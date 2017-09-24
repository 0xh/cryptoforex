@extends('layouts.app')
@section('content')
<main class="main">
    <div class="container flex flex-top">
        @include('app.instruments')
        @include('app.graph')
        @include('app.deals')

    </div>

    @include('layouts.bottom')

</main>

<footer class="footer">
    <div class="container"></div>
</footer>



@endsection
