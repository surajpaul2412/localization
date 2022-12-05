@extends('layouts.frontend.customerapp')

@section('title')
<title>My Bookings | {{Auth::user()->name}}</title>
@endsection

@section('content') 
<main>
    
    <!-- [ Top Breadcrubms ] start -->  
    <div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span>	My Bookings</h1></div>
                </div>
                <!-- End bs-wizard -->
            </div>
        </div>
    </div>

    <!-- [ My Orders ] start --> 
    <section class="section dashboard-detail">
        <div class="container-fluid">
            <div class="row align-items-start justify-content-center">

                <div class="col-lg-3 text-center d-none d-lg-block">
                    @include('layouts.frontend.partials.customerSidebar')
                </div> 
                        
                <div class="col-lg-9">

                    <div class="card border">
                        <div class="card-header">
                            <h4 class="mb-0">My Bookings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            @if($orders->count())
                            @foreach($orders as $key => $order)
                            <div class="col-lg-12">  
                                <ul class="order-listing p-0">                                 
                                
                                    <li class="order-item mb-3">
                                        <div class="order-box-v2">
                                            <div class="card border">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center justify-content-start">
                                                            <img src="{{asset('images/tour.png')}}" class="img-fluid rounded-circle shadow" width="40px">
                                                            <div class="media-body ms-2">
                                                                <h6 class="mb-0 ft-medium">#1250004123</h6>
                                                                <p class="m-0 fs-sm ft-normal">Total Amount - <b>₹</b>{{$order->total_amount}}.00</p>
                                                            </div>
                                                        </div> 
                                                        <div class="delv_status"><span class="ft-medium small text-warning bg-light-warning rounded px-2 py-1 border">{{$order->order_status}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="card-body"> 
                                                    <ul class="booking_list">
                                                        <li><strong>Tours Date:</strong> 25 Dec 2022</li> 
                                                        <!-- <li><strong>Booking details:</strong> 2 People</li> -->
                                                        <li><strong>Client:</strong> Mark Twain</li>
                                                        <li><strong>Client Contacts:</strong> <a href="#0">98432983242</a> - <a href="#0">mark@hotmail.com</a></li>
                                                        <li><strong>Payment:</strong>Online (Paied)</li>
                                                        <li class="text-success"><strong>1+</strong> Booking</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer d-flex justify-content-between"> 
                                                    <div class="cf-left">
                                                        <p class="m-0"><strong>Booking Date:</strong> {{$order->created_at->format('d M Y')}}</p>
                                                    </div>
                                                    <div class="more-links text-end"> 
                                                        <a href="{{route('customer.booking')}}"><small>View Booking</small></a> | <a href="#"><small>Cancel Order</small></a>  
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </li>   

                                </ul> 
                            </div>
                            @endforeach
                            @else
                            <div>No Bookings yet.</div>
                            @endif
                        </div>
                        </div>
                        <div class="card-footer"></div>
                    </div> 
                    
                </div>
                
            </div>
        </div>
    </section>   
</main>
@endsection