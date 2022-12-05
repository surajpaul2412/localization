@extends('layouts.frontend.customerapp')

@section('title')
<title>Address | {{Auth::user()->role->name}}</title>
@endsection

@section('css')
@endsection

@section('content')
<main>
    <!-- [ Top Breadcrubms ] start -->  
    <div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> My Address</h1></div>
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
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-0">My Address</h3>
                                <a class="btn btn-success btn-sm" href="{{route('customer.address.create')}}">Add address</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('layouts.backend.partials.alert')
                            <div class="row row-cols-1 row-cols-lg-2">

                                @if($address->count())
                                @foreach($address as $index => $address)
							
                                <!-- Single -->
                                <div class="col">
                                    <div class="card-wrap border rounded mb-4">
                                        <div class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                                            <div class="card-header-flex d-flex align-items-center">  
                                                <h4 class="fs-md ft-bold mb-0 me-1"> 
                                                    <label class="radio-custom-label">Address-{{$index+1}}</label>
                                                </h4>
                                                @if($address->default == 1) 
                                                <p class="m-0 p-0"><span class="text-success bg-success bg-opacity-25 small px-2 py-1 rounded">Default</span></p>
                                                @else
                                                <p class="m-0 p-0"><a href="{{ route('customer.address.default', $address->id) }}" class="text-primary bg-primary bg-opacity-25 small px-2 py-1 rounded">Saved</a></p> 
                                                @endif 
                                            </div>
                                            <div class="card-head-last-flex">
                                                <!-- Button -->
                                                <a class="border p-3 circle text-dark d-inline-flex align-items-center justify-content-center" href="edit-account-address.html"><i class="fas fa-pen-nib position-absolute"></i></a>
                                                <!-- Button -->
                                                <button class="border bg-white text-danger p-3 circle text-dark d-inline-flex align-items-center justify-content-center"><i class="fas fa-times position-absolute"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-wrap-body px-3 py-3"> 
                                            <h5 class="ft-medium mb-1">Henry V. Derr</h5>
                                            <p>{{$address->country}}, {{$address->city}}, {{$address->country}} - {{$address->pincode}}</p>
                                            <p class="lh-1"><strong>Email:</strong> dhananjaypreet@gmail.com</p>
                                            <p><strong>Call:</strong> +91 458 753 6924</p>
                                        </div>
                                    </div>
                                </div> 

                                @endforeach
                                <!-- Single -->
                                <div class="col-1">
                                    <div>No Saved Address in your Account.</div>
                                </div> 
                                @endif
                                
                            </div>

                            <!-- <div class="row">
                                <div class="col-lg-12">  
                                    <div class="card">
                                        <div class="card-header"></div>
                                        <div class="card-body"> 
                                            <div class="table-responsive">
                                                <table id="report-table" class="table table-sm table-bordered table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-1">Sr.No.</th>
                                                            <th>Country</th>   
                                                            <th>City</th>
                                                            <th>Pincode</th>
                                                            <th>Address</th>
                                                            <th class="col-1">Default</th>
                                                            <th class="col-1">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($address->count())
                                                        @foreach($address as $index => $address)
                                                        <tr>
                                                            <td>{{$index+1}}</td>
                                                            <td class="text-wrap">{{$address->country}}</td>
                                                            <td class="text-wrap">{{$address->city}}</td>
                                                            <td class="text-wrap">{{$address->pincode}}</td>
                                                            <td class="text-wrap">{{$address->address}}</td>
                                                            <td>
                                                                @if($address->default == 1)
                                                                <a class="btn btn-success font-weight-bold btn-xs btn-block has-ripple text-white">Default</a>
                                                                @else
                                                                <a href="{{ route('customer.address.default', $address->id) }}" class="btn btn-info font-weight-bold btn-xs btn-block has-ripple text-white">Saved</a>
                                                                @endif
                                                            </td>
                                                            <td class="d-flex">  
                                                                <a href="{{ route('customer.address.edit', $address->id) }}" class="btn btn-info btn-xs" title="Edit"><i class="feather icon-edit"></i></a>
                                                                <form method="POST" action="{{ route('customer.address.destroy', $address->id) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="feather icon-trash-2"></i></button>
                                                                </form>
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
                            </div> -->

                        </div>
                        <div class="card-footer"></div>
                    </div>  
                    
                </div>
                
            </div>
        </div>
    </section>   
</main>
@endsection