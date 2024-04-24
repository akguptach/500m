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
                                <h3 class="card-title">Levels</h3>
                                <div class="float-right">
                                    <a href="{{ route('level_study.create') }}">
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
                                            <th>Level Name</th>
                                            <th>Additional Percentage Price</th>
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
                data: "level_name"
            },
            {
                data: "price"
            },
            {
                data: "action"
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo URL::to('level_study');; ?>"
    });
    document.querySelector('div.toolbar').innerHTML =
        '<?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>';
});

function delete_level(msg, id) {
    if (confirm(msg)) {
        var form = $('#level_form_' + id);
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