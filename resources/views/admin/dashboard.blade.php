@extends('layouts.backend.app')

@section('title')
<title>Dashboard | {{Auth::user()->name}}</title>
@endsection

@section('css')
@endsection

@php
use App\Models\Order;
use App\Models\Package;
use App\Models\User;

    $orderCount = Order::count();
    $tourCount = Package::whereStatus(1)->count();
    $userCount = User::whereRoleId(2)->count();
    $amts = Order::whereOrderStatus('Completed')->pluck('price');
    $tempAmt = 0;
    foreach($amts as $amt){
        $tempAmt = $tempAmt+$amt;
    }

    $sales = Order::whereOrderStatus('Completed')->count();
@endphp

@section('content')
	<div class="pcoded-main-container">
        <div class="pcoded-content">

            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row"> 
                <div class="col-sm-4">
                    <div class="card bg-c-yellow text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{$orderCount}}+</h2>
                            <h6 class="text-white">Total Orders</h6>
                            <i class="feather icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-c-green text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{$tourCount}}+</h2>
                            <h6 class="text-white">Total Tours</h6>
                            <i class="feather icon-user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card bg-c-red text-white widget-visitor-card">
                        <div class="card-body text-center">
                            <h2 class="text-white">{{$userCount}}+</h2>
                            <h6 class="text-white">Total Users</h6>
                            <i class="feather icon-user-check"></i>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="row"> 
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Total collected all time</h5>
                        </div>
                        <div class="card-body">
                            <div id="collected-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>This Month</h5>
                        </div>
                        <div class="card-body"> 
                            <div class="row mt-3">
                                <div class="col-6">
                                    <span class="d-block text-uppercase">Amount</span>
                                    <h3 class="mt-3">₹{{$tempAmt}}</h3>
                                    <div class="mt-3" id="transactions1"></div>
                                </div>
                                <div class="col-6">
                                    <span class="d-block text-uppercase">Sales</span>
                                    <h3 class="mt-3">{{$sales}}</h3>
                                    <div class="mt-3" id="transactions2"></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- [ Main Content ] end --> 
        </div>
    </div>
@endsection