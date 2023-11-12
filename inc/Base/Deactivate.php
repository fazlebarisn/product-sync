<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

class Deactivate
{
	public static function deactivate(){
		flush_rewrite_rules();
	}
}