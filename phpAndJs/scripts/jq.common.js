$(document).ready(function(){
	
	var isError = false;
	
	var $varovani = $('<div>',{
		class: 'varovani',
		html: ''
	});
	
	$varovani.dialog({
		modal: true,
		buttons: [{
		        	text: "OK",
		        	click: function() {
		        		$( this ).dialog( "close" );
		        	}
			}],
		autoOpen: false,
		draggable: false,
		hide: 'explode',
		resizable: false,
		title: 'Chyba'
		
	});
	
	$.ajaxSetup({
		error: function( req, status, err ){
			$varovani.html(status + ', ' + err);
			$varovani.dialog('open');
		}
	});
	
	var hideError = function($element){
		$element.parent().find('.ui-widget.ui-state-error').remove();
	};
	
	var showError = function($element, error){
		hideError($element);
		var $span = $('<span>',{
			'class': 'ui-state-error-text',
			html: error
		});
		var $div = $('<div>',{
			'class': 'ui-widget ui-state-error'
		});
		$div.append($span);
		
		$element.after($div);
	};

	$('input.check').on('errorCheck',function(){
		var validace = $(this).data('validate').split(' ');
		var errors = [];
		var value = $(this).val();
		
		$.each(validace,function(i,v){
			switch(v) {
			case 'mandatory':
				if(value == '') {
					errors.push('Vyplnte kolonku');
				}
				break;
			case 'number':
				if(isNaN(parseFloat(value))) {
					errors.push('Neni cislo');
				}
				break;
			}
		});
		
		if(errors.length > 0) {
			showError($(this), errors.join('<br />'));
			isError = true;
		} else {
			hideError($(this));
		}
	});
	
	$('input.check').on('change',function(){
		$(this).trigger('errorCheck');
	});

	var totalCheck = function() {
		isError = false;
		$('input.check').trigger('errorCheck');
		return isError;
	};
	
	$('form').each(function(){
		var $form = $(this);
		if($form.find('input.check').length > 0) {
			$form.on('submit',function(event){
				event.preventDefault ? event.preventDefault() : event.returnValue=false;
				if(!totalCheck()){
					$form[0].submit();
				}
			});
		}
	});

});