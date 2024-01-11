<x-app-layout>
    <br>
    <div class="mt-4 text-dark ml-2">
        <a href="{{ route('sales.index') }}" class="mdi mdi-chevron-left text-dark"> Back to Sales List</a>
    </div>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="">Add Sales</h4>
                            <p class="text-muted font-13 mb-4">
                                Please fill the form below. 
                            </p>
                            <form role="form" method="POST" action={{ route('sales.store') }}
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kiosk_participant_id" value="{{ $kiosk_participant->id ?? '' }}">
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="kiosk-tenant">Kiosk Tenant</label>
                                            <input type="text" id="kiosk-tenant" class="form-control" value="{{$kiosk_participant->user->name}}" readonly >

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3"> 
                                            <label for="kiosk-number">Kiosk Number</label>
                                            <input type="text" id="kiosk-number" name="kiosk-number" class="form-control" value="FKK0{{ $kiosk_participant->kiosk_id }}" readonly >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="example-month">Month</label>
                                            <input class="form-control" id="example-month" type="month" name="month" value="{{ date('Y-m') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="example-month">Year</label>
                                            <input class="form-control" id="example-year" type="number" name="year" value="{{ date('Y') }}" min="{{ date('Y') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                            <p class="h6">Add Sales</p>
                                            <p class="text-muted font-13">
                                                Insert the sales.
                                            </p>
                                    </div> 
                                    <div class="col-lg-6"></div><br>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Total Sales</label>
                                            <div class="input-group">
                                                <input type="text" name="monthly_revenue" class="form-control" placeholder="Eg: RM XXXX" >
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Profit</label>
                                            <div class="input-group">
                                                <input type="text" name="profit" class="form-control" placeholder="Eg: RM XXXX" >
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost Modal</label>
                                            <div class="input-group">
                                                <input type="text" name="cost_of_goods_sold" class="form-control" placeholder="Eg: RM XXXX" >
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"></div>
                                </div><!-- end row-->
                                <div class="text-center mt-2">
                                    <button type="button" onclick="history.back()" class="btn btn-light mr-3">Back</button>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div><!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
    
        </div>
  
    
</x-app-layout>
