<?php

	$errors = array();
	$err = array();
	$isError = false;

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		
		$result = mysql_query("SELECT * FROM hodnoty WHERE id=$id",$link);
		$row = mysql_fetch_assoc($result);
		
	} else {
		$row = false;
	}
	
	if (isset($_POST['edit_form'])) {
		
		$jmeno = get_post('name');
		$vek = get_post('age');
		$vyplata = get_post('payment');
		$zadost = get_post('request');
		
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
//konec validace		
		
//ulozeni vysledku
		if (!$isError) {
			$values = array(
					'name'=>$jmeno,
					'age'=>$vek,
					'payment'=>$vyplata,
					'request'=>$zadost
				);
			
			if ($row === false) {
				mysql_query(make_insert('hodnoty', $values),$link);
				$message = "Nový záznam byl vytvořen.";
			} else {
				mysql_query(make_update('hodnoty', $values, "WHERE id={$id}"),$link);
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
		<title><?= $row===false?"Vytvoření nového prvku":"Úprava prvku" ?></title>
	</head>
	<body>
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
			<input type="submit" value="uložit" />
		</form>
		<br />
		<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
	</body>
</html>