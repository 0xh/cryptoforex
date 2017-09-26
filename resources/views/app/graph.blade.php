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
    <a href="#" class="button" onclick="toggleFullScreen();"></a>
    <a href="#" class="b_close" onclick="toggleFullScreen();"></a>
    <a href="#" class="open hidden">Открыть сделку</a>
    <a href="#" class="closee hidden">Скрыть</a>

    <!-- <div id="charttitle" class="graf-title">
    </div>
    <div id="chartdiv2" class="graf"></div>
    <div class="btn-group">
        <button onclick="graphControl.CandleStick()"><i class="fa fa-bar-chart"></i>CandleStick</button>
        <button onclick="graphControl.Line()"><i class="fa fa-line-chart"></i>Line</button>
        <button onclick="graphControl.OHLC()"><i class="fa fa-bar-chart"></i>OHLC</button>
    </div> -->


    <!-- DENIS chart graph START  -->
    <link rel="stylesheet" type="text/css" href="/chart/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/css/media.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/plugins/tether/css/tether.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/chart/assets/plugins/chart/chart.css">
    <div class="row">
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
    </div>
    <div id="main" class="stock-graph">
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <div class="btn-group btn-group-sm" id="candle-type" role="group" aria-label="Candle type">
              <button type="button" class="btn btn-secondary">1 min</button>
              <button type="button" class="btn btn-secondary">5 min</button>
              <button type="button" class="btn btn-secondary">15 min</button>
              <button type="button" class="btn btn-secondary">30 min</button>
              <button type="button" class="btn btn-secondary">1 hour</button>
            </div>
        </div>
    </div>
    <div class="wheel">0</div>
    <script type="text/javascript" src="/chart/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/tether/js/tether.min.js"></script>
    <script type="text/javascript" src="/chart/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/d3.v4.min.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/moment.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/d3/js/utils.js"></script>
    <script type="text/javascript" src="/chart/assets/plugins/chart/chart.js"></script>
    <!--  Denis chart graph END -->

</div>
