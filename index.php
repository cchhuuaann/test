<html>
	<head>
		<title><?="Hello word!"?></title>
	</head>
	<body>	
	<?php 	
		$cislo = min(10, 6);

		$cislo2 = 1.545;
		$text1 = "ahoj $cislo svete ";
		$text2 = 'ahoj ' . 'svete ';

		$novytext = ($text2 . $text1) / 10;

		echo $novytext;
		
	?>
	</body>
</html>
