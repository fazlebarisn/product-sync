<?php

namespace Inc\Base;

class AdminNotic
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public function register(){
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            add_action( 'admin_notices', [ $this, 'woocommerce' ] );
        } 
	}

    public function woocommerce(){
        $class = 'notice notice-error';
        $message = __( "Product Synchronization plugin requires WooCommerce to be Activated", "product-sync" );
     
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }
}
