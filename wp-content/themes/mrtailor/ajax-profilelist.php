<?php 
 /*
Template Name: ajax-profilelist
*/
$current_user = wp_get_current_user();
        $user_id = $current_user->ID;


        if (is_user_logged_in()) {

            global $wpdb;
            $result = $wpdb->get_results("select * from " . $wpdb->prefix . 'profile' . " where user_id=$user_id");
            ?>
            <div class="select-profile third_step">
                <ul class="third_stp_selectall">

                    <li>CREATE NEW MEASUREMENT PROFILE</li>

                    <li>

                        <select style="display: block;" id="uprofile" name="sizing[user-profile]" class="cls-profile-manager">
                            <option value="custom designed shirt">Shirt</option>
                            <option value="designed suit">Suit</option>
                            <option value="designed jacked">Jacket</option>
                            <option value="designed blazer">Balzer</option>
                            <option value="designed chinos">Chinos</option>
                            <option value="designed pant">Pants</option>
                        </select>
                    </li>

                    <li><input type="button" value="CREATE" class="btn myaccount-create-profile" onclick="profile_manager();"/></li>
                  
                </ul>


            </div>
            <table class="shop_table ">
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