<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
function show_mwp_skype_free($atts){
	extract(shortcode_atts(array('id' => ""), $atts));		
    global $wpdb;
	$table_mwp_skype_free = $wpdb->prefix . "mwp_skype_free";
	$sSQL = $wpdb->prepare("select * from $table_mwp_skype_free WHERE id = %d", $id);    
    $arrresult = $wpdb->get_results($sSQL); 
	if (count($arrresult) > 0) {
        foreach ($arrresult as $key => $val) {
			ob_start();
			include( 'partials/public.php' );
			$output_mwp_skype=ob_get_contents();
			ob_end_clean();				
			$path_script = WOWSB_PLUGIN_DIR ."asset/wowscript-".$val->id.".js";
			ob_start();
			include ('js/skype.php');
			$content_script = ob_get_contents();
			$packer = new JavaScriptPacker($content_script, 'Normal', true, false);
			$packed = $packer->pack();
			ob_end_clean();
			file_put_contents($path_script, $packed);
			wp_enqueue_script( 'wow-skype-'.$val->id, WOWSB_PLUGIN_URL . 'asset/wowscript-'.$val->id.'.js', array( 'jquery' ) );			
        }
    } 
	else {		
		$output_mwp_skype = "<p><strong>No Records</strong></p>";       
    }
	return $output_mwp_skype;
}
add_shortcode('mwpSkypeFree', 'show_mwp_skype_free');
add_shortcode('Wow-Skype-Buttons', 'show_mwp_skype_free');