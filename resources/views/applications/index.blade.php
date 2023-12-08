@extends('layouts.base-kiosk')
@section('content')
    {{-- Table Page --}}

    <div class="card mt-3 mx-5">
        <div class="card-body">

            <div class="row">
                <h4 class="header-title">Sales List</h4>
                <a href="" class="btn btn-danger btn-sm" style="position: absolute; right:2%;">+ New Application</a>
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
                                <span class="badge badge-success badge-pill">{{ $application->status }}</span>
                            </td>
                            <td>{{ $application->kiosk->id }}</td>
                            <td>{{ optional($application->start_date)->format('d F Y') }} - {{ optional($application->end_date)->format('d F Y') }}</td>
                            <td>
                                <!-- View Page-->
                                <a href="javascript:void(0);" class="action-icon-info" data-toggle="modal"
                                    data-target="#bs-view-modal-lg"> <i class="mdi mdi-eye"></i></a>
                                <!-- Edit Page-->
                                <a href="javascript:void(0);" class="action-icon-success" data-toggle="modal"
                                    data-target="#bs-edit-modal-lg"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <!-- Delete Page-->
                                <a href="javascript:void(0);" class="action-icon-danger" data-toggle="modal"
                                    data-target="#bs-danger-modal-sm"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @empty
                        No application found
                    @endforelse
            </table>
        </div> <!-- end card-body-->
    </div>
@endsection
