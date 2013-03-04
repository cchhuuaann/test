<?php

	$errors = array();
	$err = array();
	$isError = false;
	
	$id = "";

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		$result = dotaz_db("SELECT * FROM firma WHERE id=$id");
		$row = mysql_fetch_assoc($result);
	} else {
		$row = false;
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

	
//validace
		if ($nazev == "") {
			$err[] = 'Název musí být zadán';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['nazev'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($adresa == "") {
			$err[] = 'Adresa musí být zadána';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['adresa'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($mesto == "") {
			$err[] = 'Město musí být zadáno';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['mesto'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($psc == "") {
			$err[] = 'PSČ musí být zadáno';
		}
		if (strlen($psc) != 5) {
			$err[] = 'PSČ musí být pětimístné';
		}
		if (!is_numeric($psc)) {
			$err[] = 'PSČ musí být číslo';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['psc'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($jmeno_jednatele == "") {
			$err[] = 'Jméno jednatele musí být zadáno';
		}
		if (count(explode(' ',$jmeno_jednatele)) != 2) {
			$err[] = 'Jméno musí mít dvě části';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['jmeno_jednatele'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($ico == "") {
			$err[] = 'IČO musí být zadáno';
		}
		if (strlen($ico) != 8) {
			$err[] = 'IČO musí být osmimístné';
		}
		if (!is_numeric($ico)) {
			$err[] = 'IČO musí být číslo';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['ico'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($dic == "") {
			$err[] = 'DIČ musí být zadáno';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['dic'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($telefon == "") {
			$err[] = 'Telefoní číslo musí být zadáno';
		}
		if (strlen($telefon) != 9) {
			$err[] = 'Telefoní číslo musí být devítimístné';
		}
		if (!is_numeric($telefon)) {
			$err[] = 'Telefoní číslo musí být číslo';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['jmeno_jednatele'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($email == "") {
			$err[] = 'Email musí být zadán';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['email'] = implode('<br />', $err);
			unset($err);
		}
		
		if ($mesicni_naklady == "") {
			$err[] = 'Mesíční náklady musí být zadány';
		}
		if (!is_numeric($mesicni_naklady)) {
			$err[] = 'Měsíční náklady musí být číslo';
		}
		if (!empty($err)) {
			$isError = true;
			$errors['mesicni_naklady'] = implode('<br />', $err);
			unset($err);
		}
//konec validace		
		
//ulozeni vysledku
		if (!$isError) {
			$values = array(
					'nazev'=>$nazev,
					'adresa'=>$adresa,
					'mesto'=>$mesto,
					'psc'=>$psc,
					'jmeno_jednatele'=>$jmeno_jednatele,
					'ico'=>$ico,
					'dic'=>$dic,
					'telefon'=>$telefon,
					'email'=>$email,
					'mesicni_naklady'=>$mesicni_naklady,
					'dph'=>$dph
				);
			
			if ($row === false) {
				dotaz_db(make_insert('firma', $values));
				$message = "Nový záznam byl vytvořen.";
			} else {
				dotaz_db(make_update('firma', $values, "WHERE id={$id}"));
				$message = "Upraven záznam id = {$id}";
			}
			
			$_SESSION['message'] = $message;
			$location = "Location: " . get_link("",array('id'=>''),false);
			
			header($location, true, 303);
			exit;
			
		}
		
	}	


?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Vložení firmy") ?>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			<h2>
				<?= $row===false?"Vytvoření nové firmy":"Úprava firmy" ?>
			</h2>
			<form action="" method="post">
				<table class="edit">
					<tr>
						<td>
							<label for="nazev">Název</label>
						</td>
						<td>
							<?=get_input('nazev', 'text', is_array($row)?$row['nazev']:'') ?>
						</td>
						<td>
							<?= isset($errors['nazev'])?"<p>{$errors['nazev']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="adresa">Adresa</label>
						</td>
						<td>
							<?=get_input('adresa', 'text', is_array($row)?$row['adresa']:'') ?>
						</td>
						<td>
							<?= isset($errors['adresa'])?"<p>{$errors['adresa']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="mesto">Město</label>
						</td>
						<td>
							<?=get_input('mesto', 'text', is_array($row)?$row['mesto']:'') ?>
						</td>
						<td>
							<?= isset($errors['mesto'])?"<p>{$errors['mesto']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="psc">PSČ</label>
						</td>
						<td>
							<?=get_input('psc', 'text', is_array($row)?$row['psc']:'') ?>
						</td>
						<td>
							<?= isset($errors['psc'])?"<p>{$errors['psc']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="jmeno_jednatele">Jméno jednatele</label>
						</td>
						<td>
							<?=get_input('jmeno_jednatele', 'text', is_array($row)?$row['jmeno_jednatele']:'') ?>
						</td>
						<td>
							<?= isset($errors['jmeno_jednatele'])?"<p>{$errors['jmeno_jednatele']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="ico">IČO</label>
						</td>
						<td>
							<?=get_input('ico', 'text', is_array($row)?$row['ico']:'') ?>
						</td>
						<td>
							<?= isset($errors['"ico"'])?"<p>{$errors['"ico"']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="dic">DIČ</label>
						</td>
						<td>
							<?=get_input('dic', 'text', is_array($row)?$row['dic']:'') ?>
						</td>
						<td>
							<?= isset($errors['"dic"'])?"<p>{$errors['"dic"']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="telefon">telefon</label>
						</td>
						<td>
							<?=get_input('telefon', 'text', is_array($row)?$row['telefon']:'') ?>
						</td>
						<td>
							<?= isset($errors['telefon'])?"<p>{$errors['telefon']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">email</label>
						</td>
						<td>
							<?=get_input('email', 'text', is_array($row)?$row['email']:'') ?>
						</td>
						<td>
							<?= isset($errors['email'])?"<p>{$errors['email']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="mesicni_naklady">měsíční náklady</label>
						</td>
						<td>
							<?=get_input('mesicni_naklady', 'text', is_array($row)?$row['mesicni_naklady']:'') ?>
						</td>
						<td>
							<?= isset($errors['mesicni_naklady'])?"<p>{$errors['mesicni_naklady']}</p>":"" ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="dph">Plátce DPH</label>
						</td>
						<td>
							<?=get_input('dph', 'checkbox', is_array($row)?$row['dph']:'') ?>
						</td>
						<td>
							<?=get_input('edit_form', 'hidden', '1') ?>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="uložit" />
						</td>
					</tr>
				</table>
			</form>
			<br />
			<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
		</div>
	</body>
</html>
