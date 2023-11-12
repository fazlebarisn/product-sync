<?php
$fbs_col_price_title = fbs_isset_empty( 'price', 'price_title' , 'Price' );
?>
<th class="product-price"><?php esc_html_e( $fbs_col_price_title ); ?></th>