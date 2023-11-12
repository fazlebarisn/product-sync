<?php
/**
 * Plugin Name:				Product Synchronization
 * Plugin URI:				https://github.com/fazlebarisn/
 * Description:				Product Synchronization
 * Version:					1.0.0
 * Author:					Fazle Bari
 * Author URI:				https://www.chitabd.com/
 * Requires PHP:			7.2
 * Tested up to:			6.5
 * WC requires at least:	3.0.0
 * WC tested up to: 	 	8.2.1
 * Licence:					GPL Or leater
 * Text Domain:				product-sync
 * Domain Path:				/languages/
 */

defined('ABSPATH') or die('Nice Try!');

define( 'FBS_PRODUCT_SYNC_FILE' , __FILE__ );
define( 'FBS_PRODUCT_SYNC_PATH' , __DIR__ );
define( 'FBS_PRODUCT_SYNC_URL' , plugins_url( '' , FBS_PRODUCT_SYNC_FILE ) );
define( 'FBS_PRODUCT_SYNC_ASSETS' , FBS_PRODUCT_SYNC_URL . '/assets' );
define( 'FBS_PRODUCT_SYNC_BASENAME' , plugin_basename(__FILE__) );

if( file_exists(dirname( __FILE__ ). '/functions.php')){
	require_once dirname( __FILE__ ). '/functions.php';
}

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

