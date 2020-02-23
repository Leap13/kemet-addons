<?php

/**
 * Page Title
 *
 * @package Kemet Addon
 */

$title                 = kemet_get_the_title();
if(is_singular( 'post' )){
	$header_title = kemet_get_option('page-header-title');
	if($header_title == 'blog'){
		$title  = esc_html__( 'Blog', 'kemet-addons' );
	}
}
$description           = get_the_archive_description();
$classes []= kemet_get_option( 'page-title-layouts' );
$classes_responsive = kemet_get_option( 'page-title-responsive' );
if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) {
	$classes [] = 'has-breadcrumb';
} 
$classes   = implode( ' ', $classes );

?>
<div class="kmt-page-title-addon-content <?php echo esc_attr( $classes_responsive); ?>">
	<div class="kmt-page-title <?php echo esc_attr( $classes); ?>" >
		<div class="kmt-container">
			<div class="kmt-page-title-wrap">
				<?php if ( $title ) { ?>
				<h1 class="kemet-page-title">
					<?php echo apply_filters( 'kemet_page_title_addon_title', wp_kses_post( $title ) ); ?>
				</h1>
				<?php } ?>
				<?php if ( $description ) { ?>
				<div class="taxonomy-description">
					<?php echo apply_filters( 'kemet_page_title_addon_description', wp_kses_post( $description ) ); ?>
				</div>
				<?php } ?>
			</div>
	<?php if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) { ?>
			<?php kemet_breadcrumb_trail() ?>
	<?php } ?>
		</div>
	</div>
</div>
