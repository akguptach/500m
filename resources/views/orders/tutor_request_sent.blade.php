@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Orders Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @include('orders.order_info',['data'=>$data])

            @include('orders.student_chat',['data'=>$data,
            'studentMessages'=>$studentMessages])

            @if($orderRequestSent && $orderRequestSent->status == 'ACCEPTED')
            @include('orders.tutor_accepted')
            @elseif($orderRequestSent && $orderRequestSent->status == 'PENDING')
            <div class="col-md-9">
                <div class="alert alert-warning" role="alert">
                    ORDER REQUEST IS PENDING
                </div>
            </div>
            @elseif($orderRequestSent && $orderRequestSent->status == 'REJECTED')
            <div class="col-md-9">
                <div class="alert alert-warning" role="alert">
                    ORDER REQUEST IS REJECTED
                </div>
            </div>
            @endif
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>



@endsection