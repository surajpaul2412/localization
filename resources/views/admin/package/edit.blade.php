@extends('layouts.backend.app')

@section('title')
<title>Tour Edit</title>
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
                            <h5 class="m-b-10">Edit Tour</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="#!">Manage Tour</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit Tour</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <a href="{{route('admin.tours')}}" class="btn btn-success" title="Back to List"><i class="fas fa-reply-all"></i> Back to list</a> 
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
                    <form class="custom-form" method="POST" action="{{ route('admin.tours.update', $package->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
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
                                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name..." name="name" value="{{ $package->name }}" onkeyup="slug_url(this.value,'init_slug')" required/>
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
                                                        <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" Placeholder="Enter Uniqe URL Slug." name="slug" value="{{$package->slug}}" id="init_slug" required/>
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
                                                            <input type="text" name="adult_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{$package->adult_price}}" required/>
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
                                                            <input type="text" name="child_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{$package->child_price}}" required/>
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
                                                            <input type="text" name="infant_price" class="form-control form-control-sm" placeholder="Eg: 100, 200, 500 etc" value="{{$package->infant_price}}" required/>
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
                                                        <input type="text" name="capacity" class="form-control form-control-sm " placeholder="Eg: 1, 2, 3, 4 etc" value="{{$package->capacity}}" required/>
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
                                                        <input type="text" name="duration" class="form-control form-control-sm " placeholder="Eg: 23.84944" value="{{$package->duration}}" required/>
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
                                                            <option value="{{$category->id}}" {{ $category->id == $package->category->id ? 'selected' : '' }}>{{$category->name}}</option>
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
                                                                <option value="{{$city->id}}" {{ $city->id == $package->city->id ? 'selected' : '' }}>{{$city->name}}</option>
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
                                                            <option value="{{$activity->id}}" {{ $activity->id == $package->activity->id ? 'selected' : '' }}>{{$activity->name}}</option>
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
                                                            <option value="{{$amenity->id}}" 
                                                                @foreach($package->amenities as $row)
                                                                    {{ $amenity->id == $row->amenity_id ? 'selected' : '' }}
                                                                @endforeach>{{$amenity->name}}</option>
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
                                                        <input name="icon" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="{{asset($package->icon)}}" />
                                                        <input type="hidden" name="hidden_icon" value="{{ $package->icon }}">
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
                                                        <input name="avatar" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="{{asset($package->avatar)}}" />
                                                        <input type="hidden" name="hidden_avatar" value="{{ $package->avatar }}">
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
                                                        <textarea class="@error('description') is-invalid @enderror" name="description" id="editor1">{{$package->description}}</textarea>
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
                                                <input type="text" class="form-control form-control-sm @error('meta_title') is-invalid @enderror" name="meta_title" value="{{$package->meta_title}}" placeholder="" />
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
                                                <textarea class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror" name="meta_keywords" placeholder="">{{$package->meta_keywords}}</textarea>
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
                                                <textarea class="form-control form-control-sm @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="">{{$package->meta_description}}</textarea>
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
                                        @foreach($package->gallery as $index => $gallery)
                                        <div class="col-md-2">
                                            <div id="image{{$index}}" class="p-3">
                                                <img src="{{asset($gallery->image)}}" width="100%">
                                                <input type="hidden" name="gallery_images[]" value="{{$gallery->image}}">
                                                <a class="removeImage{{$index}} btn btn-danger w-100">Remove</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="exp" role="tabpanel" aria-labelledby="exp-tab">
                                    <div class="row">  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Highlights:</label> 
                                                <textarea class="@error('highlights') is-invalid @enderror" name="highlights" id="editor2">{{$package->highlights}}</textarea>
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
                                                <textarea class="@error('full_description') is-invalid @enderror" name="full_description" id="editor3">{{$package->full_description}}</textarea>
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
                                                <textarea class="@error('includes') is-invalid @enderror" name="includes" id="editor4">{{$package->includes}}</textarea>
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
                                                <textarea class="@error('meeting_point') is-invalid @enderror" name="meeting_point" id="editor6">{{$package->meeting_point}}</textarea>
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
                                                <textarea class="@error('important_information') is-invalid @enderror" name="important_information" id="editor7">{{$package->important_information}}</textarea>
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

@foreach($package->gallery as $index => $gallery)
<script>
    $(document).ready(function(){
        $(".removeImage{{$index}}").click(function(){
            $("#image{{$index}}").remove();
        });
    });
</script>
@endforeach
@endsection
