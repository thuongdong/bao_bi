<?php
//update_option('siteurl', 'http://inanhoanggia.vn');
//update_option('home', 'http://inanhoanggia.vn');
//exit;

include( TEMPLATEPATH . '/inc/menu.php' );
include( TEMPLATEPATH . '/rslib/rslib.php' );
include( TEMPLATEPATH . '/inc/theme-options.php' );
include( TEMPLATEPATH . '/inc/add-post-type.php' );
include( TEMPLATEPATH . '/inc/widget.php' );
include( TEMPLATEPATH . '/inc/custom-widget.php' );
include( TEMPLATEPATH . '/inc/megamenu/class-megamenu.php' );

add_theme_support( 'post-thumbnails' );

//function cut($str, $len, $charset="UTF-8"){
//	$str = html_entity_decode($str, ENT_QUOTES, $charset);
//	if(mb_strlen($str, $charset)> $len){
//		$arr = explode(' ', $str);
//		$str = mb_substr($str, 0, $len, $charset);
//		$arrRes = explode(' ', $str);
//		$last = $arr[count($arrRes)-1];
//		unset($arr);
//		if(strcasecmp($arrRes[count($arrRes)-1], $last)) unset($arrRes[count($arrRes)-1]);
//		return implode(' ', $arrRes)." [...]";
//	}
//	return $str;
//}

function get_the_twitter_excerpt(){
	$excerpt = get_the_content();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, 150);
	return $the_str . '...';
}

function getUrl() {
	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	$url .= $_SERVER["REQUEST_URI"];
	return $url;
}

function cut($str, $len) {
	$str = trim($str);
	if (strlen($str) <= $len) return $str;
	$str = substr($str, 0, $len);
	if ($str != "") {
		if (!substr_count($str, " ")) return $str." ...";
		while (strlen($str) && ($str[strlen($str) - 1] != " ")) $str = substr($str, 0, -1);
		$str = substr($str, 0, -1)." ...";
	}
	return $str;
}

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}


if ( !function_exists( 'thim_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'thim' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'vifonic', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'vifonic' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio'
		) );
	}

endif; // thim_setup
add_action( 'after_setup_theme', 'thim_setup' );

function wp_bac_breadcrumb() {
	$delimiter  = '<span class="delimiter">\</span>';
	$delimiter1 = '<span class="delimiter1">\</span>';

//text link for the 'Home' page
	$main = 'Home';
//Display only the first 30 characters of the post title.
	$maxLength = 30;

//variable for archived year 
	$arc_year = get_the_time( 'Y' );
//variable for archived month 
	$arc_month = get_the_time( 'F' );
//variables for archived day number + full
	$arc_day      = get_the_time( 'd' );
	$arc_day_full = get_the_time( 'l' );

//variable for the URL for the Year
	$url_year = get_year_link( $arc_year );
//variable for the URL for the Month 
	$url_month = get_month_link( $arc_year, $arc_month );

	/*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
	when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
	is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
	"A static page" and the "Front Page" value is the current Page being displayed. In this case
	no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */

//Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
	if ( !is_front_page() ) {
//If Breadcrump exists, wrap it up in a div container for styling. 
//You need to define the breadcrumb class in CSS file.
		echo '<div class="pag-breadcrumb"><div class="container">';

//global WordPress variable $post. Needed to display multi-page navigations. 
		global $post, $cat;
//A safe way of getting values for a named option from the options database table. 
		$homeLink = get_option( 'home' ); //same as: $homeLink = get_bloginfo('url');
//If you don't like "You are here:", just remove it.
		echo '<a href="' . $homeLink . '"><i class="fa fa-home"></i>' . $main . '</a>' . $delimiter;

//Display breadcrumb for single post
		if ( is_single() ) { //check if any single post is being displayed.
//Returns an array of objects, one object for each category assigned to the post.
//This code does not work well (wrong delimiters) if a single post is listed 
//at the same time in a top category AND in a sub-category. But this is highly unlikely.
			$category = get_the_category();
			$num_cat  = count( $category ); //counts the number of categories the post is listed in.

//If you have a single post assigned to one category.
//If you don't set a post to a category, WordPress will assign it a default category.
			if ( $num_cat <= 1 ) //I put less or equal than 1 just in case the variable is not set (a catch all).
			{
				//Tạm thời bỏ Categoty vì lỗi Custome post type.
				//echo get_category_parents( $category[0], true, ' ' . $delimiter . ' ' );
//Display the full post title.
				echo ' ' . get_the_title();
			} //then the post is listed in more than 1 category.
			else {
				//Put bullets between categories, since they are at the same level in the hierarchy.
				echo the_category( $delimiter1, multiple );
//Display partial post title, in order to save space.
				if ( strlen( get_the_title() ) >= $maxLength ) { //If the title is long, then don't display it all.
					echo ' ' . $delimiter . trim( substr( get_the_title(), 0, $maxLength ) ) . ' ...';
				} else { //the title is short, display all post title.
					echo ' ' . $delimiter . get_the_title();
				}
			}
		} //Display breadcrumb for category and sub-category archive
		elseif ( is_category() ) { //Check if Category archive page is being displayed.
//returns the category title for the current page. 
//If it is a subcategory, it will display the full path to the subcategory. 
//Returns the parent categories of the current category with links separated by '\'
			echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' ) . '';
		} //Display breadcrumb for tag archive
		elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
//returns the current tag title for the current page. 
			echo single_tag_title( "", false ) . '"';
		} //Display breadcrumb for calendar (day, month, year) archive
		elseif ( is_day() ) { //Check if the page is a date (day) based archive page.
			echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
			echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
		} elseif ( is_month() ) { //Check if the page is a date (month) based archive page.
			echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
		} elseif ( is_year() ) { //Check if the page is a date (year) based archive page.
			echo $arc_year;
		} //Display breadcrumb for search result page
		elseif ( is_search() ) { //Check if search result page archive is being displayed.
			echo 'Search Results for: "' . get_search_query() . '"';
		} //Display breadcrumb for top-level pages (top-level menu)
		elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
			echo get_the_title();
		} //Display breadcrumb trail for multi-level subpages (multi-level submenus)
		elseif ( is_page() && $post->post_parent ) { //Check if this is a subpage (submenu) being displayed.
//get the ancestor of the current page/post_id, with the numeric ID 
//of the current post as the argument. 
//get_post_ancestors() returns an indexed array containing the list of all the parent categories. 
			$post_array = get_post_ancestors( $post );

//Sorts in descending order by key, since the array is from top category to bottom.
			krsort( $post_array );

//Loop through every post id which we pass as an argument to the get_post() function. 
//$post_ids contains a lot of info about the post, but we only need the title. 
			foreach ( $post_array as $key => $postid ) {
				//returns the object $post_ids
				$post_ids = get_post( $postid );
//returns the name of the currently created objects 
				$title = $post_ids->post_title;
//Create the permalink of $post_ids
				echo '<a href="' . get_permalink( $post_ids ) . '">' . $title . '</a>' . $delimiter;
			}
			the_title(); //returns the title of the current page.
		} //Display breadcrumb for author archive
		elseif ( is_author() ) {//Check if an Author archive page is being displayed.
			global $author;
//returns the user's data, where it can be retrieved using member variables. 
			$user_info = get_userdata( $author );
			echo 'Archived Article(s) by Author: ' . $user_info->display_name;
		} //Display breadcrumb for 404 Error
		elseif ( is_404() ) {//checks if 404 error is being displayed
			echo 'Error 404 - Not Found.';
		} else {
			//All other cases that I missed. No Breadcrumb trail.
		}
		echo '</div></div>';
	}
}

?>