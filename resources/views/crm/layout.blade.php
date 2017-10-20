<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <!-- SEO Meta -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="/crmd2/style/main.css">

    <link rel="stylesheet" href="/crmd2/style/i2.css">

    <link rel="stylesheet" href="/crmd2/style/dhtmlxscheduler.css">
    <script src="/crmd2/js/dhtmlxscheduler.js"></script>
    <script>
        scheduler.config.xml_date="%Y-%m-%d %H:%i";
        scheduler.templates.week_date_class=function(date,today){return (date.getDay()==0 || date.getDay()==6)?"weekday":"";};
    </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        window.animationTime = 256;
        window.onloads = [];
        var currency = {
            data:{},
            value: function(a,c){
                var symb = (c=='' || this.data[c] == undefined)?'':this.data[c].unicode,sign = (parseFloat(a)<0)?'-':'',val = Math.abs(parseFloat(a));

                return sign+symb+val.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            },
            image:function(c){
                return (c=='' || this.data[c] == undefined)?'':this.data[c].image;
            }
        };
        @if(isset($currencies))
            @foreach($currencies as $currency)
                currency.data["{{$currency->code}}"]={
                    id:{{$currency->id}},
                    symbol:'{{$currency->symbol}}',
                    unicode:'{{$currency->unicode}}',
                    image:'{{$currency->image}}'
                };
            @endforeach
        @endif

    </script>
</head>
<!-- <body onload="init();"> -->
<body>
    <header class="header">
        <div class="container flex">
            <div class="logo">
                <a href="/"><img src="images/logo_x.png" alt=""></a>
            </div>
            <div class="search">
                <form action="#">
                    <input type="search" name="search" placeholder="Поиск инструментов. Например: LTE или Litecoin">
                </form>
            </div>
            @if (Auth::guest())
                <a class="out" href="{{ url('/login') }}">Login</a>
                <a class="out" href="{{ url('/register') }}">Register</a>
            @else
                <div class="akk flex">
                    <div class="item">
                        <nav class="nav">
                            <a>{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            <!-- <p class="menu">Имя аккаунта</p> -->
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="out"><i class="ic prof_out"></i>@lang('message.logout')</a>
                        </nav>
                    </div>
                    <!-- <div class="item"><a href="#" class="mail"></a></div> -->
                    <div class="notifications hidden">
                        <div class="top flex">
                            <p>Уведомления</p>
                            <div class="arrow">
                                <a href="#" class="left"></a>
                                <a href="#" class="right"></a>
                            </div>
                        </div>
                        <ul>
                            <li class="active">
                                <a href="#">Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017</a>
                            </li>
                            <li>
                                <a href="#">Закрытие позиций по биткойну и лайткойну</a>
                            </li>
                            <li>
                                <a href="#">Изменение торгового времени 28 августа по Z (FTSE) в связи с летними банковскими выходными в Великобритании</a>
                            </li>
                            <li>
                                <a href="#">Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017</a>
                            </li>
                            <li>
                                <a href="#">13 августа переход на летнее время в Чили</a>
                            </li>
                            <li>
                                <a href="#">Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017</a>
                            </li>
                            <li>
                                <a href="#">13 августа переход на летнее время в Чили</a>
                            </li>
                        </ul>
                    </div>
                    <div class="lang">
                        <ul>
                            <li class="<?php if(App::isLocale('en')) echo 'active';?>"><a href="/locale/en"><img src="images/flag-eng.png" alt=""></a>
                            </li>
                            <li class="<?php if(App::isLocale('en')) echo 'active';?>">
                                <a href="/locale/ru"><img src="images/Russia.png" alt=""></a>
                            </li>
                            <li class="<?php if(App::isLocale('en')) echo 'active';?>">
                                <a href="/locale/ar"><img src="images/flag-arab.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="item flex">
                <p>"Xcryptex LTD, London, UK. VAT 000000000"</p>
                <div class="copyright">
                    <p>Xcryptex LTD Copyright 2017 ©</p>
                </div>
            </div>
        </div>
    </footer>
    @include('crm.popup')
<!-- Script-->
  <!--  Vendor amCharts -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="/crmd2/js/jquery.shapeshift.min.js"></script>
  <script>
    $('.content').shapeshift({
        minColumns: 3
    });
  </script>
  <script src="/crmd2/js/js.js"></script>


  <!-- <script src="http://aplicant.good-point.ru/alfa-diamonds/js/jquery.shapeshift-master/core/jquery.shapeshift.min.js"></script> -->
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script src="https://www.amcharts.com/lib/3/amstock.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <!-- <script src="/crmd2/js/main.js"></script> -->


  <!-- <script src="/crmd2/js/main_new.js"></script> -->
  <script src="/crmd2/js/i.js"></script>
  <!-- <script src="/crmd2/js/jquery.shapeshift.min.js"></script> -->
  <script src="{{ asset('js/loader.js') }}"></script>
  <script src="{{ asset('js/cryptofx.fn.js') }}"></script>

</body>
</html>
