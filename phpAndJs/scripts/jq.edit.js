

$(document).ready(function(){
	
	var $payment = $('input#payment');
	
	var $slider = $('#slider').slider({
		animate: true,
		min: 8000,
		max: 50000,
		step: 200,
		range: 'min',
		slide: function(event, ui){
			$payment.val(ui.value);
			$payment.trigger('errorCheck');
		},
		change: function() {
			$('#chyba').html('');
		}
	});
	
	$payment.on('change.only_slider',function(){
		
		if(!($.isNumeric($payment.val()))){
			return;
		}
		if(!($payment.val() >= 8000 && $payment.val() <= 50000)){
			return;
		}
		if( ($payment.val() % 200) != 0){
			return;
		}
		
		$slider.slider('option','value',$payment.val());
	});
	
	$payment.trigger('change.only_slider');

	
	$('#pobocka').multiselect({
		checkAllText: "",
		uncheckAllText: "",
		noneSelectedText: "Vyberte pobočku",
		selectedText: "Vybráno: #",
		selectedList: "1",
		show: ""
		
		
	});
	
	var changeSelect = function(){
		
		var $selectP = $('select#pobocka');
		var $selectF = $('select#firma');
		
		var data = {
				'firma_id': $selectF.val()
		};
		
		$.ajax({
			type: 'GET',
			url: URL + 'zamestnanec?nav=get_pobocky_jx',
			data: data,
			dataType: 'html',
			success: function(resp){
				$selectP.html(resp);
				$("#pobocka").multiselect("refresh");
			}
		});
		
		
		
	};
	
	$('select#firma').on('change',changeSelect);
	
});