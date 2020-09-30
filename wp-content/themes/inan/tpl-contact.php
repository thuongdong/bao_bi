<?php /* Template Name: Contact Page */ ?>
<?php get_header();
the_post();
if ( get_field( 'show_slider' ) == 1 ) { ?>
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
		<div class="contact-page">
			<h3 class="title"><?php echo the_title(); ?></h3>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<ul class="list-contact">
						<li class="clearfix"><i class="fa fa-home"></i><p><label>Địa chỉ:</label><?php echo
get_option
	( 'address' )
	?></p></li>
						<li class="clearfix"><i class="fa fa-mobile"></i><p><label>Điện thoại:</label><?php
echo
get_option( 'hotline1' ) ?></p><p><?php echo get_option( 'hotline2' ) ?></p></li>
						<li class="clearfix"><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo
	get_option( 'email' ) ?>"><span><label>E-mail:</label><?php echo get_option( 'email' ) ?></span></a></li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php echo get_field('contact_form')?do_shortcode(get_field
('contact_form')):'' ?>
				</div>
			</div>
		</div>
	</div>
	<div class="maps">
		<div class="maps-title">Chỉ đường</div>
		<?php echo get_field('maps')?do_shortcode(get_field
('maps')):'' ?>
	</div>
</section>
<?php get_footer(); ?>