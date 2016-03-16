jQuery(document).ready(function($) {

    $(document).on( 'click', '#more', function( event ) {
    	event.preventDefault();

    		event.preventDefault();

	        $.ajax({
	        	url: ajaxpagination.ajaxurl,
	        	type: 'post',
	        	data: {
	        		action: 'ajax_pagination'
	        	},
	        	
	        	success: function( result ) {
	        		alert( result );
	        	}
	        });
            
     
    })

});