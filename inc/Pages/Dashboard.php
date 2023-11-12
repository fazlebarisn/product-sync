<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Dashboard extends BaseController
{
	public $settings;
	public $callbacks;
	public $deshboard_callback;

	public $pages = [];
	public $subpages = [];

	public function register(){

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		$this->setPages();
		$this->setSubPages();

		$this->settings->addPages($this->pages)->withSubPage('Dashbord')->addSubPages($this->subpages)->register();
		
	}

	/**
	 * Add pages
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setPages(){
		$this->pages = [
			[
				'page_title' => 'Product Sync',
				'menu_title' => 'Product Sync',
				'capability' => 'manage_options',
				'menu_slug'  => 'fbs_product_sync',
				'callback'   => [ $this->callbacks, 'adminDashboard' ],
				'icon_url'   => 'dashicons-cart',
				'position'   => 110
			]
		];
		
	}

	/**
	 * Add subpages
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSubPages(){
		$this->subpages = [
			[
				'parent_slug'=> 'fbs_product_sync',
				'page_title' => 'Browse Our Plugins',
				'menu_title' => 'Browse Plugins',
				'capability' => 'manage_options',
				'menu_slug'  => 'fbs_plugins',
				'callback'   => [ $this->callbacks, 'browsePlugins' ]
			],
			[
				'parent_slug'=> 'fbs_product_sync',
				'page_title' => 'About The Author',
				'menu_title' => 'Author Info',
				'capability' => 'manage_options',
				'menu_slug'  => 'fbs_author',
				'callback'   => [ $this->callbacks, 'aboutAuthor' ]
			],
		];
	}

}