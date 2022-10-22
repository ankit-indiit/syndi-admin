<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\Msg;
use App\Models\Msgerror;

use Telnyx\Telnyx;
use Telnyx\AvailablePhoneNumber;
use Telnyx\NumberOrder;
use Telnyx\PhoneNumber;
use Telnyx\MessagingProfile;
use Telnyx\Message;
use Carbon\Carbon;

use App\Events\NewMessage;
use App\Events\MessageStatusUpdate;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $token = $request->bearerToken();
        // $token1 = $request->header('Authorization');

        $user_phone = Auth::user()->phone;
        $messages = Msg::where(function ($query) use ($user_phone) {
                            $query->where('sender_phone', '=', $user_phone)
                                    ->orWhere('receiver_phone', '=', $user_phone);
                        })
                        ->select('room_id', 'sender_phone', 'sender_name', 'receiver_phone', 'receiver_name', 'message', 'created_at')
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->groupBy('room_id');

        $last_message_array = $this->getLastMessages($messages);
        return response()->json($last_message_array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set Key
        Telnyx::setApiKey('KEY0183800AD4BCF4F52D37A672CC21A352_LKYn5P2nthQTyIs7t8xuQu');
        
        $msg = Message::Create([
            "from" => $request->sender_phone, // Your Telnyx number //+12017789154 //+13017860317 //+14052672456
            "to" =>   $request->receiver_phone,  // Your Real number // +‪12183211745‬ //+12678719081
            "text" => $request->message,
        ]);

        return response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_phone = Auth::user()->phone;
        $receiver_phone = $id;
        $messages = Msg::where(function ($query) use ($user_phone) {
                            $query->where('sender_phone', '=', $user_phone)
                                    ->orWhere('receiver_phone', '=', $user_phone);
                        })
                        ->where(function ($query) use ($receiver_phone) {
                            $query->where('sender_phone', '=', $receiver_phone)
                                    ->orWhere('receiver_phone', '=', $receiver_phone);
                        })
                        ->select('sender_phone', 'sender_name', 'receiver_phone', 'receiver_name', 'message', 'created_at')
                        ->orderBy('created_at', 'DESC')
                        ->get();

        return response()->json($messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function webhook(Request $request)
    {
        $direction = $request->direction;

        $msgerror = Msgerror::create([
            'error' => json_encode($request->all()),
        ]);

        if ($direction == 'inbound') {
            $occurred_at = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            $payload_id = $request->sms_id;
            $sender_phone = $request->from;
            $receiver_phone = $request->to;
            $text = $request->body;
        } else {
            $occurred_at = $request->data['occurred_at'];
            $payload = $request->data['payload'];
            $payload_id = $request->data['payload']['id'];
            $text = $request->data['payload']['text'];
            $sender_phone = $request->data['payload']['from']['phone_number'];
            $receiver_phone = $request->data['payload']['to'][0]['phone_number'];

            // $sender_phone = $request->sender_phone;
            // $receiver_phone = $request->receiver_phone;
        }
        
        try {
            $last_query = Msg::where(function ($query) use ($receiver_phone, $sender_phone) {
                                $query->where('sender_phone', '=', $receiver_phone)
                                        ->Where('receiver_phone', '=', $sender_phone);
                            })
                            ->orwhere(function ($query) use ($receiver_phone, $sender_phone) {
                                $query->where('sender_phone', '=', $sender_phone)
                                        ->Where('receiver_phone', '=', $receiver_phone);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->first();
            $room_id = is_null($last_query)? Carbon::now()->timestamp : $last_query->room_id;

            $sender_query = User::where('phone', $sender_phone)->first();
            $sender_name = $sender_query? $sender_query->full_name : '';
            $sender_id = $sender_query? $sender_query->id : null;
            $receiver_query = User::where('phone', $receiver_phone)->first();
            $receiver_name = $receiver_query? $receiver_query->full_name : '';
            
            $saved_query1 = Msg::where('payload_id', $payload_id)
                                ->first();

            $saved_query2 = Msg::where('sender_phone', $sender_phone)
                                ->where('receiver_phone', $receiver_phone)
                                ->where('message', $text)
                                ->where('occurred_at', '>=', date('Y-m-d H:i:s', strtotime($occurred_at)-2))
                                ->first();

            if (is_null($saved_query1) && is_null($saved_query2)) {
                $msg = Msg::create([
                    'user_id' => $sender_id, // Sender ID
                    'payload_id' => $payload_id,
                    'room_id' => $room_id,
                    'sender_phone' => $sender_phone,
                    'sender_name' => $sender_name,
                    'receiver_phone' => $receiver_phone,
                    'receiver_name' => $receiver_name,
                    // 'message' => json_encode($request->all()),
                    'message' => $text,
                    'occurred_at' => date('Y-m-d H:i:s', strtotime($occurred_at)),
                ]);
                $data = $msg;

                // $event = NewMessage::dispatch($sender_phone, $text);
                $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $text, $occurred_at));

            } else {
                $data = $saved_query;
            }
            return response()->json($data);

        } catch (Exception $e) {
            $msgerror = Msgerror::create([
                'error' => json_encode($request->all()),
            ]);
            return response()->json($e->getMessage());
        }
    }

    public function messagePusher(Request $request)
    {
        $sender_phone = $request->sender_phone;
        $sender_name = $request->sender_name;
        $receiver_phone = $request->receiver_phone;
        $receiver_name = $request->receiver_name;
        $message = $request->message;
        $created_at = $request->created_at;

        $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $message, $created_at));
        // $event = event(new NewMessage($sender_phone, $text));
        // $event = broadcast(new NewMessage($sender_phone, $text));
        // broadcast(new NewMessage($sender_phone, $text))->toOthers();

        return response()->json(
            [
                'sender_phone' => $sender_phone,
                'sender_name' => $sender_name,
                'receiver_phone' => $receiver_phone,
                'receiver_name' => $receiver_name,
                'message' => $message,
                'created_at' => $created_at
            ]
        );
    }

     /**
     * Messages List Array Get Function.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function getLastMessages($messages)
    {
        $messages_array = array();
        foreach ($messages as $key => $message_arr)
        {
            $sort_array = $message_arr->toArray();
            usort($sort_array, function($first, $second) {
                return $first['created_at'] < $second['created_at'];
            });
            $sub_arr = [];
            $sub_arr['sender_phone'] = '';
            $sub_arr['sender_name'] = '';
            $sub_arr['receiver_phone'] = '';
            $sub_arr['receiver_name'] = '';
            $sub_arr['message'] = '';
            $sub_arr['created_at'] = '';

            if (!is_null($sort_array[0])) {
                $sub_arr['sender_phone'] = $sort_array[0]['sender_phone'];
                $sub_arr['sender_name'] = $sort_array[0]['sender_name'];
                $sub_arr['receiver_phone'] = $sort_array[0]['receiver_phone'];
                $sub_arr['receiver_name'] = $sort_array[0]['receiver_name'];
                $sub_arr['message'] = $sort_array[0]['message'];
                $sub_arr['created_at'] = $sort_array[0]['created_at'];
            }
            array_push($messages_array, $sub_arr);
        }
        return $messages_array;
    }
}
