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
            var rchart = null;
            // console.debug(deal);
            graphControl.makeChart(120,"chartdiv_p1",null,rchart);
            $('.popup_deal_info .deal-profit').html('<span class="'+((deal.profit>0)?"up":"down")+'">'+deal.profit+'</span>');
            $('.popup_deal_info .deal-time').html('<p><span class="time">'+new Date(deal.created_at*1000)+'</span></p>');
            $('.popup_deal_info .deal-amount').html('<p>'+currency.value(deal.amount,deal.currency.code)+'</p>');
            $('.popup_deal_info .deal-multiplier').html('<p>'+currency.value(deal.amount*deal.multiplier,deal.currency.code)+'</p>');
            $('.popup_deal_info #deal_id').val(deal.id);
        }
        function userDeals(container,d,x,s){
            // console.debug("deals",container,d);
            if(!container.find('.title').length)container.append('<div class="item flex title"><div class="inner">Инструмент</div><div class="inner">Вложено</div><div class="inner">Прибыль</div></div>');
            for(var i in d){
                var row=d[i];
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
        $(document).ready(function(){
            $('#deal_amount').on("change keyup",function(){$('[data-name=amount],[data-name=stop_high]').val($(this).val());});
            $('#flying').on("change keyup",function(){$('[data-name=multiplier]').val($(this).val());});
        });
    </script>
    <div class="deal">
        <div class="tabs_popup white">
          <!-- <ul class="tab_item">
            <li class="active">Сейчас</li>
            <li>При котировке</li>
          </ul> -->
          <div class="submiter tab_cap active" data-action="/json/deal/add" data-callback="pageReload">
            <div class="box">
              <div class="info flex">
                <p>BTC/USD</p>
                <p>3,967.28</p>
              </div>
              <strong><?php echo app('translator')->getFromJson('messages.Sumsd'); ?></strong>
              <div class="number">
                <input type="text" value="100" size="5" id="deal_amount"/>
                <div class="wrap flex">
                  <span class="minus">-</span>
                  <span class="plus">+</span>
                </div>
              </div>
              <strong><?php echo app('translator')->getFromJson('messages.Krpl'); ?></strong>
              <form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
                <output for="flying" name="level">10</output>
                <input name="flevel" id="flying" type="range" min="1" max="20" value="10" step="1">
              </form>
            </div>
            <div class="bot flex">
                <input name="amount" value="100" type="hidden" data-name="amount"/>
                <input name="stop_high" value="100" type="hidden" data-name="stop_high"/>
                <input name="stop_low" value="0" type="hidden" data-name="stop_low"/>
                <input name="multiplier" value="10" type="hidden" data-name="multiplier"/>
                <input name="instrument_id" value="1" type="hidden" data-name="instrument_id"/>
                <input name="direction" value="1" type="hidden" data-name="direction"/>
                <input name="currency" value="USD" type="hidden" data-name="currency" />
                <a onclick="$('[name=direction]').val(-1);" href="#" class="down flex submit">
                    <div class="flex">
                        <p>3758.</p>
                        <b>60</b>
                    </div>
                    <b><?php echo app('translator')->getFromJson('messages.SELL'); ?></b>
                </a>
                <a  onclick="$('[name=direction]').val(1);" href="#" class="up flex submit">
                    <div class="flex">
                        <p>3782.</p>
                        <b>50</b>
                    </div>
                    <b><?php echo app('translator')->getFromJson('messages.BUY'); ?></b>
                </a>
            </div>
            <!-- <div class="work_order flex">
              <p>BTC/BCH</p>
              <p class="down"></p>
              <p>$ <span>180.24</span></p>
            </div> -->
          </div>
          <div class="opan_order hidden flex column">
            <h2><?php echo app('translator')->getFromJson('messages.open'); ?></h2>
            <div class="work_order flex">
              <p>BTC/BCH</p>
              <p class="down"></p>
              <p>$ <span>180.24</span></p>
            </div>
            <a onclick="$('[name=direction]').val(-1);" href="#" class="down flex submit"><?php echo app('translator')->getFromJson('messages.open_new'); ?></a>
          </div>
          <!-- <div class="tab_cap submiter" data-action="/deal/add" data-callback="pageReload">
            <div class="box">
              <div class="item flex">
                <div class="inner">
                  <p>Сумма сделки</p>
                </div>
                <div class="inner">
                  <input type="text" name="num" placeholder="1000">
                </div>
              </div>
              <div class="item flex">
                <div class="inner">
                  <p>Кредитное плечо</p>
                </div>
                <div class="inner flex">
                  <input type="text" name="kr" placeholder="20">
                  <p>=</p>
                  <p><span>$20 000</span></p>
                </div>
              </div>
              <div class="item flex">
                <div class="inner">
                  <p><span>Комиссия сделки</span></p>
                </div>
                <div class="inner">
                  <p><span class="kr">2.673%</span></p>
                </div>
              </div>
            </div>
            <div class="box">
              <div class="item flex">
                <p>Ограничение прибыли / убытка</p>
              </div>
              <div class="item flex column">
                <div class="inner flex">
                  <span class="active"></span>
                  <p>Прибыль</p>
                  <p>+ 30.00%</p>
                  <input type="text" name="pr" placeholder="300">
                </div>
                <div class="inner flex">
                  <span></span>
                  <p>Прибыль</p>
                  <p>+ 30.00%</p>
                  <input type="text" name="yb" placeholder="300">
                </div>
              </div>
            </div>
            <div class="bot flex">
                <input name="instrument_id" value="1" type="hidden" data-name="instrument_id"/>
                <input name="direction" value="1" type="hidden" data-name="direction"/>
                <input name="currency" value="USD" type="hidden" data-name="currency" />
                <a onclick="$('[name=direction]').val(-1);" href="#" class="down flex submit">
                    <div class="flex">
                        <p>3758.</p>
                        <b>60</b>
                    </div>
                    <b>SELL</b>
                </a>
                <a  onclick="$('[name=direction]').val(1);" href="#" class="up flex submit">
                    <div class="flex">
                        <p>3782.</p>
                        <b>50</b>
                    </div>
                    <b>BUY</b>
                </a>
            </div>
          </div> -->
        </div>
        <!-- <h2>Активные сделки</h2>
        <div class="flex column">
            <div class="flex column width mh">
                <div class="top loader" data-action="/deal" data-autostart="true" data-refresh="60000" data-function="userDeals"></div> -->

                    <!-- <div class="item flex"><div class="inner">BTC/ETH</div><div class="inner">100.00$</div><div class="inner down">-3.54$</div></div>
                    <div class="item flex">
                        <div class="inner">BTC/ETH</div>
                        <div class="inner">100.00$</div>
                        <div class="inner down">-7.23$</div>
                    </div>
                    <div class="item flex">
                        <div class="inner">LTE/STEEM</div>
                        <div class="inner">100.00$</div>
                        <div class="inner up">23.15$</div>
                    </div>
                    <div class="item flex">
                        <div class="inner">DOGE/DASH</div>
                        <div class="inner">100.00$</div>
                        <div class="inner up">16.76$</div>
                    </div> -->

                <!-- <div class="bot">
                    <ul class="flex">
                        <li class="active"><a href="./page/analitica" class="b03">Аналитика</a></li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="new width"> -->
                <!-- <div class="flex">
                    <div class="inner">
                        <p>BTC/LTE</p>
                    </div>
                    <div class="inner">
                        <p class="up">1.17935</p>
                    </div>
                    <div class="inner">
                        <p class="down">-0.25%</p>
                    </div>
                </div> -->
                <!-- <a href="#" class="order b01">Открыть сделку</a>
            </div>
        </div> -->
    </div>
</aside>
