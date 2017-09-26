<div class="bot">
  <div class="container">
    <div class="flex flex-top">
      <div class="tabs">
        <ul class="tabs__caption flex width">
          <li class="flex active">
            <!-- <span>@lang('messages.history') </span>
            <span class="all">@lang('messages.all_history')</span> -->
            <span>active</span>
          </li>
          <li class="flex">
            <!-- <span>@lang('messages.news')</span>
            <span class="all">@lang('messages.all_news')</span> -->
            <span>signals</span>
          </li>
          <li class="flex">
            <!-- <span>@lang('messages.trade')</span>
            <span class="all">@lang('messages.Webinars')</span> -->
            <span>closed</span>
          </li>
        </ul>

        <div class="tabs__content active">
          <div class="table">
              @if(Auth::guest())
              @else
              <script>
                function historyDeals(container,d,x,s){
                    container.html('');
                    for(var i in d){

                        var row=d[i],s='<tr class="deal-row" onclick=\'dealInfo('+JSON.stringify(row)+')\' id="deal-'+row.id+'">',
                            inst = row.instrument.from_currency.code+'/'+row.instrument.to_currency.code,
                            prct = 100*(1-row.profit/row.amount);

                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+new Date(row.open_price.created_at*1000)+' - '+row.open_price.price+'</td>';
                        s+= (row.close_price!=undefined)?'<td>'+new Date(row.close_price.created_at*1000)+' - '+row.close_price.price+'</td>':'<td>&nbsp;</td>';
                        s+= '<td>'+currency.value(row.amount,'USD')+' <span>x'+row.multiplier+'</span></td>';
                        s+= '<td class="'+((row.close_price==undefined)?'profit':"")+'">'+currency.value(row.profit,'USD')+'</td>';
                        s+= '<td class="'+((row.profit>0)?"green":"red")+'">'+prct.toFixed(2)+'%</td>'
                        s+='</tr>';
                        container.append(s);
                    }
                }
              </script>
              <table class="width">
                <thead>
                  <th>@lang('messages.Assets')</th>
                  <th>@lang('messages.D/T/O')</th>
                  <th>@lang('messages.D/T/C')</th>
                  <th>@lang('messages.invested')</th>
                  <th>@lang('messages.received')</th>
                  <th>@lang('messages.Profit') %</th>
                </thead>
                <tbody class="loader" data-action="/deal?status=all&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="8000" data-function="historyDeals"></tbody>
                </table>
              @endif

          </div>
        </div>

        <div class="tabs__content">
          <div class="table table_ta">
            <div class="top flex flex-top">
              <strong>@lang('messages.tech')</strong>
              <ul class="flex">
                <li><a href="#">1 @lang('messages.min')</a></li>
                <li><a href="#">5 @lang('messages.min')</a></li>
                <li><a href="#">15 @lang('messages.min')</a></li>
                <li><a href="#">30 @lang('messages.min')</a></li>
                <li><a href="#">1 @lang('messages.hour')</a></li>
                <li><a href="#">5 @lang('messages.hour')</a></li>
                <li><a href="#">1 @lang('messages.day')</a></li>
                <li><a href="#">1 @lang('messages.week')</a></li>
                <li><a href="#">1 @lang('messages.month')</a></li>
              </ul>
            </div>
            <table class="width">
              <thead>
                <th>@lang('messages.instruments')</th>
                <th>RSI(14)</th>
                <th>STOCH(9,6)</th>
                <th>STOCHRSI(14)</th>
                <th>MACD(12,26)</th>
                <th>ADX(14)</th>
                <th>Williams (%R)</th>
                <th>CCI(14)</th>
                <th>ATR(14)</th>
              </thead>
              <tbody>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tabs__content">
          <div class="table">
              @if(Auth::guest())
              @else
              <script>
                function historyDeals(container,d,x,s){
                    container.html('');
                    for(var i in d){

                        var row=d[i],s='<tr class="deal-row" onclick=\'dealInfo('+JSON.stringify(row)+')\' id="deal-'+row.id+'">',
                            inst = row.instrument.from_currency.code+'/'+row.instrument.to_currency.code,
                            prct = 100*(1-row.profit/row.amount);

                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+new Date(row.open_price.created_at*1000)+' - '+row.open_price.price+'</td>';
                        s+= (row.close_price!=undefined)?'<td>'+new Date(row.close_price.created_at*1000)+' - '+row.close_price.price+'</td>':'<td>&nbsp;</td>';
                        s+= '<td>'+currency.value(row.amount,'USD')+' <span>x'+row.multiplier+'</span></td>';
                        s+= '<td class="'+((row.close_price==undefined)?'profit':"")+'">'+currency.value(row.profit,'USD')+'</td>';
                        s+= '<td class="'+((row.profit>0)?"green":"red")+'">'+prct.toFixed(2)+'%</td>'
                        s+='</tr>';
                        container.append(s);
                    }
                }
              </script>
              <table class="width">
                <thead>
                  <th>@lang('messages.Assets')</th>
                  <th>@lang('messages.D/T/O')</th>
                  <th>@lang('messages.D/T/C')</th>
                  <th>@lang('messages.invested')</th>
                  <th>@lang('messages.received')</th>
                  <th>@lang('messages.Profit') %</th>
                </thead>
                <tbody class="loader" data-action="/deal?status=all&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="8000" data-function="historyDeals"></tbody>
                </table>
              @endif

          </div>
          <!-- <div class="education flex column">
            <h2>@lang('messages.Indicators')</h2>
            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/rsi.png" alt="">
                  </div>
                  <strong>RSI</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/stochastic.png" alt="">
                  </div>
                  <strong>Stochastic</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/parabolic.png" alt="">
                  </div>
                  <strong>Parabolic SAR</strong>
                </li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>RSI</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title1')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/RSI" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Stochastic</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title2')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>7</span></p>
                  <a href="/page/Stochastic" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Parabolic SAR</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title3')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/Parabolic-SAR" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
            </div>
            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/macd.png" alt="">
                  </div>
                  <strong>MACD</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/sma.png" alt="">
                  </div>
                  <strong>SMA</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/bollinger.png" alt="">
                  </div>
                  <strong>Bollinger Bands</strong>
                </li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>MACD</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title4')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>4</span></p>
                  <a href="/page/MACD" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>SMA</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title5')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>7</span></p>
                  <a href="/page/SMA" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Bollinger Bands</strong>
                  <span>@lang('messages.Indicator')</span>
                  <p>@lang('messages.title6')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/Bollinger-Bands" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
            </div>

            <h2>@lang('messages.Trst')</h2>
            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/sma2.png" alt="">
                  </div>
                  <strong>@lang('messages.srednie')</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/macd_st.png" alt="">
                  </div>
                  <strong>MACD professional</strong>
                </li>
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/icco.png" alt="">
                  </div>
                  <strong>@lang('messages.yapst')</strong>
                </li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>@lang('messages.srednie')</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title7')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Скользим-по-средним" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>MACD professional</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title8')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/MACD-professional" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>@lang('messages.yapst')</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title9')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Японский-стандарт" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
            </div>

            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/rsi2.png" alt="">
                  </div>
                  <strong>@lang('messages.zakon')</strong>
                </li>
                <li></li>
                <li></li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>@lang('messages.zakon')</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title10')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>@lang('messages.zakon')</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title11')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>@lang('messages.zakon')</strong>
                  <span>@lang('messages.Strategy')</span>
                  <p>@lang('messages.title12')</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">@lang('messages.training')</a>
                </div>
              </div>
            </div>
          </div> -->

        </div>

      </div><!-- .tabs-->

      <!-- <div class="news_n">
        <h2>Криптоновости</h2>
        <ul>
          <li class="flex">
            <a href="#">GAS NEO VS. ГАЗ ETHEREUM</a>
            <p class="date">26 Август 2017</p>
          </li>
          <li class="flex">
            <a href="#">СТРАХИ И СОМНЕНИЯ...</a>
            <p class="date">27 Август 2017</p>
          </li>
          <li class="flex">
            <a href="#">СОЗДАТЕЛЬ ARAGON: ЧЕРЕЗ...</a>
            <p class="date">28 Август 2017</p>
          </li>
          <li class="flex">
            <a href="#">НОВЫЕ ПРАВИЛА КИТАЯ...</a>
            <p class="date">28 Август 2017</p>
          </li>
        </ul>
        <a href="#" class="more">Все новости ></a>
      </div> -->
    </div>
  </div>
</div>
