<?php
/*Template Name:Sign up succ*/

	
    ?>
    
    
    <?php	
	global $mr_tailor_theme_options;
	global $woocommerce;
?>



<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <!-- ******************************************************************** -->
    <!-- * Title ************************************************************ -->
    <!-- ******************************************************************** -->
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
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
<?php wp_head(); ?>

<link rel='stylesheet' id='bootstrap-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap.min.css" type="text/css" media='all' />


<link rel='stylesheet' id='bootstrap3-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap.min.css" type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-responsive-css'  href="<?php echo bloginfo('template_directory')?>/css/bootstrap-responsive.css" type='text/css' media='all' />
<link rel='stylesheet' id='theme-style-css'  href="<?php echo bloginfo('template_directory')?>/style.css" type='text/css' media='all' />

<style>
	#site-top-bar,
	#masthead,
	.entry-title,
	#site-footer
	{
		display: none !important;
	}
	
	.login_header
	{
		display: block;
	}
	
	.st-content,
	.st-container
	{
		height: 100%;
	}
	
	.st-content
	{
		overflow-y: auto;
	}
	.watch-now p{ margin:0; padding-bottom:0 !important}
</style>
</head>

<body <?php body_class(); ?>>
<div class="login_header" style="position:relative;">
		<a class="go_home" href="http://jcoutier.com" title="jcoutier"><img src="http://jcoutier.com/wp-content/uploads/2014/10/logo2.png" alt=""></a>
	</div>
    
<div class="row">
	<div class="medium-10 medium-centered large-6 large-centered columns">
		<div class="login-register-container">
				
			<div class="row">
				
				<div class="medium-4 columns">
					<div class="account-img-container">
						<img id="login-img" alt="My account"  width="164" height="209"  src="<?php echo get_template_directory_uri() . '/images/my_account.png'; ?>" data-interchange="[<?php echo get_template_directory_uri() . '/images/my_account.png'; ?>, (default)], [<?php echo get_template_directory_uri() . '/images/my_account_retina.png'; ?>, (retina)]">
					</div>
				</div>
			
				<div class="medium-8 columns">
					<div class="account-forms-container">
						<ul class="account-tab-list">
							
							<li class="account-tab-item"><a class="account-tab-link current" href="#login">Sign Up</a></li></ul>
						
						<div class="account-forms">                       
                        
							<?php
								echo '<p>Thanks and welcome.</p>';
								echo '<p>Your voucher and an activation email has been sent to you.</p>';
							?>
						
						</div><!-- .account-forms-->
					</div><!-- .account-forms-container-->
                    <div class="row account-icon">
						<div class="col-md-6 icon-gmail">
							
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gmail.png"/>
							
						</div>	
						<div class="col-md-6 icon-yahoo">
							
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/yahoo.png"/>
						
						</div>
						<div class="row account-text">
							<p>Gmail and Yahoo Mail users, please check your 
								junk mail folder if you cannot see our mails. </p>
						</div>
					</div>
				</div><!-- .medium-8-->
			</div><!-- .row-->
		</div><!-- .login-register-container-->
		
		<?php //do_action( 'woocommerce_after_customer_login_form' ); ?>

	</div><!-- .large-6-->
</div><!-- .rows-->
<?php

?>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function ($) { 
jQuery( "#signup" ).validate({
		rules: {
		text_email: {
		required: true,
		email: true
		},
		
		text_c_email: {
		email: true,
		equalTo: "#text_email"
		
		},
		
		txt_pwd: {
		required: true,
		
		}
		
	},
	 messages: {
     
      text_c_email :"Enter Confirm Email Same as Email"
     }
});



 
 
});
</script>

</body>

</html>