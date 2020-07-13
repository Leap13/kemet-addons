;(function ( $, window, undefined ) {

    var pluginName    = 'kmtSticky',
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
        this._name     = pluginName;

		this.init();
	}

    /**
	 * Stick element
	 *
	 * @since  1.0.0
	 */
	kmtSticky.prototype.stick_element = function( self, type ) {

		var selector      	  = jQuery( self.element ),
			windowWidth       = jQuery( window ).outerWidth();
			stick_upto_scroll = parseInt( self.options.stick_upto_scroll ),
			max_width         = parseInt( selector.parent().attr( 'data-stick-maxwidth' ) ), // parseInt( self.options.max_width ),
			gutter            = parseInt( selector.parent().attr( 'data-stick-gutter' ) ); // parseInt( self.options.gutter ).
			
		/**
		 * Check window width
		 */
		if ( 'desktop' == self.options.sticky_responsive && jQuery( 'body' ).hasClass( 'kmt-header-break-point' ) ) {
			self.endStick( self );
		} else if ( 'mobile' == self.options.sticky_responsive && ! jQuery( 'body' ).hasClass( 'kmt-header-break-point' ) ) {
			self.endStick( self );
		} else {

			if ( jQuery( window ).scrollTop() > stick_upto_scroll ) {

				var fixed_header = selector;
                if ( 'slide' == self.options.sticky_style ) {
					fixed_header.css({
						'top' : gutter,
					});
					fixed_header.addClass('kmt-header-slide');
					fixed_header.css( 'visibility', 'visible' );
					fixed_header.addClass( 'kmt-sticky-active' ).stop().css({
						'transform':'translateY(0)',
					});
					$('html').addClass('kmt-header-stick-slide-active');
					$( document ).trigger( "addStickyClasses" );
					fixed_header.addClass('kmt-header-sticked');


				}else if( 'fade' == self.options.sticky_style ) {
					fixed_header.css({
						'top' : gutter,
					});
					fixed_header.addClass('kmt-header-fade');
					fixed_header.css( 'visibility', 'visible' );
					fixed_header.addClass( 'kmt-sticky-active' ).stop().css({
						'opacity' : '1',
					});
					$('html').addClass('kmt-header-stick-fade-active');
					$( document ).trigger( "addStickyClasses" );
					fixed_header.addClass('kmt-header-sticked');

				}
			} else {
				self.endStick( self );
			}
		}
    }
    
    kmtSticky.prototype.update_attrs = function () {

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

        kmtSticky.prototype.hasScrolled = function( self, method ) {
		
            var st = $( window ).scrollTop();
        
            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            
            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            var fixed_header = jQuery(self.element);
            if (st > lastScrollTop && st > navbarHeight){
    
                // Scroll Down
                jQuery(self.element).removeClass('kmt-nav-down').addClass('kmt-nav-up');
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    jQuery(self.element).removeClass('kmt-nav-up').addClass('kmt-nav-down');
                }
            }
            
            lastScrollTop = st;
    
            if ( !$(self.element).hasClass('kmt-nav-up') && 'stick' == method ) {
                fixed_header.css({
                    'top' : gutter,
                });
                fixed_header.addClass('kmt-header-sticked');
                fixed_header.addClass('kmt-header-slide');
                fixed_header.css( 'visibility', 'visible' );
                fixed_header.addClass( 'kmt-sticky-active' ).stop().css({
                    'transform':'translateY(0)',
                });
                $( document ).trigger( "addStickyClasses" );
                $('html').addClass('kmt-header-stick-scroll-active');
            }else{
                fixed_header.css({
                    'transform':'translateY(-100%)',
                }).stop();
    
                setTimeout(function() {
                    fixed_header.removeClass( 'kmt-sticky-active' );
                }, 300);
                fixed_header.css({ 
                    'visibility' : 'hidden',
                    'top' : '',
                });
                $( document ).trigger( "removeStickyClasses" );
                $('html').removeClass('kmt-header-stick-scroll-active');
                fixed_header.removeClass('kmt-header-sticked');
            }
        }

        kmtSticky.prototype.endStick = function( self ) {
            var selector = jQuery( self.element );
            var fixed_header = selector;

            if ( 'slide' == self.options.sticky_style ) {
                fixed_header.removeClass( 'kmt-sticky-active' ).stop().css({
                    'transform':'translateY(-100%)',
                });
                fixed_header.css({ 
                    'visibility' : 'hidden',
                    'top' : '',
                });

                $('html').removeClass('kmt-header-stick-slide-active');
                $( document ).trigger( "removeStickyClasses" );
                fixed_header.removeClass('kmt-header-sticked');


            }else if( 'fade' == self.options.sticky_style ) {
                fixed_header.removeClass( 'kmt-sticky-active' ).stop().css({
                    'opacity' : '0',
                });
                fixed_header.css({ 
                    'visibility' : 'hidden',
                });
                fixed_header.removeClass('kmt-header-sticked');
                $( document ).trigger( "removeStickyClass" );
                $('html').removeClass('kmt-header-stick-fade-active');


            }
        }

        /**
         * Init Prototype
         *
         * @since  1.0.0
         */
        kmtSticky.prototype.init = function () {

            /**
             * If custom stick options are set
             */
            if ( jQuery( this.element ) ) {

                var self                       	   = this,
                    selector                       = jQuery( self.element ),
                    gutter                         = parseInt( self.options.gutter ),
                    stick_upto_scroll              = selector.position().top || 0,
                    dependent_height               = 0;

                selector.wrap( self.options.wrap )
                .attr( 'data-stick-support', 'on' )
                .attr( 'data-stick-maxwidth', parseInt( self.options.max_width ) );
                self.update_attrs();

                // Stick me!.
                jQuery( window ).on('resize', function() {

                    self.endStick( self );
                    self.update_attrs();
                    self.stick_element( self );
                } );

                jQuery( window ).on('scroll', function() {
                    // update the stick_upto_scroll if normal main header navigation is opend.
                    self.stick_element( self, 'scroll' );
                    
                    if( jQuery( 'body' ).hasClass( 'kmt-sticky-toggled-off' ) ){
                        self.update_attrs();
                        self.stick_element( self, 'scroll' );
                    }
                } );

                jQuery( document ).ready(function($) {
                    self.stick_element( self );
                } );

            }

        };

        $.fn[pluginName] = function ( options ) {
            return this.each(function () {
                if ( ! $.data( this, 'plugin_' + pluginName )) {
                    $.data( this, 'plugin_' + pluginName, new kmtSticky( this, options ) );
                }
            });
        }




    var $body = jQuery( 'body' ),
        layout_width = $body.width(), 
        enable_sticky_header = kemetAddons.enable_sticky_header,
        enable_sticky_top_bar = kemetAddons.enable_sticky_top_bar,
        site_content_layout = kemetAddons.site_content_layout,
        sticky_style = kemetAddons.sticky_style,
        site_content_width = kemetAddons.site_content_width || 1200,
        sticky_logo_width = kemetAddons.sticky_logo_width,
        sticky_responsive = kemetAddons.sticky_responsive,
        display_responsive_menu_point = kemetAddons.display_responsive_menu_point;


        if ( enable_sticky_header || enable_sticky_top_bar ) {

            $( document ).on( "addStickyClasses", function() {
                var classes = '';
                
                if ( enable_sticky_header ) {
                    classes = " kmt-sticky-header-active";
                }
                if ( enable_sticky_top_bar ) {
                    classes += " kmt-sticky-top-bar-active";
                }
                $('body').addClass(classes);
            });

            $( document ).on( "removeStickyClasses", function() {
                var classes = '';
                
                if ( enable_sticky_header ) {
                    classes = " kmt-sticky-header-active";
                }
                if ( enable_sticky_top_bar ) {
                    classes += " kmt-sticky-top-bar-active";
                }
                $('body').removeClass(classes);
            });

            if ( '1' == enable_sticky_header ) {
                jQuery( '#sitehead' ).kmtSticky({
                    max_width: layout_width,
                    sticky_on_device: sticky_responsive,
                    header_style: sticky_style,
                });
            }
        }
}(jQuery, window));

// var Header = document.querySelector('.kmt-sticky-header');

// if (Header != null) {
//     var sticky = Header.offsetHeight;
//     window.onscroll = function () {
//         if (window.pageYOffset > sticky) {
//             Header.classList.add("kmt-is-sticky")
//         } else {
//             Header.classList.remove("kmt-is-sticky", 'swing' );
//         }
//     }
// }