(function($) {
    "use strict";
    
    $(document).ready(function() {
        $('#redux-import').click(function(e) {
            if ($('#import-code-value').val() === "" && $('#import-link-value').val() === "") {
                e.preventDefault();
                return false;
            }
        });      
        
        $('#redux-import-code-button').click(function() {
            if ($('#redux-import-link-wrapper').is(':visible')) {
                $('#redux-import-link-wrapper').hide();
                $('#import-link-value').val('');
            }
            $('#redux-import-code-wrapper').fadeIn('fast');
        });
        
        $('#redux-import-link-button').click(function() {
            if ($('#redux-import-code-wrapper').is(':visible')) {
                $('#redux-import-code-wrapper').hide();
                $('#import-code-value').val('');
            }
            $('#redux-import-link-wrapper').fadeIn('fast');
        });
        
        $('#redux-export-code-copy').click(functio