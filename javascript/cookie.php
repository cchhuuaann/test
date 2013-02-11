<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");

	
?><!doctype html>
<html>
<head>
<title>Cookies</title>

<script type="text/javascript">

String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, ''); }; //smaze vsechny prazdne znaky na zacatku a nakonci retezce 

var get_cookie = function(nazev) {
	var cookies = document.cookie.split(";");
	for(var cookie in cookies) {
		var parts = cookies[cookie].split("=");
		if(parts[0].trim() === nazev) {
			return unescape(parts[1].trim());
		}
	}
	return false;
}

var ready = function() {
	
	var prvek = document.getElementById('js');
	if(prvek != null) {
		prvek.style.display = 'block';
		prvek.innerHTML = get_cookie('username');
	}
	
};
</script>

</head>
<body onload="ready()">
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div id="js" style="display: none">
		<strong>JavaScript</strong>
	</div>
</body>
</html>