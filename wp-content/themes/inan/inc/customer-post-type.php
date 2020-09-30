<?php
function create_customer() {
	$labels = array(
    'name' => _x('Khách hàng', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Khách hàng', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm mới', 'Khách hàng', 'your_text_domain'),
    'add_new_item' => __('Thêm khách hàng', 'your_text_domain'),
    'edit_item' => __('Sửa khách hàng', 'your_text_domain'),
    'new_item' => __('Khách hàng mới', 'your_text_domain'),
    'all_items' => __('Tất cả khách hàng', 'your_text_domain'),
    'view_item' => __('Xem khách hàng', 'your_text_domain'),
    'search_items' => __('Tìm kiếm khách hàng', 'your_text_domain'),
    'not_found' =>  __('Không tìm thấy khách hàng', 'your_text_domain'),
    'not_found_in_trash' => __('Không tìm thấy khách hàng trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('Khách hàng', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'customer', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'thumbnail' )
	);
	register_post_type('customer', $args);
}
add_action( 'init', 'create_customer' );

function add_meta_box_init(){
	add_meta_box(
		'link-customer',
		'Liên kết khách hàng',
		'link_customer_render',
		'customer'
	);
}
function link_customer_render($post){
	global $RS;
	$link_customer = get_post_meta($post->ID, 'link_customer', true);
	$RS->text(array(
		'name' => 'link_customer',
		'value' => $link_customer
	));
}
add_action( 'add_meta_boxes', 'add_meta_box_init' );

function save_meta_box(){
	global $post;
	if( $post && $post->post_type == 'customer' ){
		update_post_meta($post->ID, 'link_customer', $_POST['link_customer']);

	}
}
add_action('save_post', 'save_meta_box');
?>