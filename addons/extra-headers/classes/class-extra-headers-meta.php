<?php
/**
 * Extra Headers Meta Box
 */

if (!class_exists('Kemet_Addon_Extra_Headers_Meta_Box')) {

    class Kemet_Addon_Extra_Headers_Meta_Box
    {
        /**
         * Instance
         *
         * @var $instance
         */
        private static $instance;

        /**
         * Initiator
         */
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         * Constructor
         */
        public function __construct()
        {
            self::add_extra_headers_meta_box();
            add_action('wp', array($this, 'meta_options_hooks'));
        }

        /**
         * Metabox Hooks
         */
        public function meta_options_hooks()
        {

            if (is_singular()) {
                add_filter('kemet_primary_header_layout', array($this, 'primary_header'));
                add_filter('kemet_header_class', array($this, 'add_header_class'));
                add_filter('kemet_trnsparent_header', array($this, 'transparent_header'));
                add_filter('kemet_header_width', array($this, 'header_width'));
            }

        }

        public function add_extra_headers_meta_box()
        {

            KFW::createSection('kemet_page_options', array(
                'title' => __('Header', 'kemet-addons'),
                'icon' => 'dashicons dashicons-admin-post',
                'priority_num' => 3,
                'fields' => array(
                    array(
                        'id' => 'kemet-main-header-display',
                        'type' => 'image_select',
                        'title' => __('Display Primary Header', 'kemet-addons'),
                        'options' => array(
                            'default' => KEMET_EXTRA_HEADERS_URL . '/assets/images/default.png',
                            'header-main-layout-1' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-01.png',
                            'header-main-layout-2' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-02.png',
                            'header-main-layout-3' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-03.png',
                            'header-main-layout-4' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-04.png',
                            'header-main-layout-5' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-05.png',
                            'header-main-layout-6' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-06.png',
                            'header-main-layout-7' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-07.png',
                            'header-main-layout-8' => KEMET_EXTRA_HEADERS_URL . '/assets/images/header-layout-08.png',
                            'disable' => KEMET_EXTRA_HEADERS_URL . '/assets/images/disable.png',
                        ),
                        'default' => 'default',
                    ),
                    array(
                        'id' => 'kemet-meta-enable-header-transparent',
                        'type' => 'button_set',
                        'title' => __('Overlay Header', 'kemet-addons'),
                        'options' => array(
                            'default' => __('Default', 'kemet-addons'),
                            'enable' => __('Enable', 'kemet-addons'),
                            'disable' => __('Disable', 'kemet-addons'),
                        ),
                        'default' => 'default',
                        'dependency' => array('kemet-main-header-display', '!=', 'disable'),
                    ),
                    array(
                        'id' => 'header-main-layout-width',
                        'type' => 'select',
                        'title' => __('Header Width', 'kemet-addons'),
                        'options' => array(
                            'default' => __('Default', 'kemet-addons'),
                            'full' => __('Full Width', 'kemet-addons'),
                            'content' => __('Content Width', 'kemet-addons'),
                            'boxed' => __('Boxed Content', 'kemet-addons'),
                            'stretched' => __('Stretched Content', 'kemet-addons'),
                        ),
                        'default' => 'default',
                    ),
                ),
            )
            );
        }

        /**
         * Transparent Header Option
         */
        public function add_header_class($classes, $default = '')
        {

            $enable_trans_header = kemet_get_option('enable-transparent');
            $meta = get_post_meta(get_the_ID(), 'kemet_page_options', true);
            $trans_meta_option = (isset($meta['kemet-meta-enable-header-transparent'])) ? $meta['kemet-meta-enable-header-transparent'] : $default;

            if (('enable' === $trans_meta_option && $enable_trans_header) || 'enable' === $trans_meta_option) {

                $classes[] = 'kmt-header-transparent';

            } elseif ('disable' === $trans_meta_option && $enable_trans_header) {
                if (in_array('kmt-header-transparent', $classes)) {
                    unset($classes[array_search('kmt-header-transparent', $classes)]);
                }
            }

            return $classes;
        }

        /**
         * Disable Primary Header
         */
        public function primary_header($defaults)
        {

            $meta = get_post_meta(get_the_ID(), 'kemet_page_options', true);

            $display_header = (isset($meta['kemet-main-header-display']) && $meta['kemet-main-header-display'] != 'default') ? $meta['kemet-main-header-display'] : $defaults;

            return $display_header;
        }
        /**
         * Transparent Header
         */
        public function transparent_header($default)
        {

            $meta = get_post_meta(get_the_ID(), 'kemet_page_options', true);
            $trans_meta_option = (isset($meta['kemet-meta-enable-header-transparent']) && $meta['kemet-meta-enable-header-transparent'] != 'default') ? $meta['kemet-meta-enable-header-transparent'] : $default;

            return $trans_meta_option;
        }

        /**
         * Header Width
         */
        public function header_width($default)
        {
            $meta = get_post_meta(get_the_ID(), 'kemet_page_options', true);
            $header_width = (isset($meta['header-main-layout-width']) && $meta['header-main-layout-width'] != 'default') ? $meta['header-main-layout-width'] : $default;

            return $header_width;
        }
    }
}

new Kemet_Addon_Extra_Headers_Meta_Box;
