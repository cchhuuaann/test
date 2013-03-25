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
		
			<?= vykresli_menu() ?>
			
			<div class="slide">
				<img class="front_image first active" alt="" src="../images/intro/intro_1.jpg" />
				<img class="front_image" alt="" src="../images/intro/intro_2.jpg" />
				<img class="front_image" alt="" src="../images/intro/intro_3.jpg" />
				<img class="front_image" alt="" src="../images/intro/intro_4.jpg" />
				<img class="front_image" alt="" src="../images/intro/intro_5.jpg" />
				<img class="front_image" alt="" src="../images/intro/intro_6.jpg" />
				<div id="text">
					<h1>Signal processing laboratory</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget lacus vulputate orci cursus semper sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget lacus vulputate orci cursus mi.</p>
				</div>
				<div class="switches">
					<a class="switch active" href="" rel="1"></a>
					<a class="switch" href="" rel="2"></a>
					<a class="switch" href="" rel="3"></a>
					<a class="switch" href="" rel="4"></a>
					<a class="switch" href="" rel="5"></a>
					<a class="switch" href="" rel="6"></a>
				</div>
			</div>
			
			<div class="left">
			
				<?php ?>
			
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
			
				<div id="obsah">
					<h2>Výzkum v oblastech</h2>
					
					<div id="data_mining">
						<div class="icons"></div>
						data-mining
					</div>
					
					<div id="zpracovani_ak">
						<div class="icons"></div>
						zpracování<br />akustických signálů
					</div>
					
					<div id="interakce">
						<div class="icons"></div>
						interakce<br />člověk – stroj
					</div>
					
					<div id="zpracovani_med">
						<div class="icons"></div>
						zpracování<br />medicínských signálů
					</div>
					
					<div id="neortogonalni">
						<div class="icons"></div>
						neortogonální<br />reprezentace signálů
					</div>
					
				</div>
				
				<div class="info clear" id="aktualni">
					<div class="left">
						<h2>AKTUÁLNÍ INFORMACE</h2>
						<p><span>Uvedení prototypu detektoru emocí</span> Maecenas ullamcorper tellus ut enim dignissim ortis.</p>
						<p>12.7.2011 <a href="">zobrazit celou zprávu</a></p>
					</div>
					
					<div class="right">
						<h2>AKTUÁLNÍ INFORMACE</h2>
						<p><span>Uvedení prototypu detektoru emocí</span> Maecenas ullamcorper tellus ut enim dignissim ortis.</p>
						<p>12.7.2011 <a href="">zobrazit celou zprávu</a></p>
					</div>
					
				</div>
				
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
			
	
	<?php //require("actions/{$model}/{$nav}.php"); ?>