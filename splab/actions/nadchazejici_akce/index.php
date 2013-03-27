<?php
	$query = "SELECT id,nadpis,podnadpis,datum,UNIX_TIMESTAMP(datum) AS datum_timestamp FROM novinky WHERE typ=0 ORDER BY datum ASC";
	$result = dotaz_db($query);
		
	while ($row = mysql_fetch_assoc($result)) {
		echo "<div class=\"novinky\">";
		echo "<h2><a href=\"" . URL . "nadchazejici_akce?nav=detail&id=" . $row['id'] . "\">" . $row['nadpis'] . "</a></h2>";
		echo "<p><span>" . date('d.m.Y',$row['datum_timestamp']) . "</span></p>";
		echo "<p>" . $row['podnadpis'] . "</p>";
		echo "</div>";
	}	
?>