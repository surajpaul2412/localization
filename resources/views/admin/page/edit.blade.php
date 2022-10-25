@extends('layouts.backend.app')

@section('title')
<title>Pages Edit | {{$page->name}}</title>
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
                            <li class="breadcrumb-item"><a href="#!">Manage Pages</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit Page</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="pages.php" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
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
                    <form class="custom-form" method="post" action="{{ route('admin.pages.update', $page->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">   
                                <div class="col-sm-6">
                                    <div class="form-group fill">  
                                        <label class="control-label">Page Name<span>*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name..." name="name" value="{{ $page->name }}" onkeyup="slug_url(this.value,'init_slug')" required/>
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
                                        <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" Placeholder="Enter Uniqe URL Slug." name="slug" id="init_slug" value="{{ $page->slug }}"  required/>
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
                                        <textarea name="description" class="@error('description') is-invalid @enderror" id="editor1">{{$page->description}}</textarea>
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
                                        <input type="text" class="form-control form-control-sm @error('meta_title') is-invalid @enderror" name="meta_title" value="{{$page->meta_title}}" placeholder="" />
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
                                        <textarea class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="">{{$page->meta_keywords}}</textarea>
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
                                        <textarea class="form-control form-control-sm @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="">{{$page->meta_description}}</textarea>
                                        @error('meta_description')
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

@section('script')
<script>  
    $(document).ready(function(){ 
        $('.dropify').dropify(); 
    }); 
</script>
@endsection