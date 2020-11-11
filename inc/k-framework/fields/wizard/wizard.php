<?php if ( ! defined( 'ABSPATH' ) ) {
    die;
}
/**
*
* Field: System Info
*
* @since 1.0.0
* @version 1.0.0
*
*/
if ( ! class_exists( 'KFW_Field_systeminfo' ) ) {
    class KFW_Field_wizard extends KFW_Fields {
    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }
    public function render() {
        $license = get_option('wiz_license_code');
        if($license){ 
            $support_timestamp = get_option( 'wiz_license_support_until' );
            $support_unit = $support_timestamp - time();
            ?>
            <p class="license-status"><?php echo __("Your License Is Active" , "kfw") ?> <?php echo $support_unit > 0 ? '<mark>Supported</mark>' : '<mark>Unsupported</mark>'; ?></p>     
     <?php }else{ ?>
            <p class="license-status"><?php echo __("Your License Not Active" , "kfw") ?></p>
            <a href="javascript:void(0)" class="test-wizard button button-primary"><?php echo __("Activate Now" , "kfw") ?></a>
    <?php }
        } 
    }
}