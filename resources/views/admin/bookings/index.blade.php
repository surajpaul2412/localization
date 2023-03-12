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
                                        <th>Status</th>
                                        <th>Action</th>
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
                                        <td class="text-wrap">{{$booking->price}}.00</td>
                                        <td class="text-wrap"> 
                                            @if($booking->order_status == "In Progress")                                         
                                            <a href="#" class="btn btn-warning btn-xs" title="View Order" data-toggle="modal" data-target="#editBooking{{$index+1}}"><span class="badge badge-warning">{{$booking->order_status}}</span></a> 
                                            @elseif($booking->order_status == "Cancelled")
                                            <a href="#" class="btn btn-danger btn-xs" title="View Order" data-toggle="modal" data-target="#editBooking{{$index+1}}"><span class="badge badge-danger">{{$booking->order_status}}</span></a> 
                                            @else
                                            <a href="#" class="btn btn-success btn-xs" title="View Order" data-toggle="modal" data-target="#editBooking{{$index+1}}"><span class="badge badge-success">{{$booking->order_status}}</span></a> 
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-xs mr-1" title="Edit"><i class="feather icon-edit"></i></a> -->
                                            <a href="#" class="btn btn-success btn-xs" title="View Order" data-toggle="modal" data-target="#viewBooking{{$index+1}}"><i class="feather icon-eye"></i></a> 
                                        </td>
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

<!-- model -->
@if($bookings->count())
    @foreach($bookings as $index => $booking)
    <div id="viewBooking{{$index+1}}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form class="custom-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Booking Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"> 
                        <table class="table table-sm table-bordered table-striped mb-0"> 
                            <tbody>
                                <tr>
                                    <th>Booking Id</th>
                                    <td>#{{$booking->order_no}}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>{{$booking->user->name}} <br><a href="#">{{$booking->user->email}}</a></td>
                                </tr>
                                <tr>
                                    <th>Plan/Packeges</th>
                                    <td>{{$booking->package->name}}</td>
                                </tr>
                                <tr>
                                    <th>Departure date</th>
                                    <td>{{$booking->date}}</td>
                                </tr>
                                <tr>
                                    <th>Seat - Price</th>
                                    <td>{{$booking->adult_qty+$booking->child_qty+$booking->infant_qty}} / {{$booking->price}}</td>
                                </tr>
                                <tr>
                                    <th>Payemnt Id</th>
                                    <td>{{$booking->razorpay_payment_id}}</td>
                                </tr>
                                <tr>
                                    <th>Booking Status</th>
                                    @if($booking->order_status == "In Progress")
                                    <td><span class="badge badge-warning">{{$booking->order_status}}</span></td>
                                    @elseif($booking->order_status == "Cancelled")
                                    <td><span class="badge badge-danger">{{$booking->order_status}}</span></td>
                                    @else
                                    <td><span class="badge badge-success">{{$booking->order_status}}</span></td>
                                    @endif
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer bg-gray">
                        <!-- <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-success btn-xs has-ripple">Update</button> -->
                    </div>
                </div> 
            </form>
        </div>
    </div>


    <!-- edit -->
    <div id="editBooking{{$index+1}}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form class="custom-form" method="post" action="{{ route('admin.booking.update', $booking->id) }}">
                @method('PATCH')
                @csrf 
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title">Booking Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-sm-12">
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
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12">
                                <div class="form-group fill">  
                                    <label class="control-label">Update Status<span>*</span></label>
                                    <select name="order_status" class="form-control" required>
                                        <option {{ $booking->order_status == "In Progress" ? 'selected' : '' }} value="In Progress">In Progress</option>
                                        <option {{ $booking->order_status == "Confirmed" ? 'selected' : '' }} value="Confirmed">Confirmed</option>
                                        <option {{ $booking->order_status == "Completed" ? 'selected' : '' }} value="Completed">Completed</option>
                                        <option {{ $booking->order_status == "Cancelled" ? 'selected' : '' }} value="Cancelled">Cancelled By Admin</option>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button> 
                        <button type="submit" class="btn btn-success btn-xs has-ripple">Update</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>
    @endforeach
@endif
@endsection

@section('script')
<script>
    // DataTable start
    $('#report-table').DataTable();  
</script>
@endsection