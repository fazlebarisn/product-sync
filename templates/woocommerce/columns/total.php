<?php 
    $fbs_col_total_color = fbs_isset_empty( 'subtotal', 'subtotal_color' , '#808080' );
    $fbs_col_total_font_size = fbs_isset_empty( 'subtotal', 'subtotal_font_size' , '15px' );
    $fbs_col_total_width = fbs_isset_empty( 'subtotal', 'subtotal_width' , 'unset' );
?>

<style>
    .fbs-cart-table tr td.product-subtotal span.woocommerce-Price-amount.amount{
        color: <?php echo esc_html($fbs_col_total_color); ?>;
        font-size: <?php echo esc_html($fbs_col_total_font_size); ?>;
    }
    .fbs-cart-table tbody tr td.product-subtotal{
        width: <?php echo esc_html($fbs_col_total_width); ?>;
    }
</style>
<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
    <?php
        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
    ?>
</td>