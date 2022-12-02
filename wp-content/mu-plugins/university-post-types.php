<?php
function university_post_types() {

  // Campus Post Type
  register_post_type('campus', array(
    'capability_type' => 'campus',
    'map_meta_cap' => true,
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'campuses',
    ),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Campus',
      'add_new_item' => 'Add New Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus',
    ),
    'menu_icon' => 'dashicons-location-alt',
    'supports' => array('title', 'editor', 'excerpt'),
  ));
  
  // Event Post Type
  register_post_type('event', array(
    'capability_type' => 'event',
    'map_meta_cap' => true,
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'events',
    ),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event',
    ),
    'menu_icon' => 'dashicons-calendar',
    'supports' => array('title', 'editor', 'excerpt'),
  ));

  // Program Post Type
  register_post_type('program', array(
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'programs',
    ),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program',
    ),
    'menu_icon' => 'dashicons-awards',
    'supports' => array('title'),
  ));

  // Professor Post Type
  register_post_type('professor', array(
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor',
    ),
    'menu_icon' => 'dashicons-welcome-learn-more',
    'supports' => array('title', 'editor', 'thumbnail'),
  ));

  // Note Post Type
  register_post_type('note', array(
    'capability_type' => 'note',
    'map_meta_cap' => true,
    'public' => false,
    'show_ui' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note',
    ),
    'menu_icon' => 'dashicons-welcome-write-blog',
    'supports' => array('title', 'editor'),
  ));

  // Like Post Type
  register_post_type('like', array(
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Likes',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like',
    ),
    'menu_icon' => 'dashicons-heart',
    'supports' => array('title'),
  ));
}
add_action('init', 'university_post_types');