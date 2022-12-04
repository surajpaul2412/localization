<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | GetBeds</title>
    @yield('title')
    @include('layouts.partials.style')
    @yield('css')
    @livewireStyles
</head> 
<body>
    @include('layouts.partials.header')

    @yield('content')
    
    @include('layouts.partials.footer')

    @include('layouts.partials.script')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{asset('js/jarallax.min.js')}}"></script>
    <script src="{{asset('js/jarallax-video.min.js')}}"></script>
    @yield('script')
    @livewireScripts 
</body> 
</html>
