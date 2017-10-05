/* global redux_change, wp */

jQuery(document).ready(function () {

    jQuery('.redux-slides-remove').live('click', function () {
        redux_change(jQuery(this));
        jQuery(this).parent().siblings().find('input[type="text"]').val('');
        jQuery(this).parent().siblings().find('textarea').val('');
        jQuery(this).parent().siblings().find('input[type="hidden"]').val('');

        var slideCount = jQuery(this).parents('.redux-container-slides:first').find('.redux-slides-accordion-group').length;

        if (slideCount > 1) {
            jQuery(this).parents('.redux-slides-accordion-group:first').slideUp('medium', function () {
                jQuery(this).remove();
            });
        } else {
            jQuery(this).parents('.redux-slides-accordion-group:first').find('.remove-image').click();
            jQuery(this).parents('.redux-container-slides:first').find('.redux-slides-accordion-group:last').find('.redux-slides-header').text("New Slide");            
        }
    });

    jQuery('.redux-slides-add').click(function () {

        var newSlide = jQuery(this).prev().find('.redux-slides-accordion-group:last').clone(true);
        var slideCount = jQuery(newSlide).find('input[type="text"]').attr("name").match(/[0-9]+(?!.*[0-9])/);
        var slideCount1 = slideCount*1 + 1;

        jQuery(newSlide).find('input[type="text"], input[type="hidden"], textarea').each(function(){

            jQuery(this).attr("name", jQuery(this).attr("name").replace(/[0-9]+(?!.*[0-9])/, slideCount1) ).attr("id", jQuery(this).attr("id").replace(/[0-9]+(?!.*[0-9])/, slideCount1) );
            jQuery(this).val('');
            if (jQuery(this).hasClass('slide-sort')){
                jQuery(this).val(slideCount1);
            }
        });

        jQuery(newSlide).find('.screenshot').removeAttr('style');
        jQuery(newSlide).find('.screenshot').addClass('hide');
        jQuery(newSlide).find('.screenshot a').attr('href', '');
        jQuery(newSlide).find('.remove-image').addClass('hide');
        jQuery(newSlide).find('.redux-slides-image').attr('src', '').removeAttr('id');
        jQuery(newSlide).find('h3').text('').append('<span class="redux-slides-header">New slide</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>');
        jQuery(this).prev().append(newSlide);
    });

    jQuery('.slide-title').keyup(function(event) {
        var newTitle = event.target.value;
        jQuery(this).parents()