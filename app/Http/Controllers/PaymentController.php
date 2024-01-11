<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

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
        $billpaymentAmount = $decoded_result[0]['billpaymentAmount'];

        return view('payments.index-bills', compact('billName', 'billpaymentInvoiceNo', 'billStatus', 'billpaymentAmount'));
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
        return view('payments.index', compact('transactions'));
    }

    /**
     * Display the specified resource.
     */
    public function showTransaction(Transaction $transaction)
    {
        //
    }
}
