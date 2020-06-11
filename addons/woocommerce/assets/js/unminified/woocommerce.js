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
    // Shop Style
    var $body = $('body'),
        $toolBar = $('.kmt-toolbar'),
        removerClasses = '';
    
        $toolBar.find('a').click(function (e){
            var $this = $(this),
                bodyClass = $this.attr('class'),
                prevClass = $this.siblings('a').attr('class').split(' ')[0];
                
            e.preventDefault();

            $this.addClass('active');
            $this.siblings().removeClass('active');

            $body.addClass(bodyClass);
            $body.removeClass(prevClass);

            if(bodyClass == 'kmt-list-style' && $body.hasClass('shop-grid')){
                $body.removeClass('shop-grid');
                removerClasses = 'shop-grid';
            }else if(bodyClass == 'kmt-list-style' && $body.hasClass('hover-style')){
                removerClasses = '';
            }else{
                $body.addClass(removerClasses);
            }
        });    

})(jQuery);