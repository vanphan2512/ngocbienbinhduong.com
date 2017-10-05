<?php
global $product_id, $post_type, $settings_id, $current_page_id, $cart_key;

$post = get_post($post->ID);
setup_postdata($post);

if ($_GET['similar'] != NULL) {

    $cart_key = $_GET['similar'];
} elseif ($_GET['edit'] != NULL) {
    $cart_key = $_GET['edit'];
}

if (!empty($cart_key)) {

    $selected_values = $_SESSION['cart']['items'][$cart_key]['sizing'];

    $values_type = $_SESSION['cart']['items'][$cart_key]['sizing']['value-type'];
}


$options = get_field('sizing', $settings_id);



$current_user = wp_get_current_user();

$user_profiles = array();

$user_id = $current_user->ID;

//$b_measurement=get_user_meta($user_id, 'measurement_profile',true);
$get_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$slug_product = explode("/", $get_url);

global $wpdb;

$profile_id = $wpdb->get_var("select min(umeta_id) from " . $wpdb->prefix . "profile where user_id=$user_id");

$profile = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "usermeta where umeta_id=$profile_id");
$b_measurement = unserialize($profile);

//print_r($b_measurement);
if (0 == $user_id) {

    // Not Logged In
} else {

    // Logged in

    $user_profiles = get_user_meta($user_id, 'user-profiles', true);
}

$select_options = array();

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

