<?php global $woocommerce, $mr_tailor_theme_options; ?>

<footer id="site-footer" role="contentinfo">

    <?php if (is_active_sidebar('footer-widget-area')) : ?>

        <div class="trigger-footer-widget-area">
            <span class="trigger-footer-widget-icon"></span>
        </div>

        <div class="site-footer-widget-area">
            <div class="row">
                <?php dynamic_sidebar('footer-widget-area'); ?>
            </div><!-- .row -->
        </div><!-- .site-footer-widget-area -->

    <?php endif; ?>

    <div class="site-footer-copyright-area">
        <div class="row">
            <div class="medium-4 columns">
                <div class="payment_methods">

                    <?php
                    if ((isset($mr_tailor_theme_options['credit_card_icons']['url'])) && (trim($mr_tailor_theme_options['credit_card_icons']['url']) != "" )) {
                        if (is_ssl()) {
                            $credit_card_icons = str_replace("http://", "https://", $mr_tailor_theme_options['credit_card_icons']['url']);
                        } else {
                            $credit_card_icons = $mr_tailor_theme_options['credit_card_icons']['url'];
                        }
                        ?>

                        <img src="<?php echo $credit_card_icons; ?>" alt="<?php _e('Payment methods', 'mr_tailor') ?>" />

                    <?php } ?>

                </div><!-- .payment_methods -->
            </div><!-- .large-4 .columns -->

            <div class="medium-8 columns">
                <div class="copyright_text">
                    <?php if ((isset($mr_tailor_theme_options['footer_copyright_text'])) && (trim($mr_tailor_theme_options['footer_copyright_text']) != "" )) { ?>
                        <?php _e($mr_tailor_theme_options['footer_copyright_text'], 'mr_tailor'); ?>
                    <?php } ?>
                </div><!-- .copyright_text -->
            </div><!-- .large-8 .columns -->
        </div><!-- .row -->
    </div><!-- .site-footer-copyright-area -->

</footer>

</div><!-- #page -->

</div><!-- /st-content -->
</div><!-- /st-pusher -->

