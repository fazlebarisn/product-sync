<?php
/**
 * Only for developer
 * @author Fazle Bari
 */
defined('ABSPATH') or die('Nice Try!');

if( ! function_exists('dd') ){
    function dd( ...$vals){
        if( ! empty($vals) && is_array($vals) ){
            ob_start(); // Start output buffering
            foreach($vals as $val ){
                echo "<pre>";
                var_dump($val);
                echo "</pre>";
            }
            $output = ob_get_clean(); // Get the buffered output and clear the buffer
            echo $output; // Output the buffered content
        }
    }
}

/**
 * A function to check value is set or not
 * If the value is set, retuen the value or retuen the default value
 * @param string $option_name The name under the value register
 * @param string $key The option key name
 * @param string $default Can be empty
 * @return string $value
 * @author Fazle Bari
 */
if( ! function_exists( 'fbs_isset_empty') ){
    function fbs_isset_empty( $option_name, $key, $default = '' ){

        $fbs_options = get_option('fbs_cart_table');

        $value = $fbs_options[$option_name][$key] ?? '';
        $value = ! empty($value) ? $value : $default;

        return $value;
    }
}
