jQuery( function ( $ ) {

    'use strict';   

    // load More Js  
    function loadMoreButton(){   

        // LoadMore College List 
        var loadMore = "#loadMore",
            items = "#loadContent .isotope-item",
            itemsHidden = "#loadContent .isotope-item:hidden";

        $(items).slice(0, 8).show();

        if ($(items).length > 8) {
            $(loadMore).show();  
        }else{ 
            $(loadMore).hide(); 
        }

        $(loadMore).on("click", function (e) { 
            e.preventDefault();
            $(itemsHidden).slice(0, 8).slideDown();

            setTimeout(function () {
                if ($(itemsHidden).length == 0) {
                    $(loadMore).addClass("btn-danger opacity-25"); 
                    $(loadMore).removeClass("btn-success");
                    $(loadMore).text("No More to view").fadOut("slow"); 
                }else{
                    $(loadMore).text("Load More").fadOut("slow");
                }
            }, 500);

            $.ajax({ beforeSend: function () { $(loadMore).text("Loading..."); }, }); 

        });  

 

    };loadMoreButton()  

    // item Slide
	$('.slick-slider').slick({
        slidesToShow:4,
        arrows: true,
        dots: false,
        infinite: true,
        speed: 500,
        cssEase: 'linear',
        autoplaySpeed: 2000,
        autoplay:true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:3
            }
          },
          {
            breakpoint: 600,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:1
            }
          }
        ]
    }); 

    // item Slide
	$('.slick-travel-product, .slick-popular-destination, .slick-get-inspired').slick({
        slidesToShow:5,
        arrows: true,
        dots: false,
        infinite: true,
        speed: 500,
        cssEase: 'linear',
        autoplaySpeed: 2000,
        autoplay:true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:3
            }
          },
          {
            breakpoint: 600,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:2
            }
          }
        ]
    });

    // item Slide
	$('.slick-amenities-filter').slick({
        slidesToShow:7,
        arrows: false,
        dots: false,
        infinite: true,
        speed: 500, 
        autoplaySpeed: 2000,
        autoplay:true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:3
            }
          },
          {
            breakpoint: 600,
            settings: {
              arrows: true,
              dots: false,
              slidesToShow:2
            }
          }
        ]
    });
    

});