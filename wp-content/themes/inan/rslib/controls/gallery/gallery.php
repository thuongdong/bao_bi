<?php
/// Gallery Control - Render Script And HTML ////

RS::addControl('gallery', 'gallery', 'rs_render_gallery_control');

function rs_render_gallery_control($config = array()){

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

	RS::loadStyle('rs-gallery', RSLIBURL . '/controls/gallery/gallery.css');
	RS::loadScript('jquery-ui', RSLIBURL . '/scripts/jquery.ui/jquery-ui-1.10.3.custom.min.js');
	RS::loadScript('rs-gallery', RSLIBURL . '/controls/gallery/gallery.js');
	
	$config = array_merge ( array(
		'name' => 'gallery',
		'type' => 'gallery',
		'title' => 'Select Images',
		'addItemText' => 'Add Image',
		'maxItems' => 999,
		'values' => array(),
		'items' => array(),
		'sorting' => true,
		'cssClass' => ''
	), $config);
	
	if(empty($config['items']) && !empty($config['values'])){
		$config['items'] = $config['values'];
	}
	
	?>
	
	<div class="rs-gallery sorting-<?php echo $config['sorting'] ? 'true' : 'false' ?> <?php echo $config['cssClass'] ?>" data-base-name="<?php echo $config['name'] ?>" data-max-items="<?php echo $config['maxItems'] ?>" data-title="<?php echo $config['title'] ?>">
		<a class="rs-gallery-add-item rs-button"><i class="icon-plus"></i> <?php echo $config['addItemText'] ?></a>
		<div class="rs-gallery-items">
			<?php 
			$i = 0;
			foreach($config['items'] as $item) { ?>
				<div class="rs-gallery-item">
					<input type="hidden" class="rs-gallery-item-id" name="<?php echo $config['name'].'['.$i.'][id]' ?>" value="<?php echo $item['id'] ?>"/>
					<input type="hidden" class="rs-gallery-item-url" name="<?php echo $config['name'].'['.$i.'][url]' ?>" value="<?php echo $item['url'] ?>"/>
					<input type="hidden" class="rs-gallery-item-thumbnail" name="<?php echo $config['name'].'['.$i.'][thumbnail]' ?>" value="<?php echo $item['thumbnail'] ?>"/>
					<input type="hidden" class="rs-gallery-item-name" name="<?php echo $config['name'].'['.$i.'][name]' ?>" value="<?php echo $item['name'] ?>"/>
					<input type="hidden" class="rs-gallery-item-caption" name="<?php echo $config['name'].'['.$i.'][caption]' ?>" value="<?php echo $item['caption'] ?>"/>
					<input type="hidden" class="rs-gallery-item-description" name="<?php echo $config['name'].'['.$i.'][description]' ?>" value="<?php echo $item['description'] ?>"/>
					<img src="<?php echo $item['thumbnail'] ? $item['thumbnail'] : $item['url'] ?>" alt="<?php echo $item['name'] ?>"/>
					<div class="rs-gallery-action">
						<a class="rs-gallery-delete">D</a>
						<a class="rs-gallery-edit">E</a>
					</div>
				</div>
				<?php 
				$i++;
			} ?>
			<div class="clear"></div>
		</div>		
		<div class="rs-gallery-template">
			<div class="rs-gallery-item">
				<input type="hidden" class="rs-gallery-item-id" name="<?php echo $config['name'].'[rsitemindex][id]' ?>" value=""/>
				<input type="hidden" class="rs-gallery-item-url" name="<?php echo $config['name'].'[rsitemindex][url]' ?>" value=""/>
				<input type="hidden" class="rs-gallery-item-thumbnail" name="<?php echo $config['name'].'[rsitemindex][thumbnail]' ?>" value=""/>
				<input type="hidden" class="rs-gallery-item-name"  name="<?php echo $config['name'].'[rsitemindex][name]' ?>" value=""/>
				<input type="hidden" class="rs-gallery-item-caption"  name="<?php echo $config['name'].'[rsitemindex][caption]' ?>" value=""/>
				<input type="hidden" class="rs-gallery-item-description"  name="<?php echo $config['name'].'[rsitemindex][description]' ?>" value=""/>
				<img src="" alt=""/>
				<div class="rs-gallery-action">
					<a class="rs-gallery-delete">D</a>
					<a class="rs-gallery-edit">E</a>
				</div>
			</div>
		</div>
	<?php
	?>
	</div>
	
	<?php
}
?>