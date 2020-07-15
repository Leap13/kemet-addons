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
            cookie = $this.getCookie('kemet_shop_layout');
            
        if(cookie != 'cookie' && cookie != 'undefined'){
            $this.defaultStyle(cookie)
        }
        $('a.kmt-grid-style').on('click' , function(e){
            var $link = $(this);
            $this.gridMode(e , $link);
        });
        $('a.kmt-list-style').on('click' ,function(e){
            var $link = $(this);
            $this.listMode(e , $link);
        });

    },
    gridMode: function(e , $this){

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
    listMode: function(e , $this){
        
        e.preventDefault();
        if ($this.hasClass('active')) return;

        var $body = $('body'),
            layoutStyle = $this.data('layout'),
            prevClass = $this.siblings('a').data('layout'),
            container = $('.kmt-woocommerce-container .products'),
            shop_load_template = kemet.shop_load_layout_style || '',
            action = 'kemet_list_post_ajax',
            data = {
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

                Cookies.set('kemet_shop_layout', 'shop-list', {
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

        $body.addClass(layout);
        switch(cookie) {
            case 'hover-style':
                $body.removeClass('grid-style shop-list');
              break;
            case 'grid-style':
                $body.removeClass('hover-style shop-list');
              break;
            case 'shop-list':
                $body.removeClass('hover-style grid-style');
              break;
          };
      }
}

$(function () { Kemet_Shop_Layout.init(); });

})(jQuery);