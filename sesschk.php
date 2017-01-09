<?php
session_start();

$q= $_GET['q'];

	if(strcmp($q, 1)==0){
		echo $_SESSION['queryid_a'];
	}else if(strcmp($q, 2)==0){
		echo $_SESSION['queryid_b'];
	}

?>
