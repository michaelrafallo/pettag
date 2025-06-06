<style type="text/css">
#pet_tags_options label {
	float: none;
	width: auto;
	display: table-cell;
	padding-bottom: 5px; 
}	
#pet_tags_options input {
	float: none;
}
#pet_tags_options .form-group {
	margin-bottom: 10px; 
}
.pet_tags_options a::before {
	content: "\f323" !important;
}
.btn-remove-img {
	margin: 5px 15px 0;
	display: inline-block;
}
#pet_tags_options table input {
	width: 100%;
}
</style>

<div id='pet_tags_options' class='panel woocommerce_options_panel'>
	<div class='options_group' style="margin:10px;">

	<label for="enable_pet_tags">

		<?php $enable = @$meta['enable'] ? 'checked' : ''; ?>
		<input type="hidden" name="pet_tags[enable]" value="">
		<input type="checkbox" class="checkbox" name="pet_tags[enable]" id="enable_pet_tags" value="1" <?php echo $enable; ?>> 
		Enable pet tags custom fields on product page.
	</label>

	<hr>

	<?php wp_enqueue_media(); ?>

	<h4>Select Back Image</h4>
	<div class="img-thumb-manager">
		<div class='image-preview-wrapper'>
			<?php 
				$placeholder = plugin_dir_url( dirname( __FILE__ ) ) . 'admin/img/woocommerce-placeholder.png';
				$back_image  = $placeholder;

				if( @$meta['back_image'] ) {
					$back_image = @$meta['back_image'];
				}
			?> 
			<img id='image-preview' src="<?php echo $back_image; ?>" data-img="<?php echo $placeholder; ?>" style='max-width: 300px; width: 100%;border: 2px solid #e0e0e0;'>
		</div>

		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<input type='hidden' name='pet_tags[back_image]' id='image_attachment_id' value="<?php echo @$meta['back_image']; ?>">
		<a href="" class="btn-remove-img" style="<?php echo @$meta['back_image'] ? '' : 'display:none;'; ?>">Remove product image</a>				
	</div>

	<?php 
		global $post;
		$settings = get_post_meta(@$post->ID, 'pet_tags_settings', true);
	?>

	<br>
	<label for="canvas-border">
		<?php $enable_border = @$settings['canvas']['border'] ? 'checked' : ''; ?>
		<input type="hidden" name="pet_tags_settings[canvas][border]" value="">
		<input type="checkbox" class="checkbox" name="pet_tags_settings[canvas][border]" id="canvas-border" value="1" <?php echo $enable_border; ?>> 
		Enable frame border.
	</label>

	<?php 
	$sizes = get_terms('pa_size');

	if( @$_GET['post'] && @$_GET['action'] == 'edit' ) {
		$sizes = wp_get_post_terms( @$post->ID, 'pa_size');
	} 
	?>
	<table width="100%">
		<tr>
			<td><h3>Primary Front Line</h3></td>
			<td><h3>Front Lines</h3></td>
			<td><h3>Primary Back Line</h3></td>
			<td><h3>Back Lines</h3></td>
		</tr>
		<tr>
			<td valign="top">
				<div class="form-group">
					<label><b>Front Line</b> Font Size (px)</label>
					<input name="pet_tags_settings[front_1][font_size]" type="number" value="<?php echo @$settings['front_1']['font_size']; ?>" placeholder="60">
				</div>				
				<div class="form-group">
					<label><b>Front Line</b> Padding Left/Right</label>
					<input name="pet_tags_settings[front_1][tolerance]" type="number" value="<?php echo @$settings['front_1']['tolerance']; ?>" placeholder="0.4" step="any">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label><b>Front Line</b> Font Size (px)</label>
					<input name="pet_tags_settings[front][font_size]" type="number" value="<?php echo @$settings['front']['font_size']; ?>" placeholder="60">
				</div>				
				<div class="form-group">
					<label><b>Front Line</b> Padding Left/Right</label>
					<input name="pet_tags_settings[front][tolerance]" type="number" value="<?php echo @$settings['front']['tolerance']; ?>" placeholder="0.4" step="any">
				</div>
				<div class="form-group">
					<label><b>Front Line</b> Frame Width (%)</label>
					<input name="pet_tags_settings[front][frame_width]" type="number" value="<?php echo @$settings['front']['frame_width']; ?>" placeholder="72">
				</div>
				<div class="form-group">
					<label><b>Front Line</b> Top Position (%)</label>
					<input name="pet_tags_settings[front][top_position]" type="number" value="<?php echo @$settings['front']['top_position']; ?>" placeholder="55">
				</div>
			</td>
			<td valign="top">
				<div class="form-group">
					<label><b>Back Line</b> Font Size (px)</label>
					<input name="pet_tags_settings[back_2][font_size]" type="number" value="<?php echo @$settings['back_1']['font_size']; ?>" placeholder="60">
				</div>				
				<div class="form-group">
					<label><b>Back Line</b> Padding Left/Right</label>
					<input name="pet_tags_settings[back_2][tolerance]" type="number" value="<?php echo @$settings['back_1']['tolerance']; ?>" placeholder="0.4" step="any">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label><b>Back Line</b> Font Size (px)</label>
					<input name="pet_tags_settings[back][font_size]" type="number" value="<?php echo @$settings['back']['font_size']; ?>" placeholder="60">
				</div>				
				<div class="form-group">
					<label><b>Back Line</b> Padding Left/Right</label>
					<input name="pet_tags_settings[back][tolerance]" type="number" value="<?php echo @$settings['back']['tolerance']; ?>" placeholder="0.4" step="any">
				</div>
				<div class="form-group">
					<label><b>Back Line</b> Frame Width (%)</label>
					<input name="pet_tags_settings[back][frame_width]" type="number" value="<?php echo @$settings['back']['frame_width']; ?>" placeholder="72">
				</div>				
				<div class="form-group">
					<label><b>Back Line</b> Top Position (%)</label>
					<input name="pet_tags_settings[back][top_position]" type="number" value="<?php echo @$settings['back']['top_position']; ?>" placeholder="55">
				</div>
			</td>
		</tr>
	<?php
	foreach( $sizes as $size ): 
			$size_k = $size->slug; 
			$size_v = $size->name; 
	?>
	<tr>
		<td colspan="2">
			<h3>Tag Size and Custom Fields - <?php echo $size_v; ?></h3>
		</td>		
	</tr>
	<tr>
		<td valign="top">

			<?php foreach( range(1, 6) as $front ): ?>
			<div class="form-group">
				<label><b>Front Line</b> <?php echo $front; ?> - Max Characters</label>
				<input name="pet_tags[size][<?php echo $size_k; ?>][front][<?php echo $front; ?>]" type="number" placeholder="0"  
				value="<?php echo @$meta['size'][$size_k]['front'][$front]; ?>" min="0" oninput="this.value = Math.abs(this.value)">
			</div>
			<?php endforeach; ?>

		</td>
		<td valign="top">

			<?php foreach( range(1, 6) as $back ): ?>
			<div class="form-group">
				<label><b>Back Line</b> <?php echo $back; ?> - Max Characters</label>
				<input name="pet_tags[size][<?php echo $size_k; ?>][back][<?php echo $back; ?>]" type="number" placeholder="0"  
				value="<?php echo @$meta['size'][$size_k]['back'][$back]; ?>" min="0" oninput="this.value = Math.abs(this.value)">
			</div>
			<?php endforeach; ?>
			
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	</div>
</div>