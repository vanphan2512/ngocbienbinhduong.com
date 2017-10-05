<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

    
	<div id="primary" class="content-area page-contact">
       
        <div id="content" class="site-content" role="main">
             <?php 
                if ( has_post_thumbnail() ) {
                    $page_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                    $page_bg_image = 'style="background-image:url(' . $page_image_url[0] . ');"';
                    $title_with_bg = 'title-with-bg';
                } else {
                    $title_with_bg = 'wrapper title-with-sep';
                } 
            ?>
            <header class="entry-header with_featured_img" <?php echo isset( $page_bg_image ) ? $page_bg_image : ''; ?>>
                 
                <div class="page_header_overlay"></div>
            
                <div class="row">
                    <div class="large-12 large-centered columns without-sidebar">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </div>            
            </header>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="row">
                    <div class="large-12 large-centered columns">
                        <?php get_template_part( 'content', 'page' ); ?>
   
                        <div class="clearfix"></div>
                        <footer class="entry-meta">    
                            <?php edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
                        </footer><!-- .entry-meta -->
                        
                    </div>
                </div>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
<?php get_footer(); ?>
