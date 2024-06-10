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
            <h4 class="m-0">Experts</h4>
            <div>
                <a href="{{ route('experts.expert.create') }}" class="btn btn-secondary" title="Create New Expert">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($experts) == 0)
            <div class="card-body text-center">
                <h4>No Experts Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Dob</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($experts as $expert)
                        <tr>
                            <td class="align-middle">{{ $expert->name }}</td>
                            <td class="align-middle">{{ $expert->first_name }}</td>
                            <td class="align-middle">{{ $expert->last_name }}</td>
                            <td class="align-middle">{{ $expert->email }}</td>
                            <td class="align-middle">{{ $expert->dob }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('experts.expert.destroy', $expert->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('experts.expert.show', $expert->id ) }}" class="btn btn-info" title="Show Expert">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('experts.expert.edit', $expert->id ) }}" class="btn btn-primary" title="Edit Expert">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Expert" onclick="return confirm(&quot;Click Ok to delete Expert.&quot;)">
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

            {!! $experts->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection