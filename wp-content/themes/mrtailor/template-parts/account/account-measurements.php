<?php
$args = array(
    'public' => true,
    '_builtin' => false
);
$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'
$post_types = get_post_types($args, $output, $operator);
$exclude_types = array("product-accessory", "product-gift", "product-made-shirt", "product-voucher");
foreach ($post_types as $post_type) {
    if (strstr($post_type, 'product')) {
        if (!in_array($post_type, $exclude_types)) {
            $allowed_post_types[] = $post_type;
        }
    }
}

$current_user = wp_get_current_user();
$user_profiles = array();
$user_id = $current_user->ID;

if (isset($_POST['save-profile']) && !empty($_POST['save-profile'])) {
    // Save Profile	

    $profile = $_POST['sizing'][$_POST['sizing']['sizing-type']];
    $profile['sizing-type'] = $_POST['sizing']['sizing-type'];
    $profile['value-type'] = $_POST['sizing'][$_POST['sizing']['sizing-type']]['value-type'];
    $profile['user-profile'] = "";
    if ($_POST['profile_key']) {
        $profile['user-profile'] = $_POST['profile_key'];
    }

    save_user_profiles($profile, $user_id, $_POST['profile_type']);
}

$user_profiles = get_user_meta($user_id, 'user-profiles', true);

//var_dump($user_profiles);

if (isset($_GET['delete_profile']) && !empty($_GET['delete_profile'])) {
    unset($user_profiles[$_GET['delete_profile']]);
    update_user_meta($user_id, 'user-profiles', $user_profiles);
}


