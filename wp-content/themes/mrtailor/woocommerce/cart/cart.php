<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action('woocommerce_before_cart'); ?>

<div class="cart_container">

    <form action="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" method="post">

        <?php do_action('woocommerce_before_cart_table'); ?>

        <div class="row">
            <div class="large-10 large-centered columns">

                <table class="shop_table cart" cellspacing="0">

                    <thead>
                        <tr>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name"><?php _e('Product', 'mr_tailor'); ?></th>
                            <th class="product-quantity">
                                <span class="show-for-small-only text-center product_quantity_mobile"><?php _e('Qty', 'mr_tailor'); ?></span>
                                <span class="show-for-medium-up"><?php _e('Quantity', 'mr_tailor'); ?></span>
                            </th>	
                            <th class="product-subtotal"><?php _e('Total', 'mr_tailor'); ?></th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php do_action('woocommerce_before_cart_contents'); ?>

                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                ?>
                                <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                    <td class="product-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                        if (!$_product->is_visible())
                                            echo $thumbnail;
                                        else
                                            printf('<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail);
                                        ?>
                                    </td>

                                    <td class="product-name">
                                        <?php
                                        if (!$_product->is_visible()) {
                                            echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                                        } else {
                                            //echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
                                            $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                                            ?>
                                            <a href="<?php echo get_permalink($product_id); ?>"><?php echo $product_name; ?></a>
                                            <?php
                                        }

                                        // Price
                                        //echo '<div>' . apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) . '</div>';
                                        //echo 'Show Details | Edit Product | Design Similar';
                                        $terms = get_the_terms($cart_item['product_id'], 'product_cat');
                                        //echo $terms[0]->term_id;
                                        if ($terms[0]->term_id == 73) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/custom-design?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/design-your-own/?type=custom-design&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        } elseif ($terms[0]->term_id == 74) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/design-jackets?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/jackets/?type=design-jackets&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        } elseif ($terms[0]->term_id == 75) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/design-blazers?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/blazer/?type=design-blazers&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        } elseif ($terms[0]->term_id == 76) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/design-pants?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/pants/?type=design-pants&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        } elseif ($terms[0]->term_id == 77) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/design-chinos?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/chinos/?type=design-chinos&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        } elseif ($terms[0]->term_id == 78) {
                                            echo '<ul class="cart_edit_nnv"><li><a href="javascript:void(0);" onclick="show_hide(' . $cart_item['product_id'] . ');">Show Details</a></li><li><a href="' . get_bloginfo('url') . '/design-suits?action=edit_product&custom_product_id=' . $cart_item['product_id'] . '">Edit Product</a></li><li><a href="' . get_bloginfo('url') . '/product-category/suits/?type=design-suits&custom_product_id=' . $cart_item['product_id'] . '">Design Similar</a></li></ul>';
                                        }


                                        // Meta data
                                        echo WC()->cart->get_item_data($cart_item);

                                        // Backorder notification
                                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                            echo '<p class="backorder_notification">' . __('Available on backorder', 'mr_tailor') . '</p>';
                                        ?>
                                    </td>

                                    <td class="product-quantity">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                    ), $_product, false);
                                        }

                                        if ($terms[0]->term_id == 80) {
                                            $product_quantity = woocommerce_quantity_input(array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => 1,
                                                    ), $_product, false);
                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key);
                                        } else {
                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key);
                                        }
                                        ?>
                                    </td>

                                    <td class="product-subtotal">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                        ?>
                                    </td>

                                    <td class="product-remove">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><i class="getbowtied-icon-close_regular"></i></a>', esc_url(WC()->cart->get_remove_url($cart_item_key)), __('Remove this item', 'mr_tailor')), $cart_item_key);
                                        ?>
                                    </td>

                                </tr>

                                <!--This section for show/hide detail -->

                                <tr class="show_hide">

                                    <td colspan="5" id="product-detail-<?php echo $cart_item['product_id'] ?>" style="display:none;">

                                        <div class="product-detail-<?php echo $cart_item['product_id'] ?>">

                                            <div class="col">

                                                <h3>Design</h3>
                                                <ul>
                                                    <?php
                                                    
                                                    if (metadata_exists('post', $cart_item['product_id'], 'design')) {
                                                        $design_meta = unserialize(get_post_meta($cart_item['product_id'], 'design', true));
                                                        //echo '<li><span>Products : </span>' . $_product->get_title(). '</li>';
                                                        
                                                        $ext_meta_proid = get_post_meta($cart_item['product_id'], 'parent_product_id', true);
                                                        echo '<li><span>Products : </span>' .get_the_title($ext_meta_proid). '</li>';
                                                        foreach ($design_meta as $key => $value) {
                                                            if (!empty($value)) {
                                                                echo '<li><span>' . ucfirst($key) . ' : </span>' . $value . '</li>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </ul>

                                            </div>

                                            <div class="col">
                                                <?php
                                                $ext_meta = unserialize(get_post_meta($cart_item['product_id'], 'extras', true));
                                                if (count($ext_meta) > 0) {
                                                    ?>
                                                    <h3>Extras</h3>
                                                    <?php
                                                }
                                                ?>
                                                <ul>

                                                    <?php
                                                    if (metadata_exists('post', $cart_item['product_id'], 'extras')) {
                                                        $design_meta = unserialize(get_post_meta($cart_item['product_id'], 'extras', true));
                                                        if (count($design_meta) > 0) {

                                                            foreach ($design_meta as $key => $value) {
                                                                if (!empty($value)) {

                                                                    $pos = strrpos($value, "-");
                                                                    $str_len = strlen($value);
                                                                    if (!empty($pos)) {
                                                                        echo '<li><span>' . ucfirst($key) . ' : </span>' . substr($value, 0, $pos) . '</li>';
                                                                    } else {
                                                                        echo '<li><span>' . ucfirst($key) . ' : </span>' . $value . '</li>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </ul>

                                            </div>

                                            <div class="col">

                                                <h3>Sizing</h3>
                                                <ul>
                                                    <?php
                                                     global $wpdb;
                                                    $p_id = $cart_item['product_id'];
                                                    $measure = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='measure_your_shirt' and post_id=$p_id");
                                                    $measurement = unserialize($measure);
                                                    $measure1 = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='measure_your_body' and post_id=$p_id");
                                                    $measurement1 = unserialize($measure1);
                                                    
                                                     if (metadata_exists('post', $cart_item['product_id'], 'measure_your_shirt') && !empty($measurement['neck'])) {
                                                     	foreach ($measurement as $selected_key => $selected_values_option) {
                                                            if (!empty($selected_values_option)) {
                                                                if (($selected_key != 'general' && $selected_key=='profile-name') || ($selected_key != 'general' && $selected_key=='value-type')) {
                                                                    echo '<li><span>' . ucfirst($selected_key) . ' : </span>' . $selected_values_option . '</li>';
                                                                }
                                                            }
                                                        }
                                                        foreach ($measurement as $selected_key => $selected_values_option) {
                                                            if (!empty($selected_values_option)) {
                                                                if (($selected_key != 'general' && $selected_key!='profile-name') && ($selected_key != 'general' && $selected_key!='value-type')) {
                                                                    echo '<li><span>' . ucfirst($selected_key) . ' : </span>' . $selected_values_option . '</li>';
                                                                }
                                                            }
                                                        }                                                    

                                                    }else if (metadata_exists('post', $cart_item['product_id'], 'measure_your_body')) {

                                                    	foreach ($measurement1 as $selected_key => $selected_values_option) {
                                                            if (!empty($selected_values_option)) {
                                                                if (($selected_key != 'general' && $selected_key=='profile-name') || ($selected_key != 'general' && $selected_key=='value-type')) {
                                                                    echo '<li><span>' . ucfirst($selected_key) . ' : </span>' . $selected_values_option . '</li>';
                                                                }
                                                            }
                                                        }
                                                        foreach ($measurement1 as $selected_key => $selected_values_option) {
                                                            if (!empty($selected_values_option)) {
                                                                if (($selected_key != 'general' && $selected_key!='profile-name') && ($selected_key != 'general' && $selected_key!='value-type')) {
                                                                    echo '<li><span>' . ucfirst($selected_key) . ' : </span>' . $selected_values_option . '</li>';
                                                                }
                                                            }
                                                        }

                                                        foreach ($measurement1['general'] as $selected_key => $selected_values_option) {
                                                            if (!empty($selected_values_option)) {
                                                                if ($selected_key != 'general') {
                                                                    echo '<li><span>' . ucfirst($selected_key) . ' : </span>' . $selected_values_option . '</li>';
                                                                }
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
                            }
                        }

                        do_action('woocommerce_cart_contents');
                        ?>

                        <?php do_action('woocommerce_after_cart_contents'); ?>

                    </tbody>
                </table>

                <?php do_action('woocommerce_after_cart_table'); ?>

            </div><!-- .columns -->
        </div><!-- .row -->

        <div class="cart-buttons">                

            <div class="row">

                <div class="medium-6 large-5 large-push-1 columns">
                    <?php if (WC()->cart->coupons_enabled()) { ?>
                        <div class="coupon">

                            <input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e('Enter Coupon Code', 'mr_tailor'); ?>" /><input type="submit" class="button apply_coupon" name="apply_coupon" value="<?php _e('Apply', 'mr_tailor'); ?>" />

                            <?php do_action('woocommerce_cart_coupon'); ?>

                        </div>
                    <?php } ?>
                </div><!-- .columns -->

                <div class="medium-6 large-5 large-pull-1 columns">
                    <div class="update_and_checkout">                
                        <input type="submit" class="button update_cart" name="update_cart" value="<?php _e('Update Cart', 'mr_tailor'); ?>" />
                        <input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e('Proceed to Checkout', 'mr_tailor'); ?>" />                
                    </div>
                </div><!-- .columns -->

            </div><!-- .row -->

            <?php do_action('woocommerce_proceed_to_checkout'); ?>
            <?php wp_nonce_field('woocommerce-cart') ?>

        </div>

    </form>

    <?php do_action('woocommerce_after_cart'); ?>

    <div class="cart-collaterals">

        <div class="row">
            <div class="large-10 large-centered columns">

                <div class="row">

                    <div class="medium-6 columns medium-push-6">
                        <?php woocommerce_cart_totals(); ?>
                        <?php woocommerce_shipping_calculator(); ?>
                    </div><!-- .columns -->		

                    <div class="medium-6 columns medium-pull-6 show-for-medium-up">
                        <div class="row">
                            <?php do_action('woocommerce_cart_collaterals'); ?>
                        </div><!-- .row -->
                    </div><!-- .columns -->

                </div><!-- .row -->

            </div><!-- .columns -->    
        </div><!-- .row -->

    </div><!-- .cart-collaterals -->

</div><!-- .cart_container-->