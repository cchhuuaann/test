<?php
	
	$where_conds = array();
	
	$where = "";

	
	if (isset($_GET['strana']) && is_numeric($_GET['strana'])) {
		$strana = $_GET['strana'];
	} else {
		$strana = 1;
	}	
	

//nastaveni razeni dle nazev nebo id
	if (isset($_GET['order']) && in_array($_GET['order'],$arr_razeni) ) {
		$order = 'ORDER BY ' . $_GET['order'] . ' ASC';
	} else {
		$order = '';
	}
	
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
	
//ziskani poctu radku
	$query = "SELECT COUNT(*) as cnt FROM firma f $where";
	
	$result = dotaz_db($query);
	
	$count = mysql_fetch_assoc($result);

	mysql_free_result($result);
	
// konec
	
	
// dotaz pro vypis tabulky
	$page_count = ceil($count['cnt']/$per_page);
	
	if (!($strana > 0 && $strana <= $page_count) ) {
		$strana = 1;
	}
	
	$max = $per_page * $strana;
	$limit = "LIMIT " . ($max - $per_page) . "," . $per_page;
	
	$query = "SELECT $select FROM firma AS f $join $where GROUP BY nazev $order $limit";
	
	$result = dotaz_db($query);
	
	while ($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	mysql_free_result($result);

?>
		<br />Vyhovuje <?=$count['cnt']?> položek z <?=$count['cnt']?>
		
			<?php 
				if (!empty($data)) {
			?>
		<table class="seznam">
			<thead>
				<tr>
					<th>
						<a class="order" data-order="nazev" href="<?=get_link("", array('order'=>'nazev'))?>">Název</a>
					</th>
					<th>adresa</th>
					<th>email</th>
					<th>součet platů</th>
					<th>průměrný plat</th>
					<th>náklady na zaměstnance</th>
					<th>měsíční náklady</th>
					<th>celkové náklady</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($data as $row) { ?>
						<tr>
							<td><?=$row['nazev'] ?></td>
							<td><?=$row['adresa'] ?>
							<br /><?=$row['mesto'] ?>
							<br /><?=$row['psc'] ?></td>
							<td><?=$row['email'] ?></td>
							<td><?=$row['soucet_platu'] ?></td>
							<td><?=$row['prumerny_plat'] ?></td>
							<td><?=$row['naklady_na_zamestnance'] ?></td>
							<td><?=$row['mesicni_naklady'] ?></td>
							<td><?=$row['celkove_naklady'] ?></td>
						</tr>
				<?php }?>
			</tbody>
		</table>
			<?php }
		
			if ($strana > 1) {
				$get = $_GET;
				$get['strana']=$strana - 1;
				$odkaz = http_build_query($get);
				
				echo "<a class=\"page\" data-page=\"{$get['strana']}\" href=\"?{$odkaz}\">&laquo;</a> ";
			}
			
			for ($i = 1; $i <= ceil($count['cnt']/$per_page); $i++) {
				$get = $_GET;
				$get['strana']=$i;
				$odkaz = http_build_query($get);
				
				if ($strana == $i) {
					echo "<strong>$i </strong>";
				} else {
					echo "<a class=\"strana\" data-page=\"{$get['strana']}\" href=\"?{$odkaz}\">$i</a>  ";
				}
			}
			
			if ($strana < $page_count) {
				$get = $_GET;
				$get['strana']=$strana + 1;
				$odkaz = http_build_query($get);
				
				echo "<a class=\"strana\" data-page=\"{$get['strana']}\" href=\"?{$odkaz}\">&raquo;</a>";
			}

		?>
