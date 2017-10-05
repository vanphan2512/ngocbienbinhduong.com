/* global redux_change */
jQuery(document).ready(function() {

    jQuery('.redux_spinner').each(function() {
        //slider init
        var spinner = redux.spinner[jQuery(this).attr('rel')];

        jQuery("#" + spinner.id).spinner({
            value: parseInt(spinner.val, null),
            min: parseInt(spinner.min, null),
            max: parseInt(spinner.max, null),
            step: parseInt(spinner.step, null),
            range: "min",
            slide: function(event, ui) {
                var input = jQuery("#" + spinner.id);
                input.val(ui.value);
                redux_change(input);
            }
        });

        // Limit input for negative
        var neg = false;
        if (parseInt(spinner.min, null) < 0) {
            neg = true;
        }

		jQuery("#" + spinner.id).numeric({
			allowMinus: neg,
			min: spinner.min,
			max: spinner.max
		});

    });

    // Update the slider from the input and vice versa
    jQuery(".spinner-input").keyup(function() {

        jQu