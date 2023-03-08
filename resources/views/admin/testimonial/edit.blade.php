@extends('layouts.backend.app')

@section('title')
<title>Testimonial Edit | {{$testimonial->name}}</title>
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
                            <h5 class="m-b-10">Edit Testimonial</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('admin.testimonials')}}">Manage Testimonial</a></li>
                            <li class="breadcrumb-item"><a href="">Edit Testimonial</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('admin.testimonials')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card"> 
                    <form class="custom-form" method="post" action="{{ route('admin.testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group fill">  
                                                <label class="control-label">Name<span>*</span></label>
                                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name..." name="name" value="{{ $testimonial->name }}" required/>
                                                @error('name')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>   
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="col-form-label">Country<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" Placeholder="Enter your country." name="country" value="{{ $testimonial->country }}"  required/>
                                                @error('country')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-form-label">Star<span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm" name="stars">
                                                    <option value="1" {{ $testimonial->stars == '1' ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ $testimonial->stars == '2' ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ $testimonial->stars == '3' ? 'selected' : '' }}>3</option>
                                                    <option value="4" {{ $testimonial->stars == '4' ? 'selected' : '' }}>4</option>
                                                    <option value="5" {{ $testimonial->stars == '5' ? 'selected' : '' }}>5</option>
                                                </select>
                                                @error('stars')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description:</label> 
                                                <textarea class="@error('description') is-invalid @enderror" name="description" id="editor1">
                                                    {{$testimonial->description}}
                                                </textarea>
                                                @error('description')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                    </div>
                                </div>  

                                <div class="col-lg-4">
                                    <div class="row"> 
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Upload Avatar<span class="text-danger">*</span></label>
                                                <input name="avatar" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="{{asset($testimonial->avatar)}}" />
                                                <input type="hidden" name="hidden_avatar" value="{{ $testimonial->avatar }}">
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
    }); 
</script>
@endsection