<?php
//define('MAILCHIMP_API', '64b88f6f99a625e2450356795cefc27c-us4');
function mailchimp_connect( $url, $api_key, $data = array() ) {
 
    $url .= '?' . http_build_query($data);
 
    $mailchimp = curl_init();
 
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic '.base64_encode( 'user:'. $api_key )
    );
 
    curl_setopt($mailchimp, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($mailchimp, CURLOPT_URL, $url );
    curl_setopt($mailchimp, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($mailchimp, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($mailchimp, CURLOPT_TIMEOUT, 10);
    curl_setopt($mailchimp, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mailchimp, CURLOPT_SSL_VERIFYPEER, false);
 
    return curl_exec($mailchimp);
    $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/';
function mailchimp_list() {
 
    $api_key = kmt_get_panel_option('kmt-mailchimp-api-key');
 
    if (empty($api_key)) {
        return new WP_Error( 'no_api_key', esc_html__( 'No Mailchimp API key is found.', 'mailchimp' ) );
    }
      
 
    if ( false === ( $mailchimp_list = get_transient( 'mailchimp-' . $api_key ) ) ) {
 
        $data = array(
            'fields' => 'lists',
            'count' => 'all',
        );
          
        $result = json_decode( mailchimp_connect( $url, 'PUT', $api_key, $data) );
        
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

}
function mailchimp_action(){
 
    if ( ! isset( $_POST['et_mailchimp_nonce'] ) || !wp_verify_nonce( $_POST['et_mailchimp_nonce'], 'et_mailchimp_action' )) {
       exit;
    } else {
 
        $email     = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $fname     = strip_tags(trim($_POST["fname"]));
        $lname     = strip_tags(trim($_POST["lname"]));
        $list      = kmt_get_panel_option('kmt-mailchimp-list-id');
        $api_key   = kmt_get_panel_option('kmt-mailchimp-api-key');
 
        mailchimp_post($email, 'subscribed', $list, $api_key, array('FNAME' => $fname,'LNAME' => $lname) );
         
        die;
    }
}
function mailchimp_post( $email, $status, $list_id, $api_key, $merge_fields = array('FNAME' => '','LNAME' => '') ){
 
    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
        'merge_fields'  => $merge_fields
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

add_action('admin_post_nopriv_et_mailchimp', 'mailchimp_action');
add_action('admin_post_et_mailchimp', 'mailchimp_action');