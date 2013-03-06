<?php
	
	$where_conds = array();
	
	$where = "";
	
//filtrace podle nazvu firmy
	if (isset($_GET['nazev'])) {
		$nazev = $_GET['nazev'];
	} else {
		$nazev = "";
	}	
	if (!empty($nazev)) {
		$where_conds[] = "f.nazev LIKE '%" . mysql_real_escape_string($nazev) . "%'";
	}
	
//filtrace podle adresy firmy
	if (isset($_GET['adresa'])) {
		$adresa = $_GET['adresa'];
	} else {
		$adresa = "";
	}
	if (!empty($adresa)) {
		$where_conds[] = "f.adresa LIKE '%" . mysql_real_escape_string($adresa) . "%'";
	}
	
//filtrace podle mesta
	if (isset($_GET['mesto'])) {
		$mesto = $_GET['mesto'];
	} else {
		$mesto = "";
	}
	if ($mesto != "") {
		$where_conds[] = "f.mesto = '" . mysql_real_escape_string($mesto) . "'";
	}
	
//filtrace podle emailu
	if (isset($_GET['email'])) {
		$email = $_GET['email'];
	} else {
		$email = "";
	}
	if (!empty($email)) {
		$where_conds[] = "f.email LIKE '%" . mysql_real_escape_string($email) . "%'";
	}

//zde skadame finalni podminku
	if (!empty($where_conds)) {
		$where = "WHERE " . implode(" AND ",$where_conds);
	}

//select a join pro dotazy
	$select = "f.id AS id, f.nazev AS nazev, f.adresa AS adresa, f.mesto AS mesto, f.psc AS psc, f.email AS email, SUM(z.payment) AS soucet_platu, ROUND(AVG(z.payment)) AS prumerny_plat, ROUND(1.4 * SUM(z.payment)) AS naklady_na_zamestnance, f.mesicni_naklady AS mesicni_naklady, ROUND((1.4 * SUM(z.payment)) + mesicni_naklady) AS celkove_naklady";
	$join = " JOIN zamestnanec AS z ON z.firma_id = f.id";
	
	$query = "SELECT $select FROM firma AS f $join $where GROUP BY nazev ORDER BY nazev ASC";
	
	$result = dotaz_db($query);
	
	while ($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	mysql_free_result($result);

	if (!empty($data)) {
		foreach ($data as $row) { ?>
					
					<h3><?=$row['nazev'] ?></h3>
					<dl>
						<dt>adresa</dt>
						<dd><?=$row['adresa'] ?>, <?=$row['psc'] ?> <?=$row['mesto'] ?></dd>
						<dt>email</dt>
						<dd><?=$row['email'] ?></dd>
						<dt>součet platů</dt>
						<dd><?=$row['soucet_platu'] ?>Kč</dd>
						<dt>průměrný plat</dt>
						<dd><?=$row['prumerny_plat'] ?>Kč</dd>
						<dt>náklady na zaměstnance</dt>
						<dd><?=$row['naklady_na_zamestnance'] ?>Kč</dd>
						<dt>měsíční náklady</dt>
						<dd><?=$row['mesicni_naklady'] ?>Kč</dd>
						<dt>celkové náklady</dt>
						<dd><?=$row['celkove_naklady'] ?>Kč</dd>
					</dl>
					
<?php	} 
	}
?>
