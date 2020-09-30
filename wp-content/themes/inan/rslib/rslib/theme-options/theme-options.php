<?php
global $current_user;

RS::loadScript('rs-panel-script', RSLIBURL . '/theme-options/js/options.js');

$groups = array();

foreach(RS::$options as $tab){
	if($tab['controls']){
		$groups[$tab['name']] = $tab['controls'];
	}
	foreach($tab['subtabs'] as $subtab){
		if($subtab['controls']){
			$groups[$subtab['name']] = $subtab['controls'];
		}
	}
}

if(isset($_POST['rs-options'])){
	foreach($groups as $group){
		foreach($group as $control){
			$value = $_POST[$control['name']];
			$value = str_replace("\'", "'", $value);
			$value = str_replace('\"', '"', $value);
			RS::updateOption($control['name'], $value);		
		}
	}
}

?>
<div class="wrap rs-panel-wrap">
	<h2 style="display:none"></h2>
	<div class="rs-panel">
		<div class="rs-header">
			<h2><?php _e('Themes Panel') ?></h2>
		</div>
		<div class="rs-content">
			<div class="rs-sidebar">
				<div class="rs-avatar">
					<?php echo get_avatar($current_user->user_email) ?>
					<p><?php _e('Welcome') ?>, <span><?php echo $current_user->display_name ?></span></p>
					<div class="clear"></div>
				</div>
				<div class="rs-menu">
					<ul>
					<?php
						foreach(RS::$options as $tab){
							?>
							<li id="<?php echo $tab['name'] ?>" class="rs-menu-item">								
								<a href="<?php echo is_url($tab['link']) ? $tab['link'] : '#'?>" data-tab-name="<?php echo $tab['name'] ?>">
									<?php if(!is_file($tab['icon'])) { ?>
										<i class="rs-icon dashicons <?php echo $tab['icon'] ?>"></i>
									<?php } else { ?>
										<img src="<?php echo $tab['icon'] ?>" class="rs-icon" alt=""/>
									<?php } ?>
									<?php echo $tab['title'] ?>
								</a>
								<?php
									if(count($tab['subtabs'])){
									?>
									<ul>
										<?php
										foreach($tab['subtabs'] as $subtab){
											?>
											<li id="<?php echo $subtab['name'] ?>" class="rs-menu-sub-item">
												<a href="<?php echo is_url($subtab['link']) ? $subtab['link'] : '#'?>" data-tab-name="<?php echo $subtab['name'] ?>"><?php echo $subtab['title'] ?></a>
											</li>
											<?php
										}
										?>
									</ul>
									<?php
									}
								?>
							</li>
							<?php
						}
					?>
					</ul>               
				</div>
			</div><!--end rs-sidebar-->
			<div class="rs-content-main">
				<div class="rs-breadcrumb">
					<ul>
						<li class="rs-breadcrumb-e1"><a href="#">Theme panel</a></li>
						<li class="rs-breadcrumb-e2"><a href="#">UI Elements</a></li>
						<li class="rs-breadcrumb-e3"><a href="#">General</a></li>
					</ul>
				</div><!--end rs-breadcrumb-->
				<div class="rs-form">
					<form action="<?php echo admin_url('/themes.php?page=theme-options') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="rs-options" value="true"/>
						<?php
							
							foreach($groups as $name=>$fields) { ?>
								<div class="rs-fields" id="rs-tab-<?php echo $name ?>"> 
									<?php foreach($fields as $field) { ?>
										<div class="rs-field">
											<div class="rs-field-label">
												<label for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
												<p><?php echo $field['description'] ?></p>
											</div>
											<div class="rs-field-editor">
												<?php 
												if(empty($field['name'])){
													$field['name'] = $field['type'];
												}
												if(empty($field['label'])){
													$field['label'] = $field['name'];
												}
												if($field['name']){
													$field['value'] = RS::getOption($field['name'], isset($field['value']) ? $field['value'] : null );
													$field['values'] = RS::getOption($field['name'], isset($field['values']) ? $field['values'] : null);
												}
												
												RS::renderControl($field) 
												?>
											</div>
											<div class="clear"></div>
										</div>
									<?php } ?>
								</div>
							<?php } 
						?>						
						<div class="rs-form-action">
							<input type="submit" class="rs-button rs-button-primary" value="Save changes" name="save" />
							<span class="spinner"></span>
							<span class="rs-action-msg"></span>
						</div>
					</form>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>