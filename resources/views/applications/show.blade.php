<x-app-layout>
    <br>
    <a href="{{ route('applications.index') }}" class="text-reset" style="margin-left: 20%"><i
            class="mdi mdi-arrow-left"></i>Back</a>
    {{-- Show Application Information Page --}}
    <div class="card mt-2" style="margin-left: 20%; margin-right: 20%">
        <div class="card-body px-4 py-3">
            <div class="row ">
                <div class="col-10">
                    <h2 style="font-size: 20px">Application #{{ $application->id }}</h2>
                </div>

                {{-- status section --}}
                <div class="d-flex align-items-center">
                    @switch($application->status)
                        @case('Approved')
                            <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path fill="#00ff40" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                        @break

                        @case('Rejected')
                            <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path fill="#ff0000" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                        @break

                        @default
                            <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path fill="#fb8728" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                    @endswitch

                    <span style="font-size: 18px; margin-left: 10px"><b>{{ $application->status }}</b></span>
                </div>

                {{-- dropdown menu --}}
                @if (auth()->user()->hasRole('Kiosk Participant'))
                    <div class="dropdown-container" tabindex="-1">
                        <button id="dropdownIcon"
                            style="font-size:22px; font-weight:bold; border:0; background:transparent; cursor: pointer; font-style:normal;">
                            &mldr;
                        </button>
                        <div class="dropdown" id="dropdownMenu" style="width: 202px">
                            <button type="button" class="btn" data-toggle="modal"
                            data-target="#edit-application-modal{{ $application->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path
                                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                </svg>
                                <span>Edit application info</span>
                            </button>
                            <button type="button" class="btn text-danger" data-toggle="modal"
                            data-target="#delete-application-modal{{ $application->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path fill="#ff0000"
                                        d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                </svg>
                                <span class="text-red mt-1">Delete application</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <p class="mb-3"><b>{{ optional($application->created_at)->format('d F Y, H:i') }}</b></p>

            <div class="row">
                <div class="col-4">
                    <label for="name">Applicant</label>
                    <p class="text-black">{{ $application->user->name }}</p>
                </div>

                <div class="col-1" style="border-left:1px solid #d6d6d6;height:50px"></div>

                <div class="col-4">
                    <label for="phone">Phone</label>
                    <p><b>{{ $application->user->mobile_no }}</b></p>
                </div>
            </div>
        </div>
    </div> <!-- end card-body-->

    {{-- Details information section --}}
    <div class="card mt-2" style="margin-left: 20%; margin-right: 20%; height:500px">
        <div class="card-body px-4 py-3">
            <h2 class="mb-4" style="font-size: 20px">Summary</h2>

            <div class="row mb-1">
                <div class="col">
                    <label for="name"><b>Name</b></label>
                    <p>{{ $application->user->name }}</p>
                </div>
                <div class="col">
                    <label for="kiosk"><b>Kiosk Number</b></label>
                    <p>FKK{{ str_pad($application->kiosk->id, 2, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            @if (
                (auth()->user()->hasRole('Kiosk Participant') &&
                    auth()->user()->kioskParticipant->student) ||
                    auth()->user()->hasRole('Admin'))
                <div class="row mb-1">
                    <div class="col">
                        <label for="course"><b>Course</b></label>
                        <p>
                            @if ($application->user->kioskParticipant->student)
                                {{ $application->user->kioskParticipant->student->course->name }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="col mb-1">
                        <label for="businessType"><b>Business Type</b></label>
                        <p>{{ $application->kiosk->businessType->name }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-1">
                        <label for="year/semester"><b>Year / Semester</b></label>
                        <p>
                            @if ($application->user->kioskParticipant->student)
                                {{ $application->user->kioskParticipant->student->year }} /
                                {{ $application->user->kioskParticipant->student->semester }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="col mb-1">
                        <label for="businessPeriod"><b>Business Period</b></label>
                        <p>
                            {{ optional($application->start_date)->format('d F Y') }} -
                            {{ optional($application->end_date)->format('d F Y') }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-1">
                        <label for="phone"><b>Contact Number</b></label>
                        <p>{{ $application->user->mobile_no }}</p>
                    </div>
                    <div class="col mb-1">
                        <label for="phone"><b>Comment</b></label>
                        <p>
                            @if ($application->reason == null)
                                No comment
                            @else
                                {{ $application->reason }}
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="row mb-1">
                    <div class="col">
                        <label for="phone"><b>Contact Number</b></label>
                        <p>{{ $application->user->mobile_no }}</p>
                    </div>
                    <div class="col mb-1">
                        <label for="businessType"><b>Business Type</b></label>
                        <p>{{ $application->kiosk->businessType->name }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-1">
                        <label for="phone"><b>Comment</b></label>
                        <p>
                            @if ($application->reason == null)
                                No comment
                            @endif{{ $application->reason }}
                        </p>
                    </div>
                    <div class="col mb-1">
                        <label for="businessPeriod"><b>Business Period</b></label>
                        <p>{{ optional($application->start_date)->format('d F Y') }} -
                            {{ optional($application->end_date)->format('d F Y') }}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- show these button only if role is Admin --}}
        @if (auth()->user()->getRoleNames()->first() == 'Admin')
            <hr>
            <div style="display: flex; justify-content:center; padding: 15px;">
                <form action="{{ route('applications.updateStatus', ['application' => $application->id]) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Approved">
                    <button type="submit"
                        style="background-color: limegreen; border:0; width:100px; height:30px; border-radius:5px; color:white; margin-right: 10px;">Approve</button>
                </form>
                <button type="button" data-toggle="modal"
                    data-target="#reject-application-modal{{ $application->id }}"
                    style="background-color: red; border:0; width:100px; height:30px; border-radius:5px; color:white;">Reject</button>
            </div>
        @endif

        @include('applications.update')

        <!-- Delete Application Modal -->
        <div class="modal fade" id="delete-application-modal{{ $application->id }}" tabindex="-1"
            role="dialog" aria-labelledby="editApplicationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Delete application</h4>
                    </div>
                    <div class="modal-body">
                        <form id="deleteApplication"
                            action="{{ route('applications.destroy', ['application' => $application->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="col justify-content-center align-items-center g-2">
                                <p>Are you sure you want to delete this application?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded-md"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger rounded-md">Yes,
                                    delete</button>
                            </div>
                        </form>
                    </div><!-- /.modal-body -->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Reject Application Modal -->
        <div class="modal fade" id="reject-application-modal{{ $application->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editApplicationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Attention!</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('applications.updateStatus', ['application' => $application->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col justify-content-center align-items-center g-2">
                                <p>Are you sure that you want to reject this application? Please provide your reason if
                                    you want to reject this application.</p>
                            </div>
                            <div class="col justify-content-center align-items-center g-2 mb-2">
                                <input type="hidden" name="status" value="Rejected">
                                <input type="text" class="form-control" name="reason" placeholder="Reason" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded-md"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger rounded-md">Reject Application</button>
                            </div>
                        </form>
                    </div><!-- /.modal-body -->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- end card-body-->
</x-app-layout>

<style>
    #dropdownMenu {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    #dropdownMenu.show {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownIcon = document.getElementById('dropdownIcon');
        var dropdownMenu = document.getElementById('dropdownMenu');

        dropdownIcon.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });

        // Close the dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('#dropdownIcon')) {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            }
        });
    });
</script>
