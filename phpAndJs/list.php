<?php
	
	$arr_zazadal = array(
			"v" => "vše",
			"1" => "ano",
			"0" => "ne"
	);

	$arr_vek = array(
			"0" => "vše",
			"_26" => "do 26 let",
			"26_35" => "26-34",
			"35_47" => "35-46",
			"47_60" => "47-59",
			"60_" => "60 a více"
	);
	
	$arr_vyplata = array(
			"0" => "vše",
			"_10000" => "do 10.000",
			"10000_20000" => "10.000-19.999",
			"20000_30000" => "20.000-29.999",
			"30000_" => "30.000 a více"
	);
	
	$arr_razeni = array(
			"id",
			"name"
	);
	
	
	
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
	
	$per_page = 5;
	$page_count = ceil($count['cnt']/$per_page);
	
	mysql_free_result($result);

	if (!($strana > 0 && $strana <= $page_count) ) {
		$strana = 1;
	}
	
	if ($strana == 1) {
		$limit = "LIMIT $per_page";
	} else {
		$max = $per_page * $strana;
		$limit = "LIMIT " . ($max - $per_page) . "," . $max;
	}
	
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

?><!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<form action="" method="get">
			<label for="zacatek">Jméno začíná na: </label>
			<input type="text" name="zacatek" id="zacatek" value="<?=htmlspecialchars($zacatek) ?>" />
				<br />
				
			<label for="vek">věk</label>
			<select id="vek" name="vek" >
				<?= vytvor_option($arr_vek,$age)?>
			</select>
				<br />
				
			<label for="vyplata">výplata</label>
			<select id="vyplata" name="vyplata" >
				<?= vytvor_option($arr_vyplata,$money)?>
			</select>
				<br />
				
			<label for="zazadal">zažádal</label>
			<select id="zazadal" name="zazadal" >
				<?= vytvor_option($arr_zazadal,$zadost)?>
			</select>
				<br />
            <input type="hidden" name="order" value="<?= isset($_GET['order']) ? $_GET['order'] : "" ?>" />				
			<input type="submit" />
		</form>
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
						<a href="<?=get_link("", array('order'=>'id'))?>">id</a>
					</th>
					<th>
						<a href="<?=get_link("", array('order'=>'name'))?>">Jméno</a>
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
				/* 
					foreach ($data as $line) {
						echo "<tr>\n";
							foreach ($line as $key => $value) {
								$tmp = "<td>";
								
								if ($key == 'request') {
									if ($value == 0) {
										$tmp .= "N";
									} else {
										$tmp .= "A";
									}
								} else {
									$tmp .= $value;
								}
								
								echo "{$tmp}</td>\n";
							}
						echo "</tr>\n";
					}
				*/

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
				
				echo "<a href=\"?{$odkaz}\">&laquo;</a> ";
			}
			
			for ($i = 1; $i <= ceil($count['cnt']/5); $i++) {
				$get = $_GET;
				$get['strana']=$i;
				$odkaz = http_build_query($get);
				
				if ($strana == $i) {
					echo "<strong>$i </strong>";
				} else {
					echo "<a href=\"?{$odkaz}\">$i</a>  ";
				}
			}
			
			if ($strana < $page_count) {
				$get = $_GET;
				$get['strana']=$strana + 1;
				$odkaz = http_build_query($get);
				
				echo "<a href=\"?{$odkaz}\">&raquo;</a>";
			}

		?>
	</body>
</html>
