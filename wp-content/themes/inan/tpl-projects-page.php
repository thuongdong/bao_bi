<?php /* Template Name: Projects Page */ ?>
<?php get_header();
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
			<?php if(get_field('file_download')) { ?>
				<a class="download" href="<?php echo get_field('file_download'); ?>"><i class="fa fa-cloud-download"></i>Tải báo giá</a>
			<?php }?>
		</div>
	</div>
	<?php if (function_exists('wp_bac_breadcrumb')) {wp_bac_breadcrumb();} ?>
</header>
<section class="content-area">
	<div class="container">
		<div data-isotope-nav="isotope" class="isotope-nav nav-categories">
			<?php
			$args_project = array(
				'order'              => 'ASC',
				'hide_empty'         => 1,
				'taxonomy'           => 'tax-project'
			);
			?>
			<ul class="clearfix">
				<li><a data-filter="*" class="active" href="#">Tất cả</a></li>
				<?php
				foreach (get_categories($args_project) as $t_project) { ?>
				<li><a data-filter=".<?php echo $t_project->slug; ?>" href="#" class=""><?php echo $t_project->name; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="row">
			<div class="isotope list-projects" id="isotope" style="position: relative; height: 611.266px;">
			<?php
			$args_project = array('post_type' => 'project', 'posts_per_page' => -1);
			$loop_project = new WP_Query($args_project);
			?>
			<?php while ($loop_project->have_posts()) : $loop_project->the_post();
				$terms = get_the_terms( $post->ID, 'tax-project' );
				$class_term = '';
				foreach ($terms as $term) {
					$class_term = $class_term .' '. $term->slug;
				}
				?>
				<div class="col-md-6 col-sm-6 col-xs-6 <?php echo $class_term; ?> isotope-item" style="position: absolute; left: 0px; top: 0px;">
					<div class="thumbnail">
						<a href="<?php echo get_permalink() ?>" class="thumb-img"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="" /></a>
						<div class="caption">
							<h3 class="title"><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h3>
							<p class="entry-meta">
								<span>
									<i class="fa fa-comments-o"></i>
									<label class="entry-comments"><span class="fb-comments-count" data-href="<?php echo get_permalink() ?>">0</span> bình luận</label>
								</span>
							</p>
							<div class="emtry-excerpt">
								<?php echo the_excerpt(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_query(); ?>
			</div><!-- Isotope content end -->
		</div>
	</div>
</section>
<?php get_footer(); ?>