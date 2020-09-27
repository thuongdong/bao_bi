(function ($j) {

  switch_style = {

    onReady: function () {      
      this.switch_style_click();
    },
    
    switch_style_click: function(){
    	$(".colorbox").click(function(){
    		var id = $(this).attr("id");
    		
    		$("#switch_style").attr("href", "<?php echo get_template_directory_uri(); ?>/stylesheets/css/colors/" + id + ".css");    		
    	});
    },
  };

  $j().ready(function () {
	  switch_style.onReady();
  });

})(jQuery);

$( ".hiddenbox" ).click(
  function() {
    $(".colorbox-container").toggle('slide');
  }
);