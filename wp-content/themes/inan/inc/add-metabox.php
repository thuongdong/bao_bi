<?php
/* add meta box */

function add_meta_box_init(){

	add_meta_box( 
		'author-box', 
		'Author Box', 
		'author_render', 
		'testimonial'
	);
	add_meta_box( 
		'url-box', 
		'Url Slider Box', 
		'url_slider_render', 
		'slider'
	);
	add_meta_box( 
		'select-show-box', 
		'Choose Display', 
		'select_show_render', 
		'testimonial'
	);
	add_meta_box( 
		'url-resource-box', 
		'Url Post', 
		'url_resource_render', 
		'resource'
	);
	add_meta_box( 
		'price-product-box', 
		'Price Product', 
		'price_product_render', 
		'product'
	);
	add_meta_box( 
		'featured-products-box', 
		'Featured Products', 
		'featured_products_box', 
		'product'
	);
	function author_render($post){
		$author_testimonial = get_post_meta($post->ID, 'author_testimonial', true);
		echo '<input style="width:99%;" name="author_testimonial" value="'.$author_testimonial.'" type="text" /><br />';
	}
	function url_slider_render($post){
		$url_slider_render = get_post_meta($post->ID, 'url_slider_render', true);
		echo '<input style="width:99%;" name="url_slider_render" value="'.$url_slider_render.'" type="text" /><br />';
	}
	function select_show_render($post){
		$select_show_render = get_post_meta($post->ID, 'select_show_render', true);
		echo '<select name="select_show_render" style="width:99%;height:28px;font-size:14px;">
				  <option value="1" '.($select_show_render == 1 ? 'selected="selected"' : '').'>None</option>
				  <option value="2" '.($select_show_render == 2 ? 'selected="selected"' : '').'>Show Home</option>
			  </select>';

	}
	function url_resource_render($post){
		$url_resource_render = get_post_meta($post->ID, 'url_resource_render', true);
		echo '<input style="width:99%;" name="url_resource_render" value="'.$url_resource_render.'" type="text" /><br />';
	}
	function price_product_render($post){
		$price_product_render = get_post_meta($post->ID, 'price_product_render', true);
		echo '<input style="width:100px;" name="price_product_render" value="'.$price_product_render.'" type="text" />$<br />';
	}
	function featured_products_box($post){
		$featured_products_box = get_post_meta($post->ID, 'featured_products_box', true);
		echo '<select name="featured_products_box" style="width:99%;height:28px;font-size:14px;">
				  <option value="1" '.($featured_products_box == 1 ? 'selected="selected"' : '').'>None</option>
				  <option value="2" '.($featured_products_box == 2 ? 'selected="selected"' : '').'>Show Home</option>
			  </select>';

	}
}

add_action( 'add_meta_boxes', 'add_meta_box_init' );

/* end add meta box */
/* save meta box */

function save_meta(){
	global $post;
	if($post->post_type == 'post'){
		update_post_meta($post->ID, 'author_testimonial', $_POST['author_testimonial']);
		update_post_meta($post->ID, 'url_slider_render', $_POST['url_slider_render']);
		update_post_meta($post->ID, 'select_show_render', $_POST['select_show_render']);
		update_post_meta($post->ID, 'url_resource_render', $_POST['url_resource_render']);
		update_post_meta($post->ID, 'price_product_render', $_POST['price_product_render']);
		update_post_meta($post->ID, 'featured_products_box', $_POST['featured_products_box']);
	}
}

add_action('save_post', 'save_meta');
?>
