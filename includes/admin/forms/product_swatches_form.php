<?php 

$product_settings               = $this->product_settings;  



if (isset($product_settings['woocommerce_custom_clear_text'])) {
	$woocommerce_custom_clear_text  = $product_settings['woocommerce_custom_clear_text'];
} else {
	$woocommerce_custom_clear_text  = get_option('woocommerce_custom_clear_text');
}

$woocommerce_custom_clear_text = isset($woocommerce_custom_clear_text) && ($woocommerce_custom_clear_text != "") ? $woocommerce_custom_clear_text : esc_html__('Clear Selection','color-image-variation-swatches-for-woocommerce');



if (isset($product_settings['woocommerce_wcva_swatch_tooltip'])) {
	$woocommerce_wcva_swatch_tooltip  = $product_settings['woocommerce_wcva_swatch_tooltip'];
} else {
	$woocommerce_wcva_swatch_tooltip  = get_option('woocommerce_wcva_swatch_tooltip');
}

if (isset($product_settings['woocommerce_wcva_disableios_tooltip'])) {
	$woocommerce_wcva_disableios_tooltip  = $product_settings['woocommerce_wcva_disableios_tooltip'];
} else {
	$woocommerce_wcva_disableios_tooltip  = get_option('woocommerce_wcva_disableios_tooltip');
}

if (isset($product_settings['woocommerce_show_selected_attribute_name'])) {
	$woocommerce_show_selected_attribute_name  = $product_settings['woocommerce_show_selected_attribute_name'];
} else {
	$woocommerce_show_selected_attribute_name  = get_option('woocommerce_show_selected_attribute_name');
}


if (isset($product_settings['woocommerce_custom_swatch_height'])) {
	$woocommerce_custom_swatch_height  = $product_settings['woocommerce_custom_swatch_height'];
} else {
	$woocommerce_custom_swatch_height  = get_option('woocommerce_custom_swatch_height');
}

$woocommerce_custom_swatch_height = isset($woocommerce_custom_swatch_height) && ($woocommerce_custom_swatch_height != "") ? $woocommerce_custom_swatch_height : 32;

if (isset($product_settings['woocommerce_custom_swatch_width'])) {
	$woocommerce_custom_swatch_width  = $product_settings['woocommerce_custom_swatch_width'];
} else {
	$woocommerce_custom_swatch_width  = get_option('woocommerce_custom_swatch_width');
}

$woocommerce_custom_swatch_width = isset($woocommerce_custom_swatch_width) && ($woocommerce_custom_swatch_width != "") ? $woocommerce_custom_swatch_width : 32;


if (isset($product_settings['woocommerce_enable_shop_show_more'])) {
	$woocommerce_enable_shop_show_more  = $product_settings['woocommerce_enable_shop_show_more'];
} else {
	$woocommerce_enable_shop_show_more  = get_option('woocommerce_enable_shop_show_more');
}

if (isset($product_settings['woocommerce_show_swatches_number'])) {
	$woocommerce_show_swatches_number  = $product_settings['woocommerce_show_swatches_number'];
} else {
	$woocommerce_show_swatches_number  = get_option('woocommerce_show_swatches_number');
}

$woocommerce_show_swatches_number = isset($woocommerce_show_swatches_number) && ($woocommerce_show_swatches_number != "") ? $woocommerce_show_swatches_number : 5;

if (isset($product_settings['woocommerce_show_more_text'])) {
	$woocommerce_show_more_text  = $product_settings['woocommerce_show_more_text'];
} else {
	$woocommerce_show_more_text  = get_option('woocommerce_show_more_text');
}


$woocommerce_show_more_text = isset($woocommerce_show_more_text) && ($woocommerce_show_more_text != "") ? $woocommerce_show_more_text : esc_html__('{remaining_count} more','color-image-variation-swatches-for-woocommerce');

