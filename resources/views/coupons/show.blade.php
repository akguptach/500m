@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Coupon' }}</h4>
        <div>
            <form method="POST" action="{!! route('coupons.coupon.destroy', $coupon->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('coupons.coupon.edit', $coupon->id ) }}" class="btn btn-primary" title="Edit Coupon">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Coupon" onclick="return confirm(&quot;Click Ok to delete Coupon.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('coupons.coupon.index') }}" class="btn btn-primary" title="Show All Coupon">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('coupons.coupon.create') }}" class="btn btn-secondary" title="Create New Coupon">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Code</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->code }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Start Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->start_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">End Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->end_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Whole Order Coupon</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->whole_order_coupon }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Max Product Instances</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->max_product_instances }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Max Uses</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->max_uses }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Num Uses</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->num_uses }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reduction Target</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->reduction_target }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reduction Type</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->reduction_type }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Reduction Amount</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->reduction_amount }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Limit Per Users</dt>
            <dd class="col-lg-10 col-xl-9">{{ $coupon->limit_per_users }}</dd>

        </dl>

    </div>
</div>

@endsection