<?php
/**
 * Mega menu walker
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Walker_Nav_Menu' ) ) {

	/**
	 * Mega menu walker
	 */
	class Kemet_Addon_Mega_Menu_Walker_Nav_Menu extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$indent = str_repeat( $t, $depth );

			// Default class.
			$classes = array( 'sub-menu' );

			$columns    = ! empty( $this->megamenu_col ) ? ( 'col-' . $this->megamenu_col ) : 'col-2';
			$style      = array();
			$output_css = '';

			if ( 0 === $depth && true == $this->megamenu ) {
				$classes[]         = 'kemet-megamenu';
				$classes[]         = $columns;
				$global_bg_color   = kemet_get_sub_option( 'global-background-color', 'initial' );
				$layout            = ! empty( $this->megamenu_layout ) ? ( $this->megamenu_layout ) : 'row';
				$headings_color    = isset( $this->megamenu_heading_color['initial'] ) && $this->megamenu_heading_color['initial'] ? $this->megamenu_heading_color['initial'] : 'var(--headingColor)';
				$headings_bg_color = isset( $this->megamenu_heading_bg_color['initial'] ) && $this->megamenu_heading_bg_color['initial'] ? $this->megamenu_heading_bg_color['initial'] : 'transparent';
				$link_color        = isset( $this->megamenu_link_color['initial'] ) ? $this->megamenu_link_color['initial'] : '';
				$link_h_color      = isset( $this->megamenu_link_color['hover'] ) ? $this->megamenu_link_color['hover'] : '';
				$link_bg_color     = isset( $this->megamenu_link_color['background'] ) && $this->megamenu_link_color['background'] ? $this->megamenu_link_color['background'] : 'transparent';
				$default_bg        = array(
					'background-type'  => 'color',
					'background-color' => $global_bg_color,
				);
				$bg_obj            = $this->megamenu_bg_obj ? $this->megamenu_bg_obj : $default_bg;
				$spacing           = $this->megamenu_spacing;
				$style[ '.kmt-is-sticky .main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .kemet-megamenu a' ] = array(
					'--linksColor'      => esc_attr( $link_color ),
					'--linksHoverColor' => esc_attr( $link_h_color ),
					'--backgroundColor' => esc_attr( $link_bg_color ),
				);
				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id ]                                       = array(
					'--borderRadius' => kemet_spacing( $this->megamenu_border_radius, 'all' ),
				);

				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .kemet-megamenu, .main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .mega-menu-full-wrap' ] = array(
					'border-radius' => 'var(--borderRadius)',
				);

				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .mega-menu-full-wrap .kemet-megamenu' ] = array(
					'border-radius' => '0',
				);

				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .kemet-megamenu' ] = array(
					'--gridTemplateColummns' => Kemet_Dynamic_Css_Generator::get_grid_template_columns( $layout ),
					'--linksColor'           => esc_attr( $link_color ),
					'--linksHoverColor'      => esc_attr( $link_h_color ),
					'--backgroundColor'      => esc_attr( $link_bg_color ),
					'padding-top'            => kemet_spacing( $spacing, 'top' ),
					'padding-right'          => kemet_spacing( $spacing, 'right' ),
					'padding-bottom'         => kemet_spacing( $spacing, 'bottom' ),
					'padding-left'           => kemet_spacing( $spacing, 'left' ),
				);

				$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .kemet-megamenu .heading-item' ] = array(
					'--linksColor'      => esc_attr( $headings_color ),
					'--backgroundColor' => esc_attr( $headings_bg_color ),
				);

				if ( $this->megamenu_column_divider || $this->megamenu_items_divider ) {
					$divider       = isset( $this->megamenu_column_divider ) ? $this->megamenu_column_divider : array();
					$items_divider = isset( $this->megamenu_items_divider ) ? $this->megamenu_items_divider : array();
					$style[ '.main-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' ul.kemet-megamenu' ] = array(
						'--columnDivider' => kemet_border( $divider ),
						'--itemDivider'   => kemet_border( $items_divider ),
					);
				}
				$background_selector = 'full' === $this->megamenu_width ? 'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' .mega-menu-full-wrap' : 'body:not(.kmt-header-break-point) #site-navigation .kemet-megamenu-item.menu-item-' . $this->menu_item_id . ' ul.kemet-megamenu';
				$output_css         .= kemet_get_background_obj( $background_selector, $bg_obj );

				if ( 'full' === $this->megamenu_width ) {
					$output .= "\n$indent<div class='mega-menu-full-wrap'>\n";
				}
			}

			$output_css .= kemet_parse_css( $style );
			Kemet_Addon_Mega_Menu_Partials::add_css( $output_css );
			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul$class_names>{$n}";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent  = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			// Set some vars.
			if ( 0 === $depth ) {
				$this->megamenu                  = get_post_meta( $item->ID, 'enable-mega-menu', true );
				$this->megamenu_col              = get_post_meta( $item->ID, 'mega-menu-columns', true );
				$this->megamenu_layout           = get_post_meta( $item->ID, 'mega-menu-layout', true );
				$this->megamenu_bg_obj           = get_post_meta( $item->ID, 'mega-menu-background', true );
				$this->megamenu_width            = get_post_meta( $item->ID, 'mega-menu-width', true );
				$this->megamenu_spacing          = get_post_meta( $item->ID, 'mega-menu-spacing', true );
				$this->megamenu_link_color       = get_post_meta( $item->ID, 'mega-menu-link-color', true );
				$this->megamenu_heading_color    = get_post_meta( $item->ID, 'mega-menu-heading-color', true );
				$this->megamenu_heading_bg_color = get_post_meta( $item->ID, 'mega-menu-heading-bg-color', true );
				$this->megamenu_column_divider   = get_post_meta( $item->ID, 'mega-menu-column-divider', true );
				$this->megamenu_items_divider    = get_post_meta( $item->ID, 'mega-menu-items-divider', true );
				$this->megamenu_border_radius    = get_post_meta( $item->ID, 'mega-menu-border-radius', true );
				$this->menu_item_id              = $item->ID;
			}
			if ( 0 < $depth ) {
				$this->megamenu_item_spacing = get_post_meta( $item->ID, 'mega-menu-item-spacing', true );
			}

			$this->column_heading              = get_post_meta( $item->ID, 'column-heading', true );
			$this->megamenu_disable_link       = get_post_meta( $item->ID, 'disable-link', true );
			$this->megamenu_disable_item_label = get_post_meta( $item->ID, 'disable-item-label', true );

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			if ( 0 === $depth && '' != $this->megamenu ) {
				$classes[] = 'kemet-megamenu-item';
				$classes[] = 'mega-menu-' . $this->megamenu_width . '-width';
			}

			if ( ! empty( $item->description ) ) {
				$classes[] = 'has-description';
			}

			$classes[] = 'menu-item-' . $item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item  Menu item data object.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			if ( '_blank' === $item->target && empty( $item->xfn ) ) {
				$atts['rel'] = 'noopener noreferrer';
			} else {
				$atts['rel'] = $item->xfn;
			}
			$atts['href']         = ! empty( $item->url ) ? $item->url : '';
			$atts['aria-current'] = $item->current ? 'page' : '';

			$item_link_classes = array();
			if ( $item->column_heading && 0 < $depth ) {
				$item_link_classes[] = 'heading-item';
			}
			if ( $item->megamenu_disable_link && 0 < $depth ) {
				$item_link_classes[] = 'kmt-disable-link';
			}

			if ( ! empty( $item_link_classes ) ) {
				$atts['class'] = implode( $item_link_classes, ' ' );
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria_current The aria-current attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$title_html = '';

			if ( ! empty( $item->description ) ) {

				$title_html = '<span>';

			}

			$title_text = $item->title;

			if ( $this->megamenu_disable_item_label && 0 < $depth ) {
				$title_text = '';
			}

			if ( isset( $item->megamenu_icon ) && ! empty( $item->megamenu_icon ) && isset( $item->megamenu_icon['icon'] ) ) {
				$icon_color                   = isset( $item->megamenu_icon_color['initial'] ) ? $item->megamenu_icon_color['initial'] : '';
				$icon_size                    = isset( $item->megamenu_icon_size ) ? $item->megamenu_icon_size : '';
				$style                        = array(
					'.main-navigation .menu-item-' . $item->ID . ' .menu-item' . $item->ID . '-icon' => array(
						'--iconColor' => esc_attr( $icon_color ),
						'--iconSize'  => kemet_slider( $icon_size ),
					),
				);
				$item->megamenu_icon['class'] = 'menu-item' . $item->ID . '-icon';
				Kemet_Addon_Mega_Menu_Partials::add_css( kemet_parse_css( $style ) );
				$title_html .= Kemet_Addon_Mega_Menu_Partials::get_icon( $item->megamenu_icon ) . $title_text;
			} else {
				$title_html .= $title_text;
			}

			if ( 0 < $depth ) {
				$spacing = $this->megamenu_item_spacing;
				$style   = array(
					'.main-navigation .menu-item-' . $item->ID => array(
						'padding-top'    => kemet_spacing( $spacing, 'top' ),
						'padding-right'  => kemet_spacing( $spacing, 'right' ),
						'padding-bottom' => kemet_spacing( $spacing, 'bottom' ),
						'padding-left'   => kemet_spacing( $spacing, 'left' ),
					),
				);
				Kemet_Addon_Mega_Menu_Partials::add_css( kemet_parse_css( $style ) );
			}

			if ( isset( $item->megamenu_label ) && ! empty( $item->megamenu_label ) ) {
				$label_color = isset( $item->megamenu_label_color['initial'] ) ? $item->megamenu_label_color['initial'] : '#ffffff';
				$label_bg    = isset( $item->megamenu_label_bg_color['initial'] ) ? $item->megamenu_label_bg_color['initial'] : 'var(--themeColor)';

				$style = array(
					'.menu-item-' . $item->ID . ' .kemet-mega-menu-label' => array(
						'color'            => esc_attr( $label_color ),
						'background-color' => esc_attr( $label_bg ),
					),
				);

				Kemet_Addon_Mega_Menu_Partials::add_css( kemet_parse_css( $style ) );

				$title_html .= '<span class="kemet-mega-menu-label">' . esc_html( $item->megamenu_label ) . '</span>';
			}

			if ( ! empty( $item->description ) ) {

				$title_html .= '</span>';

				$title_html .= '<span class="kemet-menu-decription">' . esc_html( $item->description ) . '</span>';
			}

			if ( isset( $args->container_class ) ) {
				$icon = Kemet_Svg_Icons::get_icons( 'dropdown-menu' );
			}

			if ( ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
				$title_html = $title_html . $icon;
			}

			$title = $title_html;

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';

			ob_start();
			$content = '';

			if ( false != $this->megamenu && $item->megamenu_item_content && 'default' !== $item->megamenu_item_content && ! empty( $item->megamenu_column_template ) && 0 < $depth ) {
				$template_id = explode( '-', $item->megamenu_column_template );
				$content    .= '<div class="kemet-mega-menu-content">';
				if ( class_exists( 'Kemet_Addons_Page_Builder_Compatiblity' ) ) {
					$custom_layout_compat = Kemet_Addons_Page_Builder_Compatiblity::get_instance();
					$custom_layout_compat->render_content( $template_id[1] );
				}
				$content .= ob_get_contents();
				$content .= '</div>';
			}

			ob_end_clean();
			$item_output .= $content;
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Page data object. Not used.
		 * @param int      $depth  Depth of page. Not Used.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$output .= "</li>{$n}";
		}

	}

}
