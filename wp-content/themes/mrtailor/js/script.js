/**

 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com

 * Dual licensed under MIT and GPL.

 * @author Ariel Flesler

 * @version 1.4.3.1

 */

;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);



// Reactivate XFBML Facebook 

$(document).ajaxComplete(function(){

    try{

        FB.XFBML.parse(); 

    }catch(ex){}

});

var mouse_is_inside = false;

var currencyClicked = false;

jQuery(document).ready(function($)	{

	$('.slider').flexslider({

		animation: "slide",

		controlNav: false

	});

	$('.faq-cat').on('click',function()	{

		$('.faq-cat').removeClass('active-faq');

		$(this).addClass('active-faq');



		var item = '.category-' + $(this).attr('data-target');

		$('.faq-category').each(function(){

			$(this).hide();

		});

		$(item).slideDown();

		return false;

	});

	$('.questions a').on('click',function(){

		$('.questions p').each(function(){

			$(this).slideUp();

		});

		$(this).next().slideDown();

		return false;

	});



// Currency Change

	$('ul.currency-change').hover(function(){

		mouse_is_inside = true;

	}, function(){

		mouse_is_inside = false;

	});

	$('.currency').click(function()	{

		if ($('.currency-change').css('display') == "none")	{

			$('.currency-change').slideDown();

		} else {

			$('.currency-change').slideUp();

		}

	});

	$('.currency-change li').click(function()	{

		$(this).find('form').submit();

	});

	$('body').mouseup(function()	{

		if ($('.currency-change').css('display') == "none")	{

			currencyClicked = false;

		} else {

			currencyClicked = true;

		}

		if(!mouse_is_inside && currencyClicked)	{

			$('.currency-change').slideUp(500);

		}

	});



// Pop up Functionality

	$('.fancybox').fancybox({

		beforeClose: function ()	{

			$('.error').hide();

		},
		beforeLoad: function () {
			$('p.error').show();
		}

	});



	



// Tab Content

// My Account

	$('.dashboard-nav li').click(function(){

		$('.my-account-content').hide();

		$('.dashboard-nav li').removeClass('dashboard-nav-active');



		var current_tab = $(this).find('a').attr('href');

		

		$(this).addClass('dashboard-nav-active');

		$(current_tab).show();



		return false;

	});



	var current_option = $('.measure-selected').val();

	if ($('#'+current_option).length)	{

		$('.sizing-options').hide();

		$('#' + current_option).show();

	}



	// Accessories
	
	/*$('.browse-results-accessories').infinitescroll({
		loading			:	{
			finishedMsg		: "<em>You've reached the end of the page.</em>",
			msgText			: "<em>Loading ...</em>",
		},
		debug           : true,
		extraScrollPx	: 500,
		nextSelector    : "div.posts-nav-accessories a",
		navSelector     : "div.posts-nav-accessories",
		contentSelector : ".browse-results-accessories",
		itemSelector    : ".browse-results-accessories div.row-fluid"
	});*/

	/*var current_tab = $('.acc-cats li').first().find('a').attr('href');
	$(current_tab).show();
	//setInterval(function Scroll_Init_Accessories(){
		if( $('.browse-results-accessories').is(':visible') ) 
		{
		    $('.browse-results-accessories').infinitescroll({
				loading			:	{
					finishedMsg		: "<em>You've reached the end of the page.</em>",
					msgText			: "<em>Loading ...</em>",
				},
				debug           : true,
				extraScrollPx	: 500,
				nextSelector    : "div.posts-nav-accessories a",
				navSelector     : "div.posts-nav-accessories",
				contentSelector : ".browse-results-accessories",
				itemSelector    : ".browse-results-accessories div.row-fluid"
			});
		} 
		else 
		{
			$('.browse-results-accessories').infinitescroll('destroy'); //deactive current scroll
		}
	//}, 1);*/

	/*$('body').on('click', '.acc-cats li a', function(event) {
		event.preventDefault();
		$('#show-items').html('');
		$('.acc-tabs').hide();
		$('.acc-cats li').removeClass('acc-cats-active');
		$(this).parent().addClass('acc-cats-active');

		var href = $(this).attr('data-href');
		if(href) {
			$('#show-items').load(href);
			Scroll_Init_Accessories();
		}
		current_tab = $(this).attr('href');
		$(this).parent().addClass('acc-cats-active');
		$(current_tab).show();
		return false;
	});*/

	function showAccessories(url, append_to) {
		append_to.html('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" style="display: block; float: none;"/>');
		$.get(url, function(data) {
			append_to.html(data);
		})
		.done(function() {
			$('.browse-results-accessories').infinitescroll({
				state: {
					isDestroyed: false,
					isDone: false
				},
				loading			:	{
					finishedMsg		: "<em>You've reached the end of the page.</em>",
					msgText			: "<em>Loading ...</em>",
				},
				debug           : true,
				extraScrollPx	: 500,
				nextSelector    : "div.posts-nav-accessories a",
				navSelector     : "div.posts-nav-accessories",
				contentSelector : ".browse-results-accessories",
				itemSelector    : ".browse-results-accessories div.row-fluid"
			});
		})
		.fail(function() {
			
		})
		.always(function() {
			
		});
	}

	var current_tab = $('.acc-cats li').first().find('a').attr('href');
	$(current_tab).show();

	setTimeout(function(){
		$('.browse-results-accessories').infinitescroll({
			state: {
				isDestroyed: false,
				isDone: false
			},
			loading			:	{
				finishedMsg		: "<em>You've reached the end of the page.</em>",
				msgText			: "<em>Loading ...</em>",
			},
			debug           : true,
			extraScrollPx	: 500,
			nextSelector    : "div.posts-nav-accessories a",
			navSelector     : "div.posts-nav-accessories",
			contentSelector : ".browse-results-accessories",
			itemSelector    : ".browse-results-accessories div.row-fluid"
		});
	}, 1000);

	$('body').on('click', '.acc-cats li a', function(event) {
		event.preventDefault();
		$('.browse-results-accessories').infinitescroll('destroy'); //deactive current scroll
		$('#show-items').html('');
		$('.acc-tabs').hide();
		$('.acc-cats li').removeClass('acc-cats-active');
        
        $('.accesories-head').find('.custom-ties').removeClass('block');
        $('.accesories-head').find('.custom-boxer').removeClass('block');
        $('.accesories-head').find('.scarves').removeClass('block');
        
		$(this).parent().addClass('acc-cats-active');

		var href = $(this).attr('data-href');
		if(href) {
			showAccessories(href, $('#show-items'));
			//$('#show-items').load(href);
			//Scroll_Init_Accessories();
		}
		current_tab = $(this).attr('href');
		$(this).parent().addClass('acc-cats-active');
        
        //////////////////////////////////////////////////////////////////////
        
        if ($('li.cats-boxer-shorts').hasClass('acc-cats-active') ){
        
            $('.accesories-head').find('.custom-boxer').addClass('block');
            $('.accesories-head').find('.custom-ties').addClass('remove');
            $('.accesories-head').find('.scarves').addClass('remove');
        }
        
        if ($('li.cats-custom-my-ties').hasClass('acc-cats-active') ){
          
            $('.accesories-head').find('.custom-boxer').addClass('remove');
            $('.accesories-head').find('.custom-ties').addClass('block');
            $('.accesories-head').find('.scarves').addClass('remove');
        }
        
        if ($('li.cats-custom-scarves').hasClass('acc-cats-active') ){
          
            $('.accesories-head').find('.custom-boxer').addClass('remove');
            $('.accesories-head').find('.custom-ties').addClass('remove');
            $('.accesories-head').find('.scarves').addClass('block');
        }
		$(current_tab).show();
		return false;
	});

// Cart

	$('.show-details').click(function()	{

		$(this).parents('.order-img').find('.item-details').slideToggle(function()	{

			if ($(this).is(':visible'))	{

				$(this).parents('.order-img').find('.show-details').text('Hide Details');

			} else	{

				$(this).parents('.order-img').find('.show-details').text('Show Details');

			}

		});

		return false;

	});



// Checkout

	$('.change-tab').click(function()	{

		if (verify_checkout())	{

			return true;

		}			

		return false;

	});



	$('#same-address').change(function()	{

		if ($(this).is(':checked'))	{

			$('#billing-details').hide();

			$('#billing-details').find('.required').addClass('toberequired');

			$('#billing-details').find('.checkout-details-input').removeClass('required');

		} else {

			$('#billing-details').find('.toberequired').addClass('required');

			$('#billing-details').find('.checkout-details-input').removeClass('toberequired');

			$('#billing-details').show();

		}

	});



	$('body').scrollTo('#gift-vouchers');



	$('body').scrollTo('#shipping-options');



	$('.shipping-button').change(function()	{

		$('#mask').show();

		$(this).parents('form').submit();

	});



	$('.verify-payment').click(function()	{

		var output = "";

		var newoutput = "";

		var newdiv2 = document.createElement('div');

		$(newdiv2).addClass('checkout-errors');

		$(newdiv2).attr('id', 'c-errors');

		$('body').append(newdiv2);



		$('.checkout-payment-select').find('input[type="text"]').each(function()	{

			if ($(this).val() == ""){

				output += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().prev().html() + "</span> field empty.</span></li>";

			}

		});

		$('.checkout-payment-select').find('select').each(function()	{

			if ($(this).val() == ""){

				output += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

			}

		});

		$('.checkout-payment-select').find('input[type="checkbox"]').each(function()	{
			 if ($(this).prop('checked')==false){ 
				output += "<li><span>You can't leave the. <span class='highlight'>Please accept terms & conditions!</span></span></li>";
			}
		});

		if (output != "")	{

			newoutput = "<ul class='checkout-errors2'>";

			newoutput += output;

			newoutput += "</ul>";

			//$(newdiv2).append(newoutput);

			$.fancybox({

				'href': '#c-errors',

				afterLoad   : function() {

	        		this.inner.prepend( newoutput );

	    		}

	    	});

			return false;

		} else {

			return true;

		}



	});



	$('.submit-landing-form').click(function()	{

		$('#landing-form').submit();



		return false;

	});



	$('#landing-form').submit(function(e)	{

		e.preventDefault();



		if ($('#jackets-only').is(':checked') && $('#pants-only').is(':checked'))	{

			window.location = $('#suits-only').val();

		} else if ($('#jackets-only').is(':checked'))	{

			window.location = $('#jackets-only').val();

		} else if ($('#pants-only').is(':checked'))	{

			window.location = $('#pants-only').val();

		} else {

			window.location = $('#suits-only').val();

		}

	});



});



