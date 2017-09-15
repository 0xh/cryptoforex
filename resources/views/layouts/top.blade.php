<header class="header">
    <div class="container flex">
        <div class="logo">
            <a href="/"><img src="../images/logo_x.png" alt=""></a>
        </div>
        <div class="search">
            <form action="#"><input type="search" name="search" placeholder="Поиск инструментов. Например: LTE или Litecoin"></form>
        </div>
        <div class="akk flex">
            @if (Auth::guest())
                <p class="menu"><a href="{{ route('login') }}">@lang('messages.login')</a> or <a href="{{ route('register') }}">@lang('messages.register')</a></p>
            @else
            <div class="item">
                <nav class="nav">
                    <p class="menu">{{ Auth::user()->name }} </p>
                    <ul class="flex column hidden">
                        <div class="top br flex">
                            <p class="active">Демо счет</p>
                            <div>
                                <input type="checkbox" class="checkbox account-type" id="checkbox" value="demo">
                                <label for="checkbox" class=" account-type-switcher"></label>
                            </div>
                            <p>Реальный счет</p>
                        </div>
                        <div class="br">
                            <li><a href="#" class="bal"><i class="ic in"></i>Пополнить счет</a></li>
                            <li><a href="#" class="bal2"><i class="ic out"></i>Вывод средств</a></li>
                            <li><a href="#" class="his"><i class="ic ic_his"></i>История платежей</a></li>
                        </div>
                        <div class="br">
                            <li><a href="#" class="cab"><i class="ic prof"></i>Управление профилем</a></li>
                        </div>
                        <!-- <li><a href="#">выход</a></li> -->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ic prof_out"></i>@lang('messages.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </ul>
                </nav>
                <script>
                    var user_accounts = [];
                    function displayuseraccount(d){
                        var c = $('.account-display');
                        c.html('');
                        c.append('<span class="'+d.type+'">'+d.type+'</span>');
                        $('<span class="money">'+currency.value(d.amount,'USD')+'</span>').appendTo(c).on("click",function(){
                            new cf.loader($('.account-display'),Fresher);
                        });
                    }
                    function userAccount(c,data,x,s){
                        for(var i in data){
                            var d = data[i];
                            user_accounts[d.type] = d;
                        }
                        displayuseraccount(user_accounts.demo);
                        $(".account-type-switcher").unbind("click").on("click",function(){
                            var vt = $('.account-type').val();
                            vt = (vt=='demo')?'real':'demo';
                            $('.account-type,[name=account_type]').val(vt);

                            displayuseraccount(user_accounts[vt]);
                        });
                    }
                </script>
                <div class="inner flex loader account-display" data-action="/account?type=demo&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="60000" data-function="userAccount">
                  <span class="demo">Демо счет</span>
                  <span class="money">10 000 $</span>
                </div>
            </div>
            <div class="item">
                <a href="#" class="mail"></a>
            </div>
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
                            <a href="#">
                                Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Закрытие позиций по биткойну и лайткойну
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Изменение торгового времени 28 августа по Z (FTSE) в связи с летними банковскими выходными в Великобритании
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                13 августа переход на летнее время в Чили
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Изменение торгового времени 15 августа в связи с Днем Вознесения Девы Марии 2017
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                13 августа переход на летнее время в Чили
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="lang">
                <ul>
                    <li><a href="#"><img src="images/flag-eng.png" alt=""></a></li>
                    <li><a href="#"><img src="images/flag-arab.png" alt=""></a></li>
                    <li class="active"><a href="#"><img src="images/Russia.png" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="informer-wrap">
        <div id="informer">
            <img src="/images/trade-down.png" alt="down"> EUR/USD <span style="color:#FF3100">1.1965</span> | 
            <img src="/images/trade-down.png" alt="down"> USD/JPY <span style="color:#FF3100">110.16</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/USD <span style="color:#FF3100">1.3285</span> | 
            <img src="/images/trade-down.png" alt="down"> USD/CHF <span style="color:#FF3100">0.9602</span> | 
            <img src="/images/trade-up.png" alt="up"> USD/CAD <span style="color:#6EAC2C">1.2179</span> | 
            <img src="/images/trade-down.png" alt="down"> EUR/JPY <span style="color:#FF3100">131.80</span> | 
            <img src="/images/trade-up.png" alt="up"> AUD/USD <span style="color:#6EAC2C">0.8018</span> | 
            <img src="/images/trade-up.png" alt="up"> NZD/USD <span style="color:#6EAC2C">0.7283</span> | 
            <img src="/images/trade-up.png" alt="up"> EUR/GBP <span style="color:#6EAC2C">0.9004</span> | 
            <img src="/images/trade-down.png" alt="down"> EUR/CHF <span style="color:#FF3100">1.1492</span> | 
            <img src="/images/trade-down.png" alt="down"> AUD/JPY <span style="color:#FF3100">88.33</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/JPY <span style="color:#FF3100">146.34</span> | 
            <img src="/images/trade-up.png" alt="up"> CHF/JPY <span style="color:#6EAC2C">114.69</span> | 
            <img src="/images/trade-up.png" alt="up"> EUR/CAD <span style="color:#6EAC2C">1.4572</span> | 
            <img src="/images/trade-up.png" alt="up"> AUD/CAD <span style="color:#6EAC2C">0.9766</span> | 
            <img src="/images/trade-down.png" alt="down"> CAD/JPY <span style="color:#FF3100">90.42</span> | 
            <img src="/images/trade-up.png" alt="up"> NZD/JPY <span style="color:#6EAC2C">80.26</span> | 
            <img src="/images/trade-down.png" alt="down"> AUD/NZD <span style="color:#FF3100">1.1005</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/AUD <span style="color:#FF3100">1.6566</span> | 
            <img src="/images/trade-down.png" alt="down"> EUR/AUD <span style="color:#FF3100">1.4919</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/CHF <span style="color:#FF3100">1.2760</span> | 
            <img src="/images/trade-down.png" alt="down"> EUR/NZD <span style="color:#FF3100">1.6423</span> | 
            <img src="/images/trade-down.png" alt="down"> AUD/CHF <span style="color:#FF3100">0.7701</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/NZD <span style="color:#FF3100">1.8235</span> | 
            <img src="/images/trade-down.png" alt="down"> USD/SGD <span style="color:#FF3100">1.3461</span> | 
            <img src="/images/trade-down.png" alt="down"> USD/HKD <span style="color:#FF3100">7.8096</span> | 
            <img src="/images/trade-down.png" alt="down"> USD/DKK <span style="color:#FF3100">6.2157</span> | 
            <img src="/images/trade-down.png" alt="down"> GBP/CAD <span style="color:#FF3100">1.6184</span>
        </div>
    </div>
</header>
                        <!-- <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">


            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <ul class="nav navbar-nav">
                &nbsp;
            </ul>


            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Вход</a></li>
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/profile">Профиль</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> -->
