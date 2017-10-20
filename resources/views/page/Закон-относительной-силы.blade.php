@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Закон относительной силы</a>
      </div>
      <section class="section">
        @lang('messages.zakon1')
        @lang('messages.zakon2')
        @lang('messages.zakon3')
        @lang('messages.zakon4')
        @lang('messages.zakon5')
        @lang('messages.zakon6')
        @lang('messages.zakon7')
        @lang('messages.zakon8')
      </section>
    </div>
    <div class="item">
      @lang('messages.zakon9')
    </div>
  </div>
</main>
@endsection
