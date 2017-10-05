<?php
/* Template Name:custom design */

// Default Post Options Values
global $woocommerce;
$product_id = $post->ID;
$settings_post_title = "Shirts";
$settings_type = 'store-settings';

// End Default Post Options Values

if (get_field('store_settings_post_name')) {
    $settings_post_title = get_field('store_settings_post_name');
}

$settings_posts = get_posts(array('post_type' => $settings_type, 'post_status' => 'private', 'posts_per_page' => -1));
foreach ($settings_posts as $setting) {
    if ($setting->post_title == $settings_post_title) {
        $settings_id = $setting->ID;
    }
}

$post_type = 'product-shirt';
$current_page_id = 10;

if (get_field('post_type')) {
    $post_type = get_field('post_type');
}
$current_page_link = get_permalink($current_page_id);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'posts_per_page' => 16,
    'paged' => $paged,
    'post_type' => $post_type,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

if ($_GET['addquery'] == "true") {
    $tax_relation = "AND";
    if ($_GET['search']) {
        $args['s'] = $_GET['search'];
    }
    if ($_GET['color']) {
        $args['tax_query'] = array(
            'relation' => $tax_relation,
            array(
                'taxonomy' => 'product-colors',
                'field' => 'slug',
                'terms' => $_GET['color']
            )
        );
    }
    if ($_GET['design']) {
        if (empty($args['tax_query']['relation'])) {
            $args['tax_query']['relation'] = $tax_relation;
        }
        $args['tax_query'][] = array(
            'taxonomy' => 'product-designs',
            'field' => 'slug',
            'terms' => $_GET['design']
        );
    }
    if ($_GET['price']) {
        $args['meta_query'] = array(
            array(
                'key' => 'price',
                'value' => $_GET['price']
            )
        );
    }
}

$wp_query = new WP_Query($args);
//var_dump($wp_query->request);

$term_args = array(
    'hide_empty' => 0,
    'orderby' => 'id',
    'order' => 'ASC',
);

$colors = get_terms('product-colors', $term_args);
$designs = get_terms('product-designs', $term_args);
$prices = get_prices_array($post_type);
$steps = get_field('select_steps', $settings_id);


$custom_post_id = $_REQUEST['custom_product_id'];
$post_details = get_post($custom_post_id);


if (in_array($post_type, array('product-made-shirt', 'product-shirt')) && $paged == 1) {
    global $wpdb;
    $fabrics = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'product-shirt' AND post_status = 'publish' ORDER BY menu_order ASC");
}
get_header();
?>
<style>
    li.menu-item-34 a{
        color:#777777;
    }
</style>
<form id="general-settings">
    <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>" />
    <input type="hidden" name="post_type_name" id="browse-shirts-option" value="<?php echo $post_type; ?>" />
    <input type="hidden" name="current_page_id" value="<?php echo $current_page_id; ?>" />
    <?php foreach ($steps as $step) { ?>
        <input type="hidden" name="steps[]" value="<?php echo strtolower($step); ?>" />
    <?php } ?>
    <?php if ($_GET['similar'] && array_key_exists($_GET['similar'], $_SESSION['cart']['items'])) { ?>
        <input type="hidden" name="cart-key" value="<?php echo $_GET['similar']; ?>" />
    <?php } ?>
    <?php if ($_GET['edit'] && array_key_exists($_GET['edit'], $_SESSION['cart']['items'])) { ?>
        <input type="hidden" name="cart-key" value="<?php echo $_GET['edit']; ?>" />
        <input type="hidden" name="edit-item" value="1" />
    <?php } ?>
</form>

