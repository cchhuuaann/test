<?php

	//firma - dodelat
	

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		
		$result = dotaz_db("SELECT nazev FROM firma WHERE id=$id");
		$row = mysql_fetch_assoc($result);
		
		if ($row === false) {
			die("id není obsaženo v databázi");
		}
	} else {
		die("Toto id není platné.");
	}
	
	if (isset($_POST['delete'])) {
		/*
		$query = "DELETE FROM firma WHERE id=$id";
		$result = dotaz_db($query);
		*/
		
		$query = "SELECT id FROM pobocka WHERE firma_id = $id";
		$result = dotaz_db($query);
		
		$data = array();
		
		while($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		
		
		
		var_dump($data);
		
		/*
		$_SESSION['message'] = "Záznam firmy {$row['nazev']} byl smazán.";
		$location = "Location: " . get_link("",array('id'=>''),false);
		
		header($location, true, 303);
		exit;
		*/
	}	

	
?><!doctype html>
<html>
	<head>
		<?= vykresli_header("Smazání firmy") ?>
	</head>
	<body>
		<div id="all">
			<?= vykresli_menu() ?>
			<h1>
				Opravdu chcete smazat firmu <?= $row['nazev'] ?>?
			</h1>
			<form action="" method="post">
				<input type="hidden" name="delete" value="1" />
				<input type="submit" value="ano" />
			</form>
			<br />
			<a href="<?= get_link("",array('id'=>'')) ?>">Zpět</a>
		</div>
	</body>
</html>