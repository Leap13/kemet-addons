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
    class KFW_Field_systeminfo extends KFW_Fields {
    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

    extract( $args );
    ?>

    <table class="widefat" cellspacing="0">
        <thead>
            <tr>
                <th colspan="2"><?php _e( 'WordPress Environment', 'wiz' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php _e( 'Home URL', 'wiz' ); ?>:</td>
                <td><?php form_option( 'home' ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Site URL', 'wiz' ); ?>:</td>
                <td><?php form_option( 'siteurl' ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Theme Version', 'wiz' ); ?>:</td>
                <td><?php echo esc_html( THEME_VERSION ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Version', 'wiz' ); ?>:</td>
                <td><?php bloginfo( 'version' ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Path', 'wiz' ); ?>:</td>
                <td><?php echo ABSPATH; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Multisite', 'wiz' ); ?>:</td>
                <td><?php
                    if ( is_multisite() )
                        echo '&#10004;';
                    else
                        echo '&ndash;';
                    ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Memory Limit', 'wiz' ); ?>:</td>
                <td><?php
                    $memory = wp_convert_hr_to_bytes( WP_MEMORY_LIMIT );

                    echo size_format( $memory );
                    ?></td>
            </tr>
            <tr>
                <td><?php _e( 'WP Debug Mode', 'wiz' ); ?>:</td>
                <td><?php
                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG )
                        echo '&#10004;';
                    else
                        echo '&ndash;';
                    ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Language', 'wiz' ); ?>:</td>
                <td><?php echo get_locale() ?></td>
            </tr>
        </tbody>
    </table>
<br>
    <table class="widefat" cellspacing="0">
        <thead>
            <tr>
                <th colspan="2" data-export-label="Server Environment"><?php _e( 'Server Environment', 'wiz' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php _e( 'Server Info', 'wiz' ); ?>:</td>
                <td><?php echo esc_html( $_SERVER[ 'SERVER_SOFTWARE' ] ); ?></td>
            </tr>
            <tr>
                <td><?php _e( 'PHP Version', 'wiz' ); ?>:</td>
                <td><?php
                    // Check if phpversion function exists
                    if ( function_exists( 'phpversion' ) ) {
                        $php_version = phpversion();

                        echo esc_html( $php_version );
                    } else {
                        _e( "Couldn't determine PHP version because phpversion() doesn't exist.", 'wiz' );
                    }
                    ?></td>
            </tr>
            <?php if ( function_exists( 'ini_get' ) ) : ?>
                <tr>
                    <td><?php _e( 'PHP Memory Limit', 'wiz' ); ?>:</td>
                    <td><?php echo size_format( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) ); ?></td>
                </tr>
                <tr>
                    <td><?php _e( 'PHP Post Max Size', 'wiz' ); ?>:</td>
                    <td><?php echo size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ); ?></td>
                </tr>
                <tr>
                    <td ><?php _e( 'PHP Time Limit', 'wiz' ); ?>:</td>
                    <td><?php echo ini_get( 'max_execution_time' ); ?></td>
                </tr>
                <tr>
                    <td><?php _e( 'PHP Max Input Vars', 'wiz' ); ?>:</td>
                    <td><?php echo ini_get( 'max_input_vars' ); ?></td>
                </tr>
                <tr>
                    <td ><?php _e( 'SUHOSIN Installed', 'wiz' ); ?>:</td>
                    <td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td><?php _e( 'MySQL Version', 'wiz' ); ?>:</td>
                <td>
                    <?php
                    /** @global wpdb $wpdb */
                    global $wpdb;
                    echo $wpdb->db_version();
                    ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'Max Upload Size', 'wiz' ); ?>:</td>
            <td><?php echo size_format( wp_max_upload_size() ); ?></td>
            </tr>
            </tbody>
    </table>
<br>
    <table class="widefat" cellspacing="0">
        <thead>
            <tr>
                <th colspan="2"><?php _e( 'Active Plugins', 'wiz' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $active_plugins = (array) get_option( 'active_plugins', array() );

            if ( is_multisite() ) {
                $network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
                $active_plugins            = array_merge( $active_plugins, $network_activated_plugins );
            }

            foreach ( $active_plugins as $plugin ) {

                $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
                $dirname        = dirname( $plugin );
                $version_string = '';
                $network_string = '';

                if ( !empty( $plugin_data[ 'Name' ] ) ) {

                    // link the plugin name to the plugin url if available
                    $plugin_name = esc_html( $plugin_data[ 'Name' ] );

                    if ( !empty( $plugin_data[ 'PluginURI' ] ) ) {
                        $plugin_name = '<a href="' . esc_url( $plugin_data[ 'PluginURI' ] ) . '" title="' . esc_attr__( 'Visit plugin homepage', 'wiz' ) . '" target="_blank">' . $plugin_name . '</a>';
                    }
                    ?>
                    <tr>
                        <td><?php echo $plugin_name; ?></td>
                        <td><?php echo sprintf( _x( 'by %s', 'by author', 'wiz' ), $plugin_data[ 'Author' ] ) . ' &ndash; ' . esc_html( $plugin_data[ 'Version' ] ) . $version_string . $network_string; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>

    <?php
}
    }
}