<?php

?><!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="jq.spin.js"></script>
		<script type="text/javascript" src="jq.ajax-table.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
	<!-- 
		Pridat: filtrování podle skupiny, firmy a pobočky
	 -->
		<form action="" method="get" style="display: none">
			<label for="zacatek">Jméno začíná na: </label>
			<input type="text" name="zacatek" id="zacatek" />
				<br />
				
			<label for="vek">věk</label>
			<select id="vek" name="vek" >
				<?= vytvor_option($arr_vek,'')?>
			</select>
				<br />
				
			<label for="vyplata">výplata</label>
			<select id="vyplata" name="vyplata" >
				<?= vytvor_option($arr_vyplata,'')?>
			</select>
				<br />
				
			<label for="zazadal">zažádal</label>
			<select id="zazadal" name="zazadal" >
				<?= vytvor_option($arr_zazadal,'')?>
			</select>
				<br />
			<label for="skupina">skupina</label>
			<select id="skupina" name="skupina" >
				<?= vytvor_option_db('skupina','nazev','','')?>
			</select>
				<br />	
			<label for="firma">firma</label>
			<select id="firma" name="firma" >
				<?= vytvor_option_db('firma','nazev','','')?>
			</select>
				<br />	
			<label for="pobocka">pobočka</label>
			<select id="pobocka" name="pobocka" >
				<?= vytvor_option_db('pobocka','nazev','','')?>
			</select>
				<br />				
			<input type="submit" />
		</form>
		
		<div id="tabulka" style="width: 800px; height: 500px">
		</div>
	
	</body>
</html>
