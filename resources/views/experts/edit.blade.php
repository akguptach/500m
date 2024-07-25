@extends('layouts.app')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Expert</h3>
                        <div class="ml-auto">
                            <a href="{{ route('experts.expert.index') }}" class="btn btn-primary" title="Show All Expert">
                                <span aria-hidden="true"></span>View Expert
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" id="success_message">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-validation">

                            <form method="POST" class="needs-validation" novalidate action="{{ route('experts.expert.update', $expert->id) }}" id="edit_expert_form" name="edit_expert_form" accept-charset="UTF-8" >
                                {{ csrf_field() }}
                                @method('PUT')
                                @include ('experts.form', [
                                'expert' => $expert,
                                ])

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <input type="submit"  class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection