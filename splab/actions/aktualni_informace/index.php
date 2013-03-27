<?php
	$query = "SELECT id,nadpis,podnadpis,datum,UNIX_TIMESTAMP(datum) AS datum_timestamp FROM novinky WHERE typ=1 ORDER BY datum ASC";
	$result = dotaz_db($query);
		
	while ($row = mysql_fetch_assoc($result)) {
		echo "<div class=\"novinky\">";
		echo "<h2>" . $row['nadpis'] . "</h2>";
		echo "<p>" . $row['podnadpis'] . "</p>";
		echo "<p>" . date('d.m.Y',$row['datum_timestamp']) . " <a href=\"" . URL . "aktualni_informace?nav=detail&id=" . $row['id'] . "\">zobrazit celou zprávu</a></p>";
		echo "</div>";
	}	
?>