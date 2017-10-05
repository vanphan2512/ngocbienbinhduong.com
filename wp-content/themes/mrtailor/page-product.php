<?php
/*
Template Name: san pham
*/
?>

<?php get_header(); ?>
       <header class="entry-header">
       <?php 
            if ( has_post_thumbnail() ) {
                $page_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                $page_bg_image = 'style="background-image:url(' . $page_image_url[0] . ');"';
                $title_with_bg = 'title-with-bg';
            } else {
                $title_with_bg = 'wrapper title-with-sep';
            } 
        ?>
            <div  id="primary" class="content-area">
                <div class="page-title <?php echo isset( $title_with_bg ) ? $title_with_bg : ''; ?>" <?php echo isset( $page_bg_image ) ? $page_bg_image : ''; ?>>
                    <div class="wrapper title-banner" style="min-height: 550px;" >
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div><!-- .full-width-page -->
        </header>

    <div id="primary" class="content-area">
       
        <div class="row site-content" role="main">
      
        <div class="large-12 columns entry-content">
            <div class="row">
               <?php
                $customPostTaxonomies = get_object_taxonomies('product');
                
                if(count($customPostTaxonomies) > 0)
                {
                     foreach($customPostTaxonomies as $tax)
                     {
                	     $args = array(
                            'orderby' => 'name',
                            'show_count' => 1,
                            'pad_counts' => 1,
                            'hierarchical' => 1,
                            'taxonomy' => $tax,                            
                            'feed_image' => ''                          
                
                
                        	);
                            ?>
                              <ul class="categories">
                                    <?php wp_list_categories( $args ); ?>
                                </ul>
                            <?php

                     }
                }
                 
               ?>

      

            </div> 
        </div><!-- .entry-content -->
  

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
   
    
<?php get_footer(); ?>
