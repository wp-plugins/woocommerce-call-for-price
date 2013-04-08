<?php
/*
Plugin Name: WooCommerce Call for Price
Plugin URI: http://www.algoritmika.com/shop/wordpress-woocommerce-call-for-price-plugin/
Description: This plugin extends the WooCommerce e-commerce plugin by outputting "Call for Price" when price field for product is left empty.
Version: 1.0.3
Author: Algoritmika Ltd.
Author URI: http://www.algoritmika.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
?>
<?php
if ( ! class_exists( 'woocfp_plugin_lite' ) ) {
	class woocfp_plugin_lite{
		public function __construct(){
		
			add_filter('woocommerce_empty_price_html', array($this, 'empty_price'), 99);
		
			//Settings
			if(is_admin()){
				add_action('admin_menu', array($this, 'add_plugin_options_page'));
			}
		}
		
		public function empty_price($price) {
			return 'Call for Price';
		}
		
		public function add_plugin_options_page(){
			add_submenu_page( 'woocommerce', 'WooCommerce Call for Price Settings Admin', 'Call for Price Settings', 'manage_options', 'woocfp-lite-settings-admin', array($this, 'create_admin_page'));
		}

		public function create_admin_page(){
			?>
		<div class="wrap">
			<h2>WooCommerce Call for Price Options</h2>			
			<form method="post">
				<div id="message" class="updated fade"><p><strong>*You need <a href='http://www.algoritmika.com/shop/wordpress-woocommerce-call-for-price-pro-plugin/'>'WooCommerce Call for Price Pro'</a> plugin version to change these settings.</strong></p></div>
				<table class="form-table">
				<tr valign="top"><th scope="row">Text to output</th><td><input type="text" readonly style="width:300px;" id="woocfp_text_id" name="woocfp_option_group[woocfp_text]" value="Call for Price" /></td></tr>
				<tr valign="top"><th scope="row">Display on single product</th><td><input disabled type="checkbox" checked id="woocfp_on_single_id" name="woocfp_option_group[woocfp_on_single]" /></td></tr>
				<tr valign="top"><th scope="row">Display on products archive</th><td><input disabled type="checkbox" checked id="woocfp_on_archive_id" name="woocfp_option_group[woocfp_on_archive]" /></td></tr>
				<tr valign="top"><th scope="row">Display on home page</th><td><input disabled type="checkbox" checked id="woocfp_on_home_id" name="woocfp_option_group[woocfp_on_home]" /></td></tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
		}		
	}
}

$woocfp_plugin_lite = &new woocfp_plugin_lite();
