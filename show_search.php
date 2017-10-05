<?php

include "wp-load.php";
echo var_dump($_GET);

$color=$_GET['color'];
echo 'ket qua search';
echo ' <br/> mau:'.$color;


echo do_shortcode('[product_attribute attribute="color" filter="'.$color.'"]');
?>