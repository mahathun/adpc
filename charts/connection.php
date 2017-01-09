<?php
	$host= 'localhost';
	$username= 'adpc';
	$password= 'adpc2014';
	$database=  'wims';


	 $server = mysql_connect($host, $username, $password);
     $connection = mysql_select_db($database, $server);

?>