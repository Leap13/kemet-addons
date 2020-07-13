;(function ( $, window, undefined ) {

    var addonName    = 'kmtSticky',
        document      = window.document,
		windowWidth   = jQuery( window ).outerWidth(),
		viewPortWidth = jQuery( window ).width(),
		defaults      = {
			dependent            : [],
			max_width            : '',
			break_point          : 920,
			admin_bar_height_lg  : 32,
			admin_bar_height_sm  : 46,
			admin_bar_height_xs  : 0,
			stick_upto_scroll    : 0,
			gutter               : 0,
			wrap                 : '<div></div>',

			body_padding_support : true,

			html_padding_support : true,
		};


	/**
	 * Init
	 */
	function kmtSticky( element, options ) {
		this.element   = element;
		this.options   = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name     = addonName;

		this.init();
	}

    /**
	 * Stick element
	 *
	 * @since  1.0.7
	 */
	kmtSticky.prototype.stick_element = function( self, type ) {

		var selector      	  = jQuery( self.element ),
			stick_upto_scroll = parseInt( self.options.stick_upto_scroll ),
			max_width         = parseInt( selector.parent().attr( 'data-stick-maxwidth' ) ), // parseInt( self.options.max_width ),
            gutter            = parseInt( selector.parent().attr( 'data-stick-gutter' ) ); // parseInt( self.options.gutter ).
            
		/**
		 * Check window width
		 */
		if ( 'sticky-hide-tablet' == self.options.sticky_responsive && window.matchMedia('(min-width: 481px) and (max-width: 767px)').matches ) {
            
			self.endStick( self );
		} else if ( 'sticky-hide-mobile' == self.options.sticky_responsive && window.matchMedia('(max-width: 480px)').matches ) {
			self.endStick( self );
        }
        else if('sticky-hide-tablet-mobile' == self.options.sticky_responsive && window.matchMedia('(max-width: 767px)').matches){
            self.endStick( self );
        } else {
            
			if ( jQuery( window ).scrollTop() > stick_upto_scroll ) {
                
                var stickyHeader = selector;

                
                if ( 'sticky-slide' == self.options.header_style ) {

                    stickyHeader.css({
                        'top' : gutter,
                    });

                    stickyHeader.addClass('kmt-sticky-header');
                    stickyHeader.addClass('sticky-slide');
					$( document ).trigger( "addStickyClasses" );


				}else if( 'sticky-fade' == self.options.header_style ) {

                    stickyHeader.css({
                        'top' : gutter,
                    });

                    stickyHeader.addClass('kmt-sticky-header');
					stickyHeader.addClass( 'sticky-fade' );
					$( document ).trigger( "addStickyClasses" );

				}
			} else {
				self.endStick( self );
			}
		}
    }
    
    kmtSticky.prototype.updateValues = function () {

		var self  	          = this,
			selector          = jQuery( self.element ),
			gutter            = parseInt( self.options.gutter ),
			max_width         = self.options.max_width;

		if ( ! jQuery( 'body' ).hasClass( 'kmt-sticky-toggled-off' ) ) {
			var stick_upto_scroll = selector.offset().top || 0;
		}else{
			if ( $('#sitehead').length ) {
				var sitehead 			= $('#sitehead');
				var sitehead 	= sitehead.offset().top + sitehead.outerHeight() + 100;
				var stick_upto_scroll 	= sitehead_bottom || 0;
			}
		}

		if ( self.options.dependent ) {
			jQuery.each( self.options.dependent, function(index, val) {
				if (
					( jQuery( val ).length ) &&
					( jQuery( val ).parent().attr( 'data-stick-support' ) == 'on' )
				) {

					dependent_height   = jQuery( val ).outerHeight();
					gutter            += parseInt( dependent_height );
					stick_upto_scroll -= parseInt( dependent_height );
				}
			});
		}

		/**
		 * Add support for Admin bar height
		 */
		if ( self.options.admin_bar_height_lg && jQuery( '#wpadminbar' ).length && viewPortWidth > 782 ) {
			gutter            += parseInt( self.options.admin_bar_height_lg );
			stick_upto_scroll -= parseInt( self.options.admin_bar_height_lg );
		}

		if ( self.options.admin_bar_height_sm && jQuery( '#wpadminbar' ).length && ( viewPortWidth >= 600 && viewPortWidth <= 782 ) ) {
			gutter            += parseInt( self.options.admin_bar_height_sm );
			stick_upto_scroll -= parseInt( self.options.admin_bar_height_sm );
		}

		if( self.options.admin_bar_height_xs && jQuery( '#wpadminbar' ).length ){
			gutter            += parseInt( self.options.admin_bar_height_xs );
			stick_upto_scroll -= parseInt( self.options.admin_bar_height_xs );
		}

		/**
		 * Add support for <body> tag
		 */
		if ( self.options.body_padding_support ) {
			gutter            += parseInt( jQuery( 'body' ).css( 'padding-top' ), 10 );
			stick_upto_scroll -= parseInt( jQuery( 'body' ).css( 'padding-top' ), 10 );
		}

		/**
		 * Add support for <html> tag
		 */
		if ( self.options.html_padding_support ) {
			gutter            += parseInt( jQuery( 'html' ).css( 'padding-top' ), 10 );
			stick_upto_scroll -= parseInt( jQuery( 'html' ).css( 'padding-top' ), 10 );
        }
        
		/**
		 * Updated vars
		 */
		self.options.stick_upto_scroll = stick_upto_scroll;

		/**
		 * Update Attributes
		 */
		selector.parent()
            .attr( 'data-stick-gutter', parseInt( gutter ) )
            .attr( 'data-stick-maxwidth', parseInt( max_width ) );
    }

    kmtSticky.prototype.endStick = function( self ) {
        var selector = jQuery( self.element );
        var stickyHeader = selector;

        if ( 'sticky-slide' == self.options.header_style ) {
            stickyHeader.removeClass( 'sticky-slide' );
            $( document ).trigger( "removeStickyClasses" );


        }else if( 'sticky-fade' == self.options.header_style ) {
            stickyHeader.removeClass( 'sticky-fade' );
            $( document ).trigger( "removeStickyClasses" );


        }
    }

    /**
     * Init Prototype
     *
     * @since  1.0.7
     */
    kmtSticky.prototype.init = function () {

        /**
         * If custom stick options are set
         */
        if ( jQuery( this.element ) ) {

            var self                       	   = this,
                selector                       = jQuery( self.element );

            selector.wrap( self.options.wrap )
            .attr( 'data-stick-support', 'on' )
            .attr( 'data-stick-maxwidth', parseInt( self.options.max_width ) );
            self.updateValues();

            // Stick me!.
            jQuery( window ).on('resize', function() {

                self.endStick( self );
                self.updateValues();
                self.stick_element( self );
            } );

            jQuery( window ).on('scroll', function() {
                // update the stick_upto_scroll if normal main header navigation is opend.
                self.stick_element( self, 'scroll' );
                
                if( jQuery( 'body' ).hasClass( 'kmt-sticky-toggled-off' ) ){
                    self.updateValues();
                    self.stick_element( self, 'scroll' );
                }
            } );

            jQuery( document ).ready(function($) {
                self.stick_element( self );
            } );

        }

    };

    $.fn[addonName] = function ( options ) {
        return this.each(function () {
            if ( ! $.data( this, 'plugin_' + addonName )) {
                $.data( this, 'plugin_' + addonName, new kmtSticky( this, options ) );
            }
        });
    }

    var $body = jQuery( 'body' ),
        layout_width = $body.width(), 
        enable_sticky_header = kemetAddons.enable_sticky_header,
        enable_sticky_top_bar = kemetAddons.enable_sticky_top_bar,
        sticky_style = kemetAddons.sticky_style,
        sticky_responsive = kemetAddons.sticky_responsive,
        header_layout = kemetAddons.kemet_primary_header_layout,
        sticky_logo = kemetAddons.sticky_logo,
        display_responsive_menu_point = kemetAddons.display_responsive_menu_point;


        if ( enable_sticky_header || enable_sticky_top_bar ) {

            $( document ).on( "addStickyClasses", function() {
                var classes = '';
                
                if ( enable_sticky_header && ( 'header-main-layout-5' != header_layout || 'header-main-layout-7' != header_layout || 'header-main-layout-6' != header_layout ) ) {
                    classes = " kmt-is-sticky";
                }
                if ( enable_sticky_top_bar && ( 'header-main-layout-5' != header_layout || 'header-main-layout-7' != header_layout || 'header-main-layout-6' != header_layout ) ) {
                    classes += " kmt-sticky-top-bar";
                }
                if( enable_sticky_header && sticky_logo != '' ){
                    classes += " kmt-sticky-logo";
                }
                
                $('#sitehead').addClass(classes);
            });

            $( document ).on( "removeStickyClasses", function() {
                var classes = '';
                
                if ( enable_sticky_header && ( 'header-main-layout-5' != header_layout && 'header-main-layout-7' != header_layout && 'header-main-layout-6' != header_layout ) ) {
                    classes = " kmt-is-sticky";
                }
                if ( enable_sticky_top_bar && ( 'header-main-layout-5' != header_layout && 'header-main-layout-7' != header_layout && 'header-main-layout-6' != header_layout )  ) {
                    classes += " kmt-sticky-top-bar";
                }
                if( enable_sticky_header && sticky_logo != '' ){
                    classes += " kmt-sticky-logo";
                }

                $('#sitehead').removeClass(classes);
            });
            if('header-main-layout-5' != header_layout && 'header-main-layout-7' != header_layout && 'header-main-layout-6' != header_layout){

                if ( '1' == enable_sticky_header ) {
                    jQuery( '#sitehead' ).kmtSticky({
                        max_width: layout_width,
                        sticky_responsive: sticky_responsive,
                        header_style: sticky_style,
                    });
                }
            }
        }
}(jQuery, window));