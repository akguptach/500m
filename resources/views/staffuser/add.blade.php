@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New User</h4>
                        <div class="float-right">
                            <a href="{{ route('staffuser.list') }}" class="btn btn-primary">
                                View Users
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" action="{{ route('staffuser.store') }}" method="POST">
                                {{ csrf_field() }}
								<input name="_method" type="hidden" value="POST">
                                @include ('staffuser.form', [
                                'user' => null,
								'roles'=>$roles
                                ])
                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                <a href="{{route('staffuser.list')}}" class="btn btn-primary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




@endsection