@extends('layouts.index')
@section('title')
          Order report
@endsection

@section('content')
<style>
th{
   text-align: center;
}
td {
    vertical-align: middle;
    text-align: center;
}
img{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
   border-radius:10%;
}
#color, .btn-sm{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="row">


                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Order Report</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                       <div class="col-md-12">
                       <div class="col-md-3 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h4 class="m-b-20">New Customers</h4>
                    <h2 class="text-right"><i class="fa fa-user-plus f-left"></i><span>{{$customer}}</span></h2>
                   
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h4 class="m-b-20">Total revenue</h4>
                    <h2 class="text-right"><i class="fa fa-money f-left"></i><span>{{$revenue}}</span></h2>
        
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h4 class="m-b-20">Orders Received</h4>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{$order}}</span></h2>
                  
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                <h4 class="m-b-20">Orders delivered</h4>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{$delivered}}</span></h2>
                   
                </div>
            </div>
        </div>

                  </div>
                  
                        <h2 style="text-align:center; font-weight:bold" >TOP SELLING PRODUCTS</h2>
                     <div style="margin-top:5%;width: 100%; height: 400px;" id="piechartdiv">
                     
                     </div>
                     <hr>
                          <h2 style="text-align:center; font-weight:bold" >TOP 5 CUSTOMERS</h2>
                          <div style="width: 100%; height: 400px;"  id="custchartdiv">
                          </div>
                          <div class="col-md-12">
                          <hr>
                          <h2  style="text-align:center; font-weight:bold">SALES GROWTH</h2>
                          <div style="width: 100%; height: 400px;"  id="saleschartdiv"></div>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
              
              
      @endsection

      @section('script')


<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/maps.js"></script>
<script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var piechart = am4core.create("piechartdiv", am4charts.PieChart3D);
piechart.hiddenState.properties.opacity = 0; // this creates initial fade-in

pie = [];

$.get("getprd",function(data){
//alert(data[0].name);

if(data.length){ 
  for(var i=0; i<data.length ; i++){
    pie.push({
      country: ""+data[i].name+"",
    litres: data[i].count
},);

}piechart.data = [];
piechart.data = pie;
}console.log(piechart.data)
  });


piechart.innerRadius = am4core.percent(40);
piechart.depth = 120;

piechart.legend = new am4charts.Legend();

var series = piechart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "litres";
series.dataFields.depthValue = "litres";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 5;
series.colors.step = 3;


// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

/**
 * Chart design taken from Samsung health app
 */

var custchart = am4core.create("custchartdiv", am4charts.XYChart);
custchart.hiddenState.properties.opacity = 0; // this creates initial fade-in

custchart.paddingBottom = 30;
custdata = [
  ];
//custchart.data = []; 

$.get("getorder",function(data){

//alert(data.length);
if(data.length){ 
  for(var i=0; i<data.length ; i++){
    custdata.push({
    "name": ""+data[i].customer+"",
   "steps": data[i].amount,
    "href": "https://www.amcharts.com/wp-content/uploads/2019/04/monica.jpg"
},);

}
custchart.data = custdata;
}console.log(custchart.data)
  });
 
// console.log( custchart.data);
var categoryAxis = custchart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "name";
categoryAxis.renderer.grid.template.strokeOpacity = 0;
categoryAxis.renderer.minGridDistance = 10;
categoryAxis.renderer.labels.template.dy = 35;
categoryAxis.renderer.tooltip.dy = 35;

var valueAxis = custchart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inside = true;
valueAxis.renderer.labels.template.fillOpacity = 0.3;
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = 0;
valueAxis.cursorTooltipEnabled = false;
valueAxis.renderer.baseGrid.strokeOpacity = 0;

var series = custchart.series.push(new am4charts.ColumnSeries);
series.dataFields.valueY = "steps";
series.dataFields.categoryX = "name";
series.tooltipText = "{valueY.value}";
series.tooltip.pointerOrientation = "vertical";
series.tooltip.dy = - 6;
series.columnsContainer.zIndex = 100;

var columnTemplate = series.columns.template;
columnTemplate.width = am4core.percent(50);
columnTemplate.maxWidth = 66;
columnTemplate.column.cornerRadius(60, 60, 10, 10);
columnTemplate.strokeOpacity = 0;

