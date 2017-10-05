<?php global $settings_id; ?>

<?php if (get_field('quote_text'))	{ ?>

<div class="browse2-product-feed">

	<div class="row-fluid">

		<div class="span8">

			<p><?php echo get_field('quote_text'); ?></p>

		</div>

		<div class="span1">

			<img src="<?php bloginfo('template_url') ?>/images/signature.jpg" alt="">

		</div>

		<div class="span3"><p><?php echo get_field('quote_author'); ?> <br> <?php echo get_field('quote_author_profession'); ?></p></div>

	</div>

</div>

<?php } ?>

<div class="browse2-product-extra">

	<div class="row-fluid">

		<div class="span6">

			<div class="product-extra-details">

				<h3>PERFECT FIT GUARANTEE</h3>

				<p>We offer a 30-day money back guarantee. </p>

				<h3>CHEAP WORLDWIDE SHIPING</h3>

				<p class="no-margin">We ship to enywhere in the world at a very affordable price.</p>

			</div>

		</div>

		<div class="span6">

		<?php if (get_field('step_2_box_image', $settings_id))	{ $toshow_image = get_field('step_2_box_image', $settings_id); ?>

			<div class="product-extra-img">

				<img src="<?php echo $toshow_image['sizes']['medium']; ?>" alt="">

			</div>

		<?php } ?>

		</div>

	</div>

</div>