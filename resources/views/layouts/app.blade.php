<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cryptofx.css') }}" rel="stylesheet">
    <!--  Vendor styles -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
        @include('layouts.top')
        @yield('content')

        <footer class="footer">
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
        @include('app.order')
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!--  Vendor amCharts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/amstock.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
    <!--  Own tools -->
    <script src="{{ asset('js/cryptofx.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
</body>
</html>
