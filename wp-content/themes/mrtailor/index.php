<?php 
$blog_with_sidebar = "";
if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<?php get_header(); ?>

    <div id="primary" class="content-area">                    
            <div class="row"><h1 style="text-align:center; text-transform:uppercase;">blog</h1></div>
		<?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="row">
            <div class="large-8 columns with-sidebar">
        <?php endif; ?>
                
                <div id="content" class="site-content" role="main">             

					<?php if ( have_posts() ) : ?>
            
                        <?php /* Start the Loop */ ?>
                        <div class="row">
                        <ul class="blog_loop_box">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li>
							<?php //get_template_part( 'content', get_post_format() ); ?>
                            <?php the_post_thumbnail(); ?>
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <div class="post_header_date"><?php mr_tailor_post_header_entry_date(); ?></div>
                            <!--<hr class="content_hr" />-->
                            </li>
                        <?php endwhile; ?>
                        </ul>
            </div>
            
            
                        <?php //mr_tailor_content_nav( 'nav-below' ); ?>
            
                    <?php else : ?>
            
                        <?php get_template_part( 'no-results', 'index' ); ?>
            
                    <?php endif; ?>
                
                </div><!-- #content -->                            
            
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
        		</div><!-- .columns -->
        
        
            
            <?php endif; ?>
    
			<?php if ( $blog_with_sidebar == "yes" ) : ?>
				<div class="large-4 columns">        					
					<?php get_sidebar(); ?>			           
                </div><!-- .columns -->
            <?php endif; ?>
            
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
        	</div><!-- .row -->
        <?php endif; ?>
                 
    </div><!-- #primary -->
    
           

            
<?php get_footer(); ?>