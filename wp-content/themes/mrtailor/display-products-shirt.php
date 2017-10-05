<?php
/* Template Name: Display Products Shirt*/
get_header();

// Default Post Options Values

$settings_post_title = "Shirts";
$settings_type = 'store-settings';

// End Default Post Options Values

if (get_field('store_settings_post_name'))	{
	$settings_post_title = get_field('store_settings_post_name');
}

$settings_posts = get_posts( array( 'post_type' => $settings_type, 'post_status' => 'private', 'posts_per_page' => 12 ) );
foreach ($settings_posts as $setting)	{
	if ($setting->post_title == $settings_post_title)	{
		$settings_id = $setting->ID;
	}
}

$post_type = 'product-shirt';
$current_page_id = $post->ID;
//if ($current_page_id == 11)
//	$current_page_id = 10;
if (get_field('post_type'))	{
	$post_type = get_field('post_type');
}
$current_page_link = get_permalink($current_page_id);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
($paged != 1) ?  $post_page = 16 : $post_page = 15;
$args = array(
	'posts_per_page' => $post_page,
	'paged' => $paged,
	'post_type' => $post_type,
	'orderby' => 'menu_order',
	'order' => 'ASC'
);

if ($_GET['addquery'] == "true")	{
	$tax_relation = "AND";
	if ($_GET['search'])	{
		$args['s'] = $_GET['search'];
	}
	if ($_GET['color'])	{
		$args['tax_query'] = array(
			'relation' => $tax_relation,
			array(
				'taxonomy' => 'product-colors',
				'field' => 'slug',
				'terms' => $_GET['color']
			)
		);
	}
	if ($_GET['design'])	{
		if (empty($args['tax_query']['relation']))	{
			$args['tax_query']['relation'] = $tax_relation;
		}
		$args['tax_query'][] = array(
			'taxonomy' => 'product-designs',
			'field' => 'slug',
			'terms' => $_GET['design']
		);
	}
	if ($_GET['price'])	{
		$args['meta_query'] = array(
			array(
				'key' => 'price',
				'value' => $_GET['price']
			)
		);
	}
}

$wp_query = new WP_Query( $args );
//var_dump($wp_query->request);

$term_args = array(
	'hide_empty' => 0,
	'orderby' => 'id',
	'order' => 'ASC',
);

$colors = get_terms('product-colors', $term_args);
$designs = get_terms('product-designs', $term_args);
$prices = get_prices_array($post_type);
$steps = get_field('select_steps', $settings_id);

if ( in_array( $post_type, array( 'product-made-shirt', 'product-shirt' ) ) && $paged == 1 )	{
	global $wpdb;
	$fabrics = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'product-shirt' AND post_status = 'publish' ORDER BY menu_order ASC" );
}
?>



<form id="general-settings">
	<input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>" />
	<input type="hidden" name="post_type_name" id="browse-shirts-option" value="<?php echo $post_type; ?>" />
	<input type="hidden" name="current_page_id" value="<?php echo $current_page_id; ?>" />
