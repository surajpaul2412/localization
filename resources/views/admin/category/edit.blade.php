@extends('layouts.backend.app')

@section('title')
<title>Category Edit | {{$category->name}}</title>
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
                            <li class="breadcrumb-item"><a href="#!">Manage Category</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit Category</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('admin.category')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
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
                    <form class="custom-form" method="post" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">   
                                        <div class="col-sm-6">
                                            <div class="form-group fill">  
                                                <label class="control-label">Category Name<span>*</span></label>
                                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name..." name="name" value="{{$category->name}}" required/>
                                                @error('name')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>   
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">URL Slug<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" Placeholder="Enter Uniqe URL Slug." name="slug" value="{{ $category->slug }}"  required/>
                                                @error('slug')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description:</label> 
                                                <textarea class="@error('description') is-invalid @enderror" name="description" id="editor1">{{$category->description}}</textarea>
                                                @error('description')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>  
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Title:</label>
                                                <input type="text" class="form-control form-control-sm @error('meta_title') is-invalid @enderror" name="meta_title" value="{{$category->meta_title}}" placeholder="" />
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
                                                <textarea class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="">{{$category->meta_keywords}}</textarea>
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
                                                <textarea class="form-control form-control-sm @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="">{{$category->meta_description}}</textarea>
                                                @error('meta_description')
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
                                                <label class="col-form-label">Icon Image:</label>
                                                <input name="icon" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="{{asset($category->icon)}}" />
                                                <input type="hidden" name="hidden_icon" value="{{ $category->icon }}">
                                            </div>
                                        </div> 
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Profile Image:</label>
                                                <input name="avatar" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify1" data-max-file-size="2M" data-default-file="{{asset($category->avatar)}}" />
                                                <input type="hidden" name="hidden_avatar" value="{{ $category->avatar }}">
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
