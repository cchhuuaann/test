<?php
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Seznam firem") ?>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.spin.js"></script>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.list_firma.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			
			<form action=""  method="get">
				<label for="nazev">název firmy</label>
				<input type="text" name="nazev" id="nazev" />
					<br />
				<label for="adresa">adresa</label>
				<input type="text" name="adresa" id="adresa" />
					<br />	
				<label for="mesto">město</label>
				<select id="mesto" name="mesto" >
					<?= vytvor_option_db('firma','mesto','','',true)?>
				</select>
					<br />
				<label for="email">email</label>
				<input type="text" name="email" id="email" />
					<br />					
				<input type="submit" />
			</form>
			
			<div id="tabulka">
			</div>	
		</div>
	</body>
</html>