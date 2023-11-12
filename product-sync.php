<?php
/**
 * Plugin Name:				Product Synchronization
 * Plugin URI:				https://github.com/fazlebarisn/
 * Description:				Synchronize products and custom fields from WordPressShop1 to WordPressShop2.
 * Version:					1.0.0
 * Author:					Fazle Bari
 * Author URI:				https://www.chitabd.com/
 * Requires PHP:			7.2
 * Tested up to:			6.4
 * WC requires at least:	3.0.0
 * WC tested up to: 	 	8.2.1
 * Licence:					GPL Or leater
 * Text Domain:				product-sync
 * Domain Path:				/languages/
 */


defined('ABSPATH') or die('Nice Try!');

if( file_exists(dirname( __FILE__ ). '/functions.php')){
	require_once dirname( __FILE__ ). '/functions.php';
}

if( file_exists(dirname( __FILE__ ). '/vendor/autoload.php')){
	require_once dirname( __FILE__ ). '/vendor/autoload.php';
}

define('FBS_PRODUCT_SYNC_PATH', plugin_dir_path( __FILE__) );

// Active Plugin
function activate_fbs_product_sync(){
	Inc\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activate_fbs_product_sync');

// Deactive Plugin
function deactivate_fbs_product_sync(){
	Inc\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_fbs_product_sync');

/**
 * Initialize all the core classess of the plugin
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */
function fbsProductSync(){

	if (class_exists("Inc\\Init")) {
		Inc\Init::register_services();
	}
}
add_action( 'init' , 'fbsProductSync' );


/**
 * Declare compatibility with custom order tables for WooCommerce.
 * Support WooCommerce High-performance order storage
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
if( ! function_exists( 'fbs_product_sync_hpos' ) ){
	function fbs_product_sync_hpos(){
		if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
		}
	}
	add_action( 'before_woocommerce_init', 'fbs_product_sync_hpos' );
}