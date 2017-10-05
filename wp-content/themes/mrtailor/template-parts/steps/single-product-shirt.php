<?php

// Default Post Options Values
$product_id = $post->ID;
$settings_post_title = "Shirts";
$settings_type = 'store-settings';

// End Default Post Options Values

if (get_field('store_settings_post_name'))	{
	$settings_post_title = get_field('store_settings_post_name');
}

$settings_posts = get_posts( array( 'post_type' => $settings_type, 'post_status' => 'private', 'posts_per_page' => -1 ) );
foreach ($settings_posts as $setting)	{
	if ($setting->post_title == $settings_post_title)	{
		$settings_id = $setting->ID;
	}
}

$post_type = 'product-shirt';
$current_page_id = 10;

if (get_field('post_type'))	{
	$post_type = get_field('post_type');
}
$current_page_link = get_permalink($current_page_id);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'posts_per_page' => 16,
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
get_header(); 
?>
<style>
    li.menu-item-34 a{
        color:#777777;
    }
</style>
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
	       <?php get_template_part('template-parts/steps-header'); ?>
		</div>
        
    </div>
    <div class="product_single_wrap">
    	<div class="row">
          <div class="large-12 columns">
        <form id="main-product-form" action="<?php bloginfo('url') ?>/?page_id=502" method="post">
            <?php include_once( 'template-parts/steps/product-step-design.php' ); ?>
            <?php include_once( 'template-parts/steps/product-step-extras.php' ); ?>
            <?php include_once( 'template-parts/steps/product-step-sizing.php' ); ?>
            <?php //get_template_part('template-parts/product-extra'); ?>
        </form>
          </div>
        </div>
    </div>
    
    <div class="row"><?php the_field('fabric_details'); ?></div>
<?php
	if ($fabrics) {
		$no_lining_image = get_field('no_lining_image', 188);
		$no_lining_src = $no_lining_image['sizes']['product-thumb-small'];
	?>
   
	<div class="lining-fabrics" id="contrasting-collar-cuff-lining-fabrics">
		<p>CONTRASTING COLLAR &amp; CUFF LINING </p>

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

<?php get_template_part( 'info-promo'); ?>
<?php get_footer() ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('body').addClass('single-design');
        
        jQuery('.browse-product-wrap.extract').addClass('remove');
        jQuery('.measure-wrap').addClass('remove');
        jQuery('li.step-design').addClass('browse-navbar-active');
        //////////////
        jQuery('.design.change-step').click(function(){
           jQuery('.browse-product-wrap.design').addClass('remove');
           jQuery('.browse-product-wrap.design').removeClass('block');
           
           jQuery('.browse-product-wrap.extract').removeClass('remove'); 
           
        });
        /////////////
        jQuery('.extract.change-step').click(function(){
           jQuery('.browse-product-wrap.design').addClass('remove');
           jQuery('.browse-product-wrap.design').removeClass('block');
           
           jQuery('.browse-product-wrap.extract').addClass('remove');
           jQuery('.browse-product-wrap.extract').removeClass('block');
           
           jQuery('.measure-wrap').removeClass('remove');
           
        });
        jQuery('.extract.step-back').click(function(){
           jQuery('.browse-product-wrap.design').removeClass('remove');
           jQuery('.browse-product-wrap.extract').removeClass('block');
           jQuery('.browse-product-wrap.extract').addClass('remove');
           jQuery('.measure-wrap').addClass('remove');
            
        });
        
        jQuery('.measure.step-back').click(function(){
           jQuery('.browse-product-wrap.design').addClass('remove');
           jQuery('.browse-product-wrap.extract').addClass('block');
           jQuery('.measure-wrap').addClass('remove');
           jQuery('.browse2-product-extra').removeClass('remove');
            
        });
        /////////////
        jQuery('li.step-select').click(function(){
            jQuery('li.step-select').addClass('browse-navbar-active');
            jQuery('li.step-design').removeClass('browse-navbar-active');
            jQuery('li.step-extras').removeClass('browse-navbar-active');
            jQuery('li.step-sizing').removeClass('browse-navbar-active');
        });
        /////////////
        jQuery('li.step-design').click(function(){
            jQuery('.browse-product-wrap.design').addClass('block');
            
            //hide sizing
            jQuery('.measure-wrap').removeClass('blog');
            jQuery('.measure-wrap').addClass('remove');
            //hide extract
            jQuery('.browse-product-wrap.extract').removeClass('block');
          //  jQuery('.browse-product-wrap.extract').addClass('remove');
            
            jQuery('li.step-design').addClass('browse-navbar-active');
            jQuery('li.step-extras').removeClass('browse-navbar-active');
            jQuery('li.step-sizing').removeClass('browse-navbar-active');
        });
        
        jQuery('li.step-extras').click(function(){
            //hide design
            jQuery('.browse-product-wrap.design').removeClass('block');
            jQuery('.browse-product-wrap.design').addClass('remove');
            //hide sizing
            jQuery('.measure-wrap').removeClass('block');
            jQuery('.measure-wrap').addClass('remove');
            //show extract
            jQuery('.browse-product-wrap.extract').addClass('block');
            
            jQuery('li.step-extras').addClass('browse-navbar-active');
            jQuery('li.step-design').removeClass('browse-navbar-active');
            jQuery('li.step-sizing').removeClass('browse-navbar-active');
        });
        
        jQuery('li.step-sizing').click(function(){
            jQuery('.measure-wrap').removeClass('remove');
            jQuery('.browse-product-wrap.extract').removeClass('block');
            jQuery('.browse-product-wrap.design').removeClass('block');
            
            jQuery('.browse-product-wrap.design').addClass('remove');
            
            jQuery('li.step-sizing').addClass('browse-navbar-active');
            jQuery('li.step-extras').removeClass('browse-navbar-active');
            jQuery('li.step-design').removeClass('browse-navbar-active');
            //hide browse2-product-feed && hide browse2-product-extra
          //  jQuery('.browse2-product-feed').addClass('remove');
            //jQuery('.browse2-product-extra').addClass('remove');
        });
        $('body').on( 'click', function(){
            if(jQuery('body .li.step-design').hasClass('active_step')){
                //alert('aaaaaa')
                jQuery('.browse-product-wrap.design').removeClass('remove');
                jQuery('.measure-wrap').removeClass('block');
                jQuery('.browse-product-wrap.extract').removeClass('block');
            }
        });
        $('body').on( 'click', function(){
            if(jQuery('.browse-product-wrap.design').hasClass('remove')&&jQuery('.browse-product-wrap.extract').hasClass('remove')){
                jQuery('.browse2-product-feed').addClass('remove');
                jQuery('.browse2-product-extra').addClass('remove');
            }
        });
        
        $('body').on( 'click', function(){
            if(jQuery('.browse-product-wrap.extract').hasClass('block')){
                jQuery('.browse2-product-feed').removeClass('remove');
                jQuery('.browse2-product-extra').removeClass('remove');
            }
        });
        
    }); 
</script>
<style>
li.step-select{
    cursor:pointer;
}
</style>
