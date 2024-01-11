<x-app-layout>
    <br>
    <div class="mt-4 text-dark ml-2">
        <a href="{{ route('kiosks.index') }}" class="mdi mdi-chevron-left text-dark"> Back to Kiosk List</a>
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="">Add Kiosk</h4>
                        <p class="text-muted font-13 mb-4">
                            Please fill in the form below
                        </p>
                        <form method="POST" action="{{ route('kiosks.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kiosk_participant_id">
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-name">Kiosk Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-number">Business Type</label>
                                        <select class="form-control" name="business_type_id">
                                            <option value="">-Please Select</option>
                                            @foreach ($businessTypes as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-number">Kiosk Status</label>
                                        <select class="form-control" name="status">
                                            <option disabled selected>Please Select</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Active">Active</option>
                                            <option value="Warning">Warning</option>
                                           <!-- <option value="Repair">Repair</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="location">Location</label>
                                        <textarea class="form-control" name="location" rows="5"></textarea>
                                    </div>
                                </div>
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
