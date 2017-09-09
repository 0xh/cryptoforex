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
                                <input type="checkbox" class="checkbox" id="checkbox">
                                <label for="checkbox"></label>
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
                <div class="inner flex">
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
                    <li class="active"><a href="#"><img src="images/flag-eng.png" alt=""></a></li>
                    <li><a href="#"><img src="images/flag-arab.png" alt=""></a></li>
                    <li><a href="#"><img src="images/Russia.png" alt=""></a></li>
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
