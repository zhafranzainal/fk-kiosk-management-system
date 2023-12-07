@extends('layouts.base-admin')
@section('content')
    {{-- Profile Page --}}
    <div class="row"> <!-- start page title -->
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Profile 2</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile 2</h4>
            </div>
        </div>
    </div> <!-- end page title -->


    <div class="row align-items-stretch">
        <div class="col-xl-4 col-lg-3">
            <div class="card text-center">
                <div class="card-body">
                    <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                        alt="profile-image">
                    <h4 class="mb-0 mt-2">Dominic Keller</h4>
                    <p class="text-muted font-14">Founder</p>
                    <button type="button" class="btn btn-secondary btn-sm mb-2">Follow</button>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Input Types</h4>
                    <p class="text-muted font-14">Edit yout profile here!</p>
                    <form>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control" placeholder="Eg:Text">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row-->


    {{-- Table Page --}}
    <div class="row"> <!-- start page title -->
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Data Table </li>
                    </ol>
                </div>
                <h4 class="page-title">Data Table</h4>
            </div>
        </div>
    </div> <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <h4 class="header-title">Basic Data Table</h4>
                        <a href="" class="btn btn-secondary btn-sm" style="position: absolute; right:2%;">+ Add
                            User</a>
                    </div>
                    <br>

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead style="background: #F9FAFB;">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>
                                    <span class="badge badge-success badge-pill">Closed</span>
                                </td>
                                {{-- <td>
                                    <!-- View Page-->
                                    <a href="" class="btn btn-outline-success btn-sm "><i class="dripicons-document-edit"></i></a>
                                   <!-- View Page-->
                                    <a href="" class="btn btn-outline-info btn-sm"><i class="uil-eye"></i></a>
                                </td> --}}
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
                    </table>
                </div> <!-- end card-body-->

                <!-- View modal -->
                <div class="modal fade" id="bs-view-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">View modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Text</label>
                                                <input type="text" id="simpleinput" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Email</label>
                                                <input type="email" id="example-email" name="example-email"
                                                    class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-password">Password</label>
                                                <input type="password" id="example-password" class="form-control"
                                                    value="password">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="password">Show/Hide Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" class="form-control"
                                                        placeholder="Enter your password">
                                                    <div class="input-group-append" data-password="false">
                                                        <div class="input-group-text">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-palaceholder">Placeholder</label>
                                                <input type="text" id="example-palaceholder" class="form-control"
                                                    placeholder="placeholder">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-readonly">Readonly</label>
                                                <input type="text" id="example-readonly" class="form-control"
                                                    readonly="" value="Readonly value">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="example-textarea">Text area</label>
                                                <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div><!-- end row-->
                                </form>
                            </div><!-- /.modal-body -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="bs-edit-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Edit modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Text</label>
                                                <input type="text" id="simpleinput" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-email">Email</label>
                                                <input type="email" id="example-email" name="example-email"
                                                    class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-password">Password</label>
                                                <input type="password" id="example-password" class="form-control"
                                                    value="password">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="password">Show/Hide Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password" class="form-control"
                                                        placeholder="Enter your password">
                                                    <div class="input-group-append" data-password="false">
                                                        <div class="input-group-text">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-palaceholder">Placeholder</label>
                                                <input type="text" id="example-palaceholder" class="form-control"
                                                    placeholder="placeholder">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="example-readonly">Readonly</label>
                                                <input type="text" id="example-readonly" class="form-control"
                                                    readonly="" value="Readonly value">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="example-textarea">Text area</label>
                                                <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div><!-- end row-->
                                </form>
                            </div><!-- /.modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Delete modal -->
                <div class="modal fade" id="bs-danger-modal-sm" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="font-14" id="mySmallModalLabel">Delete Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to delete this data?</p>
                            </div><!-- /.modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">No,
                                    cancel</button>
                                <button type="button" class="btn btn-danger btn-sm">Yes, delete</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div> <!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->

    {{-- Form Page --}}
    <div class="row"> <!-- start page title -->
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Form Page </li>
                    </ol>
                </div>
                <h4 class="page-title">Form Page</h4>
            </div>
        </div>
    </div> <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Form Users</h4>
                    <p class="text-muted font-14">
                        Please fill in the form.
                    </p>
                    <form>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Text</label>
                                    <input type="text" id="simpleinput" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-email">Email</label>
                                    <input type="email" id="example-email" name="example-email" class="form-control"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-password">Password</label>
                                    <input type="password" id="example-password" class="form-control" value="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="password">Show/Hide Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-palaceholder">Placeholder</label>
                                    <input type="text" id="example-palaceholder" class="form-control"
                                        placeholder="placeholder">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-textarea">Text area</label>
                                    <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-readonly">Readonly</label>
                                    <input type="text" id="example-readonly" class="form-control" readonly=""
                                        value="Readonly value">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-disable">Disabled</label>
                                    <input type="text" class="form-control" id="example-disable" disabled=""
                                        value="Disabled value">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-static">Static control</label>
                                    <input type="text" readonly class="form-control-plaintext" id="example-static"
                                        value="email@example.com">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label for="example-helping">Helping text</label>
                                    <input type="text" id="example-helping" class="form-control"
                                        placeholder="Helping text">
                                    <span class="help-block"><small>A block of help text that breaks onto a new line and
                                            may extend beyond one line.</small></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-select">Input Select</label>
                                    <select class="form-control" id="example-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-multiselect">Multiple Select</label>
                                    <select id="example-multiselect" multiple class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-fileinput">Default file input</label>
                                    <input type="file" id="example-fileinput" class="form-control-file">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-date">Date</label>
                                    <input class="form-control" id="example-date" type="date" name="date">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-month">Month</label>
                                    <input class="form-control" id="example-month" type="month" name="month">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-time">Time</label>
                                    <input class="form-control" id="example-time" type="time" name="time">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-week">Week</label>
                                    <input class="form-control" id="example-week" type="week" name="week">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-number">Number</label>
                                    <input class="form-control" id="example-number" type="number" name="number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="example-color">Color</label>
                                    <input class="form-control" id="example-color" type="color" name="color"
                                        value="#727cf5">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label for="example-range">Range</label>
                                    <input class="custom-range" id="example-range" type="range" name="range"
                                        min="0" max="100">
                                </div>
                            </div>
                        </div><!-- end row-->
                        <div class="text-center mt-2">
                            <button type="button" onclick="history.back()" class="btn btn-light mr-3">Back</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div><!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->

    {{-- View Page --}}
    <div class="row"> <!-- start page title -->
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">View Page </li>
                    </ol>
                </div>
                <h4 class="page-title">View Page</h4>
            </div>
        </div>
    </div> <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-11 col-12">
                            <h4 class="header-title">Bill #8</h4>
                            <p class="text-muted font-12">
                                25 Oct - 24 Nov
                            </p>
                        </div>
                        <div class="col-md-1 col-12">
                            <span class="noti-icon-badge bg-danger"></span>
                            <h5 class="ml-1">Unpaid</h5>
                        </div>
                    </div>
                    <h6>Kiosk Name</h6>
                    <p class="text-muted font-12 font-weight-bold">Pak Mat Western</p>
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
                            <label for="example-week">Name</label>
                            <p>Bryan Tan</p>
                        </div>
                        <div class="col-lg-6">
                            <label for="example-week">Kiosk Number</label>
                            <p>FKK01</p>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="example-week">Name</label>
                            <p>Bryan Tan</p>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="example-week">Kiosk Number</label>
                            <p>FKK01</p>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label for="example-week">Name</label>
                            <p>Bryan Tan</p>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div><!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
