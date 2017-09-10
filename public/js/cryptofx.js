var usePulseData = true;
var mainChart = undefined;
var pulseData = function(chart,i){
    var c = chart.dataSets[0].dataProvider[chart.dataSets[0].dataProvider.length-1];

    var rnd = .1*Math.random();
    // console.debug(c,rnd,i);
    c.low = parseFloat(c.low)+Math.pow(-1,i)*rnd;
    c.high= parseFloat(c.high)+Math.pow(-1,i)*rnd;
    c.close = c.high;
    c.volume = parseFloat(c.volume)+400*rnd;
    chart.dataSets[0].dataProvider[chart.dataSets[0].dataProvider.length-1] = c;
    chart.panels[0].trendLines[0].finalDate=c.date;
    chart.panels[0].trendLines[0].finalValue=c.close;
    chart.panels[0].trendLines[0].initialValue=c.close;
    chart.validateData();
    if(--i>0) setTimeout(pulseData,1000,chart,i);
    else {
        $.ajax({
            url:"/data/amcharts/hystominute?limit=1",
            dataType:"json",
            success:function(d){
                chart.dataSets[0].dataProvider.shift();
                // console.debug(chart.dataSets[0].dataProvider,d);
                if(chart.dataSets[0].dataProvider[chart.dataSets[0].dataProvider.length-1].date!=d[0].date)chart.dataSets[0].dataProvider.push(d[0]);
                chart.validateData();
                pulseData(chart,60);
            }
        });
    }
}
var getData = function(limit,divid){
    var res={},divid = (arguments.length>1)?arguments[1]:"chartdiv";
    $.ajax({
        async:true,
        url:"/data/amcharts/hystominute?limit="+limit,
        dataType:"json",
        success:function(d){
            dp = d.reverse();
            mainChart = AmCharts.makeChart(divid, {
                type: "stock",
                dataDateFormat: "YYYY-MM-DD JJ:NN:SS",
                glueToTheEnd:true,
                mouseWheelScrollEnabled:true,
                processTimeout:1,
                // theme: "light",
                pathToImages: "https://www.amcharts.com/lib/3/images/",
                dataSets: [{
                        color:"#04bf85",
                        title: "BTC/BCH",
                        dataProvider: dp,//getData(12000),
                        categoryField: "date",
                        fieldMappings: [
                            {fromField: "value", toField: "value"},
                            {fromField: "open", toField: "open"},
                            {fromField: "low", toField: "low"},
                            {fromField: "high", toField: "high"},
                            {fromField: "close", toField: "close"},
                            {fromField: "volumefrom", toField: "volumefrom"},
                            {fromField: "volumeto", toField: "volumeto"},
                            {fromField: "volume", toField: "volume"}
                        ]
                    }
                ],
                categoryAxis: {
                    parseDates: true,
                    dateFormat: "YYYY-MM-DD hh:mm:ss",
                    minPeriod: 'mm'
                },
                categoryAxesSettings: {
                    equalSpacing: true,
                    minPeriod: "mm"
                },
                axisX: {
                    interval:1,
                    intervalType: "minute",
                    // valueFormatString: "YYYY-MM-DD hh:mm:ss",
                    labelAngle: -45
                },
                axisY: {
                    interval:1,
                    intervalType: "minute",
                    // valueFormatString: "YYYY-MM-DD hh:mm:ss",
                    labelAngle: -45
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
                                balloonText: "[[title]]: On date:<b>[[date]]</b> open <b>[[open]]</b> low <b>[[low]]</b> high <b>[[high]]</b> close <b>[[close]]</b>",
                                compareGraphBalloonText: "[[title]]: open <b>[[open]]</b> low <b>[[low]]</b> high <b>[[high]]</b> close <b>[[close]]</b>",
                                fillColor: "#38697f",
                                lineColor: "#38697f",
                                fillAlphas:1,
                                negativeFillColors: "#db4c3c",
                                negativeLineColor:  "#db4c3c",
                                negativeFillAlphas:1,
                                plotAreaBorderColor: "#855252",
                                dateFormat: "hh:mm:ss",
                                animationPlayed: true
                            }
                        ],
                        trendLines: [{
                            "finalDate":new Date(),
                            "finalValue":dp[dp.length-1].value,
                            "initialDate": "2012-01-02 12",
                            "initialValue": dp[dp.length-1].value,
                            "lineColor": "#CC0000",
                            balloonText:"value: [[value.high]]",
                            lineThickness:2
                        }],
                        stockLegend: {
                            periodValueTextComparing: "[[percents.value.close]]%",
                            periodValueTextRegular:  "Open:[[value.open]] Low:[[value.low]] High:[[value.high]] Close:[[value.close]]",
                            valueText: "Open:[[open]] Low:[[low]] High:[[high]] Close:[[close]]",
                            valueTextRegular: "Open:[[open]] Low:[[low]] High:[[high]] Close:[[close]]"
                        },
                        drawingIconsEnabled: false,
                        showCategoryAxis:true,
                        eraseAll: false,
                        allLabels: [
                            {
                                x: 0,
                                y: 115,
                                text: "",
                                align: "center",
                                size: 16
                            }
                        ],
                    }
                    ,{
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
                    graphType:"line",
                    position: "top",
                    minPeriod: "mm"
                },
                chartCursorSettings: {
                    valueBalloonsEnabled: true,
                    fullWidth: true,
                    cursorAlpha: 0.1,
                    valueLineBalloonEnabled: true,
                    valueLineEnabled: true,
                    valueLineAlpha: 0.5,
                    zoomable:true,
                    // categoryBalloonDateFormat:'HH:NN',
                    categoryBalloonDateFormats:[
                        {period:"YYYY", format:"YYYY"},
                        {period:"MM", format:"MMM, YYYY"},
                        {period:"WW", format:"MMM DD, YYYY"},
                        {period:"DD", format:"MMM DD, YYYY"},
                        {period:"hh", format:"HH:NN"},
                        {period:"mm", format:"HH:NN"},
                        {period:"ss", format:"HH:NN:SS"},
                        {period:"fff", format:"HH:NN:SS.QQQ"}
                    ]
                },
                periodSelector: {
                    position: "bottom",
                    inputFieldsEnabled:false,
                    hideOutOfScopePeriods:false,
                    periods: [{
                            period: "mm",
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
                            selected: true,
                            label: "MAX"
                        }
                    ]
                },
                export: {
                    enabled: true,
                    position: "bottom"
                }
            });
            if(usePulseData)pulseData(mainChart,60);
            setInterval( function(chart) {
                $.ajax({
                    url:"/data/amcharts/hystominute?limit=60",
                    dataType:"json",
                    success:function(d){
                        chart.dataSets[0].dataProvider.shift();
                        // console.debug(chart.dataSets[0].dataProvider,d);
                        if(chart.dataSets[0].dataProvider[chart.dataSets[0].dataProvider.length-1].date!=d[0].date)chart.dataSets[0].dataProvider.push(d[0]);
                        chart.validateData();
                    }
                });
            }, 60000,mainChart );
        }
    });
    return res;
}

getData(20000);