<div class="content design-shirts-1-content">
    <div class="woocommerce">
        <?php
        if ($_REQUEST['action'] == 'buy-now') {
            ?>
            <div class="row">
                <nav class="woocommerce-breadcrumb stp_bredcum_nav" itemprop="breadcrumb"><a class="home" href="<?php echo home_url(); ?>">Home</a>
                    <span class="delimiter"> / </span><a href="<?php echo home_url(); ?>/product-category/design-your-own/">Shirts</a><span class="delimiter">
                        / </span><span><?php echo $post_details->post_title; ?> :</span> <span id="brdcrum_design"> Design </span>
                    <span class="delimiter_design">
                        - </span><span id="brdcrum_extras"> Extras </span><span class="delimiter_design">
                        - </span><span id="brdcrum_sizing" class="brdcrum_field" class="brdcrum_field"> Sizing </span></nav>

            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <nav class="woocommerce-breadcrumb stp_bredcum_nav" itemprop="breadcrumb"><a class="home" href="<?php echo home_url(); ?>">Home</a>
                    <span class="delimiter"> / </span><a href="<?php echo home_url(); ?>/product-category/design-your-own/">Shirts</a><span class="delimiter">
                        / </span><span><?php echo $post_details->post_title; ?> :</span> <span id="brdcrum_design" class="brdcrum_field"> Design </span>
                    <span class="delimiter_design">
                        - </span><span id="brdcrum_extras"> Extras </span><span class="delimiter_design">
                        - </span><span id="brdcrum_sizing"> Sizing </span></nav>

            </div>
            <?php
        }
        ?>
        <div class="product_single_wrap rwg_mss_deg">
            <div class="row">
                <div class="large-12 columns">
                    <form id="main-product-form" action="<?php bloginfo('url') ?>/?page_id=56972" method="post">
                        <div class="row-fluid">
                            <div class="span6" id="img_main_thumb" <?php
                            if ($_REQUEST['action'] == 'buy-now') {
                                echo "style='display:none'";
                            }
                            ?>>
                                        <!--<img src="<?php echo bloginfo("template_directory") ?>/images/man__shirt.png">-->

                                <?php
                                $attachment_ids = explode(",", get_post_meta($_REQUEST[custom_product_id], '_product_image_gallery', true));
                                $modal_class = "";
                                if (get_option('woocommerce_enable_lightbox') == "yes") {
                                    $modal_class = "fresco zoom";
                                }
                                if ($attachment_ids) {
                                    ?>

                                    <?php if (has_post_thumbnail($_REQUEST[custom_product_id])) { ?>

                                        <div class="large-2 columns product_summary_thumbnails_wrapper">
                                            <div class="product_thumbnails">

                                                <div class="swiper-container">

                                                    <div class="swiper-wrapper">

                                                        <?php
                                                        //Featured

                                                        $image_title = esc_attr(get_the_title(get_post_thumbnail_id($_REQUEST[custom_product_id])));
                                                        $image_link = wp_get_attachment_url(get_post_thumbnail_id($_REQUEST[custom_product_id]));
                                                        $image = get_the_post_thumbnail($_REQUEST[custom_product_id], apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), array(
                                                            'title' => $image_title
                                                        ));

                                                        $attachment_count = count($attachment_ids);

                                                        echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="swiper-slide">%s</div>', $image), $_REQUEST[custom_product_id]);

                                                        //Thumbs
                                                        //$attachment_ids = $product->get_gallery_attachment_ids();

                                                        if ($attachment_ids) {

                                                            foreach ($attachment_ids as $attachment_id) {

                                                                $image_link = wp_get_attachment_url($attachment_id);

                                                                if (!$image_link)
                                                                    continue;

                                                                $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
                                                                $image_title = esc_attr(get_the_title($attachment_id));

                                                                echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="swiper-slide">%s</div>', $image), $attachment_id, $_REQUEST[custom_product_id]);
                                                            }
                                                            ?>

                                                        </div><!-- /.swiper-wrapper -->

                                                        <?php
                                                        if ($attachment_count < 4) {
                                                            $number_of_thumbs = $attachment_count + 1;
                                                        } else {
                                                            $number_of_thumbs = 4;
                                                        }
                                                        $shop_thumbnail_image = get_option('shop_thumbnail_image_size');
                                                        $thumbnail_swiper_height = $shop_thumbnail_image['height'] * $number_of_thumbs + (($number_of_thumbs - 1) * 20 ); // 20 is the padding between thumbs
                                                        ?>

                                                        <style>
                                                            .product_thumbnails .swiper-container {
                                                                height: <?php echo $thumbnail_swiper_height; ?>px;
                                                            }
                                                        </style>

                                                        <div class="pagination"></div>

                                                    </div><!-- /.swiper-container -->

                                                </div><!-- /.product_images -->

                                            </div>

                                            <div class="large-10 large-push-0 medium-8 medium-push-2 columns">
                                                <?php
                                            } //has_post_thumbnail
                                        } else {
                                            echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="Placeholder" />', wc_placeholder_img_src()), $post->ID);
                                        }
                                    } //attachment_ids
                                    ?>

                                    <?php
                                    //Featured

                                    $image_title = esc_attr(get_the_title(get_post_thumbnail_id($_REQUEST[custom_product_id])));
                                    $image_src = wp_get_attachment_image_src(get_post_thumbnail_id($_REQUEST[custom_product_id]), 'shop_thumbnail');
                                    $image_data_src = wp_get_attachment_image_src(get_post_thumbnail_id($_REQUEST[custom_product_id]), 'shop_single');
                                    $image_link = wp_get_attachment_url(get_post_thumbnail_id($_REQUEST[custom_product_id]));
                                    $image = get_the_post_thumbnail($_REQUEST[custom_product_id], apply_filters('single_product_large_thumbnail_size', 'shop_single'));
                                    //$attachment_count   = count( $product->get_gallery_attachment_ids() );

                                    echo apply_filters('woocommerce_single_product_image_html', sprintf('<div class="featured_img_temp">%s</div>', $image), $_REQUEST[custom_product_id]);
                                    ?>

                                    <div class="images">

                                        <?php if (has_post_thumbnail($_REQUEST[custom_product_id])) { ?>

                                            <div class="product_images">

                                                <div id="product-images-carousel" class="owl-carousel">

                                                    <?php
                                                    //Featured

                                                    echo apply_filters('woocommerce_single_product_image_html', sprintf('<div><a data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'" class="' . $modal_class . '" href="' . $image_link . '">%s<span class="product_image_zoom_button show-for-medium-up"><i class="getbowtied-icon-plus"></i></span></a></div>', $image), $_REQUEST[custom_product_id]);

                                                    //Thumbs
                                                    //$attachment_ids = $product->get_gallery_attachment_ids();

                                                    if ($attachment_ids) {

                                                        foreach ($attachment_ids as $attachment_id) {

                                                            $image_link = wp_get_attachment_url($attachment_id);

                                                            if (!$image_link)
                                                                continue;

                                                            $image_title = esc_attr(get_the_title($attachment_id));
                                                            $image_src = wp_get_attachment_image_src($attachment_id, 'shop_single_small_thumbnail');
                                                            $image_data_src = wp_get_attachment_image_src($attachment_id, 'shop_single');
                                                            $image_link = wp_get_attachment_url($attachment_id);
                                                            $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));

                                                            echo '<div><a data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'" class="' . $modal_class . '" href="' . $image_link . '"><img src="' . $image_src[0] . '" data-src="' . $image_data_src[0] . '" class="lazyOwl" alt="' . $image_title . '"><span class="product_image_zoom_button show-for-medium-up"><i class="getbowtied-icon-plus"></i></span></a></div>';
                                                        }
                                                    }
                                                    ?>

                                                </div>

                                            </div><!-- /.product_images -->

                                            <?php
                                        } else {
                                            echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="Placeholder" />', wc_placeholder_img_src()), $_REQUEST[custom_product_id]);
                                        }
                                        ?>
                                    </div>
                                </div>


                            </div>


                            <?php include_once( 'template-parts/steps/product-step-design.php' ); ?>
                            <?php include_once( 'template-parts/steps/product-step-extras.php' ); ?>
                            <?php include_once( 'template-parts/steps/product-step-sizing.php' ); ?>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row woocommerce">
            <div class="large-12 large-uncentered columns pro product">
                <?php echo woocommerce_product_detail_tabs($custom_post_id) ;?>
            </div>
        </div>

        <?php

