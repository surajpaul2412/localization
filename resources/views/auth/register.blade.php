<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | GetBeds</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.style')
</head> 
<body id="login_bg">
    <nav id="menu" class="fake_menu"></nav>
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div>
    <div id="login" class="bg-gray d-flex align-items-center justify-content-center">
        <aside>
            <figure>
                <a href="{{URL('/')}}"><img src="{{asset('images/logo.png')}}" alt="Logo" class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label>{{ dynamicLang('Your Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <i class="ti-user"></i>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ dynamicLang('Your Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <i class="icon_mail_alt"></i>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class="form-group">
                    <label>{{ dynamicLang('Your Password') }}</label>
                    <input id="password1" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <i class="icon_lock_alt"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ dynamicLang('Confirm Password') }}</label>
                    <input id="password2" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <i class="icon_lock_alt"></i>
                </div>
                <div id="pass-info" class="clearfix m-0"></div>
                <button type="submit" class="btn_1 rounded full-width mt-1">{{ dynamicLang('Register Now!') }}</button>
                <div class="text-center add_top_10">{{dynamicLang('Already have an acccount')}}? <strong><a href="{{route('login')}}">{{dynamicLang('Sign In')}}</a></strong></div>
            </form>
        </aside>
    </div>
    @include('layouts.partials.script')
</body> 
</html>
