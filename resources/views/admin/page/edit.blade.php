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
                    <form class="custom-form">

                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">   
                                <div class="col-sm-6">
                                    <div class="form-group fill">  
                                        <label class="control-label">Page Name<span>*</span></label>
                                        <input type="text" class="form-control form-control-sm " placeholder="Enter Category Name..." required/> 
                                    </div>
                                </div>   
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">URL Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" Placeholder="Enter Uniqe URL Slug."  required/>
                                    </div>
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Description:</label> 
                                        <textarea name="description" id="editor1"></textarea> 
                                    </div> 
                                </div>  
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Meta Title:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="" />
                                    </div> 
                                </div>   
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label class="col-form-label">Meta Keywords:</label>
                                        <textarea class="form-control form-control-sm" placeholder=""></textarea>  
                                    </div> 
                                </div>    
                                <div class="col-sm-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Meta Description:</label>
                                        <textarea class="form-control form-control-sm" placeholder=""></textarea> 
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