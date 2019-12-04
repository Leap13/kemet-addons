<?php


function mailchimp_post( $email, $status, $list_id, $api_key){
 
    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
    );
 
    $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address']));
 
    $headers = array(
        'Content-Type: application/json', 
        'Authorization: Basic '.base64_encode( 'user:'.$api_key )
    );
 
    $mailchimp = curl_init();
  
    curl_setopt($mailchimp, CURLOPT_URL, $url);
    curl_setopt($mailchimp, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($mailchimp, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($mailchimp, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($mailchimp, CURLOPT_TIMEOUT, 10);
    curl_setopt($mailchimp, CURLOPT_POST, true);
    curl_setopt($mailchimp, CURLOPT_POSTFIELDS, json_encode($data) );
    curl_setopt($mailchimp, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mailchimp, CURLOPT_SSL_VERIFYPEER, false);
  
    return curl_exec($mailchimp);
}	

function mailchimp_action(){
 
    if ( ! isset( $_POST['et_mailchimp_nonce'] ) || !wp_verify_nonce( $_POST['et_mailchimp_nonce'], 'et_mailchimp_action' )) {
       exit;
    } else {
 
        $email     = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $list      = kmt_get_panel_option('kmt-mailchimp-list-id');
        $api_key   = kmt_get_panel_option('kmt-mailchimp-api-key');
        
        mailchimp_post($email, 'subscribed', $list, $api_key);       
        die;
    }
}  
add_action('admin_post_nopriv_et_mailchimp', 'mailchimp_action');
add_action('admin_post_et_mailchimp', 'mailchimp_action');

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
 
        //wp_enqueue_script('widget-mailchimp');
 
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
 
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }
}
// add_action('widgets_init', 'register_mailchimp_widget');
// function register_mailchimp_widget(){
//     register_widget( 'Kemet_MailChimp_Widget' );
// }

