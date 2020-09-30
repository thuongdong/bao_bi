<?php
/// Repeater Control - Render Script And HTML ////

RS::addControl('repeater', 'repeater', 'rs_render_repeater_control');

function rs_render_repeater_control($config = array()){
	RS::loadStyle('rs-repeater', RSLIBURL . '/controls/repeater/repeater.css');
	RS::loadScript('jquery-ui', RSLIBURL . '/scripts/jquery.ui/jquery-ui-1.10.3.custom.min.js');
	RS::loadScript('rs-repeater', RSLIBURL . '/controls/repeater/repeater.js');
	
	$config = array_merge ( array(
		'name' => 'repeater',
		'name' => 'type',
		'layout' => 'table',
		'addRowText' => isset($config['control']) ? 'Add Item' : 'Add Row',
		'minRows' => 1,
		'maxRows' => 999,
		'sorting' => true,
		'controls' => array(),
		'control' => null,
		'values' => array(),
		'value' => '',
		'cssClass' => ''
	), $config);
		
	if($config['control']){
		$config['layout'] = 'single';
	}
	
	foreach($config['controls'] as $key => $control){
		if(empty($control['name'])){
			$control['name'] = $control['type'];
		}
		if(empty($control['label'])){
			$control['label'] = $control['name'];
		}
		$config['controls'][$key] = $control;
	}
	
	?>
	
	<div class="rs-repeater layout-<?php echo $config['layout'] ?> sorting-<?php echo $config['sorting'] ? 'true' : 'false' ?> <?php echo $config['cssClass'] ?>" data-max-rows="<?php echo $config['maxRows'] ?>" data-min-rows="<?php echo $config['minRows'] ?>" data-base-name="<?php echo $config['name'] ?>">
		<?php
		if($config['control']){
			rs_repeater_render_control_single($config);
		}
		else if($config['layout'] == 'table'){
			rs_repeater_render_control_table($config);
		}
		else{
			rs_repeater_render_control_row($config);
		}
		?>
	</div>
	
	<?php
}

function rs_repeater_render_control_single($config){
	$control = $config['control'];
	$default = empty($control['value']) ? $controls['values'] : $control['value'];
	?>
	<table class="rs-repeater-table rs-table">
		<tbody>
		<?php 
		$i = 0;
		if($config['values'] && is_array($config['values'])) { 
			foreach($config['values'] as $value) { ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1 ?></td>
				<?php } ?>
				<td>
				<?php 
					$control['value'] = $control['values'] = $default;
					if(isset($config['values'][$i])){
						$control['value'] = $control['values'] = $config['values'][$i];
					}						
					$control['name'] = $config['name'].'['.$i.']';
					RS::renderControl($control); 
				?>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php $i++; 
			} 
		}
		
		$control['value'] = $control['values'] = $default;
		
		for(; $i < $config['minRows']; $i++){ ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1  ?></td>
				<?php } ?>
				<td>
				<?php 
					$control['name'] = $config['name'].'['.$i.']';
					RS::renderControl($control); 
				?>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php
		}
		
		?>
		</tbody>
		<tfoot>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"></td>
				<?php } ?>
				<td>
				<?php
					$control['name'] = $config['name'].'[rsrowindex]';
					RS::renderControl($control); 
				?>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
		</tfoot>
	</table>
	<div class="rs-repeater-footer">
		<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo $config['addRowText'] ?></a>
	</div>
	<?php
}

