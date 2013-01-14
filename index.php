<html>
	<head>
		<title><?="Hello word!"?></title>
	</head>
	<body>	
	<?php 	
		$cislo = min(10, 6);

		$cislo2 = 1.545;
		$text1 = "ahoj $cislo svete";
		$text2 = 'ahoj $cislo' . 'svete';

		$novytext = ($text2 . $text1) / 10;

		echo "$novytext<br />";

		// var_dump($text1);
		print_r($text1);
		
		$bool = true; // false
		
		$cislo1 = 10;
		
		$cislo1 += 15;
		$cislo1 = $cislo1 + 15;		
		
		$cislo1++;
		$cislo1 = $cislo1 + 1;
		
		$cislo1--;
		$cislo1 = $cislo1 - 1;
		
		var_dump($cislo1);
		
		$text2 .= ' !!!';
		$text2 =  $text2 . ' !!!';
		
		/*
		$nazev = 'xxx';
		$nazevpromenne = 'nazev';
		var_dump($$nazevpromenne);
		*/
		
		# test
		# test tets
		/*
		 * test
		 */
	?>
	</body>
</html>

<?php
$promenna = 'xxx';
$text = $promenna . "\n\t\"\\";

$text = $promenna . '\n\t\"\\';

echo '<table class="short"></table>';
echo "<table class=\"short\"></table>";
?>


<?php 
	var_dump(is_string($text));
	var_dump(is_string($cislo1));		
?>

<?php 
 session_start();

// prohlizec
 var_dump($_GET);
 var_dump($_POST);
 var_dump($_COOKIE);
 
 // server
 var_dump($_SERVER);
 var_dump($_SESSION);

 
 var_dump($_COOKIE["PHPSESSID"]);
 
 $pole = array(1,2,3);
 $pole = [1,2,3]; // jen od PHP 5.4
 
 var_dump($pole);
 var_dump($pole[1]);

 
 $pole = array('xxx1' => 'jedna', 2=>'dve');
 $pole = ['xxx1' => 'jedna', 2=>'dve']; // jen od PHP 5.4
 
 var_dump($pole);
 var_dump($pole['xxx1']);
?>
