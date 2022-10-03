@extends('layouts.backend.app')

@section('title')
<title>Testimonials | {{Auth::user()->role->name}}</title>
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
                            <h5 class="m-b-10">All testimonial</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="#!">Manage testimonials</a></li>
                            <li class="breadcrumb-item"><a href="#!">testimonial List</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('admin.testimonials.create')}}" class="btn btn-success" title="Back to List"><i class="feather icon-plus"></i> Add Testimonial</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        @include('layouts.backend.partials.alert')

        <!-- [ Main Content ] start --> 
        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table id="report-table" class="table table-sm table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="col-1">SR.No.</th> 
                                        <th>Name</th>
                                        <th>Avatar</th>
                                        <th>Country</th>
                                        <th>Stars</th>  
                                        <th class="col-1">Status</th> 
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($testimonials->count())
                                    @foreach($testimonials as $index => $testimonial)
                                    <tr>
                                        <td>{{$index+1}}.</td>
                                        <td>{{$testimonial->name}}</td>
                                        <td><img src="{{asset($testimonial->avatar)}}" width="20px"></td>
                                        <td>{{$testimonial->country}}</td>
                                        <td>
                                        	@foreach(range(1, $testimonial->stars) as $index)
			                                <i class="fas fa-star text-warning"></i>
			                                @endforeach
                                            @if($testimonial->stars != 5)
			                                @foreach(range(1, 5-$testimonial->stars) as $index)
			                                <i class="far fa-star text-warning"></i>
			                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($testimonial->status == 1)
                                            <a href="{{ route('admin.testimonials.deactivate', $testimonial->id) }}" class="btn btn-success font-weight-bold btn-xs btn-block has-ripple text-white">Active</a>
                                            @else
                                            <a href="{{ route('admin.testimonials.activate', $testimonial->id) }}" class="btn btn-danger font-weight-bold btn-xs btn-block has-ripple text-white">Not Verified</a>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-info btn-xs" title="Edit"><i class="feather icon-edit"></i></a>
                                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="feather icon-trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-gray"></div>
                </div>
            </div>
        </div> 
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection

@section('script')
<script>
    // DataTable start
    $('#report-table').DataTable();  
</script>
@endsection