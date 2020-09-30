jQuery(function($){
	if(Modernizr.boxsizing){
		$('.rs-upload-input').css('padding-right', function(){
			return ($(this).next('.rs-upload-button').outerWidth() + 4) + 'px';
		});
	}
	
	!wp.media && $('.rs-upload-edit').hide();
	
	$(document).bind('rs-control-rebuild.rs-upload', function(e, box){
		box = $(box).is('.rs-upload') ? $(box) : $(box).find('.rs-upload');
		box.each(function(){
			var data = {
				'title': $(this).attr('data-title'),
				'editTitle': $(this).attr('data-edit-title'),
				'type': $(this).attr('data-type'),
				'insertText': $(this).attr('data-insert-text'),
				'updateText': $(this).attr('data-update-text')
			};
			$(this).find('.rs-upload-button').unbind('click').click(function(event){
				event.preventDefault();
				var upload = $(this).closest('.rs-upload');
				rs.controls.upload.show({
					title: data.title,
					insertText: data.insertText,
					type: data.type,
					multiple: false,
					onselect: function(data){
						rs_upload_update_file(data, upload);
					}
				});
			});
			$(this).find('.rs-upload-delete').unbind('click').click(function(event){
				event.preventDefault();
				var upload = $(this).closest('.rs-upload');
				upload.find('.rs-upload-preview img').attr('src', '');
				upload.find('.rs-upload-details p').text('');
				upload.find('.rs-upload-input').val('');
				upload.find('.rs-upload-id').val('');
				upload.find('.rs-upload-details').css('display','none');
			});
			$(this).find('.rs-upload-edit').unbind('click').click(function(event){
				event.preventDefault();
				var upload = $(this).closest('.rs-upload');
				var id = upload.find('.rs-upload-id').val();
				if(id != '') rs.controls.upload.edit({
					fileId: id,
					title: data.editTitle,
					updateText: data.updateText,
					type: data.type,
					onselect: function(data){
						rs_upload_update_file(data, upload);
					}
				});
			});
			
		});
		box.find('.rs-upload-input').unbind('change paste').bind('change paste', function(event){
			var url = $(this).val();
			if(rs.helpers.files.isFile(url)){
				var upload = $(this).closest('.rs-upload');
				var data = {
					id: '',
					url: url,
					type: rs.helpers.files.isImage(url) ? 'image' : 'other',
					filesize: '',
					title: rs.helpers.files.basename(url),
					icon: rs.wordpress.homeUrl + '/wp-includes/images/crystal/default.png'
				};
				rs_upload_update_file(data, upload);
				upload.find('.rs-upload-edit').css('display', 'none');
			}
			
		});
		
		box.find('.rs-upload-id').each(function(){
			if($(this).val() != '' && wp.media){
				var upload = $(this).closest('.rs-upload');
				wp.media.attachment($(this).val()).fetch({
					success: function(data){
						data = data.toJSON();
						if(data.url != ''){
							rs_upload_update_file(data, upload);
							upload.find('.rs-upload-edit').css('display', '');
						}
					}
				});		
			}
			else{
				$(this).next().trigger('change');
			}
		});
		
	});	
	
	$(document).trigger('rs-control-rebuild.rs-upload', document);
});

function rs_upload_update_file(data, upload){
	var image = data.type == 'image';
	upload.find('.rs-upload-input').val(data.url);
	upload.find('.rs-upload-id').val(data.id);
	
	upload.find('.rs-upload-details').toggleClass('file-details', !image).toggleClass('image-details', image);
	upload.find('.rs-upload-preview img').attr('src', image ? data.url : data.icon);
	
	upload.find('.rs-upload-name').text(data.title);
	upload.find('.rs-upload-size').text(data.filesize ? 'Size: ' + data.filesize : '');
	upload.find('.rs-upload-details p').toggle(!image);
	upload.find('.rs-upload-details').css('display', 'block');
	
	upload.find('.rs-upload-edit').css('display','');
}