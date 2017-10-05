<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
function wow_skype_free_admin_menu() {
	add_menu_page('Wow Skype Buttons', __( "Wow <br/>Skype Buttons", "wow-marketings"), 'edit_pages', 'wow-skype-buttons', 'wow_skype_free', 'dashicons-email', null);
	add_action('admin_print_styles', 'wow_script_style');
}
add_action('admin_menu', 'wow_skype_free_admin_menu');
function wow_skype_free() {
	global $wow_plugin_free;	
	$wow_plugin_free = true;
	include_once( 'partials/skype.php' );			
	
}

if ( ! function_exists ( 'wow_script_style' ) ) {
function wow_script_style() {
	wp_enqueue_style('wow-style', plugin_dir_url(__FILE__) . 'css/style.css'); 	
	
}
}


function wow_skype_nonce_chek() 
{
	if ( !empty($_POST) && wp_verify_nonce($_POST['wow_skype_nonce_field'],'wow_skype_action') && current_user_can('manage_options'))
	{
		wow_skype_run_marketingwpclass();
	}	
}
add_action( 'plugins_loaded', 'wow_skype_nonce_chek' );
function wow_skype_run_marketingwpclass(){
$objItem = new WOWFREEClass();
$addwow = (isset($_REQUEST["addwow"])) ? sanitize_text_field($_REQUEST["addwow"]) : '';
$table_name = sanitize_text_field($_REQUEST["wowtable"]);
$wowpage = sanitize_text_field($_REQUEST["wowpage"]);
/*  Save and update Record on button submission */
if (isset($_POST["submit"])) {
    if (sanitize_text_field($_POST["addwow"]) == "1") {
        $objItem->addNewItem($table_name, $_POST);
        header("Location:admin.php?page=".$wowpage."&info=saved");
    } else if (sanitize_text_field($_POST["addwow"]) == "2") {
        $objItem->updItem($table_name, $_POST);
        header("Location:admin.php?page=".$wowpage."&wow=add&act=update&id=".sanitize_text_field($_POST['id'])."&info=update");
        exit;
    }
}
}
if ( ! function_exists ( 'wow_plugins_admin_footer_text' ) ) {
function wow_plugins_admin_footer_text( $footer_text ) {
	global $wow_plugin_free;
	if ( $wow_plugin_free == true ) {
		$rate_text = sprintf( '<span id="footer-thankyou">Developed by <a href="http://wow-company.com/" target="_blank">Wow-Company</a> | <a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a> | <a href="https://wow-estore.com/" target="_blank">Wow-Estore</a></span>'
		);
		return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
	}
	else {
		return $footer_text;
	}	
}
add_filter( 'admin_footer_text', 'wow_plugins_admin_footer_text' );
}