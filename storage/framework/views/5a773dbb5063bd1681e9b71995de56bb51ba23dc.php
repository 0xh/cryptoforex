<aside class="left">
    <ul>
        <li>
            <a href="#"><?php echo app('translator')->getFromJson('messages.Instruments'); ?></a>
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
                    var firstInstrument = true, informer = '',count=9;
                    for(var i in d){
                        var row=d[i],inst = row.title,elementId = 'instrument_chart_id_'+row.id;
                        if(--count==0)break;
                        if(firstInstrument){
                            firstInstrument = false;
                            window.instrument = row;
                        }
                        window.instruments[row.id]= row;
                        //<img src="/images/trade-down.png" alt="down"> EUR/USD <span style="color:#FF3100">1.1965</span>
                        informer+= (row.direction>0)?'<img src="/images/trade-up.png" alt="up">':'<img src="/images/trade-down.png" alt="fown"> '
                        informer+= row.from_currency.code+'/'+row.to_currency.code+' <span style="color:#FF3100">'+currency.value(row.price,'')+'</span> | ';

                        s='<div class="inner instrument-bar width flex flex-top '+((row.direction>0)?"green":"red")+'" id="instrument_id_'+row.id+'" onclick="chooseInstrument('+row.id+')">';
                        s+='<div class="box">'
                                +'<span><img src="'+row.from_currency.image+'" alt=""><img src="'+row.to_currency.image+'" alt=""></span>'
                                +'<p class="viz"><i class="'+((row.direction>0)?"up":"down")+'"></i>('+currency.value(row.diff,'')+'%)</p><p class="hidden slice">'+inst+'</p>'
                            +'</div>';
                        s+='<div class="box">'
                                +'<strong>'+currency.value(row.price,'')+'<sub>9</sub></strong>'
                                +'<p class="viz">L.'+currency.value(row.price,'')+'</p>'
                            +'</div>';
                        s+='<div class="box">'
                                +'<strong>'+currency.value(row.price,'')+'<sub>9</sub></strong>'
                                +'<p class="viz">H.'+currency.value(row.price,'')+'</p>'
                            +'</div>';


                        // s+='<div class="mini-chart" id="'+elementId+'"></div>';
                        // s+='<div class="title">'+row.from_currency.code+'/'+row.to_currency.code+'</div>';
                        // s+='<div class="percents"><span class="'+((row.direction>0)?"up":"down")+'">'+currency.value(row.diff,'')+'%</span></div>';
                        // s+='<div class="diff">'+currency.value(row.price,'')+'</div>';

                        s+='</div>';
                        container.append(s);
                        // graphControl.makeMiniChart({
                        //     eid:elementId,
                        //     iid:row.id
                        // });
                    }
                    $('#informer').html(informer);
                    chooseInstrument(window.instrument.id)
                }
                function chooseInstrument(id){

                    $('.instrument-bar').removeClass('active');
                    $('#instrument_id_'+id).addClass('active');
                    $('[name=instrument_id]').val(id);
                    window.instrument = window.instruments[id];
                    $("#charttitle").html('<p>'+window.instrument.title+'</p>&nbsp;&nbsp<p>'+window.instrument.price+'</p>');
                    if(window.MainChart != undefined){
                        window.MainChart.xhrInstrumentId = id;
                        window.MainChart.reloadData.call(true);
                    }else{
                        window.MainChart = new Chart(document.getElementById('main'), {
                            xhrInstrumentId: id,     // query type currency number
                            xhrPeriodFull: 720,    // data max period
                            dataNum: 60,          // default zoom number of dataset in 1 screen
                            xhrMaxInterval: 30000,  // renewal full data interval
                            xhrMinInterval: 2000,    // ticks - min interval to update and redraw last close data
                            btnVolume: false,       // bottom volume graph default state
                            colorCandleBodyUp: "#f59" // example to change positive candle body
                        });
                    }
                }
            </script>



            <!-- Новая версия -->

            <div class="item item2 flex flex-top loader-instruments" data-action="/json/instrument" data-name="instruments" data-autostart="true" data-refresh="0" data-function="userInstruments"></div>
            <!-- <div class="item item2 flex flex-top">
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <span>
                            <img src="/images/icon/btc.png" alt="">
                            <img src="/images/icon/dgb.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">btc/dgb</p>
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
                        <span>
                            <img src="/images/icon/doge.png" alt="">
                            <img src="/images/icon/eth.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">doge/eth</p>
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
                        <span>
                            <img src="/images/icon/msc.png" alt="">
                            <img src="/images/icon/nvc.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">msc/nvc</p>
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
                        <span>
                            <img src="/images/icon/ppc.png" alt="">
                            <img src="/images/icon/rdd.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">ppc/rdd</p>
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
                        <span>
                            <img src="/images/icon/start.png" alt="">
                            <img src="/images/icon/storj.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">start/storj</p>
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
                        <span>
                            <img src="/images/icon/usdt.png" alt="">
                            <img src="/images/icon/usnbt.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">usdt/usnbt</p>
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
                        <span>
                            <img src="/images/icon/usdt.png" alt="">
                            <img src="/images/icon/usnbt.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">usdt/usnbt</p>
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
                        <span>
                            <img src="/images/icon/xcp.png" alt="">
                            <img src="/images/icon/btc.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">xcp/btc</p>
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
            </div> -->
        </li>
        <li>
            <a href="#"><?php echo app('translator')->getFromJson('messages.Poppar'); ?></a>
            <!-- <div class="item flex flex-top loader-instruments" data-action="/instrument" data-autostart="true" data-refresh="0" data-function="userInstruments"></div> -->

            <!-- Новая версия -->

            <div class="item item2 flex flex-top">
                <div class="inner width flex flex-top red">
                    <div class="box">
                        <span>
                            <img src="/images/icon/btc.png" alt="">
                            <img src="/images/icon/dgb.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">btc/dgb</p>
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
                        <span>
                            <img src="/images/icon/doge.png" alt="">
                            <img src="/images/icon/eth.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">doge/eth</p>
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
                        <span>
                            <img src="/images/icon/msc.png" alt="">
                            <img src="/images/icon/nvc.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">msc/nvc</p>
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
                        <span>
                            <img src="/images/icon/ppc.png" alt="">
                            <img src="/images/icon/rdd.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">ppc/rdd</p>
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
                        <span>
                            <img src="/images/icon/start.png" alt="">
                            <img src="/images/icon/storj.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">start/storj</p>
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
                        <span>
                            <img src="/images/icon/usdt.png" alt="">
                            <img src="/images/icon/usnbt.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">usdt/usnbt</p>
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
                        <span>
                            <img src="/images/icon/usdt.png" alt="">
                            <img src="/images/icon/usnbt.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">usdt/usnbt</p>
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
                        <span>
                            <img src="/images/icon/xcp.png" alt="">
                            <img src="/images/icon/btc.png" alt="">
                        </span>
                        <p class="viz"><i class="down"></i>(0.008%)</p>
                        <p class="hidden slice">xcp/btc</p>
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