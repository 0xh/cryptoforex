@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">RSI</a>
      </div>
      <section class="section">
        @lang('messages.rci1')
        @lang('messages.rci2')
        @lang('messages.rci3')
        @lang('messages.rci4')
        @lang('messages.rci5')
        @lang('messages.rci6')
      </section>
    </div>
    <div class="item">
      @lang('messages.rci7')
    </div>
  </div>
</main>
@endsection
