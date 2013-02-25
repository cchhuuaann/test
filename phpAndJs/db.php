<?php
$link = mysql_connect('localhost', 'honza', 'test');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';

$db_selected = mysql_select_db('firma', $link);
if (!$db_selected) {
	die ('Can\'t use firma : ' . mysql_error());
}

mysql_query('SET NAMES utf8');

function mysql_on_end($link) {
	if (is_resource($link)) {
		mysql_close($link);
		$link = NULL;
	}
}

register_shutdown_function("mysql_on_end",$link);