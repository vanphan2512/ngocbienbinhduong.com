/* global redux, redux_opts */
/*
 * Field Sorter jquery function
 * Based on
 * [SMOF - Slightly Modded Options Framework](http://aquagraphite.com/2011/09/slightly-modded-options-framework/)
 * Version 1.4.2
 */

jQuery(function() {
    /**	Sorter (Layout Manager) */
    jQuery('.redux-sorter').each(function() {
        var id = jQuery(this).attr('id');
        jQuery('#' + id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.8,
			stop: function(event, ui) {
				var sorter = redux.sorter[jQuery(this).attr('data-id')];
				var id = jQuery(this).find('h3').text();

				if ( sorter.limits && id && sorter.limits[id] ) {
					if(jQuery(this).children('li').length >= sorter.limits[id]) {
						jQuery(this).addClass('filled');
						if (jQuery(this).children('li').length > sorter.limits[id]) {
							jQuery(ui.sender).sortable('cancel');	
						}
					} else {
						jQuery(this).removeClass('filled');
					}