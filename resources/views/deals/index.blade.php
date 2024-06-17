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
            <h4 class="m-0">Deals</h4>
            <div>
                <a href="{{ route('deals.deal.create') }}" class="btn btn-secondary" title="Create New Deal">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($deals) == 0)
            <div class="card-body text-center">
                <h4>No Deals Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Long Description</th>
                            <th>Url</th>
                            <th>Price</th>
                            <th>Other Price</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($deals as $deal)
                        <tr>
                            <td class="align-middle">{{ $deal->title }}</td>
                            <td class="align-middle">{{ $deal->short_description }}</td>
                            <td class="align-middle">{{ $deal->long_description }}</td>
                            <td class="align-middle">{{ $deal->url }}</td>
                            <td class="align-middle">{{ $deal->price }}</td>
                            <td class="align-middle">{{ $deal->other_price }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('deals.deal.destroy', $deal->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('deals.deal.show', $deal->id ) }}" class="btn btn-info" title="Show Deal">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('deals.deal.edit', $deal->id ) }}" class="btn btn-primary" title="Edit Deal">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Deal" onclick="return confirm(&quot;Click Ok to delete Deal.&quot;)">
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

            {!! $deals->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection