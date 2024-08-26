@extends('layouts.app')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="justify-content: right;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?php
/*
use App\Models\Orders;
use App\Models\ContactUs;

$orders = Orders::get()->count();
$enqury = ContactUs::get()->count();
*/
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-primary">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-truck"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Total Order</p>
                                <h3 class="text-white">{{$total_orders}}</h3>
                                <!-- <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-white" style="width: 80%"></div>
                                </div> -->
                                <small><a href="{{route('orders.payment_done')}}" style="color:#fff;">View All</a></small>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-warning">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-money"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Total Expanse</p>
                                <h3 class="text-white">${{$total_expence}}</h3>
                                <!-- <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-white" style="width: 50%"></div>
                                </div>
                                <small>50% Increase in 25 Days</small> --> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-secondary">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-question-circle"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Total Enquery </p>
                                <h3 class="text-white">{{$total_enqury}}</h3>
                                <!-- <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-white" style="width: 76%"></div>
                                </div>
                                <small>76% Increase in 20 Days</small> -->
                                <small><a href="{{route('orders.enquery')}}" style="color:#fff;">View All</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-danger">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-rupee"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Total Profit</p>
                                <h3 class="text-white">${{$total_profit}}</h3>
                                <!-- <div class="progress mb-2 bg-white">
                                    <div class="progress-bar progress-animated bg-white" style="width: 30%"></div>
                                </div>
                                <small>30% Increase in 30 Days</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="col-lg-3 col-6">
                
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3></h3>

                        <p>Total Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>100000</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>150000</h3>

                        <p>Total Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pig-money-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3></h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection