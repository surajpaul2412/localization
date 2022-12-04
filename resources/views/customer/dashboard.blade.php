@extends('layouts.frontend.customerapp')

@section('title')
<title>Dashboard | {{Auth::user()->name}}</title>
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
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> Dashboard</h1></div>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <h3 class="mb-0">My Dashboard</h3>
                            <hr class="mt-1">
                        </div> 
                    </div>
                    
                    <div class="row">
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>   
</main>
@endsection