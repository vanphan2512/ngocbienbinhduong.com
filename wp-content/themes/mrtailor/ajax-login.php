 <?php 
 /*
Template Name: ajax-login
*/
 	$info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;
    $user_signon = wp_signon( $info, false );
    if (is_wp_error($user_signon)){
        echo json_encode(array('loggedin'=>false));
    } else {
    	global $wpdb;
        $settings_id= $_POST['settings_id'];
    	$current_user =  $user = get_user_by( 'login', $info['user_login']);
		$user_id = $current_user->ID;
        $result = $wpdb->get_results("select umeta_id,profile_name,product_type from " . $wpdb->prefix . 'profile' . " where user_id=$user_id");
    	if ($settings_id != 191)
            $type_radio='<input type="radio" name="profile" value="new" onclick="hide_profile()" checked>NEW MEASUREMENT PROFILE';
        else
            $type_radio='<input type="radio" name="profile" value="new" onclick="hide_profile_shirt()" checked>NEW MEASUREMENT PROFILE';             
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
        $option='';
        foreach ($result as $row) {
	        if ($type == $row->product_type) {
	            $option.='<option value="'.$row->umeta_id.'">'.$row->profile_name.'</option>';
        	}
        }
        $select_option_html='';
        foreach ($select_options as $key => $type) {
            if (!empty($selected_values)) {
               $selected_value = $selected_values['sizing-type'];
            }
				$select_option_html.='<option value="'.$key.'"'.selected($selected_value, $key).'>'.$type['shirt/body_name'].'</option>';
        }
        $select_option_html_total='';
        if ($type == "custom designed shirt"):
            $select_option_html_total='<li class="measure-box-right">
                                <div class="measure-title-right">
                                    <select name="sizing[sizing-type]" id="measure-option" class="measure-selected">
                                      '.$select_option_html.'  
                                    </select>
                                </div>
                            </li>';
        endif;
    	$html='<div class="select-profile third_step">
                <ul class="third_stp_selectall">
                    <li>'.$type_radio.'</li>
                    <li><input type="radio" name="profile" value="new" onclick="show_profile()" checked>USE EXISITING MEASUREMENT PROFILE</li>
                    <li>
                     	<select name="sizing[user-profile]" id="uprofile" onChange="select_profile('.$settings_id.')" style="display:none">
                        	<option selected="selected" value="0">Select Profile</option>'.$option.'
                		</select>
                    </li>'. $select_option_html_total.'

                </ul>
            </div>';
        $login_html='<ul><li><a href="'.get_site_url().'/my-accounts/" class="logout_link">My Account</a></li></ul>
                    <ul><li><a href="'.get_site_url().'/'.get_option("woocommerce_logout_endpoint").'" class="logout_link">Logout</a></li></ul>';
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...'),'profilelist'=>$html,'login'=>$login_html,'user_id'=>$user_id));
    }

                                    
                                

                            
                            
                       