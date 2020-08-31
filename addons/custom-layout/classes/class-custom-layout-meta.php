<?php
/**
 * custom layout
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Custom_Layout_Meta' )) {
    /**
	 * custom_layout options
	 *
	 */
    class Kemet_Custom_Layout_Meta {
        
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
          $prefix_page_opts = 'kemet_custom_layout_options';
          $code_editor_prefix = 'kemet_code_editor';
          $short_code_mete_prefix = 'kemet_short_code';

          $this->create_custom_layout_meta($prefix_page_opts);
          $this->create_code_editor($code_editor_prefix);
          $this->create_short_code( $short_code_mete_prefix );
        }

        function get_options_array($array_type){

          $options = array();
          switch ($array_type) {
            case 'hooks':
              $options = Kemet_Custom_Layout_Partials::get_hooks_options();
              break;
            case 'locations':
              $options = Kemet_Custom_Layout_Partials::get_location_options();
              break;
            case 'users':
              $options = Kemet_Custom_Layout_Partials::get_user_rules_options();
              break;  
          }

          $select_options = array();

          if(!empty($options)){
            foreach($options as $key => $value){
              foreach($value['value'] as $val => $label){
                 $select_options[ __($value['title'], 'kemet-addons') ][$val] = esc_html__($label, 'kemet-addons');
              }
           }
           return $select_options;

          }else{
            return;
          }
          
        }
        /**
         * Create Meta
         */
        public function create_custom_layout_meta($prefix)
        {

          KFW::createMetabox( $prefix, array(
            'title'        => __('Kemet Page Options', 'kemet-addons'),
            'priority'     => 'high',
            'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
            'data_type'      => 'serialize',
            'theme'   => 'light',
          ) );

          KFW::createSection( $prefix, array(
            'priority_num' => 1,
            'fields' => array(
                array(
                  'id'          => 'hook-action',
                  'type'        => 'select',
                  'class'       => 'kmt-hooks-select',
                  'title'       => __('Action', 'kemet-addons'),
                  'desc'        => __('Select an option', 'kemet-addons'),
                  'placeholder' => __('Select an option', 'kemet-addons'),
                  'default'     => '',
                  'options'     => self::get_options_array('hooks'),
                ),  
                array(
                  'id'    => 'hook-priority',
                  'type'  => 'number',
                  'title' => __('Priority', 'kemet-addons' ),
                  'default' => 10
                ), 
                array(
                  'id'    => 'spacing-top',
                  'type'  => 'number',
                  'title' => __('Spacing Top', 'kemet-addons' ),
                  'unit'  => 'px',
                  'output_mode' => 'padding',
                  'default' => 0
                ), 
                array(
                  'id'    => 'spacing-bottom',
                  'type'  => 'number',
                  'title' => __('Spacing Bottom', 'kemet-addons' ),
                  'unit'  => 'px',
                  'output_mode' => 'padding',
                  'default' => 0
                ),
                array(
                  'id'     => 'display-on-group',
                  'type'   => 'fieldset',
                  'title'  => __('Display On', 'kemet-addons'),
                  'fields' => array(
                    array(
                      'id'    => 'display-on-rule',
                      'class'    => 'display-on-rule',
                      'type'  => 'select',
                      'multiple'    => true,
                      'placeholder' => __('Select an option', 'kemet-addons'),
                      'options'     => self::get_options_array('locations'),
                    ),
                    array(
                      'id'          => 'display-on-specifics-location',
                      'type'        => 'select',
                      'class'       => 'kmt-display-on-specifics-select',
                      'default'     => '',
                      'multiple'    => true,
                      'title'  => __('Specific Locations', 'kemet-addons'),
                      'options'     => array(
                        '' => __('Select an option', 'kemet-addons'),
                      ),
                    ),
                  ),
                ),  
                array(
                  'id'     => 'hide-on-group',
                  'type'   => 'fieldset',
                  'title'  => __('Hide On', 'kemet-addons'),
                  'fields' => array(
                    array(
                      'id'    => 'hide-on-rule',
                      'type'  => 'select',
                      'class'    => 'hide-on-rule',
                      'multiple'    => true,
                      'placeholder' => __('Select an option', 'kemet-addons'),
                      'options'     => self::get_options_array('locations'),
                    ),
                    array(
                      'id'          => 'hide-on-specifics-location',
                      'type'        => 'select',
                      'class'       => 'kmt-hide-on-specifics-select',
                      'title'       => __('Specific Locations', 'kemet-addons'),
                      'multiple'    => true,
                      'options'     => array(
                        '' => __('Select an option', 'kemet-addons'),
                      ),
                    ),
                  ),
                ),
                array(
                  'id'    => 'user-rules',
                  'class'    => 'kmt-user-rules',
                  'type'  => 'select',
                  'title'  => __('User Rules', 'kemet-addons'),
                  'multiple'    => true,
                  'placeholder' => __('Select an option', 'kemet-addons'),
                  'options'     => self::get_options_array('users'),
                ),
              )
            ) 
          );
        }

        public function create_code_editor($prefix)
        {

          KFW::createMetabox( $prefix, array(
            'title'        => __('Kemet Code Editor', 'kemet-addons'),
            'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
            'data_type'      => 'unserialize',
            'theme'   => 'light',
            'priority'  => 'high',
          ) );
          //
          // Create a section
          //
          KFW::createSection( $prefix, array(
            'priority_num' => 1,
            'fields' => array(
                array(
                  'id'    => 'enable-code-editor',
                  'type'  => 'switcher',
                  'class' => 'enable-code-editor',
                  'title' => __('Enable Code Editor', 'kemet-addons'),
                ),
                array(
                  'title'        => __('Code Editor', 'kemet-addons'),
                  'id'       => 'kemet-hook-custom-code',
                  'class'   => 'kemet-hook-custom-code',
                  'type'     => 'textarea',
                  'data_type' => 'unserialize',
                  'default'   => esc_html__('<!-- Add your snippet here. -->', 'kemet-addons'),
                ),
              )
            )
          );
        }

        public function create_short_code($prefix)
        {
          
          $post_id = '';

          if(isset($_GET['post'])){
            $post_id = $_GET['post'];
          }else{
            global $wpdb;

            $result  = $wpdb->get_results( "SHOW TABLE STATUS LIKE 'wp_posts'", ARRAY_A );
            $post_id = $result[0]['Auto_increment'];
          }
          KFW::createMetabox( $prefix, array(
            'title'        => __('Short Code', 'kemet-addons'),
            'post_type'    =>  array( KEMET_CUSTOM_LAYOUT_POST_TYPE ),
            'data_type'      => 'unserialize',
            'context'  => 'side'
          ) );
          //
          // Create a section
          //
          KFW::createSection( $prefix, array(
            'priority_num' => 1,
            'fields' => array(
                array(
                  'id'       => 'kemet-custom-layout-short-code',
                  'type'    => 'text',
                  'class'   => 'kemet-short-code',
                  'default' => $post_id,
                  'data_type'      => 'unserialize',
                  'attributes' => array(
                    'readonly' => 'readonly',           
                  )
                ),
              )
            )
          );
        }
    }
}
Kemet_Custom_Layout_Meta::get_instance();

