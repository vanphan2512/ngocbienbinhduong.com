<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $mr_tailor_theme_options;

//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title_loop_rating', 'woocommerce_template_loop_rating', 5 );

//woocommerce_before_shop_loop_item_title
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>

<div class="large-3  col-md-3 col-sm-6 col-xs-12 columns swiper-slide <?php if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 1) ) : ?>catalog_mode<?php endif; ?> ">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<?php
	if(!empty($_REQUEST['custom_product_id']))
	{
		$url=get_bloginfo('url').'/'.$_REQUEST['type'].'?custom_product_id='.$_REQUEST['custom_product_id'].'&same-product=1';
	?>
		<a href="<?php echo $url ?>">
	<?php
	}
	else
	{
	?>
		<div class="item-products">
		
	<?php
	}
	?>
		<?php
            $attachment_ids = $product->get_gallery_attachment_ids();
            if ( $attachment_ids ) {
                $loop = 0;
                foreach ( $attachment_ids as $attachment_id ) {
                    $image_link = wp_get_attachment_url( $attachment_id );
                    if (!$image_link) continue;
                    $loop++;
                    $product_thumbnail_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
                    if ($loop == 1) break;
                }
            }
        ?>
        
        <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
        
        <?php wc_get_template( 'loop/sale-flash.php' ); ?>
        
        <?php

        $style = '';
        $class = '';        
        if (isset($product_thumbnail_second[0])) {            
            $style = 'background-image:url(' . $product_thumbnail_second[0] . ')';
            $class = 'with_second_image';     
        }
        
        ?>
		
        
        <div class="phan product_thumbnail <?php echo $class; ?>">
			<!-- <span class="product_thumbnail_background" style="<?php echo $style; ?>"></span> -->
			<a href="<?php the_permalink(); ?>">
            	<div class="bg-hover" style="height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center; <?php echo $style; ?> "></div>
            </a>
        </div>
        
        <?php if ( !$product->is_in_stock() ) : ?>            
            <div class="out_of_stock_badge_loop <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php _e( 'Out of stock', 'mr_tailor' ); ?></div>            
        <?php endif; ?>

		
       <!--  <div class="text_content"><?php the_content(); ?></div> -->
	
	<h3 class="pro_title cd" style="font-family: benchnine !important;"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>

	</div>
    
</div>