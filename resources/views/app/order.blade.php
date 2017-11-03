<script>
function multiplier(t){
    var r = $($(t).attr("data-target")),v = $(t).val(),amt = $(t).closest(".submiter").find("[data-name=amount]").val();
    console.debug(v,amt);
    r.text(v*amt);
}
</script>

<div class="popup popup_deposit">
  <div class="close"></div>
  <strong>Deposit</strong>
  <div class="item top">
      <div class="inner flex">
          <p>Demo account</p>
          <b class="live-demo-account"><i class="demo"></i>10 000.00</b>
      </div>
      <div class="inner">
          <p>You can add funds to your demo account, if your balance is less than <i class="demo"></i>5 000</p>
      </div>
      <div class="inner">
          <a href="#">
              <span>Deposit</span>
              <span>up to <i class="demo"></i>10 000</span>
          </a>
      </div>
  </div>
  <div class="item bot">
      <div class="inner flex">
          <p>Live account</p>
          <b class="live-real-account"><i class="real"></i>10 000.00</b>
      </div>
      <div class="inner">
          <p>Trade on a real account and make a profit</p>
      </div>
      <div class="inner">
          <a href="#">
              <span>Deposit</span>
              <!-- <span>From <i class="real"></i>350</span> -->
          </a>
      </div>
  </div>
</div>

<div class="popup popup_open">
  <div class="close"></div>
  <strong>Done!</strong>
  <p>Trade on Bitcoin is opened</p>
  <p>Comission is $9.27 <i class="ic"></i></p>
  <a href="#" class="order">Open new trade</a>
</div>

<div class="popup popup_close">
  <div class="close"></div>
  <!-- <div class="submiter tab_cap active" data-action="/deal/add" data-callback="pageReload">
    <div class="box">
      <div class="info flex">
        <p>BTC/USD</p>
        <p>3,967.28</p>
      </div>
      <strong>@lang('messages.Sumsd')</strong>
      <div class="number">
        <input type="text" value="100" size="5"/>
        <div class="wrap flex">
          <span class="minus">-</span>
          <span class="plus">+</span>
        </div>
      </div>
      <strong>@lang('messages.Krpl')</strong>
      <form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
        <output for="flying" name="level">0</output>
        <input name="flevel" id="flying" class="flying" type="range" min="1" max="20" value="10" step="1">
      </form>
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
            <b>@lang('messages.SELL')</b>
        </a>
        <a  onclick="$('[name=direction]').val(1);" href="#" class="up flex submit">
            <div class="flex">
                <p>3782.</p>
                <b>50</b>
            </div>
            <b>@lang('messages.BUY')</b>
        </a>
    </div>
  </div> -->

  <div class="submiter tab_cap active" data-action="/json/deal/add" data-callback="dealAddPopup">
    <div class="box">
      <div class="info flex current-instrument">
        <p>BTC/USD</p>
        <p>3,967.28</p>
      </div>
      <strong>@lang('messages.Sumsd')</strong>
      <div class="number">
        <input type="text" value="100" size="5" id="deal_amount" class="deal_amount"/>
        <div class="wrap flex">
          <span class="minus">-</span>
          <span class="plus">+</span>
        </div>
      </div>
      <strong>@lang('messages.Krpl')</strong>
      <form onsubmit="return false" oninput="level.value = flevel.valueAsNumber">
        <output for="flying" name="level">10</output>
        <input name="flevel" id="flying" class="flying" class="flying" type="range" min="1" max="20" value="10" step="1">
      </form>
    </div>
    <div class="bot flex column">
      <div class="advance flex column">
        <h2>Advance</h2>
        <ul class="flex jcsb">
            <li class="active">Take Profit</li>
            <li>Stop Loss</li>
            <li>At to Price</li>
        </ul>
        <div class="wrap width">
            <div class="left">
                <div class="item flex">
                    <div>
                        <input type="checkbox" class="checkbox" id="profit_active_p" value="">
                        <label for="profit_active_p">Take Profit (TP)</label>
                    </div>
                    <div class="flex active">
                        <input type="number" value="0" size="0.00001" id="take_profit_p">
                        <div class="wrap flex">
                          <span class="minus">-</span>
                          <span class="plus">+</span>
                        </div>
                    </div>
                </div>
                <div class="item flex">
                    <div>
                        <input type="checkbox" class="checkbox" id="loss_active_p" value="">
                        <label for="loss_active_p">Stop Loss (SL)</label>
                    </div>
                    <div class="flex active">
                        <input type="number" value="0" size="0.00001" id="stop_loss_p">
                        <div class="wrap flex">
                          <span class="minus">-</span>
                          <span class="plus">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <!-- <strong>At the price</strong> -->
                <div>
                    <input type="checkbox" class="checkbox" id="atprice_active_p" value="">
                    <label for="atprice_active_p">At the price</label>
                </div>
                <div class="flex">
                    <input type="number" value="0" size="0.00001" id="atprice_p">
                </div>
            </div>
        </div>
    </div>
    <div class="flex width">
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

