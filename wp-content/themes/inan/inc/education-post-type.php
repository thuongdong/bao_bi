<?php
function create_education() {
	$labels = array(
    'name' => _x('Đào tạo', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Đào tạo', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm', 'Đào tạo', 'your_text_domain'),
    'add_new_item' => __('Thêm Đào tạo mới', 'your_text_domain'),
    'edit_item' => __('Sửa Đào tạo', 'your_text_domain'),
    'new_item' => __('Đào tạo mới', 'your_text_domain'),
    'all_items' => __('Tất cả Đào tạo', 'your_text_domain'),
    'view_item' => __('Xem Đào tạo', 'your_text_domain'),
    'search_items' => __('Tìm kiếm Đào tạo', 'your_text_domain'),
    'not_found' =>  __('Không có Đào tạo tìm thấy', 'your_text_domain'),
    'not_found_in_trash' => __('Không có Đào tạo tìm thấy trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('Đào tạo', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'dao-tao', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	register_post_type('dao-tao', $args);
}
add_action( 'init', 'create_education' );
?>