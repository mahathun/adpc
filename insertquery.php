<?php
require 'config.php';

	$task ="";
	//echoL("MONE=".$_GET['monE']);
	//exit();
    if(isset($_GET['task'])){
		
    $con = mysqli_connect($host, $username, $password,$database);
    
	if (!$con) {
		die("Connection failed: " . mysql_connect_error());
	}
	$myquery = "INSERT INTO query_log(query_id,user_id,sessionid,variable,type,region_filter,resolution,RCM,GCM,scenario,statistic,yearS,yearE,monS,monE,".
	"jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dece,A_B_AB) VALUES". 
	"(NULL,".$_GET['uid'].",'".$_GET['sid']."','".$_GET['variable']."','".$_GET['typev']."','".$_GET['selextedArea']."','".$_GET['resolution']."','".$_GET['rcm'].
	"','".$_GET['gcm']."','".$_GET['scenario']."','".$_GET['statistics']."',".$_GET['yearf'].",".$_GET['yeart'].",".$_GET['monS'].",".$_GET['monE'].",".
	$_GET['monthJAN'].",".$_GET['monthFEB'].",".$_GET['monthMAR'].",".$_GET['monthAPR'].",".$_GET['monthMAY'].
	",".$_GET['monthJUN'].",".$_GET['monthJUL'].",".$_GET['monthAUG'].",".$_GET['monthSEP'].",".$_GET['monthOCT'].",".
	$_GET['monthNOV'].",".$_GET['monthDEC'].",'".$_GET['task']."')";
echoL($myquery."<br />");
mysqli_query( $con, $myquery);
	
	

	//get last query_id  -MADUWNATHA  use mysqli_ ..
	$qid=mysqli_insert_id($con);
echoL("QID:".$qid)	;
	
require "loadpara.php";


  if ($Tb_Name_1st_Part=="observeddata")
  {  
  //echoL("Processing OB---------");
  
	
	//######################### edit by maduwantha	  
  	if ($_GET['variable'] == "RainFall") $vartype="rf";
	if ($_GET['variable'] == "Max Temperature") $vartype="tmax";
	if ($_GET['variable'] == "Min Temperature") $vartype="tmin";

echoL("station ID:" . $region);
echoL("statMtd:" . $statMtd);

// update data_avail
    
	$daq_type="Observed";
	$daq_var = $_GET['variable'] ;
	$daq_yearS=0;
	$daq_monS=0;
	$daq_yearE=0;
	$daq_monE=0;
	$avail=0;
   
	$daq = sprintf("select year,month  from observeddata   order by year,month limit 1");
	$resdaq= mysqli_query($con,$daq);
	if ($resdaq)  $rowdaq=mysqli_fetch_array($resdaq);
	if ($rowdaq) {
	
	$daq_yearS= $rowdaq['year'];
	$daq_monS=$rowdaq['month'];
	$avail=1;
	}
	$daq = sprintf("select year,month  from observeddata   order by year desc,month desc limit 1");
	$resdaq= mysqli_query($con,$daq);
	if ($resdaq)  $rowdaq=mysqli_fetch_array($resdaq);
	if ($rowdaq) {
		$daq_yearE= $rowdaq['year'];
	$daq_monE=$rowdaq['month'];
	}
   
	$daq = sprintf("INSERT INTO  data_avail (data_type,variable,yearS,monS,yearE,monE,avail)  values ('%s','%s',%d,%d,%d,%d,%d) ON DUPLICATE KEY UPDATE yearS=%d,monS=%d,yearE=%d,monE=%d,avail=%d",$daq_type,$daq_var,$daq_yearS,$daq_monS,$daq_yearE,$daq_monE,$avail,$daq_yearS,$daq_monS,$daq_yearE,$daq_monE,$avail);
	
echoL($daq."<br />");
mysqli_query( $con, $daq);
	
	if  ($region =="ALL") {
	if ($statMtd=="-") {
								$sql="select T.stationid,T.year,T.month,T.day,T.".$vartype." as val from observeddata  T";
								//$sql = $sql . " inner join stations S on S.id= T.stationid  and S.name='" . $region . "'   ";
								$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
								$sql = $sql . " and " . $monQ ;	
								$sql = $sql . " order by T.stationid,T.year, T.month, T.day ";
								
								}
								else {
								$sql="select ". $yearE. " as year, ". $monE." as month , 1 as day, T.stationid,".$statMtd."(T.".$vartype.") as val from observeddata  T";
								//$sql = $sql . " inner join stations S on S.id= T.stationid  and S.name='" . $region . "'   ";
								$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
								$sql = $sql . " and " . $monQ ;	
								$sql = $sql . " group by T.stationid  ";
								$sql = $sql . " order by T.stationid";
								
								}
	
	}
	elseif  ($region =="SELECTION")  {
	/*$sql="select T.* from p_temperature_max T  ";
	$sql = $sql . " inner join region_coord C on C.latitude= T.latitude and C.longitude=T.longitude and   C.p_name='$region' ";
	$sql = $sql . " where T.year=1980 and T.month=1";*/
	}
	else{
	if ($statMtd=="-") {
								$sql="select T.stationid,T.year,T.month,T.day,T.".$vartype." as val from observeddata  T";
								$sql = $sql . " inner join stations S on S.id= T.stationid  and S.name='" . $region . "'   ";
								$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
								$sql = $sql . " and " . $monQ ;	
								$sql = $sql . " order by T.stationid,T.year, T.month, T.day ";
								
								}
								else {
								$sql="select ". $yearE. " as year, ". $monE." as month , 1 as day, T.stationid,".$statMtd."(T.".$vartype.") as val from observeddata  T";
								$sql = $sql . " inner join stations S on S.id= T.stationid  and S.name='" . $region . "'   ";
								$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
								$sql = $sql . " and " . $monQ ;	
								$sql = $sql . " group by T.stationid  ";
								$sql = $sql . " order by T.stationid";
								
								}
	}	
	
	echoL($sql);
	
	$res= mysqli_query($con,$sql);
	//echoL($sql);

	if ($_GET['task']=="a") 	$tbl_data="a_query_result_observed";
	else $tbl_data="b_query_result_observed";
	$sql= "INSERT INTO $tbl_data (qid,stationid,year,month,day,val) VALUES ";

	$x=0;
	while ( $row=mysqli_fetch_array($res)) 
	{ 
		//	if ($row['latitude'] ==10) {	
		if ($x >0) $sql= $sql.",";
		$sql= $sql. sprintf("(%d,%d,%d,%d,%d,%f)",$qid,$row['stationid'],$row['year'],$row['month'],$row['day'],$row['val']);
		$x++;	
		//	}
	}
	$sql= $sql."";
	//echoL("<br /> OBSx: ".$sql);
	$query = mysqli_query($con,$sql);
		$map=0;
		$map_csv=0;
		$p_map_csv=0;
		$prodcd_map_csv="";
		$units_map_csv=0;
		
		$ts=1;
		$ts_csv=1;
		$p_ts_csv=1;
		$prodcd_ts_csv="P01";
		$units_ts_csv=1;
		
		$sql=sprintf("update query_log set map=%d, map_csv=%d, p_map_csv=%d,prodcd_map_csv='%s',units_map_csv=%d,ts=%d,ts_csv=%d,p_ts_csv=%d,prodcd_ts_csv='%s',units_ts_csv=%d  where query_id=%d",$map,$map_csv,$p_map_csv,$prodcd_map_csv,$units_map_csv,$ts,$ts_csv,$p_ts_csv,$prodcd_ts_csv,$units_ts_csv,$qid);
	echoL($sql);
	$query = mysqli_query($con,$sql);
    
    
  if ($_GET['task']=="a") 	{
    $_SESSION ['queryid_a'] =$qid;
    $_SESSION ['map_a'] = $map;
	$_SESSION ['map_csv_a'] = $map_csv;
	$_SESSION ['p_map_csv_a'] = $p_map_csv;	
	$_SESSION ['prodcd_map_csv_a'] = $prodcd_map_csv;	
	$_SESSION ['units_map_csv_a'] = $units_map_csv;		
	
	$_SESSION ['ts_a'] = $ts;
	$_SESSION ['ts_csv_a'] = $ts_csv;
	$_SESSION ['p_ts_csv_a'] = $p_ts_csv;	
	$_SESSION ['prodcd_ts_csv_a'] = $prodcd_ts_csv;	
	$_SESSION ['units_ts_csv_a'] = $units_ts_csv;	
	} 
	if ($_GET['task']=="b") 	{
    $_SESSION ['queryid_b'] =$qid;
    $_SESSION ['map_b'] = $map;
	$_SESSION ['map_csv_b'] = $map_csv;
	$_SESSION ['p_map_csv_b'] = $p_map_csv;	
	$_SESSION ['prodcd_map_csv_b'] = $prodcd_map_csv;	
	$_SESSION ['units_map_csv_b'] = $units_map_csv;		
	
	$_SESSION ['ts_b'] = $ts;
	$_SESSION ['ts_csv_b'] = $ts_csv;
	$_SESSION ['p_ts_csv_b'] = $p_ts_csv;	
	$_SESSION ['prodcd_ts_csv_b'] = $prodcd_ts_csv;	
	$_SESSION ['units_ts_csv_b'] = $units_ts_csv;	
	} 
	
	
		// return back to Parent	
	//return $query_id
	$outStr=sprintf("queryid,%d,map,%d,map_csv,%d,p_map_csv,%d,prodcd_map_csv,%s,units_map_csv,%.2f,ts,%d,ts_csv,%d,p_ts_csv,%d,prodcd_ts_csv,%s,units_ts_csv,%.2f",$qid,$map,$map_csv,$p_map_csv,$prodcd_map_csv,$units_map_csv,$ts,$ts_csv,$p_ts_csv,$prodcd_ts_csv,$units_ts_csv);
	echo($outStr);
		//echo $qid . "MorTA=".$_SESSION ['MorTA']."MorTB=".$_SESSION ['MorTB'] . "ForPA=".$_SESSION ['ForPA']."ForPB=".$_SESSION ['ForPB'] ; 
  } else  ///OBSERVED DATA REGION END
  {
  
  // echoL("Processing NOB---------");
	echoL($Selet_TB_Name);

	$daq_type=trim($_GET['typev']);
	$daq_var =trim($_GET['variable']);
	$daq_yearS=0;
	$daq_monS=0;
	$daq_yearE=0;
	$daq_monE=0;
	$avail=0;
   
	$daq = sprintf("select year,month  from ".$Selet_TB_Name."  order by year,month limit 1");
	$resdaq= mysqli_query($con,$daq);
	if ($resdaq) $rowdaq=mysqli_fetch_array($resdaq);
	if ($rowdaq)  {
		$daq_yearS= $rowdaq['year'];
	$daq_monS=$rowdaq['month'];
	$avail=1;
	}
	$daq = sprintf("select year,month  from ".$Selet_TB_Name."  order by year desc,month desc limit 1");
	$resdaq= mysqli_query($con,$daq);
	if ($resdaq)  $rowdaq=mysqli_fetch_array($resdaq);
if ($rowdaq)  {
	$daq_yearE= $rowdaq['year'];
	$daq_monE=$rowdaq['month'];
	}
   
	$daq = sprintf("INSERT INTO  data_avail (data_type,variable,yearS,monS,yearE,monE,avail)  values ('%s','%s',%d,%d,%d,%d,%d) ON DUPLICATE KEY UPDATE yearS=%d,monS=%d,yearE=%d,monE=%d,avail=%d",$daq_type,$daq_var,$daq_yearS,$daq_monS,$daq_yearE,$daq_monE,$avail,$daq_yearS,$daq_monS,$daq_yearE,$daq_monE,$avail);
	
echoL($daq."<br />");
mysqli_query( $con, $daq);
	
	
	
	
	
	
	if  ($region =="ALL") {

	$sql="select ".$statMtd."(T.value) as VAL,T.latitude, T.longitude  from  ".$Selet_TB_Name."  T  ";
	$sql = $sql . " inner join region_coord C on C.latitude= T.latitude and C.longitude=T.longitude and   C.p_name<>'' ";
	$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
	$sql = $sql . " and " . $monQ ;	
	$sql = $sql . " group by T.latitude, T.longitude ";	
	
	}
	elseif  ($region =="SELECTION")  {
	/*$sql="select T.* from p_temperature_max T  ";
	$sql = $sql . " inner join region_coord C on C.latitude= T.latitude and C.longitude=T.longitude and   C.p_name='$region' ";
	$sql = $sql . " where T.year=1980 and T.month=1";*/
	}
	else{
	$sql="select ".$statMtd."(T.value) as VAL,T.latitude, T.longitude  from  ".$Selet_TB_Name."  T  ";
	$sql = $sql . " inner join region_coord C on C.latitude= T.latitude and C.longitude=T.longitude and   C.p_name='$region' ";
	$sql = $sql . " where (T.year>=".$yearS." and T.year <=".$yearE." and T.month >=". $monS." and T.month <=". $monE .") ";
	$sql = $sql . " and " . $monQ ;	
	$sql = $sql . " group by T.latitude, T.longitude ";
	}	

	echoL($sql);	
	$res= mysqli_query($con,$sql);
	if ($_GET['task']=="a") 	$tbl_data="a_query_result";
	else $tbl_data="b_query_result";
	$sql= "INSERT INTO $tbl_data (qid,uid,row,col,sessionid,value) VALUES ";

	$x=0;
	if ($res) 
	while ( $row=mysqli_fetch_array($res)) {
	 
	 						
					//	if ($row['latitude'] ==10) {	
						if ($x >0) $sql= $sql.",";
						$sql= $sql. sprintf("(%d,'%s',%d,%d,'%s',%d)",$qid,"",$row['latitude'],$row['longitude'],$sid,$row['VAL']);
						//$qid,'',$row['id'],)";
						$x++;
					//	}
	}
	$sql= $sql."";
	echoL("<br />".$sql);
	$query = mysqli_query($con,$sql);
		
		$map=1;
		$map_csv=0;
		$p_map_csv=1;
		$prodcd_map_csv="P02";
		$units_map_csv=2;
		
		$ts=0;
		$ts_csv=0;
		$p_ts_csv=0;
		$prodcd_ts_csv="";
		$units_ts_csv=0;
		
		$sql=sprintf("update query_log set map=%d, map_csv=%d, p_map_csv=%d,prodcd_map_csv='%s',units_map_csv=%d,ts=%d,ts_csv=%d,p_ts_csv=%d,prodcd_ts_csv='%s',units_ts_csv=%d  where query_id=%d",$map,$map_csv,$p_map_csv,$prodcd_map_csv,$units_map_csv,$ts,$ts_csv,$p_ts_csv,$prodcd_ts_csv,$units_ts_csv,$qid);
	echoL($sql);
	$query = mysqli_query($con,$sql);
 
  if ($_GET['task']=="a") 	{
    $_SESSION ['queryid_a'] =$qid;
    $_SESSION ['map_a'] = $map;
	$_SESSION ['map_csv_a'] = $map_csv;
	$_SESSION ['p_map_csv_a'] = $p_map_csv;	
	$_SESSION ['prodcd_map_csv_a'] = $prodcd_map_csv;	
	$_SESSION ['units_map_csv_a'] = $units_map_csv;		
	
	$_SESSION ['ts_a'] = $ts;
	$_SESSION ['ts_csv_a'] = $ts_csv;
	$_SESSION ['p_ts_csv_a'] = $p_ts_csv;	
	$_SESSION ['prodcd_ts_csv_a'] = $prodcd_ts_csv;	
	$_SESSION ['units_ts_csv_a'] = $units_ts_csv;	
	} 
	if ($_GET['task']=="b") 	{
    $_SESSION ['queryid_b'] =$qid;
    $_SESSION ['map_b'] = $map;
	$_SESSION ['map_csv_b'] = $map_csv;
	$_SESSION ['p_map_csv_b'] = $p_map_csv;	
	$_SESSION ['prodcd_map_csv_b'] = $prodcd_map_csv;	
	$_SESSION ['units_map_csv_b'] = $units_map_csv;		
	
	$_SESSION ['ts_b'] = $ts;
	$_SESSION ['ts_csv_b'] = $ts_csv;
	$_SESSION ['p_ts_csv_b'] = $p_ts_csv;	
	$_SESSION ['prodcd_ts_csv_b'] = $prodcd_ts_csv;	
	$_SESSION ['units_ts_csv_b'] = $units_ts_csv;	
	} 
		// return back to Parent	
	//return $query_id
	$outStr=sprintf("queryid,%d,map,%d,map_csv,%d,p_map_csv,%d,prodcd_map_csv,%s,units_map_csv,%.2f,ts,%d,ts_csv,%d,p_ts_csv,%d,prodcd_ts_csv,%s,units_ts_csv,%.2f",$qid,$map,$map_csv,$p_map_csv,$prodcd_map_csv,$units_map_csv,$ts,$ts_csv,$p_ts_csv,$prodcd_ts_csv,$units_ts_csv);
	echo($outStr);
	
		//echo $qid . "MorTA=".$_SESSION ['MorTA']."MorTB=".$_SESSION ['MorTB'] . "ForPA=".$_SESSION ['ForPA']."ForPB=".$_SESSION ['ForPB'] ;

	} // not Observed
	

	mysqli_close($con);
	
	} 
  
	
?>

