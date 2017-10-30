<div class="popup popup_b deals" style="display:block;">
    <div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <strong class="title">@lang('messages.deal_dashboard')</strong>

    <div class="contenta flex info info_deals">
        @if(isset($deal) && !is_null($deal->instrument))
        <div class="item dashblock-4">
            <span class="title">@lang('messages.instruments'): <b>{{ $deal->instrument->from->name }}/{{ $deal->instrument->to->name }}</b></span>
            <span class="text">@lang('messages.Komsd'): <b>{{ $deal->instrument->commission or '0' }}% </b></span>
            <span class="text">@lang('messages.direction'): <b>@if($deal->direction>0) buy @else sell @endif</b></span>
            <span class="text">@lang('messages.open_price'): <b>{{ $deal->open->price or '0' }}</b></span>
            <span class="text">@lang('messages.current'): <b class="loader" data-action="/json/price/{{$deal->instrument_id}}" data-name="current-price" data-autostart="true" data-refresh="1000" data-function="currentPrice">{{ $price->price or '0' }}</b></span>
            <span class="text">@lang('messages.Amount'): <b>{{ $deal->amount or '0' }}</b></span>
            <span class="text">@lang('messages.multiplier'): <b>{{ $deal->multiplier or '0' }}</b></span>
            <span class="text">@lang('messages.Profit'): <b>{{ $deal->profit or '0' }}</b></span>

        </div>
        @endif
        <div class="item dashblock">
            <div class="chart">
                <div id="deal_{{$deal->id}}_chart"></div>
            </div>
        </div>
        <div class="item dashblock-4 flex column">
            <!-- <span class="title">@lang('messages.User'): <a href="javascript:window.crm.user.info({{$deal->user->id}})">{{ $deal->user->name }} {{ $deal->user->surname }}</a></span>
            <span class="text">@lang('messages.manager'): <b>@if(!is_null($deal->user->manager)) {{ $deal->user->manager->name or 'no'}} {{ $deal->user->surname or 'manager'}} @endif</b></span> -->
            <div class="wrap">
                <script type="text/javascript" >
                    $(document).ready(function() {
                        $('.minus').click(function () {
                            var $input = $(this).parent().parent().find('input');
                            var count = parseInt($input.val()) - 1;
                            count = count < 1 ? 1 : count;
                            $input.val(count);
                            $input.change();
                            return false;
                        });
                        $('.plus').click(function () {
                            var $input = $(this).parent().parent().find('input');
                            $input.val(parseInt($input.val()) + 1);
                            $input.change();
                            return false;
                        });
                    });
                </script>
                <div class="real nnn">
                    <a href="/">Real</a>
                    <div class="wrap flex">
                        <span class="minus">-</span>
                        <input type="text" value="100" size="5" id="real"/>
                        <span class="plus">+</span>
                    </div>
                </div>
                <!-- <div class="number nnn">
                    <input type="text" value="100" size="5" id="number"/>
                    <div class="wrap flex">
                        <span class="minus">-</span>
                        <strong>Amount, %</strong>
                        <span class="plus">+</span>
                    </div>
                </div> -->
                <form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
                    <output for="flying" name="level">10</output>
                    <input name="flevel" id="flying" type="range" min="1" max="20" value="10" step="1">
                </form>
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
    var dealChart = new Chart(document.getElementById('deal_{{$deal->id}}_chart'),{
        xhrInstrumentId: {{$deal->instrument->id}},     // query type currency number
        xhrUserId: {{$deal->user->id}},     // query type currency number
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
