<?php

?><!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="jq.ajax-table.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
		<form action="" method="get">
			<label for="zacatek">Jméno začíná na: </label>
			<input type="text" name="zacatek" id="zacatek" />
				<br />
				
			<label for="vek">věk</label>
			<select id="vek" name="vek" >
				<?= vytvor_option("",$age)?>
			</select>
				<br />
				
			<label for="vyplata">výplata</label>
			<select id="vyplata" name="vyplata" >
				<?= vytvor_option("",$money)?>
			</select>
				<br />
				
			<label for="zazadal">zažádal</label>
			<select id="zazadal" name="zazadal" >
				<?= vytvor_option("",$zadost)?>
			</select>
				<br />			
			<input type="submit" />
		</form>
		<br />Vyhovuje <?=$count['cnt']?> položek z <?=$count['cnt']?>
		
		<p>
		<?php
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			}
		?>
		</p>
	
		<div id="tabulka">
		</div>
	
	</body>
</html>
