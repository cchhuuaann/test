<?php
	
/*
 * Vyřešit <select> boxy, nekdy je potřeba ve value ID a někdy NAZEV 
 */

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
	
//filtrace podle nazvu pobocky
	if (isset($_GET['nazev'])) {
		$nazev = $_GET['nazev'];
	} else {
		$nazev = "";
	}	
	if (!empty($nazev)) {
		$where_conds[] = "p.nazev LIKE '%" . mysql_real_escape_string($nazev) . "%'";
	}
	
//filtrace podle adresy pobocky
	if (isset($_GET['adresa'])) {
		$adresa = $_GET['adresa'];
	} else {
		$adresa = "";
	}
	if (!empty($adresa)) {
		$where_conds[] = "p.adresa LIKE '%" . mysql_real_escape_string($adresa) . "%'";
	}
	
//filtrace podle mesta
	if (isset($_GET['mesto'])) {
		$mesto = $_GET['mesto'];
	} else {
		$mesto = "";
	}
	if ($mesto != "") {
		$where_conds[] = "p.mesto = '" . mysql_real_escape_string($mesto) . "'";
	}
	
//filtrace podle emailu
	if (isset($_GET['email'])) {
		$email = $_GET['email'];
	} else {
		$email = "";
	}
	if (!empty($email)) {
		$where_conds[] = "p.email LIKE '%" . mysql_real_escape_string($email) . "%'";
	}
	
//filtrace podle firmy
	if (isset($_GET['firma_nazev'])) {
		$firma_nazev = $_GET['firma_nazev'];
	} else {
		$firma_nazev = "";
	}
	if (!empty($firma_nazev)) {
		$where_conds[] = "firma.nazev = '" . mysql_real_escape_string($email) . "'";
	}

//zde skadame finalni podminku
	if (!empty($where_conds)) {
		$where = "WHERE " . implode(" AND ",$where_conds);
	}
	
//join
	$join = "JOIN firma ON p.firma_id = firma.id";
	
//pole
	$pole = "p.nazev, p.adresa, p.mesto, p.psc, p.telefon, p.email, firma.nazev AS firma_nazev, firma.adresa AS firma_adresa, firma.mesto AS firma_mesto, firma.psc AS firma_psc";

//ziskani poctu radku
	$query = "SELECT COUNT(DISTINCT p.id) as cnt FROM pobocka AS p $join $where";
	
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
	
	$query = "SELECT $pole FROM pobocka AS p $join $where GROUP BY p.id $order $limit";
	
	$result = dotaz_db($query);
	
	while ($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	mysql_free_result($result);

?>
		<br />Vyhovuje <?=$count['cnt']?> položek z <?=$count['cnt']?>
		
		<p>
		<?php
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			}
		?>
		</p>
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
					<th>telefon</th>
					<th>email</th>
					<th>firma</th>
					<th>adresa firmy</th>
					<th>smazat</th>
					<th>upravit</th>
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
							<td><?=$row['telefon'] ?></td>
							<td><?=$row['email'] ?></td>
							<td><?=$row['firma_nazev'] ?></td>
							<td><?=$row['firma_adresa'] ?>
							<br /><?=$row['firma_mesto'] ?>
							<br /><?=$row['firma_psc'] ?></td>
							<td><a href="<?= get_link('delete',array('id'=>$row['id'])) ?>">Smazat</a></td>
							<td><a href="<?= get_link('edit',array('id'=>$row['id'])) ?>">Upravit</a></td>
						</tr>
				<?php }?>
			</tbody>
		</table>
			<?php }?>
		<p>
		<a href="<?= get_link('edit',array('id'=>'')) ?>">Nová položka</a>
		</p>
		<?php
		
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
