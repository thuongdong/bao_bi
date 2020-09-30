jQuery(function($){
	
	!wp.media && $('.rs-gallery-edit').hide();
	
	$(document).bind('rs-control-rebuild.rs-gallery', function(e,box){
		
		box = $(box).is('.rs-gallery') ? $(box) : $(box).find('.rs-gallery');
		
		box.each(function(){
			
			var gallery = $(this);
			
			gallery.data('rs-gallery', {
				'title': $(this).attr('data-title'),
				'maxItems': $(this).attr('data-max-items'),
				'baseName': $(this).attr('data-base-name'),
				'storage': (location.pathname + "-" + $(this).attr('data-base-name')).sanitize()
			});
			
			gallery.find('.rs-gallery-add-item').unbind('click').click(function(){
				if(!$(this).is('.disabled')){
					rs.controls.upload.show({
						title: gallery.data('rs-gallery').title,
						insertText: 'Insert',
						type: 'image',
						multiple: true,
						onselect: function(data){
							rs_gallery_add_items(gallery, data);						
							
							rs_gallery_update_storage(gallery);
						}
					});
				}
			});
			
			gallery.filter('.sorting-true').find('.rs-gallery-items').sortable({
				cursorAt: { top: 75, left: 75 },
				toleranceType: "pointer",
				update: function(){
					rs_gallery_update_storage(gallery);
					rs_gallery_reorder(gallery);
				}
			}).disableSelection();
			
			if(Modernizr.localstorage){
				gallery.closest('form').submit(function(){
					localStorage.removeItem(gallery.data('rs-gallery').storage);
				});
			
				if(localStorage[gallery.data('rs-gallery').storage]  && rs.helpers.isRefresh) {
					gallery.find('.rs-gallery-items .rs-gallery-item').remove();
					rs_gallery_add_items(gallery, JSON.parse(localStorage[gallery.data('rs-gallery').storage]));
				}
			}
			
			if(gallery.find('.rs-gallery-items .rs-gallery-item').length >= gallery.data('rs-gallery').maxItems){
				gallery.find('.rs-gallery-add-item').addClass('disabled');
			}
		});
		
		$(box).off('click.rs-gallery-delete').on('click.rs-gallery-delete', '.rs-gallery-delete', function(){
			var gallery = $(this).closest('.rs-gallery');
			var item = $(this).closest('.rs-gallery-item');
			item.remove();
			gallery.find('.rs-gallery-add-item').removeClass('disabled');
			
			rs_gallery_update_storage(gallery);
		});
		
		$(box).off('click.rs-gallery-edit').on('click.rs-gallery-edit', '.rs-gallery-edit', function(){
			var gallery = $(this).closest('.rs-gallery');
			var item = $(this).closest('.rs-gallery-item');
			var id = item.find('.rs-gallery-item-id').val();
			if(id != '') rs.controls.upload.edit({
				fileId: id,
				title: 'Edit Image',
				updateText: 'Update',
				type: 'image',
				onselect: function(data){
					item.find('img').attr('alt', data.title);
					item.find('.rs-gallery-item-name').val(data.title);
					item.find('.rs-gallery-item-caption').val(data.caption);
					item.find('.rs-gallery-item-description').val(data.description);
					
					rs_gallery_update_storage(gallery);
				}
			});
		});
		
		box.find('.rs-gallery-template input').attr('disabled', 'disabled');
	});
	
	$(document).trigger('rs-control-rebuild.rs-gallery', '.rs-gallery');
});

function rs_gallery_update_storage(gallery){
	if(!Modernizr.localstorage) return false;
	var data = [];
	gallery.find('.rs-gallery-items .rs-gallery-item').each(function(){
		data.push({
			id: jQuery(this).find('.rs-gallery-item-id').val(),
			url: jQuery(this).find('.rs-gallery-item-url').val(),
			title: jQuery(this).find('.rs-gallery-item-name').val(),
			caption: jQuery(this).find('.rs-gallery-item-caption').val(),
			description: jQuery(this).find('.rs-gallery-item-description').val(),
			sizes: {
				thumbnail: {
					url: jQuery(this).find('img').attr('src')
				}
			}
		});
	});
	localStorage[gallery.data('rs-gallery').storage] = JSON.stringify(data);
}

function rs_gallery_add_items(gallery, items){
	var length = gallery.find('.rs-gallery-items .rs-gallery-item').length;
	var max = gallery.data('rs-gallery').maxItems - length;

	for(var i=0; i < items.length && i < max; i++){							
		var tmpl = gallery.find('.rs-gallery-template').html();
		var has_thumbnail = items[i].sizes && item[i].sizes.thumbnail;
		tmpl = jQuery(tmpl.replace(/rsitemindex/g, length + i));
		tmpl.find('img').attr('alt', items[i].title);
		tmpl.find('img').attr('src', has_thumbnail ? items[i].sizes.thumbnail.url : items[i].url);
		tmpl.find('.rs-gallery-item-id').val(items[i].id);
		tmpl.find('.rs-gallery-item-url').val(items[i].url);
		tmpl.find('.rs-gallery-item-thumbnail').val(has_thumbnail ? items[i].sizes.thumbnail.url : items[i].url);
		tmpl.find('.rs-gallery-item-name').val(items[i].title);
		tmpl.find('.rs-gallery-item-caption').val(items[i].caption);
		tmpl.find('.rs-gallery-item-description').val(items[i].description);
		tmpl.find('input').removeAttr('disabled');
		gallery.find('.rs-gallery-items .clear').before(tmpl);
	}
	if(i >= max){
		gallery.find('.rs-gallery-add-item').addClass('disabled');
	}
}

function rs_gallery_reorder(gallery){
	gallery.find('.rs-gallery-items .rs-gallery-item').each(function(i){
		var re = new RegExp(gallery.data('rs-gallery').baseName + '\\[\\d+\\]', 'g');
		jQuery(this).find('[name]').attr('name', function(){		
			return jQuery(this).attr('name').replace(re,  gallery.data('rs-gallery').baseName + '[' + i + ']');
		});
	});
}