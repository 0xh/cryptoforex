<div class="content flex column">
    <script>

        // mozfullscreenerror event handler
        function errorHandler() {
            alert('mozfullscreenerror');
        }
        document.documentElement.addEventListener('mozfullscreenerror', errorHandler, false);

        // toggle full screen
        function toggleFullScreen() {
            if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        }

        // keydown event handler
        document.addEventListener('keydown', function (e) {
            if (e.keyCode == 13 || e.keyCode == 70) {
                toggleFullScreen();
            }
        }, false);
    </script>
    <div class="ttt">        
        <!-- <a href="#" class="b_close" onclick="toggleFullScreen();"></a> -->
        <a href="#" class="open hidden">@lang('messages.Open_sd')</a>
        <a href="#" class="closee hidden">@lang('messages.Close_sd')</a>
        <a href="#" class="open2 hidden">@lang('messages.Instruments')</a>
        <a href="#" class="closee2 hidden">@lang('messages.Close_sd')</a>
        <a href="#" class="button" onclick="toggleFullScreen();"></a>
    </div>

    <!-- <div id="charttitle" class="graf-title">
    </div>
    <div id="chartdiv2" class="graf"></div>
    <div class="btn-group">
        <button onclick="graphControl.CandleStick()"><i class="fa fa-bar-chart"></i>CandleStick</button>
        <button onclick="graphControl.Line()"><i class="fa fa-line-chart"></i>Line</button>
        <button onclick="graphControl.OHLC()"><i class="fa fa-bar-chart"></i>OHLC</button>
    </div> -->


    <!-- DENIS chart graph START  -->
    <!-- <link rel="stylesheet" type="text/css" href="/chart/assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/chart/assets/css/media.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/plugins/tether/css/tether.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/plugins/chart/chart.css">


    <!-- <div class="row">
        <div class="col-md-3 text-left">
           <button type="button" id="panel-show-hide" class="btn btn-primary">add panel</button>
        </div>
        <div class="col-md-9 text-right">
            <div class="row">
                <div class="col-md-3">
                   <button type="button" id="area-show-hide" class="btn btn-primary">remove area</button>
                </div>
                <div class="col-md-3">
                   <button type="button" id="candle-show-hide" class="btn btn-primary">remove candle</button>
                </div>
            </div>
        </div>
    </div> -->
    <div id="main" class="stock-graph">
        <div class="button_top flex center">
            <button type="button" id="panel-show-hide" class="btn btn-primary panel-show-hide"><i class="ic ic1"></i>Volume</button>
            <button type="button" id="line-show-hide" class="btn btn-primary line-show-hide"><i class="ic ic2"></i>Line</button>
            <button type="button" id="candle-show-hide" class="btn btn-primary candle-show-hide"><i class="ic ic3"></i>Candlesticks</button>
            <button type="button" id="area-show-hide" class="btn btn-primary area-show-hide"><i class="ic ic4"></i>Area</button>
            <!-- <div class="btn-group btn-group-sm" id="candle-type" role="group" aria-label="Candle type">
                <button type="button" class="btn btn-secondary">1M</button>
                <button type="button" class="btn btn-secondary">5M</button>
                <button type="button" class="btn btn-secondary">15M</button>
                <button type="button" class="btn btn-secondary">30M</button>
                <button type="button" class="btn btn-secondary">45M</button>
                <button type="button" class="btn btn-secondary">1H</button>
            </div> -->
            <div class="inner flex flex-top red">
                <div class="box">
                    <span>
                        <img src="/images/icon/btc.png" alt="">
                        <img src="/images/icon/dgb.png" alt="">
                    </span>
                    <!-- <p class="viz"><i class="down"></i>(0.008%)</p> -->
                    <p class="hidden slice">btc/dgb</p>
                </div>
                <!-- <div class="box">
                    <strong>1.1967<sub>9</sub></strong>
                    <p class="viz">L.1.19524</p>
                </div>
                <div class="box">
                    <strong>1.1967<sub>9</sub></strong>
                    <p class="viz">H.1.20079</p>
                    <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                </div> -->
            </div>
            <div class="info flex" id="charttitle">
                <p>BTC/USD</p>&nbsp;&nbsp;
                <p>3,967.28</p>
              </div>
        </div>
    </div>
    <div class="btn-group btn-group-sm" id="candle-type" role="group" aria-label="Candle type">
        <button type="button" class="btn btn-secondary">1M</button>
        <button type="button" class="btn btn-secondary">5M</button>
        <button type="button" class="btn btn-secondary">15M</button>
        <button type="button" class="btn btn-secondary">30M</button>
        <button type="button" class="btn btn-secondary">45M</button>
        <button type="button" class="btn btn-secondary">1H</button>
    </div>
    <!-- <div class="row">
        <div class="col-md-12 text-right">
            <div class="btn-group btn-group-sm" id="candle-type" role="group" aria-label="Candle type">
              <button type="button" class="btn btn-secondary">1 min</button>
              <button type="button" class="btn btn-secondary">5 min</button>
              <button type="button" class="btn btn-secondary">15 min</button>
              <button type="button" class="btn btn-secondary">30 min</button>
              <button type="button" class="btn btn-secondary">1 hour</button>
            </div>
        </div>
    </div> -->
    <!-- <div class="wheel">0</div> -->
    <script type="text/javascript" src="/chart/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="/chart/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/d3.v4.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/moment.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/utils.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/chart/chart.js"></script>
    <!-- <script type="text/javascript" src="/chart/assets/js/script.js"></script> -->
    <!--  Denis chart graph END -->

</div>