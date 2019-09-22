<?php
/**
 * Template for Small Footer Layout 2
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

$section_1 = Kemet_Extra_Header_Partials::kemet_get_top_section( 'top-section-1' );
$section_2 = Kemet_Extra_Header_Partials::kemet_get_top_section( 'top-section-2' );

$sections  = 0;

 if ( '' != $section_1 ) {
 	$sections++;
 }

 if ( '' != $section_2 ) {
 	$sections++;
 }

// switch ( $sections ) {
//
// 	case '2':
// 			$section_class = 'kmt-topbar-section kmt-col-md-6 kmt-col-xs-12';
// 		break;
//
// 	case '1':
// 	default:
// 			$section_class = 'kmt-topbar-section kmt-col-xs-12';
// 		break;
// }
// if ( empty( $section_1 ) && empty( $section_2 ) ) {
//	return;
//}

$classes = kemet_get_option( 'topbar-responsive' );

?>

<div class="kemet-top-header-wrap" >
	<div class="kemet-top-header  <?php echo esc_attr( $classes ); ?>" >
		<div class="kmt-container">
			<div class="kmt-row kmt-flex kemet-top-header-section-wrap">
					<div class="kemet-top-header-section kemet-top-header-section-1 kmt-flex kmt-justify-content-flex-start mt-topbar-section-equally kmt-col-md-6 kmt-col-xs-12" >
							<?php print_r($section_1); ?>
					</div>

					<div class="kemet-top-header-section kemet-top-header-section-2 kmt-flex kmt-justify-content-flex-end mt-topbar-section-equally kmt-col-md-6 kmt-col-xs-12<" >
							<?php print_r($section_2); ?>
					</div>
			</div>
		</div><!-- .kmt-container -->
	</div><!-- .kemet-top-header -->
</div><!-- .kemet-top-header-wrap -->