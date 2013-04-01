<?php
/*
Plugin Name: WooCommerce Call for Price
Plugin URI: http://www.algoritmika.com/shop/wordpress-woocommerce-call-for-price-plugin/
Description: This plugin extends the WooCommerce e-commerce plugin by outputting "Call for Price" when price field for product is left empty.
Version: 1.0
Author: Algoritmika Ltd.
Author URI: http://www.algoritmika.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
?>
<?php

function my_empty_price()
{
	return 'Call for Price';
}
add_filter('woocommerce_empty_price_html', 'my_empty_price');