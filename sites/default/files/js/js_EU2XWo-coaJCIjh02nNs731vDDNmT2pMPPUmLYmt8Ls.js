(function ($) {
Drupal.behaviors.clear_search = {
  attach: function(context) {
    $('#webform-client-form-13 .form-text', context).once(function(){  
      this.defaultValue = this.value;
      $(this).click(function(){
        if(this.value == this.defaultValue){
          $(this).val("");
        }
        return false;
      });
      $(this).blur(function(){
        if(this.value == ""){
          $(this).val(this.defaultValue);
        }
      });
    });
  }
}
})(jQuery);

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
