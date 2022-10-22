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

class MultiMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Msg::all();
        $phones = array();

        foreach ($messages as $key => $value)
        {
            if(!in_array($value->sender_phone, $phones)) {
                array_push($phones, $value->sender_phone);
            }
            if(!in_array($value->receiver_phone, $phones)) {
                array_push($phones, $value->receiver_phone);
            }
        }
        return response()->json($phones);
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
        Telnyx::setApiKey(env('TELNYX_API_KEY'));

        $sender_phone = $request->sender_phone;
        $receiver_phones = $request->receiver_phones;
        $text = $request->message;

        foreach ($receiver_phones as $key => $receiver_phone)
        {
            $msg = Message::Create([
                "from" => $sender_phone, // Your Telnyx number //+12017789154 //+13017860317 //+14052672456
                "to" =>   $receiver_phones,  // Your Real number // +‪12183211745‬ //+12678719081
                "text" => $text,
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

            $room_id = is_null($last_query)? Carbon::now()->timestamp : $last_query->room_id;

            $sender_query = User::where('phone', $sender_phone)->first();
            $sender_name = $sender_query? $sender_query->full_name : '';
            $sender_id = $sender_query? $sender_query->id : null;
            $receiver_query = User::where('phone', $receiver_phone)->first();
            $receiver_name = $receiver_query? $receiver_query->full_name : '';

            $msg = Msg::create([
                'user_id' => $sender_id, // Sender ID
                'room_id' => $room_id,
                'sender_phone' => $sender_phone,
                'sender_name' => $sender_name,
                'receiver_phone' => $receiver_phone,
                'receiver_name' => $receiver_name,
                // 'message' => json_encode($request->all()),
                'message' => $text,
            ]);

            // $event = NewMessage::dispatch($sender_phone, $text);
            $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $text, $msg->created_at));

            return response()->json($msg);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
