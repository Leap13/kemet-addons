<?php
/**
 * Extra Blogs - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_blog_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css dynamic css.
 * @return string
 */
function kemet_blog_layouts_dynamic_css( $dynamic_css ) {

	$blog_pagination_border_color = kemet_get_sub_option( 'blog-pagination-border-color', 'initial' );
	$inifinte_loader_color        = kemet_get_sub_option( 'blog-infinite-loader-color', 'initial' );

	$css_content = array(
		'.kmt-pagination.standard .nav-links > a' => array(
			'--paginationBorderColor' => esc_attr( $blog_pagination_border_color ),
			'border-color'            => 'var(--paginationBorderColor, var(--borderColor))',
		),
		'.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader' => array(
			'--dotsColor'      => esc_attr( $inifinte_loader_color ),
			'background-color' => 'var(--dotsColor, var(--themeColor))',
		),
	);

	$parse_css = kemet_parse_css( $css_content );

	return $dynamic_css . $parse_css;

}
