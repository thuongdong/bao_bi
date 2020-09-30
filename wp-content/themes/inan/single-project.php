<?php get_header();
	the_post();
	//var_dump(get_field('show_slider'));
	if(get_field('show_slider') == 1 ) { ?>
	<div id="banner-slider">
		<img style="max-width: 100%;" src="<?php bloginfo('template_directory'); ?>/images/slider-img.jpg" alt="" />
	</div>
	<?php }
?>
	<div id="page-title">
		<div class="container clearfix">
			<p>/ <?php echo the_title(); ?></p>
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
			<div class="thumbnail">
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="" />
				<div class="caption">
					<p class="entry-meta">
						<span>
							<i class="fa fa-comments-o"></i>
							<label class="entry-comments"><span class="fb-comments-count" data-href="<?php echo get_permalink() ?>">0</span> bình luận</label>
						</span>
					</p>
					<div class="entry-content">
						<?php echo the_content(); ?>
					</div>
				</div>
			</div>
			<div class="post-info">
				<div class="caption">
					<p class="entry-meta">
						<span>
							<i class="fa fa-pencil-square-o"></i>
							Đăng bởi <?php the_author_posts_link(); ?>
						</span>
						<span>
							<i class="fa fa-comments-o"></i>
							<label class="entry-comments"><span class="fb-comments-count" data-href="<?php echo getUrl(); ?>">0</span> bình luận</label>
						</span>
					</p>
				</div>
			</div>
			<div class="leave-comment">
				<div class="fb-comments" data-href="<?php echo getUrl(); ?>" data-numposts="5"></div>
			</div>
		</div>
		<div class="right_sidebar col-md-4">
			<?php get_sidebar( 'right' ); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>