$('form#loginform').on('submit', function(e)	{

	$('form#loginform p.status').show().text("Sending user info, please wait...");

	$.ajax({

		type: 'POST',

		dataType: 'json',

		url: ajax_object.ajax_url,

		data: { 

			'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin

			'username': $('form#loginform #label-box-email').val(), 

			'password': $('form#loginform #label-box-psw').val(),

			'redirect_to': $('form#loginform #redirect_to').val(),

			'security': $('form#loginform #security').val() },

		success: function(data){

			$('form#loginform p.status').html(data.message);

			if (data.loggedin == true){

				document.location.href = data.redirect_to;

			}

		}

	});

	e.preventDefault();

});

// Ajax // Very Important Part!!!

$('body').on( 'click', '.product-link', load_steps);

$('body').on( 'keyup', '#search-input', function(){

	var selector = $(this);
	current_div = selector.parent();

	setTimeout(function(){
		current_div.find('.loading-search').remove();
		current_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');

		$('.browse-results').infinitescroll('destroy');
		$('.browse-results-search').infinitescroll('destroy');

		refine_search2();
	}, 500);
});
$('body').on( 'change', '.select-change', refine_search2);

var current_div = "";
var next_page_link = $('.posts-nav a').attr('href');
var current_url = document.URL;


function showSearchedProducts(url, before_load, append_to) {
	$('.posts-nav').remove();

	$.get(url, function(data) {
		append_to.html(data);
	})
	.done(function() {
		$('.loading-search').remove();
		$('.browse-results-search').infinitescroll('destroy');
		$('.browse-results-search').infinitescroll({
			//state: {
				//isDestroyed: false,
				//isDone: false
			//},
			loading			:	{
				finishedMsg		: "<em>You've reached the end of the page.</em>",
				msgText			: "<em>Loading ...</em>",
			},
			debug           : true,
			extraScrollPx	: 500,
			nextSelector    : "div.posts-nav-search a",
			navSelector     : "div.posts-nav-search",
			contentSelector : ".browse-results-search",
			itemSelector    : ".browse-results-search div.span3"//,
		});
	})
	.fail(function() {
		$('.loading-search').remove();
	})
	.always(function() {
		
	});
}

