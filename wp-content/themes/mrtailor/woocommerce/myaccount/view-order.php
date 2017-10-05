<?php
/**
 * Order details
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order = wc_get_order( $order_id );
?>

<div class="row">
    <div class="large-8 large-centered columns">

        <h2>Order #<?php echo $order_id;?> Details</h2>

        <div class="my_account_container order_details_table">
        <table class="shop_table order_details">
            <thead>
                <tr>
                    <th class="product-thumbnail"><?php _e( 'Product', 'mr_tailor' ); ?></th>
                    <th class="product-name">&nbsp;</th>
                    <th class="product-thumbnail">Quantity</th>
                    <th class="product-total"><?php _e( 'Total', 'mr_tailor' ); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ( sizeof( $order->get_items() ) > 0 ) {

                    foreach( $order->get_items() as $item ) {
                        $_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
                        $item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );
                        $product_id = $item['product_id'];                        
                        ?>
                        <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
                            <td class="product-thumbnail product-img">
                            <?php
                                
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $_product->id),'large',false);
								$image = apply_filters('woocommerce_order_product_image', '<img src="'.$src[0].'" alt="Product Image" height="auto" width="100%" style="vertical-align:middle; margin-right: 10px;" />', $_product);
                                 $id = isset( $item['variation_id'] ) ? $item['variation_id'] : $item['product_id'];
								$image_default = wc_get_product($id);
								if($src[0] != '' and $src[0] != null){
									echo $image;
								}else{									
									echo $image_default->get_image();
								}
                            ?>
                            </td>
                            <td class="product-name">
                               <ul class="list_prodcut">
                                    <li>
                                         <?php
                                        if ( $_product && ! $_product->is_visible() )
                                            echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
                                        else
                                            echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
                                            ?>
                                            
                                            <?php
                                          //  echo apply_filters( 'woocommerce_order_item_quantity_html', ' <span class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</span>', $item );
    
                                        $item_meta->display();
    
                                        if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {
    
                                            $download_files = $order->get_item_downloads( $item );
                                            $i              = 0;
                                            $links          = array();
    
                                            foreach ( $download_files as $download_id => $file ) {
                                                $i++;
    
                                                $links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'mr_tailor' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
                                            }
    
                                            echo '<br/>' . implode( '<br/>', $links );
                                        }
                                    ?>
                                    </li>
                                    <li class="text_showdetails">
                                        <!--
                                        <button class="flip">Show Details</button>-->
                                        
                                        <a href="javascript:void(0);" onclick="show_hide2(<?php echo $product_id; ?>);">Show Details</a>
                                    </li>
                               </ul>
                            </td>
                            <td class="product-quantity">
                               <?php echo $item['qty']; ?>
                            </td>
                            <td class="product-total">
                                <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                            </td>
                        </tr>
                        <!--This section for show/hide detail--->
                           <tr class="show_hide">								
								<td colspan="4" id="product-detail-oder-<?php echo $product_id; ?>" style="display:none;">								
									<div class="product-detail-<?php echo $product_id;  ?>">									
									<div class="col">									
									<h3 style="text-transform: none;">Design</h3>
									<ul>
                                    <?php                                        
                                        //echo '<li style="text-transform: none;"><span>Products : </span>' .$item['name']. '</li>';
//                                        $test=get_field('design',$product_id); 
//                                        echo '<pre>';
//                                        var_dump($test);                                    
//                                        echo '</pre>';
                                        if (metadata_exists('post', $product_id, 'design')) {
                                                    $design_meta = get_field('design',$product_id);
                                                    echo '<li style="text-transform: none;float: none;"><span>Products : </span>' .$item['name']. '</li>';                                                 
                                                    foreach ($design_meta as $key => $value) {
                                                        if (!empty($value)) {
                                                            echo '<li style="float: none;text-transform: none;"><span>' . ucfirst($key) . ' : </span>' . $value . '</li>';
                                                        }
                                                    }
                                        };                                        
                                     ?>
									</ul>
									
									</div>
                                    <div class="col">									
    									<h3 style="text-transform: none;">Extras</h3>
    									<ul>
                                        <?php                                        
                                            	
                                                if (metadata_exists('post', $product_id, 'extras')) {
                                                    $design_meta = get_field('extras',$product_id);                                                 
                                                    foreach ($design_meta as $key => $value) {
                                                        if (!empty($value)) {
                                                            echo '<li style="float: none;text-transform: none;"><span>' . ucfirst($key) . ' : </span>' . $value . '</li>';
                                                        }
                                                    }
                                                }
                                                      
                                         ?>
    									</ul>
    									
    									</div>
                                        <div class="col">									
    									<h3 style="text-transform: none;">Sizing</h3>
    									<ul>
                                        <?php                                        
                                            	
                                                if (metadata_exists('post', $product_id, 'sizing')) {
                                                    $design_meta = get_field('sizing',$product_id);                                                 
                                                    foreach ($design_meta as $key => $value) {
                                                        if (!empty($value)) {
                                                            echo '<li style="float: none;text-transform: none;"><span>' . ucfirst($key) . ' : </span>' . $value . '</li>';
                                                        }
                                                    }
                                                }
                                                      
                                         ?>
    									</ul>
    									
    									</div>
									</div>
									
								</td>
								
								</tr>
                         <!--End show/hide detail --->   
                                 
                        <?php

                        if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
                            ?>
                            <tr class="product-purchase-note">
                                
                                <td colspan="3"><?php echo wpautop( do_shortcode( $purchase_note ) ); ?></td>
                            </tr>
                            <?php
                        }
                    }
                }

                do_action( 'woocommerce_order_items_table', $order );
                ?>
            </tbody>
            </table>
  
            <div class="order_details_footer_container">
                <table class="shop_table order_details_footer">
            <?php
                if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
                    ?>
                    <tr>
                                <td scope="row"><?php echo $total['label']; ?></td>
                                <td class="product-total"><?php echo $total['value']; ?></td>
                    </tr>
                    <?php
                endforeach;
            ?>
        </table>
                <div class="clear"></div>
                <?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
            </div>

    </div><!-- .order_details_table-->

    <div class="clear"></div>

        <header>
        <h3><?php _e( 'Customer details', 'mr_tailor' ); ?></h3>
        </header>
        <dl class="customer_details">
        <?php
            if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'mr_tailor' ) . '</dt><dd>' . $order->billing_email . '</dd>';
            if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'mr_tailor' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

            // Additional customer details hook
            do_action( 'woocommerce_order_details_after_customer_details', $order );
        ?>
        </dl>

        <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

    <div class="row">

        <div class="medium-6 columns">

        <?php endif; ?>

                <header class="title">
                    <h3><?php _e( 'Billing Address', 'mr_tailor' ); ?></h3>
                </header>
                <address>
                    <?php
                        if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'mr_tailor' ); else echo $order->get_formatted_billing_address();
                    ?>
                </address>

        <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

        </div><!-- /.large-6 -->

        <div class="medium-6 columns">

                <header class="title">
                    <h3><?php _e( 'Shipping Address', 'mr_tailor' ); ?></h3>
                </header>
                <address>
                    <?php
                        if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'mr_tailor' ); else echo $order->get_formatted_shipping_address();
                    ?>
                </address>

        </div><!-- /.large-6 -->

    </div><!-- /.row -->

        <?php endif; ?>

        <div class="clear"></div>

    </div><!-- .medium-8-->
</div><!-- .row-->