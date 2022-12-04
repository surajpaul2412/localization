@extends('layouts.backend.app')

@section('title')
<title>Bookings | {{Auth::user()->role->name}}</title>
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
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">All bookings</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="">Manage bookings</a></li>
                            <li class="breadcrumb-item"><a href="">All Bookings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        @include('layouts.backend.partials.alert')

        <!-- [ Main Content ] start --> 
        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table id="report-table" class="table table-sm table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="col-1">Sr.No.</th>
                                        <th>Name</th>   
                                        <th>Email</th>   
                                        <th>Mobile</th>   
                                        <th>Country</th>   
                                        <th>City</th>   
                                        <th>Amount</th>   
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if($bookings->count())
                                    @foreach($bookings as $index => $booking)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td class="text-wrap">{{$booking->user->name}}</td>
                                        <td class="text-wrap">{{$booking->user->email}}</td>
                                        <td class="text-wrap">{{$booking->user->mobile}}</td>
                                        <td class="text-wrap">{{$booking->address->country}}</td>
                                        <td class="text-wrap">{{$booking->address->city}}</td>
                                        <td class="text-wrap">{{$booking->total_amount}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-gray"></div>
                </div>
            </div>
        </div> 
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection