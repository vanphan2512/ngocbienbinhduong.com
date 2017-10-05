<?php
/* * *************************************************************************** */
/* * *************************** Theme Options ******************************** */
/* * *************************************************************************** */

if (!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/settings/redux/ReduxCore/framework.php')) {
    require_once( dirname(__FILE__) . '/settings/redux/ReduxCore/framework.php' );
}
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/settings/mrtailor.config.php')) {
    require_once( dirname(__FILE__) . '/settings/mrtailor.config.php' );
}

/* * *************************************************************************** */
/* * ****************************** Includes *********************************** */
/* * *************************************************************************** */

include_once('framework/inc/custom-fonts.php'); // Load Custom Fonts
include_once('framework/inc/custom-styles.php'); // Load Custom Styles
include_once('framework/templates/post-meta.php'); // Load Post meta template
include_once('framework/templates/template-tags.php'); // Load Template Tags
include_once('includes/product-filter.php'); // Load Template filter
//Include metaboxes
define('_TEMPLATEURL', WP_CONTENT_URL . '/themes/' . basename(TEMPLATEPATH));



include_once 'framework/inc/wpalchemy/MetaBox-mod.php';
include_once 'framework/inc/wpalchemy/MediaAccess-mod.php';


// Add Promotions

require_once(dirname(__FILE__) . '/includes/admin/promotions.php');

add_action('init', 'mr_tailor_metabox_styles');

function mr_tailor_metabox_styles() {
    if (is_admin()) {
        wp_enqueue_style('wpalchemy-metabox', _TEMPLATEURL . '/framework/css/wp-admin-metabox.css');
    }
}

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

//Include metaboxes
include_once 'framework/metaboxes/slider-spec.php';
include_once 'framework/metaboxes/map-spec.php';

//Include shortcodes
include_once('framework/shortcodes/wishlist.php');
include_once('framework/shortcodes/product-categories.php');
include_once('framework/shortcodes/socials.php');
include_once('framework/shortcodes/from-the-blog.php');
include_once('framework/shortcodes/separator.php');
include_once('framework/shortcodes/spacing.php');

/* * *************************************************************************** */
/* * ********************** Plugin recommendations ***************************** */
/* * *************************************************************************** */

require_once dirname(__FILE__) . '/framework/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'mr_tailor_theme_register_required_plugins');

function mr_tailor_theme_register_required_plugins() {

    $plugins = array(
        //delivered with the theme

        array(
            'name' => 'WooCommerce', // The plugin name
            'slug' => 'woocommerce', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/woocommerce.2.2.3.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '2.2.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'WooCommerce Header Category Image', // The plugin name
            'slug' => 'woocommerce-header-category-image', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/woocommerce-header-category-image.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Envato Toolkit', // The plugin name
            'slug' => 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/envato-wordpress-toolkit.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Visual Composer', // The plugin name
            'slug' => 'js_composer', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/js_composer.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '4.3.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Revolution Slider', // The plugin name
            'slug' => 'revslider', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
            'required' => false, // If false, the plugin is only 'recommended' instead of required
            'version' => '4.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        //from WP repository
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
            'version' => '3.9.3',
        ),
        array(
            'name' => 'WP Retina 2x',
            'slug' => 'wp-retina-2x',
            'required' => false,
            'version' => '2.0.4',
        ),
    );

    $theme_text_domain = 'mr_tailor';

    $config = array(
        'domain' => $theme_text_domain, // Text domain
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php', // Default parent menu slug
        'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', $theme_text_domain),
            'menu_title' => __('Install Plugins', $theme_text_domain),
            'installing' => __('Installing Plugin: %s', $theme_text_domain), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', $theme_text_domain),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', $theme_text_domain),
            'plugin_activated' => __('Plugin activated successfully.', $theme_text_domain),
            'complete' => __('All plugins installed and activated successfully. %s', $theme_text_domain), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa($plugins, $config);
}

/* * *************************************************************************** */
/* * ************************* Visual Composer ********************************* */
/* * *************************************************************************** */

if (class_exists('WPBakeryVisualComposerAbstract')) {
    if (function_exists('vc_set_as_theme'))
        vc_set_as_theme(true);
    vc_disable_frontend();

    // Modify and remove existing shortcodes from VC
    include_once('framework/shortcodes/visual-composer/custom_vc.php');

    // VC Templates
    $vc_templates_dir = get_template_directory() . '/framework/shortcodes/visual-composer/vc_templates/';
    vc_set_template_dir($vc_templates_dir);

    // Add new shortcodes to VC
    include_once('framework/shortcodes/visual-composer/from-the-blog.php');
    include_once('framework/shortcodes/visual-composer/social-media-profiles.php');

    // Add new Shop shortcodes to VC
    if (class_exists('WooCommerce')) {
        include_once('framework/shortcodes/visual-composer/wc-recent-products.php');
        include_once('framework/shortcodes/visual-composer/wc-featured-products.php');
        include_once('framework/shortcodes/visual-composer/wc-products-by-category.php');
        include_once('framework/shortcodes/visual-composer/wc-products-by-attribute.php');
        include_once('framework/shortcodes/visual-composer/wc-product-by-id-sku.php');
        include_once('framework/shortcodes/visual-composer/wc-products-by-ids-skus.php');
        include_once('framework/shortcodes/visual-composer/wc-sale-products.php');
        include_once('framework/shortcodes/visual-composer/wc-top-rated-products.php');
        include_once('framework/shortcodes/visual-composer/wc-best-selling-products.php');
        include_once('framework/shortcodes/visual-composer/wc-add-to-cart-button.php');
        include_once('framework/shortcodes/visual-composer/wc-product-categories.php');
        include_once('framework/shortcodes/visual-composer/wc-product-categories-grid.php');
    }

    // Add new Options
    function add_vc_text_separator_no_border() {
        $param = WPBMap::getParam('vc_text_separator', 'style');
        $param['value'][__('No Border', 'js_composer')] = 'no_border';
        WPBMap::mutateParam('vc_text_separator', $param);
    }

    add_action('init', 'add_vc_text_separator_no_border');

    // Remove vc_teaser
    if (is_admin()) :

        function remove_vc_teaser() {
            remove_meta_box('vc_teaser', '', 'side');
        }

        add_action('admin_head', 'remove_vc_teaser');
    endif;
}


/* * *************************************************************************** */
/* * **************************** Ajax url ************************************* */
/* * *************************************************************************** */

add_action('wp_head', 'mrtailor_ajaxurl');

function mrtailor_ajaxurl() {
    ?>
    <script type="text/javascript">
        var mrtailor_ajaxurl = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
    </script>
    <?php
}

/* * *************************************************************************** */
/* * ********************** Ajax calls ***************************************** */
/* * *************************************************************************** */

//ajax on shopping bag items number
if (class_exists('WooCommerce')) {

    function refresh_shopping_bag_items_number() {
        global $woocommerce;
        echo $woocommerce->cart->cart_contents_count;
        die();
    }

    add_action('wp_ajax_refresh_shopping_bag_items_number', 'refresh_shopping_bag_items_number');
    add_action('wp_ajax_nopriv_refresh_shopping_bag_items_number', 'refresh_shopping_bag_items_number');
}

//ajax on wishlist items number
if (class_exists('YITH_WCWL')) {

    function refresh_wishlist_items_number() {
        global $yith_wcwl;
        echo yith_wcwl_count_products();
        die();
    }

    add_action('wp_ajax_refresh_wishlist_items_number', 'refresh_wishlist_items_number');
    add_action('wp_ajax_nopriv_refresh_wishlist_items_number', 'refresh_wishlist_items_number');
}



/* * *************************************************************************** */
/* * ********************* mr_tailor setup ************************************* */
/* * *************************************************************************** */


if (!function_exists('mr_tailor_setup')) :

    function mr_tailor_setup() {

        global $mr_tailor_theme_options;

        /** Theme support * */
        add_theme_support('menus');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio'));
        add_theme_support('woocommerce');

        function custom_header_custom_bg() {
            add_theme_support('custom-header');
            add_theme_support('custom-background');
        }

        /** Add Image Sizes * */
        $shop_catalog_image_size = get_option('shop_catalog_image_size');
        $shop_single_image_size = get_option('shop_single_image_size');
        add_image_size('product_small_thumbnail', (int) $shop_catalog_image_size['width'] / 3, (int) $shop_catalog_image_size['height'] / 3, $shop_catalog_image_size['crop']); // made from shop_catalog_image_size
        add_image_size('shop_single_small_thumbnail', (int) $shop_single_image_size['width'] / 3, (int) $shop_single_image_size['height'] / 3, $shop_single_image_size['crop']); // made from shop_single_image_size
        //add_image_size('default_gallery_img', 300, 300, true);
        //add_image_size('product_small_thumbnail', 100, 100, true);

        /** Register menus * */
        register_nav_menus(array(
            'top-bar-navigation' => __('Top Bar Navigation', 'mr_tailor'),
            'main-navigation' => __('Main Navigation', 'mr_tailor'),
        ));

        /** Theme textdomain * */
        load_theme_textdomain('mr_tailor', get_template_directory() . '/languages');

        /** WooCommerce Number of products displayed per page * */
        if ((isset($mr_tailor_theme_options['products_per_page']))) {
            add_filter('loop_shop_per_page', create_function('$cols', 'return ' . $mr_tailor_theme_options['products_per_page'] . ';'), 20);
        }
    }

endif; // mr_tailor_setup
add_action('after_setup_theme', 'mr_tailor_setup');




/* * *************************************************************************** */
/* * ********************* Enable excerpts ************************************* */
/* * *************************************************************************** */

add_action('init', 'mr_tailor_post_type_support');

function mr_tailor_post_type_support() {
    add_post_type_support('page', 'excerpt');
}

/* * *************************************************************************** */
/* * ************************** Enqueue styles ********************************* */
/* * *************************************************************************** */

// frontend
function mr_tailor_styles() {

    global $mr_tailor_theme_options;

    wp_enqueue_style('mr_tailor-default-style', get_stylesheet_uri());

   // wp_enqueue_style('mr_tailor-framework-styles', get_template_directory_uri() . '/framework/css/defaults.css', array(), '1.0', 'all' );
   // wp_enqueue_style('mr_tailor-styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all' );
   // wp_enqueue_style('mr_tailor-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all' );
    if ((isset($mr_tailor_theme_options['debug_mode'])) && ($mr_tailor_theme_options['debug_mode'] == "1" )) {
        wp_enqueue_style('mr_tailor-debug', get_template_directory_uri() . '/framework/css/debug.css', array(), '1.0', 'all');
    }

    if (file_exists(dirname(__FILE__) . '/_theme-explorer/css/theme-explorer.css')) {
        wp_enqueue_style('mr_tailor-theme-explorer', get_template_directory_uri() . '/_theme-explorer/css/theme-explorer.css', array(), '1.0', 'all');
    }
}

add_action('wp_enqueue_scripts', 'mr_tailor_styles', 99);

// admin area
function mr_tailor_admin_styles() {
    if (is_admin()) {

        wp_enqueue_style("mr_tailor_admin_styles", get_template_directory_uri() . "/framework/css/wp-admin-custom.css", false, "1.0", "all");

        if (class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('mr_tailor_visual_composer', get_template_directory_uri() . '/framework/css/visual-composer.css', false, "1.0", 'all');
        }
    }
}

add_action('admin_enqueue_scripts', 'mr_tailor_admin_styles');





/* * *************************************************************************** */
/* * ************************* Enqueue scripts ********************************* */
/* * *************************************************************************** */

// frontend
function mr_tailor_scripts() {

    /** In Header * */
    wp_enqueue_script('mr_tailor-modernizr', get_template_directory_uri() . '/framework/js/modernizr.custom.js', '', '2.6.3', FALSE);

    /** In Footer * */
    wp_enqueue_script('mr_tailor-foundation', get_template_directory_uri() . '/framework/js/foundation.min.js', array('jquery'), '5.2.0', TRUE);
    wp_enqueue_script('mr_tailor-foundation-interchange', get_template_directory_uri() . '/framework/js/foundation.interchange.js', array('jquery'), '5.2.0', TRUE);
    wp_enqueue_script('mr_tailor-touchswipe', get_template_directory_uri() . '/framework/js/jquery.touchSwipe.min.js', array('jquery'), '1.6.5', TRUE);
    wp_enqueue_script('mr_tailor-fitvids', get_template_directory_uri() . '/framework/js/jquery.fitvids.js', array('jquery'), '1.0.3', TRUE);
    wp_enqueue_script('mr_tailor-idangerous-swiper', get_template_directory_uri() . '/framework/js/idangerous.swiper.min.js', array('jquery'), '2.6.1', TRUE);
    wp_enqueue_script('mr_tailor-owl', get_template_directory_uri() . '/framework/js/owl.carousel.min.js', array('jquery'), '1.3.1', TRUE);
    wp_enqueue_script('mr_tailor-fresco', get_template_directory_uri() . '/framework/js/fresco.js', array('jquery'), '1.3.0', TRUE);
    wp_enqueue_script('mr_tailor-audioplayer', get_template_directory_uri() . '/framework/js/audioplayer.min.js', array('jquery'), NULL, TRUE);
    wp_enqueue_script('mr_tailor-nanoscroller', get_template_directory_uri() . '/framework/js/jquery.nanoscroller.min.js', array('jquery'), '0.7.6', TRUE);
    wp_enqueue_script('mr_tailor-framework-scripts', get_template_directory_uri() . '/framework/js/scripts.js', array('jquery'), '1.0', TRUE);
    wp_enqueue_script('mr_tailor-select2', get_template_directory_uri() . '/framework/js/select2.min.js', array('jquery'), '3.5.0', TRUE);
    wp_enqueue_script('mr_tailor-scroll_to', get_template_directory_uri() . '/framework/js/jquery.scroll_to.js', array('jquery'), '1.4.5', TRUE);
    wp_enqueue_script('mr_tailor-stellar', get_template_directory_uri() . '/framework/js/jquery.stellar.min.js', array('jquery'), '0.6.2', TRUE);
    wp_enqueue_script('mr_tailor-snapscroll', get_template_directory_uri() . '/framework/js/jquery.snapscroll.min.js', array('jquery'), '1.6.1', TRUE);
    wp_enqueue_script('mr_tailor-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', TRUE);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'mr_tailor_scripts', 99);






/* * ****************************************************************************************** */
/* * ****************************** Fix empty title on homepage  ****************************** */
/* * ****************************************************************************************** */

/* add_filter( 'wp_title', 'mr_tailor_hack_wp_title_for_home' );
  function mr_tailor_hack_wp_title_for_home( $title )
  {
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
  return __( 'Home', 'mr_tailor' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
  } */

add_filter('wp_title', 'mr_tailor_wp_title', 10, 2);

function mr_tailor_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name', 'display');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'mr_tailor'), max($paged, $page));
    }

    return $title;
}

/* * *************************************************************************** */
/* * ****************** Revolution Slider set as Theme ************************* */
/* * *************************************************************************** */

if (function_exists('set_revslider_as_theme')) {
    add_action('init', 'mr_tailor_set_revslider_as_theme');

    function mr_tailor_set_revslider_as_theme() {
        set_revslider_as_theme();
    }

}





/* * *************************************************************************** */
/* * **** Register widgetized area and update sidebar with default widgets ***** */
/* * *************************************************************************** */

function mr_tailor_widgets_init() {

    $sidebars_widgets = wp_get_sidebars_widgets();
    $footer_area_widgets_counter = "0";
    if (isset($sidebars_widgets['footer-widget-area']))
        $footer_area_widgets_counter = count($sidebars_widgets['footer-widget-area']);

    switch ($footer_area_widgets_counter) {
        case 0:
            $footer_area_widgets_columns = 'large-12';
            break;
        case 1:
            $footer_area_widgets_columns = 'large-12 medium-12 small-12';
            break;
        case 2:
            $footer_area_widgets_columns = 'large-6 medium-6 small-12';
            break;
        case 3:
            $footer_area_widgets_columns = 'large-4 medium-6 small-12';
            break;
        case 4:
            $footer_area_widgets_columns = 'large-3 medium-6 small-12';
            break;
        case 5:
            $footer_area_widgets_columns = 'footer-5-columns large-2 medium-6 small-12';
            break;
        case 6:
            $footer_area_widgets_columns = 'large-2 medium-6 small-12';
            break;
        default:
            $footer_area_widgets_columns = 'large-2 medium-6 small-12';
    }

    //default sidebar
    register_sidebar(array(
        'name' => __('Sidebar', 'mr_tailor'),
        'id' => 'default-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    //footer widget area
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'mr_tailor'),
        'id' => 'footer-widget-area',
        'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    //catalog widget area
    register_sidebar(array(
        'name' => __('Shop Sidebar (Off-Canvas)', 'mr_tailor'),
        'id' => 'catalog-widget-area',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'mr_tailor_widgets_init');



// Remove Woocommerce prettyPhoto
add_action('wp_enqueue_scripts', 'mr_tailor_remove_woo_lightbox', 99);

function mr_tailor_remove_woo_lightbox() {
    wp_dequeue_script('prettyPhoto-init');
}

/* * *************************************************************************** */
/* * **** Add Fresco to Galleries ********************************************** */
/* * *************************************************************************** */

add_filter('wp_get_attachment_link', 'sant_prettyadd', 10, 6);

function sant_prettyadd($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
        return $content;
    }
    $content = preg_replace("/<a/", "<a class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}

//Adds gallery shortcode defaults of size="medium" and columns="2"
/*
  function custom_gallery_atts( $out, $pairs, $atts ) {

  $atts = shortcode_atts( array(
  'size' => 'default_gallery_img',
  ), $atts );

  $out['size'] = $atts['size'];

  return $out;

  }
  add_filter( 'shortcode_atts_gallery', 'custom_gallery_atts', 10, 3 );
 */



/* * *************************************************************************** */
/* * **** Add Font Awesome to Redux ******************************************** */
/* * *************************************************************************** */

function newIconFont() {

    wp_register_style(
            'redux-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array(), time(), 'all'
    );
    wp_enqueue_style('redux-font-awesome');
}

// This example assumes the opt_name is set to mr_tailor_theme_options.
add_action('redux/page/mr_tailor_theme_options/enqueue', 'newIconFont');





/* * *************************************************************************** */
/* WooCommerce Update Number of Items in the cart **************************** */
/* * *************************************************************************** */

add_action('woocommerce_ajax_added_to_cart', 'mr_tailor_ajax_added_to_cart');

function mr_tailor_ajax_added_to_cart() {

    add_filter('add_to_cart_fragments', 'mr_tailor_shopping_bag_items_number');

    function mr_tailor_shopping_bag_items_number($fragments) {
        global $woocommerce;
        ob_start();
        ?>

        <script>
            (function ($) {
                $('.shopping-bag-button').trigger('click');
            })(jQuery);
        </script>

        <span class="shopping_bag_items_number animated flipYSmall"><?php echo $woocommerce->cart->cart_contents_count; ?></span>

        <?php
        $fragments['.shopping_bag_items_number'] = ob_get_clean();
        return $fragments;
    }

}

/* * *************************************************************************** */
/* WooCommerce Number of Related Products ************************************ */
/* * *************************************************************************** */

function woocommerce_output_related_products() {
    $atts = array(
        'posts_per_page' => '12',
        'orderby' => 'rand'
    );
    woocommerce_related_products($atts);
}

/* * *************************************************************************** */
/* WooCommerce Add data-src & lazyOwl to Thumbnails ************************** */
/* * *************************************************************************** */

function woocommerce_get_product_thumbnail($size = 'product_small_thumbnail', $placeholder_width = 0, $placeholder_height = 0) {
    global $post;

    if (has_post_thumbnail()) {
        $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'shop_catalog');
        return get_the_post_thumbnail($post->ID, $size, array('data-src' => $image_src[0], 'class' => 'lazyOwl'));
    } elseif (wc_placeholder_img_src()) {
        return wc_placeholder_img($size);
    }
}

function woocommerce_subcategory_thumbnail($category) {
    $small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'product_small_thumbnail');
    $thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'shop_catalog');
    $dimensions = wc_get_image_size($small_thumbnail_size);
    $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);

    if ($thumbnail_id) {
        $image_small = wp_get_attachment_image_src($thumbnail_id, $small_thumbnail_size);
        $image_small = $image_small[0];
        $image = wp_get_attachment_image_src($thumbnail_id, $thumbnail_size);
        $image = $image[0];
    } else {
        $image = $image_small = wc_placeholder_img_src();
    }

    if ($image_small)
        echo '<img data-src="' . esc_url($image) . '" class="lazyOwl" src="' . esc_url($image_small) . '" alt="' . esc_attr($category->name) . '" width="' . esc_attr($dimensions['width']) . '" height="' . esc_url($dimensions['height']) . '" />';
}

/* * *************************************************************************** */
/* WooCommerce Wrap Oembed Stuff ********************************************* */
/* * *************************************************************************** */
add_filter('embed_oembed_html', 'mr_tailor_embed_oembed_html', 99, 4);

function mr_tailor_embed_oembed_html($html, $url, $attr, $post_id) {
    return '<div class="video-container">' . $html . '</div>';
}

/* * *************************************************************************** */
/* * **** Overwrite WooCommerce Widgets **************************************** */
/* * *************************************************************************** */

function overwride_woocommerce_widgets() {
    if (class_exists('WC_Widget_Cart')) {
        include_once( 'framework/widgets/woocommerce-cart.php' );
        register_widget('mr_tailor_WC_Widget_Cart');
    }
}

add_action('widgets_init', 'overwride_woocommerce_widgets', 15);




/* * *************************************************************************** */
/* * **** WooCommerce Wishlist YITH Ajax Hook ********************************** */
/* * *************************************************************************** */

if (class_exists('YITH_WCWL')) {

    function wishlist_shortcode_offcanvas() {
        echo do_shortcode('[mr_tailor_yith_wcwl_wishlist]');
        die;
    }

    add_action('wp_ajax_wishlist_shortcode', 'wishlist_shortcode_offcanvas');
    add_action('wp_ajax_nopriv_wishlist_shortcode', 'wishlist_shortcode_offcanvas');
}




/* * *************************************************************************** */
/* * **** Set woocommerce images sizes ***************************************** */
/* * *************************************************************************** */

/**
 * Hook in on activation
 */
global $pagenow;
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php')
    add_action('init', 'mr_tailor_woocommerce_image_dimensions', 1);

/**
 * Define image sizes
 */
function mr_tailor_woocommerce_image_dimensions() {
    $catalog = array(
        'width' => '350', // px
        'height' => '435', // px
        'crop' => 1   // true
    );

    $single = array(
        'width' => '570', // px
        'height' => '708', // px
        'crop' => 1   // true
    );

    $thumbnail = array(
        'width' => '70', // px
        'height' => '87', // px
        'crop' => 1   // false
    );

    // Image sizes
    update_option('shop_catalog_image_size', $catalog);   // Product category thumbs
    update_option('shop_single_image_size', $single);   // Single product image
    update_option('shop_thumbnail_image_size', $thumbnail);  // Image gallery thumbs
}

