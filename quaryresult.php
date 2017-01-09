<?php
		$con=mysqli_connect("localhost","adpc","adpc2014","wims");
	$myquery = "SELECT name,(deglatitude+ minlatitude/60+ seclatitude/3600) as latitude , (deglongitude+minlongitude/60+seclongitude/3600) as longitude, elevation FROM stations";
	$query = mysqli_query($con,$myquery);	
	$data = array();
	$data2 = array();
	
		
	for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
		$data2[]=array($data[$x]['name'],$data[$x]['latitude'],$data[$x]['longitude'],$data[$x]['elevation']);
       }
     echo json_encode($data2);
    mysqli_close($con);  
?>

