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
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <h3 class="mb-0">My Address</h3>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12" align="right">
                            <a class="btn btn-primary" href="{{route('customer.address.create')}}">Add address</a>
                        </div> 
                    </div>

                    @include('layouts.backend.partials.alert')
                    
                    <div class="row">
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
                    </div> 
                    
                </div>
                
            </div>
        </div>
    </section>   
</main>
@endsection