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
                                <h3 class="card-title">Services</h3>
                                <div class="float-right">
                                    <a href="{{ route('services.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" id="success_message">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <table id="services" class="table table-bordered table-responsive table-bordered  row-border">
                                    <thead>
                                        <tr>
                                            <th style="width:100px;">Sr.No.</th>
                                            <th>Service Name</th>
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
@include('services.service_page_js')
@endsection