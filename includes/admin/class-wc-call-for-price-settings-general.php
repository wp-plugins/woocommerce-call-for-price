<?php
/**
 * WooCommerce Call for Price - General Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Call_For_Price_Settings_General' ) ) :

class WC_Call_For_Price_Settings_General {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id   = 'general';
		$this->desc = __( 'General', 'woocommerce-call-for-price' );

		add_filter( 'woocommerce_get_sections_call_for_price',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_call_for_price_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
	}

	/**
	 * settings_section.
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

	/**
	 * get_settings.
	 */
	function get_settings() {

		$default_empty_price_text = '<strong>' . __( 'Call for Price', 'woocommerce-call-for-price' ) . '</strong>';
		$desc = __( 'You will need <a href="http://coder.fm/items/woocommerce-call-for-price-plugin/">WooCommerce Call for Price Pro</a> plugin to change value.', 'woocommerce-call-for-price' );

		$settings = array(

			array(
				'title'     => __( 'Call for Price Options', 'woocommerce-call-for-price' ),
				'type'      => 'title',
				'id'        => 'woocommerce_call_for_price_options',
			),

			array(
				'title'     => __( 'WooCommerce Call for Price', 'woocommerce-call-for-price' ),
				'desc'      => '<strong>' . __( 'Enable', 'woocommerce-call-for-price' ) . '</strong>',
				'desc_tip'  => __( 'Create any custom price label for all WooCommerce products with empty price.', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_enabled',
				'default'   => 'yes',
				'type'      => 'checkbox',
			),

			array(
				'title'     => __( 'Label to Show on Single', 'woocommerce-call-for-price' ),
				'desc_tip'  => __( 'This sets the html to output on empty price. Leave blank to disable.', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_text',
				'default'   => $default_empty_price_text,
				'type'      => 'textarea',
				'css'       => 'width:50%;min-width:300px;',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
				'desc'      => $desc,
			),

			array(
				'title'     => __( 'Label to Show on Archives', 'woocommerce-call-for-price' ),
				'desc_tip'  => __( 'This sets the html to output on empty price. Leave blank to disable.', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_text_on_archive',
				'default'   => $default_empty_price_text,
				'type'      => 'textarea',
				'css'       => 'width:50%;min-width:300px;',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
				'desc'      => $desc,
			),

			array(
				'title'     => __( 'Label to Show on Homepage', 'woocommerce-call-for-price' ),
				'desc_tip'  => __( 'This sets the html to output on empty price. Leave blank to disable.', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_text_on_home',
				'default'   => $default_empty_price_text,
				'type'      => 'textarea',
				'css'       => 'width:50%;min-width:300px;',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
				'desc'      => $desc,
			),

			array(
				'title'     => __( 'Label to Show on Related', 'woocommerce-call-for-price' ),
				'desc_tip'  => __( 'This sets the html to output on empty price. Leave blank to disable.', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_text_on_related',
				'default'   => $default_empty_price_text,
				'type'      => 'textarea',
				'css'       => 'width:50%;min-width:300px;',
				'custom_attributes' => array( 'readonly' => 'readonly' ),
				'desc'      => $desc,
			),

			array(
				'title'     => __( 'Hide Sale! Tag', 'woocommerce-call-for-price' ),
				'desc'      => __( 'Hide the tag', 'woocommerce-call-for-price' ),
				'id'        => 'woocommerce_call_for_price_hide_sale_sign',
				'default'   => 'yes',
				'type'      => 'checkbox',
			),

			array(
				'type'      => 'sectionend',
				'id'        => 'woocommerce_call_for_price_options',
			),

		);

		return $settings;
	}

}

endif;

return new WC_Call_For_Price_Settings_General();
