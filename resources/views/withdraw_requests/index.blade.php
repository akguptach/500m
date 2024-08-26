@extends('layouts.app')
@section('content')
<style> 
.paginate_button  {
    padding : 8px!important;
}

#withdraw_request_table_filter{
    margin-left: 400px;
}
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif

            <div class="col-sm-12">
                <h4 class="m-0">Withdraw Requests</h4>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" id="success_message">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="table-responsive table-bordered">
                            <table id="withdraw_request_table" class="table table-responsive table-bordered table-bordered  row-border">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Student Name</th>
                                        <th>Wallet Balance</th>
                                        <th>Request Amount</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    var table = $('#withdraw_request_table').DataTable({
        dom: '<"top-toolbar"lf>rtip',
            initComplete: function() {
                this.api().columns([5]).every(function() {
                    var column = this;
                    var website_type = $('#status')
                        .on('change', function() {
                            var val = $(this).val();
                            column.search(val).draw();
                        });

                });
            },
        processing: true,
        serverSide: true,
        ajax: "{{ route('withdraw_request_view') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {
                data: 'student_name'
            },
            {
                data:'wallet_balance'
            },
            {
                data: 'amount'
            },
            {
                data: 'created_at'
            },
            {
                data: 'status'
            },
            {
                data: 'action'
            }
        ]

    });
    $("div.top-toolbar").css({
        "display": "flex",
        "justify-content": "space-between"
    });
    
    $("div.top-toolbar").append('<select id="status"><option value="">All</option><option value="COMPLETED">Completed</option><option value="PENDING">Pending</option><option value="DECLINED">Declined</option></select>');
});
</script>
@endsection