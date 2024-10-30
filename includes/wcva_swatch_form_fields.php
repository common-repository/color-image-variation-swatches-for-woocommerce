<?php
class wcva_swatch_form_fields {

	 

	 /*
	  * Load colored select
	  * since 1.0.0
	  */
     public function wcva_load_colored_select($product,$name,$options,$_coloredvariables,$newvalues,$selected_value,$extra,$attribute_size) {  
	
     	$variations    =  $product->get_available_variations();
     	$productid     =  $product->get_id();
     	$stock_class   =  '';
     	$cross_outofstock = 'no';
     	$cross_outofstock = apply_filters('wcva_cross_outofstock_options', $cross_outofstock);

     	if ($attribute_size == 1) {
     		$instock_array =  $this->get_instock_array($variations,$name);
     	}

            


     	if ( is_array( $options ) ) {

     		?> 
     		<div class="attribute-swatch" attribute-index="">
     			<?php

     			if ( taxonomy_exists( $name ) ) {


     				$terms = wc_get_product_terms( $productid, $name, array( 'fields' => 'all' ) );

     				$count = count($terms);

     				foreach ( $terms as $term ) {

     					if ( ! in_array( $term->slug, $options ) ) continue; { 

     						if (isset($instock_array) ) {

     							if (in_array($term->slug,$instock_array) && ($attribute_size == 1) ) {
     								$stock_class= '';
     							} elseif ($cross_outofstock == 'yes') {
     								$stock_class= 'wcvaoutofstock';
     							}

     						}

                         
     						$this->wcva_display_custom_display_type_global_attributes($selected_value,$name,$term,$_coloredvariables,$newvalues,$extra,$stock_class);
     					}
     				}

     			} else { 

     				$count = count($options);

     				foreach ( $options as $option ) { 

     					if (isset($instock_array) ) {

     						if (in_array($option,$instock_array) && ($attribute_size == 1) ) {
     							$stock_class= '';
     						} elseif ($cross_outofstock == 'yes') {
     							$stock_class= 'wcvaoutofstock';
     						}

     					}


                  
     					$this->wcva_display_custom_display_type_custom_attributes($selected_value,$name,$option,$_coloredvariables,$newvalues,$extra,$stock_class);

     				}
     			}

     			$product_settings = get_option('wcva_product_settings');

     			if (isset($product_settings['woocommerce_enable_shop_show_more'])) {
     				$woocommerce_enable_shop_show_more  = $product_settings['woocommerce_enable_shop_show_more'];
     			} else {
     				$woocommerce_enable_shop_show_more  = get_option('woocommerce_enable_shop_show_more');
     			}



     			if (isset($woocommerce_enable_shop_show_more) && $woocommerce_enable_shop_show_more == "yes") {
     				$this->load_show_more_link($name,$count);
     			}

     			?>
     		</div>
     		<?php
     	}
    } 
	
	
	 /**
	  * This is entire swatch template when global values are chosen as display type
	  * Single templte values are rendered inside this
	  * since 1.0.0
	  */
	public function wcva_load_colored_select2($product,$name,$options,$newvalues,$selected_value,$attribute_size) {  

		$variations    =  $product->get_available_variations();
		$productid     =  $product->get_id();
		$stock_class   =  '';
		$cross_outofstock = 'no';
		$cross_outofstock = apply_filters('wcva_cross_outofstock_options', $cross_outofstock);

		if ($attribute_size == 1) {
			$instock_array =  $this->get_instock_array($variations,$name);
		}

		if ( is_array( $options ) ) {

			?> 
			<div class="attribute-swatch" attribute-index="">
				<?php
				if ( taxonomy_exists( $name ) ) {



					$terms = wc_get_product_terms( $productid, $name, array( 'fields' => 'all' ) );

					$count = count($terms);

					foreach ( $terms as $term ) {

						if ( ! in_array( $term->slug, $options ) ) continue; { 

							if (isset($instock_array) ) {

								if (in_array($term->slug,$instock_array) && ($attribute_size == 1)) {
									$stock_class= '';
								} elseif ($cross_outofstock == 'yes') {
									$stock_class= 'wcvaoutofstock';
								}

							}

							$this->wcva_display_global_display_type_template($selected_value,$name,$term,$newvalues,$stock_class);
						}

					}

				} 


				$product_settings = get_option('wcva_product_settings');

				if (isset($product_settings['woocommerce_enable_shop_show_more'])) {
					$woocommerce_enable_shop_show_more  = $product_settings['woocommerce_enable_shop_show_more'];
				} else {
					$woocommerce_enable_shop_show_more  = get_option('woocommerce_enable_shop_show_more');
				}

				if (isset($woocommerce_enable_shop_show_more) && $woocommerce_enable_shop_show_more == "yes") {
					$this->load_show_more_link($name,$count);
				}


				?>
			</div>
			<?php
		}
	} 
	
