<?php

global $product_id, $post_type, $settings_id, $material_id, $meta_box_prefix, $cart_key;

$post = get_post($product_id);

setup_postdata($post);

if (!empty($cart_key))	{

	$selected_values = $_SESSION['cart']['items'][$cart_key]['design'];

}

$steps = get_field('select_steps', $settings_id);

$next_step = "#" . sanitize_title($steps[1]) . "-tab";

?>



<div class="browse-product-wrap">

	<div class="row-fluid">

		<div class="span12">

			<div class="browse2-product-title">

				<h2><?php the_title(); ?></h2>

				<h3><?php echo get_currency_sign() . get_currency_price(get_field('price')); ?></h3>

			</div>

		</div>

	</div>

	<div class="browse-product-wrap-box">

<?php if ($post_type == 'product-suit')	{ // Special Design for suits ?>

<?php $jackets_settings_id = 193; $pants_settings_id = 194; ?>

	<?php if (get_field('design_settings', $jackets_settings_id))	{ ?>

		<div class="popup-input-wrap">

		<?php while (has_sub_field('design_settings', $jackets_settings_id))	{ ?>

		<?php $option_name = sanitize_title(get_sub_field('setting_name', $jackets_settings_id)); ?>

		<?php

		if ($material_id != 0)	{

			$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $jackets_settings_id)), true);

		}

		if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

		?>

			<div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

			<?php $x = 1; while (has_sub_field('options', $jackets_settings_id))	{ ?>

				<div class="popup-input-box<?php if ($selected_value == get_sub_field('option_name')) { ?> selected-option<?php } elseif ($x == 1) { ?> selected-option<?php } ?>" data-select="<?php the_sub_field('option_name'); ?>">

					<p class="text_popup"><?php the_sub_field('option_des'); ?></p>

					<img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

					<a href="#"><?php the_sub_field('option_name'); ?></a>

				</div>

			<?php if (($x%4) == 0 && $x != 0) { echo '<div class="clear"></div>'; } ?>

			<?php $x++; } ?>

			</div>

		<?php } ?>

		</div>

	<?php } ?>

	<?php if (get_field('design_settings', $pants_settings_id))	{ ?>

		<div class="popup-input-wrap">

		<?php while (has_sub_field('design_settings', $pants_settings_id))	{ ?>

		<?php $option_name = sanitize_title(get_sub_field('setting_name', $pants_settings_id)); ?>

		<?php

		if ($material_id != 0)	{

			$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $pants_settings_id)), true);

		}

		if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

		?>

			<div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

			<?php $x = 1; while (has_sub_field('options', $pants_settings_id))	{ ?>

				<div class="popup-input-box<?php if ($selected_value == get_sub_field('option_name')) { ?> selected-option<?php } elseif ($x == 1) { ?> selected-option<?php } ?>" data-select="<?php the_sub_field('option_name'); ?>">

					<p class="text_popup"><?php the_sub_field('option_des'); ?></p>

					<img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

					<a href="#"><?php the_sub_field('option_name'); ?></a>

				</div>

			<?php if (($x%4) == 0 && $x != 0) { echo '<div class="clear"></div>'; } ?>

			<?php $x++; } ?>

			</div>

		<?php } ?>

		</div>

	<?php } ?>

