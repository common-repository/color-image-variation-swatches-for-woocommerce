<?php 
class wcva_global_values_per_attribute {
    
	public function __construct() {
	
	
	  add_action( 'admin_init', array($this,'wcva_setup_texonomy_based_fields' ));
	  add_action( 'created_term', array( $this, 'save_category_fields' ), 10, 3 );
      add_action( 'edit_term', array( $this, 'save_category_fields' ), 10, 3 );
	  add_action( 'admin_enqueue_scripts', array($this, 'wcva_register_scripts'));
	}
	
    public function wcva_register_scripts() {
	   
	   wp_register_script( 'wcva-term', ''.wcva_PLUGIN_URL.'assets/js/wcva-term.js' );
	   wp_register_style( 'wcva-term', ''.wcva_PLUGIN_URL.'assets/css/wcva-term.css' );
	   
	   $translation_array = array( 
		      'uploadimage'    => esc_html__( 'Choose an image' ,'color-image-variation-swatches-for-woocommerce'),
			  'useimage'       => esc_html__( 'Use Image' ,'color-image-variation-swatches-for-woocommerce'),
			  'placeholder'    => wedd_placeholder_img_src(),
		    );
       wp_localize_script( 'wcva-term', 'wcvaterm', $translation_array );
	  
    }
	
	public function wcva_setup_texonomy_based_fields(){
	   global $woocommerce;
	    $woo_version =  wcva_get_woo_version_number();
	
	    if ($woo_version <2.1) {
	     $createdattributes = $woocommerce->get_attribute_taxonomies();
	    } else {
	     $createdattributes=wc_get_attribute_taxonomies();
	    }
	
	    foreach ($createdattributes as $attribute) {
	
	       add_action( 'pa_'.$attribute->attribute_name.'_add_form_fields', array( $this, 'add_category_fields' ) );
           add_action( 'pa_'.$attribute->attribute_name.'_edit_form_fields', array( $this, 'edit_category_fields' ), 10, 2 );
	       add_filter( 'manage_edit-pa_'.$attribute->attribute_name.'_columns', array( $this, 'term_columns' ) );
           add_filter( 'manage_pa_'.$attribute->attribute_name.'_custom_column', array( $this, 'term_column' ), 10, 3 );
	    }
	}
	
