@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">MACD professional</a>
      </div>
      <section class="section">
        <h1>MACD professional</h1>
        <div class="inner">
          <strong id="q1">Трейдинг на развороте тренда</strong>
          <p>Сейчас мы расскажем тебе о стратегии MACD professional. Ты узнаешь, как совмещать 3 индикатора, чтобы вовремя замечать развороты тренда.</p>
          <div>
            <img src="../images/mp1.gif" alt="">
          </div>
          <a href="#" class="order next">Хочу узнать! 👌</a>
        </div>
        <div class="inner hidden">
          <strong id="q2">В чем суть стратегии?</strong>
          <p>В основе стратегии лежит сочетание осциллятора MACD, экспоненциальной скользящей средней EMA и индикатора Parabolic SAR.</p>
          <p>Сигналы, которые они совместно генерируют, помогают эффективно анализировать текущий тренд и вовремя замечать его разворот.</p>
          <a href="#" class="order next">Ок. Что мне нужно для работы?</a>
        </div>
        <div class="inner hidden">
          <strong id="q3">Инструментарий</strong>
          <p>Первое, что нам понадобится — отдельное окно «Технического анализа».</p>
          <p>Главные инструменты в стратегии — индикаторы.</p>
          <p>Экспоненциальная средняя скользящая или Exponential Moving Average (ЕМА) показывает сглаженное движение цены, исключая случайные колебания.</p>
          <div>
            <img src="../images/mp2.gif" alt="">
          </div>
          <p>Осциллятор MACD помогает вовремя замечать момент перелома тренда. Он состоит из гистограммы, линии MACD и сигнальной линии.</p>
          <div>
            <img src="../images/mp3.gif" alt="">
          </div>
          <p>Индикатор Parabolic подтверждает направление тренда или указывает на его разворот.</p>
          <div>
            <img src="../images/mp4.gif" alt="">
          </div>
          <a href="#" class="order next">Понятно ✋</a>
        </div>
        <div class="inner hidden">
          <strong id="q4">Подготовка к торговле. Шаг 1</strong>
          <p>В отдельном окне открой «Технический анализ»</p>
          <div>
            <img src="../images/mp5.gif" alt="">
          </div>
          <p>Переключись на график «Японские свечи» и выбери таймфрейм. Оптимальный таймфрейм для торговли по этой стратегии — 1 час.</p>
          <div>
            <img src="../images/mp6.gif" alt="">
          </div>
          <p>Добавь на график MACD, линию EMA и Parabolic.</p>
          <div>
            <img src="../images/mp7.gif" alt="">
          </div>
          <a href="#" class="order next">Что дальше? 🙌</a>
        </div>
        <div class="inner hidden">
          <strong id="q5">Подготовка к торговле. Шаг 2</strong>
          <p>Наблюдай за графиком.</p>
          <p>Как только точка индикатора Parabolic появится с противоположной стороны свечи, можно говорить о смене тренда.</p>
          <div>
            <img src="../images/mp8.gif" alt="">
          </div>
          <a href="#" class="order next">Когда открывать сделку? 👍</a>
        </div>
        <div class="inner hidden">
          <strong id="q6">Открываем сделку НИЖЕ</strong>
          <p>Убедись, что перед тобой нисходящий тренд: EMA направлена вниз.</p>
          <p>Дождись, когда линии MACD пересекутся: быстрая линия пересекает сигнальную линию сверху вниз.</p>
          <p>А точка Parabolic при этом должна появиться над графиком.</p>
          <div>
            <img src="../images/mp9.gif" alt="">
          </div>
          <p>Открой сделку НИЖЕ сроком на 2 часа.</p>
          <a href="#" class="order next">Понятно. А ВЫШЕ? 👉</a>
        </div>
        <div class="inner hidden">
          <strong id="q7">Открываем сделку ВЫШЕ</strong>
          <p>Убедись, что перед тобой восходящий тренд: EMA направлена вверх.</p>
          <p>Быстрая линия MACD пересекла сигнальную линию снизу вверх.</p>
          <p>А точка Parabolic появилась под графиком.</p>
          <div>
            <img src="../images/mp10.gif" alt="">
          </div>
          <p>Открой сделку ВЫШЕ на 2 часа.</p>
          <a href="#" class="order next">На что обратить внимание? 💡</a>
        </div>
        <div class="inner hidden">
          <strong id="q8">Рекомендации по торговле</strong>
          <p>Не открывай сделку на основании только 1 сигнала. Важно, чтобы на графике появились сигналы всех индикаторов.</p>
          <p>Срок сделки должен в 2 раза превышать рассматриваемый таймфрейм. Если используешь период в 1 час, открывай сделку на 2-3 часа.</p>
          <p>Торгуй в период Европейской и Американской сессии.</p>
          <p>Избегай работы по стратегии в период Тихоокеанской и Азиатской сессии.</p>
          <a href="#" class="order">Начать торговать 📊</a>
        </div>
      </section>
    </div>
    <div class="item">
      <strong>Содержание</strong>
      <ul>
        <li class="active"><a href="#q1">Трейдинг на развороте тренда</a></li>
        <li><a href="#q2">В чем суть стратегии?</a></li>
        <li><a href="#q3">Инструментарий</a></li>
        <li><a href="#q4">Подготовка к торговле. Шаг 1</a></li>
        <li><a href="#q5">Подготовка к торговле. Шаг 2</a></li>
        <li><a href="#q6">Открываем сделку НИЖЕ</a></li>
        <li><a href="#q7">Открываем сделку ВЫШЕ</a></li>
        <li><a href="#q8">Рекомендации по торговле</a></li>
      </ul>
    </div>
  </div>
</main>
@endsection
