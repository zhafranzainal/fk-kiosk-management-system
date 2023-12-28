<x-app-layout>
    <br>
    <div class="mt-4 text-dark ml-2">
        <a href="{{ route('complaints.index') }}" class="mdi mdi-chevron-left text-dark"> Back to Complaint List</a>
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="">Update Complaint</h4>
                        <p class="text-muted font-13 mb-4">
                            Update your complaint here. We are ready to help!
                        </p>
                        <form role="form" method="POST" action={{ route('complaints.update', ['complaint' => $complaint['id']]) }}>
                            @csrf
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-tenant">Kiosk Tenant</label>
                                        <input type="text" value="{{ $complaint->User->name }}" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-number">Kiosk Number</label>
                                        <input type="text" value="FKK{{ $complaint->KioskParticipant->kiosk_id }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="kiosk-complaint">Kiosk Complaint</label>
                                        <input type="text" value="Repair Kiosk" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">No. Telephone</label>
                                        <input type="text" value="{{ $complaint->User->mobile_no }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <p class="text-muted font-13">
                                        Give your complaint a short and clear description.<br>
                                        120-160 characters is the recommended length.
                                    </p>
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="complaint-desc">Complaint Description</label>
                                        <textarea class="form-control" name="description" rows="5">{{ $complaint->description }}</textarea>
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
