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
		<link rel="stylesheet" href="dist/css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="dist/css/leaflet.css" />
		<link rel="stylesheet" href="dist/css/leaflet.label.css" />
		<link rel="stylesheet" href="dist/css/leaflet.draw.css"/>
		<link rel="stylesheet" href="dist/css/leaflet.css" />
		<link rel="stylesheet" type="text/css" href="dist/css/iconselect.css" >
		<style>
		.leaflet-bottom{display:none;}
		.leaflet-google-layer{ z-index: 0;}
		.leaflet-map-pane{ z-index: 100;}
		.leaflet-control-zoom{	left: -10px; top: -10px;}
		.leaflet-draw{	left: -10px; top: -20px;}
		.leaflet-grid-label .lng {
			margin-left: 8px;
			-webkit-transform: rotate(90deg);
			transform: rotate(90deg);
		}
		.leaflet-draw-draw-marker{display:none}
		#map-wrapper {
        position: relative;
		}
		#button-wrapper {
			position: absolute;
			left:10px;
			bottom: 50px;
			background-color: green;
			color:white;
			z-index: 150;
			
		}

</style>
		
		<script  src="dist/js/lib/togeojson.js"></script>
		<script src="dist/js/lib/angular.min.js"></script>
		<script src="dist/js/lib/leaflet.js"></script>
		<script src="dist/js/lib/leaflet.label.js"></script>
		<script src="dist/js/lib/angular-leaflet-directive.min.js"></script>
		<script type="text/javascript" src="dist/js/app.js"></script>
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
			document.getElementById('my-icon-select').addEventListener('changed', function(e){
              $scope.colorp = iconSelect.getSelectedValue();
			   //$scope.pushValue();
			   alert($scope.colorp);
            });
		
            
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
 	.footer-col-1{
 		padding: 15px 0px;
 	}
 	.footer-btn{
 		padding: 15px 50px;
 	}
 	.hit-count{
 		padding: 22px 0px;
 		background: #7f7f7f;
 	}
 	.clickable{
    cursor: pointer;   
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
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
})
 	</script>
        
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="#"><span class="glyphicon glyphicon-home"></span></a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Guide <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Link1</a></li>
                <li><a href="#">Link2</a></li>
                <li class="divider"></li>
                <li><a href="#">Link3</a></li>
                <li class="divider"></li>
                <li><a href="#">Link4</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Purchase Data <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <li><a href="#">Link1</a></li>
                <li><a href="#">Link2</a></li>
                <li class="divider"></li>
                <li><a href="#">Link3</a></li>
                <li class="divider"></li>
                <li><a href="#">Link4</a></li>
              </ul>
            </li>
		</ul>
		<div class="col-sm-3 col-md-3 pull-right">
          	<ul class="nav navbar-nav navbar-right">
                <li><a href="#loginModal" role="button" data-toggle="modal">Login</a></li>
                <li><a href="#">Language</a></li>
                <li><a href="#termsModal" role="button" data-toggle="modal">Terms of use</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
