<?php

/* Template Name:My accounts asad*/

	global $mr_tailor_theme_options;

    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">       
       	
			<?php
            if($_GET){
                if($_GET['action']=='lost-password'){
                ?>
                <form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
                        <div class="username">
                          <label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
                          <input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
                        </div>
                        <div class="login_fields">
                          <?php do_action('login_form', 'resetpass'); ?>
                          <input type="submit" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
                          <?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
                          <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
                          <input type="hidden" name="user-cookie" value="1" />
                        </div>
                      </form>
                <?php
                }else{
                    //echo 'aaaaaaaaaaaaaa';
                    //echo do_shortcode('[recent_order_tab]');
                    
                    ?>  
                    <div class="row">
	<div class="medium-10 medium-centered large-6 large-centered columns">
		
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

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
							
							<li class="account-tab-item"><a class="account-tab-link current" href="#login"><?php _e( 'Login', 'mr_tailor' ); ?></a></li>
							
							<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
								<li class="account-tab-item last"><a class="account-tab-link" href="#register"><?php _e( 'Register', 'mr_tailor' ); ?></a></li>
							<?php endif; ?>
						
						</ul>
						
						<div class="account-forms">
							<form id="login" method="post" class="login-form">
					
								<?php do_action( 'woocommerce_login_form_start' ); ?>
					
								<p class="form-row form-row-wide">
									<!--<label for="username"><?php // _e( 'Username or email address', 'mr_tailor' ); ?> <span class="required">*</span></label>-->
									<input type="text" class="input-text" name="username" id="username"  placeholder="<?php _e( 'Username or email address *', 'mr_tailor' ); ?>"/>
								</p>
								<p class="form-row form-row-wide">
									<!--<label for="password"><?php //_e( 'Password', 'mr_tailor' ); ?> <span class="required">*</span></label>-->
									<input class="input-text" type="password" name="password" id="password" placeholder="<?php _e( 'Password *', 'mr_tailor' ); ?>" />
								</p>
					
								<?php do_action( 'woocommerce_login_form' ); ?>
					
								<p class="form-row">
									<?php wp_nonce_field( 'woocommerce-login' ); ?>
									
									<input name="rememberme" class="check_box" type="checkbox" id="rememberme" value="forever" /> 
									<label for="rememberme" class="remember-me check_label"><?php _e( 'Remember me', 'mr_tailor' ); ?></label>
									
									<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'mr_tailor' ); ?>" /> 
									
								</p>							
					
					
								<?php do_action( 'woocommerce_login_form_end' ); ?>
					
							</form>
							
						<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
								
							<form id="register" method="post" class="register-form">
					
								<?php do_action( 'woocommerce_register_form_start' ); ?>
					
								<?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>
					
									<p class="form-row form-row-wide">
										<!--<label for="reg_username"><?php //_e( 'Username', 'mr_tailor' ); ?> <span class="required">*</span></label>-->
										<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) esc_attr_e( $_POST['username'] ); ?>" placeholder="<?php _e( 'Username *', 'mr_tailor' ); ?>" />
									</p>
					
								<?php endif; ?>
					
								<p class="form-row form-row-wide">
									<!--<label for="reg_email"><?php //_e( 'Email address', 'mr_tailor' ); ?> <span class="required">*</span></label>-->
									<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) esc_attr_e( $_POST['email'] ); ?>" placeholder="<?php _e( 'Email *', 'mr_tailor' ); ?>"/>
								</p>
					
								<p class="form-row form-row-wide">
									<!--<label for="reg_password"><?php _//e( 'Password', 'mr_tailor' ); ?> <span class="required">*</span></label>-->
									<input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr_e( $_POST['password'] ); ?>" placeholder="<?php _e( 'Password *', 'mr_tailor' ); ?>"/>
								</p>
					
								<!-- Spam Trap -->
								<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'mr_tailor' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
					
								<?php do_action( 'woocommerce_register_form' ); ?>
								<?php do_action( 'register_form' ); ?>
					
								<p class="form-row">
									<?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
									<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'mr_tailor' ); ?>" />
								</p>
					
								<?php do_action( 'woocommerce_register_form_end' ); ?>
					
							</form><!-- .register-->
					
								
						<?php endif; ?>	
						</div><!-- .account-forms-->
					</div><!-- .account-forms-container-->
				</div><!-- .medium-8-->
			</div><!-- .row-->
		</div><!-- .login-register-container-->
		
		<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

	</div><!-- .large-6-->
</div><!-- .rows-->
                    
                            <?php
                            
                }
                
            }else{
               // echo 'aaaaaaaaaaaaaaaeeeeeeeeeeeeee';
               ?>
               
                <div class="large-8 large-centered columns">
                    <?php echo do_shortcode('[recent_order_tab]');?>
                </div>
                
                <?php
            }
            ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
<?php get_footer(); ?>
