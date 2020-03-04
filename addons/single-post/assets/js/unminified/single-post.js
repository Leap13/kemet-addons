(function ($) {

    var relatedPostsContainer = $('.kmt-related-posts');
    
    if(relatedPostsContainer.length > 0 ){
        var desktopItems = relatedPostsContainer.data('desktop'),
            tabletItems = relatedPostsContainer.data('tablet'),
            mobileItems = relatedPostsContainer.data('mobile');
        relatedPostsContainer.owlCarousel({
            loop:false,
            margin:10,
            responsiveClass:true,
            autoHeight: true,
            nav: true,
            responsive:{
                0:{
                    items: mobileItems,
                },
                700:{
                    items: tabletItems,
                },
                1000:{
                    items: desktopItems,
                }
            }
        });
        var squire = function(){
            var post = $('.kmt-related-posts .related-post > a'),
            postWidth = post.width();
            post.height( postWidth );
        }
        squire();
        relatedPostsContainer.on('resized.owl.carousel', function(event) {
            squire();
        })
    }
})(jQuery);