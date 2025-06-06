<div class="front_var_img" style="display:none">
  <?php for($i=1;$i<=sizeof($thumb)+1;$i++){?>
    <div id="<?php echo $attr['attributes'.$i].'_'.$attr1['attributes'.$i]; ?>">
      <img id="img<?php echo $i; ?>" src="<?php print_r($thumb['full_src'.$i]); ?>" alt="" />
    </div>
  <?php } ?>
</div>

<?php 
  $settings = get_post_meta(@$post->ID, 'pet_tags_settings', true);

  $front_1_font_size    = @$settings['front_1']['font_size'] ? $settings['front_1']['font_size'] : 60;
  $front_1_tolerance    = @$settings['front_1']['tolerance'] ? $settings['front_1']['tolerance'] : 0.4;

  $front_font_size    = @$settings['front']['font_size'] ? $settings['front']['font_size'] : 50;
  $front_tolerance    = @$settings['front']['tolerance'] ? $settings['front']['tolerance'] : 0.4;
  $front_frame_width  = @$settings['front']['frame_width'] ? $settings['front']['frame_width'] : 72;
  $front_top_position = @$settings['front']['top_position'] ? $settings['front']['top_position'] : 55;

  $back_1_font_size    = @$settings['back_1']['font_size'] ? $settings['back_1']['font_size'] : 60;
  $back_1_tolerance    = @$settings['back_1']['tolerance'] ? $settings['back_1']['tolerance'] : 0.4;

  $back_font_size    = @$settings['back']['font_size'] ? $settings['back']['font_size'] : 50;
  $back_tolerance    = @$settings['back']['tolerance'] ? $settings['back']['tolerance'] : 0.4;
  $back_frame_width  = @$settings['back']['frame_width'] ? $settings['back']['frame_width'] : 72;
  $back_top_position = @$settings['back']['top_position'] ? $settings['back']['top_position'] : 55;

  $canvas_border     = @$settings['canvas']['border'] ?  '1px dashed #E91E63' : '0';

?>



<style type="text/css">
.writable_canvas .writable_body  {
    line-height: 100%;
    color: #717171;
}
.front-image .writable_canvas,
.front_image .writable_canvas {
  width: <?php echo $front_frame_width; ?>% !important;
  top: <?php echo $front_top_position; ?>% !important;
}
.back-image .writable_canvas,
.back_image .writable_canvas {
  width: <?php echo $back_frame_width; ?>% !important;
  top: <?php echo $back_top_position; ?>% !important;
}
.front_tags {
  margin-bottom: 20px;  
}
.writable_canvas {
  border: <?php echo $canvas_border; ?>;
  text-align: center;
  text-align: -webkit-center;  
  position: absolute;
  z-index: 1;
  left: 50%;
  transform: translate(-50%, -50%); 
  color: #263548;
  width: 100%;
  line-height: initial;
}
.front_image, .back_image {
  position: relative;
  text-align: center;
}
.back_image img {
  width: 100%;  
}
dl dd, dl dt {
    text-transform: initial !important;
  font-size: 13px;
  display: inline-block;
  float: left;
}
dl dd {
    font-weight: 900 !important;
  width: 100%;
  margin-bottom: 8px;
}
dl dt {
  width: 100%;
}
.woocommerce-mini-cart-item .variation {
  display: none;
}
.wc-item-meta {
  margin-left: 15px;
}
.wc-item-meta li p { 
  display: inline-block; 
    margin: 0;
}
.cfs-form input, .pet-name input, .writable_canvas {
    text-transform: uppercase;
}
.et-db #et-boc .et-l .et_pb_module_inner {
    display: none !important;
}.et-db #et-boc .et-l .et_pb_module_inner:first-child {
    display: block !important;
}.et-db #et-boc .et-l .et_pb_module_inner:first-child > nav {
    padding: 0px 20px;
}
.attr-icon {
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%; 
  border-radius: 100%;
  display: inline-block;
    border: 1px solid #eaeaea;
}
.attr-icon.active {
  border: 1px solid #4d688a;
}
.attr-icon img {
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%; 
  border-radius: 100%;
  padding: 1px; 
    vertical-align: bottom !important;
}
.ced-vm-row-wrapper ul li 
{
  margin: 0 !important;
}
.product-small .box-image {
  text-align: center;
}

