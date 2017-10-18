
var tickEvent = function(dataSet, direction){
        console.log("tickerGet", dataSet, direction);
    }

$(document).ready(function(){

    MainChart = new Chart(document.getElementById('main'), {
        xhrInstrumentId: 1,     // query type currency number
        xhrPeriodFull: 1440,    // data max period
        dataNum: 120,          // default zoom number of dataset in 1 screen
        xhrMaxInterval: 30000,  // renewal full data interval
        xhrMinInterval: 200,    // ticks - min interval to update and redraw last close data
        btnVolume: false,       // bottom volume graph default state
        // colorCandleStemUp: "#41be3b",
        // colorCandleStemDown: "#f06e6e",
        // colorCandleBodyUp: "#41be3b", // example to change positive candle body
        // colorCandleBodyDown: "#f06e6e", // example to change positive candle body
//        barSpacing: 0.85
    },
    tickEvent
    );

    SecondChart = new Chart(document.getElementById('second'), {
        colorCandleBodyUp: "#059", // for example color of buy candle body
        xhrInstrumentId: 4,
        xhrUserId: 4,
        xhrMinInterval: 1000,
        xhrMaxInterval: 65000,
    });
    function tryChange(){
        MainChart.xhrInstrumentId = 2;
        MainChart.dataNum = 1440;
        MainChart.reloadData.call(true);
    };

    MainChart.on("tickEvent", function(evt, eventData, direction, element){
//        console.log("on", eventData, direction, element);
    });

//    setTimeout(tryChange, 12000);


    var candleShowHide = $("#main").parent().find("button.instrument_1").on('click', function() {
        MainChart.setParams({xhrInstrumentId: 1});
        MainChart.reloadData(true);
    });

    var candleShowHide2 = $("#main").parent().find("button.instrument_2").on('click', function() {
        MainChart.setParams({xhrInstrumentId: 2});
        MainChart.reloadData(true);
    });

    var candleShowHide3 = $("#main").parent().find("button.instrument_3").on('click', function() {
        MainChart.setParams({xhrInstrumentId: 3});
        MainChart.reloadData(true);
    });

    var candleShowHide4 = $("#main").parent().find("button.instrument_4").on('click', function() {
        MainChart.setParams({xhrInstrumentId: 4});
        MainChart.reloadData(true);
    });

});
