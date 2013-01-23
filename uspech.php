<?php
	session_start();
	
//sem je presmerovana zprava z forms.php pri spravnem vyplneni formulare
	
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
 		<?php
 			if (isset($_SESSION['message'])) {
				echo $_SESSION['message']; 
 				unset($_SESSION['message']);
 			} else {
				echo '$_SESSION neni nastavena';
			}
 		?>
	</body>
</html>