.preloading {
    background: #f2a10057;
    border: 1px solid #f2a100;
    position: absolute;
    border-radius: 10px;
    width: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.preloading:before {
  background:url('<?php echo plugin_dir_url(__FILE__).'loading.gif'; ?>');  
    content: "";
    width: 70px;
    height: 70px;
    position: absolute;
    background-size: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  border-radius: 100%;
}
.variation dt, .variation dd {
    padding: 0px !important;
}
dl.variation {
    margin-top: 10px;
    float: left;
    width: 100%;
}
<?php if( @$meta['enable'] ): ?>
/* mobile updates */

@media only screen and (max-width: 768px) {
  .shop-container {
      max-width: 100%;
      overflow-x: hidden;
  }
  .custom-product-page .row>.col>.col-inner>.row .et_pb_section_0_tb_body .et_pb_column:nth-child(1) {
      max-width: 100%;
      flex-basis: 100%;
      position: fixed !important; 
      background: #fff;
      z-index: 9 !important;
      padding: 0;
      border-bottom: 1px solid #E91E63;
      top: 70px;
  }
  .custom-product-page .col-inner .product-images, 
  .custom-product-page .col-inner .back-image {
      width: 50%;
      display: inline-block;
      float: left;    
      margin: 0;
  }
  .custom-product-page .row>.col>.col-inner>.row .et_pb_section_0_tb_body .et_pb_column:nth-child(2) {
      max-width: 100%;
      flex-basis: 100%;
  }
  .back-image h4 {
    display: none;
  }
  .et-l.et-l--body .et_pb_row.et_pb_row_0_tb_body.et_pb_gutters2 {
    width: 100% !important;
    max-width: 100% !important;
}
#product_image {
    margin: 0px !important;
}.product-images {
    padding: 0px 15px 15px 15px !important;
}
}
<?php endif; ?>
</style>


<script type="text/javascript">  
var js = jQuery;
function show_custom_fields() {

    var val = js('[name="attribute_pa_size"]').val();

    js('.cfs-form').hide();
    js('.cfs-' + val).show();

    js('.writable_body').html('');

    js('.front-tag:visible').each(function (index, value) {
        var id = js(this).find('input').attr('data-id');
        val = js(this).find('input').val();

        js('.flickity-viewport .writable_canvas, .front_image .writable_canvas').append('<div class="writable_body" id="front-text-tag-' + id + '" >' + val + '</div>');
       // js('#front-text-tag-' + id).html(val);
    });

    js('.back-tag:visible').each(function (index, value) {
        var id = js(this).find('input').attr('data-id');
        val = js(this).find('input').val();

        js('.back_image .writable_canvas').append('<div class="writable_body" id="back-text-tag-' + id + '">' + val + '</div>');
       // js('#back-text-tag-' + id).html(val);
    });

}

jQuery(document).ready(function(js){

  js(document).on('keyup', '.front-tag input', function(){
    var id  = js(this).data('id'),
        val = js(this).val();

    js('#front-text-tag-'+id).html(val);
    txt_quickfit(this);
  });

  js(document).on('keyup', '.back-tag input', function(){
    var id  = js(this).data('id'),
        val = js(this).val();

    js('#back-text-tag-'+id).html(val);
    txt_quickfit(this);
  });  

  var check=0;
  var check1=0;
  
  js(window).resize(function () {
      m_top();
  });
  m_top();

  function m_top() {
      var size = js(window).innerWidth();
      if (size < 768) {
          var height = js('.custom-product-page .row>.col>.col-inner>.row').find('.et_pb_column:nth-child(1)').innerHeight();
          js('.custom-product-page .row>.col>.col-inner>.row').find('.et_pb_column:nth-child(2)').css({
              'margin-top': height + 'px'
          });
          if (check1 == 0) {
              js('.et-l.et-l--body').wrapAll('<div class="custom-product-page"><div class="row"><div class="col small-12 large-12"><div class="col-inner"><div class="row">');
              js('.custom-product-page .row>.col>.col-inner>.row .et_pb_column:nth-child(2)').prepend(js('.et_pb_module.et_pb_wc_breadcrumb.et_pb_wc_breadcrumb_0_tb_body.et_pb_bg_layout_.et_pb_text_align_left').html());
              check1 = 1;
          }
          js('.custom-product-page .row>.col>.col-inner>.row .et_pb_column:nth-child(2) .et_pb_module.et_pb_wc_breadcrumb.et_pb_wc_breadcrumb_0_tb_body.et_pb_bg_layout_.et_pb_text_align_left').show();
          js('.et_pb_module.et_pb_wc_breadcrumb.et_pb_wc_breadcrumb_0_tb_body.et_pb_bg_layout_.et_pb_text_align_left').hide();

      } else {
          js('.custom-product-page .row>.col>.col-inner>.row').find('.et_pb_column:nth-child(2)').css({
              'margin-top': 'initial'
          });
          js('.custom-product-page .row>.col>.col-inner>.row .et_pb_column:nth-child(2) .et_pb_module.et_pb_wc_breadcrumb.et_pb_wc_breadcrumb_0_tb_body.et_pb_bg_layout_.et_pb_text_align_left').hide();
          js('.et_pb_module.et_pb_wc_breadcrumb.et_pb_wc_breadcrumb_0_tb_body.et_pb_bg_layout_.et_pb_text_align_left').show();
      }
  }


  js(window).scroll(function() {
      if (check == 0) {
          check = 1;
      }
      if (js(window).scrollTop() > js('.single_variation_wrap').offset().top) {
          js('.custom-product-page .et_pb_gutters2').find('.et_pb_column:nth-child(1)').css({
              'visibility': 'hidden'
          });
      } else {
          if (js(window).scrollTop() > 70) {
              js('.custom-product-page .et_pb_gutters2 .et_pb_css_mix_blend_mode_passthrough').css({
                  'top': '0px'
              });
          } else {
              js('.custom-product-page .row>.col>.col-inner>.row').find('.et_pb_column:nth-child(1)').css({
                  'top': '76px'
              });
          }
          js('.custom-product-page .et_pb_gutters2 .et_pb_css_mix_blend_mode_passthrough').css({
              'visibility': 'visible'
          });
      }
  });




  var front_img = js('.flickity-slider');
  var overlay = '<div class="writable_canvas"></div>';
  front_img.after(overlay);

  var ind = js("#pa_size").prop('selectedIndex');
  var img_1 = js('.front_var_img').find('#img' + ind).attr('src');

  var back_img = js('#product_image');
  var img = '<img src="<?php echo @$meta['back_image']; ?>" data-src="<?php echo @$meta['back_image']; ?>" data-lazy-type="image">';
  var img_f = '<img src="' + img_1 + '" id="change_f_img" data-src="' + img_1 + '" data-lazy-type="image">';
  back_img.after('<div class="product-images"><div class="front_image">' + img_f + '<div class="writable_canvas"></div></div></div><div class="back-image"><div class="back_image">' + img + '<div class="writable_canvas"></div></div></div>');
  js('.product-images,.back-image').wrapAll('<div class="col medium-6 small-12 large-6"><div class="col-inner">');
  var j = 0;

  setTimeout(function(){  
    show_custom_fields();
  }, 500);


  js('#pa_colour').on('change', function () {
      c = js(this).val();
      j = js("#pa_size").prop('selectedIndex');
      var f = js("#pa_size").children("option:selected").val();
      if (j == 0) {
          j = js("#pa_size").prop('selectedIndex', 1);
          f = js("#pa_size").children("option:selected").val();
      }
      var img_1 = js('.front_var_img').find('#' + c + '_' + f + ' img').attr('src');
      js('#change_f_img').attr('src', img_1);

  });

  var t_size = (js('#pa_size').find('option').size()) - 1;

  js('#pa_size').on('change', function () {
      c = js(this).val();
      j = js("#pa_colour").prop('selectedIndex');
      var f = js("#pa_colour").children("option:selected").val();
      if (j == 0) {
          j = js("#pa_colour").prop('selectedIndex', 1);
          f = js("#pa_colour").children("option:selected").val();
      }
      var img_1 = js('.front_var_img').find('#' + c + '_' + f + ' img').attr('src');
      js('#change_f_img').attr('src', img_1);

  });

  js(document).on('change', '.variations select', function () {
      js('.writable_canvas').html('');
      show_custom_fields();
  });

  js(document).on('click', '.attr-icon', function (e) {
      e.preventDefault();
      var src = js(this).attr('data-img');

      var preload = '<div class="preloading"></div>';
      js(this).closest('.product-type-variable').append(preload);

      js(this).closest('.product-type-variable').find('.attachment-woocommerce_thumbnail')
          .attr('srcset', src)
          .attr('data-srcset', src)
          .attr('data-src', src)
          .attr('src', src).load(function () {
              js(this).closest('.product-type-variable').find('.preloading').remove();
          });

      js(this).closest('.product-type-variable').find('.active').removeClass('active');
      js(this).addClass('active');

  });


});

