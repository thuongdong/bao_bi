<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		<?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '|', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		?>
	</title>
	<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_enqueue_script( 'jquery' );
	wp_head();
	?>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/rs-wp-v1.2.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap/css/bootstrap.css" type="text/css" />


	<link rel='stylesheet' id='owl.carousel.min' href='<?php bloginfo('template_directory'); ?>/css/owl.carousel.min.css?v2.0.0' type='text/css' />
	<link rel='stylesheet' id='owl.theme' href='<?php bloginfo('template_directory'); ?>/css/owl.theme.default.min.css?v2.0.0' type='text/css' />

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- bxSlider -->
	<link href="<?php bloginfo('template_directory'); ?>/js/bxslider/jquery.bxslider.css" rel="stylesheet" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/animate.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" />
</head>
<body <?php echo body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=306238306156204";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<header id="header">
	<div class="top-page">
		<div class="container clearfix">
			<ul class="top-social">
				<li><a target="_blank" class="facebook" href="<?php echo get_option('facebook')?>"><i class="fa fa-facebook"></i></a></li>
				<li><a target="_blank" class="google-plus" href="<?php echo get_option('google')?>"><i class="fa fa-google-plus"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="header">
		<div class="container">
			<div class="row row-no-padding">
				<!-- Logo -->
				<div class="col-md-4 col-sm-3 col-xs-12 logo">
					<a href="<?php echo home_url() ?>"><img src="<?php echo get_option('header_logo')?>" alt=""/></a>
				</div>
				<!-- End Logo -->
				<!-- Star Menu -->
				<div class="col-md-8 col-sm-9 col-xs-12">
					<nav class="main-menu navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php
								$defaults = array(
									'theme_location'  => 'header_menu',
									'menu'            => '',
									'container'       => 'div',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'nav navbar-nav',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								);

								echo str_replace('sub-menu', 'dropdown-menu', wp_nav_menu( $defaults ));
								?>
								<form role="search" method="get" class="navbar-form navbar-left search-form"
									  action="<?php echo home_url( '/' ); ?>">
									<div class="form-group">
										<input type="search" class="form-control search-field" placeholder="<?php
										echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
										<input type="submit" class="btn btn-default search-submit" value="<?php echo
										esc_attr_x( 'Search', 'submit button' ) ?>" />
									</div>
								</form>
<!--								<form class="navbar-form navbar-left" role="search">-->
<!--									<div class="form-group">-->
<!--										<input type="text" class="form-control" placeholder="Search">-->
<!--									</div>-->
<!--									<button type="submit" class="btn btn-default">Submit</button>-->
<!--								</form>-->
								<a class="search-box" href="#"><i class="fa fa-search"></i></a>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
				</div>
				<!-- End menu -->
			</div>
		</div>
	</div>