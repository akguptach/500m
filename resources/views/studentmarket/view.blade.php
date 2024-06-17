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

                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Short Description</th>
                                            <th>Long Description</th>
                                            <th>Url</th>
                                            <th>Price</th>
                                            <th>Other Price</th>
                                            <th>Action</th>
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

                                                <form method="POST"
                                                    action="{!! route('deals.deal.destroy', $deal->id) !!}"
                                                    accept-charset="UTF-8">
                                                    <input name="_method" value="DELETE" type="hidden">
                                                    {{ csrf_field() }}

                                                    <div class="btn-group btn-group-sm" role="group">
                                                        
                                                        <a style="padding: 0px;padding-bottom:3px;margin-right:5px;" href="{{ route('deals.deal.edit', $deal->id ) }}"
                                                            class="edit-link" title="Edit Deal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button style="padding: 0px;padding-bottom:3px;" type="submit" class="btn btn-link" title="Delete Deal"
                                                            onclick="return confirm(&quot;Click Ok to delete Deal.&quot;)">
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


@endsection