<div ng-controller="GoogleMapsController">
  
  <!--left-->
  <div class="col-md-3">
  	
		<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Base Layers</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
			
         	<div class="panel-body">
			<ul class="collapsibleList">
								
								<li><input type="radio" name="basetype"  ng-click="changeTiles('OSMMapnik')" checked="checked"/>Streets</li>
								<li><input type="radio" name="basetype"  ng-click="changeTiles('Landscape')"/>Landscape</li>
								
			</ul>
			</div>
		</div>

        <div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Overlays</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				
         	<div class="panel-body">
						<ul class="collapsibleList">
						  <li><input type="checkbox" name="layers" ng-click="addTiles('Provinces',95)"/>Provinces</li>
						  <li><input type="checkbox" name="layers" ng-click="addTiles('PNames',97)"/>Province Names</li>
						  <li><input type="checkbox" name="layers" ng-click="addTiles('Stations',96)"/>Station List</li>
						  <li><input type="checkbox" name="layers" ng-click="addTiles('Grid',94)"/>Grid</li>
						  <li><input type="checkbox" name="layers" ng-click="addTiles('QuaryR',93)"/>Query Result</li>
						</ul>
			</div>
		</div>

        <div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 1</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
		
         	<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
            dolor, in sagittis nisi.Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
            Aliquam in felis sit amet augue.
			</div>
		</div>
  </div><!--/left-->
  
 
 
  <div class="col-md-3"><!--right--><!--center-->
		<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">Select Data</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				
         	<div class="panel-body">
			<table>
			<tr>
				<td height="35px">Variable</td>
				<td><select ng-model="variable" ng-change="getTask()" style=""><option value="rf1980JAN">RainFall</option><option value="temp1980JAN">Temperature</option></select></td>
			</tr>
			<tr>
				<td height="35px">Year</td>
				<td><select ng-model="year"><option value="1980">1980</option></select></td>
			</tr>
			<tr>
				<td height="35px">Month</td>
				<td><select ng-model="month"><option value="JAN">JAN</option></select></td>
			</tr>
			<tr>
				<td height="35px">Area</td>
				<td><select ng-model="selextedArea" ng-change="pushValue()">
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
							</select></td>
			</tr>
				
			
			</table>
         									
			</div>
		</div>
        <div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 1</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				
         	<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
            dolor, in sagittis nisi.Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
            Aliquam in felis sit amet augue.
			</div>
		</div>
     
       
 		<p class="text-center footer-col-1"><button class="btn btn-danger btn-lg footer-btn">Climate Dashboard</button></p>
   	
   		
  </div><!--/right--><!--/center-->
  
  
   <div class="col-md-6"><!--right-->

    
          <div id="map-wrapper">
	<div id="map" style="width: 630px; height: 600px"></div>
	<div id="button-wrapper">
            <div class="btnStyle span3" width="310px">
				<table width="220px">
				<tr>
				<td width="30px"><input size="5" ng-model="minrange" value="0" style="background-color:#222; border:1px solid #888; color:white;margin:0px;padding:0px;width:30px"></td>
				<td width="160px" style="background-color:#222; border:1px solid #888; color:white;margin:0px;padding:0px;text-align:center" >{{units}}</td>
				<td width="30px"><input size="255" ng-model="maxrange" value="255" style="background-color:#222; border:1px solid #888; color:white;margin:0px;padding:0px;width:30px"></td>
				</tr>
				<tr>
				<td width="220px" colspan="3"> <div id="my-icon-select" ng-click="changeColorP()"></div></td>
				</tr>
				<tr><td width="220px" colspan="3" style="background-color:#FFFFFF;color:black;font-size:10px">Query: {{ variable}} Year:{{year}} Month:{{month}} <br/>Province(s):{{selextedArea}}</td>
				</tr>
				</table>
			</div>
            
         </div> 
	</div>

 <div class="col-md-12">
 	<div class="col-md-8">
 		<div class="col-md-3">
 			<img src="http://placehold.it/70x60" alt="..." class="img-thumbnail">
 		</div>
 		<div class="col-md-3">
 			<img src="http://placehold.it/70x60" alt="..." class="img-thumbnail">
 		</div>
 		<div class="col-md-3">
 			<img src="http://placehold.it/70x60" alt="..." class="img-thumbnail">
 		</div>
 		<div class="col-md-3">
 			<img src="http://placehold.it/70x60" alt="..." class="img-thumbnail">
 		</div>
 		
 	</div>
 	<div class="col-md-4">
 		<p class="text-center hit-count">Hit Counter</p>
 	</div>

 </div>
   
	</div><!--/right-->
</div>
</div><!--/container-fluid-->
        
<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="text-center"><img src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"><br>Login</h2>
      </div>
      <div class="modal-body">
          <form class="form col-md-8 col-md-offset-2">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
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
<div id="termsModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="text-left">Terms of use</h2>
      </div>
      <div class="modal-body">
          
      </div>
    
  </div>
  </div>
</div>

    </body>
</html>
