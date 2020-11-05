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
    ?>
    <a href="javascript:void(0)" class="test-wizard button button-hero"><?php echo __("Activate" , "kfw") ?></a>

<?php } 
    }
}