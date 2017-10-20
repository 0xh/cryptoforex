@extends('layouts.app')
@section('content')
<main class="main cart-item">
  <div class="cart wrap flex flex-top">
    <div class="item">
      <div class="back">
        <a href="/">Stochastic</a>
      </div>
      <section class="section">
        @lang('messages.Stochastic1')
        @lang('messages.Stochastic2')
        @lang('messages.Stochastic3')
        @lang('messages.Stochastic4')
        @lang('messages.Stochastic5')
        @lang('messages.Stochastic6')
        @lang('messages.Stochastic7')
      </section>
    </div>
    @lang('messages.Stochastic8')
  </div>
</main>
@endsection
