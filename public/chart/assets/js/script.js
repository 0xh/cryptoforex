$(document).ready(function(){
    
    
    MainChart = new Chart(document.getElementById('main'), {
        xhrInstrumentId: 1,     // query type currency number 
        xhrPeriodFull: 1440,    // data max period 
        dataNum: 30,          // default zoom number of dataset in 1 screen
        xhrMaxInterval: 30000,  // renewal full data interval
        xhrMinInterval: 200,    // ticks - min interval to update and redraw last close data
        btnVolume: false,       // bottom volume graph default state
        colorCandleBodyUp: "#f59" // example to change positive candle body
    });
    
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
        MainChart.reloadData.call(true)
    }
    
    
    
//    setTimeout(tryChange, 12000);
    
    
    var candleShowHide = $("#main").parent().find("button.instrument_1").on('click', function() {
        MainChart.xhrInstrumentId = 1;
//        MainChart.timerGraph = 0;
        MainChart.reloadData.call(true);
    });

    var candleShowHide = $("#main").parent().find("button.instrument_2").on('click', function() {
        MainChart.xhrInstrumentId = 2;
//        MainChart.timerGraph = 0;
        MainChart.reloadData(true);
    });

    var candleShowHide = $("#main").parent().find("button.instrument_3").on('click', function() {
        MainChart.xhrInstrumentId = 3;
//        MainChart.timerGraph = 0;
        MainChart.reloadData(true);
    });

    var candleShowHide = $("#main").parent().find("button.instrument_4").on('click', function() {
        MainChart.xhrInstrumentId = 4;
//        MainChart.timerGraph = 0;
        MainChart.reloadData(true);
    });
    
});
