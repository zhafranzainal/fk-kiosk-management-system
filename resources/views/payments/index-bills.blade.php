<x-app-layout>
    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="row">
                        <h4 class="header-title" style="margin-left: 10px">Bills List</h4>

                        {{-- <form action="{{ route('payments.store-transaction') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                Generate Bill
                            </button>
                        </form> --}}

                        <a href="{{ route('payments.index-transaction') }}" class="btn btn-danger btn-sm"
                            style="position: absolute; right:2%;">
                            Transaction History
                        </a>
                    </div>
                    <br>

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">

                        <thead style="background: #F9FAFB;">
                            <tr>
                                <th>No.</th>
                                <th>Bill Name</th>
                                <th>Bill Code</th>
                                <th>Kiosk Number</th>
                                <th>Status</th>
                                <th>Billing Period</th>
                                <th>Amount (RM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($billData as $bill)
                                <tr>

                                    <td>{{ $bill['transactionId'] }}</td>
                                    <td>{{ $bill['billName'] }}</td>
                                    <td>{{ $bill['billCode'] }}</td>
                                    <td>FKK{{ str_pad($bill['kioskNumber'], 2, '0', STR_PAD_LEFT) }}

                                    <td>
                                        @switch($bill['convertedBillStatus'])
                                            @case('Paid')
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#00ff40"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                            @break

                                            @case('Unpaid')
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#ff0000"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                            @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#FFA500"
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                                </svg>
                                        @endswitch
                                        <span>{{ $bill['convertedBillStatus'] }}</span>
                                    </td>

                                    <td>{{ $bill['billingPeriod'] }}</td>
                                    <td>{{ $bill['billpaymentAmount'] }}</td>

                                    <td>

                                        @role('Kiosk Participant')
                                            @if ($bill['convertedBillStatus'] !== 'Paid')
                                                <a href="https://dev.toyyibpay.com/{{ $bill['billCode'] }}"
                                                    class="action-icon-danger">
                                                    <i class="mdi mdi-cash-plus"></i>
                                                </a>
                                            @endif
                                        @endrole

                                        <a href="{{ route('payments.show-bill', $bill['transactionId']) }}"
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