<div class="popup popup_order">
    <div class="close b02"></div>
    <div class="flex flex-top">
        <div class="flex flex-top left">
            <div class="item">
                <div class="content flex column">
                    <div id="chartdiv_p" class="graph"></div>
                    <div class="btn-group">
                        <button onclick="graphControl.CandleStick()">CandleStick</button>
                        <button onclick="graphControl.Line()">Line</button>
                        <button onclick="graphControl.OHLC()">OHLC</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="tabs_popup">
                    <!-- <ul class="tab_item">
                        <li class="active">Сейчас</li>
                        <li>При котировке</li>
                    </ul> -->
                    <div class="tab_cap active submiter" data-action="/deal/add" data-callback="pageReload">
                        <div class="box">
                            <div class="item flex">
                                <div class="inner">
                                    <p>@lang('messages.Sumsd')</p>
                                </div>
                                <div class="inner">
                                    <input type="text" name="num" placeholder="1000" data-name="amount" value="100">
                                </div>
                            </div>
                            <div class="item flex">
                                <div class="inner">
                                    <p>@lang('messages.Krpl')</p>
                                </div>
                                <div class="inner flex">
                                    <input type="text" name="kr" placeholder="20"  value="20" data-name="multiplier" onchange="multiplier(this)" class="multiplier" data-target=".multiplier-result">
                                    <p>=</p>
                                    <p><span class="multiplier-result">$20 000</span></p>
                                </div>
                            </div>
                            <div class="item flex">
                                <div class="inner">
                                    <p><span>@lang('messages.Komsd')</span></p>
                                </div>
                                <div class="inner">
                                    <p><span class="kr">2.673%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="item flex">
                                <p>@lang('messages.ogrpr')</p>
                            </div>
                            <div class="item flex column">
                                <div class="inner flex">
                                    <span class="active"></span>
                                    <p>@lang('messages.Profit')</p>
                                    <p>+ 30.00%</p>
                                    <input type="text" name="pr"  data-name="stop_high" placeholder="300" value=0>
                                </div>
                                <div class="inner flex">
                                    <span></span>
                                    <p>@lang('messages.Profit')</p>
                                    <p>+ 30.00%</p>
                                    <input type="text" name="yb" data-name="stop_low" placeholder="300" value=0>
                                </div>
                            </div>
                        </div>
                        <div class="bot flex">
                            <input name="instrument_id" value="1" type="hidden" data-name="instrument_id"/>
                            <input name="direction" value="1" type="hidden" data-name="direction"/>
                            <input name="currency" value="USD" type="hidden" data-name="currency" />
                            <a onclick="$('[name=direction]').val(-1);" class="down submit btn">@lang('messages.SELL')</a>
                            <a onclick="$('[name=direction]').val(1);" class="up submit btn">@lang('messages.BUY')</a>
                        </div>
                        <!-- <div class="box">
                          <div class="item flex">
                            <div class="inner">
                              <strong class="up">Прибыль</strong>
                            </div>
                            <div class="inner">
                              <span class="up">27 $</span>
                            </div>
                          </div>
                          <div class="item flex">
                            <div class="inner">
                              <strong>Пара</strong>
                            </div>
                            <div class="inner flex">
                              <strong><span>BTC</span>/<span>BCH</span></strong>
                            </div>
                          </div>
                          <div class="item flex">
                            <div class="inner">
                              <strong>Время открытия</strong>
                            </div>
                            <div class="inner">
                              <p><span class="time">11:00 06.09.17</span></p>
                            </div>
                          </div>
                        </div>
                        <div class="box">
                          <div class="item flex">
                            <div class="inner">
                              <p>Сумма сделки</p>
                            </div>
                            <div class="inner">
                              <p>100$</p>
                            </div>
                          </div>
                          <div class="item flex">
                            <div class="inner">
                              <p>Кредитное плечо</p>
                            </div>
                            <div class="inner">
                              <p>5000$</p>
                            </div>
                          </div>
                          <div class="item flex">
                            <div class="inner">
                              <p>Комиссия сделки</p>
                            </div>
                            <div class="inner">
                              <p>0.023%</p>
                            </div>
                          </div>
                        </div>
                        <div class="bot flex">
                          <a href="#" class="order close b02">Закрыть сделку</a>
                        </div> -->
                    </div>
                    <!-- <div class="tab_cap">
                        <div class="box">
                            <div class="item flex">
                                <div class="inner">
                                    <p>Сумма сделки</p>
                                </div>
                                <div class="inner">
                                    <input type="text" name="num" placeholder="1000" data-name="amount">
                                </div>
                            </div>
                            <div class="item flex">
                                <div class="inner">
                                    <p>Кредитное плечо</p>
                                </div>
                                <div class="inner flex">
                                    <input type="text" name="kr" placeholder="20" data-name="multiplier">
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
                                    <input type="text" name="pr" placeholder="300" data-name="price_start">
                                </div>
                                <div class="inner flex">
                                    <span></span>
                                    <p>Убыток</p>
                                    <p>+ 30.00%</p>
                                    <input type="text" name="yb" placeholder="300"  data-name="price_stop">
                                </div>
                            </div>
                        </div>
                        <div class="bot flex">
                            <a href="#" class="down">В снижение</a>
                            <a href="#" class="up">В рост</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="right">
            <!-- <div class="deal loader" data-action="/deal" data-autostart="true" data-refresh="10000" data-function="userDeals"></div> -->
            <div class="bot">
                <ul class="flex">
                    <li class="active"><a href="#">@lang('messages.Report')</a></li>
                    <li><a href="#">@lang('messages.Closed')</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
