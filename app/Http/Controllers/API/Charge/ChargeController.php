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
use App\Models\Msgerror;
use App\Models\Transaction;
use App\Models\Unit;

use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\SquareClient;
use Square\LocationsApi;
use Square\Exceptions\ApiException;
use Square\Http\ApiResponse;
use Square\Environment;

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
        $units = $request->units;
        $idempotency_key = uniqid();

        // ========== Payment Charge using PHP model ==========
        $client = new SquareClient([
            'accessToken' => env('SQUARE_TOKEN'),
            'environment' => Environment::SANDBOX, // 'environment' => Environment::PRODUCTION,
        ]);
        $amount_money = new Money();
        $amount_money->setAmount((int)($amount));
        $amount_money->setCurrency('USD');

        // $app_fee_money = new Money();
        // $app_fee_money->setAmount(10);
        // $app_fee_money->setCurrency('USD');

        $body = new CreatePaymentRequest(
            $card_nonce,
            $idempotency_key,
            $amount_money
        );
        // $body->setAppFeeMoney($app_fee_money);
        // $body->setCustomerId('W92WH6P11H4Z77CTET0RNTGFW8');
        // $body->setReferenceId('123456');
        $body->setAutocomplete(true);
        $body->setLocationId(env('SQUARE_LOCATION'));
        $body->setNote($note);

        $api_response = $client->getPaymentsApi()->createPayment($body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id, // User ID
                'amount' => $amount,
                'type' => $plan_type,
                'currency' => $currency,
                'units' => $units,
            ]);

            $unit_id = Unit::where('user_id', Auth::user()->id)->first();

            if (is_null($unit_id)) {
                $new_units = Unit::create([
                    'user_id' => Auth::user()->id, // User ID
                    'units' => $units,
                ]);
            } else {
                $prev_units = Unit::where('user_id', Auth::user()->id)->first()->units;
                Unit::where('user_id', Auth::user()->id)->update(array(
                    'units' => $prev_units + $units,
                ));
            }

        } else {
            $result = $api_response->getErrors();
            $msgerror = Msgerror::create([
                'error' => json_encode($result),
            ]);
        }

        return response()->json($result);

        // ========== Payment Charge using CURL ==========
        /*
        $url = 'https://connect.squareupsandbox.com/v2/payments'; // $url = 'https://connect.squareup.com/v2/payments';
        $ch = curl_init($url);
        $data = '{
            "amount_money": {
                "amount": '.(int)$amount.',
                "currency": "USD"
            },
            "idempotency_key":"'.uniqid().'",
            "source_id": "'.$card_nonce.'",
            "autocomplete": true,
            "location_id": "'.env('SQUARE_LOCATION').'",
            "note": "'.$note.'"
        }';
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Square-Version: 2022-10-19',
            'Authorization: Bearer EAAAECsHkF8m02iFRbHvk0n-t488r_peVAIzmnytflpHyGGAlGbYjxq-lIQpAF5j',
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        */
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
