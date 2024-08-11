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

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blog Categories</h3>
                    <a href="{{route('blog_categories.blog_category.create')}}" class="btn btn-primary">+ Add New</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" id="success_message">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example1" class="table table-responsive table-bordered row-border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogCategories as $blogCategory)
                                <tr>
                                    <td class="align-middle">{{ $blogCategory->category_name }}</td>
                                    <td class="align-middle">
                                        {{$blogCategory->status}}
                                    </td>
                                    <td>

                                        <a href="{{route('blog_categories.blog_category.edit',$blogCategory                                        
->id)}}" class="edit-link">
                                            <i class="fas fa-edit"></i>
                                        </a>



                                        <form method="POST"
                                            action="{!! route('blog_categories.blog_category.change', $blogCategory->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="active" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($blogCategory->status=='active') disabled="disabled" @endif
                                                type="submit"
                                                class="btn btn-link " title="Inactivate Service Keyword"
                                                onclick="return confirmAction('Click Ok to activate');"
                                                style="padding: 0px;padding-bottom:3px;">
                                                <i class="fas fa-times-circle"></i>
                                            </button>

                                        </form>


                                        <form method="POST"
                                            action="{!! route('blog_categories.blog_category.change', $blogCategory->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="PATCH" type="hidden">
                                            <input name="status" value="inactive" type="hidden">
                                            {{ csrf_field() }}
                                            <button @if($blogCategory->status=='inactive') disabled="disabled" @endif
                                                type="submit" class="btn btn-link " title="Activate Service Keyword"
                                                onclick="return confirmAction('Click Ok to Inactivate');"
                                                style="padding: 0px;padding-bottom:3px;">

                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>

                                        <form method="POST"
                                            action="{!! route('blog_categories.blog_category.destroy', $blogCategory->id) !!}"
                                            accept-charset="UTF-8" style="display:inline">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link " title="Delete Keyword"
                                                onclick="return confirmAction('Click Ok to delete');"
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

                </div>
                <div class="clearfix mt-2 pagination-div">
                    <div style="width: 100%;">
                        {!! $blogCategories->appends(request()->input())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
function confirmAction(message) {
    var result = confirm(message);
    return result;
}
</script>
@endsection