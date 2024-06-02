@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pages</h3>
                                <div class="float-right">
                                    <a href="{{ route('pages.create') }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="services" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:100px;">Sr.No.</th>
                                            <th>Page Name</th>
                                            <th>Status</th>
                                            <th>Website</th>
                                            <th>Service Url</th>
                                            <th style="width:100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
@include('services.pages_page_js')
@endsection