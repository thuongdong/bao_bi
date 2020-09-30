<?php
/// Checkable Control - Render Script And HTML ////

RS::addControl('colorpicker', 'color', 'rs_render_colorpicker_control');

function rs_render_colorpicker_control($config = array()){
	RS::loadStyle('rs-colorpicker', RSLIBURL . '/scripts/jquery.colorpicker/css/colorpicker.css');
	RS::loadStyle('rs-colorpicker-custom', RSLIBURL . '/controls/colorpicker/colorpicker.css');
	RS::loadScript('rs-colorpicker', RSLIBURL . '/scripts/jquery.colorpicker/js/colorpicker.js');
	RS::loadScript('rs-colorpicker-init', RSLIBURL . '/controls/colorpicker/colorpicker.js');
			
	$config = array_merge ( array(
		'name' => 'color', 
		'type' => 'color',
		'value' => '',
		'cssClass' => ''
	), $config);
	?>
	
	<div class="rs-colorpicker rs-control <?php echo $config['cssClass'] ?>">
		<input type="text" class="rs-textbox rs-colorpicker-input" value="<?php echo $config['value'] ?>" name="<?php echo $config['name'] ?>" id="<?php echo tag_id($config['name']) ?>"/>
		<img class="rs-colorpicker-trigger" src="<?php echo RSLIBURL . '/controls/colorpicker/trigger.png' ?>" alt="..." title="..."/>
	</div>
	
	<?php
}
