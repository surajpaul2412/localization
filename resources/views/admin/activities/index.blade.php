@extends('layouts.backend.app')

@section('title')
<title>Activities | {{Auth::user()->role->name}}</title>
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
                            <h5 class="m-b-10">All activities</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="feather icon-home"></i></a></li>  
                            <li class="breadcrumb-item"><a href="">Manage Activities</a></li>
                            <li class="breadcrumb-item"><a href="">All Activities</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-right"> 
                        <a href="{{route('admin.activities.create')}}" class="btn btn-success" title="Back to List"><i class="feather icon-plus"></i> Add activities</a> 
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
                                        <th>Activities Name</th>   
                                        <th class="col-1">Status</th>
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if($activities->count())
                                    @foreach($activities as $index => $activity)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td class="text-wrap">{{$activity->name}}</td>
                                        <td>
                                            @if($activity->status == 1)
                                            <a href="{{ route('admin.activities.deactivate', $activity->id) }}" class="btn btn-success font-weight-bold btn-xs btn-block has-ripple text-white">Enable</a>
                                            @else
                                            <a href="{{ route('admin.activities.activate', $activity->id) }}" class="btn btn-danger font-weight-bold btn-xs btn-block has-ripple text-white">Disable</a>
                                            @endif
                                        </td>
                                        <td class="d-flex">  
                                            <a href="{{ route('admin.activities.edit', $activity->id) }}" class="btn btn-info btn-xs mr-1" title="Edit"><i class="feather icon-edit"></i></a>
                                            <form method="POST" action="{{ route('admin.activities.destroy', $activity->id) }}">
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