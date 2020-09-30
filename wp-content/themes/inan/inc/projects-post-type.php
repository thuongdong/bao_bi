<?php
function create_project() {
	$labels = array(
    'name' => _x('Dự án', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Dự án', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Thêm', 'Dự án', 'your_text_domain'),
    'add_new_item' => __('Thêm Dự án mới', 'your_text_domain'),
    'edit_item' => __('Sửa Dự án', 'your_text_domain'),
    'new_item' => __('Dự án mới', 'your_text_domain'),
    'all_items' => __('Tất cả Dự án', 'your_text_domain'),
    'view_item' => __('Xem Dự án', 'your_text_domain'),
    'search_items' => __('Tìm kiếm Dự án', 'your_text_domain'),
    'not_found' =>  __('Không có Dự án tìm thấy', 'your_text_domain'),
    'not_found_in_trash' => __('Không có Dự án tìm thấy trong thùng rác', 'your_text_domain'),
    'parent_item_colon' => '',
    'menu_name' => __('Dự án', 'your_text_domain')
    );
	$args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'project', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	); 
	register_post_type('project', $args);
}
add_action( 'init', 'create_project' );

/* create taxonomy */
function create_project_taxonomy()
{
	$labels = array(
		'name' => 'Loại dự án',
		'singular_name' => 'Loại dự án',
		'popular_items' => null,
		'search_items' =>  'Tìm kiếm thể loại',
		'all_items' => 'Tất cả thể loại',
		'parent_item' => 'Parent item',
		'parent_item_colon' => 'Parent item:',
		'edit_item' => 'Sửa thể loại',
		'update_item' => 'Cập nhật thể loại',
		'add_new_item' => 'Thêm thể loại',
		'new_item_name' => 'Thể loại mới',
		'menu_name' => 'Loại dự án',
	);

	register_taxonomy('tax-project', array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'taxproject' ),
	));
}
add_action( 'init', 'create_project_taxonomy');
/* end create taxonomy */
?>