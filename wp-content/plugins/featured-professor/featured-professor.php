<?php

/*
  Plugin Name: Featured Professor Block Type
  Version: 1.0
  Author: Natalia Drause
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path(__FILE__) . 'inc/generateProfessorHTML.php';
require_once plugin_dir_path(__FILE__) . 'inc/relatedPostsHTML.php';

class FeaturedProfessor {
  function __construct() {
    add_action('init', [$this, 'onInit']);
    // Add custom REST API for professor HTML:
    add_action('rest_api_init', [$this, 'profHTML']);
    // Add posts list to the Professor CPT:
    add_filter('the_content', [$this, 'addRelatedPosts']);
  }

  function onInit() {
    wp_register_script('featuredProfessorScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('featuredProfessorStyle', plugin_dir_url(__FILE__) . 'build/index.css');
    register_meta('post', 'featuredprofessor', array(
      'show_in_rest' => true,
      'type' => 'number',
      'single' => false,
    ));

    register_block_type('ourplugin/featured-professor', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'featuredProfessorScript',
      'editor_style' => 'featuredProfessorStyle'
    ));
  }

  function renderCallback($attributes) {
    if ($attributes['profId']) {
      wp_enqueue_style('featuredProfessorStyle');
      return generateProfessorHTML($attributes['profId']);
    } else {
      return NULL;
    }
  }

  //Add custom REST API for professor HTML:

  function profHTML() {
    register_rest_route('featuredProfessor/v1', 'getHTML', array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => [$this, 'getProfHTML'],
    ));
  }

  function getProfHTML($data) {
    return generateProfessorHTML($data['profId']);
  }

  // Add posts list to the Professor CPT:

  function addRelatedPosts($content) {
    if (is_singular('professor') && in_the_loop() && is_main_query()) {
      return $content . relatedPostsHTML(get_the_id());
    }
    return $content;
  }

}

$featuredProfessor = new FeaturedProfessor();