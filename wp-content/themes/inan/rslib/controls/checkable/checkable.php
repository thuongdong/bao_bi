<?php
/// Checkable Control - Render Script And HTML ////
RS::addControl('checkbox', 'checkbox', 'rs_render_checkbox_control');
RS::addControl('radio', 'radio', 'rs_render_radio_control');

function rs_render_checkbox_control($config = array()){
	RS::loadStyle('rs-checkable', RSLIBURL . '/scripts/jquery.rs.checkable/jquery.rs.checkable.css');
	RS::loadScript('rs-checkable', RSLIBURL . '/scripts/jquery.rs.checkable/jquery.rs.checkable.js');
	RS::loadScript('rs-checkable-init', RSLIBURL . '/controls/checkable/checkable.js');
			
	$config = array_merge ( array(
		'name' => 'checkable', 
		'type' => 'checkbox',
		'value' => '', 
		'values' => array(),
		'items' => null,
		'item' => null,
		'cssClass' => ''
	), $config);
	
	
	echo "\r\n\t";
	echo '<div class="rs-control rs-'.$config['type'].' '.$config['cssClass'].'">';
	
	if($config['items'] == null && $config['item'] == null){
		return RS::message('[No item found]');
	}	
	if(is_array($config['items'])){
		$i = 0;
		foreach($config['items'] as $item){
			$checked = (is_array($config['values']) && in_array($item['value'], $config['values'])) || ($item['value'] == $config['value']);
			$name = $config['type'] == 'checkbox' ? $config['name'].'[]' : $config['name'];
			$id = tag_id($config['name'] . '-' .  $i);
			echo '<label class="rs-'.$config['type'].'-label" for="'.$id.'"><input type="'.$config['type'].'" id="'.$id.'" class="rs-'.$config['type'].'-input" name="'.$name.'" value="'.$item['value'].'" '.($checked ? 'checked="checked"' : '').'>'.$item['text'].'</label>';
		}
	}
	else if(is_array($config['item'])){
		$checked = $item['value'] == $config['value'];
		$id = tag_id($config['name']);
		echo '<label class="rs-'.$config['type'].'-label" for="'.$id.'"><input type="'.$config['type'].'" id="'.$id.'" class="rs-'.$config['type'].'-input" name="'.$config['name'].'" value="'.$config['item']['value'].'" '.($checked ? 'checked="checked"' : '').'>'.$config['item']['text'].'</label>';
	}	
	else{
		return RS::message('[Item(s) must be an array]');
	}
	
	echo '</div>'."\r\n";
}

function rs_render_radio_control($config = array()){
	$config['type'] = 'radio';
	rs_render_checkbox_control($config);
}
?>