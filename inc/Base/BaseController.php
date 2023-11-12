<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public $fbs_ct_options;

	public function __construct(){
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3) ) . '/product-sync.php';

		// $this->fbs_ct_options = get_option('fbs_cart_table');
		// // dd($this->fbs_ct_options);
	}
}
