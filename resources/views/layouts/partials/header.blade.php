<div id="page">		
    <header class="header">
        <div id="preloader"><div data-loader="circle-side"></div></div>
        <!-- /Page Preload --> 
        <div class="top-menu">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div id="logo" class="">
                        <a href="{{URL('/')}}">
                        <img src="{{asset('images/logo.png')}}" alt="" class="logo_normal" />
                        <img src="{{asset('images/logo.png')}}" alt="" class="logo_sticky" /> 
                        </a>
                    </div>
                    <ul class="top-right-area m-0 d-flex justify-content-between align-items-center">  
                        
                        <!-- lang -->
                        <li class="d-none d-lg-block nav-item dropdown">
                            <a class="form-currency form-control nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> <span class="lang-text">{{ Config::get('languages')[App::getLocale()]['display'] }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (languages() as $lang => $language)
                                @if ($language->code != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $language->code) }}"><span class="flag-icon flag-icon-{{$language->flag}}"></span> {{$language->name}}</a>
                                @endif
                            @endforeach
                            </div>
                        </li>

                        <!-- currency -->
                        <li class="d-none d-lg-block nav-item dropdown">
                            <a class="form-currency form-control nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Session::get('currency')?? 'INR' }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (currencies() as $curr)
                                <a class="dropdown-item" href="{{ route('curr.switch', $curr->id) }}">
                                    {{$curr->currency_symbol}} {{$curr->currency_code}}
                                </a>
                            @endforeach
                            </div>
                        </li>
                        
                        <li>
                            @livewire('wishlist')
                        </li>
                        <li>
                            @livewire('cart')
                        </li>
                        @guest
                        <li>
                            <a href="{{route('login')}}" class="login" title="Sign In">
                                <span class="icon me-lg-1"><i class="icon_lock_alt"></i></span>
                                <span class="text d-none d-lg-block">{{dynamicLang('Sign In')}}</span>  
                            </a>
                        </li> 
                        <li class="d-none d-lg-block"><a href="{{route('register')}}" class="btn_1 btn-sm">{{dynamicLang('Sign Up')}}</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role->name == 'Admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    {{ dynamicLang('Dashboard') }}
                                </a>
                                @else
                                <a class="dropdown-item" href="{{ route('customer.order') }}">
                                    {{ dynamicLang('Dashboard') }}
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ dynamicLang('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- /top_menu -->        
        <!-- <a href="#menu" class="btn_mobile"></a> -->
        <nav id="menu" class="main-menu"></nav>
    </header>
    <!-- /header -->