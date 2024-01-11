<x-app-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')


        <div class="container-fluid mt-3">
            <div class="row" style="margin-right: -150px; margin-left:50px;">
                <div class="col-lg-3" style="margin-right: 20px;">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="mdi mdi-account-multiple widget-icon bg-secondary" style="color: black; "></i>
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
                                <i class="mdi mdi-account-multiple widget-icon bg-secondary" style="color: black;"></i>
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
                                <i class="mdi mdi-pulse widget-icon bg-secondary" style="color: black; "></i>
                            </div>
                            <h5 class="text-muted font-weight-normal mt-0" title="This Month">Total Revenue </h5>
                            <h3 class="mt-3 mb-3">RM {{ $totalRevenue }}</h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Sales Statistic</h4>
                    <div id="chart_div" style="height: 300px;"></div>
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
                                        <th>Month</th>
                                        <th>Year</th>
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
                                        <div class="modal fade" id="bs-edit-modal-lg-{{ $sale->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                            aria-hidden="true">
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
                                                            <div
                                                                class="row justify-content-center align-items-center g-2">
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
                                                                            <input type="text"
                                                                                name="monthly_revenue"
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
        <script>
            google.charts.load('current', {
                packages: ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {
                var monthlyData = {!! json_encode($monthlyData) !!};

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Monthly Revenue');

                // Add data to the chart
                monthlyData.forEach(function(item) {
                    data.addRow([getMonthName(item.month), item.revenue]);
                });

                var options = {
                    title: 'Monthly Revenue',
                    chartArea: {
                        width: '50%'
                    },
                    hAxis: {
                        title: 'Month'
                    },
                    vAxis: {
                        title: 'Monthly Revenue (RM)'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            function getMonthName(monthNumber) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                    'November', 'December'
                ];
                return months[monthNumber - 1];
            }
        </script>

    @endif

    @if (auth()->user()->getRoleNames()->first() == 'PUPUK Admin')
        <div class="container-fluid mt-3">
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
                            <h5 class="text-muted font-weight-normal mt-0" title="This Month">Total Revenue </h5>
                            <h3 class="mt-3 mb-3">RM {{ $totalRevenue }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Sales Statistic</h4>
                    <label for="filter">Filter:</label>
                    <select id="filter" onchange="updateChart()">
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                    <div id="chart_div" style="height: 300px;"></div>
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

                            <br>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead style="background: #F9FAFB;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kiosk Name</th>
                                        <th>Kiosk Tenant</th>
                                        <th>Total Sales</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($kiosk_participant as $kioskParticipant)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>FKK0{{ $kioskParticipant->kiosk_id }}</td>
                                            <td>{{ $kioskParticipant->user->name }}</td>
                                            <td>RM
                                                {{ $kioskParticipant->sales()->whereYear('created_at', now()->year)->sum('monthly_revenue') }}
                                            </td>
                                            @if ($kioskParticipant->kiosk->status == 'Inactive')
                                                <td>
                                                    <span class="badge badge-danger badge-pill">Inactive</span>
                                                </td>
                                            @elseif ($kioskParticipant->kiosk->status == 'Active')
                                                <td>
                                                    <span class="badge badge-success badge-pill">Active</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge badge-warning badge-pill">Warning</span>
                                                </td>
                                            @endif

                                            <!-- View Page-->
                                            <td>
                                                <a href="{{ route('sales.showPupuk', ['id' => $kioskParticipant->user_id]) }}"
                                                    class="action-icon-info">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                <!-- Edit Page-->
                                                <a href="javascript:void(0);" class="action-icon-success"
                                                    data-toggle="modal"
                                                    data-target="#bs-edit-modal-lg-{{ $kioskParticipant->id }}">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="bs-edit-modal-lg-{{ $kioskParticipant->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Update Remark
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('sales.updatePupuk', $kioskParticipant->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <p class="text-muted font-13 ">
                                                                Please update the details below.
                                                            </p>
                                                            <div
                                                                class="row justify-content-center align-items-center g-2">
                                                                {{-- <input type="hidden" name="kiosk_participant_id" value="{{ $kiosk_participant->id ?? '' }}"> --}}
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label for="kiosk-tenant">Kiosk Tenant</label>
                                                                        <input type="text" id="kiosk-tenant"
                                                                            class="form-control"
                                                                            value="{{ $kioskParticipant->user->name }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label for="kiosk-number">Kiosk Number</label>
                                                                        <input type="text" id="kiosk-number"
                                                                            name="kiosk-number" class="form-control"
                                                                            value="FKK0{{ $kioskParticipant->kiosk_id }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group mb-3">
                                                                        <label for="kiosk-number">Kiosk Name</label>
                                                                        <input type="text" id="kiosk-number"
                                                                            name="kiosk-number" class="form-control"
                                                                            value="{{ $kioskParticipant->kiosk->name }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-floating mb-2">
                                                                        <label for="floatingTextarea">Message</label>
                                                                        <textarea class="form-control" id="floatingTextarea" style="height: 100px;" name="comment">{{ $kioskParticipant->kiosk->comment }}</textarea>
                                                                    </div>
                                                                </div>

                                                            </div><!-- end row-->
                                                    </div><!-- /.modal-body -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    @endforeach

                                </tbody>
                            </table>


                        </div> <!-- end card-body-->

                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- Your Blade View -->

        <script>
            google.charts.load('current', {
                packages: ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawBasic);

            var monthlyData = {!! json_encode($monthlyData) !!};
            var yearlyData = {!! json_encode($yearlyData) !!};
            var currentFilter = 'monthly';

            function drawBasic() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Label');
                data.addColumn('number', 'Revenue');

                updateChartData(data);

                var options = {
                    title: currentFilter === 'monthly' ? 'Monthly Revenue' : 'Yearly Revenue',
                    chartArea: {
                        width: '50%'
                    },
                    hAxis: {
                        title: currentFilter === 'monthly' ? 'Month' : 'Year'
                    },
                    vAxis: {
                        title: 'Revenue'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            function updateChartData(data) {
                data.removeRows(0, data.getNumberOfRows());

                var dataSet = currentFilter === 'monthly' ? monthlyData : yearlyData;

                dataSet.forEach(function(item, index) {
                    data.addRow([getLabel(item.label, currentFilter), item.revenue]);
                });
            }

            function updateChart() {
                var filter = document.getElementById('filter').value;
                currentFilter = filter;
                drawBasic();
            }

            function getLabel(value, filter) {
                if (filter === 'monthly') {
                    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ];
                    return months[value - 1];
                } else if (filter === 'yearly') {
                    return value.toString();
                } else {
                    return value;
                }
            }
        </script>

    @endif



</x-app-layout>
