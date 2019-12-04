<?php
//define('MAILCHIMP_API', 'caa6f34b24e11856eedec90bc997a068-us12-my-fake-api');

class Kemet_MailChimp_Widget extends WP_Widget {
 
    public function __construct() {
        parent::__construct(
            'mailchimp',
            esc_html__('* Mailchimp', 'mailchimp'),
            array( 'description' => esc_html__('Mailchimp subscribe widget', 'mailchimp'))
        );
       // mailchimp_list();
       add_action( 'widgets_init', array( $this, 'mailchimp_list'), 10 );
    }
 
    public function widget( $args, $instance ) {
 
        wp_enqueue_style('widget-mailchimp');
        wp_enqueue_script('widget-mailchimp');
 
        extract($args);
 
 
        $title  = apply_filters( 'widget_title', $instance['title'] );
        $list   = $instance['list'] ? esc_attr($instance['list']) : '';
 
        $output = "";
        $output .= $before_widget;
        $output .='<div class="mailchimp-form">';
            if ( ! empty( $title ) ){$output .= $before_title . $title . $after_title;}
             
            $output .='<form class="et-mailchimp-form" name="et-mailchimp-form" action="'.esc_url( admin_url('admin-post.php') ).'" method="POST">';
                $output .='<input type="text" value="" name="fname" placeholder="'.esc_html__("First name", 'mailchimp').'">';
                $output .='<input type="text" value="" name="lname" placeholder="'.esc_html__("Last name", 'mailchimp').'">';
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
                 
                //$output .='<input type="hidden" value="'.$list.'" name="list">';
                $output .= '<input type="hidden" name="list" value="'.$list.'" />';
                $output .='<input type="hidden" name="action" value="et_mailchimp" />';
                $output .= wp_nonce_field( "et_mailchimp_action", "et_mailchimp_nonce", false, false ); 
            $output .='</form>';
        $output .='</div>';
        $output .= $after_widget;
        echo $output;
    }

  function mailchimp_list() {
 
    $api_key = MAILCHIMP_API;
 
    if (empty($api_key)) {
        return new WP_Error( 'no_api_key', esc_html__( 'No Mailchimp API key is found.', 'mailchimp' ) );
    }
      
 
    if ( false === ( $mailchimp_list = get_transient( 'mailchimp-' . $api_key ) ) ) {
 
        $data = array(
            'fields' => 'lists',
            'count' => 'all',
        );
          
        $result = json_decode( mailchimp_connect( $url, 'GET', $api_key, $data) );
        
        if (! $result ) {
            return new WP_Error( 'bad_json', esc_html__( 'Mailchimp has returned invalid data.', 'mailchimp' ) );
        }
 
        if ( !empty( $result->lists ) ) {
            foreach( $result->lists as $list ){
                $mailchimp_list[] = array(
                    'id'      => $list->id,
                    'name'    => $list->name,
                );
            }
        } else {
            return new WP_Error( 'no_list', esc_html__( 'Mailchimp did not return any list.', 'mailchimp' ) );
        }
 
        // do not set an empty transient - should help catch private or empty accounts.
        if ( ! empty( $mailchimp_list ) ) {
            $mailchimp_list = base64_encode( serialize( $mailchimp_list ) );
            set_transient( 'mailchimp-' . $api_key, $mailchimp_list, apply_filters( 'null_mailchimp_cache_time', WEEK_IN_SECONDS * 2 ) );
        }
    }
 
    if ( ! empty( $mailchimp_list ) ) {
        return unserialize( base64_decode( $mailchimp_list ) );
    } else {
        return new WP_Error( 'no_list', esc_html__( 'Mailchimp did not return any list.', 'mailchimp' ) );
    }
}
 
    function form( $instance ) {
 
        $defaults = array(
            'title' => esc_html__('Subscribe', 'mailchimp'),
            'mailchimp_api_key'  => '',
            'mailchimp_list_id'  => '',
        );
 
        $instance = wp_parse_args((array) $instance, $defaults);
        $title					 = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $mailchimp_list_id		 = isset( $instance[ 'mailchimp_list_id' ] ) ? $instance[ 'mailchimp_list_id' ] : '';
        $mailchimp_api_key		 = isset( $instance[ 'mailchimp_api_key' ] ) ? $instance[ 'mailchimp_api_key' ] : '';
 
        //$list_array = mailchimp_list();
 
        ?>
 
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'mailchimp' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>

            <p>
			<label for="<?php echo $this->get_field_id( 'mailchimp_api_key' ); ?>"><?php _e( 'Mailchimp API Key:', 'wiz' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'mailchimp_api_key' ); ?>" name="<?php echo $this->get_field_name( 'mailchimp_api_key' ); ?>" value="<?php echo $mailchimp_api_key; ?>" />
		    </p>

             <p>
			<label for="<?php echo $this->get_field_id( 'mailchimp_list_id' ); ?>"><?php _e( 'Mailchimp List ID:', 'wiz' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'mailchimp_list_id' ); ?>" name="<?php echo $this->get_field_name( 'mailchimp_list_id' ); ?>" value="<?php echo $mailchimp_list_id; ?>" />
		    </p>
 

         
    <?php }
 
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['mailchimp_api_key']  = strip_tags( $new_instance['mailchimp_api_key']);
        $instance['mailchimp_list_id']  = strip_tags( $new_instance['mailchimp_list_id']);
        return $instance;
    }
}
// add_action('widgets_init', 'register_mailchimp_widget');
// function register_mailchimp_widget(){
//     register_widget( 'Kemet_MailChimp_Widget' );
// }