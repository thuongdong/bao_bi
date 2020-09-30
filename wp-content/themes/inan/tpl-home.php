<?php /* Template Name: Home Page */ ?>
<?php get_header();
	$page_show_home = get_field('chon_trang');
	$page_show_home_2 = get_field('chon_trang_2');

	$customers = null;
	$args_customers = array('post_type' => 'customer', 'posts_per_page' => -1);
	$customers = new WP_Query($args_customers);
	
	$educations = null;
	$args_educations = array('post_type' => 'dao-tao', 'posts_per_page' => -1);
	$educations = new WP_Query($args_educations);

	//var_dump(get_field('show_slider'));
	if(get_field('show_slider') == 1 ) { ?>
	<div id="banner-slider">
		<?php echo do_shortcode ('[rev_slider banner_slider]'); ?>
	</div>
	<?php }
?>
	<div id="page-title">
		<div class="container clearfix">
			<p class="wow slideInLeft animated"><?php echo get_field('brand_name'); ?></p>
			<?php
				if(get_field('price_page')) { ?>
					<a class="download wow wobble animated animated" href="<?php echo get_field('price_page'); ?>"><i class="fa
					fa-cloud-download"></i>Trang báo giá</a>
				<?php } elseif(get_field('file_download')) { ?>
					<a class="download wow wobble animated animated" href="<?php echo get_field('file_download'); ?>"><i class="fa fa-cloud-download"></i>Tải báo giá</a>
				<?php }?>
		</div>
	</div>
