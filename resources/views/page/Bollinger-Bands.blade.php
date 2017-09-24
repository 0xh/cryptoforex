@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Bollinger Bands</a>
      </div>
      <section class="section">
        <h1>Bollinger Bands</h1>
        <div class="inner">
          <strong id="q1">Полосы Боллинджера</strong>
          <p>Привет! Сегодня мы расскажем про индикатор Bollinger bands, или, как его еще называют, полосы Боллинджера.</p>
          <div>
            <img src="../images/bb1.png" alt="">
          </div>
          <a href="#" class="order next">Хочу узнать! 👌</a>
        </div>
        <div class="inner hidden">
          <strong id="q2">Что такое Bollinger bands?</strong>
          <p>Полосы Боллинджера – это индикатор, который, показывает направление тренда и помогает находить точки его разворота.</p>
          <p>Итак, основной принцип трейдинга с использованием этого индикатора — это торговля на развороте тренда.</p>
          <a href="#" class="order next">Как настроить Bollinger bands? 🔧</a>
        </div>
        <div class="inner hidden">
          <strong id="q3">Настройка индикатора</strong>
          <p>Рекомендуем оставить стандартные настройки периода и отклонения — 20 и 2.0 соответственно.</p>
          <p>При желании можно также изменить цвет и толщину линий индикатора.</p>
          <p>Кстати, лучше всего для торговли подходит график «Японские свечи» с таймфреймом в 5 или 15 минут.</p>
          <a href="#" class="order next">Как применять индикатор в торговле? 💡</a>
        </div>
        <div class="inner hidden">
          <strong id="q4">Как читать сигналы Bollinger bands</strong>
          <p>Основные составляющие индикатора — это линии, а именно 3 простые скользящие средние.</p>
          <p>Центральная линия, двигаясь за графиком, демонстрирует направление тренда.</p>
          <p>Верхняя и нижняя линии образуют ценовой коридор. Выход графика за его пределы и является сигналом к открытию сделки.</p>
          <div>
            <img src="../images/bb2.png" alt="">
          </div>
          <a href="#" class="order next">Когда открывать сделку?</a>
        </div>
        <div class="inner hidden">
          <strong id="q5">Открываем сделку ВЫШЕ</strong>
          <p>Пересечение графика и нижней линии индикатора указывает, что в самое ближайшее время тренд может развернуться.</p>
          <p>Таким образом, если свеча графика пересекла нижнюю границу ценового коридора, можно открывать сделку ВЫШЕ.</p>
          <div>
            <img src="../images/bb3.png" alt="">
          </div>
          <a href="#" class="order next">Понятно. А НИЖЕ? 😶</a>
        </div>
        <div class="inner hidden">
          <strong id="q6">Открываем сделку НИЖЕ</strong>
          <p>Открывать сделку НИЖЕ можно, когда график пересек верхнюю линию Боллинджера.</p>
          <div>
            <img src="../images/bb4.png" alt="">
          </div>
          <a href="#" class="order">Попробовать 📊</a>
        </div>
      </section>
    </div>
    <div class="item">
      <strong>Содержание</strong>
      <ul>
        <li class="active"><a href="#q1">Полосы Боллинджера</a></li>
        <li><a href="#q2">Что такое Bollinger bands?</a></li>
        <li><a href="#q3">Настройка индикатора</a></li>
        <li><a href="#q4">Как читать сигналы Bollinger bands</a></li>
        <li><a href="#q5">Открываем сделку ВЫШЕ</a></li>
        <li><a href="#q6">Открываем сделку НИЖЕ</a></li>
      </ul>
    </div>
  </div>
</main>
@endsection
