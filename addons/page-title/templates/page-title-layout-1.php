<?php

/**
 * The title bar style 1 for our theme.
 *
 * This template generates markup required for the title bar style 1
 *
 * @todo Update this template for Default Advanced Headers Style
 *
 * @package Kemet Addon
 */

//$show_breadcrumb       = Kemet_Ext_Advanced_Headers_Loader::kemet_advanced_headers_layout_option( 'breadcrumb' );
//$is_breadcrumb_enabled = '';
$title                 = kemet_get_the_title();
$description           = get_the_archive_description();

// if ( $show_breadcrumb ) {
// 	$is_breadcrumb_enabled = $show_breadcrumb;
// }

?>
<div class="kmt-page-title-addon-content">
	<div class="kmt-page-title kmt-page-title-layout-1" >
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
	<?php //if ( $is_breadcrumb_enabled ) { ?>
			<div class="kmt-advanced-headers-breadcrumb">
			<?php kemet_breadcrumb_trail() ?>
				<?php //Kemet_Ext_Advanced_Headers_Markup::advanced_headers_breadcrumbs_markup(); ?>
			</div><!-- .kmt-advanced-headers-breadcrumb -->
	<?php //} ?>
		</div>
	</div>
</div>