function refine_search2()	{
	current_div = $(this).parent();

	$('.browse-results').infinitescroll('destroy');
	$('.browse-results-search').infinitescroll('destroy');

	form_data = $("#refine-results").serialize();
	general_form_data = $('#general-settings').serialize();
	form_data2 = form_data + "&" + general_form_data;
	current_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');
	
	$.ajax({
		type: "POST",
		url: ajax_object.ajax_url,
		data: form_data2,
		dataType: 'json',
		beforeSend: function() {
			$('.browse-results-search').infinitescroll('destroy');
		},
		success: function(result) {
			$('#post_count span').html(result.post_count);

			// Add Search Args to Next Page Link
			var new_string = "";
			var first_separator = "?";
			var separator = "&";
			if (result.search_args !== undefined)	{
				new_string = first_separator + "addquery=true";
				$.each(result.search_args, function(index, element)	{
					if (element.length)	{
						new_string += separator + index + "=" + element;
					}
				});
			} else {
				new_string = first_separator + "addquery=true";
			}
			showSearchedProducts(current_url + new_string, current_div, $('#show-all-products'));
		}
	});
}

function refine_search()	{

	current_div = $(this).parent();

	if(xhr) 
	{
		xhr.abort();
		current_div.find('.loading-search').remove();
	}

	form_data = $("#refine-results").serialize();
	
	general_form_data = $('#general-settings').serialize();

	form_data2 = form_data + "&" + general_form_data;

	current_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');

	xhr = $.ajax({

		type: "POST",

		url: ajax_object.ajax_url,

		data: form_data2,

		dataType: 'json',

		success: function(result) {

			$('.browse-results').infinitescroll('destroy');

			// Reload Products Based on New Query

			$('.browse-results').html(result.html_output);

			$('#post_count span').html(result.post_count);



			// Add Search Args to Next Page Link

			var next_page_link = $('.posts-nav a').attr('href');

			var new_string = "";

			var first_separator = "?";

			var separator = "&";

			if (result.search_args !== undefined)	{

				new_string = first_separator + "addquery=true";

				$.each(result.search_args, function(index, element)	{

					if (element.length)	{

						new_string += separator + index + "=" + element;

					}

				});

			}

			//alert(new_string);

			$('.posts-nav2 a').attr('href', next_page_link + new_string);

			//init_scroll();

			$('.browse-results').infinitescroll({

				state: {

					isDestroyed: false,

					isDone: false

				},

				loading			:	{

					finishedMsg		: "<em>You've reached the end of the page.</em>",

					msgText			: "<em>Loading ...</em>",

				},

				debug           : true,

				extraScrollPx	: 500,

				nextSelector    : "div.posts-nav a",

				navSelector     : "div.posts-nav",

				contentSelector : ".browse-results",

				itemSelector    : ".browse-results div.row-fluid",

				path			: function(pageNum)	{

					return ajax_object.prod_url + "page/" + pageNum + "/" + new_string;

				}

			});

			$('.browse-results').infinitescroll('bind');

			current_div.find('.loading-search').remove();

		}

	});

}



function load_steps()	{

	$('.browse-results').infinitescroll('unbind');

	var second_step = "";

	var step = 0;

	$('#mask').show();

	form_data = $(this).parents('form').serialize();

	general_form_data = $('#general-settings').serialize();

	form_data2 = form_data + "&" + general_form_data;

	$.ajax({

		type: "POST",

		url: ajax_object.ajax_url,

		data: form_data2,

		dataType: 'json',

		success: function(result) {

			$('.product-tab').hide();

			$('.steps-tabs li').removeClass('browse-navbar-active').addClass('is_active');

			if (result.header)	{

				$('.made-shirt-header').hide();

				$('#step-header').show();

			}

			if(result.diable_step)	{

				$('.steps-tabs li.step-' + result.diable_step).removeClass('is_active');

			}



			// load steps from files

			$.each(result, function(index, element)	{

				$(element.tab).html(element.html);

				if (step == 0)	{

					second_step = element.tab;

				}

			step++;

			});



			$('body').scrollTo('#design-tab');



			// Load Second Step

			$(second_step).show();

			$('#target-jacket-buttons-double').parent().hide(); // Hide Double Option for Blazers/Jackets/Suits

			$('.steps-tabs li').find('a[href="'+second_step+'"]').parent().addClass('browse-navbar-active');



			var current_option = $('.measure-selected').val();

			if ($('#'+current_option).length)	{

				$('.sizing-options').hide();

				$('#'+current_option).show();

			}



			$('#mask').hide();

		}

	});

	return false;

}

// End Ajax



// Design/Extras Image pop-up Selection

$('body').on('focus mousedown', '.select-popup', function(e)	{

	e.preventDefault();

	this.blur();

	window.focus();

	$.fancybox({

		'autoScale': true,

		'transitionIn': 'elastic',

		'transitionOut': 'elastic',

		'speedIn': 500,

		'speedOut': 300,

		'autoDimensions': true,

		'centerOnScroll': true,

		'href' : $(this).attr('data-popup')

	});

});

$('body').on('click', '.popup-input-box', function()	{

	$(this).parents('.popup-window').find('.popup-input-box').removeClass('selected-option');

	$(this).addClass('selected-option');

	var selected_value = $(this).attr('data-select');

	var selected_target = $(this).parents('.popup-window').attr('data-target');
    
    var selected_value_2 = $(selected_target).children('option[value^="'+selected_value+'"]').val();
    
    $(selected_target).val(selected_value_2);

	$.fancybox.close();

});

if ($('#target-monogram').val() != "No-0")
{
	$('.monogram').show();
} 
else
{
	$('.monogram').hide();
}


$('body').on('change', '#target-monogram', function()	{
	if ($(this).val() != "No-0")
	{
		$('.monogram').show();
	} 
	else
	{
		$('.monogram').hide();
	}
});

$('body').on('click', '#design-jacket-style .popup-input-box', function()	{

	$('#target-jacket-buttons-single, #target-jacket-buttons-double').parent().hide();

	if ($(this).data('select') == "Single Breast")	{

		$('#target-jacket-buttons-single').parent().show();

	} else	{

		$('#target-jacket-buttons-double').parent().show();

	}

});

$('body').on('click', '.suit-tab', function()	{

	$('.suit-tab').removeClass('selected');

	$('.suit-content').hide();

	var selected_content = $(this).attr('href');

	if (selected_content == "#pants-design-options")	{

		$('.suit-next-btn').addClass('change-step').removeClass('change-suit-tab');

		$('.suit-back-btn').addClass('suit-step-back');

	} else {

		$('.suit-next-btn').addClass('change-suit-tab').removeClass('change-step');

		$('.suit-back-btn').removeClass('suit-step-back');

	}

	$(this).addClass('selected');

	$(selected_content).show();

	return false;

});

$('body').on('click', '.change-suit-tab',function()	{

	$('.suit-tab').removeClass('selected');

	$('.suit-content').hide();

	var selected_content = "#pants-design-options";

	$(this).addClass('change-step').removeClass('change-suit-tab');

	$('.suit-back-btn').addClass('suit-step-back');

	$('.suit-tab[href="#pants-design-options"]').addClass('selected');

	$(selected_content).show();

	return false;

});

$('body').on('click', '.suit-step-back', function()	{

	$('.suit-tab').removeClass('selected');

	$('.suit-content').hide();

	var selected_content = "#jacket-design-options";

	$(this).removeClass('suit-step-back');

	$('.suit-next-btn').addClass('change-suit-tab').removeClass('change-step');

	$('.suit-tab[href="#jacket-design-options"]').addClass('selected');

	$(selected_content).show();

	return false;

});

$('#contrasting-collar-cuff-lining-fabrics')._scrollable();

