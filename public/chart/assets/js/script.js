$(document).ready(function(){
    
    
    MainChart = new Chart(document.getElementById('main'), {
        xhrInstrumentId: 4,     // query type currency number 
        xhrPeriodFull: 700,    // data max period 
        dataNum: 30,          // default zoom number of dataset in 1 screen
        xhrMaxInterval: 30000,  // renewal full data interval
        xhrMinInterval: 400,    // ticks - min interval to update and redraw last close data
        btnVolume: false,       // bottom volume graph default state
        colorCandleBodyUp: "#f59" // example to change positive candle body
    });
    
    SecondChart = new Chart(document.getElementById('second'), {
        colorCandleBodyUp: "#059", // for example color of buy candle body
        xhrUserId: 2
    });  
    function tryChange(){
        MainChart.xhrInstrumentID = 2;
        MainChart.reloadData();
        console.log("outer call");
    }
    setTimeout(tryChange, 10000);
    
    
    
});
