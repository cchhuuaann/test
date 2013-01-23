<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");
	$isError = false;
	
	$errors = array();
	
	$arr_pohlavi = array(
			"0" => "prosím vyberte",
			"M" => "muž",
			"F" => "žena",
			"N" => "nerozhodnut"
		);
	
	$arr_mobily = array(
			"1" => "iPhone",
			"2" => "Mobil Aligator",
			"3" => "MyPhone",
			"4" => "Galaxy S4",
			"5" => "Nokia"
		);
	
	$jmeno = "";
	$vek = "";
	$pohlavi = "";
	$mobil = "";
	$souhlas = false;
	
	$array = array(
			"name" => $jmeno,
			"age" => $vek,
			"gender" => $pohlavi,
			"souhlas" => $souhlas,
			"mobil" => $mobil
	);
	
	function printInfo($array) {
	
		$ret = "<p>Ahoj, jsem {$array['name']} a je mi {$array['age']} let. pokud jste si nevšimli, jsem ";
	
		if($array["gender"] == "M") {
			$ret .= "muž. ";
		} else if($array["gender"] == "F") {
			$ret .= "žena. ";
		} else {
			$ret .= "něco jiného. ";
		}
	
		$ret .= "Souhlasíš se vším? " . ($array["souhlas"] ? "Ano. " : "Ne. ");
		$ret .= "<br />A mobil mám  číslo {$array['mobil']} .";
		$ret .= "</p>";
	
		return $ret;
	}
	
	if (!empty($_POST)) {
		
//rozhodovani o promnennych se kterymi se  bude potom pracovat
		$jmeno = trim($_POST['fname']);
		$vek = trim($_POST['age']);
		$pohlavi = $_POST['gender'];
		
		if (isset($_POST['mobil'])) {
			$mobil = $_POST['mobil'];
		}
		
		if (isset($_POST['souhlas'])) {
			$souhlas = true;
		}
		
//cast: validace
		$err = array();
		
//validace: jmeno
		if ($jmeno == "") {
			$err[] = 'Jméno musí být zadáno';
		}
		
		if(count(explode(' ', $jmeno)) != 2) {
			$err[] = 'Jméno musí mít dvě části';
		}
//konec validace: jmeno
		if (!empty($err)) {
			$isError = true;
			$errors['fname'] = implode('<br />', $err);
			unset($err);
		}
		
//validace: vek
		if ($vek == "") {
			$err[] = 'Věk musí být zadán';
		}
		
		if (!is_numeric($vek)) {
			$err[] = 'Věk musí být číslo';
		}
		
		if ($vek <  1 || $vek > 100) {
			$err[] = 'Věk musí být od 1 do 100';
		}
//konec validace: vek
		if (!empty($err)) {
			$isError = true;
			$errors['age'] = implode('<br />', $err);
			unset($err);
		}
		
//validace: pohlavi
		if (!isset($arr_pohlavi[$pohlavi])) {
			$err[] = 'Pohlaví není v platném seznamu hodnot';
		} else if ($pohlavi == "0") {
			$err[] = 'Musíte si vybrat jednu z hodnot';
		}
//konec validace: pohlavi
		if (!empty($err)) {
			$isError = true;
			$errors['gender'] = implode('<br />', $err);
			unset($err);
		}
		
//validace: souhlas
		if ($souhlas === false) {
			$err[] = 'Musíš souhlasit';
		}
//konec validace: souhlas
		if (!empty($err)) {
			$isError = true;
			$errors['souhlas'] = implode('<br />', $err);
			unset($err);
		}		
		
//validace: mobily
		if (!empty($mobil)) {
			
			if (!isset($arr_mobily[$mobil])) {
				$err[] = 'Musíte vybrat mobil z nabídky';
			} else {
				if ($mobil != "1") {
					$err[] = 'Steve jobs by neměl radost. Rozmysli si to...';
				}
			}
		} else {
			$err[] = 'Musíte vybrat aspoň jednu hodnotu';
		}
//konec validace: mobily
		if (!empty($err)) {
			$isError = true;
			$errors['mobil'] = implode('<br />', $err);
			unset($err);
		}
		
		if(!$isError) {
			$_SESSION['message'] = printInfo($array);
			header("Location: uspech.php", true, 303);
			die;
		}
		
	}
?>
<html>
	<body>
		<form action="forms.php" method="post">
			<label for="jmeno">Jméno:</label>
			<!-- <input type="text" id="jmeno" name="fname" value=""> -->
			<textarea name="fname" id="jmeno" rows="2" cols="80"><?= htmlspecialchars($jmeno, ENT_QUOTES) ?></textarea>
				<?php
					if(isset($errors['fname'])) {
						echo '<br />'.$errors['fname'];
					}
				?>
			<br />
			<label for="vek">Věk:</label>
			<input type="text" id="vek" name="age" value="<?= htmlspecialchars($vek, ENT_QUOTES) ?>">
				<?php
					if(isset($errors['age'])) {
						echo '<br />'.$errors['age'];
					}
				?>
			<br />
			<label for="pohlavi">Pohlaví:</label>
			<select name="gender" id="pohlavi">
				<?php
					foreach ($arr_pohlavi as $key => $value) {
						$selected = "";
						if ($key == $pohlavi) {
							$selected = "selected=\"selected\"";
						}
						echo "<option value=\"{$key}\" {$selected}>{$value}</option>\n";
					}
				?> 
			</select>
				<?php
				if(isset($errors['gender'])) {
					echo '<br />'.$errors['gender'];
				}
				?>
			<br />
			<label for="souhlas">Souhlasím se vším </label>
			<input type="checkbox" name="souhlas" id="souhlas" value="1"  <?= $souhlas ? "checked=\"checked\"" : "" ?> />
				<?php 
					
					if(isset($errors['souhlas'])) {
						echo '<br />'.$errors['souhlas'];
					}
					
					echo '<br />';
					
					foreach ($arr_mobily as $key => $value) {
						$checked = "";
						if ( ($mobil == "" && $key == 1) || $mobil == $key ) {
							$checked = "checked=\"checked\"";
						}
						echo "<input type=\"radio\" id=\"mobil{$key}\" name=\"mobil\" value=\"{$key}\" $checked /><label for=\"mobil{$key}\">{$value}</label><br />";
					}
					
					if(isset($errors['mobil'])) {
						echo '<br />'.$errors['mobil'];
					}
					
				?>
			<br />
			<input type="submit">
		</form>
	</body>
</html>
