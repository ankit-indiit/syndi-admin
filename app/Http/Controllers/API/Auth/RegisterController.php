<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use Telnyx\Telnyx;
use Telnyx\AvailablePhoneNumber;
use Telnyx\NumberOrder;
use Telnyx\PhoneNumber;
use Telnyx\MessagingProfile;



class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // Availble Phone Number List
        $av_list = AvailablePhoneNumber::All(['filter[country_code]' => 'US', 
                                            // 'filter[features]' => 'sms',
                                            'filter[phone_number_type]' => 'local',
                                            // 'filter[locality]' => 'local',
                                            // 'filter[administrative_area]' => 'CA',
                                            'filter[national_destination_code]' => '301',
                                            // "filter[phone_number][starts_with]" => "209",
                                            'filter[limit]' => 10]
                                        );

        // dd($av_list);

        // Create Telnyx phone number
        // $new_user_phone = NumberOrder::Create(["phone_numbers" => [["phone_number" => "+13017860317"]]]);
        // dd($new_user_phone);

        // Current Phone Number
        $current_phone = PhoneNumber::All(['filter[phone_number]' => '+13017860317']);
        $current_phone_id = $current_phone->data[0]->id;
        // dd($current_phone, $current_phone_id);

        // Retrive Phone
        // $retrive_phone = PhoneNumber::Retrieve($current_phone_id);
        // dd($retrive_phone);

        // Retrive Message Profile
        // $phone_number = PhoneNumber::Retrieve("2010018953069332345");
        // 2010018953069332345
        // 304d957f-48e5-49b8-a32f-ccb6848ba6a1
        // dd($phone_number);

        // Retrive Message Profile
        // $msg_profile =  MessagingProfile::Retrieve("400183cb-3f07-4b96-a93a-7a88ee855210");
        // $msg_profile_id = $msg_profile->id;
        // dd($msg_profile);
        

        // Create Message profile
        // $new_message_profile = MessagingProfile::Create([ "enabled" => true, 
        //                                               "name" => "Profile for +13017860317",
        //                                               "number_pool_settings" => [ "geomatch" => false, 
        //                                                                           "long_code_weight" => 1,
        //                                                                           "skip_unhealthy" => true,
        //                                                                           "sticky_sender" => false,
        //                                                                           "toll_free_weight" => 10
        //                                                                         ],
        //                                               "url_shortener_settings" => [ "domain" => "",
        //                                                                             "prefix" => "",
        //                                                                             "replace_blacklist_only" => true,
        //                                                                             "send_webhooks" => false
        //                                                                         ],
        //                                               "webhook_api_version" => "2",
        //                                               "webhook_failover_url" => "",
        //                                             //   "webhook_url" => "http://telnyxwebhooks.com:8084/7f750dee-01fd-49e1-8325-2622d70e0051"
        //                                               "webhook_url" => ""
        //                                             ]);
        // dd($new_message_profile);
    
// http://telnyxwebhooks.com:8084/7f750dee-01fd-49e1-8325-2622d70e0051
// https://webhook.site/3bd28ed8-6442-42a6-85b3-26084fe88efb

// 400183cd-527d-4a22-bcb6-64df180021ed
// 400183cb-3f07-4b96-a93a-7a88ee855210


        // Create Message profile
        // $update_message_profile_ = MessagingProfile::Update('400183cb-3f07-4b96-a93a-7a88ee855210',
        //                             [   
        //                                 "webhook_api_version" => "2",
        //                                 "webhook_failover_url" => "",
        //                                 "webhook_url" => "http://3.137.108.96/webhook"
        //                             ]);
        // dd($update_message_profile_);


        // Assign Your Phone Number to Your Messaging Profile
        // $assign = PhoneNumber::Update($current_phone_id, ["messaging_product" => "P2P", "messaging_profile_id" => $msg_profile_id]);
        // dd($assign);



        // $url = 'https://api.telnyx.com/v2/messaging_hosted_number_orders';
        // $ch = curl_init($url);
        // $data = '{
        //     "messaging_profile_id":"400183cb-3f07-4b96-a93a-7a88ee855210",
        //     "phone_numbers":["+12017789154"]
        // }';
        // //+13017860317
        // $headers = [
        //     'Content-Type: application/json',
        //     'Accept: application/json',
        //     'Authorization: Bearer KEY0183800AD4BCF4F52D37A672CC21A352_LKYn5P2nthQTyIs7t8xuQu',
        // ];
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // $result = curl_exec($ch);
        // curl_close($ch);



        $url = 'https://api.telnyx.com/v2/phone_numbers/'.$current_phone_id.'/messaging';
        $ch = curl_init($url);
        $data = '{
            "messaging_profile_id":"'.$message_profile->id.'"
        }';

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer KEY0183800AD4BCF4F52D37A672CC21A352_LKYn5P2nthQTyIs7t8xuQu',
        ];

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

dd(json_decode($result));


        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'account_id' => $request->account_id,
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
            'email' => trim($request->email),
            'company' => trim($request->company),
            'phone' => $request->phone,
            'timezone' => $request->timezone,
            'password' => Hash::make($request->password),
            'dpassword' => $request->password
        ]);

        $signup_state = $user->save();
        $token = $user->createToken('API Token')->accessToken;
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
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
