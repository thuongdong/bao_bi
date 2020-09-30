<?php 
	
RS::addControl('metabox', null, 'rs_add_metabox');

global $rs_metabox_configs, $rs_metabox_registered;
$rs_metabox_configs = array();
$rs_metabox_registered = false;

function rs_add_metabox($config = array()){
	global $rs_metabox_configs, $rs_metabox_registered;
	
	$config = array_merge ( array(
		'name' => 'metabox-' . count($rs_metabox_configs),
		'title' => 'Metabox Title',
		'cssClass' => '',
		'layout' => 'row',
		'rules' => array(), // can use rules1, rules2, rules3.... for other filter
		'context' => 'normal',
		'priority' => 'default',
		'controls' => array(),
		'control' => null
	), $config);
	
	if($rs_metabox_registered){
		RS::message('The meta box with name "'.$config['name'].'" should be register outside any functions or by action "add_meta_boxes".');
		return false;
	}
	
	$rules_default = array(
		'post_type' => 'post',
		'post_in' => null,
		'post_not_in' => null,
		'term_in' => null,
		'term_not_in' => null,
		'term' => null,
		'page_template' => null,
		'post_format' => null,
		'user_role' => null
	);
	
	$rules = array();
	
	foreach($config as $key=>$value){
		if(strpos($key, "rules") === 0){
			$value = array_merge($rules_default, $value);
			$rules[] = $value;
		}
	}
	
	if(empty($rules)){
		$rules[] = $rules_default;
	}
	
	$config['rules'] = $rules;
	
	RS::loadStyle('rs-metabox', RSLIBURL . '/controls/metabox/metabox.css');
	$rs_metabox_configs[] = $config;
}

add_action('add_meta_boxes', 'rs_add_all_metabox', 1000, 2);

function rs_add_all_metabox($current_post_type, $post){
	global $rs_metabox_configs, $rs_metabox_registered;
	
	$rs_metabox_registered = true;
	
	
	foreach($rs_metabox_configs as $config){
		$match = false;
		foreach($config['rules'] as $rules){
			extract($rules);
			$match = $match || ($current_post_type == $post_type && ($post_in == null || is_array($post_in) && in_array($post->ID, $post_in)) && ($post_not_in == null || is_array($post_not_in) && !in_array($post->ID, $post_not_in)));
		}
		if($match){
			add_meta_box( 
				sanitize_title($config['name']),
				__( $config['title'] ),
				'rs_render_metabox',
				$current_post_type,
				$config['context'],
				$config['priority'],
				$config
			);
		}
	}
}
function rs_render_metabox($post, $args){
	$config = $args['args'];
	if(!$config['controls'] && $config['control']){
		$config['layout'] = 'single';
	}
	?>
	<div class="rs-metabox layout-<?php echo $config['layout'] ?>">
		<?php
		if($config['layout'] == 'single'){
			rs_render_metabox_single_layout($post, $config);
		}
		else if($config['layout'] == 'row'){
			rs_render_metabox_row_layout($post, $config);
		}
		else if($config['layout'] == 'table'){
			rs_render_metabox_table_layout($post, $config);
		}
		else{
			rs_render_metabox_none_layout($post, $config);
		}
		?>
	</div>
	<?php
}
function rs_render_metabox_single_layout($post, $config){
	$control = $config['control'] ? $config['control'] : $config['controls'][0];
	$control['value'] = $control['values'] = get_post_meta($post->ID, FIELDSPREFIX . $control['name'], true);
	RS::renderControl($control);
}

function rs_render_metabox_row_layout($post, $config){
	if($config['controls']){
	?>
	<table class="rs-table">
		<tbody>
		<?php 
			foreach($config['controls'] as $control){ 
				$control['value'] = $control['values'] = get_post_meta($post->ID, FIELDSPREFIX . $control['name'], true);
				?>
				<tr class="row">
					<td class="label">
						<label><?php echo $control['label'] ? $control['label'] : $control['name'] ?></label>
						<p><?php echo $control['description'] ?></p>
					</td>
					<td><?php RS::renderControl($control); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php
	}
}

function rs_render_metabox_table_layout($post, $config){
	if($config['controls']){
	?>
	<table class="rs-table">
		<thead>
			<tr>
				<?php 
				foreach($config['controls'] as $control){ ?>
					<th class="label">
						<label><?php echo $control['label'] ? $control['label'] : $control['name'] ?></label>
					</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<tr>
			<?php 
				foreach($config['controls'] as $control){ 
					$control['value'] = $control['values'] = get_post_meta($post->ID, FIELDSPREFIX . $control['name'], true);
					?>
					<td><?php RS::renderControl($control); ?></td>
				<?php } ?>
			</tr>
		</tbody>
	</table>
	<?php
	}
}

function rs_render_metabox_none_layout($post, $config){
	foreach($config['controls'] as $control){ 
		$control['value'] = $control['values'] = get_post_meta($post->ID, FIELDSPREFIX . $control['name'], true);
		?>
		<p class="label">
			<label><?php echo $control['label'] ? $control['label'] : $control['name'] ?></label>
			<small><?php echo $control['description'] ?></small>
		</p>
		<?php RS::renderControl($control); ?>
	<?php } 
}

/* save post */

add_action('save_post', 'rs_metabox_save');

function rs_metabox_save($post_id){
	global $rs_metabox_configs;

	foreach($rs_metabox_configs as $config){
		if($config['post_type'] == $_POST['post_type']){
			if($config['control']){
				update_post_meta($post_id, FIELDSPREFIX . $config['control']['name'], $_POST[$config['control']['name']]);
			}
			else{
				foreach($config['controls'] as $control){
					update_post_meta($post_id, FIELDSPREFIX . $control['name'], $_POST[$control['name']]);
				}
			}
		}
	}
}