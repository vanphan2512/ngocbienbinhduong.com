<?php
require_once( dirname( dirname( __FILE__ ) ) . '\wp-load.php' );
// Array with names

// get the q parameter from URL
$q = $_REQUEST["q"];

echo var_dump($q);

?>