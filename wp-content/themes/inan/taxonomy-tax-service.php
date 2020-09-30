<?php get_header();
	the_post();
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
			<p>\ <?php echo single_cat_title( '', false ) ?></p>
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
			<div class="col-md-12 service-group">
				<?php
				$category_service = get_term_by('name', single_cat_title( '', false ), 'tax-service');
				//var_dump($category_service);
				?>
				<div class="service-content">
					<div class="service-thumb">
						<img class="thumb" src="<?php the_field('thumb_service', $category_service); ?>" alt="" />
						<h2 class="the-title clearfix"><?php echo single_cat_title( '', false ) ?></h2>
					</div>
					<ul class="list-group printing clearfix">
						<?php
						$term_id = $category_service->term_id;
						$query_args = array( 'post__not_in' => array( $post->ID ), 'posts_per_page' => -1, 'post_type' => 'service', 'tax_query' => array(
							array(
								'taxonomy' => 'tax-service',
								'terms' => $term_id
							)));

						$r = new WP_Query($query_args);
						if ($r->have_posts()) {
							while ($r->have_posts()) : $r->the_post(); global $product; ?>
								<li class="col-md-6" style="font-size: <?php the_field('font_size_service', $category_service); ?>px;">
									<img class="icon-service" src="<?php the_field( 'icon_service', $category_service ); ?>" alt="" />
									<a href="<?php the_permalink() ?>" title="<?php if ( get_the_title() ) the_title(); else the_ID(); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
							<?php endwhile; ?>
							<?php
							// Reset the global $the_post as this query will have stomped on it
							wp_reset_query();
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>