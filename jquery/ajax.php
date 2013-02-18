<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
?><!doctype html>
<html>
<head>
<title>jQuery - ajax</title>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		console.log('OK');

		$('form').submit(function(event){
			event.preventDefault();

			var formular = $(this);

			$.ajax({
				type: 'GET',
				url: 'people.php',
				data: formular.serialize(),
				dataType: 'json',
				success: function(resp){
					console.log(resp);
				}
			});

		});
		
		


	});

</script>

</head>
<body>
	<noscript>
		Zapnete si v prohlizeci javascript
	</noscript>
	<div id="target">
	<form action="">
	name
	<input type="text" name="name" />
	surname
	<input type="text" name="surname"/>
	age
	<input type="text" name="age"/>
	<input type="submit" name="submit" />
	</form>
	</div>
</body>
</html>