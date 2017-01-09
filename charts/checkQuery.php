<?php
include ("connection.php");
$qid1 = $_POST['qid1'];
$qid2 = $_POST['qid2'];

$myquery = "SELECT * FROM `query_log` WHERE query_id='$qid1'";
$myquery2 = "SELECT * FROM `query_log` WHERE query_id='$qid2'";



$query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }


    $res1 = mysql_fetch_assoc($query);

    $query = mysql_query($myquery2);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }


    $res2 = mysql_fetch_assoc($query);

$variable1 =  $res1['variable'];
$variable2 =  $res2['variable'];

$arr = array('q1' => "false", 'q2' => "false" , 'dataType1' => $variable1, 'dataType2' => $variable2 );
    
if(strcmp($res1['ts'], "1")==0){
	$arr['q1'] = "true";
}

if(strcmp($res2['ts'], "1")==0){
	$arr['q2'] = "true";
}

echo json_encode($arr);

?>