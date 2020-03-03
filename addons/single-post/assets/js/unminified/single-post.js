(function ($) {
    $('.kmt-related-posts').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        autoHeight: false,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            767:{
                items:3,
                nav:false
            },
            1000:{
                items:3,
                nav:true,
                loop:false
            }
        }
    })
})(jQuery);