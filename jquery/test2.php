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

		var list = $('div#seznam>ul');
		var listItems = list.find('li');
		console.log(listItems);
		for(var i = (listItems.length - 2); i >= 0; i -= 1) {
			listItems.eq(i).appendTo(list);
		}
		
	});

</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div class="vlevo"></div>
	<div class="vlevo vpravo"></div>
	<div class="vpravo"></div>
	<div class="vlevo"></div>
	<div class="vpravo"></div>
	<hr style="width: 100%" />
	<div id="seznam">
		<ul>
			<li>jedna</li>
			<li>dva</li>
			<li>tri</li>
			<li>ctyri</li>
			<li>pet</li>
			<li>sest</li>
		</ul>
	</div>
</body>
</html>