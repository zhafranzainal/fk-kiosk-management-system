<x-app-layout>
    <br>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if ($message = session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="text-black mb-0">{{ session()->get('success') }}</p>
                            </div>

                            <!-- Add the following JavaScript to auto-dismiss the alert after 3 seconds -->
                            <script>
                                setTimeout(function() {
                                    $('.alert').alert('close');
                                }, 3000); // 3000 milliseconds = 3 seconds
                            </script>
                        @endif
                        <div class="row mt-2">
                            <h4 class="mx-2 header-title">Kiosk Complaint</h4>
                            @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                                <a href="{{ route('complaints.create') }}" class="btn btn-danger btn-sm"
                                    style="position: absolute; right:2%;">+ Add
                                    Complaint</a>
                            @endif
                        </div>
                        <br>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead style="background: #F9FAFB;">
                                <tr>
                                    <th>No.</th>
                                    <th>Kiosk Number</th>
                                    <th>Complaint Description</th>
                                    <th>Complaint Date</th>
                                    @if (auth()->user()->getRoleNames()->first() == 'Technical Team')
                                        <th>Assigned To</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sort By function -->
                                @foreach ($complaints->sortBy(function ($complaint) {
        switch ($complaint->status) {
            case 'Pending':
                return 1;
            case 'In Progress':
                return 2;
            case 'Completed':
                return 3;
            default:
                return 4;
        }
    }) as $complaint)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>FKK{{ str_pad($complaint->kioskParticipant->kiosk_id, 2, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>{{ $complaint->description }}</td>
                                        <td>{{ $complaint->created_at->format('d-m-Y') }}</td>
                                        @if (auth()->user()->getRoleNames()->first() == 'Technical Team')
                                            <td>{{ $complaint->assign_to }}</td>
                                        @endif
                                        @if ($complaint->status == 'Pending')
                                            <td>
                                                <span class="badge badge-danger badge-pill">Pending</span>
                                            </td>
                                        @elseif($complaint->status == 'In Progress')
                                            <td>
                                                <span class="badge badge-warning badge-pill">In Progress</span>
                                            </td>
                                        @elseif($complaint->status == 'Completed')
                                            <td>
                                                <span class="badge badge-success badge-pill">Completed</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-secondary badge-pill">Closed</span>
                                            </td>
                                        @endif

                                        @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                                            <td>
                                                <!-- View Page-->
                                                <a href="{{ route('complaints.show', $complaint->id) }}"
                                                    class="action-icon-info"><i class="mdi mdi-eye"></i></a>
                                                @if ($complaint->status == 'Pending')
                                                    <!-- Edit Page-->
                                                    <a href="{{ route('complaints.edit', $complaint->id) }}"
                                                        class="action-icon-success"><i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    <!-- Delete -->
                                                    <a href="#" class="action-icon-danger" data-toggle="modal"
                                                        data-target="#bs-danger-modal-sm{{ $complaint->id }}"> <i
                                                            class="mdi mdi-delete"></i></a>
                                                @elseif($complaint->status == 'Completed')
                                                    <!-- Update Status Page-->
                                                    <a href="" class="action-icon-warning" data-toggle="modal"
                                                        data-target="#bs-update-modal-sm{{ $complaint->id }}"> <i
                                                            class="mdi mdi-check-circle"></i></a>
                                                @endif

                                            </td>
                                        @endif

                                        @if (auth()->user()->getRoleNames()->first() == 'Technical Team')
                                            <td>
                                                <!-- View Page-->
                                                <a href="" data-toggle="modal"
                                                    data-target="#bs-view-modal-lg{{ $complaint->id }}"
                                                    class="action-icon-info"> <i class="mdi mdi-eye"></i></a>
                                                @if ($complaint->status == 'Pending')
                                                    <!-- Assign TT-->
                                                    <a href="" class="action-icon-success" data-toggle="modal"
                                                        data-target="#bs-assign-modal-lg{{ $complaint->id }}"> <i
                                                            class="mdi mdi-account-plus-outline"></i></a>
                                                @elseif($complaint->status == 'In Progress')
                                                    <!-- Update Status-->
                                                    <a href="" class="action-icon-warning" data-toggle="modal"
                                                        data-target="#bs-status-modal-sm{{ $complaint->id }}"> <i
                                                            class="mdi mdi-check-circle-outline"></i></a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>

                                    <!-- Modal Section -->

                                    <!-- Update Status modal -->
                                    <div class="modal fade" id="bs-update-modal-sm{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="font-15" id="mySmallModalLabel">Update Status</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure want to update complaint status to closed?</p>
                                                    <a href="#" data-toggle="popover"
                                                        data-content="Please click the button to close the complaint"><small><i
                                                                class="mdi mdi-information"></i> Read Me</small></a>
                                                </div><!-- /.modal-body -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-sm"
                                                        data-dismiss="modal">No,
                                                        cancel</button>
                                                    <form method="POST"
                                                        action="{{ route('complaints.updateStatus', $complaint->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Yes,
                                                            sure</button>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Delete modal -->
                                    <div class="modal fade" id="bs-danger-modal-sm{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="font-14" id="mySmallModalLabel">Delete Data</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure want to delete this data?</p>
                                                </div><!-- /.modal-body -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-sm"
                                                        data-dismiss="modal">No,
                                                        cancel</button>
                                                    <form method="POST"
                                                        action="{{ route('complaints.destroy', $complaint->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Yes,
                                                            delete</button>
                                                    </form>

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- View modal -->
                                    <div class="modal fade" id="bs-view-modal-lg{{ $complaint->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Show Complaint</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Kiosk Tenant</label>
                                                                <input type="text" id="name"
                                                                    class="form-control"
                                                                    value="{{ $complaint->user->name }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Number</label>
                                                                <input type="text" id="simpleinput"
                                                                    class="form-control"
                                                                    value="FKK{{ $complaint->kioskParticipant->kiosk_id }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Complaint</label>
                                                                <input type="text" id="simpleinput"
                                                                    class="form-control" value="Repair Kiosk"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Complaint Date</label>
                                                                <input type="text" id="simpleinput"
                                                                    class="form-control"
                                                                    value="{{ $complaint->created_at->format('d-m-Y') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">No. Telephone</label>
                                                                <input type="text" id="simpleinput"
                                                                    class="form-control"
                                                                    value="{{ $complaint->user->mobile_no }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Assigned To</label>
                                                                <input type="text" id="simpleinput"
                                                                    class="form-control"
                                                                    value="{{ $complaint->assign_to }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-3">
                                                                <label for="example-textarea">Complaint
                                                                    Description</label>
                                                                <textarea class="form-control" id="example-textarea" rows="5" readonly>{{ $complaint->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row-->
                                                </div><!-- /.modal-body -->
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Update Status Modal -->
                                    <div class="modal fade" id="bs-status-modal-sm{{ $complaint->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="font-15" id="mySmallModalLabel">Update Status</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure want to update complaint status to completed?</p>
                                                </div><!-- /.modal-body -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-sm"
                                                        data-dismiss="modal">No,
                                                        cancel</button>
                                                    <form method="POST"
                                                        action="{{ route('complaints.updateStatus', $complaint->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-sm">Yes,
                                                            sure</button>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Assigned To Modal -->
                                    <div class="modal fade" id="bs-assign-modal-lg{{ $complaint->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Assign Technical
                                                        Team</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('complaints.assignTo', $complaint->id) }}">
                                                        @csrf
                                                        <div class="row justify-content-center align-items-center g-2">
                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="simpleinput">Kiosk Tenant</label>
                                                                    <input type="text" id="simpleinput"
                                                                        class="form-control"
                                                                        value="{{ $complaint->user->name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="simpleinput">Kiosk Number</label>
                                                                    <input type="text" id="simpleinput"
                                                                        class="form-control"
                                                                        value="FKK{{ $complaint->kioskParticipant->kiosk_id }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="example-textarea">Complaint
                                                                        Description</label>
                                                                    <textarea class="form-control" id="example-textarea" rows="5" readonly>{{ $complaint->description }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-group mb-3">
                                                                    <label for="simpleinput">Assign To</label>
                                                                    <input type="text" id="simpleinput"
                                                                        class="form-control" name="assign_to">
                                                                </div>
                                                            </div>
                                                        </div><!-- end row-->
                                                </div><!-- /.modal-body -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light mr-2"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Save
                                                        changes</button>
                                                </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- End Modal Section -->
                                @endforeach
                        </table>
                    </div> <!-- end card-body-->

                </div> <!-- end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

</x-app-layout>
