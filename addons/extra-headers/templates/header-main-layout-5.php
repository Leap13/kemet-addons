<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="main-header-bar-wrap kemet-addons-header-layout-1">
	<div class="main-header-bar">
        <?php kemet_main_header_bar_top(); ?>
        <div id="header-layout-5" class="header kemet-addons-header5">
            <div class="kmt-container">
                <div class="main-header-container">
                    <div class="kmt-navbar-collapse">
                        <?php kemet_primary_navigation_markup(); ?>
                    </div>
                </div>
                <div class="kemet-addons-icon-header">
                    <div class="kmt-navbar-fixed-top">
                        <?php kemet_logo(); ?>
                    </div>
                    <div class="kemet-addons-icon">
                        <div class="social-icons">
                            <?php echo kemet_header_custom_item_outside_menu(); ?>
                        </div>
                        <div class="kmt-icon-social-block">
                            <div id="animated-icon" class="animated-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Main Header Container -->
        </div><!-- Header Layout 5 -->
        <?php kemet_main_header_bar_bottom(); ?>
    </div> <!-- Main Header Bar -->
</div> <!-- Main Header Bar Wrap -->
