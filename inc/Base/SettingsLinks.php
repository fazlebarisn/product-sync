<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{

	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	/**
	 * Add settings links for user. From there user easyly can go to the deshboard
	 * 
	 * @since 1.0.0
	 * @param array $links
	 * @return array links
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=fbs_cart_table">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}