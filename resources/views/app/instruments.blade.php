<aside class="left">
    <ul>
        <li>
            <a href="#">Инструменты</a>
            <!-- <div class="item flex flex-top" style="flex-wrap: wrap;">
                <script>

                </script>
                <div class="inner">
                    <div id="chart_pair_1" class="chart_pair"></div>
                </div>
                <div class="inner">
                    <div id="chart_pair_2" class="chart_pair"></div>
                </div>
                <div class="inner">
                    <div id="chart_pair_3" class="chart_pair"></div>
                </div>
                <div class="inner">
                    <div id="chart_pair_4" class="chart_pair"></div>
                </div>
            </div> -->
            <script>
                function userInstruments(container,d,x,s){
                    // console.debug("userInstruments",container,d);
                    for(var i in d){
                        var row=d[i],inst = row.title,elementId = 'instrument_chart_id_'+row.id;
                        s='<div class="instrument-bar">';
                        s+='<div class="mini-chart" id="'+elementId+'"></div>';
                        s+='<div class="title">'+row.from_currency.code+'/'+row.to_currency.code+'</div>';
                        s+='<div class="percents"><span class="'+((row.direction>0)?"up":"down")+'">'+currency.value(row.diff,'')+'%</span></div>';
                        s+='<div class="diff">'+currency.value(row.price,'')+'</div>';
                        s+='</div>';
                        container.append(s);
                        graphControl.makeMiniChart({
                            eid:elementId,
                            iid:row.id
                        });
                    }
                }
            </script>
            <div class="item flex flex-top loader-instruments" data-action="/instrument" data-autostart="true" data-refresh="0" data-function="userInstruments"></div>
        </li>
        <li>
            <a href="#">Популярные пары</a>
            <div class="item flex flex-top loader-instruments" data-action="/instrument" data-autostart="true" data-refresh="0" data-function="userInstruments"></div>
            <!-- <div class="item flex flex-top">
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="down">-3%</span>
                    </div>
                    <p class="total">2 357.57</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/Ethereum.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">21%</span>
                    </div>
                    <p class="total">371.53</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/Ethereum.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">5%</span>
                    </div>
                    <p class="total">2357.57</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="down">-3%</span>
                    </div>
                    <p class="total">2 357.57</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/Ethereum.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">21%</span>
                    </div>
                    <p class="total">371.53</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/Ethereum.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">5%</span>
                    </div>
                    <p class="total">2357.57</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="down">-3%</span>
                    </div>
                    <p class="total">2 357.57</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/bitcoin.png" alt="">
                        <span></span>
                        <img src="images/Ethereum.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">21%</span>
                    </div>
                    <p class="total">371.53</p>
                </div>
                <div class="inner flex column">
                    <div class="pic flex">
                        <img src="images/Ethereum.png" alt="">
                        <span></span>
                        <img src="images/litecoin.png" alt="">
                    </div>
                    <div class="percent">
                        <span class="up">5%</span>
                    </div>
                    <p class="total">2357.57</p>
                </div>
            </div> -->

        </li>
        <!-- <li>
            <a href="#">Выбор инструментов</a>
            <div class="item flex flex-top">
                <div class="inner flex">
                    <img src="images/bitcoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="down">-3%</span>
                        <p class="total">2 357.57</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/Ethereum.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">7%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/litecoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">3,12%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/bitcoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="down">-3%</span>
                        <p class="total">2 357.57</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/Ethereum.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">7%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/litecoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">3,12%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/bitcoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="down">-3%</span>
                        <p class="total">2 357.57</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/Ethereum.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">7%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/litecoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">3,12%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/bitcoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="down">-3%</span>
                        <p class="total">2 357.57</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/Ethereum.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">7%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
                <div class="inner flex">
                    <img src="images/litecoin.png" alt="">
                    <div class="percent_total flex column">
                        <span class="up">3,12%</span>
                        <p class="total">237.16</p>
                    </div>
                </div>
            </div>
        </li> -->
    </ul>
</aside>
