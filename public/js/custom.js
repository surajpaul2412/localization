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

});