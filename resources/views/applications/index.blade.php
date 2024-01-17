<x-app-layout>
    <br>
    @if (session('success'))
        <div class="position-fixed top-20 end-0 p-3" style="z-index: 100">
            <div class="toast align-items-center bg-green-100 border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="mdi mdi-check-circle"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto border-0" data-dismiss="toast"
                        aria-label="Close">&#9747;</button>
                </div>
            </div>
        </div>
    @elseif (session('error'))
        <div class="position-fixed top-20 end-0 p-3" style="z-index: 100">
            <div class="toast align-items-center bg-red-100 border-0" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="mdi mdi-alert-decagram" style="font-size: 15px"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto border-0" data-dismiss="toast"
                        aria-label="Close">&#9747;</button>
                </div>
            </div>
        </div>
    @endif
    {{-- Table Page --}}
    <div class="card mt-3 mx-5">
        <div class="card-body">

            <div class="row">
                <h4 class="header-title">Application List</h4>
                @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                    <a href="{{ route('applications.create') }}" class="btn btn-danger btn-sm"
                        style="position: absolute; right:2%;">+ New Application</a>
                @endif
            </div>
            <br>

            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead style="background: #F9FAFB;">
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Business Types</th>
                        <th>Status</th>
                        <th>Kiosk Number</th>
                        <th>Business Period</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                    @forelse ($applications as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ optional($application->created_at)->format('d F Y  H:i') }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->kiosk->businessType->name }}</td>
                            <td>
                                @switch($application->status)
                                    @case('Approved')
                                        <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                            <path fill="#00ff40" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                        </svg>
                                    @break

                                    @case('Rejected')
                                        <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                            <path fill="#ff0000" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                        </svg>
                                    @break

                                    @default
                                        <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                            <path fill="#FFA500" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                                        </svg>
                                @endswitch
                                <span>{{ $application->status }}</span>
                            </td>
                            <td>FKK{{ str_pad($application->kiosk->id, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ optional($application->start_date)->format('d F Y') }} -
                                {{ optional($application->end_date)->format('d F Y') }}</td>
                            <td>
                                @if (auth()->user()->hasRole('Kiosk Participant'))
                                    <!-- View Page-->
                                    <a href="{{ route('applications.show', ['application' => $application->id]) }}"
                                        class="action-icon-info"> <i class="mdi mdi-eye"></i></a>
                                    <!-- Edit Page-->
                                    <a href="#" class="action-icon-success edit-btn" data-toggle="modal"
                                        data-target="#edit-application-modal{{ $application->id }}">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    <!-- Delete Page-->
                                    <a href="javascript:void(0);" class="action-icon-danger" data-toggle="modal"
                                        data-target="#delete-application-modal{{ $application->id }}">
                                        <i class="mdi mdi-delete"></i></a>
                                @else
                                    <!-- View Page-->
                                    <a href="{{ route('applications.show', ['application' => $application->id]) }}"
                                        class="action-icon-info"> <i class="mdi mdi-eye"></i></a>
                                @endif
                            </td>
                        </tr>

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

                        @if (auth()->user()->getRoleNames()->first() == 'Kiosk Participant')
                            @include('applications.update')
                        @endif

                        @empty
                            No application found
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end card-body-->
        </div>
    </x-app-layout>
    <script>
        $(document).ready(function() {
            $('.kioskNumber').on('change', function() {
                var businessTypeId = $(this).find(':selected').data('business-type-id');
                if ($('#edit-application-modal{{ $application->id ?? 'null' }}').is(':visible')) { // check if edit modal is open
                    $('.businessType').val(businessTypeId); // update business type in modal
                } else {
                    $(this).closest('tr').find('.businessType').val(businessTypeId); // update business type in row
                }
            });
        });

        $(document).ready(function() {
            $('.toast').toast({
                delay: 6000
            }).toast('show');
        });
    </script>