</header>
<section class="content-area">
	<!--Star Home Services -->
	<div class="home-services" style="background: url('<?php echo get_field('background'); ?>') <?php echo get_field('background_repeat'); ?> top center">
		<div class="container">
			<div class="row">
			<?php
			$terms = get_terms('tax-service', array('hide_empty' => 0, 'order' => 'DESC'));
			$index = 1;
			foreach ($terms as $term) { ?>
				<div class="col-md-6 col-sm-6 col-xs-12 services-item wow zoomInDown animated index-<?php echo $index; ?> thu-nho-<?php echo $index; ?>">
					<h2 class="the-title clearfix">
						<i class="fa fa-<?php the_field('icon_category', $term); ?>"></i>
						<a href="<?php echo get_term_link( $term->slug, 'tax-service' ); ?>"><?php echo $term->name; ?></a>
					</h2>
					<ul class="list-group clearfix">
						<?php
						$term_id = $term->term_id;
						$query_args = array(
							'post__not_in' => array( $post->ID ),
							'posts_per_page' => -1,
							'no_found_rows' => 1,
							'post_status' => 'publish',
							'post_type' => 'service',
							'meta_key' => 'thu_tu',
							'orderby' => 'meta_value',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'tax-service',
									'terms' => $term_id
								)
							)
						);

						$r = new WP_Query($query_args);
						if ($r->have_posts()) {
							$index2 = 1;
							while ( $r->have_posts() ) : $r->the_post();
								global $product;
								if($index2 <= 6) { ?>
								<li class="col-md-12 col-sm-12 col-xs-6 <?php echo the_field('thu_tu'); ?>" style="font-size: <?php the_field('font_size_service', $term); ?>px;">
									<img class="icon-service" src="<?php the_field( 'icon_service', $term ); ?>" alt="" />
									<a href="<?php the_permalink() ?>" title="<?php get_the_title()?the_title():the_ID(); ?>"><?php get_the_title()?the_title():the_ID(); ?></a>
								</li>
								<?php } else { ?>
									<li class="col-md-12 col-sm-12 col-xs-6 <?php echo the_field('thu_tu'); ?> item-hide" style="font-size: <?php the_field('font_size_service', $term); ?>px;">
										<img class="icon-service" src="<?php the_field( 'icon_service', $term ); ?>" alt="" />
										<a href="<?php the_permalink() ?>" title="<?php get_the_title()?the_title():the_ID(); ?>"><?php get_the_title()?the_title():the_ID(); ?></a>
									</li>
								<?php } $index2++; endwhile; ?>
							<?php
							// Reset the global $the_post as this query will have stomped on it
							wp_reset_query();
						} ?>
					</ul>
					<a id="index-<?php echo $index; ?>" class="readmore" href="#">Xem thêm</a>
					<a id="thu-nho-<?php echo $index; ?>" class="thu-nho" href="#">Thu nhỏ</a>
				</div>
			<?php $index++; } ?>
			</div>
		</div>
	</div>
	<!--End Home Services-->

  <?php
	if($page_show_home) { ?>
    <!--Star Site Content-->
    <div class="container site-content">
      <div class="row">
        <main id="main" class="site-main wow bounceInUp animated">
          <?php
          $post = get_post($page_show_home);
          $title = apply_filters('the_title', $post->post_title);
          $excerpt = apply_filters('the_content', $post->post_excerpt);
          $thumb_link = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
          ?>
          <h2 class="the-title center-block clearfix"><a href="<?php echo get_page_link($page_show_home); ?>"><?php echo $title; ?></a></h2>
          <div class="post-excerpt"><?php echo $excerpt; ?></div>
          <a href="<?php echo get_page_link($page_show_home); ?>"><img class="post-thumb" src="<?php echo $thumb_link; ?>" alt="" /></a>
        </main>
      </div>
    </div>
    <!--End Site Content-->
  <?php } ?>

  <?php
		if($page_show_home_2) { ?>
  	<!--Star In Offset-->
    <div class="container in-offset">
      <div class="row">
        <main id="main" class="site-main wow bounceInUp animated">
          <?php
                             $post = get_post($page_show_home_2);
                             $title = apply_filters('the_title', $post->post_title);
                             $excerpt = apply_filters('the_content', $post->post_excerpt);
                             $thumb_link = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
  ?>
          <h2 class="the-title center-block clearfix"><a href="<?php echo get_page_link($page_show_home_2); ?>"><?php echo $title; ?></a></h2>
          <div class="post-excerpt"><?php echo $excerpt; ?></div>
          <a href="<?php echo get_page_link($page_show_home_2); ?>"><img class="post-thumb" src="<?php echo $thumb_link; ?>" alt="" /></a>
        </main>
      </div>
    </div>
    <!--End In Offset-->
    <?php } ?>

	<!--Star New Projects Show-->
	<?php
	$args_project = array('post_type' => 'project', 'posts_per_page' => 6);
	$loop_project = new WP_Query($args_project);
	//var_dump($loop_project);
	?>
	<div class="new-projects">
		<div class="container">
			<h2 class="the-title center-block clearfix"><a href="#">Dự án mới</a></h2>
			<ul class="projects-list row">
				<?php
				while ($loop_project->have_posts()) : $loop_project->the_post(); ?>
					<li class="col-md-4 col-sm-6 col-xs-6 wow zoomInUp animated">
						<div class="thumbnail">
							<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="" />
							<div class="caption">
								<h3 class="title"><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h3>
								<p class="entry-meta">
									<span>
										<i class="fa fa-comments-o"></i>
										<label class="entry-comments"><span class="fb-comments-count" data-href="<?php echo get_permalink() ?>">0</span> bình luận</label>
									</span>
								</p>
								<p><a href="<?php echo get_permalink() ?>" class="btn btn-primary" role="button">Xem thêm</a></p>
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
		<div class="customers wow zoomInDown animated">
			<div class="container">
				<h2 class="the-title center-block clearfix"><a href="#">Khách hàng thân thiết</a></h2>
				<ul class="customers-list row">
					<?php
					while ($customers->have_posts()) : $customers->the_post(); ?>
						<li><a target="_blank" href="<?php echo get_post_meta
							($post->ID,
								'link_customer', true) ?>"><img src="<?php
								echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="<?php the_title(); ?>" /></a></li>
					<?php endwhile; wp_reset_query(); ?>
				</ul>
			</div>
		</div>
	<?php } ?>
	<!-- End Customers -->
</section>
<?php get_footer(); ?>