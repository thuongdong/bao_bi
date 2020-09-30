<?php
function create_slider_show() {
	$labels = array(
    'name' => _x('Trình diễn', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Trình diễn', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm mới', 'Slider Show', 'your_text_domain'),
    'add_new_item' => __('Thêm mới trình diễn', 'your_text_domain'),
    'edit_item' => __('Sửa trình diễn', 'your_text_domain'),
    'new_item' => __('Trình diễn mới', 'your_text_domain'),
    'all_items' => __('Tất cả trình diễn', 'your_text_domain'),
    'view_item' => __('Xem trình diễn', 'your_text_domain'),
    'search_items' => __('Tìm kiếm trình diễn', 'your_text_domain'),
    'not_found' =>  __('Không tìm thấy trình diễn', 'your_text_domain'),
    'not_found_in_trash' => __('Không tìm thấy trình diễn trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('Trình diễn', 'your_text_domain')
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
	register_post_type('slideshow', $args);
}
add_action( 'init', 'create_slider_show' );
?>