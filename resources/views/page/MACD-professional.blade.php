@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">MACD professional</a>
      </div>
      <section class="section">
        @lang('messages.MACD1')
        @lang('messages.MACD2')
        @lang('messages.MACD3')
        @lang('messages.MACD4')
        @lang('messages.MACD5')
        @lang('messages.MACD6')
        @lang('messages.MACD7')
        @lang('messages.MACD8')
      </section>
    </div>
    @lang('messages.MACD9')
  </div>
</main>
@endsection
