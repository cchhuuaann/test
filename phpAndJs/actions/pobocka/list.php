<?php
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Seznam poboček") ?>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.spin.js"></script>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.list_pobocka.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			
			<form action=""  method="get">
				<table class="list">
					<tr>
						<td>
							<label for="nazev">název pobočky</label>
						</td>
						<td>
							<input type="text" name="nazev" id="nazev" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="adresa">adresa</label>
						</td>
						<td>
							<input type="text" name="adresa" id="adresa" />
						</td>
					</tr>
					<tr>
						<td>	
							<label for="mesto">město</label>
						</td>
						<td>
							<select id="mesto" name="mesto" >
								<?= vytvor_option_db('pobocka','mesto','nazev','','',true)?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">email</label>
						</td>
						<td>
							<input type="text" name="email" id="email" />
						</td>
					</tr>
					<tr>
						<td>	
							<label for="firma_nazev">firma</label>
						</td>
						<td>
							<select id="firma_nazev" name="firma_nazev" >
								<?= vytvor_option_db('firma','nazev','','','',true)?>
							</select>
						</td>
					</tr>
					<tr>
						<td>				
							<input type="submit" />
						</td>
					</tr>
				</table>
			</form>
			
			<div id="tabulka">
			</div>	
		</div>
	</body>
</html>
