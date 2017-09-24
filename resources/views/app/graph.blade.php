<div class="content flex column">
    <script>
    function requestFullScreen(element) {
        var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;
        if (requestMethod) {
            requestMethod.call(element);
        } else if (typeof window.ActiveXObject !== "undefined") { // для IE
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }
    </script>
    <a href="#" class="button" onclick="requestFullScreen(document.documentElement); return false;"></a>
    <a href="#" class="b_close"></a>
    <a href="#" class="open hidden">Открыть сделку</a>
    <a href="#" class="closee hidden">Скрыть</a>
    <!-- <div class="item flex">
        <div class="pic">
            <img src="images/bitcoin.png" alt="">
            <img src="images/litecoin.png" alt="">
        </div>
        <div class="in">BTC/LTE</div>
        <div class="open tabl">
            <span>Open</span>
            <span>1.17805</span>
        </div>
        <div class="high tabl">
            <span>High</span>
            <span>1.17805</span>
        </div>
        <div class="low tabl">
            <span>Low</span>
            <span>1.17754</span>
        </div>
        <div class="clos tabl">
            <span>Close</span>
            <span>1.17763</span>
        </div>
    </div> -->
    <!-- <div class="graf">
<img src="images/graf.png" alt="">
</div> -->
    <div id="charttitle" class="graf-title">
    </div>
    <div id="chartdiv" class="graf"></div>
    <div class="btn-group">
        <button onclick="graphControl.CandleStick()"><i class="fa fa-bar-chart"></i>CandleStick</button>
        <button onclick="graphControl.Line()"><i class="fa fa-line-chart"></i>Line</button>
        <button onclick="graphControl.OHLC()"><i class="fa fa-bar-chart"></i>OHLC</button>
    </div>
</div>
