<?php /* Template Name: Service Page */ ?>
<?php get_header();
	$custome_items = get_field('services_item');
	if(get_field('show_slider') == 1 ) { ?>
	<div id="banner-slider">
		<?php echo do_shortcode ('[rev_slider banner_slider]'); ?>
	</div>
	<?php }
?>
	<div id="page-title">
		<div class="container clearfix">
			<p>\ <?php the_title(); ?></p>
			<?php if(get_field('file_download')) { ?>
				<a class="download" href="<?php echo get_field('file_download'); ?>"><i class="fa fa-cloud-download"></i>Tải báo giá</a>
			<?php }?>
		</div>
	</div>
	<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
</header>
<section class="content-area">
	<div class="container">
		<div class="row row-padding-10">
		<?php $terms = get_terms('tax-service', array('hide_empty' => 0, 'orderby' => 'ASC'));
		foreach ($terms as $term) { ?>
			<div class="col-md-6 service-group">
				<div class="service-content">
					<div class="service-thumb">
						<img class="thumb" src="<?php the_field('thumb_service', $term); ?>" alt="" />
						<h2 class="the-title clearfix"><?php echo $term->name; ?></h2>
					</div>
					<ul class="list-group printing clearfix">
						<?php
						$term_id = $term->term_id;
						$query_args = array( 'post__not_in' => array( $post->ID ), 'posts_per_page' => -1, 'no_found_rows' =>
							1, 'post_status' => 'publish', 'post_type' => 'service', 'tax_query' => array(
							array(
								'taxonomy' => 'tax-service',
								'terms' => $term_id
							)));

						$r = new WP_Query($query_args);
						if ($r->have_posts()) {
							while ($r->have_posts()) : $r->the_post(); global $product; ?>
								<li class="wow fadeInUp animated col-md-6" style="font-size: <?php the_field('font_size_service', $term); ?>px;">
									<img class="icon-service" src="<?php the_field( 'icon_service', $term ); ?>" alt="" />
									<a href="<?php the_permalink() ?>" title="<?php if ( get_the_title() ) the_title(); else the_ID(); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
							<?php endwhile; ?>
							<?php
							// Reset the global $the_post as this query will have stomped on it
							wp_reset_query();
						} ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</section>
<div class="custom_service">
	<div class="container">
		<h3 class="custome-title"><?php echo get_field('custome_title'); ?></h3>
		<p><?php echo get_field('custome_excerpt'); ?></p>
		<ul class="item-list row">
		<?php
		foreach ($custome_items as $item) { ?>
			<li class="col-md-6 col-sm-6">
				<h3 class="title"><i class="fa fa-<?php echo $item['service_icon'] ?>"></i><?php echo
					$item['service_title'] ?></h3>
				<p>"<?php echo $item['service_excerpt'] ?>"</p>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
<div class="service-img-thumb">
	<div class="container">
		<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" alt=""/>
	</div>
</div>
<?php get_footer(); ?>