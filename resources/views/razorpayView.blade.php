@extends('layouts.frontend.app')
@section('title')
<title>Payment | GetBeds</title>
@endsection

@section('content') 
    <main>
        <div class="hero_in cart_section" style="background: #0295a9 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
            <div class="wrapper">
                <div class="container">
                    <div class="bs-wizard clearfix">
                        <div class="bs-wizard-step disabled">
                            <div class="text-center bs-wizard-stepnum">Your cart</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="{{route('cart')}}" class="bs-wizard-dot"></a>
                        </div>

                        <div class="bs-wizard-step active">
                            <div class="text-center bs-wizard-stepnum">Payment</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#0" class="bs-wizard-dot"></a>
                        </div>

                        <div class="bs-wizard-step disabled">
                            <div class="text-center bs-wizard-stepnum">Finish!</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="#0" class="bs-wizard-dot"></a>
                        </div>
                    </div>
                    <!-- End bs-wizard -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3 col-md-offset-6">

                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif

                    <div class="card card-default">

                        <div class="card-body text-center">
                            <form action="{{ route('razorpay.payment.store') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ env('RAZORPAY_KEY') }}"
                                        data-amount="1000"
                                        data-buttontext="payment"
                                        data-name="GetBeds"
                                        data-description="Rozerpay"
                                        data-image="http://getbeds.starklikes.com/images/logo.png"
                                        data-prefill.name="name"
                                        data-prefill.email="email"
                                        data-theme.color="#ff7529">
                                </script>
                                
                                <input name="radio_address" value="{{$data['radio_address']??null}}">
                                <input name="email" value="{{$data['email']}}">
                                <input name="name" value="{{$data['name']}}">
                                <input name="mobile" value="{{$data['mobile']}}">
                                <input name="country" value="{{$data['country']}}">
                                <input name="city" value="{{$data['city']}}">
                                <input name="pincode" value="{{$data['pincode']}}">
                                <input name="address" value="{{$data['address']}}">
                                <input name="tax" value="{{$data['tax']}}">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection