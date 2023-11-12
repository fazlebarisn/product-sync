<?php
    $data= $_product->get_data();
    $stock = $data['stock_status'];
?>

<td class="product-stock" data-title="<?php esc_attr_e( 'Stock', 'fbs-cart-table-pro' ); ?>">
    <?php
    if ( ! $_product->managing_stock() && 'instock' == $stock){
        echo "<p class='stock in-stock wpt_instock'>In Stock</p>";
    }else{
        echo wc_get_stock_html( $_product );
    }
    ?>
</td>