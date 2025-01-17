<p class="form-field wcva_field">
    <label for="_display_type">
		    <span class="wcvaformfield"><?php echo esc_html__('Display Type','color-image-variation-swatches-for-woocommerce'); ?></span>
	</label>
	<select name="coloredvariables[<?php echo $key; ?>][display_type]" class="wcvadisplaytype">
	         
		<option value="none" <?php if (isset($selected_type) && ($selected_type == 'none')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo esc_html__('Default Dropdown Select','color-image-variation-swatches-for-woocommerce'); ?></span></option>
			 
		<?php if (( taxonomy_exists( $key  ) ) && (isset($global_activation)) && ($global_activation == "yes")) { ?>
			<option value="global" <?php if (isset($selected_type) && ( $selected_type == "global")) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo esc_html__('Global Values','color-image-variation-swatches-for-woocommerce'); ?></span></option>
		<?php } ?>
			 
		<option value="colororimage" <?php if (isset($selected_type) && ($selected_type == 'colororimage')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo esc_html__('Custom Color or Image Swatches','color-image-variation-swatches-for-woocommerce'); ?></span></option>
			  
	    <?php if (sizeof($attributes) == 1) { ?>
			<option value="variationimage" <?php if (isset($selected_type) && ($selected_type == 'variationimage')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo esc_html__('Use Variation Images','color-image-variation-swatches-for-woocommerce'); ?></span></option>
		<?php } ?>
	</select>
</p>