if (isset($product_settings['wcva_outofstock_options_behavior'])) {
	$wcva_outofstock_options_behavior  = $product_settings['wcva_outofstock_options_behavior'];
} else {
	$wcva_outofstock_options_behavior  = get_option('wcva_outofstock_options_behavior');
}

$wcva_outofstock_options_behavior = isset($wcva_outofstock_options_behavior) ? $wcva_outofstock_options_behavior : 01;

if (isset($product_settings['wcva_disable_unavailable_options'])) {
	$wcva_disable_unavailable_options  = $product_settings['wcva_disable_unavailable_options'];
} else {
	$wcva_disable_unavailable_options  = get_option('wcva_disable_unavailable_options');
}

$use_description_tooltip          = isset($product_settings['use_description_tooltip']) ? $product_settings['use_description_tooltip'] : "no";

$wcva_disable_default_text_swatches          = isset($product_settings['wcva_disable_default_text_swatches']) ? $product_settings['wcva_disable_default_text_swatches'] : "no";

$wcva_disable_unavailable_options = isset($wcva_disable_unavailable_options) ? $wcva_disable_unavailable_options : 01;

?> 

<table class="table">

	<tr>
		<td width="50%"><label><?php  echo esc_html__('Clear Selection Text','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="50%">
			<input type="text" class="clearselection_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_custom_clear_text]" value="<?php if (isset($woocommerce_custom_clear_text)) { echo $woocommerce_custom_clear_text; } ?>" >
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Disable default text swatches on all products','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="wcva_disable_default_text_swatches_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_wcva_swatch_tooltip]" value="no">
			<input type="checkbox" class="wcva_disable_default_text_swatches_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[wcva_disable_default_text_swatches]" value="yes" <?php if (isset($wcva_disable_default_text_swatches) && ($wcva_disable_default_text_swatches == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Enable tooltip on swatches','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="woocommerce_wcva_swatch_tooltip_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_wcva_swatch_tooltip]" value="no">
			<input type="checkbox" class="woocommerce_wcva_swatch_tooltip_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_wcva_swatch_tooltip]" value="yes" <?php if (isset($woocommerce_wcva_swatch_tooltip) && ($woocommerce_wcva_swatch_tooltip == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr style="<?php if (isset($woocommerce_wcva_swatch_tooltip) && ($woocommerce_wcva_swatch_tooltip == "no")) { echo 'display:none;'; } else { echo 'display:table-row;'; } ?>">
		<td width="30%"><label><?php  echo esc_html__('Use description instead of title in tooltip','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[use_description_tooltip]" value="no">
			<input type="checkbox" class="use_description_tooltip_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[use_description_tooltip]" value="yes" <?php if (isset($use_description_tooltip) && ($use_description_tooltip == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr style="<?php if (isset($woocommerce_wcva_swatch_tooltip) && ($woocommerce_wcva_swatch_tooltip == "no")) { echo 'display:none;'; } else { echo 'display:table-row;'; } ?>">
		<td width="30%"><label><?php  echo esc_html__('Disable tooltip on IOS devices','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_wcva_disableios_tooltip]" value="no">
			<input type="checkbox" class="woocommerce_wcva_disableios_tooltip_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_wcva_disableios_tooltip]" value="yes" <?php if (isset($woocommerce_wcva_disableios_tooltip) && ($woocommerce_wcva_disableios_tooltip == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Show selected attribute name on single product page','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_show_selected_attribute_name]" value="no">
			<input type="checkbox" class="woocommerce_show_selected_attribute_name_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_show_selected_attribute_name]" value="yes" <?php if (isset($woocommerce_show_selected_attribute_name) && ($woocommerce_show_selected_attribute_name == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr>
		<td width="50%"><label><?php  echo esc_html__('Product page custom swatches height','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_custom_swatch_height_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_custom_swatch_height]" value="<?php if (isset($woocommerce_custom_swatch_height)) { echo $woocommerce_custom_swatch_height; } ?>" >
			<span><?php  echo esc_html__('px','color-image-variation-swatches-for-woocommerce'); ?></span>
		</td>
	</tr>

	<tr>
		<td width="50%"><label><?php  echo esc_html__('Product page custom swatches width','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_custom_swatch_width_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_custom_swatch_width]" value="<?php if (isset($woocommerce_custom_swatch_width)) { echo $woocommerce_custom_swatch_width; } ?>" >
			<span><?php  echo esc_html__('px','color-image-variation-swatches-for-woocommerce'); ?></span>
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Limit display of number of swatches on single product page','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="woocommerce_enable_shop_show_more_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_enable_shop_show_more]" value="no">
			<input type="checkbox" class="woocommerce_enable_shop_show_more_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_enable_shop_show_more]" value="yes" <?php if (isset($woocommerce_enable_shop_show_more) && ($woocommerce_enable_shop_show_more == "yes")) { echo 'checked'; } ?>>
			<p><?php  echo esc_html__('Check this if you have lot of options for attribute and you only want to show some them while there will a show more link which shows all options.','color-image-variation-swatches-for-woocommerce'); ?></p>
		</td>
	</tr>

	<tr style="<?php if (isset($woocommerce_enable_shop_show_more) && ($woocommerce_enable_shop_show_more == "no")) { echo 'display:none;'; } else { echo 'display:table-row;'; } ?>">
		<td width="50%"><label><?php  echo esc_html__('Number of swatches to show','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_show_swatches_number_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_show_swatches_number]" value="<?php if (isset($woocommerce_show_swatches_number)) { echo $woocommerce_show_swatches_number; } ?>" >
			
		</td>
	</tr>

	<tr style="<?php if (isset($woocommerce_enable_shop_show_more) && ($woocommerce_enable_shop_show_more == "no")) { echo 'display:none;'; } else { echo 'display:table-row;'; } ?>">
		<td width="50%"><label><?php  echo esc_html__('Show more text','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="50%">
			<input type="text" class="woocommerce_show_more_text_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[woocommerce_show_more_text]" value="<?php if (isset($woocommerce_show_more_text)) { echo $woocommerce_show_more_text; } ?>" >
			<p><?php  echo esc_html__('{remaining_count} - number of swatches that will show upon clicking show more button.','color-image-variation-swatches-for-woocommerce'); ?></p>
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Out of Stock options behavior','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<select class="wcva_outofstock_options_behavior_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[wcva_outofstock_options_behavior]">
				<option value="01" <?php if (isset($wcva_outofstock_options_behavior) && (($wcva_outofstock_options_behavior == 01))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Default - do not cross out outofstock options','color-image-variation-swatches-for-woocommerce'); ?>						
				</option>
				<option value="02" <?php if (isset($wcva_outofstock_options_behavior) && (($wcva_outofstock_options_behavior == 02))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Crossout outofstock options','color-image-variation-swatches-for-woocommerce'); ?>
				</option>
			</select>		
		</td>
	</tr>

	<tr>
		<td width="30%"><label><?php  echo esc_html__('Unavailable options behavior','color-image-variation-swatches-for-woocommerce'); ?></label> 
		</td>
		<td width="70%">
			<select class="wcva_disable_unavailable_options_input" name="<?php  echo esc_html__($this->wcva_product_settings); ?>[wcva_disable_unavailable_options]">
				<option value="01" <?php if (isset($wcva_disable_unavailable_options) && (($wcva_disable_unavailable_options == 01))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Default - do not disable or hide unavailable options','color-image-variation-swatches-for-woocommerce'); ?>						
				</option>
				<option value="02" <?php if (isset($wcva_disable_unavailable_options) && (($wcva_disable_unavailable_options == 02))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Disable unavailable options','color-image-variation-swatches-for-woocommerce'); ?>
				</option>
				<option value="03" <?php if (isset($wcva_disable_unavailable_options) && (($wcva_disable_unavailable_options == 03))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Hide unavailable options','color-image-variation-swatches-for-woocommerce'); ?>
				</option>
			</select>		
		</td>
	</tr>


</table>