var dataCurrent;

var yticks = 6;
var xticks = 5;

//crossfilter 
var xf = crossfilter();
var dataset,dataset2;

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


//adding x-axis labels
// svg.append("text")
//     .attr("class", "x label")
//     .attr("text-anchor", "end")
//     .attr("x", width)
//     .attr("y", height)
//     .text("date");


//adding y-axis labels
    svg.append("text")
    .attr("id", "queryAYLabel")
    .attr("class", "y label")
    .attr("text-anchor", "end")
    .attr("y", -10)
    .attr("x", "15")
    .attr("transform", "rotate(-90)")
    .text("mm");
//adding y-axis labels tmin
    svgtmin.append("text")
    .attr("id", "queryBYLabel")
    .attr("class", "y label")
    .attr("text-anchor", "end")
    .attr("y", -10)
    .attr("x", "15")
    .attr("transform", "rotate(-90)")
    .text("mm");


function loadQueryA(qa){
    d3.json("charts/data.php?q1="+qa, function(error, data) {
    dataset = data;

    dataset.forEach(function(d) {
        d.date = parseDate(d.day+"-"+d.month+"-"+d.year);
        d.val = + d.val;
        
    });
    dataset.forEach(toNumbers);

    //adding the data to the crossfilter   
    xf.add(dataset);


    //****************** drawing for the first time ***************
    dataCurrent = dataset;
   // Scale the range of the data
    x.domain(d3.extent(dataset, function(d) { return d.date; }));
    y.domain(d3.extent(dataset, function(d) { return d.val; }));
    //yrf.domain(d3.extent(dataset, function(d) { return d.rf; }));
    //ytmin.domain(d3.extent(dataset, function(d) { return d.tmin; }));
    
    //adding bars - max temp
   svg.selectAll("rect")
        .data(data)
        .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return  Math.abs(y(d.val)-y(0));},//height-y(d.val)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return y(d.val)},
                fill: "steelblue"
            });
//  //adding bars - rain fall
//     svgrf.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-yrf(d.rf)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return yrf(d.rf)},
//                 fill: "steelblue"
//             });
// //adding bars - tmin
//     svgtmin.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-ytmin(d.tmin)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return ytmin(d.tmin)},
//                 fill: "steelblue"
//             });

    // Add the X Axis - max temp
    svg.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
   //Add the X Axis - min temp
    //  svgtmin.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);
    // //Add the X Axis - rain fall
    //  svgrf.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);




    // Add the Y Axis - max temp
    svg.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxis);
   // Add the Y Axis - min temp
    // svgtmin.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxistmin);
    // // Add the Y Axis - rain fall
    // svgrf.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxisrf);

});

    drawCharts(dataset);
}
function loadQueryB(qb){
    d3.json("charts/data2.php?q2="+qb, function(error, data) {
    dataset2 = data;

    dataset2.forEach(function(d) {
        d.date = parseDate(d.day+"-"+d.month+"-"+d.year);
        d.val = + d.val;
        
    });
    dataset2.forEach(toNumbers);

    //adding the data to the crossfilter   
    xf.add(dataset2);


    //****************** drawing for the first time ***************
    dataCurrent = dataset2;
   // Scale the range of the data
    x.domain(d3.extent(dataset2, function(d) { return d.date; }));
    //y.domain(d3.extent(dataset2, function(d) { return d.val; }));
    //yrf.domain(d3.extent(dataset2, function(d) { return d.rf; }));
    ytmin.domain(d3.extent(dataset2, function(d) { return d.val; }));
    
    //adding bars - max temp
   // svg.selectAll("rect")
   //      .data(data)
   //      .enter()
   //          .append("rect")
   //          .attr({
   //              width:1,
   //              height: function(d){ return  height-y(d.val)},
   //              x: function(d,i){ return x(d.date)},
   //              y: function(d){ return y(d.val)},
   //              fill: "steelblue"
   //          });
//  //adding bars - rain fall
//     svgrf.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-yrf(d.rf)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return yrf(d.rf)},
//                 fill: "steelblue"
//             });
//adding bars - tmin
    svgtmin.selectAll("rect")
        .data(data)
        .enter()
            .append("rect")
            .attr({
                width:1,
                height: function(d){ return  Math.abs(ytmin(d.val)-ytmin(0));},//height-y(d.val)},
                // height: function(d){ return  height-ytmin(d.val)},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return ytmin(d.val)},
                fill: "steelblue"
            });

    // Add the X Axis - max temp
    // svg.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);
   //Add the X Axis - min temp
     svgtmin.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
    // //Add the X Axis - rain fall
    //  svgrf.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);




    // Add the Y Axis - max temp
    // svg.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxis);
   // Add the Y Axis - min temp
    svgtmin.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxistmin);
    // // Add the Y Axis - rain fall
    // svgrf.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxisrf);

});

    drawCharts2(dataset2);
}

