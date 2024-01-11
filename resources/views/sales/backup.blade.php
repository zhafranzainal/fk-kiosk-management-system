<x-app-layout>

    <div class="container-fluid mt-5">
        <div class="row" style="margin-right: -150px; margin-left:50px;">
            <div class="col-lg-3" style="margin-right: 20px;">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-account-multiple widget-icon" style="color: black; "></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="This Month">This Month</h5>
                        <h3 class="mt-3 mb-3">RM {{ $totalMonthlyRevenue }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="margin-right: 20px;">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-account-multiple widget-icon" style="color: black;"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="This Month">Total Profit</h5>
                        <h3 class="mt-3 mb-3">RM {{ $totalProfit }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3" style="margin-right: 20px;">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-pulse widget-icon" style="color: black; "></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="This Month">Total </h5>
                        <h3 class="mt-3 mb-3">RM {{ $totalRevenue }}</h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                            <div class="row mt-2">
                                <h4 class="mx-2 header-title">Sales List</h4>
                                <a href="{{ route('sales.create') }}" class="btn btn-danger btn-sm"
                                    style="position: absolute; right:2%;">+ Add
                                    Sales</a>
                            </div>
                        @else
                        @endif

                        <br>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead style="background: #F9FAFB;">
                                <tr>
                                    <th>No.</th>
                                    <th>Kiosk Number</th>
                                    @if (auth()->user()->getRoleNames()->first() == 'PUPUK Admin')
                                        <th>Kiosk Tenant</th>
                                    @elseif (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                                        <!-- Add your Kiosk Participant specific column here if needed -->
                                    @endif


                                    <th>Total Sales</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>FKK0{{ $sale->KioskParticipant->kiosk_id }}</td>
                                        <td>{{ $sale->created_at->formatLocalized('%B') }}</td>
                                        <td>{{ $sale->created_at->format('Y') }}</td>
                                        <td>{{ $sale->monthly_revenue }}</td>

                                        @if ($sale->status == 'Warning')
                                            <td>
                                                <span class="badge badge-warning badge-pill">Warning</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-success badge-pill">Active</span>
                                            </td>
                                        @endif
                                        <td>
                                            <!-- View Page-->

                                            <a href="{{ route('sales.show', ['sale' => $sale['id']]) }}"
                                                class="action-icon-info"><i class="mdi mdi-eye"></i></a>
                                            <!-- Edit Page-->
                                            <a href="javascript:void(0);" class="action-icon-success"
                                                data-toggle="modal"
                                                data-target="#bs-edit-modal-lg-{{ $sale->id }}"> <i
                                                    class="mdi mdi-square-edit-outline"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="bs-edit-modal-lg-{{ $sale->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Update Sales</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('sales.update', $sale->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <p class="text-muted font-13 mb-4">
                                                            Please update the details below.
                                                        </p>
                                                        <div class="row justify-content-center align-items-center g-2">
                                                            {{-- <input type="hidden" name="kiosk_participant_id" value="{{ $kiosk_participant->id ?? '' }}"> --}}
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="kiosk-tenant">Kiosk Tenant</label>
                                                                    <input type="text" id="kiosk-tenant"
                                                                        class="form-control"
                                                                        value="{{ $sale->kioskParticipant->user->name }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="kiosk-number">Kiosk Number</label>
                                                                    <input type="text" id="kiosk-number"
                                                                        name="kiosk-number" class="form-control"
                                                                        value="FKK0{{ $sale->kioskParticipant->kiosk_id }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="example-month">Month</label>
                                                                    <input class="form-control" id="example-month"
                                                                        value="{{ $sale->created_at->format('F') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="example-month">Year</label>
                                                                    <input class="form-control" id="example-year"
                                                                        value="{{ $sale->created_at->format('Y') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label>Total Sales</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="monthly_revenue"
                                                                            class="form-control"
                                                                            value="{{ $sale->monthly_revenue }}">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-secondary"
                                                                                type="reset">Reset</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Profit</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="profit"
                                                                            class="form-control"
                                                                            value="{{ $sale->profit }}">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-secondary"
                                                                                type="reset">Reset</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Cost Modal</label>
                                                                    <div class="input-group">
                                                                        <input type="text"
                                                                            name="cost_of_goods_sold"
                                                                            class="form-control"
                                                                            value="{{ $sale->cost_of_goods_sold }}">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-secondary"
                                                                                type="reset">Reset</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end row-->
                                                </div><!-- /.modal-body -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Save
                                                        changes</button>
                                                </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                @endforeach
                        </table>
                    </div> <!-- end card-body-->

                </div> <!-- end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>



</x-app-layout>
