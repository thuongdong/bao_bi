<?php
function create_service() {
	$labels = array(
    'name' => _x('Dịch vụ', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Dịch vụ', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm', 'Dịch vụ', 'your_text_domain'),
    'add_new_item' => __('Thêm Dịch vụ mới', 'your_text_domain'),
    'edit_item' => __('Sửa Dịch vụ', 'your_text_domain'),
    'new_item' => __('Dịch vụ mới', 'your_text_domain'),
    'all_items' => __('Tất cả Dịch vụ', 'your_text_domain'),
    'view_item' => __('Xem Dịch vụ', 'your_text_domain'),
    'search_items' => __('Tìm kiếm Dịch vụ', 'your_text_domain'),
    'not_found' =>  __('Không có Dịch vụ tìm thấy', 'your_text_domain'),
    'not_found_in_trash' => __('Không có Dịch vụ tìm thấy trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('Dịch vụ', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'service', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	register_post_type('service', $args);
}
add_action( 'init', 'create_service' );

/* create taxonomy */
function create_service_taxonomy()
{
	$labels = array(
		'name' => 'Loại Dịch vụ',
		'singular_name' => 'Loại Dịch vụ',
		'popular_items' => null,
		'search_items' =>  'Tìm kiếm thể loại',
		'all_items' => 'Tất cả thể loại',
		'parent_item' => 'Parent item',
		'parent_item_colon' => 'Parent item:',
		'edit_item' => 'Sửa thể loại',
		'update_item' => 'Cập nhật thể loại',
		'add_new_item' => 'Thêm thể loại',
		'new_item_name' => 'Thể loại mới',
		'menu_name' => 'Loại Dịch vụ',
	);

	register_taxonomy('tax-service', array('service'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'taxservice' ),
	));
}
add_action( 'init', 'create_service_taxonomy');
/* end create taxonomy */
?>