series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
series.mainContainer.mask = undefined;

var cursor = new am4charts.XYCursor();
custchart.cursor = cursor;
cursor.lineX.disabled = true;
cursor.lineY.disabled = true;
cursor.behavior = "none";

var bullet = columnTemplate.createChild(am4charts.CircleBullet);
bullet.circle.radius = 30;
bullet.valign = "bottom";
bullet.align = "center";
bullet.isMeasured = true;
bullet.mouseEnabled = false;
bullet.verticalCenter = "bottom";
bullet.interactionsEnabled = false;

var hoverState = bullet.states.create("hover");
var outlineCircle = bullet.createChild(am4core.Circle);
outlineCircle.adapter.add("radius", function (radius, target) {
    var circleBullet = target.parent;
    return circleBullet.circle.pixelRadius + 10;
})

var image = bullet.createChild(am4core.Image);
image.width = 60;
image.height = 60;
image.horizontalCenter = "middle";
image.verticalCenter = "middle";
image.propertyFields.href = "href";

image.adapter.add("mask", function (mask, target) {
    var circleBullet = target.parent;
    return circleBullet.circle;
})

var previousBullet;
custchart.cursor.events.on("cursorpositionchanged", function (event) {
    var dataItem = series.tooltipDataItem;

    if (dataItem.column) {
        var bullet = dataItem.column.children.getIndex(1);

        if (previousBullet && previousBullet != bullet) {
            previousBullet.isHover = false;
        }

        if (previousBullet != bullet) {

            var hs = bullet.states.getKey("hover");
            hs.properties.dy = -bullet.parent.pixelHeight + 30;
            bullet.isHover = true;

            previousBullet = bullet;
        }
    }
})


// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("saleschartdiv", am4charts.XYChart);

// Add data
chart.data = generatechartData();
function generatechartData() {
  var chartData = [];
  var firstDate = new Date();
  firstDate.setDate( firstDate.getDate() - 150 );
  var visits = -40;
  var b = 0.6;

  $.get("getorderdate",function(data){

//alert(data[0]);
if(data.length){ 
  for(var i=0; i<data.length ; i++){
      console.log(data[i].OrderDate);
    // we create date objects here. In your data, you can have date strings
    // and then set format of your dates using chart.dataDateFormat property,
    // however when possible, use date objects, as this will speed up chart rendering.
    // var newDate = new Date( firstDate );
    // newDate.setDate( newDate );
    // if(i > 80){
    //     b = 0.4;
    // }
    // visits += Math.round((Math.random()<b?1:-1)*Math.random()*10);

    // chartData.push( {
    //   date: newDate,
    //   visits: visits
    // } );

}
}
  });

  for ( var i = 0; i < 150; i++ ) {
    // we create date objects here. In your data, you can have date strings
    // and then set format of your dates using chart.dataDateFormat property,
    // however when possible, use date objects, as this will speed up chart rendering.
    var newDate = new Date( firstDate );
    newDate.setDate( newDate.getDate() + i );
    if(i > 80){
        b = 0.4;
    }
    visits += Math.round((Math.random()<b?1:-1)*Math.random()*10);

    chartData.push( {
      date: newDate,
      visits: visits
    } );
  }
  return chartData;
}

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.startLocation = 0.5;
dateAxis.endLocation = 0.5;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "visits";
series.dataFields.dateX = "date";
series.strokeWidth = 3;
series.tooltipText = "{valueY.value}";
series.fillOpacity = 0.1;

// Create a range to change stroke for values below 0
var range = valueAxis.createSeriesRange(series);
range.value = 0;
range.endValue = -1000;
range.contents.stroke = chart.colors.getIndex(4);
range.contents.fill = range.contents.stroke;
range.contents.strokeOpacity = 0.7;
range.contents.fillOpacity = 0.1;

// Add cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.xAxis = dateAxis;
chart.scrollbarX = new am4core.Scrollbar();

series.tooltip.getFillFromObject = false;
series.tooltip.adapter.add("x", (x, target)=>{
    if(series.tooltip.tooltipDataItem.valueY < 0){
        series.tooltip.background.fill = chart.colors.getIndex(4);
    }
    else{
        series.tooltip.background.fill = chart.colors.getIndex(0);
    }
    return x;
})

}); // end am4core.ready()
</script>
@endsection
