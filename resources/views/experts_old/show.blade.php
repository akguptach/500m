@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($expert->name) ? $expert->name : 'Expert' }}</h4>
        <div>
            <form method="POST" action="{!! route('experts.expert.destroy', $expert->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('experts.expert.edit', $expert->id ) }}" class="btn btn-primary" title="Edit Expert">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Expert" onclick="return confirm(&quot;Click Ok to delete Expert.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('experts.expert.index') }}" class="btn btn-primary" title="Show All Expert">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('experts.expert.create') }}" class="btn btn-secondary" title="Create New Expert">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expert->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">First Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expert->first_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Last Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expert->last_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Email</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expert->email }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Dob</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expert->dob }}</dd>

        </dl>

    </div>
</div>

@endsection