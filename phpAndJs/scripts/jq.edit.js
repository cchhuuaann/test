

$(document).ready(function(){
	
	var changeSelect = function(){
		
		var $selectP = $('select#pobocka');
		var $selectF = $('select#firma');
		
		$selectP.hide(100);
		
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
				$selectP.show(100);
			},
			error: function( req, status, err ) {
				  console.log( 'something went wrong', status, err );
			}
		});
		
		
		
	};
	
	$('select#firma').on('change',changeSelect);
	
});