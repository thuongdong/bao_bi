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
		<div class="left-content col-md-8">
			<ul class="category-list">
				<?php
				$args = array('post_type' => 'post', 'posts_per_page' => -1);
				$loop = new WP_Query($args);
				?>
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<li class="list-item">
						<div class="thumbnail">
							<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="" />
							<div class="caption">
								<h3 class="title"><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h3>
								<p class="entry-meta">
									<span>
										<i class="fa fa-comments-o"></i>
										<label class="entry-comments"><?php comments_number('Comment (0)', 'Comment (1)',
												'Comments (%)');?></label>
									</span>
								</p>
								<div class="emtry-excerpt">
									<?php echo the_excerpt(); ?>
								</div>
								<p class="bnt-xemthem"><a href="<?php echo get_permalink() ?>" class="btn btn-primary"
												role="button">Xem thêm</a>
								</p>
							</div>
						</div>
					</li>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
		</div>
		<div class="right_sidebar col-md-4">
			<?php get_sidebar( 'right' ); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>