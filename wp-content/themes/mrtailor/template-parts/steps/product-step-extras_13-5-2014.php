<?php
global $product_id, $post_type, $settings_id, $material_id, $meta_box_prefix, $cart_key;
$post = get_post($product_id);
setup_postdata($post);
if (!empty($cart_key))	{
	$selected_values = $_SESSION['cart']['items'][$cart_key]['extras'];
}
?>

<div class="browse-product-wrap <?php echo $post_type; ?>">
	<div class="row-fluid">
		<div class="span12">
			<div class="browse2-product-title">
				<h2><?php the_title(); ?></h2>
				<h3><?php echo get_currency_sign() . get_currency_price(get_field('price')); ?></h3>
			</div>
		</div>
	</div>
	<div class="browse-product-wrap-box">
		<!-- popup hidden for development -->
	<?php if (get_field('extras_settings', $settings_id))	{ ?>
		<!-- collar -->
		<div class="popup-input-wrap">
		<?php while (has_sub_field('extras_settings', $settings_id))	{ ?>
		<?php $option_name = sanitize_title(get_sub_field('setting_name', $settings_id)); ?>
		<?php
			if ($material_id != 0)	{
				$selected_value = get_post_meta($product_id, $meta_box_prefix . sanitize_title(get_sub_field('setting_name', $settings_id)), true);
			}
			if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }
		?>
			<div class="popup-window" id="extras-<?php echo $option_name; ?>" data-target="#target-<?php echo $option_name; ?>">
			<?php $x = 1; while (has_sub_field('options', $settings_id))	{ ?>
				<div class="popup-input-box<?php if ($selected_value == get_sub_field('option_name')) { ?> selected-option<?php } ?>" data-select="<?php the_sub_field('option_name'); ?>-<?php echo $x-1; ?>">
					<img src="<?php the_sub_field('option_image'); ?>" alt="<?php the_sub_field('option_name'); ?>">
					<a href="#"><?php the_sub_field('option_name'); ?></a>
				</div>
			<?php if (($x%4) == 0 && $x != 0) { echo '<div class="clear"></div>'; } ?>
			<?php $x++; } ?>
			</div>
		<?php } ?>
		</div>
	<?php } ?>
		<!-- popup hidden for development -->
		<div class="row-fluid">
			<div class="span6">
			<?php if (get_field('images'))	{ ?>
				<?php
				// Run loop to setup main image + thumbs array
				$thumbs = array();
				$image_size = "product-image";
				if ($post_type == 'product-suit')	{
					$image_size = "product-suit-image";
				}
				$x = 0; while (has_sub_field('images'))	{
					if ($x == 0)	{}
					elseif ($x == 1){
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
			<div class="span6">
				<div class="browse-design-details">
				<?php if (get_field('extras_settings', $settings_id))	{ ?>
					<?php if ($selected_values['lining-code'])	$lining_code = $selected_values['lining-code']; ?>
					<div class="browse-design-details-box">
					<?php while (has_sub_field('extras_settings', $settings_id))	{ ?>
						<div class="input-wrap">
							<label><?php the_sub_field('setting_name', $settings_id); ?></label>
							<?php $option_name = sanitize_title(str_replace("<br>", " ", get_sub_field('setting_name', $settings_id))); ?>
                            <!--------------------------------------->
                                <?php //if($option_name =='contrasting-buttonhole-stitching'){
//                                    $option_name = 'contrastingbuttonhole-stitching';
//                                    }
//                                  elseif($option_name == 'contrasting-collar-cuff-lining'){
//                                    $option_name = 'contrastingcollar-cuff-lining';
//                                  } 
                                ?>
                            <!--------------------------------------->
							<?php
							if ($material_id != 0)	{
								$selected_value = get_post_meta($product_id, $meta_box_prefix . $option_name, true);
							}
							if (!empty($selected_values))	{ $selected_value = $selected_values[$option_name]; }
							?>
							<select name="extras[<?php echo $option_name; ?>]" id="target-<?php echo $option_name; ?>" class="<?php if ($option_name == "contrasting-buttons" || $option_name == "buttons" || $option_name == "jacket-lining") { ?>select-popup<?php } ?>" id="target-<?php echo $option_name; ?>" data-popup="#extras-<?php echo $option_name; ?>">
							<?php $x = 0; while (has_sub_field('options', $settings_id))	{ ?>
							<?php
							// Create Monogram colors array
							if ($option_name == "contrasting-buttonhole-stitching")	{
								if (get_sub_field('option_name') != "No")	{
									$monogram_colors[get_sub_field('option_name')] = get_sub_field('option_name');
								}
							}
							if (get_sub_field('option_price'))	{
								$price = get_currency_price(get_sub_field('option_price'));
							} else {
								$price = "";
							}
							?>
								<option value ="<?php the_sub_field('option_name'); echo "-".$x; ?>"<?php if ($selected_value == get_sub_field('option_name')) { ?> selected="selected"<?php } ?>>
									<?php if ($option_name == 'contrasting-collar-cuff-lining' && $lining_code && $x != 0) { echo get_the_title($lining_code); } else { the_sub_field('option_name'); } if (!empty($price)) {echo "[+".get_currency_sign()."$price]";} ?>
								</option>
							<?php $x++; } ?>
							</select>
							<?php if ($option_name == 'contrasting-collar-cuff-lining' && $lining_code)	{ ?>
							<input type="hidden" id="lining-code" name="extras[lining-code]" value="<?php echo $lining_code; ?>" />
							<?php } ?>
						<?php if (get_sub_field('show_me', $settings_id))	{ ?>
							<a href="<?php echo get_sub_field('show_me', $settings_id); ?>" class="fancybox">Show me</a>
						<?php } ?>
						</div>
					<?php } ?>
						<div class="input-wrap monogram" <?php if (!empty($selected_values) && $selected_values['monogram'] != 'No') { ?>style="display: block;"<?php } ?>>
						<?php
						$monogram_position = array('left cuff' => 'Left Cuff', 'right cuff' => 'Right Cuff', 'pocket chest' => 'Pocket Chest', 'shirt bottom' => 'Shirt Bottom');
						?>
							<div class="popup-label">
							<?php if (get_field('monogram_positions', $settings_id))	{ ?>
								<div class="popup-color-position">
									<label for="popup-position">Position</label>
									<select name="extras[position]">
										<option value=""> - </option>
									<?php while (has_sub_field('monogram_positions', $settings_id))	{ ?>
									<?php $option_name = sanitize_title(get_sub_field('monogram_position', $settings_id)); ?>
										<option value="<?php echo $option_name; ?>" <?php if ($option_name == $selected_values['position']) { ?>selected="selected"<?php } ?>><?php echo get_sub_field('monogram_position', $settings_id); ?></option>
									<?php } ?>
									</select>
								</div>
							<?php } ?>
								<div class="popup-color-select">
									<label for="popup-color">Color</label>
									<select name="extras[color]">
										<option value="same as fabric">Same as Fabric</option>
									<?php foreach ($monogram_colors as $key => $color)	{ ?>
										<option value="<?php echo $key; ?>" <?php if ($key == $selected_values['color']) { ?>selected="selected"<?php } ?>><?php echo $color; ?></option>
									<?php } ?>
									</select>
								</div>
								<div class="popup-name">
									<label for="popup-name">Text</label>
									<input type="text" name="extras[custom-text]" value="<?php echo $selected_values['custom-text']; ?>" maxlength="3" />
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
					<div class="browse-design-purchase-box">
						<a href="#sizing-tab" class="btn change-step">
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
		</div>
	</div>
</div>
<?php get_template_part('template-parts/product-extra'); ?>