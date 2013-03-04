<?php
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Seznam zaměstnanců") ?>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.spin.js"></script>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.ajax-table.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
		<!-- 
			Pridat: filtrování podle skupiny, firmy a pobočky
		 -->
			<form action="" method="get" style="display: none">
				<table class="list">
					<tr>
						<td>
							<label for="zacatek">Jméno začíná na: </label>
						</td>
						<td>
							<input type="text" name="zacatek" id="zacatek" />
						</td>
					</tr>
					<tr>
						<td>	
							<label for="vek">věk</label>
						</td>
						<td>
							<select id="vek" name="vek" >
								<?= vytvor_option($arr_vek,'')?>
							</select>
						</td>
					</tr>
					<tr>
						<td>	
							<label for="vyplata">výplata</label>
						</td>
						<td>
							<select id="vyplata" name="vyplata" >
								<?= vytvor_option($arr_vyplata,'')?>
							</select>
						</td>
					</tr>
					<tr>
						<td>	
							<label for="zazadal">zažádal</label>
						</td>
						<td>
							<select id="zazadal" name="zazadal" >
								<?= vytvor_option($arr_zazadal,'')?>
							</select>
						</td>
					</tr>
					<tr>
						<td>	
							<label for="skupina">skupina</label>
						</td>
						<td>
							<select id="skupina" name="skupina" >
								<?= vytvor_option_db('skupina','nazev','','',true)?>
							</select>
						</td>
					</tr>
					<tr>
						<td>		
							<label for="firma">firma</label>
						</td>
						<td>
							<select id="firma" name="firma" >
								<?= vytvor_option_db('firma','nazev','','',true)?>
							</select>
						</td>
					</tr>
					<tr>
						<td>		
							<label for="pobocka">pobočka</label>
						</td>
						<td>
							<select id="pobocka" name="pobocka" >
								<?= vytvor_option_db('pobocka','nazev','','',true)?>
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
			
			<div id="tabulka" style="width: 800px; height: 500px">
			</div>
		</div>
	</body>
</html>
