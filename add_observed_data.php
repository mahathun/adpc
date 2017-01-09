<?php 

$host='localhost';
$user='adpc';
$pass='adpc2014';
$dbs='wims';

// tables
$tbl_station='stations';
$tbl_observeddata='observeddata';

$link=mysql_connect($host,$user,$pass) or die ('Cannot connect to the server');

$db=mysql_select_db($dbs) or die('Cannot select the database');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>

		<!-- Bootstrap -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">
		
		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			body {
				padding-top: 20px;
			}
		</style>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

		<script src="dist/js/bootstrap.min.js"></script>
		
	</head>
	
<body>
	<div class="container">
		<div class="col-md-12">
		<legend>
			<h1>Station List in Alphabetical Order</h1>
		</legend>
	</div>
		<table class="table table-striped table-hover table-responsive">
		<?php 
		$StationSQL=mysql_query("SELECT * FROM $tbl_station ORDER BY name");
		$i=1;
		while ($GetStationRow=mysql_fetch_array($StationSQL)){
		
		if(mysql_query("SELECT * FROM $tbl_observeddata WHERE stationid='$GetStationRow[id]'")){
			$StationDataSQL=mysql_query("SELECT MAX(year) AS Year,MAX(month) AS Month,stationid FROM $tbl_observeddata WHERE stationid='$GetStationRow[id]'");
			while ($GetStationData=mysql_fetch_array($StationDataSQL)){

			$date1=$GetStationData['Year']."-".$GetStationData['Month'];
			
			
		?>
  	<tr>
  		<td><?php echo $i;?></td>
  		<td><?php echo $GetStationRow['name'];?></td>
  		<td class="text-center">
  		<?php 
  			$date = strtotime('-0 months',strtotime ( $date1 ));
  			if($GetStationData['stationid']!=$GetStationRow['id']){
			echo "-";
			}else{
			echo "<span class=\"label label-success\">".date('Y-m', $date)."</span>";
			}
		?>
		</td>
  		<td class="text-center">
  		<?php $date = strtotime('-1 months',strtotime ( $date1 ));
			if($GetStationData['stationid']!=$GetStationRow['id']){
			echo "-";
			}else{
			echo "<span class=\"label label-info\">". date('Y-m', $date)."</span>";
			}
		?>
		</td>
  		<td class="text-center">
  		<?php $date = strtotime('-2 months',strtotime ( $date1 ));
			if($GetStationData['stationid']!=$GetStationRow['id']){
			echo "-";
			}else{
			echo "<span class=\"label label-warning\">". date('Y-m', $date)."</span>";
			}
		?>
		</td>
  		<td><a href="observed_data_process.php?station_name=<?php echo $GetStationRow['name'];?>&station_id=<?php echo $GetStationRow['id'];?>" class="btn btn-primary btn-xs">Add</button></td>
  	</tr>
  	<?php 
  			}
  		}
  	
  	$i++;
  	}
  	
  	?>
  </table>
	
	</div>
	
  
</body>
</html>
