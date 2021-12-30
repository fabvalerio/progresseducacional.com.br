jQuery(document).ready(function() {
	
	jQuery('[data-toggle=offcanvas]').click(function() {
		jQuery('.row-offcanvas').toggleClass('active');
	}); 
	
});

jQuery(function () {
   jQuery('[data-toggle="tooltip"]').tooltip()
});