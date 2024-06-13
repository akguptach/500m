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
                                <h3 class="card-title">Experts</h3>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Language</th>
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
                                            <td class="align-middle">{{$expert->language}}</td>
                                            <td class="align-middle">{{$expert->ratings}}</td>
                                            <td class="align-middle">{{$expert->qualification}}</td>
                                            <td class="align-middle">{{$expert->subject_number}}</td>
                                            <td class="align-middle">{{$expert->paper_number}}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('expert_reviews.expert_review.index',$expert->id) }}"
                                                    class="btn-sm btn-primary">Add Review </a>
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
                                                        onclick="return confirm(&quot;Click Ok to activate
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
                                                        onclick="return confirm(&quot;Click Ok to Inactive
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
                                                        onclick="return confirm(&quot;Click Ok to delete Expert.&quot;)"
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


@endsection