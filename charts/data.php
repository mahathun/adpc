<?php

include ("connection.php");
    
    //$server = mysql_connect($host, $username, $password);
    //$connection = mysql_select_db($database, $server);

    $qid1 =  $_GET['q1'];


 // if(isset($qid)){
         //echo "1";
         $myquery = "SELECT * FROM `a_query_result_observed` WHERE qid = '$qid1'";
    // }else{
        //echo "2";
         //$myquery = "";
    // }
   
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
?>
