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
                        <div class="row g-2">
                            <div class="col-md-11 col-12">
                                <h4 class="header-title">Complaint #{{ $complaint->id }}</h4>
                                <p class="text-muted font-12">
                                    {{ $complaint->created_at->format('d-m-Y') }}
                                </p>
                            </div>
                            <div class="col-md-1 col-12">
                                @if ($complaint->status == 'Pending')
                                    <span class="noti-icon-badge bg-danger"></span>
                                    <h6 class="text-danger">{{ $complaint->status }}</h6>
                                @elseif($complaint->status == 'In Progress')
                                    <span class="noti-icon-badge bg-warning"></span>
                                    <h6 class="text-warning">{{ $complaint->status }}</h6>
                                @elseif($complaint->status == 'Completed')
                                    <span class="noti-icon-badge bg-success"></span>
                                    <h6 class="text-success">{{ $complaint->status }}</h6>
                                @else
                                    <span class="noti-icon-badge bg-secondary"></span>
                                    <h6 class="text-secondary">{{ $complaint->status }}</h6>
                                @endif
                            </div>
                        </div>
                        <h6>Kiosk Number</h6>
                        <p class="text-muted font-12 font-weight-bold">FKK{{ str_pad($complaint->kioskParticipant->kiosk_id, 2, '0', STR_PAD_LEFT) }}
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
                            <div class="col-lg-6">
                                <label for="example-week">Kiosk Tenant</label>
                                <p>{{ $complaint->user->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label for="example-week">Kiosk Complaint</label>
                                <p>Repair Kiosk</p>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="example-week">No. Telephone</label>
                                <p>{{ $complaint->user->mobile_no }}</p>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="example-week">Complaint Description</label>
                                <p>{{ $complaint->description }}</p>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div><!-- end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

</x-app-layout>