	 /**
	  * This function returns template when display type is custom color/images and attributes are global
	  * For each attribute value
	  * since 1.0.2
	  */
	 public function wcva_display_custom_display_type_global_attributes($selected_value,$name,$option,$_coloredvariables,$newvalues,$extra,$stock_class){ 

	 	$globalthumbnail_id       = ''; 
	 	 
	 	$labelid                  =  sanitize_title( $name );
 	



	 	$global_settings   = get_option('wcva_global_settings');

	 	if (isset($global_settings['wcva_woocommerce_global_activation'])) {
	 		$wcva_global_activation = $global_settings['wcva_woocommerce_global_activation'];
	 	} else {
	 		$wcva_global_activation = get_option('wcva_woocommerce_global_activation');
	 	}

	 	if (isset($global_settings['values'])) {
	 		$wcva_global = $global_settings['values'];
	 	} else {
	 		$wcva_global = get_option('wcva_global');
	 	}

		foreach ($newvalues as $newvalue) {
			if (isset($newvalue->slug) && (strtolower($newvalue->slug) == strtolower($option->slug))) {

				$globalthumbnail_id 	    = absint( get_term_meta( $newvalue->term_id, 'thumbnail_id', true ) );
				$globaldisplay_type 	    = get_term_meta($newvalue->term_id, 'display_type', true );
				$globalcolor 	            = get_term_meta($newvalue->term_id, 'color', true );
				$globaltextblock 	        = get_term_meta($newvalue->term_id, 'textblock', true );
				$globaldesc 	            = $newvalue->description;
			}
		}
			 
		if (isset($extra['display_type']) && $extra['display_type']== "variationimage") {  
			global $product;

			$variations = $product->get_available_variations();

			foreach ($variations as $variation) {

				$attributes = $variation['attributes'];

				foreach ($attributes as $attribute=>$value) {
					if ((rawurldecode($attribute) == 'attribute_'.$name.'') && ($value == $option->slug)) {
						$url = $variation['image']['thumb_src'];
                        
					}
				}
			}


		} elseif ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option->slug]['image']))) {
	                  
					$thumb_id = $_coloredvariables[$name]['values'][$option->slug]['image']; 
					
					$url = wp_get_attachment_thumb_url( $thumb_id ); 
		       
		} elseif (isset($globalthumbnail_id)) {
		          
				    $thumb_id=$globalthumbnail_id; 
					
					$url = wp_get_attachment_thumb_url( $globalthumbnail_id );
					
		}
			
			

			 
			
			 
		if (isset($extra['display_type']) && $extra['display_type']== "variationimage") {
				 
				$attrdisplaytype  = "Image";
			 
		} elseif ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option->slug]['type']))) {
	             
				$attrdisplaytype = $_coloredvariables[$name]['values'][$option->slug]['type'];
		          
		} elseif (isset($globaldisplay_type)) {
		         
				 $attrdisplaytype = $globaldisplay_type;
		} else {

			  $attrdisplaytype = 'textblock';

		}



			
		  
		if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option->slug]['color']))) {
	             
				    $attrcolor = $_coloredvariables[$name]['values'][$option->slug]['color'];
		            
		} elseif (isset($globalcolor)) {
		      
			        $attrcolor = $globalcolor;
		}
			 
		if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option->slug]['textblock']))) {

			$attrtextblock = $_coloredvariables[$name]['values'][$option->slug]['textblock'];
			

		} elseif (isset($globaltextblock) && ($globaltextblock != '')) {

			$attrtextblock = $globaltextblock;
			
		} else {
			$attrtextblock = apply_filters( 'woocommerce_variation_option_name', $option->name );

		}


		
			    
	         
		if (isset($selected_value) && ($selected_value == esc_attr( sanitize_title( $option->slug ) ) ))  {

			$labelclass="selectedswatch";
		} else {

			$labelclass="wcvaswatchlabel";
		}				 
			 
		if (isset($_coloredvariables[$name]['size'])) {

			$thumbsize   = $_coloredvariables[$name]['size']; 
			$displaytype = $_coloredvariables[$name]['displaytype']; 
			$showname    = $_coloredvariables[$name]['show_name'];

		} elseif ((isset($wcva_global_activation)) && ($wcva_global_activation == "yes")) 
		{
			$thumbsize   = $wcva_global[$name]['size']; 
			$displaytype = $wcva_global[$name]['displaytype']; 
			$showname    = $wcva_global[$name]['show_name'];

		} else {

			$thumbsize   = 'small';
			$displaytype = 'square';
			$showname    = 'no';
		}

		if (isset($thumbsize) && ($thumbsize == "custom")) {

			if (isset($_coloredvariables[$name]['customheight']) && ($_coloredvariables[$name]['customheight'] != '')) {
				$imageheight = $_coloredvariables[$name]['customheight'];
			} else {
				$imageheight      = $this->wcva_get_image_height($thumbsize);

			}

			if (isset($_coloredvariables[$name]['customwidth']) && ($_coloredvariables[$name]['customwidth'] != '')) {
				$imagewidth = $_coloredvariables[$name]['customwidth'];
			} else {
				$imagewidth      = $this->wcva_get_image_width($thumbsize);

			}



		} else {

			$imageheight      = $this->wcva_get_image_height($thumbsize); 

			$imagewidth       = $this->wcva_get_image_width($thumbsize);

		}


		$show_price = isset($_coloredvariables[$name]['show_price']) ? $_coloredvariables[$name]['show_price'] : "no";


		if ($show_price == "yes") {

	 		global $product;

	 		$option_slug = $option->slug;

	 		$matching_variation_id = wcva_find_matching_variation_price_from_attribute($product,$name,$option_slug);

	 		$price_template = wc_price($matching_variation_id);

	 		$textblock_label = ''.$attrtextblock.' - <span class="wcva_textblock_pricing">'.$price_template.'</span>';

	 	} else {

	 		$textblock_label = $attrtextblock;

	 	}

			    
		                      
					
					
	    $url              = apply_filters('wcva_attribute_swatch_image', $url , $name , $option );
					
		$attrdisplaytype  = apply_filters('wcva_attribute_swatch_display_type', $attrdisplaytype );
				
		$spanwidth        = $imagewidth + 6;


		if (isset($globaldesc) && ($globaldesc != "")) {
			$desct_html = 'description = "'.$globaldesc.'"';
		} else {
			$desct_html = '';
		}

		
	            
		?>
		<div class="swatchinput">

			<?php  


			switch($attrdisplaytype) {
				case "Color":
				?>

				<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>"  class="attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>" selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="background-color:<?php if (isset($attrcolor)) { echo $attrcolor; } else { echo '#ffffff'; } ?>; width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
				<?php if (isset($showname) && ($showname == "yes")) { ?>
					<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
				<?php }

				break;

				case "Image":
				?>

				<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>"  class="wcva_image_label attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="background-image: url('<?php if (isset($url)) { echo $url; } ?>');  width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
				<?php if (isset($showname) && ($showname == "yes")) { ?>
					<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
				<?php }

				break;

				case "textblock":

				?>

				<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="min-width:<?php echo $imagewidth; ?>px; ">

					<?php echo $textblock_label; ?>

				</label>
				<?php if (isset($showname) && ($showname == "yes")) { ?>
					<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
				<?php }

				break;

				default:

				?>

				<label <?php echo $desct_html; ?>  selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="min-width:<?php echo $imagewidth; ?>px; ">

					<?php echo $textblock_label; ?>

				</label>

				<?php if (isset($showname) && ($showname == "yes")) { ?>
					<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
				<?php }

				break;
			} ?>

		</div>	  
 	                   
	<?php }
	
	
	/**
	  * This function returns template when display type is custom color/images and attributes are custom
	  * For each attribute value
	  * since 1.0.2
	  */
	public function wcva_display_custom_display_type_custom_attributes($selected_value,$name,$option,$_coloredvariables,$newvalues,$extra,$stock_class){ 
	  
		$globalthumbnail_id       = ''; 
		   
		$labelid                  = sanitize_title( $name );
		
       

		foreach ($newvalues as $newvalue) {
			if (isset($newvalue->slug) && (strtolower($newvalue->slug) == strtolower($option))) {

				$globalthumbnail_id   	= absint( get_term_meta( $newvalue->term_id, 'thumbnail_id', true ) );
				$globaldisplay_type 	    = get_term_meta($newvalue->term_id, 'display_type', true );
				$globalcolor 	        = get_term_meta($newvalue->term_id, 'color', true );
				$globaltextblock 	    = get_term_meta($newvalue->term_id, 'textblock', true );

			}

		}


		 $attrtextblock = $option;

			
	         
		if (isset($extra['display_type']) && $extra['display_type']== "variationimage") {
			global $product;

			$variations = $product->get_available_variations();

			foreach ($variations as $variation) {

				$attributes = $variation['attributes'];



				foreach ($attributes as $attribute => $value) {


					if ((rawurldecode($attribute) == 'attribute_'.strtolower($labelid).'') && ($value == $option)) {

						$url = $variation['image']['thumb_src'];


					}

				}
			}


		} elseif ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['image']))) {

			$thumb_id = $_coloredvariables[$name]['values'][$option]['image']; 

			$url = wp_get_attachment_thumb_url( $thumb_id ); 

		} elseif (isset($globalthumbnail_id)) {

			$thumb_id=$globalthumbnail_id; 

			$url = wp_get_attachment_thumb_url( $globalthumbnail_id );

		}

        $attrdisplaytype = 'textblock';

		  
		if (isset($extra['display_type']) && $extra['display_type']== "variationimage") {

			$attrdisplaytype  = "Image";

		} elseif ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['type']))) {

			$attrdisplaytype = $_coloredvariables[$name]['values'][$option]['type'];

		} elseif (isset($globaldisplay_type)) {

			$attrdisplaytype = $globaldisplay_type;
		}
		  
		if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['color']))) {
			$attrcolor = $_coloredvariables[$name]['values'][$option]['color'];
		} elseif (isset($globalcolor)) {
			$attrcolor = $globalcolor;
		}

		if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['textblock']))) {

			$attrtextblock = $_coloredvariables[$name]['values'][$option]['textblock'];

		} elseif (isset($globaltextblock)) {

			$attrtextblock = $globaltextblock;
		}

		if (isset($selected_value) && $selected_value == $option)  {
			$labelclass="selectedswatch";
		} else {
			$labelclass="wcvaswatchlabel";
		}

		if (isset($_coloredvariables[$name]['size'])) {
			$thumbsize   = $_coloredvariables[$name]['size']; 
			$displaytype = $_coloredvariables[$name]['displaytype']; 
			$showname = $_coloredvariables[$name]['show_name'];
		} else {
			$thumbsize   = 'small';
			$displaytype = 'square';
			$showname = 'no';
		}

		if (isset($thumbsize) && ($thumbsize == "custom")) {

			if (isset($_coloredvariables[$name]['customheight']) && ($_coloredvariables[$name]['customheight'] != '')) {
				$imageheight = $_coloredvariables[$name]['customheight'];
			} else {
				$imageheight      = $this->wcva_get_image_height($thumbsize);

			}

			if (isset($_coloredvariables[$name]['customwidth']) && ($_coloredvariables[$name]['customwidth'] != '')) {
				$imagewidth = $_coloredvariables[$name]['customwidth'];
			} else {
				$imagewidth      = $this->wcva_get_image_width($thumbsize);

			}



		} else {

			$imageheight      = $this->wcva_get_image_height($thumbsize); 

			$imagewidth       = $this->wcva_get_image_width($thumbsize);

		} 


		$url              = apply_filters('wcva_attribute_swatch_image', $url, $name , $option );
		$attrdisplaytype  = apply_filters('wcva_attribute_swatch_display_type', $attrdisplaytype );
		$spanwidth        = $imagewidth + 6;

		$show_price = isset($_coloredvariables[$name]['show_price']) ? $_coloredvariables[$name]['show_price'] : "no";


		if ($show_price == "yes") {

			global $product;

			$matching_variation_id = wcva_find_matching_variation_price_from_attribute($product,$labelid,$option);

			$price_template = wc_price($matching_variation_id);

			$textblock_label = ''.$attrtextblock.' - <span class="wcva_textblock_pricing">'.$price_template.'</span>';

		} else {

			$textblock_label = $attrtextblock;

		}

	   
	
	    ?>          
	    <div class="swatchinput">


	    	<?php  

	    	switch($attrdisplaytype) {
	    		case "Color":
	    		?>
	    		<label  selectid="<?php echo rawurldecode($labelid); ?>" class="attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( $option  ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( $option  ); ?>" selectedtext="<?php echo rawurldecode($option); ?>" title="<?php echo rawurldecode($option); ?>" style="background-color:<?php if (isset($attrcolor)) { echo $attrcolor; } else { echo '#ffffff'; } ?>; width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo $option; ?></span>
	    		<?php }
	    		break;


	    		case "Image":
	    		?>
	    		<label  selectid="<?php echo rawurldecode($labelid); ?>"  class="wcva_image_label attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( $option  ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( $option  ); ?>" selectedtext="<?php echo rawurldecode($option); ?>" title="<?php echo rawurldecode($option); ?>" style="background-image: url('<?php if (isset($url)) { echo $url; } ?>'); width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo $option; ?></span>
	    		<?php }
	    		break;

	    		case "textblock":
	    		?>

	    		<label  selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( $option  ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( $option  ); ?>"  selectedtext="<?php echo rawurldecode($option); ?>" title="<?php echo rawurldecode($option); ?>" style="min-width:<?php echo $imagewidth; ?>px; ">
	    			<?php echo $textblock_label; ?>

	    		</label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo $option; ?></span>
	    		<?php }

	    		break;

	    		default:
	    		?>

	    		<label  selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( $option  ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( $option  ); ?>"  selectedtext="<?php echo rawurldecode($option); ?>" title="<?php echo rawurldecode($option); ?>" style="min-width:<?php echo $imagewidth; ?>px; ">
	    			<?php echo $textblock_label; ?>

	    		</label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo $option; ?></span>
	    		<?php }

	    		break;


	    	} ?>

	    </div>	  
 	                   
	<?php }
	
	
    /**
	 * This function returns template when display type is Global Values
	 * For each attribute value
	 * since 1.0.2
	 */
    public function wcva_display_global_display_type_template($selected_value,$name,$option,$newvalues,$stock_class){ 

    	$globalthumbnail_id       = ''; 
    	$globaldisplay_type       = 'textblock';
    	$globalcolor              =  'grey';     
    	$labelid                  = sanitize_title( $name );
    	$global_settings          = get_option('wcva_global_settings');

    	if (isset($global_settings['wcva_woocommerce_global_activation'])) {
    		$wcva_global_activation = $global_settings['wcva_woocommerce_global_activation'];
    	} else {
    		$wcva_global_activation = get_option('wcva_woocommerce_global_activation');
    	}
    	if (isset($global_settings['values'])) {
    		$wcva_global = $global_settings['values'];
    	} else {
    		$wcva_global = get_option('wcva_global');
    	}



    	foreach ($newvalues as $newvalue) {
    		if (isset($newvalue->slug) && (strtolower($newvalue->slug) == strtolower($option->slug))) {

    			$globalthumbnail_id 	    = absint( get_term_meta( $newvalue->term_id, 'thumbnail_id', true ) );
    			$globaldisplay_type 	    = get_term_meta($newvalue->term_id, 'display_type', true );


    			if (isset($globaldisplay_type) && ($globaldisplay_type != '')) {
    				$globaldisplay_type  = $globaldisplay_type;
    			} else {
    				$globaldisplay_type      = "textblock";
    			}


                $globaldesc               = $newvalue->description;

    			$globalcolor 	          = get_term_meta($newvalue->term_id, 'color', true );
    			$globaltextblock 	      = get_term_meta($newvalue->term_id, 'textblock', true );

    			if (isset($globaltextblock) && ($globaltextblock != '')) {
    				$globaltextblock         = $globaltextblock;
    			} else {
    				$globaltextblock         = get_term( $newvalue->term_id )->name;;
    			}
    		}
    	}
			 
	          
    	if (isset($globalthumbnail_id)) {

    		$thumb_id=$globalthumbnail_id; $url = wp_get_attachment_thumb_url( $globalthumbnail_id );

    	}
			 
			
			 
		  
		if (isset($globaldisplay_type)) {
		         
		    $attrdisplaytype = $globaldisplay_type;
		} 

  
		if (isset($globalcolor)) {
		    	
		    $attrcolor = $globalcolor;
		}
		    
		if (isset($globaltextblock)) {

			$attrtextblock = $globaltextblock;
		}

		if (isset($selected_value) && ($selected_value == esc_attr( sanitize_title( $option->slug ) ) ))  {
			$labelclass="selectedswatch";
		} else {
			$labelclass="wcvaswatchlabel";
		}				 



		if ((isset($wcva_global_activation)) && ($wcva_global_activation == "yes")) {
			$thumbsize   = $wcva_global[$name]['size']; 
			$displaytype = $wcva_global[$name]['displaytype']; 
			$showname    = $wcva_global[$name]['show_name'];

		}


		$imageheight      = $this->wcva_get_image_height($thumbsize); 
		$imagewidth       = $this->wcva_get_image_width($thumbsize); 
		$url              = apply_filters('wcva_attribute_swatch_image', $url , $name , $option );
		$attrdisplaytype  = apply_filters('wcva_attribute_swatch_display_type', $attrdisplaytype );
		$spanwidth        = $imagewidth + 6;

		if (isset($globaldesc) && ($globaldesc != "")) {
			$desct_html = 'description = "'.$globaldesc.'"';
		} else {
			$desct_html = '';
		}
	            
	    ?>          
	    <div class="swatchinput">

	    	<?php  

	    	switch($attrdisplaytype) {
	    		case "Color":
	    		?>

	    		<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>"  class="attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="background-color:<?php if (isset($attrcolor)) { echo $attrcolor; } else { echo '#ffffff'; } ?>; font-size: 20px!important;font-weight: 500; width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
	    		<?php }
	    		break;

	    		case "Image":
	    		?>

	    		<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>"  class="wcva_image_label attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="background-image: url('<?php if (isset($url)) { echo $url; } ?>'); width:<?php echo $imagewidth; ?>px; height:<?php echo $imageheight; ?>px; "></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
	    		<?php }

	    		break;

	    		case "textblock":
	    		?>

	    		<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="min-width:<?php echo $imagewidth; ?>px; "><?php echo $attrtextblock; ?></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
	    		<?php }

	    		break;


	    		default:

	    		?>

	    		<label <?php echo $desct_html; ?> selectid="<?php echo rawurldecode($labelid); ?>" class="wcva_single_textblock attribute_<?php echo rawurldecode($labelid); ?>_<?php echo esc_attr( sanitize_title( $option->slug ) ); ?> <?php echo $labelclass; ?> <?php echo $stock_class; ?> <?php if ($displaytype == "round") { echo 'wcvaround'; } else { echo 'wcvasquare';} ?>" data-option="<?php echo esc_attr( sanitize_title( $option->slug ) ); ?>"  selectedtext="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" title="<?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?>" style="min-width:<?php echo $imagewidth; ?>px; "><?php echo $attrtextblock; ?></label>
	    		<?php if (isset($showname) && ($showname == "yes")) { ?>
	    			<span style="width:<?php echo $spanwidth; ?>px;" class="belowtext <?php echo $stock_class; ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $option->name ); ?></span>
	    		<?php }
	    		break;
	    	} ?>

	    </div>	  
 	                   
	<?php }
	
	/**
	 * Get Image Height
	 * since 1.0.0
	 */
	public function wcva_get_image_height($thumbsize) {

		$height=32;

		switch($thumbsize) {

			case "small":
			$height=32;
			break;


			case "extrasmall":
			$height=22;
			break;

			case "medium":
			$height=40;
			break;

			case "big":
			$height=60;
			break;

			case "extrabig":
			$height=90;
			break;

			case "custom":

			$product_settings   = get_option('wcva_product_settings');

			if (isset($product_settings['woocommerce_custom_swatch_height'])) {
				$woocommerce_custom_swatch_height  = $product_settings['woocommerce_custom_swatch_height'];
			} else {
				$woocommerce_custom_swatch_height  = get_option('woocommerce_custom_swatch_height');
			}

			$height = isset($woocommerce_custom_swatch_height) ? $woocommerce_custom_swatch_height : "32";
			

			
			break;

			default : 
			$height=32;


		}

		return $height;
	}
	 
	/**
	 * Get Image Width
	 * since 1.0.0
	 */
	public function wcva_get_image_width($thumbsize) {



		$width=32;

		switch($thumbsize) {

			case "small":
			$width=32;
			break;

			case "extrasmall":
			$width=22;
			break;

			case "medium":
			$width=40;
			break;

			case "big":
			$width=60;
			break;

			case "extrabig":
			$width=90;
			break;

			case "custom":

			$product_settings   = get_option('wcva_product_settings');

			if (isset($product_settings['woocommerce_custom_swatch_height'])) {
				$woocommerce_custom_swatch_width  = $product_settings['woocommerce_custom_swatch_width'];
			} else {
				$woocommerce_custom_swatch_width  = get_option('woocommerce_custom_swatch_width');
			}

			$width = isset($woocommerce_custom_swatch_width) ? $woocommerce_custom_swatch_width : "32";

			break;

			default : 
			$width=32;

		}

		return $width;
	}



	public function load_show_more_link($name,$count) {

		$product_settings = get_option('wcva_product_settings');

		if (isset($product_settings['woocommerce_show_swatches_number'])) {
    	    $woocommerce_show_swatches_number  = $product_settings['woocommerce_show_swatches_number'];
        } else {
    	    $woocommerce_show_swatches_number  = get_option('woocommerce_show_swatches_number');
        }

        $woocommerce_show_swatches_number = isset($woocommerce_show_swatches_number) ? $woocommerce_show_swatches_number : "5";

		
		if (isset($product_settings['woocommerce_show_more_text'])) {
    	    $woocommerce_show_more_text  = $product_settings['woocommerce_show_more_text'];
        } else {
    	    $woocommerce_show_more_text  = get_option('woocommerce_show_more_text');
        }
    
    
        $woocommerce_show_more_text = isset($woocommerce_show_more_text) ? $woocommerce_show_more_text : esc_html__('{remaining_count} more','color-image-variation-swatches-for-woocommerce');
        
		$different_count                   = $count - $woocommerce_show_swatches_number;
		$woocommerce_show_more_text        = preg_replace('/{remaining_count}/', $different_count, $woocommerce_show_more_text);
        
        ?>
            <a attribute="<?php echo $name; ?>" show-number="<?php echo $woocommerce_show_swatches_number; ?>" class="wcva_show_more_link"><?php echo $woocommerce_show_more_text; ?></a>
		<?php
	
	}

    /**
     * Returns instock array from variations in case of single attribute product
     * params @$variations - arrays of all product variations. 
     * params $attribute_slug - attribute slug
     * output $instock_array returns filterd list of options that are in stock
     */
	public function get_instock_array($variations,$attribute_slug) {

        $instock_array = array();

        
        
        

        if (isset($attribute_slug)) {

	  	    $attribute_slug           =  'attribute_'.$attribute_slug.'';
      
	    }


        foreach ($variations as $vkey => $variation) {
            

	        if ($variation['is_in_stock'] == 1) {

                if (isset($variation['attributes'][$attribute_slug])) {

	        	    
	        		
                        if (!in_array($attribute_slug, $instock_array))  {
                            $instock_array[] = $variation['attributes'][$attribute_slug];
                        }
                    
                    
                }

			}
        }

        
        return $instock_array;
        
	}
}

?>