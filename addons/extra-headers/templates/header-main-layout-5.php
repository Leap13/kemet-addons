<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="main-header-bar-wrap">
	<div class="main-header-bar">
        <?php //kemet_main_header_bar_top(); ?>
        <div class="header-logo-menu-icon">
                <div class="kmt-navbar-collapse">
                    <?php kemet_primary_navigation_markup(); ?>
                </div>
            <!-- <div class="kmt-container"> -->
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
            <!--  </div> -->
        </div><!-- Header Layout 5 -->
        <?php kemet_main_header_bar_bottom(); ?>
    </div> <!-- Main Header Bar -->
</div> <!-- Main Header Bar Wrap -->
