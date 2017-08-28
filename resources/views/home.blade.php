@extends('layouts.app')
@section('content')
<main class="main">
    <div class="container flex flex-top">
        @include('app.instruments')
        @include('app.graph')
        @include('app.deals')

    </div>

    @include('layouts.bottom')

</main>

<footer class="footer">
    <div class="container"></div>
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

<div class="popup popup_order">
    <div class="close"></div>
    <div class="flex flex-top">
        <div class="flex flex-top left">
            <div class="item">
                <div class="content flex column">
                    <div class="item flex">
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
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="tabs_popup">
                    <ul class="tab_item">
                        <li class="active">Сейчас</li>
                        <li>При котировке</li>
                    </ul>
                    <div class="tab_cap active">
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
                            <a href="#" class="down">В снижение</a>
                            <a href="#" class="up">В рост</a>
                        </div>
                    </div>
                    <div class="tab_cap">
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
                            <a href="#" class="down">В снижение</a>
                            <a href="#" class="up">В рост</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="deal">
                <h2>Активные сделки</h2>
                <div class="flex column">
                    <div class="flex column width mh">
                        <div class="top">
                            <div class="item flex title">
                                <div class="inner">Инструмент</div>
                                <div class="inner">Вложено</div>
                                <div class="inner">Прибыль</div>
                            </div>
                            <div class="item flex">
                                <div class="inner">BTC/ETH</div>
                                <div class="inner">100.00$</div>
                                <div class="inner down">-3.54$</div>
                            </div>
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
                            </div>
                        </div>
                        <div class="bot">
                            <ul class="flex">
                                <li class="active"><a href="#">Отчет</a></li>
                                <li><a href="#">Закрытые</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
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

    </div>
    <!-- .tabs-->
</div>
@endsection
