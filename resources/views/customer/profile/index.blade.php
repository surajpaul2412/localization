@extends('layouts.frontend.customerapp')

@section('title')
<title>Profile | {{Auth::user()->name}}</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('backend/css/plugins/dropify.min.css')}}"> 
@endsection

@section('content')
<main>
    <!-- [ Top Breadcrubms ] start --> 
    <div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><h1 class="my-4 animated"> <span></span> Profile Info</h1></div>
                </div>
                <!-- End bs-wizard -->
            </div>
        </div>
    </div> 

    <!--[ Profile Detail ] start -->
    <section class="section dashboard-detail">
        <div class="container-fluid">
            <div class="row justify-content-center justify-content-between">
                <div class="col-lg-3 text-center d-none d-lg-block">
                    @include('layouts.frontend.partials.customerSidebar')
                </div>

                <div class="col-lg-9">
                    <div class="card border">
                        <form class="custom-form" method="post" action="{{ route('customer.profile.update', $user->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="card-header">
                                <h4 class="mb-0">Profile Information</h4> 
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <input name="avatar" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="{{asset($user->avatar)}}" />
                                            <input type="hidden" name="hidden_avatar" value="{{ $user->avatar }}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Full Name:</label>
                                                    <input type="text" id="name" class="form-control form-control-sm @error('email') is-invalid @enderror" Placeholder="Enter Name." required value="{{ $user->name }}" name="name" />
                                                    @error('name')
                                                        <div class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Email Id:</label>
                                                    <input type="email" class="form-control form-control-sm" Placeholder="Enter Email." required name="email" value="{{ $user->email }}" />
                                                    @error('email')
                                                        <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Contact Number:</label>
                                                    <input type="text" class="form-control form-control-sm" Placeholder="Enter Mobile Number." name="mobile" value="{{$user->mobile}}" />
                                                    @error('mobile')
                                                        <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>  
                                        </div>  
                                    </div>
                                </div>  
                            </div>  
                            <div class="card-footer"> 
                                <div class="row"> 
                                    <div class="col-sm-12 text-end">  
                                        <!-- <a href="users.php" class="btn btn-secondary">Back To List</a>   -->
                                        <button type="submit" class="btn btn-success btn-sm">Save Change</button>  
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script')
<!-- file-upload Js -->
<script src="{{asset('backend/js/plugins/dropify.min.js')}}"></script> 
<script>  
    $(document).ready(function(){ 
        $('.dropify').dropify(); 
    }); 
</script>
@endsection