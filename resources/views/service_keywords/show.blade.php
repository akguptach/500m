@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($serviceKeyword->name) ? $serviceKeyword->name : 'Service Keyword' }}</h4>
        <div>
            <form method="POST" action="{!! route('service_keywords.service_keyword.destroy', $serviceKeyword->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('service_keywords.service_keyword.edit', $serviceKeyword->id ) }}" class="btn btn-primary" title="Edit Service Keyword">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Service Keyword" onclick="return confirm(&quot;Click Ok to delete Service Keyword.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('service_keywords.service_keyword.index') }}" class="btn btn-primary" title="Show All Service Keyword">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('service_keywords.service_keyword.create') }}" class="btn btn-secondary" title="Create New Service Keyword">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $serviceKeyword->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $serviceKeyword->status }}</dd>

        </dl>

    </div>
</div>

@endsection