@extends('layouts.frontend.customerapp')

@section('title')
<title>Address Edit | {{$address->name}}</title>
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
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> Edit address </h1></div>
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
                    <form class="custom-form" method="post" action="{{ route('customer.address.update', $address->id) }}">
                    @method('PATCH')
                    @csrf
                        <div class="card border"> 
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Edit Address</h4>
                                    <a class="btn btn-success btn-sm" href="{{route('customer.address')}}">Back to Address List</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('layouts.backend.partials.alert')
                                
                                <div class="row">   
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="text-dark ft-medium">Full Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="First Name..." value="{{$address->name}}" required>
                                            @error('name')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="text-dark ft-medium">Email ID *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email..." value="{{$address->email}}" required>
                                            @error('email')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="text-dark ft-medium">Mobile Number *</label>
                                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Mobile number..." value="{{ $address->mobile }}" required>
                                            @error('mobile')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group fill">  
                                            <label class="control-label">Country<span>*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" placeholder="Enter country..." name="country" value="{{ $address->country }}" required/>
                                            @error('country')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group fill">  
                                            <label class="control-label">City<span>*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" placeholder="Enter city..." name="city" value="{{ $address->city }}" required/>
                                            @error('city')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group fill">  
                                            <label class="control-label">Pincode<span>*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" placeholder="Enter pincode..." name="pincode" value="{{ $address->pincode }}" required/>
                                            @error('pincode')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group fill">  
                                            <label class="control-label">Address<span>*</span></label>
                                            <textarea class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" required>{{$address->address}}</textarea>
                                            @error('address')
                                                <div class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <div class="form-group mb-3 form-check">
                                                <input type="checkbox" name="default" class="form-check-input" id="exampleCheck1" @if($address->default == 1) checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Mark as Default</label>
                                            </div>
                                        </div>
                                </div>  
                                    
                            </div>
                            <div class="card-footer text-end">
                                <button type="" class="btn btn-danger">Cancel</button>
                                <button type="submit" class="btn btn-success m-0">Submit</button>
                            </div>
                        </div> 
                    </form> 
                    
                </div>
            </div>
        </div>
    </section>   
</main>
@endsection
