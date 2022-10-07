<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('backend/css/plugins/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/css/plugins/dropify.min.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/css/plugins/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/css/custom-style.css')}}" />
    @include('layouts.partials.style')
</head>
<body class="">
    <!-- [ auth-signin ] start -->
    <div class="auth-wrapper">
        <div class="auth-content"> 
            <div class="card">
                <div class="card-header text-white bg-primary text-center text-white h4 mb-2">Admin Login</div>
                <div class="card-body">
                    <div class="row align-items-center text-center">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('admin.postLogin') }}">
                                @csrf
                                <input type="hidden" name="_role"  value="admin" />                                
                                <div class="form-group mb-3 fill"> 
                                    <input id="email" type="email" class="form-control px-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="Enter Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 fill"> 
                                    <input id="password" type="password" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="Enter Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- [ auth-signin ] end -->
    @include('layouts.partials.script')
</body> 
</html>
