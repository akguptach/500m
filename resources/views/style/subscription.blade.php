@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Subscription List</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="subscription" class="table table-responsive table-bordered  row-border">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
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
        </section>
    </div>
</section>
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<script>
$(function() {
    $('#subscription').DataTable({
        dom: '<"top-toolbar"lf>rtip',
        "columns": [{
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "email"
            },
            {
                data: "created_at"
            },
            {
                render: function(data, type, row, meta) {
                    return '<button class="btn btn-danger delete-btn d-block mx-auto" data-id="' +
                        row.id + '">Delete</button>';
                }
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('subscription/list'); ?>"
    });

    $("div.top-toolbar").css({
        "display": "flex",
        "justify-content": "space-between"
    });
    $("div.top-toolbar").append(`@include('style.subcriptionExportForm')`);
    



    $('#subscription').on('click', '.delete-btn', function() {
        var SubscriptionDlt = $(this).data('id');
        $.ajax({
            url: "{{ route('subscriptionDelete') }}",
            type: 'POST',
            data: {
                id: SubscriptionDlt,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection