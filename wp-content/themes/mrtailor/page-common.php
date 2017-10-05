
<?php
/*
Template Name: page inner with slider
*/
?>

<?php get_header(); ?>
    
    
    <div class="page_with_slider inner_top_slider">
       <?php
        global $slider_metabox;
        $slider_metabox->the_meta();
    ?>
    
    <?php
    
	$slider_style = $slider_metabox->get_the_value('slider_template');
	switch ($slider_style) {
		case "style_1":
			include_once('templates/slider/style_1.php');
			break;
		case "style_2":
			include_once('templates/slider/style_2.php');
			break;
		case "style_3":
			include_once('templates/slider/style_3.php');
			break;
		case "style_4":
			include_once('templates/slider/style_4.php');
			break;
		case "style_5":
			include_once('templates/slider/style_5.php');
			break;
		case "style_6":
			include_once('templates/slider/style_6.php');
			break;
		default:
			include_once('templates/slider/style_1.php');
	}
	
	?>
    </div>
    
    <?php if ($post->post_content != "") : ?>
    
    <div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">
        <div class="row">
            <div class="large-8 columns column_container">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <?php endwhile; // end of the loop. ?>
            </div>
            <div class="large-4 columns column_container">
            <?php if(get_field('sidebar_content_area','option')){ echo get_field('sidebar_content_area','option'); } ?>
            </div>
            </div>
            
        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
    <?php endif; ?>
    

<?php get_footer(); ?>

