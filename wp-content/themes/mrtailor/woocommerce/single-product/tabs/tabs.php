<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
global $post;

function woo_rename_tabs() {

//            $tabs['description']['title'] = __('More Information');  // Rename the description tab
//            $tabs['reviews']['title'] = __('Ratings');    // Rename the reviews tab
//            $tabs['additional_information']['title'] = __('Product Data'); // Rename the additional information tab
    // Rename the additional information tab
    $tabs['delivery'] = array(
        'title'     => __('Delivery'),
        'priority'  => 1,
        'callback'  =>get_field('delivery', $post->ID),
        'image'     =>get_field('delivery_image', $post->ID)
    );
    
    $tabs['fit_guarantee'] = array(
        'title'     => __('Fit Guarantee'),
        'priority'  => 2,
        'callback'  =>get_field('fit_guarantee', $post->ID),
        'image'     =>get_field('fit_guarantee_gif', $post->ID)
    );
    
    $tabs['photo_details'] = array(
        'title'     => __('Photo Details'),
        'priority'  => 3,
        'callback'  =>get_field('photo_details', $post->ID),
        'image'     =>get_field('photo_details_image', $post->ID)
    ); // Rename the additional information tab

    return $tabs;
}

$tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($tabs)) :
    ?>

    <div class="woocommerce-tabs">
        <ul class="tabs">
            <?php foreach ($tabs as $key => $tab) : ?>
                <?php if ($key != 'description' && $key != 'reviews' && $key != 'additional_information'): ?>
                    <li class="<?php echo $key ?>_tab">
                        <a href="#tab-<?php echo $key ?>"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key) ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php foreach ($tabs as $key => $tab) : ?>
            <?php if ($key != 'description' && $key != 'reviews' && $key != 'additional_information'): ?>
                <div class="panel entry-content" id="tab-<?php echo $key ?>">
                    <div class="row">
                        <div class="large-10 large-centered columns">
                            <div class="width-65 left">
                                <?php echo $tab['callback'] ; ?>  
                                <?php // call_user_func($tab['callback'], $key, $tab) ?>
                            </div>
                            <div class="width-30 right">
                                <?php if(!empty($tab['image'])): ?>
                                    <img src="<?php echo $tab['image']['url'] ?>" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

<?php endif; ?>