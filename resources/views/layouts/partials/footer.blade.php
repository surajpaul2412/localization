@php
use App\Models\Contact;
$cred = Contact::first();
@endphp

    <!-- Start: footer -->
    <footer class="main-footer">
        <div class="top-footer py-5">  
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12 pe-5">
                        <h5>{{dynamicLang('Contact with Us')}}</h5>
                        <ul class="contacts">
                            <li><a href="tel://919999585812"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>
                            <li><a href="mailto:info@getbeds.in"><i class="ti-email"></i> info@getbeds.in</a></li>
                        </ul>
                        <div id="newsletter">
                            <h6>{{dynamicLang('Newsletter')}}</h6>
                            <div id="message-newsletter"></div>
                            <form method="post" action="{{route('newsletter.store')}}" name="newsletter_form" id="newsletter_form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" id="email_newsletter" class="form-control @error('email') is-invalid @enderror" placeholder="Your email" required>
                                    @error('email')
                                        <div class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <input type="submit" value="{{dynamicLang('Submit')}}" id="submit-newsletter">
                                </div>
                            </form>
                        </div>
                        <div class="follow_us">
                            <ul>
                                <li>{{dynamicLang('Follow us')}}</li>
                                <li><a href="{{$cred->facebook}}"><i class="ti-facebook"></i></a></li>
                                <li><a href="{{$cred->instagram}}"><i class="ti-instagram"></i></a></li>
                                <li><a href="{{$cred->twitter}}"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="{{$cred->linkedin}}"><i class="ti-linkedin"></i></a></li> 
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 ms-lg-auto">
                        <h5>{{dynamicLang('Useful links')}}</h5>
                        <ul class="links">
                            <li><a href="{{URL('about-us')}}">{{dynamicLang('About')}}</a></li> 
                            <li><a href="{{route('contact-us')}}">{{dynamicLang('Contacts')}}</a></li>
                            <li><a href="{{route('register')}}">{{dynamicLang('Register')}}</a></li> 
                            <li><a href="{{URL('privacy-policy')}}">{{dynamicLang('Privacy Policy')}}</a></li> 
                            <li><a href="{{URL('terms-of-use')}}">{{dynamicLang('Terms of Use')}}</a></li> 
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6"> 
                        <h5>{{dynamicLang('Ways You Can Pay')}}</h5>
                        <p><img src="{{asset('images/payments.png')}}" alt="Footer Logo" /></p>
                    </div>
                </div>
                <!--/row--> 
            </div>
        </div> 
        <hr class="m-0"> 
        <div class="bottom-footer py-3">  
            <div class="container"> 
                <div class="row justify-content-center"> 
                    <div class="col-lg-6">
                        <div class="copy-right text-center text-lg-start">
                            <p class="m-0">{{dynamicLang('Copyright © 2022')}} | <a href="{{URL('/')}}">GetBeds</a> | {{dynamicLang('All Rights Reserved.')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="developed_by text-center text-lg-end">
                            <p class="m-0">Developed by: <a href="www.abhisan.com">Abhisan Technology</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->
    </div>
    <!-- page -->

    <!-- Start: Sign In Popup -->
    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form>
        <div class="sign-in-wrapper">
            <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-start">
                    <label class="container_check">Remember me
                    <input type="checkbox">
                    <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-end mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
            <div class="text-center">
                Don’t have an account? <a href="register.html">Sign up</a>
            </div>
            <div id="forgot_pw">
                <div class="form-group">
                    <label>Please confirm login email below</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
            </div>
        </div>
    </form>
<!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div>
<!-- Back to top button -->