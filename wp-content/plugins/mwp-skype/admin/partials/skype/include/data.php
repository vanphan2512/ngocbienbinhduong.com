<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
$wowpage = 'wow-skype-buttons';
$act = (isset($_REQUEST["act"])) ? $_REQUEST["act"] : '';
if ($act == "update") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $table_wow_skype_free WHERE id=$recid");
	if ($result){
        $id = $result->id;
        $title = $result->title;
		$loginskype = $result->loginskype;
		$chat = $result->chat;		
		$call_skype = $result->call_skype;						
		$btn = __("Update", "wow-marketings");
        $hidval = 2;
    }
}
else if ($act == "duplicate") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $table_wow_skype_free WHERE id=$recid");
	if ($result){
        $id = "";
        $title = "Skype Us";
		$loginskype = $result->loginskype;
		$chat = $result->chat;		
		$call_skype = $result->call_skype;				
		$btn = __("Save", "wow-marketings");
        $hidval = 1;
    }
}
 else {
    $btn = __("Save", "wow-marketings");
    $id = "";
        $title = "Skype Us";
		$loginskype = "";
		$chat = "1";
    $hidval = 1;
}
?>