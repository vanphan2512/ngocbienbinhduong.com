function display_option(id,pid)
{
	//alert(id);
		
	
	jQuery.ajax({ 
			type:"post",
			url: 'http://jcoutier.com/wp-admin/admin-ajax.php',
			data: {
				action:'get_product_data',
				settings_id : id,pid:pid
			},
		   
		success: function(response) {
	//alert(response);
		//document.getElementById('measure-your-body').innerHTML=" ";
		//document.getElementById('measure-your-body').innerHTML=response;
//jQuery('#measure-your-body .measure-options').html(response);
		//jQuery('#measure-your-body').html(response
		jQuery('#product_option').html(response);

		
	}

});
}