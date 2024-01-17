<x-app-layout>
    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="row">
                        <h4 class="header-title" style="margin-left: 10px">Transaction History</h4>
                    </div>
                    <br>

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">

                        <thead style="background: #F9FAFB;">
                            <tr>
                                <th>ID</th>
                                <th>Reference No.</th>
                                <th>Payer Name</th>
                                <th>Kiosk Number</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                                <th>Amount (RM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($billData as $bill)
                                <tr>

                                    <td>{{ $bill['transactionId'] }}</td>
                                    <td>{{ $bill['referenceNo'] }}</td>
                                    <td>{{ $bill['payerName'] }}</td>
                                    <td>FKK{{ str_pad($bill['kioskNumber'], 2, '0', STR_PAD_LEFT) }}</td>

                                    <td>
                                        @switch($bill['convertedBillStatus'])
                                            @case('Successful')
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#00ff40"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                            @break

                                            @case('Pending')
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#FFA500"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                            @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#ff0000"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                        @endswitch
                                        <span>{{ $bill['convertedBillStatus'] }}</span>
                                    </td>

                                    <td>{{ $bill['paymentDate'] }}</td>
                                    <td>{{ $bill['billpaymentAmount'] }}</td>

                                    <td>
                                        <a href="{{ route('payments.show-transaction', $bill['transactionId']) }}"
                                            class="action-icon-info">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
