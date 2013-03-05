

$(document).ready(function(){
	
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
			},
			error: function( req, status, err ) {
				  console.log( 'something went wrong', status, err );
			}
		});
		
		
		
	};
	
	$('select#firma').on('change',changeSelect);
	
});