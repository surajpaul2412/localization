@php
use App\Models\Testimonial;
$testimonials = Testimonial::whereStatus(1)->get();
@endphp

@if($testimonials->count())
<section class="section-sm traveler-reviews bg-white">
    <div class="container">
        <div class="main_title_3 d-flex justify-content-between align-items-center">
            <div> 
                <span><em></em></span>
                <h2>{{dynamicLang("Traveler's Reviews")}}</h2> 
            </div> 
            <!-- <a href="#0"><strong>View all (57) <i class="arrow_carrot-right"></i></strong></a>  -->
        </div>
        
        <div id="traveler-reviews1" class="slick-traveler-reviews">
        	@foreach($testimonials as $index => $testimonial)
            <div class="item">  
                <div class="testimonial-box">
                    <img src="{{asset($testimonial->avatar)}}" class="img-fluid" alt="avatar" />
                    <div class="content-box p-2">
                        <div class="rating">
                            @foreach(range(1, $testimonial->stars) as $index)
                            <i class="fas fa-star"></i>
                            @endforeach
                        </div>
                        <h4 class="mb-1">{{dynamicLang($testimonial->name)}}</h4>
                        <!-- <p class="m-0">
                            {{dynamicLang('Country')}}: {{dynamicLang($testimonial->country)}}
                        </p> -->
                        <p class="m-0">{!! $testimonial->description !!}</p>  
                          
                    </div>
                </div>
            </div>
            @endforeach 
        </div>  
    </div>
</section>
@endif
