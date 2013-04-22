<?php
	session_start();
	
	header("Content-Type: text/html; Charset=utf-8");

	function __autoload($class) {
		include str_replace("_","/",$class) . ".php";
	}
	
	$prihlaseni = NULL;
	
	$config = array(
			"user"=>"honza",
			"db_name"=>"login",
			"pass"=>"test",
			"server"=>"localhost",
			"encoding"=>"utf-8"
	);
	
	$session = session_id();
 
	$database = Database::getInstance($config);
	
	if(isset($_GET['logoff']) && $_GET['logoff'] == 'true') {
		
		$database->store(array('sid'=>''));
		$database->updateStored('user', "WHERE sid = '{$session}'");

		setcookie(session_id(), '', time() - 42000, 'http://test/');
		
		session_unset();
		session_destroy();
		
	} elseif(isset($_POST) && !empty($_POST)) {
		
		$row = $database->getRows("SELECT * FROM user WHERE email = '{$_POST['email']}'");
		
		if($row[0]['email'] == $_POST['email'] && $row[0]['passwd'] == $_POST['passwd']) {
			
			$database->store(array('sid'=>session_id(),'ip'=>$_SERVER['REMOTE_ADDR']));
			$database->updateStored('user', "WHERE email = '{$row[0]['email']}'");
			
			$prihlaseni = true;
		}
	} else {
		
		$row = $database->getRows("SELECT * FROM user WHERE sid = '{$session}'");
		
		if($row != false) {
			session_regenerate_id();
			
			$database->store(array('sid'=>session_id()));
			$database->updateStored('user', "WHERE email = '{$row[0]['email']}'");
			
			$prihlaseni = false;
		}
	}
	
	echo '<pre>';
	
	var_dump($_SERVER['SERVER_ADDR']);
	
	var_dump($_SERVER['REMOTE_ADDR']);
	
	var_dump(session_id());
	
	var_dump($_SESSION);
	//session_regenerate_id();
	
	//var_dump(session_id());
	
	echo '</pre>';

?><!doctype html>
<html>
	<head>
	</head>
	<body>
	
	<?php
	
		if(isset($prihlaseni)) {
			if($prihlaseni) {
				echo "<h2>Prave jste se prihlasil.</h2>";
			} else {
				echo "<h2>Uz jste nejakou dobu prihlasen.</h2>";
			}
		} else {
			echo '<h2>Nejste prihlasen.</h2>';
		}
	
	?>
	
		<form action="http://test/login/" method="post">
			<div>
				<label for="email">Email: </label><input type="text" name="email" />
			</div>
			<div>
				<label for="passwd">Heslo: </label><input type="password" name="passwd" />
			</div>
			<input type="submit" />
		</form>
		<a href="?logoff=true">odhlasit</a>
	</body>
</html>