@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($expertReview->title) ? $expertReview->title : 'Expert Review' }}</h4>
        <div>
            <form method="POST" action="{!! route('expert_reviews.expert_review.destroy', $expertReview->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('expert_reviews.expert_review.edit', $expertReview->id ) }}" class="btn btn-primary" title="Edit Expert Review">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Expert Review" onclick="return confirm(&quot;Click Ok to delete Expert Review.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('expert_reviews.expert_review.index') }}" class="btn btn-primary" title="Show All Expert Review">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('expert_reviews.expert_review.create') }}" class="btn btn-secondary" title="Create New Expert Review">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Title</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expertReview->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Description</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expertReview->description }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Expert</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($expertReview->expert)->subject }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Review Date</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expertReview->review_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Review Code</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expertReview->review_code }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Status</dt>
            <dd class="col-lg-10 col-xl-9">{{ $expertReview->status }}</dd>

        </dl>

    </div>
</div>

@endsection