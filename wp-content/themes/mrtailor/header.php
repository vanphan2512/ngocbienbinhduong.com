<?php	
	global $mr_tailor_theme_options;
	global $woocommerce;
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <!-- 
   <?php if(is_front_page()){ 
    ?>
    
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php } else {
		
		echo '<meta name="viewport"  content="width=1350">';
    
    if(stripos($_SERVER['HTTP_USER_AGENT'],"Android") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
		
		  echo '<meta name="viewport"  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no ">';
							?>
                            <style type="text/css">
                               /*#st-container{ width:1350px;}*/
                            </style>
                            
                            <?php
						}
						elseif(stripos($_SERVER['HTTP_USER_AGENT'],"iPad") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
							echo '<meta name="viewport" content="width=1350, initial-scale=0, user-scalable=1.0, minimum-scale=0, maximum-scale=1.0">';
							}
							elseif(stripos($_SERVER['HTTP_USER_AGENT'],"iPhone") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
							echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no ">';
							}?>
      
    <?php } ?> -->
    
    <!-- ******************************************************************** -->
    <!-- * Title ************************************************************ -->
    <!-- ******************************************************************** -->
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--<script src="<?php echo get_stylesheet_directory_uri().'/js/jquery.form.js'; ?>"></script>--!>

    
    <?php if ( (isset($mr_tailor_theme_options['main_font_typekit_kit_id'])) && ($mr_tailor_theme_options['main_font_typekit_kit_id'] != "") ) : ?>
    	<script type="text/javascript" src="//use.typekit.net/<?php echo $mr_tailor_theme_options['main_font_typekit_kit_id']; ?>.js"></script>
    <?php endif; ?>
	
    <?php if ( (isset($mr_tailor_theme_options['secondary_font_typekit_kit_id'])) && ($mr_tailor_theme_options['secondary_font_typekit_kit_id'] != "") ) : ?>
    	<script type="text/javascript" src="//use.typekit.net/<?php echo $mr_tailor_theme_options['secondary_font_typekit_kit_id']; ?>.js"></script>
    <?php endif; ?>
	
	<?php if ( ((isset($mr_tailor_theme_options['main_font_typekit_kit_id'])) && ($mr_tailor_theme_options['main_font_typekit_kit_id'] != "")) || ((isset($mr_tailor_theme_options['secondary_font_typekit_kit_id'])) && ($mr_tailor_theme_options['secondary_font_typekit_kit_id'] != "")) ) : ?>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php endif; ?>
    
    <!-- ******************************************************************** -->
    <!-- * Custom Favicon *************************************************** -->
    <!-- ******************************************************************** -->
    
    <?php
	if ( (isset($mr_tailor_theme_options['favicon']['url'])) && (trim($mr_tailor_theme_options['favicon']['url']) != "" ) ) {
        
        if (is_ssl()) {
            $favicon_image_img = str_replace("http://", "https://", $mr_tailor_theme_options['favicon']['url']);		
        } else {
            $favicon_image_img = $mr_tailor_theme_options['favicon']['url'];
        }
	?>
    
    <!-- ******************************************************************** -->
    <!-- * Favicon ********************************************************** -->
    <!-- ******************************************************************** -->
    
    <link rel="shortcut icon" href="<?php echo $favicon_image_img; ?>" />
        
    <?php } ?>
    
    <!-- ******************************************************************** -->
    <!-- * Custom Header JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($mr_tailor_theme_options['header_js'])) && ($mr_tailor_theme_options['header_js'] != "") ) : ?>
		<script type="text/javascript">
			<?php echo $mr_tailor_theme_options['header_js']; ?>
		</script>
    <?php endif; ?>
    
    <!-- ******************************************************************** -->
    <!-- * WordPress wp_head() ********************************************** -->
    <!-- ******************************************************************** -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="<?php echo bloginfo('template_directory')?>/js/jquery-ias.min.js" type="text/javascript"></script>
    <script src="<?php echo bloginfo('template_directory')?>/js/jquery.jscroll.js" type="text/javascript"></script>
    <script src="<?php echo bloginfo('template_directory')?>/js/jquery.jscroll.min.js" type="text/javascript"></script>
<?php wp_head(); 

?>
<link rel='stylesheet' id='admin-bar-css'  href='http://jcoutier.com/wp-includes/css/admin-bar.min.css?ver=3.7.1' type='text/css' media='all' />


<link rel='stylesheet' id='bootstrap-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap.min.css" type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap3-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap.min.css" type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-responsive-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap-responsive.css" type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href="<?php echo bloginfo('template_directory')?>/css/flexslider.css" type='text/css' media='all' />

<link rel='stylesheet' id='fancybox-css'  href="<?php echo bloginfo('template_directory')?>/js/fancybox/jquery.fancybox.css" type='text/css' media='all' />
<!--<link rel='stylesheet' id='magicthumb-js-css'  href='<?php// echo bloginfo('template_directory')?>/js/magicthumb/magicthumb.css' type='text/css' media='all' />-->
<link rel='stylesheet' id='theme-style-css'  href="<?php echo bloginfo('template_directory')?>/style.css" type='text/css' media='all' />
<link rel='stylesheet' id='sts-style-css'  href="<?php echo bloginfo('template_directory')?>/css/sts.css" type='text/css' media='all' />


</head>

<body <?php body_class(); ?>>

	<div id="st-container" class="st-container">
        <div class="login_header">
            <a class="go_home" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="http://jcoutier.com/wp-content/uploads/2014/10/logo2.png" alt="" /></a>
        </div>
        <div class="st-pusher">
            
            <div class="st-pusher-after"></div>   
                
                <div class="st-content">
                
					<?php if (file_exists(dirname( __FILE__ ) . '/_theme-explorer/header.php')) { include_once('_theme-explorer/header.php'); } ?>
                    
                    <div id="page">
                    
                        <?php do_action( 'before' ); ?>
                        
                        <div class="top-headers-wrapper">
						
							<?php if ( (!isset($mr_tailor_theme_options['top_bar_switch'])) || ($mr_tailor_theme_options['top_bar_switch'] == "1" ) ) : ?>                        
                                <?php include_once('header-topbar.php'); ?>						
                            <?php endif; ?>                      
                            
                            <?php
                            
							if ( (isset($mr_tailor_theme_options['header_layout'])) && ($mr_tailor_theme_options['header_layout'] == "0" ) ) {
								include_once('header-default.php');
							} else {
								include_once('header-centered.php');
							}
							
							?>
                        
                        </div>
                        
                        <?php if (function_exists('wc_print_notices')) : ?>
                        <?php wc_print_notices(); ?>
                        <?php endif; 
						
						  
						?>
