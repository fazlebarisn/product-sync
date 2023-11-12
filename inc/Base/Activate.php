<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

class Activate
{
	public static function activate(){
		flush_rewrite_rules();
	}
}