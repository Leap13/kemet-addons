<?php 
if ( !function_exists( 'kemet_is_valid_url' ) ) {

    /**
     * Validate given URL format
     * @param strint $url
     * @return bool
     */
    function kemet_is_valid_url( $url ) {
        return (bool) parse_url( $url, PHP_URL_SCHEME );
    }

}

if ( !function_exists( 'kemet_get_post_thumbnail_format' ) ) {

    /**
     * Get post thumbnail url if added or default image based on poet format
     * @param int $post_id Post id
     * @param string $size Image size
     * @return string Image URL
     */
    function kemet_get_post_thumbnail_format( $post_id, $size ) {
        $attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
        if ( false == $attachment_image ) {
            return ( get_post_format( $post_id ) ) ? get_post_format( $post_id ) : 'standard';
        } else {
            return $attachment_image[ 0 ];
        }
    }

}

if ( !function_exists( 'kemet_get_the_post_thumbnail_background' ) ) {

    /**
     * Get post thumbnail url if added or default image based on poet format
     * @param int $post_id Post id
     * @param string $size Image size
     * @return string Image URL
     */
    function kemet_get_the_post_thumbnail_background( $post_id, $size ) {
        $thumbnail_format = kemet_get_post_thumbnail_format( $post_id, $size );
        if ( kemet_is_valid_url( $thumbnail_format ) ) {
            return '<div class="kmt-blog-featured-section post-thumb" style="background-image:url(' . $thumbnail_format . ');"></div>';
        } else {
            return '<div class="kmt-default-featured-section post-thumb' . $thumbnail_format . '"></div>';
        }
    }

}
/**
 * Set theme images sizes
 */
function leap_theme_image_sizes() {
    add_image_size( '570x570', 200, 200, true );
}

add_action( 'after_setup_theme', 'leap_theme_image_sizes' );