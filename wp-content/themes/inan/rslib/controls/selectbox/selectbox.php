<?php
/// Selectbox Control - Render Script And HTML ////
RS::addControl('selectbox', 'select', 'rs_render_selectbox_control');

function rs_render_selectbox_control($config = array()){
	RS::loadStyle('rs-selecbox', RSLIBURL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.css');
	RS::loadScript('rs-selecbox', RSLIBURL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.js');
	RS::loadScript('rs-selecbox-init', RSLIBURL . '/controls/selectbox/selectbox.js');

	$config = array_merge ( array(
		'name' => 'select', 
		'type' => 'select',
		'value' => '', 
		'values' => array(),
		'items' => array(),
		'multiple' => false,
		'cssClass' => ''
	), $config);
	
	if($config['items'] == null){
		return RS::message('[No item found]');
	}
	
	?>
	
	<select class="rs-control rs-selectbox <?php echo $config['multiple'] ? 'rs-selectbox-multiple' : '' ?> <?php echo $config['cssClass'] ?>" name="<?php echo $config['name'] ?><?php echo $config['multiple'] ? '[]' : '' ?>" id="<?php echo tag_id($config['name']) ?>" <?php echo $config['multiple'] ? 'multiple="multiple"' : '' ?>><?php 
		foreach($config['items'] as $item){
			if(empty($item['value'])) $item['value'] = $item['text'];
			$selected = (is_array($config['values']) && in_array($item['value'], $config['values'])) || $config['value'] == $item['value'];
			echo '<option value="'.$item['value'].'"'.($selected ? 'selected="selected"' : '').'>'.$item['text'].'</option>';
		} ?>
	</select>
	
	<?php
}
?>