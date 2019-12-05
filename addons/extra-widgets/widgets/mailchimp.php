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
if ( ! class_exists( 'Kemet_MailChimp_Widget' ) ) {
    class Kemet_MailChimp_Widget extends WP_Widget {
 
    public function __construct() {
        parent::__construct(
            'mailchimp',
            esc_html__('Kemet Mailchimp', 'kemet-addons'),
            array( 'description' => esc_html__('Mailchimp subscribe widget', 'kemet-addons'))
        );
    }
 
    public function widget( $args, $instance ) {
 
        extract($args);
 
        $title  = apply_filters( 'widget_title', $instance['title'] );
        $list   = kmt_get_panel_option('kmt-mailchimp-list-id');

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
                 
                $output .='<input type="hidden" value="'.$list.'" name="list">';
                $output .='<input type="hidden" name="action" value="kmt_mailchimp" />';
                $output .= wp_nonce_field( "kmt_mailchimp_action", "kmt_mailchimp_nonce", false, false );
 
            $output .='</form>';
        $output .='</div>';
        $output .= $after_widget;
        echo $output;

    }
 
    public function form( $instance ) {
        $defaults = array(
            'title' => esc_html__('Subscribe', 'kemet-addons'),
        );
 
        $instance = wp_parse_args((array) $instance, $defaults);
        $title					 = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'kemet-addons' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>
    <?php }
    }
 
}
register_widget( 'Kemet_MailChimp_Widget' );