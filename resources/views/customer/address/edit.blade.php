@extends('layouts.backend.app')

@section('title')
<title>Address Edit | {{$address->name}}</title>
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
                            <li class="breadcrumb-item"><a href="{{route('customer.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('customer.address')}}">Manage address</a></li>
                            <li class="breadcrumb-item"><a href="">Edit address</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('customer.address')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        @include('layouts.backend.partials.alert')

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card"> 
                    <form class="custom-form" method="post" action="{{ route('customer.address.update', $address->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">   
                                <div class="col-sm-12">
                                    <div class="form-group fill">  
                                        <label class="control-label">Country<span>*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" placeholder="Enter country..." name="country" value="{{ $address->country }}" required/>
                                        @error('country')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group fill mt-3">  
                                        <label class="control-label">City<span>*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" placeholder="Enter city..." name="city" value="{{ $address->city }}" required/>
                                        @error('city')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group fill mt-3">  
                                        <label class="control-label">Pincode<span>*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" placeholder="Enter pincode..." name="pincode" value="{{ $address->pincode }}" required/>
                                        @error('pincode')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group fill mt-3">  
                                        <label class="control-label">Address<span>*</span></label>
                                        <textarea class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" required>{{$address->address}}</textarea>
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
                            <button type="" class="btn btn-warning">Cancel</button>
                            <button type="submit" class="btn btn-success m-0">Submit</button>
                        </div>  
                        
                    </form>  
                </div>
            </div> 
        </div>  
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
