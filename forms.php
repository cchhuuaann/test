<?php
	session_start();
	header("Content-Type: text/html; Charset=utf-8");
	//var_dump($_SESSION);
	$isError = false;
?>
<html>
	<body>
 
		<form action="forms.php" method="post">
		
		<?php 
		 if(!empty($_SESSION['message'])) {
           echo $_SESSION['message'];
           unset($_SESSION['message']);
		 }
		?>
			Jméno:
			<input type="text" name="fname">
			<br />
				<?php
					if(!empty($_POST)) {
						$jmeno = $_POST['fname'];
				 
						$err = '';
				 
						if(!is_string($jmeno)) {
							$err .= '<br /> Jméno musí být řetězec';
						}
				 
				   		if(count(explode(' ', $jmeno)) != 2) {
				     		$err .= '<br /> Jméno musí mít dvě části';
				   		}   
				 
				   		if(!empty($err)) {
				     		echo "<p>{$err}</p>";
							$isError = true;
						}
					}
				?>
			Věk:
			<input type="text" name="age">
			<br />
				<?php
					if (!empty($_POST)) {
						$vek = $_POST['age'];
						
						$err = '';
						
						$vek = (int)$vek;
						
						if (empty($vek)) {
							$err .= '<br /> Zadejte věk';
						}
						
						if ($vek <  1 || $vek > 100) {
							$err .= '<br /> Věk musí být od 1 do 100';
						}
						
						if (!empty($err)) {
							echo "<p>{$err}</p>";
							$isError = true;
						}
					}
				?>
			Pohlaví:
			<select name="gender">
				<option value="">prosím vyberte</option>
				<option value="M">muž</option>
				<option value="F">žena</option>  
			</select>
			<br />
				<?php
					if (!empty($_POST)) {
						$pohlavi = $_POST['gender'];
						
						$err = '';
						
						if ($pohlavi != 'M' && $pohlavi != 'F') {
							$err .= '<br /> Pohlaví může být pouze muž nebo žena';
						}
						
						if (!empty($err)) {
							echo "<p>{$err}</p>";
							$isError = true;
						}
					}
				?>
			<label for="souhlas">Souhlasím se vším </label>
			<input type="checkbox" id="souhlas" value="1" />
			<br />
				<?php 
					if (!empty($_POST)) {

						if (empty($_POST['souhlas'])) {
							$err .= '<br /> Musíš souhlasit';
						}
							
						if (!empty($err)) {
							echo "<p>{$err}</p>";
							$isError = true;
						}
					}
				?>
			<input type="submit">
		
		</form>
 
		<?php
			if(!empty($_POST) && !$isError) {
				 
				$_SESSION['message'] = printInfo($jmeno, $vek, $pohlavi);
				header("HTTP/1.1 303 See Other");
				$header = "Location: " . $_SERVER['REQUEST_URI'];
				header($header);
				die;  
		 	}
		 
		 
		 	function printInfo($jmeno, $vek, $pohlavi) {
				
				$ret = "<p>Ahoj, jsem $jmeno a je mi $vek let. pokud jste si nevšimli, jsem ";
				
				if($pohlavi == "M") {
					$ret .= "muž";
				} else {
					$ret .= "žena";
				}
				
				$ret .= ". ";
				
				if ($souhlas == 1) {
					$ret .= "Souhlasím se vším.";
				}
				
				$ret .= "</p>";
				
				return $ret;
		 	}
		?>
 
	</body>
</html>