if ((isset($_POST['make-new-profile']) && !empty($_POST['make-new-profile'])) || (isset($_GET['view_profile']) && !empty($_GET['view_profile']))) {

    if (isset($_POST['make-new-profile']) && !empty($_POST['make-new-profile'])) {
        $profile_type = $_POST['post-type'];
    } elseif (isset($_GET['view_profile']) && !empty($_GET['view_profile'])) {
        $profile_type = $user_profiles[$_GET['view_profile']]['type'];
    }

    $settings_post_title = "Shirts";
    $settings_type = 'store-settings';

// End Default Post Options Values
    if ($profile_type == 'product-suit') {
        $settings_post_title = "Suits";
    } elseif ($profile_type == 'product-blazer') {
        $settings_post_title = "Blazers";
    } elseif ($profile_type == 'product-jacket') {
        $settings_post_title = "Jackets";
    } elseif ($profile_type == 'product-pants') {
        $settings_post_title = "Pants";
    } elseif ($profile_type == 'product-chinos') {
        $settings_post_title = "Chinos";
    }

    $settings_posts = get_posts(array('post_type' => $settings_type, 'post_status' => 'private', 'posts_per_page' => -1));
    foreach ($settings_posts as $setting) {
        if ($setting->post_title == $settings_post_title) {
            $settings_id = $setting->ID;
        }
    }
    $options = get_field('sizing', $settings_id);

    $select_options = array();
    if ($options) {
        foreach ($options as $option) {
            $x = 0;
            foreach ($option as $key => $opt) {//echo "<pre>"; var_dump($opt); echo "</pre>";
                if ($key != "general_settings") {
                    // Every Product Type Array
                    foreach ($opt as $o) {
                        $select_options[sanitize_title($o['shirt/body_name'])] = $o;
                    }
                } else {
                    // Shirts General Sizing Array
                    //	echo "<pre>"; var_dump($opt); echo "</pre>";
                    if (in_array($profile_type, array('product-shirt'))) {
                        $select_options[sanitize_title($opt[0]['shirt/body_name'])] = $opt[0];
                    }
                }
                $x++;
            }
        }
    }

    if (isset($_GET['view_profile']) && !empty($_GET['view_profile'])) {
        $selected_profile = $user_profiles[$_GET['view_profile']];
        $selected_values = $selected_profile['sizing'];
        $selected_values_design = $selected_profile['design'];
    }
//echo "<pre>"; var_dump($selected_profile); echo "</pre>";
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
//var_dump($selected_value_type); exit();
    ?>
    <div class="measure-wrap">
        <form action="<?php echo get_permalink(2490) ?>" method="post" id="profile-measurements-form">
            <input type="hidden" name="profile_key" value="<?php echo isset($_GET['view_profile']) ? $_GET['view_profile'] : ""; ?>" />
            <input type="hidden" name="profile_type" value="<?php echo $profile_type; ?>" />
            <?php
            if ($profile_type == 'product-suit') {
                $sizing_type = "measure-your-body";
                ?>
                <input type="hidden" name="sizing[sizing-type]" value="measure-your-body" />
                <div class="measure-small-nav">
                    <a href="#measure-your-jacket" class="btn selected">Jacket</a>
                    <a href="#measure-your-pants" class="btn">Pants</a>
                </div>
                <div class="measure-box measure-box-new <?php echo $profile_type; ?>-class"> ádasdas
                    <?php if ($select_options) { ?>
                        <?php foreach ($select_options as $key => $opt) { ?>
                            <div class="options-container" id="<?php echo $key; ?>" <?php if ($key == 'measure-your-jacket') echo 'style="display: block;"'; ?>>
                                <div class="measure-options">
                                    <?php if ($key != 'measure-your-pants') { ?>
                                        <div class="profile-title input-profile input-profile-active left-col" data-info="general">
                                            <p>Profile General</p>
                                        </div>
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
                                            <select name="sizing[<?php echo $sizing_type; ?>][<?php echo sanitize_title($option['field_name']); ?>]" class="selected-values">
                                                <option value="">Select Size</option>
                                                <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>
                                                    <option value="<?php echo $i; ?>"<?php echo_selected($selected_value, $i); ?>><?php echo $i; ?></option>
                                                <?php } ?>
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
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </div>
                                <div class="measure-contain measure-contain-body">
                                    <?php if ($key != 'measure-your-pants') { ?>
                                        <!-- general -->
                                        <div class="profile-wrap field-info" id="general">
                                            <div class="profile-input-wrap">
                                                <label for="profile-name" class="big-label">Profile Name</label>
                                                <input type="text" id="profile-name" name="sizing[<?php echo $sizing_type; ?>][profile-name]" value="<?php echo $selected_profile['profile-name']; ?>">
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
                                                    <select name="sizing[<?php echo $sizing_type; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]">
                                                        <option value="">Select <?php echo $goption['field_value']; ?></option>
                                                        <?php
                                                        if (!empty($selected_values)) {
                                                            $selected_value = $selected_values['general'][sanitize_title($goption['field_value'])];
                                                        }
                                                        ?>
                                                        <?php foreach ($goption['field_options'] as $gopt) { ?>
                                                            <option value="<?php echo $gopt['option_name']; ?>"<?php echo_selected($selected_value, $gopt['option_name']); ?>><?php echo $gopt['option_name']; ?></option>
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
                <div class="measure-box measure-box-new">
                    <div class="measure-title">
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
                    <?php if ($select_options) { ?>
                        <?php foreach ($select_options as $key => $opt) { ?>
                            <div class="options-container" id="<?php echo $key; ?>">
                                <?php if ($key != "standard-sizing") { ?>
                                    <div class="measure-options">
                                        <div class="profile-title input-profile input-profile-active left-col" data-info="general">
                                            <p>Profile General</p>
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
                                            if ($option_name == "arm-length-short") {
                                                $display = 'style="display: none;"';
                                            } else {
                                                $display = '';
                                            }
                                            ?>
                                            <div class="input-profile left-col <?php echo "container-" . $option_name; ?>" data-info="<?php echo $option_name . "-" . $key; ?>" <?php echo $display; ?>>
                                                <label><?php echo str_replace(" (Short)", "", $option['field_name']); ?></label>
                                                <?php
                                                if (!empty($selected_values)) {
                                                    $selected_value = $selected_values[$option_name];
                                                }
                                                ?>
                                                <select name="sizing[<?php echo $key; ?>][<?php echo $option_name; ?>]" class="selected-values">
                                                    <option value="">Select Size</option>
                                                    <?php for ($i = $selected_range[0]; $i <= $selected_range[1]; $i = $i + $selected_step) { ?>
                                                        <option value="<?php echo $i; ?>"<?php echo_selected($selected_value, $i); ?>><?php echo $i; ?></option>
                                                    <?php } ?>
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
                                        <!-- general -->
                                        <div class="profile-wrap field-info" id="general">
                                            <div class="profile-input-wrap">
                                                <label for="profile-name" class="big-label">Profile Name</label>
                                                <input type="text" id="profile-name" name="sizing[<?php echo $key; ?>][profile-name]" value="<?php echo $selected_profile['profile-name']; ?>">
                                            </div>
                                            <div class="profile-input-wrap">
                                                <label>Cm/Inches</label>
                                                <select name="sizing[<?php echo $key; ?>][value-type]" class="change-values">
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
                                                    <select name="sizing[<?php echo $key; ?>][general][<?php echo sanitize_title($goption['field_value']); ?>]">
                                                        <?php
                                                        if (!empty($selected_values)) {
                                                            $selected_value = $selected_values['general'][sanitize_title($goption['field_value'])];
                                                        }
                                                        ?>
                                                        <?php foreach ($goption['field_options'] as $gopt) { ?>
                                                            <option value="<?php echo $gopt['option_name']; ?>"<?php echo_selected($selected_value, $gopt['option_name']); ?>><?php echo $gopt['option_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
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
                                                    <img src="<?php echo $link; ?>" alt="<?php echo $option['field_name']; ?> image">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } else { // Change The design for Standard Sizing   ?>
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="standard-sizing">
                                                <h1><?php echo $opt['shirt/body_name'] ?></h1>
                                                <div class="standard-profile-wrap">
                                                    <label>Profile Name</label>
                                                    <input type="text" name="sizing[<?php echo $key; ?>][profile-name]" id="profile-name" value="<?php echo $selected_profile['profile-name']; ?>">
                                                </div>
                                                <div class="standard-size-wrap">
                                                    <input type="radio" id="standard-cm" value="centimeters" name="sizing[<?php echo $key; ?>][value-type]" class="change-neck-values" <?php
                                                    if ($selected_value_type == "centimeters") {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> />
                                                    <label for="standard-cm">Centimetres</label>
                                                    <input type="radio" id="standard-in" value="inches" name="sizing[<?php echo $key; ?>][value-type]" class="change-neck-values" <?php
                                                    if ($selected_value_type == "inches") {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> />
                                                    <label for="standard-in">Inches</label>
                                                    <a href="#">What's My Size</a>
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
                                                <h2>Additional Information</h2>
                                                <div class="standard-info-height">
                                                    <div class="standard-height">
                                                        <label>Height</label>
                                                        <input type="text" name="sizing[<?php echo $key; ?>][height]" value="<?php
                                                        if (!empty($selected_values)) {
                                                            echo $selected_values['height'];
                                                        }
                                                        ?>">
                                                        <select name="sizing[<?php echo $key; ?>][height-value-type]">
                                                            <option value="inches"<?php echo_selected($selected_values['height-value-type'], "inches"); ?>>In</option>
                                                            <option value="centimeters"<?php echo_selected($selected_values['height-value-type'], "centimeters"); ?>>Cm</option>
                                                        </select>
                                                    </div>
                                                    <div class="standard-weight">
                                                        <label>Weight</label>
                                                        <input type="text" name="sizing[<?php echo $key; ?>][weight]" value="<?php
                                                        if (!empty($selected_values)) {
                                                            echo $selected_values['weight'];
                                                        }
                                                        ?>">
                                                        <select name="sizing[<?php echo $key; ?>][weight-value-type]">
                                                            <option value="pounds"<?php echo_selected($selected_values['weight-value-type'], "pounds"); ?>>Pounds</option>
                                                            <option value="kilograms"<?php echo_selected($selected_values['weight-value-type'], "kilograms"); ?>>Kilograms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="standard-info-fit">
                                                    <label>Fit</label>
                                                    <select name="sizing[<?php echo $key; ?>][fit]">
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
            <div class="measure-view-submit-box">
                <input type="submit" value="Save" class="btn" name="save-profile" />
                <a href="<?php echo get_permalink(); ?>?measurements=true" class="btn-gray">Back to Profiles</a>
            </div>
        </form>
    </div>
<?php } else { ?>
    <div class="orders-content">
        <div class="row-fluid">
            <div class="span12">
                <div class="dashboard-measure-profile">
                    <form action="<?php echo get_permalink() ?>" method="post">
                        <label for="dashboard-profile">New Profile</label>
                        <select name="post-type">
                            <?php foreach ($allowed_post_types as $post_type) { ?>
                                <?php $pt = explode("-", $post_type); ?>
                                <option value="<?php echo $post_type; ?>"><?php echo ucfirst($pt[1]); ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" name="make-new-profile" value="Make New Profile" class="btn-gray" />
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <table class="account-measure-table">
                    <tr class="table-cat">
                        <td><p>Profile Name</p></td>
                        <td class="cell-hide640"><p>Date Created</p></td>
                        <td><p>Profile Type</p></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    if ($user_profiles) {
                        foreach ($user_profiles as $key => $profile) {
                            ?>
                            <tr>
                                <td><p><?php echo $profile['profile-name']; ?></p></td>
                                <td class="cell-hide640"><p><?php echo date("M/d/Y", $profile['date']); ?></p></td>
                                <?php $pt = explode("-", $profile['type']); ?>
                                <td><p><?php echo ucfirst($pt[1]); ?></p></td>
                                <td><a href="<?php echo get_permalink(); ?>?view_profile=<?php echo $key ?>">View</a></td>
                                <td><a href="<?php echo get_permalink(); ?>?delete_profile=<?php echo $key ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td colspan="5" style="text-align: center;">You don't have any profiles yet. Create one or if you order an item, one will be created for you.</td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <?php
} // $_GET['view_profile'] || $_POST['make-new-profile'] ?>