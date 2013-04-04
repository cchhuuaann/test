<?php
	header("Content-Type: text/plain-text; Charset=utf-8");

	class Database {
		private static $instance;
		private static  $defaultConfigArr = array(
				"user"=>"",
				"db_name"=>"",
				"pass"=>"",
				"server"=>"",
				"encoding"=>"utf-8"
			);
		
		private $linkIdentifier;
		private $buffer = array();
		
		private function __construct($config_arr) {
			
			$this->linkIdentifier = mysql_connect($config_arr['server'],$config_arr['user'],$config_arr['pass']);
			if(!$this->linkIdentifier) {
				die('Could not connect: ' . mysql_error());
			}
			
			$select_db = mysql_select_db($config_arr['db_name'],$this->linkIdentifier);
			if(!$select_db) {
				die('Can\'t use ' . $config_arr['db_name'] . ' : ' . mysql_error());
			}
			
			mysql_query('SET NAMES ' . $config_arr['encoding']);
		}
		
		private function __clone() {
			;
		}
		
		public function __wakeup() {
			throw new Exception("Serializace neni podporovana.");
		}
		
		public function __destruct() {
			mysql_close($this->linkIdentifier);
		}
		
		private function mysqlQuote($value, $connection = NULL) {
			if(is_null($value)) {
				return "NULL";
			}
			if(is_int($value) || is_float($value)) {
				return $value;
			}
			if(is_bool($value)) {
				return ($value ? 1 : 0);
			}
			$args = func_get_args();
			$return = call_user_func_array("mysql_real_escape_string", $args);
			return "`{$return}`";
		}
		
		public static function getInstance($config_arr) {
			$config_arr = array_merge(self::$defaultConfigArr, $config_arr);
			if(!isset(self::$instance)) {
				self::$instance = new self($config_arr);
			}
			
			return self::$instance;
		}
				
		public function query($dotaz) {
			$dotaz_arr = explode('?', $dotaz);
			$num_args = func_num_args();
			$num_dotaz = count($dotaz_arr);
			
			if($num_args != $num_dotaz) {
				die('Chyba: spatny pocet argumentu.');
			}
			
			$query = $dotaz_arr[0];
			
			for($i = 1; $i < ($num_args); $i++) {
				$arg = func_get_arg($i);
				$query .= $this->mysqlQuote($arg) . $dotaz_arr[$i];
			}
			var_dump($query);
			$result = mysql_query($query,$this->linkIdentifier);
			
			return $result;
		}
		
		public function getRows($dotaz) {
			$args_arr = func_get_args();
			$result = call_user_func_array(array($this,"query"), $args_arr);
			
			$row_arr = array();
			while($row = mysql_fetch_row($result)) {
				$row_arr[] = $row;
			}
			
			if(count($row_arr) > 0) {
				return $row_arr;
			} else {
				return FALSE;
			}
		}
		
		public function getObjects($dotaz) {
			$args_arr = func_get_args();
			$result = call_user_func_array(array($this,"query"), $args_arr);
			
			$row_arr = array();
			while($row = mysql_fetch_object($result)) {
				$row_arr[] = $row;
			}
			
			if(count($row_arr) > 0) {
				return $row_arr;
			} else {
				return FALSE;
			}
		}
		
		public function store($array) {
			$this->buffer = array_merge($this->buffer,$array);
			var_dump($this->buffer);
		}
		
		public function insertStored($tabulka) {
			$columns = implode(',', array_keys($this->buffer));
			$values = implode('\',\'', $this->buffer);
			
			$query = "INSERT INTO {$tabulka} ({$columns}) VALUES ('{$values}')";
			var_dump($query);
			$result = mysql_query($query,$this->linkIdentifier);
			
			return $result;
		}
		
		public function UpdateStored($tabulka,$where_cast) {
			;
		} 
	}
	
	$config_array = array(
			"user"=>"honza",
			"db_name"=>"test",
			"pass"=>"test",
			"server"=>"localhost",
			"encoding"=>"utf8"
		);
	
	$arr = array(
			"name"=>"John",
			"age"=> 24,
			"company"=>"www"
		);
	
	$databaze = Database::getInstance($config_array);
	$databaze->store($arr);
	var_dump($databaze->insertStored('zamestnanec'));
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
