<?php
/**
 * Kemet_Panel_plugins_Tab
 *
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Panel_plugins_Tab')) {

    /**
     * Kemet Panel
     *
     * @since 1.0.0
     */
    class Kemet_Panel_plugins_Tab
    {

        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        private function call_plugin_api($slug)
        {
            include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');

            $call_api = get_transient('about_plugin_info_' . $slug);

            if (false === $call_api) {
                $call_api = plugins_api(
                    'plugin_information',
                    array(
                    'slug'   => $slug,
                    'fields' => array(
                        'downloaded'        => false,
                        'rating'            => false,
                        'description'       => true,
                        'short_description' => true,
                        'donate_link'       => false,
                        'tags'              => false,
                        'sections'          => true,
                        'homepage'          => true,
                        'added'             => false,
                        'last_updated'      => false,
                        'compatibility'     => false,
                        'tested'            => false,
                        'requires'          => false,
                        'downloadlink'      => false,
                        'icons'             => true,
                        'banners'           => true,
                        'name'  => true
                    ),
                )
                );
                set_transient('about_plugin_info_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS);
            }

            return $call_api;
        }
    
        /**
         * Check if Kemet Addons is installed
         *
         * @since 1.0.0
         *
         * @access public
         */
        public function is_addons_installed($plugin_path)
        {
            $plugins = get_plugins();

            return isset($plugins[ $plugin_path ]);
        }

        public function render_html()
        {
            $plugins = array(
                'elementor',
                'premium-addons-for-elementor',
                'premium-blocks-for-gutenberg',
            ); ?>
            <div class="kmt-plugins-container">
    <?php foreach ($plugins as $plugin) {
                $plugin_description = isset($this->call_plugin_api($plugin)->short_description) ? $this->call_plugin_api($plugin)->short_description : '';
                $plugin_banner = isset($this->call_plugin_api($plugin)->banners) ? $this->call_plugin_api($plugin)->banners : '';
                $plugin_name = isset($this->call_plugin_api($plugin)->name) ? $this->call_plugin_api($plugin)->name : '';
                $plugin_path = $plugin . '/'. $plugin . '.php'; ?>
        <div class="kmt-card">
            <div class="kmt-card-header">
                <div class="card-img">
                    <img src="<?php echo $plugin_banner['low']; ?>" />
                </div>
            </div>
            <div class="kmt-card-body">
                <h2 class="card-title"><?php echo $plugin_name; ?></h2>
                <p class="plugin-description"><?php esc_html_e($plugin_description, 'kfw'); ?></p>
            </div>
            <div class="kmt-card-footer">
                <?php
                $install_url   = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin='.$plugin.''), 'install-plugin_'.$plugin);
                $activate_url   = wp_nonce_url('plugins.php?action=activate&plugin=' . $plugin_path . '&plugin_status=all&paged=1&amp;s', 'activate-plugin_' . $plugin_path);
                $deactivate_url = wp_nonce_url('plugins.php?action=deactivate&plugin=' . $plugin_path . '&plugin_status=all&paged=1&amp;s', 'deactivate-plugin_' . $plugin_path);
                if ($this->is_addons_installed($plugin_path)) {
                    if (is_plugin_active($plugin_path)) {
                        $button_label = __('Deactivate ', 'kfw');
                        $status = 'deactivate';
                        $button = '<a class="button button-primary kmt-plugin" data-status = '.$status.'  data-url-deactivate = '.$deactivate_url.' >' . $button_label . '</a>';
                    } else {
                        $button_label = __('Activate', 'kfw');
                        $status = 'activate';
                        $button = '<a class="button button-primary kmt-plugin" data-status = '.$status.'  data-url-activate = '.$activate_url.' >' . $button_label . '</a>';
                    }
                } else {
                    if (current_user_can('install_plugins')) {
                        $status = 'install';
                        $button_label = __('Install and Activate', 'kfw');
                        $button = '<a class="button button-primary kmt-plugin" data-status = '.$status.' data-url-install = '.$install_url.'  data-url-activate = '.$activate_url.' >' . $button_label . '</a>';
                    }
                }
                
                printf('<div>%1$s</div>', $button); ?>

                <?php ?>
            </div>
        </div>
    <?php
            } ?>
    </div>
     <?php
        }
    }
}
