<?php 

$fbs_col_name_link = $fbs_options['name']['name_link'] ?? false;
$fbs_col_name_color = fbs_isset_empty( 'name', 'name_color' , '#808080');
$fbs_col_name_font_size = fbs_isset_empty( 'name', 'name_font_size' , "15px");
$fbs_col_name_width = fbs_isset_empty( 'name', 'name_width' , 'unset' );
 
?>
<style>
    .fbs-cart-table tr td.product-name a,
    .fbs-cart-table tr td.product-name{
        color: <?php echo esc_html($fbs_col_name_color); ?>;
        font-size: <?php echo esc_html($fbs_col_name_font_size); ?>;
    }
    .fbs-cart-table tr td.product-name{
        width: <?php echo esc_html($fbs_col_name_width); ?>;
    }
</style>
<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
    <?php
        if ( ! $product_permalink ) {
            echo wp_kses_post( $product_name . '&nbsp;' );
        } else {
            /**
                * This filter is documented above.
                *
                * @since 2.1.0
                */
            if( 'on' == $fbs_col_name_link ){
                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf(  $_product->get_name(), $cart_item, $cart_item_key ) ));
            }else{
                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
            }
        }

        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

        // Meta data.
        echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

        // Backorder notification.
        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
        }
    ?>
</td>