<?php

/*
  Plugin Name: Our Test Plugin
  Description: A trully amazing plugin.
  Version: 1.0
  Author: Natalia
  Author URI: https://nataliadrause.com
*/

add_filter('the_content', 'add_to_end_of_post');

function add_to_end_of_post( $content ) {
  if ( is_single() && is_main_query() ) {
    return $content . '<p>My name is Natalia</p>';
  }
  return $content;
}