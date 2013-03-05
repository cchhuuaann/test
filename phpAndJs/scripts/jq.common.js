$(document).ready(function(){
	
	var $varovani = $('<div>',{
		class: 'varovani',
		text: 'Varovani'
	});
	
	$($varovani).dialog({
		buttons: [{
		        	text: "OK",
		        	click: function() {
		        		$( this ).dialog( "close" );
		        	}
		}],
		autoOpen: false
		
	});
	
	$.ajaxSetup({
		error: function( req, status, err ){
			$($varovani).dialog('open');
		}
	});
	
});