<?php

	

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		
		$result = dotaz_db("SELECT name FROM zamestnanec WHERE id=$id");
		$row = mysql_fetch_assoc($result);
		
		if ($row === false) {
			die("id není obsaženo v databázi");
		}
	} else {
		die("Toto id není platné.");
	}
	
	if (isset($_POST['delete'])) {
		dotaz_db("DELETE FROM pobocka_zamestnanec WHERE zamestnanec_id1 = $id");
		$query = "DELETE FROM zamestnanec WHERE id=$id";
		$result = dotaz_db($query);
		
		$_SESSION['message'] = "Záznam uživatele {$row['name']} byl smazán.";
		$location = "Location: " . get_link("",array('id'=>''),false);
		
		header($location, true, 303);
		exit;
	}	

	
?><!doctype html>
<html>
	<head>
		<title>Smazání</title>
	</head>
	<body>
		<p>
			Opravdu chcete smazat uživatele <?= $row['name'] ?>?
		</p>
		<form action="" method="post">
			<input type="hidden" name="delete" value="1" />
			<input type="submit" value="ano" />
		</form>
		<br />
		<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
	</body>
</html>