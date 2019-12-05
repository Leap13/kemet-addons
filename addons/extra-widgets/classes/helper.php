<?php

//MailChimp
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
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mailchimp = curl_init();
  
    curl_setopt($mailchimp, CURLOPT_URL, $url);
    curl_setopt($mailchimp, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($mailchimp, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($mailchimp, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($mailchimp, CURLOPT_TIMEOUT, 10);
    curl_setopt($mailchimp, CURLOPT_POST, true);
    curl_setopt($mailchimp, CURLOPT_POSTFIELDS, json_encode($data) );
    curl_setopt($mailchimp, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($mailchimp, CURLOPT_SSL_VERIFYPEER, false);
  
    return curl_exec($mailchimp);
}	

function mailchimp_action(){
 
    if ( ! isset( $_POST['kmt_mailchimp_nonce'] ) || !wp_verify_nonce( $_POST['kmt_mailchimp_nonce'], 'kmt_mailchimp_action' )) {
       exit;
    } else {
 
        $email     = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $list      = kmt_get_panel_option('kmt-mailchimp-list-id');
        $api_key   = kmt_get_panel_option('kmt-mailchimp-api-key');
        
        mailchimp_post($email, 'subscribed', $list, $api_key);       
        die;
    }
} 
add_action('admin_post_nopriv_kmt_mailchimp', 'mailchimp_action');
add_action('admin_post_kmt_mailchimp', 'mailchimp_action');
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    return $instance;
}