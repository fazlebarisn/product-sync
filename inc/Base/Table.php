<?php
/**
 * @package fbs-ct-pro
*/
namespace Inc\Base;

use \Inc\Base\BaseController;

class Table extends BaseController
{

	public function register(){

        // set false if no column is active
        $active_col = $this->fbs_ct_options['active_col'] ?? false;

        if( $active_col  ){
		    add_action( 'woocommerce_locate_template', [ $this, 'locateTemplate' ], 10, 3 );
        }

	}

    public function locateTemplate( $template, $template_name, $template_path ){

        global $woocommerce;
        $_template = $template;
        if ( ! $template_path ) 
            $template_path = $woocommerce->template_url;

        // $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/template/woocommerce/';
        $plugin_path  = $this->plugin_path . 'templates/woocommerce/';
        
        // Look within passed path within the theme - this is priority
        $template = locate_template(
            array(
                $template_path . $template_name,
                $template_name
            )
        );

        if( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;

        if ( ! $template )
        $template = $_template;

        // dd($template);
        return $template;
    }

}