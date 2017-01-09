<?php
$host='localhost';
$user='adpc';
$pass='adpc2014';
$dbs='wims';

$link=mysql_connect($host,$user,$pass) or die ('Cannot connect to the server');

$db=mysql_select_db($dbs) or die('Cannot select the database');


if(isset($_POST['btnsubmit'])){
	
	if($_POST['data_type']=='ptmin'){

		$tbl_data='p_temperature_min';
		$file_name='Raw_projected_TMIN__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
		
	}elseif ($_POST['data_type']=='ptmax'){
		
		$tbl_data='p_temperature_max';
		$file_name='Raw_projected_TMAX__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
		
	}elseif ($_POST['data_type']=='ptmean'){
		
		$tbl_data='p_temperature_mean';
		$file_name='Raw_projected_TMEAN__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
		
	}elseif ($_POST['data_type']=='pswind'){
		
		$tbl_data='p_surfacewind';
		$file_name='Raw_projected_SWIND__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
		
	}elseif ($_POST['data_type']=='prh'){
	
		$tbl_data='p_relativehumidity';
		$file_name='Raw_projected_RH__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
	
	}elseif ($_POST['data_type']=='prf'){
	
		$tbl_data='p_rainfall';
		$file_name='Raw_projected_RF__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
	
	}elseif ($_POST['data_type']=='pmslp'){
	
		$tbl_data='p_meansealevelpressure';
		$file_name='Raw_projected_MSLP__1980_2040_Kumara_140802.csv';
		$data_ok='OK';
	
	}else{
		
		$msg="<div class=\"alert alert-danger\">Data Not Found</div>";
	}
	
	if($data_ok=='OK'){
		
		$csv_file='/team/raw_data_csv_files/'.$file_name;
		$handle = fopen($csv_file, "r");
		
		
		
		while (($insert_csv = fgetcsv($handle,5000,"\t")) !== FALSE) {
		
			/*
			$L=0;//longitude
				
			for($i=2;$i<=30;$i++){
				$LV=$L+1;
				$v=$insert_csv[$i];// Value
		
				$query = mysql_query("INSERT INTO $tbl_data (timeid,year,month,latitude,longitude,value) VALUES('$insert_csv[0]','80','1','$insert_csv[1]','$LV','$v')");
		
			}
			
			*/
			
			for($a=1980;$a<=2040;$a++){
				for($b=1;$b<=12;$b++){
					for($c=1;$c<=54;$c++){
						$L=0;//longitude
						for($d=2;$d<=30;$d++){
						$LV=$L+1;
						$v=$insert_csv[$d];// Value
						$query = mysql_query("INSERT INTO $tbl_data (timeid,year,month,latitude,longitude,value) VALUES('$insert_csv[0]','$a','$b','$c','$LV','$v')");
		
								
						}
					}
				}
			}
			
			
		
		
		
		
		
		}
		
		
		
		if($query){
			$msg="<div class=\"alert alert-success\">Data Successfully Uploaded</div>";
		}else{
			$msg="<div class=\"alert alert-danger\">Error ! Uploading data</div>";
		}
		
		fclose($handle);
		
	}else{
		$msg="<div class=\"alert alert-danger\">Data Not Found</div>";
	}
	



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
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="well well-sm">
					<?php 
					echo $msg;
					?>
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<legend class="text-center">
									Add Projected/Gridded/Bias Data
								</legend>

							<div class="form-group">
              <label class="col-md-3 control-label" for="name">Data Type</label>
              <div class="col-md-9">
              
                 <select class="col-md-4 form-control" name="data_type" required>
										 	<option value="">--</option>
										 	<optgroup label="Raw Projected Data">
										 	<option value="ptmin">Min Temperature</option>
										 	<option value="ptmax">Max Temperature</option>
										 	<option value="ptmean">Mean Temperature</option>
										 	<option value="pswind">Surface Wind</option>
										 	<option value="prh">Relative Humidity</option>
										 	<option value="prf">Rainfall</option>
										 	<option value="pmslp">Mean Sea Level Pressure</option>
										 	
										 	</optgroup>
										 	<optgroup label="Observed Gridded Data">
										 	<option value="gtmin">Min Temperature</option>
										 	<option value="gtmax">Max Temperature</option>
										 	<option value="gtmean">Mean Temperature</option>
										 	<option value="gswind">Surface Wind</option>
										 	<option value="grh">Relative Humidity</option>
										 	<option value="grf">Rainfall</option>
										 	<option value="gmslp">Mean Sea Level Pressure</option>
					
										 	</optgroup>
										 </select>
              </div>
            </div>
								
							

							
								<div class="form-group">
									<div class="col-md-12 text-right">
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