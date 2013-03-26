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
					<h2>NADHÁZEJÍCÍ AKCE</h2>
					<p>
						<span>21.7.2011</span>
					</p>
					<p>
						Telecommunication and Signal<br />Processing conference<br />v Budapešti
					</p>
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
	/*
	if(!$error) {
		$cesta = "../actions/{$model}/index.php";
	} else {
		$cesta = "../actions/404/index.php";
	} 
	
	require($cesta);
	*/
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
