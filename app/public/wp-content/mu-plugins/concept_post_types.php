<?php

function function_name3(){
    //Event Post Type
    register_post_type('event', array(
        'capability_type' => 'event', // post by default -- permissions
        'map_meta_cap' => true, // maps capabilities at the right time
        'supports' => array('title','editor','excerpt'),
        'rewrite' => array( 'slug' => 'events'), //url
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit  Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    // Program Post Type
    register_post_type('program', array(
        'supports' => array('title','excerpt'),
        'rewrite' => array( 'slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit  Program',
            'all_items' => 'All Program',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));
    //Professor Post Type
    register_post_type('professor', array(
        'show_in_rest' => true,
        'supports' => array('title','editor','thumbnail'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit  Professor',
            'all_items' => 'All Professor',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

      //Note Post Type
      register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'show_in_rest' => true,
        'supports' => array('title','editor'),
        'has_archive' => true,
        'show_ui' => true, // shows to admin
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New note',
            'edit_item' => 'Edit  Notes',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    //Like Post Type
    register_post_type('like', array(
        'supports' => array('title'),
        'has_archive' => true,
        'show_ui' => true, // shows to admin
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit  Likes',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    ));

    
}

add_action('init','function_name3');