<nav class="st-menu slide-from-left">
    <div class="nano">
        <div class="content">
            <div id="mobiles-menu-offcanvas" class="offcanvas-left-content">

                <nav id="mobile-main-navigation" class="mobile-navigation" role="navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-navigation',
                        'fallback_cb' => false,
                        'container' => false,
                        'items_wrap' => '<ul id="%1$s">%3$s</ul>',
                    ));
                    ?>
                </nav>

                <?php
                $theme_locations = get_nav_menu_locations();
                if (isset($theme_locations['top-bar-navigation'])) {
                    $menu_obj = get_term($theme_locations['top-bar-navigation'], 'nav_menu');
                }

                if ((isset($menu_obj->count) && ($menu_obj->count > 0)) || (is_user_logged_in())) {
                    ?>

                    <nav id="mobile-top-bar-navigation" class="mobile-navigation" role="navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'top-bar-navigation',
                            'fallback_cb' => false,
                            'container' => false,
                            'items_wrap' => '<ul id="%1$s">%3$s</ul>',
                        ));
                        ?>

                        <?php if (is_user_logged_in()) { ?>
                            <ul><li><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php _e('Logout', 'mr_tailor'); ?></a></li></ul>
                        <?php } ?>
                    </nav>

                <?php } ?>

                <?php if (function_exists('icl_get_languages')) { ?>

                    <?php $additional_languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); ?>

                    <?php if (count($additional_languages) > 1) { ?>
                        <nav class="mobile-navigation" role="navigation">
                            <ul>
                                <li class="menu-item-has-children">
                                    <a><?php echo ICL_LANGUAGE_NAME; ?></a>
                                    <ul class="sub-menu">
                                        <?php
                                        foreach ($additional_languages as $additional_language) {
                                            if (!$additional_language['active'])
                                                $langs[] = '<li><a href="' . $additional_language['url'] . '">' . $additional_language['native_name'] . '</a></li>';
                                        }
                                        echo join(', ', $langs);
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    <?php } ?>

                <?php } ?>

                <div class="mobile-socials">
                    <div class="site-social-icons">
                        <ul class="//animated //flipY">
                            <?php if ((isset($mr_tailor_theme_options['facebook_link'])) && (trim($mr_tailor_theme_options['facebook_link']) != "" )) { ?><li class="site-social-icons-facebook"><a target="_blank" href="<?php echo $mr_tailor_theme_options['facebook_link']; ?>"><i class="fa fa-facebook"></i><span>Facebook</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['twitter_link'])) && (trim($mr_tailor_theme_options['twitter_link']) != "" )) { ?><li class="site-social-icons-twitter"><a target="_blank" href="<?php echo $mr_tailor_theme_options['twitter_link']; ?>"><i class="fa fa-twitter"></i><span>Twitter</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['pinterest_link'])) && (trim($mr_tailor_theme_options['pinterest_link']) != "" )) { ?><li class="site-social-icons-pinterest"><a target="_blank" href="<?php echo $mr_tailor_theme_options['pinterest_link']; ?>"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['linkedin_link'])) && (trim($mr_tailor_theme_options['linkedin_link']) != "" )) { ?><li class="site-social-icons-linkedin"><a target="_blank" href="<?php echo $mr_tailor_theme_options['linkedin_link']; ?>"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['googleplus_link'])) && (trim($mr_tailor_theme_options['googleplus_link']) != "" )) { ?><li class="site-social-icons-googleplus"><a target="_blank" href="<?php echo $mr_tailor_theme_options['googleplus_link']; ?>"><i class="fa fa-google-plus"></i><span>Google+</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['rss_link'])) && (trim($mr_tailor_theme_options['rss_link']) != "" )) { ?><li class="site-social-icons-rss"><a target="_blank" href="<?php echo $mr_tailor_theme_options['rss_link']; ?>"><i class="fa fa-rss"></i><span>RSS</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['tumblr_link'])) && (trim($mr_tailor_theme_options['tumblr_link']) != "" )) { ?><li class="site-social-icons-tumblr"><a target="_blank" href="<?php echo $mr_tailor_theme_options['tumblr_link']; ?>"><i class="fa fa-tumblr"></i><span>Tumblr</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['instagram_link'])) && (trim($mr_tailor_theme_options['instagram_link']) != "" )) { ?><li class="site-social-icons-instagram"><a target="_blank" href="<?php echo $mr_tailor_theme_options['instagram_link']; ?>"><i class="fa fa-instagram"></i><span>Instagram</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['youtube_link'])) && (trim($mr_tailor_theme_options['youtube_link']) != "" )) { ?><li class="site-social-icons-youtube"><a target="_blank" href="<?php echo $mr_tailor_theme_options['youtube_link']; ?>"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li><?php } ?>
                            <?php if ((isset($mr_tailor_theme_options['vimeo_link'])) && (trim($mr_tailor_theme_options['vimeo_link']) != "" )) { ?><li class="site-social-icons-vimeo"><a target="_blank" href="<?php echo $mr_tailor_theme_options['vimeo_link']; ?>"><i class="fa fa-vimeo-square"></i><span>Vimeo</span></a></li><?php } ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div id="filters-offcanvas" class="offcanvas-left-content">
                <?php if (is_active_sidebar('catalog-widget-area')) : ?>
                    <?php dynamic_sidebar('catalog-widget-area'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<nav class="st-menu slide-from-right">
    <div class="nano">
        <div class="content">
            <div id="minicart-offcanvas" class="offcanvas-right-content"><?php
                if (class_exists('WC_Widget_Cart')) {
                    the_widget('mr_tailor_WC_Widget_Cart');
                }
                ?></div>
            <div id="wishlist-offcanvas" class="offcanvas-right-content"><div class="widget"></div></div>
        </div>
    </div>
</nav>

</div><!-- /st-container -->

<!-- ******************************************************************** -->
<!-- * Custom Footer JavaScript Code ************************************ -->
<!-- ******************************************************************** -->

<?php if ((isset($mr_tailor_theme_options['footer_js'])) && ($mr_tailor_theme_options['footer_js'] != "")) : ?>
    <script type="text/javascript">
    <?php echo $mr_tailor_theme_options['footer_js']; ?>
    </script>
<?php endif; ?>

<?php if ((isset($mr_tailor_theme_options['debug_mode'])) && ($mr_tailor_theme_options['debug_mode'] == "1" )) : ?>
    <!-- ******************************************************************** -->
    <!-- * Debug ************************************************************ -->
    <!-- ******************************************************************** -->

    <?php include_once('framework/templates/debug.php'); ?>
<?php endif; ?>

<?php if ((isset($mr_tailor_theme_options['sticky_header'])) && (trim($mr_tailor_theme_options['sticky_header']) == "1" )) : ?>

    <!-- ******************************************************************** -->
    <!-- * Sticky Header **************************************************** -->
    <!-- ******************************************************************** -->

    <div class="site-header-sticky">
        <div class="row">
            <div class="large-12 columns">
                <div class="site-header-sticky-inner">
                    <div class="site-branding">

                        <?php
                        if ((isset($mr_tailor_theme_options['site_logo']['url'])) && (trim($mr_tailor_theme_options['site_logo']['url']) != "" )) {
                            if (is_ssl()) {
                                $site_logo = str_replace("http://", "https://", $mr_tailor_theme_options['site_logo']['url']);
                            } else {
                                $site_logo = $mr_tailor_theme_options['site_logo']['url'];
                            }
                            ?>

                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img class="site-logo" src="<?php echo $site_logo; ?>" title="<?php bloginfo('description'); ?>" alt="<?php bloginfo('name'); ?>" /></a>

                        <?php } else { ?>

                            <div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></div>

                        <?php } ?>

                    </div><!-- .site-branding -->

                    <?php
                    if ((isset($mr_tailor_theme_options['site_logo_retina']['url'])) && (trim($mr_tailor_theme_options['site_logo_retina']['url']) != "" )) {
                        ?>
                        <script>
                            //<![CDATA[

                            // Set pixelRatio to 1 if the browser doesn't offer it up.
                            var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;

                            logo_image = new Image();

                            jQuery(window).load(function () {

                                if (pixelRatio > 1) {
                                    jQuery('.site-logo').each(function () {

                                        var logo_image_width = jQuery(this).width();
                                        var logo_image_height = jQuery(this).height();

                                        jQuery(this).css("width", logo_image_width);
                                        jQuery(this).css("height", logo_image_height);

                                        jQuery(this).attr('src', '<?php echo $mr_tailor_theme_options['site_logo_retina']['url'] ?>');
                                    });
                                }
                                ;

                            });

                            //]]>
                        </script>
                    <?php } ?>

                    <div id="site-menu">

                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'main-navigation',
                                'fallback_cb' => false,
                                'container' => false,
                                'items_wrap' => '<ul id="%1$s">%3$s</ul>',
                            ));
                            ?>
                        </nav><!-- #site-navigation -->

                        <div class="site-tools">
                            <ul>

                                <li class="mobile-menu-button"><a><i class="getbowtied-icon-menu"></i></a></li>

                                <?php if (class_exists('YITH_WCWL')) : ?>
                                    <?php if ((isset($mr_tailor_theme_options['main_header_wishlist'])) && (trim($mr_tailor_theme_options['main_header_wishlist']) == "1" )) : ?>
                                        <li class="wishlist-button"><a><i class="getbowtied-icon-heart"></i></a><span class="wishlist_items_number">--<?php //echo yith_wcwl_count_products();     ?></span></li>
                                        <script>
                                            //ajax on wishlist items number
                                            jQuery.ajax({
                                                url: mrtailor_ajaxurl,
                                                data: {
                                                    'action': 'refresh_wishlist_items_number'
                                                },
                                                success: function (data) {
                                                    jQuery(".wishlist_items_number").html(data);
                                                }
                                            });
                                        </script>


                                    <?php endif; ?>
                                <?php endif; ?>



                                <?php if (class_exists('WooCommerce')) : ?>
                                    <?php if ((isset($mr_tailor_theme_options['main_header_shopping_bag'])) && (trim($mr_tailor_theme_options['main_header_shopping_bag']) == "1" )) : ?>
                                        <?php if ((isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 1)) : ?>
                                        <?php else : ?>
                                            <li class="shopping-bag-button" class="right-off-canvas-toggle"><a><i class="getbowtied-icon-shop"></i></a><span class="shopping_bag_items_number">--<?php //echo $woocommerce->cart->cart_contents_count;     ?></span></li>
                                            <script>
                                                //ajax on shopping bag items number
                                                jQuery.ajax({
                                                    url: mrtailor_ajaxurl,
                                                    data: {
                                                        'action': 'refresh_shopping_bag_items_number'
                                                    },
                                                    success: function (data) {
                                                        jQuery(".shopping_bag_items_number").html(data);
                                                    }
                                                });
                                            </script>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ((isset($mr_tailor_theme_options['main_header_search_bar'])) && (trim($mr_tailor_theme_options['main_header_search_bar']) == "1" )) : ?>
                                    <li class="search-button"><a><i class="getbowtied-icon-search"></i></a></li>
                                <?php endif; ?>

                            </ul>
                        </div>

                        <div class="site-search">
                            <?php
                            if (class_exists('WooCommerce')) {
                                the_widget('WC_Widget_Product_Search', 'title=');
                            } else {
                                the_widget('WP_Widget_Search', 'title=');
                            }
                            ?>
                        </div><!-- .site-search -->

                    </div><!-- #site-menu -->

                    <div class="clearfix"></div>
                </div><!--.site-header-sticky-inner-->
            </div><!-- .large-12-->
        </div><!--.row-->
    </div><!-- .site-header-sticky -->

