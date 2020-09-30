<?php
$args = array('post_type' => 'post', 'posts_per_page' => -1);
$loop = new WP_Query($args);
?>
<div class="right-box">
	<h3 class="box-title"><i class="fa fa-bell-o"></i>Tin mới nhất</h3>
	<ul class="post-new-list">
		<?php while ($loop->have_posts()) : $loop->the_post(); //var_dump($post); ?>
			<li>
				<div class="thumb">
					<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt=""/>
				</div>
				<h3 class="entry-title"><a title="<?php the_title();?>" href="<?php echo get_permalink()
					?>"><?php echo	cut($post->post_title,	30); ?></a></h3>
				<div class="emtry-excerpt">
					<?php echo cut($post->post_excerpt, 50); ?>
				</div>
				<p class="bnt-xemthem"><a href="<?php echo get_permalink() ?>" class="btn btn-primary"
										  role="button">Xem thêm</a>
			</li>
		<?php endwhile; wp_reset_query(); ?>
	</ul>
</div>
<div class="right-box">
	<h3 class="box-title">Tags</h3>
	<ul class="tags-list clearfix">
		<?php
		$posttags = get_tags();
		//var_dump($posttags);
		if ($posttags) {
			foreach($posttags as $tag) { ?>
				<li><a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a></li>
			<?php } }
		?>
	</ul>
</div>