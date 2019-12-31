<?php
$title                 = kemet_get_the_title();
$description           = get_the_archive_description();
$classes [] = kemet_get_option( 'page-title-layouts' );
$classes_responsive = kemet_get_option( 'page-title-responsive' );
$classes   = implode( ' ', $classes );
?>

<div class = "kmt-page-title-addon-content  <?php echo esc_attr( $classes_responsive); ?>">
    <div class = "kmt-page-title <?php echo esc_attr( $classes); ?>" >
        <div class = 'kmt-container'>
            <div class = 'kmt-row kmt-flex kemet-top-header-section-wrap'>
                <div class = 'kmt-page-title-wrap kmt-flex kmt-justify-content-flex-end kmt-col-md-6 kmt-col-xs-12'>
                <?php if ( $title ) { ?>
                    <h1 class = 'kemet-page-title'>
                    <?php echo apply_filters( 'kemet_page_title_addon_title', wp_kses_post( $title ) ); ?>
                    </h1>
                <?php } ?>
                <?php if ( $description ) { ?>
                <div class = 'taxonomy-description'>
                    <?php echo apply_filters( 'kemet_page_title_addon_description', wp_kses_post( $description ) ); ?>
                </div>
        <?php } ?>
        </div>
        <div class = 'kmt-flex kmt-justify-content-flex-start kmt-col-md-6 kmt-col-xs-12<'>
        <?php if ( apply_filters( 'kemet_the_page_title_enabled', true ) ) { ?>
            <?php kemet_breadcrumb_trail() ?>
        <?php }  ?>
    </div>
    </div>
    </div>
  </div>
</div>