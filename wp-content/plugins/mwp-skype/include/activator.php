<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
global $wpdb;
$wpdb->mwp_skype_free = $wpdb->prefix . 'mwp_skype_free';
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
$sql = "CREATE TABLE " . $wpdb->mwp_skype_free . " (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL,
  loginskype TEXT,
  chat TEXT,
  call_skype TEXT,
  UNIQUE KEY id (id)
) DEFAULT CHARSET=utf8;";
dbDelta($sql);
?>