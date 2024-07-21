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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Deals</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif


                                <form id="page-limit-form">
                                <div style="display: flex;" class="card-header d-flex justify-content-between align-items-center p-3">
                                    <div>
                                        <labe>Item Per Page</labe>
                                        <select id="limit" name="limit">
                                            <option value="5" @if(@$limit==5) selected @endif>5</option>
                                            <option value="10" @if(@$limit==10) selected @endif>10</option>
                                            <option value="25" @if(@$limit==25) selected @endif>25</option>
                                            <option value="50" @if(@$limit==50) selected @endif>50</option>
                                            <option value="100" @if(@$limit==100) selected @endif>100</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: auto;">
                                        {{ HtmlHelper::WebsiteDropdown('website_type', $websiteType, false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type_filter',[],'All') }}
                                    </div>
                                </div>
                            </form>
                            <br>
                                <table class="table  ">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Show on Home</th>
                                            <th>Title</th>
                                            <th>Url</th>
                                            <th>Price</th>
                                            <th>Offer Price</th>
                                            <th>Voucher code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deals as $deal)
                                        <tr>
                                            <td class="align-middle"><img src="{{ $deal->image }}" width="50px"/></td>
                                            <td class="align-middle">
                                                @if($deal->show_on_home)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $deal->title }}</td>
                                            <td class="align-middle">{{ $deal->url }}</td>
                                            <td class="align-middle">{{ $deal->price }}</td>
                                            <td class="align-middle">{{ $deal->offer_price }}</td>
                                            <td class="align-middle">{{ $deal->voucher_code }}</td>

                                            <td class="text-end">

                                                <form method="POST"
                                                    action="{!! route('deals.deal.destroy', $deal->id) !!}"
                                                    accept-charset="UTF-8">
                                                    {{ csrf_field() }}

                                                    <div class="btn-group btn-group-sm" role="group">
                                                        
                                                        <a style="padding: 0px;padding-bottom:3px;margin-right:5px;" href="{{ route('deals.deal.edit', $deal->id ) }}"
                                                            class="edit-link" title="Edit Deal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        @if($deal->status=='active')
                                                        <button style="padding: 0px;padding-bottom:3px;margin-right: 7px;" name="action"
                                                            value="inactive" type="submit" class="btn btn-link "
                                                            title="Inactivate Deal Category"
                                                            onclick="return new_modal(event,'Click Ok to Inactivate Deal.')">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                        @endif

                                                        @if($deal->status=='inactive')
                                                        <button style="padding: 0px;padding-bottom:3px;margin-right: 7px;" name="action"
                                                            value="active" type="submit" class="btn btn-link "
                                                            title="activate Deal"
                                                            onclick="return new_modal(event,'Click Ok to activate Deal.')">
                                                            
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                        @endif

                                                        <button name="action" value="delete" style="padding: 0px;padding-bottom:3px;" type="submit" class="btn btn-link" title="Delete Deal"
                                                            onclick="return new_modal(event,&quot;Click Ok to delete Deal.&quot;)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>

                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<script>

$(document).ready(function() {
    $('#limit').change(function() {
        $('#page-limit-form').submit();
    })
    $('#website_type_filter').change(function() {
        $('#page-limit-form').submit();
    })
})
</script>

<script>
    async function new_modal(event, msg) {
        event.preventDefault(); // Prevent form submission

        if (await confirm(msg)) {
            let button = event.target.closest('button');

            // Create a hidden input to hold the button's value
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = button.name;
            hiddenInput.value = button.value;

            // Append the hidden input to the form
            event.target.closest('form').appendChild(hiddenInput);
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