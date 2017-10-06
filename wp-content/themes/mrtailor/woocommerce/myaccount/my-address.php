<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'mr_tailor' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'mr_tailor' ),
		'shipping' => __( 'Shipping Address', 'mr_tailor' )
	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'mr_tailor' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'mr_tailor' )
	), $customer_id );
}

$col = 1;
?>

<h2><?php echo $page_title; ?></h2>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'mr_tailor' ) ); ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '<div class="row">'; ?>

<?php foreach ( $get_addresses as $name => $title ) : ?>

    <div class="medium-6 columns">
		<header class="title">
			<h3 class="myaccount_address_headers"><?php echo $title; ?></h3>
		</header>
		<address>
			<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'     => get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address )
					_e( 'You have not set up this type of address yet.', 'mr_tailor' );
				else
					echo $formatted_address;
			?>
		</address>
        <div class="edit-link">
			<i class="fa fa-pencil-square-o"></i>
			<?php
			 $str_url=wc_get_endpoint_url( 'edit-address', $name );
			$url=str_replace("my-accounts","my-account",$str_url);
			?>
			<!--<a href="<?php //echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="post-edit-link"><?php _e( 'Edit', 'mr_tailor' ); ?></a>-->
			<a href="<?php echo $url ?>" class="post-edit-link"><?php _e( 'Edit', 'mr_tailor' ); ?></a>
		</div>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '</div>'; ?>