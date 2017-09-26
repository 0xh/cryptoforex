<aside class="left">
    <ul>
        <li>
            <a href="#">@lang('messages.Instruments')</a>
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
                window.instruments = [];
                window.instrument = null;
                function userInstruments(container,d,x,s){
                    // console.debug("userInstruments",container,d);
                    var firstInstrument = true, informer = '';
                    for(var i in d){
                        var row=d[i],inst = row.title,elementId = 'instrument_chart_id_'+row.id;
                        if(firstInstrument){
                            firstInstrument = false;
                            window.instrument = row;
                        }
                        window.instruments[row.id]= row;
                        //<img src="/images/trade-down.png" alt="down"> EUR/USD <span style="color:#FF3100">1.1965</span>
                        informer+= (row.direction>0)?'<img src="/images/trade-up.png" alt="up">':'<img src="/images/trade-down.png" alt="fown"> '
                        informer+= row.from_currency.code+'/'+row.to_currency.code+' <span style="color:#FF3100">'+currency.value(row.price,'')+'</span> | ';

                        s='<div class="instrument-bar" id="instrument_id_'+row.id+'" onclick="chooseInstrument('+row.id+')">';
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
                    $('#informer').html(informer);
                    chooseInstrument(window.instrument.id)
                }
                function chooseInstrument(id){
                    $('.instrument-bar').removeClass('active');
                    $('#instrument_id_'+id).addClass('active');
                    $('[name=instrument_id]').val(id);
                    window.instrument = window.instruments[id];
                    $("#charttitle").html('<h1>'+window.instrument.title+'</h1>');
                    getData(120,"chartdiv",id);
                }
            </script>
            <div class="item flex flex-top loader-instruments" data-action="/instrument" data-autostart="false" data-refresh="0" data-function="userInstruments" style="display: none !important;"></div>

            <!-- Новая версия -->

            <div class="item item2 flex flex-top">
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top green">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top green">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="#">@lang('messages.Poppar')</a>
            <!-- <div class="item flex flex-top loader-instruments" data-action="/instrument" data-autostart="true" data-refresh="0" data-function="userInstruments"></div> -->

            <!-- Новая версия -->

            <div class="item item2 flex flex-top">
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top green">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
                <div class="inner width flex flex-top green">
                    <div class="box">
                        <strong>Eur/USD</strong>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">Eur/USD</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">L.1.19524</p>
                    </div>
                    <div class="box">
                        <strong>1.1967<sub>9</sub></strong>
                        <p class="viz">H.1.20079</p>
                        <p class="hidden slice"><i class="down"></i>(0.18%)</p>
                    </div>
                </div>
            </div>


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
