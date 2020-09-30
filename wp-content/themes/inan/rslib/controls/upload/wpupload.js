(function($){
	$.fn.rsUpload = function(options){	
		this.unbind('click.rs-upload').bind('click.rs-upload', function(){
			rs.controls.upload.show(options);
		});
		return this;
	};
	rs.controls.upload = {
		show: function(options){
			options = $.extend({
				title: 'Choose Image',
				insertText: 'Insert',
				type: 'image',
				multiple: false,
				onselect: function(data){
				
				}
			}, options);
			if(wp.media){
				rs.controls.upload.frame = wp.media({
					title: options.title,
					button: {
						text: options.insertText
					},
					library: {
						type: options.type
					},
					multiple: options.multiple
				});
				rs.controls.upload.frame.on('select', function(){
					var attachment = rs.controls.upload.frame.state().get('selection').toJSON();
					if(typeof options.onselect == 'function'){
						options.onselect(options.multiple ? attachment : attachment[0]);
					}
				});
				rs.controls.upload.frame.on('close', function(){
					rs.controls.upload.showed = false;
				});
				rs.controls.upload.frame.open();
			}
			else{
				tb_show(options.title, rs.wordpress.adminUrl + '/media-upload.php?tab=library&post_id=0&type=' + options.type + '&multiple=' + options.multiple +'&buttontext=' + options.insertText +'&rsupload=tb&TB_iframe=true');
				rs.controls.upload.tb_send = function(data){
					options.onselect(options.multiple ? [data] : data);
				};
			}
			rs.controls.upload.showed = true;
		},
		edit: function(options){
			options = $.extend({
				title: 'Edit Image',
				updateText: 'Update',
				fileId: ''
			}, options);

			options.insertText = options.updateText;
			options.multiple = false;
			
			if(options.fileId == ''){
				return rs.message('No file to edit.');
			}
			else{
				rs.controls.upload.show(options);
				var file = wp.media.attachment(options.fileId);
				file.fetch();
				rs.controls.upload.frame.state().get('selection').add(file);
				rs.controls.upload.frame.$el.closest(".media-modal").addClass("rs-media-edit-wrap");
			}
			
			 rs.controls.upload.frame.content.mode('browse');
		},
		frame: null,
		showed: false,
		tb_send: function(data){
			console.log(data);
		}
	}
})(jQuery);

jQuery(function($){
	$(window).bind('scroll mousemove', function(){
		//$('td.savesend input').val('<?php _e($_REQUEST['buttontext']) ?>')
	});
	$('#media-upload td.savesend input').val($.parseParams(location.search.substring(1)).buttontext).click(function(event){
		var win = window.dialogArguments || opener || parent || top;
		if(win.rs.controls.upload.tb_send){
			var table = $(this).closest('table');			
			var mime = $.trim(table.find('thead td:eq(1) p:eq(1)').text().split(':')[1]);
			var type = mime.split('/')[1];
			var fizename = $.trim(table.find('thead td:eq(1) p:eq(0)').text().split(':')[1]);
			var image = type == 'image';
			var data = {
				id: table.find('.A1B1').attr('id').replace('thumbnail-head-', ''),
				link: table.find('.A1B1 a').attr('href'),
				url: table.find('.urlfield').val(),
				name: table.find('.post_title input').val(),
				title: table.find('.post_title input').val(),
				alt: table.find('.image_alt input').val(),
				type: type,
				caption: table.find('.post_excerpt textarea').val(),
				description: table.find('.post_content textarea').val(),
				icon: image ? rs.wordpress.homeUrl + "/wp-includes/images/crystal/default.png" : table.find('thead .thumbnail').attr('src'),
				filesize: 'undefined',
				fizename: fizename,
				mime: mime
			};
			if(image) {
				data.sizes = {
					full: {
						url: table.find('.urlfield').val()
					},
					thumbnail: {
						url: table.find('thead .thumbnail').attr('src')					
					}
				}
			}
			win.rs.controls.upload.tb_send(data);
		}
		return win.tb_remove();
	});
});