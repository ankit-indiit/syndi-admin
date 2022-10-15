<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Msg;
use Telnyx\Telnyx;
use Telnyx\AvailablePhoneNumber;
use Telnyx\NumberOrder;
use Telnyx\PhoneNumber;
use Telnyx\MessagingProfile;
use Telnyx\Message;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Set Key
        Telnyx::setApiKey('KEY0183800AD4BCF4F52D37A672CC21A352_LKYn5P2nthQTyIs7t8xuQu');

        $msg = Message::Create([
            // "from" => "+13017860317", // Your Telnyx number
            "from" => "+12017789154", // Your Telnyx number //+12017789154 //13017860317
            "to" =>   "+13017860317",
            "text" => "Telnyx to Telnyx msg test"
        ]);

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
            "from" => $sender_phone, // Your Telnyx number //+12017789154 //+13017860317
            "to" =>   $receiver_phone,
            "text" => $message
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function webhook(Request $request)
    {
        // dd(json_encode($request->all()));
        
        $payload = $request->data['payload'];
        $sent_at = $request->data['payload']['sent_at'];
        $text = $request->data['payload']['text'];
        $sender_phone = $request->data['payload']['from']['phone_number'];
        $receiver_phone = $request->data['payload']['to'][0]['phone_number'];

        $sender_query = User::where('phone', $sender_phone)->first();
        $sender_name = $sender_query? $sender_query->first_name . ' ' . $sender_query->last_name : '';
        $receiver_query = User::where('phone', $receiver_phone)->first();
        $receiver_name = $receiver_query? $receiver_query->first_name . ' ' . $receiver_query->last_name : '';


        $last_msg = Msg::orderBy('created_at', 'desc')->first();

        $msg = Msg::create([
            'sender_phone' => $sender_phone,
            'sender_name' => $sender_name,
            'receiver_phone' => $receiver_phone,
            'receiver_name' => $receiver_name,
            // 'message' => json_encode($request->all()),
            'message' => $text,
            'sent_at' => date('Y-m-d H:i:s', strtotime($sent_at)),
        ]);

        return response()->json($msg);
    }
}
