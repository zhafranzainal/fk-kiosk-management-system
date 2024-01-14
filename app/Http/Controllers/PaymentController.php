<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBill(Request $request)
    {
        // Fetch all transactions
        $transactions = Transaction::all();

        // Initialize an array to store the data for each bill
        $billData = [];

        // Loop through each transaction and fetch data for its bill code
        foreach ($transactions as $transaction) {

            $billCode = $transaction->bill_code;

            // Make API call for each bill code
            $some_data = ['billCode' => $billCode];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, config('payment-gateway.api') . 'getBillTransactions');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

            $result = curl_exec($curl);
            curl_close($curl);

            $decoded_result = json_decode($result, true);

            // Extract relevant data from the API response
            $billName = $decoded_result[0]['billName'];
            $billpaymentStatus = $decoded_result[0]['billpaymentStatus'];
            $billpaymentAmount = $decoded_result[0]['billpaymentAmount'];

            // Convert bill status to its corresponding value
            switch ($billpaymentStatus) {
                case 1:
                    $convertedBillStatus = 'Paid';
                    break;
                case 2:
                    $convertedBillStatus = 'In Progress';
                    break;
                case 3:
                    $convertedBillStatus = 'Fail';
                    break;
                case 4:
                    $convertedBillStatus = 'Unpaid';
                    break;
                default:
                    $convertedBillStatus = 'Unknown';
            }

            // Store the data for each bill in the array
            $billData[] = [
                'transactionId' => $transaction->id,
                'billName' => $billName,
                'billCode' => $billCode,
                'kioskNumber' => $transaction->user->kioskParticipant->kiosk->id,
                'convertedBillStatus' => $convertedBillStatus,
                'billpaymentAmount' => $billpaymentAmount,
            ];
        }

        return view('payments.index-bills', compact('billData'));
    }


    /**
     * Display the specified resource.
     */
    public function showBill(Transaction $transaction)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function indexTransaction(Request $request)
    {
        $this->authorize('view-any', Transaction::class);

        $transactions = Transaction::All();
        return view('payments.index-transactions', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function generateBill(Request $request)
    {
        $user = Auth::user();

        $kioskId = $user->kioskParticipant->kiosk->id;

        $some_data = array(
            'userSecretKey' => config('payment-gateway.key'),
            'categoryCode' => config('payment-gateway.category'),
            'billName' => 'Rent for January 2024',
            'billDescription' => 'Kiosk Rent for FKK0' . $kioskId,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => 20000,
            'billTo' => $user->name,
            'billEmail' => $user->email,
            'billPhone' => $user->mobile_no,
            'billSplitPayment' => 0,
            'billPaymentChannel' => '0',
            'billContentEmail' => 'Thank you for paying the rent for our kiosk!',
            'billChargeToCustomer' => 0,
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, config('payment-gateway.api') . 'createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result = curl_exec($curl);
        curl_close($curl);

        $decoded_result = json_decode($result, true);

        $billCode =  $decoded_result[0]['BillCode'];
        $billAmount = $some_data['billAmount'] / 100;

        $user->transactions()->create(['user_id' => $user->id, 'bill_code' => $billCode, 'amount' => $billAmount]);

        return redirect()->route('payments.index-transaction')->withSuccess(__('Successfully stored transaction!'));
    }

    /**
     * Display the specified resource.
     */
    public function showTransaction(Transaction $transaction)
    {
        //
    }
}