function rs_repeater_render_control_table($config){
	$length = count($config['controls']);
	$defaults = array();
	?>
	<table class="rs-repeater-table rs-table">
		<thead>
			<tr>
				<?php if($config['sorting']) { ?>
					<th class="row-order"></th>
				<?php } ?>
				<?php 
					$i = 1; 
					foreach($config['controls'] as $key=>$control) {
						$defaults[$key] = empty($control['value']) ? $control['values'] : $control['value'];
						$i++; ?>
						<th style="<?php echo $i != $length ? 'width:'.(90/$length).'%' : '' ?>"><?php echo $control['label'] ?></th>
					<?php } ?>
				<th class="row-action"></th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i = 0;
		if($config['values'] && is_array($config['values'])) {
			foreach($config['values'] as $value) { ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1 ?></td>
				<?php } ?>
				<?php foreach($config['controls'] as $key=>$control) : ?>
					<td>
					<?php 
						$control['value'] = $control['values'] = $defaults[$key];
						if(isset($config['values'][$i][$control['name']])){
							$control['value'] = $control['values'] = $config['values'][$i][$control['name']];
						}						
						$control['name'] = $config['name'].'['.$i.']['.$control['name'].']';
						RS::renderControl($control); 
					?>
					</td>
				<?php endforeach; ?>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php	
			$i++;
			}
		}
		for(; $i<$config['minRows']; $i++){ ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1 ?></td>
				<?php } ?>
				<?php foreach($config['controls'] as $control) : ?>
					<td>
					<?php 
						$control['name'] = $config['name'].'['.$i.']['.$control['name'].']';
						RS::renderControl($control); 
					?>
					</td>
				<?php endforeach; ?>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php
		}		
		?>
		</tbody>
		<tfoot>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"></td>
				<?php } ?>
				<?php $i = -1; foreach($config['controls'] as $control) : $i++; ?>
					<td>
					<?php
						$control['name'] = $config['name'].'[rsrowindex]['.$control['name'].']';
						RS::renderControl($control); 
					?>
					</td>
				<?php endforeach; ?>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
		</tfoot>
	</table>
	<div class="rs-repeater-footer">
		<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo $config['addRowText'] ?></a>
	</div>
	<?php
}

function rs_repeater_render_control_row($config){
	$length = count($config['controls']);	
	$defaults = array();
	foreach($config['controls'] as $key=>$control) {
		$default[$key] = empty($control['value']) ? $control['values'] : $control['value'];
	}
	?>
	<table class="rs-repeater-table rs-table">
		<tbody>
		<?php 
		$i = 0;
		if($config['values'] && is_array($config['values'])) {
			foreach($config['values'] as $value) { ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1 ?></td>
				<?php } ?>
				<td class="rs-fields-wrap">
					<table>
					<?php foreach($config['controls'] as $key=>$control) : ?>
						<tr>
							<td class="label"><?php echo $control['label'] ? $control['label'] : $control['name'] ?></td>
							<td>
							<?php 
								$control['value'] = $control['values'] = $defaults[$key];
								if(isset($config['values'][$i][$control['name']])){
									$control['value'] = $control['values'] = $config['values'][$i][$control['name']];
								}						
								$control['name'] = $config['name'].'['.$i.']['.$control['name'].']';
								RS::renderControl($control); 
							?>
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php
			$i++;
			}
		}
		for(; $i<$config['minRows']; $i++){ ?>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"><?php echo $i + 1 ?></td>
				<?php } ?>
				<td class="rs-fields-wrap">
					<table>
					<?php foreach($config['controls'] as $control) : ?>
						<tr>
							<td class="label"><?php echo $control['label'] ?></td>
							<td>
							<?php 
								$control['name'] = $config['name'].'['.$i.']['.$control['name'].']';
								RS::renderControl($control); 
							?>
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr class="row">
				<?php if($config['sorting']) { ?>
					<td class="row-order"></td>
				<?php } ?>
				<td class="rs-fields-wrap">
					<table>
					<?php foreach($config['controls'] as $control) : ?>
						<tr>
							<td class="label"><?php echo $control['label'] ?></td>
							<td>
							<?php
								$control['name'] = $config['name'].'[rsrowindex]['.$control['name'].']';
								RS::renderControl($control); 
							?>
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				</td>
				<td class="row-action">
					<?php if($config['sorting']) { ?><a class="rs-repeater-add-row" title="add">+</a><?php } ?>
					<a class="rs-repeater-remove-row" title="remove">-</a>
				</td>
			</tr>
		</tfoot>
	</table>
	<div class="rs-repeater-footer">
		<a class="rs-button rs-repeater-add-row"><i class="icon-plus"></i> <?php echo $config['addRowText'] ?></a>
	</div>
	<?php
}

?>