<?php
/**
 * Mega menu
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Addon_Mega_Menu_Options' ) ) {
	/**
	 * Mega_menu options
	 */
	class Kemet_Addon_Mega_Menu_Options {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
		}

		/**
		 * get_item_fields
		 *
		 * @return array
		 */
		public function get_item_fields() {
			$fields = array(
				'mega-menu-title'      => array(
					'type'  => 'kmt-title',
					'label' => __( 'Menu Options', 'kemet-addons' ),
				),
				'enable-mega-menu'     => array(
					'type'    => 'kmt-switcher',
					'label'   => __( 'Enable Mega Menu', 'kemet-addons' ),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
					),
				),
				'mega-menu-width'      => array(
					'type'    => 'kmt-select',
					'label'   => __( 'Mega Menu Width', 'kemet-addons' ),
					'choices' => array(
						'content'   => __( 'Content', 'kemet-addons' ),
						'container' => __( 'Menu Container Width', 'kemet-addons' ),
						'full'      => __( 'Full', 'kemet-addons' ),
					),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'mega-menu-columns'    => array(
					'type'    => 'kmt-radio',
					'default' => 2,
					'label'   => __( 'Mega Menu Columns', 'kemet-addons' ),
					'choices' => array(
						1 => __( '1', 'kemet-addons' ),
						2 => __( '2', 'kemet-addons' ),
						3 => __( '3', 'kemet-addons' ),
						4 => __( '4', 'kemet-addons' ),
						5 => __( '5', 'kemet-addons' ),
						6 => __( '6', 'kemet-addons' ),
					),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'mega-menu-background' => array(
					'type'    => 'kmt-background',
					'label'   => __( 'Mega Menu Background', 'kemet-addons' ),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'disable-link'         => array(
					'type'    => 'kmt-switcher',
					'label'   => __( 'Disable link', 'kemet-addons' ),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'mega-menu-icon'       => array(
					'type'    => 'icon-picker',
					'label'   => __( 'Icon', 'kemet-addons' ),
					'context' => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'mega-menu-spacing'    => array(
					'type'           => 'kmt-spacing',
					'responsive'     => false,
					'label'          => __( 'Spacing', 'kemet-addons' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kemet' ),
						'right'  => __( 'Right', 'kemet' ),
						'bottom' => __( 'Bottom', 'kemet' ),
						'left'   => __( 'Left', 'kemet' ),
					),
					'context'        => array(
						array(
							'setting' => 'depth',
							'value'   => 0,
						),
						array(
							'setting' => 'enable-mega-menu',
							'value'   => true,
						),
					),
				),
				'disable-item-label'   => array(
					'type'  => 'kmt-switcher',
					'label' => __( 'Hide Menu Item Text', 'kemet-addons' ),
				),
				'column-heading'       => array(
					'type'  => 'kmt-switcher',
					'label' => __( 'Make This Item As Column Heading', 'kemet-addons' ),
				),
				'enable-template'      => array(
					'type'  => 'kmt-switcher',
					'label' => __( 'Enable Templates', 'kemet-addons' ),
				),
				'column-template'      => array(
					'type'    => 'kmt-select',
					'label'   => __( 'Content Source', 'kemet-addons' ),
					'class'   => 'mega-menu-field-template',
					'choices' => array(
						'' => 'Select an Template',
					),
					'context' => array(
						array(
							'setting' => 'enable-template',
							'value'   => true,
						),
					),
				),
				'menu-label-title'     => array(
					'type'  => 'kmt-title',
					'label' => __( 'Item Settings', 'kemet-addons' ),
				),
				'label-text'           => array(
					'type'  => 'kmt-text',
					'label' => __( 'Menu Label', 'kemet-addons' ),
				),
				'label-color'          => array(
					'type'    => 'kmt-color',
					'label'   => __( 'Label Color', 'kemet-addons' ),
					'pickers' => array(
						array(
							'id'    => 'initial',
							'title' => __( 'Initial', 'kemet-addons' ),
						),
					),
					'context' => array(
						array(
							'setting'  => 'label-text',
							'operator' => 'not_empty',
						),
					),
				),
				'label-bg-color'       => array(
					'type'    => 'kmt-color',
					'label'   => __( 'Label Background Color', 'kemet-addons' ),
					'pickers' => array(
						array(
							'id'    => 'initial',
							'title' => __( 'Initial', 'kemet-addons' ),
						),
					),
					'context' => array(
						array(
							'setting'  => 'label-text',
							'operator' => 'not_empty',
						),
					),
				),
			);

			return $fields;
		}

		/**
		 * Create Sections
		 *
		 * @param string $prefix sections prefix.
		 * @return void
		 */
		public function create_sections( $prefix ) {
			KFW::create_section(
				$prefix,
				array(
					'title'  => __( 'Menu Options', 'kemet-addons' ),
					'fields' => array(

						array(
							'id'      => 'enable-mega-menu',
							'class'   => 'enable-mega-menu',
							'type'    => 'switcher',
							'label'   => __( 'Enable Mega Menu', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'         => 'mega-menu-width',
							'class'      => 'mega-menu-width',
							'type'       => 'select',
							'title'      => __( 'Mega Menu Width', 'kemet-addons' ),
							'options'    => array(
								'content'   => __( 'Content', 'kemet-addons' ),
								'container' => __( 'Menu Container Width', 'kemet-addons' ),
								'full'      => __( 'Full', 'kemet-addons' ),
							),
							'default'    => 'content',
							'dependency' => array( 'enable-mega-menu', '==', 'true' ),
						),
						array(
							'id'         => 'mega-menu-columns',
							'class'      => 'mega-menu-columns',
							'type'       => 'select',
							'title'      => __( 'Mega Menu Columns', 'kemet-addons' ),
							'options'    => array(
								1 => __( 'One', 'kemet-addons' ),
								2 => __( 'Two', 'kemet-addons' ),
								3 => __( 'Three', 'kemet-addons' ),
								4 => __( 'Four', 'kemet-addons' ),
								5 => __( 'Five', 'kemet-addons' ),
								6 => __( 'Six', 'kemet-addons' ),
							),
							'default'    => 2,
							'dependency' => array( 'enable-mega-menu', '==', 'true' ),
						),
						array(
							'id'         => 'mega-menu-background',
							'class'      => 'mega-menu-background',
							'type'       => 'background',
							'title'      => __( 'Mega Menu Background', 'kemet-addons' ),
							'dependency' => array( 'enable-mega-menu', '==', 'true' ),
						),
						array(
							'id'         => 'disable-link',
							'class'      => 'disable-link',
							'type'       => 'checkbox',
							'label'      => __( 'Disable link', 'kemet-addons' ),
							'dependency' => array( 'enable-mega-menu', '==', 'true' ),
							'default'    => false,
						),
						array(
							'id'    => 'mega-menu-icon',
							'class' => 'mega-menu-icon',
							'type'  => 'icon',
							'title' => __( 'Icon', 'kemet-addons' ),
						),
						array(
							'id'         => 'mega-menu-spacing',
							'class'      => 'mega-menu-spacing',
							'type'       => 'spacing',
							'title'      => __( 'Spacing', 'kemet-addons' ),
							'dependency' => array( 'enable-mega-menu', '==', 'true' ),
						),
					),
				)
			);
			KFW::create_section(
				$prefix,
				array(
					'fields' => array(
						array(
							'id'      => 'disable-item-label',
							'class'   => 'disable-item-label',
							'type'    => 'checkbox',
							'label'   => __( 'Hide Menu Item Text', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'      => 'column-heading',
							'class'   => 'column-heading',
							'type'    => 'checkbox',
							'label'   => __( 'Make This Item As Column Heading', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'      => 'enable-template',
							'class'   => 'enable-template',
							'type'    => 'switcher',
							'label'   => __( 'Enable Templates', 'kemet-addons' ),
							'default' => false,
						),
						array(
							'id'         => 'column-template',
							'type'       => 'select',
							'class'      => 'mega-menu-field-template',
							'title'      => __( 'Content Source', 'kemet-addons' ),
							'options'    => array(
								'' => 'Select an Template',
							),
							'dependency' => array( 'enable-template', '==', 'true' ),
						),
					),
				)
			);
			KFW::create_section(
				$prefix,
				array(
					'title'  => __( 'Label', 'kemet-addons' ),
					'fields' => array(
						array(
							'id'    => 'label-text',
							'class' => 'label-text',
							'type'  => 'text',
							'title' => __( 'Menu Label', 'kemet-addons' ),
						),
						array(
							'id'    => 'label-color',
							'class' => 'label-color',
							'type'  => 'color',
							'title' => __( 'Label Color', 'kemet-addons' ),
						),
						array(
							'id'      => 'label-bg-color',
							'class'   => 'label-bg-color',
							'type'    => 'color',
							'title'   => __( 'Label Background Color', 'kemet-addons' ),
							'default' => '#f0f0f0',
						),
					),
				)
			);
		}
	}
}
Kemet_Addon_Mega_Menu_Options::get_instance();
