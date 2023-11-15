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
 * Add menu to the deshboard
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
function fbs_add_synchronize_button() {
    add_menu_page('Synchronize Products', 'Products Sync', 'manage_options', 'synchronize-products', 'fbs_synchronize_products');
}
add_action('admin_menu', 'fbs_add_synchronize_button');
 
 /**
 * Add HTML for the synchronization button and any status messages.
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
 function fbs_synchronize_products() {
     echo '<div class="wrap">';
     echo '<h2>Synchronize Products</h2>';
 
     // Check if the button is clicked.
     if (isset($_POST['sync_button'])) {
         // Call the function to synchronize products.
         fbs_synchronize_products_function();
         echo '<div class="updated"><p>Products synchronized successfully!</p></div>';
     }

     echo '<form method="post">';
     echo '<p> Click the button below to synchronize products</p>';
     echo '<input type="submit" class="button button-primary" name="sync_button" value="Synchronize Products">';
     echo '</form>';
     echo '</div>';
 }
 
/**
 * Synchronize products function
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
function fbs_synchronize_products_function() {
    // Get products from WordPressShop1
    $products_from_shop1 = fbs_get_products_from_shop1();

    if (is_array($products_from_shop1) && !empty($products_from_shop1)) {
        foreach ($products_from_shop1 as $product_from_shop1) {
            $product_id = $product_from_shop1['id'];

            // Check if the product already exists in WordPressShop2 using SKU
            $existing_product_id = wc_get_product_id_by_sku($product_from_shop1['sku']);

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
                // 'brand' => $product_from_shop1['meta_data'][0]['value'], // Assuming 'brand' is stored in meta_data
                // Add other product data fields as needed.
            );

            if ($existing_product_id) {
                // Product exists, update it
                $existing_product = wc_get_product($existing_product_id);
                $existing_product->set_props($product_data);
                $existing_product->save();
            } else {
                // Product doesn't exist, create it
                $new_product = wc_get_product($product_id);

                if (!$new_product || !$new_product->get_id()) {
                    $new_product = new WC_Product();
                    $new_product->set_props($product_data);
                    $new_product->save();
                }
            }
        }
    }
}


/**
 * get products via api
 * @return array $products
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
 function fbs_get_products_from_shop1() {
     $api_url = 'https://wordpressshop1.csoft.ca/wp-json/wc/v3/products';
 
     // $consumer_key and $consumer_secret keys generated in WordPressShop1.
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
    //  dd($products);
     if (is_array($products)) {
         return $products;
     } else {
         // Handle unexpected response format.
         error_log('Unexpected response format from WordPressShop1: ' . print_r($products, true));
         return false;
     }
 }

/**
 * Define the function to update or create terms
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
function fbs_update_or_create_terms() {
    $url = 'https://wordpressshop1.csoft.ca/wp-json/fbs-api/v1/get_brand_terms/';

    // Fetch data from the URL
    $response = wp_remote_get($url);
    $data = wp_remote_retrieve_body($response);
    $data = json_decode($data, true);

    // Loop through the terms and insert/update them
    foreach ($data as $term) {
        $term_id = $term['term_id'];
        $name = $term['name'];
        $slug = $term['slug'];

        // Check if the term already exists
        $existing_term = get_term($term_id, 'brand');

        if ($existing_term !== null && !is_wp_error($existing_term)) {
            // Term exists, update it
            wp_update_term($term_id, 'brand', ['name' => $name, 'slug' => $slug]);
            // echo "Updated term: $term_id\n";
        } else {
            // Term doesn't exist, create it
            wp_insert_term($name, 'brand', ['slug' => $slug]);
        }
    }

}
