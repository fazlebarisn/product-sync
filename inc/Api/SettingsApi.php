<?php

namespace Inc\Api;

class SettingsApi
{
	// Define $admin_page as an empty array
	public $admin_pages = [];

	public $admin_subpages = [];
	public $settings = [];
	public $sections = [];
	public $fields = [];

	public function register(){

		if ( !empty( $this->admin_pages ) ) {
			add_action( 'admin_menu', [ $this, 'addAdminMenu' ] );
		}

		if ( !empty($this->settings) ){
			add_action( 'admin_init', [ $this, 'registerCustomFields' ] );
		}
	}

	/**
	 * Accept $page only if it is an array
	 * store all pages
	 * 
	 * @since 1.0.0
	 * @param array $pages
	 * @return array instance
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function addPages( array $pages){
		$this->admin_pages = $pages;
		return $this;
	}

	/**
	 * Define withSubPage function, By default title will be null
	 * 
	 * @since 1.0.0
	 * @param string $pages
	 * @return string subpage title
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function withSubPage( string $title = null){

		if( empty($this->admin_pages )){
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$subpage = [
			[
				'parent_slug'=> $admin_page['menu_slug'],
				'page_title' => $admin_page['page_title'],
				'menu_title' => ($title)? : $admin_page['menu_title'],
				'capability' => $admin_page['capability'],
				'menu_slug'  => $admin_page['menu_slug'],
				'callback'   => $admin_page['callback']
			]
		];

		$this->admin_subpages = $subpage;
		return $this;
	}

	public function addSubPages( array $pages ){
		$this->admin_subpages = array_merge( $this->admin_subpages , $pages );
		return $this;
	}

	/**
	 * loop though all the pages and activate all the pages at once
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function addAdminMenu(){

		foreach ( $this->admin_pages as $page ) {
			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] ); 
		}		

		foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] ); 
		}
	}

    /**
	 * Set the settings 
	 * 
	 * @since 1.0.0
	 * @param array $settings
	 * @return array setting instance
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSettings( array $settings ){
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Set the section 
	 * 
	 * @since 1.0.0
	 * @param array $section
	 * @return array section instance
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSections( array $sections ){
		$this->sections = $sections;
		return $this;
	}

	/**
	 * Set the fields 
	 * 
	 * @since 1.0.0
	 * @param array $fields
	 * @return array fields instance
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setFields( array $fields ){
		$this->fields = $fields;
		return $this;
	}	
 
	/**
	 * Register custom field for admin panel
	 * 
	 * @since 1.0.
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function registerCustomFields()
	{
		// register setting
		foreach ( $this->settings as $setting ) {
			register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) );
		}

		// add settings section
		foreach ( $this->sections as $section ) {
			add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
		}

		// add settings field
		foreach ( $this->fields as $field ) {
			add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
		}
	}
}
