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
			$content_options  = array(
				'default' => __( 'Default (Menu Item)', 'kemet-addons' ),
			);
			$custom_templates = array(
				'elementor_library'    => __( 'Elementor templates', 'kemet-addons' ),
				'wp_block'             => __( 'Reusable blocks', 'kemet-addons' ),
				'kemet_custom_content' => __( 'Kemet Custom Content', 'kemet-addons' ),
			);

			foreach ( $custom_templates as $key => $title ) {
				if ( post_type_exists( $key ) ) {
					$content_options[ $key ] = $title;
				}
			}

			$fields = array(
				'mega-menu-tabs' => array(
					'type' => 'kmt-tabs',
					'tabs' => array(
						'general' => array(
							'title'   => __( 'General', 'kemet-addons' ),
							'options' => array(
								'enable-mega-menu'    => array(
									'type'    => 'kmt-switcher',
									'label'   => __( 'Enable Mega Menu', 'kemet-addons' ),
									'context' => array(
										array(
											'setting' => 'depth',
											'value'   => 0,
										),
									),
								),
								'mega-menu-width'     => array(
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
								'mega-menu-columns'   => array(
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
								'mega-menu-layout'    => array(
									'type'    => 'kmt-row-layout',
									'label'   => __( 'Layout', 'kemet' ),
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
								'template-title'      => array(
									'type'    => 'kmt-title',
									'label'   => __( 'Custom content', 'kemet-addons' ),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
										array(
											'setting'  => 'enable-mega-menu',
											'operator' => 'parent',
											'value'    => true,
										),
									),
								),
								'item-content'        => array(
									'type'    => 'kmt-select',
									'default' => 'default',
									'label'   => __( 'Content Type', 'kemet-addons' ),
									'choices' => $content_options,
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
										array(
											'setting'  => 'enable-mega-menu',
											'operator' => 'parent',
											'value'    => true,
										),
									),
								),
								'column-template'     => array(
									'type'    => 'kmt-select',
									'label'   => __( 'Content Source', 'kemet-addons' ),
									'class'   => 'mega-menu-field-template',
									'choices' => array(),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
										array(
											'setting'  => 'item-content',
											'operator' => 'in_array',
											'value'    => array( 'elementor_library', 'wp_block', 'kemet_custom_content' ),
										),
										array(
											'setting'  => 'enable-mega-menu',
											'operator' => 'parent',
											'value'    => true,
										),
									),
								),
								'label-title'         => array(
									'type'    => 'kmt-title',
									'label'   => __( 'Item Label Settings', 'kemet-addons' ),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'disable-link'        => array(
									'type'    => 'kmt-switcher',
									'label'   => __( 'Disable link', 'kemet-addons' ),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'disable-item-label'  => array(
									'type'    => 'kmt-switcher',
									'label'   => __( 'Hide Menu Item Text', 'kemet-addons' ),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'column-heading'      => array(
									'type'    => 'kmt-switcher',
									'label'   => __( 'Make This Item As Column Heading', 'kemet-addons' ),
									'context' => array(
										array(
											'setting' => 'disable-item-label',
											'value'   => false,
										),
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'icon-title'          => array(
									'type'  => 'kmt-title',
									'label' => __( 'Item Icon Settings', 'kemet-addons' ),
								),
								'mega-menu-icon'      => array(
									'type'  => 'icon-picker',
									'label' => __( 'Icon', 'kemet-addons' ),
								),
								'mega-menu-icon-size' => array(
									'type'         => 'kmt-slider',
									'responsive'   => false,
									'label'        => __( 'Icon Size', 'kemet-addons' ),
									'unit_choices' => array(
										'px' => array(
											'min'  => 1,
											'step' => 1,
											'max'  => 50,
										),
									),
								),
								'menu-label-title'    => array(
									'type'  => 'kmt-title',
									'label' => __( 'Menu Item Badge', 'kemet-addons' ),
								),
								'label-text'          => array(
									'type'  => 'kmt-text',
									'label' => __( 'Menu Item Badge Text', 'kemet-addons' ),
								),
							),
						),
						'design'  => array(
							'title'   => __( 'Design', 'kemet-addons' ),
							'options' => array(
								'mega-menu-design-title'   => array(
									'type'    => 'kmt-title',
									'label'   => __( 'Mega Menu Settings', 'kemet-addons' ),
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
								'mega-menu-background'     => array(
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
								'mega-menu-link-color'     => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Link Colors', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
										array(
											'id'    => 'hover',
											'title' => __( 'hover', 'kemet-addons' ),
										),
										array(
											'id'    => 'background',
											'title' => __( 'Background', 'kemet-addons' ),
										),
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
								'mega-menu-heading-color'  => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Headings Color', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
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
								'mega-menu-heading-bg-color' => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Headings Background Color', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
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
								'mega-menu-items-divider'  => array(
									'divider' => true,
									'type'    => 'kmt-border',
									'label'   => __( 'Items Divider', 'kemet-addons' ),
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
								'mega-menu-column-divider' => array(
									'divider' => true,
									'type'    => 'kmt-border',
									'label'   => __( 'Column Divider', 'kemet-addons' ),
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
								'mega-menu-border-radius'  => array(
									'type'           => 'kmt-spacing',
									'responsive'     => false,
									'label'          => __( 'Border Radius', 'kemet-addons' ),
									'linked_choices' => true,
									'unit_choices'   => array( 'px' ),
									'choices'        => array(
										'top'    => __( 'Top', 'kemet-addons' ),
										'right'  => __( 'Right', 'kemet-addons' ),
										'bottom' => __( 'Bottom', 'kemet-addons' ),
										'left'   => __( 'Left', 'kemet-addons' ),
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
								'mega-menu-spacing'        => array(
									'type'           => 'kmt-spacing',
									'responsive'     => false,
									'divider'        => true,
									'label'          => __( 'Padding', 'kemet-addons' ),
									'linked_choices' => true,
									'unit_choices'   => array( 'px' ),
									'choices'        => array(
										'top'    => __( 'Top', 'kemet-addons' ),
										'right'  => __( 'Right', 'kemet-addons' ),
										'bottom' => __( 'Bottom', 'kemet-addons' ),
										'left'   => __( 'Left', 'kemet-addons' ),
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
								'column-setting-title'     => array(
									'type'    => 'kmt-title',
									'label'   => __( 'Column Settings', 'kemet-addons' ),
									'context' => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'mega-menu-item-spacing'   => array(
									'type'           => 'kmt-spacing',
									'responsive'     => false,
									'label'          => __( 'Item Padding', 'kemet-addons' ),
									'linked_choices' => true,
									'unit_choices'   => array( 'px' ),
									'choices'        => array(
										'top'    => __( 'Top', 'kemet-addons' ),
										'right'  => __( 'Right', 'kemet-addons' ),
										'bottom' => __( 'Bottom', 'kemet-addons' ),
										'left'   => __( 'Left', 'kemet-addons' ),
									),
									'context'        => array(
										array(
											'setting'  => 'depth',
											'operator' => '>',
											'value'    => 0,
										),
									),
								),
								'menu-item-settings-title' => array(
									'type'  => 'kmt-title',
									'label' => __( 'Item Label Settings', 'kemet-addons' ),
								),
								'mega-menu-icon-color'     => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Icon Color', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
									),
								),
								'menu-badge-title'         => array(
									'type'  => 'kmt-title',
									'label' => __( 'Menu Item Badge', 'kemet-addons' ),
								),
								'label-color'              => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Font Color', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
									),
								),
								'label-bg-color'           => array(
									'type'    => 'kmt-color',
									'label'   => __( 'Background Color', 'kemet-addons' ),
									'pickers' => array(
										array(
											'id'    => 'initial',
											'title' => __( 'Initial', 'kemet-addons' ),
										),
									),
								),
							),
						),
					),
				),
			);

			return $fields;
		}
	}
}
Kemet_Addon_Mega_Menu_Options::get_instance();
