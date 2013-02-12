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

		//var vlevo = '<strong>vlevo</strong>';
		//var vpravo = '<em>vpravo</em>';

		//$('div.vlevo').html(vlevo);
		//$('div.vpravo').html(vpravo);

		var vlevo = $('<strong>',{
			html: 'vlevo'
		});

		var vpravo = $('<em>',{
			html: 'vpravo'
		});

		$('div.vlevo').append(vlevo);
		$('div.vpravo').append(vpravo);
		
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
		<ul id="prvni">
			<li>ahoj</li>
			<li class="special">zdar</li>
			<li>quote <span>nebo</span> uvozovky</li>
			<li><ul id="druhy">
					<li>volvo</li>
					<li>saab</li>
					<li><ul id="treti">
							<li>slunce</li>
							<li>mars</li>
							<li>pluto</li>
						</ul></li>
					<li>skoda</li>
					<li>fiat</li>
				</ul></li>
			<li class="special">neco</li>
		</ul>
	</div>
	<hr style="width: 100%" />
	<div class="vlevo"></div>
	<div class="vlevo"></div>
	<div class="vpravo"></div>
	<div class="vlevo"></div>
	<div class="vpravo"></div>
</body>
</html>