(function ($) {
    KmtQuickView = {
        init: function(){
            this.bind();
        },
        bind:function(){
            // Open Quick View.
			$(document).off( 'click', '.kmt-quick-view' ).on( 'click', '.kmt-quick-view', KmtQuickView.openModel);
        },
        openModel:function( e ){
            e.preventDefault();

            var quickBtn = $(this),
                productId = quickBtn.data('product_id');    
            $.ajax({
                url        : kemet.ajax_url,
                type       : 'POST',
                dataType   : 'html',
                data       : {
                    action     : 'kemet_load_quick_view',
                    product_id : productId
                },
                success: function (result) {
                    $(document).find( '#quick-view-test' ).find( '.quick-view-container' ).html(result);
                    console.log("Success: " + productId);
                },
            });
        },
    }

    /**
	 * Initialization
	 */
	$(function(){
        KmtQuickView.init();
	});
})(jQuery);