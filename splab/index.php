<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");	
	
	require('common/config.php');
	require('common/funkce.php');
	
	if (isset($_GET['model']) && in_array($_GET['model'], array_keys($povolene_akce) ) ) {
		$model = $_GET['model'];
	} else {
		$model = $vychozi_model;
	}
	
	$nav = $povolene_akce[$model][0];
	
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("") ?>
	</head>
	<body>
		<div id="body">
			<div id="header">
				
			</div>
		
			<?= vykresli_menu() ?>
			
			<div id="slide"></div>
			
			<div class="left">
				<div class="info" id="nadchazejici">nadchazejici</div>
				<div class="info" id="vyhledavani">vyhledavani</div>
			</div>
			<div id="obsah"><h2>Výzkum v oblastech</h2></div>
			
			<div class="info" id="aktualni">aktualni</div>
			
			<div class="clear"></div>
		</div>
		<div id="footer">
			<div>
				
			</div>
			<div>
				
			</div>
		</div>
	</body>
</html>
			
	
	<?php //require("actions/{$model}/{$nav}.php"); ?>