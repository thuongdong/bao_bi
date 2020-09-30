<footer>
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col col-md-4 col-sm-4 col-xs-12 about-us wow flash animated">
					<div class="f-content">
						<a class="f-logo" href="#"><img src="<?php echo get_option('footer_logo')?>" alt="" /></a>
						<span>Tìm chúng tôi trên</span>
						<ul class="footer-sodial">
							<li><a class="facebook" target="_blank" href="<?php echo get_option('facebook')?>"><i
										class="fa
							fa-facebook"></i></a></li>
							<li><a class="google" target="_blank" href="<?php echo get_option('google')?>"><i class="fa
							fa-google-plus"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col col-md-4 col-sm-4 col-xs-12 f-blog wow flash animated">
					<h2 class="title">Blog mới nhất</h2>
					<div class="f-content">
						<ul class="post-list">
							<?php
							$args = $args = array(
								'numberposts' => 3,
								'offset' => 0,
								'category' => 0,
								'orderby' => 'post_date',
								'order' => 'DESC',
								'post_type' => 'post',
								'post_status' => 'publish',
								'suppress_filters' => true );
							$recent_posts = wp_get_recent_posts( $args );
							foreach( $recent_posts as $recent ){ //var_dump($recent); ?>
								<li class="clearfix">
									<div class="thumb"><img src="<?php echo wp_get_attachment_url
										(get_post_thumbnail_id($recent["ID"])); ?>" alt="" /></div>
									<a class="title" href="<?php echo get_permalink($recent["ID"]); ?>"><?php echo
										$recent["post_name"]; ?></a>
									<p class="entry-meta">
									</p>
								</li>
							<?php }
							?>
						</ul>
					</div>
				</div>
				<div class="col col-md-4 col-sm-4 col-xs-12 f-contact wow flash animated">
					<h2 class="title">Thông tin liên hệ</h2>
					<div class="f-content">
						<ul class="list-contact">
							<li class="clearfix"><i class="fa fa-home"></i><p><?php echo get_option('address');
									?></p></li>
							<li class="clearfix"><i class="fa fa-mobile"></i><p><?php echo get_option('hotline1')?></p><p><?php echo get_option('hotline2')?></p></li>
							<li class="clearfix"><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo
								get_option('email')?>"><span><?php echo get_option('email')?></span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<p><?php echo get_option('copyright_text')?> by <a target="_blank" href="<?php echo get_option('copyright_link')?>"><?php echo get_option('copyright_name')?></a></p>
		</div>
	</div>
	<?php wp_footer();?>
</footer>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/less.min.js"></script>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/owl.carousel.min.js'></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/css/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/wow.min.js"></script>

<!-- Isotope -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/isotope.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ini.isotope.js"></script>

<!-- bxSlider -->
<script src="<?php bloginfo('template_directory'); ?>/js/bxslider/jquery.bxslider.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom-script.js"></script>

<script lang="javascript">
	(function() {var _h1= document.getElementsByTagName('title')[0] || false;
		var product_name = ''; if(_h1){product_name= _h1.textContent || _h1.innerText;}var ga = document.createElement('script'); ga.type = 'text/javascript';
		ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=1a2128b34b78d20f698c0d34034576f3&data=eyJzc29faWQiOjMyOTMzNTIsImhhc2giOiJkODI0Yzk4ZjViMGRkYWFmMTk0YzNmYTZiOWVhNDg1NCJ9&pname='+product_name;
		var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();
</script><noscript><a href="http://www.vatgia.com" title="vatgia.com" target="_blank">Tài trợ bởi vatgia.com</a></noscript><noscript><a href="http://vchat.vn" title="vchat.vn" target="_blank">Phát triển bởi vchat.vn</a></noscript>
</body>
</html>