jQuery(function($) {
	$(document).bind('rs-control-rebuild.rs-datepicker', function(e, box){
		var inp = $(box).find(".rs-datepicker-input");
		inp.filter('.hasDatepicker').removeClass('hasDatepicker').next('.ui-datepicker-trigger').remove();
		inp.not('.hasDatepicker').datepicker({
			showOn: "button",
			buttonImage: rs.lib.url + "/controls/datepicker/trigger.png",
			buttonImageOnly: true,
			dateFormat: inp.attr('data-date-format')
		});
		
	});
	
	$(document).trigger('rs-control-rebuild.rs-datepicker', '.rs-datepicker');
});