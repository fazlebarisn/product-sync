<?php 

$fbs_col_thumb_width = fbs_isset_empty( 'thumbnail', 'thumb_width' , "80px");
$fbs_col_thumb_height = fbs_isset_empty( 'thumbnail', 'thumb_height' , "80px");

?>

<style>
    .fbs-cart-table td.product-thumbnail img.attachment-woocommerce_thumbnail {
        max-width: unset;
        width: <?php echo esc_html($fbs_col_thumb_width); ?>;
        height: <?php echo esc_html($fbs_col_thumb_height); ?>;
    }
</style>
<td class="product-thumbnail">
    <?php
        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
        if ( ! $product_permalink ) {
            echo $thumbnail; // PHPCS: XSS ok.
        } else {
            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
        }
    ?>
</td>