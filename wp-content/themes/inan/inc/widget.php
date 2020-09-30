<?php
	add_action('init', 'create_system');
	//khoi tạo he thông
	function create_system(){
		add_theme_support('post-thumbnails');
		
		if(function_exists('register_sidebar')){
			register_sidebar(
				array(
				'name'=>'Left Widget',//tên của widget
				'id'=>'left_widget',//id của widget, dùng để gọi ra
				'before_widget'=>'<div class="box">',//các thẻ bao nó.
				'before_title'=>'<h2 class="title">',
				'after_title'=>'</h2>',
				'after_widget'=>'</div>',
				)
			);
			register_sidebar(
				array(
				'name'=>'Footer Widget',//tên của widget
				'id'=>'footer_widget',//id của widget, dùng để gọi ra
				'before_widget'=>'<div class="qc-form col-md-3 col-sm-6">',//các thẻ bao nó.
				'before_title'=>'<h3 class="footer-title">',
				'after_title'=>'</h3>',
				'after_widget'=>'</div>',
				)
			);
			register_sidebar(
				array(
				'name'=>'Bottom Widget',//tên của widget
				'id'=>'bottom_widget',//id của widget, dùng để gọi ra
				'before_widget'=>'<div class="col-md-3 col-sm-6">',//các thẻ bao nó.
				'before_title'=>'<h3 class="title">',
				'after_title'=>'</h3>',
				'after_widget'=>'</div>',
				)
			);
		}
	}
?>