<?php 

    $global_settings=$this->global_settings; 

    if (isset($global_settings['wcva_woocommerce_global_activation'])) {
    	$wcva_woocommerce_global_activation = $global_settings['wcva_woocommerce_global_activation'];
    } else {
    	$wcva_woocommerce_global_activation = get_option('wcva_woocommerce_global_activation');
    }
    
?> 

<table class="table">

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Enable default attribute options','color-image-variation-swatches-for-woocommerce'); ?></label> <br />
		</td>
		<td width="70%">
			<input type="hidden"  name="<?php  echo esc_html__($this->wcva_global_settings); ?>[wcva_woocommerce_global_activation]" value="no" >
			<input type="checkbox" class="globalcheckbox" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_global_settings); ?>[wcva_woocommerce_global_activation]" value="yes" <?php if (isset($wcva_woocommerce_global_activation) && ($wcva_woocommerce_global_activation == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

    <?php $this->global_values_swatches_form(); ?>
	

</table>