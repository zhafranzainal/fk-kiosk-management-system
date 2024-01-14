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
        $some_data = array(
            'billCode' => 'Rent-for-October-2023',
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, config('payment-gateway.api') . 'getBillTransactions');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

        $result = curl_exec($curl);
        curl_close($curl);

        $decoded_result = json_decode($result, true);

        $billName = $decoded_result[0]['billName'];
        $billpaymentInvoiceNo = $decoded_result[0]['billpaymentInvoiceNo'];

        $billStatus = $decoded_result[0]['billStatus'];

        // Convert bill status to its corresponding value
        switch ($billStatus) {
            case 1:
                $convertedBillStatus = 'Success';
                break;
            case 2:
                $convertedBillStatus = 'Pending';
                break;
            case 3:
                $convertedBillStatus = 'Fail';
                break;
            default:
                $convertedBillStatus = 'Unknown';
        }

        $billpaymentAmount = $decoded_result[0]['billpaymentAmount'];

        return view('payments.index-bills', compact('billName', 'billpaymentInvoiceNo', 'convertedBillStatus', 'billpaymentAmount'));
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
    public function storeTransaction(Request $request)
    {
        $this->authorize('create', Transaction::class);

        $validated = $request->validated();

        $billId = $this->generateBill();

        $user = Auth::user();
        $user->transactions()->create(['id' => $billId, 'user_id' => $user->id]);

        $transaction = Transaction::create($validated);

        return redirect()->route('payments.index-transaction', $transaction)->withSuccess(__('Successfully stored transaction!'));
    }

    /**
     * Display the specified resource.
     */
    public function showTransaction(Transaction $transaction)
    {
        //
    }

    public function generateBill()
    {
        $user = Auth::user();

        $some_data = array(
            'userSecretKey' => config('payment-gateway.key'),
            'categoryCode' => config('payment-gateway.category'),
            'billName' => 'Rent for January 2024',
            'billDescription' => 'Kiosk Rent',
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => 200,
            // 'billReturnUrl' => 'http://bizapp.my',
            // 'billCallbackUrl' => 'http://bizapp.my/paystatus',
            // 'billExternalReferenceNo' => 'AFR341DFI',
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
        dd($decoded_result);


        try {
            return $decoded_result[0]->BillCode;
        } catch (Exception $e) {
            return null;
        }
    }
}
