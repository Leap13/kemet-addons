<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Mega_Menu_Options' )) {
    /**
	 * mega_menu options
	 *
	 */
    class Kemet_Mega_Menu_Options {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        public function __construct() {
			$prefix = 'kemet_menu_options';

			$this->create_menu_options($prefix);
			$this->create_sections($prefix);
		}
		
		/**
		 * Create Menu Option
		 */
		public function create_menu_options($prefix)
		{
			

			KFW::createNavMenuOptions( $prefix, array(
				'data_type' => 'unserialize',
				) 
			);
		}

		/**
		 * Create Sections
		 */
		public function create_sections($prefix)
		{
			$templates_array = array(
				'' => __('Select Template', 'kemet-addons'),
			);

			$custom_layouts 	= get_posts( array( 'post_type' => 'kemet_custom_layouts', 'numberposts' => -1, 'post_status' => 'publish' ) );

			if ( ! empty ( $custom_layouts ) ) {
				foreach ( $custom_layouts as $layout ) {
					$templates_array[ $layout->ID ] = __( $layout->post_title, 'kemet-addons' );
				}
			}
			KFW::createSection( $prefix, array(
				'title'  => __('Menu Options', 'kemet-addons'),
				'fields' => array(

					array(
						'id'      => 'enable-mega-menu',
						'class'   => 'enable-mega-menu',
						'type' => 'switcher',
						'label'   => __('Enable Mega Menu', 'kemet-addons'),
						'default' => false
					),
					array(
						'id'          => 'mega-menu-width',
						'class'       => 'mega-menu-width',
						'type'        => 'select',
						'title'       => __('Mega Menu Width', 'kemet-addons'),
						'options'     => array(
							'content' => __('Content', 'kemet-addons'),
							'container' => __('Menu Container Width', 'kemet-addons'),
							'full' => __('Full', 'kemet-addons'),
						),
						'default' => 'content',
						'dependency' => array( 'enable-mega-menu', '==', 'true' ),
					),
					array(
						'id'          => 'mega-menu-columns',
						'class'       => 'mega-menu-columns',
						'type'        => 'select',
						'title'       => __('Mega Menu Columns', 'kemet-addons'),
						'options'     => array(
							1 => __('One', 'kemet-addons'),
							2 => __('Two', 'kemet-addons'),
							3 => __('Three', 'kemet-addons'),
							4 => __('Four', 'kemet-addons'),
							5 => __('Five', 'kemet-addons'),
							6 => __('Six', 'kemet-addons'),
						),
						'default' => 2,
						'dependency' => array( 'enable-mega-menu', '==', 'true' ),
					),
					array(
						'id'    => 'mega-menu-background',
						'class'   => 'mega-menu-background',
						'type'  => 'background',
						'title' => __('Mega Menu Background', 'kemet-addons'),
						'dependency' => array( 'enable-mega-menu', '==', 'true' ),
					),
					array(
						'id'      => 'disable-link',
						'class'   => 'disable-link',
						'type'    => 'checkbox',
						'label'   => __('Disable link', 'kemet-addons'),
						'dependency' => array( 'enable-mega-menu', '==', 'true' ),
						'default' => false
					),
					array(
						'id'    => 'mega-menu-icon',
						'class'   => 'mega-menu-icon',
						'type'  => 'icon', 
						'title' => __('Icon','kemet-addons' ),
					),
					array(
						'id'    => 'mega-menu-spacing',
						'class' => 'mega-menu-spacing',
						'type'  => 'spacing',
						'title' => __('Spacing', 'kemet-addons'),
						'dependency' => array( 'enable-mega-menu', '==', 'true' ),
					),
				)
			  ) 
			);
			KFW::createSection( $prefix, array(
				'fields' => array(
					array(
						'id'      => 'disable-item-label',
						'class'   => 'disable-item-label',
						'type'    => 'checkbox',
						'label'   => __('Hide Menu Item Text', 'kemet-addons'),
						'default' => false
					),
					array(
						'id'      => 'column-heading',
						'class'   => 'column-heading',
						'type'    => 'checkbox',
						'label'   => __('Make This Item As Column Heading', 'kemet-addons'),
						'default' => false
					),
					array(
						'id'          => 'column-template',
						'type'        => 'select',
						'class'       => 'mega-menu-field-template',
						'title'       => __('Content Source', 'kemet-addons'),
						'options'     => $templates_array
					)
				)
			  ) 
			);
			KFW::createSection( $prefix, array(
				'title'  => __('Label', 'kemet-addons'),
				'fields' => array(
					array(
						'id'      => 'label-text',
						'class'   	  => 'label-text',
						'type'    => 'text',
						'title'   => __('Menu Label', 'kemet-addons'),
					),
					array(
						'id'    => 'label-color',
						'class'   	  => 'label-color',
						'type'  => 'color',
						'title' => __('Label Color', 'kemet-addons'),
					),
					array(
						'id'    => 'label-bg-color',
						'class'   	  => 'label-bg-color',
						'type'  => 'color',
						'title' => __('Label Background Color', 'kemet-addons'),
						'default' => '#f0f0f0'
					),
				)
			  ) 
			);
		}
    }
}
Kemet_Mega_Menu_Options::get_instance();