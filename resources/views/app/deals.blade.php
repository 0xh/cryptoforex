<aside class="right">
    <script>
        function multiplier(t){
            var r = $($(t).attr("data-target")),v = $(t).val(),amt = $(t).closest(".submiter").find("[data-name=amount]").val();
            console.debug(v,amt);
            r.text(v*amt);
        }
        function dealInfo(deal){
            $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
            $('.popup_deal_info,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
            var rchart = null, time = new Date(deal.created_at*1000);
            // console.debug(deal);
            // graphControl.makeChart(120,"chartdiv_p1",null,rchart);

            window.SubChart = new Chart(document.getElementById('chartdiv_p1'), {
                xhrInstrumentId: deal.intrument_id,     // query type currency number
                xhrPeriodFull: 1440,    // data max period
                dataNum: 60,          // default zoom number of dataset in 1 screen
                xhrMaxInterval: 45000,  // renewal full data interval
                xhrMinInterval: 1000,    // ticks - min interval to update and redraw last close data
                btnVolume: true,       // bottom volume graph default state
            });

            $('.popup_deal_info .deal-profit').html('<span class="'+((deal.profit>0)?"up":"down")+'">'+deal.profit+'</span>');
            $('.popup_deal_info .deal-time').html('<p><span class="time">'+time.toGMTString()+'</span></p>');
            $('.popup_deal_info .deal-amount').html('<p>'+currency.value(deal.amount,deal.currency.code)+'</p>');
            $('.popup_deal_info .deal-multiplier').html('<p>'+currency.value(deal.amount*deal.multiplier,deal.currency.code)+'</p>');
            $('.popup_deal_info #deal_id').val(deal.id);
            $('.popup_deal_info .close').on("click",function(e){
                console.debug("close deal info modal",window.SubChart);
                delete window.SubChart;
                $('#chartdiv_p1').html('');
            });
        }
        function userDeals(container,d,x,s){
            // console.debug("deals",container,d);
            if(!container.find('.title').length)container.append('<div class="item flex title"><div class="inner">Инструмент</div><div class="inner">Вложено</div><div class="inner">Прибыль</div></div>');
            for(var i in d.data){
                var row=d.data[i];
                // console.debug(row);
                var inst = "BTC/BCH",profit = row.profit,amount = currency.value(row.amount,'USD'), profit_type=(profit>0)?'up':'down';
                if(!container.find('#deal-'+row.id).length)container.append('<div onclick=\'dealInfo('+JSON.stringify(row)+')\' id="deal-'+row.id+'" class="item flex deal-row"><div class="inner instrument">'+inst+'</div><div class="inner amount">'+amount+'</div><div class="inner '+profit_type+' profit">'+profit+'</div></div>');
                else{
                    // container.find('#deal-'+row.id+' .intrument').text(inst);
                    container.find('#deal-'+row.id+' .profit').text(profit).removeClass('up').removeClass('down').addClass(profit_type);
                    // container.find('#deal-'+row.id+' .amount').text(amount);
                }
            }
        }
        function dealAdd(d){
            if(d.error){
                $('.popup').hide();
                $('<div class="popup popup_open" style="display: block;"><div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div><strong>Error!</strong>\
                    <p>'+d.message+'</p></div>').appendTo('body');
            }
        }
        _onload.push(
            function(){
                $('#deal_amount').on("change keyup",function(){
                    var val = parseFloat($(this).val());
                    $('[data-name=amount]').val(val);
                    if(!$('#profit_active').is(':checked'))$('[data-name=stop_high]').val(100*val);
                });
                $('#flying').on("change keyup",function(){$('[data-name=multiplier]').val($(this).val());});
                $('#take_profit').on("change keyup",function(){
                    if($('#profit_active').is(':checked'))$('[data-name=stop_high]').val($(this).val());
                });
                $('#stop_loss').on("change keyup",function(){
                    if($('#loss_active').is(':checked'))$('[data-name=stop_low]').val($(this).val());
                });
                $('#atprice').on("change keyup",function(){
                    if($('#atprice_active').is(':checked'))
                        $('[data-name=atprice]').val($(this).val());
                });
                $('#atprice_active').on("change",function(){
                    ($('#atprice_active').is(':checked'))
                        ?$('[data-name=delayed]').val("true")
                        :$('[data-name=delayed]').val("false");
                });
            }
        );
    </script>
    <div class="deal">
        <div class="tabs_popup white">
          <!-- <ul class="tab_item">
            <li class="active">Сейчас</li>
            <li>При котировке</li>
          </ul> -->
          <div class="submiter tab_cap active" data-action="/json/deal/add" data-callback="dealAdd">
            <div class="box">
              <div class="info flex">
                <p>BTC/USD</p>
                <p>3,967.28</p>
              </div>
              <strong>@lang('messages.Sumsd')</strong>
              <div class="number">
                <input type="text" value="100" size="5" id="deal_amount"/>
                <div class="wrap flex">
                  <span class="minus">-</span>
                  <span class="plus">+</span>
                </div>
              </div>
              <strong>@lang('messages.Krpl')</strong>
              <form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
                <output for="flying" name="level">10</output>
                <input name="flevel" id="flying" type="range" min="1" max="20" value="10" step="1">
              </form>
            </div>
            <div class="bot flex">
                <div class="advance flex column">
                    <h2>Advance</h2>
                    <ul class="flex jcsb">
                        <li class="active">TP</li>
                        <li>SL</li>
                        <li>ATP</li>
                    </ul>
                    <div class="wrap">
                        <div class="left">
                            <div class="item">
                                <div>
                                    <input type="checkbox" class="checkbox" id="profit_active" value="">
                                    <label for="profit_active">Take Profit (TP)</label>
                                </div>
                                <div class="flex active">
                                    <input type="number" value="0" size="0.00001" id="take_profit"/>
                                    <div class="wrap flex">
                                      <span class="minus">-</span>
                                      <span class="plus">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <input type="checkbox" class="checkbox" id="loss_active" value="">
                                    <label for="loss_active">Stop Loss (SL)</label>
                                </div>
                                <div class="flex active">
                                    <input type="number" value="0" size="0.00001" id="stop_loss"/>
                                    <div class="wrap flex">
                                      <span class="minus">-</span>
                                      <span class="plus">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <strong>At the price</strong>
                            <div>
                                <input type="checkbox" class="checkbox" id="atprice_active" value="">
                                <label for="atprice_active">At the price</label>
                            </div>
                            <div class="flex active">
                                <input type="number" value="0" size="0.00001" id='atprice'>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="atprice" value="" type="hidden" data-name="atprice"/>
                <input name="amount" value="100" type="hidden" data-name="amount"/>
                <input name="stop_high" value="100" type="hidden" data-name="stop_high"/>
                <input name="stop_low" value="0" type="hidden" data-name="stop_low"/>
                <input name="multiplier" value="10" type="hidden" data-name="multiplier"/>
                <input name="instrument_id" value="1" type="hidden" data-name="instrument_id"/>
                <input name="direction" value="1" type="hidden" data-name="direction"/>
                <input name="currency" value="USD" type="hidden" data-name="currency" />
                <input name="delayed" value="false" type="hidden" data-name="delayed" />


                <a  onclick="$('[name=direction]').val(1);" href="#" class="up flex submit">
                    <div class="flex instrument-price-buy">
                        <p>3782.</p>
                        <b>50</b>
                    </div>
                    <b>@lang('messages.BUY')</b>
                </a>
                <a onclick="$('[name=direction]').val(-1);" href="#" class="down flex submit">
                    <div class="flex instrument-price-sell">
                        <p class="">3758.</p>
                        <b class="instrument-bid">60</b>
                    </div>
                    <b>@lang('messages.SELL')</b>
                </a>

            </div>
            <!-- <div class="work_order flex">
              <p>BTC/BCH</p>
              <p class="down"></p>
              <p>$ <span>180.24</span></p>
            </div> -->
          </div>
          <div class="opan_order hidden flex column">
            <h2>@lang('messages.open')</h2>
            <div class="work_order flex">
              <p>BTC/BCH</p>
              <p class="down"></p>
              <p>$ <span>180.24</span></p>
            </div>
            <a onclick="$('[name=direction]').val(-1);" href="#" class="down flex submit">@lang('messages.open_new')</a>
          </div>
        </div>
    </div>
</aside>
