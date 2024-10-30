<?php

   /*
    * returns displytypenumber - which decide weather to replace variable.php template or not
	* @param $product-global product variable
	* @param $post-global post variable
	*/
	
	function wcva_return_displaytype_number($post,$product = NULL) {
	   
	   
	    $displaytypenumber = 1;
	   

	  
	  return $displaytypenumber;
	}
	
	/**
	 * Extract product id from [product_page] shortcode.
	 *
	 * @param $post->post_content - post content
	 * @since 1.6.2
	 */
	
	function wcva_get_shortcode_product_id($post_content) {
		global $post;
		
        
     
        $regex_pattern = get_shortcode_regex();
        preg_match ('/'.$regex_pattern.'/s', $post->post_content, $regex_matches);
        if ($regex_matches[2] == 'product_page') :
       
            $attribureStr = str_replace (" ", "&", trim ($regex_matches[3]));
            $attribureStr = str_replace ('"', '', $attribureStr);

            //  Parse the attributes
            $defaults = array (
                'preview' => '1',
            );
            $attributes = wp_parse_args ($attribureStr, $defaults);

            if (isset ($attributes["id"])) :
                return $attributes["id"];
            endif;
           
        endif;
	
	}
	
	/**
	 * Output a list of variation attributes for use in the cart forms.
	 *
	 * @param array $args
	 * @since 2.4.0
	 */
	function wcva_dropdown_variation_attribute_options1( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'options'          => false,
			'attribute'        => false,
			'product'          => false,
			'selected' 	       => false,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'show_option_none' => esc_html__( 'Choose an option', 'woocommerce' )
		) );
		
		$show_hidden_dropdown  = apply_filters('wcva_show_hidden_dropdown', "no" );
		
		if (isset($show_hidden_dropdown)	&& ($show_hidden_dropdown == "yes")) {
		    $hidden_select_css="";
	    } else {
		    $hidden_select_css="display:none !important;";
	    }

		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];
		$name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
		$id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
		$class     = $args['class'];

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[ $attribute ];
		}

		echo '<select style="'. $hidden_select_css .'" id="' . esc_attr( rawurldecode($id) ) . '" class="wcva-single-select ' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

		if ( $args['show_option_none'] ) {
			echo '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
		}

		if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$product_id = $product->get_id();
				$terms = wc_get_product_terms( $product_id, $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
					}
				}
			} else {
				foreach ( $options as $option ) {
					// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
					$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
					echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
				}
			}
		}

		echo '</select>';
	}
	
	
	/**
	 * Output a list of variation attributes for use in the cart forms.
	 *
	 * @param array $args
	 * @since 2.4.0
	 */
	function wcva_dropdown_variation_attribute_options2( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'options'          => false,
			'attribute'        => false,
			'product'          => false,
			'selected' 	       => false,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'show_option_none' => esc_html__( 'Choose an option', 'woocommerce' )
		) );

		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];
		$name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
		$id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
		$class     = $args['class'];

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[ $attribute ];
		}

		echo '<select id="' . esc_attr( rawurldecode($id) ) . '" class="' . esc_attr( $class ) . ' wcva-standard-select" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

		if ( $args['show_option_none'] ) {
			echo '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
		}

		if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$product_id = $product->get_id();
				$terms      = wc_get_product_terms( $product_id, $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
					}
				}
			} else {
				foreach ( $options as $option ) {
					// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
					$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
					echo '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
				}
			}
		}

		echo '</select>';
	}
	
	

	
	/**
	  * This function determines weather plugin should load shop swatches assets/js/css file on current page. 
	  * Since version 2.2.2
	  * Used in Classes/class_shop_page_swatchs.php
	  */
	function wcva_load_shop_page_assets() {
	    $load_assests = "no";

	    $tex_check    = wcva_check_condition_assets();

	    if (isset($tex_check) && ($tex_check == "yes")) {
	    	$load_assests = "yes";
	    	return $load_assests;
	    } else {
	    	$load_assests = "no";
	    }
		
		
		if (is_cart() || is_product() || is_shop()  || is_page() || is_tax("pwb-brand") || is_tax("product-collection")) {
			
			$load_assests = "yes";
			
		} else {
			
			$load_assests = "no";
			
		}
		
		return $load_assests;
	}



    if ( ! function_exists( 'wcva_find_matching_variation_price_from_attribute' ) ) {

    /**
	 * Finds matching variation from attribute
	 * return variation id
	 * @access public
	 * @subpackage	Forms
	 */
        function wcva_find_matching_variation_price_from_attribute($product,$attribute_name,$option) {

        	

			$variations = $product->get_available_variations();

			foreach ($variations as $variation) {

				$attributes = $variation['attributes'];

				foreach ($attributes as $attribute=>$value) {
					if ((rawurldecode($attribute) == 'attribute_'.$attribute_name.'') && ($value == $option)) {
						$variation_price = $variation['display_price'];
                        
					}
				}
			}

			return $variation_price;

        }
    
    }

	/**
	  * This function checks if current texonomy allowed to load shop swatches assets or not. 
	  * Since version 3.5.0
	  * Used in Classes/class_shop_page_swatchs.php
	  */
	function wcva_check_condition_assets() {
		$load_assests = "no";

		$match_index  = 0;

		$default_texonomy = array(
			'product_cat' => esc_html__( 'product_cat', 'color-image-variation-swatches-for-woocommerce' ),
			'product_tag' => esc_html__( 'product_tag', 'color-image-variation-swatches-for-woocommerce' )
		);

		$shop_settings = get_option('wcva_shop_settings');


		if (isset($shop_settings['woocommerce_wcva_custom_texonomies'])) {
			$woocommerce_wcva_custom_texonomies  = $shop_settings['woocommerce_wcva_custom_texonomies'];
		} else {
			$woocommerce_wcva_custom_texonomies  = get_option('woocommerce_wcva_custom_texonomies');
		}



		$allowed_tax = isset($woocommerce_wcva_custom_texonomies) ? $woocommerce_wcva_custom_texonomies : $default_texonomy;
		
		
		
		
		if (isset($allowed_tax) && (is_array($allowed_tax))) {
			foreach ($allowed_tax as $fvalue) {
				if (is_tax( $fvalue )) {
					$match_index++;
				}
			}
		}
		
		

		if ($match_index > 0) {
			$load_assests = "yes";
			return $load_assests;
		}

		return $load_assests;
	}


	function wcva_startsWith ($string, $startString){
    	$len = strlen($startString);
    	return (substr($string, 0, $len) === $startString);
    }
   
?>