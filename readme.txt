=== SySwatches Variation Swatches For WooCommerce ===
Contributors: phppoet
Tags: woocommerce variation swatches, variation swatches, crocoblock,jetwoobuilder, jetengine, elementor pro, product color, product size, variable product attributes, variation product swatches, color variation swatch, image variation swatch
Requires at least: 4.0
Tested up to: 6.1.1
WC Tested up to: 7.1.0
WC Requires at least: 4.0
Requires PHP: 5.2
Stable tag: 1.2.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Variation Swatches For WooCommerce enables color/image swatches on store products. Fully compatible with elementor pro and crocoblock jetwoobuilder plugin for both single product swatches and shop swatches.



== Description ==

<h2>Variation Swatches For WooCommerce description</h2>

Using our Color Image Variation Swatches For WooCommerce Plugin you can Convert your normal variable attribute dropdown select to nicely looking Color image select. You can display images or color in all common size. Display them in round or square mode.


== How to use Color Image Variation Swatches For WooCommerce ==

https://www.youtube.com/watch?v=tFMfQ6uGE2c


<h3> Variation Swatches For WooCommerce features </h3>

- Color Image Variation Swatches  For WooCommerce Plugin Supports color/image/text variation swatches and dropdown select.
- Fully compatible with Elementor , Elementor Pro , Crocoblock and Jetwoobuilder.
- Different sizes of swatch from small to large.
- Square as well as round swatch support.
- Show selected option name on single product page.
- Variation Swatches For WooCommerce Plugin Shows Color image swatches on shop/category/tag archive pages.
- Inbuilt direct variation link feature.
- Using Variation Swatches For WooCommerce Plugin you can Use variation images as swatch images. 
- Global Color image values for attributes so that you don't need to set color/image swatches again and again.Just set it once globally.
- Hide or grey out unavailable options.
- Cross out out of stock options.
- Set groups as show by default which will make group menu open on page load.

==  video tutorial on how to use color/image swatches with custom product attributes which you separate via pipe (|). == 

https://www.youtube.com/watch?v=yTQI5wdUW94

==  Video tutorial on how to setup color/image swatches with pre-created global attributes which you create under product/attributes. == 

https://www.youtube.com/watch?v=rXlLOLhltDk



<h2>Variation Swatches For WooCommerce Shop Page</h2>

<p>You can opt to display any one attribute swatches on shop/category/tag and archive pages and that swatches can be linked to direct variant link using 
our inbuilt direct variation link feature.</p>

<h3>Variation Swatches For WooCommerce change product image on swatch hover on WooCommerce shop page </h3>

<p>Optionally you can set hover image for each attribute on backend and whenever user moves mouse on the swatch , Product image will get replaced by hover image. 
on Mobile devices you can replace hover with click</p> 

<a href="https://sysbasics.com/wooswatches/"><strong>see the live demo here</strong></a> 


<h4> Variation Swatches For WooCommerce Use a shop slider if number of swatches are higher </h4>

<p>Optionally you can enable shop slider on shop swatches where number of swatches are higher than the defined number. This makes it easy for users to view all colors without
compromising the look of the site.</p> 

<a href="https://sysbasics.com/wooswatches/"><strong>see the live demo here</strong></a> 


== show more colors link if number of swatches are higher than the defined ==

<p>Optionally you can enable show more links on product page swatches where number of swatches are higher than the defined number. This makes it easy for users to view all colors without
compromising the look of the site.</p> 

<a href="https://sysbasics.com/wooswatches/shop/swatch-slider/"><strong>see the live demo here</strong></a> 

== Square as well as round swatches support ==

<p>Plugin support both square and round both in terms of shape for swatches on shop and product page both.Color attributes look more appeasing when used as round shape.</p> 

<a href="https://sysbasics.com/wooswatches/"><strong>See the live demo here</strong></a> 

== Variation Swatches For WooCommerce Inbuilt direct variation link feature ==

<p>Inbuilt direct variation link feature helps you to create user friendly /?color=green and ?color=green&size=medium kind of urls so that you can
link your viariatons directly. Also on category/archive pages you can enable these links so that uses can be redirected directly to variation upon click.</p> 

<a href="https://www.sysbasics.com/wooswatches/shop/woocommerce-variations-swatches-demo/?color=green&size=medium"><strong>See the live demo here</strong></a> 


<h4>Color or Image Variation Swatches Plugin Features</h4>
- Our Color or Image Variation Swatches Plugin Plugin Supports color/image/text variation swatches and dropdown select.
- Woocommerce improved variable product attributes and attribute swatches.
- Global color or image values for attributes.
- Inbuilt color/image product filter.
- Works on mobile devices.
- Different sizes of swatch from small to large.
- Square as well as round swatch support.
- Option to display option name below swatch.
- Show selected option name on single product page.
- Shows color or image swatches on shop/category/tag archive pages.
- Inbuilt direct variation link feature. see this.
- Change product image on swatch hover on category/archive pages. 
- Color , image swatches compatible with [product_page ] shortcode. 
- Show more link if swatches number are greater than defined. see this.
- Slider for shop swatches if swatches number is higher than set value. 

== Frequently Asked Questions ==


= Variation Swatches for WooCommerce configured but not showing on frontend =

seems like your theme’s variable.php template is replacing the variable.php template of plugin. to fix that you need to find the variable.php template file inside your theme and rename it to some other name like variable2.php

