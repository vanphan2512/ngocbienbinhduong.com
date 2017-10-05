<?php global $settings_id; $steps = get_field('select_steps', $settings_id); ?>

<div class="row-fluid steps-header">
	<div class="span12">
		<ul class="steps-tabs">
			<li class="step-select" onclick="location.href='<?php bloginfo('url') ?>/?page_id=56629'"><a rel="select-fabric"><span>1</span> Select Fabric</a></li>
			<?php $i = 0; $numSteps = count($steps); $x = 1; foreach ($steps as $step)	{ $x++; ?>
				<li class="step-<?php echo strtolower($step); ?><?php if (++$i === $numSteps) { ?> no-margin<?php } ?>">
					<a href="#<?php echo strtolower($step); ?>-tab" rel="<?php echo strtolower($step); ?>">
                        <span><?php echo $x; ?></span> 
                        <?php echo $step; ?>
                    </a>
				</li>
                
			<?php } ?>
		</ul>
	</div>
</div>