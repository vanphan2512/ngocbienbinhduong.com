<form action="" method="post">
<?php global $current_user; $user_id = $current_user->ID; ?>
	<input type="hidden" name="current-user-id" value="<?php echo $user_id; ?>" />
	<?php if (!empty($_POST['error']))	{
		foreach ($_POST['error'] as $error)	{
			echo '<h3 class="error">'.$error.'</h3>';
		}
	} ?>
<div class="personal-details">
	<div class="row-fluid">
		<div class="span6">
			<div class="dash-personal-login">
				<h3>Login Details</h3>
				<div class="dash-personal-email">
					<label for="personal-email">Email</label>
					<input type="text" id="personal-email" name="personal-email" value="<?php if (!empty($_POST['error'])) { echo $_POST['personal-email']; } else { echo $current_user->user_email; } ?>">
					<br>
					<label for="personal-confirm-email">Email Confirm</label>
					<input type="text" id="personal-confirm-email" name="personal-confirm-email" value="<?php if (!empty($_POST['error'])) { echo $_POST['personal-confirm-email']; } else { echo $current_user->user_email; } ?>">
					<p>If you would like to change the password, type a new one. <br>Otherwise leave this blank. </p>
					<p class="alert" style="text-align: left;"><span class="bold">Note:</span> This action will automaticly log you out and you will have to login again using the new password.</p>
					<label for="personal-password">New Password</label>
					<input type="password" id="personal-password" name="personal-password" value="<?php if (!empty($_POST['error'])) { echo $_POST['personal-password']; } ?>">
					<br>
					<label for="personal-new-password">Confirm New Password</label>
					<input type="password" id="personal-new-password" name="personal-new-password" value="<?php if (!empty($_POST['error'])) { echo $_POST['personal-new-password']; } ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="dash-ship-details">
				<h3>Shipping Details</h3>
				<label for="personal-ship-first-name">First Name</label>
				<input type="text" id="personal-ship-first-name" name="first-name" value="<?php echo $current_user->first_name; ?>"><br>
				<label for="personal-ship-last-name">Last Name</label>
				<input type="text" id="personal-ship-last-name" name="last-name" value="<?php echo $current_user->last_name; ?>"><br>
				<label for="personal-ship-zip">Postal Adress Line1</label>
				<input type="text" id="personal-ship-zip" name="personal-ship[address]" value="<?php echo get_user_meta($user_id,'address',true) ?>"><br>
				<label for="personal-ship-zip2">Postal Adress Line2</label>
				<input type="text" id="personal-ship-zip2" name="personal-ship[address2]" value="<?php echo get_user_meta($user_id,'address2',true) ?>"><br>
				<label for="personal-ship-city">City</label>
				<input type="text" id="personal-ship-city" name="personal-ship[user-city]" value="<?php echo get_user_meta($user_id,'user-city',true) ?>"><br>
				<label for="personal-ship-state">State</label>
				<input type="text" id="personal-ship-state" name="personal-ship[user-state]" value="<?php echo get_user_meta($user_id,'user-state',true) ?>"><br>
				<label for="personal-ship-postcode">Zip/Post Code</label>
				<input type="text" id="personal-ship-postcode" name="personal-ship[user-zipcode]" value="<?php echo get_user_meta($user_id,'user-zipcode',true) ?>"><br>
				<label for="personal-ship-country">Country</label>
				<?php echo display_countries_select("personal-ship[user-country]", get_user_meta($user_id,'user-country',true), "personal-ship-country"); ?><br>
				<label for="personal-ship-phone">Phone Number</label>
				<input type="text" id="personal-ship-phone" name="personal-ship[user-phone]" value="<?php echo get_user_meta($user_id,'user-phone',true) ?>">
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="dash-personal-submit">
				<input type="submit" value="Update" class="btn" name="update-profile">
			</div>
		</div>
	</div>
</div>
</form>