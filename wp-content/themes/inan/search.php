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
		<div class="left-content col-md-12">
			<div id="search">
					<div id="archive-title">
						Search results for "<strong><?php the_search_query(); ?></strong>"
					</div>
					<?php
			if(have_posts()) : while(have_posts()) : the_post() ?>
				<div class="postItem">
					<div class="categs"></div>
					<div class="meta">
						<div><?php the_date() ?></div>
						<div class="icoAuthor"><a rel="author external" title="" href="#"><?php the_author() ?></a></div>
					</div>
					<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>

					<p><?php the_excerpt(); ?></p>
				</div>
			<?php endwhile; ?>
			<?php else: ?>
				<p>Sorry, but you are looking for something that isn't here.</p>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>