<!-- Edit Application Modal -->
<div class="modal fade" id="edit-application-modal{{ $application->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Application</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="editApplication"
                    action="{{ route('applications.update', ['application' => $application->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col justify-content-center align-items-center g-2">
                        <p>General info</p>

                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $application->user->name }}" readonly>
                        </div>

                        @if (auth()->user()->hasRole('Kiosk Participant') && auth()->user()->kioskParticipant->student)
                            <div class="form-group mb-3">
                                <label for="course">Course</label>
                                <input type="text" name="course" class="form-control" placeholder="Course"
                                    value="{{ $application->user->kioskParticipant->student->course->name }}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group mb-3">
                                    <label for="year">Year</label>
                                    <input type="numeric" name="year" class="form-control" placeholder="Year"
                                        value="{{ $application->user->kioskParticipant->student->year }}" readonly>
                                </div>
                                <div class="col-6 form-group mb-3">
                                    <label for="semester">Semester</label>
                                    <input type="numeric" name="semester" class="form-control" placeholder="Semester"
                                        value="{{ $application->user->kioskParticipant->student->semester }}" readonly>
                                </div>
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="kioskNumber">Kiosk Number</label>
                            <select class="form-select rounded-sm kioskNumber"
                                style="width: -webkit-fill-available; padding: .45rem .9rem;" name="kioskNumber"
                                value="{{ $application->kiosk->id }}" required>
                                <option value="">Select Kiosk</option>
                                @foreach ($kiosks as $kiosk)
                                    @if ($kiosk->status != 'Inactive')
                                        <option data-business-type-id="{{ $kiosk->business_type_id }}"
                                            value="{{ $kiosk->id }}" disabled @if ($kiosk->id == $application->kiosk_id) selected @endif>
                                            FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @else
                                        <option data-business-type-id="{{ $kiosk->business_type_id }}"
                                            value="{{ $kiosk->id }}" @if ($kiosk->id == $application->kiosk_id) selected @endif>
                                            FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="businessPeriod">Business Period</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ optional($application->start_date)->format('Y-m-d') }}" required>
                                <span class="input-group-text">To</span>
                                <input type="date" class="form-control" name="end_date"
                                    value="{{ optional($application->end_date)->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="businessType">Business Type</label>
                            <select class="form-select rounded-sm businessType"
                                style="width: -webkit-fill-available; padding: .45rem .9rem;" name="businessType"
                                required>
                                <option value="">Select Business Type</option>
                                @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}"
                                        @if ($business->id == $application->kiosk->business_type_id) selected @endif>
                                        {{ $business->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact_num">Contact Number</label>
                            <input type="tel" class="form-control" name="contact_num" placeholder="Contact Number"
                                value="{{ $application->user->mobile_no }}" required autofocus>
                        </div>

                    </div><!-- end row-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
