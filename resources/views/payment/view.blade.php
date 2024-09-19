@extends('layouts.app')
@section('content')
<style>
.paginate_button {
    padding: 8px !important;
}

#payment_table_filter {
    margin-left: 34%;
}

#payment_table td {
    overflow-wrap: anywhere;
}
.dataTables_length{
    width: 200px;
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
</style>
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment History</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="payment_table"
                                    class="table table-bordered  table-responsive table-bordered row-border">
                                    <thead>
                                        <tr>
                                            <th>Order id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Website</th>
                                            <th>Transaction Id</th>
                                            <th>Payment status</th>
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
<script>
$(document).ready(function() {
    var table = $('#payment_table').DataTable({
        "autoWidth": false,
        dom: '<"top-toolbar"lf>rtip',
        initComplete: function() {
            this.api().columns([4]).every(function() {
                var column = this;
                $('#website_type')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });

            });

            this.api().columns([6]).every(function() {
                var column = this;
                $('#payment_filter')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });

            });

        },
        processing: true,
        serverSide: true,
        ajax: "{{url()->full()}}",
        columns: [{
                data: 'task_id',
                'searchable': false
            },
            {
                data: 'first_name',
                'searchable': false
            },
            {
                data: 'email',
                'searchable': false
            },
            {
                data: 'phone_number',
                'searchable': false
            },
            {
                data: 'website_type',
                'searchable': false
            },
            {
                data: 'transaction_id',
                'searchable': false
            },
            {
                data: 'payment_status',
                'searchable': false
            }
        ]

    });
    $("div.top-toolbar").css({
        "display": "flex",
        "justify-content": "space-between"
    });

    $("div.top-toolbar").append(`<div class="float-right" style="display: flex;">
    <?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>
    &nbsp;&nbsp;

                                    <select name="payment_filter" id="payment_filter" class="form-control"
                                        style="width:150px;">
                                        <option value="">All</option>
                                        <option value="Success">
                                            Success</option>
                                        <option value="Failed">Fail
                                        </option>
                                    </select>
    `);
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

$(document).ready(function() {

    const searchParams = new URLSearchParams(window.location.search);
    var paramsList = {};
    for (const param of searchParams) {
        paramsList[param[0]] = param[1];
    }
    /*$('#payment_filter').change(function() {
        if (paramsList['page'])
        paramsList['page'] = 1;
        paramsList['payment_status'] = $(this).val();
        window.location.href = "{{route('payments')}}/"+generateParamsurl(paramsList);
    })
    $('#website_type').change(function() {
        if (paramsList['page'])
        paramsList['page'] = 1;
        paramsList['website'] = $(this).val();
        window.location.href = "{{route('payments')}}/"+generateParamsurl(paramsList);
    })*/


})
</script>

@endsection