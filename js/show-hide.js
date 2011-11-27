	// Show/Hide effects
	//   - This takes a DIV tag with class "show-hide" and adds Show more and Show less clickable labels.
	$(document).ready(function() {
		$('div.show-hide').hide();
		$('div.show-hide').before("<span class='show'>Show more</span>");
		$('div.show-hide').append("<span class='hide'>Show less</span>");
		//$('span.hide').hide();
		
		$('span.show').click(function() {
			$(this).hide();
			$(this).next().show('fast');
		});

		$('span.hide').click(function() {
			$(this).parent().hide('fast');
			$(this).parent().prev().show();
		});			
	});
