@extends('layouts.frontend.app')
@section('title')
<title>{{$page->meta_title}}</title>
<meta name="keywords" content="{{$page->meta_keyword}}">
<meta name="description" content="{{$page->meta_desc}}">
@endsection

@section('content') 

<!-- Start: About Section -->        
{!! $page->description !!}
<!-- End: About Section -->

@endsection