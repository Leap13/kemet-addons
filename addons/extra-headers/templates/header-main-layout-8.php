<?php
/* 
 * Header 8 Layout
 */
?>

<div class="main-header-bar-wrap ss-wrapper">
	<div class="main-header-bar ss-content">
		<?php kemet_main_header_bar_top(); ?>
        <div id="header-layout-8" class="header">
                <div class="kmt-flex main-header-container">
                    <?php kemet_sitehead_content(); ?>
                </div>
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
        
		<?php kemet_main_header_bar_bottom(); ?>
	</div> 
    
</div>