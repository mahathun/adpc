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

if(isset($_POST['btnsubmit'])){
	
	$handle = fopen($_FILES['InputFile']['tmp_name'], "r");
	
	//if(!mysql_num_rows(mysql_query("SELECT * FROM $tbl_observeddata WHERE stationid='$_POST[station_id]'"))){
		
		while (($insert_csv = fgetcsv($handle,5000,"\t")) !== FALSE) {
			//$query = mysql_query("INSERT INTO $tbl_observeddata (stationid,year,month,day,rf,tmax,tmin) VALUES('$_POST[station_id]','$insert_csv[0]','$insert_csv[1]','$insert_csv[2]','$insert_csv[3]','$insert_csv[4]','$insert_csv[5]')");
			
			$query = mysql_query("INSERT INTO $tbl_observeddata (stationid,year,month,day,rf,tmax,tmin) 
			VALUES('$_POST[station_id]','$insert_csv[0]','$insert_csv[1]','$insert_csv[2]','$insert_csv[3]','$insert_csv[4]','$insert_csv[5]')
			ON DUPLICATE KEY UPDATE stationid='$_POST[station_id]',year='$insert_csv[0]',month='$insert_csv[1]',day='$insert_csv[2]',rf='$insert_csv[3]',
			tmax='$insert_csv[4]',tmin='$insert_csv[5]'");
				
		}
		
		if($query){
			$msg="<div class=\"alert alert-success\"><a href=\"#\" class=\"alert-link\">Data Successfully Uploaded</a></div>";
		}else{
			$msg="<div class=\"alert alert-danger\"><a href=\"#\" class=\"alert-link\">Error ! Uploading data</a></div>";
		}

		fclose($handle);
			
		
	//}else{
		/*
		while (($insert_csv = fgetcsv($handle,5000,"\t")) !== FALSE) {
			$query = mysql_query("UPDATE $tbl_observeddata SET stationid='$_POST[station_id]',year='$insert_csv[0]',month='$insert_csv[1]',day='$insert_csv[2]',rf='$insert_csv[3]',tmax='$insert_csv[4]',tmin='$insert_csv[5]'");
		
		}
		
		
		if($query){
			$msg="<div class=\"alert alert-success\"><a href=\"#\" class=\"alert-link\">Data Successfully Uploaded</a></div>";
		}else{
			$msg="<div class=\"alert alert-danger\"><a href=\"#\" class=\"alert-link\">Error ! Uploading data</a></div>";
		}
		
		fclose($handle);
		*/
	//}
	
	
	



}

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
		
		<link href="dist/select/select2.css" rel="stylesheet" />

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
		<script src="dist/select/select2.js"></script>
	</head>
	<body>
		<script>
			 $(document).ready(function() {
$("#e2").select2({
    placeholder: "Select a State",
    allowClear: true
});
			});
		</script>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="well well-sm">
					<?php 
					echo $msg;
					?>
						<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<fieldset>
								<legend class="text-center">
									Add Observed Data
								</legend>

							
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Station</label>
									<div class="col-md-9">
									<?php echo $_REQUEST['station_name'];?>
									<input type="hidden" value="<?php echo $_REQUEST['station_id'];?>" name="station_id">
									</div>
								</div>

								
								<div class="form-group">
									<label class="col-md-3 control-label">Observed Data</label>
									<div class="col-md-9">
										 <input type="file" id="InputFile" name="InputFile">
									</div>
								</div>

							
								<div class="form-group">
									<div class="col-md-12 text-right">
										<a href="index.php" class="btn btn-info btn-sm">
											Back to list
										</a>
										<button type="submit" name="btnsubmit" class="btn btn-success btn-sm">
											Submit
										</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</body>
</html>