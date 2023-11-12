<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Pages\Sections;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminFieldsCallbacks;

class Design extends BaseController
{
	public $settings;
	public $callbacks;
	public $deshboard_callback;

	public $pages = array();
	public $subpages = array();

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
				'callback'		=> [ $this->deshboard_callback, 'dashboarSanitize' ]
			]
		];

		$this->settings->setSettings( $args );
	}	

    /**
	 * We are genarating the section array for design section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setSections(){
		$args = [
			[
				'id'       => 'fbs_ct_design_head',
				'title'    => 'Table Head Design',
				'callback' => [ $this->deshboard_callback, 'designHeadSection' ],
				'page'     => 'fbs_ct_design'
            ],
			[
				'id'       => 'fbs_ct_design_body',
				'title'    => 'Table Body Design',
				'callback' => [ $this->deshboard_callback, 'designBodySection' ],
				'page'     => 'fbs_ct_design'
			],
			[
				'id'       => 'fbs_ct_design_row',
				'title'    => 'Table Row Design',
				'callback' => [ $this->deshboard_callback, 'designRowSection' ],
				'page'     => 'fbs_ct_design'
			],
			[
				'id'       => 'fbs_ct_design_cell',
				'title'    => 'Table Cell Design',
				'callback' => [$this->deshboard_callback, 'designCellSection' ],
				'page'     => 'fbs_ct_design'
			],
		];

		$this->settings->setSections( $args );
	}	

	/**
	 * Genarating all field for design section
	 * 
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
	public function setFields(){

		$args = [
			[
				'id'		=> 'thead_bg',
				'title'		=> 'Background Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_head',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'thead_bg',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'thead_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_head',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'thead_color',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'thead_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_head',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'thead_font_size',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 18px',
				]
			],
			[
				'id'		=> 'thead_padding',
				'title'		=> 'Padding',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_head',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'thead_padding',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 10px',
				]
			],
			[
				'id'		=> 'thead_text_align',
				'title'		=> 'Text Align',
				'callback'	=> [ $this->deshboard_callback, 'SelectField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_head',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'thead_text_align',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'tbody_bg',
				'title'		=> 'Background Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_body',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tbody_bg',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'tbody_color',
				'title'		=> 'Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_body',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tbody_color',
					'class'			=> 'ui-toggle',
				]
			],
			[
				'id'		=> 'tr_border',
				'title'		=> 'Border',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_row',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tr_border',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 1px solid blue',
				]
			],
			[
				'id'		=> 'tr_bottom_border',
				'title'		=> 'Border Bottom',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_row',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tr_bottom_border',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 1px solid blue',
				]
			],
			[
				'id'		=> 'tr_even_bg',
				'title'		=> 'Even Row Background',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_row',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tr_even_bg',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'tr_even_color',
				'title'		=> 'Even Row Text Color',
				'callback'	=> [ $this->deshboard_callback, 'colorField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_row',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'tr_even_color',
					'class'			=> '',
				]
			],
			[
				'id'		=> 'td_border',
				'title'		=> 'Border',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_cell',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'td_border',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 1px solid blue',
				]
			],
			[
				'id'		=> 'td_padding',
				'title'		=> 'Padding',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_cell',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'td_padding',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 10px',
				]
			],
			[
				'id'		=> 'td_font_size',
				'title'		=> 'Font Size',
				'callback'	=> [ $this->deshboard_callback, 'textField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_cell',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'td_font_size',
					'class'			=> 'ui-toggle',
					'placeholder'	=> 'Eg. 10px',
				]
			],
			[
				'id'		=> 'td_text_align',
				'title'		=> 'Text Align',
				'callback'	=> [ $this->deshboard_callback, 'selectField' ],
				'page'     => 'fbs_ct_design',
				'section'  => 'fbs_ct_design_cell',
				'args'     => [
					'option_name'	=> 'fbs_cart_table[design]',
					'option_key'	=> 'design',
					'label_for'		=> 'td_text_align',
					'class'			=> 'ui-toggle',
				]
			],
		];
		
		$this->settings->setFields( $args );
	}

}