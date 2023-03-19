@extends('layouts.frontend.app')
@section('title')
<title>Contact Us | {{env('APP_NAME')}}</title>
@endsection

@section('css')
@endsection

@php
use App\Models\Contact;
$cred = Contact::first();
@endphp

@section('content')
<main>

	<div class="hero_in cart_section" style="background: #0054a6 url({{asset('images/pattern_1.svg')}}) center bottom repeat-x;">
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12"><h1 class="my-4 animated"> <span></span>{{dynamicLang('Contact Us')}}</h1></div>
				</div>
				<!-- End bs-wizard -->
			</div>
		</div>
	</div>
	<!--/hero_in-->

    <section class="section page-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-2">
					<div class="contact-form bg-white p-3 border rounded"> 

						<form id="contactForm1" action="#" method="post"> 
							<div class="row">
								<div class="col-lg-12"> 
									<h4 class="page-title mb-4">Contact Form</h4> 
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-label" for="fullname">Full Name<span class="text-danger fs-5">*</span>:</label>
										<input type="text" class="form-control" id="fullname" placeholder="Full Name..." required/>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-label" for="email">Email Id<span class="text-danger fs-5">*</span>:</label>
										<input type="email" class="form-control" id="email" placeholder="Email Id..." required/>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-label" for="mobile">Mobile Number<span class="text-danger fs-5">*</span>:</label>
										<input type="email" class="form-control" id="mobile" placeholder="Mubile Number..." required/>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-label" for="subject">Subject<span class="text-danger fs-5">*</span>"</label>
										<input type="email" class="form-control" id="subject" placeholder="Subject..." required/>
									</div>
								</div> 
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-label" for="message">Message<span class="text-danger fs-5">*</span>:</label>
										<textarea name="message" class="form-control" id="message" cols="30" rows="8" required></textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<input type="Submit" value="Submit" class="btn btn-success text-capitalize w-100">
									</div>
								</div>

							</div>

							 
						</form>
					</div>	
				</div>

				<div class="col-lg-6 d-none">
					<div class="contact-information">
						<div class="col-lg-12"><h4 class="page-title mb-4">Need Help?</h4> </div>
						<div class="col-lg-12">
							<ul class="contact-info mb-4">
								<li class="item">
									<div class="contact-info-box bg-white border rounded p-3 mb-3">
										<div class="d-flex align-items-center">
											<i class="ti-home fs-5 me-2"></i>
											<div class="cont-txt"> 
												<h4 class="title m-0">Address</h4>
												<p class="mb-0">{{$cred->address}}</p>
											</div>
										</div> 
									</div>
								</li>
								<li class="item">
									<div class="contact-info-box bg-white border rounded p-3 mb-3">
										<div class="d-flex align-items-center">
											<i class="ti-home fs-5 me-2"></i>
											<div class="cont-txt"> 
												<h4 class="title m-0">Email Id</h4>
												<a href="mailto:{{$cred->email}}">{{$cred->email}}</a>
											</div>
										</div> 
									</div>
								</li>
								<li class="item">
									<div class="contact-info-box bg-white border rounded p-3 mb-3">
										<div class="d-flex align-items-center">
											<i class="ti-home fs-5 me-2"></i>
											<div class="cont-txt"> 
												<h4 class="title m-0">Contact Number</h4>
												<a href="tel:{{$cred->phone}}">{{$cred->phone}}</a></a>
											</div>
										</div> 
									</div>
								</li>  
							</ul>
						</div>  
						<div class="col-lg-12"><h5 class="page-title mb-2">Follow us</h5> </div>
						<div class="col-lg-12">
							<div class="follow_us">
								<ul> 
									<li></li>
									<li><a href="{{$cred->facebook}}"><i class="ti-facebook"></i></a></li>
									<li><a href="{{$cred->instagram}}"><i class="ti-instagram"></i></a></li>
									<li><a href="{{$cred->twitter}}"><i class="ti-twitter-alt"></i></a></li>
									<li><a href="{{$cred->linkedin}}"><i class="ti-linkedin"></i></a></li> 
								</ul>
							</div>
						</div>

					</div>
					
					
					 
				</div>

				<!-- <div class="col-lg-6">
					{{$data}}
				</div>  -->

				<div class="col-lg-12 d-none">
					<div class="map-box mt-5">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14047.32046712315!2d77.3318964!3d28.3337424!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cdbddcfe1590f%3A0xaba6e1c24d366c69!2sAbhisan%20Technology%20Private%20Limited!5e0!3m2!1sen!2sin!4v1678693935193!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</div>
	</section> 


	
</main>
@endsection