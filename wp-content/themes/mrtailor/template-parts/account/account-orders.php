<?php
global $orders_status_array;
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
?>

<?php if (isset($_GET['view_order']) && !empty($_GET['view_order']))	{ ?>
<?php
$order = get_post($_GET['view_order']);
$order_ID = $order->ID;
$cart = get_post_meta($order_ID, 'order_cart', true);
$voucher = get_post_meta($order_ID, 'voucher', true);
$order_shipping = get_post_meta($order_ID, 'order_shipping', true);
$subtotal = get_post_meta($order_ID, 'order_subtotal', true);
$total = get_post_meta($order_ID, 'order_total', true);
?>
<div class="orders-content">
	<div class="row-fluid">
		<div class="span12">
			<div class="order-title">
				<h1>Order <?php echo get_post_meta($order_ID, 'order_ID', true);; ?></h1>
				<a href="<?php echo get_permalink(2484) ?>" class="btn-gray">Back to Orders</a>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="order-shopping-content">
				<table class="cart-table">
					<tr class="table-cat">
						<td class="big-td"><p>Shopping Cart Contents</p></td>
						<td class="cell-hide640"><p>Unit Price</p></td>
						<td class="cell-hide640"><p>Quantity</p></td>
						<td><p>Total</p></td>
					</tr>
				<?php foreach ($cart as $key => $item)	{ $link = ""; $post_id = $item['product_id']; ?>
					<?php 
					if (get_field('images', $post_id))	{
						$x = 1; 
						while (has_sub_field('images', $post_id)) {
							if ($x == 1)	{
								$image = get_sub_field('image', $post_id);
								$link = $image['sizes']['thumbnail'];
							}
							$x++; 
						}
					} else {
						$link = get_field('image', $post_id);
					}
					?>
					<tr>
						<td class="big-td">
							<div class="order-img">
								<div class="order-img-screen">
									<img src="<?php echo $link; ?>" alt="<?php echo get_the_title($post_id); ?>" width="130" height="130">
								</div>
								<div class="order-img-details">
									<p><?php echo get_the_title($post_id); ?></p>
									<br>
									<?php if ( ( !empty( $item['extras'] ) && isset( $item['extras'] ) ) || ( !empty( $item['design'] ) && isset( $item['design'] ) ) )	{ ?>
									<a href="#" class="show-details">Show Details</a>
									<?php } ?>
									<div class="item-details">
									<?php if ( !empty( $item['design'] ) && isset( $item['design'] ) )	{ ?>
										<p class="bold">Design Details</p>
										<?php foreach ( $item['design'] as $k => $value )	{ $kname = ucfirst(str_replace("-", " ", $k)); ?>
										<p><span><?php echo $kname; ?>: </span><?php echo $value; ?></p>
										<?php } ?>
									<?php } ?>
									<?php if ( !empty( $item['extras'] ) && isset( $item['extras'] ) )	{ ?>
										<p class="bold">Extras Details</p>
										<?php
										if ($item['extras']['monogram'] == 'No')	{
											unset($item['extras']['position']);
											unset($item['extras']['color']);
											unset($item['extras']['custom-text']);
										}
										foreach ( $item['extras'] as $k => $value )	{
											if ($k != 'lining-code')	{
												$kname = ucfirst(str_replace("-", " ", $k));
										?>
										<p>
											<span><?php echo $kname; ?>: </span>
											<?php echo $value; ?>
											<?php if ($k == 'contrasting-collar-cuff-lining' && $item['extras']['lining-code'])	{ ?>
												- <?php echo get_the_title($item['extras']['lining-code']); ?>
											<?php } ?>
										</p>
										<?php 
											}
										}
										?>
									<?php } ?>
									</div>
								</div>
							</div>
						</td>
						<td class="cell-hide640">
							<p><?php echo get_currency_sign() . get_currency_price($item['price']); ?></p>
						</td>
						<td class="cell-hide640">
							<?php $quantities = array(1,2,3,4,5,6,7,8,9,10); ?>
							<select name="product-quantity" disabled>
							<?php foreach ($quantities as $qty)	{ ?>
								<option value="<?php echo $qty; ?>"<?php if ($item['quantity'] == $qty) {echo " selected";} ?>><?php echo $qty; ?></option>
							<?php } ?>
							</select>
						</td>
						<td><p><?php echo get_currency_sign() . get_currency_price($item['item_total_price']); ?></p></td>
					</tr>
				<?php } ?>
				</table>
			</div>
			<div class="order-shopping-total">
				<table>
					<tr>
						<td><p class="bold">Sub Total</p></td>
						<td colspan="2" style="text-align: right;">
							<p class="bold"><?php echo get_currency_code() . " " . get_currency_sign() . get_currency_price($subtotal); ?></p>
						</td>
					</tr>
					<tr>
						<td><p class="bold">Shipping</p></td>
						<td colspan="2" style="text-align: right;">
							<?php $field_value = sanitize_title($order_shipping['name']); ?>
							<div class="left">
								<input type="radio" name="shipping" class="shipping-button" id="<?php echo $field_value; ?>" value="<?php echo $field_value; ?>" checked disabled />
								<label for="<?php echo $field_value; ?>" class="bold">
									<?php echo $order_shipping['name']; ?>
								</label>
							</div>
							<p class="bold">
								<?php echo get_currency_code() . " " . get_currency_sign() . get_currency_price($order_shipping['price']); ?>
							</p>
						</td>
					</tr>
				<?php if ( isset($voucher) && !empty($voucher) )	{ ?>
					<tr>
						<td><p class="bold">Discount</p></td>
						<td colspan="2" style="text-align: right;">
							<p class="bold">- <?php echo get_currency_code() . " " . get_currency_sign() . get_currency_price($voucher['discount']); ?></p>
						</td>
					</tr>
				<?php } ?>
					<tr>
						<td><p class="bold">Total</p></td>
						<td colspan="2" style="text-align: right;">
							<p class="bold"><?php echo get_currency_code() . " " . get_currency_sign() . get_currency_price($total); ?></p>
						</td>
					</tr>
				</table>
						</div>
		</div>
	</div>
</div>
<?php } else {

$args = array( 'post_type' => 'product-orders', 'post_status' => 'private', 'posts_per_page' => -1, 'meta_key' => 'order_client_ID', 'meta_value' => $user_id );
$loop = new WP_Query( $args );?>
<div class="orders-content">
	<h3 class="tracking-info"><a href="#tracking" class="fancybox">How do I track my order?</a></h3>

	<table class="account-orders-table">
		<tr class="table-cat">
			<td><p>Order</p></td>
			<td><p>Date</p></td>
			<td class="cell-hide640"><p>Amount</p></td>
			<td class="cell-hide640"><p>Status</p></td>
			<td class="cell-hide640"><p>Tracking</p></td>
			<td class="cell-hide640"><p>Date Sent</p></td>
			<td></td>
		</tr>
	<?php if ($loop->have_posts())	: ?>
	<?php while ($loop->have_posts())	:	$loop->the_post(); $order_ID = get_the_ID(); ?>
		<tr>
			<td><p><?php echo get_post_meta($order_ID, 'order_ID', true); ?></p></td>
			<td><p><?php echo get_the_time( "M/d/Y", $order_ID ); ?></p></td>
			<td class="cell-hide640"><p><?php echo get_currency_code() . " " . get_currency_sign() . get_currency_price(get_post_meta($order_ID, 'order_total', true)); ?></p></td>
			<td class="cell-hide640"><p><?php echo $orders_status_array[get_post_meta($order_ID, 'order_status', true)]; ?></p></td>
			<td class="cell-hide640"><p><?php echo get_post_meta($order_ID, 'trackingID', true); ?></p></td>
			<td class="cell-hide640"><p><?php echo get_post_meta($order_ID, 'date_sent', true); ?></p></td>
			<td><a href="<?php echo get_permalink(2484) ?>?view_order=<?php echo $order_ID; ?>">View</a></td>
		</tr>
	<?php endwhile; ?>
	<?php else : ?>
		<tr>
			<td colspan="7" style="text-align: center;">
				<h4 class="no-message">You have not yet placed any orders.</h4>
			</td>
		</tr>
	<?php endif; ?>
	</table>
	<div class="dashboard-tracking" id="tracking">
		<p class="bold">What do i do with my tracking number?</p>
		<p>We dispatch your orders using Registered Air Mail</p>
		<p>Registered Air Mail gives you:</p>
		<ul>
			<li><p>- Proof that the article was sent(when lodged at the post office counter)</p></li>
			<li><p>- Proof that the article was received</p></li>
			<li><p>- A unique identification number for every article</p></li>
		</ul>
		<p>A registered post item has its details recorded in a register to enable its location to be tracked</p>
		<p>Registered post items are tracked via the government postal service in your country.</p>
		<p>To track your item you need to call your local government postal service and quote your registered tracking number.</p>
		<p>Note that the registered tracking number does not appear in the postal system until its scanned through customs in your country.</p>
	</div>
</div>
<?php } ?>