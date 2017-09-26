@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Скользим по средним</a>
      </div>
      <section class="section">
        @lang('messages.scolzim1')
        @lang('messages.scolzim2')
        @lang('messages.scolzim3')
        @lang('messages.scolzim4')
        @lang('messages.scolzim5')
        @lang('messages.scolzim6')
        @lang('messages.scolzim7')
        @lang('messages.scolzim8')
      </section>
    </div>
    <div class="item">
      @lang('messages.scolzim9')
    </div>
  </div>
</main>
@endsection
