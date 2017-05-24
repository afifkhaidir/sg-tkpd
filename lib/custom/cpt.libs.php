<?php

namespace Banana\PostTypes;

function gallery() {

    //Thumbnails Gallery for Visit Tokopedia
    if ( function_exists( 'add_theme_support')){
    	add_theme_support( 'post-thumbnails' );
    }
    add_image_size( 'admin-list-thumb', 80, 80, true); //admin thumbnail
    
    $gallery_labels = array(
    	'name' => _x('Gallery', 'post type general name'),
    	'singular_name' => _x('Gallery', 'post type singular name'),
    	'add_new' => _x('Add New', 'gallery'),
    	'add_new_item' => __("Add New Gallery"),
    	'edit_item' => __("Edit Gallery"),
    	'new_item' => __("New Gallery"),
    	'view_item' => __("View Gallery"),
    	'search_items' => __("Search Gallery"),
    	'not_found' =>  __('No galleries found'),
    	'not_found_in_trash' => __('No galleries found in Trash'), 
    	'parent_item_colon' => ''
    		
    );
    $gallery_args = array(
    	'labels' => $gallery_labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'hierarchical' => true,
    	'menu_position' => null,
    	'capability_type' => 'post',
    	'supports' => array('title', 'thumbnail'),
    	'menu_icon' => 'dashicons-format-gallery' //get_bloginfo('template_directory') . '/images/photo-album.png' //16x16 png
    ); 
    register_post_type('gallery', $gallery_args);
}

add_action('init', __NAMESPACE__ . '\\gallery');
