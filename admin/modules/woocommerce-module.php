<?php
/**
 * Provide a option functions for particular sections
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link  https://pressx.co
 * @since 1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/modules
 */


/**
 * Disable Password Strength
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-password-strength' ) ) && get_option( 'kit-password-strength' ) == '1' ) {
	add_action( 'wp_print_scripts', 'kit_disable_password_strength_meter', 100 );
}

function kit_disable_password_strength_meter() {
	global $wp;

	$wp_check = isset( $wp->query_vars['lost-password'] ) || ( isset( $_GET['action'] ) && $_GET['action'] === 'lostpassword' ) || is_page( 'lost_password' );

	$wc_check = ( class_exists( 'WooCommerce' ) && ( is_account_page() || is_checkout() ) );

	if ( ! $wp_check && ! $wc_check ) {

		if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'wc-password-strength-meter' );
		}

		if ( wp_script_is( 'zxcvbn-async', 'enqueued' ) ) {
			wp_dequeue_script( 'zxcvbn-async' );
		}

		if ( wp_script_is( 'password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'password-strength-meter' );
		}
	}
}

/**
 * Disable WooCommerce Scripts
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-woo-scripts' ) ) && get_option( 'kit-woo-scripts' ) == '1' ) {
	add_action( 'wp_enqueue_scripts', 'kit_disable_woocommerce_scripts', 99 );
}

function kit_disable_woocommerce_scripts() {
	if ( function_exists( 'is_woocommerce' ) ) {
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() && ! is_product() && ! is_product_category() && ! is_shop() ) {

			// Dequeue WooCommerce Styles
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'woocommerce-inline' );

			// Dequeue WooCommerce Scripts
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );

			// Remove no-js Script + Body Class
			add_filter(
				'body_class',
				function ( $classes ) {
					remove_action( 'wp_footer', 'wc_no_js' );
					$classes = array_diff( $classes, array( 'woocommerce-no-js' ) );
					return array_values( $classes );
				},
				10,
				1
			);

			// Dequue Cart Fragmentation Script
			if ( empty( get_option( 'kit-woo-cart' ) ) || get_option( 'kit-woo-cart' ) == '0' ) {
				   wp_dequeue_script( 'wc-cart-fragments' );
			}
		}
	}
}


/**
 * Disable WooCommerce Cart Fragmentation
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-woo-cart' ) ) && get_option( 'kit-woo-cart' ) == '1' ) {
	add_action( 'wp_enqueue_scripts', 'kit_disable_woocommerce_cart_fragmentation', 99 );
}

function kit_disable_woocommerce_cart_fragmentation() {
	if ( function_exists( 'is_woocommerce' ) ) {
		wp_dequeue_script( 'wc-cart-fragments' );
	}
}


/**
 * Disable WooCommerce Status Meta Box
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-woo-status' ) ) && get_option( 'kit-woo-status' ) == '1' ) {
	add_action( 'wp_dashboard_setup', 'kit_disable_woocommerce_status' );
}

function kit_disable_woocommerce_status() {
	 remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );
}


/**
 * Disable WooCommerce Widgets
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-woo-widgets' ) ) && get_option( 'kit-woo-widgets' ) == '1' ) {
	add_action( 'widgets_init', 'kit_disable_woocommerce_widgets', 99 );
}
function kit_disable_woocommerce_widgets() {

	// Unregister Widgets
	unregister_widget( 'WC_Widget_Products' );
	unregister_widget( 'WC_Widget_Product_Categories' );
	unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
	unregister_widget( 'WC_Widget_Cart' );
	unregister_widget( 'WC_Widget_Layered_Nav' );
	unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
	unregister_widget( 'WC_Widget_Price_Filter' );
	unregister_widget( 'WC_Widget_Product_Search' );
	unregister_widget( 'WC_Widget_Recently_Viewed' );
	unregister_widget( 'WC_Widget_Recent_Reviews' );
	unregister_widget( 'WC_Widget_Top_Rated_Products' );
	unregister_widget( 'WC_Widget_Rating_Filter' );

}
