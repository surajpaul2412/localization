<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue"> 
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="{{URL('/')}}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{asset('backend/images/logo.png')}}" alt="" class="logo"> 
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-3">
                <a href="{{URL('/')}}" class="pop-search" target="_blank"><i class="feather icon-home"></i> Home</a> 
            </li> 
        </ul>
        <ul class="navbar-nav navbar-right ml-auto">
            @if(Auth::user()->role_id == 1)
                <li class="mr-3"><a href="{{route('admin.profile')}}"><i class="feather icon-user"></i> {{ Auth::user()->name }}</a> </li>
            @else
                <li class="mr-3"><a href="{{route('customer.profile')}}"><i class="feather icon-user"></i> {{ Auth::user()->name }}</a> </li>
            @endif
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="feather icon-log-out"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li> 
        </ul>
    </div>  
</header>
<!-- [ Header ] end -->


