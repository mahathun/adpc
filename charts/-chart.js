var dataCurrent;

var yticks = 6;
var xticks = 5;

//crossfilter 
var xf = crossfilter();
var dataset;

//crossfilter dimensions
var year = xf.dimension(function(d){ return d.date});
var station = xf.dimension(function(d){ return d.stationid});

// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 500 - margin.left - margin.right,
    height = 250 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%d-%m-%Y").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);
var yrf = d3.scale.linear().range([height, 0]);
var ytmin = d3.scale.linear().range([height, 0]);
// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(xticks);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(yticks);
        //rain fall
var yAxisrf = d3.svg.axis().scale(yrf)
    .orient("left").ticks(yticks);
        //tmin
var yAxistmin = d3.svg.axis().scale(ytmin)
    .orient("left").ticks(yticks);


// Adds the svg canvas
var svg = d3.select("#tmax")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var svgrf = d3.select("#rf")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
var svgtmin = d3.select("#tmin")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Get the data
d3.json("charts/data.php", function(error, data) {
    dataset = data;

    dataset.forEach(function(d) {
        d.date = parseDate(d.day+"-"+d.month+"-"+d.year);
        d.tmax = + d.tmax;
        
    });
    dataset.forEach(toNumbers);

    //adding the data to the crossfilter   
    xf.add(dataset);

//****************** drawing for the first time ***************
    dataCurrent = dataset;
   // Scale the range of the data
    x.domain(d3.extent(dataset, function(d) { return d.date; }));
    y.domain(d3.extent(dataset, function(d) { return d.tmax; }));
    yrf.domain(d3.extent(dataset, function(d) { return d.rf; }));
    ytmin.domain(d3.extent(dataset, function(d) { return d.tmin; }));
    
    //adding bars - max temp
   svg.selectAll("rect")
        .data(data)
        .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return  height-y(d.tmax)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return y(d.tmax)},
                fill: "steelblue"
            });
 //adding bars - rain fall
    svgrf.selectAll("rect")
        .data(data)
        .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return  height-yrf(d.rf)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return yrf(d.rf)},
                fill: "steelblue"
            });
//adding bars - tmin
    svgtmin.selectAll("rect")
        .data(data)
        .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return  height-ytmin(d.tmin)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return ytmin(d.tmin)},
                fill: "steelblue"
            });

    // Add the X Axis - max temp
    svg.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
   //Add the X Axis - min temp
     svgtmin.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
    //Add the X Axis - rain fall
     svgrf.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);




    // Add the Y Axis - max temp
    svg.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxis);
   // Add the Y Axis - min temp
    svgtmin.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxistmin);
    // Add the Y Axis - rain fall
    svgrf.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxisrf);



});

//converting strings to numbers
function toNumbers(d){
  d.day = parseInt(d.day);
  d.id = parseInt(d.id);
  d.month = parseInt(d.month);
  d.rf = parseInt(d.rf);
  d.stationid = parseInt(d.stationid);
  d.tmax = parseInt(d.tmax);
  d.tmin = parseInt(d.tmin);
  d.year = parseInt(d.year);
}

//filtering
function filter(start,end){

    if (start==null || end==null){
        year.filter(null);
        drawCharts(year.top(Infinity));
    }else{
        year.filter([new Date(start),new Date(end)]);
        drawCharts(year.top(Infinity));
    }
}
//filtering 
function filterStation(stid){
    station.filter(null);
    station.filter(stid);
    drawCharts(station.top(Infinity));
}

//drawing the chart
function drawCharts(data){
    dataCurrent = data;

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.date; }));
    y.domain(d3.extent(data, function(d) { return d.tmax; }));
    yrf.domain(d3.extent(data, function(d) { return d.rf; }));
    ytmin.domain(d3.extent(data, function(d) { return d.tmin; }));

    //removing the previouse bar chart

    var rect = svg.selectAll("rect");
    var rectrf = svgrf.selectAll("rect");
    var recttmin = svgtmin.selectAll("rect");


    var ax = svg.selectAll(".axis");
    var axrf = svgrf.selectAll(".axis");
    var axtmin = svgtmin.selectAll(".axis");

    //rect.exit().remove();
    ax.remove();
    axrf.remove();
    axtmin.remove();

    rect.remove();
    rectrf.remove();
    recttmin.remove();

    //drawing the new one
    var rect = svg.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return height - y(d.tmax)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return y(d.tmax)},
                fill: "#FF9933"  
            });
    var rectrf = svgrf.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return height - yrf(d.rf)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return yrf(d.rf)},
                fill: "#3333FF"  
            });
    var recttmin = svgtmin.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return height - ytmin(d.tmin)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return ytmin(d.tmin)},
                fill: "#3399FF"  
            });


    // Add the X Axis
    svg.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
    svgrf.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
    svgtmin.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxis);
    svgrf.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxisrf);
    svgtmin.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxistmin);
}



//code to download Time Series Data as a CSV
function exportTableToCSV(filename) {

        // Grabing data from json to csv format
        csv = "Id, Station Id, Date, Rain fall, Maximum Temperature, Minimum Temperature\r";

        for(i = 0; i<dataCurrent.length;i++){
             csv = csv + dataCurrent[i].id + "," + dataCurrent[i].stationid + "," + dataCurrent[i].date+"," + dataCurrent[i].rf + "," + dataCurrent[i].tmax + "," + dataCurrent[i].tmin ;
             csv = csv + "\r";
        }

        // Data URI
        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    $(this)
        .attr({
        'download': filename,
        'href': csvData,
        'target': '_blank'
    });
}


// This must be a hyperlink
$(".timeSeriesDownload").on('click', function (event) {
    // CSV
    exportTableToCSV.apply(this, [ 'timeSeriesData.csv']);
          
});


function downloadCSV(){

    // This must be a hyperlink
    $(".timeSeriesDownload").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData>table'), 'export.csv']);
       
    });

}
   

