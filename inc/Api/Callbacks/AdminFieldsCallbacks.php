<?php
/**
 * @package fbs-ct-pro
*/
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
        $sanitized_array = [];
    
        foreach ($input_array as $key => $sub_array) {
            $sanitized_sub_array = [];
    
            foreach ($sub_array as $sub_key => $value) {
                // Allow color codes starting with # followed by 3 or 6 characters.
                if (preg_match('/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $value)) {
                    // Remove extra spaces
                    $sanitized_value = preg_replace('/\s+/', ' ', $value);
                    $sanitized_sub_array[$sub_key] = $sanitized_value;
                } elseif (preg_match('/^[a-zA-Z0-9_ ]+$/', $value) || preg_match('/^[0-9]+[a-zA-Z]+(\s[a-zA-Z]+)? #[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $value) || preg_match('/^\d+(px|em) (solid|dotted|dashed) #[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $value)) {
                    // Allow numbers, alphanumeric strings with underscores and a single space, or values like "2px solid #fff".
                    $sanitized_value = preg_replace('/\s+/', ' ', $value);
                    $sanitized_sub_array[$sub_key] = $sanitized_value;
                } else {
                    // If the value doesn't match the allowed patterns, set it to empty
                    $sanitized_sub_array[$sub_key] = '';
                }
            }
    
            $sanitized_array[$key] = $sanitized_sub_array;
        }
    
        return $sanitized_array;
    }
    
    
    
    
    
    
    
    
    /**
	 * Section description for column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function enableColumn(){
        $active_col = $this->fbs_ct_options['active_col'] ?? [];
        echo '<div class="fbs-active">';
        if( ! empty( $active_col ) ){
            echo __('<p class="fbs-section-subtitle columns">Active or deactive columns. You can move the column up and down. Save and see the change.</p>', 'fbs-cart-table-pro') ;
        }else{
            echo __('<span class="no-column">No column has been activated yet</span>', 'fbs-cart-table-pro');
        }
        echo '</div>';
       
    }

    /**
	 * Section description for thumbnail column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function thumbColumn(){
        echo __('<p class="fbs-section-subtitle">Product thumbnail column settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for product name column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function nameColumn(){
        echo __('<p class="fbs-section-subtitle">Product name column settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for price column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function priceColumn(){
        echo __('<p class="fbs-section-subtitle">Product Price column settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for quantity column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function quantityColumn(){
        echo __('<p class="fbs-section-subtitle">Product quantity column settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for subtotal column settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function totalColumn(){
        echo __('<p class="fbs-section-subtitle">Subtotal column settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for table head design
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function designHeadSection(){
        echo __('<p class="fbs-section-subtitle">Design The Head section', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for table body design
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function designBodySection(){
        echo __('<p class="fbs-section-subtitle">Design The Table body section', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for table row design
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function designRowSection(){
        echo __('<p class="fbs-section-subtitle">Design The Table Row section', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for table cell design
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function designCellSection(){
        echo __('<p class="fbs-section-subtitle">Design The Table Cell section', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for cart page basic settings
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function basicSettings(){
        echo __('<p class="fbs-section-subtitle">Cart page basic settings', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for update cart button
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function updateCart(){
        echo __('<p class="fbs-section-subtitle">Design Update Cart Button', 'fbs-cart-table-pro') ;
    }

    /**
	 * Section description for apply coupon button
	 * @since 1.0.0
	 * @author Fazle Bari <fazlebarisn@gmail.com>
	 */
    public function applyCoupon(){
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
