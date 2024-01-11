<x-app-layout>
    <br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"></script>

    <div class="mt-4 text-dark ml-2">
        <a href="{{ route('sales.index') }}" class="mdi mdi-chevron-left text-dark"> Back to Sales List</a>
    </div>
    @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-11 col-12">
                                    <h4 class="header-title">Bill #{{ $sale->id }}</h4>
                                    <p class="text-muted font-12">
                                        {{ $sale->created_at->format('d F Y') }}
                                    </p>
                                </div>
                                <div class="col-md-1 col-12">
                                    @if ($sale->kioskParticipant->kiosk->status == 'Active')
                                        <span class="noti-icon-badge bg-success"></span>
                                        <h5 class="ml-1">{{ $sale->kioskParticipant->kiosk->status }}</h5>
                                    @else
                                        <span class="noti-icon-badge bg-danger"></span>
                                        <h5 class="ml-1">{{ $sale->kioskParticipant->kiosk->status }}</h5>
                                    @endif
                                </div>
                            </div>
                            <h6>Kiosk Name</h6>
                            <p class="text-muted font-12 font-weight-bold">{{ $sale->kioskParticipant->kiosk->name }}
                            </p>
                        </div> <!-- end card-body-->
                    </div><!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Summary</h4>
                            <div class="row justify-content-center align-items-center g-2 mt-4">
                                <div class="col-lg-6 ">
                                    <label for="example-week">Name</label>
                                    <p>{{ $sale->kioskParticipant->user->name }}</p>
                                </div>
                                <div class="col-lg-6">
                                    <label for="example-week">Kiosk Number</label>
                                    <p>FKK0{{ $sale->kioskParticipant->kiosk_id }} </p>
                                </div>
                            </div><br><br>
                            <h4 class="header-title">Sales Summary</h4>
                            <div class="row justify-content-center align-items-center g-2 mt-4">
                                <div class="col-lg-4">
                                    <label for="example-week">Total Sales</label>
                                    <p>RM{{ $sale->monthly_revenue }}</p>
                                </div>
                                <div class="col-lg-4">
                                    <label for="example-week">Profit</label>
                                    <p>RM{{ $sale->profit }}</p>
                                </div>
                                <div class="col-lg-4">
                                    <label for="example-week">Cost Modal</label>
                                    <p>RM {{ $sale->cost_of_goods_sold }} </p>
                                </div>

                            </div><br><br>
                            <h4 class="header-title">Admin Summary</h4>
                            <div class="row justify-content-center align-items-center g-2 mt-4">
                                <div class="col-lg-12">
                                    <label for="example-week">Comment</label>
                                    <p>{{ $sale->kioskParticipant->kiosk->comment }} </p>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div><!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    @endif

    @if (auth()->user()->getRoleNames()->first() == 'PUPUK Admin')
        <div class="container-fluid mt-2">
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
                            <div class="row g-2">
                                <div class="col-md-11 col-12">
                                    <input type="hidden" name="user_id" value="{{ $kioskParticipant->user->id }}">
                                    <h4 class="header-title">KIOSK {{ $kioskParticipant->kiosk->name }}</h4>
                                    {{-- <p class="text-muted font-12">
                                    {{ $sale->created_at->format('d F Y') }}
                                </p> --}}
                                </div>
                                <div class="col-md-1 col-12">
                                    @if ($kioskParticipant->kiosk->status == 'Active')
                                        <span class="noti-icon-badge bg-success"></span>
                                        <h5 class="ml-1">{{ $kioskParticipant->kiosk->status }}</h5>
                                    @else
                                        <span class="noti-icon-badge bg-danger"></span>
                                        <h5 class="ml-1">{{ $kioskParticipant->kiosk->status }}</h5>
                                    @endif
                                </div>
                                <div class="col-lg-5 ">
                                    <label for="example-week">Total Revenue</label>
                                    <p>RM {{ $totalRevenue }}</p>
                                    <p></p>
                                </div>
                                <div class="col-lg-2 ">
                                    <p class="text-muted font-12 font-weight-bold">|</p>
                                    <p class="text-muted font-12 font-weight-bold">|</p>
                                </div>

                                <div class="col-lg-5">
                                    <label for="example-week">Total Profit</label>
                                    <p>RM {{ $totalProfit }} </p>
                                </div>
                            </div>
                            {{-- <h6>Kiosk Name</h6>
                        <p class="text-muted font-12 font-weight-bold">{{ $kioskParticipant->kiosk->name }}</p> --}}
                        </div> <!-- end card-body-->
                    </div><!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Summary</h4>
                            <div class="row justify-content-center align-items-center g-2 mt-4">
                                <div class="col-lg-4 ">
                                    <label for="example-week">Name</label>
                                    <p>{{ $kioskParticipant->user->name }}</p>
                                </div>
                                <div class="col-lg-4">
                                    <label for="example-week">Kiosk Number</label>
                                    <p>FKK0{{ $kioskParticipant->kiosk_id }} </p>
                                </div>
                                <div class="col-lg-4">
                                    <label for="example-week">Business Type</label>
                                    <p>{{ $kioskParticipant->kiosk->businessType->name }} </p>
                                </div>
                            </div>
                            <br><br>
                            {{-- <h4 class="header-title">Sales Summary</h4>
                        <div class="row justify-content-center align-items-center g-2 mt-4">
                            <div class="col-lg-4">
                                <label for="example-week">Total Sales</label>
                                <p>RM{{ $kioskParticipant->sale->monthly_revenue}}</p>
                            </div>
                            <div class="col-lg-4">
                                <label for="example-week">Profit</label>
                                <p>RM{{ $sale->profit}}</p>
                            </div>
                            <div class="col-lg-4">
                                <label for="example-week">Cost Modal</label>
                                <p>RM {{ $sale->cost_of_goods_sold }} </p>
                            </div>
                           
                        </div><br><br> --}}
                            <h4 class="header-title">Admin Summary</h4>
                            <div class="row justify-content-center align-items-center g-2 mt-4">
                                <div class="col-lg-12">
                                    <label for="example-week">Comment</label>
                                    <p>{{ $kioskParticipant->kiosk->comment }} </p>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div><!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <script>
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                // Replace this data with your dynamic data from the server
                var dynamicData = {!! json_encode($monthlyData) !!};

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Revenue');

                dynamicData.forEach(function(item) {
                    data.addRow([getMonthName(item.label), item.revenue]);
                });

                var options = {
                    title: 'Monthly Revenue',
                    hAxis: {
                        title: 'Month',
                        titleTextStyle: {
                            color: '#333'
                        }
                    },
                    vAxis: {
                        minValue: 0
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
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
</x-app-layout>
