<?php
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>js Time Events</title>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	var cas = null;
	var cas2 = null;
	var i = 5;

	var funkce = function() {
		$('#prvni').html($('input').val());
	}
	
	var zpozdeni = function() {
		if(cas != null) {
			window.clearTimeout(cas);
		}
		cas = window.setTimeout(funkce, 1000);
	};

	var interval = function(){
		$('#druhy').html(i);
		i -= 1;
		if(i < 0) {
			window.clearInterval(cas2);
		}
	};

	$(document).ready(function(){
		
		console.log('OK');

		$('input').keyup(zpozdeni);

		cas2 = window.setInterval(interval,500);
		
	
	});

</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<p>
	<input type="text" />
	</p>
	<div id="prvni"></div>
	<div id="druhy"></div>
</body>
</html>