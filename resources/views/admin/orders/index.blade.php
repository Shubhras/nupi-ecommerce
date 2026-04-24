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
                    <h1 class="m-0 text-dark">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                            <h3 class="card-title">List of all orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="orders-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
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

    <!-- Update Payment Status Modal -->
    <div class="modal fade" id="updatePaymentModal" tabindex="-1" aria-labelledby="updatePaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePaymentModalLabel">Update Payment Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updatePaymentForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="payment_order_id">
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="cod">COD</option>
                                <option value="card">Card</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_status">Payment Status</label>
                            <select class="form-control" id="payment_status" name="payment_status" required>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="admin_message">Message / Note</label>
                            <textarea class="form-control" id="admin_message" name="admin_message" rows="3" placeholder="Add some message..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="savePaymentUpdateBtn">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(function () {
            $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.orders.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'id', name: 'id' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'total', name: 'total' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'status', name: 'payment_status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[8, 'desc']] // Order by created_at desc (which is index 8)
            });

            // Delete order functionality
            $(document).on('click', '.delete-order', function() {
                var orderId = $(this).data('id');
                
                if(confirm('Are you sure you want to delete this order?')) {
                    $.ajax({
                        url: '/admin/orders/' + orderId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.success) {
                                alert(response.message);
                                $('#orders-table').DataTable().ajax.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error deleting order.');
                        }
                    });
                }
            });

            // Open Update Payment Status Modal
            $(document).on('click', '.update-payment', function() {
                var orderId = $(this).data('id');
                var currentMethod = $(this).data('method');
                var currentStatus = $(this).data('status');
                
                $('#payment_order_id').val(orderId);
                $('#payment_method').val(currentMethod);
                $('#payment_status').val(currentStatus);
                $('#admin_message').val('');
                $('#updatePaymentModal').modal('show');
            });

            // Submit Update Payment Form
            $('#updatePaymentForm').on('submit', function(e) {
                e.preventDefault();
                var orderId = $('#payment_order_id').val();
                var formData = $(this).serialize();
                var submitBtn = $('#savePaymentUpdateBtn');

                submitBtn.prop('disabled', true).text('Updating...');

                $.ajax({
                    url: '/admin/orders/' + orderId + '/update-payment',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.success) {
                            alert(response.message);
                            $('#updatePaymentModal').modal('hide');
                            $('#orders-table').DataTable().ajax.reload(null, false);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error updating payment status.');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Update Status');
                    }
                });
            });
        });
    </script>
@endsection