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
                                <form method="POST" action="{{route('deal_categories.deal_category.store')}}" class="needs-validation" novalidate action="" accept-charset="UTF-8"
                                    id="" name="">
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
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th> Deal Category Name </th>
                                                <th> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dealCategories as $dealCategory)
                                            <tr>
                                                <td class="align-middle">{{ $dealCategory->category_name }}</td>
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

                                                        <button style="padding: 0px;padding-bottom:3px;" name="action" value="inactive"
                                                            type="submit" class="btn btn-link "
                                                            title="Inactivate Deal Category"
                                                            onclick="return confirm('Click Ok to Inactivate Deal Category.')"
                                                            @if($dealCategory->status=='inactive')
                                                            disabled="disabled" @endif>
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>

                                                        <button style="padding: 0px;padding-bottom:3px;" name="action" value="active"
                                                            type="submit" class="btn btn-link "
                                                            title="Delete Deal Category"
                                                            onclick="return confirm('Click Ok to activate Deal Category.')"
                                                            @if($dealCategory->status=='active')
                                                            disabled="disabled" @endif>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>


                                                        <button style="padding: 0px;padding-bottom:3px;" name="action" value="delete"
                                                            type="submit" class="btn btn-link "
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

@endsection