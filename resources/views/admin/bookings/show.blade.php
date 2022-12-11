@extends('layouts.backend.app')

@section('title')
<title>Update Booking</title>
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
                            <h5 class="m-b-10">Edit Page</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('admin.bookings')}}">Manage Bookings</a></li>
                            <li class="breadcrumb-item"><a href="">Update Booking</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('admin.bookings')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card">
                    <form class="custom-form" method="post" action="{{ route('admin.booking.update', $booking->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                            	<div class="col-sm-6">
                                    <div class="form-group fill">  
                                        <label class="control-label">Add Comment<span>*</span></label>
                                        <input class="form-control" name="order_comment" value="" required/>
                                        @error('order_status')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group fill">  
                                        <label class="control-label">Update Status<span>*</span></label>
                                        <select name="order_status" class="form-control" required>
                                        	<option {{ $booking->order_status == "In Progress" ? 'selected' : '' }} value="In Progress">In Progress</option>
                                        	<option {{ $booking->order_status == "Confirmed" ? 'selected' : '' }} value="Confirmed">Confirmed</option>
                                        	<option {{ $booking->order_status == "Completed" ? 'selected' : '' }} value="Completed">Completed</option>
                                        	<option {{ $booking->order_status == "Cancelled By Admin" ? 'selected' : '' }} value="Cancelled">Cancelled By Admin</option>
                                        </select>
                                        @error('order_status')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="card-footer text-right"> 
                            <button type="" class="btn btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-success m-0">Submit</button>
                        </div>
                    </form> 
                </div>
            </div> 
        </div>  
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