$('body').on('focus mousedown', '#target-contrasting-collar-cuff-lining', function(e)	{

	e.preventDefault();

	this.blur();

	window.focus();

	$('#contrasting-collar-cuff-lining-fabrics').find('img').each(function()	{

		$(this).attr('src', $(this).data('src'));

	});



	$.fancybox({

		'autoScale': true,

		'transitionIn': 'elastic',

		'transitionOut': 'elastic',

		'speedIn': 500,

		'speedOut': 300,

		'autoDimensions': true,

		'centerOnScroll': true,

		'href' : "#contrasting-collar-cuff-lining-fabrics",

		afterShow  :   function() {

			$(".fancybox-inner").scrollTo( '#selected-fabric', 500 );

		}

	});

});

$('body').on('focus mousedown', '#target-contrastingcollar-cuff-lining', function(e)	{

	e.preventDefault();

	this.blur();

	window.focus();

	$('#contrasting-collar-cuff-lining-fabrics').find('img').each(function()	{

		$(this).attr('src', $(this).data('src'));

	});



	$.fancybox({

		'autoScale': true,

		'transitionIn': 'elastic',

		'transitionOut': 'elastic',

		'speedIn': 500,

		'speedOut': 300,

		'autoDimensions': true,

		'centerOnScroll': true,

		'href' : "#contrasting-collar-cuff-lining-fabrics",

		afterShow  :   function() {

			$(".fancybox-inner").scrollTo( '#selected-fabric', 500 );

		}

	});

});

$('body').on('click', '.select-fabric', function()	{

	$(this).parent().find('li').removeAttr('id').removeClass('selected-fabric');

	$(this).addClass('selected-fabric');

	$(this).attr('id', 'selected-fabric');

	$('#lining-code').remove();

	var fabric_title = $(this).find('.fabric-title').text();

	$('#target-contrasting-collar-cuff-lining').find('option').removeAttr('selected');

	if (fabric_title != "No Lining")	{

		$('#target-contrasting-collar-cuff-lining').after('<input type="hidden" id="lining-code" name="extras[lining-code]" value="'+$(this).find('.fabric-title').data('fabriccode')+'" />');

		var yes_option = $('#target-contrasting-collar-cuff-lining').find('option[value="Yes-1"]');

		var yes_option_price = $(yes_option).text().replace(/.*\[|\]/gi,'');

		var new_yes_option_text = $(this).find('.fabric-title').text() + "["+yes_option_price+"]";

		$('#target-contrasting-collar-cuff-lining').val('Yes-1');

		$(yes_option).attr('selected', 'selected');

		$(yes_option).text(new_yes_option_text);

	} else {

		var no_option = $('#target-contrasting-collar-cuff-lining').find('option[value="No-0"]');

		$(no_option).attr('selected', 'selected');

		var yes_option = $('#target-contrasting-collar-cuff-lining').find('option[value="Yes-1"]');

		justName = $(yes_option).text().replace(/.*\[|\]/gi,'');

		$(yes_option).text("Yes["+justName+"]");

	}

	$.fancybox.close();

});

$('body').on('click', '.select-fabric', function()	{

	$(this).parent().find('li').removeAttr('id').removeClass('selected-fabric');

	$(this).addClass('selected-fabric');

	$(this).attr('id', 'selected-fabric');

	$('#lining-code').remove();

	var fabric_title = $(this).find('.fabric-title').text();

	$('#target-contrastingcollar-cuff-lining').find('option').removeAttr('selected');

	if (fabric_title != "No Lining")	{

		$('#target-contrastingcollar-cuff-lining').after('<input type="hidden" id="lining-code" name="extras[lining-code]" value="'+$(this).find('.fabric-title').data('fabriccode')+'" />');

		var yes_option = $('#target-contrastingcollar-cuff-lining').find('option[value="Yes-1"]');

		var yes_option_price = $(yes_option).text().replace(/.*\[|\]/gi,'');

		var new_yes_option_text = $(this).find('.fabric-title').text() + "["+yes_option_price+"]";

		$('#target-contrastingcollar-cuff-lining').val('Yes-1');

		$(yes_option).attr('selected', 'selected');

		$(yes_option).text(new_yes_option_text);

	} else {

		var no_option = $('#target-contrastingcollar-cuff-lining').find('option[value="No-0"]');

		$(no_option).attr('selected', 'selected');

		var yes_option = $('#target-contrastingcollar-cuff-lining').find('option[value="Yes-1"]');

		justName = $(yes_option).text().replace(/.*\[|\]/gi,'');

		$(yes_option).text("Yes["+justName+"]");

	}

	$.fancybox.close();

});

// End Design/Extras Image pop-up Selection



// Product Tab Content

$('body').on('click', '.steps-tabs li', function(e)	{
    //if ($(this).hasClass('is_active'))	{
        var current_step = $(this).find('a').attr('href');
        var check_monogram_status = 0; //not error
		if ($('.steps-tabs li').index($(this)) == 0)	
		{
			$('.browse-results').infinitescroll('bind');
			if ($('#browse-shirts-option').val() == "product-made-shirt")	
			{
				$('.made-shirt-header').show();
				$('#step-header').hide();
			}
			$('.steps-tabs li').removeClass('is_active');
		}

		if (current_step == "#sizing-tab")	
		{
			// Check Monogram - Display Required pop up
			if (!check_monogram())	//false
			{ 
				//check_monogram_status = 1; //error
				return false;
			}
            $('.browse2-product-feed').hide();
            $('.browse2-product-extra').hide();
		}
        else
        {
            $('.browse2-product-feed').show();
            $('.browse2-product-extra').show();
        }

		$('.product-tab').slideUp();
		$('.steps-tabs li').removeClass('browse-navbar-active');
		// Change Sizing Options based on Design/Extras
		change_sizing_options();
		$(current_step).show();
		$(this).addClass('browse-navbar-active');
	//}
});



