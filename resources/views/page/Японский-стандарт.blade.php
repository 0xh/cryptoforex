@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Японский стандарт</a>
      </div>
      <section class="section">
        @lang('messages.yap1')
        @lang('messages.yap2')
        @lang('messages.yap3')
        @lang('messages.yap4')
        @lang('messages.yap5')
        @lang('messages.yap6')
        @lang('messages.yap7')
        @lang('messages.yap8')
      </section>
    </div>
    <div class="item">
      @lang('messages.yap9')
    </div>
  </div>
</main>
@endsection
