@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create <small>Coupon</small></h3>
                    </div>
                    <form method="POST" class="needs-validation" novalidate action="{{ route('coupons.coupon.store') }}"
                        accept-charset="UTF-8" id="create_coupon_form" name="create_coupon_form">
                        {{ csrf_field() }}
                        @include ('coupons.form', [
                        'coupon' => null,
                        ])

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection