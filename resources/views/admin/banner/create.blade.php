@extends('layouts.backend.app')

@section('title')
<title>Banner Create</title>
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
                            <h5 class="m-b-10">Create Slider</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('admin.banner')}}">Manage Slider</a></li>
                            <li class="breadcrumb-item"><a href="">Create Slider</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <a href="{{route('admin.banner')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end --> 

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card"> 
                    <form class="custom-form" method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">   
                                        <div class="col-sm-12">
                                            <div class="form-group fill">  
                                                <label class="control-label">Slider Heading</label>
                                                <input type="text" class="form-control form-control-sm @error('heading') is-invalid @enderror" placeholder="Enter heading..." name="heading" value="{{ old('heading') }}" onkeyup="slug_url(this.value,'init_slug')"/>
                                                @error('heading')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <div class="form-group fill">  
                                                <label class="control-label">Slider content</label>
                                                <textarea class="form-control form-control-sm @error('content') is-invalid @enderror" placeholder="Enter content..." name="content" value="{{ old('content') }}" onkeyup="slug_url(this.value,'init_slug')" id="editor1"></textarea> 
                                                @error('content')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Desktop Banner<span>*</span>:</label>
                                                <input name="image" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="12M" data-default-file="" />
                                                <small class="text-muted"><b>Eg::</b> Upload icon size - 1920px*750px. </small>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Mobile Banner<span>*</span>:</label>
                                                <input name="mobile" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify1" data-max-file-size="12M" data-default-file="" />
                                                <small class="text-muted"><b>Eg::</b> Upload icon size - 800px*800px. </small>
                                            </div>
                                        </div> 
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

@section('script')
<script>  
    $(document).ready(function(){ 
        $('.dropify').dropify(); 
        $('.dropify1').dropify(); 
    }); 
</script>
@endsection
