@extends('layouts.backend.app')

@section('title')
<title>Language</title>
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
                            <li class="breadcrumb-item"><a href="{{route('admin.razorpay')}}">Manage Language</a></li>
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
                    <form class="custom-form" method="POST" action="{{ route('admin.language.update') }}">
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">   
                                <div class="col-sm-12">
                                    <div class="form-group fill">  
                                        <label class="control-label">Primary Language<span>*</span></label>
                                        <select name="language" class="form-control">
                                            @foreach(Config::get('languages') as $lang)
                                            <option>{{$lang['display']}}</option>
                                            @endforeach
                                        </select>
                                        @error('language')
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
