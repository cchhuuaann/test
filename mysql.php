<?php
	header("Content-Type: text/html; Charset=utf-8");

	if (isset($_GET['strana']) && is_numeric($_GET['strana'])) {
		$strana = $_GET['strana'];
	} else {
		$strana = 1;
	}	
	
	$link = mysql_connect('localhost', 'honza', 'test');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	//echo 'Connected successfully';

	$db_selected = mysql_select_db('zamestnaci', $link);
	if (!$db_selected) {
		die ('Can\'t use zamestnaci : ' . mysql_error());
	}
	
	mysql_query('SET NAMES utf8');

//ziskani poctu radku
	$query = 'SELECT COUNT(*) as cnt FROM hodnoty';
	
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
	
	$query = "SELECT * FROM hodnoty $limit";
	
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
	mysql_close($link);

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		
		Vyhovuje <?=$count['cnt']?> položek z <?=$count['cnt']?>
	
		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>Jméno</th>
					<th>věk</th>
					<th>výplata</th>
					<th>zažádal</th>
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

				foreach ($data as $row) { ?>
					<tr>
						<td><?=$row['id'] ?></td>
						<td><?=$row['name'] ?></td>
						<td><?=$row['age'] ?></td>
						<td><?=$row['payment'] ?></td>
						
						<td><?=$row['request']?'A':'N' ?></td>
						
						<td><?php/*
							if ($row['request'] == 0) {
								echo "N";
							} else {
								echo "A";
							}
						*/?></td>
					</tr>
				<?php }?>
			</tbody>
		</table>
		<br />
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
