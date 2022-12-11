<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | GetBeds</title>
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
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>{{ dynamicLang('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" autofocus>
                    <i class="icon_mail_alt"></i>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ dynamicLang('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password">
                    <i class="icon_lock_alt"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="clearfix add_bottom_30">
                    <div class="checkboxes float-start">
                        <label class="container_check">{{ dynamicLang('Remember Me') }}
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="float-end mt-1">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" id="forgot" href="{{ route('password.request') }}">
                                {{ dynamicLang('Forgot Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn_1 rounded full-width">{{ dynamicLang('Login to GetBeds') }}</button>
                <div class="text-center add_top_10">{{dynamicLang('New to')}} GetBeds? <strong><a href="{{route('register')}}">{{dynamicLang('Sign up')}}!</a></strong></div>
            </form> 
        </aside>
    </div>
    <!-- /login -->
    @include('layouts.partials.script')
</body> 
</html>