<script>
function multiplier(t){
    var r = $($(t).attr("data-target")),v = $(t).val(),amt = $(t).closest(".submiter").find("[data-name=amount]").val();
    console.debug(v,amt);
    r.text(v*amt);
}
</script>
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
                    <ul class="tab_item">
                        <li class="active">Сейчас</li>
                        <li>При котировке</li>
                    </ul>
                    <div class="tab_cap active submiter" data-action="/deal/add" data-callback="pageReload">
                        <div class="box">
                            <div class="item flex">
                                <div class="inner">
                                    <p>Сумма сделки</p>
                                </div>
                                <div class="inner">
                                    <input type="text" name="num" placeholder="1000" data-name="amount" value="100">
                                </div>
                            </div>
                            <div class="item flex">
                                <div class="inner">
                                    <p>Кредитное плечо</p>
                                </div>
                                <div class="inner flex">
                                    <input type="text" name="kr" placeholder="20"  value="20" data-name="multiplier" onchange="multiplier(this)" class="multiplier" data-target=".multiplier-result">
                                    <p>=</p>
                                    <p><span class="multiplier-result">$20 000</span></p>
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
                                    <input type="text" name="pr"  data-name="stop_high" placeholder="300" value=0>
                                </div>
                                <div class="inner flex">
                                    <span></span>
                                    <p>Прибыль</p>
                                    <p>+ 30.00%</p>
                                    <input type="text" name="yb" data-name="stop_low" placeholder="300" value=0>
                                </div>
                            </div>
                        </div>
                        <div class="bot flex">
                            <input name="instrument_id" value="1" type="hidden" data-name="instrument_id"/>
                            <input name="direction" value="1" type="hidden" data-name="direction"/>
                            <input name="currency" value="USD" type="hidden" data-name="currency" />
                            <a onclick="$('[name=direction]').val(-1);" class="down submit btn">В снижение</a>
                            <a onclick="$('[name=direction]').val(1);" class="up submit btn">В рост</a>
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
                    <div class="tab_cap">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <!-- <div class="deal loader" data-action="/deal" data-autostart="true" data-refresh="10000" data-function="userDeals"></div> -->
            <div class="bot">
                <ul class="flex">
                    <li class="active"><a href="#">Отчет</a></li>
                    <li><a href="#">Закрытые</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>