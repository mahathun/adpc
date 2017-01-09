<?php
$con=mysqli_connect("localhost","adpc","adpc2014","wims");
	$query = mysqli_query($con,"SELECT name,(deglatitude+ minlatitude/60+ seclatitude/3600) as latitude , (deglongitude+minlongitude/60+seclongitude/3600) as longitude, elevation FROM stations");	
	$data = array();
	echo "var item = [";
		
	for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
        echo "['",$data[$x]['name'],"',",$data[$x]['latitude'],",",$data[$x]['longitude'],",",$data[$x]['elevation'],"]";
        if ($x <= (mysqli_num_rows($query)-2) ) {
			echo ",";
		}
    } 
		echo "];";
     
    mysqli_close($con);    
?>