<?php foreach ($steps as $step)	{ ?>
	<input type="hidden" name="steps[]" value="<?php echo strtolower($step); ?>" />
<?php } ?>
<?php if ($_GET['similar'] && array_key_exists($_GET['similar'], $_SESSION['cart']['items']))	{ ?>
	<input type="hidden" name="cart-key" value="<?php echo $_GET['similar']; ?>" />
<?php } ?>
<?php if ($_GET['edit'] && array_key_exists($_GET['edit'], $_SESSION['cart']['items']))	{ ?>
	<input type="hidden" name="cart-key" value="<?php echo $_GET['edit']; ?>" />
	<input type="hidden" name="edit-item" value="1" />
<?php } ?>
</form>
	<div class="content design-shirts-1-content">
	<div class="container">
		<div class="browse-navbar">
		<?php if ($post_type == "product-made-shirt") { ?>
			<div class="row-fluid made-shirt-header">
				<div class="span12">
					<h1>Browse The Collection</h1>
				</div>
			</div>
			<div id="step-header" style="display: none;">
				<?php get_template_part('template-parts/steps-header'); ?>
			</div>
		<?php } else { ?>
			<?php //get_template_part('template-parts/steps-header'); ?>
		<?php } ?>
		</div>
		<div class="browse-wrap product-tab" id="browse-tab">
			<div class="browse">
				<div class="row-fluid">
					<!--<div class="span12">
						<form action="#" id="refine-results" method="post">
							<input type="hidden" name="action" value="refine-results" />
							<div class="search-box">
								<input type="text" value="Search Fabric..." onfocus="if (this.value == 'Search Fabric...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Fabric...';}" id="search-input" name="search-input">	
								<input type="submit" value="">
							</div>
							<div class="clear"></div>
							<ul>
								<li><p id="post_count"><span><?php echo $wp_query->found_posts; ?></span> Fabrics</p></li>
								<li><p>Sort Fabrics By:</p></li>
								<li>
									<select name="all-colors" class="select-change">
										<option value="default">All Colors</option>
									<?php foreach ($colors as $color)	{ ?>
										<option value="<?php echo $color->slug; ?>"><?php echo $color->name; ?></option>
									<?php } ?>
									</select>
								</li>
								<li>
									<select name="all-designs" class="select-change">
										<option value="default">All Designs</option>
									<?php foreach ($designs as $design)	{ ?>
										<option value="<?php echo $design->slug; ?>"><?php echo $design->name; ?></option>
									<?php } ?>
									</select>
								</li>
								<li class="no-margin">
									<select name="all-prices" class="select-change">
										<option value="default">All Prices</option>
									<?php foreach ($prices as $price)	{ ?>
										<option value="<?php echo $price['meta_value']; ?>"><?php echo get_currency_sign() . get_currency_price($price['meta_value']); ?></option>
									<?php } ?>
									</select>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
            <div style="margin-left: 0 !important;margin-right:2.5641% !important" class="span3">
        		<a class="" href="<?php bloginfo('url') ?>/?p=10">
        			<img width="205" alt="Trapelle" src="<?php bloginfo('template_url') ?>/images/design-your-own.gif" class="">
        		</a>
            </div>!-->
            <?php ($paged == 1) ?  $x=2 : $x = 1;?>
			<div class="browse-results search<?php echo $paged; ?>">
            
            
            
            
            
			<?php if ($wp_query->have_posts())	: //$x = 2; ?>
            
				<div class="row-fluid">
                    
				<?php while ( $wp_query->have_posts() )	: $wp_query->the_post(); ?>
                
					<?php display_product_list_shirt($post, $current_page_link); ?>
                    
				<?php if (($x%4) == 0 && $x != 0) { echo '</div><div class="row-fluid">'; } ?>
                
				<?php $x++; endwhile; ?>
                
				</div>
			<?php else : ?>
				<h2>No Results Text</h2>
			<?php endif; ?>
			</div>
			<div class="posts-nav" style="display: none;"><?php next_posts_link(); ?></div>
		</div>
		<form id="main-product-form" method="post" action="<?php echo get_permalink(19); ?>">
		<?php $x = 1; foreach ($steps as $step)	{ $x++; ?>
		<div class="browse-wrap2 product-tab" id="<?php echo strtolower($step); ?>-tab"></div>
		<?php } ?>
		</form>

<?php
if ($fabrics)	{
$no_lining_image = get_field('no_lining_image', 188);
$no_lining_src = $no_lining_image['sizes']['product-thumb-small'];
?>
<div class="lining-fabrics" id="contrasting-collar-cuff-lining-fabrics">
	<p>CONTRASTING COLLAR &amp; CUFF LINING</p>
	<ul>
		<li class="select-fabric selected-fabric" id="selected-fabric">
			<img src="<?php echo $no_lining_src; ?>" alt="No Lining" />
			<span class="fabric-title">No Lining</span>
		</li>
	<?php foreach ($fabrics as $fabric)	{ ?>
		<?php $image_id = get_post_meta($fabric->ID, 'images_0_image', true);
		if ($image_id)	{
			$image_array = wp_get_attachment_image_src( $image_id, 'product-thumb-small' );
			$link = $image_array[0];
		} else {
			$link = $no_lining_src;
		} ?>
		<li class="select-fabric">
			<img src="" alt="<?php echo $fabric->post_title; ?> Lining" width="70" height="70" data-src="<?php echo $link; ?>" />
			<span class="fabric-title" data-fabriccode="<?php echo $fabric->ID; ?>"><?php echo $fabric->post_title; ?></span>
		</li>
	<?php } ?>
	</ul>
</div>
<?php } ?>
	</div>
	</div>

<?php get_template_part( 'info-promo'); ?>
<?php get_footer(); ?>