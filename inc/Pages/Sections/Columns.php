<?php

namespace Inc\Pages\Sections;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminFieldsCallbacks;

class Columns extends BaseController
{
	public $settings;
	public $callbacks;
	public $deshboard_callback;

	public function register(){

		$this->settings = new SettingsApi();
		$this->deshboard_callback = new AdminFieldsCallbacks();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->register();
	}

	/**
	 * Register option group fro the plugin
	 * We are using same option group ( fbs_ct_settings ) for all settings
	 * Also same option name (fbs_cart_table) for all options
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSettings(){

		$args = [
			[
				'option_group'	=> 'fbs_ct_settings',
				'option_name'	=> 'fbs_cart_table',
				'callback'		=> [ $this->deshboard_callback, 'dashboarSanitize' ]
			]
		];

		$this->settings->setSettings( $args );
	}	

	/**
	 * We are genarating the section array for columns section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSections(){
		$args = [
			[
				'id'       => 'fbs_ct_col_enable',
				'title'    => 'Active Columns',
				'callback' => [ $this->deshboard_callback, 'enableColumn' ],
				'page'     => 'fbs_ct_cols'
			],
			[
				'id'       => 'fbs_ct_col_thumb',
				'title'    => 'Product Thumbnail Column',
				'callback' => [ $this->deshboard_callback, 'thumbColumn' ],
				'page'     => 'fbs_ct_cols'
			],
			[
				'id'       => 'fbs_ct_col_name',
				'title'    => 'Product Name Column',
				'callback' => [ $this->deshboard_callback, 'nameColumn' ],
				'page'     => 'fbs_ct_cols'
			],
			[
				'id'       => 'fbs_ct_col_price',
				'title'    => 'Product Price Column',
				'callback' => [ $this->deshboard_callback, 'priceColumn' ],
				'page'     => 'fbs_ct_cols'
			],
			[
				'id'       => 'fbs_ct_col_qty',
				'title'    => 'Product Quantity Column',
				'callback' => [ $this->deshboard_callback, 'quantityColumn' ],
				'page'     => 'fbs_ct_cols'
			],
			[
				'id'       => 'fbs_ct_total',
				'title'    => 'Subtotal Column',
				'callback' => [ $this->deshboard_callback, 'totalColumn' ],
				'page'     => 'fbs_ct_cols'
			],
		];

		$this->settings->setSections( $args );
	}	

	/**
	 * Genarating all field for column section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setFields(){

		$args = [
			[
				'id'		=> 'remove',
				'title'		=> 'Remove',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'remove',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'thumbnail',
				'title'		=> 'Thumbnail',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'thumbnail',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'name',
				'title'		=> 'Product Name',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'name',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'price',
				'title'		=> 'Price',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'price',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'quantity',
				'title'		=> 'Quantity',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'quantity',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'total',
				'title'		=> 'Total',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'total',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'stock',
				'title'		=> 'Stock',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_enable',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[active_col]',
					'option_key'	=> 'active_col',
					'label_for'		=> 'stock',
					'classes'		=> 'fbs-col-toggle',
				]
			],
			[
				'id'		=> 'thumb_width',
				'title'		=> 'Image Width',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_thumb',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[thumbnail]',
					'option_key'	=> 'thumbnail',
					'label_for'		=> 'thumb_width',
					'class'			=> '',
					'placeholder'	=> 'Eg. 180px',
				]
			],
			[
				'id'		=> 'thumb_height',
				'title'		=> 'Image Height',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_thumb',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[thumbnail]',
					'option_key'	=> 'thumbnail',
					'label_for'		=> 'thumb_height',
					'class'			=> '',
					'placeholder'	=> 'Eg. 180px',
				]
			],
			[
				'id'		=> 'name_link',
				'title'		=> 'Desible Link',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_name',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[name]',
					'option_key'	=> 'name',
					'label_for'		=> 'name_link',
					'classes'		=> 'fbs-toggle',
				]
			],
			[
				'id'		=> 'name_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_name',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[name]',
					'option_key'	=> 'name',
					'label_for'		=> 'name_color',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'name_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_name',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[name]',
					'option_key'	=> 'name',
					'label_for'		=> 'name_font_size',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 18px',
				]
			],
			[
				'id'		=> 'name_width',
				'title'		=> 'Column Width',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_name',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[name]',
					'option_key'	=> 'name',
					'label_for'		=> 'name_width',
					'class'			=> '',
					'placeholder'	=> 'Eg. 180px',
				]
			],
			[
				'id'		=> 'name_col_title',
				'title'		=> 'Column Title',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_name',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[name]',
					'option_key'	=> 'name',
					'label_for'		=> 'name_col_title',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. Product Name',
				]
			],
			[
				'id'		=> 'price_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_price',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[price]',
					'option_key'	=> 'price',
					'label_for'		=> 'price_color',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'price_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_price',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[price]',
					'option_key'	=> 'price',
					'label_for'		=> 'price_font_size',
					'class'			=> 'fbs-col-price',
					'placeholder'	=> 'Eg. 18px',
				]
			],
			[
				'id'		=> 'price_width',
				'title'		=> 'Column Width',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_price',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[price]',
					'option_key'	=> 'price',
					'label_for'		=> 'price_width',
					'class'			=> 'fbs-col-price',
					'placeholder'	=> 'Eg. 200px',
				]
			],
			[
				'id'		=> 'price_title',
				'title'		=> 'Column Title',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_price',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[price]',
					'option_key'	=> 'price',
					'label_for'		=> 'price_title',
					'class'			=> 'fbs-col-price',
					'placeholder'	=> 'Product Price',
				]
			],
			[
				'id'		=> 'qty_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_qty',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[qty]',
					'option_key'	=> 'qty',
					'label_for'		=> 'qty_color',
					'class'			=> 'fbs-col-quantity',
				]
			],
			[
				'id'		=> 'qty_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_qty',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[qty]',
					'option_key'	=> 'qty',
					'label_for'		=> 'qty_font_size',
					'class'			=> 'fbs-col-quantity',
					'placeholder'	=> 'Eg. 18px',
				]
			],
			[
				'id'		=> 'qty_width',
				'title'		=> 'Column Width',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_qty',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[qty]',
					'option_key'	=> 'qty',
					'label_for'		=> 'qty_width',
					'class'			=> 'fbs-col-quantity',
					'placeholder'	=> 'Eg. 200px',
				]
			],
			[
				'id'		=> 'qty_title',
				'title'		=> 'Column Title',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_col_qty',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[qty]',
					'option_key'	=> 'qty',
					'label_for'		=> 'qty_title',
					'class'			=> 'fbs-col-quantity',
					'placeholder'	=> 'Product Quantity',
				]
			],
			[
				'id'		=> 'subtotal_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_total',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[subtotal]',
					'option_key'	=> 'subtotal',
					'label_for'		=> 'subtotal_color',
					'class'			=> 'fbs-col-total',
				]
			],
			[
				'id'		=> 'subtotal_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_total',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[subtotal]',
					'label_for'		=> 'subtotal_font_size',
					'option_key'	=> 'subtotal',
					'class'			=> 'fbs-col-total',
					'placeholder'	=> 'Eg. 18px',
				]
			],
			[
				'id'		=> 'subtotal_width',
				'title'		=> 'Column Width',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_total',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[subtotal]',
					'option_key'	=> 'subtotal',
					'label_for'		=> 'subtotal_width',
					'class'			=> 'fbs-col-total',
					'placeholder'	=> 'Eg. 200px',
				]
			],
			[
				'id'		=> 'subtotal_title',
				'title'		=> 'Column Title',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_cols',
				'section'  => 'fbs_ct_total',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[subtotal]',
					'option_key'	=> 'subtotal',
					'label_for'		=> 'subtotal_title',
					'class'			=> 'fbs-col-total',
					'placeholder'	=> 'Subtotal',
				]
			],

		];
		
		$this->settings->setFields( $args );
	}

}