@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">MACD</a>
      </div>
      <section class="section">
        @lang('messages.MACD_1')
        @lang('messages.MACD_2')
        @lang('messages.MACD_3')
        @lang('messages.MACD_4')
      </section>
    </div>
    @lang('messages.MACD_5')
  </div>
</main>
@endsection
