@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit <small>Coupon</small></h3>
                    </div>
                    <form method="PUT" class="needs-validation" action="{{ route('coupons.coupon.update', $coupon->id) }}">
                        {{ csrf_field() }}
                        @include ('coupons.form', [
                                        'coupon' => $coupon,
                                      ])

                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection