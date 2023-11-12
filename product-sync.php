<?php
/**
 * Plugin Name:				Product Synchronization
 * Plugin URI:				https://github.com/fazlebarisn/
 * Description:				Product Synchronization
 * Version:					1.0.0
 * Author:					Fazle Bari
 * Author URI:				https://www.chitabd.com/
 * Requires PHP:			7.2
 * Tested up to:			6.5
 * WC requires at least:	3.0.0
 * WC tested up to: 	 	8.2.1
 * Licence:					GPL Or leater
 * Text Domain:				product-sync
 * Domain Path:				/languages/
 */

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

 // Add hooks to trigger synchronization when the button is clicked.
add_action('admin_menu', 'add_synchronize_button');

function add_synchronize_button() {
    add_menu_page('Synchronize Products', 'Synchronize Products', 'manage_options', 'synchronize-products', 'synchronize_products');
}

function synchronize_products() {
    // Add HTML for the synchronization button and any status messages.
    echo '<div class="wrap">';
    echo '<h2>Synchronize Products</h2>';

    // Check if the button is clicked.
    if (isset($_POST['sync_button'])) {
        // Call the function to synchronize products.
        synchronize_products_function();
        echo '<div class="updated"><p>Products synchronized successfully!</p></div>';
    }

    echo '<form method="post">';
    echo '<input type="submit" class="button button-primary" name="sync_button" value="Synchronize Products">';
    echo '</form>';
    echo '</div>';
}

function synchronize_products_function() {
    // Get products from WordPressShop1
    $products_from_shop1 = get_products_from_shop1();

    foreach ($products_from_shop1 as $product_from_shop1) {
        $product_id = $product_from_shop1['id'];

        // Check if the product already exists in WordPressShop2
        $existing_product = wc_get_product($product_id);

        // Product data from WordPressShop1
        $product_data = array(
            'name' => $product_from_shop1['name'],
            'type' => $product_from_shop1['type'],
            'regular_price' => $product_from_shop1['regular_price'],
            'description' => $product_from_shop1['description'],
            'short_description' => $product_from_shop1['short_description'],
            'sku' => $product_from_shop1['sku'],
            'stock_status' => $product_from_shop1['stock_status'],
            'featured' => $product_from_shop1['featured'],
            // Add other product data fields as needed.
        );

        if ($existing_product) {
            // Product exists, update it
            $existing_product->set_props($product_data);
            $existing_product->save();
        } else {
            // Product doesn't exist, create it
            $new_product = new WC_Product();
            $new_product->set_props($product_data);
            $new_product->save();
        }

        // Synchronize the custom field 'Brand'
        $brand_value = get_field('brand', $product_id); // Use ACF function to get custom field value
        update_field('brand', $brand_value, $product_id); // Use ACF function to update custom field value
    }
}



// function get_products_from_shop1() {
//     $api_url = 'https://wordpressshop1.csoft.ca/wp-json/wc/v3/products';

//     // Replace 'YOUR_CONSUMER_KEY' and 'YOUR_CONSUMER_SECRET' with the actual keys generated in WordPressShop1.
//     $consumer_key = 'ck_223a270f3f8d2ea4f31b3f56bb6303af790b4bdd';
//     $consumer_secret = 'cs_d738bbcaba68aa180e9f0189d2dfc4f6c0a34d50';

//     $response = wp_remote_get($api_url, array(
//         'headers' => array(
//             'Authorization' => 'Basic ' . base64_encode($consumer_key . ':' . $consumer_secret),
//         ),
//     ));

//     if (is_wp_error($response)) {
//         // Handle error.
//         return false;
//     }

//     $body = wp_remote_retrieve_body($response);
//     $products = json_decode($body, true);
//     return $products;
// }


function get_products_from_shop1() {
    $api_url = 'https://wordpressshop1.csoft.ca/wp-json/wc/v3/products';

    // Replace 'YOUR_CONSUMER_KEY' and 'YOUR_CONSUMER_SECRET' with the actual keys generated in WordPressShop1.
    $consumer_key = 'ck_223a270f3f8d2ea4f31b3f56bb6303af790b4bdd';
    $consumer_secret = 'cs_d738bbcaba68aa180e9f0189d2dfc4f6c0a34d50';

    $response = wp_remote_get($api_url, array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode($consumer_key . ':' . $consumer_secret),
        ),
    ));

    if (is_wp_error($response)) {
        // Handle error.
        error_log('Error fetching products from WordPressShop1: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $products = json_decode($body, true);

    if (is_array($products)) {
        return $products;
    } else {
        // Handle unexpected response format.
        error_log('Unexpected response format from WordPressShop1: ' . print_r($products, true));
        return false;
    }
}


