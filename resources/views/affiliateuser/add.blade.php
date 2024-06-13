@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Create New User</h4>
            <div class="ml-auto">
                <a href="{{ route('affiliateuser.affiliate.view') }}" class="btn btn-primary" title="Show All Expert">
                    <span aria-hidden="true"></span>View Affiliate User
                </a>
            </div>
         </div>
        

        <div class="card-body">
        

                            <form method="get" class="needs-validation" novalidate action="{{ route('experts.expert.addreview') }}" accept-charset="UTF-8" id="" name="" >
                            {{ csrf_field() }}
                            @include ('affiliateuser.form', [
                                                        'expert' => null,
                                                    ])

                                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                    <input class="btn btn-primary" type="submit" value="Add">
                                </div>

                            </form>

        </div>
    </div>

    <br><br>

    

@endsection


