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
 
    public function __construct() {
        parent::__construct(
            'social-icons',
            esc_html__('Kemet Social Icons', 'kemet-addons'),
            array( 'description' => esc_html__('Mailchimp subscribe widget', 'kemet-addons'))
        );
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
        $defaults = array(
            'title' => esc_html__('Social Profile', 'kemet-addons'),
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $title					 = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';

        $fields = array(
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
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo $instance['title']; ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>
    <?php }
    }
 
}
register_widget( 'Kemet_Social_Icons_Widget' );