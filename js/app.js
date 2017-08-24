var cf = {
    api:{
        url:"https://min-api.cryptocompare.com/data/",
        defaults:{
            type:"histominute",
            fsym:"BTC",
            tsym:"BCH",
            limit:20,
            success:function(){}
        }
    },
    data:function(a){
        var opt = $.extend(this.api.defaults,a);
        $.ajax({
            url: this.api.url+opt.type+"?fsym="+opt.fsym+"&tsym="+opt.tsym+"&limit="+opt.limit+"&aggregate=3&e=CCCAGG",
            dataType:"json",
            success:function(d,s,x){
                console.debug(d);
                opt.success(d.Data);
            }
        });
    }
};
var canvasJS = {
    cryptoApi:{
        url:"https://min-api.cryptocompare.com/data/"
    },
    defaults:{
        type:"histominute",
        fsym:"BTC",
        tsym:"BCH",
        limit:20
    },
    dataPoints:function(a){
        var opt = $.extend(this.defaults,a);
        $.ajax({
            url: this.cryptoApi.url+opt.type+"?fsym="+opt.fsym+"&tsym="+opt.tsym+"&limit="+opt.limit+"&aggregate=3&e=CCCAGG",
            dataType:"json",
            success:function(d,s,x){
                console.debug(d);
                var dp = [];
                for(var i in d.Data){
                    var point = {
                        x:new Date(d.Data[i].time),
                        // y:[d.Data[i].open,d.Data[i].low,d.Data[i].high,d.Data[i].close]
                        y:[d.Data[i].low,d.Data[i].open,d.Data[i].close,d.Data[i].high]
                    };
                    dp.push(point);
                }
                console.debug(dp);
                canvasJS.chart(dp);
            }
        });
    },
    chart:function(dp){
        var chart = new CanvasJS.Chart("chartContainer",{
            title:{text: "BTC/BCH"},
            zoomEnabled: true,
            dataPointWidth: 20,
            axisY: {
                includeZero:false,
                title: "Rate",
                prefix: ""
            },
            axisX: {
                interval:10,
                intervalType: "minute",
                valueFormatString: "MMM-YY",
                labelAngle: -45
            },
            data: [{type: "candlestick",dataPoints: dp}]
        });
        chart.render();
    }
};
function googleCharts(){
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
                  legend:'none'
                };

                var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        });

    }
};
googleCharts.prototype = cf;
googleCharts.prototype.contructor = googleCharts;
var gc = new googleCharts();

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(gc.draw);

$(document).ready(function () {
    setInterval(canvasJS.dataPoints({}),1000);
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
