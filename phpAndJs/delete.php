<?php

	

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		
		$result = mysql_query("SELECT name FROM hodnoty WHERE id=$id",$link);
		$row = mysql_fetch_assoc($result);
		
		if ($row === false) {
			die("id není obsaženo v databázi");
		}
	} else {
		die("Toto id není platné.");
	}
	
	if (isset($_POST['delete'])) {
		$query = "DELETE FROM hodnoty WHERE id=$id";
		$result = mysql_query($query,$link);
		
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