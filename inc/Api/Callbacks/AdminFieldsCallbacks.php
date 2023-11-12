<?php

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminFieldsCallbacks extends BaseController
{
    /**
     * Here we sanitized all input. 
     * Only allow number text and color code
     * 
     * @since 1.0.0
     * @param array $input_values
     * @return array $sanitized_value
     * @author Fazle Bari <fazlebarisn@gmail.com>
     */
    public function dashboarSanitize($input_array)
    {
       
    
        return $input_array;
    }

    /**
	 * Section description for add API key
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function addApiKey(){
        echo __('<p class="fbs-section-subtitle">Design Apply Coupon Button', 'fbs-cart-table-pro') ;
    }

    /**
	 * Generate the checkbox field for the admin panel
     * @param array $args
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function checkboxField( $args ){
        // dd($args);
        $name = $args['label_for'];
        $classes = $args['classes'];
        $option_name = $args['option_name'];
        $option_key = $args['option_key'];
        $value = $this->fbs_ct_options[$option_key][$name] ?? '';
        $checked = isset( $value ) ? ( $value ? true : false ) : false;
        echo '<label class="'.$classes.'" for="'.$name.'"><input type="checkbox" class="'.$name.'" id="'.$name.'" name="' . $option_name .'['.$name.']' . '" value="on" '. ( $checked ? 'checked' : '').'/><div class="slider round"></div></label>';
        // echo '<label class="fbs-toggle" for="'.$name.'"><input type="checkbox" class="'.$name.'" id="'.$name.'" name="' . $option_name .'['.$name.']' . '" value="on" '. ( $checked ? 'checked' : '').'/><div class="slider round"></div></label>';
    }

    /**
	 * Generate the color field for the admin panel
     * @param array $args
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function colorField( $args ){
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $option_key = $args['option_key'];
        $value = $this->fbs_ct_options[$option_key][$name] ?? '';
        echo '<div class="' . $classes . '"><input type="text" id="' . $name . '" name="' . $option_name .'['.$name.']' . '" value="'.$value.'" class="color-field"><label for="' . $name . '"><div></div></label></div>';       
    }

    /**
	 * Generate the text field for the admin panel
     * @param array $args
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function textField( $args ){
        $name = $args['label_for'];
        $placeholder = $args['placeholder'] ?? '';
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $option_key = $args['option_key'];
        $value = $this->fbs_ct_options[$option_key][$name] ?? '';
        echo '<div class="' . $classes . '"><input type="text" id="' . $name . '" name="' . $option_name .'['.$name.']' . '" value="'.$value.'" class="regular-text" placeholder="'.$placeholder.'"><label for="' . $name . '"><div></div></label></div>';       
    }

    /**
	 * Generate the select field for the admin panel
     * @param array $args
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function SelectField( $args ){
        $label = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $field_name = $option_name . '[' .$label .']';
        $option_key = get_option( $option_name ); 
        $option_key = $args['option_key'];
        $value = $this->fbs_ct_options[$option_key][$label] ?? '';
        
        ?>
            <select name="<?php echo esc_html($field_name); ?>">
                <option value="left" <?php if('left' == $value ) echo esc_html('selected'); ?> >Left</option>
                <option value="right" <?php if('right' == $value ) echo esc_html('selected'); ?>>Right</option>
                <option value="center" <?php if('center' == $value ) echo esc_html('selected'); ?>>Center</option>
            </select>
        <?php
    }

}
