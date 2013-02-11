<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>js Events</title>
<style>
#js {
	width: 500px;
	height: 250px;
	border: 1px solid black;
	margin: 25px auto auto auto;
	display: none;
}
</style>
<script type="text/javascript">

var addEvent = function(obj, type, fn) {
	if(obj.attachEvent) {
		obj['e' + type + fn] = fn;
		obj[type + fn] = function(){obj['e' + type + fn](window.event);};
		obj.attachEvent('on'+type, obj[type+fn]);
	} else {
		obj.addEventListener(type, fn, false);
	}
};

var removeEvent = function(obj,type,fn) {
	if(obj.detachEvent) {
		obj.detachEvent('on'+type, obj[type+fn]);
		obj[type+fn] = null;
	} else {
		obj.removeEventListener(type,fn,false);
	}
};

var honza = function(event) { //udalost se predava s parametrem, v nasem pripade pojmenovanem event 
	console.log(event);
};

var text_green = function() {
	var prvek_div = document.getElementById('js');
	if(prvek_div != null) {
		prvek_div.style.color = 'green';
	}
};

var text_red = function() {
	var prvek_div = document.getElementById('js');
	if(prvek_div != null) {
		prvek_div.style.color = 'red';
	}
};

var odkaz_ne = function() {
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
	var odkaz = document.getElementById('odk');
	odkaz.style.color = 'yellow';
};

var vypis = function(text) {
	var info = document.getElementById('info');
	info.innerHTML = text;
};

var ready = function() {

	var prvek_div = document.getElementById('js');
	var odkaz = document.getElementById('odk');
	if(prvek_div != null) {
		prvek_div.style.display = 'block';
		
		//prvek_div.onmouseover = text_red;
		//prvek_div.onmouseout = text_green;
		//prvek_div.onclick = honza;

		//prvek_div.addEventListener('mouseover', text_red, false);
		//prvek_div.addEventListener('mouseout', text_green, false);
		//prvek_div.removeEventListener('mouseout', text_green, false);

		addEvent(prvek_div, 'mouseover', text_red);
		addEvent(prvek_div, 'mouseout', text_green);
		addEvent(odkaz, 'click', odkaz_ne);
	}
	
};

addEvent(window, 'load', ready);
</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div id="js" >
		<strong>JavaScript</strong>
	</div>
	<a href="http://seznam.cz" id="odk">seznam.cz</a>
</body>
</html>