;
(function ($) {



 $(document).ready(function() {

$('li span.reservation-menu').mouseenter(function(){
		$('div.reservations_widget_box').fadeIn('10');
	});

	$('div.reservations_widget_box').mouseleave(function(){
		$('div.reservations_widget_box').fadeOut('10');
	});
		});

	
}(jQuery));
;