/* * ***************************************************************************** */
if (!isset($content_width))
    $content_width = 640; /* pixels */

function tc_remove_poll_menus() {
    global $current_user;

    if (current_user_can('editor') || current_user_can('aa')) :

        global $menu;
        global $submenu;

        //remove poll sub menus
        unset($submenu['edit.php?post_type=shop_order'][10][0]);   //poll options


    endif;
}

add_action('admin_menu', 'tc_remove_poll_menus');


add_action('init', 'my_setcookie');

function my_setcookie() {
    setcookie('DiscountVoucherXnPP', '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
}

/* Shirt */

function get_prices_array($post_type) {

    global $wpdb;

    $prices = array();

    if (!empty($post_type)) {

        $prices = $wpdb->get_results("SELECT DISTINCT pm.meta_value FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts p ON p.ID = pm.post_id WHERE meta_key = 'price' AND p.post_type =  '" . $post_type . "' ORDER BY pm.meta_value ASC", 'ARRAY_A');
    }

    return $prices;
}

function display_product_list_shirt($post_obj, $current_page_link = "") {

    if ($material = get_field('material')) {

        $material_id = $material[0]->ID;
    }

    $post_type = $post_obj->post_type;
    ?>

    <div class="span3">

        <form action="#" method="post">

            <input type="hidden" name="action" value="load-steps" />

            <input type="hidden" name="product_id" value="<?php echo $post_obj->ID; ?>" />

            <?php if ($material_id) { ?>

                <input type="hidden" name="material_id" value="<?php echo $material_id; ?>" />

            <?php } ?>

            <?php if ($_GET['similar'] == NULL) { ?>
                <a href="<?php the_permalink(); ?>" class="">
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>?similar=<?php echo $_GET['similar']; ?>" class="">
                    <?php } ?>

                    <?php
                    $thumb_size = "shirt-image-thumb";

                    if (in_array($post_type, array('product-suit', 'product-pants', 'product-chinos'))) {

                        $thumb_size = "shirt-image-thumb";
                    }

                    $image_id = get_post_meta($post_obj->ID, 'images_0_image', true);

                    $image_src = wp_get_attachment_image_src($image_id, $thumb_size);

                    $link = $image_src[0];
                    ?>

                    <img  class="img-shirt-thumb" src="<?php echo $link; ?>" alt="<?php echo $post_obj->post_title; ?>" width="205">

                </a>

                <div class="result-detail">

                    <p class="bold"><?php echo $post_obj->post_title; ?></p>

                    <p><?php echo get_post_meta($post_obj->ID, 'excerpt', true); ?></p>

                    <p class="bold"><?php echo get_currency_code(); ?> <?php echo get_currency_sign() . get_currency_price(get_field('price')); ?></p>

                </div>
        </form>

    </div>

    <?php
}

/* ---------End------------------ */

/* --------currency------------------- */

//Default Values;
$currency_code = "USD";
$currency_sign = "$";
$currency_rate = 1;

function get_default_currency() {
    global $wpdb;

    $store_settings_id = 188;

    if (isset($_GET['currency'])) {
        $currencies = get_field('currencies', $store_settings_id);
        foreach ($currencies as $key => $currency) {
            if ($currency['currency_code'] == strtoupper($_GET['currency'])) {
                $default_currency_code = $currency['currency_code'];
                $default_currency_sign = $currency['currency_sign'];
                $default_currency_rate = $currency['conversion_rate_in_usd'];
            }
        }
    } else {
        if (empty($_SESSION['currency']) || !is_array($_SESSION['currency'])) {
            $_SESSION['currency'] = array();

            $currencies_number = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies' AND post_id = $store_settings_id");

            $default_currency_code = $default_currency_sign = $default_currency_rate = "";

            for ($x = 0; $x <= $currencies_number; $x++) {
                if ($wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies_" . $x . "_default'") == 1) {
                    $default_currency_code = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies_" . $x . "_currency_code'");
                    $default_currency_sign = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies_" . $x . "_currency_sign'");
                    $default_currency_rate = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies_" . $x . "_conversion_rate_in_usd'");
                }
            }
        } else {

            $default_currency_code = $currency_code;
            $default_currency_sign = $currency_sign;
            $default_currency_rate = $currency_rate;

            if (isset($_POST['currency_nonce']) || wp_verify_nonce($_POST['currency_nonce'], 'switch_currency')) {
                // Set Session Based on Header Change

                $default_currency_code = $_POST['currency_code'];
                $default_currency_sign = $_POST['currency_sign'];
                $default_currency_rate = $_POST['currency_rate'];
            }
        }
    }
    if (isset($default_currency_code) || isset($default_currency_sign) || isset($default_currency_rate)) {
        $_SESSION['currency']['code'] = $default_currency_code;
        $_SESSION['currency']['sign'] = $default_currency_sign;
        $_SESSION['currency']['rate'] = $default_currency_rate;
    }
}

add_action('after_setup_theme', 'get_default_currency');

//Set Currency from select change

function get_currency_code() {
    global $currency_code;
    if (isset($_SESSION['currency']) && !empty($_SESSION['currency']['code'])) {
        return $_SESSION['currency']['code'];
    } else {
        return $currency_code;
    }
}

function get_currency_sign() {
    global $currency_sign;
    if (isset($_SESSION['currency']) && !empty($_SESSION['currency']['sign'])) {
        return $_SESSION['currency']['sign'];
    } else {
        return $currency_sign;
    }
}

function get_currency_price($price) {
    global $currency_rate;
    if (isset($_SESSION['currency']) && !empty($_SESSION['currency']['rate'])) {
        return number_format(floatval($price) * (float) $_SESSION['currency']['rate'], 2);
    } else {
        return number_format(floatval($price) * (float) $currency_rate, 2);
    }
}

function round_up($value, $places = 2) {
    if ($places < 0) {
        $places = 0;
    }
    $mult = pow(10, $places);
    return ceil($value * $mult) / $mult;
}

// Update Currency Cron

add_action('wp', 'prefix_setup_schedule');

/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function prefix_setup_schedule() {
    if (!wp_next_scheduled('prefix_daily_event')) {
        wp_schedule_event(time(), 'daily', 'prefix_daily_event');
    }
}

add_action('prefix_daily_event', 'update_currency');

/**
 * On the scheduled action hook, run a function.
 */
function update_currency() {

    global $wpdb;

    $store_settings_id = 188;

    $currencies_number = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies' AND post_id = $store_settings_id");

    for ($x = 0; $x <= $currencies_number; $x++) {
        $currency_code = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'currencies_" . $x . "_currency_code'");
        if ($currency_code != "USD") {
            $new_rate = convert_currency(1, $currency_code);
            update_post_meta($store_settings_id, 'currencies_' . $x . '_conversion_rate_in_usd', $new_rate);
        }
    }
}

// End Update Currency Cron

function convert_currency($amount, $to_code, $from_code = "USD") {
    ini_set('max_execution_time', 60);

    $temp = 'http://www.google.com/finance/converter?a=' . $amount . '&from=' . $from_code . '&to=' . $to_code;

    $response = file_get_contents($temp);
    $result_string = explode($to_code, $response);

    $final_result = $result_string[3];
    $new_result = explode('<span class=bld>', $final_result);

    $float_result = trim($new_result[1]);

    return round($float_result, 2);
}

/* * -----------End------ */

add_theme_support('post-thumbnails');

add_image_size('product-thumb', 200, 200, true);

add_image_size('product-height', 200, 300, true);

add_image_size('product-image', 400, 400, true);

add_image_size('product-suit-image', 400, 600, true);

add_image_size('product-thumb-small', 81, 78, true);

add_image_size('sizing-info', 350, 9999, false);

add_image_size('homepage-image', 185, 189, true);

add_image_size('shirt-image-thumb', 205, 260, true);

function get_selected_value($str_val) {
    $result = explode('-', $str_val);
    return $result[0];
}

function echo_selected($selected_value, $value) {

    if ($selected_value == $value)
        echo " selected";
}
function none_echo_selected($selected_value, $value) {

    if ($selected_value == $value)
        return 'selected';
}
add_shortcode('recent_order_tab', 'order_list_tab');

function order_list_tab() {

    wc_get_template('myaccount/my-orders.php', array('order_count' => $order_count));
    do_action('woocommerce_view_order', $order_id);
}

add_shortcode('user_profile_tab', 'userprofile_tab');

function userprofile_tab() {
    wc_get_template('myaccount/my-address.php');
}

add_shortcode('edit_email_tab', 'edit_emailpass_tab');

function edit_emailpass_tab() {
    /* printf( __( '<a href="%s">Edit Email and Password</a>.', 'woocommerce' ),
      wc_customer_edit_account_url()
      ); */
    echo '<a href="http://jcoutier.com/my-account/edit-account/">Edit Email and Password</a>';
}

function submit_product() {
    global $woocommerce;

    /* print '<pre>';
      print_r($_REQUEST);
      print '</pre>';
      die(); */
    $edit_flag = 0;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = $_REQUEST['custom_product_id'];
        
        if ($cart_item['product_id'] == $_REQUEST['p_id']) {
            $edit_flag = 1;
        }
    }

    if ($_REQUEST['same-product'] == 1) {
        $edit_flag = 0;
    }

    if ($edit_flag == 1) {

        $main_product_id = $_REQUEST['product_id'];
		
   

        $post_id = $_REQUEST['p_id'];

        //$meta_values_price = get_post_meta( $main_product_id, '_price', true );
        $meta_values_price = get_post_meta($main_product_id, 'base_product_price', true);
        $meta_values_fabric_code= get_post_meta($main_product_id, 'fabric_code', true);   
             
        $meta_values_product_name =  get_post_meta($main_product_id, 'parent_product_name',true);
        
        $extra_setting = $_REQUEST['extras'];
        unset($extra_setting['position']);
        unset($extra_setting['color']);
        unset($extra_setting['custom-text']);
        if (!empty($extra_setting) && isset($extra_setting)) {
            $x = 0;
            foreach ($extra_setting as $key => $extra) {
                $value = explode("-", $extra);
                $option_price = get_post_meta($_POST['settings_id'], 'extras_settings_' . $x . '_options_' . $value[1] . '_option_price', true);




                // Add to Price
                $meta_values_price += (float) $option_price;


                $x++;
            }
        }



        update_post_meta($post_id, '_price', $meta_values_price, false);
        update_post_meta($post_id, '_regular_price', $meta_values_price, false);
        update_post_meta($post_id, 'fabric_code', $meta_values_fabric_code, false);
        update_post_meta($post_id,'parent_product_id',$main_product_id ,false);
        
update_post_meta($post_id,'parent_product_name',$meta_values_product_name ,false);        
        
        $terms = get_the_terms($main_product_id, 'product_cat');
        if ($terms[0]->term_id == 73) {

            $post_thumbnail_id = get_post_thumbnail_id($main_product_id);
            set_post_thumbnail($post_id, $post_thumbnail_id);
            $collar = $_REQUEST['design']['collar'];
            $cuff = $_REQUEST['design']['cuff'];
            $collar_cuff_thickness = $_REQUEST['design']['collar-cuff-thickness'];
            $pocket = $_REQUEST['design']['pocket'];
            $front = $_REQUEST['design']['front'];
            $bottom = $_REQUEST['design']['bottom'];



            $arr = array("collar" => $collar, "cuff" => $cuff,
                "collar-cuff-thickness" => $collar_cuff_thickness,
                "pocket" => $pocket, "front" => $front,
                "bottom" => $bottom);


            if ($_REQUEST['extras']['monogram'] == 'No') {

                unset($_REQUEST['extras']['position']);

                unset($_REQUEST['extras']['color']);

                unset($_REQUEST['extras']['custom-text']);
            }

            $arr_extras = array("white-collar-cuff" => $_REQUEST['extras']['white-collar-cuff'],
                "removable-collar-stays" => $_REQUEST['extras']['removable-collar-stays'],
                "contrasting-buttons" => $_REQUEST['extras']['contrasting-buttons'],
                "contrastingbuttonhole-stitching" => $_REQUEST['extras']['contrastingbuttonhole-stitching'],
                "contrastingcollar-cuff-lining" => $_REQUEST['extras']['contrastingcollar-cuff-lining'],
                "lining-code" => $_REQUEST['extras']['lining-code'],
                "monogram" => $_REQUEST['extras']['monogram'],
                "monogram-position" => $_REQUEST['extras']['position'],
                "monogram-color" => $_REQUEST['extras']['color'],
                "monogram-custom-text" => $_REQUEST['extras']['custom-text']
            );


            $arr_sizing = array("user-profile" => $_REQUEST['sizing']['user-profile'],
                "sizing-type" => $_REQUEST['sizing']['sizing-type']);


            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);

            $measure_cnt = sizeof($_REQUEST['sizing']['general']['measure-your-body']);
            $measure_your_shirt_cnt = sizeof($_REQUEST['sizing']['general']['measure-your-shirt']);
            $standard_sizing_cnt = sizeof($_REQUEST['sizing']['general']['standard-sizing']);






            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $shirt_length = $_REQUEST['sizing']['measure-your-body']['shirt-length'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
            $arm_length_short = $_REQUEST['sizing']['measure-your-body']['arm-length-short'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];



            $arr_measure_your_body = array("neck" => $neck,
                "chest" => $chest,
                "waist" => $waist,
                "hips" => $hips,
                "shirt-length" => $shirt_length,
                "shirt-length" => $shirt_length,
                "arm-length" => $arm_length,
                "arm-length-short" => $arm_length_short,
                "shoulders" => $shoulders,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "wrist" => $wrist,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);




            if ($measure_your_shirt_cnt > 0) {
                $neck = $_REQUEST['sizing']['measure-your-shirt']['neck'];
                $chest = $_REQUEST['sizing']['measure-your-shirt']['chest'];
                $waist = $_REQUEST['sizing']['measure-your-shirt']['waist'];
                $hips = $_REQUEST['sizing']['measure-your-shirt']['hips'];
                $shirt_length = $_REQUEST['sizing']['measure-your-shirt']['shirt-length'];
                $arm_length = $_REQUEST['sizing']['measure-your-shirt']['arm-length'];
                $arm_length_short = $_REQUEST['sizing']['measure-your-shirt']['arm-length-short'];
                $shoulders = $_REQUEST['sizing']['measure-your-shirt']['shoulders'];
                $armhole = $_REQUEST['sizing']['measure-your-shirt']['armhole'];
                $cuff = $_REQUEST['sizing']['measure-your-shirt']['cuff'];
                $wrist = $_REQUEST['sizing']['measure-your-shirt']['wrist'];
                $profile_name = $_REQUEST['sizing']['measure-your-shirt']['profile-name'];
                $value_type = $_REQUEST['sizing']['measure-your-shirt']['value-type'];



                $measure_your_shirt = array("neck" => $neck,
                    "chest" => $chest,
                    "waist" => $waist,
                    "hips" => $hips,
                    "shirt-length" => $shirt_length,
                    "shirt-length" => $shirt_length,
                    "arm-length" => $arm_length,
                    "arm-length-short" => $arm_length_short,
                    "shoulders" => $shoulders,
                    "armhole" => $armhole,
                    "cuff" => $cuff,
                    "profile-name" => $profile_name,
                    "value-type" => $value_type);


                update_post_meta($post_id, "measure_your_shirt", $measure_your_shirt, false);
            }

            if ($standard_sizing_cnt > 0) {
                $neck = $_REQUEST['sizing']['standard-sizing']['neck'];
                $sleeve = $_REQUEST['sizing']['standard-sizing']['sleeve'];
                $fit = $_REQUEST['sizing']['standard-sizing']['fit'];

                $profile_name = $_REQUEST['sizing']['standard-sizing']['profile-name'];
                $value_type = $_REQUEST['sizing']['standard-sizing']['value-type'];



                $standard_sizing = array("profile-name" => $profile_name,
                    "value-type" => $value_type,
                    "neck" => $neck,
                    "sleeve" => $sleeve,
                    "fit" => $fit,
                );


                update_post_meta($post_id, "standard_sizing", $standard_sizing, false);
            }
        } elseif ($terms[0]->term_id == 74) { /* for jackect */
            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['jacket-buttons'],
                "lapel" => $_POST['design']['lapel'],
                "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


            $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                "pick-stiching" => $_POST['extras']['pick-stiching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "boutonniere" => $_POST['extras']['boutonniere'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "buttons" => $_POST['extras']['buttons'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "extra-pants" => $_POST['extras']['extra-pants'],
                "monogram" => $_POST['extras']['monogram']
            );

            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $shirt_length = $_REQUEST['sizing']['measure-your-body']['shirt-length'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
            $arm_length_short = $_REQUEST['sizing']['measure-your-body']['arm-length-short'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];


            $arr_measure_your_body = array("neck" => $neck,
                "hips" => $hips,
                "chest" => $chest,
                "waist" => $waist,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->term_id == 75) { /* for Blazer */


            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons-single" => $_POST['design']['jacket-buttons-single'],
                "jacket-buttons-double" => $_POST['design']['jacket-buttons-double'],
                "lapel" => $_POST['design']['lapel'],
                "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


            $arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
                "sizing-type" => $_REQUEST['sizing']['measure-your-body']['sizing-type']);


            $arr_extras = array("pick-stitching" => $_POST['extras']['pick-stitching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "butonniere-colour" => $_POST['extras']['butonniere-colour'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "monogram" => $_POST['extras']['monogram'],
                "contrasting-buttons" => $_POST['extras']['contrasting-buttons'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "extra-pants" => $_POST['extras']['extra-pants']);

            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];



            $arr_measure_your_body = array("neck" => $neck,
                "chest" => $chest,
                "waist" => $waist,
                "hips" => $hips,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "arm-length" => $arm_length,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "wrist" => $wrist,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );

            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->term_id == 76) { /* for pant */

            $arr = array("pants-style" => $_POST['design']['pants-style'], "crotch-style" => $_POST['design']['crotch-style'],
                "waist-style" => $_POST['design']['waist-style'],
                "pleats" => $_POST['design']['pleats'],
                "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);

            update_post_meta($post_id, "design", serialize($arr), false);

            /* $arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
              "value-type"=> $_REQUEST['sizing']['measure-your-body']['value-type']);


             */
            //update_post_meta($post_id,"sizing", serialize($arr_sizing), false);


            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $ankle = $_REQUEST['sizing']['measure-your-body']['ankle'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];


            $arr_measure_your_body = array("waist" => $waist,
                "chest" => $chest,
                "hips" => $hips,
                "crotch" => $crotch,
                "thigh" => $thigh,
                "knee" => $knee,
                "ankle" => $ankle,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build));


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->term_id == 77) { /* for chinos */

            $arr = array("pants-style" => $_POST['design']['pants-style'], "crotch-style" => $_POST['design']['crotch-style'],
                "waist-style" => $_POST['design']['waist-style'],
                "pleats" => $_POST['design']['pleats'],
                "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);
            update_post_meta($post_id, "design", serialize($arr), false);


            $arr_extras = array("waistband-lining" => $_POST['extras']['waistband-lining'],
                "back-packet-lining" => $_POST['extras']['back-packet-lining']);

            update_post_meta($post_id, "extras", serialize($arr_extras), false);

            /* $arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
              "value-type"=> $_REQUEST['sizing']['measure-your-body']['value-type']);



              update_post_meta($post_id,"sizing", serialize($arr_sizing), false); */


            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $ankle = $_REQUEST['sizing']['measure-your-body']['ankle'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $pants_bottom = $_REQUEST['sizing']['measure-your-body']['pants-bottom'];

            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];


            $arr_measure_your_body = array("waist" => $waist,
                "chest" => $chest,
                "hips" => $hips,
                "crotch" => $crotch,
                "thigh" => $thigh,
                "knee" => $knee,
                "ankle" => $ankle,
                "pants-bottom" => $pants_bottom,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build));


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->term_id == 78) { /* for suits */

            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['design']['jacket-buttons'],
                "lapel" => $_POST['design']['lapel'], "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back'], "pants-style" => $_POST['design']['pants-style'],
                "crotch-style" => $_POST['design']['crotch-style'], "waist-style" => $_POST['design']['waist-style'], "pleats" => $_POST['design']['pleats'],
                "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);

            $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                "construction" => $_POST['extras']['construction'],
                "pick-stiching" => $_POST['extras']['pick-stiching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "boutonniere" => $_POST['extras']['boutonniere'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "buttons" => $_POST['extras']['buttons'],
                "extra-pants" => $_POST['extras']['extra-pants'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "monogram" => $_POST['extras']['monogram']);

            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);

            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $pants_length = $_REQUEST['sizing']['measure-your-body']['pants-length'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $pants_bottom = $_REQUEST['sizing']['measure-your-body']['pants-bottom'];

            //$profile_name=$_REQUEST['sizing']['measure-your-body']['profile-name'];
            $profile_name = $_REQUEST['sizing']['measure-your-jacket']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];



            $arr_measure_your_body = array("neck" => $neck,
                "hips" => $hips,
                "chest" => $chest,
                "waist" => $waist,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "arm length" => $arm_length,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "wrist" => $wrist,
                "crotch" => $crotch,
                "pants length" => $pants_length,
                "thigh" => $thigh,
                "knee" => $knee,
                "pants bottom" => $pants_bottom,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        }

        //add_product_to_cart($post_id);
        //update_post_meta($post_id,"_customized_product", 'yes', true);
        $_SESSION['req'] = $_REQUEST;
        wp_redirect(get_permalink(502));
    } else {

        $main_product_id = $_REQUEST['product_id'];
      //  $main_product_name=$_REQUEST['product_id'];

        $content = get_post_field('post_content', $main_product_id);
        $post_type = get_post_field('post_type', $main_product_id);
        $post_excerpt = get_post_field('post_excerpt', $main_product_id);

        if ($_REQUEST['sizing']['standard-sizing']['profile-name']) {
            $post_title = $_REQUEST['sizing']['standard-sizing']['profile-name'];
        } else if ($_REQUEST['sizing']['measure-your-shirt']['profile-name']) {
            $post_title = $_REQUEST['sizing']['measure-your-shirt']['profile-name'];
        } else if ($_REQUEST['sizing']['measure-your-body']['profile-name']) {
            $post_title = $_REQUEST['sizing']['measure-your-body']['profile-name'];
        } else if ($_REQUEST['sizing']['measure-your-jacket']['profile-name']) {
            $post_title = $_REQUEST['sizing']['measure-your-jacket']['profile-name'];
        }


        if (empty($post_title)) {

            exit();
     }
        $post_author_id; 
          if(wp_get_current_user()->id != null ){
                $post_author_id = wp_get_current_user()->id;
          }else{
                $post_author_id = 2;
          }

        $my_post = array(
            'post_title' => $post_title,
            'post_content' => $content,
            'post_excerpt' => $post_excerpt,
            'post_status' => 'publish',
            'post_type' => 'product',
            'post_author' => $post_author_id
        );

        $terms = get_the_terms($main_product_id, 'product_cat');

        /* echo $terms[0]->term_id;
          print_r($terms); */
        // Insert the post into the database
        $post_id = wp_insert_post($my_post);
        $base_product_price = get_post_meta($main_product_id, '_price', true);
        $meta_values_fabric_code= get_post_meta($main_product_id, 'fabric_code', true);
        
        $meta_values_product_name= get_post_meta($main_product_id ,'parent_product_name',true);
        
        update_post_meta($post_id, 'fabric_code', $meta_values_fabric_code);
        update_post_meta($post_id, 'base_product_price', $base_product_price);
        update_post_meta($post_id,'parent_product_id',$main_product_id ,false);
        



        if ($_REQUEST['same-product'] == 1) {

            $old_post_id = $_REQUEST['product_id'];
            $sm_terms = get_the_terms($old_post_id, 'product_cat');
            //wp_set_object_terms($post_id,array($sm_terms[0]->term_id),'product_cat',true);
            $p_cat_id = $sm_terms[0]->term_id;
        } else {
            switch ($terms[0]->name) {
                case "Design Your Own" : $p_cat_id = 73;
                    break;
                case "design your jacket" : $p_cat_id = 74;
                    break;
                case "design your blazers" : $p_cat_id = 75;
                    break;
                case "design your pants" : $p_cat_id = 76;
                    break;
                case "design your chinos" : $p_cat_id = 77;
                    break;
                case "design your suits" : $p_cat_id = 78;
                    break;
            }
        }
        //wp_set_object_terms($post_id,array($terms[0]->term_id),'product_cat',true);

        wp_set_object_terms($post_id, array($p_cat_id), 'product_cat', true);

        update_post_meta($post_id, '_visibility', 'visible');



        $meta_values_price = get_post_meta($main_product_id, '_price', true);







        $extra_setting = $_REQUEST['extras'];
        unset($extra_setting['position']);

        unset($extra_setting['color']);

        unset($extra_setting['custom-text']);
        if (!empty($extra_setting) && isset($extra_setting)) {
            $x = 0;
            foreach ($extra_setting as $key => $extra) {

                $value = explode("-", $extra);

                $option_price = get_post_meta($_POST['settings_id'], 'extras_settings_' . $x . '_options_' . $value[1] . '_option_price', true);


                // echo "<br/>".'extras_settings_' . $x . '_options_' . $value[1] . '_option_price';
                // Add to Price
                $meta_values_price += (float) $option_price;

                // Recreate Extras without price in value
                //$_SESSION['cart']['items'][$item_key]['extras'][$key] = $value[0];
                $x++;
            }
        }
        if ($_REQUEST['same-product'] == 1) {
            /* price for Similar Product */
            $price = get_post_meta($old_post_id, '_price', true);
            update_post_meta($post_id, '_price', $price, true);
            update_post_meta($post_id, '_regular_price', $price, true);
            /* ------------------End--------------------- */
        } else {
            update_post_meta($post_id, '_price', $meta_values_price, true);
            update_post_meta($post_id, '_regular_price', $meta_values_price, true);
        }

        $post_thumbnail_id = get_post_thumbnail_id($main_product_id);
        set_post_thumbnail($post_id, $post_thumbnail_id);




        if ($terms[0]->name == 'Design Your Own' || $terms[0]->term_id == 73) {



            $collar = $_REQUEST['design']['collar'];
            $cuff = $_REQUEST['design']['cuff'];
            $collar_cuff_thickness = $_REQUEST['design']['collar-cuff-thickness'];
            $pocket = $_REQUEST['design']['pocket'];
            $front = $_REQUEST['design']['front'];
            $bottom = $_REQUEST['design']['bottom'];



            $arr = array("collar" => $collar, "cuff" => $cuff,
                "collar-cuff-thickness" => $collar_cuff_thickness,
                "pocket" => $pocket, "front" => $front,
                "bottom" => $bottom);


            if ($_REQUEST['extras']['monogram'] == 'No') {

                unset($_REQUEST['extras']['position']);

                unset($_REQUEST['extras']['color']);

                unset($_REQUEST['extras']['custom-text']);
            }

            $arr_extras = array("white-collar-cuff" => $_REQUEST['extras']['white-collar-cuff'],
                "removable-collar-stays" => $_REQUEST['extras']['removable-collar-stays'],
                "contrasting-buttons" => $_REQUEST['extras']['contrasting-buttons'],
                "contrastingbuttonhole-stitching" => $_REQUEST['extras']['contrastingbuttonhole-stitching'],
                "contrastingcollar-cuff-lining" => $_REQUEST['extras']['contrastingcollar-cuff-lining'],
                "lining-code" => $_REQUEST['extras']['lining-code'],
                "monogram" => $_REQUEST['extras']['monogram'],
                "monogram-position" => $_REQUEST['extras']['position'],
                "monogram-color" => $_REQUEST['extras']['color'],
                "monogram-custom-text" => $_REQUEST['extras']['custom-text']
            );


            $arr_sizing = array("user-profile" => $_REQUEST['sizing']['user-profile'],
                "sizing-type" => $_REQUEST['sizing']['sizing-type']);

            $measure_cnt = sizeof($_REQUEST['sizing']['measure-your-body']);
            $measure_your_shirt_cnt = sizeof($_REQUEST['sizing']['measure-your-shirt']);
            $standard_sizing_cnt = sizeof($_REQUEST['sizing']['standard-sizing']);



            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);

            if ($_REQUEST['_sizing_type'] == 'measure-your-body') {
                $profile_sizing_type = 'measure_your_body';
            } elseif ($_REQUEST['_sizing_type'] == 'measure-your-shirt') {
                $profile_sizing_type = 'measure_your_shirt';
            } else {
                $profile_sizing_type = 'standard_sizing';
            }



            if ($measure_cnt > 0) {

                $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
                $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
                $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
                $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
                $shirt_length = $_REQUEST['sizing']['measure-your-body']['shirt-length'];
                $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
                $arm_length_short = $_REQUEST['sizing']['measure-your-body']['arm-length-short'];
                $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
                $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
                $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
                $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
                $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
                $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
                $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
                $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
                $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
                $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];


                $arr_measure_your_body = array("neck" => $neck,
                    "chest" => $chest,
                    "waist" => $waist,
                    "hips" => $hips,
                    "shirt-length" => $shirt_length,
                    "shirt-length" => $shirt_length,
                    "arm-length" => $arm_length,
                    "arm-length-short" => $arm_length_short,
                    "shoulders" => $shoulders,
                    "armhole" => $armhole,
                    "bicep" => $bicep,
                    "wrist" => $wrist,
                    "profile-name" => $profile_name,
                    "value-type" => $value_type,
                    "general" => array("height" => $height,
                        "weight" => $weight,
                        "build" => $build,
                        "fit" => $fit)
                );

                update_post_meta($post_id, "_sizing_type", $profile_sizing_type, false);
                update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
            }


            if ($measure_your_shirt_cnt > 0) {
                $neck = $_REQUEST['sizing']['measure-your-shirt']['neck'];
                $chest = $_REQUEST['sizing']['measure-your-shirt']['chest'];
                $waist = $_REQUEST['sizing']['measure-your-shirt']['waist'];
                $hips = $_REQUEST['sizing']['measure-your-shirt']['hips'];
                $shirt_length = $_REQUEST['sizing']['measure-your-shirt']['shirt-length'];
                $arm_length = $_REQUEST['sizing']['measure-your-shirt']['arm-length'];
                $arm_length_short = $_REQUEST['sizing']['measure-your-shirt']['arm-length-short'];
                $shoulders = $_REQUEST['sizing']['measure-your-shirt']['shoulders'];
                $armhole = $_REQUEST['sizing']['measure-your-shirt']['armhole'];
                $cuff = $_REQUEST['sizing']['measure-your-shirt']['cuff'];
                $wrist = $_REQUEST['sizing']['measure-your-shirt']['wrist'];
                $profile_name = $_REQUEST['sizing']['measure-your-shirt']['profile-name'];
                $value_type = $_REQUEST['sizing']['measure-your-shirt']['value-type'];



                $measure_your_shirt = array("neck" => $neck,
                    "chest" => $chest,
                    "waist" => $waist,
                    "hips" => $hips,
                    "shirt-length" => $shirt_length,
                    "shirt-length" => $shirt_length,
                    "arm-length" => $arm_length,
                    "arm-length-short" => $arm_length_short,
                    "shoulders" => $shoulders,
                    "armhole" => $armhole,
                    "cuff" => $cuff,
                    "profile-name" => $profile_name,
                    "value-type" => $value_type);

                update_post_meta($post_id, "_sizing_type", $profile_sizing_type, false);
                update_post_meta($post_id, "measure_your_shirt", $measure_your_shirt, false);
            }

            if ($standard_sizing_cnt > 0) {
                $neck = $_REQUEST['sizing']['standard-sizing']['neck'];
                $sleeve = $_REQUEST['sizing']['standard-sizing']['sleeve'];
                $fit = $_REQUEST['sizing']['standard-sizing']['fit'];

                $profile_name = $_REQUEST['sizing']['standard-sizing']['profile-name'];
                $value_type = $_REQUEST['sizing']['standard-sizing']['value-type'];



                $standard_sizing = array("profile-name" => $profile_name,
                    "value-type" => $value_type,
                    "neck" => $neck,
                    "sleeve" => $sleeve,
                    "fit" => $fit,
                );

                update_post_meta($post_id, "_sizing_type", $profile_sizing_type, false);
                update_post_meta($post_id, "standard_sizing", $standard_sizing, false);
            }
        } elseif ($terms[0]->name == 'design your jacket' || $terms[0]->term_id == 74) {

            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['jacket-buttons'],
                "lapel" => $_POST['design']['lapel'],
                "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


            $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                "pick-stiching" => $_POST['extras']['pick-stiching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "boutonniere" => $_POST['extras']['boutonniere'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "buttons" => $_POST['extras']['buttons'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "extra-pants" => $_POST['extras']['extra-pants'],
                "monogram" => $_POST['extras']['monogram']
            );

            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $shirt_length = $_REQUEST['sizing']['measure-your-body']['shirt-length'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
            $arm_length_short = $_REQUEST['sizing']['measure-your-body']['arm-length-short'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];



            $arr_measure_your_body = array("neck" => $neck,
                "hips" => $hips,
                "chest" => $chest,
                "waist" => $waist,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->name == 'design your blazers' || $terms[0]->term_id == 75) {

            /* for Blazer */


            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons-single" => $_POST['design']['jacket-buttons-single'],
                "jacket-buttons-double" => $_POST['design']['jacket-buttons-double'],
                "lapel" => $_POST['design']['lapel'],
                "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


            $arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
                "sizing-type" => $_REQUEST['sizing']['measure-your-body']['sizing-type']);


            $arr_extras = array("pick-stitching" => $_POST['extras']['pick-stitching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "butonniere-colour" => $_POST['extras']['butonniere-colour'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "monogram" => $_POST['extras']['monogram'],
                "contrasting-buttons" => $_POST['extras']['contrasting-buttons'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "extra-pants" => $_POST['extras']['extra-pants']);

            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            update_post_meta($post_id, "sizing", serialize($arr_sizing), false);


            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];



            $arr_measure_your_body = array("neck" => $neck,
                "chest" => $chest,
                "waist" => $waist,
                "hips" => $hips,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "arm-length" => $arm_length,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "wrist" => $wrist,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );

            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->name == 'design your pants' || $terms[0]->term_id == 76) {



            $arr = array("pants-style" => $_REQUEST['design']['pants-style'], "crotch-style" => $_REQUEST['design']['crotch-style'],
                "waist-style" => $_REQUEST['design']['waist-style'],
                "pleats" => $_REQUEST['design']['pleats'],
                "back-pockets" => $_REQUEST['design']['back-pockets'], "pants-cuff" => $_REQUEST['design']['pants-cuff']);
            //echo $post_id;
            update_post_meta($post_id, "design", serialize($arr), false);
            /* print '<pre>';
              print_r($arr);
              print '</pre>';
              exit;

              /*$arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
              "value-type"=> $_REQUEST['sizing']['measure-your-body']['value-type']); */


            //update_post_meta($post_id,"sizing", serialize($arr_sizing), false);


            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $ankle = $_REQUEST['sizing']['measure-your-body']['ankle'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];

            $arr_measure_your_body = array("waist" => $waist,
                "chest" => $chest,
                "hips" => $hips,
                "crotch" => $crotch,
                "thigh" => $thigh,
                "knee" => $knee,
                "ankle" => $ankle,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build));


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->name == 'design your chinos' || $terms[0]->term_id == 77) {



            $arr = array("pants-style" => $_REQUEST['design']['pants-style'], "crotch-style" => $_REQUEST['design']['crotch-style'],
                "waist-style" => $_REQUEST['design']['waist-style'],
                "pleats" => $_REQUEST['design']['pleats'],
                "back-pockets" => $_REQUEST['design']['back-pockets'], "pants-cuff" => $_REQUEST['design']['pants-cuff']);

            $arr_extras = array("waistband-lining" => $_POST['extras']['waistband-lining'],
                "back-packet-lining" => $_POST['extras']['back-packet-lining']);

            update_post_meta($post_id, "design", serialize($arr), false);

            //echo $post_id;
            update_post_meta($post_id, "extras", serialize($arr_extras), false);
            /* print '<pre>';
              print_r($arr);
              print '</pre>';
              exit;

              /*$arr_sizing = array("user-profile" => $_REQUEST['sizing']['measure-your-body']['user-profile'],
              "value-type"=> $_REQUEST['sizing']['measure-your-body']['value-type']); */


            //update_post_meta($post_id,"sizing", serialize($arr_sizing), false);


            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $ankle = $_REQUEST['sizing']['measure-your-body']['ankle'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $pants_bottom = $_REQUEST['sizing']['measure-your-body']['pants-bottom'];

            $arr_measure_your_body = array("waist" => $waist,
                "chest" => $chest,
                "hips" => $hips,
                "crotch" => $crotch,
                "thigh" => $thigh,
                "knee" => $knee,
                "ankle" => $ankle,
                "pants-bottom" => $pants_bottom,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build));


            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        } elseif ($terms[0]->name == 'design your suits' || $terms[0]->term_id == 78) {

            /* $terms[0]->term_id==78 IT is for Designed suit Id and use for create product similar from a similar */

            $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['design']['jacket-buttons'],
                "lapel" => $_POST['design']['lapel'], "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back'], "pants-style" => $_POST['design']['pants-style'],
                "crotch-style" => $_POST['design']['crotch-style'], "waist-style" => $_POST['design']['waist-style'], "pleats" => $_POST['design']['pleats'],
                "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);


            $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                "construction" => $_POST['extras']['construction'],
                "pick-stiching" => $_POST['extras']['pick-stiching'],
                "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                "boutonniere" => $_POST['extras']['boutonniere'],
                "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                "buttons" => $_POST['extras']['buttons'],
                "extra-pants" => $_POST['extras']['extra-pants'],
                "matching-vest" => $_POST['extras']['matching-vest'],
                "monogram" => $_POST['extras']['monogram']);



            update_post_meta($post_id, "design", serialize($arr), false);
            update_post_meta($post_id, "extras", serialize($arr_extras), false);

            $neck = $_REQUEST['sizing']['measure-your-body']['neck'];
            $hips = $_REQUEST['sizing']['measure-your-body']['hips'];
            $chest = $_REQUEST['sizing']['measure-your-body']['chest'];
            $waist = $_REQUEST['sizing']['measure-your-body']['waist'];
            $jacket_length = $_REQUEST['sizing']['measure-your-body']['jacket-length'];
            $shoulders = $_REQUEST['sizing']['measure-your-body']['shoulders'];
            $arm_length = $_REQUEST['sizing']['measure-your-body']['arm-length'];
            $armhole = $_REQUEST['sizing']['measure-your-body']['armhole'];
            $bicep = $_REQUEST['sizing']['measure-your-body']['bicep'];
            $wrist = $_REQUEST['sizing']['measure-your-body']['wrist'];
            $crotch = $_REQUEST['sizing']['measure-your-body']['crotch'];
            $pants_length = $_REQUEST['sizing']['measure-your-body']['pants-length'];
            $thigh = $_REQUEST['sizing']['measure-your-body']['thigh'];
            $knee = $_REQUEST['sizing']['measure-your-body']['knee'];
            $pants_bottom = $_REQUEST['sizing']['measure-your-body']['pants-bottom'];

            //$profile_name=$_REQUEST['sizing']['measure-your-body']['profile-name'];
            $profile_name = $_REQUEST['sizing']['measure-your-jacket']['profile-name'];
            $value_type = $_REQUEST['sizing']['measure-your-body']['value-type'];
            $height = $_REQUEST['sizing']['measure-your-body']['general']['height'];
            $weight = $_REQUEST['sizing']['measure-your-body']['general']['weight'];
            $build = $_REQUEST['sizing']['measure-your-body']['general']['build'];
            $fit = $_REQUEST['sizing']['measure-your-body']['general']['fit'];



            $arr_measure_your_body = array("neck" => $neck,
                "hips" => $hips,
                "chest" => $chest,
                "waist" => $waist,
                "jacket-length" => $jacket_length,
                "shoulders" => $shoulders,
                "arm length" => $arm_length,
                "armhole" => $armhole,
                "bicep" => $bicep,
                "wrist" => $wrist,
                "crotch" => $crotch,
                "pants length" => $pants_length,
                "thigh" => $thigh,
                "knee" => $knee,
                "pants bottom" => $pants_bottom,
                "profile-name" => $profile_name,
                "value-type" => $value_type,
                "general" => array("height" => $height,
                    "weight" => $weight,
                    "build" => $build,
                    "fit" => $fit)
            );

            update_post_meta($post_id, "measure_your_body", $arr_measure_your_body, false);
        }
        //add_product_to_cart($post_id);

        if ($terms[0]->name == 'Design Your Own') { /* Edit product option only for shirht */
            update_post_meta($post_id, "_customized_product", 'yes', true);
        } else {
            update_post_meta($post_id, "custom-design", 'yes', true);
        }
        $woocommerce->cart->add_to_cart($post_id);
        /* $id=57437;
          $woocommerce->cart->add_to_cart($id); */

        get_promo_offer($terms[0]->term_id);

        $_SESSION['req'] = $_REQUEST;
        wp_redirect(get_permalink(502));
    }
    update_post_meta($post_id, "fornt_end_product", 'yes', true);
}

add_shortcode('submit-product', 'submit_product');

function get_promo_offer($id) {

    global $wpdb, $woocommerce;
    $sql = "select ID,post_title from " . $wpdb->prefix . "posts where post_type='promotion'";
    $result = $wpdb->get_results($sql);
    echo $cnt = count($_SESSION['free_pid']);
    foreach ($result as $row) {
        $meta_values_promotion_applies_to = get_post_meta($row->ID, 'promotion_applies_to');
        $meta_values_promotion_rule = get_post_meta($row->ID, 'promotion_rule');
        //echo $meta_values_promotion_applies_to[0][0]['promo_post_type'];die();
        //echo $id;die();
        if ($meta_values_promotion_applies_to[0][0]['promo_post_type'] == $id) {

            if ($meta_values_promotion_rule[0][0]['promo_type'] == 'free_item') {
                $p_id = $meta_values_promotion_rule[0][0]['promo_free_item'];
                $woocommerce->cart->add_to_cart($p_id);

                if ($cnt != 0) {
                    //$count=count($_SESSION['free_pid']);
                    $index = $cnt + 1;
                } else {
                    $index = 0;
                }

                $_SESSION['free_pid'][$index] = $p_id;
            }
        }
    }
    print_r($_SESSION['free_pid']);
}

function get_free_product_id($pid) {
    return $pid;
}

add_action('woocommerce_before_calculate_totals', 'add_custom_price');

function add_custom_price($cart_object) {

    global $woocommerce;

    // This will be your custome price

    for ($i = 0; $i < count($_SESSION['free_pid']); $i++) {
        $target_product_id = $_SESSION['free_pid'][$i];
        $custom_price = 0;

        foreach ($cart_object->cart_contents as $key => $value) {

            if ($value['product_id'] == $target_product_id) {
                $value['data']->price = $custom_price;
            }
        }
    }
}

/*function wpc_additional_shipping_cost($subtotal, $values, $cart_item_key) {
    //Get the custom field value

    global $woocommerce;



    //Get the product info
    $_product = $values['data'];


    $terms = get_the_terms($_product->id, 'product_cat');
    //echo $terms[0]->name; die();

    if ($terms[0]->name == 'custom designed shirt') {
        $extra_shipping_cost = 7.99;
        //return $subtotal.'<br>+'.woocommerce_price($extra_shipping_cost*$values['quantity']).' Shipping Cost';
        return $subtotal;
    } elseif ($terms[0]->name == 'designed suit') {
        $extra_shipping_cost = 24.99;
        //return $subtotal.'<br>+'.woocommerce_price($extra_shipping_cost*$values['quantity']).' Shipping Cost';
        return $subtotal;
    } elseif ($terms[0]->name == 'Accessories') {
        $extra_shipping_cost = 3.99;
        //return $subtotal.'<br>+'.woocommerce_price($extra_shipping_cost*$values['quantity']).' Shipping Cost';
        return $subtotal;
    } elseif ($terms[0]->name == 'Free Item') {
        $extra_shipping_cost = 0.00;
        //return $subtotal.'<br>+'.woocommerce_price($extra_shipping_cost).' Shipping Cost';
        return $subtotal;
    } else {
        $extra_shipping_cost = 0;
        return $subtotal;
    }







    //Check if we have a custom shipping cost, if so, display it below the item price
}

add_filter('woocommerce_cart_item_subtotal', 'wpc_additional_shipping_cost', 10, 3);*/

//add_action( 'woocommerce_cart_calculate_fees', 'add_shipping' );
/*function add_shipping() {
    global $woocommerce;




    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
        //Get the product info
        $_product = $values['data'];

        //Get the custom field value - make sure it's i.e. 10 not $10.00
        //$custom_shipping_cost = get_post_meta($_product->id, 'custom_shipping_cost', true);
        $terms = get_the_terms($_product->id, 'product_cat');
        //echo $terms[0]->name;

        if ($terms[0]->name == 'custom designed shirt') {
            $extra_shipping_cost1 = 7.99;
        } elseif ($terms[0]->name == 'designed suit') {
            $extra_shipping_cost2 = 24.99;
        } elseif ($terms[0]->name == 'ties') {
            $extra_shipping_cost3 = 3.99;
        } elseif ($terms[0]->name == 'accessories') {
            $extra_shipping_cost4 = 3.99;
        } elseif ($terms[0]->name == 'cuff links') {
            $extra_shipping_cost5 = 3.99;
        } elseif ($terms[0]->name == 'scaves') {
            $extra_shipping_cost6 = 3.99;
        } elseif ($terms[0]->name == 'woodbowties') {
            $extra_shipping_cost7 = 3.99;
        } elseif ($terms[0]->name == 'Free Item ') {
            $extra_shipping_cost8 = 0.00;
        } else {
            $extra_shipping_cost = 0;
        }
        $s = $extra_shipping_cost1 + $extra_shipping_cost2 + $extra_shipping_cost3 + $extra_shipping_cost4 + $extra_shipping_cost5 + $extra_shipping_cost6 + $extra_shipping_cost7 + $extra_shipping_cost8;

        //Adding together the extra costs
        //$extra_shipping_cost = $extra_shipping_cost + $custom_shipping_cost;
    }
    $woocommerce->cart->add_fee('Shipping Cost', $s, true, 'standard');
}*/

/* function popup_register_signup()
  {

  ?>
  <div id="signup-popup">

  <div class="signup-content">

  <div class="popup-ragister-form">

  <div class="filde-row titledive">
  <div class="alread-ragister">Already Registered? <a href="<?php echo get_permalink($WC_myaccount_page_url); ?>">Login Here..</a></div>
  <div class="sign-title">	<h2>Sign Up </br><span>For a </span></h2></div><div class="alread-ragister"><h3><span>&#36;10</span> voucher</h3></div>

  <div style="clear:both"></div>

  </div>

  <div class="filde-row" id="resorce-info"></div>
  <div class="filde-row" id="resorce-error"></div>
  <form action="<?php  echo get_option('siteurl')?><?php echo $_SERVER['REDIRECT_URL']; ?>" method="post">

  <input type="hidden" name="popupsignup" value="1" />



  <div class="filde-row">

  <div class="lable">Name</div><div class="text-field"><input  value="" type="text" name="user-first-name"  placeholder="First Name" />&nbsp;<input type="text" id="user-last-name" value="" placeholder="Last Name" /></div>

  </div>

  <div class="filde-row"><div class="lable">Email</div><div class="text-field"><input value="" placeholder="example@example.com" type="text" name="user-email" id="user-email" /></div></div>

  <div class="filde-row"><div class="lable"> Mobile</div><div class="text-field"><input value="" type="text" placeholder="mobile" name="user-mobile"  /></div></div>

  <div class="filde-row">
  <div class="lable">Password</div><div class="text-field"><input value="" type="password" placeholder="Enter Password" name="user-password" />&nbsp;<input type="password" value="" placeholder="Confirm Password" id="confirem-user-password" name="confirem-user-password" /></div>
  </div>

  <div style="clear:both"></div>



  <div class="filde-row"><div class="button-signup-div"><input  type="button" id="submit-f" value="signup"  class="button-signup" /></div></div>





  </form>

  <a id="popupBoxClose"></a>

  </div>
  <?php
  }
  add_shortcode('reg','popup_register_signup'); */

function opt_frm() {
    global $wpdb;
    $args = array(
    'posts_per_page'   => 1,
    'orderby'          => 'rand',
    'post_type'        => 'shop_coupon',
    'post_status'      => 'publish',
    'suppress_filters' => true 
    );
    $coupon='';
    $posts_array = get_posts( $args );
    foreach ( $posts_array as $post ) {
       $coupon = $post->post_title;
    }
    //print_r($atts);
    global $done;
    $html = '<div class="watch-now">';


    $html.= '<form name="signup" id="signup" method="post" action="">
					<p class="form-row form-row-wide">
							<input type="email" placeholder="Email Address" name="text_email" value="" id="text_email">
						</p>
						<p class="form-row form-row-wide">
							<input type="text" placeholder="Confirm Email Address" name="text_c_email" id="text_c_email" value="">
						 </p>
						<p class="form-row form-row-wide">
							<input type="password"   placeholder="Create Password" name="text_paaword" value="">
						</p>
						<p class="form-row form-row-wide">
							<input type="submit" value="SIGNUP">
						 </p>


				</form>
			</div>';



    if (count($_POST) > 0) {
        global $wp_sign_up_option;
        //$result = $wpdb->get_results ("SELECT email FROM wp_optin WHERE email = '".$email."'");

        $user_email = $_REQUEST['text_email'];
        $password = $_REQUEST['text_paaword'];

        $user_id = username_exists($user_name);
        if (!$user_id and email_exists($user_email) == false) {
            //$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
            $user_id = wp_create_user($user_email, $password, $user_email);
            update_user_meta($user_id, 'ja_disable_user', 1);
            //	} /*else {
            /* $random_password = __('User already exists.  Password inherited.');
              } */


            $to = $user_email;

            $admin_email = get_option('admin_email');
            $active_url = "https://jcoutier.com/active?uid=" . $user_id;          
            $from = "contact@jcoutier.com";
            $subject = "Welcome To J.Coutier";
            $message = "";
            $message .= '<div style="font-size:13px;text-align:center;width:500px; margin:10px auto; display:block; border:2px solid #eee; background:#FFF;padding-bottom: 15px;"><p style="padding:10px 0 0 0"><img height="97" width="300" src="http://jcoutier.com/wp-content/uploads/2014/10/logo2.png" style="width:300px;height:97px;"><p>';
            $message .= '<p style="padding:20px 0; font-size:18px;"><strong>Thanks for registering with J.Coutier and welcome.</strong></p>';
            $message .= '<p>Your login information listed below.</p>';
            $message .= '<p>User Email: ' . $user_email . '</p>';
            $message .= '<p>Password :'.$password.'</p>';
            $message .= '<p>To activate your account simply click on the below link: </br> ' . $active_url . '</p>';
            $message .= '<p>Should you have any queries, please do not hesitate to contact us at contact@jcoutier.com.</p></div>';
            
            
            $subject1 = "Your $20 Voucher";
            $message1 = '<div style="font-size:13px; text-align:center; width:500px; margin:10px auto; display:block; border:2px solid #eee; background:#FFF;padding-bottom: 15px;">
                        <p style="padding:10px 0 0 0"><img height="97" width="300" src="' . $wp_sign_up_option['header_image'] . '" alt="woocommerce sign up  and get-discount"  style="width:300px;height:97px;" /></p>
                        <h4 style="padding:20px 0; font-size:18px; font-style:italic">' . $wp_sign_up_option['mailbody'] . '</h4>
                        <p style="margin:20px;">Thanks for registering, and below is your voucher:</p>
                        <h3 style="font-size:18px;">' . '<b>' . $coupon . '</b></h3>
                        <p>Simply enter code at checkout.</p>
                        <p>Should you have any queries, please do not hesitate to contact us at contact@jcoutier.com.</p></div>';

            $headers = 'From: J.Coutier '."<" . $from. ">"."\r\n" .
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    
            $headers2 = 'From: J.Coutier '."<" . $from. ">"."\r\n" .
            $headers2 = 'MIME-Version: 1.0' . "\r\n";
            $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($to,$subject1, $message1, $headers);
            //mail($to, $subject, $message, $headers);
            //$message=$message.$message1;
            if (mail($to,$subject, $message, $headers2)) {

                $location = get_permalink(57971);

                wp_redirect($location);
                exit;
            }
        } else {
            //$_SESSION['mail_send']=2;
            update_option('mail_send', '2');
            $location = get_permalink(57973);
            wp_redirect($location);
            //wp_safe_redirect($location);
            exit;
        }
    }



    return $html;
}

add_shortcode('opt', 'opt_frm');

function active_user() {
    global $wpdb;

    $user_id = $_REQUEST['uid'];

    $querystr = "
			SELECT $wpdb->posts.post_title
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
			AND $wpdb->postmeta.meta_key = 'coupon_amount'
			AND $wpdb->postmeta.meta_value = '10'
			AND $wpdb->posts.post_status = 'publish'
			AND $wpdb->posts.post_type = 'shop_coupon'";

    $post_title = $wpdb->get_var($querystr);

    $pageposts = $wpdb->get_results($querystr, OBJECT);


    update_user_meta($user_id, 'ja_disable_user', 0);

    $admin_email = get_option('admin_email');
    $sql = "select user_email from wp_users where ID=$user_id";
    $u_email == $wpdb->get_var($sql);

    $to = $u_email;
    $from = $admin_email;

    $subject = "Jcoutier Account Activation";
    $message = "";
    $message .= '<p>Hello</p>';
    $message .= '<p>Your Account Succesfully Activated .</p>';
    $message .= '<p>Your Coupon Code Is :' . $post_title . '</p>';

    $message .= '<p>&nbsp;</p>';
    $message .= '<p>Thanks</p>';
    $headers = 'From:' . $from . "\r\n" .
            $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    //mail($to, $subject, $message, $headers))
    wp_mail($to, $subject, $message, $headers, $attachments);
    wp_redirect(home_url() . '/my-account?s=1');
    exit;
}

add_shortcode('active', 'active_user');

function myplugin_add_meta_box() {

    $screens = array('product');

    foreach ($screens as $screen) {

        add_meta_box(
                'custom-design-metabox', __('Custom Design Option', 'myplugin_textdomain'), 'custom_design_options_list', $screen
        );
    }
}

add_action('add_meta_boxes', 'myplugin_add_meta_box');

function custom_design_options_list($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('myplugin_meta_box', 'myplugin_meta_box_nonce');

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta($post->ID, '_customized_product', true);

    if ($value == 'yes') {
        $design_options = @unserialize(get_post_meta($post->ID, 'design', true));
        $extra_options = @unserialize(get_post_meta($post->ID, 'extras', true));
        $measure_body = @unserialize(get_post_meta($post->ID, 'measure_your_body', true));
        $measure_shirt = @unserialize(get_post_meta($post->ID, 'measure_your_shirt', true));
        $standard_sizing = @unserialize(get_post_meta($post->ID, 'standard_sizing', true));
        //print_r($design_options);
        ?>
        <style type="text/css">
            .tuytu{ width:750px; border:1px solid #CCC; padding:20px; margin:0 auto;  overflow: hidden;}
            .row_fuldiv{ width:100%; float:left; clear:both; margin:15px 0;}
            .row_fuldiv h2{ font-size:22px; color:#000; font-weight:600; padding:0; margin:0 0 15px 0;}
            .row_fuldiv ul{ margin:0; padding:3%; width:94%; float:left; background:#EAEAEA;}
            .row_fuldiv ul li{ list-style-type:none; float:left; position:relative; width:100%;   border-left:1px solid #A8A8A8; border-bottom:1px solid #A8A8A8; border-right:1px solid #A8A8A8; font:13px Arial, Helvetica, sans-serif; color:#000;}
            .row_fuldiv ul li:first-child{border-top:1px solid #A8A8A8; }
            .row_fuldiv ul li span.lft{ width:40%; padding:2%; float: left;  font-size:16px; font-weight:600;}
            .row_fuldiv ul li span.rit{ width:51.8%; padding:2%; float: left; background: #F4F4F4; border-left:1px solid #A8A8A8;}
            .row_fuldiv ul li span.rit p{border-top:1px solid #A8A8A8; padding:4px; margin:0;}
            .row_fuldiv ul li span.rit p:first-child{ border-top:none;}


        </style>
        <div class="tuytu">

            <?php if (!empty($design_options)) { ?>
                <div class="row_fuldiv">
                    <h2>Design</h2>
                    <ul>
                        <?php foreach ($design_options as $key => $value) { ?>
                            <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>


            <?php if (!empty($extra_options)) { ?>
                <div class="row_fuldiv">
                    <h2>Extras</h2>
                    <ul>
                        <?php
                        foreach ($extra_options as $key => $value) {
                            $extra_options_val = explode("-", $value);
                            ?>
                            <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $extra_options_val[0]; ?></p> </span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php if (!empty($measure_shirt)) { ?>
                <div class="row_fuldiv">
                    <h2>Measure Shirt</h2>
                    <ul>
                        <?php
                        foreach ($measure_shirt as $key => $value) {
                            //$extra_options_val=explode("-",$value);
                            ?>
                            <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>


            <?php if (!empty($measure_body)) { ?>
                <div class="row_fuldiv">
                    <h2>Measure Body</h2>
                    <ul>
                        <?php
                        foreach ($measure_body as $key => $value) {
                            //$extra_options_val=explode("-",$value);
                            ?>
                            <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php if (!empty($standard_sizing)) { ?>
                <div class="row_fuldiv">
                    <h2>Standard Sizing</h2>
                    <ul>
                        <?php
                        foreach ($standard_sizing as $key => $value) {
                            //$extra_options_val=explode("-",$value);
                            ?>
                            <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

        </div>
        <?php
    }
}

function create_user_profile() {
    global $wpdb, $woocommerce;
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $p_id = $cart_item['product_id'];
            $sizing_type = get_post_meta($p_id, '_sizing_type');

            $measure = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='" . $sizing_type[0] . "' and post_id=$p_id");
            $measurement = unserialize($measure);
            /* echo "select meta_value from ".$wpdb->prefix."postmeta where meta_key='".$sizing_type[0]."' and post_id=$p_id";
              print '<pre>';
              print_r($measurement);
              print '</pre>';
              die(); */

            $terms = get_the_terms($p_id, 'product_cat');
            $product_type = $terms[0]->name;
            $profile_name = $measurement['profile-name'];
            $u_profile = get_user_meta($user_id, $profile_name, true);


            $meta_id = update_user_meta($user_id, $profile_name, $measurement, false);

            if (!$u_profile) {
                if ($sizing_type[0] == 'measure_your_body') {
                    $sizing_option = 'measure-your-body';
                } elseif ($sizing_type[0] == 'measure_your_shirt') {
                    $sizing_option = 'measure-your-shirt';
                } else {
                    $sizing_option = 'standard-sizing';
                }
                $wpdb->insert($wpdb->prefix . 'profile', array(
                    'umeta_id' => $meta_id,
                    'user_id' => $user_id,
                    'profile_name' => $profile_name,
                    'product_type' => $product_type,
                    'sizing_option' => $sizing_option
                        ), array(
                    '%d',
                    '%d',
                    '%s',
                    '%s',
                    '%s'
                        )
                );
            }
        }
    }
    /* if(isset($_SESSION['req']))
      {

      $current_user = wp_get_current_user();
      $user_id = $current_user->ID;


      $profile_name=$_SESSION['req']['sizing']['measure-your-body']['profile-name'];

      $u_profile=get_user_meta($user_id, $profile_name, false);

      if($u_profile)
      {
      $neck=$_SESSION['req']['sizing']['measure-your-body']['neck'];
      $chest=$_SESSION['req']['sizing']['measure-your-body']['chest'];
      $waist=$_SESSION['req']['sizing']['measure-your-body']['waist'];
      $hips=$_SESSION['req']['sizing']['measure-your-body']['hips'];
      $shirt_length=$_SESSION['req']['sizing']['measure-your-body']['shirt-length'];
      $arm_length=$_SESSION['req']['sizing']['measure-your-body']['arm-length'];
      $arm_length_short=$_SESSION['req']['sizing']['measure-your-body']['arm-length-short'];
      $shoulders=$_SESSION['req']['sizing']['measure-your-body']['shoulders'];
      $armhole=$_SESSION['req']['sizing']['measure-your-body']['armhole'];
      $bicep=$_SESSION['req']['sizing']['measure-your-body']['bicep'];
      $wrist=$_SESSION['req']['sizing']['measure-your-body']['wrist'];
      $value_type=$_SESSION['req']['sizing']['measure-your-body']['value-type'];
      $height=$_SESSION['req']['sizing']['measure-your-body']['general']['height'];
      $weight=$_SESSION['req']['sizing']['measure-your-body']['general']['weight'];
      $build=$_SESSION['req']['sizing']['measure-your-body']['general']['build'];
      $fit=$_SESSION['req']['sizing']['measure-your-body']['general']['fit'];

      $arr_measure_your_body = array(	"neck" => $neck,
      "chest" => $chest,
      "waist" => $waist,
      "hips" => $hips,
      "shirt-length" => $shirt_length,
      "arm-length"=>$arm_length,
      "arm-length-short"=>$arm_length_short,
      "shoulders"=>$shoulders,
      "armhole"=>$armhole,
      "bicep"=>$bicep,
      "wrist"=>$wrist,
      "value-type"=>$value_type,
      "general"=>array("height"=>$height,
      "weight"=>$weight,
      "build"=>$build,
      "fit"=>$fit)
      );


      update_user_meta($user_id,$profile_name, $arr_measure_your_body,false);

      }
      else
      {
      /*--Add profile Name--- */
    //add_user_meta($user_id,"profile_name", $profile_name,false);
    /* ---End---------------- */

    /* --Add measurement profile-- */

    /* 	$neck=$_SESSION['req']['sizing']['measure-your-body']['neck'];
      $chest=$_SESSION['req']['sizing']['measure-your-body']['chest'];
      $waist=$_SESSION['req']['sizing']['measure-your-body']['waist'];
      $hips=$_SESSION['req']['sizing']['measure-your-body']['hips'];
      $shirt_length=$_SESSION['req']['sizing']['measure-your-body']['shirt-length'];
      $arm_length=$_SESSION['req']['sizing']['measure-your-body']['arm-length'];
      $arm_length_short=$_SESSION['req']['sizing']['measure-your-body']['arm-length-short'];
      $shoulders=$_SESSION['req']['sizing']['measure-your-body']['shoulders'];
      $armhole=$_SESSION['req']['sizing']['measure-your-body']['armhole'];
      $bicep=$_SESSION['req']['sizing']['measure-your-body']['bicep'];
      $wrist=$_SESSION['req']['sizing']['measure-your-body']['wrist'];
      $value_type=$_SESSION['req']['sizing']['measure-your-body']['value-type'];
      $height=$_SESSION['req']['sizing']['measure-your-body']['general']['height'];
      $weight=$_SESSION['req']['sizing']['measure-your-body']['general']['weight'];
      $build=$_SESSION['req']['sizing']['measure-your-body']['general']['build'];
      $fit=$_SESSION['req']['sizing']['measure-your-body']['general']['fit'];

      $arr_measure_your_body = array(	"neck" => $neck,
      "chest" => $chest,
      "waist" => $waist,
      "hips" => $hips,
      "shirt-length" => $shirt_length,
      "arm-length"=>$arm_length,
      "arm-length-short"=>$arm_length_short,
      "shoulders"=>$shoulders,
      "armhole"=>$armhole,
      "bicep"=>$bicep,
      "wrist"=>$wrist,
      "value-type"=>$value_type,
      "general"=>array("height"=>$height,
      "weight"=>$weight,
      "build"=>$build,
      "fit"=>$fit)
      );


      $meta_id=add_user_meta($user_id,$profile_name, $arr_measure_your_body,false);



      /*---End---------------- */

    /* ---Insert into custom table--- */

    /* 	$wpdb->insert($wpdb->prefix.'profile',
      array(
      'umeta_id' => $meta_id,
      'user_id' => $user_id,
      'profile_name'=>$profile_name
      ),
      array(
      '%d',
      '%d',
      '%s'
      )
      );
      }

      /*-----End--------------------- */

    //unset($_SESSION['req']);

    /* print '<pre>';
      print_r($_SESSION);
      print '</pre>'; */


    //}
    //}
}

add_shortcode('user-profile', 'create_user_profile');

add_action('wp_ajax_nopriv_get_user_profile', 'get_user_profile');
add_action('wp_ajax_get_user_profile', 'get_user_profile');

function get_user_profile() {
    global $product_id, $post_type, $settings_id, $current_page_id, $cart_key, $wpdb;


    if ($_REQUEST['profile_id'] == 0) {
        print '<h3>Please Select A Profile</h3>';
        die();
    }
    $profile_id = $_REQUEST['profile_id'];
    $settings_id = $_REQUEST['settings_id'];

    $pname = $wpdb->get_var("select profile_name from " . $wpdb->prefix . "profile where umeta_id=$profile_id");
    $sizing_key = $wpdb->get_var("select sizing_option from " . $wpdb->prefix . "profile where umeta_id=$profile_id");

    $profile = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "usermeta where umeta_id=$profile_id");

    //print "select meta_value from ".$wpdb->prefix." where umeta_id=$profile_id";
    //print_r(unserialize($profile));
    $b_measurement = unserialize($profile);
    /* print '<pre>';
      print_r($b_measurement);
      print '</pre>'; */

    //die();

    $options = get_field('sizing', $settings_id);
    $select_options = array();
    //

    if ($post_type == 'product-made-shirt')
        $post_type = 'product-shirt';

    if ($options) {

        foreach ($options as $option) {

            $x = 0;

            foreach ($option as $key => $opt) {

                if ($key != "general_settings") {

                    // Every Product Type Array

                    foreach ($opt as $o) {

                        $select_options[sanitize_title($o['shirt/body_name'])] = $o;
                    }
                } else {


                    if (in_array($post_type, array('product-made-shirt', 'product-shirt'))) {

                        // Shirts General Sizing Array

                        $select_options[sanitize_title($opt[0]['shirt/body_name'])] = $opt[0];
                    }
                }

                $x++;
            }
        }
    }
    //print_r($select_options);
    //$html='<div class="measure-box measure-box-new '.$post_type.'-class">';
    $values_types = array("centimeters", "inches");

    $selected_value_type = "centimeters";

    if (!empty($selected_values)) {
        $selected_value_type = $selected_values['value-type'];
    }

    foreach ($values_types as $vtype) {

        if ($vtype != $selected_value_type) {

            $unselected_value_type = $vtype;
        }
    }
    //print_r($select_options);die;

    if ($settings_id == 355) {
        $sizing_type = "measure-your-body";
        ?>

        <div class="measure-small-nav sute_third_nav" style="display:block;" >
            <a href="#measure-your-jacket" class="btn selected">Jacket</a>
            <a href="#measure-your-pants" class="btn">Pants</a>
        </div>
        <?php if ($select_options) { ?>

            <?php foreach ($select_options as $key => $opt) { ?>

                <div class="options-container" id="<?php echo $key; ?>" <?php if ($key == 'measure-your-jacket') echo 'style="display: block;"'; ?>>

                    <div class="measure-options">

                        <?php if ($key != 'measure-your-pants') { ?>

                            <div class="profile-title input-profile input-profile-active left-col" data-info="general" style="margin-top: 48px;">

                                <p>General Info</p>

                            </div>

                        <?php } else { ?>
                            <div style="width:100%; float:left; clear:both; height:55px;">&nbsp;</div>
                        <?php } ?>

                        <?php
                        $x = 0;

                        foreach ($opt['shirt/body_name_options'] as $option) {

                            $selected_range = explode("-", $option['field_values_' . $selected_value_type]);

                            $selected_step = $option['field_values_' . $selected_value_type . '_step'];

                            $cm_range = explode("-", $option['field_values_centimeters']);

                            $cm_step = $option['field_values_centimeters_step'];

                            $in_range = explode("-", $option['field_values_inches']);

                            $in_step = $option['field_values_inches_step'];
                            ?>

                            <div class="input-profile left-col<?php if ($x == 0 && $key == 'measure-your-pants') echo ' input-profile-active'; ?>" data-info="<?php echo sanitize_title($option['field_name']); ?>">

                                <label><?php echo $option['field_name']; ?></label>

                                <?php
                                if (!empty($selected_values)) {
                                    $selected_value = $selected_values[sanitize_title($option['field_name'])];
                                }
                                ?>
                                <?php
                                /* $p_id=$_REQUEST[custom_product_id];

                                  $measure=$wpdb->get_var("select meta_value from ".$wpdb->prefix."postmeta where meta_key='measure_your_body' and post_id=$p_id");
                                  $measurement=unserialize($measure); */

                                if ($_REQUEST['profile_id'] != "Select Profile") {

                                    foreach ($b_measurement as $selected_measure_key => $selected_values_measure_option) {
                                        $measurement_opt = strtolower($option['field_name']);

                                        if ($selected_measure_key == $measurement_opt) {
                                            $selected_value = $selected_values_measure_option;
                                        }
                                    }
                                }


                                if ($b_measurement['value-type'] == 'inches') {
                                    ?>
                                    <select name="sizing[<?php echo $sizing_type; ?>][<?php echo sanitize_title($option['field_name']); ?>]" class="selected-values">

                                        <?php for ($i = $in_range[0]; $i <= $in_range[1]; $i = $i + $in_step) { ?>

                                            <option value="<?php echo $i; ?>"<?php
                                            if ($selected_value == $i) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $i; ?></option>

                                        <?php } ?>

                                    </select>
                                    <?php
                                } else {
                                    ?>
                                    <select name="sizing[<?php echo $sizing_type; ?>][<?php echo sanitize_title($option['field_name']); ?>]" class="selected-values">

                                        <option value="">Select Size</option>


                                        <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>

                                            <option value="<?php echo $i; ?>"<?php
                                            if ($selected_value == $i) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $i; ?></option>

                                        <?php } ?>

                                    </select>
                                    <?php
                                }
                                ?>

                                <select class="replace-values" data-type="centimeters">

                                    <?php for ($i = $cm_range[0]; $i <= $cm_range[1]; $i = $i + $cm_step) { ?>

                                        <option value="<?php echo $i; ?>"<?php
                                        if ($selected_value == $i) {
                                            echo "selected=selected";
                                        }
                                        ?>><?php echo $i; ?></option>

                                    <?php } ?>

                                </select>

                                <select class="replace-values" data-type="inches">

                                    <?php for ($i = $in_range[0]; $i <= $in_range[1]; $i = $i + $in_step) { ?>

                                        <option value="<?php echo $i; ?>"<?php
                                        if ($selected_value == $i) {
                                            echo "selected=selected";
                                        }
                                        ?>><?php echo $i; ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <?php
                            $x++;
                        }
                        ?>

                    </div>

                    <div class="measure-contain measure-contain-body">
                        <div class="profile-input-wrap">
                            <label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information</h3>
                        </div>

                        <?php if ($key != 'measure-your-pants') { ?>

                            <!-- general -->

                            <div class="profile-wrap field-info" id="general">

                                <div class="profile-input-wrap">

                                                                            <label for="profile-name" >Name Your Profile </label>                                                                                                                            <!--<input type="text" id="profile-name" name="sizing[<?php echo $sizing_type; ?>][profile-name]" value="<?php echo $measurement['profile-name'] ?>" placeholder="Enter a name for your measurement profile.">-->

                                    <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php echo $pname; ?>" placeholder="Enter a name for your measurement profile." >

                                </div>

                                <div class="profile-input-wrap">

                                    <label>Cm/Inches</label>

                                    <select name="sizing[<?php echo $sizing_type; ?>][value-type]" class="change-values">

                                        <?php foreach ($values_types as $vtype) { ?>

                                            <option value="<?php echo $vtype; ?>"<?php
                                            if ($b_measurement['value-type'] == $vtype) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo ucfirst($vtype); ?></option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <?php foreach ($opt['general_options'] as $goption) { ?>

                                    <div class="profile-input-wrap">

                                        <label><?php echo $goption['field_value']; ?></label>
                                        <?php
                                        $f = strtolower($goption['field_value']);
                                        ?>
                                        <select name="sizing[<?php echo $sizing_type; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]" class="general-values">

                                            <option value="">Select <?php echo $goption['field_value']; ?></option>

                                            <?php
                                            if (!empty($selected_values)) {
                                                $f = $goption['field_value'];
                                                $selected_value = $selected_values['general'][$f];
                                            }
                                            ?>

                                            <?php foreach ($goption['field_options'] as $gopt) { ?>

                                                <option value='<?php echo $gopt['option_name']; ?>' <?php if ($b_measurement['general'][$f] == $gopt['option_name']) { ?>selected="selected"<?php } ?>><?php echo $gopt['option_name']; ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                <?php } ?>

                            </div>

                        <?php } ?>

                        <?php
                        $x = 0;
                        foreach ($opt['shirt/body_name_options'] as $option) {
                            ?>

                            <div class="profile-wrap2 field-info" id="<?php echo sanitize_title($option['field_name']); ?>"<?php if ($x == 0 && $key == 'measure-your-pants') echo ' style="display: block;"'; ?>>

                                <div class="profile-wrap-details">

                                    <h2><?php echo $option['field_name']; ?></h2>

                                    <p><?php echo $option['field_description']; ?></p>

                                </div>

                                <div class="profile-wrap-image">

                                    <?php
                                    $image = $option['field_image'];
                                    $link = $image['sizes']['sizing-info'];
                                    ?>

                                    <img src="<?php echo $link; ?>" alt="<?php echo $option['field_name']; ?> image">

                                </div>

                            </div>

                            <?php
                            $x++;
                        }
                        ?>

                    </div>

                </div>

            <?php } ?>

        <?php } ?>

        <?php
        die();
    }


    $html = '<div class="measure-options">';

    $html.='<div class="profile-title input-profile input-profile-active left-col" data-info="general-"' . $key . '">';

    $html.='<p>General Info</p>';

    $html.='</div>';
    foreach ($select_options as $key => $opt) {

        //$html.='<div class="options-container" id="'.$key.'">';
        //if ($key=='measure-your-body')	{
        if ($key == $sizing_key) {

            foreach ($opt['shirt/body_name_options'] as $option) {

                $selected_range = explode("-", $option['field_values_' . $selected_value_type]);

                $selected_step = $option['field_values_' . $selected_value_type . '_step'];

                $cm_range = explode("-", $option['field_values_centimeters']);

                $cm_step = $option['field_values_centimeters_step'];

                $in_range = explode("-", $option['field_values_inches']);

                $in_step = $option['field_values_inches_step'];


                $option_name = sanitize_title($option['field_name']);

                if ($option_name == "arm-length-short") {

                    $display = 'style="display: none;"';
                } else {

                    $display = '';
                }




                //$measurement_index=strtolower(str_replace(" (Short)", "", $option['field_name']));
                $measurement_index = strtolower(str_replace(" ", "-", $option['field_name']));
                $html.='<div class="input-profile left-col container-"' . $option_name . '" data-info="' . $option_name . '-' . $key . '" ' . $display . '>';


                $html.='<label>' . str_replace(" (Short)", "", $option['field_name']) . '</label>';
                if ($b_measurement['value-type'] == 'inches') {
                    $html.='<select name="sizing[' . $key . '][' . $option_name . '] class="selected-values">

						<option value="">Select Size</option>';

                    for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $in_step) {
                        if ($b_measurement[$measurement_index] == $i) {
                            $html.='<option value="' . $i . '" selected>' . $i . '</option>';
                        } else {
                            $html.='<option value="' . $i . '">' . $i . '</option>';
                        }
                    }

                    $html.='</select>';
                } else {
                    $html.='<select name="sizing[' . $key . '][' . $option_name . '] class="selected-values">

						<option value="">Select Size</option>';

                    for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) {
                        if ($b_measurement[$measurement_index] == $i) {
                            $html.='<option value="' . $i . '" selected>' . $i . '</option>';
                        } else {
                            $html.='<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                }

                $html.='</select>';
                $html.='<select class="replace-values" data-type="centimeters">';

                $html.='<option value="">Select Size</option>';

                for ($i = $cm_range[0]; $i <= $cm_range[1]; $i = $i + $cm_step) {

                    $html.='<option value="' . $i . '">' . $i . '</option>';
                }

                $html.='</select>';

                $html.='<select class="replace-values" data-type="inches">';

                $html.='<option value="">Select Size</option>';

                for ($i = $in_range[0]; $i <= $in_range[1]; $i = $i + $in_step) {

                    $html.='<option value="' . $i . '">' . $i . '</option>';
                }

                $html.='</select>';

                $html.='</div>';
            }
            $html.='</div>';
            /* ---Start block--- */

            $html.='<div class="measure-contain measure-contain-body">';
			
            $html.='<div class="profile-input-wrap">
            	<label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information</h3>
             </div>';

            $html.='<div class="profile-wrap field-info" id="general-"' . $key . '>';

            if (is_user_logged_in()) {
                if (count($b_measurement) > 0) {
                    $profile_name = get_user_meta($user_id, 'profile_name', true);

                    $html.='<div class="profile-input-wrap">';
                    $html.='<label for="profile-name" class="big-label">Name Your Profile</label>';
                    $html.='<input type="text" id="profile-name" name="sizing[' . $key . '][profile-name]" value="' . $pname . '" placeholder="Enter a name for your measurement profile." >';
                    $html.='</div>';
                    $html.='<div class="profile-input-wrap">';
                    $html.='<label>Cm/Inches</label>';
                    $html.='<select name=sizing[' . $key . '][value-type] class="change-values">';


                    if ($values_type != null) {
                        if ($b_measurement['value-type'] == $values_type) {

                            $html.='<option value=' . $values_type . ' selected>' . ucfirst($values_type) . '</option>';
                        } else {
                            $html.='<option value="' . $values_type . '">' . ucfirst($values_type) . '</option>';
                        }
                        $html.='<option value="inches">Inches</option>';
                    } else {

                        foreach ($values_types as $vtype) {
                            if ($b_measurement['value-type'] == $vtype) {

                                $html.='<option value="' . $vtype . '" selected>' . ucfirst($vtype) . '</option>';
                            } else {

                                $html.='<option value=$vtype>' . ucfirst($vtype) . '</option>';
                            }
                        }
                    }
                    $html.='</select>';
                    $html.='</div>';

                    foreach ($opt['general_options'] as $goption) {
                        $html.='<div class="profile-input-wrap">';
                        $html.='<label>' . $goption['field_value'] . '</label>';
                        //$html.='<select name="sizing" class="general-values">';
                        $f = sanitize_title($goption['field_value']);
                        $html.='<select name="sizing[' . $key . '][general][' . $f . ']" class="general-values">';

                        if (!empty($selected_values)) {
                            $selected_value = stripslashes($selected_values['general'][sanitize_title($goption['field_value'])]);
                        }
                        foreach ($goption['field_options'] as $gopt) {
                            $field = strtolower($goption['field_value']);

                            if ($b_measurement['general'][$field] == $gopt['option_name']) {

                                //$html.='<option value="'.$gopt['option_name'].'" selected>'.$gopt['option_name'].'</option>';
                                $html.='<option value="' . $gopt['option_name'] . '" selected>' . $gopt['option_name'] . '</option>';
                            } else {
                                //$html.='<option value="'.$gopt['option_name'].'>'.$gopt['option_name'].'</option>';
                                $html.='<option value="' . $gopt['option_name'] . '">' . $gopt['option_name'] . '</option>';
                            }
                        }
                        $html.='</select>';
                        $html.='</div>';
                    }
                }

                $html.='</div>';
                //$html.='</div>';

                /* -----End block--- */
            }
        }
    }
	
    foreach ($select_options as $key => $opt) {

        //$html.='<div class="options-container" id="'.$key.'">';
        //if ($key=='measure-your-body')    {
        //if (trim($key)=='measure-your-body') {
            //echo "gggggg";die;

            foreach ($opt['shirt/body_name_options'] as $option) {

                $selected_range = explode("-", $option['field_values_' . $selected_value_type]);

                $selected_step = $option['field_values_' . $selected_value_type . '_step'];

                $cm_range = explode("-", $option['field_values_centimeters']);

                $cm_step = $option['field_values_centimeters_step'];

                $in_range = explode("-", $option['field_values_inches']);

                $in_step = $option['field_values_inches_step'];


                $option_name = sanitize_title($option['field_name']);

                if ($option_name == "arm-length-short") {

                    $display = 'style="display: none;"';
                    continue;
                } else {

                    $display = '';
                }
                $measurement_index = strtolower(str_replace(" ", "-", $option['field_name']));
                $image = $option['field_image'];
                         $link = $image['sizes']['sizing-info'];
                
                $html.='<div class="profile-wrap2 field-info" id="'.sanitize_title($option['field_name']).'-'.$key.'" style="display:none;">
					<div class="profile-wrap-details">
						<h2>'.$option['field_name'].'</h2>
						<p>'.$option['field_description'].'</p>
					</div>
				    <div class="profile-wrap-image">';
					   if ($image) 
						{ 
							$html.='<img src="'.$link.'" alt="'.$option['field_name'].'image">';                
						} 
				 

                $html.='</div>
                         </div><!--profile-wrap-2-->';
                
            }
			
        //}
    }
    $html.='</div><div class="steps_next_prev" style="clear:both;"><a href="#" class="step_prev_btn_'.$sizing_key.'" data-referrence="'.$sizing_key.'" style="display:none;"><</a>&nbsp;<a href="#" class="step_next_btn_'.$sizing_key.'" data-referrence="'.$sizing_key.'"></a></div>';
            //$html.='</div>';
            /* ---Start block--- */

            //$html.='<div class="measure-contain measure-contain-body measure_right">';
    print $html;

    die();
}

/* add mete box */
/* Meta box product related data */
add_action('add_meta_boxes', 'related_data_meta_box_add');
function related_data_meta_box_add() {
    if ($_REQUEST['action'] == 'edit') {
        $terms = get_the_terms($_REQUEST['post'], 'product_cat');

        if ($terms[0]->term_id != 26 && $terms[0]->term_id != 50 && $terms[0]->term_id != 51 && $terms[0]->term_id != 52 && $terms[0]->term_id != 53) {
            add_meta_box('select-product-id', 'Select Product Type', 'display_product_type', 'product', 'normal', 'high');
        }
    } else {
        add_meta_box('select-product-id', 'Select Product Type', 'display_product_type', 'product', 'normal', 'high');
    }

    //add_meta_box( 'specialty-meta-box-id', 'Job Related Data', 'specialty_meta_box_cb', 'job', 'normal', 'high' );
}

function display_product_type($post) {
    if ($_REQUEST['action'] != 'edit') {
        ?>
        <input type="radio" name="product_type" value="191" onclick="display_option(this.value, '<?php echo $post->ID ?>')" checked="checked">Shirt
        <input type="radio" name="product_type" value="193" onclick="display_option(this.value, '<?php echo $post->ID ?>')">Jacket
        <input type="radio" name="product_type" value="196" onclick="display_option(this.value, '<?php echo $post->ID ?>')">Blazer
        <input type="radio" name="product_type" value="194" onclick="display_option(this.value, '<?php echo $post->ID ?>')">Pant
        <input type="radio" name="product_type" value="195" onclick="display_option(this.value, '<?php echo $post->ID ?>')">Chinos
        <input type="radio" name="product_type" value="355" onclick="display_option(this.value)">Suit
        <?php
    }
    if ($_REQUEST['action'] == 'edit') {
        $a = get_the_terms($_REQUEST['post'], 'product_cat');

        foreach ($a as $product_category) {
            $a = $product_category->name;
        }
        ?>
        <input type="radio" name="product_type" value="191" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "Design Your Own") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Shirt
        <input type="radio" name="product_type" value="193" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "design your jacket") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Jacket
        <input type="radio" name="product_type" value="196" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "design your blazers") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Blazer
        <input type="radio" name="product_type" value="194" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "design your pants") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Pant
        <input type="radio" name="product_type" value="195" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "design your chinos") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Chinos
        <input type="radio" name="product_type" value="355" onclick="display_option(this.value, '<?php echo $post->ID ?>')" <?php if ($a == "design your suits") { ?>checked="checked"<?php } else { ?> disabled="disabled" <?php } ?>>Suit
        <?php
        switch ($a) {
            case "Design Your Own":
                $settings_id = 191;
                break;
            case "design your jacket":
                $settings_id = 193;
                break;

            case "design your blazers":
                $settings_id = 196;
                break;
            case "design your chinos":
                $settings_id = 195;
                break;
            case "design your pants":
                $settings_id = 194;
                break;
            case "design your suits":
                $settings_id = 355;
                break;
            default :$settings_id = 191;
                break;
        }
    } else {
        $settings_id = 191;
    }
    ?>
    <div id="product_option">

        <?php
        /* This section for suit */
        if ($settings_id == 355) { // Special Design for suits
            $jackets_settings_id = 193;
            $pants_settings_id = 194;
            ?>

            <div class="span12">

                <div class="browse-design-details">
                    <?php if (get_field('design_settings', $jackets_settings_id)) { ?>
                        <div class="browse-design-details-box" style="width:100%;">

                            <!--<a href="#jacket-design-options" class="suit-tab selected">jacket</a><a href="#pants-design-options" class="suit-tab">pants</a>

                    </div>-->

                            <div id="jacket-design-options" class="suit-content" style="width:50%;margin: 0 0 35px 0;float:left">
                                <h2><u>Jacket</u></h2>

                                <?php while (has_sub_field('design_settings', $jackets_settings_id)) { ?>

                                    <div class="input-wrap">

                                        <label><?php the_sub_field('setting_name', $jackets_settings_id); ?></label>


                                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $jackets_settings_id)); ?>

                                        <?php
                                        $selected_value = get_post_meta($pid, sanitize_title(get_sub_field('setting_name', $jackets_settings_id)), true);

                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));


                                        if ($_REQUEST['action'] == 'edit') {
                                            if (metadata_exists('post', $_REQUEST[post], 'design')) {
                                                $design_meta = unserialize(get_post_meta($_REQUEST[post], 'design', true));

                                                foreach ($design_meta as $key => $value) {
                                                    if ($key == $option_name) {
                                                        $selected_value = $value;
                                                    }
                                                }
                                            }
                                        }

                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }

                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }
                                        ?>

                                        <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $jackets_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                            <?php while (has_sub_field('options', $jackets_settings_id)) { ?>

                                                <option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                <?php } ?>

                            </div>

                            <div id="pants-design-options" class="suit-content" style="width:50%;margin: 0 0 35px 0;float:left">
                                <h2><u>Pants</u></h2>

                                <?php while (has_sub_field('design_settings', $pants_settings_id)) { ?>

                                    <div class="input-wrap">

                                        <label><?php the_sub_field('setting_name', $pants_settings_id); ?></label>

                                        <?php // Create hidden input for pricing ?>

                                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $pants_settings_id)); ?>

                                        <?php
                                        $selected_value = get_post_meta($pid, sanitize_title(get_sub_field('setting_name', $pants_settings_id)), true);

                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));


                                        if ($_REQUEST['action'] == 'edit') {
                                            if (metadata_exists('post', $_REQUEST[post], 'design')) {
                                                $design_meta = unserialize(get_post_meta($_REQUEST[post], 'design', true));

                                                foreach ($design_meta as $key => $value) {
                                                    if ($key == $option_name) {
                                                        $selected_value = $value;
                                                    }
                                                }
                                            }
                                        }


                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }
                                        ?>

                                        <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $pants_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                            <?php while (has_sub_field('options', $pants_settings_id)) { ?>

                                                <option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                <?php } ?>

                            </div>

                        </div>

                    <?php } ?>
                </div>

                <p>&nbsp;</p>

                <hr size=1 />
                <p>&nbsp;</p>

                <?php
            }



            /* --Suit end-- */



            if (get_field('design_settings', $settings_id)) {
                ?>
                <p><b><u>Design</u></b></p>
                <div class="browse-design-details-box">

                    <ul>
                        <?php while (has_sub_field('design_settings', $settings_id)) { ?>
                            <li>
                                <div class="input-wrap">

                                    <label><?php the_sub_field('setting_name', $settings_id); ?></label>

                                    <?php // Create hidden input for pricing ?>

                                    <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

                                    <?php
                                    if ($_REQUEST['action'] == 'edit') {
                                        if (metadata_exists('post', $_REQUEST[post], 'design')) {
                                            $design_meta = unserialize(get_post_meta($_REQUEST[post], 'design', true));

                                            foreach ($design_meta as $key => $value) {
                                                if ($key == $option_name) {
                                                    $selected_value = $value;
                                                }
                                            }
                                        }
                                    }

                                    if (!empty($selected_values)) {
                                        $selected_value = $selected_values[$option_name];
                                    }
                                    ?>

                                    <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                        <?php while (has_sub_field('options', $settings_id)) { ?>

                                            <option value="<?php the_sub_field('option_name') ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected" <?php } ?>><?php the_sub_field('option_name'); ?></option>

                                        <?php } ?>

                                    </select>

                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>



                <?php
            }
            if ($settings_id != 194 || $settings_id != 195) {
                ?>
                <p><b><u>Extras</u></b></p>
                <?php
            }
            ?>

            <div class="row-fluid">

                <div class="span12">
                    <div class="browse-design-details">
                        <?php
                        if (get_field('extras_settings', $settings_id)) {
                            if ($selected_values['lining-code'])
                                $lining_code = $selected_values['lining-code'];
                            ?>
                            <div class="browse-design-details-box">
                                <?php while (has_sub_field('extras_settings', $settings_id)) { ?>
                                    <div class="input-wrap">
                                        <label><?php the_sub_field('setting_name', $settings_id); ?></label>
                                        <!-- Nhan.Mai - 20140603 -->
                                        <?php //$option_name = sanitize_title(str_replace("<br>", " ", get_sub_field('setting_name', $settings_id))); ?>
                                        <div class="snd_stem_slectbox">
                                            <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>
                                            <?php
                                            if ($_REQUEST['action'] == 'edit') {
                                                if (metadata_exists('post', $_REQUEST['post'], 'extras')) {
                                                    $design_meta = unserialize(get_post_meta($_REQUEST['post'], 'extras', true));
                                                    foreach ($design_meta as $key => $value) {
                                                        if ($key == $option_name) {
                                                            $selected_value = $value;
                                                        }
                                                    }
                                                }
                                            }
                                            if (!empty($selected_values)) {
                                                $selected_value = $selected_values[$option_name];
                                            }
                                            ?>

                                            <select name="extras[<?php echo $option_name; ?>]" id="target-<?php echo $option_name; ?>" class="select-popup"   id="target-<?php echo $option_name; ?>" data-popup="#extras-<?php echo $option_name; ?>">

                                                <?php
                                                $x = 0;
                                                while (has_sub_field('options', $settings_id)) {
                                                    ?>

                                                    <?php
                                                    // Create Monogram colors array

                                                    if ($option_name == "contrasting-buttonhole-stitching") {

                                                        if (get_sub_field('option_name') != "No") {
                                                            $monogram_colors[get_sub_field('option_name')] = get_sub_field('option_name');
                                                        }
                                                    }

                                                    // Price
                                                    if (get_sub_field('option_price')) {
                                                        $price = get_currency_price(get_sub_field('option_price'));
                                                    } else {
                                                        $price = "";
                                                    }
                                                    ?>

                                                    <option value ="<?= trim(get_sub_field('option_name')) . '-' . $x; ?>"<?php if (trim(get_selected_value($selected_value)) == trim(get_selected_value(get_sub_field('option_name')))) { ?> selected="selected"<?php } ?>>
                                                        <?php
                                                        if ($option_name == 'contrastingcollar-cuff-lining') {
                                                            if ($lining_code != NULL) {
                                                                echo get_the_title($item['extras']['lining-code']);
                                                            } else {
                                                                $option_value = get_sub_field('option_name');

                                                                if (strtoupper(trim($option_value)) == 'YES') {
                                                                    $material_contrasting = get_field('fabric_collar_cuff_lining');
                                                                    $fabricContrasting_id = $material_contrasting[0]->ID;
                                                                    $fabricContrasting_name = get_the_title($fabricContrasting_id);
                                                                    if ($fabricContrasting_id != NULL) {
                                                                        echo $fabricContrasting_name;
                                                                    } else {
                                                                        echo $option_value;
                                                                    }
                                                                } else {
                                                                    echo $option_value;
                                                                }
                                                            }
                                                        } else {
                                                            echo get_sub_field('option_name');
                                                        }
                                                        if (!empty($price)) {
                                                            echo "[+" . get_currency_sign() . "$price]";
                                                        }
                                                        ?>
                                                    </option>

                                                    <?php
                                                    $x++;
                                                }
                                                ?>

                                            </select>

                                            <!---->
                                            <?php
                                            if ($option_name == 'contrastingcollar-cuff-lining') {
                                                ?>
                                                <input type="hidden" id="lining-code" name="extras[lining-code]" value="<?= $lining_code != NULL ? $lining_code : $fabricContrasting_id; ?>" />
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!---->
                                    </div>
                                <?php } ?>

                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    add_action('save_post', 'save_product_data');

    function save_product_data($post_id) {
        /* print '<pre>';
          print_r($_POST);
          print '</pre>';
          die(); */
        switch ($_POST['product_type']) {
            case 191:
                /* design array */
                $collar = $_POST['design']['collar'];
                $cuff = $_POST['design']['cuff'];
                $collar_cuff_thickness = $_REQUEST['design']['collar-cuff-thickness'];
                $pocket = $_POST['design']['pocket'];
                $front = $_POST['design']['front'];
                $bottom = $_POST['design']['bottom'];



                $arr = array("collar" => $collar, "cuff" => $cuff,
                    "collar-cuff-thickness" => $collar_cuff_thickness,
                    "pocket" => $pocket, "front" => $front,
                    "bottom" => $bottom);

                /* ---End--- */
                /* ---Extra Array--- */
                if ($_POST['extras']['monogram'] == 'No') {

                    unset($_POST['extras']['position']);

                    unset($_POST['extras']['color']);

                    unset($_POST['extras']['custom-text']);
                }

                $arr_extras = array("white-collar-cuff" => $_POST['extras']['white-collar-cuff'],
                    "removable-collar-stays" => $_POST['extras']['removable-collar-stays'],
                    "contrasting-buttons" => $_POST['extras']['contrasting-buttons'],
                    "contrastingbuttonhole-stitching" => $_POST['extras']['contrastingbuttonhole-stitching'],
                    "contrastingcollar-cuff-lining" => $_POST['extras']['contrastingcollar-cuff-lining'],
                    "lining-code" => $_POST['extras']['lining-code'],
                    "monogram" => $_POST['extras']['monogram'],
                    "monogram-position" => $_POST['extras']['position'],
                    "monogram-color" => $_POST['extras']['color'],
                    "monogram-custom-text" => $_POST['extras']['custom-text']
                );
                break;
            case 193:

                $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['jacket-buttons'],
                    "lapel" => $_POST['design']['lapel'],
                    "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                    "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


                $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                    "pick-stiching" => $_POST['extras']['pick-stiching'],
                    "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                    "boutonniere" => $_POST['extras']['boutonniere'],
                    "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                    "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                    "buttons" => $_POST['extras']['buttons'],
                    "matching-vest" => $_POST['extras']['matching-vest'],
                    "extra-pants" => $_POST['extras']['extra-pants'],
                    "monogram" => $_POST['extras']['monogram']
                );
                break;
            case 196:

                $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons-single" => $_POST['design']['jacket-buttons-single'],
                    "jacket-buttons-double" => $_POST['design']['jacket-buttons-double'],
                    "lapel" => $_POST['design']['lapel'],
                    "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                    "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back']);


                $arr_extras = array("pick-stitching" => $_POST['extras']['pick-stitching'],
                    "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                    "butonniere-colour" => $_POST['extras']['butonniere-colour'],
                    "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                    "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                    "monogram" => $_POST['extras']['monogram'],
                    "contrasting-buttons" => $_POST['extras']['contrasting-buttons'],
                    "matching-vest" => $_POST['extras']['matching-vest'],
                    "extra-pants" => $_POST['extras']['extra-pants']);
                break;

            case 194:
                $arr = array("pants-style" => $_POST['design']['pants-style'], "crotch-style" => $_POST['design']['crotch-style'],
                    "waist-style" => $_POST['design']['waist-style'],
                    "pleats" => $_POST['design']['pleats'],
                    "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);
                break;

            case 195:

                $arr = array("pants-style" => $_POST['design']['pants-style'], "crotch-style" => $_POST['crotch-style'],
                    "waist-style" => $_POST['design']['waist-style'],
                    "pleats" => $_POST['design']['pleats'],
                    "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);


                $arr_extras = array("waistband-lining" => $_POST['extras']['waistband-lining'],
                    "back-packet-lining" => $_POST['extras']['back-packet-lining']);

                break;
            case 355;

                $arr = array("jacket-style" => $_POST['design']['jacket-style'], "jacket-buttons" => $_POST['design']['jacket-buttons'],
                    "lapel" => $_POST['design']['lapel'], "lapel-width" => $_POST['design']['lapel-width'], "pockets" => $_POST['design']['pockets'],
                    "sleeve-buttons" => $_POST['design']['sleeve-buttons'], "back" => $_POST['design']['back'], "pants-style" => $_POST['design']['pants-style'],
                    "crotch-style" => $_POST['design']['crotch-style'], "waist-style" => $_POST['design']['waist-style'], "pleats" => $_POST['design']['pleats'],
                    "back-pockets" => $_POST['design']['back-pockets'], "pants-cuff" => $_POST['design']['pants-cuff']);

                $arr_extras = array("jacket-lining" => $_POST['extras']['jacket-lining'],
                    "construction" => $_POST['extras']['construction'],
                    "pick-stiching" => $_POST['extras']['pick-stiching'],
                    "functioning-sleeve-buttons" => $_POST['extras']['functioning-sleeve-buttons'],
                    "boutonniere" => $_POST['extras']['boutonniere'],
                    "collar-felt-color" => $_POST['extras']['collar-felt-color'],
                    "buttonhole-color" => $_POST['extras']['buttonhole-color'],
                    "buttons" => $_POST['extras']['buttons'],
                    "extra-pants" => $_POST['extras']['extra-pants'],
                    "matching-vest" => $_POST['extras']['matching-vest'],
                    "monogram" => $_POST['extras']['monogram']
                );
                break;
        }
        /* ----End---- */
        update_post_meta($post_id, "design", serialize($arr));
        update_post_meta($post_id, "extras", serialize($arr_extras));
        update_post_meta($post_id, "_customized_product", 'yes', true);
    }

    function select_product_enqueue() {

        wp_enqueue_script('select_product_script', get_template_directory_uri() . '/js/product_option.js');
    }

    add_action('admin_enqueue_scripts', 'select_product_enqueue');

    add_action('wp_ajax_get_product_data', 'get_product_data');
    add_action('wp_ajax_nopriv_get_product_data', 'get_product_data');

    function get_product_data() {
        if ($_REQUEST['action'] == 'edit') {
            $a = get_the_terms($_REQUEST['post'], 'product_cat');

            foreach ($a as $product_category) {
                $a = $product_category->name;
            }

            switch ($a) {
                case "Design Your Own":
                    $settings_id = 191;
                    break;
                case "design your jacket":
                    $settings_id = 193;
                    break;

                case "design your blazers":
                    $settings_id = 196;
                    break;
                case "design your chinos":
                    $settings_id = 195;
                    break;
                case "design your pants":
                    $settings_id = 194;
                    break;
                case "design your suits":
                    $settings_id = 355;
                    break;
                default :$settings_id = 191;
                    break;
            }
        } else {
            $settings_id = $_REQUEST['settings_id'];
        }

        $pid = $_REQUEST['pid'];

        if ($settings_id == 355) { // Special Design for suits
            $jackets_settings_id = 193;
            $pants_settings_id = 194;
            ?>


            <div class="span12">

                <div class="browse-design-details">

                    <?php if (get_field('design_settings', $jackets_settings_id)) { ?>

                        <div class="browse-design-details-box" style="width:100%;">




                            <!--<a href="#jacket-design-options" class="suit-tab selected">jacket</a><a href="#pants-design-options" class="suit-tab">pants</a>

                    </div>-->

                            <div id="jacket-design-options" class="suit-content" style="width:50%;margin: 0 0 35px 0;float:left">
                                <h2><u>Jacket</u></h2>

                                <?php while (has_sub_field('design_settings', $jackets_settings_id)) { ?>

                                    <div class="input-wrap">

                                        <label><?php the_sub_field('setting_name', $jackets_settings_id); ?></label>

                                        <?php
                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));


                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));


                                        /* if($_REQUEST['action']=='edit')
                                          { */
                                        if (metadata_exists('post', $pid, 'design')) {
                                            $design_meta = unserialize(get_post_meta($pid, 'design', true));

                                            foreach ($design_meta as $key => $value) {
                                                if ($key == $option_name) {
                                                    $selected_value = $value;
                                                }
                                            }
                                        }
                                        //}


                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }
                                        ?>

                                        <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $jackets_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                            <?php while (has_sub_field('options', $jackets_settings_id)) { ?>

                                                <option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                <?php } ?>

                            </div>

                            <div id="pants-design-options" class="suit-content" style="width:50%;margin: 0 0 35px 0;float:left">
                                <h2><u>Pants</u></h2>

                                <?php while (has_sub_field('design_settings', $pants_settings_id)) { ?>

                                    <div class="input-wrap">

                                        <label><?php the_sub_field('setting_name', $pants_settings_id); ?></label>

                                        <?php // Create hidden input for pricing ?>

                                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $pants_settings_id)); ?>

                                        <?php
                                        $selected_value = get_post_meta($pid, sanitize_title(get_sub_field('setting_name', $pants_settings_id)), true);



                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }



                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));


                                        /* if($_REQUEST['action']=='edit')
                                          { */
                                        if (metadata_exists('post', $pid, 'design')) {
                                            $design_meta = unserialize(get_post_meta($pid, 'design', true));

                                            foreach ($design_meta as $key => $value) {
                                                if ($key == $option_name) {
                                                    $selected_value = $value;
                                                }
                                            }
                                        }
                                        //}
                                        ?>
                                        <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $pants_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                            <?php while (has_sub_field('options', $pants_settings_id)) { ?>

                                                <option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

                                            <?php } ?>

                                        </select>



                                    </div>

                                <?php } ?>

                            </div>

                        </div>

                    <?php } ?>






                </div>
            </div>

            <p>&nbsp;</p>

            <hr size=1 />
            <p>&nbsp;</p>

            <?php
        }



        if (get_field('design_settings', $settings_id)) {
            ?>
            <p><b><u>Design</u></b></p>
            <div class="browse-design-details-box">
                <ul>
                    <?php while (has_sub_field('design_settings', $settings_id)) { ?>
                        <li>
                            <div class="input-wrap">

                                <label><?php the_sub_field('setting_name', $settings_id) ?></label>




                                <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

                                <?php
                                if ($_REQUEST['action'] == 'edit') {
                                    if (metadata_exists('post', $pid, 'design')) {
                                        $design_meta = unserialize(get_post_meta($pid, 'design', true));

                                        foreach ($design_meta as $key => $value) {
                                            if ($key == $option_name) {
                                                $selected_value = $value;
                                            }
                                        }
                                    }
                                }
                                if (!empty($selected_values)) {
                                    $selected_value = $selected_values[$option_name];
                                }
                                ?>




                                <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">
                                    <?php
                                    while (has_sub_field('options', $settings_id)) {
                                        ?>
                                        <option value="<?php the_sub_field('option_name') ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected" <?php } ?>><?php the_sub_field('option_name'); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>



            </div>
            <?php
        }
        if ($settings_id != 194 && $settings_id != 195) {
            ?>
            <p><b><u>Extras</u></b></p>
            <?php
        }
        ?>
        <div class="row-fluid">

            <div class="span12">
                <div class="browse-design-details">
                    <?php
                    if (get_field('extras_settings', $settings_id)) {
                        if ($selected_values['lining-code'])
                            $lining_code = $selected_values['lining-code'];
                        ?>
                        <div class="browse-design-details-box">
                            <?php while (has_sub_field('extras_settings', $settings_id)) { ?>
                                <div class="input-wrap">
                                    <label><?php the_sub_field('setting_name', $settings_id); ?></label>
                                    <!-- Nhan.Mai - 20140603 -->
                                    <?php //$option_name = sanitize_title(str_replace("<br>", " ", get_sub_field('setting_name', $settings_id)));  ?>
                                    <div class="snd_stem_slectbox">
                                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>
                                        <?php
                                        if ($_REQUEST['action'] == 'edit') {
                                            if (metadata_exists('post', $pid, 'extras')) {
                                                $design_meta = unserialize(get_post_meta($pid, 'extras', true));
                                                foreach ($design_meta as $key => $value) {
                                                    if ($key == $option_name) {
                                                        $selected_value = $value;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($selected_values)) {
                                            $selected_value = $selected_values[$option_name];
                                        }
                                        ?>

                                        <select name="extras[<?php echo $option_name; ?>]" id="target-<?php echo $option_name; ?>" class="select-popup"   id="target-<?php echo $option_name; ?>" data-popup="#extras-<?php echo $option_name; ?>">

                                            <?php
                                            $x = 0;
                                            while (has_sub_field('options', $settings_id)) {
                                                ?>

                                                <?php
                                                // Create Monogram colors array

                                                if ($option_name == "contrasting-buttonhole-stitching") {

                                                    if (get_sub_field('option_name') != "No") {
                                                        $monogram_colors[get_sub_field('option_name')] = get_sub_field('option_name');
                                                    }
                                                }

                                                // Price
                                                if (get_sub_field('option_price')) {
                                                    $price = get_currency_price(get_sub_field('option_price'));
                                                } else {
                                                    $price = "";
                                                }
                                                ?>

                                                <option value ="<?= trim(get_sub_field('option_name')) . '-' . $x; ?>"<?php if (trim(get_selected_value($selected_value)) == trim(get_selected_value(get_sub_field('option_name')))) { ?> selected="selected"<?php } ?>>
                                                    <?php
                                                    if ($option_name == 'contrastingcollar-cuff-lining') {
                                                        if ($lining_code != NULL) {
                                                            echo get_the_title($item['extras']['lining-code']);
                                                        } else {
                                                            $option_value = get_sub_field('option_name');

                                                            if (strtoupper(trim($option_value)) == 'YES') {
                                                                $material_contrasting = get_field('fabric_collar_cuff_lining');
                                                                $fabricContrasting_id = $material_contrasting[0]->ID;
                                                                $fabricContrasting_name = get_the_title($fabricContrasting_id);
                                                                if ($fabricContrasting_id != NULL) {
                                                                    echo $fabricContrasting_name;
                                                                } else {
                                                                    echo $option_value;
                                                                }
                                                            } else {
                                                                echo $option_value;
                                                            }
                                                        }
                                                    } else {
                                                        echo get_sub_field('option_name');
                                                    }
                                                    if (!empty($price)) {
                                                        echo "[+" . get_currency_sign() . "$price]";
                                                    }
                                                    ?>
                                                </option>

                                                <?php
                                                $x++;
                                            }
                                            ?>

                                        </select>

                                        <!---->
                                        <?php
                                        if ($option_name == 'contrastingcollar-cuff-lining') {
                                            ?>
                                            <input type="hidden" id="lining-code" name="extras[lining-code]" value="<?= $lining_code != NULL ? $lining_code : $fabricContrasting_id; ?>" />
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!---->
                                </div>
                            <?php } ?>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        die();
    }

    function profile_sgin_up() {
        global $settings_id;
        ?>
        <div class="form-box">
            <a class="sgn_pouup_clz"></a>
            <h3>SIGN IN</h3>
            <form name="loginform" id="login2" action="" method="post">
                <p class="login-message"></p>
                <p><input type="text" name="log" id="userid" placeholder="Username" required  /></p>
                <p><input type="password" name="pwd" placeholder="Password"  id="password" required /></p>
                <p><a href="<?php echo home_url();?>/my-account/lost-password/">Recover Password</a></p>
                <p><input type="submit" name="submit" value="Login" id="enter" /></p>
                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            </form>
        </div>
        <script type="text/javascript">
      //  jQuery('#login2').submit(function(e){
//            e.preventDefault();
//            
//            var username=jQuery("input#userid").val();
//            var password=jQuery("input#password").val();
//             jQuery.ajax({
//                type: "POST",
//                dataType: 'json',
//                url: 'https://jcoutier.com/ajax-login/',
//                data: {'username':username,'password':password,'settings_id':<?php echo $settings_id;?>},
//                success: function(data) {
//                     console.log(data);
//                     if(data.loggedin==true)
//                     {
//                        jQuery('#port_1').hide();
//                        jQuery('.shield').hide();
//                        jQuery('.third_step_rap .span12').html(data.profilelist);
//                        jQuery('#site-navigation-top-bar').html(data.login);
//                     }
//                     else{
//                       jQuery('.login-message').html('Invalid User or Password');
//                     }
//                     return false;  
//                },
//            }).fail(function(){
//                jQuery('.login-message').html('Invalid User or Password');
//            });    
//            return false;  
//        });
        </script>

        <?php
    }

    add_shortcode('signup', 'profile_sgin_up');

    add_filter('wp_login_failed', 'custom_login_failed');

    function custom_login_failed($username) {
        $referrer = wp_get_referer();

        if ($referrer && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
            //wp_redirect( add_query_arg('login', 'failed', $referrer) );
            wp_redirect(home_url() . '/my-account/');
        }
    }

    add_action('wp_ajax_nopriv_get_profile_option', 'get_profile_option');
    add_action('wp_ajax_get_profile_option', 'get_profile_option');

    function get_profile_option() {
        global $wpdb;
        $profile_id = $_REQUEST['profile_id'];
        $sizing_key = $wpdb->get_var("select sizing_option from " . $wpdb->prefix . "profile where umeta_id=$profile_id");
        print $sizing_key;
        die();
    }

    /* function for b */

    function get_parent_terms($term) {
        if ($term->parent > 0) {
            $term = get_term_by("id", $term->parent, "product_cat");
            if ($term->parent > 0) {
                get_parent_terms($term);
            } else
                return $term;
        } else
            return $term;
    }

    function show_cat() {
        $terms = get_the_terms($post->ID, 'product_cat');
        foreach ($terms as $term) {
            $term = $term->term_id;
        }

        $cat = get_the_terms($post->ID, "product_cat");
        $cat = get_parent_terms($cat);
        $cat_id = $cat[$term]->parent;


        $product_cat = get_term_by('id', $cat_id, 'product_cat');
        return $product_cat->name;
    }

    function display_profile_list() {
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        if (is_user_logged_in()) {

            global $wpdb;
            $result = $wpdb->get_results("select * from " . $wpdb->prefix ."profile where user_id=$user_id");
            //echo '<pre>';
//            echo var_dump($result);
//            echo '</pre>';
            ?>
            
            <div class="select-profile third_step">
                <ul class="third_stp_selectall">
        
                    <li>CREATE NEW MEASUREMENT PROFILE</li> 

                    <li>

                        <select style="display: block;" id="uprofile" name="sizing[user-profile]" class="cls-profile-manager">
                            <option value="custom designed shirt">Shirt</option>
                            <option value="designed suit">Suit</option>
                            <option value="designed jacked">Jacket</option>
                            <option value="designed blazer">Blazer</option>
                            <option value="designed chinos">Chinos</option>
                            <option value="designed pant">Pants</option>
                        </select>
                    </li>

                    <li><input type="button" value="CREATE" class="btn myaccount-create-profile" onclick="profile_manager();"/></li>

                </ul>


            </div>
            <table class="shop_table my_account_orders">
                <thead>
                    <tr>
                        <th class="order-number"><span class="nobr">Profile Name</span></th>
                        <th class="order-date"><span class="nobr">Date Crated</span></th>
                        <th class="order-status"><span class="nobr">Profile For</span></th>
                        <th class="order-total"><span class="nobr">&nbsp</span></th>
                        <th class="order-actions">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($result as $row) {

                        switch ($row->product_type) {
                            case "custom designed shirt":
                                $df = "Shirt";
                                $settings_id = 191;
                                break;
                            case "designed jacked":
                                $settings_id = 193;
                                $df = "Jacket";
                                break;
                            case "designed blazer":
                                $df = "Blazer";
                                $settings_id = 196;
                                break;
                            case "designed chinos":
                                $df = "Chinos";
                                $settings_id = 195;
                                break;
                            case "designed pant":
                                $df = "Pant";
                                $settings_id = 194;
                                break;
                            case "designed suit":
                                $df = "Suit";
                                $settings_id = 355;
                                break;
                        }
                        ?>

                        <tr class="order" id="profile-row-<?php echo $row->umeta_id ?>">
                            <td class="order-number" ><?php echo $row->profile_name; ?></td>
                            <td class="order-date"><?php echo $row->create_date; ?></td>
                            <td class="order-date"><?php echo $df; ?></td>
                            <td class="order-date"><a onclick="edit_my_profile('<?php echo $row->umeta_id ?>', '<?php echo $settings_id ?>', '<?php echo $row->sizing_option ?>')">Edit</a></td>
                            <td class="order-date"><a onclick="delete_profile('<?php echo $row->umeta_id ?>')">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
            <?php
        }
    }

    add_shortcode('profile-list', 'display_profile_list');

    add_action('wp_ajax_get_profile_screen', 'get_profile_screen');
    add_action('wp_ajax_nopriv_get_profile_screen', 'get_profile_screen');

    function get_profile_screen() {
        global $wpdb;
        switch ($_REQUEST['profile']) {
            case "custom designed shirt":
                $settings_id = 191;
                break;
            case "designed jacked":
                $settings_id = 193;
                break;
            case "designed blazer":
                $settings_id = 196;
                break;
            case "designed chinos":
                $settings_id = 195;
                break;
            case "designed pant":
                $settings_id = 194;
                break;
            case "designed suit":
                $settings_id = 355;
                break;
        }
        if (empty($settings_id)) {
            $settings_id = $_REQUEST['settings_id'];
        }

        if (!empty($_REQUEST['profile_id'])) {
            $profile_id = $_REQUEST['profile_id'];
            //	echo "select meta_value from ".$wpdb->prefix."usermeta where umeta_id=$profile_id";die();
            $profile_name = $wpdb->get_var("select profile_name from " . $wpdb->prefix . "profile where umeta_id=$profile_id");
            $profile = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "usermeta where umeta_id=$profile_id");
            $b_measurement = unserialize($profile);


            /* print '<pre>';
              print_r($b_measurement);
              print '</pre>'; */
        }

        if ($settings_id == 191) {
            $post_type = 'product-shirt';
        }
        $options = get_field('sizing', $settings_id);
        if ($options) {

            foreach ($options as $option) {

                $x = 0;

                foreach ($option as $key => $opt) {

                    if ($key != "general_settings") {

                        // Every Product Type Array

                        foreach ($opt as $o) {

                            $select_options[sanitize_title($o['shirt/body_name'])] = $o;
                        }
                    } else {

                        if (in_array($post_type, array('product-made-shirt', 'product-shirt'))) {

                            // Shirts General Sizing Array

                            $select_options[sanitize_title($opt[0]['shirt/body_name'])] = $opt[0];
                        }
                    }

                    $x++;
                }
            }
        }
        $values_types = array("centimeters", "inches");

        $selected_value_type = "centimeters";

        if (!empty($selected_values)) {
            $selected_value_type = $selected_values['value-type'];
        }

        foreach ($values_types as $vtype) {

            if ($vtype != $selected_value_type) {

                $unselected_value_type = $vtype;
            }
        }
        ?>
        <div class="measure-wrap" id="thrd_step_wrap">

            <div class="third_step_rap">
                <form id="main-product-form" name="profile" method="post" action="/profile/">
                    <input type="hidden" name="m_product_type" id="m_product_type" value="<?php echo $_REQUEST['profile']; ?>">
                    <input type="hidden" name="settings_id" id="settings_id" value="<?php echo $settings_id; ?>">
                    <input type="hidden" name="_sizing_type" id="_sizing_type"/>

                    <div class="measure-box measure-box-new <?php echo 'product-shirt' ?>-class">

                        <?php
                        if ($settings_id == 355) {
                            $sizing_type = "measure-your-body";
//if ($post_type == 'product-suit')	{ $sizing_type = "measure-your-body";
                            ?>

                            <!--input-->
                                    <!--<input type="hidden" name="sizing[sizing-type]" value="measure-your-body" />-->





                            <div class="measure-box measure-box-new <?php echo $post_type; ?>-class" id="suit" >


                                <?php if ($select_options) { ?>
                                    <!--new-->
                                    <!--new-->


                                    <div class="measure-small-nav sute_third_nav" style="display:block;" >
                                        <a href="#measure-your-jacket" class="btn selected">Jacket</a>
                                        <a href="#measure-your-pants" class="btn">Pants</a>
                                    </div>




                                    <?php foreach ($select_options as $key => $opt) { ?>

                                        <?php
                                        if ($key == 'measure-your-pants') {
                                            $display = "display:none;";
                                        } else {
                                            $display = "display:block;";
                                        }
                                        ?>


                                        <div class="options-container" id="<?php echo $key; ?>" style="<?php echo $display; ?>" >




                                            <div class="measure-options">




                                                <?php if ($key != 'measure-your-pants') { ?>

                                                    <div class="profile-title input-profile input-profile-active left-col" data-info="general" style="margin-top: 48px;">

                                                        <p>General Info</p>

                                                    </div>

                                                <?php } else { ?>
                                                    <div style="width:100%; float:left; clear:both; height:55px;">&nbsp;</div>
                                                <?php } ?>

                                                <?php
                                                $x = 0;

                                                foreach ($opt['shirt/body_name_options'] as $option) {

                                                    $selected_range = explode("-", $option['field_values_' . $selected_value_type]);

                                                    $selected_step = $option['field_values_' . $selected_value_type . '_step'];

                                                    $cm_range = explode("-", $option['field_values_centimeters']);

                                                    $cm_step = $option['field_values_centimeters_step'];

                                                    $in_range = explode("-", $option['field_values_inches']);

                                                    $in_step = $option['field_values_inches_step'];
                                                    ?>

                                                    <div class="input-profile left-col<?php if ($x == 0 && $key == 'measure-your-pants') echo ' input-profile-active'; ?>" data-info="<?php echo sanitize_title($option['field_name']); ?>">

                                                        <label><?php echo $option['field_name']; ?></label>

                                                        <?php
                                                        if (!empty($selected_values)) {
                                                            $selected_value = $selected_values[sanitize_title($option['field_name'])];
                                                        }
                                                        ?>

                                                        <?php
                                                        if (!empty($_REQUEST['profile_id'])) {
                                                            foreach ($b_measurement as $selected_measure_key => $selected_values_measure_option) {
                                                                $measurement_opt = strtolower($option['field_name']);

                                                                if ($measurement_opt == 'arm length') {
                                                                    $measurement_opt = 'arm-length';
                                                                } elseif ($measurement_opt == 'pants length') {
                                                                    $measurement_opt = 'pants-length';
                                                                }

                                                                if ($selected_measure_key == $measurement_opt) {
                                                                    $selected_value = $selected_values_measure_option;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <select name="sizing[<?php echo $sizing_type; ?>][<?php echo sanitize_title($option['field_name']); ?>]" class="selected-values">

                                                            <option value="">Select Size</option>


                                                            <?php
                                                            for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) {
                                                                echo $selected_value;
                                                                ?>

                                                                <option value="<?php echo $i; ?>"<?php if ($selected_value == $i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option>

                                                            <?php } ?>

                                                        </select>

                                                        <select class="replace-values" data-type="centimeters">

                                                            <?php for ($i = $cm_range[0]; $i <= $cm_range[1]; $i = $i + $cm_step) { ?>

                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                            <?php } ?>

                                                        </select>

                                                        <select class="replace-values" data-type="inches">

                                                            <?php for ($i = $in_range[0]; $i <= $in_range[1]; $i = $i + $in_step) { ?>

                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                            <?php } ?>

                                                        </select>

                                                    </div>

                                                    <?php
                                                    $x++;
                                                }
                                                ?>

                                            </div>

                                            <div class="measure-contain measure-contain-body">
                                                <div class="profile-input-wrap">
                                                    <label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information222222222222</h3>
                                                </div>

                                                <?php if ($key != 'measure-your-pants') { ?>

                                                    <!-- general -->

                                                    <div class="profile-wrap field-info" id="general">

                                                        <div class="profile-input-wrap">

                                                            <label for="profile-name" >Name Your Profile</label>

                                                                                                                                                                                                                <!--<input type="text" id="profile-name" name="sizing[<?php echo $sizing_type; ?>][profile-name]" value="<?php echo $measurement['profile-name'] ?>" placeholder="Enter a name for your measurement profile.">-->

                                                            <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php echo $profile_name; ?>" placeholder="Enter a name for your measurement profile." >

                                                        </div>

                                                        <div class="profile-input-wrap">

                                                            <label>Cm/Inches</label>

                                                            <select name="sizing[<?php echo $sizing_type; ?>][value-type]" class="change-values">

                                                                <?php foreach ($values_types as $vtype) { ?>

                                                                    <option value="<?php echo $vtype; ?>"<?php
                                                                    if ($selected_value_type == $vtype) {
                                                                        echo " selected";
                                                                    }
                                                                    ?>><?php echo ucfirst($vtype); ?></option>

                                                                <?php } ?>

                                                            </select>

                                                        </div>

                                                        <?php foreach ($opt['general_options'] as $goption) { ?>

                                                            <div class="profile-input-wrap">

                                                                <label><?php echo $goption['field_value']; ?></label>
                                                                <?php
                                                                $f = strtolower($goption['field_value']);
                                                                ?>
                                                                <select name="sizing[<?php echo $sizing_type; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]" class="general-values">

                                                                    <option value="">Select <?php echo $goption['field_value']; ?></option>

                                                                    <?php //if (!empty($selected_values)) {$f=$goption['field_value'];$selected_value = $selected_values['general'][$f];}
                                                                    ?>

                                                                    <?php foreach ($goption['field_options'] as $gopt) { ?>

                                                                        <option value='<?php echo $gopt['option_name']; ?>' <?php if ($b_measurement['general'][$f] == $gopt['option_name']) { ?>selected="selected"<?php } ?>><?php echo $gopt['option_name']; ?></option>

                                                                    <?php } ?>

                                                                </select>

                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                <?php } ?>

                                                <?php
                                                $x = 0;
                                                foreach ($opt['shirt/body_name_options'] as $option) {
                                                    ?>

                                                    <div class="profile-wrap2 field-info" id="<?php echo sanitize_title($option['field_name']); ?>"<?php if ($x == 0 && $key == 'measure-your-pants') echo ' style="display: block;"'; ?>>

                                                        <div class="profile-wrap-details">

                                                            <h2><?php echo $option['field_name']; ?></h2>

                                                            <p><?php echo $option['field_description']; ?></p>

                                                        </div>

                                                        <div class="profile-wrap-image">

                                                            <?php
                                                            $image = $option['field_image'];
                                                            $link = $image['sizes']['sizing-info'];
                                                            ?>

                                                            <img src="<?php echo $link; ?>" alt="<?php echo $option['field_name']; ?> image">

                                                        </div>

                                                    </div>

                                                    <?php
                                                    $x++;
                                                }
                                                ?>

                                            </div>

                                        </div>

                                    <?php } ?>

                                <?php } ?>

                            </div>
                        </div>
                </div>
                <div class="create-profile-mabtn">
                    <input type="button" value="Exit" class="btn myaccount-create-profile" id="btn_exit" onclick="window.location = '<?php echo bloginfo('url') ?>/my-accounts/?#tab-1414392411-2-26'">
                    <input type="button" value="Save" class="btn myaccount-create-profile" onclick="save_my_profile();">

                </div>

                <?php
                die();
            }
            if ($select_options) {
                ?>

                <?php if (in_array($post_type, array('product-made-shirt', 'product-shirt'))) { ?>

                    <div class="sizing-options" >

                        <h2>Sizing Options</h2>

                        <p>You have the choice to provide measurements from your body, measurements from a well fitting shirt, or you can select from standard sizes.</p>

                        <?php foreach ($select_options as $key => $type) { ?>

                            <?php
                            if (!empty($selected_values)) {
                                $selected_value = $selected_values['sizing-type'];
                            } {


                                if (!empty($type))
                                /* if($_REQUEST['profile']=='custom designed shirt')
                                  { */

                                    ?>

                                <div class="select-sizing-option" data-sizing-option="<?php echo $key; ?>" id="siz-optiollk">

                                    <h3><?php echo $type['shirt/body_name']; ?></h3>

                                    <?php if ($key == 'measure-your-body') { ?>

                                        <p>Use our simple step-by-step guide to measure your body.</p>

                                    <?php } elseif ($key == 'measure-your-shirt') { ?>

                                        <p>Use our simple step-by-step guide to measure an existing shirt you own.</p>

                                    <?php } elseif ($key == 'standard-sizing') { ?>

                                        <p>No measurements required. Select from our standard sizes.</p>

                                    <?php } ?>

                                                                                                                                                                                                        <!--<span><img src="<?php //bloginfo('template_url');      ?>/images/box-arrow.png" alt="<?php //echo $type['shirt/body_name'];      ?> arrow" /></span>-->

                                </div>

                                <?php
                            }
                        }
                        ?>

                    </div>

                    <?php
                }
                //}
                ?>

                <?php foreach ($select_options as $key => $opt) { //echo $key;  ?>

                    <?php
                    /* if ( is_user_logged_in() ) { ?>
                      <div class="options-container" id="<?php echo $key; ?>">
                      <?php
                      }
                      else
                      {
                      if($post_type=='product-shirt')
                      {
                      ?>
                      <div class="options-container" <?php if($key=='measure-your-body') { echo  'style=display:block'; } ?>>
                      <?php
                      }
                      } */
                    ?>

                    <?php
                    //if ($key != "standard-sizing")	{

                    if ($settings_id != 191) {
                        $display = "display:block;";
                        /* }
                          else
                          {
                          $display="display:block;";
                          } */
                        ?>


                        <div class="options-container" id="measure-your-body" style="<?php echo $display; ?>">
                        <?php } else { ?>

                            <div class="options-container for_shirtdiv" id="<?php echo $key; ?>">
                            <?php } ?>

                            <?php if ($key != "standard-sizing") { ?>

                                <div class="measure-options" >

                                    <div class="profile-title input-profile input-profile-active left-col" data-info="general-<?php echo $key; ?>">

                                        <p>General Info</p>

                                    </div>

                                    <?php
                                    foreach ($opt['shirt/body_name_options'] as $option) {

                                        $selected_range = explode("-", $option['field_values_' . $selected_value_type]);

                                        $selected_step = $option['field_values_' . $selected_value_type . '_step'];

                                        $cm_range = explode("-", $option['field_values_centimeters']);

                                        $cm_step = $option['field_values_centimeters_step'];

                                        $in_range = explode("-", $option['field_values_inches']);

                                        $in_step = $option['field_values_inches_step'];

                                        $option_name = sanitize_title($option['field_name']);

                                        if ($option_name == "arm-length-short" && $_SESSION['cart']['items'][$cart_key]['design']['cuff'] != "Short Sleeve") {

                                            $display = 'style="display: none;"';
                                        } elseif ($option_name == "arm-length" && $_SESSION['cart']['items'][$cart_key]['design']['cuff'] == "Short Sleeve") {

                                            $display = 'style="display: none;"';
                                        } else {

                                            $display = '';
                                        }
                                        ?>

                                        <div class="input-profile left-col <?php echo "container-" . $option_name; ?>" data-info="<?php echo $option_name . "-" . $key; ?>" <?php echo $display; ?> id="profile_data">

                                            <label><?php echo str_replace(" (Short)", "", $option['field_name']); ?></label>

                                            <?php
                                            $measurement_index = strtolower(str_replace(" ", "-", $option['field_name']));

                                            //echo $b_measurement[$measurement_index];

                                            if (is_user_logged_in()) {
                                                ?>
                                                <select name="sizing[<?php echo $key; ?>][<?php echo $option_name; ?>]" class="selected-values">

                                                    <option value="">Select Size</option>

                                                    <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>

                                                        <option value="<?php echo $i; ?>"<?php
                                                        if ($b_measurement[$measurement_index] == $i) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $i; ?></option>

                                                    <?php } ?>

                                                </select>
                                                <?php ?>
                                                <select class="replace-values" data-type="centimeters">

                                                    <option value="">Select Size</option>

                                                    <?php for ($i = $cm_range[0]; $i <= $cm_range[1]; $i = $i + $cm_step) { ?>

                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                    <?php } ?>

                                                </select>

                                                <select class="replace-values" data-type="inches">

                                                    <option value="">Select Size</option>

                                                    <?php for ($i = $in_range[0]; $i <= $in_range[1]; $i = $i + $in_step) { ?>

                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                    <?php } ?>

                                                </select><?php
                                            }
                                            ?>
                                        </div>

                                    <?php } ?>

                                </div>

                                <div class="measure-contain measure-contain-body">
                                    <div class="profile-input-wrap">
                                        <label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information</h3>
                                    </div>
                                    <!-- general -->
                                    <div class="profile-wrap field-info" id="general-<?php echo $key; ?>">
                                        <?php ?>                                         
                                        <div class="profile-input-wrap">
                                            <label for="profile-name" class="big-label">Name Your Profile</label>
                                            <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php echo $profile_name; ?>" placeholder="Enter a name for your measurement profile." />
                                        </div>
                                        <div class="profile-input-wrap">
                                            <label>Cm/Inches</label>
                                            <select name="sizing[<?php echo $key; ?>][value-type]" class="change-values">
                                                <?php if ($values_type != null) { ?>
                                                    <option value="<?php echo $values_type; ?>"><?php echo ucfirst($values_type); ?></option>
                                                    <option value="inches">Inches</option>
                                                    <option value="">Do you want to measure in Centemeters or Inches?</option>
                                                <?php } else { ?>
                                                    <option value="">Do you want to measure in Centemeters or Inches?</option>
                                                    <?php foreach ($values_types as $vtype) { ?>
                                                        <option value="<?php echo $vtype; ?>"<?php if ($vtype == $b_measurement['value-type']) { ?>selected="selected"<?php } ?>><?php echo ucfirst($vtype); ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!---------------------------------------------------------->

                                        <?php foreach ($opt['general_options'] as $goption) { ?>
                                            <div class="profile-input-wrap">
                                                <label><?php echo $goption['field_value']; ?></label>
                                                <?php
                                                $field = trim(strtolower($goption['field_value']));
                                                ?>
                                                <select name="sizing[<?php echo $key; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]" class="general-values">
                                                    <?php
                                                    if (sanitize_title($goption['field_value']) == 'height') {
                                                        echo '<option value="">What is your Height?</option>';
                                                    } else if (sanitize_title($goption['field_value']) == 'weight') {
                                                        echo '<option value="">What is your Weight?</option>';
                                                    } else if (sanitize_title($goption['field_value']) == 'build') {
                                                        echo '<option value="">What best describes your build?</option>';
                                                    } else if (sanitize_title($goption['field_value']) == 'fit') {
                                                        echo '<option value="">How do you want your shirt to fit?</option>';
                                                    }
                                                    ?>

                                                    <?php
                                                    if (!empty($selected_values)) {
                                                        $selected_value = stripslashes($selected_values['general'][sanitize_title($goption['field_value'])]);
                                                    }
                                                    ?>

                                                    <?php
                                                    if (!empty($selected_values)) {
                                                        $selected_value = $selected_values[$option_name];
                                                    }
                                                    ?>

                                                    <?php
                                                    foreach ($goption['field_options'] as $gopt) {
                                                        if ($field == "height" || $field == "weight") {
                                                            if ($settings_id == 194) {
                                                                $val = substr($gopt['option_name'], 0, -2);
                                                            } else {
                                                                $val = $gopt['option_name'];
                                                            }
                                                        } else {
                                                            $val = $gopt['option_name'];
                                                        }
                                                        //echo $field.'|||'.$b_measurement['general']['build'].'||'.$gopt['option_name'];
                                                        ?>
                                                        <option value='<?php echo $gopt['option_name']; ?>' <?php if ($b_measurement['general'][$field] == $val) { ?> selected="selected" <?php } ?>><?php echo $gopt['option_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php
                                        }
                                        //}
                                        ?>

                                        <!---------------------------------------------------------->
                                    </div>

                                    <?php foreach ($opt['shirt/body_name_options'] as $option) {
                                       
                                        
                                        ?>

                                        <div class="profile-wrap2 field-info" id="<?php echo sanitize_title($option['field_name']) . "-" . $key; ?>">

                                            <div class="profile-wrap-details">

                                                <h2><?php echo $option['field_name']; ?></h2>

                                                <p><?php echo $option['field_description']; ?></p>

                                            </div>

                                            <div class="profile-wrap-image">

                                                <?php
                                                $image = $option['field_image'];
                                                $link = $image['sizes']['sizing-info'];
                                                ?>

                                                <?php if ($image) { ?>

                                                    <img src="<?php echo $link; ?>" alt="<?php echo $option['field_name']; ?> image">

                                                <?php } ?>

                                            </div>

                                        </div>

                                    <?php } ?>

                                </div>

                            <?php } else { // Change The design for Standard Sizing    ?>

                                <div class="row-fluid">

                                    <div class="span12">

                                        <div class="standard-sizing">

                                            <div id="what-s-my-size">

                                                <div class="container-wms">

                                                    <h2 class="wms_tab">Finding Measurements</h2>

                                                    <div class="wms_box">

                                                        <?php foreach ($opt['whats_my_size'] as $wms) { ?>

                                                            <div class="wms_cell span3">

                                                                <p class="bold"><?php echo $wms['box_title'] ?></p>

                                                                <img src="<?php echo $wms['box_image']['url']; ?>" />

                                                                <p><?php echo $wms['box_description']; ?></p>

                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                            </div>

                                            <h1><?php echo $opt['shirt/body_name'] ?></h1>

                                            <div class="standard-profile-wrap">

                                                <label>Profile Name</label>
                                                <?php
                                                $profile_name = $selected_values['profile-name'];
                                                ?>
                                                <input type="text" name="sizing[<?php echo $key; ?>][profile-name]" id="profile-name" value="<?php
                                                if ($profile_name != null) {
                                                    echo $profile_name;
                                                }
                                                ?>"/>

                                            </div>

                                            <div class="standard-size-wrap">

                                                <input type="radio" id="standard-cm" value="centimeters" name="sizing[<?php echo $key; ?>][value-type]" class="change-neck-values" <?php
                                                if ($selected_value_type == "centimeters") {
                                                    echo 'checked="checked"';
                                                }
                                                ?> />

                                                <label for="standard-cm" style="margin-right:15px;">Centimetres</label>

                                                <input type="radio" id="standard-in" value="inches" name="sizing[<?php echo $key; ?>][value-type]" class="change-neck-values" <?php
                                                if ($selected_value_type == "inches") {
                                                    echo 'checked="checked"';
                                                }
                                                ?> />

                                                <label for="standard-in">Inches</label>

                                                <a href="#what-s-my-size" class="fancybox">What's My Size</a>

                                            </div>

                                            <div class="standard-neck-sleeve">

                                                <div class="standard-neck">

                                                    <label>Neck</label>

                                                    <select name="sizing[<?php echo $key; ?>][neck]" class="standard-neck-values">

                                                        <option value="">--</option>

                                                        <?php
                                                        if (!empty($selected_values)) {
                                                            $selected_value_neck = $selected_values['neck'];
                                                        }
                                                        ?>

                                                        <?php foreach ($opt[$selected_value_type] as $value) { ?>

                                                            <?php
                                                            // Save Sleeve Interval for Edit/Similar Product

                                                            if ($selected_value_neck == $value['neck_value']) {
                                                                $sleeve_intervals = $value['sleeve_intervals'];
                                                            }
                                                            ?>

                                                            <option value="<?php echo $value['neck_value']; ?>" data-alt="<?php echo $value['sleeve_intervals'] ?>"<?php echo_selected($selected_value_neck, $value['neck_value']); ?>><?php echo $value['neck_value']; ?></option>

                                                        <?php } ?>

                                                    </select>

                                                    <select class="unselected-neck-values" data-type="centimeters">

                                                        <option value="">--</option>

                                                        <?php foreach ($opt["centimeters"] as $value) { ?>

                                                            <option value="<?php echo $value['neck_value']; ?>" data-alt="<?php echo $value['sleeve_intervals'] ?>"><?php echo $value['neck_value']; ?></option>

                                                        <?php } ?>

                                                    </select>

                                                    <select class="unselected-neck-values" data-type="inches">

                                                        <option value="">--</option>

                                                        <?php foreach ($opt["inches"] as $value) { ?>

                                                            <option value="<?php echo $value['neck_value']; ?>" data-alt="<?php echo $value['sleeve_intervals'] ?>"><?php echo $value['neck_value']; ?></option>

                                                        <?php } ?>

                                                    </select>

                                                </div>

                                                <div class="standard-sleeve">

                                                    <label >Sleeve</label>

                                                    <select name="sizing[<?php echo $key; ?>][sleeve]" class="standard-sleeve-values">

                                                        <?php
                                                        if (isset($selected_value_neck)) { // Unfold Sleeve Interval Options for Edit/Similar Product
                                                            $sleeve_values = explode(",", $sleeve_intervals);

                                                            if (!empty($selected_values)) {
                                                                $selected_value_sleeve = $selected_values['sleeve'];
                                                            }

                                                            if ($selected_value_type == "centimeters") {

                                                                $step = 1;
                                                            } else {

                                                                $step = 0.5;
                                                            }

                                                            $sleeve0 = (int) $sleeve_values[0];

                                                            $sleeve1 = (int) $sleeve_values[1];

                                                            $sleeve2 = (int) $sleeve_values[2];

                                                            $sleeve3 = (int) $sleeve_values[3];



                                                            echo '<optgroup label="Standard sleeve lengths">';

                                                            $x = 0;

                                                            while ($sleeve0 <= $sleeve1) {

                                                                $standard_interval[$x] = $sleeve0;

                                                                echo '<option value="' . $sleeve0 . '"' . echo_selected($selected_value_sleeve, $sleeve0) . '>' . $sleeve0 . '</option>';

                                                                $sleeve0 = $sleeve0 + $step;

                                                                $x++;
                                                            }

                                                            echo '</optgroup>';



                                                            echo '<optgroup label="Special sleeve lengths">';

                                                            while ($sleeve2 <= $sleeve3) {

                                                                if (!in_array($sleeve2, $standard_interval)) {

                                                                    echo '<option value="' . $sleeve2 . '"' . echo_selected($selected_value_sleeve, $sleeve2) . '>' . $sleeve2 . '</option>';
                                                                }

                                                                $sleeve2 = $sleeve2 + $step;
                                                            }

                                                            echo '</optgroup>';
                                                        } else { // Sleeve Intervals populate through javascript on Neck change
                                                            ?>

                                                            <option value="">--</option>

                                                        <?php } ?>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="standard-info">
                                            <!------------------------------------------------------------------>
                                            <h2>Additional Information</h2>

                                            <div class="standard-info-height">

                                                <?php
                                                //    echo '<pre>';
                                                //print_r($opt);
                                                //echo '</pre>';
                                                ?>
                                                <div class="profile-input-wrap">
                                                    <?php foreach ($opt['general_options'] as $goption) { ?>

                                                        <div class="standard-height" style="width: 24%;">
                                                            <label style="width: auto;"><?php echo $goption['field_value']; ?></label>
                                                            <select name="sizing[<?php echo $key; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]" class="general-values standard-input">
                                                                <?php
                                                                if (sanitize_title($goption['field_value']) == 'height') {
                                                                    echo '<option value="">What is your Height?</option>';
                                                                } else if (sanitize_title($goption['field_value']) == 'weight') {
                                                                    echo '<option value="">What is your Weight?</option>';
                                                                }
                                                                ?>

                                                                <?php
                                                                if (!empty($selected_values)) {
                                                                    $selected_value = stripslashes($selected_values['general'][sanitize_title($goption['field_value'])]);
                                                                }
                                                                ?>
                                                                <?php foreach ($goption['field_options'] as $gopt) { ?>
                                                                    <option value='<?php echo $gopt['option_name']; ?>'<?php echo_selected($selected_value, $gopt['option_name']); ?>><?php echo $gopt['option_name']; ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>

                                                    <?php } ?>
                                                </div>
                                                <!------------------------------------------------------------------------>

                                            </div>

                                            <div class="standard-info-fit">

                                                <div id="standard-fit">

                                                    <div class="sfit">

                                                        <?php foreach ($opt['fit_values'] as $fit) { ?>

                                                            <div class="sfit-row" data-value="<?php echo $fit['fit_value']; ?>">

                                                                <img src="<?php echo $fit['fit_image']['url']; ?>" />

                                                                <div class="sfit-text">

                                                                    <p class="bold red-fit"><?php echo $fit['fit_value']; ?></p>

                                                                    <p><?php echo $fit['fit_description']; ?></p>

                                                                </div>

                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <label>Fit</label>

                                                <select name="sizing[<?php echo $key; ?>][fit]" class="standard-fit">

                                                    <?php
                                                    if (!empty($selected_values)) {
                                                        $selected_value = $selected_values['fit'];
                                                    }
                                                    ?>

                                                    <?php foreach ($opt['fit_values'] as $fit) { ?>

                                                        <option value="<?php echo $fit['fit_value']; ?>"<?php echo_selected($selected_value, $fit['fit_value']); ?>><?php echo $fit['fit_value']; ?></option>

                                                    <?php } ?>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    <?php } ?>

                <?php } ?>

            </div>
        </div>
    </div>

    <div class="create-profile-mabtn">
        <input type="button" value="Exit" class="btn myaccount-create-profile" id="btn_exit" onclick="window.location = 'http://jcoutier.com/my-accounts/?#tab-1414392411-2-26'">
        <input type="button" value="Save" class="btn myaccount-create-profile" onclick="save_my_profile();">

    </div>

    </form>
    <?php
    die();
}

function save_my_profile() {

    global $wpdb, $woocommerce;
    if (is_user_logged_in()) {
        /* print '<pre>';
          print_r($_REQUEST);
          print '</pre>';die(); */
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;


        if ($_REQUEST['settings_id'] != 191) {
            $measurement = $_REQUEST['sizing']['measure-your-body'];

            if ($_REQUEST['settings_id'] == 355) {
                $profile_name = $_REQUEST['sizing']['measure-your-jacket']['profile-name'];
            } else {
                $profile_name = $_REQUEST['sizing']['measure-your-body']['profile-name'];
            }
        } else {
            $type = $_REQUEST['_sizing_type'];
            $measurement = $_REQUEST['sizing'][$type];
            $profile_name = $_REQUEST['sizing'][$type]['profile-name'];
        }

        $u_profile = get_user_meta($user_id, $profile_name, true);



        $product_type = $_REQUEST['m_product_type'];
        $meta_id = update_user_meta($user_id, $profile_name, $measurement, false);

        if ($_REQUEST['settings_id'] != 191) {
            $sizing_option = 'measure-your-body';
        } else {
            $sizing_option = $_REQUEST['_sizing_type'];
        }


        if (!$u_profile) {

            $wpdb->insert($wpdb->prefix . 'profile', array(
                'umeta_id' => $meta_id,
                'user_id' => $user_id,
                'profile_name' => $profile_name,
                'product_type' => $product_type,
                'sizing_option' => $sizing_option,
                'create_date' => date_i18n('M d,Y')
                    ), array(
                '%d',
                '%d',
                '%s',
                '%s',
                '%s',
                '%s'
                    )
            );
        }
    }
    header("location:/my-accounts/?#tab-1414392411-2-26");
}

add_shortcode('save-user-profile', 'save_my_profile');

add_action('wp_ajax_delete_myaccount_profile', 'delete_myaccount_profile');
add_action('wp_ajax_nopriv_delete_myaccount_profile', 'delete_myaccount_profile');

function delete_myaccount_profile() {
    global $wpdb;
    $profile_id = $_REQUEST['profile_id'];

    $wpdb->query("delete from wp_profile where umeta_id=$profile_id");

    die();
}

if (class_exists('MultiPostThumbnails')) {

    new MultiPostThumbnails(array(
        'label' => 'Product Specific Image',
        'id' => 'secondary-image',
        'post_type' => 'Product'
    ));
}

function my_plugin_add_meta_box() {

    $screens = array('shop_order');

    foreach ($screens as $screen) {

        add_meta_box(
                'custom-design-metabox', __('Custom Design Option', 'my_plugin_textdomain'), 'custom_designed_options_list', $screen
        );
    }
}

add_action('add_meta_boxes', 'my_plugin_add_meta_box');

function custom_designed_options_list($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('myplugin_meta_box', 'myplugin_meta_box_nonce');

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta($post->ID, '_customized_product', true);


    $design_options = @unserialize(get_post_meta($post->ID, 'design', true));
    $extra_options = @unserialize(get_post_meta($post->ID, 'extras', true));
    $measure_body = @unserialize(get_post_meta($post->ID, 'measure_your_body', true));
    $measure_shirt = @unserialize(get_post_meta($post->ID, 'measure_your_shirt', true));
    $standard_sizing = @unserialize(get_post_meta($post->ID, 'standard_sizing', true));
    print_r($design_options);
    ?>
    <style type="text/css">
        .tuytu{ width:750px; border:1px solid #CCC; padding:20px; margin:0 auto;  overflow: hidden;}
        .row_fuldiv{ width:100%; float:left; clear:both; margin:15px 0;}
        .row_fuldiv h2{ font-size:22px; color:#000; font-weight:600; padding:0; margin:0 0 15px 0;}
        .row_fuldiv ul{ margin:0; padding:3%; width:94%; float:left; background:#EAEAEA;}
        .row_fuldiv ul li{ list-style-type:none; float:left; position:relative; width:100%;   border-left:1px solid #A8A8A8; border-bottom:1px solid #A8A8A8; border-right:1px solid #A8A8A8; font:13px Arial, Helvetica, sans-serif; color:#000;}
        .row_fuldiv ul li:first-child{border-top:1px solid #A8A8A8; }
        .row_fuldiv ul li span.lft{ width:40%; padding:2%; float: left;  font-size:16px; font-weight:600;}
        .row_fuldiv ul li span.rit{ width:51.8%; padding:2%; float: left; background: #F4F4F4; border-left:1px solid #A8A8A8;}
        .row_fuldiv ul li span.rit p{border-top:1px solid #A8A8A8; padding:4px; margin:0;}
        .row_fuldiv ul li span.rit p:first-child{ border-top:none;}


    </style>
    <div class="tuytu">

        <?php if (!empty($design_options)) { ?>
            <div class="row_fuldiv">
                <h2>Design</h2>
                <ul>
                    <?php foreach ($design_options as $key => $value) { ?>
                        <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>


        <?php if (!empty($extra_options)) { ?>
            <div class="row_fuldiv">
                <h2>Extras</h2>
                <ul>
                    <?php
                    foreach ($extra_options as $key => $value) {
                        $extra_options_val = explode("-", $value);
                        ?>
                        <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $extra_options_val[0]; ?></p> </span></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php if (!empty($measure_shirt)) { ?>
            <div class="row_fuldiv">
                <h2>Measure Shirt</h2>
                <ul>
                    <?php
                    foreach ($measure_shirt as $key => $value) {
                        //$extra_options_val=explode("-",$value);
                        ?>
                        <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>


        <?php if (!empty($measure_body)) { ?>
            <div class="row_fuldiv">
                <h2>Measure Body</h2>
                <ul>
                    <?php
                    foreach ($measure_body as $key => $value) {
                        //$extra_options_val=explode("-",$value);
                        ?>
                        <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php if (!empty($standard_sizing)) { ?>
            <div class="row_fuldiv">
                <h2>Standard Sizing</h2>
                <ul>
                    <?php
                    foreach ($standard_sizing as $key => $value) {
                        //$extra_options_val=explode("-",$value);
                        ?>
                        <li><span class="lft"><?php echo $key; ?></span> <span class="rit"><p><?php echo $value; ?></p> </span></li>
                                <?php } ?>
                </ul>
            </div>
        <?php } ?>

    </div>
    <?php
}

add_action('woocommerce_before_calculate_totals', 'change_cart_item_price');

function change_cart_item_price($cart_object) {
    if ($_REQUEST['update_cart'] == 'Update Cart') {
        global $woocommerce;
        foreach ($cart_object->cart_contents as $key => $value) {
            $terms = get_the_terms($value['product_id'], 'product_cat');
            $product_in_cart[] = array('product_id' => $value['product_id'], 'key' => $key, 'quantity' => $value['quantity'],
                'cat' => $terms[0]->term_id);
        }
        /* print '<pre>';
          print_r($product_in_cart);
          die(); */

        for ($i = 0; $i < count($product_in_cart); $i++) {
            if ($product_in_cart[$i]['cat'] == 73) {
                if ($product_in_cart[$i]['quantity'] > 0) {
                    $shirt_qty = $product_in_cart[$i]['quantity'];
                } else {
                    $shirt_qty = 0;
                }
            }
            if ($product_in_cart[$i]['cat'] == 78) {
                if ($product_in_cart[$i]['quantity'] > 0) {
                    $suit_qty = $product_in_cart[$i]['quantity'];
                } else {
                    $suit_qty = 0;
                }
            }



            if ($product_in_cart[$i]['product_id'] == '57663') {
                $woocommerce->cart->set_quantity($product_in_cart[$i]['key'], $suit_qty, true);
            }
            /*if ($product_in_cart[$i]['product_id'] == '57664') {
                $woocommerce->cart->set_quantity($product_in_cart[$i]['key'], $shirt_qty, true);
            }*/
        }
    }
}

add_filter('views_edit-product', 'wpse_add_my_view');

function wpse_add_my_view($views) {
    global $post_type_object;
    $post_type = $post_type_object->name;


    $views['today'] = "<a href='edit.php?design_type=cp&post_type=$post_type'>" . __('Fornt-end product', 'myplugin') . "</a>";
    $views['today'] .= " | <a href='edit.php?design_type=cp&post_type=$post_type&author=1'>" . __('Product by Admin', 'myplugin') . "</a>";
    $views['today'] .= " | <a href='edit.php?design_type=cp&post_type=$post_type&author=0'>" . __('Product not by Admin', 'myplugin') . "</a>";

    return $views;
}

add_filter('parse_query', 'order_posts_filter');

function order_posts_filter($query) {
    global $pagenow, $wpdb;
    $type = 'product';
    if(isset($_GET['post_type']))
        if ($_GET['post_type'] == 'product' && $_GET['design_type'] == 'cp') {
            $query->query_vars['meta_key'] = 'fornt_end_product';
            $query->query_vars['meta_value'] = 'yes';
        }
    return $query;
}

add_action('pre_get_posts', 'custom_pre_get_posts_query');

function custom_pre_get_posts_query($q) {
    if (is_admin()) {
        if(isset($_GET['author'])){
            if (0 == $_GET['author']) {
                $q->set('author__not_in', array(1));
            } else {
                $q->set('author__in', array(1));
            }
        }
    }
    if (!$q->is_main_query())
        return;
    if (!$q->is_post_type_archive())
        return;

    if (!is_admin() && is_shop()) {
        $q->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array('custom designed shirt', 'designed blazer', 'designed chinos', 'designed jacked', 'designed pant', 'designed suit'), // Don't display products in the knives category on the shop page
                'operator' => 'NOT IN'
        )));
    }

    remove_action('pre_get_posts', 'custom_pre_get_posts_query');
}

add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);



/// remove tab reviews in product detail.
//add_filter('woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98);

//function wcs_woo_remove_reviews_tab($tabs) {
//    unset($tabs['description']);
//    unset($tabs['reviews']);
//    return $tabs;
//}


function woocommerce_product_detail_tabs($custom_post_id){
    ?>
        <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li class="delivery_tab active">
                            <a href="#tab-delivery">Delivery</a>
                        </li>
                        <li class="fit_guarantee_tab">
                            <a href="#tab-fit_guarantee">Fit Guarantee</a>
                        </li>
                        <li class="photo_details_tab">
                            <a href="#tab-photo_details">Photo Details</a>
                        </li>
                    </ul>

                    <div class="panel entry-content" id="tab-delivery" style="display: block;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <div class="width-65 left">
                                    <?php echo get_field('delivery', $custom_post_id) ; ?>
                                </div>
                                <div class="width-30 right">
                                    <?php $delivery_image = get_field('delivery_image', $custom_post_id); ?>
                                    <?php if(!empty($delivery_image)): ?>
                                        <img src="<?php echo $delivery_image["url"]; ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel entry-content" id="tab-fit_guarantee" style="display: none;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <div class="width-65 left">
                                    <?php echo get_field('fit_guarantee', $custom_post_id) ; ?>
                                </div>
                                <div class="width-30 right">
                                <?php $fit_guarantee_gif = get_field('fit_guarantee_gif', $custom_post_id); ?>
                                    <?php if(!empty($fit_guarantee_gif)): ?>
                                        <img src="<?php echo $fit_guarantee_gif['url']; ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel entry-content" id="tab-photo_details" style="display: none;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <div class="width-65 left">
                                    <?php echo get_field('photo_details', $custom_post_id) ; ?>
                                </div>
                                <div class="width-30 right">
                                    <?php $photo_details_image = get_field('photo_details_image', $custom_post_id) ?>
                                    <?php if(!empty($photo_details_image)): ?>
                                        <img src="<?php echo $photo_details_image["url"]; ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php

}

/**
 * Ajax process filter product.
 *
 * @author Carl Pham <vanca.vnn@gmail.com>
 * @return void
 */
function submitFilter() {
    if (check_ajax_referer('submit-filter-ajax-none', 'security')) {
        $q = '?q=filter';
        $qf = array();
        if(!empty($_POST['color'])) {
            $qf['color'] = trim(implode(',', $_POST['color']), ',');
        }
        if(!empty($_POST['weight'])) {
            $qf['weight'] = trim(implode(',', $_POST['weight']), ',');
        }
        if(!empty($_POST['pattern'])) {
            $qf['pattern'] = trim(implode(',', $_POST['pattern']), ',');
        }
        if(!empty($_POST['price'])) {
            $qf['price'] = trim(implode(',', $_POST['price']), ',');
        }
        foreach ($qf as $k => $v) {
            $q .= '&'.$k.'='.$v;
        }
        // $url = 'http://jcoutier.devenv.amlocal:8080/product-category/chinos/'.$q;
        $url = $_POST['current_url'].$q;
        echo $url;die;
    }

    echo false;
    die();
}
add_action( 'wp_ajax_submitFilter', 'submitFilter');
add_action( 'wp_ajax_nopriv_submitFilter', 'submitFilter');

/**
 * CSS overflow popup in admin
 *
 * @author Carl Pham <vanca.vnn@gmail.com>
 */
function custom_css() {
    echo '<style type="text/css">
        #TB_window{overflow: auto;}
        #TB_ajaxContent table {width: 100%;}
        #TB_ajaxContent th, #TB_ajaxContent td {
            border: 1px solid black;
        }
        #TB_ajaxContent td {
            
        }
        #TB_ajaxContent {width: auto !important; height: auto !important;}
        .ship-method .col-center {border-left:none !important;border-right:none !important;}
    </style>';
}
add_action('admin_head', 'custom_css');

/**
 * JS Print
 *
 * @author Carl Pham <vanca.vnn@gmail.com>
 */
add_action('in_admin_footer', 'foot_monger');
function foot_monger () { ?>
    <script type='text/javascript'>
    function printOrderForm(id) {
        var content = jQuery('#modal-window-id-'+id).html();
        var w = window.open();
        var str = '<html><head>';
        // str += '<title>Copy Printed</title>';
        str += '<style type="text/css">#content table {width: 100%;}#content th, #content td {border: 1px solid black;}#content td {border-top: none;}#content {width: auto !important; height: auto !important;}.ship-method .col-center {border-left:none !important;border-right:none !important;}</style>';
        str += '</head><body>';
        // str += '<h1>Copy Printed</h1><hr />';
        str += '<div id="content">'+content+'</div>';
        str += '</body></html>';
        w.document.write(str);
        w.window.print();
        w.document.close();
        return false;
    }
    </script>
<?php
}

/**
 * Rewrite rule page view detail order in page 'my-accounts'
 *
 * @author Carl Pham <vanca.vnn@gmail.com>
 */
function add_rewrite_rules($aRules) {
    $aNewRules = array('my-accounts/([^/]+)/?$' => 'index.php?pagename=my-accounts&view-order=$matches[1]');
    $aRules = $aNewRules + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules');

function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
  woocommerce_wp_text_input( 
    array( 
        'id'          => 'fabric_code', 
        'label'       => __( 'Fabric Code', 'woocommerce' ), 
        'placeholder' => '',
        'desc_tip'    => 'true',
        'description' => __( 'Enter the fabric code here.', 'woocommerce' ) 
    )
    );
  
  echo '</div>';
    
}
// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

function woo_add_custom_general_fields_save( $post_id ){
    $woocommerce_text_field = $_POST['fabric_code'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, 'fabric_code', esc_attr( $woocommerce_text_field ) );
}
// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function reset_pass_url() {
    $siteURL = get_option('siteurl');
    return "{$siteURL}/my-account/lost-password/";
}
add_filter( 'lostpassword_url',  'reset_pass_url', 11, 0 );

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Shop Widgets ', 'theme-slug' ),
        'id' => 'shop_widgets',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}

//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ), 99 );

/* Remove the WordPress version*/
remove_action ( 'wp_head', 'wp_generator');
?>