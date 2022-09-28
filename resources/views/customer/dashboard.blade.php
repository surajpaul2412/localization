@extends('layouts.backend.app')

@section('title')
<title>Dashboard | {{Auth::user()->name}}</title>
@endsection

@section('css')
@endsection

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
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li> 
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">  
            <div class="col-sm-4">
                <div class="card widget-visitor-card">
                    <h3 class="text-center">You are Login</h3> 
                </div>
            </div> 
        </div> 
        <!-- [ Main Content ] end --> 
    </div>
</div>
@endsection