@extends('layouts.backend.app')

@section('title')
<title>Profile | {{Auth::user()->role->name}}</title>
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
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Profile</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li> 
                            <li class="breadcrumb-item"><a href="">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- @include('layouts.backend.partials.alert') -->

        <!-- [ Main Content ] start --> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="card">
                    <form class="custom-form" method="post" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data">
                    	@method('PATCH')
                    	@csrf
                        <div class="card-header"></div>
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
                                        <div class="col-sm-12">
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
                                        <div class="col-sm-12">
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
                                <div class="col-sm-12 text-right">  
                                    <!-- <a href="users.php" class="btn btn-secondary">Back To List</a>   -->
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

@section('script')
<script>  
    $(document).ready(function(){ 
        $('.dropify').dropify(); 
    }); 
</script>
@endsection