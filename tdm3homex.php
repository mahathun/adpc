<?php
session_start ();
if(isset($_REQUEST['logout'])){
	$_SESSION['uid']=0;

}
unset($_SESSION ['queryid_a']);
unset($_SESSION ['p_map_csv_a']);
unset($_SESSION ['ts_csv_a']);

unset($_SESSION ['queryid_b']);
unset($_SESSION ['p_map_csv_b']);
unset($_SESSION ['p_ts_csv_b']);


include ("charts/connection.php");
require 'dbconnection.php';
$_SESSION ["sid"] = session_id ();

if (!(isset($_SESSION['uid']))) $_SESSION['uid']=0;

?>

<!DOCTYPE html>
<html ng-app="demoapp">
<head>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>home</title>
<meta name="description" content="">
<meta name="author" content="root">

<!-- Bootstrap -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="dist/js/jquery-1.10.0.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<!-- TABLE STYLES-->
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

<!-- /Bootstrap -->


<link rel="stylesheet" href="charts/datepicker3.css">
<link href="charts/charts.css" rel="stylesheet">



<link rel="stylesheet" href="dist/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="dist/css/leaflet.css" />
<link rel="stylesheet" href="dist/css/leaflet.label.css" />
<link rel="stylesheet" href="dist/css/leaflet.draw.css" />
<link rel="stylesheet" href="dist/css/leaflet.css" />
<link rel="stylesheet" type="text/css" href="dist/css/iconselect.css">


<style>
.leaflet-bottom {
	display: none;
}

.leaflet-google-layer {
	z-index: 0;
}

.leaflet-map-pane {
	z-index: 100;
}

.leaflet-control-zoom {
	left: -10px;
	top: -10px;
}

.leaflet-draw {
	left: -10px;
	top: -20px;
}
#logo-wrapper {
	position: absolute;
	left: 10px;
	bottom: 120px;
	z-index: 200;
}
.leaflet-grid-label .lng {
	margin-left: 8px;
	-webkit-transform: rotate(90deg);
	transform: rotate(90deg);
}

.leaflet-draw-draw-marker {
	display: none
}

#map-wrapper {
	position: relative;
}

#button-wrapper {
	position: absolute;
	left: 10px;
	bottom: 50px;
	background-color: green;
	color: white;
	z-index: 150;
}


/* Senaka - Style */
body {
	padding-top: 70px;
	background-color:#F5F5F5;
}
.footer-col-1 {
	padding: 15px 0px;
}

.footer-btn {
	padding: 15px 50px;
}

.hit-count {
	padding: 22px 0px;
	background: #7f7f7f;
}

