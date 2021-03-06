<?php

include("charts/connection.php");

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
	<link rel="stylesheet" href="charts/datepicker3.css">
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="charts/charts.css" rel="stylesheet">
	<link rel="stylesheet" href="dist/css/style.css" type="text/css"
		media="all" />
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

.form-control {
	border-radius: 0px;
}
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


<script src="dist/js/map/provinces.js" type="text/javascript"></script>
<script src="dist/js/map/gridlines.js" type="text/javascript"></script>
<script src="dist/js/map/area.js"></script>

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
		
            
        </script>



<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
<style>
body {
	padding-top: 70px;
}
</style>

<script src="dist/js/jquery-1.10.0.min.js"></script>

<script src="dist/js/bootstrap.min.js"></script>
<style>
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
	padding-top:4px !important;
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
</style>

</head>

<body>
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
 	</script>

	<script>
 	$(document).ready(function(){
 		//$this.parents('.panel').find('.panel-body').slideUp();
			$('.DataB').find('.panel-body').slideUp();
			
			//$('.DataB').addClass('panel-collapsed');
			//$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

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
 	//$(function() {
 	 //   $("#colour-palette").draggable();
 	 // });
 	</script>

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
					data-toggle="dropdown">User Guide <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Link1</a></li>
						<li><a href="#">Link2</a></li>
						<li class="divider"></li>
						<li><a href="#">Link3</a></li>
						<li class="divider"></li>
						<li><a href="#">Link4</a></li>
					</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown">Purchase Data <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Link1</a></li>
						<li><a href="#">Link2</a></li>
						<li class="divider"></li>
						<li><a href="#">Link3</a></li>
						<li class="divider"></li>
						<li><a href="#">Link4</a></li>
					</ul></li>
			</ul>
			<div class="col-sm-3 col-md-3 pull-right">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#loginModal" role="button" data-toggle="modal">Login</a></li>
					<li><a href="#">Language</a></li>
					<li><a href="#termsModal" role="button" data-toggle="modal">Terms
							of use</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div ng-controller="GoogleMapsController">

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
                        	 <b>  Base Layer  </b>
							<div  style="padding-left:3em;" class="radio">
								<label> <input type="radio" name="basetype"
									ng-click="changeTiles('OSMMapnik')" checked> Streets
								</label>
							</div>
						
                        	<div style="padding-left:3em;" class="radio">
								<label> <input type="radio" name="basetype"
									ng-click="changeTiles('Landscape')">Landscape
								</label>
							</div>
                            <hr color="#0033FF" size="3">
                           <b> Overlays </b>
                            <div style="padding-left:3em;" class="checkbox">
								<label> <input type="checkbox" name="layers"
									ng-click="addTiles('Provinces',95)"> Provinces
								</label>
							</div>
							<div style="padding-left:3em;" class="checkbox">
								<label><input type="checkbox" name="layers"
									ng-click="addTiles('PNames',97)" />Province Names</label>
							</div>
							<div style="padding-left:3em;" class="checkbox">
								<label><input type="checkbox" name="layers"
									ng-click="addTiles('Stations',96)" />Station List</label>
							</div>
							<div style="padding-left:3em;" class="checkbox">
								<label><input type="checkbox" name="layers"
									ng-click="addTiles('Grid',94)" />Grid</label>
							</div>
							<div style="padding-left:3em;" class="checkbox">
								<label><input type="checkbox" name="layers"
									ng-click="addTiles('QuaryR',93)" />Query Result</label>
							</div>
                            
                            <!--option button-->
                            <div style="padding-left:4em;" class="checkbox">
								<label><input type="radio" name="layers"/>A</label>
                                <label><input type="radio" name="layers"/>B</label>
                                <label><input type="radio" name="layers"/>AB</label>
							</div>
                            <!--option button-->
                            
                            
						</div>
                        
					</div>
				</form>
                
                
                <form action="" role="form">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Charts and Downloads - for Selected Places</b></h3>
							<span class="pull-right clickable"><i
								class="glyphicon glyphicon-chevron-up"></i></span>
						</div>

						<div class="panel-body">
                        	

                        <p class="text-center">
                            <button style="width:100px; border-radius:10px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#charts">Show Chart</button>                      		 <button style="width:140px; border-radius:10px;" class="btn btn-primary btn-md">Map Data (CSV)</button>
                           
                       </p>






                       <!--charts modal-->
	<div id="charts" class="modal fade" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h2 class="text-center">
						Observed Data
					</h2>
				</div>
				<div class="modal-body">


					<div class="" id="main-container">
								<div class="row well">
									<div class="col-md-12">
										
											<div class="col-md-4">
												<div class="btn-group">
													<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">Station<span class="caret"></span></a>
													<ul class="dropdown-menu">

														<li><a href="#" onClick="filterStation(null)">All</a></li>
														<li class="divider"></li>

														<?php




														$stations=mysql_query("SELECT * FROM `stations` ORDER BY name");
														$i=1;

														while ($row=mysql_fetch_array($stations)){
															echo '<li><a href="#" onclick="filterStation('.$row['id'].')">'. $row['name'].'</a></li>';

                               // echo;
                                    //$date1=$GetStationData['Year']."-".$GetStationData['Month'];
														}

														?>



													</ul>
												</div>

											</div>
											

											<div class="col-md-4">
												<div class="input-daterange input-group" id="datepicker">

													<input type="text" class="input-sm form-control" name="start" id="start">
													<span class="input-group-addon" style="padding-top:0px;padding-bottom:0px;">to</span>
													<input type="text" class="input-sm form-control" name="end" id="end">
												</div>
											</div>
										

										<div class="col-md-4">
											<button type="button" class="btn btn-primary btn-sm" onClick="filter(document.getElementById('start').value,document.getElementById('end').value)">Draw</button>
											<button type="button" class="btn btn-danger btn-sm" onClick="filter(null,null);filterStation(null);reset();">Reset</button>
										</div>
									</div>
								</div>



								<div class="row">
									<div class="col-md-12 "  >
										<span class="label label-primary">Maximum Temperature</span>
										<div id="tmax" class="chart-container">

										</div>        

										&nbsp;
									</div>
									<div class="col-md-12 "  >
										<span class="label label-warning">Minimum Temperature</span>
										<div id="tmin" class="chart-container">

										</div>        

										&nbsp;
									</div>
									<div class="col-md-12 " >
										<span class="label label-default">Rain Fall</span>
										<div id="rf" class="chart-container">

										</div>
										&nbsp;
									</div>

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




















                        
                        <p class="text-center">
                             <button style="width:100px; border-radius:10px;" class="btn btn-primary btn-md">Print Map</button>
                            <button  style="width:140px; border-radius:10px;" class="btn btn-primary btn-md">Time Series (CSV)</button>
                        </p>

							</div>
					</div>
				</form>

				

				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Current Data Selection</h3>
						<span class="pull-right clickable"><i
							class="glyphicon glyphicon-chevron-up"></i></span>
					</div>

					<div class="panel-body">
                        
                        
            <table class="table Months" bordercolor="#FFFFFF" border="1">
            <tbody>
            <tr>
            <td>Variable : </td> <td bgcolor="#999999">Precipitation </td>
            </tr>
            
            <tr>
            <td>Type : </td> <td bgcolor="#999999">Projected (Raw) </td>
            </tr>
            
            
            <tr>
            <td>Resolution : </td> <td bgcolor="#999999">25 km  </td>
            </tr>
            
            
            <tr>
            <td>RCM : </td> <td bgcolor="#999999">PRECIS </td>
            </tr>
            
            
            <tr>
            <td>GCM : </td> <td bgcolor="#999999">HadCM3Q0 </td>
            </tr>
            
            
            <tr>
            <td>Scenario : </td> <td bgcolor="#999999">A1B </td>
            </tr>
            
            
            <tr>
            <td>Statistic : </td> <td bgcolor="#999999">Annual Mean </td>
            </tr>
            
            
            <tr>
            <td>Year(s)  : </td> <td bgcolor="#999999">1970 - 2000 and 2030 - 2060 </td>
            </tr>
            
            
            <tr>
            <td>Month(s) : </td> <td bgcolor="#999999">All </td>
            </tr>
            
            </tbody>
            </table>
                                
                    </div>
				</div>
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
								<label class="col-sm-2 control-label">Variable</label>
								<div class="col-sm-4">
									<select ng-model="variable" ng-change="getTask()"
										class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">Precipitation</option>
										<option value="temp1980JAN">Min Temperature</option>
										<option value="">Max Temperature</option>
										<option value="">Mean Temperature</option>
										<option value="">Surface Wind</option>
										<option value="">Surface Pressure</option>
										<option value="">Relative Humidity</option>
										<option value="rf1980JAN">RainFall</option>

									</select>
								</div>

								<label class="col-sm-2 control-label">Type</label>
								<div class="col-sm-4">
									<select ng-model="type" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">Observed</option>
										<option value="">Gridded</option>
										<option value="">Projected (Raw)</option>
										<option value="">Projected (Bias Corrected)</option>
									</select>
								</div>




							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Province</label>
								<div class="col-sm-4">
									<select ng-model="selextedArea" ng-change="pushValue()"
										class="form-control">
										<option value="ALL">ALL</option>
										<option value="AYEYARWADY">AYEYARWADY</option>
										<option value="BAGO">BAGO</option>
										<option value="CHIN">CHIN</option>
										<option value="KACHIN">KACHIN</option>
										<option value="KAYAH">KAYAH</option>
										<option value="KAYIN">KAYIN</option>
										<option value="MAGWE">MAGWE</option>
										<option value="MANDALAY">MANDALAY</option>
										<option value="MON">MON</option>
										<option value="RAKHAING">RAKHAING</option>
										<option value="SAGAING">SAGAING</option>
										<option value="SHAN">SHAN</option>
										<option value="TANINTHARYI">TANINTHARYI</option>
										<option value="YANGON">YANGON</option>
										<option value="SELECTION">SELECTION</option>
									</select>
								</div>
								<label class="col-sm-2 control-label">Resolution</label>
								<div class="col-sm-4">
									<select ng-model="resolution" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">25 KM</option>
										<option value="">50 KM</option>
									</select>
								</div>
							</div>

							<hr>
							<p>Models (for Projected Data Only)</p>

							<div class="form-group">

								<label class="col-sm-1 control-label">RCM</label>
								<div class="col-sm-3">
									<select ng-model="rcm" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">PRECIS</option>
									</select>
								</div>

								<label class="col-sm-1 control-label">GCM</label>
								<div class="col-sm-3">
									<select ng-model="gcm" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">ECHAM5</option>
										<option value="">HadCM3Q0</option>
									</select>
								</div>

								<label class="col-sm-2 control-label">Scenario</label>
								<div class="col-sm-2">
									<select ng-model="scenario" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">A1B</option>
									</select>
								</div>


							</div>

							<hr>

							<div class="form-group">
								<label class="col-sm-3 control-label">Statistics</label>
								<div class="col-sm-3">
									<select ng-model="statistics" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">Annual Mean</option>
										<option value="">Average</option>
										<option value="">Count</option>
										<option value="">Max</option>
										<option value="">Min</option>
										<option value="">Standard Deviation</option>
										<option value="">Sum</option>
									</select>
								</div>

								<label class="col-sm-3 control-label">Region Filter</label>
								<div class="col-sm-3">
									<select ng-model="statistics" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">Ayeyarwady</option>
										<option value="">Bago</option>
										<option value="">Chin</option>
										<option value="">Kachin</option>
										<option value="">Kayah</option>
										<option value="">Kayin</option>
										<option value="">Magway</option>
										<option value="">Mandalay</option>
										<option value="">Mon</option>
										<option value="">Rakhine</option>
										<option value="">Sagaing</option>
										<option value="">Shan</option>
										<option value="">Tanintharyi</option>
										<option value="">Yangon</option>
									</select>
								</div>



							</div>
							<hr>
							<div class="form-group">
								<label class="col-sm-3 control-label">Period</label> <label
									class="col-sm-2 control-label">From</label>
								<div class="col-sm-3">
									<select ng-model="year" class="form-control">
										<option value="1980">1980</option>
									</select>
								</div>
								<label class="col-sm-1 control-label">To</label>
								<div class="col-sm-3">
									<select class="form-control">
										<option value="1980">1980</option>
									</select>
								</div>


							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"><div class="checkbox">
										<label>All Months<input type="checkbox"></label>
									</div>

								</label>

								<div class="col-sm-9">
									<table class="table Months">
										<tbody>
											<tr>
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
												<td>D</td>
											</tr>
											<tr>
												<td><input type="checkbox" value="JAN" ng-model="month" /></td>
												<td><input type="checkbox" value="FEB" /></td>
												<td><input type="checkbox" value="MAR" /></td>
												<td><input type="checkbox" value="APR" /></td>
												<td><input type="checkbox" value="MAY" /></td>
												<td><input type="checkbox" value="JUN" /></td>
												<td><input type="checkbox" value="JUL" /></td>
												<td><input type="checkbox" value="AUG" /></td>
												<td><input type="checkbox" value="SEP" /></td>
												<td><input type="checkbox" value="OCT" /></td>
												<td><input type="checkbox" value="NOV" /></td>
												<td><input type="checkbox" value="DEC" /></td>

											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group">
							<div class="col-md-6 col-md-offset-3" style="text-align:center";>
								<button class="btn btn-primary btn-md">Evaluate</button>
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
								<label class="col-sm-2 control-label">Variable</label>
								<div class="col-sm-4">
									<select ng-model="variable" ng-change="getTask()"
										class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">Precipitation</option>
										<option value="temp1980JAN">Min Temperature</option>
										<option value="">Max Temperature</option>
										<option value="">Mean Temperature</option>
										<option value="">Surface Wind</option>
										<option value="">Surface Pressure</option>
										<option value="">Relative Humidity</option>
										<option value="rf1980JAN">RainFall</option>

									</select>
								</div>

								<label class="col-sm-2 control-label">Type</label>
								<div class="col-sm-4">
									<select ng-model="type" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">Observed</option>
										<option value="">Gridded</option>
										<option value="">Projected (Raw)</option>
										<option value="">Projected (Bias Corrected)</option>
									</select>
								</div>




							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Province</label>
								<div class="col-sm-4">
									<select ng-model="selextedArea" ng-change="pushValue()"
										class="form-control">
										<option value="ALL">ALL</option>
										<option value="AYEYARWADY">AYEYARWADY</option>
										<option value="BAGO">BAGO</option>
										<option value="CHIN">CHIN</option>
										<option value="KACHIN">KACHIN</option>
										<option value="KAYAH">KAYAH</option>
										<option value="KAYIN">KAYIN</option>
										<option value="MAGWE">MAGWE</option>
										<option value="MANDALAY">MANDALAY</option>
										<option value="MON">MON</option>
										<option value="RAKHAING">RAKHAING</option>
										<option value="SAGAING">SAGAING</option>
										<option value="SHAN">SHAN</option>
										<option value="TANINTHARYI">TANINTHARYI</option>
										<option value="YANGON">YANGON</option>
										<option value="SELECTION">SELECTION</option>
									</select>
								</div>
								<label class="col-sm-2 control-label">Resolution</label>
								<div class="col-sm-4">
									<select ng-model="resolution" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">25 KM</option>
										<option value="">50 KM</option>
									</select>
								</div>
							</div>

							<hr>
							<p>Models (for Projected Data Only)</p>

							<div class="form-group">

								<label class="col-sm-1 control-label">RCM</label>
								<div class="col-sm-3">
									<select ng-model="rcm" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">PRECIS</option>
									</select>
								</div>

								<label class="col-sm-1 control-label">GCM</label>
								<div class="col-sm-3">
									<select ng-model="gcm" class="form-control col-sm-8">
										<option value="">--</option>
										<option value="">ECHAM5</option>
										<option value="">HadCM3Q0</option>
									</select>
								</div>

								<label class="col-sm-2 control-label">Scenario</label>
								<div class="col-sm-2">
									<select ng-model="scenario" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">A1B</option>
									</select>
								</div>


							</div>

							<hr>

							<div class="form-group">
								<label class="col-sm-3 control-label">Statistics</label>
								<div class="col-sm-3">
									<select ng-model="statistics" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">Annual Mean</option>
										<option value="">Average</option>
										<option value="">Count</option>
										<option value="">Max</option>
										<option value="">Min</option>
										<option value="">Standard Deviation</option>
										<option value="">Sum</option>
									</select>
								</div>

								<label class="col-sm-3 control-label">Region Filter</label>
								<div class="col-sm-3">
									<select ng-model="statistics" class="form-control col-sm-2">
										<option value="">--</option>
										<option value="">Ayeyarwady</option>
										<option value="">Bago</option>
										<option value="">Chin</option>
										<option value="">Kachin</option>
										<option value="">Kayah</option>
										<option value="">Kayin</option>
										<option value="">Magway</option>
										<option value="">Mandalay</option>
										<option value="">Mon</option>
										<option value="">Rakhine</option>
										<option value="">Sagaing</option>
										<option value="">Shan</option>
										<option value="">Tanintharyi</option>
										<option value="">Yangon</option>
									</select>
								</div>



							</div>
							<hr>
							<div class="form-group">
								<label class="col-sm-3 control-label">Period</label> <label
									class="col-sm-2 control-label">From</label>
								<div class="col-sm-3">
									<select ng-model="year" class="form-control">
										<option value="1980">1980</option>
									</select>
								</div>
								<label class="col-sm-1 control-label">To</label>
								<div class="col-sm-3">
									<select class="form-control">
										<option value="1980">1980</option>
									</select>
								</div>


							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"><div class="checkbox">
										<label>All Months<input type="checkbox"></label>
									</div>

								</label>

								<div class="col-sm-9">
									<table class="table Months">
										<tbody>
											<tr>
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
												<td>D</td>
											</tr>
											<tr>
												<td><input type="checkbox" value="JAN" ng-model="month" /></td>
												<td><input type="checkbox" value="FEB" /></td>
												<td><input type="checkbox" value="MAR" /></td>
												<td><input type="checkbox" value="APR" /></td>
												<td><input type="checkbox" value="MAY" /></td>
												<td><input type="checkbox" value="JUN" /></td>
												<td><input type="checkbox" value="JUL" /></td>
												<td><input type="checkbox" value="AUG" /></td>
												<td><input type="checkbox" value="SEP" /></td>
												<td><input type="checkbox" value="OCT" /></td>
												<td><input type="checkbox" value="NOV" /></td>
												<td><input type="checkbox" value="DEC" /></td>

											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group">
							<div class="col-md-6 col-md-offset-3" style="text-align:center";>
								<button class="btn btn-primary btn-md">Evaluate</button>
							</div>
							</div>
						</div>

					</div>


				</form>

				<p class="text-center footer-col-1">
					<button class="btn btn-danger btn-lg footer-btn">Climate Dashboard</button>
				</p>


			</div>
			<!--/right-->
			<!--/center-->


			<div class="col-md-6">
				<!--right-->


				<div id="map-wrapper"
					class="embed-responsive embed-responsive-16by9 thumbnail">
					<div id="map" style="height: 600px" class="embed-responsive-item"></div>
					<div id="colour-palette">
						<div id="button-wrapper">
							<div class="btnStyle span3" width="310px">
								<table width="220px">
									<tr>
										<td width="30px"><input size="5" ng-model="minrange" value="0"
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
											style="background-color: #FFFFFF; color: black; font-size: 10px">Query:
											{{variable}} Year:{{year}} Month:{{month}} <br />Province(s):{{selextedArea}}
										</td>
									</tr>
								</table>
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
	<!--/container-fluid-->

	<!--login modal-->
	<div id="loginModal" class="modal fade" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h2 class="text-center">
						<img
							src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
							class="img-circle"><br>Login
					</h2>
				</div>
				<div class="modal-body">
					<form class="form col-md-8 col-md-offset-2">
						<div class="form-group">
							<input type="text" class="form-control input-lg"
								placeholder="Email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg"
								placeholder="Password">
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Sign In</button>
							<span class="pull-right"><a href="#">Register</a></span><span><a
								href="#">Need help?</a></span>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--language modal-->
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




	

	<!-- load the d3.js library --> 
								<script src="http://d3js.org/d3.v3.min.js"></script>
								<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/crossfilter/1.3.7/crossfilter.min.js"></script>

								<!-- drawing the chart -->
								<script src="charts/chart.js"></script>



	<script src="charts/bootstrap-datepicker.js"></script>

	  <script type="text/javascript" >
            
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

</body>
</html>
