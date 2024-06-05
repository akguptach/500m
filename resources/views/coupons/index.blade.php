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

                                                        <button type="submit" class="btn btn-link" title="Delete Coupon"
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

@endsection