// // Get the data
// d3.json("charts/data.php?q=1", function(error, data) {
//     dataset = data;

//     dataset.forEach(function(d) {
//         d.date = parseDate(d.day+"-"+d.month+"-"+d.year);
//         d.val = + d.val;
        
//     });
//     dataset.forEach(toNumbers);

//     //adding the data to the crossfilter   
//     xf.add(dataset);

// //****************** drawing for the first time ***************
//     dataCurrent = dataset;
//    // Scale the range of the data
//     x.domain(d3.extent(dataset, function(d) { return d.date; }));
//     y.domain(d3.extent(dataset, function(d) { return d.val; }));
//     yrf.domain(d3.extent(dataset, function(d) { return d.rf; }));
//     ytmin.domain(d3.extent(dataset, function(d) { return d.tmin; }));
    
//     //adding bars - max temp
//    svg.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-y(d.val)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return y(d.val)},
//                 fill: "steelblue"
//             });
//  //adding bars - rain fall
//     svgrf.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-yrf(d.rf)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return yrf(d.rf)},
//                 fill: "steelblue"
//             });
// //adding bars - tmin
//     svgtmin.selectAll("rect")
//         .data(data)
//         .enter()
//             .append("rect")
//             .attr({
//                 width:1,
//                 height: function(d){ return  height-ytmin(d.tmin)},
//                 x: function(d,i){ return x(d.date)},
//                 y: function(d){ return ytmin(d.tmin)},
//                 fill: "steelblue"
//             });

//     // Add the X Axis - max temp
//     svg.append("g")         // Add the X Axis
//         .attr("class", "x axis")
//         .attr("transform", "translate(0," + height+ ")")
//         .call(xAxis);
//    //Add the X Axis - min temp
//      svgtmin.append("g")         // Add the X Axis
//         .attr("class", "x axis")
//         .attr("transform", "translate(0," + height+ ")")
//         .call(xAxis);
//     //Add the X Axis - rain fall
//      svgrf.append("g")         // Add the X Axis
//         .attr("class", "x axis")
//         .attr("transform", "translate(0," + height+ ")")
//         .call(xAxis);




//     // Add the Y Axis - max temp
//     svg.append("g")         // Add the Y Axis
//         .attr("class", "y axis")
//         .call(yAxis);
//    // Add the Y Axis - min temp
//     svgtmin.append("g")         // Add the Y Axis
//         .attr("class", "y axis")
//         .call(yAxistmin);
//     // Add the Y Axis - rain fall
//     svgrf.append("g")         // Add the Y Axis
//         .attr("class", "y axis")
//         .call(yAxisrf);



// });

//converting strings to numbers
function toNumbers(d){
  d.day = parseInt(d.day);
  d.id = parseInt(d.id);
  d.month = parseInt(d.month);
  //d.rf = parseInt(d.rf);
  d.stationid = parseInt(d.stationid);
  d.val = parseInt(d.val);
  //d.tmin = parseInt(d.tmin);
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
    x.domain(d3.extent(data, function(d,i) { return d.date; }));
    y.domain(d3.extent(data, function(d,i) { return d.val; }));
   // yrf.domain(d3.extent(data, function(d) { return d.rf; }));
   // ytmin.domain(d3.extent(data, function(d) { return d.tmin; }));

    //removing the previouse bar chart

    var rect = svg.selectAll("rect");
    //var rectrf = svgrf.selectAll("rect");
    //var recttmin = svgtmin.selectAll("rect");


    var ax = svg.selectAll(".axis");
   // var axrf = svgrf.selectAll(".axis");
    //var axtmin = svgtmin.selectAll(".axis");

    //rect.exit().remove();
    ax.remove();
   // axrf.remove();
   // axtmin.remove();

    rect.remove();
   // rectrf.remove();
   // recttmin.remove();


   ////////////////////////////

    var countMeasure = station.group().reduceCount(); // grouping by station id
    var n = countMeasure.size(); //station count
    var a = countMeasure.top(3); //converting to an array


     var colors = ["darkred","lightsteelblue","black"];
     var opacitylevel = [0.3,0.6,0.9];

    //loop by no of stations
    for (var i = a.length - 1; i >= 0; i--) {
        var station_id = a[i].key;

            station.filter(null);
            station.filter(station_id);
            data = station.top(Infinity);
        
         //drawing the new one
        var rect = svg.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            //.attr("class", function(d){return d.val < 0 ? "negative" : "positive";})
            .attr({
                width:1,
                height: function(d){ return  Math.abs(y(d.val)-y(0));},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return y(Math.max(0,d.val))},
                fill: colors[i], 
                opacity: opacitylevel[i],
            });


    };


   ////////////////////////////






   
    // var rectrf = svgrf.selectAll("rect")
    //         .data(data)
    //         .enter()
    //         .append("rect")
    //         .attr({
    //             width:1,
    //             height: function(d){ return height - yrf(d.rf)},
    //             x: function(d,i){ return x(d.date)},
    //             y: function(d){ return yrf(d.rf)},
    //             fill: "#3333FF"  
    //         });
    // var recttmin = svgtmin.selectAll("rect")
    //         .data(data)
    //         .enter()
    //         .append("rect")
    //         .attr({
    //             width:1,
    //             height: function(d){ return height - ytmin(d.tmin)},
    //             x: function(d,i){ return x(d.date)},
    //             y: function(d){ return ytmin(d.tmin)},
    //             fill: "#3399FF"  
    //         });


    // Add the X Axis
    svg.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);
    // svgrf.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);
    // svgtmin.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);

    // Add the Y Axis
    svg.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxis);
    // svgrf.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxisrf);
    // svgtmin.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxistmin);
}

