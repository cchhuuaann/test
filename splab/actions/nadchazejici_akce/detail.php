<?php
	
	$query = "SELECT *,UNIX_TIMESTAMP(datum) AS datum_timestamp FROM novinky WHERE id=" . $_GET['id'];
	$result = dotaz_db($query);
	
	if($result === false) {
		echo "<h2>Danná novinka nebyla nalezena.</h2>";
	} else {
		$row = mysql_fetch_assoc($result);
		echo "<div class=\"novinky\">";
		echo "<h2><a href=\"" . URL . "nadchazejici_akce?nav=detail&id=" . $row['id'] . "\">" . $row['nadpis'] . "</a></h2>";
		echo "<p><span>" . date('d.m.Y',$row['datum_timestamp']) . "</span></p>";
		echo "<p>" . $row['podnadpis'] . "</p>";
		echo "<p>" . $row['text'] . "</p>";
		echo "</div>";
	}
?>