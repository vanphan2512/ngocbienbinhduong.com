<?php if ( ! defined( 'ABSPATH' ) ) exit; 
$wow = (isset($_REQUEST["wow"])) ? sanitize_text_field($_REQUEST["wow"]) : '';
include_once( 'skype/menu.php' );
if ($wow == "marketing-wp"){
	include_once( 'skype/marketing-wp.php' );	
}
if ($wow == "add"){
	include_once( 'skype/add.php' );
	return;	
}
if ($wow == ""){
	include_once( 'skype/list.php' );
}
if ($wow == "items"){
	include_once( 'skype/items.php' );	
	return;
}
?>
</div>