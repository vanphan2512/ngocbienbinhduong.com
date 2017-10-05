<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<style type="text/css">
.succ-msg:before{display:none !important;}
	.succ-msg{ text-align:center;}
	.succ-msg i{ margin-right:5px;}
</style>
<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce-message succ-msg"><i class="fa fa-check"></i><?php echo wp_kses_post( $message ); ?></div>
<?php endforeach; ?>
