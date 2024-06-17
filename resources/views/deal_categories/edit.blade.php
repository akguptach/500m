@extends('layouts.app')

@section('content')

    <div class="card text-bg-theme">
  
         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($title) ? $title : 'Deal Category' }}</h4>
            <div>
                <a href="{{ route('deal_categories.deal_category.index') }}" class="btn btn-primary" title="Show All Deal Category">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('deal_categories.deal_category.create') }}" class="btn btn-secondary" title="Create New Deal Category">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

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

            <form method="POST" class="needs-validation" novalidate action="{{ route('deal_categories.deal_category.update', $dealCategory->id) }}" id="edit_deal_category_form" name="edit_deal_category_form" accept-charset="UTF-8" >
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('deal_categories.form', [
                                        'dealCategory' => $dealCategory,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>

        </div>
    </div>

@endsection