<?php
	/*
	 * Theme Options Icon URL: http://fontawesome.io/icons/
	 *
	 */
	global $array_page;
	$tmp = array(
		'post_type'=> 'page',
		'posts_per_page' => -1		
	);		
	$lists_page = get_posts($tmp);
	$array_page = array();
	foreach($lists_page as $list_page) {
		$id = $list_page->ID;
		$title = get_the_title($list_page->ID);
		$array_page[] = array(
			'text'=>$title, 
			'value'=>$id
		);
	}
	
	$RS->addOptionTab(array(
		'title' => 'General',
		'name' => 'general',
		'icon' => 'dashicons-editor-quote',
		'controls' => array(
			array(
				'description' => '',
				'label' => 'Logo đầu trang',
				'type' => 'image',
				'name' => 'header_logo'
			),
			array(
				'description' => '',
				'label' => 'Logo cuối trang',
				'type' => 'image',
				'name' => 'footer_logo'
			),
			array(
				'description' => '',
				'label' => 'Email',
				'type' => 'text',
				'name' => 'email'
			),
			array(
				'description' => '',
				'label' => 'Hotline 1',
				'type' => 'text',
				'name' => 'hotline1'
			),
			array(
				'description' => '',
				'label' => 'Địa chỉ',
				'type' => 'text',
				'name' => 'address'
			),
			array(
				'description' => '',
				'label' => 'Hotline 2',
				'type' => 'text',
				'name' => 'hotline2'
			),
			array(
				'description' => '',
				'label' => 'Địa chỉ',
				'type' => 'text',
				'name' => 'email'
			),
			array(
				'description' => '',
				'label' => 'CopyRight',
				'type' => 'text',
				'name' => 'copyright_text'
			),
			array(
				'description' => '',
				'label' => 'Tên trang',
				'type' => 'text',
				'name' => 'copyright_name'
			),
			array(
				'description' => '',
				'label' => 'Địa chỉ trang',
				'type' => 'text',
				'name' => 'copyright_link'
			)
		)
	));
	$RS->addOptionTab(array(
		'title' => 'Social',
		'name' => 'social',
		'icon' => 'dashicons-editor-quote',
		'controls' => array(
			array(
				'description' => '',
				'label' => 'Facebook Link',
				'type' => 'text',
				'name' => 'facebook'
			),
//			array(
//				'description' => '',
//				'label' => 'Twitter Link',
//				'type' => 'text',
//				'name' => 'twitter'
//			),
			array(
				'description' => '',
				'label' => 'Google Plus',
				'type' => 'text',
				'name' => 'google'
			)
		)
	));
?>