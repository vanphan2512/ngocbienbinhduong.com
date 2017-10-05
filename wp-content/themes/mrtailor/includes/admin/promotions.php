<?php
function my_custom_post_promotions() {
	$labels = array(
		'name'               => _x( 'Promotions', 'post type general name' ),
		'singular_name'      => _x( 'Promotion', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Promotion' ),
		'edit_item'          => __( 'Edit Promotion' ),
		'new_item'           => __( 'New Promotion' ),
		'all_items'          => __( 'All Promotions' ),
		'view_item'          => __( 'View Promotions' ),
		'search_items'       => __( 'Search Promotions' ),
		'not_found'          => __( 'No promotions found' ),
		'not_found_in_trash' => __( 'No promotions found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Promotions'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds promotions and promotions specific data',
		'public'        => false,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'promotion', $args );	
}
add_action( 'init', 'my_custom_post_promotions' );

function theme_options_add_promotions_page() {
	add_menu_page( 'Promotions', 'Promotions', 'manage_options', 'promo_page', 'promo_page', content_url( 'themes/mrtailor/images/promotions-icon.png' ), 59 );
}
add_action( 'admin_menu', 'theme_options_add_promotions_page' );

function promo_page() {
	global $wpdb;
	$post_type = 'promotion';
	wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/includes/admin/admin-style.css', null, null );
	wp_enqueue_style( 'vc-jquery-ui-css', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', null, null );
	wp_enqueue_script( 'vc-jquery-ui', 'http://code.jquery.com/ui/1.10.3/jquery-ui.js', null, null );
	wp_enqueue_script( 'admin-custom-js', get_template_directory_uri() . '/includes/admin/script.js', null, null );
	wp_localize_script( 'admin-custom-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	$paged = ($_GET['paged']) ? $_GET['paged'] : 1;
	$args = array(
		'post_type' => $post_type,
		'paged' => $paged,
		'posts_per_page' => 100,
	);
	$wp_query = new WP_Query( $args );

	$post_types = get_post_types( '', 'names' );

	if($_GET['promotion'])	{
		$promo_id = $_GET['promotion'];
	}
	$promo_title = $promo_id ? get_the_title($promo_id) : "";
	$promo_start_date = $promo_id ? date("m/d/Y", get_post_meta($promo_id, 'promo_start_date', true)) : "";
	$promo_expiry_date = $promo_id ? date("m/d/Y", get_post_meta($promo_id, 'promo_expiry_date', true)) : "";
	$promo_active = $promo_id ? get_post_meta($promo_id, 'promo_active', true) : "false";
	$active = "checked";
	if ($promo_active == "false")
		$active = "";
	$promotion_applies_to = $promo_id ? get_post_meta($promo_id, 'promotion_applies_to', true) : array();
	$promotion_rule = $promo_id ? get_post_meta($promo_id, 'promotion_rule', true) : array();
?>
	<div class="wrap">
		<div id="icon-orders_page" class="icon32">
			<img src="<?php bloginfo('template_url'); ?>/images/promotions-icon-32.jpg" />
		</div>
		<?php echo "<h2>" . __( ' Promotions ', 'pickashirt' ) . " <a class=\"add-new-h2\" onclick=\"jQuery('#new-promotion').slideToggle();\">Add New Promoion</a></h2>"; ?>
		<div id="new-promotion">
			<h3>New Promotion</h3>
			<form method="post" action="" id="promotion_form">
				<input type="hidden" name="action" value="add-promotion-form" />
				<label><span>Promotion Name:</span> <input type="text" name="promotion_name" value="<?php echo $promo_title; ?>" /></label><br><br>
				<label><span>Start Date:</span> <input type="text" id="datepicker1" name="promotion_sdate" value="<?php echo $promo_start_date; ?>" /></label><br><br>
				<label><span>Expiry Date:</span> <input type="text" id="datepicker2" name="promotion_edate" value="<?php echo $promo_expiry_date; ?>" /></label><br><br>
				<label><span>Active:</span> <input type="checkbox" name="promotion_active" value="true" <?php echo $active ?> /></label>
				<br class="clear">
				<div style="width: 60%; float: left;">
					<h4>Promotion applies to:</h4>
					<table style="width: 90%; text-align: left;">
						<thead>
						<tr>
							<th>Select Product Type</th>
							<th>Select Product</th>
							<th>Products Quantity</th>
							<!--<th>Promotion Amount</th>-->
							<!--<th></th>-->
						</tr>
						</thead>
						<tbody>
										
								<?php
  $taxonomy     = 'product_cat';
  $orderby      = 'name';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;
$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'hide_empty'   => $empty
);


if(!empty($_REQUEST['promotion']))
{
	$meta_values_promotion_applies_to = get_post_meta($_REQUEST['promotion'], 'promotion_applies_to');
	$promotion_post_type=$meta_values_promotion_applies_to[0][0]['promo_post_type'];
	$promo_product_qty=$meta_values_promotion_applies_to[0][0]['promo_product_qty'];
	
	 $promo_product_sel=$meta_values_promotion_applies_to[0][0]['promo_product'];
	
	
}
?>
<?php $all_categories = get_categories( $args );

								
								$z=1;
								?>
						<?php //if (!empty($promotion_applies_to))	{ ?>
						<?php if ($z==1)	{ ?>
						<?php //$x = 0; foreach ($all_categories as $promo)	{ ?>
						<tr>
							<td>
				
								<!--<select name="promotion_post_type[]" class="promotion_post_type">
								<?php //foreach ($all_categories as $cat)	{ ?>
									<option value="<?php //echo $cat->term_id ?>"><?php //echo $cat->name; ?></option>
								<?php //} ?>
								</select>-->
								<select name="promotion_post_type[]" class="promotion_post_type">
									<!--<option value="all" selected="selected">All</option>-->
									<option value="67" <?php if($promotion_post_type==67) { echo "selected=selected"; }?>>Shirt</option>
									<option value="69" <?php if($promotion_post_type==69) { echo "selected=selected"; }?>>Suit</option>
									<option value="68" <?php if($promotion_post_type==68) { echo "selected=selected"; }?>>Jacket</option>
									<option value="70" <?php if($promotion_post_type==70) { echo "selected=selected"; }?>>Blazer</option>
									<option value="72" <?php if($promotion_post_type==72) { echo "selected=selected"; }?>>Pant</option>
									<option value="71" <?php if($promotion_post_type==71) { echo "selected=selected"; }?>>Chinos</option>
									
									
								
								</select>
							</td>
							<td>
								<select name="promotion_products[]" class="promotion_products" style="width: 180px;">
									<option value="all">All</option>
								<?php /*if (!empty($promo) && $promo['promo_product'])	{ ?>
									<option value="<?php echo $promotion_applies_to['promo_product']; ?>"><?php echo get_the_title($promo['promo_product']); ?></option>
								<?php }*/ ?>
								<?php if (!empty($promo_product_sel))	{?>
									<option value="<?php echo $promo_product_sel; ?>" selected="selected"><?php echo get_the_title($promo_product_sel); ?></option>
								<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" name="product_qty[]" value="<?php echo $promo_product_qty; ?>" /> or more
							</td>
						<!--
							<td>
								<input type="text" name="promotion_amount[]" value="<?php echo $promo['promo_amount']; ?>" /> or more
							</td>
						-->
						<?php /* if ($x == 0)	{ ?>
							<td><a class="add-new-h2 add_rule">+ Add new Rule</a></td>
						<?php } else { ?>
							<td><a class="delete_rule add-new-h2">- Delete Rule</a></td>
						<?php } ?>
						</tr>
						<?php $x++; */ //} ?>
						<?php } else { ?>
						<tr>
							<td>
								<select name="promotion_post_type[]" class="promotion_post_type">
								<?php foreach ($post_types as $post_type)	{ ?>
									<?php if ( strstr($post_type, "product") && !in_array( $post_type, array( 'product-voucher', 'product-orders' ) ) )	{ ?>
									<?php $type = explode("-", $post_type); ?>
									<option value="<?php echo $post_type; ?>">
										<?php if ($type[1] == "made") {echo 'Ready ' . ucfirst($type[1]) . ' Shirts';} else { echo ucfirst($type[1]); } ?>
									</option>
									<?php } ?>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="promotion_products[]" class="promotion_products" style="width: 180px;">
									<option value="all">All</option>
								</select>
							</td>
							<td>
								<input type="text" name="product_qty[]" value="" /> or more
							</td>
						<!--
							<td>
								<input type="text" name="promotion_amount[]" value="" /> or more
							</td>
							<td><a class="add-new-h2 add_rule">+ Add new Rule</a></td>
						-->
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div style="width: 40%; float: left;">
					<h4>Promotion Rule:</h4>
					<table style="width: 90%; text-align: left;">
						<thead>
						<tr>
							<th>Promotion Type</th>
							<th>Select Free Item</th>
							<!--<th>Discount Amount</th>-->
							<!--<th></th>-->
						</tr>
						</thead>
						<tbody>
					<?php $promotion_type = array('free_item' => 'Free Item', 'free_shipping' => 'Free Shipping'); ?>
						<?php if (!empty($promotion_rule))	{ ?>
						<?php $x = 0; foreach ($promotion_rule as $promo_rule)	{ ?>
						<tr>
							<td>
								<select name="promotion_type[]" class="promotion_type">
									<option value="">-</option>
								<?php foreach ($promotion_type as $k => $v)	{ ?>
									<option value="<?php echo $k; ?>" <?php if (!empty($promo_rule) && $promo_rule['promo_type'] == $k) echo "selected" ?>><?php echo $v; ?></option>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="promotion_free_item[]" class="promotion_free_item" style="width: 180px;">
									<option value="">-</option>
								<?php if (!empty($promo_rule) && $promo_rule['promo_free_item'])	{ $type = ""; ?>
								<?php if (strstr($promo_rule['promo_free_item'], "-")) {$type = explode("-", $promo_rule['promo_free_item']); } ?>
									<option value="<?php echo $promo_rule['promo_free_item']; ?>" selected>
										<?php
										if ($type)	{
											if ($type[1] == "made") {
												echo 'Ready ' . ucfirst($type[1]) . ' Shirts';
											} else {
												echo ucfirst($type[1]);
											}
										} else {
											echo get_the_title($promo_rule['promo_free_item']);
										}
									?>
									</option>
								<?php } ?>
								</select>
							</td>
						<!--
							<td>
								<input type="text" name="discount_amount[]" value="<?php echo $promo_rule['promo_discount_amount']; ?>" />
							</td>
						-->
						<?php /* if ($x == 0)	{ ?>
							<td><a class="add-new-h2 add_rule">+ Add new Rule</a></td>
						<?php } else { ?>
							<td><a class="delete_rule add-new-h2">- Delete Rule</a></td>
						<?php } ?>
						</tr>
						<?php $x++; */ } ?>
						<?php } else { ?>
						<tr>
							<td>
								<select name="promotion_type[]" class="promotion_type">
									<option value="">-</option>
								<?php foreach ($promotion_type as $k => $v)	{ ?>
									<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="promotion_free_item[]" class="promotion_free_item" style="width: 180px;">
									<option value="">-</option>
								</select>
							</td>
						<!--
							<td>
								<input type="text" name="discount_amount[]" value="" />
							</td>
							<td><a class="add-new-h2 add_rule">+ Add new Rule</a></td>
						-->
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<br class="clear">
				<br class="clear">
				<div style="float: right;">
					<input type="submit" name="add-promotion" class="button-primary" value="Add Promotion" />
				</div>
			</form>
		</div>

		<div class="tablenav top">
			<div class="tablenav-pages one-page">
				<span class="displaying-num"><?php echo $wp_query->found_posts; ?> promotion(s)</span>
			</div>
			<br class="clear">
		</div>

		<div id="promotions">
			<table class="wp-list-table widefat fixed posts" cellspacing="0">
				<thead>
					<tr>
						<th scope="col">Promotion Name</th>
						<th scope="col">Start Date</th>
						<th scope="col">Expiry Date</th>
						<th scope="col"><span>Status</span></th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th scope="col">Promotion Name</th>
						<th scope="col">Start Date</th>
						<th scope="col">Expiry Date</th>
						<th scope="col"><span>Status</span></th>
						<th scope="col">Delete</th>
					</tr>
				</tfoot>
				<tbody id="the-list">
				<?php  if ($wp_query->have_posts())	: ?>
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $promo_ID = get_the_ID(); ?>
					<tr class="type-post format-standard" valign="top">
						<td scope="row" class="promo_name"><strong><a href="admin.php?page=promo_page&amp;promotion=<?php echo $promo_ID; ?>"><?php the_title(); ?></a></strong></td>
						<td class="promo_sdate"><?php echo date("m/d/Y", get_post_meta($promo_ID, 'promo_start_date', true)); ?></td>
						<td class="promo_expiry"><?php echo date("m/d/Y", get_post_meta($promo_ID, 'promo_expiry_date', true)); ?></td>
						<td class="promo_status"><?php echo get_post_meta($promo_ID, 'promo_active', true) ? "Yes" : "No"; ?></td>
						<td>
							<a href="#" rel="<?php echo $promo_ID; ?>" class="delete-promotion">
								<img src="<?php bloginfo('template_url'); ?>/includes/admin/images/delete.png" alt="Delete Promotion <?php the_title(); ?>" />
							</a>
						</td>
					</tr>
				<?php endwhile; else 	: ?>
					<tr><td colspan="6" style="text-align: center;"><h3>You haven't added any promotions yet.</h3></td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

<?php
}

add_action('wp_ajax_add-promotion-form', 'add_promotion_form', 9999);

function add_promotion_form()	{

	

	$result['error'] = $result['success'] = "";

	if (empty($_POST['promotion_name']))	{
		$result['error'] = "Promotion Name is Mandatory!";

		echo json_encode($result);

		die();
	}

	global $wpdb;

	if ($promo_exists = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $_POST['promotion_name'] . "' AND post_type = 'promotion'" ))	{
		$promo_id = $promo_exists;
	} else {

		$date = date("Y-m-d H:i:s");
		$promotion = array(
			'comment_status' => 'closed',
			'ping_status'	=> 'closed',
			'post_author'	=> 1,
			'post_date'		=> $date,
			'post_date_gmt'	=> gmdate("Y-m-d H:i:s"),
			'post_status'	=> 'private',
			'post_title'	=> $_POST['promotion_name'],
			'post_type'		=> 'promotion'
		);
		$promo_id = wp_insert_post($promotion);
	}

	if ($promo_id)	{

		update_post_meta($promo_id, 'promo_active', $_POST['promotion_active']);
		update_post_meta($promo_id, 'promo_start_date', strtotime($_POST['promotion_sdate']));
		update_post_meta($promo_id, 'promo_expiry_date', strtotime($_POST['promotion_edate']));

		// Add the Promotion options ????

		$promotion_applies = array();
		$promotion_rule = array();

		foreach ($_POST['promotion_post_type'] as $x => $value)	{
			$promotion_applies[] = array(
				'promo_post_type' => $value,
				'promo_product' => $_POST['promotion_products'][$x],
				'promo_product_qty' => $_POST['product_qty'][$x],
			//	'promo_amount' => $_POST['promotion_amount'][$x]
			);
			update_post_meta($promo_id, 'promotion_post_type', $value);
		}

		if (!empty($promotion_applies))	{
			update_post_meta($promo_id, 'promotion_applies_to', $promotion_applies);
		}

		foreach ($_POST['promotion_type'] as $x => $value)	{
			if ($value)	{
				
			/*
				if (empty($_POST['discount_amount'][$x]))	{
					$result['error'] = "You Need to specify a Discount Amount (Quantity)!";
					echo json_encode($result);
					die();
				}
			*/

				$promotion_rule[] = array(
					'promo_type' => $value,
					'promo_free_item' => $_POST['promotion_free_item'][$x],
				//	'promo_discount_amount' => $_POST['discount_amount'][$x]
				);
			}
		}

		if (!empty($promotion_rule))	{
			update_post_meta($promo_id, 'promotion_rule', $promotion_rule);
		}


		$result['success'] = "Success!";
		$result['aid'] = $promo_id;

	}

	echo json_encode($result);

	die();



}

add_action('wp_ajax_get-promo-prods', 'get_promo_prods', 9999);

function get_promo_prods() {
	global $wpdb;

	
$cat_id=$_REQUEST['post_type'];
 /*$sql="SELECT ID, post_date ,  post_title FROM  wp_posts as post INNER JOIN wp_term_relationships rs ON rs.object_id = post.ID 
WHERE  post_type =  'product' AND  post_status =  'publish' AND rs.term_taxonomy_id  = $cat_id ORDER BY post_date";*/


 $sql="SELECT ID, post_date ,  post_title from wp_posts post,wp_term_relationships rs INNER JOIN wp_term_taxonomy t ON rs.term_taxonomy_id = t.term_taxonomy_id
	where t.term_id=$cat_id and rs.object_id = post.ID and post.post_status='publish'";



 
$items = $wpdb->get_results($sql);


	echo json_encode($items);

	die();
}

add_action('wp_ajax_get-promo-items', 'get_promo_items', 9999);

function get_promo_items() {
	global $wpdb;
	$post_types = get_post_types( '', 'names' );

	$promo_type = $_POST['promo_type'];

	if ($promo_type == 'free_item')	{
	
		/*$sql="SELECT * FROM  `wp_posts` as post INNER JOIN wp_term_relationships rs ON rs.object_id = post.ID WHERE  `post_type` =  'product' AND  `post_status` =  'publish' AND rs.term_taxonomy_id  = 80
		ORDER BY post_date";*/
		$sql="SELECT ID, post_date ,  post_title from wp_posts post,wp_term_relationships rs INNER JOIN wp_term_taxonomy t ON rs.term_taxonomy_id = t.term_taxonomy_id
	where t.term_id=80 and rs.object_id = post.ID and post.post_status='publish'";

		$result = $wpdb->get_results($sql);

	
	} 
	echo json_encode($result);

	die();
}

add_action('wp_ajax_delete-promotion', 'delete_promotion', 9999);

function delete_promotion() {
	
	if (!$_POST['promotion_id'])
		echo json_decode(array('error' => 'There has been an error deleting the promotion'));

	$deleted = wp_delete_post( $_POST['promotion_id'], true );

	if ($deleted)	{
		echo json_encode( array('success' => 'Promotion Deleted Succesfully!') );
	}

	die();
}
?>