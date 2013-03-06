$(document).ready(function(){
	
	var $form = $('form');
	var $tabulka = $('div#tabulka');
	var stranky = 1;
	var radit = '';

	var  tabulka = function(){
		
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
			url: URL + 'firma?nav=statistika_jx',
			data: data,
			dataType: 'html',
			success: function(resp){
				$tabulka.html(resp);
				$tabulka.css({
					'width': 500,
					'margin-left': 'auto',
					'margin-right': 'auto',
					'font-size': 14
				});
				$tabulka.accordion({
					collapsible: true,
					active: false
				});
			}
		});
		
		$tabulka.spin();
		
	};

	
	var formular = function(event){
		event.preventDefault();
		
		tabulka();	
	};
 
	console.log('OK');
	
	$form.on('submit',formular);
	
	tabulka();
	
});