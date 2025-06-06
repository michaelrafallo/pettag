<div style="display:none;" id="after-print"><div id="inner-print">
	<?php 
	$sizes = get_the_terms($post, 'pa_size');

	foreach( $sizes as $size ): 
			$size_k = $size->slug; 
			$size_v = $size->name; 
		?>

		<div class="cfs-form cfs-<?php echo $size_k; ?>">


		<?php if( count( array_filter(@$meta['size'][$size_k]['front'])) ): ?>
		<div class="front_tags">
			<label>ENGRAVING FRONT</label>
			<?php foreach( range(1, 6) as $front ): ?>

				<?php if( $front_count = @$meta['size'][$size_k]['front'][$front]): ?>
				<div class="form-group front-tag">
					<input name="pet_tags[size][<?php echo $size_k; ?>][front][<?php echo $front; ?>]" type="text" 
					placeholder="Line <?php echo $front; ?> - Max <?php echo @$back_count; ?> Characters"  
					data-id="<?php echo $front; ?>"
					maxlength="<?php echo @$front_count; ?>"
					value="">
				</div>
				<?php endif; ?>

			<?php endforeach; ?></div>
		<?php endif; ?>

		<?php if( @$meta['back_image'] ): ?>
		<div class="back_tags">
			<label>ENGRAVING BACK</label>
			<?php foreach( range(1, 6) as $back ): ?>

				<?php if( $back_count = @$meta['size'][$size_k]['back'][$back]): ?>
				<div class="form-group back-tag">
					<input name="pet_tags[size][<?php echo $size_k; ?>][back][<?php echo $back; ?>]" type="text" 
					placeholder="Line <?php echo $back; ?> - Max <?php echo @$back_count; ?> Characters"  
					data-id="<?php echo $back; ?>"
					maxlength="<?php echo @$back_count; ?>"
					value="">
				</div>
				<?php endif; ?>

			<?php endforeach; ?></div>
		<?php endif; ?>

		</div>

	<?php endforeach; ?>

	<div class="pet-name">
	    <b>PET DETAILS <span style="color:#de151b;">*</span></b> : 
	    <p>Only used for shipping will not be ENGRAVED</p>
	    <div class="petdetail">						
	    	<input type="text" name="pet_name" placeholder="Pet Name - Max 20 Characters" maxlength="20" required>						
	    </div>
	    <div class="petdetail">
	        <p>Birthday <small style="font-size: 12px;">( DD/MM/YYY )</small></p>

	        <input type="tel" name="pet_dob"  class="date-format form-field" maxlength="10" placeholder="DD/MM/YYY" style="font-size: 18px;" /> 

	    </div>
	</div>

</div>


<style type="text/css">
.form-field { 
    height: 39px !important;
    width: 100% !important;
    border-radius: 5px;
    float: left;
    margin-top: 0 !important;
}	
</style>
</div>