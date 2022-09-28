@php
use App\Models\Testimonial;
$testimonials = Testimonial::all();
@endphp

@if($testimonials->count())
<section class="section-sm traveler-reviews bg-white">
    <div class="container">
        <div class="main_title_3 d-flex justify-content-between align-items-center">
            <div> 
                <span><em></em></span>
                <h2>Traveler's Reviews</h2> 
            </div> 
            <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
        </div>
        
        <div id="traveler-reviews" class="owl-carousel owl-theme">
        	@foreach($testimonials as $index => $testimonial)
            <div class="item">  
                <div class="testimonial-box">
                    <div class="head d-flex justify-content-between">
                        <div class="left d-flex justify-content-start align-items-center">
                            <img src="https://d2d3n9ufwugv3m.cloudfront.net/w80-h80-cfill-100/users/6xSlbFuCZKkjwUcCvK6G.jpg" class="img-fluid" alt="" />
                            <div class="tit">
                                <h4>{{$testimonial->name}}</h4>
                                <p class="d-flex justify-content-start align-items-center">
                                    <img src="https://d34z6m0qj7i7g9.cloudfront.net/v5-assets/static/images/flags/it.png" /> 
                                    {{$testimonial->country}}
                                </p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="rating">
                                @foreach(range(1, $testimonial->stars) as $index)
                                <i class="fas fa-star"></i>
                                @endforeach
                                @foreach(range(1, 5-$testimonial->stars) as $index)
                                <i class="far fa-star"></i>
                                @endforeach
                            </div>
                        </div>
                    </div> 
                    <div class="content">
                        <p>{!! $testimonial->description !!}</p>
                    </div>   
                </div>
            </div>
            @endforeach 
        </div>  
    </div>
</section>
@endif
