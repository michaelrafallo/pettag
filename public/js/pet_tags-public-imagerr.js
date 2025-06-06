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
				
				var dataimg = jQuery(this).attr('id');
				var data_img = jQuery(this).parent().parent().find('.allimages #' + dataimg + ' img').attr('src');
				
				if(data_img!=''){
					jQuery(this).parent().parent().find('a .et_shop_image img').attr('src',data_img);
					jQuery(this).parent().parent().find('a .et_shop_image img').attr('srcset',data_img);
					
				}
				
			});
		});
	 }
});
