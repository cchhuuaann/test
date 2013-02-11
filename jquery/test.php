<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>jQuery</title>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		console.log('OK');

		var pokus = $('#pokus');

		if(pokus.length > 0) {
			console.log(pokus);
		}

		var listItems = $('li');
		//var rawListItem = listItems.get(0);
		//var html = rawListItem.innerHTML;
		var html = listItems.get(0).innerHTML;
		console.log(html);
		var secondListItem = listItems.eq( 1 );
		secondListItem.remove();
		
	});

</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div id="pokus">
		ydar!
	</div>
	<div id="seznam">
		<ul>
			<li>ahoj</li>
			<li class="special">zdar</li>
			<li>quote <span>nebo</span> uvozovky</li>
			<li class="special">neco</li>
		</ul>
	</div>
	<ul>
		<li>ahoj</li>
		<li class="special">zdar</li>
		<li>quote <span>nebo</span> uvozovky</li>
		<li class="special">neco</li>
	</ul>
</body>
</html>