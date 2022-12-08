<?php

/*
  Plugin Name: Our Test Plugin
  Description: A trully amazing plugin.
  Version: 1.0
  Author: Natalia
  Author URI: https://nataliadrause.com
  Text Domain: wcpdomain
  Domain Path: /languages
*/

class WordCountAndTimePlugin {
  function __construct() {

    // Add menu link to admin sidebar and settings page.
    add_action( 'admin_menu', array( $this, 'admin_page' ) );

    // Add database options for settings.
    add_action( 'admin_init', array( $this, 'settings' ) );

    // Add the Word Count to posts.
    add_filter( 'the_content', array( $this, 'if_wrap' ) );

    // Call the translations.
    add_action('init', array($this, 'languages'));
  }

  /* METHODS */

  // Call the translations.
  function languages() {
    load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
  }

  // Filter content to add Word Count and check if options are checked.
  function if_wrap($content) {
    if (is_main_query() AND is_single() AND 
    (
      get_option('wcp_wordcount', '1') OR 
      get_option('wcp_charcount', '1') OR 
      get_option('wcp_readtime', '1') 
    )) {
      return $this->create_html($content);
    }
    return $content;
  }
  // Add HTML of the plugin on frontend.
  function create_html($content) {
    $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

    // get word count
    if (get_option('wcp_wordcount', '1') OR get_option('wcp_readtime', '1')) {
      $word_count = str_word_count(strip_tags($content));
    }

    if (get_option('wcp_wordcount', '1')) {
      $html .= esc_html__('This post has', 'wcpdomain') . ' ' . $word_count . ' ' . __('words', 'wcpdomain') . '.<br>';
    }

    if (get_option('wcp_charcount', '1')) {
      $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
    }

    if (get_option('wcp_readtime', '1')) {
      $html .= 'This post will take about ' . round($word_count/225) . ' minute(s) to read.<br>';
    }

    $html .= '</p>';

    if (get_option('wcp_location', '0') == '0') {
      return $html . $content;
    }
    return $content . $html;
    
  }

  // add database options for settings.
  function settings() {

    // add settings page section.
    add_settings_section( 'wcp_first_section', null, null, 'word-count-settings-page' );

    // the Location setting
    add_settings_field( 'wcp_location', 'Display Location', array( $this, 'location_html' ), 'word-count-settings-page', 'wcp_first_section' );
    register_setting('word_count_plugin', 'wcp_location', array( 
      'sanitize_callback' => array($this, 'sanitize_location'), 
      'default' => '0',
      ));

    // the Headline setting
    add_settings_field( 'wcp_headline', 'Headline Text', array( $this, 'headline_html' ), 'word-count-settings-page', 'wcp_first_section' );
    register_setting('word_count_plugin', 'wcp_headline', array( 
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => 'Post Statistics',
      ));

    // the Word count setting
    add_settings_field( 'wcp_wordcount', 'Word count', array( $this, 'checkbox_html' ), 'word-count-settings-page', 'wcp_first_section', array( 'theName' => 'wcp_wordcount'));
    register_setting('word_count_plugin', 'wcp_wordcount', array( 
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1',
      ));

    // the Character count setting
    add_settings_field( 'wcp_charcount', 'Character count', array( $this, 'checkbox_html' ), 'word-count-settings-page', 'wcp_first_section', array( 'theName' => 'wcp_charcount'));
    register_setting('word_count_plugin', 'wcp_charcount', array( 
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1',
      ));

    // the Read time setting
    add_settings_field( 'wcp_readtime', 'Read time', array( $this, 'checkbox_html' ), 'word-count-settings-page', 'wcp_first_section', array( 'theName' => 'wcp_readtime') );
    register_setting('word_count_plugin', 'wcp_readtime', array( 
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1',
      ));

  }

  // Custom sanitizing function for Location field.
  function sanitize_location($input) {
    if ($input !='0' AND $input !='1') {
      $error_msg = 'Display location must be either beginning or end.';
      add_settings_error('wcp_location', 'wcp_location_error', $error_msg);
      return get_option('wcp_location');
    }
    return $input;
  }

  // Location form field HTML
  function location_html() { ?>
    <select name="wcp_location">
      <option value="0" <?php selected( get_option('wcp_location'), '0' ); ?>>Beginning of post</option>
      <option value="1" <?php selected( get_option('wcp_location'), '1' ); ?>>End of post</option>
    </select>
  <?php }

  // Headline form field HTML
  function headline_html() { ?>
    <input type="text" name="wcp_headline" value="<?php echo esc_attr( get_option('wcp_headline') ); ?>">
  <?php }

  // reusable checkbox function
  function checkbox_html($args) { ?>
    <input type="checkbox" name="<?php echo $args['theName']; ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
  <?php }

/*
  // Word count form field HTML
  function wordcount_html() { ?>
    <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
  <?php }

  // Character count form field HTML
  function charcount_html() { ?>
    <input type="checkbox" name="wcp_charcount" value="1" <?php checked(get_option('wcp_charcount'), '1') ?>>
  <?php }

  // Read time form field HTML
  function readtime_html() { ?>
    <input type="checkbox" name="wcp_readtime" value="1" <?php checked(get_option('wcp_readtime'), '1') ?>>
  <?php }
*/

  // add menu link to admin sidebar and settings page
  function admin_page() {
    add_options_page('Word Count Settings', __('Word Count', 'wcpdomain'), 'manage_options', 'word-count-settings-page', array ( $this, 'our_html') );
  }
  
  function our_html() { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method="POST">
        <?php 
          settings_fields('word_count_plugin');
          do_settings_sections('word-count-settings-page');
          submit_button();
        ?>
      </form>
    </div>
  <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();



