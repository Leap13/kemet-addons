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
	 * @since 1.0.10
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
			KFW::createSection( $prefix, array(
				'title'  => __('Mega Menu', 'kemet-addons'),
				'fields' => array(

					array(
						'id'      => 'enable-mega-menu',
						'class'   => 'enable-mega-menu',
						'type' => 'switcher',
						'label'   => 'Enable Mega Menu',
						'default' => false
					),
					array(
						'id'          => 'mega-menu-width',
						'class'       => 'mega-menu-width',
						'type'        => 'select',
						'title'       => 'Mega Menu Width',
						'options'     => array(
							'content' => 'Content',
							'container' => 'Menu Container Width',
							'full' => 'Full',
						),
						'default' => 'content'
					),
					array(
						'id'    => 'mega-menu-columns',
						'class'   => 'enable-mega-menu',
						'type'  => 'number',
						'title' => 'Mega Menu Columns',
					),
					array(
						'id'    => 'mega-menu-background',
						'class'   => 'mega-menu-background',
						'type'  => 'background',
						'title' => 'Mega Menu Background',
					),
					array(
						'id'      => 'disable-link',
						'class'   => 'disable-link',
						'type'    => 'checkbox',
						'label'   => 'Disable link',
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
						'title' => 'Spacing',
					),
					array(
						'id'      => 'sub-title',
						'class'   => 'sub-title',
						'type'    => 'text',
						'title'   => 'Subtitle',
					),
				)
			  ) 
			);
			KFW::createSection( $prefix, array(
				'fields' => array(
					array(
						'id'      => 'column-heading',
						'class'   => 'column-heading',
						'type'    => 'checkbox',
						'label'   => 'Make This Item As Column Heading',
						'default' => false
					),
					array(
						'id'          => 'column-template',
						'type'        => 'select',
						'class'       => 'mega-menu-field-template',
						'title'       => 'Content Source',
						'options'     => array(
							'' => 'Select an Template',
						),
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
						'title'   => 'Menu Label',
					),
					array(
						'id'    => 'label-color',
						'class'   	  => 'label-color',
						'type'  => 'color',
						'title' => 'Label Color',
					),
					array(
						'id'    => 'label-bg-color',
						'class'   	  => 'label-bg-color',
						'type'  => 'color',
						'title' => 'Label Background Color',
					),
				)
			  ) 
			);
		}
    }
}
Kemet_Mega_Menu_Options::get_instance();