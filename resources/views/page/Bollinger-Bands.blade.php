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
          <strong id="q1">@lang('messages.Bol')</strong>
          <p>@lang('messages.text1')</p>
          <div>
            <img src="../images/bb1.png" alt="">
          </div>
          <a href="#" class="order next">@lang('messages.I_want') 👌</a>
        </div>
        <div class="inner hidden">
          @lang('messages.text2')
        </div>
        <div class="inner hidden">
          @lang('messages.text3')
        </div>
        <div class="inner hidden">
          @lang('messages.text4')
        </div>
        <div class="inner hidden">
          @lang('messages.text5')
        </div>
        <div class="inner hidden">
          @lang('messages.text6')
        </div>
      </section>
    </div>
    <div class="item">
      @lang('messages.text7')
    </div>
  </div>
</main>
@endsection
