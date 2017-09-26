@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">SMA</a>
      </div>
      <section class="section">
        @lang('messages.SMA1')
        @lang('messages.SMA2')
        @lang('messages.SMA3')
        @lang('messages.SMA4')
        @lang('messages.SMA5')
        @lang('messages.SMA6')
      </section>
    </div>
    <div class="item">
      @lang('messages.SMA7')
    </div>
  </div>
</main>
@endsection
