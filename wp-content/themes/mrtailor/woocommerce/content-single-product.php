<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $post, $product, $mr_tailor_theme_options;

//woocommerce_before_single_product
//nothing changed
//woocommerce_before_single_product_summary
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20);

//woocommerce_single_product_summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50);

//woocommerce_after_single_product_summary
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action('woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10);

//woocommerce_after_single_product
//nothing changed
//custom actions
add_action('woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0);
add_action('woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20);
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php
$term =  get_the_terms( $post->ID, 'product_cat' );
foreach ($term as $t) {
   $parentId = $t->parent;
   if($parentId == 0){
     $cat= $t->slug;
   }else{
      $term = get_terms( 'product_cat', array('include' => array($parentId)) );
     
      $cat_name= $term[0]->name;
      $cat_slg = $term[0]->slug;

   }
}

$title = $term[0]->name;
$link = $term[0]->slug;

    if ($_REQUEST['action'] == 'buy-now') {
        ?>
        <div class="row a2">
            <nav class="woocommerce-breadcrumb stp_bredcum_nav" itemprop="breadcrumb"><a class="home" href="<?php echo home_url(); ?>">Trang chủ</a>
                <span class="delimiter"> / </span><a href="<?php echo home_url(); ?>/product-category/<?php echo $cat_slg; ?>"><?php echo $cat_name; ?></a><span class="delimiter">
                    / </span><span><?php echo get_the_title($_REQUEST[custom_product_id]); ?></span></nav>

        </div>
        <?php
    } else {
        ?>
        <div class="row a1"> 
            <nav class="woocommerce-breadcrumb stp_bredcum_nav" itemprop="breadcrumb"><a class="home" href="<?php echo home_url(); ?>">Trang chủ</a>
                <span class="delimiter"> / </span><a href="<?php echo home_url(); ?>/product-category/<?php echo $link; ?>/"><?php echo $title ?></a><span class="delimiter">
                    / </span><span><?php echo get_the_title($_REQUEST[custom_product_id]); ?></span></nav>

        </div>
        <?php
    }
    ?>

    <div class="product_single_wrap on_screen">

        <div class="row">
            <div class="large-12 columns">

                <?php do_action('woocommerce_before_single_product'); ?>

            </div><!-- .columns -->        
        </div><!-- .row -->

        <div class="row">

            <div class="large-1 columns product_summary_thumbnails_wrapper">
                <div><?php do_action('woocommerce_product_summary_thumbnails'); ?></div>
            </div><!-- .columns -->

            <div class="large-5 large-push-0 medium-8 medium-push-2 columns">

                <?php
                do_action('woocommerce_before_single_product_summary_sale_flash');
                do_action('woocommerce_before_single_product_summary_product_images');
                do_action('woocommerce_before_single_product_summary');
                ?>

                <?php if (!$product->is_in_stock()) : ?>            
                    <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php _e('Out of stock', 'mr_tailor'); ?></div>            
                <?php endif; ?>

            </div><!-- .columns -->

            <?php
            $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
            $viewed_products = array_filter(array_map('absint', $viewed_products));
            ?>

            <?php if (empty($viewed_products)) { ?>
                <div class="large-6 large-push-0 columns">
                <?php } else { ?>
                    <div class="large-5 large-push-0 columns">
                    <?php } ?>

                    <div class="product_infos pd_sngl_div">

                        <div class="product_summary_top">
                            <?php
                            do_action('woocommerce_single_product_summary_single_title');
//                            do_action('woocommerce_single_product_summary_single_rating');

                            if (post_password_required()) {
                                echo get_the_password_form();
                                return;
                            }
                            ?>
                        </div>

                        <?php
                        do_action('woocommerce_single_product_summary_single_price');
                        ?>
<!--                        echo do_shortcode('[social-media]');-->
                        <div class="site-social-icons">
                            <ul class="icon">
                                <?php if ((isset($mr_tailor_theme_options['facebook_link'])) && (trim($mr_tailor_theme_options['facebook_link']) != "" )) { ?><li class="site-social-icons-facebook"><a target="_blank" href="<?php echo $mr_tailor_theme_options['facebook_link']; ?>"><i class="fa fa-facebook"></i><span>Facebook</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['pinterest_link'])) && (trim($mr_tailor_theme_options['pinterest_link']) != "" )) { ?><li class="site-social-icons-pinterest"><a target="_blank" href="<?php echo $mr_tailor_theme_options['pinterest_link']; ?>"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['twitter_link'])) && (trim($mr_tailor_theme_options['twitter_link']) != "" )) { ?><li class="site-social-icons-twitter"><a target="_blank" href="<?php echo $mr_tailor_theme_options['twitter_link']; ?>"><i class="fa fa-twitter"></i><span>Twitter</span></a></li><?php } ?>
                                <!--
                                <?php if ((isset($mr_tailor_theme_options['linkedin_link'])) && (trim($mr_tailor_theme_options['linkedin_link']) != "" )) { ?><li class="site-social-icons-linkedin"><a target="_blank" href="<?php echo $mr_tailor_theme_options['linkedin_link']; ?>"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['googleplus_link'])) && (trim($mr_tailor_theme_options['googleplus_link']) != "" )) { ?><li class="site-social-icons-googleplus"><a target="_blank" href="<?php echo $mr_tailor_theme_options['googleplus_link']; ?>"><i class="fa fa-google-plus"></i><span>Google+</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['rss_link'])) && (trim($mr_tailor_theme_options['rss_link']) != "" )) { ?><li class="site-social-icons-rss"><a target="_blank" href="<?php echo $mr_tailor_theme_options['rss_link']; ?>"><i class="fa fa-rss"></i><span>RSS</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['tumblr_link'])) && (trim($mr_tailor_theme_options['tumblr_link']) != "" )) { ?><li class="site-social-icons-tumblr"><a target="_blank" href="<?php echo $mr_tailor_theme_options['tumblr_link']; ?>"><i class="fa fa-tumblr"></i><span>Tumblr</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['instagram_link'])) && (trim($mr_tailor_theme_options['instagram_link']) != "" )) { ?><li class="site-social-icons-instagram"><a target="_blank" href="<?php echo $mr_tailor_theme_options['instagram_link']; ?>"><i class="fa fa-instagram"></i><span>Instagram</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['youtube_link'])) && (trim($mr_tailor_theme_options['youtube_link']) != "" )) { ?><li class="site-social-icons-youtube"><a target="_blank" href="<?php echo $mr_tailor_theme_options['youtube_link']; ?>"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li><?php } ?>
                                <?php if ((isset($mr_tailor_theme_options['vimeo_link'])) && (trim($mr_tailor_theme_options['vimeo_link']) != "" )) { ?><li class="site-social-icons-vimeo"><a target="_blank" href="<?php echo $mr_tailor_theme_options['vimeo_link']; ?>"><i class="fa fa-vimeo-square"></i><span>Vimeo</span></a></li><?php } ?>
                                -->
                            </ul>
                        </div>
                        <?php
                        do_action('woocommerce_single_product_summary_single_excerpt');
                        echo "<div class='add_to_cart_edit'>";
                        $a = get_the_terms(get_the_ID(), 'product_cat');
                        foreach ($a as $product_category) {
                            $b = $product_category->term_id;
                            $a = $product_category->name;
                        }

                        switch ($a) {
                            case "Design Your Own":
                                $page_id = 56960;
                                break;
                            case "design your jacket":
                                $page_id = 57020;
                                break;
                            case "design your suits":
                                $page_id = 57030;
                                break;
                            case "design your blazers":
                                $page_id = 57033;
                                break;
                            case "design your chinos":
                                $page_id = 57036;
                                break;
                            case "design your pants":
                                $page_id = 57039;
                                break;
                        }

                        if (get_post_meta(get_the_ID(), 'custom-design', true) != 'yes') {
                            //do_action( 'woocommerce_single_product_summary_single_add_to_cart' );

                            if ($b != 26 && $b != 50 && $b != 51 && $b != 52 && $b != 53) {
                                echo "<a href='" . get_permalink($page_id) . "?action=buy-now&custom_product_id=" . get_the_ID() . "' class='star_dsgn_bttn' style='clear: both; min-width:215px;'>BUY NOW</a> <br>";
                            } else {
                                do_action('woocommerce_single_product_summary_single_add_to_cart');
                            }

                            if ($page_id == 56960) {
                                echo "<a href='" . get_permalink($page_id) . "?custom_product_id=" . get_the_ID() . "' class='star_dsgn_bttn' id='edit-designing' style='margin:15px 0 0 0; clear: both; min-width:215px;'>Edit Design</a>";
                            }
                        } else {
                            echo "<a href='" . get_permalink($page_id) . "?custom_product_id=" . get_the_ID() . "' class='star_dsgn_bttn'>Start Designing</a>";
                        }


                        /* if(get_post_meta( $post->ID, '_customized_product', true )=='yes')
                          {
                          echo "<span class='edt_bbtn'>OR <a href='".get_permalink($page_id)."?custom_product_id=".get_the_ID()."' class='star_dsgn_bttn'>Edit Design</a></span>";
                          } */
                        echo "</div>";
                        do_action('woocommerce_single_product_summary');
                        //echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                        ?>

                    </div>

                </div><!-- .columns -->

                <?php if (!empty($viewed_products)) { ?>
                    <div class="large-1 columns recently_viewed_in_single_wrapper">

                        <div class="recently_viewed_in_single">

                            <?php include_once('single-product/recently-viewed.php'); ?>

                        </div>

                    </div><!-- .columns -->
                <?php } ?>

            </div><!-- .row -->

            <meta itemprop="url" content="<?php the_permalink(); ?>" />

        </div><!-- #product-<?php the_ID(); ?> -->
<!--
        <div class="row">
            <div class="large-12 large-uncentered columns ">
                <?php
                //do_action('woocommerce_after_single_product_summary_data_tabs');
//                do_action('woocommerce_single_product_summary_single_meta');
//                do_action('woocommerce_single_product_summary_single_sharing');
//                do_action('woocommerce_after_single_product_summary');
                ?>

                <div class="product_navigation">
                    <?php //mr_tailor_product_nav('nav-below'); ?>
                </div>

            </div>--><!-- .columns -->
        </div><!-- .row -->

    </div>

    <?php do_action('woocommerce_after_single_product'); ?>