<?php
/* 
 * Header 7 Layout
 */
?>
<div class="header-layout-7-logo">
    <?php kemet_site_branding_markup(); ?>
    <?php kemet_toggle_buttons_markup(); ?>
    <?php echo kemet_header_custom_item_outside_menu(); ?>
</div>
<div class="menu-icon-social">
    <div class="menu-icon">
        <a id="nav-icon" class="icon-bars-btn">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
</div>
<div class="main-header-bar-wrap ss-wrapper">
	<div class="main-header-bar ss-content">
		<?php kemet_main_header_bar_top(); ?>
        <div id="header-layout-7" class="header">
                <div class="kmt-flex main-header-container">
                    <?php kemet_primary_navigation_markup(); ?>
                </div>
		<?php kemet_main_header_bar_bottom(); ?>
	</div> 
</div>