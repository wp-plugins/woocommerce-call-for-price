<?php
/**
 * WooCommerce Call for Price
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Call_For_Price' ) ) :

class WC_Call_For_Price {

	/**
	 * Constructor.
	 */
	public function __construct() {
		if ( 'yes' === get_option( 'woocommerce_call_for_price_enabled' ) ) {
			add_action( 'init',                   array( $this, 'add_hook' ),         PHP_INT_MAX - 1 );
			add_filter( 'woocommerce_sale_flash', array( $this, 'hide_sales_flash' ), PHP_INT_MAX - 1, 3 );
		}
	}

	/**
	 * add_hook.
	 */
	public function add_hook() {
		add_filter( 'woocommerce_empty_price_html', array( $this, 'on_empty_price' ), PHP_INT_MAX - 1 );
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
