<?php
if (!class_exists('wcva_add_settings_page_class')) {

	class wcva_add_settings_page_class {

		private $wcva_notices_options_key   = 'wcva_plugin_options';
		private $wcva_shop_settings         = 'wcva_shop_settings';
		private $wcva_product_settings      = 'wcva_product_settings';
		private $wcva_global_settings       = 'wcva_global_settings';
		private $wcva_plugin_settings_tab   =  array();


		public function __construct() {

			add_action( 'init', array( $this, 'load_settings' ) );
			add_action( 'admin_init', array( $this, 'wcva_register_product_settings' ) );
			add_action( 'admin_init', array( $this, 'wcva_register_shop_settings' ) );
			add_action( 'admin_init', array( $this, 'wcva_register_global_settings' ) );
			add_action( 'admin_menu', array( $this, 'add_admin_menus' ) ,100);
			add_action( 'admin_enqueue_scripts', array($this, 'wcva_register_admin_scripts'));
			add_action( 'admin_enqueue_scripts', array($this, 'wcva_load_admin_menu_style'));

		}


		public function load_settings() {

			$this->shop_settings    = (array) get_option( $this->wcva_shop_settings );
			$this->shop_settings    = array_merge( array(), $this->shop_settings );

			$this->product_settings = (array) get_option( $this->wcva_product_settings );
			$this->product_settings = array_merge( array(), $this->product_settings );

			$this->global_settings  = (array) get_option( $this->wcva_global_settings );
			$this->global_settings  = array_merge( array(), $this->global_settings );


		}

		public function wcva_load_admin_menu_style() {


			global $general_wcvasettings_page;
			
			if ( (isset($_GET['page'])) && ( $_GET['page'] =='wcva_product_settings' ) ) {


				wp_enqueue_script( 'wcva_bootstrap', ''.wcva_PLUGIN_URL.'assets/js/bootstrap.min.js' );
				wp_enqueue_script( 'wcva_bootstrap_toggle', ''.wcva_PLUGIN_URL.'assets/js/bootstrap4-toggle.min.js' );
				


				wp_enqueue_style( 'wcva_bootstrap', ''.wcva_PLUGIN_URL.'assets/css/bootstrap.min.css' );
				wp_enqueue_style( 'wcva_bootstrap_toggle', ''.wcva_PLUGIN_URL.'assets/css/bootstrap4-toggle.min.css' );
				

			}
			wp_enqueue_script( 'woomatrix_admin_menu_js', ''.wcva_PLUGIN_URL.'assets/js/admin_menu.js' );
			wp_enqueue_style( 'woomatrix_admin_menu_css', ''.wcva_PLUGIN_URL.'assets/css/admin_menu.css' );
		}




	    /**
	     * registers admin scripts via admin enqueue scripts
	     */
	    public function wcva_register_admin_scripts($hook) {
	    	global $general_wcvasettings_page;

	    	if ( $hook == $general_wcvasettings_page ) {



	    		wp_enqueue_script( 'select2', ''.wcva_PLUGIN_URL.'assets/js/select2.js' );
	    		wp_enqueue_script( 'wcvaadmin', ''.wcva_PLUGIN_URL.'assets/js/admin.js' );


	    		wp_enqueue_style( 'select2',''.wcva_PLUGIN_URL.'assets/css/select2.css');
	    		wp_enqueue_style( 'wcvaadmin', ''.wcva_PLUGIN_URL.'assets/css/admin.css' );



	    		$wcva_js_array = array();

	    		wp_localize_script( 'wcvaadmin', 'wcvaadmin', $wcva_js_array );

	    	}
	    }





	    public function wcva_register_product_settings() {



	    	$this->wcva_plugin_settings_tab[$this->wcva_product_settings] = esc_html__( 'Product Swatches' ,'color-image-variation-swatches-for-woocommerce');



	    	register_setting( $this->wcva_product_settings, $this->wcva_product_settings );

	    	add_settings_section( 'wcva_product_section', '', '', $this->wcva_product_settings );

	    	add_settings_field( 'wcva_product_option', '', array( $this, 'product_swatches_form' ), $this->wcva_product_settings, 'wcva_product_section' );
	    }



	    public function wcva_register_shop_settings() {




	    	$this->wcva_plugin_settings_tab[$this->wcva_shop_settings] = esc_html__( 'Shop Swatches' ,'color-image-variation-swatches-for-woocommerce');



	    	register_setting( $this->wcva_shop_settings, $this->wcva_shop_settings );

	    	add_settings_section( 'wcva_shop_section', '', '', $this->wcva_shop_settings );

	    	add_settings_field( 'wcva_shop_option', '', array( $this, 'shop_swatches_form' ), $this->wcva_shop_settings, 'wcva_shop_section' );

	    }



	    public function wcva_register_global_settings() {




	    	$this->wcva_plugin_settings_tab[$this->wcva_global_settings] = esc_html__( 'Global Values' ,'color-image-variation-swatches-for-woocommerce');



	    	register_setting( $this->wcva_global_settings, $this->wcva_global_settings );

	    	add_settings_section( 'wcva_global_section', '', '', $this->wcva_global_settings );

	    	add_settings_field( 'wcva_global_option', '', array( $this, 'global_swatches_form' ), $this->wcva_global_settings, 'wcva_global_section' );
	    }










	  public function product_swatches_form() { 

	  	include ('forms/product_swatches_form.php');

	  }


	  public function shop_swatches_form() { 

	  	include ('forms/shop_swatches_form.php');

	  }


	  public function global_swatches_form() { 

	  	include ('forms/global_swatches_form.php');

	  }

	  public function global_values_swatches_form() { 

	  	include ('forms/global_values_swatches_form.php'); 

	  }



   /**
    * Adds Admin Menu "cart notices"
    * global $general_wcvasettings_page is used to include page specific scripts
    */

	 public function add_admin_menus() {
	 	global $general_wcvasettings_page;

	 	add_menu_page(
          __( 'SysBasics', 'color-image-variation-swatches-for-woocommerce' ),
         'SysBasics',
         'manage_woocommerce',
         'sysbasics',
         array($this,'plugin_options_page'),
         ''.wcva_PLUGIN_URL.'assets/images/icon.png',
         70
        );
	    

        $general_wcvasettings_page = add_submenu_page( 'sysbasics', wcva_PLUGIN_name , wcva_PLUGIN_name , 'manage_woocommerce', esc_html__($this->wcva_product_settings), array($this, 'wcva_options_page'));         
	 }




	 public function wcva_options_page() {
	 	$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : esc_html__($this->wcva_product_settings);
	 	?>
	 	<div class="wrap">
	 		<?php $this->wcva_options_tab_wrap(); ?>
	 		<form method="post" action="options.php">
	 			<?php wp_nonce_field( 'update-options' ); ?>
	 			<?php settings_fields( $tab ); ?>
	 			<?php do_settings_sections( $tab ); ?>
	 			<center>
	 				<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_html__( 'Save Changes' ,'color-image-variation-swatches-for-woocommerce'); ?>">
	 			</center>

	 		</form>
	 	</div>
	 	<?php
	 }



	 public function wcva_options_tab_wrap() {

	 	$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : esc_html__($this->wcva_product_settings);

	 	echo '<h2 class="nav-tab-wrapper">';

	 	foreach ( $this->wcva_plugin_settings_tab as $tab_key => $tab_caption ) {

	 		$active = $current_tab == $tab_key ? 'nav-tab-active' : '';

	 		echo '<a class="nav-tab ' . esc_html__($active) . '" href="?page=' . esc_html__($this->wcva_product_settings) . '&tab=' . esc_html__($tab_key) . '">' . esc_html__($tab_caption) . '</a>';	

	 	}

	 	  echo '</h2>';

	  }
	}
}


new wcva_add_settings_page_class();
?>