jQuery(function($){
	$(document).bind('rs-control-rebuild.rs-repeater', function(e, box){

		box = $(box).parent().length ? $(box).parent().find('.rs-repeater') : $(box).find('.rs-repeater');
		
		if(box.length == 0) return;

		box.each(function(){
		
			var repeater = $(this);
			var timer = null;
			
			repeater.data('rs-repeater', {
				'minRows': $(this).attr('data-min-rows'),
				'maxRows': $(this).attr('data-max-rows'),
				'baseName': $(this).attr('data-base-name'),
				'storage': (location.pathname + "-" + $(this).attr('data-base-name')).sanitize()
			});
			
			if(Modernizr.localstorage && repeater.parents('.rs-repeater').length == 0){
				repeater.closest('form').submit(function(){
					localStorage.removeItem(repeater.data('rs-repeater').storage);
				});
				
				if(localStorage[repeater.data('rs-repeater').storage] && rs.helpers.isRefresh){
					repeater.html(localStorage[repeater.data('rs-repeater').storage]);
					localStorage.removeItem(repeater.data('rs-repeater').storage);
					$(document).trigger('rs-control-rebuild', repeater.find('>table>tbody'));
				}
			}
			
			if(repeater.find('>table>tbody>tr').length <= repeater.attr('data-min-rows')){
				repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', 'none');
			}
			
			if(repeater.find('>table>tbody>tr').length >= repeater.attr('data-max-rows')){
				repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', 'none');
				repeater.find('>.rs-repeater-footer .rs-repeater-add-row').addClass('disabled');
			}
		});
		
		
		
		box.find('.rs-repeater-footer .rs-repeater-add-row').unbind('click').click(function(){
			rs_repeater_add_row($(this).closest('.rs-repeater'));
		});
		
		box.find('.rs-repeater-table').off('hover.row-hover').on('hover.row-hover', '>tbody>tr', function(){
			var rowaction = $(this).find('>.row-action');
			if(rowaction.find('.rs-repeater-remove-row').is(':visible')){
				rowaction.find('.rs-repeater-add-row').css('margin-top', ( - 10 - rowaction.height()/2) + 'px');
			}
			else{
				rowaction.find('.rs-repeater-add-row').css('margin-top', ( - 20 - rowaction.height()/2) + 'px');
			}			
		});
		
		box.find('.rs-repeater-table tbody').off('click.remove-row').on('click.remove-row', '>tr>.row-action>.rs-repeater-remove-row', function(){
			var repeater = $(this).closest('.rs-repeater');
			if(repeater.find('>table>tbody>tr').length > repeater.data('rs-repeater').minRows){
				$(this).closest('tr').remove();
				rs_repeater_reorder(repeater);
				repeater.find('>.rs-repeater-footer .rs-repeater-add-row').removeClass('disabled');
				repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', '');
			}
			if(repeater.find('>table>tbody>tr').length == repeater.data('rs-repeater').minRows){
				repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', 'none');
			}
		});
		
		box.find('.rs-repeater-table').off('click.add-row').on('click.add-row', '>tbody>tr>.row-action>.rs-repeater-add-row', function(){
			rs_repeater_add_row($(this).closest('.rs-repeater'), $(this).closest('tr'));
		});
		
		box.filter('.sorting-true').find('.rs-repeater-table tbody').sortable({
			handle: '.row-order',
			cursorAt: {
				top: 10
			},
			helper: function(event, helper){
				var row = helper.clone();
				row.find('td').each(function(i){
					$(this).width(helper.find('td').eq(i).width());
				});	
				return row;
			},
			update: function(event, ui){
				rs_repeater_reorder(ui.item.closest('.rs-repeater'));
			}
		});
		
		box.find('>table>tfoot').find('input,select,textarea').attr('disabled','disabled');
		
		$(window).unbind('beforeunload.rs-repeater').bind('beforeunload.rs-repeater', function(){
			$('.rs-repeater').each(function(){
				if($(this).parents('.rs-repeater').length == 0){
					var clone = $(this).clone();
					clone.find('input').each(function(){
						$(this).attr('value', $(this).val());
					});
					localStorage[$(this).data('rs-repeater').storage] = clone.html();
				}
			});
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-repeater', '.rs-repeater');
});

function rs_repeater_add_row(repeater, row){
	var table = repeater.find('>table');
	var tbody = table.find('>tbody');
	if(tbody.find('>tr').length < repeater.data('rs-repeater').maxRows){
		var tmpl = table.find('> tfoot > tr').html();
		tmpl = jQuery('<tr class="row"></tr>').append(tmpl.replace(/rsrowindex/g, tbody.find('>tr').length));
		tmpl.find('input,select,textarea').removeAttr('disabled');
		jQuery(document).trigger('rs-control-rebuild', tmpl);
		if(row){
			row.before(tmpl);
		}
		else{
			tbody.append(tmpl);
		}
		rs_repeater_reorder(repeater);
		repeater.find('>table>tbody>tr>.row-action .rs-repeater-remove-row').css('display', '');
	}
	if(tbody.find('>tr').length == repeater.data('rs-repeater').maxRows){
		repeater.find('>.rs-repeater-footer .rs-repeater-add-row').addClass('disabled');
		repeater.find('>table>tbody>tr>.row-action .rs-repeater-add-row').css('display', 'none');
	}
}

function rs_repeater_reorder(repeater){
	repeater.find('>table>tbody>tr').each(function(i){
		jQuery(this).find('td.row-order').text(i + 1);
		var re = new RegExp(repeater.data('rs-repeater').baseName + '\\[\\d+\\]', 'g');
		jQuery(this).find('[name]').attr('name', function(){		
			return jQuery(this).attr('name').replace(re,  repeater.data('rs-repeater').baseName + '[' + i + ']');
		});
	});
}