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
		$where_conds[] = "nazev LIKE '%" . mysql_real_escape_string($nazev) . "%'";
	}
	
//filtrace podle adresy firmy
	if (isset($_GET['adresa'])) {
		$adresa = $_GET['adresa'];
	} else {
		$adresa = "";
	}
	if (!empty($adresa)) {
		$where_conds[] = "adresa LIKE '%" . mysql_real_escape_string($adresa) . "%'";
	}
	
//filtrace podle mesta
	if (isset($_GET['mesto'])) {
		$mesto = $_GET['mesto'];
	} else {
		$mesto = "";
	}
	if ($mesto != "") {
		$where_conds[] = "id = '" . mysql_real_escape_string($mesto) . "'";
	}
	
//filtrace podle emailu
	if (isset($_GET['email'])) {
		$email = $_GET['email'];
	} else {
		$email = "";
	}
	if (!empty($email)) {
		$where_conds[] = "email LIKE '%" . mysql_real_escape_string($email) . "%'";
	}

//zde skadame finalni podminku
	if (!empty($where_conds)) {
		$where = "WHERE " . implode(" AND ",$where_conds);
	}

//ziskani poctu radku
	$query = "SELECT COUNT(*) as cnt FROM firma $where";
	
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
	
	$query = "SELECT * FROM firma $where $order $limit";
	
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
	
		<table>
			<thead>
				<tr>
					<th>
						<a class="order" data-order="nazev" href="<?=get_link("", array('order'=>'nazev'))?>">Název</a>
					</th>
					<th>adresa</th>
					<th>město</th>
					<th>PSČ</th>
					<th>jméno jednatele</th>
					<th>IČO</th>
					<th>DIČ</th>
					<th>telefon</th>
					<th>email</th>
					<th>měsíční náklady</th>
					<th>plátce DPH</th>
					<th>smazat</th>
					<th>upravit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				if (!empty($data)) {
					foreach ($data as $row) { ?>
						<tr>
							<td><?=$row['nazev'] ?></td>
							<td><?=$row['adresa'] ?></td>
							<td><?=$row['mesto'] ?></td>
							<td><?=$row['psc'] ?></td>
							<td><?=$row['jmeno_jednatele'] ?></td>
							<td><?=$row['ico'] ?></td>
							<td><?=$row['dic'] ?></td>
							<td><?=$row['telefon'] ?></td>
							<td><?=$row['email'] ?></td>
							<td><?=$row['mesicni_naklady'] ?></td>
							<td><?=$row['dph']?'Ano':'Ne' ?></td>
							<td><a href="<?= get_link('delete',array('id'=>$row['id'])) ?>">Smazat</a></td>
							<td><a href="<?= get_link('edit',array('id'=>$row['id'])) ?>">Upravit</a></td>
						</tr>
				<?php } }?>
			</tbody>
		</table>
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
