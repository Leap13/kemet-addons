<?php
add_action('widgets_init', 'register_mailchimp_widget');
function register_mailchimp_widget(){
    register_widget( 'Kemet_MailChimp_Widget' );
}
class Kemet_MailChimp_Widget extends WP_Widget {
 
    public function __construct() {
        parent::__construct(
            'mailchimp',
            esc_html__('* Mailchimp', 'mailchimp'),
            array( 'description' => esc_html__('Mailchimp subscribe widget', 'mailchimp'))
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
             
            $output .='<form class="et-mailchimp-form" name="et-mailchimp-form" action="'.esc_url( admin_url('admin-post.php') ).'" method="POST">';
                $output .='<div>';
                    $output .='<input type="text" value="" name="email" placeholder="'.esc_html__("Email", 'mailchimp').'">';
                    $output .='<span class="alert warning">'.esc_html__('Invalid or empty email', 'mailchimp').'</span>';
                $output .= '</div>';
                 
                $output .='<div class="send-div">';
                    $output .='<input type="submit" class="button" value="'.esc_html__('Subscribe', 'mailchimp').'" name="subscribe">';
                    $output .='<div class="sending"></div>';
                $output .='</div>';
 
                $output .='<div class="et-mailchimp-success alert final success">'.esc_html__('You have successfully subscribed to the newsletter.', 'mailchimp').'</div>';
                $output .='<div class="et-mailchimp-error alert final error">'.esc_html__('Something went wrong. Your subscription failed.', 'mailchimp').'</div>';
                 
                $output .='<input type="hidden" value="'.$list.'" name="list">';
                $output .='<input type="hidden" name="action" value="et_mailchimp" />';
                $output .= wp_nonce_field( "et_mailchimp_action", "et_mailchimp_nonce", false, false );
 
            $output .='</form>';
        $output .='</div>';
        $output .= $after_widget;
        echo $output;

    }
 
    public function form( $instance ) {
        $defaults = array(
            'title' => esc_html__('Subscribe', 'mailchimp'),
        );
 
        $instance = wp_parse_args((array) $instance, $defaults);
        $title					 = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'mailchimp' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>
    <?php }
 
}