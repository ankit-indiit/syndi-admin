<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Msg;
use App\Models\Msgerror;
use App\Models\Img;
use App\Models\Unit;

use Telnyx\Telnyx;
use Telnyx\AvailablePhoneNumber;
use Telnyx\NumberOrder;
use Telnyx\PhoneNumber;
use Telnyx\MessagingProfile;
use Telnyx\Message;
use Carbon\Carbon;

use App\Events\NewMessage;

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

        $msg_arr = array();
        $sender_phone = $request->sender_phone;
        $receiver_phones = $request->receiver_phones;
        $text = $request->message;
        $send_now = $request->send_now;
        $schedule_at = $request->schedule_at;
        $imageUrls = $request->imageUrls;

        $textLength = Str::length($text);
        foreach ($imageUrls as $key => $url) {
            $textLength += Str::length($url);
        }
        if ($textLength == 0) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Your message is empty. Please type or input an image.',
            ]);
        }
        $count_receivers = count($receiver_phones);
        $units = ($textLength % 120) == 0 ? floor($textLength / 120) : floor($textLength / 120) + 1;
        $total_units = $units * $count_receivers;
        if ($total_units > Auth::user()->units->units) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Your unit balance is not enough for your new message. Please charge.',
            ]);
        }

        foreach ($receiver_phones as $key => $receiver_phone)
        {
            if ($send_now) {
                $msg = Message::Create([
                    "from" => $sender_phone, // Your Telnyx number //+15512094584 //+13017860317 //+14052672456
                    "to" =>   $receiver_phone,  // Your Real number // +‪12183211745‬ //+12678719081
                    "text" => $text,
                    'media_urls' => $imageUrls
                ]);
            }
            
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
                'message' => $text,
                'units' => $units,
                'schedule_at' => $send_now? null: date('Y-m-d H:i:s', strtotime($schedule_at)),
            ]);

            $prev_units = Unit::where('user_id', Auth::user()->id)->first()->units;
            Unit::where('user_id', Auth::user()->id)->update(array(
                'units' => $prev_units - $total_units,
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
            array_push($msg_arr, 
                [
                    'user_id' => $sender_id, // Sender ID
                    'room_id' => $room_id,
                    'sender_phone' => $sender_phone,
                    'sender_name' => $sender_name,
                    'receiver_phone' => $receiver_phone,
                    'receiver_name' => $receiver_name,
                    'message' => $text,
                    'imgs' => $imageUrls,
                ]
            );
        }
        return response()->json($msg_arr);
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

    /**
     * Schedule Multi Message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function scheduleMultiMessage()
    {
        Telnyx::setApiKey(env('TELNYX_API_KEY'));

        $schedule_query = Msg::with(['img' => function ($query) {
                                $query->select('msg_id', 'img_url');
                            }])->where('schedule_at', '!=', null)
                            ->where('schedule_sent', 0)
                            ->get();

        foreach ($schedule_query as $key => $value)
        {
            $current_time = Carbon::now()->timestamp;
            $schedule_at = strtotime($value->schedule_at);

            $imageUrls = [];
            foreach ($value->img as $key => $image)
            {
                array_push($imageUrls, $image->img_url);
            }

            if ($schedule_at != 0 && $current_time >= $schedule_at)
            {
                $msg = Message::Create([
                    "from" => $value->sender_phone,
                    "to" =>   $value->receiver_phone,
                    "text" => $value->message,
                    'media_urls' => $imageUrls
                ]);

                $msg_update = DB::table('msgs')
                                ->where('id', $value->id)
                                ->update(array(
                                    'schedule_at' => null,
                                    'schedule_sent' => 1,
                                    'created_at' => $value->schedule_at,
                                    'updated_at' => $value->schedule_at,
                                ));
            }

            $sender_phone = $value->sender_phone;
            $sender_name = $value->sender_name;
            $receiver_phone = $value->receiver_phone;
            $receiver_name = $value->receiver_name;

            $event = event(new NewMessage($sender_phone, $sender_name, $receiver_phone, $receiver_name, $text, $msg->created_at, $imageUrls));
        }
    }
}
