<?php


add_action('woocommerce_before_main_content', 'ciWoocommerceWrapperStart', 10);
function ciWoocommerceWrapperStart() {
    echo '<div class="woocommerce">';
}

add_action('woocommerce_after_main_content', 'ciWoocommerceWrapperEnd', 10);
function ciWoocommerceWrapperEnd() {
    echo '</div>';
}


add_action('after_setup_theme', 'ciWoocommerceSupport');
function ciWoocommerceSupport() {
    add_theme_support('woocommerce');
}







/**
 * Layout
 * @see  storefront_before_content()
 * @see  storefront_after_content()
 * @see  woocommerce_breadcrumb()
 */
//remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb', 					20, 0 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_after_main_content', 	'woocommerce_output_content_wrapper_end', 	10 );
remove_action( 'woocommerce_sidebar', 				'woocommerce_get_sidebar', 					10 );

/**
 * Products
 * @see  storefront_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_upsell_display', 				15 );
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_show_product_loop_sale_flash', 10 );

