<?php

	header("Content-Type: text/html; Charset=utf-8");

	class Zakaznik {
		private $name;
		private $age;
		private $company;
		private $data = array();
		const AGEMAX = 30;
		
		public function __construct($name,$age,$company) {
			$this->name = $name;
			$this->age = $age;
			$this->company = $company;
		}
		
		public function __toString() {
			echo "Jmenuji se {$this->name} a je mi {$this->age}let. ";
			echo "Pracuji pro spolecnost {$this->company}. ";
			if($this->age > self::AGEMAX) {
				echo "A je mi vice jak " . self::AGEMAX . ". ";
			}
			echo "\n<br />=========<br />\n";
			echo "Dale mame definovano:<br />\n";
			foreach($this->data as $key => $value) {
				echo "{$key}: {$value}<br />\n";
			}
			
			return "";
		}
		
		public function __set($name,$value) {
			//echo "Setting '$name' to '$value'<br />\n";
			$this->data[$name] = $value;
		}
		
		public function __get($name) {
			//echo "Getting '$name'<br />\n";
			if(array_key_exists($name, $this->data)) {
				return $this->data[$name];
			}
			
			$trace = debug_backtrace();
			trigger_error(
				'Undefined property via __get(): ' . $name .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'],
				E_USER_NOTICE);
			return NULL;
		}
	}
	
	$employee = array();
	
	$db = mysql_connect('localhost','honza','test');
	mysql_select_db('people',$db);
	$query = "SELECT * FROM employee";
	$result = mysql_query($query,$db);
	
	$i = 0;
	while($row = mysql_fetch_assoc($result)) {
		$employee[$i] = new Zakaznik($row['name'], $row['age'], $row['company']);
		$employee[$i]->mesto = $row['mesto'];
		$employee[$i]->ulice = $row['ulice'];
		
		++$i;
	}
	
	foreach($employee as $value) {
		echo $value;
		echo "<br /><br /><br />";
	}
	
	$arr = array(
			'a'=>"auto", 'b'=>"kolo"
			);

			$arr = (object) $arr;
			
	var_dump($arr);
	
	var_dump($arr->a);
	
	