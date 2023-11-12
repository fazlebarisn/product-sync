<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
	public function register(){
		add_action( 'admin_enqueue_scripts', [ $this, 'adminEnqueue' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}

	/**
	 * Enqueue all admin script
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function adminEnqueue(){

		// Enqueue jquery from WordPress core
		wp_enqueue_script( 'jquery' );

		// Enqueue color picker from WordPress core
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		// Enqueue jQuery UI from WordPress core
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-sortable' );

		// Enqueue media from WordPress core
        wp_enqueue_media();

		wp_enqueue_style('fbs-ct-admin-css', $this->plugin_url . 'assets/css/admin.css');

		wp_enqueue_script('fbs-ct-admin-js', $this->plugin_url . 'assets/js/admin.js');

		// Send all plugin settings to admin.js file
		wp_localize_script( 'fbs-ct-admin-js', 'CT_Data', [
			'settings' => $this->fbs_ct_options,
		]);
	}

	/**
	 * Enqueue all frontend script
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function enqueue(){

		// Enqueue jquery from WordPress core
		wp_enqueue_script( 'jquery' );

		wp_enqueue_script('fbs-ct-custom', $this->plugin_url . 'assets/js/custom.js', ['jquery'], null, true );

		// Send all plugin settings to custom.js file
		wp_localize_script( 'fbs-ct-custom', 'CT_Data', [
			'settings' => $this->fbs_ct_options,
		]);
	}
}

