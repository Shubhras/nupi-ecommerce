@extends('layouts.admin')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Partner Requests</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Partners</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of all partner requests</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="partners-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Brand Name</th>
                                        <th>Contact Person</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Business Type</th>
                                        <th>Role</th>
                                        <th>Branches</th>
                                        <th>Request Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(function () {
            $('#partners-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.partners.list') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'brand_name', name: 'brand_name' },
                    {
                        data: 'first_name',
                        name: 'first_name',
                        render: function (data, type, row) {
                            return row.first_name + ' ' + row.last_name;
                        }
                    },
                    { data: 'brand_email', name: 'brand_email' },
                    { data: 'mobile_number', name: 'mobile_number' },
                    { data: 'business_type', name: 'business_type' },
                    { data: 'role', name: 'role' },
                    { data: 'branches', name: 'branches' },
                    { data: 'created_at', name: 'created_at' },
                ],
                order: [[8, 'desc']] // Order by created_at desc
            });
        });
    </script>
@endsection