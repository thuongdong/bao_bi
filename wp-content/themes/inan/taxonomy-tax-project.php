<?php get_header();
	$page_show_home = get_field('chon_trang');
	$customers = get_field('customers');
	//var_dump(get_field('show_slider'));
	if(get_field('show_slider') == 1 ) { ?>
	<div id="banner-slider">
		<img style="max-width: 100%;" src="<?php bloginfo('template_directory'); ?>/images/slider-img.jpg" alt="" />
	</div>
	<?php }
?>
	<div id="page-title">
		<div class="container clearfix">
			<p>Dịch vụ cung cấp bởi HOANGGIA Ad&Prt</p>
			<?php if(get_field('file_download')) { ?>
				<a class="download" href="<?php echo get_field('file_download'); ?>"><i class="fa fa-cloud-download"></i>Tải báo giá</a>
			<?php }?>
		</div>
	</div>
	<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
</header>
<section class="content-area">
	<!--Star Home Services -->
	<div class="home-services">
		<div class="container">
			<div class="col-md-6">
				<h2 class="the-title clearfix"><i class="fa fa-print"></i><a href="#">Thiết kế in ấn</a></h2>
				<ul class="list-group printing clearfix">
					<li><i class="fa fa-angle-double-right"></i><a href="#">Cras justo odio</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Dapibus ac facilisis in</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Morbi leo risus</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Porta ac consectetur ac</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Vestibulum at eros</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Cras justo odio</a></li>
				</ul>
			</div>
			<div class="col-md-6">
				<h2 class="the-title clearfix"><i class="fa fa-print"></i><a href="#">Thiết kế quảng cáo</a></h2>
				<ul class="list-group advertisement clearfix">
					<li><i class="fa fa-angle-double-right"></i><a href="#">Cras justo odio</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Dapibus ac facilisis in</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Porta ac consectetur ac</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Vestibulum at eros</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Porta ac consectetur ac</a></li>
					<li><i class="fa fa-angle-double-right"></i><a href="#">Vestibulum at eros</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--End Home Services-->
	<!--Star Site Content-->
	<div class="container site-content">
		<div class="row">
			<main id="main" class="site-main">
				<?php
				$post = get_post($page_show_home);
				$title = apply_filters('the_title', $post->post_title);
				$excerpt = apply_filters('the_content', $post->post_excerpt);
				$thumb_link = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
				?>
				<h2 class="the-title center-block clearfix"><a href="<?php echo get_page_link($page_show_home); ?>"><?php echo $title; ?></a></h2>
				<div class="post-excerpt"><?php echo $excerpt; ?></div>
				<img class="post-thumb" src="<?php echo $thumb_link; ?>" alt="" />
			</main>
		</div>
	</div>
	<!--End Site Content-->
	<!--Star New Projects Show-->
	<?php
	$args_project = array('post_type' => 'project', 'posts_per_page' => -1);
	$loop_project = new WP_Query($args_project);
	//var_dump($loop_project);
	?>
	<div class="new-projects">
		<div class="container">
			<h2 class="the-title center-block clearfix"><a href="#">Dự án mới</a></h2>
			<ul class="projects-list row">
				<?php
				while ($loop_project->have_posts()) : $loop_project->the_post(); ?>
					<li class="col-md-4">
						<div class="thumbnail">
							<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="" />
							<div class="caption">
								<h3 class="title"><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h3>
								<p class="entry-meta">
									<span class="entry-author">by <a rel="author" title="Posts by admin" href="#">admin</a></span>
									<span class="entry-comments-link"><a href="#"><?php comments_number('0 COMMENTS', '1 COMMENTS', '% COMMENTS');?> <span>Comments</span></a></span>
								</p>
								<p><a href="<?php echo get_permalink() ?>" class="btn btn-default" role="button">Xem thêm</a></p>
							</div>
						</div>
					</li>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
		</div>
	</div>
	<!--End New Projects Show-->
	<!-- Star Customers-->
	<?php
	if($customers) { ?>
		<div class="customers">
			<div class="container">
				<h2 class="the-title center-block clearfix"><a href="#">Khách hàng thân thiết</a></h2>
				<ul class="customers-list row">
					<?php
						foreach($customers as $customer) {
							if(count($customers) == 1) { ?>
								<li class="col-md-6"><a target="_blank" href="<?php echo $customer['customer_page_home'] ?>"><img src="<?php echo $customer['customer_logo'] ?>" alt="<?php echo $customer['customer_name'] ?>" /></a></li>
							<?php }
							if(count($customers) == 2) { ?>
								<li class="col-md-6"><a target="_blank" href="<?php echo $customer['customer_page_home'] ?>"><img src="<?php echo $customer['customer_logo'] ?>" alt="<?php echo $customer['customer_name'] ?>" /></a></li>
							<?php }
							if(count($customers) == 3) { ?>
								<li class="col-md-4"><a target="_blank" href="<?php echo $customer['customer_page_home'] ?>"><img src="<?php echo $customer['customer_logo'] ?>" alt="<?php echo $customer['customer_name'] ?>" /></a></li>
							<?php }
							if(count($customers) == 4) { ?>
								<li class="col-md-3"><a target="_blank" href="<?php echo $customer['customer_page_home'] ?>"><img src="<?php echo $customer['customer_logo'] ?>" alt="<?php echo $customer['customer_name'] ?>" /></a></li>
							<?php }
							if(count($customers) == 5) { ?>
								<li class="col-md-15 col-sm-3"><a target="_blank" href="<?php echo $customer['customer_page_home'] ?>"><img src="<?php echo $customer['customer_logo'] ?>" alt="<?php echo $customer['customer_name'] ?>" /></a></li>
							<?php }
						}
					?>
				</ul>
			</div>
		</div>
	<?php } ?>
</section>
<?php get_footer(); ?>