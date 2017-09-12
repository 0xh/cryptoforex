<aside class="right">
    <script>
        function dealInfo(deal){
            $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
            $('.popup_deal_info,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
            var rchart = null;
            // console.debug(deal);
            graphControl.makeChart(120,"chartdiv_p1",null,rchart);
            $('.popup_deal_info .deal-profit').html('<span class="'+((deal.profit>0)?"up":"down")+'">'+deal.profit+'</span>');
            $('.popup_deal_info .deal-time').html('<p><span class="time">'+new Date(deal.created_at*1000)+'</span></p>');
            $('.popup_deal_info .deal-amount').html('<p>'+currency.value(deal.amount,deal.currency.code)+'</p>');
            $('.popup_deal_info .deal-multiplier').html('<p>'+currency.value(deal.amount*deal.multiplier,deal.currency.code)+'</p>');
            $('.popup_deal_info #deal_id').val(deal.id);
        }
        function userDeals(container,d,x,s){
            // console.debug("deals",container,d);
            if(!container.find('.title').length)container.append('<div class="item flex title"><div class="inner">Инструмент</div><div class="inner">Вложено</div><div class="inner">Прибыль</div></div>');
            for(var i in d){
                var row=d[i];
                // console.debug(row);
                var inst = "BTC/BCH",profit = row.profit,amount = currency.value(row.amount,'USD'), profit_type=(profit>0)?'up':'down';
                if(!container.find('#deal-'+row.id).length)container.append('<div onclick=\'dealInfo('+JSON.stringify(row)+')\' id="deal-'+row.id+'" class="item flex deal-row"><div class="inner instrument">'+inst+'</div><div class="inner amount">'+amount+'</div><div class="inner '+profit_type+' profit">'+profit+'</div></div>');
                else{
                    // container.find('#deal-'+row.id+' .intrument').text(inst);
                    container.find('#deal-'+row.id+' .profit').text(profit).removeClass('up').removeClass('down').addClass(profit_type);
                    // container.find('#deal-'+row.id+' .amount').text(amount);
                }
            }
        }
    </script>
    <div class="deal">
        <h2>Активные сделки</h2>
        <div class="flex column">
            <div class="flex column width mh">
                <div class="top loader" data-action="/deal" data-autostart="true" data-refresh="60000" data-function="userDeals"></div>

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

                <div class="bot">
                    <ul class="flex">
                        <li class="active"><a href="./page/analitica" class="b03">Аналитика</a></li>
                    </ul>
                </div>
            </div>
            <div class="new width">
                <!-- <div class="flex">
                    <div class="inner">
                        <p>BTC/LTE</p>
                    </div>
                    <div class="inner">
                        <p class="up">1.17935</p>
                    </div>
                    <div class="inner">
                        <p class="down">-0.25%</p>
                    </div>
                </div> -->
                <a href="#" class="order b01">Открыть сделку</a>
            </div>
        </div>
    </div>
</aside>
