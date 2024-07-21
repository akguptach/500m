@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Deal Categories</h4>
            <div>
                <a href="{{ route('deal_categories.deal_category.create') }}" class="btn btn-secondary" title="Create New Deal Category">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($dealCategories) == 0)
            <div class="card-body text-center">
                <h4>No Deal Categories Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive table-bordered">

                <table class="table table-responsive table-bordered row-border">
                    <thead>
                        <tr>
                            <th>Category Name</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dealCategories as $dealCategory)
                        <tr>
                            <td class="align-middle">{{ $dealCategory->category_name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('deal_categories.deal_category.destroy', $dealCategory->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('deal_categories.deal_category.show', $dealCategory->id ) }}" class="btn btn-info" title="Show Deal Category">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('deal_categories.deal_category.edit', $dealCategory->id ) }}" class="btn btn-primary" title="Edit Deal Category">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Deal Category" onclick="return confirm(&quot;Click Ok to delete Deal Category.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $dealCategories->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection