<?php
/*
Plugin Name: WooCommerce Call for Price
Plugin URI: http://coder.fm/items/woocommerce-call-for-price-plugin
Description: Plugin extends the WooCommerce plugin by outputting "Call for Price" when price field for product is left empty.
Version: 2.0.1
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Copyright: © 2015 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if WooCommerce is active
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

// Check if Pro is active, if so then return
if ( in_array( 'woocommerce-call-for-price-pro/woocommerce-call-for-price-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

if ( ! class_exists( 'Woocommerce_Call_For_Price' ) ) :

/**
 * Main Woocommerce_Call_For_Price Class
 *
 * @class Woocommerce_Call_For_Price
 */

final class Woocommerce_Call_For_Price {

	/**
	 * @var Woocommerce_Call_For_Price The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main Woocommerce_Call_For_Price Instance
	 *
	 * Ensures only one instance of Woocommerce_Call_For_Price is loaded or can be loaded.
	 *
	 * @static
	 * @return Woocommerce_Call_For_Price - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

	/**
	 * Woocommerce_Call_For_Price Constructor.
	 * @access public
	 */
	public function __construct() {

		// Include required files
		$this->includes();

		add_action( 'init', array( $this, 'init' ), 0 );

		// Settings
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ), 9 );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @param mixed $links
	 * @return array
	 */
	public function action_links( $links ) {
		return array_merge( array(
			'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=call_for_price' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>',
		), $links );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {

		$settings = array();
		$settings[] = require_once( 'includes/admin/class-wc-call-for-price-settings-general.php' );
		if ( is_admin() ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						if ( isset ( $_GET['woocommerce_call_for_price_admin_options_reset'] ) ) {
							require_once( ABSPATH . 'wp-includes/pluggable.php' );
							if ( is_super_admin() ) {
								delete_option( $value['id'] );
							}
						}
						$autoload = isset( $value['autoload'] ) ? ( bool ) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
		}

		require_once( 'includes/class-wc-call-for-price.php' );
	}

	/**
	 * Add Woocommerce settings tab to WooCommerce settings.
	 */
	public function add_woocommerce_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/class-wc-settings-call-for-price.php' );
		return $settings;
	}

	/**
	 * Init Woocommerce_Call_For_Price when WordPress initialises.
	 */
	public function init() {
		// Set up localisation
		load_plugin_textdomain( 'woocommerce-call-for-price', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
}

endif;

/**
 * Returns the main instance of Woocommerce_Call_For_Price to prevent the need to use globals.
 *
 * @return Woocommerce_Call_For_Price
 */
function WCCFP() {
	return Woocommerce_Call_For_Price::instance();
}

WCCFP();
