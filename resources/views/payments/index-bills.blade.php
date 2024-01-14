<x-app-layout>
    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="row">
                        <h4 class="header-title" style="margin-left: 10px">Bills List</h4>

                        <form action="{{ route('payments.generate-bill') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                Generate Bill
                            </button>
                        </form>

                        <a href="{{ route('payments.index-transaction') }}" class="btn btn-danger btn-sm"
                            style="position: absolute; right:2%;">
                            Transaction History
                        </a>
                    </div>
                    <br>

                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">

                        <thead style="background: #F9FAFB;">
                            <tr>
                                <th>No.</th>
                                <th>Bill Name</th>
                                <th>Bill Code</th>
                                <th>Kiosk Number</th>
                                <th>Status</th>
                                <th>Billing Period</th>
                                <th>Amount (RM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($billData as $bill)
                                <tr>

                                    <td>1</td>
                                    <td>{{ $bill['billName'] }}</td>
                                    <td>{{ $bill['billCode'] }}</td>
                                    <td>FKK{{ str_pad($bill['kioskNumber'], 2, '0', STR_PAD_LEFT) }}
                                    <td>{{ $bill['convertedBillStatus'] }}</td>
                                    <td>25 Sep - 24 Oct</td>
                                    <td>{{ $bill['billpaymentAmount'] }}</td>

                                    <td>

                                        <a href="https://dev.toyyibpay.com/{{ $bill['billCode'] }}"
                                            class="action-icon-danger">
                                            <i class="mdi mdi-cash-plus"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="action-icon-info" data-toggle="modal"
                                            data-target="#bs-view-modal-lg">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="bs-edit-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Edit modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
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

                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger">Save changes</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- View modal -->
                <div class="modal fade" id="bs-view-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">View modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
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

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Delete modal -->
                <div class="modal fade" id="bs-danger-modal-sm" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="font-14" id="mySmallModalLabel">Delete Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>Are you sure want to delete this data?</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
                                    No, cancel
                                </button>
                                <button type="button" class="btn btn-danger btn-sm">
                                    Yes, delete
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
