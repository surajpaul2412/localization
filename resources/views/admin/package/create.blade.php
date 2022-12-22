@extends('layouts.backend.app')

@section('title')
<title>Add New Tour</title>
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
                            <h5 class="m-b-10">Add New Tour</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="{{route('admin.tours')}}">Manage Tours</a></li>
                            <li class="breadcrumb-item"><a href="">Add New Tour</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <a href="{{route('admin.tours')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->  
        <div class="row"> 
            <div class="col-sm-12">
                <div class="card"> 
                    <form class="custom-form" method="POST" action="{{ route('admin.tours.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header"></div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase has-ripple active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">General<span class="ripple ripple-animate"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase has-ripple" id="exp-tab" data-toggle="tab" href="#exp" role="tab" aria-controls="exp" aria-selected="false">Experience<span class="ripple ripple-animate"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase has-ripple" id="metadata-tab" data-toggle="tab" href="#metadata" role="tab" aria-controls="metadata" aria-selected="false">Meta Data<span class="ripple ripple-animate"></span></a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase has-ripple" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">Image Gallery<span class="ripple ripple-animate"></span></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">  
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">   
                                                <div class="col-md-6">
                                                    <div class="form-group">  
                                                        <label class="col-form-label">Tours Name<span>*</span></label>
                                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name..." name="name" value="{{ old('name') }}" onkeyup="slug_url(this.value,'init_slug')" required/>
                                                        @error('name')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>   
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">URL Slug<span>*</span></label>
                                                        <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" Placeholder="Enter Uniqe URL Slug." name="slug" value="{{ old('slug') }}" id="init_slug" required/>
                                                        @error('slug')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Adult Price<span>*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="adult_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{ old('adult_price') }}" required/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text input-group-text-sm py-0 px-2" id="basic-addon2">INR</span>
                                                            </div>
                                                        </div>
                                                        <small><b>Note: </b>Price/Adult</small>
                                                        @error('adult_price')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Child Price<span>*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="child_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{ old('child_price') }}" required/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text input-group-text-sm py-0 px-2" id="basic-addon2">INR</span>
                                                            </div>
                                                        </div>
                                                        <small><b>Note: </b>Price/Child</small>
                                                        @error('child_price')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Infant Price<span>*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="infant_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{ old('infant_price') }}" required/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text input-group-text-sm py-0 px-2" id="basic-addon2">INR</span>
                                                            </div>
                                                        </div>
                                                        <small><b>Note: </b>Price/Infant</small>
                                                        @error('infant_price')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Capacity<span>*</span></label>
                                                        <input type="number" name="capacity" class="form-control form-control-sm " placeholder="Eg: 1, 2, 3, 4 etc" value="{{ old('capacity') }}" required/>
                                                        @error('capacity')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">  
                                                        <label class="col-form-label">Duration<span>*</span></label>
                                                        <input type="text" name="duration" class="form-control form-control-sm " placeholder="Eg: 23.84944" value="{{ old('duration') }}" required/>
                                                        @error('duration')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Category<span>*</span></label>  
                                                        <select name="category" class="form-control form-control-sm js-example-basic-single" required>
                                                            <option>--Select Category--</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div> 
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="form-group">
                                                        <label class="col-form-label">Location<span>*</span></label>  
                                                        <select name="city" class="form-control form-control-sm js-example-basic-single" required>
                                                            <option>--Select Location--</option>
                                                            @foreach($countries as $country)
                                                            <optgroup label="{{$country->name}}">
                                                                @foreach($country->cities as $city)
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            @endforeach
                                                        </select>
                                                        @error('city')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Activity<span>*</span></label>  
                                                        <select name="activity" class="form-control form-control-sm js-example-basic-single" required>
                                                            <option>--Select Activity--</option>
                                                            @foreach($activities as $activity)
                                                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('activity')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div> 
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Includes Amenities</label>  
                                                        <select name="amenity[]" class="form-control form-control-sm js-example-basic-multiple" multiple="multiple" required>
                                                            <option disabled>--Select multiple--</option>
                                                            @foreach($amenities as $amenity)
                                                            <option value="{{$amenity->id}}">{{$amenity->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('amenity')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Icon Image:</label>
                                                        <input name="icon" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="" />
                                                        @error('icon')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>  
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Profile Image:</label>
                                                        <input name="avatar" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="" />
                                                        @error('avatar')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Description:</label> 
                                                        <textarea class="@error('description') is-invalid @enderror" name="description" id="editor1"></textarea>
                                                        @error('description')
                                                            <div class="text-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                        @enderror
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="metadata" role="tabpanel" aria-labelledby="metadata-tab"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Title:</label>
                                                <input type="text" class="form-control form-control-sm @error('meta_title') is-invalid @enderror" name="meta_title" value="{{old('meta_title')}}" placeholder="" />
                                                @error('meta_title')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>   
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Keywords:</label>
                                                <textarea class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder=""></textarea>
                                                @error('meta_keywords')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>    
                                        <div class="col-md-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Meta Description:</label>
                                                <textarea class="form-control form-control-sm @error('meta_description') is-invalid @enderror" name="meta_description" placeholder=""></textarea>
                                                @error('meta_description')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div> 
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Multiple Images (Use Ctrl button)</label>
                                                <input type="file" id="input-file-now" name="images[]" class="dropify1" multiple/>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="upload-image border">
                                                        <img class="img-fluid" src="https://cake4ever.in/uploads/product/0d70e5826e25604c475528971b7d022c.jpg" />
                                                        <button type="button" class="btn btn-danger btn-block btn-sm rounded-0">Remove Image</button> 
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <div class="upload-image border">
                                                        <img class="img-fluid" src="https://cake4ever.in/uploads/product/0d70e5826e25604c475528971b7d022c.jpg" />
                                                        <button type="button" class="btn btn-danger btn-block btn-sm rounded-0">Remove Image</button> 
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <div class="upload-image border">
                                                        <img class="img-fluid" src="https://cake4ever.in/uploads/product/0d70e5826e25604c475528971b7d022c.jpg" />
                                                        <button type="button" class="btn btn-danger btn-block btn-sm rounded-0">Remove Image</button> 
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <div class="upload-image border">
                                                        <img class="img-fluid" src="https://cake4ever.in/uploads/product/0d70e5826e25604c475528971b7d022c.jpg" />
                                                        <button type="button" class="btn btn-danger btn-block btn-sm rounded-0">Remove Image</button> 
                                                    </div>
                                                </div>  
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="exp" role="tabpanel" aria-labelledby="exp-tab">
                                    <div class="row">  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Highlights:</label> 
                                                <textarea class="@error('highlights') is-invalid @enderror" name="highlights" id="editor2"></textarea>
                                                @error('highlights')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Full description:</label> 
                                                <textarea class="@error('full_description') is-invalid @enderror" name="full_description" id="editor3"></textarea>
                                                @error('full_description')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Includes:</label> 
                                                <textarea class="@error('includes') is-invalid @enderror" name="includes" id="editor4"></textarea>
                                                @error('includes')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Meeting point:</label> 
                                                <textarea class="@error('meeting_point') is-invalid @enderror" name="meeting_point" id="editor6"></textarea>
                                                @error('meeting_point')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Important information:</label> 
                                                <textarea class="@error('important_information') is-invalid @enderror" name="important_information" id="editor7"></textarea>
                                                @error('important_information')
                                                    <div class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div> 
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between"> 
                            <div class="seal-box"> 
                                <div class="form-group m-0">
                                    <div class="switch switch-success d-inline m-r-10">
                                        <input type="checkbox" id="switch-s-1" class="form-control form-control-sm setmin_charge" name="seal">  
                                        <label for="switch-s-1" class="cr"></label>
                                    </div>
                                    <label class="col-form-label">Seal</label>
                                </div>
                            </div> 
                            <div class="action">     
                                <button type="" class="btn btn-warning">Cancel</button>
                                <button type="submit" class="btn btn-success m-0">Submit</button>
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
        $('.dropify1').dropify();
    }); 
</script>
@endsection
