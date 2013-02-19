<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>jQuery 3</title>
<style>
#pokus {
	width: 300px;
	height: 200px;
	background-color: yellow;
}
</style>
<script src="jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		console.log('OK');

		var $temp = $('#pokus');
		/*
		$temp.hide(1500);
		$temp.show(1500);

		$temp.fadeOut(1500);
		$temp.fadeIn(1500);

		$temp.slideUp(1500);
		$temp.slideDown(1500);

		$temp.slideToggle('slow');
		$temp.slideToggle('slow');
		*/

		$temp.animate({
			left: '+=50',
			opacity: 0.25,
			fintSize: '12px'
		},
		300,
		function(){

		}
		);
		
	});
</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	
	<div id="pokus">grthjykuplh gsng htsg stoyhe h</div>
	
</body>
</html>