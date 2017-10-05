<?php
global $fabricContrasting_id, $product_id, $post_type, $settings_id, $material_id, $meta_box_prefix, $cart_key;


$post = get_post($post->ID);

setup_postdata($post);

if ($_GET['similar'] != NULL) {

    $cart_key = $_GET['similar'];
} elseif ($_GET['edit'] != NULL) {
    $cart_key = $_GET['edit'];
    $_POST['edit-item'] = 1;
}

if (!empty($cart_key)) {

    $selected_values = $_SESSION['cart']['items'][$cart_key]['design'];
}

$steps = get_field('select_steps', $settings_id);

$next_step = "#" . sanitize_title($steps[1]) . "-tab";


$get_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$slug_product = explode("/", $get_url);
?>



<div class="browse-product-wrap design span6" <?php
if ($_REQUEST['action'] == 'buy-now') {
    echo "style='display:none'";
}
?>>


    <style>
        .span12.banner.design{
            display:none;
        }
    </style>
    <div class="browse-product-wrap-box">

        <?php
        if ($settings_id == 355) { // Special Design for suits 
            //if ($post_type == 'product-suit')	{ // Special Design for suits 
            ?>

            <?php
            $jackets_settings_id = 193;
            $pants_settings_id = 194;
            ?>

            <?php if (get_field('design_settings', $jackets_settings_id)) { ?>

                <div class="popup-input-wrap">

                    <?php while (has_sub_field('design_settings', $jackets_settings_id)) { ?>

                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $jackets_settings_id)); ?>

                        <?php
                        if ($material_id != 0) {

                            $selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $jackets_settings_id)), true);
                        }

                        if (!empty($selected_values)) {
                            $selected_value = $selected_values[$option_name];
                        }
                        ?>

                        <div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

                            <?php
                            $x = 1;
                            while (has_sub_field('options', $jackets_settings_id)) {
                                ?>

                                <div class="popup-input-box<?php if ($selected_value == get_sub_field('option_name')) { ?> selected-option<?php } elseif ($x == 1) { ?> selected-option<?php } ?>" data-select="<?php the_sub_field('option_name'); ?>">

                                    <img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

                                    <a href="#"><?php the_sub_field('option_name'); ?></a>

                                </div>

                                <?php
                                if (($x % 4) == 0 && $x != 0) {
                                    echo '<div class="clear"></div>';
                                }
                                ?>

                                <?php
                                $x++;
                            }
                            ?>

                        </div>

                    <?php } ?>

                </div>

            <?php } ?>

            <?php if (get_field('design_settings', $pants_settings_id)) { ?>

                <div class="popup-input-wrap">

                    <?php while (has_sub_field('design_settings', $pants_settings_id)) { ?>

                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $pants_settings_id)); ?>

                        <?php
                        if ($material_id != 0) {

                            $selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $pants_settings_id)), true);
                        }

                        if (!empty($selected_values)) {
                            $selected_value = $selected_values[$option_name];
                        }
                        ?>

                        <div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

                            <?php
                            $x = 1;
                            while (has_sub_field('options', $pants_settings_id)) {
                                ?>

                                <div class="popup-input-box<?php if ($selected_value == get_sub_field('option_name')) { ?> selected-option<?php } elseif ($x == 1) { ?> selected-option<?php } ?>" data-select="<?php the_sub_field('option_name'); ?>">


                                    <img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

                                    <a href="#"><?php the_sub_field('option_name'); ?></a>

                                </div>

                                <?php
                                if (($x % 4) == 0 && $x != 0) {
                                    echo '';
                                }
                                ?>

                                <?php
                                $x++;
                            }
                            ?>

                        </div>

                    <?php } ?>

                </div>

            <?php } ?>

        <?php } else { ?>

            <?php if (get_field('design_settings', $settings_id)) { ?>

                <div class="popup-input-wrap">

                    <?php while (has_sub_field('design_settings', $settings_id)) { ?>

                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

                        <?php
                        if ($material_id != 0) {

                            $selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);
                        }

                        if (!empty($selected_values)) {
                            $selected_value = $selected_values[$option_name];
                        }
                        ?>

                        <?php if ($option_name == 'collar-cuff-thickness') { ?>

                            <div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

                                <div class="collar-cuff-thickness-test">
                                    <?php
                                    $x = 1;
                                    while (has_sub_field('options', $settings_id)) {

                                        $selected_class = "";

                                        if (!$selected_value && $x == 1) {

                                            $selected_class = "selected-option";
                                        } elseif ($selected_value == get_sub_field('option_name')) {

                                            $selected_class = "selected-option";
                                        }
                                        ?>

                                        <div class="popup-input-box<?php echo " " . $selected_class; ?>" data-select="<?php the_sub_field('option_name'); ?>">

                                            <img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">
                                            <a href="#"><?php the_sub_field('option_name'); ?></a>



                                        </div>

                                        <?php
                                        if (($x % 4) == 0 && $x != 0) {
                                            echo 'div class="clear"></div>';
                                        }
                                        ?>

                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </div>


                            </div>

                        <?php } else { ?>

                            <div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

                                <?php
                                $x = 1;
                                while (has_sub_field('options', $settings_id)) {

                                    $selected_class = "";

                                    if (!$selected_value && $x == 1) {

                                        $selected_class = "selected-option";
                                    } elseif ($selected_value == get_sub_field('option_name')) {

                                        $selected_class = "selected-option";
                                    }
                                    ?>

                                    <div class="popup-input-box<?php echo " " . $selected_class; ?>" data-select="<?php the_sub_field('option_name'); ?>">

                                        <p class="text_popup"><?php the_sub_field('option_des'); ?></p>

                                        <img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

                                        <a href="#"><?php the_sub_field('option_name'); ?></a>

                                    </div>

                                    <?php
                                    if (($x % 4) == 0 && $x != 0) {
                                        echo '';
                                    }
                                    ?>

                                    <?php
                                    $x++;
                                }
                                ?>
                            </div>

                        <?php } ?>

                    <?php } ?>

                </div>

            <?php } ?>

        <?php } ?>

        <div class="row-fluid" >


            <?php //if ($post_type == 'product-suit')	{ // Special Design for suits   ?>

            <?php if ($settings_id == 355) { // Special Design for suits    ?>



                <?php
                $jackets_settings_id = 193;
                $pants_settings_id = 194;
                ?>

                <div class="span12">

                    <div class="browse-design-details">

                        <?php if (get_field('design_settings', $jackets_settings_id)) { ?>

                            <div class="browse-design-details-box">

                                <!--<div class="suit-toggle">

                                        <a href="#jacket-design-options" class="suit-tab selected">jacket</a><a href="#pants-design-options" class="suit-tab">pants</a>

                                </div>-->

                                <div id="jacket-design-options" class="suit-content">

                                    <?php while (has_sub_field('design_settings', $jackets_settings_id)) { ?>

                                        <div class="input-wrap">

                                            <label><?php the_sub_field('setting_name', $jackets_settings_id); ?></label>

                                            <?php // Create hidden input for pricing ?>

                                            <?php $option_name = sanitize_title(get_sub_field('setting_name', $jackets_settings_id)); ?>

                                            <?php
                                            if ($material_id != 0) {

                                                $selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $jackets_settings_id)), true);
                                            }

                                            if (!empty($selected_values)) {
                                                $selected_value = $selected_values[$option_name];
                                            }



                                            if (metadata_exists('post', $_REQUEST[custom_product_id], 'design')) {
                                                $design_meta = unserialize(get_post_meta($_REQUEST[custom_product_id], 'design', true));
                                                if (!empty($design_meta))
                                                    foreach ($design_meta as $key => $value) {
                                                        if ($key == $option_name) {
                                                            $selected_value = $value;
                                                        }
                                                    }
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



                            </div>

                        <?php } ?>

                        <div class="browse-design-purchase-box">

                                                                                            <!--<a href="<?php echo $next_step; ?>" class="btn change-suit-tab suit-next-btn">

                                                                                                    <span class="arrow">Next</span>
                                                                            

                                                                                            </a>-->




                        </div>

                    </div>

                    <!-- fb plugin -->

                    <div class="fb-like" data-send="true" data-width="320" data-show-faces="false"></div>

                </div>

                <!--this part for suit next button (newly add)-->
                <div class="browse-design-purchase-box" style="clear:both">

                    <a href="<?php echo $next_step; ?>" class="btn change-step design">

                        <span class="arrow">Next</span>

                    </a>

                    <?php if ($slug_product[3] == 'product-made-shirt') { ?>
                        <a href="<?php bloginfo('url') ?>?page_id=11" class="btn-gray " style=" float: left; margin-right: 50px; padding: 8px 0; width: 25%;">
                        <?php } else { ?>
                            <a href="<?php echo get_permalink($_REQUEST[custom_product_id]); ?>" class="btn-gray " style=" float: left; margin-right: 50px; padding: 8px 0; width: 25%;">
                            <?php } ?>
    <!--<span>Back</span>-->
                            <i class="back_txt"><img src="<?php echo get_template_directory_uri() . '/images/back_arrow.png'; ?>" /></i>

                        </a>

                </div>


            <?php } else { ?>

                <div class="span12">

                    <?php // load different template for filled in choices   ?>

                    <?php if ($material_id != 0 && empty($cart_key)) { ?>

                        <?php
                        if (!empty($selected_values)) {
                            $selected_values_extras = $_SESSION['cart'][$cart_key]['extras'];
                        }
                        ?>

                        <div class="browse-design-details" id="ready-made">

                            <h3>Design Details</h3>

                            <div class="browse-design-details-box browse-box">

                                <ul>
                                    <?php
                                    $material_contrasting = get_field('fabric_collar_cuff_lining');
                                    $fabricContrasting_id = $material_contrasting[0]->ID;
                                    ?>
                                    <li><p>Fabric: <span><?php echo get_the_title($material_id); ?></span></p></li>

                                    <?php
                                    while (has_sub_field('design_settings', $settings_id)) {

                                        $option_name = sanitize_title(get_sub_field('setting_name', $settings_id));

                                        $option_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

                                        if (!empty($selected_values)) {
                                            $option_value = $selected_values[$option_name];
                                        }
                                        ?>

                                        <input type="hidden" name="design[<?php echo $option_name ?>]" value="<?php echo $option_value; ?>" />

                                        <li><p><?php the_sub_field('setting_name', $settings_id); ?>: <span><?php echo $option_value; ?></span></p></li>

                                    <?php } ?>

                                </ul>

                                <ul>

                                    <li><p>Extras</p></li>

                                    <?php
                                    if (get_field('monogram_positions', $settings_id)) {

                                        $options = "";

                                        while (has_sub_field('monogram_positions', $settings_id)) {

                                            $m_option_name = sanitize_title(get_sub_field('monogram_position', $settings_id));

                                            $options .= '<option value="' . $m_option_name . '">' . get_sub_field('monogram_position', $settings_id) . '</option>';
                                        }
                                    }
                                    $arr_extras = array();
                                    while (has_sub_field('extras_settings', $settings_id)) {

                                        $option_name = sanitize_title(str_replace("<br>", " ", get_sub_field('setting_name', $settings_id)));

                                        $option_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

                                        if (!empty($selected_values_extras)) {
                                            $option_value = $selected_values_extras[$option_name];
                                        }

                                        if ($option_value != "No") {
                                            array_push($arr_extras, $option_name);
                                            ?>
                                            <input type="hidden" name="extras[<?php echo $option_name ?>]" value="<?php echo $option_value; ?>" />
                                            <li><p><?php echo str_replace("<br>", " ", get_sub_field('setting_name', $settings_id)); ?>: 
                                                    <span>
                                                        <?php
                                                        echo $option_value;
                                                        if ($option_value == 'Yes') {
                                                            $fabricContrasting_name = get_the_title($fabricContrasting_id);
                                                            if ($fabricContrasting_id != NULL) {
                                                                echo " (" . $fabricContrasting_name . ")";
                                                            }
                                                        }
                                                        ?>
                                                    </span></p></li>

                                        <?php } ?>

                                        <?php if ($option_name == "monogram" && $option_value != "No") { ?>

                                            <div class="input-wrap monogram" style="display: block;margin-top: 10px;">

                                                <div class="popup-label">

                                                    <?php if (get_field('monogram_positions', $settings_id)) { ?>

                                                        <div class="popup-color-position">

                                                            <label for="popup-position">Position</label>

                                                            <select name="extras[position]">

                                                                <option value=""> - </option>

                                                                <?php echo $options; ?>

                                                            </select>

                                                        </div>

                                                    <?php } ?>

                                                    <div class="popup-color-select">

                                                        <label for="popup-color">Color</label>

                                                        <select name="extras[color]">

                                                            <option value="same as fabric">Same as Fabric</option>

                                                            <?php if ($monogram_colors) { ?>

                                                                <?php foreach ($monogram_colors as $key => $color) { ?>

                                                                    <option value="<?php echo $key; ?>"><?php echo $color; ?></option>

                                                                <?php } ?>

                                                            <?php } ?>

                                                        </select>

                                                    </div>

                                                    <div class="popup-name">

                                                        <label for="popup-name">Text</label>

                                                        <input type="text" name="extras[custom-text]" value="<?php echo $selected_values_extras['custom-text']; ?>" maxlength="3" />

                                                    </div>

                                                </div>

                                            </div>

                                        <?php } ?>

                                        <?php
                                    }
                                    $_SESSION['extras_exist'][$product_id] = $arr_extras;
                                    ?>

                                </ul>

                            </div>

                            <div class="browse-design-purchase-box">

                                <a href="#sizing-tab" class="btn change-step">

                                    <span class="arrow">

                                        <span>Purchase</span>

                                        <span class="btn-small-txt">Proceed to Sizing</span>

                                    </span>

                                </a>

                                <a href="#" class="btn-gray edit-this-design">

                                    <span class="arrow">Edit This Design</span>

                                </a>

                            </div>

                        </div>

                    <?php } ?>

                    <?php // Load normal Template for all products   ?>

                    <div class="browse-design-details" id="edit-shirt"<?php if ($material_id != 0 && empty($cart_key)) { ?> style="display: none;"<?php } ?>>

                        <?php if (get_field('design_settings', $settings_id)) { ?>

                            <div class="browse-design-details-box">


                                <?php while (has_sub_field('design_settings', $settings_id)) { ?>

                                    <div class="input-wrap">

                                        <label><?php the_sub_field('setting_name', $settings_id); ?></label>

                                        <?php // Create hidden input for pricing  ?>

                                        <?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

                                        <?php
                                        if (metadata_exists('post', $_REQUEST[custom_product_id], 'design')) {
                                            $design_meta = unserialize(get_post_meta($_REQUEST[custom_product_id], 'design', true));
                                            if (!empty($design_meta))
                                                foreach ($design_meta as $key => $value) {
                                                    if ($key == $option_name) {
                                                        $selected_value = $value;
                                                    }
                                                }
                                        }

                                        //	if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }
                                        ?>

                                        <select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

                                            <?php while (has_sub_field('options', $settings_id)) { ?>

                                                <option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                <?php } ?>

                            </div>

                        <?php } ?>
                        <?php if ($slug_product[3] == 'design-pants') { ?>
                            <div class="browse-design-purchase-box">
                                <a href="#sizing-tab" class="btn change-step extract">
                                    <span class="arrow">Next</span>
                                </a>
                                <a href="" class="btn-gray step-back extract">
                                        <!--<span>Back</span>-->
                                    <i class="back_txt"><img src="<?php echo get_template_directory_uri() . '/images/back_arrow.png'; ?>" /></i>
                                </a>
                            </div>
                        <?php } else { ?>

                            <div class="browse-design-purchase-box">

                                <a href="<?php echo $next_step; ?>" class="btn change-step design">

                                    <span class="arrow">Next</span>

                                </a>

                                <?php if ($slug_product[3] == 'product-made-shirt') { ?>
                                    <a href="<?php bloginfo('url') ?>?page_id=11" class="btn-gray " style=" float: left; margin-right: 50px; padding: 8px 0; width: 25%;">
                                    <?php } else { ?>
                                        <a href="<?php echo get_permalink($_REQUEST[custom_product_id]); ?>" class="btn-gray " style=" float: left; margin-right: 50px; padding: 8px 0; width: 25%;">
                                        <?php } ?>
                                        <!--<span>Back</span>-->
                                        <i class="back_txt"><img src="<?php echo get_template_directory_uri() . '/images/back_arrow.png'; ?>" /></i>

                                    </a>

                            </div>


                            <?php
                        }
                        //print_r($slug_product);
                        ?>

                        <?php /* if($slug_product[3]=='design-pants'){?>
                          <div class="browse-design-purchase-box">
                          <a href="#sizing-tab" class="btn change-step extract">
                          <span class="arrow">Next</span>
                          </a>
                          <a href="" class="btn-gray step-back extract">
                          <!--<span>Back</span>-->
                          <i class="back_txt"><img src="<?php echo get_template_directory_uri().'/images/back_arrow.png';?>" /></i>
                          </a>
                          </div>
                          <?php } /*else {?>



                          <?php  } */ ?>



                    </div>

                    <!-- fb plugin -->

                    <div class="fb-like" data-send="true" data-width="320" data-show-faces="false"></div>

                </div>

            <?php } ?>

        </div>

    </div>

<!--    <div class="row woocommerce">
        <div class="product">

            <div class="large-12 large-uncentered columns">

                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li class="description_tab active"><a href="#tab-description">Description</a></li>
                        <li class="reviews_tab"><a href="#add-infor">Additional Information</a></li>
                        <li><a href="#tab-reviews">Reviews (0)</a></li>
                    </ul>

                    <div class="panel entry-content" id="tab-description" style="display: block;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <?php the_field('fabric_details'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="panel entry-content" id="add-infor" style="display: none;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <?php the_field('photo_detail') ?>
                            </div>
                        </div>
                    </div>

                    <div class="panel entry-content" id="tab-reviews" style="display: none;">
                        <div class="row">
                            <div class="large-10 large-centered columns">
                                <h5>no Content</h5>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>
    </div>-->

</div>

<?php
//get_template_part('template-parts/product-extra'); ?>