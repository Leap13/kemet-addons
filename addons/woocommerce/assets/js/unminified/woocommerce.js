(function ($) {
    var filterBtn = $('.kmt-woo-filter'),
        offCanvasWrap = $('#kmt-off-canvas-wrap'),
        offCanvas = $('.kmt-off-canvas-sidebar');

        $(document).off( 'click', '.kmt-off-canvas-overlay, .kmt-close-filter' ).on( 'click', '.kmt-off-canvas-overlay, .kmt-close-filter',     function( e ){
            e.preventDefault();
    
            offCanvasWrap.removeClass('side-off-canvas-filter');
            offCanvas.removeClass('side-off-canvas-filter');
        }
        );    
    filterBtn.click(function( e ){
        e.preventDefault();

        offCanvasWrap.addClass('side-off-canvas-filter');
        offCanvas.addClass('side-off-canvas-filter');
    });

    /**
     * Infinite Scroll
     */
    var paginationStyle     = kemet.pagination_style;
        totalPages 			= parseInt( kemet.shop_infinite_total ) || '',
		counter             = parseInt( kemet.shop_infinite_count ) || '',
        ajax_url            = kemet.ajax_url || '',
        loadStatus          = true,
        loader              = $('.kmt-infinite-scroll-dots'), 
        noMoreMsg           = $('.infinite-scroll-end-msg'), 
        shop_infinite_nonce = kemet.shop_infinite_nonce || '';
        
        if( typeof paginationStyle != '' && paginationStyle == 'infinite-scroll' ){
            if( $('#main').find('.product:last').length > 0 ) {
                var windowHeight = jQuery(window).outerHeight() / 1.25;
                $(window).scroll(function () {

                    if( ( $(window).scrollTop() + windowHeight ) >= ( $('#main').find('.product:last').offset().top ) ) {

                        if (counter > totalPages) {
                            return false;
                        } else {

                            if( loadStatus == true ) {
                                ProducetsLoader(counter);
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
                    action : 'kemet_infinite_scroll',
                    page_no	: pageNumber,
                    nonce: shop_infinite_nonce,
                    query_vars: kemet.query_vars,
                }

                $.post( ajax_url, data, function( data ) {

                    var products = $(data),
                        productContainer = $('#main > .kmt-woocommerce-container ul.products');
                    
                        productContainer.append( products );
                    
                    
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