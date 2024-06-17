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
                                <h3 class="card-title">Add Deal</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('deals.deal.update',$deal->id)}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @include ('studentmarket.deal_form', [
                                    'deal' => $deal,
                                    ])
                                    <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                        <input class="btn btn-primary" type="submit" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection