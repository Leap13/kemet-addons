<?php
/**
* Template for Blog Thumbnail Style
*
* @package     Kemet
* @author      Kemet
* @copyright   Copyright ( c ) 2019, Kemet
* @link        https://kemet.io/
* @since       Kemet 1.0.0
*/

?>

<div <?php kemet_blog_layout_class( 'blog-layout-1' ); ?>>
    <?php
        $post_thumb = get_the_post_thumbnail(
            get_the_ID(),
            apply_filters( 'kemet_post_thumbnail_default_size', 'full' ),
            array(
                'itemprop' => 'image',
            )
        );
        $has_feature_image = ' kmt-has-no-feature-image';
        if ( '' !=  $post_thumb ) {
            $has_feature_image = ' kmt-has-feature-image';
        }
    ?>
    <div class = "post-content kmt-col-md-12  <?php echo $has_feature_image ?>">

            <div class = 'blog-entry-content'>
                <?php
                    do_action( 'kemet_blog_archive_title_meta_before' );
                    kemet_get_blog_post_title_meta();
                    do_action( 'kemet_blog_archive_title_meta_after' );
                ?>
            <div class = "entry-content clear <?php echo 'thumbnail-image-'.kemet_get_option('thumbnail-image-position') ;?>" itemprop = 'text'>
            <?php
                // Featured Image
                do_action( 'kemet_blog_archive_featured_image_before' );
                kemet_get_blog_post_thumbnail( 'archive' );
                do_action( 'kemet_blog_archive_featured_image_after' );
            ?>
            <?php kemet_entry_content_before(); ?>

            <?php kemet_the_excerpt(); ?>

            <?php kemet_entry_content_after(); ?>

            <?php
            wp_link_pages(
                array(
                    'before'      => '<div class="page-links">' . esc_html( kemet_default_strings( 'string-blog-page-links-before', false ) ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-link">',
                    'link_after'  => '</span>',
                )
            );
            ?>
            </div><!-- .entry-content .clear -->
            </div><!-- .blog-entry-content -->
    </div><!-- .post-content -->
</div> <!-- .blog-layout-1 -->
