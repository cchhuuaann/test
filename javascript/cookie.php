<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");

	
?><!doctype html>
<html>
<head>
<title>Cookies</title>

<script type="text/javascript">

String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, ''); }; //smaze vsechny prazdne znaky na zacatku a nakonci retezce 

/**
 * @param - nazev cookie
 *
 * @return - hodnota cookie nebo false, pokud cookie neexistuje
 */
var get_cookie = function(c_name) {
	var cookies = document.cookie.split(";");
	for(var cookie in cookies) {
		var parts = cookies[cookie].split("=");
		var key = parts[0].trim();
		var value = unescape(parts[1].trim());
		
		if(key === c_name) {
			return value;
		}
	}
	return false;
};

/**
 * @param - nazev cookie
 * @param - hodnota
 * @param - za kolik dni vyprsi
 */
var set_cookie = function(c_name,value,exdays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
};

var delete_cookie = function(c_name) {
	set_cookie(c_name,'',-1);
};

var ready = function() {

	var COOKIE_NAME = 'user_name';
	var value = get_cookie(COOKIE_NAME);
	
	if(value !== false) {
		alert('Ahoj, tvoje jmeno je: ' + value);
	} else {
		set_cookie(COOKIE_NAME, prompt('Zadejte sve jmeno:'), 1);
		delete_cookie(COOKIE_NAME);
	}
	
	var prvek = document.getElementById('js');
	if(prvek != null) {
		prvek.style.display = 'block';

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