<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>js Events</title>
<style>
#sledovani {
	width: 500px;
	height: 500px;
	border: 1px solid black;
	margin: 25px auto 0px auto;
	padding: 50px;
}
#info {
	width: 500px;
	height: auto;
	margin: 0px auto 25px auto;
	padding: 0px 50px 0px 50px;
	color: white;
	background-color: black;
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

var funkce = function(event) {
	
	console.log(event);

	var text = 'Typ udalosti: ';
	text += event.type;
	if(event.type === 'keypress') {
		text += ' ';
		text += event.keyCode;
	}
	text += '<br />';
	text += 'Pozice mysi: ';
	text += 'X: ' + event.x + ' Y: ' + event.y;

	vypis(text);
};

var vypis = function(text) {
	var info = document.getElementById('info');
	if(info !== null) {
		info.innerHTML = text;
	}
};

var ready = function() {

	var sledovani = document.getElementById('sledovani');
	if(sledovani !== null) {
		addEvent(sledovani, 'click', funkce);
		addEvent(sledovani, 'mouseover', funkce);
		addEvent(sledovani, 'mouseout', funkce);
		addEvent(document, 'keypress', funkce);
	}
	
	
};

addEvent(window, 'load', ready);
</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div id="sledovani" >
		
	</div>
	<div id="info">
		
	</div>
</body>
</html>