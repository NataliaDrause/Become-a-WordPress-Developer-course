<?php

/*
  Plugin Name: Our Word Filter Plugin
  Description: Replaces a list of words.
  Version: 1.0
  Author: Natalia
  Author URI: https://nataliadrause.com
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class OurWordFilterPlugin {

  function __construct() {
    // Register menu option and add settings page.
    add_action('admin_menu', array($this, 'our_menu'));
    
  }

  // Register menu options.
  function our_menu() {
    add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array ( $this, 'word_filter_page'), 'dashicons-smiley', 100);
    add_submenu_page('ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'word_filter_page'));
    add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'options_subpage'));
  }
  // HTML for main settings page.
  function word_filter_page() { ?>
    Hello world
  <?php }
  // HTML for settings subpage.
  function options_subpage() { ?>
    Hello world from the options page
  <?php }

}

$our_word_filter_plugin = new OurWordFilterPlugin();