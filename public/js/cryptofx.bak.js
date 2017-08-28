var cf = {
    api:{
        url:"https://min-api.cryptocompare.com/data/",
        defaults:{
            type:"histominute",
            fsym:"BTC",
            tsym:"BCH",
            limit:120,
            success:function(){}
        }
    },
    geturl:function(a){
        var opt = $.extend(this.api.defaults,a);
        return this.api.url+opt.type+"?fsym="+opt.fsym+"&tsym="+opt.tsym+"&limit="+opt.limit+"&aggregate=3&e=CCCAGG";
    },
    data:function(a){
        var opt = $.extend(this.api.defaults,a);
        $.ajax({
            url: this.geturl(a),
            dataType:"json",
            success:function(d,s,x){
                console.debug(d);
                opt.success(d.Data);
            }
        });
    }
};
// var canvasJS = {
//     cryptoApi:{
//         url:"https://min-api.cryptocompare.com/data/"
//     },
//     defaults:{
//         type:"histominute",
//         fsym:"BTC",
//         tsym:"BCH",
//         limit:20
//     },
//     dataPoints:function(a){
//         var opt = $.extend(this.defaults,a);
//         $.ajax({
//             url: this.cryptoApi.url+opt.type+"?fsym="+opt.fsym+"&tsym="+opt.tsym+"&limit="+opt.limit+"&aggregate=3&e=CCCAGG",
//             dataType:"json",
//             success:function(d,s,x){
//                 console.debug(d);
//                 var dp = [];
//                 for(var i in d.Data){
//                     var point = {
//                         x:new Date(d.Data[i].time),
//                         // y:[d.Data[i].open,d.Data[i].low,d.Data[i].high,d.Data[i].close]
//                         y:[d.Data[i].low,d.Data[i].open,d.Data[i].close,d.Data[i].high]
//                     };
//                     dp.push(point);
//                 }
//                 console.debug(dp);
//                 canvasJS.chart(dp);
//             }
//         });
//     },
//     chart:function(dp){
//         var chart = new CanvasJS.Chart("chartContainer",{
//             title:{text: "BTC/BCH"},
//             zoomEnabled: true,
//             dataPointWidth: 20,
//             axisY: {
//                 includeZero:false,
//                 title: "Rate",
//                 prefix: ""
//             },
//             axisX: {
//                 interval:10,
//                 intervalType: "minute",
//                 valueFormatString: "MMM-YY",
//                 labelAngle: -45
//             },
//             data: [{type: "candlestick",dataPoints: dp}]
//         });
//         chart.render();
//     }
// };
var handleQueryResponse=function(response){
    console.debug(response);
    if (response.isError()) {
        console.error('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
        return;
    }
    var data = response.getDataTable(),
        chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
    chart.draw(data, {
        title:'BTC/BCH',
        legend:'none',
        height: 600
    });
    // chart.drawToolbar();
};
function googleCharts(){
    this.query=null;
    this.chart=null;
    this.handle=function(){
        this.chart = google.visualization.drawChart({
            "containerId": "chart_div",
            "dataSourceUrl": "/data/test/hystominute",
            "query": "select * limit 40",
            "refreshInterval": 5,
            "chartType": "CandlestickChart",
            "options": {
                "title":"BTC/BCH",
                "legend":"none",
                "alternatingRowStyle": false,
                "showRowNumber" : false
            }
        });
        this.chart = google.visualization.drawChart({
            "containerId": "chart_line",
            "dataSourceUrl": "/data/test/hystominute",
            "query": "select time,close limit 40",
            "refreshInterval": 1,
            "chartType": "LineChart",
            "options": {
                "title":"BTC/BCH",
                "legend":"none",
                "alternatingRowStyle": false,
                "showRowNumber" : false
            }
        });
    };
    this.handle2=function(){
        // Replace the data source URL on next line with your data source URL.
        this.query = new google.visualization.Query("/data/test", {
            sendMethod: 'xhr'
        });
        this.query.setRefreshInterval(1);
        this.query.setQuery("select * limit 20");
        this.query.send(handleQueryResponse);
    };
    this.handleQueryResponse=function(response){
        console.debug(response);
        if (response.isError()) {
            console.error('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
            return;
        }
        var data = response.getDataTable(),
            chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
        chart.draw(data, {
            title:'BTC/BCH',
            legend:'none',
            height: '600px'
        });
    };
    this.draw=function(){
        cf.data({
            success:function(hystoData){
                var dp = [];
                for(var i in hystoData){
                    var point = [new Date(hystoData[i].time),hystoData[i].low,hystoData[i].open,hystoData[i].close,hystoData[i].high];
                    dp.push(point);
                }
                var data = google.visualization.arrayToDataTable(dp,true);
                // [
                //   ['Mon', 20, 28, 38, 45],
                //   ['Tue', 31, 38, 55, 66],
                //   ['Wed', 50, 55, 77, 80],
                //   ['Thu', 77, 77, 66, 50],
                //   ['Fri', 68, 66, 22, 15]
                  // Treat first row as data as well.
                // ], true);

                var options = {
                    legend:'BTC/BCH'
                };

                var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
                chart.draw(data, {
                    legend:'none'
                });
            }
        });

    }
};
googleCharts.prototype = cf;
googleCharts.prototype.contructor = googleCharts;
var gc = new googleCharts();

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(gc.handle);

$(document).ready(function () {
    // setInterval(canvasJS.dataPoints({}),1000);
    // setInterval(googleCharts.draw(),1000);

});
/*
function Ask(d){
    Item.call(this,d);
    this.getIcons=function(){
        return {
            main:'<i class="fa fa-question-circle"></i>',
            time:'<i class="fa fa-calendar"></i>',
            timeAgo:'<i class="fa fa-calendar-o"></i>',
            user:'<i class="fa fa-user"></i>',
            comments:'<i class="fa fa-commention-o"></i>'
        };
    };
}
Ask.prototype = Object.create(Item.prototype);
Ask.prototype.constructor = Ask;
*/
