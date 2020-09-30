<?php
function create__expert_legal() {
	$labels = array(
    'name' => _x('Slider Show', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Slider Show', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add New', 'Slider Show', 'your_text_domain'),
    'add_new_item' => __('Add New Slider Show', 'your_text_domain'),
    'edit_item' => __('Edit Slider Show', 'your_text_domain'),
    'new_item' => __('New Slider Show', 'your_text_domain'),
    'all_items' => __('All Slider Show', 'your_text_domain'),
    'view_item' => __('View Slider Show', 'your_text_domain'),
    'search_items' => __('Search Slider Show', 'your_text_domain'),
    'not_found' =>  __('No Slider Show found', 'your_text_domain'),
    'not_found_in_trash' => __('No Slider Show found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Slider Show', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'slideshow', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	register_post_type('expertlegal', $args);
}
add_action( 'init', 'create__expert_legal' );
?>