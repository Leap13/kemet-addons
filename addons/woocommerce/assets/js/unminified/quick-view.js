(function ($) {
    KmtQuickView = {
        init: function(){
            this.bind();
        },
        bind:function(){
            // Open Quick View.
            $(document).off( 'click', '.kmt-quick-view' ).on( 'click', '.kmt-quick-view', KmtQuickView.openModel);
            // Close Quick View.
            $(document).off( 'click', '.kmt-qv-close' ).on( 'click', '.kmt-qv-close', KmtQuickView.closeModel);
            $(document).on( 'keyup', KmtQuickView.EscKeypress);
        },
        openModel:function( e ){
            e.preventDefault();

            var quickBtn = $(this),
                productId = quickBtn.data('product_id'),
                modal 		= $( '#kmt-qv-wrap' ),
                content 		= $( '#kmt-qv-content' );   

                quickBtn.addClass( 'loading' );    
            $.ajax({
                url        : kemet.ajax_url,
                type       : 'POST',
                dataType   : 'html',
                data       : {
                    action     : 'kemet_load_quick_view',
                    product_id : productId
                },
                success: function (results) {
                    var innerWidth = $( 'html' ).innerWidth();
                    $( 'html' ).css( 'overflow', 'hidden' );
                    var hiddenInnerWidth = $( 'html' ).innerWidth();
                    $( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );
                    $( 'html' ).addClass( 'kmt-qv-open' );

                    content.html( results );

                    // Display modal
                    modal.fadeIn();
                    modal.addClass( 'is-visible' );

                    var imageSlider = content.find( '.kmt-qv-image' );

                    if ( imageSlider.find( 'li' ).length > 1 ) {
                        imageSlider.flexslider();
                    }
                    
                },
            }).done( function() {
                quickBtn.removeClass( 'loading' );
            });
        },
        closeModel: function( e ){
            e.preventDefault();

            var modal 		= $( '#kmt-qv-wrap' ),
                content 		= $( '#kmt-qv-content' );

            $( 'html' ).css( {
                'overflow': '',
                'margin-right': '' 
            } );
            $( 'html' ).removeClass( 'kmt-qv-open' );
    
            modal.fadeOut();
            modal.removeClass( 'is-visible' );
    
            setTimeout( function() {
                content.html( '' );
            }, 600);
        },
        EscKeypress: function( e ){
            e.preventDefault(); 
			if( e.keyCode === 27 ) {
				KmtQuickView.closeModel( e );
			}
        }
    }

    /**
	 * Initialization
	 */
	$(function(){
        KmtQuickView.init();
	});
})(jQuery);