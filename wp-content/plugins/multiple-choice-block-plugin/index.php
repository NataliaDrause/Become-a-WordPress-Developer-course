<?php

/*
  Plugin Name: Multiple Choice block plugin
  Description: Gives readers a multiple choice question..
  Version: 1.0
  Author: Natalia
  Author URI: https://nataliadrause.com
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class MultipleChoiceBlock {
  function __construct()
  {
    // Call the main JS file
    add_action('enqueue_block_editor_assets', array($this, 'admin_assets'));
  }

  function admin_assets() {
    wp_enqueue_script('ournewblocktype', plugin_dir_url(__FILE__) . 'test.js', array('wp-blocks', 'wp-element'));
  }
}

$multiple_choice_block = new MultipleChoiceBlock();