@extends('layouts.app')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Expert</h3>
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
                            <form method="POST" class="needs-validation" novalidate action="{{ route('experts.expert.store') }}" accept-charset="UTF-8" id="create_expert_form" name="create_expert_form">
                                {{ csrf_field() }}
                                @include ('experts.form', [
                                'expert' => null,
                                ])

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <input type="submit" name="save" class="btn btn-primary" value="submit">
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