//         function woo_rename_tabs($tabs) {

// //            $tabs['description']['title'] = __('More Information');  // Rename the description tab
// //            $tabs['reviews']['title'] = __('Ratings');    // Rename the reviews tab
// //            $tabs['additional_information']['title'] = __('Product Data'); // Rename the additional information tab
//             $tabs['photo_details ']['title'] = __('Photo Details '); // Rename the additional information tab
//             $tabs['fit_guarantee']['title'] = __('Fit Guarantee'); // Rename the additional information tab
//             $tabs['delivery']['title'] = __('Delivery'); // Rename the additional information tab

//             return $tabs;
//         }
        ?>


        <?php
        if ($fabrics) {
            $no_lining_image = get_field('no_lining_image', 188);
            $no_lining_src = $no_lining_image['sizes']['product-thumb-small'];
            ?>

            <div class="lining-fabrics" id="contrasting-collar-cuff-lining-fabrics">
                <p>CONTRASTING COLLAR &amp; CUFF LINING </p>

                <ul>
                    <li class="select-fabric selected-fabric" id="selected-fabric">
                        <img src="<?php echo $no_lining_src; ?>" alt="No Lining" />
                        <span class="fabric-title">No Lining</span>
                    </li>
                    <?php foreach ($fabrics as $fabric) { ?>
                        <?php
                        $image_id = get_post_meta($fabric->ID, 'images_0_image', true);
                        if ($image_id) {
                            $image_array = wp_get_attachment_image_src($image_id, 'product-thumb-small');
                            $link = $image_array[0];
                        } else {
                            $link = $no_lining_src;
                        }
                        ?>
                        <li class="select-fabric">
                            <img src="" alt="<?php echo $fabric->post_title; ?> Lining" width="70" height="70" data-src="<?php echo $link; ?>" />
                            <span class="fabric-title" data-fabriccode="<?php echo $fabric->ID; ?>"><?php echo $fabric->post_title; ?></span>
                        </li>
    <?php } ?>
                </ul>
            </div>
<?php } ?>
    </div>
