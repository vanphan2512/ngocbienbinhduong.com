<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php include ('include/data.php'); ?>
<h2><?php esc_attr_e("Shortcode", "wow-marketings") ?> <?php esc_attr_e("for Skype Button", "wow-marketings") ?> : <?php echo "[Wow-Skype-Buttons id=$id]"; ?></h2>
<form action="admin.php?page=wow-skype-buttons" method="post" id="addtag">
<div class="wowbox">
<div class="inside wow-admin" style="display: block;">	
<div class="wow-admin-col">
<div class="wow-admin-col-6">
<b><?php esc_attr_e("Button text", "wow-marketings") ?>:</b><br/> <input  placeholder="Button text" type='text' name='title' value="<?php echo $title; ?>" />
</div>
<div class="wow-admin-col-6">
<b><?php esc_attr_e("Skype account", "wow-marketings") ?>:</b><br/> <input  placeholder="Skype account" type='text' name='loginskype' value="<?php echo $loginskype; ?>" />
</div>
</div>
</div>
</div>
<div class="wowbox">
<h3><?php esc_attr_e("Available actions", "wow-marketings") ?></h3>
<div class="inside wow-admin" style="display: block;">	
<div class="wow-admin-col">
</div>
<div class="wow-admin-col">
<div class="wow-admin-col-12">
<table>
<tr>
<td width="150px"><b><?php esc_attr_e("Actions", "wow-marketings") ?></b></td>
<td width="150px"><b><?php esc_attr_e("Choose", "wow-marketings") ?></b></td>
</tr>
<tr>
<td><?php esc_attr_e("Chat", "wow-marketings") ?></td>
<td><input name="chat" type="checkbox" value="1" <?php if(!empty($chat)) { echo 'checked="checked"'; } ?>></td>
</tr>
<tr>
<td><?php esc_attr_e("Call", "wow-marketings") ?></td>
<td><input name="call_skype" type="checkbox" value="1" disabled></td>
</tr>
<tr>
<td><?php esc_attr_e("Videocall", "wow-marketings") ?></td>
<td><input name="videocall" type="checkbox" value="1" disabled></td>
</tr>
<tr>
<td><?php esc_attr_e("Voice message", "wow-marketings") ?></td>
<td><input name="voicemessage" type="checkbox" value="1" disabled></td>
</tr>
<tr>
<td><?php esc_attr_e("Add to contacts", "wow-marketings") ?></td>
<td><input name="addtocontacts" type="checkbox" value="1" disabled></td>
</td>
</tr>
<tr>
<td><?php esc_attr_e("Information", "wow-marketings") ?></td>
<td><input name="information" type="checkbox" value="1" disabled></td>
</tr>
<tr>
<td><?php esc_attr_e("Send file", "wow-marketings") ?></td>
<td><input name="sendfile" type="checkbox" value="1" disabled></td>
</tr>
</table>
</div>
</div>
</div>
</div>
<div class="wowbox">
    
    <h3><?php esc_attr_e("Icons size", "wow-marketings") ?></h3>
    <div class="inside wow-admin" style="display: block;">	
	<div class="wow-admin-col">	
	<div class="wow-admin-col-3">
	<select name='icons_size' disabled>        
        <option value="14">14px</option>
		<option value="22">22px</option>
        <option value="30">30px</option>        
    </select>	
	</div>
	<div class="wow-admin-col-9"></div>		
	</div>
	</div>
	</div>
<div class="wowbox">
    
    <h3><?php esc_attr_e("Skype status", "wow-marketings") ?></h3>
    <div class="inside wow-admin" style="display: block;">	
	<div class="wow-admin-col">
	<div class="wow-admin-col-3"><?php esc_attr_e("Show status", "wow-marketings") ?>:<br/> 
	<select name='show_status' onchange="skypestatus()" disabled>        
        <option value="off">Hide</option>
		<option value="on">Show</option>              
    </select>
	</div>
	<div class="wow-admin-col-9"></div>
	</div>
	<div class="wow-admin-col" id="skypestatus">
	</div>
</div>
</div>	
	<?php submit_button($btn); ?>	
	<input type="hidden" name="addwow" value="<?php echo $hidval; ?>" />    
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="wowpage" value="<?php echo $wowpage; ?>" />
	<input type="hidden" name="wowtable" value="<?php echo $table_wow_skype_free; ?>" />	
	<?php wp_nonce_field('wow_skype_action','wow_skype_nonce_field'); ?>
  </form>
