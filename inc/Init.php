<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc;

final class Init
{
	/**
	 * Store all classes inside an array
	 * @return array Full list of classes
	 */

	public static function get_services(){
		return[
			Base\Table::class,
			Base\Enqueue::class,
			Base\AdminNotic::class,
			Pages\Dashboard::class,
			Base\SettingsLinks::class,
			Pages\Sections\Design::class,
			Pages\Sections\Others::class,
			Pages\Sections\Columns::class,
		];
	}

	/**
	 * Loop through the classes, initialize them
	 * and call the register() methord if it exists
	 * @return 
	 */

	public static function register_services(){
		foreach (self::get_services() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param class $class class from the services array
	 * @return class instance new instance of the class
	 */

	private static function instantiate($class){
		$service = new $class();
		return $service;
	}
}
