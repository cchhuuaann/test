<?php

	//header("Content-Type: text/Plain-Text; Charset=utf-8");
	header("Content-Type: text/html; Charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}
	
	$config = array(
		"user"=>"honza",
		"db_name"=>"xml",
		"pass"=>"test",
		"server"=>"localhost",
		"encoding"=>"utf-8"
	);
	
	$hotovo = NULL;
	$delete = false;
	$database = Database::getInstance($config);
	$form = new Form;
	
	$prvky = array(
			$form->registerItem('jmeno', new Form_Item_Text(true, array('label'=>'Jméno: '))),
			$form->registerItem('plat', new Form_Item_Text(true, array('label'=>'Plat: '))),
			$form->registerItem('telefon', new Form_Item_Text(true, array('label'=>'Telefon: '))),
			$form->registerItem('email', new Form_Item_Text(true, array('label'=>'Email: '))),
			$form->registerItem('www', new Form_Item_Text(true, array('label'=>'Www: '))),
			$form->registerItem('platova_trida', new Form_Item_Select(true, array('label'=>'Platova trida: '))),
			$form->registerItem('firma', new Form_Item_Select(true, array('label'=>'Firma: ')))
	);
	
	$prvky[0]->addValidators(array(new Form_Validator_Preg_Name()));
	$prvky[1]->addValidators(array(new Form_Validator_Preg_IntNumber()));
	$prvky[2]->addValidators(array(new Form_Validator_Preg_IntNumber()));
	$prvky[3]->addValidators(array(new Form_Validator_Preg_Email()));
	$prvky[4]->addValidators(array(new Form_Validator_Preg_Http()));
	
	/**
	 * Funkce prevede pole poli o dvou prvcich na pole
	 * o indexech nultych hodnot a hodnotach prvnich hodnot 
	 * @param Array $arr
	 * @return Array
	 */
	function transformace($arr) {
		$return = array();
		
		foreach($arr as $val) {
			$return[$val[0]] = $val[1];
		}
		
		return $return;
	}
	
	$rows = transformace($database->getRows("SELECT * FROM platova_trida"));
	$prvky[5]->setAtributes(array('multioptions'=>$rows));
	
	//TODO: dodelat selecty a navazat na to nove vytvorene tabulky
	
	if(!empty($_POST)) {
		if($form->isValid($_POST)) {
			$hotovo = true;
		} else {
			$form->populate($_POST);
			$hotovo = false;
		}
		if(isset($_GET['id'])) {
			$arr = $database->getRows("SELECT jmeno, plat, telefon, email, www FROM person WHERE id = '{$_GET['id']}'");
			$arr = $arr[0];
			$form->populate(array('jmeno'=>$arr[0],'plat'=>$arr[1],'telefon'=>$arr[2],'email'=>$arr[3],'www'=>$arr[4]));
		}
	} else if(isset($_GET['id']) && isset($_GET['delete'])) {
		$query = "DELETE FROM person WHERE id = '{$_GET['id']}'";
		$delete = $database->query($query);
	} else if(isset($_GET['id'])) {
		$arr = $database->getRows("SELECT jmeno, plat, telefon, email, www FROM person WHERE id = '{$_GET['id']}'");
		$arr = $arr[0];
		$form->populate(array('jmeno'=>$arr[0],'plat'=>$arr[1],'telefon'=>$arr[2],'email'=>$arr[3],'www'=>$arr[4]));
	}
 
	if($hotovo) {
		if(isset($_GET['id'])) {
			$dotaz = "UPDATE person SET jmeno='?', plat='?', telefon='?', email='?', www='?' WHERE id = '{$_GET['id']}' ";
		} else {
			$dotaz = "INSERT INTO person (jmeno, plat, telefon, email, www) VALUES ('?','?','?','?','?')";
		}
		call_user_func_array(array($database, "query"), array_merge(array($dotaz),$_POST));
	}
	
	$result = $database->query("SELECT * FROM person");
	
	

?><!doctype html>
<html>
	<head>
		<title></title>
		<style type="text/css">
			td {
				padding: 5px 10px;
			}
		</style>
	</head>
	<body>
	
	<?php
		if($delete == true) {
			echo "<h2>Zaznam s indexem {$_GET['id']} byl smazan</h2>";
		}
	?>
	
	<table>
		<tr>
			<th>id</th>
			<th>jmeno</th>
			<th>plat</th>
			<th>telefon</th>
			<th>email</th>
			<th>wwww</th>
			<th>edit</th>
			<th>delete</th>
		</tr>
	<?php
	
		while($row = mysql_fetch_assoc($result)) {

			echo "<tr>";
			echo "<td>{$row['id']}</td><td>{$row['jmeno']}</td><td>{$row['plat']}</td><td>{$row['telefon']}</td><td>{$row['email']}</td><td>{$row['www']}</td>";
			echo "<td><a href=\"http://test/xml/?id={$row['id']}\">upravit</a></td>";
			echo "<td><a href=\"http://test/xml/?id={$row['id']}&delete=1\">smazat</a></td>";
			echo "</tr>";

		}	
	
	?>
	
	</table>
	
	<?php 
		if(isset($hotovo) && $hotovo) {
			echo "<h2>Formular je odeslan a validni</h2>";
		}
	?>
	
	<?= isset($_GET['id'])?'<a href="http://test/xml/">Prepnout na vložení nového prvku</a>':''?>
	
		<form method="post">
			<fieldset>
				<legend><strong><?= isset($_GET['id'])?"Editace {$_GET['id']}. prvku":'Vytvoreni noveho prvku'?></strong></legend>
	<?php
	
		foreach($prvky as $value) {
	
			echo "<div>";
				
			if($value->hasError()) {
				foreach($value->getErrors() as $val) {
					echo "<p>" . $val . "</p>";
				}
			}
			$value->draw();
				
			echo "</div>";
		}
	 
	?>
				<input type="submit" value="<?= isset($_GET['id'])?"Opravit":"Pridat" ?>" />
			</fieldset>
		</form>
		
		<p>
			<a href="http://test/xml/xml.php">XML dokument</a>
		</p>
		
	</body>
</html>
	
	
	
	
	<?php
		/* try {
			$databaze = Database::getInstance($config_array);
			$databaze->store($arr2);
			var_dump($databaze->insertStored('zamestnanec'));
			var_dump($databaze->updateStored("zamestnanec","WHERE id=2"));
			
			
			//call_user_func_array(array($databaze,"query"), $param_arr);
		} catch(Exception $e) {
			echo $e->getMessage();
		} */
	?>
	
	
	
	
	
	
	
	
	