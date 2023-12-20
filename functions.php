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
         fbs_update_or_create_terms();
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
            $product_data = array();

            // Ensure that only valid WooCommerce product fields are copied
            $valid_keys = array(
                'name',
                'type',
                'regular_price',
                'sale_price',
                'description',
                'short_description',
                'sku',
                'stock_status',
                'featured',
                'weight',
                'dimensions',
                'virtual',
                'downloadable',
                'downloads',
                'download_limit',
                'download_expiry',
                'external_url',
                'button_text',
                'tax_status',
                'tax_class',
                'manage_stock',
                'stock_quantity',
                'backorders',
                'backorders_allowed',
                'backordered',
                'low_stock_amount',
                'sold_individually',
                'shipping_required',
                'shipping_taxable',
                'shipping_class',
                'shipping_class_id',
                'reviews_allowed',
                'upsell_ids',
                'cross_sell_ids',
                'parent_id',
                'purchase_note',
                'categories',
                'tags',
                'images', // Include the 'images' key for handling images
                'attributes',
                'default_attributes',
                'variations',
                'grouped_products',
                'menu_order',
                'price_html',
                'related_ids',
                'meta_data',
                'stock_status',
                'has_options',
                'post_password',
            );

            // We can modify the product fileds using the filter hook
            $valid_keys = apply_filters( 'fbs_product_fileds', $valid_keys );

            foreach ($valid_keys as $key) {
                if (isset($product_from_shop1[$key])) {
                    $product_data[$key] = $product_from_shop1[$key];
                }
            }

            if ($existing_product_id) {
                // Product exists, update it
                $existing_product = wc_get_product($existing_product_id);
                $existing_product->set_props($product_data);
                $existing_product->save();

                // Update product images
                $gallery_images = $product_from_shop1['images'];
                $gallery_image_ids = array();

                // Handle product image separately
                if (!empty($gallery_images)) {
                    $product_image_url = $gallery_images[0]['src'];
                    $product_image_id = fbs_upload_image_from_url($product_image_url);
                    if ($product_image_id) {
                        $existing_product->set_image_id($product_image_id);
                    }
                }

                // Handle gallery images
                for ($i = 1; $i < count($gallery_images); $i++) {
                    $attachment_id = fbs_upload_image_from_url($gallery_images[$i]['src']);
                    if ($attachment_id) {
                        $gallery_image_ids[] = $attachment_id;
                    }
                }

                $existing_product->set_gallery_image_ids($gallery_image_ids);
                $existing_product->save();
            } else {
                // Product doesn't exist, create it
                $new_product = wc_get_product($product_id);

                if (!$new_product || !$new_product->get_id()) {
                    $new_product = new WC_Product();
                    $new_product->set_props($product_data);
                    $new_product->save();

                    // Update product image
                    $product_image_url = $product_from_shop1['images'][0]['src'];
                    $product_image_id = fbs_upload_image_from_url($product_image_url);
                    if ($product_image_id) {
                        $new_product->set_image_id($product_image_id);
                    }

                    // Update gallery images
                    $gallery_images = $product_from_shop1['images'];
                    $gallery_image_ids = array();

                    for ($i = 1; $i < count($gallery_images); $i++) {
                        $attachment_id = fbs_upload_image_from_url($gallery_images[$i]['src']);
                        if ($attachment_id) {
                            $gallery_image_ids[] = $attachment_id;
                        }
                    }

                    $new_product->set_gallery_image_ids($gallery_image_ids);
                    $new_product->save();
                }
            }
        }
    }
}

/**
 * Function to upload an image from a URL and return the attachment ID
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
function fbs_upload_image_from_url($image_url) {
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);

    $filename = basename($image_url);

    if (wp_mkdir_p($upload_dir['path'])) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    $attachment_id = wp_insert_attachment($attachment, $file);

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attachment_data = wp_generate_attachment_metadata($attachment_id, $file);
    wp_update_attachment_metadata($attachment_id, $attachment_data);

    return $attachment_id;
}

/**
 * get products via api
 * @return array $products
 * @since 1.0.0
 * @author Fazle Bari <fazlebarisn@gmail.com>
 */ 
 function fbs_get_products_from_shop1() {
     $api_url = 'https://modern.cansoft.com/db-clone/api/j3-mijoshop-product?key=58fff5F55dd444967ddkhzf&clone_status=All';
 
     // $consumer_key and $consumer_secret keys generated in WordPressShop1.
     //$consumer_key = 'ck_223a270f3f8d2ea4f31b3f56bb6303af790b4bdd';
     //$consumer_secret = 'cs_d738bbcaba68aa180e9f0189d2dfc4f6c0a34d50';
 
     $response = wp_remote_get($api_url);
 
     if (is_wp_error($response)) {
         // Handle error.
         error_log('Error fetching products from WordPressShop1: ' . $response->get_error_message());
         return false;
     }
 
     $body = wp_remote_retrieve_body($response);
     $products = json_decode($body, true);
     dd($products);
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
