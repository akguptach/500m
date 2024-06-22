<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
}
</style>
<div class="card-body">

    <div class="form-group">
        <label for="code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Code</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" type="text" id="code"
                value="{{ old('code', optional($coupon)->code) }}" minlength="1" placeholder="Enter code here...">
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="rating" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website Type</label>
        <div class="col-lg-10 col-xl-9">
            {{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($coupon)->website_type), false, '', 'website_type') }}
            {!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="start_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Start Date</label>
        <div class="col-lg-10 col-xl-9">
            <input readonly class="datepicker form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                name="start_date" type="text" id="start_date"
                value="{{ old('start_date', optional($coupon)->start_date) }}" placeholder="Enter start date here...">
            {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="end_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">End Date</label>
        <div class="col-lg-10 col-xl-9">
            <input readonly class="enddatepicker form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                name="end_date" type="text" id="end_date" value="{{ old('end_date', optional($coupon)->end_date) }}"
                placeholder="Enter end date here...">
            {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <?php /*<div class="form-group">
        <label for="whole_order_coupon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Whole Order Coupon</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('whole_order_coupon') ? ' is-invalid' : '' }}"
                name="whole_order_coupon" type="text" id="whole_order_coupon"
                value="{{ old('whole_order_coupon', optional($coupon)->whole_order_coupon) }}" minlength="1"
                placeholder="Enter whole order coupon here...">
            {!! $errors->first('whole_order_coupon', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="max_product_instances" class="col-form-label text-lg-end col-lg-2 col-xl-3">Max Product
            Instances</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('max_product_instances') ? ' is-invalid' : '' }}"
                name="max_product_instances" type="text" id="max_product_instances"
                value="{{ old('max_product_instances', optional($coupon)->max_product_instances) }}" minlength="1"
                placeholder="Enter max product instances here...">
            {!! $errors->first('max_product_instances', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>*/ ?>

    <div class="form-group">
        <label for="max_uses" class="col-form-label text-lg-end col-lg-2 col-xl-3">Max Uses</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('max_uses') ? ' is-invalid' : '' }}" name="max_uses" type="number"
                id="max_uses" value="{{ old('max_uses', optional($coupon)->max_uses) }}" minlength="1"
                placeholder="Enter max uses here...">
            {!! $errors->first('max_uses', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <?php /*<div class="form-group">
        <label for="num_uses" class="col-form-label text-lg-end col-lg-2 col-xl-3">Num Uses</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('num_uses') ? ' is-invalid' : '' }}" name="num_uses" type="text"
                id="num_uses" value="{{ old('num_uses', optional($coupon)->num_uses) }}" minlength="1"
                placeholder="Enter num uses here...">
            {!! $errors->first('num_uses', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="reduction_target" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reduction Target</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('reduction_target') ? ' is-invalid' : '' }}"
                name="reduction_target" type="text" id="reduction_target"
                value="{{ old('reduction_target', optional($coupon)->reduction_target) }}" minlength="1"
                placeholder="Enter reduction target here...">
            {!! $errors->first('reduction_target', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>*/ ?>

    <div class="form-group">
        <label for="reduction_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reduction Type</label>
        <div class="col-lg-10 col-xl-9">
            <select class="form-control{{ $errors->has('reduction_type') ? ' is-invalid' : '' }}" name="reduction_type">
                <option value="">--Select--</option>
                @foreach([['label'=>'Percentage','value'=>'PERCENTAGE'],['label'=>'Fixed','value'=>'FIXED']] as $item)
                <option @if(old('reduction_type', optional($coupon)->reduction_type) == $item['value'])
                    selected="selected" @endif value="{{$item['value']}}">{{$item['label']}}</option>
                @endforeach
            </select>
            {!! $errors->first('reduction_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="reduction_amount" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reduction Amount</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('reduction_amount') ? ' is-invalid' : '' }}"
                name="reduction_amount" type="number" id="reduction_amount"
                value="{{ old('reduction_amount', optional($coupon)->reduction_amount) }}" minlength="1"
                placeholder="Enter reduction amount here...">
            {!! $errors->first('reduction_amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="limit_per_users" class="col-form-label text-lg-end col-lg-2 col-xl-3">Limit Per Users</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-control{{ $errors->has('limit_per_users') ? ' is-invalid' : '' }}" name="limit_per_users"
                type="text" id="limit_per_users"
                value="{{ old('limit_per_users', optional($coupon)->limit_per_users) }}" minlength="1"
                placeholder="Enter limit per users here...">
            {!! $errors->first('limit_per_users', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('coupons.coupon.index')}}" class="btn btn-primary">Back</a>
    </div>
</div>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

<script>
/*var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: today
});


var date = new Date();
date.setDate(date.getDate() + 1)
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
$('.enddatepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: today
});*/

$(document).ready(function() {



    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $("#start_date").datepicker({
        todayBtn: 1,
        autoclose: true,
        startDate: today,
        format: 'yyyy-mm-dd',
    }).on('changeDate', function(selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#end_date').datepicker('setStartDate', minDate);
    });
    $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        })
        .on('changeDate', function(selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#start_date').datepicker('setEndDate', minDate);
        });

    //$('#end_date').datepicker('setStartDate', new Date("{{ old('start_date', optional($coupon)->start_date) }}"));

    //$('#start_date').datepicker('setEndDate', new Date("{{ old('end_date', optional($coupon)->end_date) }}"));
});
</script>



@if(isset($coupon->id))
<script>
$(document).ready(function() {
    $('#end_date').datepicker('setStartDate', new Date(
        "{{ old('start_date', optional($coupon)->start_date) }}"));
    $('#start_date').datepicker('setEndDate', new Date("{{ old('end_date', optional($coupon)->end_date) }}"));
});
</script>
@endif