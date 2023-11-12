<?php 
    $fbs_col_qty_color = fbs_isset_empty( 'qty', 'qty_color' , '#808080');
    $fbs_col_qty_font_size = fbs_isset_empty( 'qty', 'qty_font_size' , '15px' );
    $fbs_col_qty_width = fbs_isset_empty( 'qty', 'qty_width' , 'unset' );
?>

<style>
    .fbs-cart-table tr td.product-quantity input.input-text.qty{
        color: <?php echo esc_html($fbs_col_qty_color); ?>;
        font-size: <?php echo esc_html($fbs_col_qty_font_size); ?>;
        
    }
    .fbs-cart-table tbody tr td.product-quantity{
        width: <?php echo esc_html($fbs_col_qty_width); ?>;
    }
</style>

<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
    <?php
    if ( $_product->is_sold_individually() ) {
        $min_quantity = 1;
        $max_quantity = 1;
    } else {
        $min_quantity = 0;
        $max_quantity = $_product->get_max_purchase_quantity();
    }

    $product_quantity = woocommerce_quantity_input(
        array(
            'input_name'   => "cart[{$cart_item_key}][qty]",
            'input_value'  => $cart_item['quantity'],
            'max_value'    => $max_quantity,
            'min_value'    => $min_quantity,
            'product_name' => $product_name,
        ),
        $_product,
        false
    );

    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
    ?>
</td>