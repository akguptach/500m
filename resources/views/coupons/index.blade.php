@extends('layouts.app')
@section('content')
<style>
div:has(> p.small) {
    margin-right: 30px;
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
                                <h3 class="card-title">Coupons</h3>
                                <div class="float-right">
                                    <a href="{{ route('coupons.coupon.create') }}">
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

                                <form id="page-limit-form">
                                <div style="display: flex;" class="card-header d-flex justify-content-between align-items-center p-3">
                                    <div>
                                        <labe>Item Per Page</labe>
                                        <select id="limit" name="limit">
                                            <option value="5" @if(@$limit==5) selected @endif>5</option>
                                            <option value="10" @if(@$limit==10) selected @endif>10</option>
                                            <option value="25" @if(@$limit==25) selected @endif>25</option>
                                            <option value="50" @if(@$limit==50) selected @endif>50</option>
                                            <option value="100" @if(@$limit==100) selected @endif>100</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: auto;">
                                        {{ HtmlHelper::WebsiteDropdown('website_type', $websiteType, false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type_filter',[],'All') }}
                                    </div>
                                </div>
                            </form>
                            <br>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Max Uses</th>
                                            <th>Num Uses</th>
                                            <th>Reduction Type</th>
                                            <th>Reduction Amount</th>
                                            <th>Limit Per Users</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupons as $coupon)
                                        <tr>
                                            <td class="align-middle">{{ $coupon->code }}</td>
                                            <td class="align-middle">{{ $coupon->start_date }}</td>
                                            <td class="align-middle">{{ $coupon->end_date }}</td>
                                            <td class="align-middle">{{ $coupon->max_uses }}</td>
                                            <td class="align-middle">{{ $coupon->num_uses }}</td>
                                            <td class="align-middle">{{ $coupon->reduction_type }}</td>
                                            <td class="align-middle">{{ $coupon->reduction_amount }}</td>
                                            <td class="align-middle">{{ $coupon->limit_per_users }}</td>

                                            <td class="text-end">

                                                <form method="POST"
                                                    action="{!! route('coupons.coupon.destroy', $coupon->id) !!}"
                                                    accept-charset="UTF-8">
                                                    <input name="_method" value="DELETE" type="hidden">
                                                    {{ csrf_field() }}

                                                    <div>

                                                        <a href="{{ route('coupons.coupon.edit', $coupon->id ) }}"
                                                            class="" title="Edit Coupon">
                                                            <i class="fas fa-edit" title="Edit"></i>
                                                        </a>

                                                        @if($coupon->status=='active')
                                                        <button style="padding: 0px;padding-bottom:3px;margin-left: 7px;" name="action"
                                                            value="inactive" type="submit" class="btn btn-link "
                                                            title="Inactivate Deal Category"
                                                            onclick="return confirm('Click Ok to Inactivate Coupon.')">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                        @endif

                                                        @if($coupon->status=='inactive')
                                                        <button style="padding: 0px;padding-bottom:3px;margin-left: 7px;" name="action"
                                                            value="active" type="submit" class="btn btn-link "
                                                            title="activate Deal"
                                                            onclick="return confirm('Click Ok to activate Coupon.')">
                                                            
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                        @endif

                                                        <button name="action"
                                                        value="delete" type="submit" class="btn btn-link" title="Delete Coupon"
                                                            onclick="return confirm(&quot;Click Ok to delete Coupon.&quot;)">
                                                            <i class="fas fa-trash" title="Delete"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix mt-2 pagination-div">
                                <div class="float-right" style="margin: 0;">
                                    {!! $coupons->appends([])->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<script>
$(document).ready(function() {
    $('#limit').change(function() {
        $('#page-limit-form').submit();
    })
    $('#website_type_filter').change(function() {
        $('#page-limit-form').submit();
    })


})
</script>
@endsection