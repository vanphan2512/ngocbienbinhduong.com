<?php 
//global $product; 
global $wpdb;
$query = "SELECT   wp_posts.*, AVG( wp_commentmeta.meta_value ) as average_rating  FROM wp_posts  INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id)
			LEFT OUTER JOIN wp_comments ON(wp_posts.ID = wp_comments.comment_post_ID)
			LEFT JOIN wp_commentmeta ON(wp_comments.comment_ID = wp_commentmeta.comment_id)
		 WHERE 1=1  AND wp_posts.post_type = 'product' AND ((wp_posts.post_status = 'publish')) AND ( (wp_postmeta.meta_key = '_visibility' AND CAST(wp_postmeta.meta_value AS CHAR) IN ('visible','catalog')) ) AND ( wp_commentmeta.meta_key = 'rating' OR wp_commentmeta.meta_key IS null ) AND ((wp_posts.post_author = 1 ))  GROUP BY wp_posts.ID ORDER BY average_rating DESC, wp_posts.post_date DESC LIMIT 0, 2";

$custom_top_rate_widget = $wpdb->get_results($query, OBJECT );
?>

<?php foreach($custom_top_rate_widget as $temp){?>
<li>
	<a href="<?php echo $temp->guid ; ?>" title="<?php echo $temp->post_title; ?>">		
		<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $temp->ID ) )[0] ;?>">
		<?php echo $temp->post_title; ?>
	</a>	
	<?php 
		$query_get_price = "SELECT meta_value FROM `wp_postmeta` WHERE `post_id`= ".$temp->ID." and meta_key = '_price'";
		$result = $wpdb->get_results($query_get_price, OBJECT );
		foreach($result as $temp2){
			echo  "$".$temp2->meta_value;
		}
	?>
</li>
<?php } ?>