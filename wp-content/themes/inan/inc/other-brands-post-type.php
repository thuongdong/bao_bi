<?php
function create_breands() {
	$labels = array(
    'name' => _x('Thương hiệu khác', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Thương hiệu khác', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm mới', 'Thương hiệu khác', 'your_text_domain'),
    'add_new_item' => __('Thêm thương hiệu', 'your_text_domain'),
    'edit_item' => __('Sửa thương hiệu', 'your_text_domain'),
    'new_item' => __('Thương hiệu mới', 'your_text_domain'),
    'all_items' => __('Tất cả thương hiệu', 'your_text_domain'),
    'view_item' => __('Xem thương hiệu', 'your_text_domain'),
    'search_items' => __('Tìm kiếm thương hiệu', 'your_text_domain'),
    'not_found' =>  __('Không tìm thấy thương hiệu', 'your_text_domain'),
    'not_found_in_trash' => __('Không tìm thấy thương hiệu trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('hương hiệu khác', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'brand', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	register_post_type('brand', $args);
}
add_action( 'init', 'create_breands' );


function add_meta_box_init(){
	add_meta_box(
		'link-brand',
		'Liên kết thương hiệu',
		'link_brand_render',
		'brand'
	);
}
function link_brand_render($post){
	global $RS;
	$link_brand = get_post_meta($post->ID, 'link_brand', true);
	$RS->text(array(
		'name' => 'link_brand',
		'value' => $link_brand
	));
}
add_action( 'add_meta_boxes', 'add_meta_box_init' );

function save_meta_box(){
	global $post;
	if( $post && $post->post_type == 'brand' ){
		update_post_meta($post->ID, 'link_brand', $_POST['link_brand']);

	}
}
add_action('save_post', 'save_meta_box');
?>