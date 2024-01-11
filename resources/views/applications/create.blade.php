<x-app-layout>
    <br>
    <a href="{{ route('applications.index') }}" class="ml-5 text-reset"><i class="mdi mdi-arrow-left"></i>Back</a>
    {{-- Create Application Form Page --}}
    <div class="card mt-2 mx-5">
        <div class="card-body px-5 py-4">

            <div>
                <h2 class="header-title mb-4" style="font-size: 20px">New Application</h2>
                <h5 class="form-title mb-3">General</h5>
            </div>
            <form action="{{ route('applications.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="form-group col mb-3">
                        <label for="kioskParticipantName">Name</label>
                        <input type="text" class="form-control" name="kioskParticipantName" id="kioskParticipantName"
                            placeholder="Name" value="{{ $user->name }}" required readonly>
                    </div>
                    <div class="form-group col mb-3">
                        <label for="kioskNumber">Kiosk Number</label>
                        <select class="form-select" style="width: -webkit-fill-available; padding: .45rem .9rem;"
                            name="kioskNumber" id="kioskNumber" required>
                            <option value="">Select Kiosk</option>
                            @foreach ($kiosks as $kiosk)
                                @if ($kiosk->status != 'Inactive')
                                    <option data-business-type-id="{{ $kiosk->business_type_id }}"
                                        value="{{ $kiosk->id }}" disabled>FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @else
                                    <option data-business-type-id="{{ $kiosk->business_type_id }}"
                                        value="{{ $kiosk->id }}">FKK{{ str_pad($kiosk->id, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (auth()->user()->kioskParticipant && auth()->user()->kioskParticipant->student)
                    <div class="row">
                        <div class="form-group col mb-3">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course"
                                placeholder="Course" value="{{ $user->kioskParticipant->student->course->name }}"
                                required readonly>
                        </div>
                        <div class="form-group col mb-3">
                            <label for="businessPeriod">Business Period</label>
                            <div class=" input-group">
                                <input type="date" class="form-control" name="start_date" required>
                                <span class="input-group-text">To</span>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3 mb-3">
                            <label for="year">Year</label>
                            <input type="number" class="form-control" name="year" id="year" placeholder="Year"
                                value="{{ $user->kioskParticipant->student->year }}" required autofocus>
                        </div>
                        <div class="form-group col-3 mb-3">
                            <label for="semester">Semester</label>
                            <input type="number" class="form-control" name="semester" id="semester"
                                placeholder="Semester" value="{{ $user->kioskParticipant->student->semester }}"
                                required autofocus>
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="businessType">Business Type</label>
                            <select class="form-select" style="width: -webkit-fill-available; padding: .45rem .9rem;"
                                name="businessType" id="businessType" required>
                                <option value="">Select Business Type</option>
                                @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}">{{ $business->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 mb-3">
                            <label for="contact_num">Contact Number</label>
                            <input type="tel" class="form-control" name="contact_num" id="contact_num"
                                placeholder="Contact Number" value="{{ $user->mobile_no }}" required autofocus>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="form-group col mb-3">
                            <label for="contact_num">Contact Number</label>
                            <input type="tel" class="form-control" name="contact_num" id="contact_num"
                                placeholder="Contact Number" value="{{ $user->mobile_no }}" required autofocus>
                        </div>
                        <div class="form-group col mb-3">
                            <label for="businessPeriod">Business Period</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="start_date" placeholder="Start date"
                                    required>
                                <span class="input-group-text">To</span>
                                <input type="date" class="form-control" name="end_date" placeholder="End date"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            {{-- empty div to make the div below float-right --}}
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="businessType">Business Type</label>
                            <select class="form-select" style="width: -webkit-fill-available; padding: .45rem .9rem;"
                                name="businessType" id="businessType" required>
                                <option value="">Select Business Type</option>
                                @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}">{{ $business->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                {{-- Button --}}
                <div>
                    <button type="button" onclick="window.location.href='{{ route('applications.index') }}'"
                        class="border-0 rounded-lg mr-5" style="width: 100px; height: 38px">Cancel</button>
                    <button type="submit" class="border-0 rounded-lg text-white"
                        style="width: 100px; height: 38px; background-color: #CA3433;">Apply</button>
                </div>
            </form>
        </div>
    </div> <!-- end card-body-->
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#kioskNumber').change(function() {
            var businessId = $(this).find(':selected').data('business-type-id');
            $('#businessType').val(businessId);
        });
    });
</script>
