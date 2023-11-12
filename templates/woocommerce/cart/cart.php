<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

$fbs_options = get_option('fbs_cart_table');

$active_cols = $fbs_options['active_col'] ?? '';
// dd($fbs_options);

$fbs_col_product_title = fbs_isset_empty( 'name', 'name_col_title' , 'Product');
$fbs_col_qty_title = fbs_isset_empty( 'qty', 'qty_title' , 'Quantity');
$fbs_col_total_title = fbs_isset_empty( 'subtotal', 'subtotal_title' , 'Subtotal');

$fbs_thead_bg = fbs_isset_empty( 'design', 'thead_bg' , '#002933');
$fbs_thead_color = fbs_isset_empty( 'design', 'thead_color' , '#fff');
$fbs_thead_font_size = fbs_isset_empty( 'design', 'thead_font_size' , '15px' );
$fbs_thead_padding = fbs_isset_empty( 'design', 'thead_padding' , '20px 10px');
$fbs_thead_text_align = fbs_isset_empty( 'design', 'thead_text_align', 'left' );

$fbs_tbody_bg = fbs_isset_empty( 'design', 'tbody_bg' , '#fff');
$fbs_tbody_color = fbs_isset_empty( 'design', 'tbody_color', '#808080');

$fbs_tr_border = fbs_isset_empty( 'design', 'tr_border' , 'none');
$fbs_tr_bottom_border = fbs_isset_empty( 'design', 'tr_bottom_border' , 'none');
$fbs_tr_even_bg = fbs_isset_empty( 'design', 'tr_even_bg' , '#e9faff');
$fbs_tr_even_color = fbs_isset_empty( 'design', 'tr_even_color' , '#808080');

$fbs_td_border = fbs_isset_empty( 'design', 'td_border' , 'none');
$fbs_td_padding = fbs_isset_empty( 'design', 'td_padding' , '5px');
$fbs_td_text_align = fbs_isset_empty( 'design', 'td_text_align' , 'left' );
$fbs_td_font_size = fbs_isset_empty( 'design', 'td_font_size' , '15px' );

$fbs_cart_btn_bg = fbs_isset_empty( 'others', 'cart_btn_bg' , '#002933' );
$fbs_cart_btn_color = fbs_isset_empty( 'others', 'cart_btn_color' , '#fff' );
$fbs_cart_btn_text = fbs_isset_empty( 'others', 'cart_btn_text' , 'Update Cart' );

$fbs_coupon_btn_bg = fbs_isset_empty( 'others', 'coupon_btn_bg' , '#002933' );
$fbs_coupon_btn_color = fbs_isset_empty( 'others', 'coupon_btn_color' , '#fff' );
$fbs_coupon_btn_text = fbs_isset_empty( 'others', 'coupon_btn_text' , 'Apply Coupon' );
$fbs_c_box_boder_color = fbs_isset_empty( 'others', 'c_box_boder' , '1px solid #002933' );


do_action( 'woocommerce_before_cart' ); ?>
<style>
	table:not( .has-background ) tbody td {
    	background-color: transparent;
	}
	table:not( .has-background ) th {
    	background-color: transparent;
	}
	table:not( .has-background ) tbody tr:nth-child(2n) td{
    	background-color: transparent;
	}
	table.fbs-cart-table{
		border-collapse: collapse;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}
	table.cart td.actions{
		border-top: none;
		padding-top: 25px;
	}
	table.fbs-cart-table.shop_table  tr:nth-child(even) td.product-name a, 
	table.fbs-cart-table.shop_table  tr:nth-child(even) td.product-name,
	table.fbs-cart-table.shop_table  tr:nth-child(even) input.input-text.qty,
	table.fbs-cart-table.shop_table  tr:nth-child(even) span.woocommerce-Price-amount.amount,
	table.fbs-cart-table.shop_table  tr:nth-child(even) {
		background-color: <?php echo esc_html($fbs_tr_even_bg); ?>;
		color: <?php echo esc_html($fbs_tr_even_color )?>;
	}
	/* table.fbs-cart-table.shop_table tr:nth-child(odd) {
		background-color: #000;
	} */
	.fbs-cart-table thead tr{
		background-color: <?php echo esc_html($fbs_thead_bg); ?>;
		color: <?php echo esc_html($fbs_thead_color); ?>;
	}
	.fbs-cart-table tr th{
		padding: <?php echo esc_html($fbs_thead_padding); ?>;
		text-align: <?php echo esc_html($fbs_thead_text_align); ?>;
		font-size: <?php echo esc_html($fbs_thead_font_size); ?>;
	}
	.fbs-cart-table tr.woocommerce-cart-form__cart-item.cart_item {
    	background: <?php echo esc_html($fbs_tbody_bg); ?>;
    	color: <?php echo esc_html($fbs_tbody_color); ?>;
    	border: <?php echo esc_html($fbs_tr_border); ?>;
    	border-bottom: <?php echo esc_html($fbs_tr_bottom_border); ?>;
	}
	.fbs-cart-table tr.woocommerce-cart-form__cart-item.cart_item td{
		border: <?php echo esc_html($fbs_td_border); ?>;
		padding: <?php echo esc_html($fbs_td_padding); ?>;
		text-align: <?php echo esc_html($fbs_td_text_align); ?>;
		font-size: <?php echo esc_html($fbs_td_font_size); ?>;
		vertical-align: middle;
	}
	button.fbs-cart-btn.button {
    	background: <?php echo esc_html($fbs_cart_btn_bg); ?>;
    	color: <?php echo esc_html($fbs_cart_btn_color); ?>;
	}
	button.fbs-coupon-btn.button {
    	background: <?php echo esc_html($fbs_coupon_btn_bg); ?>;
    	color: <?php echo esc_html($fbs_coupon_btn_color); ?>;
	}
	.fbs-cart-table .coupon input.input-text {
    	border: <?php echo esc_html($fbs_c_box_boder_color); ?>;
	}
</style>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
<?php
	$all_col = ['remove', 'thumbnail', 'name', 'price', 'quantity', 'total'];
?>
	<table class="fbs-cart-table shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<?php 
				if( is_array( $active_cols ) && ! empty($active_cols) ){
					foreach( $active_cols as $key => $col ){
						include FBS_PRODUCT_SYNC_PATH . "templates/woocommerce/columns/thead/{$key}.php";
					}
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				/**
				 * Filter the product name.
				 *
				 * @since 2.1.0
				 * @param string $product_name Name of the product in the cart.
				 * @param array $cart_item The product in the cart.
				 * @param string $cart_item_key Key for the product in the cart.
				 */
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
						if( is_array( $active_cols ) && ! empty($active_cols) ){
							foreach( $active_cols as $key => $col ){
								include FBS_PRODUCT_SYNC_PATH . "templates/woocommerce/columns/{$key}.php";
							}
						}
						?>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr class="fbs-ct-action">
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
							<button type="submit" class=" fbs-coupon-btn button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
								<?php echo esc_html( $fbs_coupon_btn_text ); ?>
							</button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class=" fbs-cart-btn button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
						<?php echo esc_html( $fbs_cart_btn_text ); ?>
					</button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
