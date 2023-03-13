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
                    <!-- <div class="col-sm-12">
                        <h5 class="mt-4">Contact Details</h5>
                    </div> -->
                    <form class="custom-form" method="post" action="{{ route('admin.setting.update', $cred->id) }}"> 
                        @method('PATCH')
                        @csrf 
                        <!-- <div class="card-header"></div> -->
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">General</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase " id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact infomation</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">  
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="mt-4">Contact Email:</h5>
                                            <hr class="mt-0">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group fill">
                                                <label class="col-form-label">System Email:</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$cred->sys_email}}" spellcheck="false" name="sys_email" data-ms-editor="true">
                                                @error('sys_email')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="mt-4">Home Meta details:</h5>
                                            <hr class="mt-0">
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Title:</label>
                                                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="meta_title" value="{{$cred->meta_title}}" placeholder="" /> 
                                                @error('meta_title')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>   
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Keywords:</label>
                                                <textarea class="form-control form-control-sm" name="meta_keywords" placeholder="">{{$cred->meta_keywords}}</textarea> 
                                                @error('meta_keywords')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>    
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Description:</label>
                                                <textarea class="form-control form-control-sm" name="meta_description" placeholder="">{{$cred->meta_description}}</textarea> 
                                                @error('meta_description')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                                 
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                                                <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{$cred->phone}}"/>
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
                                                <textarea class="form-control form-control-sm" name="address">{{$cred->address}}</textarea>
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
                                </div> 
                            </div> 
                              

                            <div class="row">  
                                <div class="col-sm-12 text-right"> 
                                    
                                </div>   
                            </div>
                        </div> 
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Save Change</button> 
                        </div>
                    </form>
                </div>
            </div> 
        </div>  
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
