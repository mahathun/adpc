angular.module("demoapp", ["leaflet-directive"]);
function GoogleMapsController($scope,$http)
{
		
		
		/*$scope.baseballIcon = L.icon({iconUrl: 'images/baseball-marker.png',iconSize: [32, 37],iconAnchor: [16, 37],popupAnchor: [0, -28]});*/
		$scope.map = new L.Map('map', {center: new L.LatLng(19, 96), zoom: 5,minZoom:4});
		//$scope.map.setMaxBounds($scope.map.getBounds());
		///$scope.aa=$scope.map.getBounds();
		//alert($scope.aa.getWest());
		//$scope.map.setMaxBounds($scope.map.getBounds().getSouthWest(),$scope.map.getBounds().getNorthEast());
		
		//base layers		
		var osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>',
		thunLink = '<a href="http://thunderforest.com/">Thunderforest</a>';
		var osmUrl = 'http://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
		osmAttrib = 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012',
		landUrl = 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png',
		thunAttrib = '&copy; '+osmLink+' Contributors & '+thunLink;
		$scope.osmMap = L.tileLayer(osmUrl, {attribution: osmAttrib});
		$scope.landMap = L.tileLayer(landUrl, {attribution: thunAttrib});			
		$scope.googleLayer = $scope.osmMap;
		$scope.googleHybrid = $scope.landMap;
		$scope.map.addLayer($scope.googleLayer);
		$scope.baseLayers = {
				OSMMapnik: $scope.googleLayer,
				Landscape: $scope.googleHybrid
			};
			
		//provinces			
		$scope.myProvinces = new L.LayerGroup();
		$scope.myProvincesnames = new L.LayerGroup();
		function onEachFeature(feature, layer) 
		{
			layer.setStyle({fillColor: feature.properties.colorvalue });
			return L.circleMarker([feature.properties.provinceLocation[0], feature.properties.provinceLocation[1]],{radius:1}).bindLabel(feature.properties.provinceName,{ noHide: true }).addTo($scope.myProvincesnames);
		}
		L.geoJson(province, {	fillColor: '#800026',weight: 1,opacity: 1,color: 'black',dashArray: '3',fillOpacity: 0.3,onEachFeature: onEachFeature}).addTo($scope.myProvinces);
		
		//drawing controls
		$scope.drawnRect;
		$scope.drawnItems = new L.FeatureGroup();
		$scope.map.addLayer($scope.drawnItems);
		$scope.drawControl = new L.Control.Draw({edit: {featureGroup: $scope.drawnItems}});
		$scope.map.addControl($scope.drawControl);
		$scope.map.on('draw:created', function (e) 
			{ 
					var type = e.layerType, layer = e.layer; 
					$scope.drawnRect=e.layer.getLatLngs();
					//$scope.drawnItems.clearLayers();
					//$scope.drawnItems.addLayer(layer); 
					//alert("1:lat-"+$scope.drawnRect[0].lat+"1:lng-"+$scope.drawnRect[0].lng+"<br/>2:lat-"+$scope.drawnRect[1].lat+"2:lng-"+$scope.drawnRect[1].lng+"<br/>3:lat-"+$scope.drawnRect[2].lat+"3:lng-"+$scope.drawnRect[2].lng+"<br/>4:lat-"+$scope.drawnRect[3].lat+"4:lng-"+$scope.drawnRect[3].lng);
					
					var bottombound=Math.floor(Math.abs($scope.drawnRect[0].lat-30.6000004)/cellHeight);
					var topbound=Math.ceil(Math.abs($scope.drawnRect[1].lat-30.6000004)/cellHeight);
					var leftbound=Math.ceil(Math.abs($scope.drawnRect[0].lng-89.7599945)/cellWidth);
					var rightbound=Math.floor(Math.abs($scope.drawnRect[2].lng-89.7599945)/cellWidth);
					alert("cols "+leftbound+" to "+rightbound+" and rows "+topbound+" to "+bottombound);
					
			});
		
		//grid overlayers
		$scope.gridlayer=new L.LayerGroup();
		L.geoJson(grid,{weight: 1,	opacity: 1,	color: 'white',	dashArray: '3',fillOpacity: 0.2}).addTo($scope.gridlayer);
		
		
			   
		
		
		 //station list
		$scope.stationl = new L.LayerGroup();
		$scope.StationData = [];
		function displayStationData(i) {
			var data = "<div style='color:red'>"+$scope.StationData[i][0]+"</div><br/>Latitude: "+$scope.StationData[i][1]+"<br/>Longitude: "+$scope.StationData[i][2]+"<br/>elevation: "+$scope.StationData[i][3];
		    return data;
		}
		$scope.PutStationValue = function(){
		for (var i = 0; i < $scope.StationData.length; i++) {
				if($scope.StationData[i][3]>1000)
						L.circle([$scope.StationData[i][1],$scope.StationData[i][2]],4500,{ color: '#5C1F00', fillColor: '#A34719', fillOpacity:1}).bindLabel($scope.StationData[i][0]).bindPopup(displayStationData(i)).addTo($scope.stationl);
				else if($scope.StationData[i][3]>500)
					L.circle([$scope.StationData[i][1],$scope.StationData[i][2]],4500,{ color: '#003D00', fillColor: '#19A319', fillOpacity:1}).bindLabel($scope.StationData[i][0]).bindPopup(displayStationData(i)).addTo($scope.stationl);
				else
					L.circle([$scope.StationData[i][1],$scope.StationData[i][2]],4500,{ color: '#001452', fillColor: '#0033CC', fillOpacity:1}).bindLabel($scope.StationData[i][0]).bindPopup(displayStationData(i)).addTo($scope.stationl);
		 }
		}
		$scope.getStation = function() {  
			$http.post("quaryresult.php").success(function(data){
					$scope.StationData=data;
					$scope.PutStationValue();
					});
			};
	   $scope.getStation(); // Load all available Station 
		 function onEachCell(feature, layer) {
			layer.setStyle({fillColor: feature.colorv });
			layer.bindPopup(feature.colorv);
		}
		 //Quary Result Layer
		 
		$scope.variable= "rf1980JAN";
		$scope.year=1980;
		$scope.month="JAN";
		$scope.selextedArea="ALL";
		$scope.colorp=1;
		$scope.units="millimeters";
		$scope.quaryResultData=[];
		$scope.quaryr=new L.LayerGroup();
		$scope.pushValue = function(){
					$scope.quaryr.clearLayers();
					var gridtoquary=createlayeringrid($scope.quaryResultData,$scope.selextedArea,$scope.colorp);
					L.geoJson(gridtoquary,{weight: 1,	opacity: 1,	color: 'white',	dashArray: '3',fillOpacity: 0.7,onEachFeature: onEachCell}).addTo($scope.quaryr);
					$scope.minrange=Math.round(minRangeGet());
					$scope.maxrange=Math.round(maxRangeGet());
		}
		$scope.changeColorP = function(){
			$scope.colorp = parseInt(iconSelect.getSelectedValue());
			$scope.pushValue();
			  
            };

		$scope.changeUnits = function(){
		if($scope.variable=="rf1980JAN")
			$scope.units="millimeters";
		if($scope.variable=="temp1980JAN")
			$scope.units="celsius";

		};		
			$scope.getTask = function() {  
			$http.post("loadlayer.php?task="+$scope.variable).success(function(data){
					$scope.quaryResultData=data;
					$scope.pushValue();
					$scope.changeUnits();
					});
			};
	   $scope.getTask(); // Load all available tasks 
		
		//$scope.myTextLabel=L.marker([22,96],{ icon: L.divIcon({ className: 'text-labels',   html: '<div id=map>A Text Label</div >' })});
		//$scope.myTextLabel.addTo($scope.map);
		 //$scope.map.addLayer($scope.myTextLabel);
		// alert(checkinProvinceArea(coordinat) );
		 
		//overlayers 
		$scope.overlays = {
			Stations:$scope.stationl,
			Provinces: $scope.myProvinces,
			PNames: $scope.myProvincesnames,
			Grid:$scope.gridlayer,
			QuaryR:$scope.quaryr
		};

		$scope.changeTiles = function(layerName) {
				for (var name in $scope.baseLayers) {
						if($scope.map.hasLayer($scope.baseLayers[name]))
						{
							 $scope.map.removeLayer($scope.baseLayers[name]);
						}
				}
				$scope.map.addLayer($scope.baseLayers[layerName],false);
		};
		$scope.addTiles = function(layerName,level) {
				if($scope.map.hasLayer($scope.overlays[layerName]))
					 $scope.map.removeLayer($scope.overlays[layerName]);
				else
				{
					if($scope.map.hasLayer($scope.overlays['Stations']))
					{
						$scope.map.removeLayer($scope.overlays['Stations']);
						$scope.map.addLayer($scope.overlays[layerName]);
						$scope.map.addLayer($scope.overlays['Stations']);
					}
					else
					{
						 $scope.map.addLayer($scope.overlays[layerName]);
					}
				}
		};
}	