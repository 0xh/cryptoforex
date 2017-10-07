<div class="bot">
  <div class="container">
    <div class="flex flex-top">
      <div class="tabs">
        <ul class="tabs__caption flex width">
          <li class="flex active">
            <span>История сделок</span>
            <span class="all">вся история</span>
          </li>
          <li class="flex">
            <span>Новости и прогнозы</span>
            <span class="all">Все новости</span>
          </li>
          <li class="flex">
            <span>Обучение торговле</span>
            <span class="all">Вебинары</span>
          </li>
        </ul>

        <div class="tabs__content active">
          <div class="table">
              <?php if(Auth::guest()): ?>
              <?php else: ?>
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
                  <th>Актив</th>
                  <th>Дата/время/цена открытия</th>
                  <th>Дата/время/цена закрытия</th>
                  <th>вложено</th>
                  <th>получено</th>
                  <th>прибыль%</th>
                </thead>
                <tbody class="loader" data-action="/deal?status=all&user_id=<?php echo e(Auth::user()->id); ?>" data-autostart="true" data-refresh="8000" data-function="historyDeals"></tbody>
                </table>
              <?php endif; ?>

          </div>
        </div>

        <div class="tabs__content">
          <div class="table table_ta">
            <div class="top flex flex-top">
              <strong>Технический анализ</strong>
              <ul class="flex">
                <li><a href="#">1 мин</a></li>
                <li><a href="#">5 мин</a></li>
                <li><a href="#">15 мин</a></li>
                <li><a href="#">30 мин</a></li>
                <li><a href="#">1 час</a></li>
                <li><a href="#">5 час</a></li>
                <li><a href="#">1 день</a></li>
                <li><a href="#">1 неделя</a></li>
                <li><a href="#">1 месяц</a></li>
              </ul>
            </div>
            <table class="width">
              <thead>
                <th>Инструмент</th>
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
          <div class="education flex column">
            <h2>Индикаторы</h2>
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
                  <span>Индикатор</span>
                  <p>Определяйте силу тренда с первого взгляда и получайте доход на самых популярных активах.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/RSI" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Stochastic</strong>
                  <span>Индикатор</span>
                  <p>Используйте линии Stochastic, чтобы отследить изменение цены актива и открывать прибыльные сделки.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>7</span></p>
                  <a href="/page/Stochastic" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Parabolic SAR</strong>
                  <span>Индикатор</span>
                  <p>Определяйте моменты разворота тренда, используя Parabolic SAR, и находите оптимальные точки для входа в рынок.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/Parabolic-SAR" target="_blank" class="order">Пройти обечение</a>
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
                  <span>Индикатор</span>
                  <p>Применяйте гистограмму и линии MACD, чтобы не пропустить момент зарождения тренда, и заключайте максимум прибыльных сделок.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>4</span></p>
                  <a href="/page/MACD" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>SMA</strong>
                  <span>Индикатор</span>
                  <p>Усредняйте данные о цене с помощью SMA, чтобы определить тренд и понять, когда он заканчивается.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>7</span></p>
                  <a href="/page/SMA" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Bollinger Bands</strong>
                  <span>Индикатор</span>
                  <p>Отслеживайте направление тренда и находите точки разворота при помощи Bollinger bands.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>6</span></p>
                  <a href="/page/Bollinger-Bands" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
            </div>

            <h2>Торговые стратегии</h2>
            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/sma2.png" alt="">
                  </div>
                  <strong>Скользим по средним</strong>
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
                  <strong>Японский стандарт</strong>
                </li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Скользим по средним</strong>
                  <span>Стратегия</span>
                  <p>Используйте популярный индикатор SMA, как настоящий профи: открывайте сразу две скользящие средние и получайте точные сигналы круглосуточно.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Скользим-по-средним" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>MACD professional</strong>
                  <span>Стратегия</span>
                  <p>Научитесь получать многоуровневые сигналы сразу от трех инструментов и совершайте максимально точные и успешные сделки в момент зарождения тренда.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/MACD-professional" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Японский стандарт</strong>
                  <span>Стратегия</span>
                  <p>Научитесь «читать» японские свечи и получайте точные сигналы для открытия сделок, даже без применения индикаторов.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Японский-стандарт" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
            </div>

            <div class="box">
              <ul class="flex width">
                <li>
                  <div class="img" data-img="БИНАРНЫЙ ГАМБИТ">
                    <img src="images/rsi2.png" alt="">
                  </div>
                  <strong>Закон относительной силы</strong>
                </li>
                <li></li>
                <li></li>
              </ul>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Закон относительной силы</strong>
                  <span>Стратегия</span>
                  <p>Научитесь находить точки разворота тренда, используя всего один осциллятор.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Закон относительной силы</strong>
                  <span>Стратегия</span>
                  <p>Научитесь находить точки разворота тренда, используя всего один осциллятор.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
              <div class="slide hidden flex flex-top">
                <div class="item">
                  <strong>Закон относительной силы</strong>
                  <span>Стратегия</span>
                  <p>Научитесь находить точки разворота тренда, используя всего один осциллятор.</p>
                </div>
                <div class="item">
                  <p class="num">0 / <span>8</span></p>
                  <a href="/page/Закон-относительной-силы" target="_blank" class="order">Пройти обечение</a>
                </div>
              </div>
            </div>
          </div>

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