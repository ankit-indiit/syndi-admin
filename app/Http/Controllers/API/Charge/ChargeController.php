<?php

namespace App\Http\Controllers\API\Charge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

use App\Models\User;

use Nikolag\Square\Facades\Square;
use Nikolag\Square\Models\Customer;

class ChargeController extends Controller
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
        $amount = $request->amount;
        $card_nonce = $request->card_nonce;
        $currency = $request->currency;
        $plan_type = $request->plan_type;
        $note = $request->note;

        // dd($request->all());

        $transaction = Square::charge([
            'amount' => 100 * (int) $amount,
            'card_nonce' => $card_nonce,
            'location_id' => env('SQUARE_LOCATION'),
            'currency' => $currency,
            'source_id' => $card_nonce,
            'note' => $note,
        ]);

        // To be removed after completed
        $msgerror = Msgerror::create([
            'error' => json_encode($transaction),
        ]);
        // End

        return response()->json(compact('transaction'));
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
        // $amount_money = new \Square\Models\Money();
        // $amount_money->setAmount(1000);
        // $amount_money->setCurrency('USD');

        // $app_fee_money = new \Square\Models\Money();
        // $app_fee_money->setAmount(10);
        // $app_fee_money->setCurrency('USD');

        // $body = new \Square\Models\CreatePaymentRequest(
        //     'ccof:GaJGNaZa8x4OgDJn4GB',
        //     '7b0f3ec5-086a-4871-8f13-3c81b3875218',
        //     $amount_money
        // );
        // $body->setAppFeeMoney($app_fee_money);
        // $body->setAutocomplete(true);
        // $body->setCustomerId('W92WH6P11H4Z77CTET0RNTGFW8');
        // $body->setLocationId(env('SQUARE_LOCATION'));
        // $body->setReferenceId('123456');
        // $body->setNote('Brief description');

        // $api_response = $client->getPaymentsApi()->createPayment($body);

        // if ($api_response->isSuccess()) {
        //     $result = $api_response->getResult();
        // } else {
        //     $errors = $api_response->getErrors();
        // }


        $amount = $request->amount;
        $card_nonce = $request->card_nonce;
        $currency = $request->currency;
        $plan_type = $request->plan_type;
        $note = $request->note;

        // Payment Charge
        $url = 'https://connect.squareup.com/v2/payments';
        $ch = curl_init($url);
        $data = '{
            "idempotency_key":"'.uniqid().'",
            "amount_money": {
                "amount": "'.$amount.'",
                "currency": "USD"
            },
            "source_id": "'.$card_nonce.'",
            "autocomplete": true,
            "location_id": "'.env('SQUARE_LOCATION').'",
            "note": "'.$note.'",
        }';
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Square-Version: 2022-10-19',
            'Authorization: Bearer EAAAECsHkF8m02iFRbHvk0n-t488r_peVAIzmnytflpHyGGAlGbYjxq-lIQpAF5j',
        ];
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        // dd(json_decode($result));

        return response()->json($result);
        
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
