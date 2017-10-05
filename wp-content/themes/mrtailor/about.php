<?php
/* Template Name:  Gioi thieu */
	global $mr_tailor_theme_options;

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<?php get_header(); ?>
<link rel='stylesheet' id='sts-style-css'  href="<?php echo bloginfo('template_directory')?>/css/swiper/swiper.css" type='text/css' media='all' />
	<div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">
        
       		<div class="entry-header <?php if ($page_header_src != "") : ?>with_featured_img<?php endif; ?>" style="background-image:url(<?php echo $page_header_src; ?>) ">
        
                <div class="page_header_overlay"></div>
                
                <div class="row">
                    <?php if ( $blog_with_sidebar == "yes" ) : ?>
                    <div class="large-12 columns">
                    <?php else : ?>
                    <div class="large-12 large-centered columns without-sidebar aaabbb">
                    <?php endif; ?>
        
                        <?php if ( is_page() ) : ?>
        
                        <h1 class="entry-title "><?php the_title(); ?></h1>
                        
                        <?php if($post->post_excerpt) : ?>
                            <div class="page-description"><?php the_excerpt(); ?></div>
                        <?php endif; ?>
                        
                        <?php else : ?>
        
                        <h1 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>
        
                        <?php endif; // is_page() ?>
        
                    </div>
                </div>
        
            </div><!-- .entry-header -->
			<?php
			if($_REQUEST['s']==1)
			{
				echo '<p style="text-align:center;">Congratulations! Your account has been activated. You can now proceed with login.</p>';
			}
			?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>
                    
                <?php if (function_exists('is_cart') && is_cart()) : ?>
                <?php else: ?>    
                <div class="clearfix"></div>
                <footer class="entry-meta">    
                    <?php edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
                </footer><!-- .entry-meta -->
                <?php endif; ?>

                <?php
                    
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) comments_template();
                    
                ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->

    <script type='text/javascript' src="<?php echo bloginfo('template_directory') ?>/js/swiper/swiper.min.js"></script>

    <script>
    var swiper = new Swiper('.best-selling-product .swiper-container', {
        pagination: '.swiper-pagination',
        autoplay: 3000,
        slidesPerView: 2,
        direction: 'vertical',
          breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 2,
            },
            640: {
                slidesPerView: 1,
            },
            320: {
                slidesPerView: 1,

            }
        }
    });
    </script>
<?php get_footer(); ?>
