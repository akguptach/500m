@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="needs-validation" novalidate action="{{ route('experts.expert.update', $expert->id) }}" id="edit_expert_form" name="edit_expert_form" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('experts.form', [
                                        'expert' => $expert,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>

        </div>
    </div>

@endsection