@extends('layouts.app')
@section('content')
<style>
    .paginate_button  {
    padding : 8px!important;
}
    p.small {
        font-size: 16px;
        margin-left: 24px;
        color: black !important;
    }

    div:has(> ul.pagination) {
        float: right;
        margin-right: 20px;
    }
    

    #student_table td{
        overflow-wrap: anywhere;
    }
    
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student</h3>
                    <?php /*<div class="float-right">
                        <?php HtmlHelper::WebsiteTypeDropdown('website_type', $website, false, 'width:150px;', 'website_type') ?>
                    </div>*/?>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" id="success_message">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive"> 
                        <table id="student_table" class="table table-responsive table-bordered row-border">
                            <thead>
                                <tr>
                                    <th style="width:80px;">Sr.No.</th>
                                    <th style="width:120px;">First Name</th>
                                    <th style="width:120px;">Last Name</th>
                                    <th style="width:120px;">Email</th>
                                    <th style="width:120px;">Mobile Number</th>
                                    <th style="width:120px;">Website</th>
                                    <th style="width:200px;">view</th>
                                    <th style="width:50px;">Actions</th>
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

<script>


$(document).ready(function() {
    var table = $('#student_table').DataTable({
        "autoWidth": false,
        dom: '<"top-toolbar"lf>rtip',
            initComplete: function() {
                this.api().columns([5]).every(function() {
                    var column = this;
                    var website_type = $('#website_type')
                        .on('change', function() {
                            var val = $(this).val();
                            column.search(val).draw();
                        });

                });
            },
        processing: true,
        serverSide: true,
        ajax: "{{url()->full()}}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {
                data: 'first_name'
            },
            {
                data: 'last_name'
            },
            {
                data:'email'
            },
            {
                data: 'phone_number'
            },
            {
                data: 'website'
            },
            {
                data: 'view'
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
    
    $("div.top-toolbar").append('<?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>');
    $("div.top-toolbar").append(`@include('student.csvExportForm')`);
    
});


    function generateParamsurl(params) {
        let paramString = '';
        Object.keys(params).forEach(function(key, index) {
            if (params[key] !== undefined && params[key] !== 'undefined') {
                paramString += (index > 0) ? '&' + key + '=' + params[key] : '?' + key + '=' + params[key]
            }
        })
        return paramString;
    }

    /*$(document).ready(function() {
        const searchParams = new URLSearchParams(window.location.search);
        var paramsList = {};
        for (const param of searchParams) {
            paramsList[param[0]] = param[1];
        }
        $('#website_type').change(function() {
            if (paramsList['page'])
                paramsList['page'] = 1;
            paramsList['website'] = $(this).val();
            window.location.href = "{{route('students.student.index')}}/" + generateParamsurl(paramsList);
        })
    })*/
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