$('body').on('click', '.change-step', function(e)	{
	e.preventDefault();
	var selected_href = $(this).attr('href');
	var selected_li = $('.steps-tabs').find('a[href="'+selected_href+'"]').parent();
	// Change Sizing Options based on Design/Extras
	change_sizing_options();
	selected_li.click();
});



$('body').on('click', '.step-back', function(e)	{

	e.preventDefault();

	var selected_li = $('.steps-tabs').find('li.browse-navbar-active');

	var to_select = $(selected_li).prev();

	var current_step = $(to_select).find('a').attr('href');
    
    change_sizing_options();

	to_select.click();

	/*
    $('.product-tab').hide();

	$('.steps-tabs li').removeClass('browse-navbar-active');

	if ($('.steps-tabs li').index($(to_select)) == 0)	{

		$('.browse-results').infinitescroll('bind');

		if ($('#browse-shirts-option').val() == "product-made-shirt")	{

			$('.made-shirt-header').show();

			$('#step-header').hide();

		}

		$('.steps-tabs li').removeClass('is_active');

	}

	$(to_select).addClass('browse-navbar-active');

	$(current_step).show();
    */

});



function check_monogram()	{
	if (typeof $('#target-monogram').val() !== "undefined")	{
		if ($('#target-monogram').val() != "No-0")	{
			var errors = "";
			var newoutput = "";
			if ($('.popup-color-position select').val() == "")	{
				errors += "<li><span>You can't leave the <span class='highlight'>Monogram Position</span> field empty.</span></li>";
			}
			if ($('.popup-name input').val() == "")	{
				errors += "<li><span>You can't leave the <span class='highlight'>Monogram Text</span> field empty.</span></li>";
			}
			if (errors.length)	{
				var newdiv2 = document.createElement('div');
				$(newdiv2).addClass('checkout-errors');
				$(newdiv2).attr('id', 'c-errors');
				$('body').append(newdiv2);
				newoutput = "<ul class='checkout-errors2'>";
				newoutput += errors;
				newoutput += "</ul>";
				$('.steps-tabs li.step-extras').click();
				$.fancybox({
					'href': '#c-errors',
					afterLoad   : function() {
						this.inner.prepend( newoutput );
					}
				});
				return false;
			}
		}
	}
	return true;
}



function change_sizing_options()	{

	// Short Sleeve

	if ($('#target-cuff').val() == "Short Sleeve")	{

		$('.input-profile.container-arm-length').hide();

		$('.input-profile.container-arm-length-short').show();

	}

}



$('body').on('click', '.edit-this-design', function()	{

	$('#edit-shirt').show();

	$('#ready-made').slideUp();

	$('.steps-tabs li').addClass('is_active');



	return false;

});



// Step 4 Javascript

$('body').on('change', '.select-profile select', function()	{

	if ($(this).val() == "")	{

		$('#profile-name').val();

	} else {

		var current_div = $(this).parent();

		current_div.find('.loading-search').remove();

		current_div.append('<img src="'+ ajax_object.ajax_url +'/../../wp-content/themes/pickashirt/images/ajax-loader-search.gif" class="loading-search" />');

		$.ajax({

			type: "POST",

			url: ajax_object.ajax_url,

			data: "action=fill-profile&profile-key=" + $(this).val(),

			dataType: 'json',

			success: function(result) {

				//current_value_type = $();

				var sizingtype = result.sizing.sizing_type;

				var valuetype = result.sizing.value_type;

				$('.sizing-options').hide();

				$('.options-container').hide();

				$('#measure-option').val(sizingtype);

				if ($('#measure-your-jacket').length)	{

					$('#measure-your-jacket').find('#profile-name').val(result.profile_name);

					$('#measure-your-jacket').show();

				}

				$('#' + sizingtype).find('#profile-name').val(result.profile_name);

				$('#' + sizingtype).show();

				if (sizingtype == "standard-sizing")	{

					replace_standard_sizing_values(valuetype);

				} else {

					replace_body_shirt_values(valuetype);

				}

				$.each(result.sizing, function(i, e)	{

					if (i == "general")	{

						$.each(e, function(gi, ge)	{console.log("124 cm / 4’1\"" + "//" + ge.replace("'", "’"));

							$('select[name="sizing['+sizingtype+']['+i+']['+gi.replace(/\_/g, "-")+']"]').val(ge.replace("'", "’"));

						});

					} else {

						if (sizingtype == "standard-sizing")	{
						  
                            // Populate Sleeve Measurements

							if (i == "value_type")	{

								$('.change-neck-values').each(function()	{

									if ($(this).val() == e)	{

										$(this).attr('checked', 'checked');

									}

								});

							} else {

								$('[name="sizing['+sizingtype+']['+i.replace(/\_/g, "-")+']"]').val(e);

							}

						} else {

							$('[name="sizing['+sizingtype+']['+i.replace(/\_/g, "-")+']"]').val(e);	

						}

					}

				});
                
                $('.selected-values').removeAttr('disabled');
                
                current_div.find('.loading-search').remove();

			}

		});

	}



});

