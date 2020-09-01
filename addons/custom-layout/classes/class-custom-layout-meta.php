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
          add_action( 'add_meta_boxes_kemet_custom_layouts', array( $this, 'register_short_code_meta_boxes' ) );
          add_filter( 'manage_posts_columns',  array( $this, 'shortcode_column') );
          add_action('manage_kemet_custom_layouts_posts_custom_column',array($this , 'shortcode_column_content') , 10, 2);
        }

        function get_array_value(){

          $options = array();
          $locations = Kemet_Custom_Layout_Partials::get_location_options();
          $users = Kemet_Custom_Layout_Partials::get_user_rules_options();

          foreach( $locations  as $key => $value){

            if($key != 'specific-position'){
              $options = array_merge($options, $value['value']);
            }
            
          }

          foreach( $users  as $key => $value){
            if($key != 'specific-position'){
              $options = array_merge($options, $value['value']);
            }
          }

          return $options;
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

        /**
         * Register meta box.
         */
        function register_short_code_meta_boxes($post) {
          add_meta_box( 'kemet-custom-layout-short-code', __( 'Short Code', 'kemet-addons' ), function($post){ ?>

              <input type="text" class="widefat" value='[kemet_custom_layout id="<?php echo $post->ID; ?>"]' readonly />
        <?php },
        'kemet_custom_layouts',
        'side',
        'low'   
        );
        }

        function shortcode_column( $columns ){
          
          $post_type = get_post_type();
          if ( $post_type == 'kemet_custom_layouts' ) {
              $custom_columns = array(
                  'kemet_layout_action' => esc_html__( 'Action', 'kemet-addons' ),
                  'kemet_layout_rules' => esc_html__( 'Rules', 'kemet-addons' ),
                  'kemet_short_code' => esc_html__( 'Short Code', 'kemet-addons' ),
              );
              $columns = array_merge($columns, $custom_columns);
          }

          return $columns;
        }

        function get_post_title($id){

          $post_id = explode("-", $id)[1]; 
          if(!empty($post_id)){

            $name = !empty(get_the_title( $post_id )) ? get_the_title( $post_id ) : get_term( $post_id )->name  ;
            return $name;
          }

        }
        function shortcode_column_content($column_key, $post_id) {

          switch ($column_key) {
            case 'kemet_short_code':
              $short_code = sprintf( '[kemet_custom_layout id="%s"]' , $post_id );
              
              printf( '<input type="text" value="%s" style="min-width: 237px;" readonly \>' , esc_attr($short_code) );
              break;
            
            case 'kemet_layout_rules':

              $meta = get_post_meta( $post_id, 'kemet_custom_layout_options', true );
              $display_rules = isset($meta['display-on-group']['display-on-rule']) ? $meta['display-on-group']['display-on-rule'] : '';
              $hide_rules = isset($meta['hide-on-group']['hide-on-rule']) ? $meta['hide-on-group']['hide-on-rule'] : '';
              $specific_display = isset($meta['display-on-group']['display-on-specifics-location']) ? $meta['display-on-group']['display-on-specifics-location'] : '';
			        $specific_hide = isset($meta['hide-on-group']['hide-on-specifics-location']) ? $meta['hide-on-group']['hide-on-specifics-location'] : '';
              $users = isset($meta['user-rules']) ? $meta['user-rules'] : '';
              $all_options = self::get_array_value();

              $all_display_rules = array(
                  'display' => array(),
                  'hide'   => array(),
                  'users'  => array()
              );
              if(is_array($users)){
                foreach($users as $user){
                  $all_display_rules['users'][] = __( $all_options[$user],'kemet-addons' );
                }
              }
              if(is_array($display_rules)){
                foreach($display_rules as $position){

                  if($position != 'specifics-location'){
                    $all_display_rules['display'][] = __( $all_options[$position],'kemet-addons' );
                  }
                  
                }
              }
              if(is_array($hide_rules)){
                foreach($hide_rules as $position){
                  if($position != 'specifics-location'){
                    $all_display_rules['hide'][] = __( $all_options[$position],'kemet-addons' );
                  }
                }
              }
              
              if(is_array($specific_display)){
                foreach($specific_display as $position){
                  $all_display_rules['display'][] = __( self::get_post_title($position),'kemet-addons' );
                }
              }
              if(is_array($specific_hide)){
                foreach($specific_hide as $position){
                  $specific_hide['hide'][] = __( self::get_post_title($position),'kemet-addons' );
                }
              }

              echo "<div class='kmt-rules-column'>";
                if(!empty($all_display_rules['display'])){
                  echo '<p>' ;
                  echo '<strong>Display: </strong>';
                  echo implode(", ", $all_display_rules['display']);
                  echo '</p>'; 
                }
                if(!empty($all_display_rules['hide'])){
                  echo '<p>' ;
                  echo '<strong>Hide: </strong>';
                  echo implode(", ", $all_display_rules['hide']);
                  echo '</p>'; 
                }
                if(!empty($all_display_rules['users'])){
                  echo '<p>' ;
                  echo '<strong>Users: </strong>';
                  echo implode(", ", $all_display_rules['users']);
                  echo '</p>'; 
                }
              echo "</div>";
              break;

            case 'kemet_layout_action':

              $meta = get_post_meta( $post_id, 'kemet_custom_layout_options', true );
              $action = isset($meta['hook-action']) ? $meta['hook-action'] : '';
              
            echo "<div class='kmt-action-column'>";
            if(!empty($action)){
              echo '<p>' ;
              echo $action;
              echo '</p>'; 
            }
            echo "</div>";
              
              break;
          }

        }
    }
}
Kemet_Custom_Layout_Meta::get_instance();

