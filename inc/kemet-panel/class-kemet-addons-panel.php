<?php
/**
 * Kemet Panel
 *
 * @package Kemet Addons
 */
define('KEMET_PANEL_DIR', KEMET_ADDONS_DIR . 'inc/kemet-panel/');
define('KEMET_PANEL_URL', KEMET_ADDONS_URL . 'inc/kemet-panel/');

if (! class_exists('Kemet_Panel')) {

    /**
     * Kemet Panel
     *
     * @since 1.0.0
     */
    class Kemet_Panel
    {
        /**
         *
         * @var array defaults
         */
        private $defaults = array();

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
        /**
         *  Constructor
         */
        
        public function __construct()
        {
            $tabs = $this->tabs();
            foreach ($tabs as $tab => $values) {
                require_once KEMET_PANEL_DIR . 'tabs/class-kemet-panel-'.$tab.'.php';
            }
            add_action('wp_ajax_kemet-panel-save-options', array($this , 'save_options'));
            add_action('wp_ajax_kemet-panel-reset-options', array($this , 'reset_options'));
            add_action('wp_ajax_kemet-panel-enable-all', array($this , 'enable_all_options'));
            add_action('admin_menu', array($this , 'register_custom_menu_page'));
            add_action('admin_enqueue_scripts', array($this , 'enqueue_admin_script'));
            add_action('wp_loaded', array($this , 'set_default_options'));
        }

        public function register_custom_menu_page()
        {
            $tabs = $this->tabs();
            add_menu_page(__('Kemet Panel', 'kemet-addons'), __('Kemet', 'kemet-addons'), 'manage_options', 'kemet_panel', array($this , 'render'), null);
            foreach ($tabs as $tab => $values) {
                add_submenu_page('kemet_panel', $values['title'], $values['title'], 'manage_options', 'admin.php?page=kemet_panel' . '#tab=' . $values['slug']);
            }
            remove_submenu_page('kemet_panel', 'kemet_panel');
        }

        public function tabs()
        {
            $tabs = array(
                'options' => array(
                    'title' => __('Customizer & Page Options', 'kemet-addons'),
                    'slug' => 'customizer',
                    'reset' => true,
                    'enable_all' => true,
                ),
                'integration' => array(
                    'title' => __('Integrations', 'kemet-addons'),
                    'slug' => 'integration',
                    'reset' => true,
                ),
                'plugins' => array(
                    'title' => __('Plugins', 'kemet-addons'),
                    'slug' => 'plugins',
                ),
                'system' => array(
                    'title' => __('System Info', 'kemet-addons'),
                    'slug' => 'system',
                )
            );

            return $tabs;
        }
        public function render()
        {
            $tabs = $this->tabs(); ?>
            <div class="kemet-panel-container">
                <div class="kemet-panel-header">
                    <div class="kemet-panel-header-inner">
                        <div class="logo">
                            <div class="icon"></div>
                            <div class="title">
                                <h1>
                                    <span><?php _e("Welcome to", "kemet-addons") ?></span>
                                    <strong><?php _e("Kemet Theme", "kemet-addons") ?></strong>
                                    <small><?php _e("by Leap13", "kemet-addons") ?></small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kemet-panel-body">
                    <div class="kemet-panel-tabs-group">
                        <ul class="kemet-panel-tabs">
                            <?php foreach ($tabs as $tab => $values) { ?>
                            <li class="<?php esc_attr_e($values['slug'] . '-tab', 'kemet-addons') ?>"><a href="#tab=<?php esc_attr_e($values['slug'], 'kemet-addons') ?>"><span><?php echo $values['title']; ?></span></a></li>
                            <?php } ?>
                        </ul>
                        <div class="kemet-panel-tabs-content">
                            <?php foreach ($tabs as $tab => $values) { ?>
                                <div id="<?php esc_attr_e($values['slug'], 'kemet-addons') ?>" class="tab">
                                    <?php
                                        $class = 'Kemet_Panel_' . $tab . '_Tab';
                                        echo '<div class="tab-content">';
                                        $class::get_instance()->render_html();
                                        echo '</div>';
                                        $enable_all = isset($values['enable_all']) ? $values['enable_all'] : false;
                                         if (isset($values['reset']) && $values['reset']) {
                                             $this->render_footer($tab, $values['slug'], $enable_all);
                                         } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
  <?php
        }

        public function render_footer($class, $id, $enable_all)
        { ?>
            <div class="kemet-panel-footer">
                <div class="kemet-panel-footer-inner">
                    <div class="footer-button">
                        <button data-class="<?php esc_attr_e($class, 'kemet-addons') ?>" data-id="<?php esc_attr_e($id, 'kemet-addons') ?>" class="button button-primary kemet-save-ajax"><?php _e("Save", "kemet-addons"); ?></button>
                        <?php if ($enable_all): ?>
                            <button data-class="<?php esc_attr_e($class, 'kemet-addons') ?>" data-id="<?php esc_attr_e($id, 'kemet-addons') ?>" class="button button-secondary kemet-enable-all-options"><?php _e("Enable All", "kemet-addons"); ?></button>
                        <?php endif; ?>
                        <button data-class="<?php esc_attr_e($class, 'kemet-addons') ?>" data-id="<?php esc_attr_e($id, 'kemet-addons') ?>" class="button button-secondary kemet-reset-options"><?php _e("Reset All", "kemet-addons"); ?></button>
                    </div>
                </div>
            </div>
        <?php }
        public function save_options()
        {
            $options = isset($_POST['options']) ? $_POST['options'] : array();
            $class = isset($_POST['class']) ? $_POST['class'] : '';
            switch ($class) {
                case 'options':
                    update_option("kemet_addons_options", $options);
                    wp_send_json_success();
                    break;
                case 'integration':
                    update_option("kemet_addons_integration", $options);
                    wp_send_json_success();
                    break;
            }
            wp_send_json_error();
        }

        public function reset_options()
        {
            $class = isset($_POST['class']) ? $_POST['class'] : '';
            $options = $this->get_defaults();
            $options = isset($options['Kemet_Panel_'.$class.'_Tab']) ? $options['Kemet_Panel_'.$class.'_Tab'] : array();
            switch ($class) {
                case 'options':
                    update_option("kemet_addons_options", $options);
                    wp_send_json_success();
                    break;
                case 'integration':
                    update_option("kemet_addons_integration", $options);
                    wp_send_json_success();
                    break;
            }
            wp_send_json_error();
        }

        public function enable_all_options()
        {
            $class = isset($_POST['class']) ? $_POST['class'] : '';
            $options = isset($_POST['options']) ? $_POST['options'] : array();
            switch ($class) {
                case 'options':
                    update_option("kemet_addons_" . $class, $options);
                    wp_send_json_success();
                    break;
            }
            wp_send_json_error();
        }
        /**
         * Get Defaults
         *
         * @return $defaults
         */
        public function get_defaults()
        {
            $tabs = $this->tabs();
            $defaults = array();
            foreach ($tabs as $tab => $values) {
                $class = 'Kemet_Panel_' . $tab . '_Tab';
                if (method_exists($class, 'get_defaults')) {
                    $options = $class::get_instance()->get_defaults();
                    $defaults[$class] = $options;
                }
            }
            $this->defaults = $defaults;
            return $this->defaults;
        }

        /**
         * Get Defaults
         *
         * @return $defaults
         */
        public function set_default_options()
        {
            $default_option = get_option("kemet_panel_default_options_added");
            if ($default_option) {
                return;
            }
            $tabs = $this->tabs();
            foreach ($tabs as $tab => $values) {
                $class = 'Kemet_Panel_' . $tab . '_Tab';
                if (method_exists($class, 'get_defaults')) {
                    $options = $class::get_instance()->get_defaults();
                    update_option("kemet_addons_" . $tab, $options);
                }
            }
            update_option("kemet_panel_default_options_added", true);
        }

        /**
         * Enqueue a script in the WordPress admin on edit.php.
         *
         * @param int $hook Hook suffix for the current admin page.
         */
        public function enqueue_admin_script($hook)
        {
            $js_prefix  = '.min.js';
            $css_prefix  = '.min.css';
            $dir        = 'minified';
            if (SCRIPT_DEBUG) {
                $js_prefix  = '.js';
                $css_prefix  = '.css';
                $dir        = 'unminified';
            }
            if (is_rtl()) {
                $css_prefix = '-rtl.min.css';
                if (SCRIPT_DEBUG) {
                    $css_prefix = '-rtl.css';
                }
            }
            wp_enqueue_style('kemet-panel-css', KEMET_PANEL_URL . 'assets/css/' . $dir . '/kemet-panel' . $css_prefix, false, KEMET_ADDONS_VERSION);
            if ('toplevel_page_kemet_panel' != $hook) {
                return;
            }
            wp_enqueue_script('kemet-panel-js', KEMET_PANEL_URL . 'assets/js/' . $dir . '/kemet-panel' . $js_prefix, array('jquery', 'jquery-ui-tabs', 'jquery-ui-core'), KEMET_ADDONS_VERSION);
        }
    }
    Kemet_Panel::get_instance();
}
