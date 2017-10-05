<?php
/*
Template Name: Tin Tuc Thi Truong
*/ 
?>

<?php get_header(); ?>
    

    <div id="primary" class="content-area">
       
        <div class="site-content" role="main">
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
        <?php 
            $post_intro = array( 
                'post_type'    =>    'post',
                'cat'          =>        154,
                'order'       =>        'DESC',

            );
            $myposts= query_posts($post_intro); 
            foreach( $myposts as $post ) :  setup_postdata($post);
            $thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full');   
            $thumb_image_share = wp_get_attachment_image_src( get_post_thumbnail_id(),'rectangle-size');          
                // var_dump($post);
        
        ?>
        <div class="row">
        <div class="large-12 columns entry-content news-item">
            <div class="row">
                <div class="large-3 columns">
                    <div class="img_news">                      
                      
                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                         <div class="entry-thumbnail" style="background-image: url('<?php echo $thumb_image[0];?>');width: 100%;height: 180px;background-position: center center;background-size: cover;"></div>    
                        <?php else : ?>
                            <div class="entry-thumbnail">
                                <img src="<?php echo get_stylesheet_directory_uri()?>/images/img-default.png">
                            </div>
                        <?php endif; // is_single() ?>      
                    </div>
                    
                </div>

                <div class="large-9 columns">
                    <div class="content_news">
                        <a href="<?php echo get_permalink( $post->ID );?>"><?php  the_title(); ?></a>
                        <p class="cont_news"><?php  echo wp_trim_words( get_the_content(), 100, ' ...' ); ?></p> 
                        <a class="read-more-link" href="<?php the_permalink() ?>"><?php _e( 'Xem thêm', 'themetext' ); ?></a>
                    </div>
                </div>
            </div> 
        </div><!-- .entry-content -->
        </div>
    <?php endforeach; ?>   

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
   
    
<?php get_footer(); ?>
