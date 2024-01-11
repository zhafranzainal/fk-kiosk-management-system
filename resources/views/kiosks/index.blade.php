<x-app-layout>
    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="row">
                        <h4 class="header-title" style="margin-left: 10px">Manage Kiosks</h4>
                        @can('create', App\Models\Kiosk::class)
                            <a href="{{ route('kiosks.create') }}" class="btn btn-danger btn-sm"
                                style="position: absolute; right:2%;">
                                + Add Kiosk
                            </a>
                        @endcan
                    </div>
                    <br>

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">

                        <thead style="background: #F9FAFB;">
                            <tr>
                                <th>No.</th>
                                <th>Kiosk Number</th>
                                <th>Kiosk Name</th>
                                <th>Kiosk Location</th>
                                <th>Business Type</th>
                                <th>Kiosk Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kiosks as $index => $kiosk)
                                <tr>

                                    <td>{{ $index + 1 }}</td>
                                    <td>FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $kiosk->name ?? '-' }}</td>
                                    <td>{{ $kiosk->location ?? '-' }}</td>
                                    <td>{{ optional($kiosk->businessType)->name ?? '-' }}</td>

                                    <td>

                                        @php
                                            $status = strtolower($kiosk->status ?? '-');
                                            $circleColor = '';

                                            switch ($status) {
                                                case 'inactive':
                                                    $circleColor = 'badge badge-secondary badge-pill';
                                                    $displayText = 'Unavailable';
                                                    break;
                                                case 'active':
                                                case 'warning':
                                                    $circleColor = 'badge badge-success badge-pill';
                                                    $displayText = 'Availabe';
                                                    break;
                                                case 'repair':
                                                    $circleColor = 'badge badge-danger badge-pill';
                                                    $displayText = 'Repair';
                                                    break;
                                                default:
                                                    $circleColor = 'badge badge-white badge-pill';
                                                    $displayText = '-';
                                                    break;
                                            }

                                        @endphp

                                        <div class="col-md-1 col-12">
                                            <span class="{{ $circleColor }}">{{ $displayText }}</span>
                                        </div>

                                    </td>

                                    <td>

                                        @can('update', $kiosk)
                                            <a href="javascript:void(0);" class="action-icon-success" data-toggle="modal"
                                                data-target="#bs-edit-modal-lg{{ $kiosk->id }}">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                        @endcan

                                        @can('view', $kiosk)
                                            <a href="javascript:void(0);" class="action-icon-info" data-toggle="modal"
                                                data-target="#bs-view-modal-lg{{ $kiosk->id }}">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @endcan

                                        @if ($kiosk->status != 'Inactive' && $kiosk->status != 'Repair')
                                            @can('delete', $kiosk)
                                                <a href="javascript:void(0);" class="action-icon-danger" data-toggle="modal"
                                                    data-target="#bs-danger-modal-sm{{ $kiosk->id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            @endcan
                                        @endif
                                    </td>

                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="bs-edit-modal-lg{{ $kiosk->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Update Kiosk</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('kiosks.update', $kiosk->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row justify-content-center align-items-center g-2">

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Number</label>
                                                                <input type="text" name="id"
                                                                    class="form-control"
                                                                    value="FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Status</label>
                                                                <input type="text" name="status"
                                                                    class="form-control" value="{{ $kiosk->status }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Name</label>
                                                                <input type="text" name="name"
                                                                    class="form-control" value="{{ $kiosk->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Business Type</label>
                                                                <select class="form-control" name="business_type_id">
                                                                    <option value="" disabled selected>Please
                                                                        Choose</option>

                                                                    @foreach ($businessTypes as $id => $name)
                                                                        <option
                                                                            @if ($kiosk->business_type_id == $id) selected @endif
                                                                            value="{{ $id }}">
                                                                            {{ $name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-3">
                                                                <label for="example-textarea">Kiosk Location</label>
                                                                <textarea class="form-control" name="location" rows="5">{{ $kiosk->location }}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Save changes</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- View modal -->
                                <div class="modal fade" id="bs-view-modal-lg{{ $kiosk->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">View Kiosk</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form>
                                                    <div class="row justify-content-center align-items-center g-2">

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Number</label>
                                                                <input type="text" name="id"
                                                                    class="form-control"
                                                                    value="FKF{{ $kiosk->id }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Status</label>
                                                                <input type="text" name="status"
                                                                    class="form-control" value="{{ $kiosk->status }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Kiosk Name</label>
                                                                <input type="text" name="name"
                                                                    class="form-control" value="{{ $kiosk->name }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Business Type</label>
                                                                <input type="text" name="business_type_id"
                                                                    class="form-control"
                                                                    value="{{ $kiosk->BusinessType->name }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-3">
                                                                <label for="example-textarea">Kiosk Location</label>
                                                                <textarea class="form-control" name="location" rows="5" readonly>{{ $kiosk->location }}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Delete modal -->
                                <div class="modal fade" id="bs-danger-modal-sm{{ $kiosk->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="font-14" id="mySmallModalLabel">Delete Data</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Are you sure want to delete this data?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm"
                                                    data-dismiss="modal">
                                                    No, cancel
                                                </button>
                                                <form method="POST" action="{{ route('kiosks.destroy', $kiosk->id) }}" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Yes, delete
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
