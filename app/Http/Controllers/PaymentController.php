<?php

namespace App\Http\Controllers;

use App\Models\KioskParticipant;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBill(Request $request)
    {
        if (auth()->user()->hasRole('FK Bursary')) {
            $transactions = Transaction::all();
        } else {
            $transactions = auth()->user()->transactions;
        }

        // Initialize an array to store the data for each bill
        $billData = [];

        // Loop through each transaction and fetch data for its bill code
        foreach ($transactions as $transaction) {

            $billCode = $transaction->bill_code;

            $createdAt = $transaction->created_at;
            $carbonCreatedAt = Carbon::parse($createdAt);

            $billingPeriod = $carbonCreatedAt->isoFormat('DD MMM') . ' - ' . $carbonCreatedAt->addMonth()->subDay()->isoFormat('DD MMM');

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
            $billName = $decoded_result[0]['billName'] ?? $transaction->bill_name;
            $billpaymentStatus = $decoded_result[0]['billpaymentStatus'] ?? 4;
            $billpaymentAmount = $decoded_result[0]['billpaymentAmount'] ?? '200.00';

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
                'billingPeriod' => $billingPeriod,
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
        return view('payments.show-bill', compact('transaction'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexTransaction(Request $request)
    {
        $this->authorize('view-any', Transaction::class);

        if (auth()->user()->hasRole('FK Bursary')) {
            $transactions = Transaction::all();
        } else {
            $transactions = auth()->user()->transactions;
        }

        // Initialize an array to store the data for each bill
        $billData = [];

        // Loop through each transaction and fetch data for its bill code
        foreach ($transactions as $transaction) {

            $billCode = $transaction->bill_code;

            $paymentDate = Carbon::parse($transaction->updated_at)->format('d/m/Y H:i:s');

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
            $referenceNo = $decoded_result[0]['billpaymentInvoiceNo'] ?? $billCode;
            $billpaymentStatus = $decoded_result[0]['billpaymentStatus'] ?? 4;
            $billpaymentAmount = $decoded_result[0]['billpaymentAmount'] ?? '200.00';

            // Convert bill status to its corresponding value
            switch ($billpaymentStatus) {
                case 1:
                    $convertedBillStatus = 'Successful';
                    break;
                case 2:
                    $convertedBillStatus = 'In Progress';
                    break;
                case 3:
                    $convertedBillStatus = 'Unsuccessful';
                    break;
                case 4:
                    $convertedBillStatus = 'Pending';
                    break;
                default:
                    $convertedBillStatus = 'Unknown';
            }

            // Store the data for each bill in the array
            $billData[] = [
                'transactionId' => $transaction->id,
                'referenceNo' => $referenceNo,
                'payerName' => $transaction->user->name,
                'kioskNumber' => $transaction->user->kioskParticipant->kiosk->id,
                'convertedBillStatus' => $convertedBillStatus,
                'paymentDate' => $paymentDate,
                'billpaymentAmount' => $billpaymentAmount,
            ];
        }

        return view('payments.index-transactions', compact('billData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function generateBill()
    {
        // Get next month from current month
        $nextMonthYear = Carbon::now()->addMonth()->format('F Y');

        // Get all kiosk participants
        $kioskParticipants = KioskParticipant::all();

        foreach ($kioskParticipants as $kioskParticipant) {

            // Check if the kiosk participant has a kiosk relationship
            if ($kiosk = $kioskParticipant->kiosk) {

                // Extract kiosk ID
                $kioskId = $kiosk->id;

                // Create some_data for the bill
                $some_data = array(
                    'userSecretKey' => config('payment-gateway.key'),
                    'categoryCode' => config('payment-gateway.category'),
                    'billName' => 'Rent for ' . $nextMonthYear,
                    'billDescription' => 'Kiosk Rent for FKK0' . $kioskId,
                    'billPriceSetting' => 1,
                    'billPayorInfo' => 1,
                    'billAmount' => 20000,
                    'billTo' => $kioskParticipant->user->name,
                    'billEmail' => $kioskParticipant->user->email,
                    'billPhone' => $kioskParticipant->user->mobile_no,
                    'billSplitPayment' => 0,
                    'billPaymentChannel' => '0',
                    'billContentEmail' => 'Thank you for paying the rent for our kiosk!',
                    'billChargeToCustomer' => 0,
                );

                // Make the API call to create the bill
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_URL, config('payment-gateway.api') . 'createBill');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

                $result = curl_exec($curl);
                curl_close($curl);

                // Decode the API response
                $decoded_result = json_decode($result, true);

                $billName = $some_data['billName'];
                $billCode = $decoded_result[0]['BillCode'];
                $billAmount = $some_data['billAmount'] / 100;

                // Create a transaction record for the user
                $kioskParticipant->user->transactions()->create([
                    'user_id' => $kioskParticipant->user->id,
                    'bill_name' => $billName,
                    'bill_code' => $billCode,
                    'amount' => $billAmount,
                ]);
            }
        }

        return redirect()->route('payments.index-bill')->withSuccess(__('Successfully stored bill!'));
    }

    /**
     * Display the specified resource.
     */
    public function showTransaction(Transaction $transaction)
    {
        return view('payments.show-transaction', compact('transaction'));
    }
}