<?php endif; ?>


<!-- ******************************************************************** -->
<!-- * WP Footer() ****************************************************** -->
<!-- ******************************************************************** -->



<div id="port_1">
    <?php echo do_shortcode('[signup]'); ?>
</div>


<?php
wp_footer();


if (!isset($_COOKIE["DiscountVoucherXnPP"]) && $_COOKIE["DiscountVoucherXnPP"] != '1') {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("#signup-popup-link-1").trigger("click");
        });
    </script>
    <?php
}
?>
<script type='text/javascript' src="<?php echo bloginfo('template_directory') ?>/js/fancybox/jquery.fancybox.js"></script>
<script type='text/javascript' src="<?php echo bloginfo('template_directory') ?>/js/bootstrap.js"></script>
<script type='text/javascript' src="<?php echo bloginfo('template_directory') ?>/js/jquery.flexslider.js"></script>
<script type='text/javascript' src="<?php echo bloginfo('template_directory') ?>/js/jquery.infinitescroll.js"></script>
<script language="javascript" type="text/javascript">
        jQuery(document).ready(function ($) {



// Code using $ as usual goes here.

            $(".input-profile").click(function () {
                jQuery(".bbg_hdingtxt").hide();
            });
            $(".selected-values").click(function () {
                jQuery(".bbg_hdingtxt").hide();
            });
            $(".selected-values").change(function () {
                jQuery(".bbg_hdingtxt").hide();
            });
            $(".profile-title").click(function () {
                jQuery(".bbg_hdingtxt").show();
            });


// Pop up Functionality

            $('.fancybox').fancybox({
                beforeClose: function () {

                    $('.error').hide();

                }

            });








// Design/Extras Image pop-up Selection

            $('body').on('focus mousedown', '.select-popup', function (e) {

                e.preventDefault();

                this.blur();

                window.focus();

                $.fancybox({
                    'autoScale': true,
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic',
                    'speedIn': 500,
                    'speedOut': 300,
                    'autoDimensions': true,
                    'centerOnScroll': true,
                    'href': $(this).attr('data-popup')

                });

            });
            var chk_no = function (a) {
                if (a == 'No') {
                    $("#extras-monogram .popup-label").css('display', 'none');
                } else {
                    $("#extras-monogram .popup-label").css('display', 'block');
                }
                return a;
            };
            var ttget;
            var ttval;
            jQuery('body').on('click', '.popup-input-box', function () {

                $(this).parents('.popup-window').find('.popup-input-box').removeClass('selected-option');

                $(this).addClass('selected-option');

                var selected_value = $(this).attr('data-select');

                var selected_target = $(this).parents('.popup-window').attr('data-target');

                //console.log($(this));
                ttget = selected_target;
                ttval = selected_value;
                $(selected_target).val(selected_value);

                chk_no($(this).find('input').val());

                if ($(this).attr('data-option') != 'monogram')
                {
                    $.fancybox.close();
                }

            });
            jQuery('body').on('click', '.monogram-done', function (e) {
                e.preventDefault();
                //$('.mono_option input[type="radio"]:checked').val()
                $(ttget).val(ttval);

                $.fancybox.close();

            })

            $('body').on('change', '#target-monogram', function () {


                if ($(this).val() != "No-0") {

                    $('.monogram').show();

                } else {

                    $('.monogram').hide();

                }

            });

            $('body').on('click', '#design-jacket-style .popup-input-box', function () {

                $('#target-jacket-buttons-single, #target-jacket-buttons-double').parent().hide();

                if ($(this).data('select') == "Single Breast") {

                    $('#target-jacket-buttons-single').parent().show();

                } else {

                    $('#target-jacket-buttons-double').parent().show();

                }

            });

            $('body').on('click', '.suit-tab', function () {

                $('.suit-tab').removeClass('selected');

                $('.suit-content').hide();

                var selected_content = $(this).attr('href');

                if (selected_content == "#pants-design-options") {

                    $('.suit-next-btn').addClass('change-step').removeClass('change-suit-tab');

                    $('.suit-back-btn').addClass('suit-step-back').removeClass('step-back');

                } else {

                    $('.suit-next-btn').addClass('change-suit-tab').removeClass('change-step');

                    $('.suit-back-btn').addClass('step-back').removeClass('suit-step-back');

                }

                $(this).addClass('selected');

                $(selected_content).show();

                return false;

            });

            $('body').on('click', '.change-suit-tab', function () {

                $('.suit-tab').removeClass('selected');

                $('.suit-content').hide();

                var selected_content = "#pants-design-options";

                $(this).addClass('change-step').removeClass('change-suit-tab');

                $('.suit-back-btn').addClass('suit-step-back').removeClass('step-back');

                $('.suit-tab[href="#pants-design-options"]').addClass('selected');

                $(selected_content).show();

                return false;

            });

            $('body').on('click', '.suit-step-back', function () {

                $('.suit-tab').removeClass('selected');

                $('.suit-content').hide();

                var selected_content = "#jacket-design-options";

                $(this).addClass('step-back').removeClass('suit-step-back');

                $('.suit-next-btn').addClass('change-suit-tab').removeClass('change-step');

                $('.suit-tab[href="#jacket-design-options"]').addClass('selected');

                $(selected_content).show();

                return false;

            });

            $('#contrasting-collar-cuff-lining-fabrics')._scrollable();

            $('body').on('focus mousedown', '#target-contrasting-collar-cuff-lining', function (e) {

                e.preventDefault();

                this.blur();

                window.focus();

                $('#contrasting-collar-cuff-lining-fabrics').find('img').each(function () {

                    $(this).attr('src', $(this).data('src'));

                });



                $.fancybox({
                    'autoScale': true,
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic',
                    'speedIn': 500,
                    'speedOut': 300,
                    'autoDimensions': true,
                    'centerOnScroll': true,
                    'href': "#contrasting-collar-cuff-lining-fabrics",
                    afterShow: function () {

                        $(".fancybox-inner").scrollTo('#selected-fabric', 500);

                    }

                });

            });

            $('body').on('click', '.select-fabric', function () {

                $(this).parent().find('li').removeAttr('id').removeClass('selected-fabric');

                $(this).addClass('selected-fabric');

                $(this).attr('id', 'selected-fabric');

                $('#lining-code').remove();

                var fabric_title = $(this).find('.fabric-title').text();

                $('#target-contrasting-collar-cuff-lining').find('option').removeAttr('selected');

                if (fabric_title != "No Lining") {

                    $('#target-contrasting-collar-cuff-lining').after('<input type="hidden" id="lining-code" name="extras[lining-code]" value="' + $(this).find('.fabric-title').data('fabriccode') + '" />');

                    var yes_option = $('#target-contrasting-collar-cuff-lining').find('option[value="Yes-1"]');

                    var yes_option_price = $(yes_option).text().replace(/.*\[|\]/gi, '');

                    var new_yes_option_text = $(this).find('.fabric-title').text() + "[" + yes_option_price + "]";

                    $('#target-contrasting-collar-cuff-lining').val('Yes-1');

                    $(yes_option).attr('selected', 'selected');

                    $(yes_option).text(new_yes_option_text);

                } else {

                    var no_option = $('#target-contrasting-collar-cuff-lining').find('option[value="No-0"]');

                    $(no_option).attr('selected', 'selected');

                    var yes_option = $('#target-contrasting-collar-cuff-lining').find('option[value="Yes-1"]');

                    justName = $(yes_option).text().replace(/.*\[|\]/gi, '');

                    $(yes_option).text("Yes[" + justName + "]");

                }

                $.fancybox.close();

            });

// End Design/Extras Image pop-up Selection



// Product Tab Content

            $('body').on('click', '.steps-tabs li', function (e) {

                e.preventDefault();

                if ($(this).hasClass('is_active')) {

                    var current_step = $(this).find('a').attr('href');

                    if ($('.steps-tabs li').index($(this)) == 0) {

                        $('.browse-results').infinitescroll('bind');

                        if ($('#browse-shirts-option').val() == "product-made-shirt") {

                            $('.made-shirt-header').show();

                            $('#step-header').hide();

                        }

                        $('.steps-tabs li').removeClass('is_active');

                    }

                    if (current_step == "#sizing-tab") {

                        // Check Monogram - Display Required pop up

                        if (!check_monogram()) {

                            return false;

                        }

                    }

                    $('.product-tab').slideUp();

                    $('.steps-tabs li').removeClass('browse-navbar-active');

                    // Change Sizing Options based on Design/Extras

                    change_sizing_options();

                    $(current_step).show();

                    $(this).addClass('browse-navbar-active');

                }

            });



            $('body').on('click', '.change-step', function (e) {

                e.preventDefault();

                var selected_href = $(this).attr('href');

                var selected_li = $('.steps-tabs').find('a[href="' + selected_href + '"]').parent();

                // Change Sizing Options based on Design/Extras

                change_sizing_options();

                selected_li.click();

            });



            $('body').on('click', '.step-back', function (e) {

                e.preventDefault();

                var selected_li = $('.steps-tabs').find('li.browse-navbar-active');

                var to_select = $(selected_li).prev();

                var current_step = $(to_select).find('a').attr('href');

                $('.product-tab').hide();

                $('.steps-tabs li').removeClass('browse-navbar-active');

                if ($('.steps-tabs li').index($(to_select)) == 0) {

                    $('.browse-results').infinitescroll('bind');

                    if ($('#browse-shirts-option').val() == "product-made-shirt") {

                        $('.made-shirt-header').show();

                        $('#step-header').hide();

                    }

                    $('.steps-tabs li').removeClass('is_active');

                }

                $(to_select).addClass('browse-navbar-active');

                $(current_step).show();

            });



            function check_monogram() {

                if (typeof $('#target-monogram').val() !== "undefined") {

                    if ($('#target-monogram').val() != "No-0") {

                        var errors = "";

                        var newoutput = "";

                        if ($('.popup-color-position select').val() == "") {

                            errors += "<li><span>You can't leave the <span class='highlight'>Monogram Position</span> field empty.</span></li>";

                        }

                        if ($('.popup-name input').val() == "") {

                            errors += "<li><span>You can't leave the <span class='highlight'>Monogram Text</span> field empty.</span></li>";

                        }



                        if (errors.length) {

                            var newdiv2 = document.createElement('div');

                            $(newdiv2).addClass('checkout-errors');

                            $(newdiv2).attr('id', 'c-errors');

                            $('body').append(newdiv2);

                            newoutput = "<ul class='checkout-errors2'>";

                            newoutput += errors;

                            newoutput += "</ul>";

                            $.fancybox({
                                'href': '#c-errors',
                                afterLoad: function () {

                                    this.inner.prepend(newoutput);

                                }

                            });

                            return false;

                        }

                    }

                }



                return true;

            }



            function change_sizing_options() {

                // Short Sleeve

                if ($('#target-cuff').val() == "Short Sleeve") {

                    $('.input-profile.container-arm-length').hide();

                    $('.input-profile.container-arm-length-short').show();

                }

            }



            $('body').on('click', '.edit-this-design', function () {

                $('#edit-shirt').show();

                $('#ready-made').slideUp();

                $('.steps-tabs li').addClass('is_active');



                return false;

            });



// Step 4 Javascript

            $('body').on('change', '.select-profile > select', function () {

                if ($(this).val() == "") {

                    $('#profile-name').val();

                } else {

                    var current_div = $(this).parent();

                    current_div.find('.loading-search').remove();

                    current_div.append('<img src="' + ajax_object.ajax_url + '/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');

                    $.ajax({
                        type: "POST",
                        url: ajax_object.ajax_url,
                        data: "action=fill-profile&profile-key=" + $(this).val(),
                        dataType: 'json',
                        success: function (result) {

                            //current_value_type = $();

                            var sizingtype = result.sizing.sizing_type;

                            var valuetype = result.sizing.value_type;

                            $('.sizing-options').hide();

                            $('.options-container').hide();

                            $('#measure-option').val(sizingtype);

                            if ($('#measure-your-jacket').length) {

                                $('#measure-your-jacket').find('#profile-name').val(result.profile_name);

                                $('#measure-your-jacket').show();

                            }

                            $('#' + sizingtype).find('#profile-name').val(result.profile_name);

                            $('#' + sizingtype).show();

                            if (sizingtype == "standard-sizing") {

                                replace_standard_sizing_values(valuetype);

                            } else {

                                replace_body_shirt_values(valuetype);

                            }

                            $.each(result.sizing, function (i, e) {

                                if (i == "general") {

                                    $.each(e, function (gi, ge) {
                                        console.log("124 cm / 4’1\"" + "//" + ge.replace("'", "’"));

                                        $('select[name="sizing[' + sizingtype + '][' + i + '][' + gi.replace(/\_/g, "-") + ']"]').val(ge.replace("'", "’"));

                                    });

                                } else {

                                    if (sizingtype == "standard-sizing") {

                                        // Populate Sleeve Measurements

                                        if (i == "value_type") {

                                            $('.change-neck-values').each(function () {

                                                if ($(this).val() == e) {

                                                    $(this).attr('checked', 'checked');

                                                }

                                            });

                                        } else {

                                            $('[name="sizing[' + sizingtype + '][' + i.replace(/\_/g, "-") + ']"]').val(e);

                                        }

                                    } else {

                                        $('[name="sizing[' + sizingtype + '][' + i.replace(/\_/g, "-") + ']"]').val(e);

                                    }

                                }

                            });

                            current_div.find('.loading-search').remove();

                        }

                    });

                }



            });

            $('body').on('change', '#measure-option', function () {

                var current_option = $(this).val();



                $('.sizing-options').hide();

                $('.options-container').hide();

                $('#' + current_option).show();

            });

            $('body').on('click', '.select-sizing-option', function () {

                var current_option = $(this).data('sizing-option');


                $('#_sizing_type').val(current_option);

                $('#measure-option').val(current_option);

                $('.sizing-options').hide();

                $('.options-container').hide();

                $('#' + current_option).show();




            });

            $('body').on('click', '.measure-small-nav a', function () {

                var selected_tab = $(this).attr('href');

                $('.measure-small-nav a').removeClass('selected');

                $('.options-container').hide();

                $(this).addClass('selected');

                $(selected_tab).show();

                return false;

            });

            $('body').on('submit', "#main-product-form, #profile-measurements-form", function (e) {

                var errors = "";

                var newoutput = "";

                if (!$('.options-container').is(':visible')) {

                    errors += "<li><span>You need to select a Sizing Option</span></li>";

                } else {

                    //	alert($('.input-profile').parents('.options-container').attr('id'));

                    $('.options-container').each(function () {

                        if ($(this).is(':visible')) {//console.log($(this).attr('id'));

                            if ($(this).find('#profile-name').val() == "") {

                                errors += "<li><span>You need to fill in the <span class='highlight'>Profile Name</span> field.</span></li>";

                            }

                            if ($(this).attr('id') == "standard-sizing") { // Standard Sizing different check

                                $('select.standard-neck-values, select.standard-sleeve-values, input.standard-input').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                            } else {

                                $(this).find('select.general-values').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the Profile General <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                                $(this).find('select.selected-values:visible').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                            }



                            if ($(this).attr('id') == "measure-your-jacket") {

                                $('#measure-your-pants').find('select.selected-values').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                            } else if ($(this).attr('id') == "measure-your-pants") {

                                if ($('#measure-your-jacket').find('#profile-name').val() == "") {

                                    errors += "<li><span>You need to fill in the <span class='highlight'>Profile Name</span> field.</span></li>";

                                }

                                $('#measure-your-jacket').find('select.general-values').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the Profile General <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                                $('#measure-your-jacket').find('select.selected-values').each(function () {

                                    if ($(this).val() == "") {

                                        errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

                                    }

                                });

                            }

                        }

                    });

                }



                if (errors.length) {

                    var newdiv2 = document.createElement('div');

                    $(newdiv2).addClass('checkout-errors');

                    $(newdiv2).attr('id', 'c-errors');

                    $('body').append(newdiv2);

                    newoutput = "<ul class='checkout-errors2'>";

                    newoutput += errors;

                    newoutput += "</ul>";

                    $.fancybox({
                        'href': '#c-errors',
                        afterLoad: function () {

                            this.inner.prepend(newoutput);

                        }

                    });

                    e.preventDefault();

                }

            });



            function replace_body_shirt_values(value) {

                var other_value = "";

                if (value == "centimeters") {

                    other_value = "inches";

                } else {

                    other_value = "centimeters";

                }

                var to_replace;

                var replacements;

                $('.input-profile').each(function () {

                    to_replace = $(this).find('.selected-values').html();

                    replacements = $(this).find('.replace-values[data-type="' + value + '"]').html();

                    $(this).find('.selected-values').html(replacements);


                });

            }

            function replace_standard_sizing_values(value) {

                var other_value = "";

                if (value == "centimeters") {

                    other_value = "inches";

                } else {

                    other_value = "centimeters";

                }

                var to_replace = $('.standard-neck-values').html();

                var replacements = $('.unselected-neck-values[data-type="' + value + '"]').html();

                $('.standard-neck-values').html(replacements);

            }



// Change Cm/In

            $('body').on('change', '.change-values', function () {

                var current_val = $(this).val();

                replace_body_shirt_values(current_val);


            });

            $('body').on('click', '.change-neck-values', function () {

                var current_val = $(this).val();

                replace_standard_sizing_values(current_val);

            });

// End Change Cm/In



            $('body').on('change', '.input-profile select', function () {

                var option_selected = $(this).children(':selected');

                $(this).children().attr('selected', false);

                $(this).val(option_selected.val());

                option_selected.attr('selected', true);

            });



            $('body').on('change', '.standard-neck-values', function () {

// Legend: 0,1 keys are Standard Sleeve Lenghts and 2,3 keys are the main interval

                var option_selected = $(this).children(':selected');

                $(this).children().attr('selected', false);

                $(this).val(option_selected.val());

                option_selected.attr('selected', true);



                var data_sleeve = $(this).children(':selected').attr('data-alt');

                var sleeve_array = data_sleeve.split(","), i;

                var standard_option_list = "";

                var option_list = "";

                var standard_interval = new Array;

                var main_interval = new Array;



// Get Step based on value

                $('.change-neck-values').each(function () {

                    if ($(this).is(':checked')) {

                        value_type = $(this).val();

                    }

                });

                if (value_type == "centimeters") {

                    step = 1;

                } else {

                    step = 0.5;

                }



                // Create Standard Interval

                var sleeve0 = Number(sleeve_array[0]);

                var sleeve1 = Number(sleeve_array[1]);

                x = sleeve0;

                standard_option_list = '<optgroup label="Standard sleeve lengths">';

                while (x <= sleeve1) {

                    standard_interval[standard_interval.length] = x;

                    standard_option_list += '<option value="' + x + '">' + x + '</option>';

                    x = x + step;

                }

                standard_option_list += '</optgroup>';



                // Create Main Interval and Exclude Standard Lenghts

                var sleeve2 = Number(sleeve_array[2]);

                var sleeve3 = Number(sleeve_array[3]);

                var y = sleeve2;

                option_list = '<optgroup label="Special sleeve lengths">';

                while (y <= sleeve3) {

                    if (!in_array(y, standard_interval)) {

                        main_interval[main_interval.length] = y;

                        option_list += '<option value="' + y + '">' + y + '</option>';

                    }

                    y = y + step;

                }

                option_list += '</optgroup>';



                $('.standard-sleeve-values').html(standard_option_list + option_list);

            });

            $('body').on('focus mousedown', '.standard-fit', function () {

                $.fancybox({'href': '#standard-fit', });

            });

            $('body').on('click', '.sfit-row', function () {

                var data = $(this).attr('data-value');

                $('.standard-fit').val(data);

                $.fancybox.close();

            });



// Info Tab Content

            $('body').on('click', '.input-profile', function () {

                $(this).parent().find('.input-profile').removeClass('input-profile-active');

                $(this).parents('.options-container').find('.field-info').hide();

                var current_tab = $(this).attr('data-info');

                $('#' + current_tab).show();

                $(this).addClass('input-profile-active');

            });

            $('body').on('focus', '.input-profile select', function () {

                $(this).parent().click();

            });

// Infinite Scrolling

            (window.INFSCR_jQ ? jQuery.noConflict() : jQuery)(function ($) {

                init_scroll();
                init_scroll_browse_shirt();

            });



            function init_scroll() {
                $('.browse-results').infinitescroll({
                    loading: {
                        finishedMsg: "<em>You've reached the end of the page.</em>",
                        msgText: "<em>Loading ...</em>",
                    },
                    debug: true,
                    extraScrollPx: 500,
                    nextSelector: "div.posts-nav a",
                    navSelector: "div.posts-nav",
                    contentSelector: ".browse-results",
                    itemSelector: ".browse-results div.row-fluid"
                });
            }

            function init_scroll_browse_shirt() {
                $('.browse-results-search').infinitescroll({
                    loading: {
                        finishedMsg: "<em>You've reached the end of the page.</em>",
                        msgText: "<em>Loading ...</em>",
                    },
                    debug: true,
                    extraScrollPx: 500,
                    nextSelector: "div.posts-nav a",
                    navSelector: "div.posts-nav",
                    contentSelector: ".browse-results-search",
                    itemSelector: ".browse-results-search div.span3"
                });
            }




// Helper Functions

            function verify_checkout() {

                var output = "";

                var newoutput = "";

                var input = "";

                var newdiv2 = document.createElement('div');

                $(newdiv2).addClass('checkout-errors');

                $(newdiv2).attr('id', 'c-errors');

                $('body').append(newdiv2);

                $('.checkout-details-input.required').each(function () {

                    input = $(this).find('input');

                    if ($(input).val() == "") {

                        output += "<li><span>You can't leave the <span class='highlight'>" + $(input).prev().html() + "</span> field empty.</span></li>";

                    } else {

                        if ($(this).hasClass('verify-email')) {

                            if (!validateEmail($(input).val())) {

                                output += "<li><span>You must enter a valid email in the <span class='highlight'>" + $(input).prev().html() + "</span></span></li>";

                            } else {

                                if ($(this).hasClass('confirm-email')) {

                                    if ($(input).val() != $(this).prev().find('input').val()) {

                                        output += "<li><span>The  <span class='highlight'>" + $(input).prev().html() + "</span> field must match the <span class='highlight'>" + $(this).prev().find('input').prev().html() + "</span> field</span></li>";

                                    }

                                }

                            }

                        }

                    }

                });



                if (output != "") {

                    newoutput = "<ul class='checkout-errors2'>";

                    newoutput += output;

                    newoutput += "</ul>";

                    //$(newdiv2).append(newoutput);

                    $.fancybox({
                        'href': '#c-errors',
                        afterLoad: function () {

                            this.inner.prepend(newoutput);

                        }

                    });

                    return false;

                } else {

                    return true;

                }



            }



            function validateEmail(email) {

                var re = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

                return re.test(email);

            }



            function in_array(needle, haystack) {

                for (var a in haystack) {

                    if (haystack[a] == needle)
                        return true;

                }

                return false;

            }



            var addUrlParam = function (search, key, val) {

                var newParam = key + '=' + val,
                        params = '?' + newParam;



                // If the "search" string exists, then build params from it

                if (search) {

                    // Try to replace an existance instance

                    params = search.replace(new RegExp('[\?&]' + key + '[^&]*'), '$1' + newParam);



                    // If nothing was replaced, then add the new param to the end

                    if (params === search) {

                        params += '&' + newParam;

                    }

                }



                return params;

            };
        });

