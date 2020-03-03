(function ($) {

    var relatedPostsContainer = $('.kmt-related-posts'),
        desktopItems = relatedPostsContainer.data('desktop'),
        tabletItems = relatedPostsContainer.data('tablet'),
        mobileItems = relatedPostsContainer.data('mobile');
    relatedPostsContainer.owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        autoHeight: true,
        responsive:{
            0:{
                items: mobileItems,
                nav:true
            },
            700:{
                items: tabletItems,
                nav:false
            },
            1000:{
                items: desktopItems,
                nav:true,
                loop:false
            }
        }
    })
})(jQuery);