<?php

/*
  Plugin Name: Our Test Plugin
  Description: A trully amazing plugin.
  Version: 1.0
  Author: Natalia
  Author URI: https://nataliadrause.com
*/

class WordCountAndTimePlugin {
  function __construct() {
    add_action( 'admin_menu', array( $this, 'admin_page' ) );
  }

  function admin_page() {
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array ( $this, 'our_html') );
  }
  
  function our_html() { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
    </div>
  <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();



