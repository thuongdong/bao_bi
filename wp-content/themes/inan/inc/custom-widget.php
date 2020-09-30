<?php
global $array_cat, $array_page;
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
//var_dump($array_page);
//======================
class Oil_Categories_Widget extends WP_Widget {
	function Oil_Categories_Widget() {
		$widget_ops = array( 'classname' => 'oil-categories-widget', 'description' => __('A widget that displays the categories of Oil', 'oil-categories-widget') );
		$control_ops = array( 'width' => 500, 'height' => 500, 'id_base' => 'oil-categories-widget' );
		$this->WP_Widget( 'oil-categories-widget', __('Oil Categories Widget', 'oil-categories-widget'), $widget_ops, $control_ops );
	}  
	function widget( $args, $instance ) {
		$title = $instance['title']; ?>
		<h2 class="title"><?php echo $title; ?></h2>
		<?php
		$args_coil = array(
			'order'              => 'DESC',
			'hide_empty'         => 1
		);
		$cats_oil = get_terms('p-oil', $args_coil);
		?>
		<ul class="category-list">
			<?php
			foreach ( $cats_oil as $c ) { //var_dump($c); ?>
				<li><span><?php echo $c->name; ?></span>
				<ul>
				<?php query_posts(array(
					'post_type' => 'oil',
					'tax_query' => array(
						array(
							'taxonomy' => 'p-oil',
							'field' => 'id',
							'terms' => $c->term_id
						)
					),
					'posts_per_page' => -1,
					'offset' => 1
				));
				while ( have_posts() ) : the_post();
					?>
					<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
				<?php
				endwhile; wp_reset_query(); ?>
				</ul>
			<?php } ?>
		</ul>
	<?php
	}
	function form($instance) {
		global $RS;
		?>
		<p style="margin:10px 0 5px 0;"><strong>Title</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('title'),
				'value' => $instance['title']
			)
		);
		$RS->ajaxTrigger();
	}
};
//======================
class Get_Products_By_Cat_Widget extends WP_Widget {
	function Get_Products_By_Cat_Widget() {
		$widget_ops = array( 'classname' => 'get-products-widget', 'description' => __('A widget that displays the products by categories', 'get-products-widget') );
		$control_ops = array( 'width' => 500, 'height' => 500, 'id_base' => 'get-products-widget' );
		$this->WP_Widget( 'get-products-widget', __('Get Products By Category Widget', 'get-products-widget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		$cat_id = $instance['select_category']; ?>
		<div class="col-md-3 col-sm-6">
			<div class="footer-about-us">
				<?php
					$term = get_term( $cat_id, 'p-oil' );
					$slug = $term->slug;
					//var_dump($term);
				?>
				<h3 class="footer-title"><?php echo $term->name; ?></h3>
				<ul class="arrow">
					<?php
					query_posts(array(
						'post_type' => 'oil',
						'tax_query' => array(
							array(
								'taxonomy' => 'p-oil',
								'field' => 'slug',
								'terms' => $slug
							)
						),
						'posts_per_page' => -1,
						'offset' => 1
					));
					while ( have_posts() ) : the_post();
						?>
						<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
					<?php
					endwhile; wp_reset_query(); ?>
				</ul>
			</div>
		</div><!--/ end about us -->
	<?php
	}
	function form($instance) {
		global $RS;
		?>
		<p style="margin:10px 0 5px 0;"><strong>Select Category</strong></p>
		<?php
		$args_coil1 = array(
			'order'              => 'DESC',
			'hide_empty'         => 1
		);
		$cats_oil1 = get_terms('p-oil', $args_coil1);
		foreach($cats_oil1 as $item1) {
			$id = $item1->term_id;
			$title = $item1->name;
			$array_cat[] = array(
				'text'=>$title,
				'value'=>$id
			);
		}
		$RS->selectbox(
			array(
				'name' => $this->get_field_name('select_category'),
				'value' => $instance['select_category'],
				'label' => 'Select Category',
				'type' => 'select',
				'items' => $array_cat
			));
		$RS->ajaxTrigger();
	}
};
//======================
class Show_Page_In_Widget extends WP_Widget {
	function Show_Page_In_Widget() {
		$widget_ops = array( 'classname' => 'show-page-widget', 'description' => __('A widget that displays the title and content page in widget', 'show-page-widget') );
		$control_ops = array( 'width' => 500, 'height' => 500, 'id_base' => 'show-page-widget' );
		$this->WP_Widget( 'show-page-widget', __('Show title and content in widget', 'show-page-widget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		$page_id = $instance['select_page'];
		$post = get_post($page_id);
		$title = apply_filters('the_title', $post->post_title);
		$content = apply_filters('the_content', $post->post_content); ?>
		<div class="col-md-5">
			<h3 class="title"><?php echo $title; ?></h3>
			<?php echo $content; ?>
		</div>
	<?php
	}
	function form($instance) {
		global $RS, $array_page;
		//var_dump($array_page);
		?>
		<p style="margin:10px 0 5px 0;"><strong>Select Page</strong></p>
		<?php
		$RS->selectbox(
			array(
				'name' => $this->get_field_name('select_page'),
				'value' => $instance['select_page'],
				'label' => 'Select Page',
				'type' => 'select',
				'items' => $array_page
			));
		$RS->ajaxTrigger();
	}
};
//======================
class Display_Post_List_Widget extends WP_Widget {
	function Display_Post_List_Widget() {
		$widget_ops = array( 'classname' => 'post-list-widget', 'description' => __('A widget that displays post list in widget', 'post-list-widget') );
		$control_ops = array( 'width' => 500, 'height' => 500, 'id_base' => 'post-list-widget' );
		$this->WP_Widget( 'post-list-widget', __('Show post list in widget', 'post-list-widget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$order = $instance['order'];
		$post_number = $instance['post_number'];
		$args = array(
			'posts_per_page'   => $post_number,
			'offset'           => 0,
			'category'         => '',
			'category_name'    => '',
			'orderby'          => 'date',
			'order'            => $order,
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'author'	   => '',
			'post_status'      => 'publish',
			'suppress_filters' => false
		);
		$loop = new WP_Query($args); ?>
		<div class="col-md-4 col-sm-6">
			<h3 class="title"><?php echo $title; ?></h3>
			<?php
			while ($loop->have_posts()) : $loop->the_post(); global $post; //var_dump($post); ?>
				<div class="media latest-post">
					<?php echo get_the_post_thumbnail($post->ID)?'<img alt="img" src="'. wp_get_attachment_url(get_post_thumbnail_id($post->ID)).'" class="pull-left">':'' ?>
					<div class="media-body post-body">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
						<p class="post-meta">
							<span class="post-meta-author">By <?php echo get_the_author(); ?></span>
							<span class="date">On <?php echo $post->post_date; ?><!--On Aug 19, 2014--></span>
							<!-- <span class="post-meta-comments"><i class="fa fa-comments"></i> <a href="#">11</a></span> -->
						</p>
					</div>
				</div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php
	}
	function form($instance) {
		global $RS;
		?>
		<p style="margin:10px 0 5px 0;"><strong>Tiêu đề</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('title'),
				'value' => $instance['title']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Sắp xếp Theo</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('order'),
				'value' => $instance['order']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Số bài viết</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('post_number'),
				'value' => $instance['post_number']
			)
		);
	}
};
//======================
class Get_In_Touch_Widget extends WP_Widget {
	function Get_In_Touch_Widget() {
		$widget_ops = array( 'classname' => 'get-in-touch-widget', 'description' => __('A widget that displays get in tauch in widget', 'get-in-touch-widget') );
		$control_ops = array( 'width' => 500, 'height' => 500, 'id_base' => 'get-in-touch-widget' );
		$this->WP_Widget( 'get-in-touch-widget', __('Show get in touch in widget', 'get-in-touch-widget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$address = $instance['address_'];
		$phonenumber = $instance['phonenumber_'];
		$fax = $instance['fax_'];
		$email = $instance['email_'];
		$facebook = $instance['facebook_'];
		$twitter = $instance['twitter_'];
		$googleplus = $instance['googleplus_'];
		$linkedin = $instance['linkedin_'];
		$youtube = $instance['youtube_']; ?>
		<div class="col-md-3 col-sm-6">
			<h3 class="title"><?php echo $title; ?></h3>
			<div style="margin-left: 10px;" class="content-box">
				<address class="footer-address">
					<?php echo $address?'<p><i class="fa fa-globe"> </i> '.$address.'</p>':'';?>
					<?php echo $phonenumber?'<p><i class="fa fa-phone"> </i> '.$phonenumber.'</p>':'';?>
					<?php echo $fax?'<p><i class="fa fa-fax"> </i> '.$fax.'</p>':'';?>
					<?php echo $email?'<p><i class="fa fa-envelope-o"> </i> <a href="mailto:'. $email .'">'.$email.'</a></p>':'';?>
				</address>
				<p class="footer-social social">
					<?php echo $facebook?'<a target="_blank" href="'. $facebook .'"><i style="margin-left: 6px;margin-top: 6px;" class="fa fa-facebook"></i></a>':'';?>
					<?php echo $twitter?'<a target="_blank" href="'. $twitter .'"><i style="margin-left: 6px;margin-top: 6px;" class="fa fa-twitter"></i></a>':'';?>
					<?php echo $googleplus?'<a target="_blank" href="'. $googleplus .'"><i style="margin-left: 6px;margin-top: 6px;" class="fa fa-google-plus"></i></a>':'';?>
					<?php echo $linkedin?'<a target="_blank" href="'. $linkedin .'"><i style="margin-left: 6px;margin-top: 6px;" class="fa fa-linkedin"></i></a>':'';?>
					<?php echo $youtube?'<a target="_blank" href="'. $youtube .'"><i style="margin-left: 6px;margin-top: 6px;" class="fa fa-youtube"></i></a>':'';?>
				</p>
			</div>
		</div>
	<?php
	}
	function form($instance) {
		global $RS;
		?>
		<p style="margin:10px 0 5px 0;"><strong>Tiêu đề:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('title'),
				'value' => $instance['title']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Địa chỉ:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('address_'),
				'value' => $instance['address_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Hotline:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('phonenumber_'),
				'value' => $instance['phonenumber_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Fax:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('fax_'),
				'value' => $instance['fax_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Email:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('email_'),
				'value' => $instance['email_']
			)
		); ?>
		<h3 style="margin:30px 0 0 0;">Kết nối online</h3>
		<p><strong>Facebook:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('facebook_'),
				'value' => $instance['facebook_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Twitter:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('twitter_'),
				'value' => $instance['twitter_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Google Plus:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('googleplus_'),
				'value' => $instance['googleplus_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Linkedin:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('linkedin_'),
				'value' => $instance['linkedin_']
			)
		); ?>
		<p style="margin:10px 0 5px 0;"><strong>Youtube:</strong></p>
		<?php
		$RS->text(
			array(
				'name' => $this->get_field_name('youtube_'),
				'value' => $instance['youtube_']
			)
		);
	}
};

//======================
add_action( 'widgets_init', 'register_my_widget' );
function register_my_widget() {
	register_widget( 'Oil_Categories_Widget' );
	register_widget( 'Get_Products_By_Cat_Widget' );
	register_widget( 'Show_Page_In_Widget' );
	register_widget( 'Display_Post_List_Widget' );
	register_widget( 'Get_In_Touch_Widget' );
}
?>