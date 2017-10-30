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
                <div id="instrument_{{$row->id}}_chart"></div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="/chart/assets/plugins/chart/chart.css">
<script type="text/javascript" src="/chart/assets/plugins/tether/js/tether.min.js"></script>
<script type="text/javascript" src="/chart/assets/plugins/d3/js/d3.v4.min.js"></script>
<script type="text/javascript" src="/chart/assets/plugins/d3/js/moment.js"></script>
<script type="text/javascript" src="/chart/assets/plugins/d3/js/utils.js"></script>
<script type="text/javascript" src="/chart/assets/plugins/chart/chart.js"></script>
<script>
    $('ul.tabs_in_dashbord li:not(.active)').on('click', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs_in').find('div.tabs_in_dash').removeClass('active').eq($(this).index()).addClass('active');
    });
    var dealChart = new Chart(document.getElementById('instrument_{{$row->id}}_chart'),{
        xhrInstrumentId: {{$row->id}},     // query type currency number
        xhrPeriodFull: 1440,    // data max period
        dataNum: 60,          // default zoom number of dataset in 1 screen
        xhrMaxInterval: 45000,  // renewal full data interval
        xhrMinInterval: 1000,    // ticks - min interval to update and redraw last close data
        btnVolume: true,       // bottom volume graph default state
        colorCandleBodyUp: "#f59" // example to change positive candle body
    });
    function currentPrice(container,d,x,s){
        container.html(d.price);
    }
    cf.reload();
</script>
