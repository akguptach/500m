@extends('layouts.app')
@section('content')
<style>
p.small {
    font-size: 16px;
    margin-left: 24px;
    color: black !important;
}

div:has(> ul.pagination) {
    float: right;
    margin-right: 20px;
}
</style>
<section class="content-header">
    <div class="container-fluid">
    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Review</h3>
                            </div>
                            <div class="card-body">



                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif


                                <form method="POST" class="needs-validation" novalidate
                                    action="{{ route('expert_reviews.expert_review.store',$id) }}"
                                    accept-charset="UTF-8" id="" name="">
                                    {{ csrf_field() }}
                                    @include ('expert_reviews.form', [
                                    'expertReview' => null,
                                    ])
                                    <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                        <input class="btn btn-primary" type="submit" value="submit">
                                    </div>
                                </form>

                            </div>

                            <div class="card1 text-bg-theme">
                                <div class="card-header d-flex justify-content-between align-items-center p-3">
                                    <h4 class="m-0">Review list</h4>
                                </div>
                                <div class="card-body1 p-0">
                                    <div class="table-responsive table-bordered">
                                        <table class="table  table-responsive table-bordered row-border ">
                                            <thead>
                                                <tr>
                                                    <th>Review Title </th>
                                                    <th>Review Description</th>
                                                    <th>Date</th>
                                                    <th>Review Code</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expertReviews as $expertReview)
                                                <tr>
                                                    <td class="align-middle">{{ $expertReview->title }}</td>
                                                    <td class="align-middle">{{ $expertReview->description }}</td>
                                                    <td class="align-middle">{{ $expertReview->title }}</td>
                                                    <td class="align-middle">{{ $expertReview->review_date }}</td>
                                                    <td class="align-middle">{{ $expertReview->review_code }}</td>
                                                    <td class="align-middle">{{ $expertReview->status }}</td>

                                                    <td class="align-middle">
                                                        <a href="{{route('expert_reviews.expert_review.edit',$expertReview->id)}}"
                                                            class="edit-link">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="POST"
                                                            action="{!! route('experts.review.change', $expertReview->id) !!}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            <input name="_method" value="PATCH" type="hidden">
                                                            <input name="status" value="active" type="hidden">
                                                            {{ csrf_field() }}
                                                            <button @if($expertReview->status=='active')
                                                                disabled="disabled" @endif
                                                                type="submit" class="btn btn-link " title="Inactivate
                                                                Expert Review"
                                                                onclick="return confirm(&quot;Click Ok to activate
                                                                Expert.&quot;)" style="padding:
                                                                0px;padding-bottom:3px;">
                                                                <i class="fas fa-check-circle"></i>
                                                            </button>

                                                        </form>


                                                        <form method="POST"
                                                            action="{!! route('experts.review.change', $expertReview->id) !!}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            <input name="_method" value="PATCH" type="hidden">
                                                            <input name="status" value="inactive" type="hidden">
                                                            {{ csrf_field() }}
                                                            <button @if($expertReview->status=='inactive')
                                                                disabled="disabled" @endif
                                                                type="submit" class="btn btn-link " title="Activate
                                                                Expert Review"
                                                                onclick="return confirm(&quot;Click Ok to Inactive
                                                                Expert.&quot;)" style="padding:
                                                                0px;padding-bottom:3px;">
                                                                <i class="fas fa-times-circle"></i>
                                                            </button>

                                                        </form>



                                                        <form method="POST"
                                                            action="{!! route('expert_reviews.expert_review.destroy', $expertReview->id) !!}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            <input name="_method" value="DELETE" type="hidden">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-link "
                                                                title="Delete Student"
                                                                onclick="return new_modal(event,'Click Yes to delete Expert Review.')"
                                                                style="padding: 0px;padding-bottom:3px;">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>

                                                        </form>

                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix mt-2 pagination-div">
                                        <div style="width: 100%;">
                                            {!!
                                            $expertReviews->appends(request()->input())->links('pagination::bootstrap-5')
                                            !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<script>
    async function new_modal(event, msg) {
        event.preventDefault(); // Prevent form submission

        if (await confirm(msg)) {
            event.target.closest('form').submit(); // Submit the form if confirmed
        }
    }

    // Function to show Bootstrap modal as confirmation
    function showBootstrapConfirm(msg, callback) {
        // Create modal markup
        var modalMarkup = `
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close btn border" style="padding: 1% 2%;" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>${msg}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>
        `;
        var modalElement = $(modalMarkup).appendTo('body');
        $(modalElement).modal('show');
        $(modalElement).find('.btn-primary').click(function() {
            callback(true); // Call callback with true indicating confirmation
            $(modalElement).modal('hide'); // Hide modal
        });
        $(modalElement).find('.btn-secondary').click(function() {
            callback(false); // Call callback with false indicating cancellation
            $(modalElement).modal('hide'); // Hide modal
        });
        $(modalElement).on('hidden.bs.modal', function() {
            $(this).remove(); // Remove modal from DOM when closed
        });
    }

    window.confirm = function(msg) {
        return new Promise(function(resolve) {
            showBootstrapConfirm(msg, function(result) {
                resolve(result);
            });
        });
    };
</script>
@endsection