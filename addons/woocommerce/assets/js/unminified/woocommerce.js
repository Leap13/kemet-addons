(function ($) {
    'use strict';
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
 *
 * @class Kemet_Shop_Layout
 */    
var Kemet_Shop_Layout = {

    /**
     * @access private
     * @method init
     */
    init: function () {

        var $this = this,
            cookie = $this.getCookie('kemet_shop_layout'),
            toolBar = $('.kmt-toolbar');
            
        if(cookie != '' && cookie != 'undefined' && !kemet.in_customizer){
            $this.defaultStyle(cookie);
        }
        
        toolBar.find('a').click(function(e){
            var $link = $(this);
            $this.loadAjax(e , $link);
        });
    },
    loadAjax: function(e , $this){

        e.preventDefault();
        if ($this.hasClass('active')) return;

        var $body = $('body'),
            layoutStyle = $this.data('layout'),
            prevClass = $this.siblings('a').data('layout'),
            container = $('.kmt-woocommerce-container .products'),
            shop_load_template = kemet.shop_load_layout_style || '',
            action = '';

            switch(layoutStyle) {
                case 'hover-style':
                    action = 'kemet_hover_style_post_ajax';
                  break;
                case 'shop-grid':
                    action = 'kemet_product_default_style';
                  break;
                case 'shop-list':
                    action = 'kemet_list_post_ajax';
                  break;  
              };
              
        var data = {
            'action': action,
            'query': kemet.query_vars,
            'nonce': shop_load_template,
            };
            
            $this.addClass('active');
            $this.siblings().removeClass('active');

        $.ajax({
            url: kemet.ajax_url,
            data: data,
            type: 'POST',

            beforeSend: function (xhr) {
                container.addClass('load-ajax');
            },
            success: function (data) {
            if (data) {

                    container.html(data);
                    $this.addClass('active');
                    $this.siblings().removeClass('active');

                    $body.addClass(layoutStyle);
                    $body.removeClass(prevClass);

                    container.removeClass('load-ajax');
                }
                Cookies.set('kemet_shop_layout', layoutStyle, {
                    expires: 0.1,
                    path: '/'
                });
            }
        });
    },
    getCookie: function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      },
      defaultStyle: function(cookie) {
        var layout = cookie,
            $body = $('body'),
            toolBar = $('.kmt-toolbar');
        
        toolBar.find('a').each(function(){
            var $this = $(this);

            if($this.data('layout') == layout){
                $this.addClass('active');
                $this.siblings().removeClass('active');
            }
        });
        switch(layout) {
            case 'hover-style':
                $body.removeClass('grid-style shop-list');
              break;
            case 'shop-grid':
                $body.removeClass('hover-style shop-list');
              break;
            case 'shop-list':
                $body.removeClass('hover-style grid-style');
              break;
          };

          $body.addClass(layout);   
    }
}

$(function () { Kemet_Shop_Layout.init(); });
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