$('body').on('change', '#measure-option', function()	{

	var current_option = $(this).val();

	$('.sizing-options').hide();

	$('.options-container').hide();

	$('#'+current_option).show();

});

$('body').on('click', '.select-sizing-option', function()	{

	var current_option = $(this).data('sizing-option');

	$('#measure-option').val(current_option);

	$('.sizing-options').hide();

	$('.options-container').hide();

	$('#'+current_option).show();

});

$('body').on('click', '.measure-small-nav a', function()	{

	var selected_tab = $(this).attr('href');

	$('.measure-small-nav a').removeClass('selected');

	$('.options-container').hide();

	$(this).addClass('selected');

	$(selected_tab).show();

	return false;

});

$('body').on('submit', "#main-product-form, #profile-measurements-form", function(e)	{

	var errors = "";

	var newoutput = "";

	if (!$('.options-container').is(':visible'))	{

		errors += "<li><span>You need to select a Sizing Option</span></li>";

	} else {

	//	alert($('.input-profile').parents('.options-container').attr('id'));

		$('.options-container').each(function()	{ 

			if ($(this).is(':visible'))	{//console.log($(this).attr('id'));

				if ($(this).find('#profile-name').val() == "")	{

					errors += "<li><span>You need to fill in the <span class='highlight'>Profile Name</span> field.</span></li>";

				}

				if ($(this).attr('id') == "standard-sizing")	{ // Standard Sizing different check

					$('select.standard-neck-values, select.standard-sleeve-values, input.standard-input, select.general-values.standard-input').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

				} else {

					$(this).find('select.general-values').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the Profile General <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

					$(this).find('select.selected-values:visible').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

				}



				if ($(this).attr('id') == "measure-your-jacket")	{

					$('#measure-your-pants').find('select.selected-values').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

				} else if ($(this).attr('id') == "measure-your-pants")	{

					if ($('#measure-your-jacket').find('#profile-name').val() == "")	{

						errors += "<li><span>You need to fill in the <span class='highlight'>Profile Name</span> field.</span></li>";

					}

					$('#measure-your-jacket').find('select.general-values').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the Profile General <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

					$('#measure-your-jacket').find('select.selected-values').each(function()	{

						if ($(this).val() == "")	{

							errors += "<li><span>You can't leave the <span class='highlight'>" + $(this).prev().html() + "</span> field empty.</span></li>";

						}

					});

				}

			}

		});

	}



	if (errors.length)	{

		var newdiv2 = document.createElement('div');

		$(newdiv2).addClass('checkout-errors');

		$(newdiv2).attr('id', 'c-errors');

		$('body').append(newdiv2);

		newoutput = "<ul class='checkout-errors2'>";

		newoutput += errors;

		newoutput += "</ul>";

		$.fancybox({

			'href': '#c-errors',

			afterLoad   : function() {

				this.inner.prepend( newoutput );

			}

		});

		e.preventDefault();

	}

});



function replace_body_shirt_values(value)	{

	var other_value = "";

	if (value == "centimeters")	{

		other_value = "inches";

	} else {

		other_value = "centimeters";

	}

	var to_replace;

	var replacements;

	$('.input-profile').each(function()	{

		to_replace = $(this).find('.selected-values').html();

		replacements = $(this).find('.replace-values[data-type="'+value+'"]').html();

		$(this).find('.selected-values').html(replacements);

	});

}

function replace_standard_sizing_values(value)	{

	var other_value = "";

	if (value == "centimeters")	{

		other_value = "inches";

	} else {

		other_value = "centimeters";

	}

	var to_replace = $('.standard-neck-values').html();

	var replacements = $('.unselected-neck-values[data-type="'+value+'"]').html();

	$('.standard-neck-values').html(replacements);

}



// Change Cm/In

$('body').on('change', '.change-values', function()	{

	var current_val = $(this).val();

	replace_body_shirt_values(current_val);

});

$('body').on('click', '.change-neck-values', function()	{

	var current_val = $(this).val();

	replace_standard_sizing_values(current_val);

});

// End Change Cm/In



$('body').on('change', '.input-profile select', function()	{

	var option_selected = $(this).children(':selected');

	$(this).children().attr('selected', false);

	$(this).val(option_selected.val());

	option_selected.attr('selected', true);

});



