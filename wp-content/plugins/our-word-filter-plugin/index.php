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
    //add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array ( $this, 'word_filter_page'), plugin_dir_url(__FILE__) . 'custom.svg', 100);
    $main_page_hook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', array ( $this, 'word_filter_page'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
    add_submenu_page('ourwordfilter', 'Words to Filter', 'Words List', 'manage_options', 'ourwordfilter', array($this, 'word_filter_page'));
    add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'options_subpage'));
    // Add CSS to the settings page.
    add_action("load-{$main_page_hook}", array($this, 'main_page_assets'));
  }

  function main_page_assets() {
    wp_enqueue_style('filter_admin_CSS', plugin_dir_url(__FILE__) . 'styles.css');
  }

  // Form handling.
  function handle_form() {
    if (wp_verify_nonce($_POST['our_nonce'], 'save_filter_words') AND current_user_can('manage_options')) {
      update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter'])); ?>
        <div class="updated">
          <p>Your filtered words were saved.</p>
        </div> 
    <?php } else { ?>
            <div class="error">
              <p>Sorry, you do not have permission to perform that action.</p>
            </div>
    <?php }
  }

  // HTML for main settings page.
  function word_filter_page() { ?>
    <div class="wrap">
      <h1>Word Filter</h1>
      <?php if ($_POST['justsubmitted'] == "true") $this->handle_form() ?>
      <form method="POST">
        <input type="hidden" name="justsubmitted" value="true">
        <?php wp_nonce_field('save_filter_words', 'our_nonce') ?>
        <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p></label>
        <div class="word-filter__flex-container">
          <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, aweful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')); ?></textarea>
        </div>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
      </form>
    </div>
  <?php }

  // HTML for settings subpage.
  function options_subpage() { ?>
    Hello world from the options page
  <?php }

}

$our_word_filter_plugin = new OurWordFilterPlugin();