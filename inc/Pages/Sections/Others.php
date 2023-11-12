<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Pages\Sections;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminFieldsCallbacks;

class Others extends BaseController
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
	 * Register option group for the plugin
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
				'callback'		=> [$this->deshboard_callback, 'dashboarSanitize' ],
			]
		];

		$this->settings->setSettings( $args );
	}	

    /**
	 * Genarating the array for other section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSections(){
		$args = [
			[
				'id'       => 'fbs_ct_basic',
				'title'    => 'Basic Settings',
				'callback' => [ $this->deshboard_callback, 'basicSettings' ],
				'page'     => 'fbs_ct_others'
            ],
			[
				'id'       => 'fbs_ct_cart_btn',
				'title'    => 'Update Cart Button',
				'callback' => [ $this->deshboard_callback, 'updateCart' ],
				'page'     => 'fbs_ct_others'
            ],
			[
				'id'       => 'fbs_ct_coupon_btn',
				'title'    => 'Apply Coupon Button',
				'callback' => [ $this->deshboard_callback, 'applyCoupon' ],
				'page'     => 'fbs_ct_others'
            ],

        ];

		$this->settings->setSections( $args );
	}
    
	/**
	 * Genarating all field for other section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setFields(){

		$args = [
			[
				'id'		=> 'cart_auto_update',
				'title'		=> 'Cart Auto Update',
				'callback'	=> [ $this->deshboard_callback, 'checkboxField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_basic',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'cart_auto_update',
					'classes'			=> 'fbs-toggle',
				]
			],
			[
				'id'		=> 'cart_btn_bg',
				'title'		=> 'Background',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_cart_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'cart_btn_bg',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'cart_btn_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_cart_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'cart_btn_color',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'cart_btn_text',
				'title'		=> 'Button Text',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_cart_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'cart_btn_text',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'coupon_btn_bg',
				'title'		=> 'Background',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_coupon_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'coupon_btn_bg',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'coupon_btn_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_coupon_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'coupon_btn_color',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'coupon_btn_text',
				'title'		=> 'Button Text',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_coupon_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'coupon_btn_text',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'c_box_boder',
				'title'		=> 'Coupon Box Border',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_others',
				'section'  => 'fbs_ct_coupon_btn',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[others]',
					'option_key'	=> 'others',
					'label_for'		=> 'c_box_boder',
					'placeholder'	=> 'Eg. 1px solid #002933',
					'class'			=> '',
				]
			],

		];

		// Allow other plugins to modify the $args array
		$args = apply_filters( 'fbs_ct_other_field_args', $args );
		
		$this->settings->setFields( $args );
	}

}