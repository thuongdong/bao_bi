<?php
/// Textbox Control - Render Script And HTML ////


RS::addControl('textbox', 'text', 'rs_render_textbox_control');
RS::addControl('text', 'text', 'rs_render_textbox_control');

function rs_render_textbox_control($config = array()){
	$config = array_merge ( array(
		'name' => 'text',
		'value' => '',
		'placeHolder' => '',
		'type' => 'text'
	), $config);
	
	$config['value'] = htmlentities($config['value'], ENT_QUOTES);
	
	?>
	
	<div class="rs-control rs-textbox-wrap <?php echo $config['cssClass'] ?>">
		<input type="text" value="<?php echo $config['value'] ?>" id="<?php echo tag_id($config['name']) ?>" name="<?php echo $config['name'] ?>" class="rs-textbox" placeholder="<?php echo $config['placeholder'] ?>"/>
	</div>
	<?php
}


/// Textarea Control - Render Script And HTML ////

RS::addControl('textarea', 'textarea', 'rs_render_textarea_control');

function rs_render_textarea_control($config = array()){
	$config = array_merge ( array(
		'name' => 'textarea',
		'value' => '',
		'placeHolder' => '',
		'type' => 'textarea'
	), $config);
	?>
	
	<div class="rs-control rs-textarea-wrap <?php echo $config['cssClass'] ?>">
		<textarea id="<?php echo tag_id($config['name']) ?>" name="<?php echo $config['name'] ?>" class="rs-textarea" placeholder="<?php echo $config['placeholder'] ?>"><?php echo $config['value'] ?></textarea>
	</div>
	<?php
}


/// File Control - Render Script And HTML ////

RS::addControl('fileupload', 'file', 'rs_render_file_control');
RS::addControl('file', 'file', 'rs_render_file_control');

function rs_render_file_control($config = array()){
	$config = array_merge ( array(
		'name' => 'file',
		'value' => '',
		'type' => 'file'
	), $config);
	?>
	
	<div class="rs-control rs-fileupload-wrap <?php echo $config['cssClass'] ?>">
		<input type="file" id="<?php echo tag_id($config['name']) ?>" name="<?php echo $config['name'] ?>" class="rs-fileupload" value="<?php echo $config['value'] ?>"/>
	</div>
	<?php
}


/// Editor Control - Render Script And HTML ////


RS::addControl('editor', 'editor', 'rs_render_editor_control');

function rs_render_editor_control($config = array()){
	$config = array_merge ( array(
		'name' => 'editor',
		'value' => '',
		'type' => 'editor',
		'cssClass' => '',
		'mediaButtons' => false,
		'tinymce' => array(
			'theme_advanced_buttons1' => 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,spellchecker,wp_fullscreen,wp_adv'
		)
	), $config);
	?>
	
	<div class="rs-control rs-editor-wrap <?php echo $config['cssClass'] ?>">
	<?php
		wp_editor( $config['value'], $config['name'], array( 'textarea_name' => $config['name'], 'media_buttons' => $config['mediaButton'], 'tinymce' => $config['tinymce'] ) ); 
	?>
	</div>
	<?php
}