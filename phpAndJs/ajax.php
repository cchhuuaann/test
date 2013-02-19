<?php
	
	require('config.php');
	require('funkce.php');
	require('db.php');
	
	$where_conds = array();
	
	$where = "";

	
	if (isset($_GET['strana']) && is_numeric($_GET['strana'])) {
		$strana = $_GET['strana'];
	} else {
		$strana = 1;
	}	
	

//nastaveni razeni dle name nebo id
	if (isset($_GET['order']) && in_array($_GET['order'],$arr_razeni) ) {
		$order = 'ORDER BY ' . $_GET['order'] . ' ASC';
	} else {
		$order = '';
	}
	
//filtrace podle stavu zadosti
	if (isset($_GET['zazadal']) && isset($arr_zazadal[$_GET['zazadal']])) {
		$zadost = $_GET['zazadal'];
	} else {
		$zadost = "v";
	}
		
	if ($zadost != "v") {
		$where_conds[] = "request = '" . mysql_real_escape_string($zadost) . "'";
	}
	
//filtrace podle zacatku jmena
	if (isset($_GET['zacatek'])) {
		$zacatek = $_GET['zacatek'];
	} else {
		$zacatek = "";
	}
	
	if (!empty($zacatek)) {
		$where_conds[] = "name LIKE '%" . mysql_real_escape_string($zacatek) . "%'";
	}	
	
//filtrace dle veku
	$age = "0";
	if (isset($_GET['vek']) && isset($arr_vek[$_GET['vek']])) {
		$age = $_GET['vek'];
	}
	
	vygeneruj_podminky($where_conds,$age,'age');
	
//filtrace dle vyplaty
	$money = "0";
	if (isset($_GET['vyplata']) && isset($arr_vyplata[$_GET['vyplata']])) {
		$money = $_GET['vyplata'];
	}
	
	vygeneruj_podminky($where_conds, $money, 'payment');
	

//zde skadame finalni podminku

	if (!empty($where_conds)) {
		$where = "WHERE " . implode(" AND ",$where_conds);
	}
	
//ziskani poctu radku
	$query = "SELECT COUNT(*) as cnt FROM hodnoty $where";
	
	$result = mysql_query($query,$link);
	
	$count = mysql_fetch_assoc($result);
// konec
	
	$per_page = 4;
	$page_count = ceil($count['cnt']/$per_page);
	
	mysql_free_result($result);

	if (!($strana > 0 && $strana <= $page_count) ) {
		$strana = 1;
	}
	
	$max = $per_page * $strana;
	$limit = "LIMIT " . ($max - $per_page) . "," . $per_page;
	
	$query = "SELECT * FROM hodnoty $where $order $limit";
	
	$result = mysql_query($query,$link);
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
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
						<a class="order" data-order="id" href="<?=get_link("", array('order'=>'id'))?>">id</a>
					</th>
					<th>
						<a class="order" data-order="name" href="<?=get_link("", array('order'=>'name'))?>">Jméno</a>
					</th>
					<th>věk</th>
					<th>výplata</th>
					<th>zažádal</th>
					<th>smazat</th>
					<th>upravit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				if (!empty($data)) {
					foreach ($data as $row) { ?>
						<tr>
							<td><?=$row['id'] ?></td>
							<td><?=$row['name'] ?></td>
							<td><?=$row['age'] ?></td>
							<td><?=$row['payment'] ?></td>
							<td><?=$row['request']?'A':'N' ?></td>
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
