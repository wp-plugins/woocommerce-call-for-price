<?php
/**
 * WooCommerce Call for Price
 *
 * @version 2.0.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Call_For_Price' ) ) :

class WC_Call_For_Price {

	/**
	 * Constructor.
	 *
	 * @version 2.0.1
	 */
	public function __construct() {
		if ( 'yes' === get_option( 'woocommerce_call_for_price_enabled' ) ) {
			add_action( 'init',                   array( $this, 'add_hooks' ),         PHP_INT_MAX - 1 );
			add_filter( 'woocommerce_sale_flash', array( $this, 'hide_sales_flash' ), PHP_INT_MAX - 1, 3 );
		}
	}

	/**
	 * solaris_theme_fix_single_end.
	 *
	 * @since 2.0.1
	 */
	public function solaris_theme_fix_single_end() {
		$the_id = get_the_ID();
		$the_product = wc_get_product( $the_id );
		if ( '' === $the_product->get_price() ) {
			add_action( 'woocommerce_single_product_summary', 'themerex_woocommerce_after_price', 11);
			add_action( 'woocommerce_single_product_summary', 'themerex_woocommerce_before_price', 9);
		}
	}

	/**
	 * solaris_theme_fix_single.
	 *
	 * @since 2.0.1
	 */
	public function solaris_theme_fix_single() {
		$the_id = get_the_ID();
		$the_product = wc_get_product( $the_id );
		if ( '' === $the_product->get_price() ) {
			remove_action( 'woocommerce_single_product_summary', 'themerex_woocommerce_after_price', 11);
			remove_action( 'woocommerce_single_product_summary', 'themerex_woocommerce_before_price', 9);
		}
	}

	/**
	 * solaris_theme_fix_loop_end.
 	 *
	 * @since 2.0.1
	 */
	public function solaris_theme_fix_loop_end() {
		$the_id = get_the_ID();
		$the_product = wc_get_product( $the_id );
		if ( '' === $the_product->get_price() ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'themerex_woocommerce_after_price', 11);
			add_action( 'woocommerce_after_shop_loop_item_title', 'themerex_woocommerce_before_price', 9);
		}
	}

	/**
	 * solaris_theme_fix_loop.
	 *
	 * @since 2.0.1
	 */
	public function solaris_theme_fix_loop() {
		$the_id = get_the_ID();
		$the_product = wc_get_product( $the_id );
		if ( '' === $the_product->get_price() ) {
			remove_action( 'woocommerce_after_shop_loop_item_title', 'themerex_woocommerce_after_price', 11);
			remove_action( 'woocommerce_after_shop_loop_item_title', 'themerex_woocommerce_before_price', 9);
		}
	}

	/**
	 * add_hooks.
	 *
	 * @version 2.0.1
	 */
	public function add_hooks() {
		add_filter( 'woocommerce_empty_price_html', array( $this, 'on_empty_price' ), PHP_INT_MAX - 1 );

		// Solaris theme fix
		if ( function_exists( 'themerex_woocommerce_after_price' ) ) {
			add_action( 'woocommerce_before_single_product', array( $this, 'solaris_theme_fix_single' ) );
			add_action( 'woocommerce_after_single_product',  array( $this, 'solaris_theme_fix_single_end' ) );
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'solaris_theme_fix_loop' ) );
			add_action( 'woocommerce_after_shop_loop_item',  array( $this, 'solaris_theme_fix_loop_end' ) );
		}
	}

	/**
	 * Hide "sales" icon for empty price products.
	 */
	public function hide_sales_flash( $onsale_html, $post, $duct ) {
		if ( 'yes' === get_option( 'woocommerce_call_for_price_hide_sale_sign' ) && '' === $duct->get_price() ) {
			return '';
		}

		// No changes
		return $onsale_html;
	}

	/**
	 * On empty price filter - return the label.
	 */
	public function on_empty_price( $price ) {
		return '<strong>' . __( 'Call for Price', 'woocommerce-call-for-price' ) . '</strong>';
	}
}

endif;

return new WC_Call_For_Price();
