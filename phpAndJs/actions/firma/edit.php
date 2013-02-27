<?php
/*
 * Dodelat transformaci na edit firmy
 */

	$errors = array();
	$err = array();
	$isError = false;
	
	$id = "";

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
	}
	
	if (isset($_POST['edit_form'])) {
		
		$nazev = get_post('nazev');
		$adresa = get_post('adresa');
		$mesto = get_post('mesto');
		$psc = get_post('psc');
		$jmeno_jednatele = get_post('jmeno_jednatele');
		$ico = get_post('ico');
		$dic = get_post('dic');
		$telefon = get_post('telefon');
		$email = get_post('email');
		$mesicni_naklady = get_post('mesicni_naklady');
		$dph = get_post('dph');
	} // odmazat
/*		
//validace
		if ($jmeno == "") {
			$err[] = 'Jméno musí být zadáno';
		}
		
		if(count(explode(' ', $jmeno)) != 2) {
			$err[] = 'Jméno musí mít dvě části';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['name'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($vek == "") {
			$err[] = 'Věk musí být zadán';
		}
		if (!is_numeric($vek)) {
			$err[] = 'Věk musí být číslo';
		}
		if ($vek <  1 || $vek > 100) {
			$err[] = 'Věk musí být od 1 do 100';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['age'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($vyplata == "") {
			$err[] = 'Výplata musí být zadána';
		}
		if (!is_numeric($vyplata)) {
			$err[] = 'Výplata musí být číslo';
		}
		if ($vyplata <  0 || $vyplata > 1000000) {
			$err[] = 'Výplata musí být od 0 do 1000000';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['payment'] = implode('<br />', $err);
			unset($err);
		}
		
		$query = "SELECT 1 FROM skupina WHERE id = {mysql_real_escape_string($skupina)}";
		
		if(dotaz_db($query) == 0) {
			$err[] = "Neexistující skupina";
		}
		if (!empty($err)) {
			$isError = true;
			$errors['payment'] = implode('<br />', $err);
			unset($err);
		}
		
		$query = "SELECT 1 FROM firma WHERE id = {mysql_real_escape_string($firma)}";
		
		if(dotaz_db($query) == 0) {
			$err[] = "Neexistující firma";
		}
		if (!empty($err)) {
			$isError = true;
			$errors['payment'] = implode('<br />', $err);
			unset($err);
		}
		
		
//konec validace		
		
//ulozeni vysledku
		if (!$isError) {
			$values = array(
					'name'=>$jmeno,
					'age'=>$vek,
					'payment'=>$vyplata,
					'request'=>$zadost,
					'skupina_id'=>$skupina,
					'firma_id'=>$firma
				);
			*/
			/*
			 * predelat zmenu pobocky pomoci WHERE ... IN(.. , ...) aby se nemazalo vse,ale jen to, co tam uz nepatri
			 * 
			 *//*
			if ($row === false) {
				dotaz_db(make_insert('zamestnanec', $values));
				$id = mysql_insert_id($link);
				dotaz_db(make_insert_sp('pobocka_zamestnanec',$_POST['pobocka'], $id));
				
				$message = "Nový záznam byl vytvořen.";
			} else {
				dotaz_db(make_update('zamestnanec', $values, "WHERE id={$id}"));
				dotaz_db("DELETE FROM pobocka_zamestnanec WHERE zamestnanec_id1 = $id");
				
				dotaz_db(make_insert_sp('pobocka_zamestnanec',$_POST['pobocka'], $id));
				
				$message = "Upraven záznam id = {$id}";
			}
			
			$_SESSION['message'] = $message;
			$location = "Location: " . get_link("",array('id'=>''),false);
			
			header($location, true, 303);
			exit;
			
		}
		
	}	

*/	
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Vložení firmy") ?>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			<p>
				<?= $row===false?"Vytvoření nové firmy":"Úprava firmy" ?>
			</p>
			<form action="" method="post">
				<label for="nazev">Název</label>
				<?=get_input('nazev', 'text', is_array($row)?$row['nazev']:'') ?>
				<?= isset($errors['nazev'])?"<p>{$errors['nazev']}</p>":"" ?>
					<br />
				<label for="adresa">Adresa</label>
				<?=get_input('adresa', 'text', is_array($row)?$row['adresa']:'') ?>
				<?= isset($errors['adresa'])?"<p>{$errors['adresa']}</p>":"" ?>
					<br />
				<label for="mesto">Město</label>
				<?=get_input('mesto', 'text', is_array($row)?$row['mesto']:'') ?>
				<?= isset($errors['mesto'])?"<p>{$errors['mesto']}</p>":"" ?>
					<br />
				<label for="psc">PSČ</label>
				<?=get_input('psc', 'text', is_array($row)?$row['psc']:'') ?>
				<?= isset($errors['psc'])?"<p>{$errors['psc']}</p>":"" ?>
					<br />
				<label for="jmeno_jednatele">jméno jednatele</label>
				<?=get_input('jmeno_jednatele', 'text', is_array($row)?$row['jmeno_jednatele']:'') ?>
				<?= isset($errors['jmeno_jednatele'])?"<p>{$errors['jmeno_jednatele']}</p>":"" ?>
					<br />
				<label for="ico">IČO</label>
				<?=get_input('"ico"', 'text', is_array($row)?$row['"ico"']:'') ?>
				<?= isset($errors['"ico"'])?"<p>{$errors['"ico"']}</p>":"" ?>
					<br />
				<label for="dic">DIČ</label>
				<?=get_input('"dic"', 'text', is_array($row)?$row['"dic"']:'') ?>
				<?= isset($errors['"dic"'])?"<p>{$errors['"dic"']}</p>":"" ?>
					<br />
				<label for="telefon">telefon</label>
				<?=get_input('telefon', 'text', is_array($row)?$row['telefon']:'') ?>
				<?= isset($errors['telefon'])?"<p>{$errors['telefon']}</p>":"" ?>
					<br />
				<label for="email">email</label>
				<?=get_input('email', 'text', is_array($row)?$row['email']:'') ?>
				<?= isset($errors['email'])?"<p>{$errors['email']}</p>":"" ?>
					<br />
				<label for="mesicni_naklady">měsíční náklady</label>
				<?=get_input('mesicni_naklady', 'text', is_array($row)?$row['mesicni_naklady']:'') ?>
				<?= isset($errors['mesicni_naklady'])?"<p>{$errors['mesicni_naklady']}</p>":"" ?>
					<br />
				<label for="dph">Plátce DPH</label>
				<?=get_input('dph', 'checkbox', is_array($row)?$row['dph']:'') ?>
				<?=get_input('edit_form', 'hidden', '1') ?>
					<br />
				<input type="submit" value="uložit" />
			</form>
			<br />
			<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
		</div>
	</body>
</html>