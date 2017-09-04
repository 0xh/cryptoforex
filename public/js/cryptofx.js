var graphControl = {
    Line:function(){
        var chart = AmCharts.charts[ 0 ];
        if ( chart.panels.length ) {
            var panel = chart.panels[0];
            var graph = new AmCharts.StockGraph();
            graph.id= "g1";
            graph.valueField = "value";
            graph.comparable= true;
            graph.type = "line";
            graph.compareField = "value";
            graph.balloonText = "[[title]]: open <b>[[open]]</b> low <b>[[low]]</b> high <b>[[high]]</b> close <b>[[close]]</b>";
            graph.compareGraphBalloonText = "[[title]]:<b>[[value]]</b>";
            graph.dateFormat = "hh:mm:ss";
            graph.animationPlayed= true;
            graph.lineColor = "#38697f";
            panel.removeStockGraph(panel.stockGraphs[0]);
            panel.addStockGraph(graph);
            chart.validateNow();
        }
    },
    CandleStick:function(){
        var chart = AmCharts.charts[ 0 ];
        if ( chart.panels.length ) {
            var panel = chart.panels[0];
            var graph = new AmCharts.StockGraph();
            graph.id= "g1";
            graph.proCandlesticks= true,
            // graph.valueField = "value";

            graph.openField = "open";
            graph.closeField = "close";
            graph.highField = "low";
            graph.lowField = "high";

            graph.comparable= true;
            graph.type = "candlestick";
            graph.compareField = "value";
            graph.balloonText = "[[title]]: open <b>[[open]]</b> low <b>[[low]]</b> high <b>[[high]]</b> close <b>[[close]]</b>";
            graph.compareGraphBalloonText = "[[title]]:<b>[[value]]</b>";
            graph.dateFormat = "hh:mm:ss";
            graph.animationPlayed= true;
            graph.lineColor = "#38697f";
            graph.fillColors = "#38697f";
            graph.negativeFillColors = "#db4c3c";
            graph.negativeLineColor =  "#db4c3c";
            graph.fillAlphas=1;
            panel.removeStockGraph(panel.stockGraphs[0]);
            panel.addStockGraph(graph);

            chart.validateNow();
        }
    },
    OHLC:function(){
        var chart = AmCharts.charts[ 0 ];
        if ( chart.panels.length ) {
            var panel = chart.panels[0];
            var graph = new AmCharts.StockGraph();
            graph.id= "g1";
            graph.proCandlesticks= true,
            graph.valueField = "value";
            graph.openField = "open";
            graph.closeField = "close";
            graph.highField = "high";
            graph.lowField = "low";
            graph.comparable= true;
            graph.type = "ohlc";
            graph.compareField = "value";
            graph.balloonText = "[[title]]: open <b>[[open]]</b> low <b>[[low]]</b> high <b>[[high]]</b> close <b>[[close]]</b>";
            graph.compareGraphBalloonText = "[[title]]:<b>[[value]]</b>";
            graph.dateFormat = "hh:mm:ss";
            graph.animationPlayed= true;
            graph.fillColor = "#38697f";
            graph.lineColor = "#38697f";
            graph.negativeFillColors = "#db4c3c";
            graph.negativeLineColor =  "#db4c3c";
            panel.removeStockGraph(panel.stockGraphs[0]);
            panel.addStockGraph(graph);

            chart.validateNow();
        }
    }
};
$(document).ready(function () {
    var dl = {//dataLoader
        url: '/data/amcharts/hystominute?limit=2000',
        // url: 'amchdata500.json',
        format: "json",
        // load:function(){},
        // complete:function(){},
        reverse:true,
        // reload: 45,
        async:true
    };
    var chart = AmCharts.makeChart("chartdiv", {
        type: "stock",
        dataDateFormat: "YYYY-MM-DD HH:mm:ss",
        theme: "none",
        pathToImages: "https://www.amcharts.com/lib/3/images/",
        dataSets: [
            {
                title: "BTC/BCH",
                // dataProvider: d,
                dataLoader: dl,
                categoryField: "date",
                fieldMappings: [
                    {
                        fromField: "value",
                        toField: "value"
                    },
                    {
                        fromField: "open",
                        toField: "open"
                    },
                    {
                        fromField: "low",
                        toField: "low"
                    },
                    {
                        fromField: "high",
                        toField: "high"
                    },
                    {
                        fromField: "close",
                        toField: "close"
                    },
                    {
                        fromField: "volumefrom",
                        toField: "volumefrom"
                    },
                    {
                        fromField: "volumeto",
                        toField: "volumeto"
                    },
                    {
                        fromField: "volume",
                        toField: "volume"
                    }
                ]
            },
        ],
        categoryAxis: {
            parseDates: true,
            dateFormat: "YYYY-MM-DD hh:mm:ss"
        },
        categoryAxesSettings: {
            equalSpacing: true,
            minPeriod: "mm"
        },
        panels: [
            {
                showCategoryAxis: false,
                title: "Stock",
                percentHeight: 66,
                creditsPosition: "bottom-left",
                marginBottom:"10",
                stockGraphs: [
                    {
                        id: "g1",
                        valueField: "value",
                        lowField: "low",
                        highField:"high",
                        openField:"open",
                        closeField:"close",
                        comparable: true,
                        type: "candlestick",
                        compareField: "value",
                        balloonText: "[[title]]: open <b>[[open]]</b> close <b>[[close]]</b>",
                        compareGraphBalloonText: "[[title]]:<b>[[value]]</b>",
                        dateFormat: "hh:mm:ss",
                        animationPlayed: true
                    }
                ],
                stockLegend: {
                    periodValueTextComparing: "[[percents.value.close]]%",
                    periodValueTextRegular: "[[value.close]]",
                    valueText: "Open:[[open]] Low:[[low]] High:[[high]] Close:[[close]]",
                    valueTextRegular: "Open:[[open]] Low:[[low]] High:[[high]] Close:[[close]]"
                }
                // drawingIconsEnabled: false,
                // showCategoryAxis:true,
                // eraseAll: false,
                // allLabels: [
                //     {
                //         x: 0,
                //         y: 115,
                //         text: "Click on the pencil icon on top-right to start drawing",
                //         align: "center",
                //         size: 16
                //     }
                // ],
            },
            {
                title: "Volume",
                percentHeight: 34,
                stockGraphs: [{
                    valueField: "volume",
                    type: "column",
                    showBalloon: false,
                    fillAlphas: 1,
                    fillColor: "#38697f"
                }],
                stockLegend: {
                    periodValueTextRegular: "[[value.close]]"
                }
            }
        ],
        chartScrollbarSettings: {
            graph: "g1",
            minPeriod: "ss"
        },
        chartCursorSettings: {
            valueBalloonsEnabled: true,
            fullWidth: true,
            cursorAlpha: 0.1,
            valueLineBalloonEnabled: true,
            valueLineEnabled: true,
            valueLineAlpha: 0.5,
            zoomable:true,
            categoryBalloonDateFormats:[
                {period:"YYYY", format:"YYYY"},
                {period:"MM", format:"MMM, YYYY"},
                {period:"WW", format:"MMM DD, YYYY"},
                {period:"DD", format:"MMM DD, YYYY"},
                {period:"hh", format:"JJ:NN"},
                {period:"mm", format:"JJ:NN:SS"},
                {period:"ss", format:"JJ:NN:SS"},
                {period:"fff", format:"JJ:NN:SS"}
            ]
        },
        periodSelector: {
            position: "bottom",
            inputFieldsEnabled:false,
            hideOutOfScopePeriods:false,
            periods: [{
                    period: "mm",
                    selected: true,
                    count: 1,
                    label: "1M"
                },
                {
                    period: "5mm",
                    count: 5,
                    label: "5M"
                },
                {
                    period: "DD",
                    count: 1,
                    label: "1D"
                },
                {
                    period: "WW",
                    count: 1,
                    label: "7D"
                },
                {
                    period: "MM",
                    count: 1,
                    label: "1MO"
                },
                {
                    period: "MM",
                    count: 6,
                    label: "6MO"
                },
                {
                    period: "YYYY",
                    count: 1,
                    label: "1Y"
                },
                {
                    period: "MAX",
                    count: 1,
                    label: "MAX"
                }
            ]
        },
        export: {
            enabled: true,
            position: "bottom"
        }
    });
    // chart.addListener( "rendered", zoomChart );
    // zoomChart();
    // this method is called when chart is first inited as we listen for "dataUpdated" event
    function zoomChart() {
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        // chart.zoomToIndexes( chart.dataProvider.length - 50, chart.dataProvider.length - 1 );
    }
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