	public function add_category_fields() {
	 wp_enqueue_media(); 
	 wp_enqueue_script('wp-color-picker');
     wp_enqueue_script( 'wcva-term' );
     wp_enqueue_style( 'wcva-term' );
	 wp_enqueue_style( 'wp-color-picker' );
		?>
	   
		<div class="" >
		
		    <label><?php echo esc_html__( 'Display Type', 'color-image-variation-swatches-for-woocommerce' ); ?></label>
			<select id="display_type" name="display_type">
				<option value="textblock"><?php echo esc_html__('Text Block','color-image-variation-swatches-for-woocommerce'); ?></option>
			    <option value="Color"><?php echo esc_html__('Color','color-image-variation-swatches-for-woocommerce'); ?></option>
			    <option value="Image"><?php echo esc_html__('Image','color-image-variation-swatches-for-woocommerce'); ?></option>
			</select>
			
			<br /><br />
            <div id="wcvacolorp" style="display:none;">
		        <label for="_chose_color"><span class="wcvaformfield"><?php echo esc_html__('Chose Color','color-image-variation-swatches-for-woocommerce'); ?></span></label> 
	            <input name="color" type="text" class="wcvaattributecolorselect" value="<?php if (isset($color)) { echo $color;} else { echo '#ffffff';}  ?>" data-default-color="#ffffff">
		    </div>
			
			<br />
			<div id="wcvaimagep" style="display:none;">
			<label><?php echo esc_html__( 'Thumbnail', 'color-image-variation-swatches-for-woocommerce' ); ?></label>
			<div id="facility_thumbnail_1" style="float:left;margin-right:10px;"><img src="<?php echo wedd_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div class="image-upload-div" style="line-height:60px;" idval="1">
				<input type="hidden" id="thumbnail_id_1" name="thumbnail_id" />
				<button type="button" class="wcva_upload_image_button_1 button"><?php echo esc_html__( 'Upload/Add image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
				<button type="button" class="wcva_remove_image_button_1 button"><?php echo esc_html__( 'Remove image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
			</div>
			</div>
			
			<br />
			<div id="wcvahoverdiv" style="">
			<label><?php echo esc_html__( 'Hover Image', 'color-image-variation-swatches-for-woocommerce' ); ?></label>
			<div id="facility_thumbnail_2" style="float:left;margin-right:10px;"><img src="<?php echo wedd_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div class="image-upload-div" style="line-height:60px;" idval="2">
				<input type="hidden" id="thumbnail_id_2" name="hoverimage" />
				<button type="button" class="wcva_upload_image_button_2 button"><?php echo esc_html__( 'Upload/Add image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
				<button type="button" class="wcva_remove_image_button_2 button"><?php echo esc_html__( 'Remove image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
			</div>
			</div>
			
			<br />
			<div id="wcvatextblockp" style="display:block;">
		      <label for="_textblock_text"><span class="wcvaformfield"><?php echo esc_html__('Text','color-image-variation-swatches-for-woocommerce'); ?></span></label> 
	          <input name="textblock" type="text" class="wcvatextblockinput" value="">
		    </div>
			<br />
			<div class="clear"></div>
			</div>
		
		<?php
	}
	
		public function edit_category_fields( $term, $taxonomy ) {
           wp_enqueue_media();
	       wp_enqueue_script( 'wp-color-picker' );
           wp_enqueue_script( 'wcva-term' );
	       wp_enqueue_style( 'wp-color-picker' );
		
		   $image 			    = '';
		   $thumbnail_id 	    = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
		   $hoverimage 	        = absint( get_term_meta( $term->term_id, 'hoverimage', true ) );
		   $display_type 	    = get_term_meta( $term->term_id, 'display_type', true );
		   $color 	            = get_term_meta( $term->term_id, 'color', true );
		   $textblock 	        = get_term_meta( $term->term_id, 'textblock', true );
		
		
		
		if ( $thumbnail_id )
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		else
			$image = wedd_placeholder_img_src();
		
		if ( $hoverimage )
			$image2 = wp_get_attachment_thumb_url( $hoverimage );
		else
			$image2 = wedd_placeholder_img_src();
		?>
		<tr class="form-field">
		   <th scope="row" valign="top"><label><?php echo esc_html__( 'Display Type', 'color-image-variation-swatches-for-woocommerce' ); ?></label></label></th>
		   <td>
			    <select id="display_type" name="display_type" >
			    	<option value="textblock" <?php if (isset($display_type) && ($display_type == "textblock")) { echo 'selected'; }  ?>><?php echo esc_html__('Text Block','color-image-variation-swatches-for-woocommerce'); ?></option>
			        <option value="Color" <?php if (isset($display_type) && ($display_type == "Color")) { echo 'selected'; }  ?>><?php echo esc_html__('Color','color-image-variation-swatches-for-woocommerce'); ?></option>
			        <option value="Image" <?php if (isset($display_type) && ($display_type == "Image")) { echo 'selected'; }  ?>><?php echo esc_html__('Image','color-image-variation-swatches-for-woocommerce'); ?></option>
			        
			    </select>
		   </td>
		</tr>
		<div id="">

		<tr class="form-field" id="wcvatextblockp" style="<?php if (isset($display_type) && (($display_type == "Image") ||  ($display_type == "Color"))) { echo 'display:none;'; } else { echo 'display:;'; }  ?>">
		   <th scope="row" valign="top"><label><?php echo esc_html__('Text','color-image-variation-swatches-for-woocommerce'); ?></label></label></th>
		   <td>
			 <input name="textblock" type="text" class="wcvatextblockinput" value="<?php if (isset($textblock) && (!empty($textblock))) { echo $textblock;} elseif (isset($term->name)) { echo $term->name; } ?>">
		   </td>
		</tr>

		<tr class="" id="wcvacolorp" style="<?php if (isset($display_type) && ($display_type == "Color")) { echo 'display:;'; } else { echo 'display:none;'; }  ?>">
		   <th scope="row" valign="top"><label><?php echo esc_html__('Chose Color','color-image-variation-swatches-for-woocommerce'); ?></label></label></th>
		   <td>
			 <input name="color" type="text" class="wcvaattributecolorselect" value="<?php if (isset($color)) { echo $color;} else { echo '#ffffff';}  ?>" data-default-color="#ffffff">
		   </td>
		</tr>
		
		
		<tr class="form-field" id="wcvaimagep" style="<?php if (isset($display_type) && ($display_type == "Image")) { echo 'display:;'; } else { echo 'display:none;'; }  ?>">
			<th scope="row" valign="top"><label><?php echo esc_html__( 'Thumbnail', 'color-image-variation-swatches-for-woocommerce' ); ?></label></th>
			<td>
				<div id="facility_thumbnail_1" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
				<div class="image-upload-div" style="line-height:60px;" idval="1">
					<input type="hidden" id="thumbnail_id_1" name="thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
					<button type="submit" class="wcva_upload_image_button_1 button"><?php echo esc_html__( 'Upload/Add image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
					<button type="submit" class="wcva_remove_image_button_1 button"><?php echo esc_html__( 'Remove image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
				</div>
				<script type="text/javascript">

					

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		
		
		
		
		
		<tr class="form-field" id="wcvahoverdiv" style="">
			<th scope="row" valign="top"><label><?php echo esc_html__( 'Hover Image', 'color-image-variation-swatches-for-woocommerce' ); ?></label></th>
			<td>
				<div id="facility_thumbnail_2" style="float:left;margin-right:10px;"><img src="<?php echo $image2; ?>" width="60px" height="60px" /></div>
				<div class="image-upload-div" style="line-height:60px;" idval="2">
					<input type="hidden" id="thumbnail_id_2" name="hoverimage" value="<?php echo $hoverimage; ?>" />
					<button type="submit" class="wcva_upload_image_button_2 button"><?php echo esc_html__( 'Upload/Add image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
					<button type="submit" class="wcva_remove_image_button_2 button"><?php echo esc_html__( 'Remove image', 'color-image-variation-swatches-for-woocommerce' ); ?></button>
				</div>
				<script type="text/javascript">

					

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		

		<?php
	}

	
	
	public function save_category_fields( $term_id, $tt_id, $taxonomy ) {
		

		if ( isset( $_POST['thumbnail_id'] ) )
			update_term_meta( $term_id, 'thumbnail_id', absint( $_POST['thumbnail_id'] ) );
		
		if ( isset( $_POST['hoverimage'] ) )
			update_term_meta( $term_id, 'hoverimage', absint( $_POST['hoverimage'] ) );
			
		if ( isset( $_POST['display_type'] ) )
			update_term_meta( $term_id, 'display_type',  $_POST['display_type'] );
		
		if ( isset( $_POST['color'] ) )
			update_term_meta( $term_id, 'color',  $_POST['color'] );
		
		if ( isset( $_POST['textblock'] ) )
			update_term_meta( $term_id, 'textblock',  $_POST['textblock'] );

		delete_transient( 'wc_term_counts' );
	}
	
	public function term_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['thumb'] = esc_html__( 'Preview', 'color-image-variation-swatches-for-woocommerce' );
		$new_columns['hoverimage'] = esc_html__( 'Hover Image', 'color-image-variation-swatches-for-woocommerce' );

		unset( $columns['cb'] );

		return array_merge( $new_columns, $columns );
	   }
	
	public function term_column( $columns, $column, $id ) {

		if ( $column == 'thumb' ) {

			$image 			    = '';
			$thumbnail_id 	    = get_term_meta( $id, 'thumbnail_id', true );
			$color 	            = get_term_meta( $id, 'color', true );
			$textblock 	        = get_term_meta( $id, 'textblock', true );
			$term_name          = get_term( $id )->name;

			if ($thumbnail_id)
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			else
				$image          = wedd_placeholder_img_src();
                $display_type 	= get_term_meta( $id, 'display_type', true );	
				
				
				if (isset($display_type)) :
				switch($display_type){
				  case "Color":
				   $columns .= '<div style="background-color:'.$color.'; border: solid 2px white; outline: solid 1px #9C9999; width:32px; height:32px;"></div>';
				  break;
				
				  case "Image":
				   $columns .= '<div style="border: solid 2px white; outline: solid 1px #9C9999; width:32px; height:32px;"><img src="' . esc_url( $image ) . '" alt="Thumbnail" class="wp-post-image" /></div>';
				  break;
				
				  case "textblock":
				    $columns .= '<div style="display: inline-block; border: solid 2px white; outline: solid 1px #9C9999; height: auto; width: auto;  background-color: #eee;
                     color: black; border-radius: 3px; font-size: 14px!important;font-weight: 500; padding: 3px 6px;" width="auto" height="32">'. $textblock .'</div>';
				  break;

				  default:

				    $columns .= '<div style="display: inline-block; border: solid 2px white; outline: solid 1px #9C9999; height: auto; width: auto; max-width: 100%; background-color: #eee;
                     color: black; border-radius: 3px; font-size: 14px!important;font-weight: 500; padding: 3px 6px;" width="auto" height="32">'. $term_name .'</div>';

				  break;
				
				
				}
				endif;
			

		}
		
		if ( $column == 'hoverimage' ) {

			$image2 			    = '';
			$thumbnail_id 	    = get_term_meta( $id, 'thumbnail_id', true );
			$hoverimage 	    = get_term_meta( $id, 'hoverimage', true );
			
			if ($hoverimage) {
				$image2 = wp_get_attachment_thumb_url( $hoverimage );
			} else {
				$image2          = wedd_placeholder_img_src();
			}
				
			$columns .= '<div style="border: solid 2px white; outline: solid 1px #9C9999; width:32px; height:32px;"><img src="' . esc_url( $image2 ) . '" alt="Thumbnail" class="wp-post-image" /></div>';
		}

		return $columns;
	}

    }

new wcva_global_values_per_attribute();


function wedd_placeholder_img_src() {
    return ''.wcva_PLUGIN_URL.'assets/images/placeholder.png';
}
?>