<script type='text/javascript'>
var js = jQuery;

js(document).ready(function () {
    js('.show_if_variable').addClass('show_if_pet_tags').show();
});

js( 'body' ).on( 'woocommerce_added_attribute', function( event ){
    js('.woocommerce_attribute_data .enable_variation').addClass('show_if_pet_tags').show();
});

js(document).on('click', '.btn-remove-img', function(e){
	e.preventDefault();
	js('#image_attachment_id').val('');
	var img = js('.img-thumb-manager').find('img');		
	img.attr('src', img.data('img'));
	js(this).hide();
});
</script>