//drawing the chart 2
function drawCharts2(data){
    dataCurrent = data;

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.date; }));
    //y.domain(d3.extent(data, function(d) { return d.val; }));
   // yrf.domain(d3.extent(data, function(d) { return d.rf; }));
   ytmin.domain(d3.extent(data, function(d) { return d.val; }));

    //removing the previouse bar chart

    //var rect = svg.selectAll("rect");
    //var rectrf = svgrf.selectAll("rect");
    var recttmin = svgtmin.selectAll("rect");


    //var ax = svg.selectAll(".axis");
   // var axrf = svgrf.selectAll(".axis");
    var axtmin = svgtmin.selectAll(".axis");

    //rect.exit().remove();
    //ax.remove();
   // axrf.remove();
   axtmin.remove();

   // rect.remove();
   // rectrf.remove();
    recttmin.remove();

    ////////////////////////////

    var countMeasure = station.group().reduceCount(); // grouping by station id
    var n = countMeasure.size(); //station count
    var a = countMeasure.top(3); //converting to an array


     var colors = ["darkred","lightsteelblue","black"];
     var opacitylevel = [0.3,0.6,0.9];




     //loop by no of stations
    for (var i = a.length - 1; i >= 0; i--) {
        var station_id = a[i].key;

            station.filter(null);
            station.filter(station_id);
            data = station.top(Infinity);
        
         //drawing the new one
       var recttmin = svgtmin.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            .attr("class", function(d){return d.val < 0 ? "negative" : "positive";})
            .attr({
                width:1,
                height: function(d){ return  Math.abs(ytmin(d.val)-ytmin(0));},
                x: function(d,i){ return x(d.date)},
                y: function(d){ return ytmin(Math.max(0,d.val))},
                 
            });


    };


   ////////////////////////////

    //drawing the new one
    
    //a code is missing here

    // var rectrf = svgrf.selectAll("rect")
    //         .data(data)
    //         .enter()
    //         .append("rect")
    //         .attr({
    //             width:1,
    //             height: function(d){ return height - yrf(d.rf)},
    //             x: function(d,i){ return x(d.date)},
    //             y: function(d){ return yrf(d.rf)},
    //             fill: "#3333FF"  
    //         });
    


    // Add the X Axis
    // svg.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);
    // svgrf.append("g")         // Add the X Axis
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + height+ ")")
    //     .call(xAxis);
    svgtmin.append("g")         // Add the X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height+ ")")
        .call(xAxis);

    // Add the Y Axis
    // svg.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxis);
    // svgrf.append("g")         // Add the Y Axis
    //     .attr("class", "y axis")
    //     .call(yAxisrf);
    svgtmin.append("g")         // Add the Y Axis
        .attr("class", "y axis")
        .call(yAxistmin);
}


//code to download Time Series Data as a CSV
function exportTableToCSV(filename) {

        // Grabing data from json to csv format
        csv = "Id, Station Id, Date, Rain fall, Maximum Temperature, Minimum Temperature\r";

        for(i = 0; i<dataCurrent.length;i++){
             csv = csv + dataCurrent[i].id + "," + dataCurrent[i].stationid + "," + dataCurrent[i].date+"," + dataCurrent[i].rf + "," + dataCurrent[i].val + "," + dataCurrent[i].tmin ;
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
   

