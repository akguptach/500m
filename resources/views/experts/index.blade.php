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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Experts</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form id="page-limit-form">
                                    <div style="display: flex;">
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
                                            {{ HtmlHelper::WebsiteDropdown('website_type', $websiteType, false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type',[],'All') }}
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Show on Home</th>
                                            <th>Language</th>
                                            <th>Skills</th>
                                            <th>Rating</th>
                                            <th>Qualification</th>
                                            <th>Subject Number</th>
                                            <th>Paper Number</th>
                                            <th>Add Review</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($experts as $expert)
                                        <tr>
                                            <td class="align-middle">{{$expert->first_name}}</td>
                                            <td class="align-middle"><img src="{{$expert->image}}" width="50px"></td>
                                            <td class="align-middle">
                                                @if($expert->show_on_home)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </td>
                                            <td class="align-middle">{{$expert->language}}</td>
                                            <td class="align-middle">{{count($expert->subjects)}}</td>
                                            <td class="align-middle">{{$expert->rating_numbers}}</td>
                                            <td class="align-middle">{{$expert->qualification}}</td>
                                            <td class="align-middle">{{$expert->subject_number}}</td>
                                            <td class="align-middle">{{$expert->paper_number}}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('expert_reviews.expert_review.index',$expert->id) }}"
                                                type="button" class="btn-xs btn-primary" style="color: white;">Add Review </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{route('experts.expert.edit',$expert->id)}}"
                                                    class="edit-link">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST"
                                                    action="{!! route('experts.expert.change', $expert->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="active" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($expert->status=='active') disabled="disabled" @endif
                                                        type="submit" class="btn btn-link " title="Inactivate Expert"
                                                        onclick="return new_modal(event, &quot;Click Ok to activate
                                                        Expert.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>

                                                </form>


                                                <form method="POST"
                                                    action="{!! route('experts.expert.change', $expert->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="PATCH" type="hidden">
                                                    <input name="status" value="inactive" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button @if($expert->status=='inactive') disabled="disabled" @endif
                                                        type="submit" class="btn btn-link " title="Activate Expert"
                                                        onclick="return new_modal(event, &quot;Click Ok to Inactivate
                                                            Expert.&quot;)" style="padding: 0px;padding-bottom:3px;">
                                                        <i class="fas fa-times-circle"></i>
                                                    </button>

                                                </form>



                                                <form method="POST"
                                                    action="{!! route('experts.expert.destroy', $expert->id) !!}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    <input name="_method" value="DELETE" type="hidden">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link " title="Delete Student"
                                                    onclick="return new_modal(event, &quot;Click Ok to delete Expert.&quot;)" 
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

                                    {!! $experts->appends(request()->input())->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

</section>
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#limit').change(function() {

        $('#page-limit-form').submit();
    })

    $('#website_type').change(function() {

        $('#page-limit-form').submit();
    })


})
</script>

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