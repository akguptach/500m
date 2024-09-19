@extends('layouts.app')
@section('content')
<style>
.paginate_button {
    padding: 8px !important;
}
</style>

<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <style>
                        .nav-link.active {
                            background-color: #6a73fa !important;
                            color: #fff !important;
                        }

                        .nav-link {
                            border: 1px solid !important;
                        }
                        </style>
                        <div class="home-tab" style="margin-top:10px;margin-bottom:10px;">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <ul class="nav nav-tabs" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link {{ ( request()->is('contact/form-store/pending')) ? 'active' : '' }}"
                                            href="{{route('contact.form.store','pending')}}">Pending Enquiry</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ ( request()->is('contact/form-store/completed')) ? 'active' : '' }}"
                                            href="{{route('contact.form.store','completed')}}">Completed Enquiry</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enquery Form List</h3>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <table id="example1" class="table table-responsive table-bordered  row-border">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Service</th>
                                            <th>Write us</th>
                                            <th width="15%">Action</th>
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
$(function() {
    $('#example1').DataTable({
        "autoWidth": false,
        dom: '<"top-toolbar"lf>rtip',
        "columns": [{
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "name"
            },
            {
                data: "email"
            },
            {
                data: "mobile_number",
                render: function(data, type, row, meta) {
                    return '+' + row.mobile_number;
                }
            },

            {
                data: "service"
            },
            {
                data: "write_us"
            },
            {
                data: "action"
            }
        ],
        "processing": true,
        "serverSide": true,
        ajax: "{{url()->full()}}"
    });

    $("div.top-toolbar").css({
        "display": "flex",
        "justify-content": "space-between"
    });
    $("div.top-toolbar").append(`@include('style.csvExportForm',['type'=>$type])`);
    //$('.date-range').datepicker({
        //dateFormat: 'yy-mm-dd',
        /*onSelect: function() {
            if ($('#from').val() && $('#to').val()) {
                $("#exportBtn").removeAttr("disabled");
            } else {
                $("#exportBtn").attr("disabled");
            }
        },*/
   // });



});

//$(document).on("click", '.mylink', function(event) { 
// alert("new link clicked!");
//});
</script>
<script>
async function new_modal(event, msg) {
    event.preventDefault(); // Prevent form submission
    if (await confirm(msg)) {
        event.target.closest('form').submit(); // Submit the form if confirmed
    }
}

// Function to show Bootstrap modal as confirmation
function showBootstrapConfirm(msg, callback) {
    // Create modal markup
    var modalMarkup = `
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close btn border" style="padding: 1% 2%;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>${msg}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>
        `;
    var modalElement = $(modalMarkup).appendTo('body');
    $(modalElement).modal('show');
    $(modalElement).find('.btn-primary').click(function() {
        callback(true); // Call callback with true indicating confirmation
        $(modalElement).modal('hide'); // Hide modal
    });
    $(modalElement).find('.btn-secondary').click(function() {
        callback(false); // Call callback with false indicating cancellation
        $(modalElement).modal('hide'); // Hide modal
    });
    $(modalElement).on('hidden.bs.modal', function() {
        $(this).remove(); // Remove modal from DOM when closed
    });
}

window.confirm = function(msg) {
    return new Promise(function(resolve) {
        showBootstrapConfirm(msg, function(result) {
            resolve(result);
        });
    });
};
</script>
@endsection