<div class="measure-wrap remove" id="thrd_step_wrap">

    <div class="third_step_rap">



        <div class="row-fluid">

            <div class="span12">
                <?php
                /* ---Load user profile--- */
                if (is_user_logged_in()) {

                    global $wpdb;
                    //$result = $wpdb->get_results("select umeta_id,profile_name,product_type from " . $wpdb->prefix . 'profile' . " where user_id=$user_id");
                    $result = $wpdb->get_results("select umeta_id,profile_name,product_type from " . $wpdb->prefix . 'profile' . " where user_id=".$user_id." AND sizing_option!='standard-sizing' AND sizing_option!='pictailor'");
                    ?>
                    <div class="select-profile third_step">
                        <ul class="third_stp_selectall">

                            <li>
                                <?php if ($settings_id != 191) { ?>
                                    <input type="radio" name="profile" value="new" onclick="hide_profile()" checked>NEW MEASUREMENT PROFILE
                                    <?php
                                } else {
                                    ?>
                                    <input type="radio" name="profile" value="new" onclick="hide_profile_shirt()" checked>NEW MEASUREMENT PROFILE
                                    <?php
                                }
                                ?>
                            </li>
                            <li>
                                <input type="radio" name="profile" value="new" onclick="show_profile()">USE EXISITING MEASUREMENT PROFILE
                            </li>
                            <li>
                                <?php
                                switch ($settings_id) {
                                    case 195 : $type = "designed chinos";
                                        break;
                                    case 194 : $type = "designed pant";
                                        break;
                                    case 193 : $type = "designed jacked";
                                        break;
                                    case 196 : $type = "designed blazer";
                                        break;
                                    case 191 : $type = "custom designed shirt";
                                        break;
                                    case 355 : $type = "designed suit";
                                        break;
                                }
                                ?>

                                <select name="sizing[user-profile]" id="uprofile" onChange="select_profile('<?php echo $settings_id ?>');" style="display:none">
                                    <option selected="selected" value="0">Select Profile</option>
                                    <?php
								
									
                                    foreach ($result as $row) {
                                        if ($type == $row->product_type) {

                                            $szie_type=$wpdb->get_var("select sizing_option from ".$wpdb->prefix."profile where umeta_id='".$row->umeta_id."'");
                                            $arr = array($row->umeta_id, $szie_type);
                                            $profilee = implode("_", $arr);
                                            ?>
                                            <option value="<?php echo $profilee; ?>"><?php echo $row->profile_name; ?></option>
<!--                                            <option value="--><?php //echo $szie_type; ?><!--">--><?php //echo $row->profile_name; ?><!--</option>-->
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </li>
                            <li>

                                    <input type="hidden" id="test" name="test" value="">
                                <?php
                                //                                $sizing_typee=$wpdb->get_var("select sizing_option from ".$wpdb->prefix."profile where umeta_id='".$row->umeta_id."'");
                                print_r($_REQUEST['test']);
                                ?>
                            </li>
                            <li><img src="<?php echo bloginfo('template_directory') ?>/images/loader32.gif" class="loading-search" style="display: none" /></li>

                            <!--<label>Select Profile</label>-->
                            <?php  if ($type == "custom designed shirt"): ?>
                            <li class="measure-box-right">
                                <div class="measure-title-right">
                                    <select name="sizing[sizing-type]" id="measure-option" class="measure-selected">
                                        <?php foreach ($select_options as $key => $type) { ?>
                                            <?php
                                            if (!empty($selected_values)) {
                                                $selected_value = $selected_values['sizing-type'];
                                            }
                                            ?>
                                         
                                            <option value="<?php echo $key; ?>"<?php echo_selected($selected_value, $key); ?>><?php echo $type['shirt/body_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                            <?php  endif; ?>
                        </ul>

                        <!-- /*this is old code off*/
                                <select name="sizing[user-profile]">

                                        <option value="">New Measurement Profile</option>

                        <?php //if ($user_profiles)	{ ?>

                        <?php //foreach ($user_profiles as $key => $profile)	{ ?>

                        <?php //if ($profile['type'] == $post_type)	{ ?>

                        <?php //if (!empty($selected_values)) {$selected_value = $selected_profile = $selected_values['user-profile'];}  ?>

                                        <option value="<?php echo $key; ?>"<?php echo_selected($selected_value, $key); ?>><?php echo $profile['profile-name']; ?></option>

                        <?php //}  ?>

                        <?php //}  ?>

                        <?php //}  ?>

                        </select>-->

                    </div>
                <?php } else { ?>
                    <div class="select-profile third_step">
                        <ul class="third_stp_selectall">
                            <li>RETURNING CUSTOMER? <a href="#" id="clkm">SIGN IN</a></li>
                            <li class="measure-box-right">
                                <div class="measure-title-right">
                                    <select name="sizing[sizing-type]" id="measure-option" class="measure-selected">
                                        <?php foreach ($select_options as $key => $type) { ?>
                                            <?php
                                            if (!empty($selected_values)) {
                                                $selected_value = $selected_values['sizing-type'];
                                            }
                                            ?>
                                            <option value="<?php echo $key; ?>"<?php echo_selected($selected_value, $key); ?>><?php echo $type['shirt/body_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>

        </div>

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
                    <div class="sizing-options" id="sute_oppe">
                        <h2>Sizing Options</h2>
                        <p>You have the choice to provide measurements from your body, measurements from a well fitting shirt, or you can select from standard sizes.</p>
                        <div class="select-sizing-option" data-sizing-option="measure-your-jacket">
                            <h3>Measure Your Body</h3>
                            <p>Use our simple step-by-step guide to measure your body.</p>
                        </div>
                    </div>
                    <!--new-->

                    <div class="measure-small-nav sute_third_nav" style="display:none;" >
                        <a href="#measure-your-jacket" class="btn selected">Jacket</a>
                        <a href="#measure-your-pants" class="btn">Pants</a>
                    </div>

                    <?php foreach ($select_options as $key => $opt) { ?>

                        <div class="options-container" id="<?php echo $key; ?>" style="display:none;" >

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
                                        $p_id = $_REQUEST[custom_product_id];

                                        $measure = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='measure_your_body' and post_id=$p_id");
                                        $measurement = unserialize($measure);
                                        if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                            if (metadata_exists('post', $_REQUEST[custom_product_id], 'measure_your_body')) {


                                                foreach ($measurement as $selected_measure_key => $selected_values_measure_option) {
                                                    $measurement_opt = strtolower($option['field_name']);

                                                    if ($selected_measure_key == $measurement_opt) {
                                                        $selected_value = $selected_values_measure_option;
                                                    }
                                                }
                                            }
                                        }
                                        ?>

                                        <select name="sizing[<?php echo $sizing_type; ?>][<?php echo sanitize_title($option['field_name']); ?>]" class="selected-values">

                                            <option value="">Select Size</option>


                                            <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>

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
                                    <label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information</h3>
                                </div>

                                <?php if ($key != 'measure-your-pants') { ?>

                                    <!-- general -->

                                    <div class="profile-wrap field-info" id="general">

                                        <div class="profile-input-wrap">

                                            <label for="profile-name" >Name Your Profile</label>

                                                  <!--<input type="text" id="profile-name" name="sizing[<?php echo $sizing_type; ?>][profile-name]" value="<?php echo $measurement['profile-name'] ?>" placeholder="Enter a name for your measurement profile.">-->

                                            <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php
                                            if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                                echo $measurement['profile-name'];
                                            }
                                            ?>" placeholder="Enter a name for your measurement profile." />

                                        </div>

                                        <div class="profile-input-wrap">

                                            <label>Cm/Inches</label>

                                            <select name="sizing[<?php echo $sizing_type; ?>][value-type]" class="change-values">

                                                <?php foreach ($values_types as $vtype) { ?>

                                                    <option value="<?php echo $vtype; ?>"<?php
                                                    if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                                        if ($selected_value_type == $vtype) {
                                                            echo " selected";
                                                        }
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

                                                        <option value='<?php echo $gopt['option_name']; ?>' <?php
                                                        if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                                            if ($measurement['general'][$f] == $gopt['option_name']) {
                                                                ?>selected="selected"<?php
                                                                    }
                                                                }
                                                                ?>><?php echo $gopt['option_name']; ?></option>

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

        <?php } else { ?>

            <div class="measure-box measure-box-new <?php echo $post_type; ?>-class">
                <?php
                if (is_user_logged_in()) {
                    ?>
                    <!--<div class="measure-title">

                            <select name="sizing[sizing-type]" id="measure-option" <?php //if (!empty($selected_values) || !in_array( $post_type, array( 'product-made-shirt', 'product-shirt' ) )) echo 'class="measure-selected"';           ?>>

                    <?php //foreach ($select_options as $key => $type)	{  ?>

                    <?php //if (!empty($selected_values)) {$selected_value = $selected_values['sizing-type'];}   ?>

                                    <option value="<?php //echo $key;         ?>"<?php //echo_selected($selected_value, $key);         ?>><?php //echo $type['shirt/body_name'];         ?></option>

                    <?php //}  ?>

                            </select>

                    </div>-->

                    <?php
                } if ($select_options) {
                    //if ( is_user_logged_in() ) {
                    ?>

                    <?php if (in_array($post_type, array('product-made-shirt', 'product-shirt'))) { ?>

                        <div class="sizing-options" >

                            <h2>Sizing Options</h2>

                            <p>You have the choice to provide measurements from your body, measurements from a well fitting shirt, or you can select from standard sizes.</p>

                            <?php foreach ($select_options as $key => $type) { ?>

                                <?php
                                if (!empty($selected_values)) {
                                    $selected_value = $selected_values['sizing-type'];
                                }
                                if (!empty($type)) {
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

                                                                                                                                                                                                                                                <!--<span><img src="<?php //bloginfo('template_url');          ?>/images/box-arrow.png" alt="<?php //echo $type['shirt/body_name'];          ?> arrow" /></span>-->

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

                    <?php foreach ($select_options as $key => $opt) { //echo $key; ?>

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

                        <?php if ($key != "standard-sizing") { ?>

                            <div class="options-container" id="<?php echo $key; ?>">
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
                                                    if (count($b_measurement) > 0) {
                                                        ?>
                                                        <select name="sizing[<?php echo $key; ?>][<?php echo $option_name; ?>]" class="selected-values">

                                                            <option value="">Select Size</option>

                                                            <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>

                                                                <option value="<?php echo $i; ?>"<?php //if($b_measurement[$measurement_index]==$i){echo "selected";}          ?>><?php echo $i; ?></option>

                                                            <?php } ?>

                                                        </select>
                                                    <?php }
                                                    ?>
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
                                                } else {
                                                    if (!empty($selected_values)) {
                                                        $selected_value = $selected_values[$option_name];
                                                    }
                                                    ?>
                                                    <?php
                                                    $p_id = $_REQUEST[custom_product_id];
                                                    $measure = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='measure_your_body' and post_id=$p_id");
                                                    $measurement = unserialize($measure);

                                                    if (metadata_exists('post', $_REQUEST[custom_product_id], 'measure_your_body')) {
                                                        if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {

                                                            foreach ($measurement as $selected_key => $selected_values_option) {
                                                                if ($selected_key == $option_name) {
                                                                    $selected_value = $selected_values_option;
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if (!empty($selected_values)) {
                                                        $selected_value = $selected_values[$option_name];
                                                    }
                                                    //$key='measure-your-body';
                                                    ?>

                                                    <select name="sizing[<?php echo $key; ?>][<?php echo $option_name; ?>]" class="selected-values">

                                                        <option value="">Select Size</option>

                                                        <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>

                                                                                                                                                                                                                                                                                                                                        <!--<option value="<?php echo $i; ?>"<?php //echo_selected($selected_value, $i);         ?>><?php echo $i; ?></option>-->
                                                            <option value="<?php echo $i; ?>"<?php if ($selected_value == $i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option
                                                            >
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>

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

                                                </select>

                                            </div>

                                        <?php } ?>

                                    </div>

                                    <div class="measure-contain measure-contain-body">
                                        <div class="profile-input-wrap">
                                            <label for="profile-name" class="big-label">&nbsp; </label><h3 class="bbg_hdingtxt">General Information</h3>
                                        </div>
                                        <!-- general -->
                                        <div class="profile-wrap field-info" id="general-<?php echo $key; ?>">
                                            <?php
                                            if (is_user_logged_in()) {
                                                if (count($b_measurement) > 0) {
                                                    $profile_name = get_user_meta($user_id, 'profile_name', true);
                                                    ?>
                                                    <div class="profile-input-wrap">
                                                        <label for="profile-name" class="big-label">Name Your Profile </label>
                                                        <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="" placeholder="Enter a name for your measurement profile." />
                                                    </div>
                                                    <div class="profile-input-wrap">
                                                        <label>Cm/Inches</label>
                                                        <select name="sizing[<?php echo $key; ?>][value-type]" class="change-values">
                                                            <?php if ($values_type != null) { ?>
                                                                <option value="<?php echo $values_type; ?>"><?php echo ucfirst($values_type); ?></option>
                                                                <option value="inches">Inches</option>

                                                            <?php } else { ?>

                                                                <?php foreach ($values_types as $vtype) { ?>
                                                                    <option value="<?php echo $vtype; ?>"><?php echo ucfirst($vtype); ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!---------------------------------------------------------->

                                                    <?php foreach ($opt['general_options'] as $goption) { ?>
                                                        <div class="profile-input-wrap">
                                                            <label><?php echo $goption['field_value']; ?></label>

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


                                                                <?php //if (!empty($selected_values)) {$selected_value = stripslashes($selected_values['general'][sanitize_title($goption['field_value'])]);}  ?>
                                                                <?php
                                                                foreach ($goption['field_options'] as $gopt) {
                                                                    $field = strtolower($goption['field_value']);
                                                                    ?>
                                                                    <option value="<?php echo $gopt['option_name']; ?>"><?php echo $gopt['option_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                $p_id = $_REQUEST[custom_product_id];



                                                $other_meta = $wpdb->get_var("select meta_value from " . $wpdb->prefix . "postmeta where meta_key='measure_your_body' and post_id=$p_id");
                                                $other_meta_measurement = unserialize($other_meta);
                                                ?>
                                                <div class="profile-input-wrap">
                                                    <label for="profile-name" class="big-label">Profile Name </label>
                                                    <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php
                                                    if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                                        echo $other_meta_measurement['profile-name'];
                                                    }
                                                    ?>" placeholder="Enter a name for your measurement profile." >
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
                                                                <option value="<?php echo $vtype; ?>"<?php if ($vtype == $other_meta_measurement['value-type']) { ?>selected="selected"<?php } ?>><?php echo ucfirst($vtype); ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <!---------------------------------------------------------->

                                                <?php foreach ($opt['general_options'] as $goption) { ?>
                                                    <div class="profile-input-wrap">
                                                        <label><?php echo $goption['field_value']; ?></label>
                                                        <?php
                                                        $field = strtolower($goption['field_value']);
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
                                                                echo $other_meta_measurement['general'][$field];
                                                                ?>
                                                                <option value='<?php echo $gopt['option_name']; ?>' <?php
                                                                if (!empty($_REQUEST['same-product']) || $_REQUEST['action'] == 'edit_product') {
                                                                    if ($other_meta_measurement['general'][$field] == $gopt['option_name']) {
                                                                        ?> selected="selected" <?php
                                                                            }
                                                                        }
                                                                        ?>><?php echo $gopt['option_name']; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>







                                            <!---------------------------------------------------------->
                                        </div>

                                        <?php foreach ($opt['shirt/body_name_options'] as $option) { ?>

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
                                                    ?>">

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
//                                print_r($opt);
//                                echo '</pre>';
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

            <?php } ?>

            <?php // hidden input values to use with cart   ?>

            <input type="hidden" name="product_id" value="<?php echo $_REQUEST['custom_product_id']; ?>" />
            <input type="hidden" name="p_id" value="<?php echo $_REQUEST['custom_product_id']; ?>" />

            <input type="hidden" name="post-type" value="<?php echo $post_type; ?>" />

            <input type="hidden" name="settings_id" value="<?php echo $settings_id ?>" />

            <input type="hidden" name="current_page_id" value="<?php echo $current_page_id; ?>" />
            <input type="hidden" name="_sizing_type" id="_sizing_type"/>
            <input type="hidden" name="my_sizing_type" id="my_sizing_type" value="measure-your-body"/>

            <?php if ((isset($cart_key) && !empty($cart_key)) && $_GET['edit-item'] == 1) { ?>

                <input type="hidden" name="edit_cart_key" value="<?php echo $cart_key; ?>" />

            <?php } ?>

        </div>


        <div class="measure-submit">
            <?php
            if ($slug_product[3] == 'design-pants') {
                ?>
                <a href="<?php echo $get_url ?>">

                    <i class="back_txt_third"><img src="<?php echo get_template_directory_uri() . '/images/back_arrow.png'; ?>" /></i>


                </a>
                <?php
            } else {
                ?>
                <a href="" class="btn-gray step-back measure">

                    <i class="back_txt_third"><img src="<?php echo get_template_directory_uri() . '/images/back_arrow.png'; ?>" /></i>


                </a>
                <?php
            }

            global $woocommerce;
            $edit_flag = 0;
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = $_REQUEST['custom_product_id'];

                if ($cart_item['product_id'] == $_REQUEST['custom_product_id']) {
                    $edit_flag = 1;
                }
            }
            ?>
            <?php if ($edit_flag == 1 && empty($_REQUEST['same-product'])) { ?>

                <input type="submit" value="Update Product" name="submit-product-form" class="btn"/>

                <?php
            } else {
                if (!empty($_REQUEST['same-product'])) {
                    ?>

                    <input type="hidden" value="1" name="same-product"/>
                    <?php
                }
                ?>
                <input type="submit" value="Add to Cart" name="submit-product-form" class="btn adtocart_bbtn"/>

            <?php } ?>

        </div>

    </div>


    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            jQuery(function ($) {
                $("#clkm").click(function (e) {
                    e.preventDefault();
                    $("#port_1").stop(true, true).fadeToggle();
                    $('.shield').css({'display': 'block',
                        'position': 'fixed',
                        'opacity': '0.59'});
                });
                $(".sgn_pouup_clz").click(function () {
                    $("#port_1").css('display', 'block');
                    $('.shield').css({'display': 'block'});
                });
            });


            $('#sute_oppe').click(function () {
                $(this).next().show();
                $('.sute_third_nav').show();

            });

            $('#siz-optiollk').click(function () {
                $('.measure-box-right').show();
            });

            $('#measure-option').change(function () {
                $value = $('#measure-option').val();
                $('.' + $value).show();
            });

        });
    </script>