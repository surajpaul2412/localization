@extends('layouts.backend.app')

@section('title')
<title>Review | {{Auth::user()->role->name}}</title>
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
                            <h5 class="m-b-10">All review</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="">Manage review</a></li>
                            <li class="breadcrumb-item"><a href="">All review</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

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
                                        <th class="col-1">Sr.No.</th>
                                        <th>Reviewer Name</th>
                                        <th>Tour</th>
                                        <th>Comment</th>
                                        <th>Stars</th>
                                        <th class="col-1">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if($reviews->count())
                                    @foreach($reviews as $index => $review)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td class="text-wrap">{{$review->user->name}}</td>
                                        <td class="text-wrap">{{$review->package->name}}</td>
                                        <td class="text-wrap">{{$review->content}}</td>
                                        <td class="text-wrap">{{$review->stars}}</td>
                                        <td>
                                            @if($review->status == 1)
                                            <a href="{{ route('admin.review.deactivate', $review->id) }}" class="btn btn-success font-weight-bold btn-xs btn-block has-ripple text-white">Enabled</a>
                                            @else
                                            <a href="{{ route('admin.review.activate', $review->id) }}" class="btn btn-danger font-weight-bold btn-xs btn-block has-ripple text-white">Disabled</a>
                                            @endif
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