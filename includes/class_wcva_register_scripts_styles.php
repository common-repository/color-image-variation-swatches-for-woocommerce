<?php
class wcva_register_style_scripts {

   public function __construct() {
       add_action( 'wp_enqueue_scripts', array($this,'wcva_register_my_scripts' ));
       add_action( 'wp_enqueue_scripts', array($this,'wcva_register_my_scripts_quick_view' ));
   }


      public function wcva_register_my_scripts_quick_view() {

   	    if (wcva_quick_view_mode == "on") {

   	    	global $post,$product;
        
  

            $product_settings                    = get_option('wcva_product_settings');



            wp_deregister_script('yith-wcqv-frontend'); 
            wp_dequeue_script ('yith-wcqv-frontend'); 

            wp_register_script( 'yith-wcqv-frontend', wcva_PLUGIN_URL . 'assets/js/frontend-quickview.js' ,array( 'jquery','powerTip'));


	   
       
            if (isset($product_settings['woocommerce_wcva_swatch_tooltip'])) {
    	        $woocommerce_wcva_swatch_tooltip  = $product_settings['woocommerce_wcva_swatch_tooltip'];
            } else {
    	        $woocommerce_wcva_swatch_tooltip  = get_option('woocommerce_wcva_swatch_tooltip');
            }

            if (isset($product_settings['wcva_disable_unavailable_options'])) {
    	        $wcva_disable_unavailable_options  = $product_settings['wcva_disable_unavailable_options'];
            } else {
    	        $wcva_disable_unavailable_options  = get_option('wcva_disable_unavailable_options');
            }

            $wcva_swatch_behaviour = isset($wcva_disable_unavailable_options) ? $wcva_disable_unavailable_options : 01;

	    
	        $wcva_disable_click_behavior         = get_option('wcva_disable_click_behavior','01');

	        if (isset($product_settings['wcva_outofstock_options_behavior'])) {
    	        $wcva_outofstock_options_behavior  = $product_settings['wcva_outofstock_options_behavior'];
            } else {
    	        $wcva_outofstock_options_behavior  = get_option('wcva_outofstock_options_behavior');
            }

            $wcva_outofstock_options_behavior = isset($wcva_outofstock_options_behavior) ? $wcva_outofstock_options_behavior : 01;

	    

	        $woo_version                         =  wcva_get_woo_version_number();
	        $iPod                                = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $iPhone                              = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
            $iPad                                = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

        if (isset($product_settings['woocommerce_wcva_disableios_tooltip'])) {
    	    $woocommerce_wcva_disableios_tooltip  = $product_settings['woocommerce_wcva_disableios_tooltip'];
        } else {
    	    $woocommerce_wcva_disableios_tooltip  = get_option('woocommerce_wcva_disableios_tooltip');
        }

        $use_description_tooltip          = isset($product_settings['use_description_tooltip']) ? $product_settings['use_description_tooltip'] : "no";


        $use_hoverimage_tooltip          = isset($product_settings['use_hoverimage_tooltip']) ? $product_settings['use_hoverimage_tooltip'] : "no";

        $woocommerce_hover_tooltip_width = isset($product_settings['woocommerce_hover_tooltip_width']) && ($product_settings['woocommerce_hover_tooltip_width'] != "") ? $product_settings['woocommerce_hover_tooltip_width'] : 100;




        $woocommerce_hover_tooltip_height = isset($product_settings['woocommerce_hover_tooltip_height']) && ($product_settings['woocommerce_hover_tooltip_height'] != "") ? $product_settings['woocommerce_hover_tooltip_height'] : 100;
       

        $wcva_selected_text_option = isset($product_settings['wcva_selected_text_option']) && ($product_settings['wcva_selected_text_option'] != "") ? $product_settings['wcva_selected_text_option'] : 01;

        

	    if (isset($product_settings['woocommerce_show_selected_attribute_name'])) {
    	    $woocommerce_show_selected_attribute_name  = $product_settings['woocommerce_show_selected_attribute_name'];
        } else {
    	    $woocommerce_show_selected_attribute_name  = get_option('woocommerce_show_selected_attribute_name' , "yes");
        }

	   $cross_outofstock = "no";
       $wcva_disable_outofstock_options = "no";
	   
	   $wcva_current_theme                  =  wp_get_theme(); 
	   
	    if (isset($woocommerce_wcva_disableios_tooltip) && $woocommerce_wcva_disableios_tooltip == "yes" && ( $iPod || $iPhone || $iPad)) {
			  $woocommerce_wcva_swatch_tooltip ="no";
		}
        
        if (isset($wcva_swatch_behaviour)	&& ($wcva_swatch_behaviour == "02")) {
		      $wcva_disable_options = "yes";
		      $wcva_hide_options    = "no";
	    } elseif (isset($wcva_swatch_behaviour)	&& ($wcva_swatch_behaviour == "03")) {
              $wcva_disable_options = "yes";
              $wcva_hide_options    = "yes";
	    } else {
		      $wcva_disable_options ="no";
		      $wcva_hide_options    ="no";
	    }


	    if (isset($wcva_outofstock_options_behavior)	&& ($wcva_outofstock_options_behavior == "02")) {
		    $cross_outofstock = "yes";
		      
	    } elseif (isset($wcva_outofstock_options_behavior)	&& ($wcva_outofstock_options_behavior == "03")) {
            $cross_outofstock = "yes";
            $wcva_disable_outofstock_options = "yes";
	    } else {
	    	$cross_outofstock = "no";
            $wcva_disable_outofstock_options = "no";
	    }


	   
	   
	   
       if ( is_product()  ) {
	       
		 $product            = wc_get_product($post->ID);
		 $product_type       = $product->get_type();
		 $displaytypenumber = wcva_return_displaytype_number($post,$product);
       
	   } elseif  ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) {
		   
		 $product            = wc_get_product($post->ID);
		 $product_type       = get_post_type($post->ID);
		 $displaytypenumber  = wcva_return_displaytype_number($post,$product);
		   
	   }
	   

	    
	  
	   wp_register_style( 'wcva-frontend', wcva_PLUGIN_URL . 'assets/css/front-end.css' );
	   wp_register_style( 'powerTip', wcva_PLUGIN_URL . 'assets/css/powerTip.css' );
      
	  $goahead=1;
	 
    if(isset($_SERVER['HTTP_USER_AGENT'])){
         $agent = $_SERVER['HTTP_USER_AGENT'];
      }
	  
	if (preg_match('/(?i)msie [5-8]/', $agent)) {
         $goahead=0;
     }
	 
	
	 
   

      
	   wp_register_script( 'product-frontend', wcva_PLUGIN_URL . 'assets/js/product-frontend.js' ,array( 'jquery','powerTip'), false, true);

	   
	   
	   
	   $wcva_localize = array(
	    'tooltip'            => $woocommerce_wcva_swatch_tooltip,
	    'desc_tooltip'       => $use_description_tooltip,
	    'hoverimage_tooltip' => $use_hoverimage_tooltip,
	    'woocommerce_hover_tooltip_width' => $woocommerce_hover_tooltip_width,
	    'woocommerce_hover_tooltip_height' => $woocommerce_hover_tooltip_height,
		'disable_options'    => $wcva_disable_options,
		'hide_options'       => $wcva_hide_options,
		'show_attribute'     => $woocommerce_show_selected_attribute_name,
		'wcva_selected_text_option' => $wcva_selected_text_option,
		'cross_outofstock'   => apply_filters('wcva_cross_outofstock_options', $cross_outofstock),
		'enable_click'       => apply_filters('wcva_enable_disabled_options_click', $wcva_disable_click_behavior),
		'disable_unselect'   => apply_filters('wcva_disable_unselect_on_click', 0),
		'disable_outofstock' => $wcva_disable_outofstock_options,
		'wc_version'         => wcva_get_woo_version_number()

	   );
	   
       wp_localize_script( 'product-frontend', 'wcva', $wcva_localize );
	  
   	   wp_register_script( 'powerTip', wcva_PLUGIN_URL . 'assets/js/powerTip.js' ,array( 'jquery'), false, true);
	   
	  
	
	

		
	    wp_enqueue_script('product-frontend'); 

	    wp_enqueue_script('yith-wcqv-frontend');
	     
		wp_deregister_script('wc-add-to-cart-variation'); 
        wp_dequeue_script ('wc-add-to-cart-variation'); 
		
		if  ($woo_version < 3.0) {
		    if ($woo_version < 2.5) {
				
	            wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation1.js' ,array( 'jquery'), false, true);
	            
		    } else {
			    wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation2.js' ,array( 'jquery', 'wp-util' ), false, true);
		    }
		} else {

                if (($wcva_current_theme == "Avada Child") || ($wcva_current_theme == "Avada")) { 
			        wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation4.js' ,array( 'jquery', 'wp-util' ), false, true);
			    } else {
			    	wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation3.js' ,array( 'jquery', 'wp-util' ), false, true);
			    }
		}
		
		wp_enqueue_script('wc-add-to-cart-variation'); 
	
	    
		wp_enqueue_style('wcva-frontend');
	   
	   if (isset($woocommerce_wcva_swatch_tooltip) && ($woocommerce_wcva_swatch_tooltip == "yes")) {
		  
		  
 		   
		  if (isset($woocommerce_wcva_disableios_tooltip) && $woocommerce_wcva_disableios_tooltip == "yes" && ( $iPod || $iPhone || $iPad)) {
			  wp_deregister_script('powerTip');
	          wp_deregister_style('powerTip');
		  } else {
			  wp_enqueue_script('powerTip');
	          wp_enqueue_style('powerTip');
		  }
		   
		      
	   
	   }
	    
	 }
	    
	}

   public function wcva_register_my_scripts() {
     global $post,$product;
        
        $displaytypenumber                   = 0;

        $product_settings                    = get_option('wcva_product_settings');

	   
       
        if (isset($product_settings['woocommerce_wcva_swatch_tooltip'])) {
    	    $woocommerce_wcva_swatch_tooltip  = $product_settings['woocommerce_wcva_swatch_tooltip'];
        } else {
    	    $woocommerce_wcva_swatch_tooltip  = get_option('woocommerce_wcva_swatch_tooltip');
        }

        if (isset($product_settings['wcva_disable_unavailable_options'])) {
    	    $wcva_disable_unavailable_options  = $product_settings['wcva_disable_unavailable_options'];
        } else {
    	    $wcva_disable_unavailable_options  = get_option('wcva_disable_unavailable_options');
        }

        $wcva_swatch_behaviour = isset($wcva_disable_unavailable_options) ? $wcva_disable_unavailable_options : 01;

	    
	    $wcva_disable_click_behavior         = get_option('wcva_disable_click_behavior','01');

	    if (isset($product_settings['wcva_outofstock_options_behavior'])) {
    	    $wcva_outofstock_options_behavior  = $product_settings['wcva_outofstock_options_behavior'];
        } else {
    	    $wcva_outofstock_options_behavior  = get_option('wcva_outofstock_options_behavior');
        }

        $wcva_outofstock_options_behavior = isset($wcva_outofstock_options_behavior) ? $wcva_outofstock_options_behavior : 01;

	    

	   $woo_version                         =  wcva_get_woo_version_number();
	   $iPod                                = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
       $iPhone                              = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
       $iPad                                = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

        if (isset($product_settings['woocommerce_wcva_disableios_tooltip'])) {
    	    $woocommerce_wcva_disableios_tooltip  = $product_settings['woocommerce_wcva_disableios_tooltip'];
        } else {
    	    $woocommerce_wcva_disableios_tooltip  = get_option('woocommerce_wcva_disableios_tooltip');
        }

        $use_description_tooltip          = isset($product_settings['use_description_tooltip']) ? $product_settings['use_description_tooltip'] : "no";

	    if (isset($product_settings['woocommerce_show_selected_attribute_name'])) {
    	    $woocommerce_show_selected_attribute_name  = $product_settings['woocommerce_show_selected_attribute_name'];
        } else {
    	    $woocommerce_show_selected_attribute_name  = get_option('woocommerce_show_selected_attribute_name' , "yes");
        }

	   $cross_outofstock = "no";
       $wcva_disable_outofstock_options = "no";
	   
	   $wcva_current_theme                  =  wp_get_theme(); 
	   
	    if (isset($woocommerce_wcva_disableios_tooltip) && $woocommerce_wcva_disableios_tooltip == "yes" && ( $iPod || $iPhone || $iPad)) {
			  $woocommerce_wcva_swatch_tooltip ="no";
		}
        
        if (isset($wcva_swatch_behaviour)	&& ($wcva_swatch_behaviour == "02")) {
		      $wcva_disable_options = "yes";
		      $wcva_hide_options    = "no";
	    } elseif (isset($wcva_swatch_behaviour)	&& ($wcva_swatch_behaviour == "03")) {
              $wcva_disable_options = "yes";
              $wcva_hide_options    = "yes";
	    } else {
		      $wcva_disable_options ="no";
		      $wcva_hide_options    ="no";
	    }


	    if (isset($wcva_outofstock_options_behavior)	&& ($wcva_outofstock_options_behavior == "02")) {
		    $cross_outofstock = "yes";
		      
	    } elseif (isset($wcva_outofstock_options_behavior)	&& ($wcva_outofstock_options_behavior == "03")) {
            $cross_outofstock = "yes";
            $wcva_disable_outofstock_options = "yes";
	    } else {
	    	$cross_outofstock = "no";
            $wcva_disable_outofstock_options = "no";
	    }


	   
	   
	   
       if ( is_product()  ) {
	       
		 $product            = wc_get_product($post->ID);
		 $product_type       = $product->get_type();
		 $displaytypenumber = wcva_return_displaytype_number($post,$product);
       
	   } elseif  ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) {
		   
		 $product            = wc_get_product($post->ID);
		 $product_type       = get_post_type($post->ID);
		 $displaytypenumber  = wcva_return_displaytype_number($post,$product);
		   
	   }
	   

	    
	  
	   wp_register_style( 'wcva-frontend', wcva_PLUGIN_URL . 'assets/css/front-end.css' );
	   wp_register_style( 'powerTip', wcva_PLUGIN_URL . 'assets/css/powerTip.css' );
      
	  $goahead=1;
	 
    if(isset($_SERVER['HTTP_USER_AGENT'])){
         $agent = $_SERVER['HTTP_USER_AGENT'];
      }
	  
	if (preg_match('/(?i)msie [5-8]/', $agent)) {
         $goahead=0;
     }
	 
	
	 
   
    if (($displaytypenumber >0) && ($goahead == 1) ) {
      
	   wp_register_script( 'product-frontend', wcva_PLUGIN_URL . 'assets/js/product-frontend.js' ,array( 'jquery','powerTip'), false, true);
	   
	   
	   $wcva_localize = array(
	    'tooltip'            => $woocommerce_wcva_swatch_tooltip,
	    'desc_tooltip'       => $use_description_tooltip,
		'disable_options'    => $wcva_disable_options,
		'hide_options'       => $wcva_hide_options,
		'show_attribute'     => $woocommerce_show_selected_attribute_name,
		'quick_view'         => wcva_quick_view_mode,
		'cross_outofstock'   => apply_filters('wcva_cross_outofstock_options', $cross_outofstock),
		'enable_click'       => apply_filters('wcva_enable_disabled_options_click', $wcva_disable_click_behavior),
		'disable_unselect'   => apply_filters('wcva_disable_unselect_on_click', 0),
		'disable_outofstock' => $wcva_disable_outofstock_options,
		'wc_version'         => wcva_get_woo_version_number()

	   );
	   
       wp_localize_script( 'product-frontend', 'wcva', $wcva_localize );
	  
   	   wp_register_script( 'powerTip', wcva_PLUGIN_URL . 'assets/js/powerTip.js' ,array( 'jquery'), false, true);
	   
	  
	}
	
	if ( ((is_product()) && ($product_type == "variable")) || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) {
	   if (($displaytypenumber >0) && ($goahead == 1)) {
		
	    wp_enqueue_script('product-frontend'); 
		wp_deregister_script('wc-add-to-cart-variation'); 
        wp_dequeue_script ('wc-add-to-cart-variation'); 
		
		if  ($woo_version < 3.0) {
		    if ($woo_version < 2.5) {
				
	            wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation1.js' ,array( 'jquery'), false, true);
	            
		    } else {
			    wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation2.js' ,array( 'jquery', 'wp-util' ), false, true);
		    }
		} else {

                if (($wcva_current_theme == "Avada Child") || ($wcva_current_theme == "Avada")) { 
			        wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation4.js' ,array( 'jquery', 'wp-util' ), false, true);
			    } else {
			    	wp_register_script( 'wc-add-to-cart-variation', wcva_PLUGIN_URL . 'assets/js/add-to-cart-variation3.js' ,array( 'jquery', 'wp-util' ), false, true);
			    }
		}
		
		wp_enqueue_script('wc-add-to-cart-variation'); 
	
	    
		wp_enqueue_style('wcva-frontend');
	   
	   if (isset($woocommerce_wcva_swatch_tooltip) && ($woocommerce_wcva_swatch_tooltip == "yes")) {
		  
		  
 		   
		  if (isset($woocommerce_wcva_disableios_tooltip) && $woocommerce_wcva_disableios_tooltip == "yes" && ( $iPod || $iPhone || $iPad)) {
			  wp_deregister_script('powerTip');
	          wp_deregister_style('powerTip');
		  } else {
			  wp_enqueue_script('powerTip');
	          wp_enqueue_style('powerTip');
		  }
		   
		      
	   
	   }
	    
	 }
	    
	}
	}
	
   }

new wcva_register_style_scripts();



?>