</script>


<script src="<?php echo get_site_url(); ?>/wp-content/plugins/pet_tags/public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo get_site_url(); ?>/wp-content/plugins/pet_tags/public/js/jquery.quickfit.js"></script>

<script>  
jQuery(window).on('resize', function() {
   txt_quickfit();
});
jQuery(window).trigger('resize');    

function txt_quickfit($this) {

    var front_inputs = jQuery('.front_tags .front-tag input:visible'),
        back_inputs  = jQuery('.back_tags .back-tag input:visible'),

        front_image   = jQuery('.front_image .writable_canvas .writable_body'),
        front_image_1 = jQuery('.front_image .writable_canvas #front-text-tag-1'),

        back_image   = jQuery('.back_image .writable_canvas .writable_body'),
        back_image_1 = jQuery('.back_image .writable_canvas #back-text-tag-1'),

        front_total  = back_total = 0;

    // Front
    front_inputs.each(function(){
        if(jQuery(this).val().length > 0) {
            front_total = front_total + 1;
        }
    });

    var target_id = jQuery($this).attr('data-id');

    var longest = did = "";
    jQuery('.front_tags .front-tag:not(:first-of-type) input:visible').each(function() {
        if (jQuery(this).val().length > longest.length) {
            did = jQuery(this).attr('data-id');
            longest = jQuery(this).val();
        }
    });


    front_inputs.each(function(i){
      
        var val = jQuery(this).val(),
            id  = jQuery(this).attr('data-id');
 

        if( val ) {

            var front_font_size   = <?php echo $front_font_size; ?>,
                front_1_font_size = <?php echo $front_1_font_size; ?>;


            if( front_total == 1 ) {

                var ffs = front_font_size-10,
                    ffs1 = front_1_font_size;
 

            } else if( front_total == 2 ) { 

                var ffs = front_font_size-15,
                    ffs1 = front_1_font_size;


            } else if( front_total == 3 ) { 

                var ffs  = front_font_size-20,
                    ffs1 = front_1_font_size-5;

            } else {

                var ffs  = front_font_size-25,
                    ffs1 = front_1_font_size-10;

            }

            front_image.quickfit({ max: ffs, min: 8, tolerance: <?php echo $front_tolerance; ?>, truncate: false });    

            if( id > 1 ) {
              fsf = jQuery('#front-text-tag-'+did).css('font-size').replace('px', '');
                front_image.quickfit({ max: fsf, min: 8, tolerance: <?php echo $front_tolerance; ?>, truncate: false });    
            }

            front_image_1.quickfit({ max: ffs1, min: 8, tolerance: <?php echo $front_1_tolerance; ?>, truncate: false });    

        }
    });    

    // Back
    back_inputs.each(function(){
        if(jQuery(this).val().length > 0) {
            back_total = back_total + 1;
        }
    });

    var target_id = jQuery($this).attr('data-id');

    var longest = did = "";
    jQuery('.back_tags .back-tag:not(:first-of-type) input:visible').each(function() {
        if (jQuery(this).val().length > longest.length) {
            did = jQuery(this).attr('data-id');
            longest = jQuery(this).val();
        }
    });


    back_inputs.each(function(i){
      
        var val = jQuery(this).val(),
            id  = jQuery(this).attr('data-id');
 

        if( val ) {

            var back_font_size   = <?php echo $back_font_size; ?>,
                back_1_font_size = <?php echo $back_1_font_size; ?>;


            if( back_total == 1 ) {

                var bfs = back_font_size-10,
                    bfs1 = back_1_font_size;
 

            } else if( back_total == 2 ) { 

                var bfs = back_font_size-15,
                    bfs1 = back_1_font_size;


            } else if( back_total == 3 ) { 

                var bfs  = back_font_size-20,
                    bfs1 = back_1_font_size-5;

            } else {

                var bfs  = back_font_size-25,
                    bfs1 = back_1_font_size-10;

            }

            back_image.quickfit({ max: bfs, min: 8, tolerance: <?php echo $back_tolerance; ?>, truncate: false });    
        
            if( id > 1 ) {
              fs = jQuery('#back-text-tag-'+did).css('font-size').replace('px', '');
                back_image.quickfit({ max: fs, min: 8, tolerance: <?php echo $back_tolerance; ?>, truncate: false });    
            }

            back_image_1.quickfit({ max: bfs1, min: 8, tolerance: <?php echo $back_1_tolerance; ?>, truncate: false });    

        }
    });

}

