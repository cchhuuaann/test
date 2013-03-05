/**
 * Hlavni fce, ze ktere se bude vse spoustet po uplnem nacteni html
 */
$(document).ready(function(){
	
	var $form = $('form');
	var $tabulka = $('div#tabulka');
	var stranky = 1;
	var radit = '';
	
//zkouseni dialogu
	var $varovani = $('<div>',{
		class: 'varovani',
		text: 'Ahoj'
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
	
	$($varovani).dialog('open');
//konec testovani
	
	var  refTabulka = function(){
		
		$tabulka.spin(spinnerOpts);
		
		//konstrukce dat k odeslani
		var formArray = $form.serializeArray();
		var data = {};
		$.each(formArray, function(i,v){
			data[v.name] = v.value;
		});
		
		//strankovani, razeni
		data['strana'] = stranky;
		data['order'] = radit;
		
		$.ajax({
			type: 'GET',
			url: URL + 'zamestnanec?nav=tabulka_jx',
			data: data,
			dataType: 'html',
			success: function(resp){
				$tabulka.html(resp);

				if($form.is(':hidden')){
					$form.fadeIn(1000);
				}
			},
			error: function( req, status, err ) {
				  console.log( 'something went wrong', status, err );
			}
		});
		
		$tabulka.spin();
		
	};
	
	var formular = function(event){
		event.preventDefault();
		
		refTabulka();	
	};
	
	var strankovani = function(event){
		event.preventDefault();
		if( $(this).data('page') && !isNaN(parseInt( $(this).data('page') )) ) {
			stranky = $(this).data('page');
		}
		refTabulka();
	};
	
	var razeni = function(event){
		event.preventDefault();
		if( $(this).data('order') ) {
			radit = $(this).data('order');
		}
		refTabulka();
	}; 
	
	console.log('OK');
	
	$form.on('submit',formular);
	$tabulka.on('click', 'a.strana', strankovani);
	$tabulka.on('click', 'a.order', razeni);
	
	refTabulka();
	
	
});