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
                                <h3 class="card-title">FAQ</h3>
                                <div class="float-right">
                                    <a href="{{ route('faq.create') }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add
                                    </a>
                                </div>
                            </div>
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
                                            <th>Website Type</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Actions</th>
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
<style>
.toolbar {
    float: right;
    margin-left: 10px;
}
</style>
<script>
$(function() {
    $('#example1').DataTable({
        dom: '<"toolbar">frtip',
        initComplete: function() {
            this.api().columns([1]).every(function() {
                var column = this;
                var website_type = $('#website_type')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });
                website_type.append('<option value="">All Websites</option>')
                column.data().unique().sort().each(function(d, j) {
                    console.log('-', j)
                    if (d != '' && d != 0)
                        website_type.append('<option value="' + d + '">' + d +
                            '</option>')
                });
            });
        },
        "columns": [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "website_type"
            },
            {
                data: "question"
            },
            {
                data: "answer"
            },
            {
                data: "action"
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('faq');; ?>"
    });
    document.querySelector('div.toolbar').innerHTML =
        '<select id="website_type" style="padding: 4px;width: 130px;" name="website_type"></select>';
});

function delete_faq(msg, id) {
    if (confirm(msg)) {
        var form = $('#faq_form_' + id);
        var token = $('#csrf_' + id).val();
        // Create a hidden input field to send the CSRF token
        var csrfInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_token')
            .val(token);
        // Create a hidden input field to send the DELETE method
        var methodInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_method')
            .val('DELETE');
        // Append the hidden input fields to the form
        form.append(csrfInput, methodInput);
        // Submit the form
        form.submit();
    }
}
</script>
@endsection