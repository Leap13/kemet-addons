<?php
/**
 * mega menu
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Mega_Menu_Partials')) {

    class Kemet_Mega_Menu_Partials {

        /**
		 * Member Variable
		 *
		 * @var string
		 */
        private static $mega_menu_style = '';
        
        /**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;
        
        /**
         * Initiator
         */
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'admin_enqueue_scripts',  array($this, 'admin_script' ) );
            add_filter( 'wp_nav_menu_args', array( $this, 'nav_menu_args' ) );
			add_filter( 'wp_footer', array( $this, 'megamenu_style' ) );
        }
		
        function nav_menu_args( $args ) {

            if ( 'primary' == $args['theme_location'] ) {
				$args['walker'] = new Mega_Menu_Walker_Nav_Menu();
			}

			return $args;
        }

		/**
		 * Ajax handeler to return the posts based on the search query.
		 * When searching for the post/pages only titles are searched for.
		 *
		 */
		public function kemet_ajax_get_posts_list() {

			check_ajax_referer( 'kemet-addons-ajax-get-post-list', 'nonce' );

			$search_query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : ''; 
			$data          = array();
			$result        = array();

			$args = array(
				'public'   => true,
				'_builtin' => false
			);
			
			$output = 'names'; // 'names' or 'objects' (default: 'names')
			$operator = 'and'; // 'and' or 'or' (default: 'and')
			
			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';

			foreach ( $post_types as $key => $post_type ) {

				$data = array();

				add_filter( 'posts_search', array( $this, '__search_by_title_only' ), 500, 2 );

				$query = new WP_Query(
					array(
						's'              => $search_query,
						'post_type'      => $post_type,
						'posts_per_page' => - 1,
					)
				);

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$title  = get_the_title();
						$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
						$id     = get_the_id();
						$data[] = array(
							'id'   => 'post-' . $id,
							'text' => $title,
						);
					}
				}
				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $key,
						'children' => $data,
					);
				}
			}

			$data = array();

			wp_reset_postdata();

			$args = array(
				'public' => true,
			);

			$output     = 'objects'; // names or objects, note names is the default.
			$operator   = 'and'; // also supports 'or'.
			$taxonomies = get_taxonomies( $args, $output, $operator );

			foreach ( $taxonomies as $taxonomy ) {
				$terms = get_terms(
					$taxonomy->name,
					array(
						'orderby'    => 'count',
						'hide_empty' => 0,
						'name__like' => $search_query,
					)
				);

				$data = array();

				$label = ucwords( $taxonomy->label );

				if ( ! empty( $terms ) ) {

					foreach ( $terms as $term ) {

						$term_taxonomy_name = ucfirst( str_replace( '_', ' ', $taxonomy->name ) );

						$data[] = array(
							'id'   => 'tax-' . $term->term_id,
							'text' => $term->name . ' archive page',
						);

						$data[] = array(
							'id'   => 'tax-' . $term->term_id . '-single-' . $taxonomy->name,
							'text' => 'All singulars from ' . $term->name,
						);

					}
				}

				if ( is_array( $data ) && ! empty( $data ) ) {
					$result[] = array(
						'text'     => $label,
						'children' => $data,
					);
				}
			}

			// return the result in json.
			wp_send_json( $result );
		}

		/**
		 *
		 * @param  (string)   $search   Search SQL for WHERE clause.
		 * @param  (WP_Query) $wp_query The current WP_Query object.
		 *
		 * @return (string) The Modified Search SQL for WHERE clause.
		 */
		function __search_by_title_only( $search,$wp_query )
		{
			global $wpdb;
			if(empty($search)) {
				return $search; // skip processing - no search term in query
			}
			$q = $wp_query->query_vars;
			$n = !empty($q['exact']) ? '' : '%';
			$search =
			$searchand = '';
			foreach ((array)$q['search_terms'] as $term) {
				$term = esc_sql($wpdb->esc_like($term));
				$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
				$searchand = ' AND ';
			}
			if (!empty($search)) {
				$search = " AND ({$search}) ";
				if (!is_user_logged_in())
					$search .= " AND ($wpdb->posts.post_password = '') ";
			}
			return $search;
		}

        function admin_script(){

			wp_enqueue_style( 'kemet-addons-mega-menu-css', KEMET_MEGA_MENU_URL . 'assets/css/unminified/mega-menu.css', KEMET_ADDONS_VERSION );
			
			$js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}

			wp_enqueue_script( 'kemet-addons-mega-menu-js', KEMET_MEGA_MENU_URL . 'assets/js/' . $dir . '/admin-mega-menu' . $js_prefix, array(
				'jquery',
				'kemet-addons-select2',
			), KEMET_ADDONS_VERSION, true );

			wp_localize_script(
                'kemet-addons-mega-menu-js', 'kemetAddons', apply_filters(
                'kemet_addons_admin_js_localize', array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'ajax_nonce'    => wp_create_nonce( 'kemet-addons-ajax-get-post' ),
                    )
                )
            );
		
        }
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {

			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}
			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
 
			Kemet_Style_Generator::kmt_add_css( KEMET_MEGA_MENU_DIR.'assets/css/'. $dir .'/style' . $css_prefix );
        }
        
        /**
		 * Append CSS style to class variable.
		 *
		 * @since 1.0.10
		 * @param string $style Inline style string.
		 * @return void
		 */
		public static function add_css( $style ) {
			self::$mega_menu_style .= $style;
		}

		/**
		 * Print inline CSS to footer.
		 *
		 * @since 1.0.10
		 * @return void
		 */
		public function megamenu_style() {
           
			if ( '' != self::$mega_menu_style ) {
				echo "<style type='text/css' class='kemet-megamenu-inline-style'>";
				echo self::$mega_menu_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</style>';
			}
        }
        
        public function add_scripts() {

            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
            }
            
            Kemet_Style_Generator::kmt_add_js( KEMET_MEGA_MENU_DIR.'assets/js/' . $dir . '/mega-menu' . $js_prefix );
        }
    }
}
Kemet_Mega_Menu_Partials::get_instance();
