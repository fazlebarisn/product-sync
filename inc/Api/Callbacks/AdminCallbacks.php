<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	/**
	 * Include the deshboard template
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function adminDashboard(){
		return require_once("$this->plugin_path/templates/admin/deshboard.php");
	}	

	/**
	 * Include the browse plugin page template
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function browsePlugins(){
		return require_once("$this->plugin_path/templates/admin/plugins.php");
	}

	/**
	 * Include the about author page template
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function aboutAuthor(){
		return require_once("$this->plugin_path/templates/admin/author.php");
	}	

}