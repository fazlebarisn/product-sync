<td class="product-remove">
    <?php
        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            'woocommerce_cart_item_remove_link',
            sprintf(
                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                /* translators: %s is the product name */
                esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                esc_attr( $product_id ),
                esc_attr( $_product->get_sku() )
            ),
            $cart_item_key
        );
    ?>
</td>