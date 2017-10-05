jQuery(document).ready(function($)	{

	$('.add_order_comments').click(function()	{

		$(this).parent().find('.add_tracking').toggle();



		return false;

	});



	$('.add_order_comments').click(function()  {

		$(this).parent().find('.add_comments').toggle();



		return false;

	});



	$('.submit-track-comments-form').parent().submit(function(e) {

		e.preventDefault();

		var data = $(this).serialize();

		var current_div = $(this).parent();

		var textarea = $(this).parent().find('textarea');

		var next_div = $(this).parents('td').find('.add_order_comments');

		$(current_div).fadeOut();

		$.ajax({

			type: "POST",

			url: ajax_object.ajax_url,

			data: data,

			dataType: 'json',

			success: function(result) {

				if (result.item_value.length) {

					$(textarea).html(result.item_value);

					$(next_div).html(result.item_value).fadeIn();

				}

			}

		});

	});



	$('.change-order-status').change(function(e)  {

		var data = $(this).parent().serialize();

		var element = $(this);

		$.ajax({

			type: "POST",

			url: ajax_object.ajax_url,

			data: data,

			dataType: 'json',

			success: function(result) {

				if (result.item_value.length) {

					$(element).val(result.item_value);

				}

				if (result.date_shipped.length) {

					$(element).parents('tr').find('#date-shipped').html(result.date_shipped).fadeIn();

				}

			}

		});

	});



	$('.show-details').click(function() {

		$(this).parents('.order-img').find('.item-details').slideToggle(function()  {

			if ($(this).is(':visible')) {

				$(this).parents('.order-img').find('.show-details').text('Hide Details');

			} else  {

				$(this).parents('.order-img').find('.show-details').text('Show Details');

			}

		});



		return false;

	});



	$('.add_rule').click(function()	{

		var row = $(this).parents('tbody').find('tr:first');

		var row_html;

		$(row).find('td').each(function(index, el)	{

			if (index != $(row).find('td').length - 1)	{

				row_html += '<td>' + $(el).html() + '</td>';

			} else {

				row_html += '<td><a class="delete_rule add-new-h2">- Delete Rule</a></td>';

			}

		});

		$(this).parents('tbody').append('<tr>' + row_html + '</tr>');

	});



	$('#promotion_form').submit(function(e)	{

		e.preventDefault();

		var button = $(this).find('.button-primary');

		var curr_div = $(this).find('.button-primary').parent();

		button.attr('disabled', 'disabled');

		curr_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/mrtailor/images/ajax-loader-search.gif" class="loading-search" />');



		var data = $(this).serialize();

	

		xhr = jQuery.ajax({

		type: "POST",

		url: ajax_object.ajax_url,

		data: data,

		dataType: 'json',

		success: function(result) {

			console.log(result);

		

			if (result.error.length)

				alert(result.error);



			if (result.success.length && result.success == "Success!")

				//window.location.href = "http://verycreative.info/pickashirt/wp-admin/admin.php?page=promo_page&promotion_added=" + result.aid;

		window.location.href = "/wp-admin/admin.php?page=promo_page";

			button.removeAttr('disabled');

			curr_div.find('.loading-search').remove();

		}

	});



	});



	jQuery('.order-free-item').click(function()	{



		var curr_div = jQuery(this).parent();

		var order_id = jQuery(this).data('orderid');

		var item_key = jQuery(this).data('itemkey');

		var accepted = jQuery(this).attr('rel');

		var container = jQuery(this).parents('.free-item-status');

		var tr_container = jQuery(this).parents('tr');



		if (xhr)	{

			xhr.abort();

			curr_div.find('.loading-search').remove();

		}



		curr_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');



		xhr = jQuery.ajax({

			type: "POST",

			url: ajax_object.ajax_url,

			data: 'action=change-free-item-status&order_id=' + order_id + '&item_key=' + item_key + '&accepted=' + accepted,

			dataType: 'json',

			success: function(result) {

				console.log(result);

				if (result.success)	{

					alert(result.success);

					if (accepted != "0")	{

						container.html("Accepted");

					} else {

						jQuery(tr_container).css('background-color', '#ff0000').fadeOut(2000);

					}

				}

				curr_div.find('.loading-search').remove();

			}

		});



		return false;

	});



	$( "#datepicker1, #datepicker2" ).datepicker();



});



var xhr = null;



jQuery('body').on('change', '.promotion_post_type', function()	{



	var curr_div = jQuery(this).parent();

	if (xhr)	{

		xhr.abort();

		curr_div.find('.loading-search').remove();

	}



	var post_type = jQuery(this).val();

	var target_el = jQuery(this).parents('tr').find('.promotion_products');

	jQuery(target_el).html('<option value="all">All</option>');



	if (post_type == 'all')	

		return false;



	curr_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/mrtailor/images/ajax-loader-search.gif" class="loading-search" />');

	

	var new_html;

	xhr = jQuery.ajax({

		type: "POST",

		url: ajax_object.ajax_url,

		data: 'action=get-promo-prods&post_type=' + post_type,

		dataType: 'json',

		success: function(result) {
	
		
			jQuery.each(result, function(i, e)	{
				
				

					new_html += '<option value="' + e.ID + '">' + e.post_title + '</option>';
			

			});



			if (new_html.length)	{

				jQuery(target_el).append(new_html);

			}



			curr_div.find('.loading-search').remove();

		}

	});

});



jQuery('body').on('change', '.promotion_type', function()	{



	var curr_div = jQuery(this).parent();

	if (xhr)	{

		xhr.abort();

		curr_div.find('.loading-search').remove();

	}



	var promo_type = jQuery(this).val();

	var target_el = jQuery(this).parents('tr').find('.promotion_free_item');

	jQuery(target_el).html('<option value="">-</option>');



	if (promo_type == '' || promo_type == 'free_shipping' || promo_type == 'discount')

		return false;



	curr_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/mrtailor/images/ajax-loader-search.gif" class="loading-search" />');



	var new_html;

	xhr = jQuery.ajax({

		type: "POST",

		url: ajax_object.ajax_url,

		data: 'action=get-promo-items&promo_type=' + promo_type,

		dataType: 'json',

		success: function(result) {

		console.log(result);

			jQuery.each(result, function(i, e)	{

				new_html += '<option value="' + e.ID + '">' + e.post_title + '</option>';

			});



			if (new_html.length)	{

				jQuery(target_el).append(new_html);

			}



			curr_div.find('.loading-search').remove();

		}

	});

});



jQuery('body').on('click', '.delete_rule', function()	{

	jQuery(this).parents('tr').remove();

});



jQuery('body').on('click', '.delete-promotion', function()	{

	var promo_id = jQuery(this).attr('rel');

	var deleted = jQuery(this);

	jQuery.aj