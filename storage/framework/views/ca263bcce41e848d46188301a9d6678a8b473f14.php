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
    <link rel="stylesheet" href="/chart2/chart.v2.css">
    <!--  Vendor styles -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Scripts -->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

    <script>
    var _onload = [];
    function leftZeroPad(s){
        var ret=s.toString(),
            length = ret.length,
            defaults={
                symbol:'0',
                maxLength:2
            },
            opts = $.extend(defaults,(arguments.length>1)?arguments[1]:{});
        for(var i=0;i<(opts.maxLength-length);++i)ret=opts.symbol+ret;
        return ret;
    }
    function dateFormat(d){
        if(d==null) return '';
        var date = new Date(d*1000),
            withTime = (arguments.length>1)?arguments[1]:true,
            res = date.getFullYear();
        res+= '-'+leftZeroPad(date.getMonth()+1);
        res+= '-'+leftZeroPad(date.getDate());
        if(withTime){
            res+= ' '+leftZeroPad(date.getHours());
            res+= ':'+leftZeroPad(date.getMinutes());
            res+= ':'+leftZeroPad(date.getSeconds());
        }
        return res;
    }
    var currency = {
        data:{},
        value: function(a,c){
            var symb = (c=='' || this.data[c] == undefined)?'':this.data[c].unicode+' ',pres = (arguments.length>2)?arguments[2]:2;
            return symb+parseFloat(a).toFixed(pres).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
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
  <!-- <div id="page-preloader">
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
      </div>
  </div> -->
        <?php if(!Auth::guest()): ?>

        <!-- <div id="scroller_container">
          <div id="scroller"> -->
           <!--  <div class="informer-wrap">
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
            </div> -->
          <!-- </div>
        </div> -->
        <?php endif; ?>
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
          <strong><?php echo app('translator')->getFromJson('messages.Your_details'); ?></strong>
          <p><?php echo app('translator')->getFromJson('messages.Our_specialist'); ?></p>
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
                <strong><?php echo app('translator')->getFromJson('messages.Basic_balance'); ?></strong>
                <p class="sum">$75 386</p>
              </div>
              <div class="con">
                <strong><?php echo app('translator')->getFromJson('messages.Withdrawal_of_funds'); ?></strong>
                <form action="#" class="submiter" data-action="/user/finance/withdrawal">
                  <input type="text" name="summ" data-name="amount" placeholder="<?php echo app('translator')->getFromJson('messages.Amount'); ?>">
                  <select name="out">
                    <option disabled value=""><?php echo app('translator')->getFromJson('messages.Output_method'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.first'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.second'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.following'); ?></option>
                  </select>
                  <button class="submit"><?php echo app('translator')->getFromJson('messages.Order_output'); ?></button>
                  <!-- <input type="submit" class="submit" value="<?php echo app('translator')->getFromJson('messages.Order_output'); ?>"> -->
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
                <strong><?php echo app('translator')->getFromJson('messages.Basic_balance'); ?></strong>
                <p class="sum">$75 386</p>
              </div>
              <div class="con">
                <strong><?php echo app('translator')->getFromJson('messages.Withdrawal_of_funds'); ?></strong>
                <form action="#">
                  <input type="text" name="summ" placeholder="<?php echo app('translator')->getFromJson('messages.Amount'); ?>">
                  <select name="out">
                    <option disabled value=""><?php echo app('translator')->getFromJson('messages.Output_method'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.first'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.second'); ?></option>
                    <option value=""><?php echo app('translator')->getFromJson('messages.following'); ?></option>
                  </select>
                  <input type="submit" value="<?php echo app('translator')->getFromJson('messages.Order_output'); ?>">
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
                      <!-- <input type="submit" value="Принять"> -->
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
                    <tbody class="loader" data-name="user-transactions" data-action="/json/finance/withdrawal/<?php echo e(Auth::id()); ?>" data-function="userWithdrawals" data-autostart="true" data-refresh="0"></tbody>
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
              <p><?php echo app('translator')->getFromJson('messages.pliz'); ?></p>
            </div>
          </div>
          <div class="tabs">
            <div class="container">
              <ul class="tabs__cab flex width">
                <li class="active"><?php echo app('translator')->getFromJson('messages.Personal-Information'); ?></li>
                <li><?php echo app('translator')->getFromJson('messages.Change_Password'); ?></li>
                <li><?php echo app('translator')->getFromJson('messages.Verification'); ?></li>
              </ul>

              <div class="tab_cab flex flex-top active">
                <div class="item flex column">
                  <div class="inner">
                    <label for="name"><?php echo app('translator')->getFromJson('messages.name'); ?></label>
                    <input type="text" name="name" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_your_name'); ?>">
                  </div>
                  <div class="inner">
                    <label for="l_name"><?php echo app('translator')->getFromJson('messages.Surname'); ?></label>
                    <input type="text" name="l_name" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_last_name'); ?>">
                  </div>
                  <div class="inner">
                    <label for="l_name_l"><?php echo app('translator')->getFromJson('messages.middle-name'); ?></label>
                    <input type="text" name="l_name_l" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_middle_name'); ?>">
                  </div>
                  <div class="inner">
                    <label for="country"><?php echo app('translator')->getFromJson('messages.country'); ?></label>
                    <input type="text" name="country" placeholder="<?php echo app('translator')->getFromJson('messages.Enter-country-of-residence'); ?>">
                  </div>
                  <div class="inner">
                    <label for="city"><?php echo app('translator')->getFromJson('messages.city'); ?></label>
                    <input type="text" name="city" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_the_name_of_the_city'); ?>">
                  </div>
                  <div class="inner">
                    <label for="name"><?php echo app('translator')->getFromJson('messages.index'); ?></label>
                    <input type="text" name="index" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_the_index'); ?>">
                  </div>
                  <div class="inner">
                    <label for="address1"><?php echo app('translator')->getFromJson('messages.address'); ?> 1</label>
                    <input type="text" name="address1" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_the_address'); ?> 1">
                  </div>
                  <div class="inner">
                    <label for="address2"><?php echo app('translator')->getFromJson('messages.address'); ?> 2</label>
                    <input type="text" name="address2" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_the_address'); ?> 2">
                  </div>
                </div>
                <div class="item">
                  <div class="inner">
                    <label for="tel"><?php echo app('translator')->getFromJson('messages.phone'); ?></label>
                    <input type="tel" name="tel" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_phone_number'); ?>">
                  </div>
                  <div class="inner">
                    <label for="date"><?php echo app('translator')->getFromJson('messages.Birthday'); ?></label>
                    <input type="date" name="date" placeholder="<?php echo app('translator')->getFromJson('messages.dd_mm_yyyy'); ?>">
                  </div>
                  <div class="inner">
                    <label for="pasport"><?php echo app('translator')->getFromJson('messages.Passport-Series'); ?></label>
                    <input type="text" name="pasport" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_the_series'); ?>">
                  </div>
                  <div class="inner">
                    <label for="num_pasport"><?php echo app('translator')->getFromJson('messages.Passport-ID'); ?></label>
                    <input type="text" name="num_pasport" placeholder="<?php echo app('translator')->getFromJson('messages.Passport-ID'); ?>">
                  </div>
                  <div class="inner">
                    <label for="kem"><?php echo app('translator')->getFromJson('messages.Issued-by'); ?></label>
                    <input type="text" name="kem" placeholder="<?php echo app('translator')->getFromJson('messages.Issued-by'); ?>">
                  </div>
                  <div class="inner">
                    <label for="until"><?php echo app('translator')->getFromJson('messages.Valid-until'); ?></label>
                    <input type="date" name="until" placeholder="<?php echo app('translator')->getFromJson('messages.dd_mm_yyyy'); ?>">
                  </div>
                  <div class="inner">
                    <input type="submit" value="<?php echo app('translator')->getFromJson('messages.Save'); ?>">
                  </div>
                </div>
              </div>

              <div class="tab_cab tab_cab2">
                <div class="item flex column">
                  <div class="inner">
                    <label for="name"><?php echo app('translator')->getFromJson('messages.Valid_password'); ?> <abbr>*</abbr></label>
                    <input type="password" name="pass" placeholder="<?php echo app('translator')->getFromJson('messages.Valid_password'); ?>">
                  </div>
                  <div class="inner">
                    <label for="name"><?php echo app('translator')->getFromJson('messages.New_password'); ?> <abbr>*</abbr></label>
                    <input type="password" name="new_pass" placeholder="<?php echo app('translator')->getFromJson('messages.Enter_a_new_password'); ?>">
                  </div>
                  <div class="inner">
                    <label for="name"><?php echo app('translator')->getFromJson('messages.Confirm_the_password'); ?> <abbr>*</abbr></label>
                    <input type="password" name="new_pass_to" placeholder="<?php echo app('translator')->getFromJson('messages.Confirm_the_new_password'); ?>">
                  </div>
                  <div class="inner">
                    <input type="submit" value="<?php echo app('translator')->getFromJson('messages.Save'); ?>">
                  </div>
                </div>
              </div>

              <div class="tab_cab tab_cab3 column">
                <div class="item flex column">
                  <div class="inner">
                    <p>
                      <?php echo app('translator')->getFromJson('messages.foto'); ?>
                  </div>
                    </p>
                  </div>
                  <div class="inner">
                    <input type="file" name="download">
                  </div>
                  <div class="inner">
                    <input type="submit" value="<?php echo app('translator')->getFromJson('messages.Send'); ?>">
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
                            <script>

                            // mozfullscreenerror event handler
                            function errorHandler() {
                                alert('mozfullscreenerror');
                            }
                            document.documentElement.addEventListener('mozfullscreenerror', errorHandler, false);

                            // toggle full screen
                            function toggleFullScreen() {
                                if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
                                    if (document.documentElement.requestFullscreen) {
                                        document.documentElement.requestFullscreen();
                                    } else if (document.documentElement.mozRequestFullScreen) {
                                        document.documentElement.mozRequestFullScreen();
                                    } else if (document.documentElement.webkitRequestFullscreen) {
                                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                                    }
                                } else {
                                    if (document.cancelFullScreen) {
                                        document.cancelFullScreen();
                                    } else if (document.mozCancelFullScreen) {
                                        document.mozCancelFullScreen();
                                    } else if (document.webkitCancelFullScreen) {
                                        document.webkitCancelFullScreen();
                                    }
                                }
                            }

                            // keydown event handler
                            document.addEventListener('keydown', function (e) {
                                // if (e.keyCode == 13 || e.keyCode == 70) {
                                if ( e.keyCode == 70 ) {
                                    toggleFullScreen();
                                }
                            }, false);
                        </script>
                        <!-- <div class="ttt">
                            <a href="#" class="open hidden"><?php echo app('translator')->getFromJson('messages.Open_sd'); ?></a>
                            <a href="#" class="closee hidden"><?php echo app('translator')->getFromJson('messages.Close_sd'); ?></a>
                            <a href="#" class="open2 hidden"><?php echo app('translator')->getFromJson('messages.Instruments'); ?></a>
                            <a href="#" class="closee2 hidden"><?php echo app('translator')->getFromJson('messages.Close_sd'); ?></a>
                            <a href="#" class="button" onclick="toggleFullScreen();"></a>
                        </div> -->
                            <div id="chartdiv_p1" class="graph"></div>
                            <!-- <div class="btn-group">
                                <button onclick="graphControl.CandleStick()">CandleStick</button>
                                <button onclick="graphControl.Line()">Line</button>
                                <button onclick="graphControl.OHLC()">OHLC</button>
                            </div> -->
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
                                      <strong class="up"><?php echo app('translator')->getFromJson('messages.Profit'); ?></strong>
                                    </div>
                                    <div class="inner deal-profit">
                                        <span class="up">27 $</span>
                                    </div>
                                  </div>
                                  <div class="item flex">
                                    <div class="inner">
                                      <strong><?php echo app('translator')->getFromJson('messages.pair'); ?></strong>
                                    </div>
                                    <div class="inner flex">
                                      <strong><span>BTC</span>/<span>BCH</span></strong>
                                    </div>
                                  </div>
                                  <div class="item flex">
                                    <div class="inner">
                                      <strong><?php echo app('translator')->getFromJson('messages.Opening_time'); ?></strong>
                                    </div>
                                    <div class="inner deal-time">
                                      <p><span class="time">11:00 06.09.17</span></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="box">
                                  <div class="item flex">
                                    <div class="inner">
                                      <p><?php echo app('translator')->getFromJson('messages.Sumsd'); ?></p>
                                    </div>
                                    <div class="inner deal-amount">
                                      <p>100$</p>
                                    </div>
                                  </div>
                                  <div class="item flex">
                                    <div class="inner">
                                      <p><?php echo app('translator')->getFromJson('messages.Krpl'); ?></p>
                                    </div>
                                    <div class="inner deal-multiplier">
                                      <p>5000$</p>
                                    </div>
                                  </div>
                                  <div class="item flex">
                                    <div class="inner">
                                      <p><?php echo app('translator')->getFromJson('messages.Komsd'); ?></p>
                                    </div>
                                    <div class="inner">
                                      <p>0.023%</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="bot flex">
                                    <input type="hidden" name="deal_id" data-name="deal_id" id="deal_id"  />
                                    <a href="#" class="order submit close b02"><?php echo app('translator')->getFromJson('messages.Close_the_deal'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="deal loader" data-action="/deal" data-autostart="true" data-refresh="30000" data-function="userDeals"></div>
                    <div class="bot">
                        <ul class="flex">
                            <li class="active"><a href="#"><?php echo app('translator')->getFromJson('messages.Report'); ?></a></li>
                            <li><a href="#"><?php echo app('translator')->getFromJson('messages.Closed'); ?></a></li>
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
        <script src="<?php echo e(asset('js/jscroller-0.4.js')); ?>"></script>
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

        <script src="http://d3js.org/d3.v4.min.js"></script>
        <script src="http://techanjs.org/techan.min.js"></script>
        <script type="text/javascript" src="<?php echo e(asset('/chart2/chart_2.0.js')); ?>"></script>

        <script>
            $(document).ready(function(){
                new cf.loader($(".loader-instruments"),Fresher);
                for(var i in _onload){
                    var fnc=_onload[i];
                    if(typeof(fnc)=="function"){
                        console.debug("Execute _onload func: "+fnc);
                        fnc();
                    }
                }
            });

        </script>

        <!-- <script type="text/javascript">
          $(document).ready(function(){
            $jScroller.add(".informer-wrap","#informer","left",10, true);
            $jScroller.start();
          });
        </script> -->
</body>
</html>
