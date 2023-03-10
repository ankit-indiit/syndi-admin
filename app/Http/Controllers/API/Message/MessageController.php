<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Exception;

use App\Models\User;
use App\Models\Msg;
use App\Models\Msgerror;
use App\Models\Img;
use App\Models\Unit;
use App\Models\Contact;
use App\Models\Group;

use Telnyx\Telnyx;
use Telnyx\AvailablePhoneNumber;
use Telnyx\NumberOrder;
use Telnyx\PhoneNumber;
use Telnyx\MessagingProfile;
use Telnyx\Message;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Events\NewMessage;
use App\Notifications\MessageNotification;

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
        $messages = Msg::with(['img' => function ($query) {
                            $query->select('msg_id', 'img_url');
                        }])
                        ->where(function ($query) use ($user_phone) {
                            $query->where('sender_phone', '=', $user_phone)
                                    ->orWhere('receiver_phone', '=', $user_phone);
                        })
                        ->where('schedule_at', null)
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
        $sender_phone = $request->sender_phone;
        $receiver_phone = $request->receiver_phone;
        $text = $request->message;
        $imageUrls = $request->imageUrls;

        $textLength = Str::length($text);
        // if (count($imageUrls) > 0) {
        //     foreach ($imageUrls as $key => $url) {
        //         $textLength += Str::length($url);
        //     }
        // }
        if ($textLength == 0) {
            return response()->json([
                'status' => 406,
                'message' => 'Your message is empty. Please type or input an image.',
            ]);
        }
        $units = ($textLength % 120) == 0 ? floor($textLength / 120) : floor($textLength / 120) + 1;

        if ($units > Auth::user()->units->units) {
            return response()->json([
                'status' => 406,
                'message' => 'Your unit balance is not enough for your new message. Please charge.',
            ]);
        }

        // Set Key
        Telnyx::setApiKey(env('TELNYX_API_KEY'));
        $msg = Message::Create([
            "from" => $sender_phone, // Your Telnyx number //+15512094584 //+13017860317 //+14052672456
            "to" =>   $receiver_phone,  // Your Real number // +???12183211745??? //+12678719081
            "text" => $text,
            // 'subject' => 'Picture',
            // 'media_urls' => ''
        ]);

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
        $new_room_id = (Carbon::now()->timestamp).(str_replace('+', '_', $receiver_phone));
        $room_id = is_null($last_query)? $new_room_id : $last_query->room_id;

        $sender_query = User::where('phone', $sender_phone)->first();
        $sender_name = $sender_query? $sender_query->full_name : '';
        $sender_id = $sender_query? $sender_query->id : null;
        $receiver_query1 = User::where('phone', $receiver_phone)->first();
        $receiver_query2 = Contact::where('phone_number', $receiver_phone)->where('user_id', Auth::user()->id)->first();
        $receiver_name = is_null($receiver_query1) ? is_null($receiver_query2) ? '' : $receiver_query2->first_name . ' ' . $receiver_query2->last_name : $receiver_query1->full_name;

        $msg = Msg::create([
            'user_id' => $sender_id, // Sender ID
            'room_id' => $room_id,
            'sender_phone' => $sender_phone,
            'sender_name' => $sender_name,
            'receiver_phone' => $receiver_phone,
            'receiver_name' => $receiver_name,
            'message' => $text,
            'units' => $units,
        ]);
        $receiver_query1->notify(new MessageNotification($msg));
        $prev_units = Unit::where('user_id', Auth::user()->id)->first()->units;
        Unit::where('user_id', Auth::user()->id)->update(array(
            'units' => $prev_units - $units,
        ));

        // Image URL Store
        $msg_id = $msg->id;
        foreach ($imageUrls as $key => $url) {
            $userId = User::where('phone', $sender_phone)->first()->id;
            $img = Img::create([
                'user_id' => $userId,
                'msg_id' => $msg_id,
                'type' => 'library',
                'img_url' => $url,
            ]);
        }

        // $event = NewMessage::dispatch($sender_phone, $text);
        $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $text, $msg->created_at, $imageUrls));
        
        return response()->json([
            'user_id' => $sender_id, // Sender ID
            'room_id' => $room_id,
            'sender_phone' => $sender_phone,
            'sender_name' => $sender_name,
            'receiver_phone' => $receiver_phone,
            'receiver_name' => $receiver_name,
            'message' => $text,
            'imgs' => $imageUrls,
        ]);
        
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

        $messages = Msg::with(['img' => function ($query) {
                            $query->select('msg_id', 'img_url');
                        }])->where(function ($query) use ($user_phone) {
                            $query->where('sender_phone', '=', $user_phone)
                                    ->orWhere('receiver_phone', '=', $user_phone);
                        })
                        ->where(function ($query) use ($receiver_phone) {
                            $query->where('sender_phone', '=', $receiver_phone)
                                    ->orWhere('receiver_phone', '=', $receiver_phone);
                        })
                        ->where('schedule_at', null)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        
        $message_array = $this->getMessageDetails($messages);
        return response()->json($message_array);
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
        $msg_update = Msg::where('id', $id)
                        ->update(array('read' => 1));

        return response()->json([
            'status' => 'Success',
            'message' => 'You read the new message.'
        ]);
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
        $store_flag = 0;

        if (is_null($direction)) {
            $created_at = $request->data['occurred_at'];
            $payload = $request->data['payload'];
            $payload_id = $request->data['payload']['id'];
            $text = $request->data['payload']['text'];
            $direction = $request->data['payload']['direction'];
            $sender_phone = $request->data['payload']['from']['phone_number'];
            $receiver_phone = $request->data['payload']['to'][0]['phone_number'];
            
            $from_line_type = $request->data['payload']['from']['line_type'];
            if ($from_line_type == 'Wireline') {
                $store_flag = 1;
            }
        } else {
            $created_at = date('Y-m-d H:i:s', strtotime(Carbon::now()));
            $payload_id = $request->sms_id;
            $sender_phone = $request->from;
            $receiver_phone = $request->to;
            $text = $request->body;
            $store_flag = 1;
        }

        if ($direction == 'inbound' && $store_flag == 1) {
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
                $new_room_id = (Carbon::now()->timestamp).(str_replace('+', '_', $receiver_phone));
                $room_id = is_null($last_query)? $new_room_id : $last_query->room_id;
                
                $sender_query1 = User::where('phone', $sender_phone)->first();
                $sender_query2 = Contact::where('phone_number', $sender_phone)
                                        ->where(function ($query) {
                                            if (Auth::check()) {
                                                $query->where('user_id', Auth::user()->id);
                                            }
                                        })
                                        ->first();
                $sender_name = is_null($sender_query1)? is_null($sender_query2)? '' : $sender_query2->first_name . ' ' . $sender_query2->last_name : $sender_query1->full_name;
                $sender_id = $sender_query1? $sender_query1->id : null;
                $receiver_query1 = User::where('phone', $receiver_phone)->first();
                $receiver_query2 = Contact::where('phone_number', $receiver_phone)
                                        ->where(function ($query) {
                                            if (Auth::check()) {
                                                $query->where('user_id', Auth::user()->id);
                                            }
                                        })
                                        ->first();
                $receiver_name = is_null($receiver_query1)? is_null($receiver_query2)? '' : $receiver_query2->first_name . ' ' . $receiver_query2->last_name : $receiver_query1->full_name;
                
                $saved_query = Msg::where('sender_phone', $sender_phone)
                                    ->where('receiver_phone', $receiver_phone)
                                    ->where('message', $text)
                                    ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($created_at)-10))
                                    ->first();
    
                if (is_null($saved_query)) {
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
                        'created_at' => date('Y-m-d H:i:s', strtotime($created_at)),
                    ]);
                    $data = $msg;
    
                    // $event = NewMessage::dispatch($sender_phone, $text);
                    $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $text, $created_at, []));
    
                } else {
                    $data = $saved_query;
                }
                return response()->json($data);
    
            } catch (\Exception $e) {
                $req = Msgerror::create([
                    'error' => json_encode($request->all()),
                ]);
                $error = Msgerror::create([
                    'error' => json_encode($e->getMessage()),
                ]);
                return response()->json($e->getMessage());
            }
        }
    }

    // Test Function
    public function messagePusher(Request $request)
    {
        $sender_phone = $request->sender_phone;
        $sender_name = $request->sender_name;
        $receiver_phone = $request->receiver_phone;
        $receiver_name = $request->receiver_name;
        $message = $request->message;
        $created_at = $request->created_at;
        $imageUrls = $request->imageUrls;

        $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $message, $created_at, $imageUrls));
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
                'created_at' => $created_at,
                'imgs' => $imageUrls,
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
            $sub_arr['id'] = '';
            $sub_arr['sender_phone'] = '';
            $sub_arr['sender_name'] = '';
            $sub_arr['receiver_phone'] = '';
            $sub_arr['receiver_name'] = '';
            $sub_arr['message'] = '';
            $sub_arr['read'] = '';
            $sub_arr['created_at'] = '';

            if (!is_null($sort_array[0]))
            {
                $img_arr = [];
                foreach ($sort_array[0]['img'] as $key => $img) {
                    array_push($img_arr, $img['img_url']);
                }
                $sub_arr['id'] = $sort_array[0]['id'];
                $sub_arr['sender_phone'] = $sort_array[0]['sender_phone'];
                $sub_arr['sender_name'] = $sort_array[0]['sender_name'];
                $sub_arr['receiver_phone'] = $sort_array[0]['receiver_phone'];
                $sub_arr['receiver_name'] = $sort_array[0]['receiver_name'];

                if ($sub_arr['receiver_phone'] == Auth::user()->phone) {
                    $sub_arr['sender_name'] = $sort_array[0]['receiver_name'];
                    $sub_arr['receiver_name'] = $sort_array[0]['sender_name'];
                }

                $sub_arr['message'] = $sort_array[0]['message'];
                $sub_arr['created_at'] = $sort_array[0]['created_at'];
                $sub_arr['read'] = $sort_array[0]['read'];
                $sub_arr['imgs'] = $img_arr;
            }
            array_push($messages_array, $sub_arr);
        }
        return $messages_array;
    }

    /**
     * Messages List Array Get Function.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function getMessageDetails($messages)
    {
        $messages_array = array();
        foreach ($messages as $key => $message_arr)
        {
            $sub_arr = [];
            $sub_arr['sender_phone'] = $message_arr->sender_phone;
            $sub_arr['sender_name'] = $message_arr->sender_name;
            $sub_arr['receiver_phone'] = $message_arr->receiver_phone;
            $sub_arr['receiver_name'] = $message_arr->receiver_name;
            $sub_arr['message'] = $message_arr->message;
            $sub_arr['created_at'] = $message_arr->created_at;
            $sub_arr['imgs'] = [];

            foreach ($message_arr->img as $key => $image)
            {
                array_push($sub_arr['imgs'], $image->img_url);
            }
            array_push($messages_array, $sub_arr);
        }
        return $messages_array;
    }

    public function msgReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        $messages = Msg::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);
        $period = CarbonPeriod::create($request->start_date, $request->end_date);
        $days = [];
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('d M Y');
            $days[] = Msg::whereDate('created_at', $date)->count();           
        }
        return response()->json([
            'status' => $messages->count() > 0 ? true : false,
            'count' => $messages->count(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'data' => [
                'x' => $days,
                'y' => $dates,
            ],
        ]);
    }
}
