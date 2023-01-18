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
    //wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    //wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
    register_block_type(__DIR__, array(
      'render_callback' => array($this, 'the_html'),
    ));
  }

  function the_html($attributes) {
    if (!is_admin()) {
      wp_enqueue_script('attentionFrontent', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'), '1.0', true);
      //wp_enqueue_style('attentionFrontentStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }
    ob_start(); ?>
      <div class="paying-attention-update-me"><pre style="display: none"><?php echo wp_json_encode($attributes) ?></pre></div>
    <?php return ob_get_clean();
  }
}

$multiple_choice_block = new MultipleChoiceBlock();