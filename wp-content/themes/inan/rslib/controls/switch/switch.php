<?php
RS::addControl('switchbutton', 'switch', 'rs_render_switch_control');

function rs_render_switch_control($config = array()){
	RS::loadStyle('rs-switch', RSLIBURL . '/scripts/jquery.rs.switch/jquery.rs.switch.css');
	RS::loadScript('rs-switch', RSLIBURL . '/scripts/jquery.rs.switch/jquery.rs.switch.js');
	RS::loadScript('rs-switch-init', RSLIBURL . '/controls/switch/switch.js');
	
	$config = array_merge ( array(
		'name' => 'switch',
		'value' => false,
		'type' => 'switch',
		'style' => 'default',
		'cssClas' => ''
	), $config);

	?>
	
	<div class="rs-control rs-switch <?php echo $config['cssClass'] ?> rs-switch-<?php echo $config['style'] ?>">
		<input type="hidden" id="<?php echo tag_id($config['name']) ?>" name="<?php echo $config['name'] ?>" class="rs-switch-input" value="<?php echo $config['value'] ?>"/>
	</div>
	<?php
}

?>