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
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> {{dynamicLang('My Address')}}</h1></div>
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
                                <h3 class="mb-0">{{dynamicLang('My Address')}}</h3>
                                <a class="btn btn-success btn-sm" href="{{route('customer.address.create')}}">{{dynamicLang('Add address')}}</a>
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
                                                    <label class="radio-custom-label">{{dynamicLang('Address')}}-{{$index+1}}</label>
                                                </h4>
                                                @if($address->default == 1) 
                                                <p class="m-0 p-0"><span class="text-success bg-success bg-opacity-25 small px-2 py-1 rounded">Default</span></p>
                                                @else
                                                <p class="m-0 p-0"><a href="{{ route('customer.address.default', $address->id) }}" class="text-primary bg-primary bg-opacity-25 small px-2 py-1 rounded">Saved</a></p> 
                                                @endif 
                                            </div>
                                            <div class="card-head-last-flex">
                                                <!-- Button -->
                                                <a class="border p-3 circle text-dark d-inline-flex align-items-center justify-content-center" href="{{ route('customer.address.edit', $address->id) }}"><i class="fas fa-pen-nib position-absolute"></i></a>
                                                <!-- Button -->
                                                <form class="d-inline-flex align-items-center justify-content-center" method="POST" action="{{ route('customer.address.destroy', $address->id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="border bg-white text-danger p-3 circle text-dark d-inline-flex align-items-center justify-content-center"><i class="fas fa-times position-absolute"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-wrap-body px-3 py-3"> 
                                            <p class="m-0"><strong>{{dynamicLang('Name')}}:</strong> {{$address->name}}</p>
                                            <p class="m-0"><strong>{{dynamicLang('Address')}}:</strong> {{$address->address}}, {{$address->city}}, {{$address->country}} -- {{$address->pincode}}</p>
                                            <p class="m-0"><strong>{{dynamicLang('Email')}}:</strong> {{$address->email}}</p>
                                            <p class="m-0"><strong>{{dynamicLang('Call')}}:</strong> {{$address->mobile}}</p>
                                        </div>
                                    </div>
                                </div> 

                                @endforeach
                                @else
                                <div class="col-12">
                                    <div>{{dynamicLang('No Saved Address in your Account')}}.</div>
                                </div> 
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