in most themes variable.php file is located at wp-content/themes/your-theme/woocommerce/single-product/add-to-cart/variable.php


= Variation Swatches for WooCommerce Shop swatches location template missing =

please visit woocommerce/settings/wooswatches tab and try other two options for dropdown ”Shop swatches location”

it still not work then you need to find the proper hook for that location from template files and replace it with woocommerce_after_shop_loop_item_title on line 29 of class_shop_page_swatchs.php file. plugin uses three hooks to display shop swatches.

option 1 :- woocommerce_after_shop_loop_item_title after shop loop item title

option 2 :- woocommerce_before_shop_loop_item_title before shop loop item title

option 3 :- woocommerce_after_shop_loop_item after shop loop item.



= Variation Swatches for WooCommerce Unavailable due to ajax handling = 

It seems that issue is with ajax handling of variations. If you deactivate and test with default drop-downs , you will find it not working.

woocommerce loads variations via ajax in case where number of variations are more then 20. But you can increase that limit with below given php code snippet.


<pre>

function woomatrix_wc_ajax_variation_threshold( $qty, $product ) {

   //replace 50 with maximum number of variation your site might have
   return 50;

}
add_filter( 'woocommerce_ajax_variation_threshold', 'woomatrix_wc_ajax_variation_threshold', 10, 2 );

</pre>

replace 50 with maximum number of variation your site might have.

you may use this plugin for extra php code

https://wordpress.org/plugins/code-snippets/


= Add Text Before Or After Shop Swatches =

To use this plugin you will need plugin version 3.0.15 or higher.

To add text before attribute swatches use this code snippet

add_action('wcva_before_shop_swatches','wcva_add_text_before_swatches',10,2);
function wcva_add_text_before_swatches($product_id,$attribute) {
    if ($attribute == 'pa_size') {
        echo 'Available Sizes :';
    }
}
To add text after shop swatches use this code snippet

add_action('wcva_after_shop_swatches','wcva_add_text_before_swatches',10,2);
function wcva_add_text_before_swatches($product_id,$attribute) {
    if ($attribute == 'pa_size') {
        echo 'Available Sizes :';
    }
}
To insert extra php code you may use Code Snippets plugin.



= Shop swatches location issue =

Please visit wooswatches tab under woocommerce/settings tab and try two other options for shop swatches location drop-down.

== variation image does not change with dropdowns ==

what happens if you deactivate our plugin and test with default dropdowns ? does image change with default dropdowns ?

if image does not change with default dropdowns then there is something else which is causing this.First make sure you have setup images for each variation into variations tab. if still not working It could be due to your theme or third party plugins. Change your theme to default twenty-twelve theme and test weather problem persists or not . if it is working with default theme then its a conflict created by theme.

In case Issue still persists deactivate all plugins except woocommerce and and see if issue is resolved or not. if resolved activate other plugins each one by one to find the conflicting one .

== Enable shop swatches globally ==

Use below given php code snippet to enable shop swatches globally. You may use https://wordpress.org/plugins/code-snippets/ plugin for inserting extra php code.

<pre>

add_action( 'wcva_default_shop_swatches_enable', 'wcva_default_shop_swatches_enable_function');
add_action( 'wcva_default_shop_swatches_attribute', 'wcva_default_shop_swatches_attribute_function' );

function wcva_default_shop_swatches_enable_function() {

    return 'yes';

}

function wcva_default_shop_swatches_attribute_function() {
    return 'pa_color';
}

</pre>


= How To Display One Attribute Swatches On Shop/Category Pages ? = 

To display one attribute swatches on shop/category pages you need to check the “Enable one attribute swatches on shop/archive pages ” checkbox in variation select tab and then select the attribute in next option as shown in the below image.


You can also upload the hover image for each option of that selected attribute. Once hover image is set , plugin will replace the hover image with product image on swatch hover on shop/category pages.


If you are using global values as display type make sure you have set hover image for all options for chosen attribute under product/attributes menu.


= Disable unselect on swatches = 

Use below given php code snippet

<pre>

add_filter('wcva_disable_unselect_on_click',function () {
    return 1;
} );

</pre>

You may use Code Snippets plugin to inject any extra php code.


 == Unavailable due to ajax handling == 

 It seems that issue is with ajax handling of variations. If you deactivate and test with default drop-downs , you will find it not working.

woocommerce loads variations via ajax in case where number of variations are more then 20. But you can increase that limit with below given php code snippet.


<pre>

function woomatrix_wc_ajax_variation_threshold( $qty, $product ) {

   //replace 50 with maximum number of variation your site might have
   return 50;

}
add_filter( 'woocommerce_ajax_variation_threshold', 'woomatrix_wc_ajax_variation_threshold', 10, 2 );

</pre>

replace 50 with maximum number of variation your site might have.

you may use this plugin for extra php code

https://wordpress.org/plugins/code-snippets/







where pa_color is the global attribute which you want as shop swatches.




Version 1.0.0 - Initial Release 
             
* Initial release

== Screenshots ==

1. Color Image Variation Swatches For WooCommerce each product
2. Color Image Variation Swatches For WooCommerce each product
3. Color Image Variation Swatches For WooCommerce sidebar widget
4. Color Image Variation Swatches For WooCommerce settings page
5. Color Image Variation Swatches For WooCommerce product frontend view
6. Color Image Variation Swatches For WooCommerce shop swatches





== Installation ==

Use automatic installer.