</script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript">
        function profile_manager()
        {
            var profile = jQuery('.cls-profile-manager').val();
            //alert(profile);
            jQuery.ajax({
                type: "post",
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'get_profile_screen',
                    profile: profile,
                },
                success: function (response) {
                    jQuery('.tab_border_line').html(response);
                }
            });
        }
        jQuery(document).ready(function ($) {



            jQuery("#signup").validate({
                rules: {
                    text_email: {
                        required: true,
                        email: true
                    },
                    text_c_email: {
                        email: true,
                        equalTo: "#text_email"

                    },
                    txt_pwd: {
                        required: true,
                    }

                },
                messages: {
                    text_c_email: " Enter Confirm Email Same as Email"
                }
            });
        });
</script>
<script type="text/javascript">

    function get_profile_type(profile_id)
    {
        jQuery.ajax({
            type: "post",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'get_profile_option',
                profile_id: profile_id,
            },
            success: function (response) {

                jQuery('.select-sizing-option').data('sizing-option', response);
                document.getElementById('my_sizing_type').value = response;

            }

        });

    }



    function select_profile(settings_id)
    {
        var profile_id = document.getElementById('uprofile').value;
        var measurement = get_profile_type(profile_id);
        var measurement = document.getElementById('my_sizing_type').value;
        jQuery('.loading-search').show();
        //alert(measurement);
        if (profile_id == 0)
        {
            document.getElementById('my_sizing_type').value = 'measure-your-body';

            jQuery('.select-sizing-option').data('sizing-option', 'measure-your-body');
        }
        if (measurement == "")
        {
            measurement = 'measure-your-body';
        }
        jQuery('.select-sizing-option').data('sizing-option', measurement);
        jQuery('#siz-optiollk').trigger('click');

        jQuery.ajax({
            type: "post",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'get_user_profile',
                profile_id: profile_id, settings_id: settings_id,
            },
            success: function (response) {
                if (settings_id == 355)
                {
                    jQuery('#suit').html(response);
                }
                else
                {

                    jQuery('#' + measurement).html(response);
                }
                jQuery('.loading-search').hide();
            }

        });

    }

    function show_profile()
    {
        document.getElementById('uprofile').style.display = 'block';
    }

    function hide_profile()
    {
        document.getElementById('uprofile').style.display = 'none';


        //alert(measurement);
        var measurement = document.getElementById('my_sizing_type').value;
        jQuery("#measure-your-body").find("input[type=text]").val('');
        jQuery('#measure-your-body select').val("");
        jQuery('#measure-your-body').trigger('click');
        //jQuery('#measure-your-body').hide();
        jQuery('#measure-your-shirt').hide();
        jQuery('#standard-sizing').hide();
        jQuery('#siz-optiollk').show();
        jQuery('.sizing-options').hide();

    }
    function hide_profile_shirt()
    {
        document.getElementById('uprofile').style.display = 'none';
        var measurement = document.getElementById('my_sizing_type').value;

        jQuery("#measure-your-body").find("input[type=text]").val('');
        jQuery('#measure-your-body select').val("");

        jQuery("#measure-your-shirt").find("input[type=text]").val('');
        jQuery('#measure-your-shirt select').val("");

        jQuery("#standard-sizing").find("input[type=text]").val('');
        jQuery('#standard-sizing select').val("");

        jQuery('#measure-your-body').hide();
        jQuery('#measure-your-shirt').hide();
        jQuery('#standard-sizing').hide();
        jQuery('#siz-optiollk').show();
        jQuery('.sizing-options').show();
    }


    function show_hide(prod_id)
    {
        jQuery('#product-detail-' + prod_id).slideToggle();
    }
   function show_hide2(order_pro_id)
    {
        jQuery('#product-detail-oder-'+ order_pro_id).slideToggle();
    }  

    function save_my_profile()
    {
        jQuery("#main-product-form").submit();
    }

    function delete_profile(pid)
    {
        var r = confirm("Do You Want to Delete This Profile ?");
        if (r == true) {

            jQuery.ajax({
                type: "post",
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'delete_myaccount_profile',
                    profile_id: pid,
                },
                success: function (response) {

                    jQuery("#profile-row-" + pid).hide();

                }

            });

        }


    }

    function edit_my_profile(pid, settings_id, sz)
    {

        jQuery.ajax({
            type: "post",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'get_profile_screen',
                profile_id: pid, settings_id: settings_id,
            },
            success: function (response) {
                jQuery('.tab_border_line').html(response);

                jQuery('.select-sizing-option').data('sizing-option', sz);
                jQuery('.select-sizing-option').trigger('click');
            }

        });

    }

    jQuery(document).ready(function($){
        $( '.woocommerce-tabs ul.tabs li a' ).click( function() {

            var $tab = $( this ),
            $tabs_wrapper = $tab.closest( '.woocommerce-tabs' );

            $( 'ul.tabs li', $tabs_wrapper ).removeClass( 'active' );
            $( 'div.panel', $tabs_wrapper ).hide();
            $( 'div' + $tab.attr( 'href' ), $tabs_wrapper).show();
            $tab.parent().addClass( 'active' );

            return false;
        });
    });


    function submit_filter()
    {
        var color =  [];
        var i = 0;
        jQuery('input[name="pa_color[]"]:checked').each(function () {
           color[i++] = jQuery(this).val();
        });

        var weight =  [];
        var i = 0;
        jQuery('input[name="pa_fabric-weight[]"]:checked').each(function () {
           weight[i++] = jQuery(this).val();
        });

        var pattern =  [];
        var i = 0;
        jQuery('input[name="pa_pattern[]"]:checked').each(function () {
           pattern[i++] = jQuery(this).val();
        });

        var price =  [];
        var i = 0;
        jQuery('input[name="price[]"]:checked').each(function () {
           price[i++] = jQuery(this).val();
        });

        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            beforeSend: function( xhr ) {
                jQuery('.gif-filter').show();
            },
            data: {
                action: 'submitFilter',
                security: jQuery('input[name=submit-filter-ajax-none]').val(),
                color: color,
                weight: weight,
                pattern: pattern,
                price: price,
                current_url: jQuery('input[name=current-url]').val(),
            }
        }).done(function(data){
            jQuery('.gif-filter').hide();
            window.location.replace(data);
        });

        return false;
    }
       
