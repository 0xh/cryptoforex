@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">SMA</a>
      </div>
      <section class="section">
        <h1>SMA</h1>
        <div class="inner">
          <strong id="q1">Простая скользящая средняя</strong>
          <p>Привет! Сейчас мы расскажем о SMA, самом популярном индикаторе из класса скользящие средние (Мoving Average).</p>
          <div>
            <img src="../images/sm1.png" alt="">
          </div>
          <a href="#" class="order next">Хочу узнать! 👌</a>
        </div>
        <div class="inner hidden">
          <strong id="q2">Что такое SMA?</strong>
          <p>Simple Moving Average или SMA часто называют обыкновенной или простой скользящей средней, потому что она высчитывается по самой простой формуле в классе.</p>
          <p>В данном случае берется среднее значение цены актива за выбранный период.</p>
          <p>SMA помогает определить тренд и четко увидеть, когда он заканчивается.</p>
          <a href="#" class="order next">Как настроить SMA? 🔧</a>
        </div>
        <div class="inner hidden">
          <strong id="q3">Настройка индикатора</strong>
          <p>В настройках SMA можно поменять один единственный параметр — количество периодов цены, которые используются для расчета среднего значения.</p>
          <p>Стандартный период — 10.</p>
          <p>В зависимости от цели можно усреднять разное количество периодов.</p>
          <p>Для краткосрочного анализа на 15-ти минутном таймфрейме выбирай периоды от 5 до 10.</p>
          <p>А для среднесрочного — от 15 до 20.</p>
          <a href="#" class="order next">Понятно ✋</a>
        </div>
        <div class="inner hidden">
          <strong id="q4">Как читать сигналы SMA?</strong>
          <p>Если SMA поднимается выше своего среднего значения, то восходящее движение индикатора продолжится.</p>
          <p>Если индикатор опускается ниже своего среднего значения, это говорит о нисходящем тренде.</p>
          <div>
            <img src="../images/sm2.png" alt="">
          </div>
          <a href="#" class="order next">Когда открывать сделку? 📈</a>
        </div>
        <div class="inner hidden">
          <strong id="q5">Торгуем на повышение</strong>
          <p>SMA используется как в комбинации с другими индикаторами, так и самостоятельно.</p>
          <p>Если используешь сигналы только SMA, открывай сделку на повышение, когда график пересечет индикатор снизу вверх.</p>
          <div>
            <img src="../images/sm3.png" alt="">
          </div>
          <a href="#" class="order next">Хорошо. А на понижение? 📉</a>
        </div>
        <div class="inner hidden">
          <strong id="q6">Торгуем на понижение</strong>
          <p>Открывай сделку на понижение, когда график пересечет SMA сверху вниз.</p>
          <div>
            <img src="../images/sm4.png" alt="">
          </div>
          <a href="#" class="order">Попробовать 📊</a>
        </div>
      </section>
    </div>
    <div class="item">
      <strong>Содержание</strong>
      <ul>
        <li class="active"><a href="#q1">Простая скользящая средняя</a></li>
        <li><a href="#q2">Что такое SMA?</a></li>
        <li><a href="#q3">Настройка индикатора</a></li>
        <li><a href="#q4">Как читать сигналы SMA?</a></li>
        <li><a href="#q5">Торгуем на повышение</a></li>
        <li><a href="#q6">Торгуем на понижение</a></li>
      </ul>
    </div>
  </div>
</main>
@endsection