<?php } else { ?>

	<?php if (get_field('design_settings', $settings_id))	{ ?>

		<div class="popup-input-wrap">

		<?php while (has_sub_field('design_settings', $settings_id))	{ ?>

		<?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

		<?php

			if ($material_id != 0)	{

				$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

			}

			if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

		?>

			<div class="popup-window" id="design-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">

			<?php $x = 1; while (has_sub_field('options', $settings_id))	{

				$selected_class = "";

				if (!$selected_value && $x == 1)	{

					$selected_class = "selected-option";

				} elseif ($selected_value == get_sub_field('option_name'))	{

					$selected_class = "selected-option";

				}

			?>

				<div class="popup-input-box<?php echo " ".$selected_class; ?>" data-select="<?php the_sub_field('option_name'); ?>">

					<p class="text_popup"><?php the_sub_field('option_des'); ?></p>

					<img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">

					<a href="#"><?php the_sub_field('option_name'); ?></a>

				</div>

			<?php if (($x%4) == 0 && $x != 0) { echo '<div class="clear"></div>'; } ?>

			<?php $x++; } ?>

			</div>

		<?php } ?>

		</div>

	<?php } ?>

<?php } ?>

		<div class="row-fluid">

			<div class="span6">

			<?php if (get_field('images'))	{ ?>

				<?php

				// Run loop to setup main image + thumbs array

				$images = array();

				$image_size = "product-image";

				if ($post_type == 'product-suit')	{

					$image_size = "product-suit-image";

				}

				$x = 0; while (has_sub_field('images'))	{

					//if ($x == 0) continue;

					if ($x == 0)	{

					} elseif ($x == 1){

						// Set Main Image

						$main_image_thumb = get_sub_field('image_thumb');

						$main_image = get_sub_field('image');

					} else {

						$images[$x]['thumb'] = get_sub_field('image_thumb');

						$images[$x]['image'] = get_sub_field('image');

					}

				$x++;

				}

				?>

				<div class="base-img">

					<a href="<?php echo $main_image['sizes']['large']; ?>" class="fancybox" rel="<?php echo "images-" . $product_id; ?>">

						<img src="<?php echo $main_image_thumb['sizes'][$image_size]; ?>" alt="<?php the_title(); ?>">

					</a>

				</div>

			<?php if ($images)	{ ?>

				<div class="base-img-alt">

					<ul>

					<?php // var_dump($images);

					foreach ($images as $key => $image)	{

						if ($image['thumb'])	{

							$thumb_link = $image['thumb']['sizes']['product-thumb-small'];

						} else {

							$thumb_link = $image['image']['sizes']['product-thumb-small'];

						}

					?>

						<li>

							<a href="<?php echo $image['image']['sizes']['large']; ?>" class="fancybox" rel="<?php echo "images-" . $product_id; ?>">

								<img src="<?php echo $thumb_link; ?>" alt="default alternative shirts">

							</a>

						</li>

					<?php } ?>

					</ul>

				</div>

			<?php } ?>

			<?php } ?>

			</div>

		<?php if ($post_type == 'product-suit')	{ // Special Design for suits ?>

		<?php $jackets_settings_id = 193; $pants_settings_id = 194; ?>

			<div class="span6">

				<div class="browse-design-details">

				<?php if (get_field('design_settings', $jackets_settings_id))	{ ?>

					<div class="browse-design-details-box">

						<div class="suit-toggle">

							<a href="#jacket-design-options" class="suit-tab selected">jacket</a><a href="#pants-design-options" class="suit-tab">pants</a>

						</div>

						<div id="jacket-design-options" class="suit-content">

						<?php while (has_sub_field('design_settings', $jackets_settings_id))	{ ?>

							<div class="input-wrap">

								<label><?php the_sub_field('setting_name', $jackets_settings_id); ?></label>

								<?php // Create hidden input for pricing ?>

								<?php $option_name = sanitize_title(get_sub_field('setting_name', $jackets_settings_id)); ?>

								<?php

								if ($material_id != 0)	{

									$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $jackets_settings_id)), true);

								}

								if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

								?>

								<select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $jackets_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

								<?php while (has_sub_field('options', $jackets_settings_id))	{ ?>

									<option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

								<?php } ?>

								</select>

							</div>

						<?php } ?>

						</div>

						<div id="pants-design-options" class="suit-content">

						<?php while (has_sub_field('design_settings', $pants_settings_id))	{ ?>

							<div class="input-wrap">

								<label><?php the_sub_field('setting_name', $pants_settings_id); ?></label>

								<?php // Create hidden input for pricing ?>

								<?php $option_name = sanitize_title(get_sub_field('setting_name', $pants_settings_id)); ?>

								<?php

								if ($material_id != 0)	{

									$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $pants_settings_id)), true);

								}

								if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

								?>

								<select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $pants_settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

								<?php while (has_sub_field('options', $pants_settings_id))	{ ?>

									<option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

								<?php } ?>

								</select>

							</div>

						<?php } ?>

						</div>

					</div>

				<?php } ?>

					<div class="browse-design-purchase-box">

						<a href="<?php echo $next_step; ?>" class="btn change-suit-tab suit-next-btn">

							<span class="arrow">Next</span>

						</a>

						<a href="" class="btn-gray step-back suit-back-btn">

							<span>Back</span>

						</a>

					</div>

				</div>

				<!-- fb plugin -->

				<div class="fb-like" data-send="true" data-width="320" data-show-faces="false"></div>

			</div>

		<?php } else { ?>

			<div class="span6">

			<?php // load different template for filled in choices ?>

			<?php if ($material_id != 0 && empty($cart_key))	{ ?>

			<?php if (!empty($selected_values))	{$selected_values_extras = $_SESSION['cart'][$cart_key]['extras'];} ?>

				<div class="browse-design-details" id="ready-made">

					<h3>Design Details</h3>

					<div class="browse-design-details-box browse-box">

						<ul>

							<li><p>Fabric: <span><?php echo get_the_title($material_id); ?></span></p></li>

						<?php

						while (has_sub_field('design_settings', $settings_id))	{

							$option_name = sanitize_title(get_sub_field('setting_name', $settings_id));

							$option_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

							if (!empty($selected_values))	{ $option_value = $selected_values[$option_name]; }

						?>

							<input type="hidden" name="design[<?php echo $option_name ?>]" value="<?php echo $option_value; ?>" />

							<li><p><?php the_sub_field('setting_name', $settings_id); ?>: <span><?php echo $option_value; ?></span></p></li>

						<?php } ?>

						</ul>

						<ul>

							<li><p>Extras</p></li>

						<?php

if (get_field('monogram_positions', $settings_id))	{

	$options = "";

	while (has_sub_field('monogram_positions', $settings_id))	{

		$m_option_name = sanitize_title(get_sub_field('monogram_position', $settings_id));

		$options .= '<option value="'.$m_option_name.'">'.get_sub_field('monogram_position', $settings_id).'</option>';

	}

}

						while (has_sub_field('extras_settings', $settings_id))	{

							$option_name = sanitize_title(str_replace("<br>", " ", get_sub_field('setting_name', $settings_id)));

							$option_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

							if (!empty($selected_values_extras))	{ $option_value = $selected_values_extras[$option_name]; }

							if ($option_value != "No")	{

						?>

							<input type="hidden" name="extras[<?php echo $option_name ?>]" value="<?php echo $option_value; ?>" />

							<li><p><?php echo str_replace("<br>", " ", get_sub_field('setting_name', $settings_id)); ?>: <span><?php echo $option_value; ?></span></p></li>

						<?php } ?>

						<?php if ($option_name == "monogram" && $option_value != "No")	{ ?>

							<div class="input-wrap monogram" style="display: block;margin-top: 10px;">

								<div class="popup-label">

								<?php if (get_field('monogram_positions', $settings_id))	{ ?>

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

										<?php if ($monogram_colors)	{ ?>

										<?php foreach ($monogram_colors as $key => $color)	{ ?>

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

						<?php } ?>

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

			<?php // Load normal Template for all products ?>

				<div class="browse-design-details" id="edit-shirt"<?php if ($material_id != 0 && empty($cart_key))	{ ?> style="display: none;"<?php } ?>>

				<?php if (get_field('design_settings', $settings_id))	{ ?>

					<div class="browse-design-details-box">

					<?php while (has_sub_field('design_settings', $settings_id))	{ ?>

						<div class="input-wrap">

							<label><?php the_sub_field('setting_name', $settings_id); ?></label>

							<?php // Create hidden input for pricing ?>

							<?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>

							<?php

							if ($material_id != 0)	{

								$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);

							}

							if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }

							?>

							<select name="design[<?php echo $option_name; ?>]" class="<?php if (get_sub_field('options', $settings_id)) { ?>select-popup<?php } ?>" data-popup="#design-<?php echo $option_name; ?>" id="target-<?php echo $option_name; ?>">

							<?php while (has_sub_field('options', $settings_id))	{ ?>

								<option value="<?php the_sub_field('option_name'); ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>><?php the_sub_field('option_name'); ?></option>

							<?php } ?>

							</select>

						</div>

					<?php } ?>

					</div>

				<?php } ?>

					<div class="browse-design-purchase-box">

						<a href="<?php echo $next_step; ?>" class="btn change-step">

							<span class="arrow">Next</span>

						</a>

						<a href="" class="btn-gray step-back">

							<span>Back</span>

						</a>

					</div>

				</div>

				<!-- fb plugin -->

				<div class="fb-like" data-send="true" data-width="320" data-show-faces="false"></div>

			</div>

		<?php } ?>

		</div>

	</div>

	<div class="browse2-shirt-other-details">

		<div class="row-fluid">

			<div class="span3">

				<h3>Fabric Details</h3>

				<?php the_field('fabric_details'); ?>

			</div>

			<div class="span3">

				<h3>Photo Details</h3>

				<?php the_field('photo_detail') ?>

			</div>

			<div class="span6">

				<h3>Label</h3>

				<img src="<?php the_field('label'); ?>" alt="" width="118">

			</div>

		</div>

	</div>

</div>

<?php get_template_part('template-parts/product-extra'); ?>