	<?php
	    $attribute_taxonomies = wc_get_attribute_taxonomies();
	   

	    $global_settings      =   $this->global_settings; 

        if (isset($global_settings['wcva_woocommerce_global_activation'])) {
    	    $global_activation = $global_settings['wcva_woocommerce_global_activation'];
        } else {
    	    $global_activation = get_option('wcva_woocommerce_global_activation');
        }

        if (isset($global_settings['values'])) {
        	$wcva_global_values = $global_settings['values'];
        } else {
        	$wcva_global_values = get_option('wcva_global');
        }
	   
	    
	    


	?>
	<tr valign="top" style="<?php if (isset($global_activation) && ($global_activation == "yes")) { echo 'display:;'; } else {echo 'display:none;';} ?>">
		
		<td width="30%">
			<label><?php  echo esc_html__('Default attribute options','color-image-variation-swatches-for-woocommerce'); ?></label>
		</td>
		<td width="70%" class="forminp">
			<?php echo esc_html__('This Feature Available In Pro Version Only','color-image-variation-swatches-for-woocommerce'); ?> 
			<br><br>
            <a class="button button-success" href="https://www.sysbasics.com/go/swatch/"><?php echo esc_html__('Upgrade to Pro','color-image-variation-swatches-for-woocommerce'); ?> </a>
		</table>
	</td>
</tr>