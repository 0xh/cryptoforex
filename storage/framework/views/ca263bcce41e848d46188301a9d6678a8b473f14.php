<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/cryptofx.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/polz.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/preload.css')); ?>" rel="stylesheet">
    <!--  Vendor styles -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Scripts -->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

    <script>
    var currency = {
        data:{},
        value: function(a,c){
            var symb = (c=='' || this.data[c] == undefined)?'':this.data[c].unicode+' ';
            return symb+parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        },
        image:function(c){
            return (c=='' || this.data[c] == undefined)?'':this.data[c].image;
        }
    };
    <?php if(isset($currencies)): ?>
        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            currency.data["<?php echo e($currency->code); ?>"]={
                id:<?php echo e($currency->id); ?>,
                symbol:'<?php echo e($currency->symbol); ?>',
                unicode:'<?php echo e($currency->unicode); ?>',
                image:'<?php echo e($currency->image); ?>'
            };
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </script>
</head>
<body class="home">
  <div id="page-preloader">
      <div class="diamonds-spinner">
          <div class="spinner-image">
              <img src="images/icon/btc.png" alt="." style="display: none">
          </div>
          <div class="spinner-image">
              <img src="images/icon/dgb.png" alt="." style="display: none">
          </div>
          <div class="spinner-image">
              <img src="images/icon/doge.png" alt="." style="display: none">
          </div>
          <div class="spinner-image">
              <img src="images/icon/ppc.png" alt="." style="display: none">
          </div>
          <div class="spinner-image">
              <img src="images/icon/msc.png" alt="." style="display: none">
          </div>
          <!-- <div class="spinner-image">
              <img src="images/icon/ppc.png" alt="." style="display: none">
          </div>
          <div class="spinner-image">
              <img src="images/icon/rdd.png" alt="." style="display: none">
          </div> -->
      </div>
  </div>

        <div class="informer-wrap">
          <div id="informer">
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                <img src="/images/icon/btc.png" alt="">
                <img src="/images/icon/dgb.png" alt="">
              </span>
              <span style="color:#FF3100">1.1965</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/doge.png" alt="">
                  <img src="/images/icon/eth.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/msc.png" alt="">
                  <img src="/images/icon/nvc.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/ppc.png" alt="">
                  <img src="/images/icon/rdd.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/start.png" alt="">
                  <img src="/images/icon/storj.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/usdt.png" alt="">
                  <img src="/images/icon/usnbt.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/usdt.png" alt="">
                  <img src="/images/icon/usnbt.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/xcp.png" alt="">
                  <img src="/images/icon/btc.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                <img src="/images/icon/btc.png" alt="">
                <img src="/images/icon/dgb.png" alt="">
              </span>
              <span style="color:#FF3100">1.1965</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/doge.png" alt="">
                  <img src="/images/icon/eth.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/msc.png" alt="">
                  <img src="/images/icon/nvc.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/ppc.png" alt="">
                  <img src="/images/icon/rdd.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/start.png" alt="">
                  <img src="/images/icon/storj.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/usdt.png" alt="">
                  <img src="/images/icon/usnbt.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/usdt.png" alt="">
                  <img src="/images/icon/usnbt.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
            <div class="flex">
              <img src="/images/trade-down.png" alt="down">
              <span class="img">
                  <img src="/images/icon/xcp.png" alt="">
                  <img src="/images/icon/btc.png" alt="">
              </span>
              <span style="color:#FF3100">110.16</span> |
            </div>
          </div>
      </div>
        <?php echo $__env->make('layouts.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>

        <footer class="footer blue">
          <div class="container">
            <div class="item flex">
              <p>"Xcryptex LTD, London, UK. VAT 000000000"</p>
              <div class="copyright">
                <p>Xcryptex LTD Copyright 2017 ©</p>
              </div>
            </div>
          </div>
        </footer>


        <div id="top"></div>

        <div class="bgc"></div>

        <div class="thanks">
          <strong>Ваши данные приняты.</strong>
          <p>Наш специалист свяжется с Вами в ближайшее время.</p>
        </div>

        <div class="mobi">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <?php echo $__env->make('app.order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="popup popup_bal2">
          <div class="close"></div>
          <div class="flex flex-top">
            <div class="item">
              <div class="top flex">
                <strong>Основной баланс</strong>
                <p class="sum">$75 386</p>
              </div>
              <div class="con">
                <strong>Вывод средств</strong>
                <form action="#">
                  <input type="text" name="summ" placeholder="Сумма">
                  <select name="out">
                    <option disabled value="">Способ вывода</option>
                    <option value="">первый</option>
                    <option value="">второй</option>
                    <option value="">следующий</option>
                  </select>
                  <input type="submit" value="Заказать вывод">
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="popup popup_bal">
          <div class="close"></div>
          <div class="flex flex-top">
            <div class="item">
              <div class="top flex">
                <strong>Основной баланс</strong>
                <p class="sum">$75 386</p>
              </div>
              <div class="con">
                <strong>Ввод средств</strong>
                <form action="#">
                  <input type="text" name="summ" placeholder="Сумма">
                  <select name="out">
                    <option disabled value="">Способ вывода</option>
                    <option value="">первый</option>
                    <option value="">второй</option>
                    <option value="">следующий</option>
                  </select>
                  <input type="submit" value="Ввод средств">
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="popup popup_his">
          <div class="close"></div>
            <div class="flex flex-top">
              <div class="item">
                <div class="top flex">
                  <p>История платежей</p>
                </div>
                <div class="con">
                  <form action="#">
                    <div class="sort flex column">
                      <div class="item flex">
                        <strong>Сортировать по</strong>
                        <select name="out">
                          <option disabled value="">Выберите способ сортировки</option>
                          <option value="">первый</option>
                          <option value="">второй</option>
                          <option value="">следующий</option>
                        </select>
                      </div>
                      <div class="item flex flex-top">
                        <p>Период:</p>
                        <div class="inner flex column">
                          <div class="box flex">
                            <p class="no">за</p>
                            <p>неделю</p>
                            <p>месяц</p>
                            <p>Выбрать период</p>
                          </div>
                          <div class="box flex">
                            <p class="no">с</p>
                            <p>дд.мм.гггг</p>
                            <p class="no">по</p>
                            <p>дд.мм.гггг</p>
                          </div>
                        </div>
                      </div>
                      <input type="submit" value="Принять">
                    </div>
                  </form>
                </div>
                <div class="table">
                  <table>
                    <thead>
                      <th>Дата</th>
                      <th>Сумма</th>
                      <th>Статус</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>100$</td>
                        <td>В процессе</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>200$</td>
                        <td>В процессе</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>1 000$</td>
                        <td>Выплачено</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>5 000$</td>
                        <td>Отказано</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>100$</td>
                        <td>В процессе</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>200$</td>
                        <td>В процессе</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>1 000$</td>
                        <td>Выплачено</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>5 000$</td>
                        <td>Отказано</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>1 000$</td>
                        <td>Выплачено</td>
                      </tr>
                      <tr>
                        <td>04-12-2017 17:29:26</td>
                        <td>5 000$</td>
                        <td>Отказано</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="popup popup_cabinet">
          <div class="close"></div>
          <div class="top">
            <div class="container">
              <p>Пожалуйста, заполните форму, проверьте верность введенных данных и введите пароль</p>
            </div>
          </div>
          <div class="tabs">
            <div class="container">
              <ul class="tabs__cab flex width">
                <li class="active">Личный данные</li>
                <li>Поменять пароль</li>
                <li>Верификация</li>
              </ul>

              <div class="tab_cab flex flex-top active">
                <div class="item flex column">
                  <div class="inner">
                    <label for="name">Имя</label>
                    <input type="text" name="name" placeholder="Введите имя">
                  </div>
                  <div class="inner">
                    <label for="l_name">Фамилия</label>
                    <input type="text" name="l_name" placeholder="Введите фамилию">
                  </div>
                  <div class="inner">
                    <label for="l_name_l">Отчество</label>
                    <input type="text" name="l_name_l" placeholder="Введите отчество">
                  </div>
                  <div class="inner">
                    <label for="country">Страна</label>
                    <input type="text" name="country" placeholder="Введите страну проживания">
                  </div>
                  <div class="inner">
                    <label for="city">Город</label>
                    <input type="text" name="city" placeholder="Введите название города">
                  </div>
                  <div class="inner">
                    <label for="name">Индекс</label>
                    <input type="text" name="index" placeholder="Введите индекс">
                  </div>
                  <div class="inner">
                    <label for="address1">Адрес 1</label>
                    <input type="text" name="address1" placeholder="Введите адрес 1">
                  </div>
                  <div class="inner">
                    <label for="address2">Адрес 2</label>
                    <input type="text" name="address2" placeholder="Введите адрес 2">
                  </div>
                </div>
                <div class="item">
                  <div class="inner">
                    <label for="tel">Телефон</label>
                    <input type="tel" name="tel" placeholder="Введите номер телефона">
                  </div>
                  <div class="inner">
                    <label for="date">День рождения</label>
                    <input type="date" name="date" placeholder="дд.мм.гггг">
                  </div>
                  <div class="inner">
                    <label for="pasport">Серия паспорта</label>
                    <input type="text" name="pasport" placeholder="Введите серию">
                  </div>
                  <div class="inner">
                    <label for="num_pasport">Номер паспорта</label>
                    <input type="text" name="num_pasport" placeholder="Введите номер паспорта">
                  </div>
                  <div class="inner">
                    <label for="kem">Кем выдан</label>
                    <input type="text" name="kem" placeholder="">
                  </div>
                  <div class="inner">
                    <label for="until">Действителен до</label>
                    <input type="date" name="until" placeholder="дд.мм.гггг">
                  </div>
                  <div class="inner">
                    <input type="submit" value="Сохранить">
                  </div>
                </div>
              </div>

              <div class="tab_cab tab_cab2">
                <div class="item flex column">
                  <div class="inner">
                    <label for="name">Действующий пароль <abbr>*</abbr></label>
                    <input type="password" name="pass" placeholder="Действующий пароль">
                  </div>
                  <div class="inner">
                    <label for="name">Новый пароль <abbr>*</abbr></label>
                    <input type="password" name="new_pass" placeholder="Введите новый пароль">
                  </div>
                  <div class="inner">
                    <label for="name">Подтвердите пароль <abbr>*</abbr></label>
                    <input type="password" name="new_pass_to" placeholder="Подтвердите новый пароль">
                  </div>
                  <div class="inner">
                    <input type="submit" value="Сохранить">
                  </div>
                </div>
              </div>

              <div class="tab_cab tab_cab3">
                <div class="item flex column">
                  <div class="inner">
                    <p>
                      Пожалуйста, загрузите копию или фотографию <br />документа удостоверяющую Вашу личность
                    </p>
                  </div>
                  <div class="inner">
                    <input type="file" name="download">
                  </div>
                  <div class="inner">
                    <input type="submit" value="Отправить">
                  </div>
                </div>
              </div>


            </div>

          </div><!-- .tabs-->
        </div>

        <div class="popup popup_message">
          <div class="close"></div>
          <h2>Закрытие позиций по биткойну и лайткойну <span>31 июля 2017 в 18:49</span></h2>
          <strong>Уважаемые Клиенты!</strong>
          <p>
            Изменение протокола по биткойну создает неопределенную ситуацию на рынке, в которой биржи не могут гарантировать стабильность цен, достаточную ликвидность и прозрачные правила предстоящих технологических изменений.
          </p>
          <p>
            В таких условиях котировки криптовалют могут быть подвержены резким изменениям, комиссии и спреды расширяться до существенных значений, создавая риски огромных потерь для Клиентов.
          </p>
          <p>
            В этой связи к 21:00 GMT 31.07.17 торговые операции по криптовалютам будут приостановлены, позиции по инструментам биткойн и лайткойн будут закрыты по актуальной котировке, а отложенные ордера - отменены.
          </p>
          <p>
            Мы ожидаем восстановления торговли по криптовалютам после нормализации ситуации и стабилизации ликвидности по данным инструментам.
          </p>
          <p>
            Пожалуйста, обратите внимание на имеющиеся у вас открытые позиции по криптовалютам. До указанного времени принудительного закрытия позиций у вас есть возможность самостоятельного выбора момента их закрытия.
          </p>
        </div>
        <div class="popup popup_deal_info" style="z-index:1000;">
            <div class="close b02"></div>
            <div class="flex flex-top">
                <div class="flex flex-top left">
                    <div class="item">
                        <div class="content flex column">
                            <!-- <div class="item flex">
                                <div class="pic">
                                    <img src="images/bitcoin.png" alt="">
                                    <img src="images/litecoin.png" alt="">
                                </div>
                                <div class="in">BTC/LTE</div>
                                <div class="open tabl">
                                    <span>Open</span>
                                    <span>1.17805</span>
                                </div>
                                <div class="high tabl">
                                    <span>High</span>
                                    <span>1.17805</span>
                                </div>
                                <div class="low tabl">
                                    <span>Low</span>
                                    <span>1.17754</span>
                                </div>
                                <div class="clos tabl">
                                    <span>Close</span>
                                    <span>1.17763</span>
                                </div>
                            </div>
                            <div class="graf">
                                <img src="images/graf.png" alt="">
                            </div>
                            <div class="pagination">
                                <ul class="flex">
                                    <li><a href="#">1D</a></li>
                                    <li><a href="#">7D</a></li>
                                    <li><a href="#">1M</a></li>
                                    <li class="active"><a href="#">3M</a></li>
                                    <li><a href="#">6M</a></li>
                                    <li><a href="#">YTD</a></li>
                                    <li><a href="#">1Y</a></li>
                                    <li><a href="#">5Y</a></li>
                                </ul>
                            </div> -->
                            <div id="chartdiv_p1" class="graph"></div>
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
                            <div class="tab_cap active submiter" data-action="/deal/delete" data-callback="pageReload">
                            <!-- <div class="tab_cap active submiter" data-action="/deal/delete"> -->
                                <div class="box">
                                  <div class="item flex">
                                    <div class="inner">
                                      <strong class="up">Прибыль</strong>
                                    </div>
                                    <div class="inner deal-profit">
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
                                    <div class="inner deal-time">
                                      <p><span class="time">11:00 06.09.17</span></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="box">
                                  <div class="item flex">
                                    <div class="inner">
                                      <p>Сумма сделки</p>
                                    </div>
                                    <div class="inner deal-amount">
                                      <p>100$</p>
                                    </div>
                                  </div>
                                  <div class="item flex">
                                    <div class="inner">
                                      <p>Кредитное плечо</p>
                                    </div>
                                    <div class="inner deal-multiplier">
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
                                    <input type="hidden" name="deal_id" data-name="deal_id" id="deal_id"  />
                                    <a href="#" class="order submit close b02">Закрыть сделку</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="deal loader" data-action="/deal" data-autostart="true" data-refresh="30000" data-function="userDeals"></div>
                    <div class="bot">
                        <ul class="flex">
                            <li class="active"><a href="#">Отчет</a></li>
                            <li><a href="#">Закрытые</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--  Vendor amCharts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="http://aplicant.good-point.ru/alfa-diamonds/js/jquery.shapeshift-master/core/jquery.shapeshift.min.js"></script>
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/amstock.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <!-- <script src="https://www.amcharts.com/lib/3/themes/none.js"></script> -->
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
        <script src="http://mcpants.github.io/jquery.shapeshift/core/jquery.shapeshift.min.js" type="text/javascript"></script>
        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>
        <!-- <script src="<?php echo e(asset('js/jquery.li-scroller.1.0.js')); ?>"></script> -->
        <!-- <script src="<?php echo e(asset('js/jquery.liMarquee.js')); ?>"></script> -->
        <script src="<?php echo e(asset('js/objects.js')); ?>"></script>
        <script src="<?php echo e(asset('js/ion.sound.js')); ?>"></script>
        <script src="<?php echo e(asset('js/settings.js')); ?>"></script>

        <!--  Own tools -->
        <script src="<?php echo e(asset('js/cryptofx.js')); ?>"></script>
        <script src="<?php echo e(asset('js/cryptofx.fn.js')); ?>"></script>
        <script src="<?php echo e(asset('js/loader.js')); ?>"></script>
        <script>
            $(document).ready(function(){
                new cf.loader($(".loader-instruments"),Fresher);
            });

        </script>
</body>
</html>
