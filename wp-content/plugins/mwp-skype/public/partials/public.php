<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
    $commands = '';
    if ($val->chat == 1)
		$commands .= 'chat,';
	if ($val->call_skype == 1)
		$commands .= 'call,'; 	
	$mwpskype = '';
		 $mwpskype .= '<a data-config="commands='.$commands.';size=14;status=off;theme=logo;language=en;" id="mwp-skype-buttons-'.$val->id.'" href="skype:'.$val->loginskype.'">'.$val->title.'</a>';
	echo $mwpskype;	 
?>