<?php
/**
 * Plugin Name:       Wow Skype Buttons
 * Plugin URI:        https://wordpress.org/plugins/mwp-skype/
 * Description:       Add a Skype button to your WP site!
 * Version:           2.2
 * Author:            Wow-Company
 * Author URI:        http://wow-company.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wow-marketings
  */
if ( ! defined( 'WPINC' ) ) {die;}
if ( ! defined( 'WOWSB_PLUGIN_DIR' ) ) {
	define( 'WOWSB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WOWSB_PLUGIN_URL' ) ) {
	define( 'WOWSB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
load_plugin_textdomain('wow-marketings', false, dirname(plugin_basename(__FILE__)) . '/languages/');
function activate_mwp_skype() {
	require_once plugin_dir_path( __FILE__ ) . 'include/activator.php';	
	}	
register_activation_hook( __FILE__, 'activate_mwp_skype' );
function deactivate_mwp_skype() {	
	require_once plugin_dir_path( __FILE__ ) . 'include/deactivator.php';
}
register_deactivation_hook( __FILE__, 'deactivate_mwp_skype' );
require_once plugin_dir_path( __FILE__ ) . 'admin/admin.php';
require_once plugin_dir_path( __FILE__ ) . 'public/public.php';
if( !class_exists( 'WOWFREEClass' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'include/wowfreeclass.php';
}
if( !class_exists( 'JavaScriptPacker' )) {
	require_once plugin_dir_path( __FILE__ ) . 'include/class.JavaScriptPacker.php';
}

function wow_mwp_skype_row_meta( $meta, $plugin_file ){
	if( false === strpos( $plugin_file, basename(__FILE__) ) )
		return $meta;

	$meta[] = '<a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a> | <a href="https://wow-estore.com/" target="_blank">Wow-Estore</a>';
	return $meta; 
}
add_filter( 'plugin_row_meta', 'wow_mwp_skype_row_meta', 10, 4 );

function wow_mwp_skype_action_links( $actions, $plugin_file ){
	if( false === strpos( $plugin_file, basename(__FILE__) ) )
		return $actions;

	$settings_link = '<a href="admin.php?page=wow-skype-buttons' .'">Settings</a>'; 
	array_unshift( $actions, $settings_link ); 
	return $actions; 
}
add_filter( 'plugin_action_links', 'wow_mwp_skype_action_links', 10, 2 );

function wow_skype_free_asset(){
	$filename = plugin_dir_path( __FILE__ ).'asset';
	if (!is_writable($filename)) {
		add_action('admin_notices', 'wow_skype_free_asset_notice' );
	} 
}
add_filter( 'admin_init', 'wow_skype_free_asset');
function wow_skype_free_asset_notice(){
	$path = plugin_dir_path( __FILE__ ).'asset';
    echo "<div class='error' id='message'><p>".__("Please set the 775 access rights (chmod 775) for the '".$path."' folder.", "marketing-wp")."</p> </div>";
}