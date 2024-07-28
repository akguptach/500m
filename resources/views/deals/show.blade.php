@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($deal->title) ? $deal->title : 'Deal' }}</h4>
        <div>
            <form method="POST" action="{!! route('deals.deal.destroy', $deal->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('deals.deal.edit', $deal->id ) }}" class="btn btn-primary" title="Edit Deal">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Deal" onclick="return confirm(&quot;Click Ok to delete Deal.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('deals.deal.index') }}" class="btn btn-primary" title="Show All Deal">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('deals.deal.create') }}" class="btn btn-secondary" title="Create New Deal">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Image</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->image }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Short Description</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->short_description }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Long Description</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->long_description }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Url</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->url }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Price</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->price }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Other Price</dt>
            <dd class="col-lg-10 col-xl-9">{{ $deal->other_price }}</dd>

        </dl>

    </div>
</div>

@endsection