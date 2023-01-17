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
    add_action('init', array($this, 'admin_assets'));
  }

  function admin_assets() {
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ourplugin/multiple-choice-block', array(
      'editor_script' => 'ournewblocktype',
      'render_callback' => array($this, 'the_html'),
    ));
  }

  function the_html($attributes) {
    ob_start(); ?>
    <h3>Today the sky is <?php echo esc_html($attributes['skyColor']) ?> and the grass is <?php echo esc_html($attributes['grassColor']) ?>.</h3>
    <?php return ob_get_clean();
  }
}

$multiple_choice_block = new MultipleChoiceBlock();