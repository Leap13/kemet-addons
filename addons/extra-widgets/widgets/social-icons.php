<?php
/**
 * Mailchimp Widget.
 *
 * @package Kemet Addons
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Kemet_Social_Icons_Widget' ) ) {
    class Kemet_Social_Icons_Widget extends WP_Widget {
       public $fields = array(
          array(
            'id'      => 'title',
            'type'    => 'text',
            'title'   => 'Title',
          ),
          array(
            'id'     => 'social-profile',
            'type'   => 'repeater',
            'title'  => 'Add Profile',
            'fields' => array(
          
              array(
                'id'    => 'profile-title',
                'type'  => 'text',
                'title' => 'Title'
              ),
              array(
                'id'    => 'link',
                'type'  => 'text',
                'title' => 'Link'
              ),
              array(
                'id'          => 'link-target',
                'type'        => 'select',
                'title'       => 'Target',
                'options'     => array(
                  'same-page'  => 'Same Page',
                  'new-page'  => 'New Page',
                ),
                'default'     => 'new-page'
              ),
              array(
                'id'    => 'no-follow',
                'type'  => 'switcher',
                'title' => 'No Follow',
              ),
              array(
                'id'    => 'social-icon',
                'type'  => 'icon',
                'title' => 'Icon',
              ),
            ),
          ),
    
          array(
            'id'          => 'alignment',
            'type'        => 'select',
            'title'       => 'Alignment',
            'options'     => array(
              'inline'  => 'Inline',
              'stack'  => 'Stack',
            ),
            'default'     => 'inline'
          ),
          array(
            'id'          => 'icon-style',
            'type'        => 'select',
            'title'       => 'Icon Style',
            'options'     => array(
              'simple'  => 'Simple',
              'circle'  => 'Circle',
              'square'  => 'Square',
              'circle-outline'  => 'Circle Outline',
              'square-outline'  => 'Square Outline',
            ),
            'default'     => 'simple'
          ),
          array(
            'id'          => 'icon-color-mode',
            'type'        => 'select',
            'title'       => 'Icon Color',
            'options'     => array(
              'official-color'  => 'Official Color',
              'custom'  => 'Custom',
            ),
            'default'     => 'official-color',
          ),
          array(
            'id'    => 'icon-color',
            'type'  => 'color',
            'title' => 'Color',
            'dependency' => array( 'icon-color-mode', '==', 'custom' ),
          ),
          array(
            'id'    => 'icon-bg-color',
            'type'  => 'color',
            'title' => 'Background Color',
            'dependency' => array( 'icon-color-mode', '==', 'custom' ),
          ),
          array(
            'id'    => 'icon-hover-color',
            'type'  => 'color',
            'title' => 'Icon Hover Color',
            'dependency' => array( 'icon-color-mode', '==', 'custom' ),
          ),
          array(
            'id'    => 'icon-hover-bg-color',
            'type'  => 'color',
            'title' => 'Background Hover Color',
            'dependency' => array( 'icon-color-mode', '==', 'custom' ),
          ),
          array(
            'id'    => 'icon-width',
            'type'  => 'number',
            'title' => 'Icon Width',
            'unit'  => 'px',
            'output_mode' => 'width'
          ),
          array(
            'id'    => 'space-between-icon-text',
            'type'  => 'number',
            'title' => 'Space Between Icon & Text:',
            'unit'  => 'px',
            'output_mode' => 'padding'
          ),
          array(
            'id'    => 'space-between-profiles',
            'type'  => 'number',
            'title' => 'Space Between Social Profiles:',
            'unit'  => 'px',
          'output_mode' => 'padding'
          ),
      );
     public $test2 =  array(
        'id'     => 'social-profile',
        'type'   => 'repeater',
        'title'  => 'Add Profile',
        'fields' => array(
      
          array(
            'id'    => 'profile-title',
            'type'  => 'text',
            'title' => 'Title'
          ),
          array(
            'id'    => 'link',
            'type'  => 'text',
            'title' => 'Link'
          ),
          array(
            'id'          => 'link-target',
            'type'        => 'select',
            'title'       => 'Target',
            'options'     => array(
              'same-page'  => 'Same Page',
              'new-page'  => 'New Page',
            ),
            'default'     => 'new-page'
          ),
          array(
            'id'    => 'no-follow',
            'type'  => 'switcher',
            'title' => 'No Follow',
          ),
          array(
            'id'    => 'social-icon',
            'type'  => 'icon',
            'title' => 'Icon',
          ),
        ),
      );
      public $unique  = '';
      public $args    = array(
        'title'       => '',
        'classname'   => '',
        'description' => '',
        'width'       => '',
        'defaults'    => array(),
        'fields'      => array(array(
                      'id'          => 'icon-color-mode',
                      'type'        => 'select',
                      'title'       => 'Icon Color',
                      'options'     => array(
                        'official-color'  => 'Official Color',
                        'custom'  => 'Custom',
                      ),
                      'default'     => 'custom',
                      )),
        'class'       => '',
      );
    public function __construct() {
        parent::__construct(
            'social-icons',
            esc_html__('Kemet Social Icons', 'kemet-addons'),
            array( 'description' => esc_html__('Mailchimp subscribe widget', 'kemet-addons'))
        );
    }
    // get default value
    public function get_default( $field, $options = array() ) {

      $default = ( isset( $this->args['defaults'][$field['id']] ) ) ? $this->args['defaults'][$field['id']] : null;
      $default = ( isset( $field['default'] ) ) ? $field['default'] : $default;
      $default = ( isset( $options[$field['id']] ) ) ? $options[$field['id']] : $default;

      return $default;

    }
    public function widget( $args, $instance ) {
 
        extract($args);
 
        $title  = apply_filters( 'widget_title', $instance['title'] );

        $output = "";
        $output .= $before_widget;
        $output .='<div class="mailchimp-form">';
            if ( ! empty( $title ) ){$output .= $before_title . $title . $after_title;}
             
            $output .='<form class="kmt-mailchimp-form" name="kmt-mailchimp-form" action="'.esc_url( admin_url('admin-post.php') ).'" method="POST">';
                $output .='<div>';
                    $output .='<input type="text" value="" name="email" placeholder="'.esc_html__("Email", 'kemet-addons').'">';
                    $output .='<span class="alert warning">'.esc_html__('Invalid or empty email', 'kemet-addons').'</span>';
                $output .= '</div>';
                 
                $output .='<div class="send-div">';
                    $output .='<input type="submit" class="button" value="'.esc_html__('Subscribe', 'kemet-addons').'" name="subscribe">';
                    $output .='<div class="sending"></div>';
                $output .='</div>';
 
                $output .='<div class="kmt-mailchimp-success alert final success">'.esc_html__('You have successfully subscribed to the newsletter.', 'kemet-addons').'</div>';
                $output .='<div class="kmt-mailchimp-error alert final error">'.esc_html__('Something went wrong. Your subscription failed.', 'kemet-addons').'</div>';
                 
                $output .='<input type="hidden" value="" name="list">';
                $output .='<input type="hidden" name="action" value="kmt_mailchimp" />';
                $output .= wp_nonce_field( "kmt_mailchimp_action", "kmt_mailchimp_nonce", false, false );
 
            $output .='</form>';
        $output .='</div>';
        $output .= $after_widget;
        echo $output;

    }
 
    public function form( $instance ) {    
        $createField = new KFW(); 
        
        if( ! empty( $this->args['fields'] ) ) {

          $class = ( $this->args['class'] ) ? ' '. $this->args['class'] : '';
  
          echo '<div class="kfw kfw-widgets kfw-fields'. $class .'">';
  
          foreach( $this->args['fields'] as $field ) {
  
            $field_value  = '';
            $field_unique = '';
  
            if( ! empty( $field['id'] ) ) {
  
              $field_value  = $this->get_default( $field, $instance );
              $field_unique = 'widget-' . $this->unique;
  
              if( $field['id'] === 'title' ) {
                $field['attributes']['id'] = 'widget-'. $this->unique . '-title';
              }
  
            }
  
            $createField->field( $field, $field_value, $field_unique );
  
          }
  
          echo '</div>';
  
        }

        var_dump($instance);
        
     }

     // Sanitize widget form values as they are saved.
    public function update( $new_instance, $old_instance ) {

      // auto sanitize
      foreach( $this->args['fields'] as $field ) {
        if( ! empty( $field['id'] ) && ( ! isset( $new_instance[$field['id']] ) || is_null( $new_instance[$field['id']] ) ) ) {
          $new_instance[$field['id']] = '';
        }
      }

      $new_instance = apply_filters( "kfw_{$this->unique}_save", $new_instance, $this->args, $this );

      do_action( "kfw_{$this->unique}_save_before", $new_instance, $this->args, $this );

      return $new_instance;

    }
    }
 
}
register_widget( 'Kemet_Social_Icons_Widget' );