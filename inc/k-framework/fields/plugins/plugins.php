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
if ( ! class_exists( 'KFW_Field_plugins' ) ) {
    class KFW_Field_plugins extends KFW_Fields {
    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }


    /**
     * Check if Kemet Addons is installed
     *
     * @since 1.0.0
     *
     * @access public
     */
    function is_addons_installed($plugin_path) {
    
        $plugins = get_plugins();

        return isset( $plugins[ $plugin_path ] );
    }
    public function render() {

    //extract( $args );
    ?>
    <div class="kmt-plugins-container">
    <?php foreach($this->field['plugins'] as $plugin){ ?>
        <div class="kmt-card">
            <div class="kmt-card-header">
                <div class="card-img">
                    <img src="<?php echo $plugin['plugin_image']; ?>" />
                </div>
            </div>
            <div class="kmt-card-body">
                <h2 class="card-title"><?php echo $plugin['title']; ?></h2>
                <p class="plugin-description"><?php esc_html_e( $plugin['description'] , 'kemet' ); ?></p>
            </div>
            <div class="kmt-card-footer">
                <?php 

                $plugin_path = $plugin['plugin'];
                $plugin_name = $pieces = explode("/", $plugin_path)[0];
                $install_url   = wp_nonce_url( self_admin_url( $plugin['install_url'] ), 'install-plugin_'.$plugin_name );
                $activate_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin_path . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin_path );
                $deactivate_url = wp_nonce_url( 'plugins.php?action=deactivate&amp;plugin=' . $plugin_path . '&amp;plugin_status=all&amp;paged=1&amp;s', 'deactivate-plugin_' . $plugin_path );
                if ( $this->is_addons_installed( $plugin_path ) ) {
                    if ( is_plugin_active($plugin['plugin']) ) {
                        $button_label = __( 'Deactivate ', 'kemet' );
					    $status = 'deactivate';
                        $button = '<a class="button button-primary kmt-active-plugin" data-status = '.$status.'  data-url-deactivate = '.$deactivate_url.' onclick="active_plugin(event)" >' . $button_label . '</a>';
                    }else{
                        $button_label = __( 'Active '.$plugin['title'], 'kemet' );
					    $status = 'activate';
                        $button = '<a class="button button-primary kmt-active-plugin" data-status = '.$status.'  data-url-activate = '.$activate_url.' onclick="active_plugin(event)" >' . $button_label . '</a>';
                    }
                } else {
                    if ( current_user_can( 'install_plugins' ) ) {
                        $status = 'install';
                        $button_label = __( 'Install and Activate '.$plugin['title'], 'kemet' );
                        $button = '<a class="button button-primary kmt-active-plugin" data-status = '.$status.' data-url-install = '.$install_url.'  data-url-activate = '.$activate_url.' onclick="active_plugin(event)" >' . $button_label . '</a>'; 
                    }
                }
                
                printf( '<div>%1$s</div>', $button );
                ?>

                <?php ?>
            </div>
        </div>
    <?php } ?>
    </div>
    

    <?php
}
    }
}

