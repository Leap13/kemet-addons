<?php
/**
 * Template for Top Bar Layouout
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */
if ( ! function_exists( 'kemet_get_top_section' ) ) {

	/**
	 * Function to get top section
	 * @param string $section
	 * @return mixed
	 */
	function kemet_get_top_section( $option ) {

		 $output  = '';
		 $section = kemet_get_option( $option );   
		  if ( is_array( $section ) ) {
			
			foreach ( $section as $sectionnn ) {

				switch ( $sectionnn ) {

			case 'search':
					$output .= kemet_get_search();
				break;

            case 'menu':
					$output .= kemet_get_top_menu();
				break;

			case 'widget':
					$output .= kemet_get_custom_widget($option);
			break;

			case 'text-html':
					$output .= kemet_get_custom_html( $option . '-html' );
			break;
			}
		}
			return $output;			
	}
	}
}
$section_1 = kemet_get_top_section( 'top-section-1' );
$section_2 = kemet_get_top_section( 'top-section-2' );

$sections  = 0;

 if ( '' != $section_1 ) {
 	$sections++;
 }

 if ( '' != $section_2 ) {
 	$sections++;
 }

if ( empty( $section_1 ) && empty( $section_2 ) ) {
	return;
}

$classes = kemet_get_option( 'topbar-responsive' );

?>

<div class="kemet-top-header-wrap" >
	<div class="kemet-top-header  <?php echo esc_attr( $classes ); ?>" >
		<div class="kmt-container">
			<div class="kmt-row kmt-flex kemet-top-header-section-wrap">
					<div class="kemet-top-header-section kemet-top-header-section-1 kmt-flex kmt-justify-content-flex-start mt-topbar-section-equally kmt-col-md-6 kmt-col-xs-12" >
							<?php echo $section_1; ?>
					</div>

					<div class="kemet-top-header-section kemet-top-header-section-2 kmt-flex kmt-justify-content-flex-end mt-topbar-section-equally kmt-col-md-6 kmt-col-xs-12<" >
							<?php echo $section_2; ?>
					</div>
			</div>
		</div><!-- .kmt-container -->
	</div><!-- .kemet-top-header -->
</div><!-- .kemet-top-header-wrap -->