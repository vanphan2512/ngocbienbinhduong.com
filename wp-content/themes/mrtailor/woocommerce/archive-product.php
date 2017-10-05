<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$category_header_src = "";

if (function_exists('woocommerce_get_header_image_url')) $category_header_src = woocommerce_get_header_image_url();

get_header('shop');

?>
<style type="text/css" media="screen">
    .dropdown dd, .dropdown p {margin: 0px; padding: 0px;}
    .dropdown ul {
        margin: -1px 0 0 0;
    }
    .dropdown dd {
        position:relative;
    }
    .dropdown a,
    .dropdown a:visited {
        color:#222222;
        text-decoration:none;
        outline:none;
        font-size: 12px;
        background-color: #fafafa;
    }
    .dropdown dt a {
        color: #222222;
        display:block;
        padding: 2px;
        min-height: 37px;
        line-height: 24px;
        overflow: hidden;
        border:1px solid #dddddd;
    }
    .dropdown dt a span, .multiSel span {
        cursor:pointer;
        display:inline-block;
        padding: 4px 2px 4px 10px;
        font-size: 14px;
        color: #222222;
    }
    .dropdown dd ul {
        background-color: #fff;
        border:1px solid #dddddd;
        border-top: none;
        color:#222222;
        display:none;
        left:0px;
        padding: 0px 15px 2px 5px;
        position:absolute;
        top:-4px;
        width:100%;
        list-style:none;
        height: 150px;
        overflow: auto;
        z-index: 999;
    }
    .dropdown span.value {
        display:none;
    }
    .dropdown dd ul li input {
        margin-right:5px;
        margin-bottom: 0px;
    }
    .hida {font-family:'lato' !important;}
    .mutliSelect ul li {font-family: 'BenchNine', sans-serif !important; font-size: 13px;}
</style>

	<div id="primary" class="content-area">

        <div class="category_header <?php if ($category_header_src != "") : ?>with_featured_img<?php endif; ?>" style="background-image:url(<?php echo $category_header_src ; ?>)">

            <div class="category_header_overlay"></div>

            <div class="row">
                <div class="large-8 large-centered columns">

                    <?php do_action('woocommerce_before_main_content'); ?>

                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                        <h1 class="page-title shop_page_title"><?php woocommerce_page_title(); ?></h1>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_archive_description' ); ?>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="large-12 columns">
                 <div id="content" class="site-content" role="main">
                        <?php
                        				/**
                        				 * woocommerce_before_shop_loop hook
                        				 *
                        				 * @hooked woocommerce_result_count - 20
                        				 * @hooked woocommerce_catalog_ordering - 30
                        				 */
                        				do_action( 'woocommerce_before_shop_loop' );
                 			?>
                    <div id = "target-filter" class="row ">  

                              <div class="large-12 columns auto">
                        	
                              
                        		<?php if ( have_posts() ) : ?>
                        
                        			
                        
                        			<?php woocommerce_product_loop_start(); ?>
                        
                        				<?php $categories = woocommerce_product_subcategories(); ?>
                        
                        				<?php if($categories): global $woocommerce_loop; $woocommerce_loop['loop'] = 0; ?>
                        				<div class="category-separator"></div>
                        				<?php endif; ?>
                        
                        
                        				<?php while ( have_posts() ) : the_post(); ?>
                        					
                        					<?php global $product; $post; ?>
                        					
                        					<?php wc_get_template_part( 'content', 'product' ); ?>
                        
                        				<?php endwhile; // end of the loop. ?>
                        
                        			<?php woocommerce_product_loop_end(); ?>
                        
                        			
                        
                        		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                        
                        			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
                        
                        		<?php endif; ?>
                                    <?php
                    				/**
                    				 * woocommerce_after_shop_loop hook
                    				 *
                    				 * @hooked woocommerce_pagination - 10
                    				 */
                    				do_action( 'woocommerce_after_shop_loop' );
            			            ?>
            	               
                        		<?php 
                        		if(is_archive() && !is_shop())
                        		{ 
                        			?>
                                    
                        		</div>
                                
                        		<?php } ?>
                                
                    </div>
                                
                 </div>
            </div>             
        </div><!-- .columns -->
            	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
        </div><!-- .row -->
    </div><!-- #primary -->


<?php get_footer('shop'); ?>
