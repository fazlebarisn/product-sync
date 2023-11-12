<?php

    $fbs_col_price_color = fbs_isset_empty('price', 'price_color', '#808080');
    $fbs_col_price_font_size = fbs_isset_empty( 'price', 'price_font_size' , '15px' );
    $fbs_col_price_width = fbs_isset_empty( 'price', 'price_width' , 'unset' );

?>

<style>
    .fbs-cart-table tr td.product-price span.woocommerce-Price-amount.amount{
        color: <?php echo esc_html($fbs_col_price_color); ?>;
        font-size: <?php echo esc_html($fbs_col_price_font_size); ?>;
    }
    .fbs-cart-table tr td.product-price{
        width: <?php echo esc_html($fbs_col_price_width); ?>;
    }
</style>
<td class="product-price"  data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
    <?php
        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
    ?>
</td>