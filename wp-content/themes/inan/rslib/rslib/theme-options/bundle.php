<?php
add_action('init', 'rs_theme_options_init');

function rs_theme_options_init(){
	if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'theme-options'){
		RS::loadStyle('rs-panel-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic');
		RS::loadStyle('glyphicon', RSLIBURL . '/theme-options/css/font-awesome.min.css');
		RS::loadStyle('rs-panel-css', RSLIBURL . '/theme-options/css/style.css');
		RS::loadStyle('rs-panel-responsive-css', RSLIBURL . '/theme-options/css/reponsive.css');
	}
}
?>