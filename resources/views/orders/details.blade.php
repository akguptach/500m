@extends('layouts.app')

@section('content')
<link  rel="stylesheet" href="/css/adminlte.min.css"></link>

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
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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


            @if($orderAssign)
            @include('orders.tutor_assigned',['data'=>$data,
            'studentMessages'=>$studentMessages,'teacherOrderMessage'=>$teacherOrderMessage])
            @elseif($tutorRequestAccepted)
            {{--@include('orders.tutor_accepted')--}}
            @include('orders.student_chat',['data'=>$data,
            'studentMessages'=>$studentMessages])
            @else
            @include('orders.student_chat',['data'=>$data,
            'studentMessages'=>$studentMessages])
            @endif

            @if($qcAssign)
            @include('orders.qc_assigned',['data'=>$data, 'qcOrderMessage'=>$qcOrderMessage])
            <?php /*@elseif($qcRequestAccepted)
            @include('orders.qc_accepted',['orderRequestSent'=>$qcRequestAccepted])*/ ?>
            @endif


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>



@endsection