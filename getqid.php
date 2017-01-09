<?php
session_start();

if(isset($_SESSION['queryid_a'])){
	$q1 = $_SESSION['queryid_a'];
}else{
	$q1 = "null";
}
if(isset($_SESSION['queryid_b'])){
	$q2 = $_SESSION['queryid_b'];
}else{
	$q2 = "null";
}



$arr = array('q1' => $q1, 'q2' => $q2 );


	// if(strcmp($q, 1)==0){
	// 	echo $_SESSION['queryid_a'];
	// }else if(strcmp($q, 2)==0){
	// 	echo $_SESSION['queryid_b'];
	// }


echo json_encode($arr);
?>