</div>
<?php get_template_part('info-promo'); ?>
<?php get_footer() ?>
<script type="text/javascript">
    /* if(window.location.search.split("&")[0].split("?")[1]=="action=buy-now"){

     }else{

     }*/
    jQuery(document).ready(function () {

        jQuery('body').addClass('single-design');

        //////////////////////
        //var action=getUrlParameter();
        //hide design

        if (window.location.search.split("&")[0].split("?")[1] == "action=buy-now") { //This is for buy now directly load Sizing panel.

            //hide design
            jQuery('.browse-product-wrap.design').removeClass('block');
            jQuery('.browse-product-wrap.design').addClass('remove');

            //hise extract
            jQuery('.browse-product-wrap.extract').removeClass('block');
            jQuery('.browse-product-wrap.extract').addClass('remove');

            jQuery('li.step-design').addClass('browse-navbar-active');
            jQuery('li.step-extras').removeClass('browse-navbar-active');
            jQuery('li.step-sizing').removeClass('browse-navbar-active');

            //show sizing
            jQuery('.measure-wrap').addClass('block');
            jQuery('.measure-wrap').removeClass('remove');

            jQuery('li.step-extras').addClass('browse-navbar-active');
            jQuery('li.step-design').removeClass('browse-navbar-active');
            jQuery('li.step-sizing').removeClass('browse-navbar-active');

            jQuery('#img_main_thumb').removeClass('block');
            jQuery('#img_main_thumb').addClass('remove');


        }
        else
        {

            ///////////////////////
            // jQuery('.browse-product-wrap.extract').addClass('remove');
            // jQuery('.measure-wrap').addClass('remove');
            jQuery('li.step-design').addClass('browse-navbar-active');

            jQuery('#brdcrum_design').click(function () {
                jQuery('.browse-product-wrap.extract').addClass('remove');
                jQuery('.browse-product-wrap.extract').removeClass('block');
                jQuery('.measure-wrap').addClass('remove');
                jQuery('.measure-wrap').removeClass('block');

                jQuery('.browse-product-wrap.design').addClass('block');

                jQuery('#brdcrum_design').addClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');

                jQuery('#img_main_thumb').addClass('block');
            });

            jQuery('#brdcrum_extras').click(function () {
                jQuery('.browse-product-wrap.design').addClass('remove');
                jQuery('.browse-product-wrap.design').removeClass('block');
                jQuery('.measure-wrap').addClass('remove');
                jQuery('.measure-wrap').removeClass('block');

                jQuery('.browse-product-wrap.extract').addClass('block');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').addClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');

                jQuery('#img_main_thumb').addClass('block');
            });

            jQuery('#brdcrum_sizing').click(function () {
                jQuery('.browse-product-wrap.design').addClass('remove');
                jQuery('.browse-product-wrap.design').removeClass('block');
                jQuery('.browse-product-wrap.extract').addClass('remove');
                jQuery('.browse-product-wrap.extract').removeClass('block');
                jQuery('.measure-wrap').addClass('block');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').addClass('brdcrum_field');

                jQuery('#img_main_thumb').addClass('remove');
                jQuery('#img_main_thumb').removeClass('block');
            });

            //////////////
            jQuery('.design.change-step').click(function () {
                jQuery('.browse-product-wrap.design').addClass('remove');
                jQuery('.browse-product-wrap.design').removeClass('block');

                jQuery('.browse-product-wrap.extract').removeClass('remove');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').addClass('brdcrum_field');

            });

            /////////////
            jQuery('.extract.change-step').click(function () {
                jQuery('.browse-product-wrap.design').addClass('remove');
                jQuery('.browse-product-wrap.design').removeClass('block');

                jQuery('.browse-product-wrap.extract').addClass('remove');
                jQuery('.browse-product-wrap.extract').removeClass('block');

                jQuery('.measure-wrap').removeClass('remove');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').addClass('brdcrum_field');

                jQuery('#img_main_thumb').removeClass('block');
                jQuery('#img_main_thumb').addClass('remove');


            });
            jQuery('.extract.step-back').click(function () {
                jQuery('.browse-product-wrap.design').removeClass('remove');
                jQuery('.browse-product-wrap.extract').removeClass('block');
                jQuery('.browse-product-wrap.extract').addClass('remove');
                jQuery('.measure-wrap').addClass('remove');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');
                jQuery('#brdcrum_design').addClass('brdcrum_field');

            });

            jQuery('.measure.step-back').click(function () {
                jQuery('.browse-product-wrap.design').addClass('remove');
                jQuery('.browse-product-wrap.extract').addClass('block');
                jQuery('.measure-wrap').addClass('remove');
                jQuery('.measure-wrap').removeClass('block');
                jQuery('.browse2-product-extra').removeClass('remove');

                jQuery('#brdcrum_design').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').removeClass('brdcrum_field');
                jQuery('#brdcrum_sizing').removeClass('brdcrum_field');
                jQuery('#brdcrum_extras').addClass('brdcrum_field');

                jQuery('#img_main_thumb').addClass('block');

            });
            /////////////
            jQuery('li.step-select').click(function () {
                jQuery('li.step-select').addClass('browse-navbar-active');
                jQuery('li.step-design').removeClass('browse-navbar-active');
                jQuery('li.step-extras').removeClass('browse-navbar-active');
                jQuery('li.step-sizing').removeClass('browse-navbar-active');
            });
            /////////////
            jQuery('li.step-design').click(function () {
                jQuery('.browse-product-wrap.design').addClass('block');

                //hide sizing
                jQuery('.measure-wrap').removeClass('blog');
                jQuery('.measure-wrap').addClass('remove');
                //hide extract
                jQuery('.browse-product-wrap.extract').removeClass('block');
                //  jQuery('.browse-product-wrap.extract').addClass('remove');

                jQuery('li.step-design').addClass('browse-navbar-active');
                jQuery('li.step-extras').removeClass('browse-navbar-active');
                jQuery('li.step-sizing').removeClass('browse-navbar-active');
            });

            jQuery('li.step-extras').click(function () {
                //hide design
                jQuery('.browse-product-wrap.design').removeClass('block');
                jQuery('.browse-product-wrap.design').addClass('remove');
                //hide sizing
                jQuery('.measure-wrap').removeClass('block');
                jQuery('.measure-wrap').addClass('remove');
                //show extract
                jQuery('.browse-product-wrap.extract').addClass('block');

                jQuery('li.step-extras').addClass('browse-navbar-active');
                jQuery('li.step-design').removeClass('browse-navbar-active');
                jQuery('li.step-sizing').removeClass('browse-navbar-active');
            });

            jQuery('li.step-sizing').click(function () {
                jQuery('.measure-wrap').removeClass('remove');
                jQuery('.browse-product-wrap.extract').removeClass('block');
                jQuery('.browse-product-wrap.design').removeClass('block');

                jQuery('.browse-product-wrap.design').addClass('remove');

                jQuery('li.step-sizing').addClass('browse-navbar-active');
                jQuery('li.step-extras').removeClass('browse-navbar-active');
                jQuery('li.step-design').removeClass('browse-navbar-active');
                //hide browse2-product-feed && hide browse2-product-extra
                //  jQuery('.browse2-product-feed').addClass('remove');
                //jQuery('.browse2-product-extra').addClass('remove');
            });
            jQuery('body').on('click', function () {
                if (jQuery('body .li.step-design').hasClass('active_step')) {
                    //alert('aaaaaa')
                    jQuery('.browse-product-wrap.design').removeClass('remove');
                    jQuery('.measure-wrap').removeClass('block');
                    jQuery('.browse-product-wrap.extract').removeClass('block');
                }
            });
            jQuery('body').on('click', function () {
                if (jQuery('.browse-product-wrap.design').hasClass('remove') && jQuery('.browse-product-wrap.extract').hasClass('remove')) {
                    jQuery('.browse2-product-feed').addClass('remove');
                    jQuery('.browse2-product-extra').addClass('remove');
                }
            });

            jQuery('body').on('click', function () {
                if (jQuery('.browse-product-wrap.extract').hasClass('block')) {
                    jQuery('.browse2-product-feed').removeClass('remove');
                    jQuery('.browse2-product-extra').removeClass('remove');
                }
            });
        }
    });
</script>
<style>
    li.step-select{
        cursor:pointer;
    }
</style>
