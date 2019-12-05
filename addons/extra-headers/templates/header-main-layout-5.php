<?php
/* 
 * Header 5 Layout
 */

?>

<div class="main-header-bar-wrap">
	<div class="main-header-bar">
        <?php kemet_main_header_bar_top(); ?>
        <div class="header-logo-menu-icon">
                <div class="kmt-navbar-collapse">
                    <?php kemet_primary_navigation_markup(); ?>
                </div>
                <div class="main-header-container logo-menu-icon">
                    <div class="kmt-container">
                    <?php kemet_site_branding_markup(); ?>
                        <div class="menu-icon-social">
                            <div class="menu-icon">
                                <a id="nav-icon" class="icon-bars-btn">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                </a>
                            </div>
                            <div class="social-icons">
                                <?php echo kemet_header_custom_item_outside_menu(); ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- Header Layout 5 -->
        <?php kemet_main_header_bar_bottom(); ?>
    </div> 
</div> 
