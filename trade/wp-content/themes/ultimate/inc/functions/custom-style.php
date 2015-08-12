<?php
/**
 * Ultimate style functions and definitions
 *
 * This file contains all the functions related to styles.
 * 
 * @package Theme Horse
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
/****************************************************************************************/
/**
 * Changes the style according to theme options value
 */
add_action( 'wp_head', 'ultimate_infobar_information');
function ultimate_infobar_information() {
        global $ultimate_theme_setting_value;
        $options = $ultimate_theme_setting_value;
        if( 0 != $options[ 'hide_header_searchform' ] ){ ?>
        	<style type="text/css">
                .search-toggle, #search-box {
                display: none;
                }
                .hgroup-right {
                padding-right: 0;
                }
                </style>
  <?php }
        if ('off' == $options['slider_content']) {?>
                <style type="text/css">
                .featured-text {
                display: none;
                }
                </style>
 <?php  }
}
?>
