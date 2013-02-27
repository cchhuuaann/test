<?php

	$errors = array();
	$err = array();
	$isError = false;
	
	$id = "";

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		
		$result = dotaz_db("SELECT * FROM zamestnanec WHERE id=$id");
		$row = mysql_fetch_assoc($result);
		$skupina = $row['skupina_id'];
		$firma = $row['firma_id'];
	} else {
		$row = false;
		$skupina = "";
		$result = dotaz_db("SELECT id FROM firma LIMIT 1");
		if($radek = mysql_fetch_assoc($result)) {
			$firma = $radek['id'];
		}
	}
	
	if (isset($_POST['edit_form'])) {
		
		$jmeno = get_post('name');
		$vek = get_post('age');
		$vyplata = get_post('payment');
		$zadost = get_post('request');
		$skupina = get_post('skupina');
		$firma = get_post('firma');
		
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
			
			/*
			 * predelat zmenu pobocky pomoci WHERE ... IN(.. , ...) aby se nemazalo vse,ale jen to, co tam uz nepatri
			 * 
			 */
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

	
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Vložení zaměstnance") ?>
		<script type="text/javascript" src="<?= URL ?>scripts/jq.edit.js?v=<?= JS_VERSION_STRING ?>"></script>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			<p>
				<?= $row===false?"Vytvoření nového prvku":"Úprava prvku" ?>
			</p>
			<form action="" method="post">
				<label for="name">Jméno a příjmení </label>
				<?=get_input('name', 'text', is_array($row)?$row['name']:'') ?>
				<?= isset($errors['name'])?"<p>{$errors['name']}</p>":"" ?>
					<br />
				<label for="age">Věk </label>
				<?=get_input('age', 'text', is_array($row)?$row['age']:'') ?>
				<?= isset($errors['age'])?"<p>{$errors['age']}</p>":"" ?>
					<br />
				<label for="payment">Výplata </label>
				<?=get_input('payment', 'text', is_array($row)?$row['payment']:'') ?>
				<?= isset($errors['payment'])?"<p>{$errors['payment']}</p>":"" ?>
					<br />
				<label for="request">Zažádal </label>
				<?=get_input('request', 'checkbox', is_array($row)?$row['request']:'') ?>
				<?=get_input('edit_form', 'hidden', '1') ?>
					<br />
				<label for="skupina">skupina</label>
				<select id="skupina" name="skupina" >
					<?= vytvor_option_db('skupina','nazev','',$skupina)?>
				</select>
					<br />
				<label for="firma">firma</label>
				<select id="firma" name="firma" >
					<?= vytvor_option_db('firma','nazev','',$firma)?>
				</select>
					<br />
				<label for="pobocka">pobočky</label>
				<select id="pobocka" name="pobocka[]" size="6" multiple >
					<?= vytvor_option_db_multi('pobocka','nazev','zamestnanec',$id, "WHERE t.firma_id = '{$firma}'")?>
				</select>
					<br />
				<input type="submit" value="uložit" />
			</form>
			<br />
			<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
		</div>
	</body>
</html>