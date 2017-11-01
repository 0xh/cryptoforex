<header class="header">
    <div class="container flex">
        <div class="logo">
            <a href="/"><img src="../kriptex/images/logo_xx.png" alt=""></a>
        </div>
        <div class="search">
            <i class="face"></i>
            <p>Online <span>{{$online or 128}}</span></p>
            <!-- <form action="#"><input type="search" name="search" placeholder="Поиск инструментов. Например: LTE или Litecoin"></form> -->
        </div>
        <div class="akk flex">
            <div class="deposit">
                <a href="#">Make a deposit</a>
            </div>
            @if (Auth::guest())
                @if(Request::is('login') or Request::is('register'))
                @else
                    <p class="menu">
                        <a href="{{ route('login') }}">@lang('messages.login')</a>
                            or
                        <a href="{{ route('register') }}">@lang('messages.register')</a></p>
                @endif
            @else
            <div class="item">
                <a href="#" class="mail"></a>
            </div>
            <div class="notifications hidden">
                <div class="top flex">
                    <p>@lang('messages.Notifications')</p>
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
            <div class="item flex">
                <nav class="nav">
                    <p class="menu flex center">{{ Auth::user()->name }}
                        <span></span>
                    </p>
                    <ul class="flex column hidden">
                        <div class="top br flex">
                            <p class="active">@lang('messages.demo')</p>
                            <div>
                                <input type="checkbox" class="checkbox account-type" id="checkbox" value="demo">
                                <label for="checkbox" class=" account-type-switcher"></label>
                            </div>
                            <p>@lang('messages.real')</p>
                        </div>
                        <li><a href="#" class="bal"><i class="ic in"></i>@lang('messages.fund')</a></li>
                        <li><a href="#" class="bal2"><i class="ic out"></i>@lang('messages.out_m')</a></li>
                        <li><a href="#" class="his"><i class="ic ic_his"></i>@lang('messages.history')</a></li>
                        <li><a href="#" class="cab"><i class="ic prof"></i>@lang('messages.profil')</a></li>
                        <li><a href="#"><i class="ic prof"></i>@lang('messages.Education')</a>
                            <ul class="sub-menu">
                                <li><a href="./page/RSI">RSI</a></li>
                                <li><a href="./page/Stochastic">Stochastic</a></li>
                                <li><a href="./page/Parabolic-SAR">Parabolic SAR</a></li>
                                <li><a href="./page/MACD">MACD</a></li>
                                <li><a href="./page/SMA">SMA</a></li>
                                <li><a href="./page/Bollinger-Bands">@lang('messages.Bollinger-Bands')</a></li>
                                <li><a href="./page/Скользим-по-средним">@lang('messages.on-average')</a></li>
                                <li><a href="./page/MACD-professional">@lang('messages.MACD-p')</a></li>
                                <li><a href="./page/Японский-стандарт">@lang('messages.Japanese')</a></li>
                                <li><a href="./page/Закон-относительной-силы">@lang('messages.strength')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ic prof_out"></i>@lang('messages.logout')
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </nav>
                <script>
                    var user_accounts = [];
                    function displayuseraccount(d){
                         $('.account-display-'+d.type+' .money').html(currency.value(d.amount,'USD'));
                        return;
                        var c = $('.account-display');
                        c.html('');
                        c.append('<span class="'+d.type+'">'+d.type+'</span>');
                        $('<span class="money">'+currency.value(d.amount,'USD')+'</span>').appendTo(c).on("click",function(){new cf.loader($('.account-display'),Fresher);});
                    }
                    function userWithdrawals(c,data,x,s){
                        console.debug(data);
                        for(var i in data.data){
                            var tr = $('<tr></tr>').appendTo(c),row = data.data[i];
                            tr.append('<td>'+dateFormat(row.created_at)+'</td>');
                            tr.append('<td>'+currency.value(row.amount,'USD')+'</td>');
                            tr.append('<td>'+row.status+'</td>');
                        }

                    }
                    function userAccount(c,data,x,s){
                        for(var i in data){
                            var d = data[i];
                            user_accounts[d.type] = d;
                            displayuseraccount(d);
                            if(d.type=='real'){
                                $('.popup_bal .sum').html(currency.value(d.amount,'USD'));
                                $('.popup_bal2 .sum').html(currency.value(d.amount,'USD'));
                                $(".live-real-account").html('<i class="real"></i>'+currency.value(d.amount,'USD')+'</b>');
                            }
                            else {
                                $(".live-demo-account").html('<i class="demo"></i>'+currency.value(d.amount,'USD')+'</b>');
                            }
                        }
                        // displayuseraccount(user_accounts.demo);
                    }
                    _onload.push(function(){
                        $(".account-type-switcher").on("click",function(){
                            var vt = $('.account-type').val();
                            vt = (vt=='demo')?'real':'demo';
                            $('.account-type').val(vt);

                            $('.account-display > div').hide();
                            $('.account-display-'+vt).show();
                        });
                    });
                </script>
                <div class="inner flex loader account-display" data-action="/account?type=demo&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="1000" data-function="userAccount">
                    <div class="account-display-demo">
                        <span class="demo">@lang('messages.demo')</span>
                        <span class="money">10 000 $</span>
                    </div>
                    <div class="account-display-real" style="display:none;">
                        <span class="demo">@lang('messages.real')</span>
                        <span class="money">10 000 $</span>
                    </div>

                </div>
            </div>
            <div class="support">
                <a href="#">Client support departament</a>
                <div class="hidden">
                    <ul>
                        <li>
                            Telephone:<a href="tel:+447441913630">+447441913630</a>
                            Watsapp:<a href="tel:+447441913630">+447441913630</a>
                            Sales department:<a href="mailto:support@xcryptex.com">support@xcryptex.com</a>
                            Technical support department:<a href="mailto:ab@sky-mechanics.com">ab@sky-mechanics.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            <div class="lang">
                <ul>
                    <li>
                        <a href="#" class="flex center"><img src="images/flag-eng.png" alt=""></a>
                        <ul class="sub">
                            <li><a href="#"><img src="images/flag-arab.png" alt=""></a></li>
                            <li class="active"><a href="#"><img src="images/Russia.png" alt=""></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
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
