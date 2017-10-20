@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Parabolic SAR</a>
      </div>
      <section class="section">
        @lang('messages.Parabolic1')
        @lang('messages.Parabolic2')
        @lang('messages.Parabolic3')
        @lang('messages.Parabolic4')
        @lang('messages.Parabolic5')
        @lang('messages.Parabolic6')
      </section>
    </div>
    <div class="item">
      @lang('messages.Parabolic7')
    </div>
  </div>
</main>
@endsection
