<?php
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
?>
<div class="refer1-content">
<div id="refer-list" <?php if ($_GET['refer'] && !$_GET['refer-list']) echo 'style="display: none;"'; ?>>
	<div class="row-fluid">
		<div class="span8">
			<div class="refer-voucher">
				<h2>Refer a friend | Get a Free  Voucher</h2>
				<p>Refer a friend and when they purchase a shirt, you receive a  voucher! <br>You can refer as many friends as you like</p>
				<a href="<?php echo get_permalink() ?>?refer=true" class="btn">Refer a Friend</a>
			</div>
		</div>
		<div class="span4">
			<div class="refer-img">
				<img src="<?php bloginfo('template_url'); ?>/images/present.jpg" alt=""> 
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="account-table">
				<table>
					<tr class="table-cat">
						<td class="cell-hide480"><p>Date Referred</p></td>
						<td><p>Referee</p></td>
						<td class="cell-hide480"><p>Has Your Friend Purchased?</p></td>
						<td><p>Reward</p></td>
						<td><p>Code</p></td>
					</tr>
					<?php
						$args = array( 
							'post_type' => 'refer_a_friend', 
							'post_status' => 'private', 
							'author' => $user_id
						);
						$refer_query = new WP_Query($args);
						if ($refer_query->have_posts())	: while ($refer_query->have_posts())	: $refer_query->the_post(); $refer_id = get_the_ID();
					?>
					<tr>
						<td class="cell-hide480"><p><?php echo date("m/d/Y", get_post_meta($refer_id, 'date_refered', true)); ?></p></td>
						<td><p><?php echo str_replace("Private:", "", get_the_title()); ?></p></td>
						<td class="cell-hide480"><p><?php echo get_post_meta($refer_id, 'friend_purchased', true) ? "Yes" : "No"; ?></p></td>
						<td><p><?php echo get_currency_sign() . get_post_meta($refer_id, 'reward', true); ?></p></td>
						<td><p><?php echo get_post_meta($refer_id, 'code', true) ?></p></td>
					</tr>
					<?php endwhile; ?>
				<?php else : ?>
					<tr>
						<td colspan="5" style="text-align: center;">
							<h4 class="no-message">You have not reffered any users yet. <a href="<?php echo get_permalink() ?>?refer=true">Click here to refer a friend.</a></h4>
						</td>
					</tr>
				<?php endif; wp_reset_query(); ?>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="refer-form" <?php if ($_GET['refer'] && !$_GET['refer-list']) echo 'style="display: block;"'; ?>>
	<div class="row-fluid">
		<div class="span8">
			<h2>Refer a friend | Get a Free  Voucher</h2>
			<?php if ($_POST['error'])	{ ?>
			<h3 class="error" style="margin-top: 10px;"><?php echo $_POST['error']; ?></h3>
			<?php } ?>
			<form action="" method="post" id="refer-a-friend-form">
				<div class="refer-label">
					<label for="refer-friend-name">Your Friend's Name</label>
					<br>
					<label for="refer-friend-email">Your Friend's Email</label>
					<br>
					<label for="refer-msg">Message</label>
				</div>
				<div class="refer-input">
					<label class="show-640">Your Friend's Name</label>
					<input type="text" id="refer-friend-name" name="refer-friend-name" value="<?php echo $_POST['refer-friend-name']; ?>">
					<br>
					<label class="show-640">Your Friend's Email</label>
					<input type="text" id="refer-friend-email" name="refer-friend-email" value="<?php echo $_POST['refer-friend-email']; ?>">
					<br>
					<label class="show-640">Message</label>
					<textarea id="refer-msg" cols="30" rows="10" name="refer-message"><?php echo $_POST['refer-message']; ?></textarea>
					<br>
					<input type="submit" value="submit" class="btn" name="refer-a-friend">
				</div>
			</form>
		</div>
		<div class="span4">
			<div class="refer-back">
				<a href="<?php echo get_permalink(2496) ?>" class="btn-gray back">Back</a>
			</div>
		</div>
	</div>
</div>
</div>