$('body').on('change', '.standard-neck-values', function()	{

// Legend: 0,1 keys are Standard Sleeve Lenghts and 2,3 keys are the main interval

	var option_selected = $(this).children(':selected');

	$(this).children().attr('selected', false);

	$(this).val(option_selected.val());

	option_selected.attr('selected', true);



	var data_sleeve = $(this).children(':selected').attr('data-alt');

	var sleeve_array = data_sleeve.split(","), i;

	var standard_option_list = "";

	var option_list = "";

	var standard_interval = new Array;

	var main_interval = new Array;



// Get Step based on value

	$('.change-neck-values').each(function()	{

		if ($(this).is(':checked'))	{

			value_type = $(this).val();

		}

	});

	if (value_type == "centimeters")	{

		step = 1;

	} else 	{

		step = 0.5;

	}



	// Create Standard Interval

	var sleeve0 = Number(sleeve_array[0]);

	var sleeve1 = Number(sleeve_array[1]);

	x = sleeve0;

	standard_option_list = '<optgroup label="Standard sleeve lengths">';

	while (x <= sleeve1)	{

		standard_interval[standard_interval.length] = x;

		standard_option_list += '<option value="' + x + '">' + x + '</option>';

	x=x+step;

	}

	standard_option_list += '</optgroup>';



	// Create Main Interval and Exclude Standard Lenghts

	var sleeve2 = Number(sleeve_array[2]);

	var sleeve3 = Number(sleeve_array[3]);

	var y = sleeve2;

	option_list = '<optgroup label="Special sleeve lengths">';

	while (y <= sleeve3)	{

		if (!in_array(y, standard_interval))	{

			main_interval[main_interval.length] = y;

			option_list += '<option value="' + y + '">' + y + '</option>';

		}

		y=y+step;

	}

	option_list += '</optgroup>';



	$('.standard-sleeve-values').html(standard_option_list + option_list);

});

$('body').on('focus mousedown', '.standard-fit', function()	{

	$.fancybox({'href': '#standard-fit',});

});

$('body').on('click', '.sfit-row', function()	{

	var data = $(this).attr('data-value');

	$('.standard-fit').val(data);

	$.fancybox.close();

});



// Info Tab Content

$('body').on('click', '.input-profile', function()	{

	$(this).parent().find('.input-profile').removeClass('input-profile-active');

	$(this).parents('.options-container').find('.field-info').hide();

	var current_tab = $(this).attr('data-info');

	$('#' + current_tab).show();

	$(this).addClass('input-profile-active');

});

$('body').on('focus', '.input-profile select', function()	{

	$(this).parent().click();

});







// Infinite Scrolling

(window.INFSCR_jQ ? jQuery.noConflict() : jQuery)(function($){

	init_scroll();
	init_scroll_browse_shirt();

});



function init_scroll()	{
	$('.browse-results').infinitescroll({
		loading			:	{
			finishedMsg		: "<em>You've reached the end of the page.</em>",
			msgText			: "<em>Loading ...</em>",
		},
		debug           : true,
		extraScrollPx	: 500,
		nextSelector    : "div.posts-nav a",
		navSelector     : "div.posts-nav",
		contentSelector : ".browse-results",
		itemSelector    : ".browse-results div.row-fluid"
	});
}

function init_scroll_browse_shirt()	{
	$('.browse-results-search').infinitescroll({
		loading			:	{
			finishedMsg		: "<em>You've reached the end of the page.</em>",
			msgText			: "<em>Loading ...</em>",
		},
		debug           : true,
		extraScrollPx	: 500,
		nextSelector    : "div.posts-nav a",
		navSelector     : "div.posts-nav",
		contentSelector : ".browse-results-search",
		itemSelector    : ".browse-results-search div.span3"
	});
}




// Helper Functions

function verify_checkout()	{

	var output = "";

	var newoutput = "";

	var input = "";

	var newdiv2 = document.createElement('div');

	$(newdiv2).addClass('checkout-errors');

	$(newdiv2).attr('id', 'c-errors');

	$('body').append(newdiv2);

	$('.checkout-details-input.required').each(function()	{

		input = $(this).find('input');

		if ($(input).val() == "")	{

			output += "<li><span>You can't leave the <span class='highlight'>" + $(input).prev().html() + "</span> field empty.</span></li>";

		} else {

			if ($(this).hasClass('verify-email'))	{

				if (!validateEmail($(input).val()))	{

					output += "<li><span>You must enter a valid email in the <span class='highlight'>" + $(input).prev().html() + "</span></span></li>";

				} else {

					if ($(this).hasClass('confirm-email'))	{

						if ($(input).val() != $(this).prev().find('input').val())	{

							output += "<li><span>The  <span class='highlight'>" + $(input).prev().html() + "</span> field must match the <span class='highlight'>" + $(this).prev().find('input').prev().html() + "</span> field</span></li>";	

						}

					}

				}

			}

		}

	});

	

	if (output != "")	{

		newoutput = "<ul class='checkout-errors2'>";

		newoutput += output;

		newoutput += "</ul>";

		//$(newdiv2).append(newoutput);

		$.fancybox({

			'href': '#c-errors',

			afterLoad   : function() {

        		this.inner.prepend( newoutput );

    		}

    	});

		return false;

	} else {

		return true;

	}

	

}



function validateEmail(email) { 

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    return re.test(email);

}



function in_array(needle, haystack) {

    for(var a in haystack) {

        if(haystack[a] == needle) return true;

    }

    return false;

}



var addUrlParam = function(search, key, val){

  var newParam = key + '=' + val,

      params = '?' + newParam;



  // If the "search" string exists, then build params from it

  if (search) {

    // Try to replace an existance instance

    params = search.replace(new RegExp('[\?&]' + key + '[^&]*'), '$1' + newParam);



    // If nothing was replaced, then add the new param to the end

    if (params === search) {

      params += '&' + newParam;

    }

  }



  return params;

};