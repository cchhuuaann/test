<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>jQuery 3</title>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	var pokus = function(event){
		event.preventDefault();
		console.log( this );
	};

	$(document).ready(function(){
		
		console.log('OK');

		//$('li').click(function(event){
		//	console.log('clicked',$(this).text());
		//});

		//$('li').click();

		//$('li').off('click');

		//$('li').on('click.to mouseover.taky', pokus);

		//$('li').on('click.neco', pokus);

		//$('li').off('click.neco');
		//$('li').off('mouseover.taky');

		//$('a').on('click',pokus);

		$( '#seznam' ).on( 'click', 'li', function( event ) {
			  console.log( this );
			});

	});
</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	
	<div id="seznam">
		<ul>
			<li><b>jedna</b></li>
			<li><b>dva</b></li>
			<li><b>tri</b></li>
			<li><b>ctyri</b></li>
			<li><b>pet</b></li>
			<li><b>sest</b></li>
		</ul>
		<a href="http://seznam.cz">seznam.cz</a>
	</div>
</body>
</html>