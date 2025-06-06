var j=0;
jQuery(window).scroll(function(){
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 if(j==0){
	j=1;
		jQuery('#swatchs .attr-icon').each(function(){
			jQuery(this).click(function(){
				jQuery('.loader-img').show();
				
				var dataimg = jQuery(this).attr('id');
				var data_img = jQuery(this).parent().parent().find('.allimages #' + dataimg + ' img').attr('src');
				
				if(data_img!=''){
					jQuery(this).parent().parent().find('a .et_shop_image img').attr('src',data_img);
					jQuery(this).parent().parent().find('a .et_shop_image img').attr('srcset',data_img);
					jQuery('.loader-img').hide();
				}
				
			});
		});
	 }
  
    jQuery(document).on('click', '.attr-icon', function(e){
		e.preventDefault();	
		var src = jQuery(this).attr('data-img');

		var preload = '<div class="preloading"></div>';
		jQuery(this).closest('.product-type-variable').append(preload);

		jQuery(this).closest('.product-type-variable').find('.attachment-woocommerce_thumbnail')
		.attr('srcset', src)
		.attr('data-srcset', src)
		.attr('data-src', src)
		.attr('src', src).load(function() { 
			jQuery(this).closest('.product-type-variable').find('.preloading').remove();
		});

		jQuery(this).closest('.product-type-variable').find('.active').removeClass('active');
		jQuery(this).addClass('active');

	});

});

jQuery('input[type="text"], form').attr('autocomplete', "off");