@extends('layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!--<div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>-->
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" id="success_message">
                            {{ session('status') }}
                        </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Student Name</th>
                                    <th>Website</th>
                                    <th>Subject</th>
                                    <!--<th>Task type</th>
										<th>Lebel of study</th>
										<th>Grade</th>
										<th>Referencing Style</th>-->
                                    <th>Number of words</th>
                                    <th>Amount</th>
                                    <th>Currency Code</th>
                                    <th>Delivery Date</th>

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
</section>

<div class="modal fade" id="modal-assign-teacher">
    <div class="modal-dialog">
        <div class="modal-content" id="teachers-modal-body">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


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
<style>
.toolbar {
    float: right;
    margin-left: 10px;
}
</style>
<script>
$(document).on("click", '.assign-teacher', function(event) {
    var dataModelBody = $('#' + $(this).attr('data-model-body'));
    $('#' + $(this).attr('data-modal-id')).modal('show');
    dataModelBody.html('<div class="loader"></div>');
    $.ajax({
        type: "GET",
        url: $(this).attr('data-ajax-url'),
        success: function(data) {
            dataModelBody.html(data);
        },
        error: function() {
            dataModelBody.html('');
        }
    });
});
$(document).on("submit", '#assign-qc-form', function(e) {

    $('.text-danger').html('');
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');
    var formData = form.serialize();
    $('#loadingoverlay').show();
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: formData, // serializes the form's elements.
        success: function(data) {
            $('#loadingoverlay').hide();
            $('#modal-assign-teacher').modal('hide');
            alert(data);
            location.reload();
            //$('#teachers-modal-body').html('<div class="alert alert-success" role="alert">' + data + '</div>');
            //
        },
        error: function(e) {
            $('#loadingoverlay').hide();
            const eResponse = e.responseJSON
            $('#delivery_date_error').html((eResponse.errors && eResponse.errors.delivery_date) ?
                eResponse.errors.delivery_date[0] : '');
            $('#teacher_id_error').html((eResponse.errors && eResponse.errors.teacher_id) ?
                eResponse.errors.teacher_id[0] : '');
            console.log(e.responseJSON)
        }
    });
});



$(function() {
    $('#example1').DataTable({
        dom: '<"toolbar">frtip',
        initComplete: function() {
            this.api().columns([2]).every(function() {
                var column = this;
                var website_type = $('#website_type')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });
                /*website_type.append('<option value="">All Websites</option>')
                column.data().unique().sort().each(function(d, j) {
                    if (d != '' && d != 0)
                        website_type.append('<option value="' + d + '">' + d +
                            '</option>')
                });*/
            });
        },
        "columns": [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                data: "first_name"
            },
            {
                data: "website_type"
            },
            {
                data: "subject_name"
            },
            //{ data: "type_name" },
            //{ data: "level_name" },
            //{ data: "grade_name" },
            //{ data: "style" },
            {
                data: "no_of_words"
            },
            {
                data: "price"
            },
            {
                data: "currency_code"
            },
            {
                data: "delivery_date"
            },
            {
                data: "action"
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('orders');; ?>"
    });
    document.querySelector('div.toolbar').innerHTML =
        '<?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>';
});
</script>
@endsection