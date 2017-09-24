@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Скользим по средним</a>
      </div>
      <section class="section">
        <h1>Скользим по средним</h1>
        <div class="inner">
          <strong id="q1">SMA+SMA</strong>
          <p>Сейчас мы расскажем тебе про индикатор SMA. Что это такое и как пользоваться для наиболее эффективной торговли.</p>
          <div>
            <img src="../images/ss1.png" alt="">
          </div>
          <a href="#" class="order next">Хочу узнать! 👌</a>
        </div>
        <div class="inner hidden">
          <strong id="q2">Что такое SMA?</strong>
          <p>Simple moving average (SMA) или простая скользящая средняя — один из наиболее популярных и простых индикаторов.</p>
          <p>SMA усредняет данные о цене и помогает увидеть тренды. Визуально представляет собой линию.</p>
          <p>Она плавно следует за графиком и, сглаживая случайные колебания цены, показывает направление движения стоимости актива.</p>
          <a href="#" class="order next">Как настроить SMA? 🔧</a>
        </div>
        <div class="inner hidden">
          <strong id="q3">Настройка индикатора</strong>
          <p>Изменяй порядок SMA, чтобы увеличить количество сигналов или повысить их точность.</p>
          <p>Чем больше порядок, тем индикатор медленнее. Он дает более точные сигналы, но самих сигналов меньше.</p>
          <p>Чем меньше порядок, тем индикатор быстрее. Он дает больше сигналов, но они менее точные.</p>
          <p>Пересечение индикатора с графиком цены, а также пересечение нескольких SMA разного порядка дает сигнал на открытие сделки.</p>
          <a href="#" class="order next">Понятно 😕</a>
        </div>
        <div class="inner hidden">
          <strong id="q4">Как читать сигналы SMA?</strong>
          <p>Если установить на график не одну, а сразу две скользящие средние с разными периодами, можно отслеживать сигналы на разворот цены.</p>
          <a href="#" class="order next">Как это сделать? 🔧</a>
        </div>
        <div class="inner hidden">
          <strong id="q5">Подготовка к торговле. Шаг 1</strong>
          <p>Настрой первую «медленную» линию, установив период 60.</p>
          <p>И выбери цвет, например, синий или красный.</p>
          <div>
            <img src="../images/ss2.png" alt="">
          </div>
          <a href="#" class="order next">Что дальше? 👍</a>
        </div>
        <div class="inner hidden">
          <strong id="q6">Подготовка к торговле. Шаг 2</strong>
          <p>Добавь вторую «быструю» SMA, установив период 4.</p>
          <p>И выбери любой цвет, отличный от первого. Например, зеленый или желтый.</p>
          <div>
            <img src="../images/ss3.png" alt="">
          </div>
          <a href="#" class="order next">Когда открывать сделку? 📈</a>
        </div>
        <div class="inner hidden">
          <strong id="q7">Торгуем на повышение</strong>
          <p>Наблюдай за линиями индикатора.</p>
          <p>Если «быстрая» SMA пересечёт «медленную» снизу вверх, это сигнал для заключения сделки на повышение.</p>
          <div>
            <img src="../images/ss4.gif" alt="">
          </div>
          <a href="#" class="order next">Хорошо. А на понижение? 📉</a>
        </div>
        <div class="inner hidden">
          <strong id="q8">Торгуем на понижение</strong>
          <p>Если «быстрая» SMA пересечёт «медленную» сверху вниз, это сигнал для заключения сделки на понижение.</p>
          <div>
            <img src="../images/ss5.gif" alt="">
          </div>
          <a href="#" class="order">Попробовать 📊</a>
        </div>
      </section>
    </div>
    <div class="item">
      <strong>Содержание</strong>
      <ul>
        <li class="active"><a href="#q1">SMA+SMA</a></li>
        <li><a href="#q2">Что такое SMA?</a></li>
        <li><a href="#q3">Настройка индикатора</a></li>
        <li><a href="#q4">Как читать сигналы SMA?</a></li>
        <li><a href="#q5">Подготовка к торговле. Шаг 1</a></li>
        <li><a href="#q6">Подготовка к торговле. Шаг 2</a></li>
        <li><a href="#q6">Торгуем на повышение</a></li>
        <li><a href="#q6">Торгуем на понижение</a></li>
      </ul>
    </div>
  </div>
</main>
@endsection
