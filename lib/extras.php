<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/* ==================
 * Add <body> classes
 * ================== */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');


/* ======================
 * Clean up the_excerpt()
 * ====================== */
function excerpt_more() {
  return '&hellip; <a href="' . get_permalink() . '" class="blog-post__excerpt-link">' . __('Lihat Selengkapnya', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/* ========================
 * Exclude page from search
 * ======================== */
function SearchFilter($query) {
    if($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', __NAMESPACE__ . '\\SearchFilter');


/* =====================
 * Custom excerpt length
 * ===================== */
function custom_excerpt_length($length) {
    return 15;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );