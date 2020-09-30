<?php
/*
 * Redsand Wordpress Library
 * Version: 1.1.1
 * Modify: 7/4/2014
 * Author: RedSand Team
 *
 */



/// CONST //
define('RSLIBURL', get_template_directory_uri() . '/rslib');
define('RSLIBPATH', get_template_directory() . '/rslib');

define('DATEFORMAT', 'd MM yy');
define('LONGDATEFORMAT', 'd MM yy');

define('OPTIONSPREFIX', '');
define('FIELDSPREFIX', '');


/// RS CLASS ///
class RS{
	public static $wordpress;
	public static $controls;
	public static $types;
	public static $options;
	public static $message;
	public static $scripts;
	public static $styles;
	public static $init;
	public static $version = "1.1.1";
	
	public function init(){
		if(!RS::$init){
			RS::$init = true;
			global $RS;
			
			/// INIT VARIABLE ///
			RS::$controls = array();
			RS::$wordpress = new stdClass();
			RS::$wordpress->version = get_bloginfo('version');
			RS::$options = array();
			RS::$types = array();
			RS::$message = array();
			RS::$scripts = array();
			RS::$styles = array();
			
			/// RS INIT SCRIPT ///	
			add_action( 'login_head', 'rs_common_scripts' );
			add_action( 'wp_print_scripts', 'rs_common_scripts');
			
			RS::loadScript('modernizr', RSLIBURL . '/scripts/modernizr.js');
			RS::loadScript('jquery');
			RS::loadScript('rs-common', RSLIBURL . '/scripts/rs.common.js');
			RS::loadStyle('rs-common', RSLIBURL . '/styles/rs.common.css');
			
			/// INCLUDE ALL CONTROLS ///			
			$allfiles = glob(RSLIBPATH . "/controls/*");
			foreach($allfiles as $dir){
				$basename = basename($dir);
				if(is_dir($dir) && file_exists(RSLIBPATH . "/controls/$basename/$basename.php")){
					include(RSLIBPATH . "/controls/$basename/$basename.php");
				}
			}
			add_action('wp_enqueue_scripts',  array(__CLASS__, 'enqueueScript'));
			add_action('admin_enqueue_scripts',  array(__CLASS__, 'enqueueScript'));
			add_action('login_enqueue_scripts',  array(__CLASS__, 'enqueueScript'));
			
			/// THEME OPTIONS ///
			add_action('admin_menu', array(__CLASS__, 'addThemeOptionsMenu')); 
			include(RSLIBPATH . '/theme-options/bundle.php');
			
			/// OTHER ///
			add_action('wp_footer', array(__CLASS__, 'addFooterCode'));
			add_action('admin_footer', array(__CLASS__, 'addFooterCode'));
			
			/// DISPLAY ERROR ///
			add_action('admin_notices', array(__CLASS__,'showMessage'));
			add_action('wp_footer', array(__CLASS__, 'showMessage'), 100);
			add_action('admin_footer', array(__CLASS__, 'showMessage'), 100);
		}
	}


	public function __call($name, $arguments) {
		if(method_exists($this, $name)) {
			return call_user_func_array(array($this, $name), $args);
		}
		if(is_callable(RS::$controls[$name])) {
			return call_user_func_array(RS::$controls[$name], $arguments);			
		} else {
			RS::message("The control/function named \"$name\" is not found in rs");
		}
	}
	
	public static function __callStatic($name, $arguments) {
		if(is_callable(RS::$controls[$name])) {
			return call_user_func_array(RS::$controls[$name], $arguments);			
		} else {
			RS::message("The control/function named \"$name\" is not found in rs");
		}
	}
	
	public function __get($name){
		if(property_exists('RS', $name)){
			return RS::$$name;
		}
		return null;
	}
	
	public function __set($name, $value){
		if(property_exists('RS', $name)){
			RS::$$name == $value;
		}
	}
	
	public static function addControl($name, $types, $callback, $get = null, $set = null) {
		if(is_array($types)){
			foreach($types as $type){
				if(!isset(RS::$types[$type])){
					RS::$types[$type] = array(
						'callback' => $callback,
						'get' => $get,
						'set' => $set
					);
				}
			}
		}
		else if($types && !isset(RS::$types[$types])){
			RS::$types[$types] = array(
				'callback' => $callback,
				'get' => $get,
				'set' => $set
			);
		}
		RS::$controls[$name] = $callback;
	}
	
	public static function renderControl($control){
		
		if($control['type']){
			$callback = RS::$types[$control['type']]['callback'];
			if(is_callable($callback)){				
				return call_user_func($callback, $control);
			}
			else{
				RS::message('[No control found for type "'.$control['type'].'"]');
			}
		}
		else{
			RS::message('[The "type" property is missing.]');
		}
	}
	
	public static function addOptionTab($tab, $callback = null){
		$tab = array_merge( array('title' => '[Empty]', 'name' => 'tab-' . (count(RS::$options) + 1), 'link' => '', 'icon' => '', 'controls' => null), $tab);
		$tab['callback'] = $callback;
		$tab['subtabs'] = array();
		RS::$options[$tab['name']] = $tab;
	}
	
	public static function addOptionSubTab($tab, $callback = null){
		if(!isset($tab['parent'])) {
			RS::addOptionTab($tab, $controls, $callback);
		}
		else if(!isset(RS::$options[$tab['parent']])){
			RS::message('The tab '.$tab['parent'].' does not exists.', true, 'theme-options');
		}
		else{
			$tab = array_merge( array('title' => '[Empty]', 'name' => RS::$options[$tab['parent']]['name'] . '-sub-' . (count(RS::$options[$tab['parent']]['subtabs']) + 1), 'link' => '', 'icon' => '', 'controls' => null), $tab);
			$tab['callback'] = $callback;
			RS::$options[$tab['parent']]['subtabs'][$tab['name']] = $tab;
		}
	}
	
	public static function getOption($key, $default = null){
		return get_option(OPTIONSPREFIX . $key, $default);
	}
	
	public static function getOptions(){
		$rsOptionKeys = get_option('rs-option-keys', array());
		$options = array();
		foreach($rsOptionKeys as $key){
			$options[$key] = get_option(OPTIONSPREFIX . $key);
		}
		return $options;
	}
	
	public static function updateOption($key, $value){
		$rsOptionKeys = get_option('rs-option-keys', array());
		if(!in_array($key, $rsOptionKeys)){
			$rsOptionKeys[] = $key;
		}
		update_option('rs-option-keys', $rsOptionKeys);
		return update_option(OPTIONSPREFIX . $key, $value);
	}
	
	public static function deleteOption($key){
		delete_option(OPTIONSPREFIX . $key);
	}
	
	public static function getRequest($name){

		if(strpos("[", $name)){
			$base = sub_str($name, 0, strpos("[", $name));
			$name = str_repace($base, '$_REQUEST[' . $base . ']', $name);
		}
		else{
			$name = '$_REQUEST[' . $name . ']';
		}
		$name = str_replace('[','["', $name);
		$name = str_replace(']','"]', $name);

		return @eval('return ' . $name . ';');
	}
	
	public static function addThemeOptionsMenu(){	
		if(count(RS::$options)){
			add_theme_page("Theme Options", "Theme Options", 'edit_theme_options', 'theme-options', array(__CLASS__, 'renderThemeOptions'));
		}		
	}
	
	public static function renderThemeOptions(){		
		include(RSLIBPATH . '/theme-options/theme-options.php');
	}
	
	public static function addFooterCode(){
		echo '<input type="hidden" name="rs-data-input" id="rs-data-input"/>'."\r\n";
	}
	
	public static function ajaxTrigger(){
		if(is_ajax()){
			echo '<script> jQuery(document).trigger("rs-control-rebuild", ".widget-inside") </script>';
		}
	}
	
	public static function loadScript($name, $url = null, $footer = false){
		if(is_callable($url)){
			if(wp_script_is('rs-common', 'done') || $footer){
				add_action('admin_print_footer_scripts', $url);
				add_action('wp_print_footer_scripts', $url);
			}
			else{
				add_action('admin_print_scripts', $url);
				add_action('wp_print_scripts', $url);
			}
		}
		else{
			if(did_action('wp_enqueue_scripts') || did_action('admin_enqueue_scripts') || did_action('login_enqueue_scripts')){
				wp_enqueue_script($name, $url, 'jquery', '', $footer);
			}
			else if(!isset(RS::$scripts[$name])){
				RS::$scripts[$name] = array('url' => $url, 'footer' => $footer);
			}
			else{
				RS::message('Cannot load script with handle name is "' . $name . '"');
			}
		}
	}
	public static function enqueueScript(){
		foreach(RS::$scripts as $handle=>$script){
			wp_enqueue_script($handle, $script['url'], 'jquery', '', $script['footer']);
		}
		foreach(RS::$styles as $handle=>$style){
			wp_enqueue_style($handle, $style['url']);
		}
	}
	public static function removeScript($name){
		wp_dequeue_script($name);
	}
	
	public static function loadStyle($name, $url = null){		
		if(is_callable($url)){
			if(wp_script_is('rs-common', 'done')){
				add_action('admin_footer', $url);
				add_action('wp_footer', $url);
			}
			else{
				add_action('admin_print_styles', $url);
				add_action('wp_print_styles', $url);
			}
		}
		else{
			if(did_action('wp_enqueue_scripts') || did_action('admin_enqueue_scripts') || did_action('login_enqueue_scripts')){
				wp_enqueue_style($name, $url);
			}
			else if(!isset(RS::$styles[$name])){
				RS::$styles[$name] = array('url' => $url);
			}
		}
	}
	public static function removeStyle($name){
		wp_dequeue_style($name);
	}
	public static function message($msg, $error = true, $page = ''){
		RS::$message[] = array('msg' => $msg, 'error' => $error, 'page' => $page);
	}
	public static function showMessage(){
		foreach(RS::$message as $key=>$message){
			if($message['page'] == '' || is_page($message['page']) || $_REQUEST['page'] == $message['page']){
				echo '<div class="rs-msg '.($message['error'] ? 'error' : 'updated').'"><p>'.$message['msg'].'</p></div>';
			}
			unset(RS::$message[$key]);
		}
	}
}

/// CUSTOM FUNCTIONS ///

function rs_common_scripts(){?>
<script type="text/javascript">
if(typeof rs == 'undefined'){
	var rs = {
		wordpress: {
			version: '<?php bloginfo('version') ?>',
			homeUrl: '<?php echo home_url() ?>',
			adminUrl: '<?php echo admin_url() ?>',
			templateUrl: '<?php bloginfo('template_url') ?>',
			isAdmin: <?php echo is_admin() ? 'true' : 'false' ?>,
			isHome: <?php echo is_home() ? 'true' : 'false' ?>
		},
		lib: {
			url: '<?php echo RSLIBURL ?>'
		},
		controls: {}
	}; 
}
</script>
<?php 
}


if(!function_exists('is_url')){
	function is_url($url){
		return !empty($url) && false !== parse_url($url);
	}
}

if(!function_exists('tag_id')){
	function tag_id($name){
		return sanitize_title(str_replace(array('[',']'), '-', $name));
	}
}

if(!function_exists('get_attachment_id_by_url')){
	function get_attachment_id_by_url($url){
		global $wpdb;
		$upload_dir = wp_upload_dir();
		if(is_string($url) && !empty($url)){
			$url = str_replace($upload_dir['baseurl'] . '/', '', $url);
			return $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $url));
		}
		return null;
	}
}

if(!function_exists('is_ajax')){
	function is_ajax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	}
}

if(!function_exists('get_current_url')){
	function get_current_url(){
		return (!empty($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT'] == "80" ? "" : ":".$_SERVER['SERVER_PORT']).$_SERVER['REQUEST_URI']; 
	}
}

/// END CUSTOM FUNCTIONS ///



/// INIT ///
global $RS;
$RS = new RS();
$RS->init();
