@extends('layouts.backend.app')

@section('title')
<title>Razorpay</title>
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
                            <h5 class="m-b-10">Edit Page</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('admin.razorpay')}}">Manage Razorpay</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card"> 
                    <div class="col-sm-12">
                        <h5 class="mt-4">Contact Details</h5>
                    </div>
                    <form class="custom-form" method="post" action="{{ route('admin.setting.update', $cred->id) }}"> 
                        @method('PATCH')
                        @csrf 
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email:</label>
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Enter key..." name="email" value="{{$cred->email}}" required/>
                                        @error('email')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>   
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone:</label>
                                        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="Enter key..." name="phone" value="{{$cred->phone}}" required/>
                                        @error('phone')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>   
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Address:</label>
                                        <textarea class="form-control form-control-sm" Placeholder="Eg: you can add address with pincode.">{{$cred->address}}</textarea>
                                    </div>
                                </div>  
                            </div> 
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="mt-4">Social Link</h5>
                                    <hr class="mt-0">
                                </div>   
                                <div class="col-sm-12">
                                    <div class="form-group col-sm-6"> 
                                        <input type="text" class="form-control form-control-sm @error('facebook') is-invalid @enderror" name="facebook" value="{{$cred->facebook}}" placeholder="Facebook Link..." />
                                        @error('facebook')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror 
                                    </div>
                                    <div class="form-group col-sm-6">  
                                        <input type="text" class="form-control form-control-sm @error('twitter') is-invalid @enderror" name="twitter" value="{{$cred->twitter}}" placeholder="Twitter Link..." />
                                        @error('twitter')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror 
                                    </div>
                                    <div class="form-group col-sm-6">  
                                        <input type="text" class="form-control form-control-sm @error('instagram') is-invalid @enderror" name="instagram" value="{{$cred->instagram}}" placeholder="Instagram Link..." />
                                        @error('instagram')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror  
                                    </div>
                                    <div class="form-group col-sm-6">  
                                        <input type="text" class="form-control form-control-sm @error('linkedin') is-invalid @enderror" name="linkedin" value="{{$cred->linkedin}}" placeholder="Linkedin Link..." />
                                        @error('linkedin')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>   
                            </div>   

                            <div class="row">  
                                <div class="col-sm-12 text-right"> 
                                    <button type="submit" class="btn btn-success">Save Change</button> 
                                </div>   
                            </div>
                        </div> 
                    </form>
                </div>
            </div> 
        </div>  
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
