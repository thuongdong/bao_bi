<?php
/// Checkable Control - Render Script And HTML ////
RS::addControl('datepicker', 'date', 'rs_render_datepicker_control');

function rs_render_datepicker_control($config = array()){	
	RS::loadStyle('jquery-ui', RSLIBURL . '/scripts/jquery.ui/rstheme/jquery-ui-1.10.3.custom.min.css');
	RS::loadStyle('rs-datepicker', RSLIBURL . '/controls/datepicker/datepicker.css');
	RS::loadScript('jquery-ui', RSLIBURL . '/scripts/jquery.ui/jquery-ui-1.10.3.custom.min.js');
	RS::loadScript('rs-datepicker', RSLIBURL . '/controls/datepicker/datepicker.js');
			
	$config = array_merge ( array(
		'name' => 'date', 
		'type' => 'date',
		'value' => '',
		'dateFormat' => 'yy-mm-dd',
		'cssClass' => ''
	), $config);
	?>
	
	<div class="rs-datepicker rs-control <?php echo $config['cssClass'] ?>">
		<input type="text" class="rs-textbox rs-datepicker-input" value="<?php echo $config['value'] ?>" id="<?php echo tag_id($config['name']) ?>" name="<?php echo $config['name'] ?>" data-date-format="<?php echo $config['dateFormat'] ?>"/>
	</div>
	
	<?php
}
?>