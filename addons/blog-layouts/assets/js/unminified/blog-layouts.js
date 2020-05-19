(function ($) {
  
      var Mode = 'masonry';
      if($('.blog-posts-container.blog-layout-2').hasClass('fit-rows')){
        Mode = 'fitRows';
      }
      $('.blog-posts-container.blog-layout-2').masonry({
        itemSelector: '.kmt-article-post',
        layoutMode: Mode,
      });

      /**
     * Infinite Scroll
     */
    var paginationStyle     = kemet.pagination_style;
    totalPages 			= parseInt( kemet.blog_infinite_total ) || '',
    counter             = parseInt( kemet.blog_infinite_count ) || '',
    ajax_url            = kemet.ajax_url || '',
    loadStatus          = true,
    loader              = $('.kmt-infinite-scroll-dots'), 
    noMoreMsg           = $('.infinite-scroll-end-msg'), 
    blog_infinite_nonce = kemet.blog_infinite_nonce || '';
    
    if( typeof paginationStyle != '' && paginationStyle == 'infinite-scroll' ){
      
        if( $('#main').find('.post:last').length > 0 ) {
            var windowHeight = jQuery(window).outerHeight() / 1.25;
            $(window).scroll(function () {

                if( ( $(window).scrollTop() + windowHeight ) >= ( $('#main').find('.post:last').offset().top ) ) {

                    if (counter > totalPages) {
                        return false;
                    } else {

                        if( loadStatus == true ) {
                            ProducetsLoader(counter);
                            console.log('work');
                            counter++;
                            loadStatus = false;
                        }
                    }
                }
            });
        }
        /**
         * Get Products via AJAX
         */
        function ProducetsLoader(pageNumber) {

            loader.show();

            var data = {
                action : 'kemet_pagination_infinite',
                page_no	: pageNumber,
                nonce: blog_infinite_nonce,
                query_vars: kemet.query_vars,
            }

            $.post( ajax_url, data, function( data ) {

                var posts = $(data),
                    postContainer = $('#main .blog-posts-container');
                    console.log(posts);
                    postContainer.append( posts );
                
                
                loader.hide();
                //	Show no more msg
                if( counter > totalPages ) {
                    noMoreMsg.show();
                }
                loadStatus = true;
            });
        }
    }
})(jQuery);