jQuery(document).ready(function () {

    var data = jQuery('#after-print').html();
    jQuery('#after-print').html('');
    jQuery('.variations_form.cart .variations').before(data);
    jQuery('.variations_form.cart div div.cfs-form .front_tags div.front-tag').each(function () {
        jQuery(this).find('input').change(function () {
            var indexx = jQuery(this).parent().index();
            indexx = indexx + 1;
            var attr_val = jQuery(this).val();
            //alert(attr_val);
            jQuery(this).parent().parent().parent().parent().find('.cfs-form').each(function () {
                jQuery(this).find('div.front-tag:nth-child(' + indexx + ')').each(function () {
                    jQuery(this).find('input').val(attr_val);
                });
            });
        });
    });

    jQuery('.variations_form.cart div div.cfs-form .back_tags div.back-tag').each(function () {
        jQuery(this).find('input').change(function () {
            var indexx = jQuery(this).parent().index();
            indexx = indexx + 1;
            var attr_val = jQuery(this).val();
            //  alert(indexx);
            jQuery(this).parent().parent().parent().parent().find('.cfs-form').each(function () {
                jQuery(this).find('div.back-tag:nth-child(' + indexx + ')').each(function () {
                    jQuery(this).find('input').val(attr_val);
                });
            });
        });
    });


    jQuery('#pa_colour').change();

    jQuery('.variations_form').each(function () {
        jQuery(this).on('found_variation', function (event, variation) {
            var price = '<?php global  $woocommerce;   echo get_woocommerce_currency_symbol(); ?>' + variation.display_regular_price;
            jQuery('.et_pb_wc_price .price').html(price);
        });
    });

  jQuery('.date-format').inputmask('99/99/9999');    
	
});

</script>

