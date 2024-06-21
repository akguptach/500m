@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h4 class="m-0">Create New Affiliate</h4>
                                <div class="ml-auto">
                                    <a href="{{ route('affiliateuser.affiliate.view') }}" class="btn btn-primary"
                                        title="Show All Expert">
                                        <span aria-hidden="true"></span>View Affiliate User
                                    </a>
                                </div>
                            </div>


                            <div class="card-body">

                                <form method="POST" class="needs-validation" novalidate
                                    action="{{ route('affiliateuser.affiliate.update',$user->id) }}" accept-charset="UTF-8" id=""
                                    name="">
                                    {{ csrf_field() }}
                                    @include ('affiliateuser.form', [
                                    'user' => $user,
                                    ])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</section>




@endsection