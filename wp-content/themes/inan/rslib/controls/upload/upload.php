<?php
/// Upload Control - Render Script And HTML ////
RS::addControl('upload', array('media', 'video', 'audio', 'image'), 'rs_render_upload_control');

function rs_render_upload_control($config = array()){		
	$config = array_merge ( array(
		'name' => 'upload', 
		'value' => '', 
		'title' => '', 
		'editTitle' => '', 
		'buttons' => array(), 
		'showInput' => true,
		'cssClass' => '',
		'type' => 'image'
	), $config);
	
	if($config['title'] == '') $config['title'] = 'Choose ' . ucfirst($config['type']);
	if($config['editTitle'] == '') $config['editTitle'] = 'Update ' . ucfirst($config['type']);

	$config['buttons'] = array_merge( array(
		'insertText' => 'Insert', 
		'updateText' => 'Update', 
		'browseText' => ''), $config['buttons'] 
	);

	if($config['buttons']['browseText'] == '') $config['buttons']['browseText'] = 'Choose ' . ucfirst($config['type']);
	
	RS::loadScript('rs-upload', RSLIBURL . '/controls/upload/wpupload.js');
	RS::loadScript('rs-upload-init', RSLIBURL . '/controls/upload/upload.js');
	RS::loadStyle('rs-upload', RSLIBURL . '/controls/upload/upload.css');

	if((float)RS::$wordpress->version < 3.5){
		RS::loadScript('media-upload');
		RS::loadScript('thickbox');
		RS::loadStyle('thickbox');
	}
	else{
		wp_enqueue_media();
	}
	
	if(!in_array($config['type'], array('audio', 'video', 'image'))) $config['type'] = '';
	
	?>
	
	<div class="rs-control rs-upload <?php echo $config['cssClass'] ?> <?php echo $config['showInput'] ? '' : 'hide-input' ?>" data-title="<?php echo $config['title'] ?>" data-type="<?php echo $config['type'] ?>" data-insert-text="<?php echo $config['buttons']['insertText'] ?>" data-update-text="<?php echo $config['buttons']['updateText'] ?>" data-edit-title="<?php echo $config['editTitle'] ?>">
		<div class="rs-upload-browser">
			<input class="rs-upload-id" type="hidden" value="<?php echo get_attachment_id_by_url($config['value']) ?>" name="<?php echo tag_id($config['name']) ?>-id"/>
			<input class="rs-textbox rs-upload-input" type="<?php echo $config['showInput'] ? "text" : "hidden" ?>" name="<?php echo $config['name'] ?>" value="<?php echo $config['value']?>"/>
			<a class="rs-button rs-upload-button"><?php echo $config['buttons']['browseText'] ?></a>
		</div>
		<div class="rs-upload-details">
			<div class="rs-upload-preview">
				<img src="" alt=""/>
				<div class="rs-upload-action">
					<a class="rs-upload-delete" title="Delete">X</a>
					<a class="rs-upload-edit" title="Edit">E</a>
				</div>
			</div>
			<p class="rs-upload-name"></p>
			<p class="rs-upload-size"></p>
			<div class="clear"></div>
		</div>
	</div>
	<?php
}

add_action('init', 'rs_upload_tb_script');

function rs_upload_tb_script(){
	if(isset($_GET['rsupload']) && $_GET['rsupload'] == 'tb'){
		RS::loadScript('rs-upload-init', RSLIBURL . '/controls/upload/wpupload.js');
	}
}