<style>.variation-Birthday{float:left;width:auto;margin:0}.variation-PetName{float:left;width:auto}.variation{float:left}#ui-datepicker-div{background:#fff;padding:20px;box-shadow:0 0 15px rgba(0,0,0,0.3)}.ui-datepicker-header.ui-widget-header.ui-helper-clearfix.ui-corner-all{width:100%;float:left}.ui-datepicker-next.ui-corner-all{float:right}.ui-datepicker-title{text-align:center;color:#f962a7;font-size:17px;font-weight:bold}th,td{padding:.5em;text-align:left;border:1px solid #f2f2f2;line-height:1.3;font-size:.9em;text-align:center}.ui-datepicker-calendar thead tr th{border:1px solid #f5f5f5}.ui-datepicker-calendar tbody tr td{border:1px solid #f5f5f5}.ui-datepicker-days-cell-over.ui-datepicker-today,.ui-datepicker-days-cell-over.ui-datepicker-today a,.ui-datepicker-week-end.ui-datepicker-current-day,.ui-datepicker-week-end.ui-datepicker-current-day a{background:#f962a7;color:#fff!important}.ui-datepicker-prev.ui-corner-all{float:left}.variations,.variations_form.cart>div{border:1px solid #c1c1c1;padding:10px;border-radius:10px;box-shadow:none!important;margin-bottom:10px}.variations .reset_variations{position:absolute;right:11px;bottom:89%;color:currentColor;opacity:.6;font-size:11px;text-transform:uppercase}.pet-name b{font-weight:700;display:block;font-size:.9em;margin-bottom:0;float:left}.product-title.product_title.entry-title{font-weight:700;display:block;font-size:25px;margin-bottom:0;float:left;font-family:"Nunito Sans",sans-serif;margin-bottom:15px;margin-top:5px}.product-title-container .is-divider.small{display:none}.ced-vm-row-wrapper td.label .ced-vm-swatch-label{padding-top:6px!important;font-size:19px}.ced-vm-row-wrapper td.label .ced-vm-swatch-label{text-align:left!important}.ced-vm-row-wrapper label{line-height:normal!important;text-align:left}.input-group.date input{width:70px!important;border:0;padding:0 10px!important}.jq-dte-inner span{left:0;position:relative;top:-6px}.input-group.date input.jq-dte-day,.input-group.date input.jq-dte-month{width:43px!important;padding-right:0!important}.variations_form.cart{float:left;width:100%}.variations,.variations div{float:left;width:100%}.add-to-cart-container.form-minimal.is-normal,.product-price-container.is-normal,.product-price-container.is-normal,.social-icons.share-icons.share-row.relative.icon-style-outline,.product-page-accordian{float:left;width:100%}.variations_form.cart{float:left;width:100%}.pet-name{float:left;width:100%}.petdetail{float:left;width:100%}.input-group.date,.jq-dte{float:left;width:100%}.woocommerce-variation.single_variation{float:left;width:100%}.add-to-cart-container.form-minimal.is-normal form>div{float:left;width:100%}.input-group.date,.jq-dte{float:left;width:100%;position:relative}.jq-dte-tooltip{color:red!important;top:-10px!important;background:#fff;font-size:12px!important}.jq-dte-inner{border:1px solid #cccc;line-height:normal!important;height:auto;margin-top:0;float:left}#hidethis{display:none!important}.jq-dte-inner input{margin:0}#inner-print{background:#fff;padding:20px;float:left;width:100%;border:none!important;box-shadow:0 2px 18px 0 rgba(0,0,0,0.1)!important;position:relative;margin-bottom:20px;border-radius:10px!important}.jq-dte .jq-dte-inner{display:none!important}.jq-dte .jq-dte .jq-dte-inner{display:block!important}.jq-dte-errorbox{font-size:13px;color:red;margin-top:6px}.woocommerce div.product form.cart .variations{margin-bottom:1em;background:#fff;padding:20px!important;float:left;width:100%;border:none!important;box-shadow:0 -2px 18px 0 rgba(0,0,0,0.1)!important;margin-bottom:0;border-radius:10px 10px 0 0!important}.variations,.variations_form.cart>div{border-radius:10px;margin-bottom:10px;background:#fff;padding:20px;float:left;width:100%;border:none!important;box-shadow:0 10px 18px 0 rgba(0,0,0,0.1)!important;border-radius:0 0 10px 10px!important}.et-db #et-boc .et-l .et_pb_wc_add_to_cart form.cart .variations td.value span::after{right:28px!important}.woocommerce div.product form.cart .variations td{padding:20px 20px 20px 0!important}.woocommerce div.product form.cart .variations td:last-child{padding-right:20px!important}.form-group.back-tag input,.form-group.front-tag input{width:100%;height:39px;margin-top:1em;border-radius:5px}.pet-name{margin-top:20px}.pet-name .petdetail>input{height:39px;width:100%;border-radius:5px;float:left;margin-top:0}.petdetail{float:left;width:100%;margin-top:1em!important}.input-group.date input{width:70px!important;border:0;padding:0 10px!important;height:39px}.product-images,.back-image{width:50%;display:inline-block;float:left;margin:0}#product_image{margin:0!important}.product-images{padding:0 15px 15px 15px!important}.et-db #et-boc .et-l .et_pb_wc_add_to_cart_0_tb_body{overflow:visible!important}.jq-dte-inner span{left:2px;position:relative;top:2px}</style>