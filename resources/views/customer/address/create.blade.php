@extends('layouts.frontend.customerapp')

@section('title')
<title>Add address</title>
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
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> Add address </h1></div>
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
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <h3 class="mb-0">Add address</h3>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12" align="right">
                            <a class="btn btn-primary" href="{{route('customer.address')}}">Back</a>
                        </div> 
                    </div>

                    @include('layouts.backend.partials.alert')
                    
                    <div class="row">
                        <div class="col-lg-12">  
                            <div class="card"> 
                                <form class="custom-form" method="POST" action="{{ route('customer.address.store') }}">
                                    @csrf
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <div class="row">   
                                            <div class="col-sm-12">
                                                <div class="form-group fill">  
                                                    <label class="control-label">Country<span>*</span></label>
                                                    <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" placeholder="Enter country..." name="country" value="{{ old('country') }}" required/>
                                                    @error('country')
                                                        <div class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group fill mt-3">  
                                                    <label class="control-label">City<span>*</span></label>
                                                    <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" placeholder="Enter city..." name="city" value="{{ old('city') }}" required/>
                                                    @error('city')
                                                        <div class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group fill mt-3">  
                                                    <label class="control-label">Pincode<span>*</span></label>
                                                    <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" placeholder="Enter pincode..." name="pincode" value="{{ old('pincode') }}" required/>
                                                    @error('pincode')
                                                        <div class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group fill mt-3">  
                                                    <label class="control-label">Address<span>*</span></label>
                                                    <textarea class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required></textarea>
                                                    @error('address')
                                                        <div class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>  
                                    </div>  
                                    <div class="card-footer text-right"> 
                                        <button type="" class="btn btn-danger">Cancel</button>
                                        <button type="submit" class="btn btn-success m-0">Submit</button>
                                    </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
</main>
@endsection
