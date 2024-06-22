@extends('layouts.app')
@section('content')
<style>
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
                                <div class="float-right" style="display: flex;">

                                    <?php HtmlHelper::WebsiteTypeDropdown('website_type', $website, false, 'width:150px;', 'website_type') ?>

                                    &nbsp;&nbsp;

                                    <select name="payment_filter" id="payment_filter" class="form-control"
                                        style="width:150px;">
                                        <option value="">All</option>
                                        <option value="Success" @if($paymentStatus=='Success' ) selected="selected" @endif>
                                            Success</option>
                                        <option value="Failed" @if($paymentStatus=='Failed' ) selected="selected" @endif>Fail
                                        </option>
                                    </select>
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
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>MAS{{$payment->order->id}}</td>
                                            <td>{{@$payment->order->student->first_name}}</td>
                                            <td>{{@$payment->order->student->email}}</td>
                                            <td>{{@$payment->order->student->phone_number}}</td>
                                            <td>{{@$payment->order->website->website_type}}</td>
                                            <td width="250px"><span
                                                    style="overflow-wrap: anywhere;">{{$payment->transaction_id}}</span>
                                            </td>
                                            <td>
                                                {{$payment->payment_status}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix mt-2 pagination-div">
                                <div style="width: 100%;">
                                    {!! $payments->appends(request()->input())->links('pagination::bootstrap-5') !!}
                                </div>
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
    $('#payment_filter').change(function() {
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
    })


})
</script>

@endsection