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
				throw new Exception('Could not connect: ' . mysql_error());
			}
			
			$select_db = mysql_select_db($config_arr['db_name'],$this->linkIdentifier);
			if(!$select_db) {
				throw new Exception('Can\'t use ' . $config_arr['db_name'] . ' : ' . mysql_error());
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

		private function _callQuery($dotaz) {
			return mysql_query($dotaz,$this->linkIdentifier);
		}
		
		
		private function _escapeQuery($dotaz) {
			$parametry = func_get_args();
			$dotaz_arr = explode('?', $dotaz);
			array_shift($parametry);
			var_dump($parametry);
			$num_args = func_num_args();
			$num_dotaz = count($dotaz_arr);
				
			if($num_args != $num_dotaz) {
				throw new Exception('Chyba: spatny pocet argumentu.');
			}
			
			$dotaz = $dotaz_arr[0];
			array_shift($dotaz_arr);
			
			foreach($parametry as $value) {
				$dotaz .= $this->mysqlQuote($value) . $dotaz_arr[0];
				array_shift($dotaz_arr);
			}
			
			return $dotaz;
		}
		
		public function query($dotaz) {
			$param_arr = func_get_args();
			$dotaz = call_user_func_array(array($this,"_escapeQuery"), $param_arr);
			
			return $this->_callQuery($dotaz);
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
			
			$dotaz = "INSERT INTO {$tabulka} ({$columns}) VALUES ('{$values}')";
			
			return $this->_callQuery($dotaz);
		}
		
		public function updateStored($tabulka,$where_cast) {
			$update_arr = array();
			
			foreach($this->buffer as $key => $value) {
				$update_arr[] = "{$key}='{$value}'";
			}
			
			$update = implode(', ', $update_arr);
			
			if(func_num_args() > 2) {
				$argumenty = func_get_args();
				array_shift($argumenty);
				$where_cast = call_user_func_array(array($this,"_escapeQuery"), $argumenty);
			}
			
			$dotaz = "UPDATE {$tabulka} SET {$update} {$where_cast}";
			var_dump($dotaz);
			return $this->_callQuery($dotaz);
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
	
	$arr2 = array(
			"name"=>"Mike",
			"age"=> 21,
			"company"=>"xxx"
	);
	
	$param_arr = array(
			"SELECT ? ? FROM ?",
			"id",
			"name",
			"zamestnanec"
	);
	
	try {
		$databaze = Database::getInstance($config_array);
		$databaze->store($arr2);
		var_dump($databaze->insertStored('zamestnanec'));
		var_dump($databaze->updateStored("zamestnanec","WHERE id=2"));
		
		
		//call_user_func_array(array($databaze,"query"), $param_arr);
	} catch(Exception $e) {
		echo $e->getMessage();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