.clickable,.clickableDataB {
	cursor: pointer;
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

label {
	font-weight: 600;
}

.form-horizontal .control-label {
	text-align: left !important;
	padding-top: 4px !important;
}

.form-group {
	margin-bottom: 5px !important;
}

hr {
	margin-top: 0px;
	margin-bottom: 5px;
}

.form-control {
	height: 25px !important;
	padding: 2px 4px !important;
	font-size: 12px !important;
	padding-top: 5px !important;
}

td {
	border-top: 0px solid #ddd !important;
	padding: 0px !important;
}

.panel-body {
	padding: 10px;
}

.table {
	margin-bottom: 0px;
}

.form-control {
	border-radius: 0px;
}
.navbar-inverse {
background-color: #0971A6;
border-color: #080808;
}
.navbar-inverse .navbar-nav>li>a {
	color: #fff;
}
.navbar-inverse .navbar-brand {
color: #FFF;
background: #43C4E2;
}
/* /Senaka - Style */
</style>

<script src="dist/js/lib/togeojson.js"></script>
<script src="dist/js/lib/angular.min.js"></script>
<script src="dist/js/lib/leaflet.js"></script>
<script src="dist/js/lib/leaflet.label.js"></script>
<script src="dist/js/lib/angular-leaflet-directive.min.js"></script>
<script type="text/javascript" src="dist/js/app2.js"></script>
<script src="dist/js/lib/leaflet.draw.js"></script>
<script type="text/javascript" src="dist/js/lib/iconselect.js"></script>
<script type="text/javascript" src="dist/js/lib/iscroll.js"></script>

<script>
            
        var iconSelect;
		

        window.onload = function(){

            iconSelect = new IconSelect("my-icon-select", 
                {'selectedIconWidth':207,
                'selectedIconHeight':17,
                'selectedBoxPadding':1,
                'iconsWidth':207,
                'iconsHeight':17,
                'boxIconSpace':1,
                'vectoralIconNumber':1,
                'horizontalIconNumber':2});

            var icons = [];
			icons.push({'iconFilePath':'img/colorp1.png', 'iconValue':'1'});
			icons.push({'iconFilePath':'img/colorp2.png', 'iconValue':'2'});
			icons.push({'iconFilePath':'img/colorp3.png', 'iconValue':'3'});
          
            iconSelect.refresh(icons);

        };
			//document.getElementById('my-icon-select').addEventListener('changed', function(e){
             // $scope.colorp = iconSelect.getSelectedValue();
			  // //$scope.pushValue();
			   //alert($scope.colorp);
            //});
		
            
		var qi1 = null;
		var qi2 = null;
		
         	function getQueryId(id) {
		var request2 = $.ajax({
			url: "charts/getqid.php",
			type: "POST",
						
			dataType: "JSON"
		});

		request2.done(function(msg1) {
				
			if(id<2){
				qi1 = msg1.q1;
			}else{
				qi2 = msg1.q2;
			}
			
		});

		request2.fail(function(jqXHR, textStatus) {
			alert( "Requesggt failed: " + textStatus );
		});
	}



            	function showChartsRequest(q1,q2) {
		var request = $.ajax({
			url: "charts/checkQuery.php",
			type: "POST",
			data: {
				qid1:q1,
				qid2:q2
			},			
			dataType: "JSON"
		});

		request.done(function(msg) {
			var q1lable;
			var q2lable;
			if(msg.dataType1 == "Min Temperature"){
					
					q1lable= "C";
				}
				if(msg.dataType2 == "Min Temperature"){
					q2lable = "C";
				}

				if(msg.dataType1 == "Max Temperature"){
					q1lable= "C";
				}
				if(msg.dataType2 == "Max Temperature"){
					q2lable = "C";
				}

				if(msg.dataType1 == "RainFall"){
					q1lable = "mm";
				}
				if(msg.dataType2 == "RainFall"){
					q2lable = "mm";
				}
				

			if(msg.q1 == "false" && msg.q2 == "false" ){
				alert("There are no compatible chart data available.");
			}else {
				if(msg.q1 == "true" && msg.q2 == "false"){
					loadQueryA(q1,q1lable);
					$("#qA").show();
					$("#qB").hide();

					$('#charts').modal('show');

				}
				if(msg.q1 == "false" && msg.q2 == "true"){
					loadQueryB(q2,q2lable);
					$("#qA").hide();
					$("#qB").show();
					$('#charts').modal('show');
				}
				if(msg.q1 == "true" && msg.q2 == "true"){
					loadQueryA(q1,q1lable);
					loadQueryB(q2,q2lable);
					$("#qA").show();
					$("#qB").show();
					$('#charts').modal('show');
				}

				

				$('#charts').modal('show');
			}	
		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	}
        </script>









</head>

<body>
<!-- Senaka - JS  -->
<script type="text/javascript" src="dist/js/login.js"></script>
<script>
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
});

 	$(document).ready(function(){

			$('.DataB').find('.panel-body').slideUp();
			

	});
	 	
 	$(document).on('click', '.panel-heading span.clickableDataB', function(e){
 	    var $this = $(this);
 	   if(!$this.hasClass('panel-collapsed')) {
 			$this.parents('.panel').find('.panel-body').slideDown();
 			$this.addClass('panel-collapsed');
 			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
 		} else {
 			$this.parents('.panel').find('.panel-body').slideUp();
 		
 			$this.removeClass('panel-collapsed');
 			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
 		}
 	  
 		
 	});
    function savemap()
		{
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById('map-wrapper').innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
		}

</script>
<!-- /Senaka - JS  -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" rel="home" href="#"><span
				class="glyphicon glyphicon-home"></span></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> User Guide <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Link1</a></li>
						<li><a href="#">Link2</a></li>
						<li class="divider"></li>
						<li><a href="#">Link3</a></li>
						<li class="divider"></li>
						<li><a href="#">Link4</a></li>
					</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Purchase Data <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#data_available" onclick="loadDataAvailable()" role="button" data-toggle="modal">Data Availability</a></li>	
						<?php 
						if($_SESSION['uid']!=0){
						?>
						<li><a href="cart/currentpurchase.php" target="_blank">Current Purchase</a></li>
						<?php
						}else{
						?>
						<li><a href="#">Current Purchase</a></li>
						<?php
						}
						?>
						<?php 
						if($_SESSION['uid']!=0){
						?>
						<li><a href="cart/purchasehistroy.php" target="_blank">Purchase Histroy</a></li>
						<?php
						}else{
						?>
						<li><a href="#">Purchase Histroy</a></li>
						<?php
						}
						?>
						
				</ul></li>
					<li><a href="#termsModal" role="button" data-toggle="modal"><span class="glyphicon glyphicon-book"></span> Terms of use</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-globe"></span> Language</a></li>
			</ul>
			<div class="col-sm-3 col-md-3 pull-right">
				<ul class="nav navbar-nav navbar-right">
					
					<?php 
						if($_SESSION['uid']!=0){
						$fetchusername=mysql_fetch_array(mysql_query("SELECT * FROM $tbl_cart_user_login INNER JOIN $tbl_cart_user_info ON $tbl_cart_user_login.uid=$tbl_cart_user_info.uid WHERE $tbl_cart_user_login.uid='$_SESSION[uid]'"));
						
					?>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome ! <?php echo $fetchusername['name'];?></a></li>
					<li><a href="#"> | </a></li>
					<li><a href="homex.php?logout" class="btn-link btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					<?php
						}else{
					?>
					<li><a href="#loginModal" role="button" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php
						}
					?>
					
					
	
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div ng-controller="GoogleMapsController">
			<script type="text/javascript">
var sid='<?php if(isset($_SESSION['sid'])){echo $_SESSION['sid'];} ?>';
var uid=<?php if(isset($_SESSION['uid'])){echo $_SESSION['uid'];} ?>;
</script>

			<!--left-->
			<div class="col-md-2">
				<form action="" role="form">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Map Layers</h3>
							<span class="pull-right clickable"><i
								class="glyphicon glyphicon-chevron-up"></i></span>
						</div>

						<div class="panel-body">
						<div class="form-group">
                                            <label><strong>Base Layer</strong></label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="basetype" ng-click="changeTiles('OSMMapnik')" checked> Streets
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                   <input type="radio" name="basetype" ng-click="changeTiles('Landscape')">Landscape
                                                </label>
                                            </div>
                                        </div>
						
						<hr color="#0033FF" size="3">
							
							<div class="form-group">
                                            <label><strong>Overlays</strong></label>
							<div class="checkbox">
                                                <label>
                                                   <input type="checkbox" name="layers"
									ng-click="addTiles('Provinces',95)"> Provinces
                                                </label>
                                            </div>
                            <div class="checkbox">
                                                <label>
                                                   <input type="checkbox" name="layers" id="PNames"
									ng-click="addTiles('PNames',97)" />Province Names
                                                </label>
                                            </div>
                            <div class="checkbox">
                                                <label>
                                                   <input type="checkbox" name="layers" id="Stations"
									ng-click="addTiles('Stations',96)" />Station List
                                                </label>
                                            </div>
                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="layers" id="Grid"
									ng-click="addTiles('Grid',94)" />Grid
                                                </label>
                                            </div>
                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="layers" id="QuaryR"
									ng-click="addTiles('QuaryR',93)" />Query Result
                                                </label>
                                            </div>
                          </div>
                          
                            <div class="col-sm-3">
                            	<label class="radio-inline"><input type="radio" name="layers" ng-click="getTask('a')" id="radioA"  />A</label>
							</div>
							<div class="col-sm-3">
								<label class="radio-inline"><input type="radio" name="layers" ng-click="getTask('b')" id="radioB" />B</label>
							</div>
							<div class="col-sm-3">
								<label class="radio-inline"><input type="radio" name="layers" ng-click="displayAB()" id="radioAB" />AB</label>
                            </div>
						</div>

					</div>
				</form>


				<form action="" role="form">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title text-center">
								Charts and Downloads<br/>for Selected Places
							</h3>
							<span class="pull-right clickable"><i
								class="glyphicon glyphicon-chevron-up"></i></span>
						</div>

						<div class="panel-body text-center">
							<div class="row">
							
							 <div class="col-md-12" style="margin-top:10px;">
							 		a{{queryid_a}},b{{queryid_b}}
							 		<button style="width:120px;" class="btn btn-primary btn-sm" onclick="getQueryId(1);getQueryId(2);showChartsRequest({{queryid_a}},{{queryid_b}});" id="showchart">Show Chart</button>
							
							  </div>
							  <div class="col-md-12" style="margin-top:10px;">
							 <!-- <a href="#cartModal" onclick="AddtoCart()" role="button" data-toggle="modal" style="width:120px;" class="btn btn-success btn-sm" id="mapdata">Map Data (CSV)</a>-->
							  <button data-target="#cartModal" onclick="AddtoCartMAPCSV()" role="button" data-toggle="modal" style="width:120px;" class="btn btn-success btn-sm" id="mapdata">Map Data (CSV)</button>
							 </div>
							 
							  <div class="col-md-12" style="margin-top:10px;">
							  <button style="width:120px;" class="btn btn-danger btn-sm" onclick="savemap()" id="printmap">Print Map</button>
							  </div>
							  
							  <div class="col-md-12" style="margin-top:10px;">
							   <button data-target="#TimeModal" onclick="AddtoCartTIMECSV()" role="button" data-toggle="modal" style="width:120px;" class="btn btn-warning btn-sm timeSeriesDownload" id="timeseries"> Time Series (CSV)</button>
							   </div>
							 
							</div>
						</div>
					</div>
				</form>




			</div>

			<!--/left-->



			<div class="col-md-4">
				<!--right-->
				<!--center-->
				<form action="" class="form-horizontal" role="form">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Data (A)</h3>
							<span class="pull-right clickable"><i
								class="glyphicon glyphicon-chevron-up"></i></span>
						</div>

						<div class="panel-body">

								<div class="form-group">
							
							<label class="col-sm-2 control-label">Type</label>
								<div class="col-sm-4">
									<select ng-model="type_a" class="form-control col-sm-8"  ng-change="onchangetypeA()">
										<option value="--">--</option>
										<option value="Observed">Observed</option>
										<option value="Gridded">Gridded</option>
										<option value="Projected_Raw">Projected (Raw)</option>
										<option value="Projected_Bias">Projected (Bias Corrected)</option>
									</select>
								</div>
								
								<label class="col-sm-2 control-label">Variable</label>
								<div class="col-sm-4">
									<select ng-model="variable_a" class="form-control col-sm-8" ng-options="o as o for o in listvariable_a " ng-change="loadAvailability('a');">

									</select>
								</div>

								</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">{{station_province_a}}</label>
								<div class="col-sm-4">
									<select ng-model="selextedArea_a" class="form-control" ng-options="o as o for o in liststations_a">
										
									</select>
								</div>
								<label class="col-sm-2 control-label">Resolution</label>
								<div class="col-sm-4">
									<select ng-model="resolution_a" class="form-control col-sm-2" id="resolution_gui_a">
										<option value="--">--</option>
										<option value="25">25 KM</option>
										<option value="50">50 KM</option>
									</select>
								</div>
							</div>

							<hr>
							<p>Models (for Projected Data Only)</p>

							<div class="form-group">

								<label class="col-sm-1 control-label">RCM</label>
								<div class="col-sm-3">
									<select ng-model="rcm_a" class="form-control col-sm-8" id="rcm_gui_a">
										<option value="--">--</option>
										<option value="PRECIS">PRECIS</option>
									</select>
								</div>

								<label class="col-sm-1 control-label">GCM</label>
								<div class="col-sm-3">
									<select ng-model="gcm_a" class="form-control col-sm-8" id="gcm_gui_a">
										<option value="--">--</option>
										<option value="ECHAM5">ECHAM5</option>
										<option value="HadCM3Q0">HadCM3Q0</option>
									</select>
								</div>

								<label class="col-sm-2 control-label">Scenario</label>
								<div class="col-sm-2">
									<select ng-model="scenario_a" class="form-control col-sm-2" id="senario_gui_a">
										<option value="">--</option>
										<option value="A1B">A1B</option>
									</select>
								</div>


							</div>

							<hr>

							<div class="form-group">
								<label class="col-sm-3 control-label">Statistics</label>
								<div class="col-sm-3">
									<select ng-model="statistics_a" class="form-control col-sm-2">
										<option value="--">--</option>
										<option value="Annual Mean">Annual Mean</option>
										<option value="Average">Average</option>
										<option value="Count">Count</option>
										<option value="Max">Max</option>
										<option value="Min">Min</option>
										<option value="Standard Deviation">Standard Deviation</option>
										<option value="Sum">Sum</option>
									</select>
								</div>





							</div>
							<hr>
							<div class="form-group">
								<label class="col-sm-2 control-label">Period</label> 
								<label class="col-sm-2 control-label" style="width: 8.66666667%;padding-left: 5px;padding-right: 5px;">From</label>
								<div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;">
									<select ng-model="yearf_a" class="form-control" id="yearf_a">
									<option value="">--</option>
									
									</select>
								</div>
								<div class="col-sm-2" style="padding-left: 5px;padding-right: 5px;width: 12.66666667%;">
									<select ng-model="MonS_a" class="form-control">
									<option value="">--</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
									</select>
								</div>
								<label class="col-sm-1 control-label" style="width: 5.33333333%;padding-left: 5px; padding-right: 5px;">To</label>
								<div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;">
									<select class="form-control" ng-model="yeart_a" id="yeart_a">
									<option value="">--</option>
									
									</select>
								</div>
								<div class="col-sm-2" style="padding-left: 5px;padding-right: 5px;width: 12.66666667%;">
									<select ng-model="MonE_a" class="form-control">
									<option value="">--</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
									</select>
								</div>


							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<table class="table Months">
										<tbody>
											<tr>
												<td style="width: 90px; font-size: 12">All Months</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">F</td>
												<td style="width: 30px;">M</td>
												<td style="width: 30px;">A</td>
												<td style="width: 30px;">M</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">A</td>
												<td style="width: 30px;">S</td>
												<td style="width: 30px;">O</td>
												<td style="width: 30px;">N</td>
												<td style="width: 30px;">D</td>
											</tr>
											<tr>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="month_a" id="month_a" ng-click="AllmonthcallA()" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJAN_a" id="monthJANA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthFEB_a" id="monthFEBA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthMAR_a" id="monthMARA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthAPR_a" id="monthAPRA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthMAY_a" id="monthMAYA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJUN_a" id="monthJUNA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJUL_a" id="monthJULA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthAUG_a" id="monthAUGA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthSEP_a" id="monthSEPA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthOCT_a" id="monthOCTA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthNOV_a" id="monthNOVA" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthDEC_a" id="monthDECA" /></td>

											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-sm-3"
									style="text-align: left; padding-top: 5px; padding-right: 5px">
									<button class="btn btn-primary btn-md" style="font-size: 12px"
										 ng-click="insertdata_a('a');" id="EvaluateA">Evaluate</button>

								</div>
							</div>


						</div>


					</div>
				</form>

				<form action="" class="form-horizontal" role="form">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Data (B)</h3>
							<span class="pull-right clickable"><i
								class="glyphicon glyphicon-chevron-up"></i></span>
						</div>
						<div class="panel-body">

							<div class="form-group">
							
							<label class="col-sm-2 control-label">Type</label>
								<div class="col-sm-4">
									<select ng-model="type_b" class="form-control col-sm-8" ng-change="onchangetypeB()">
										<option value="--">--</option>
										<option value="Observed">Observed</option>
										<option value="Gridded">Gridded</option>
										<option value="Projected_Raw">Projected (Raw)</option>
										<option value="Projected_Bias">Projected (Bias Corrected)</option>
									</select>
								</div>
								
								<label class="col-sm-2 control-label">Variable</label>
								<div class="col-sm-4">
									<select ng-model="variable_b" class="form-control col-sm-8" ng-options="o as o for o in listvariable_b" ng-change="loadAvailability('b');">
										

									</select>
								</div>

								




							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">{{station_province_b}}</label>
								<div class="col-sm-4">
									<select ng-model="selextedArea_b" class="form-control" ng-options="o as o for o in liststations_b">
										
									</select>
								</div>
								<label class="col-sm-2 control-label">Resolution</label>
								<div class="col-sm-4">
									<select ng-model="resolution_b" class="form-control col-sm-2" id="resolution_gui_b">
										<option value="--">--</option>
										<option value="25">25 KM</option>
										<option value="50">50 KM</option>
									</select>
								</div>
							</div>

							<hr>
							<p>Models (for Projected Data Only)</p>

							<div class="form-group">

								<label class="col-sm-1 control-label">RCM</label>
								<div class="col-sm-3">
									<select ng-model="rcm_b" class="form-control col-sm-8" id="rcm_gui_b">
										<option value="--">--</option>
										<option value="PRECIS">PRECIS</option>
									</select>
								</div>

								<label class="col-sm-1 control-label">GCM</label>
								<div class="col-sm-3">
									<select ng-model="gcm_b" class="form-control col-sm-8" id="gcm_gui_b">
										<option value="--">--</option>
										<option value="ECHAM5">ECHAM5</option>
										<option value="HadCM3Q0">HadCM3Q0</option>
									</select>
								</div>

								<label class="col-sm-2 control-label">Scenario</label>
								<div class="col-sm-2">
									<select ng-model="scenario_b" class="form-control col-sm-2" id="senario_gui_b">
										<option value="--">--</option>
										<option value="A1B">A1B</option>
									</select>
								</div>


							</div>

							<hr>

							<div class="form-group">
								<label class="col-sm-3 control-label">Statistics</label>
								<div class="col-sm-3">
									<select ng-model="statistics_b" class="form-control col-sm-2">
										<option value="--">--</option>
										<option value="Annual Mean">Annual Mean</option>
										<option value="Average">Average</option>
										<option value="Count">Count</option>
										<option value="Max">Max</option>
										<option value="Min">Min</option>
										<option value="Standard Deviation">Standard Deviation</option>
										<option value="Sum">Sum</option>
									</select>
								</div>





							</div>
							<hr>
							<div class="form-group">
								<label class="col-sm-2 control-label">Period</label> 
								<label class="col-sm-2 control-label" style="width: 8.66666667%;padding-left: 5px;padding-right: 5px;">From</label>
								<div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;">
									<select ng-model="yearf_b" class="form-control" id="yearf_b">
									<option value="">--</option>
									
									</select>
								</div>
								<div class="col-sm-2" style="padding-left: 5px;padding-right: 5px;width: 12.66666667%;">
									<select ng-model="MonS_b" class="form-control">
									<option value="">--</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
									</select>
								</div>
								<label class="col-sm-1 control-label" style="width: 5.33333333%;padding-left: 5px; padding-right: 5px;">To</label>
								<div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;">
									<select class="form-control" ng-model="yeart_b" id="yeart_b">
									<option value="">--</option>
									
									</select>
								</div>
								<div class="col-sm-2" style="padding-left: 5px;padding-right: 5px;width: 12.66666667%;">
									<select ng-model="MonE_b" class="form-control">
									<option value="">--</option>
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
									</select>
								</div>


							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<table class="table Months">
										<tbody>
											<tr>
												<td style="width: 90px; font-size: 12">All Months</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">F</td>
												<td style="width: 30px;">M</td>
												<td style="width: 30px;">A</td>
												<td style="width: 30px;">M</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">J</td>
												<td style="width: 30px;">A</td>
												<td style="width: 30px;">S</td>
												<td style="width: 30px;">O</td>
												<td style="width: 30px;">N</td>
												<td style="width: 30px;">D</td>
											</tr>
											<tr>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="month_b" id="month" ng-click="AllmonthcallB()" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJAN_b" id="monthJANB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthFEB_b" id="monthFEBB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthMAR_b" id="monthMARB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthAPR_b" id="monthAPRB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthMAY_b" id="monthMAYB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJUN_b" id="monthJUNB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthJUL_b" id="monthJULB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthAUG_b" id="monthAUGB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthSEP_b" id="monthSEPB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthOCT_b" id="monthOCTB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthNOV_b" id="monthNOVB" /></td>
												<td><input type="checkbox" ng-true-value=1 ng-false-value=0
													ng-model="monthDEC_b" id="monthDECB" /></td>

											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-sm-3"
									style="text-align: left; padding-top: 5px; padding-right: 5px">
									<button class="btn btn-primary btn-md" style="font-size: 12px"
										ng-click="insertdata_b('b');" id="EvaluateB">Evaluate</button>

								</div>
							</div>


						</div>
					</div>
			
			</div>


			</form>





			<!--/right-->
			<!--/center-->


			<div class="col-md-6">
				<!--right-->


				<div id="map-wrapper"
					class="embed-responsive embed-responsive-16by9 thumbnail">
					<div id="map" style="height: 600px" class="embed-responsive-item"></div>

					<script src="dist/js/map/provinces.js" type="text/javascript"></script>
					<script src="dist/js/map/gridlines.js" type="text/javascript"></script>
					<script src="dist/js/map/area.js"></script>

					<div id="colour-palette">
						<div id="button-wrapper">
							<div class="btnStyle span3" width="310px">
								<table width="220px">
									<tr>
										<td width="30px"><input size="5" ng-model="minrange" value=0
											style="background-color: #222; border: 1px solid #888; color: white; margin: 0px; padding: 0px; width: 30px"></td>
										<td width="160px"
											style="background-color: #222; border: 1px solid #888; color: white; margin: 0px; padding: 0px; text-align: center">{{units}}</td>
										<td width="30px"><input size="255" ng-model="maxrange"
											value="255"
											style="background-color: #222; border: 1px solid #888; color: white; margin: 0px; padding: 0px; width: 30px"></td>
									</tr>
									<tr>
										<td width="220px" colspan="3">
											<div id="my-icon-select" ng-click="changeColorP()"></div>
										</td>
									</tr>
									<tr>
										<td width="220px" colspan="3"
											style="background-color: #FFFFFF; color: black; font-size: 10px">Query : {{query_display}}
										</td>
									</tr>
								</table>
							</div>

						</div>
					</div>
					<div id="logo">
						<div id="logo-wrapper">
							<div class="btnStyle span3" width="310px">
								<img src="img/logo1.png" style="width:80px">
							</div>

						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-8">
						<div class="col-md-3">
							<img src="http://placehold.it/70x60" alt="..."
								class="img-thumbnail">
						</div>
						<div class="col-md-3">
							<img src="http://placehold.it/70x60" alt="..."
								class="img-thumbnail">
						</div>
						<div class="col-md-3">
							<img src="http://placehold.it/70x60" alt="..."
								class="img-thumbnail">
						</div>
						<div class="col-md-3">
							<img src="http://placehold.it/70x60" alt="..."
								class="img-thumbnail">
						</div>

					</div>
					<div class="col-md-4">
						<p class="text-center hit-count">Hit Counter</p>
					</div>

				</div>

			</div>
			<!--/right-->
		</div>
	</div>
	</div>
	<!--/container-fluid-->

<!--charts modal-->
	<div id="charts" class="modal fade" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h2 class="text-center">Observed Data</h2>
				</div>
				<div class="modal-body">


					<div class="" id="main-container">
						<!-- <div class="row well">
							<div class="col-md-12">

								<div class="col-md-4">
									<div class="btn-group">
										<a class="btn btn-primary dropdown-toggle"
											data-toggle="dropdown" href="#">Station<span class="caret"></span></a>
										<ul class="dropdown-menu">

											<li><a href="#" onClick="filterStation(null)">All</a></li>
											<li class="divider"></li>

														<?php
														
														$stations = mysql_query ( "SELECT * FROM `stations` ORDER BY name" );
														$i = 1;
														
														while ( $row = mysql_fetch_array ( $stations ) ) {
															echo '<li><a href="#" onclick="filterStation(' . $row ['id'] . ')">' . $row ['name'] . '</a></li>';
															
															// echo;
															// $date1=$GetStationData['Year']."-".$GetStationData['Month'];
														}
														
														?>



													</ul>
									</div>

								</div>


								<div class="col-md-4">
									<div class="input-daterange input-group" id="datepicker">

										<input type="text" class="input-sm form-control" name="start"
											id="start"> <span class="input-group-addon"
											style="padding-top: 0px; padding-bottom: 0px;">to</span> <input
											type="text" class="input-sm form-control" name="end" id="end">
									</div>
								</div>


								<div class="col-md-4">
									<button type="button" class="btn btn-primary btn-sm"
										onClick="filter(document.getElementById('start').value,document.getElementById('end').value)">Draw</button>
									<button type="button" class="btn btn-danger btn-sm"
										onClick="filter(null,null);filterStation(null);reset();">Reset</button>
									<button type="button" class="btn btn-danger btn-sm"
										onClick="loadQueryA(1);loadQueryB(1);">load</button>
								</div>
							</div>
						</div> -->
						<div class="row">
							<div id="qA" class="col-md-12 ">
								<span class="label label-primary">Data A</span>
								<div id="tmax" class="chart-container"></div>

								&nbsp;
							</div>
							<div id="qB" class="col-md-12 ">
								<span class="label label-warning">Data B</span>
								<div id="tmin" class="chart-container"></div>

								&nbsp;
							</div>
							<!-- <div class="col-md-12 ">
								<span class="label label-default">Rain Fall</span>
								<div id="rf" class="chart-container"></div>
								&nbsp;
							</div> -->

						</div>

					</div>
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Senaka -->
	<!--login modal-->
	<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Sign in</h4>
			</div>
			<div class="modal-body">
				<form id="login_form" class="form" role="form" method="post" action="">
					<fieldset>
						<div class="form-group">
							<label><strong>Username</strong></label> 
							<input style="height: 50px !important;" class="form-control" id="LoginUname" required="required" placeholder="Your Username" type="text" autofocus="">
						</div>
						<div class="form-group">
							<label><strong>Password</strong> <a href="cart/forgotpassword.php">(forgot password)</a></label> 
							<input style="height: 50px !important;" class="form-control" id="LoginPsw" required="required" placeholder="Password" type="password" value="">
						</div>
						Don't have an account? <a href="cart/signup.php" data-toggle="modal" id="">Register now</a>
						<button type="submit" class="btn btn-success pull-right" id="" style="margin:10px 0px;">Sign in</button>
					</fieldset>
				</form>
				<hr />
				<div class="form-group">
					<div id="signin_status"></div>
				</div>
			</div>
		</div>
	</div>
</div>

	<!--Map Data modal-->

	<div class="modal fade" id="cartModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Map Data (CSV)</h4>
			</div>
			<div class="modal-body" id="mapout">

				
					

				<hr />
			</div>
		</div>
	</div>
</div>

<!--Time Series modal-->

	<div class="modal fade" id="TimeModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Time Series (CSV)</h4>
			</div>
			<div class="modal-body" id="timeout">

				
					

				<hr />
			</div>
		</div>
	</div>
</div>
<!--datavisible-->
	<div class="modal fade" id="data_available" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Data Availability</h4>
			</div>
			<div class="modal-body" id="view_data_avail">

			</div>
		</div>
	</div>
</div>

<!--Terms of use-->
	<div id="termsModal" class="modal fade" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h2 class="text-left">Terms of use</h2>
				</div>
				<div class="modal-body"></div>

			</div>
		</div>
	</div>

<!-- /Senaka -->
	
	



	<!-- load the d3.js library -->
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script type="text/javascript"
		src="//cdnjs.cloudflare.com/ajax/libs/crossfilter/1.3.7/crossfilter.min.js"></script>

	<!-- drawing the chart -->
	<script src="charts/chart.js"></script>

<script src="charts/bootstrap-datepicker.js"></script>

	<script type="text/javascript">
            
 $(".dropdown-menu li a").click(function(){
                  var selText = $(this).text();
                  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
                });


$(document).ready(function () {
                
                $('#datepicker .input-sm').datepicker({
                    format: "yyyy-mm-dd",
                    todayBtn: "linked",
                    todayHighlight: true,
                    startDate: "1987-1-1",
                    startView: 2,
					minViewMode:1,
                    autoclose: true
                });  
            
            });
function reset(){
    
                  var selText = "Select a Station";
                  $(".dropdown-menu li a").parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
                
}
           
            

        </script>
        
        <!-- DATA TABLE SCRIPTS -->
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
	<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script>
            $(document).ready(function () {
                $('#data_available_table').dataTable();
            });
    </script>

</body>
</html>
