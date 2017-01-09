<?php
$task ="";
    if(isset($_GET['task'])){
			$task = $_GET['task'];
	}
	$con=mysqli_connect("localhost","adpc","adpc2014","wims");
	$myquery = "SELECT `row`,`column`,`".$task."` as value FROM `query_result`";
	$query = mysqli_query($con,$myquery);	
	$data = array();
	$data2 = array();
	
		
	for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
		$data2[]=array($data[$x]['row'],$data[$x]['column'],$data[$x]['value']);
       }
     echo json_encode($data2);
    mysqli_close($con);    
?>

