<?php

if ($_GET['activation_key'])	{
	global $wpdb;

	$user_id = $wpdb->get_var( "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'activation_key' AND meta_value = '".$_GET['activation_key']."'" );

	if ($user_id)	{
		$activated = delete_user_meta( $user_id, 'activation_key', $_GET['activation_key'] );
	}
	unset($_GET['activation_key']);
	wp_redirect(get_permalink(54265));
	exit();
}

/* If user registered, input info. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'adduser' ) {
	$user_pass = wp_generate_password();
	$_POST['user_name'] = $_POST['user_email'];
	$userdata = array(
		'user_pass' => esc_attr( $_POST['password'] ),
		'user_login' => esc_attr( $_POST['user_name'] ),
		'first_name' => esc_attr( $_POST['first_name'] ),
		'last_name' => esc_attr( $_POST['last_name'] ),
		'user_email' => esc_attr( $_POST['user_email'] ),
		'role' => get_option( 'default_role' ),
	);
	
	if ( !$userdata['user_login'] )
		$error = __('An email is required for registration.', 'frontendprofile');
	elseif ( username_exists($userdata['user_login']) )
		$error = __('Sorry, that username already exists!', 'frontendprofile');
	elseif ( !is_email($userdata['user_email'] ) )
		$error = __('You must enter a valid email address.', 'frontendprofile');
	elseif ( email_exists($userdata['user_email']) )
		$error = __('Sorry, that email address is already used!', 'frontendprofile');
	elseif ($userdata['user_email'] != $_POST['user_confirm_email'])
		$error = __('Your emails don\'t match.', 'frontendprofile');
	elseif ( $_POST['password'] !== $_POST['repeat_password'] )
		$error = __('The passwords must match!', 'frontendprofile');
	else{
		$new_user = wp_insert_user( $userdata );
		echo wp_new_user_notification( $new_user, $_POST['password'] );
	}
}

?>

<form method="post" id="adduser" class="user-forms" action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
	<h2>Create Account</h2>
<?php if ( $new_user ) : ?>
	<p class="alert">
	<?php
		if ( current_user_can( 'create_users' ) )
			printf( __('A user account for %1$s has been created.', 'frontendprofile'), $_POST['user_name'] );
		else 
			printf( __('Thank you for registering, %1$s.', 'frontendprofile'), $_POST['user_name'] );
			printf( __('<br/>An email has been sent to you to activate your account.', 'frontendprofile') );
	?>
	</p><!-- .alert -->
<?php elseif ($activated) : ?>
	<p class="alert">
	<?php
			printf( __('Your Account has been activated!', 'frontendprofile'), $_POST['user_name'] );
			printf( __('<br/>You can use the login information in your email to login.', 'frontendprofile') );
	?>
	</p><!-- .alert -->
<?php else : ?>
	<?php if ( $error ) : ?>
	<p class="error">
		<?php echo $error; ?>
	</p><!-- .error -->
	<?php endif; ?>
	<div class="login-box-sign-email">
		<label for="label-box-sign-email">Email</label>
		<input type="text" id="label-box-sign-email" name="user_email" value="<?php if ( $error ) echo esc_html( $_POST['user_email'], 1 ); ?>">
	</div>
	<div class="login-box-sign-email">
		<label for="label-box-sign-confirm-email">Confirm Email</label>
		<input type="text" id="label-box-sign-confirm-email" name="user_confirm_email" value="<?php if ( $error ) echo esc_html( $_POST['user_confirm_email'], 1 ); ?>">
	</div>
	<div class="login-box-sign-name">
		<label for="label-box-sing-first-name">First Name</label>
		<input type="text" id="label-box-sign-first-name" name="first_name" value="<?php if ( $error ) echo esc_html( $_POST['first_name'], 1 ); ?>">
	</div>
	<div class="login-box-sign-name">
		<label for="label-box-sing-last-name">Last Name</label>
		<input type="text" id="label-box-sign-last-name" name="last_name" value="<?php if ( $error ) echo esc_html( $_POST['last_name'], 1 ); ?>">
	</div>
	<div class="login-box-sign-psw">
		<label for="label-box-sign-psw">Password</label>
		<input type="password" id="label-box-sign-psw" name="password">
	</div>
	<div class="login-box-sign-psw">
		<label for="label-box-sign-repeat-psw">Repeat Password</label>
		<input type="password" id="label-box-sign-repeat-psw" name="repeat_password">
	</div>
	<input name="adduser" type="submit" id="addusersub" class="btn" value="<?php _e('Register', 'frontendprofile'); ?>" />
	<?php wp_nonce_field( 'add-user' ) ?>
	<input name="action" type="hidden" id="action" value="adduser" />
<?php endif; ?>
</form>