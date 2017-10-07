<header class="header">
    <div class="container flex">
        <div class="logo">
            <a href="/"><img src="../images/logo_x.png" alt=""></a>
        </div>
        <div class="search">
            <form action="#"><input type="search" name="search" placeholder="Поиск инструментов. Например: LTE или Litecoin"></form>
        </div>
        <div class="akk flex">
            <?php if(Auth::guest()): ?>
                <?php if(Request::is('login') or Request::is('register')): ?>
                <?php else: ?>
                    <p class="menu"><a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('messages.login'); ?></a> or <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('messages.register'); ?></a></p>
                <?php endif; ?>
            <?php else: ?>
            <div class="item">
                <nav class="nav">
                    <p class="menu"><?php echo e(Auth::user()->name); ?> </p>
                    <ul class="flex column hidden">
                        <div class="top br flex">
                            <p class="active"><?php echo app('translator')->getFromJson('messages.real'); ?></p>
                            <div>
                                <input type="checkbox" class="checkbox account-type" id="checkbox" value="<?php echo app('translator')->getFromJson('messages.demo'); ?>">
                                <label for="checkbox" class=" account-type-switcher"></label>
                            </div>
                            <p><?php echo app('translator')->getFromJson('messages.real'); ?></p>
                        </div>
                        <div class="br">
                            <li><a href="#" class="bal"><i class="ic in"></i><?php echo app('translator')->getFromJson('messages.fund'); ?></a></li>
                            <li><a href="#" class="bal2"><i class="ic out"></i><?php echo app('translator')->getFromJson('messages.out_m'); ?></a></li>
                            <li><a href="#" class="his"><i class="ic ic_his"></i><?php echo app('translator')->getFromJson('messages.history'); ?></a></li>
                        </div>
                        <div class="br">
                            <li><a href="#" class="cab"><i class="ic prof"></i><?php echo app('translator')->getFromJson('messages.profil'); ?></a></li>
                        </div>
                        <div class="br">
                            <li><a href="#" class="cab"><i class="ic prof"></i><?php echo app('translator')->getFromJson('messages.Education'); ?></a>
                                <ul class="sub-menu">
                                    <li><a href="../105">RSI</a></li>
                                    <li><a href="./page/RSI">Stochastic</a></li>
                                    <li><a href="./page/Stochastic">Parabolic-SAR</a></li>
                                    <li><a href="/page/Parabolic-SAR">Parabolic-SAR</a></li>
                                    <li><a href="./page/MACD">MACD</a></li>
                                    <li><a href="./page/SMA">SMA</a></li>
                                    <li><a href="./page/Bollinger-Bands">Bollinger-Bands</a></li>
                                    <li><a href="./page/Скользим-по-средним">Скользим-по-средним</a></li>
                                    <li><a href="./page/MACD-professional">MACD-professional</a></li>
                                    <li><a href="./page/Японский-стандарт">Японский-стандарт</a></li>
                                    <li><a href="./page/Закон-относительной-силы">Закон-относительной-силы</a></li>
                                </ul>
                            </li>
                        </div>
                        <!-- <li><a href="#">выход</a></li> -->
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ic prof_out"></i><?php echo app('translator')->getFromJson('messages.logout'); ?>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

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
                <div class="inner flex loader account-display" data-action="/account?type=demo&user_id=<?php echo e(Auth::user()->id); ?>" data-autostart="true" data-refresh="60000" data-function="userAccount">
                  <span class="demo"><?php echo app('translator')->getFromJson('messages.demo'); ?></span>
                  <span class="money">10 000 $</span>
                </div>
            </div>
            <div class="item">
                <a href="#" class="mail"></a>
            </div>
            <div class="notifications hidden">
                    <div class="top flex">
                        <p><?php echo app('translator')->getFromJson('messages.Notifications'); ?></p>
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
            <?php endif; ?>
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

            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'Laravel')); ?>

            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <ul class="nav navbar-nav">
                &nbsp;
            </ul>


            <ul class="nav navbar-nav navbar-right">

                <?php if(Auth::guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>">Вход</a></li>
                    <li><a href="<?php echo e(route('register')); ?>">Регистрация</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/profile">Профиль</a></li>
                            <li>
                                <a href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> -->
