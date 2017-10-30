<div class="popup popup_b intrument" style="display:block;">
    <div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <strong class="title">@lang('messages.instrument_dashboard')</strong>

    <div class="contenta flex info">
        @if(isset($row))
        <div class="item dashblock-4">
            <span class="title">@lang('messages.instrument'): <b>{{ $row->from->name }}/{{ $row->to->name }}</b></span>
            <span class="text">@lang('messages.commission'): <b>{{ $row->commission or '0' }}% </b></span>
            <span class="text">@lang('messages.direction'): <b>@if($row->direction>0) buy @else sell @endif</b></span>
            <span class="text">@lang('messages.current'): <b class="loader" data-action="/json/price/{{$row->id}}" data-name="current-price" data-autostart="true" data-refresh="1000" data-function="currentPrice">{{ $price->price or '0' }}</b></span>
            <span class="text">@lang('messages.enabled'): <b>{{ $row->enabled or '0' }}</b></span>
        </div>
        @endif
        <div class="item dashblock">
            <div class="chart">
                <div id="instrument_{{$row->id}}_chart">
                    <div class="chart2-panel" style="display:none;">
                        <input type="checkbox" id="sma0Show" onclick="checkForm()">Show SMA-0
                        <input type="text" id="sma0_value" value="10" style="width: 40px"><br>
                        <input type="checkbox" id="sma1Show" onclick="checkForm()">Show SMA-1
                        <input type="text" id="sma1_value" value="20" style="width: 40px"><br>
                        <input type="checkbox" id="ema2Show" onclick="checkForm()">Show EMA-2
                        <input type="text" id="ema2_value" value="50" style="width: 40px"><br>
                        <br>

                        <p><b> 4. MAC, RSI settings: </b></p>
                        <input type="checkbox" id="macdShow" onclick="checkForm()">Show MACD
                        <input type="checkbox" id="rsiShow" onclick="checkForm()">Show RSI
                        <br>

                        <p><b> 5. View settings: </b></p>
                        <select onchange="chartType(parseInt(this.value))">Point type
                            <option value="0">OHLC</option>
                            <option selected value="1">CandleStick</option>
                            <option value="2">Close</option>
                        </select>
                        <!--button onclick="chartType(0)">OHLC</button><br>
                        <button onclick="chartType(1)">CandleStick</button><br>
                        <button onclick="chartType(2)">Close</button--><br>
                        <br>
                        <button onclick="addTrendline()">Add trendline</button><br>

                        <br>
                        <button class="black_button" onclick="setBackground()">Change background</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/chart2/chart.v2.js"></script>
<script>
    $('ul.tabs_in_dashbord li:not(.active)').on('click', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs_in').find('div.tabs_in_dash').removeClass('active').eq($(this).index()).addClass('active');
    });
    // var dealChart = new Chart(document.getElementById('instrument_{{$row->id}}_chart'),{
    //     xhrInstrumentId: {{$row->id}},     // query type currency number
    //     xhrPeriodFull: 1440,    // data max period
    //     dataNum: 60,          // default zoom number of dataset in 1 screen
    //     xhrMaxInterval: 45000,  // renewal full data interval
    //     xhrMinInterval: 1000,    // ticks - min interval to update and redraw last close data
    //     btnVolume: true,       // bottom volume graph default state
    //     colorCandleBodyUp: "#f59" // example to change positive candle body
    // });
    createChart('#instrument_{{$row->id}}_chart','{{$row->title}}', '{{$row->to->code}}');
    $.ajax({
        url:'/data/amcharts/histominute?limit=1440&instrument_id={{$row->id}}',
        data:"json",
        success:function(d,x,s){
            for(var i in d){
                d[i].date = new Date(d[i].date);
            }
            dataChart(d);
            // checkForm();
        }
    });

    //    setPeriod(newData, 5);


    function currentPrice(container,d,x,s){
        container.html(d.price);
    }
    cf.reload();
</script>
