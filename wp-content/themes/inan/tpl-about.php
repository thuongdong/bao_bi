<?php /* Template Name: About Page */ ?>
<?php get_header();
	the_post();
	$page_show_home = get_field('chon_trang');

	$customers = null;
	$args_customers = array('post_type' => 'customer', 'posts_per_page' => -1);
	$customers = new WP_Query($args_customers);

	$about_items = get_field('about_items');
	//var_dump(get_field('show_slider'));
	if(get_field('show_slider') == 1 ) { ?>
	<div id="banner-slider">
		<?php echo do_shortcode ('[rev_slider banner_slider]'); ?>
	</div>
	<?php }
?>
	<div id="page-title">
		<div class="container clearfix">
			<p>\ <?php the_title(); ?></p>
			<?php if ( get_field( 'file_download' ) ) { ?>
	<a class="download" href="<?php echo get_field( 'file_download' ); ?>"><i class="fa fa-cloud-download"></i>Tải báo giá</a>
<?php } ?>
		</div>
	</div>
	<?php if ( function_exists( 'wp_bac_breadcrumb' ) ) { wp_bac_breadcrumb(); } ?>
</header>
<section class="content-area">
	<div class="container">
		<div class="the-content row">
			<?php
			if(get_post_thumbnail_id( $post->ID )) { ?>
				<div class="col-md-6 col-sm-6">
					<div class="post-thumb"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ?>" alt=""/></div>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php echo the_content(); ?>
				</div>
			<?php } else { ?>
				<div class="col-md-12 col-sm-12">
					<?php echo the_content(); ?>
				</div>
			<?php } ?>
		</div>
		<div class="gia-tri has-top-border">
			<h3 class="custome-title"><?php echo get_field('about_title'); ?></h3>
			<ul class="item-list row">
			<?php
			foreach ($about_items as $item) { ?>
				<li class="col-md-6 col-sm-6">
					<h3 class="title"><i class="fa fa-<?php echo $item['about_icon'] ?>"></i><?php echo $item['about_title']
						?></h3>
					<p>"<?php echo $item['about_excerpt'] ?>"</p>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="customers has-top-border">
			<h3 class="custome-title">Khách hàng thân thiết</h3>
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
</section>
<?php get_footer(); ?>