</script>

<script>
/*function showHint(str) {
  var xhttp;
  if (str.length == 0) { 
    document.getElementById("mutliSelect-pa_color").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("mutliSelect-pa_color").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "/BVQT/wp-admin/gethint.php?q="+str, true);
  xhttp.send();   
}*/
</script>
<script>
/*
      var ias = $.ias({
          container:  ".scroll",
          item:       ".products",
          pagination: ".woocommerce-pagination",
          next:       ".next"
    });
    
        ias.extension(new IASSpinnerExtension());         
        ias.extension(new IASNoneLeftExtension({
          text: 'There are no more pages left to load.'      
    }));
*/
</script>
<script>
$(document).ready(function(){
    $(".widget_color").click(function(){
        $(".widget-slideToggle-Color").slideToggle();
    });
});
$(document).ready(function(){
    $(".widget-weight").click(function(){
        $(".widget-slideToggle-Weight").slideToggle();
    });
});
$(document).ready(function(){
    $(".widget-pattern").click(function(){
        $(".widget-slideToggle-Pattern").slideToggle();
    });
});
$(document).ready(function(){
    $(".widget-price").click(function(){
        $(".widget-slideToggle-Price").slideToggle();
    });
});
$(document).ready(function(){
    $(".widget-pattern").click(function(){
        $(".widget-slideToggle-Pattern-Shirts").slideToggle(); 
    });
});
$(document).ready(function(){
    $(".widget_fabric_suits").click(function(){
        $(".widget-slideToggle-Fabric").slideToggle();
    });
});
</script>


</body>

</html>
