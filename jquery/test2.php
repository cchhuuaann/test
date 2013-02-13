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
/*
		var list = $('div#seznam>ul li');
		console.log(list);
		for(var i = (list.length - 2); i >= 0; i -= 1) {
			list.eq(i).appendTo(list.parent());
		}
*/

		var arrLi = [];
		var list = $('div#seznam>ul');
		var listItems = list.find('li');
		listItems.each(function(index,elem) {
			arrLi.push($(elem).text());
			$(elem).remove();
		});
/**
 * lze resit take pomoci clone(true) - zkopiruje se cely prvek
 * (s true v zavorkach se zachova i navazani na udalosti)
 */
		arrLi.sort();
		arrLi.reverse();
		
		while(arrLi.length > 0) {
			var obsah = $('<li>',{html: arrLi.shift()});
			list.append(obsah);
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
			<li class="dva">dva</li>
			<li>tri</li>
			<li>ctyri</li>
			<li>pet</li>
			<li>sest</li>
		</ul>
	</div>
</body>
</html>