<?php
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("") ?>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<div id="logo">
					<img alt="Signal Processing Laboratory" src="../images/ruzne/logo.png">
					<p>
						<span>&bdquo;Není nic praktičtějšího, než dobrá teorie&ldquo;</span>  Kurt Lewin
					</p>
				</div>
				<div id="lang">
					<a href="">
						<img class="cz" alt="Czech" src="../images/ruzne/cz.png">
					</a>
					<a href="">
						<img class="en" alt="English" src="../images/ruzne/en.png">
					</a>
				</div>
			</div>
		
<?php
	vykresli_menu();

	if($model == $vychozi_model) {
		vykresli_slider(); 
	}		
?>
			
			<div class="left">
<?php
	if(in_array($model, array_keys($submenu))) {
		vykresli_submenu($model,$nav);
	}
?>
				
				<div class="info" id="nadchazejici">
				<?php
					
					$query = "SELECT id,nadpis,podnadpis,datum,UNIX_TIMESTAMP(datum) AS datum_timestamp FROM novinky WHERE typ=0 ORDER BY datum ASC LIMIT 0,1";
					$result = dotaz_db($query);
					
					$row = mysql_fetch_assoc($result);
					echo "<h2><a href=\"" . URL . "nadchazejici_akce?nav=detail&id=" . $row['id'] . "\">" . $row['nadpis'] . "</a></h2>";
					echo "<p><span>" . date('d.m.Y',$row['datum_timestamp']) . "</span></p>";
					echo "<p>" . $row['podnadpis'] . "</p>";
						
					echo "<div class=\"vice\"><a href=\"" . URL . "nadchazejici_akce" . "\">více...</a></div>";
					
				?>
				</div>
				
				<div class="info" id="vyhledavani">
					<h2>VYHLEDÁVÁNÍ</h2>
					<form action="" method="get">
						<input id="search" type="text" name="search" value="hledaný výraz..." />
						<input id="submit" type="submit" value="" />
					</form>
				</div>
				
			</div>
			
			<div class="right">
			
<?php
	
	if($error) {
		$cesta = "actions/404/index.php";
	} else {
		$cesta = "actions/{$model}/{$nav}.php";
	} 
	
	require($cesta);
	
?>
				
			</div>

			<div class="clear"></div>
			
		</div>
		<div id="footer">
			<div class="left">
				<ul>
					<li>
						&copy; Ústav telekomunikací VUT Brno, 2011
					</li>
					<li>
						Máte potíže s webem? <a href="">kontaktujte nás</a>
					</li>
					<li>
						Oprávnění uživatelé: <a href="">přihlášení</a>
					</li>
				</ul>
			</div>
			<div class="right">
				
			</div>
		</div>
	</body>
</html>
