<aside class="right">
    <div class="deal">
        <h2>Активные сделки</h2>
        <div class="flex column">
            <div class="flex column width mh">
                <script>
                    function userDeals(container,d,x,s){
                        console.debug("deals",d,x,s);
                        container.append('<div class="item flex title"><div class="inner">Инструмент</div><div class="inner">Вложено</div><div class="inner">Прибыль</div></div>');
                        for(var i in d){
                            var row=d[i];
                            console.debug(row);
                            var inst = "BTC/BCH",profit = row.profit,bet = row.bet;
                            container.append('<div class="item flex"><div class="inner">'+inst+'</div><div class="inner">'+bet+'</div><div class="inner down">'+profit+'</div></div>');
                        }
                    }
                </script>
                <div class="top loader" data-action="/deal" data-autostart="true" data-refresh="1" data-function="userDeals">

                    <!-- <div class="item flex"><div class="inner">BTC/ETH</div><div class="inner">100.00$</div><div class="inner down">-3.54$</div></div>
                    <div class="item flex">
                        <div class="inner">BTC/ETH</div>
                        <div class="inner">100.00$</div>
                        <div class="inner down">-7.23$</div>
                    </div>
                    <div class="item flex">
                        <div class="inner">LTE/STEEM</div>
                        <div class="inner">100.00$</div>
                        <div class="inner up">23.15$</div>
                    </div>
                    <div class="item flex">
                        <div class="inner">DOGE/DASH</div>
                        <div class="inner">100.00$</div>
                        <div class="inner up">16.76$</div>
                    </div> -->
                </div>
                <div class="bot">
                    <ul class="flex">
                        <li class="active"><a href="#">Отчет</a></li>
                        <li><a href="#">Закрытые</a></li>
                    </ul>
                </div>
            </div>
            <div class="new width">
                <div class="flex">
                    <div class="inner">
                        <p>BTC/LTE</p>
                    </div>
                    <div class="inner">
                        <p class="up">1.17935</p>
                    </div>
                    <div class="inner">
                        <p class="down">-0.25%</p>
                    </div>
                </div>
                <a href="#" class="order">Открыть сделку</a>
            </div>
        </div>
    </div>
</aside>
