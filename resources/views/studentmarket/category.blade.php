@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session('success_message'))
                        <div class="alert alert-success" id="success_message">
                            {{ session('success_message') }}
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Deal Category</h3>
                                <div class="float-right">
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('deal_categories.deal_category.store')}}"
                                    class="needs-validation" novalidate action="" accept-charset="UTF-8" id="" name="">
                                    {{ csrf_field() }}
                                    @include ('studentmarket.form', [
                                    'dealCategory' => null,
                                    ])
                                    <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                                        <input class="btn btn-primary" type="submit" value="Add">
                                    </div>
                                </form>

                            </div>
                        </div>
                        <br><br>
                        <div class="card text-bg-theme">
                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h4 class="m-0">Deal Category list</h4>

                            </div>
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

                            <div class="card-body p-0">
                                <div class="table-responsive">

                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th> Deal Category Name </th>
                                                <th> Website Type</th>
                                                <th> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dealCategories as $dealCategory)
                                            <tr>
                                                <td class="align-middle">{{ $dealCategory->category_name }}</td>
                                                <td class="align-middle">{{ ucfirst($dealCategory->website_type) }}</td>
                                                <td class="align-middle">{{ ucfirst($dealCategory->status) }}</td>
                                                <td class="align-middle" style="display: flex;">


                                                    <a style="padding: 0px;padding-bottom:3px;margin-right: 2px;"
                                                        href="{{ route('deal_categories.deal_category.edit', $dealCategory->id ) }}"
                                                        class="edit-link" title="Edit Deal Category">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{!! route('deal_categories.deal_category.destroy', $dealCategory->id) !!}">
                                                        {{ csrf_field() }}

                                                        @if($dealCategory->status=='active')
                                                        <button style="padding: 0px;padding-bottom:3px;" name="action"
                                                            value="inactive" type="submit" class="btn btn-link "
                                                            title="Inactivate Deal Category"
                                                            onclick="return confirm('Click Ok to Inactivate Deal Category.')">
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                        @endif

                                                        @if($dealCategory->status=='inactive')
                                                        <button style="padding: 0px;padding-bottom:3px;" name="action"
                                                            value="active" type="submit" class="btn btn-link "
                                                            title="activate Deal Category"
                                                            onclick="return confirm('Click Ok to activate Deal Category.')">
                                                            
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                        @endif


                                                        <button style="padding: 0px;padding-bottom:3px;" name="action"
                                                            value="delete" type="submit" class="btn btn-link "
                                                            title="Delete Deal Category"
                                                            onclick="return confirm('Click Ok to delete Deal Category.')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>

                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix mt-2 pagination-div d-flex justify-content-between align-items-center p-3">
                                <div style="width: 100%;">
                                    {!! $dealCategories->appends(request()->input())->links('pagination::bootstrap-5') !!}
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
$(document).ready(function() {
    $('#limit').change(function() {
        $('#page-limit-form').submit();
    })
    $('#website_type_filter').change(function() {
        $('#page-limit-form').submit();
    })


})
</script>

@endsection