<?php
/* 
 * Header 8 Layout
 */
$icon_label = trim( apply_filters( 'icon_header_label', kemet_get_option( 'header-icon-label' ) ) );
?>
<?php do_action('kemet_before_main_header'); ?>
<div class="main-header-bar-wrap"> 
    <div class="main-header-bar">
        <?php kemet_main_header_bar_top(); ?>
    
        <div class="kmt-container">
            <div id="header-layout-8" class="header inline-icon-menu-header">
                <div class="menu-icon-header-8">
                    <div class="inline-logo-menu"> 
                        <?php kemet_site_branding_markup(); ?>
                            <?php if(wp_is_mobile()){
                            echo '<div class="mobile-icon-outside-menu">' ;   
                            kemet_toggle_buttons_markup();
                            echo kemet_header_custom_item_outside_menu();
                            echo '</div>' ;
                            } ?>
                            <div class="menu-icon-social">
                                <div class="menu-icon">
                                    <a id="nav-icon" class="icon-bars-btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>    
                                </div>
                            </div>
                        
                        <div class="kmt-flex main-header-container">
                            <?php kemet_primary_navigation_markup(); ?>
                        </div>
                    </div>
                </div>
                    <?php if(! wp_is_mobile()){
                        kemet_toggle_buttons_markup();
                        echo kemet_header_custom_item_outside_menu();
                    } ?> 
             <?php kemet_main_header_bar_bottom(); ?>
            </div> 
        </div> 
    </div> 
</div>
<?php do_action('kemet_after_main_header'); ?>