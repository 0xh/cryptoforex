<aside class="left">
    <ul>
        <li>
            <a href="#">Инструменты</a>
            <div class="item flex flex-top" style="flex-wrap: wrap;">
                <script src="//www.amcharts.com/lib/3/amcharts.js"></script>
                <script src="//www.amcharts.com/lib/3/serial.js"></script>
                <script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                <script src="//www.amcharts.com/lib/3/themes/light.js"></script>
                <script>
                    var chartData = generateChartData();

                    var chart = AmCharts.makeChart("chart_pair_1", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 0,
                        "dataProvider": chartData,
                        "valueAxes": [{
                            "position": "left",
                            "title": ""
                        }],
                        "valueAxes": [
                            {
                            "type": "date"
                        }],
                        "graphs": [{
                            "id": "g1",
                            "fillAlphas": 0.8,
                            "valueField": "visits"
                        }],
                        "chartCursor": {
                            "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                            "cursorPosition": "mouse"
                        },
                        "categoryAxis": {
                            "minPeriod": "mm",
                            "labelsEnabled": false,
                            "parseDates": false
                        },
                        "export": {
                            "enabled": false,
                             "dateFormat": "HH:NN:SS"
                        }
                    });

                    var chart = AmCharts.makeChart("chart_pair_2", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 0,
                        "dataProvider": chartData,
                        "valueAxes": [{
                            "position": "left",
                            "title": ""
                        }],
                        "valueAxes": [
                            {
                            "type": "date"
                        }],
                        "graphs": [{
                            "id": "g1",
                            "fillAlphas": 0.8,
                            "valueField": "visits"
                        }],
                        "chartCursor": {
                            "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                            "cursorPosition": "mouse"
                        },
                        "categoryAxis": {
                            "minPeriod": "mm",
                            "labelsEnabled": false,
                            "parseDates": false
                        },
                        "export": {
                            "enabled": false,
                             "dateFormat": "HH:NN:SS"
                        }
                    });

                    var chart = AmCharts.makeChart("chart_pair_3", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 0,
                        "dataProvider": chartData,
                        "valueAxes": [{
                            "position": "left",
                            "title": ""
                        }],
                        "valueAxes": [
                            {
                            "type": "date"
                        }],
                        "graphs": [{
                            "id": "g1",
                            "fillAlphas": 0.8,
                            "valueField": "visits"
                        }],
                        "chartCursor": {
                            "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                            "cursorPosition": "mouse"
                        },
                        "categoryAxis": {
                            "minPeriod": "mm",
                            "labelsEnabled": false,
                            "parseDates": false
                        },
                        "export": {
                            "enabled": false,
                             "dateFormat": "HH:NN:SS"
                        }
                    });

                    var chart = AmCharts.makeChart("chart_pair_4", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 0,
                        "dataProvider": chartData,
                        "valueAxes": [{
                            "position": "left",
                            "title": ""
                        }],
                        "valueAxes": [
                            {
                            "type": "date"
                        }],
                        "graphs": [{
                            "id": "g1",
                            "fillAlphas": 0.8,
                            "valueField": "visits"
                        }],
                        "chartCursor": {
                            "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                            "cursorPosition": "mouse"
                        },
                        "categoryAxis": {
                            "minPeriod": "mm",
                            "labelsEnabled": false,
                            "parseDates": false
                        },
                        "export": {
                            "enabled": false,
                             "dateFormat": "HH:NN:SS"
                        }
                    });

                // chart.addListener("dataUpdated", zoomChart);
                    // when we apply theme, the dataUpdated event is fired even before we add listener, so
                    // we need to call zoomChart here
                // zoomChart();
                    // this method is called when chart is first inited as we listen for "dataUpdated" event
                // function zoomChart() {
                //     // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                //     chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
                // }

                    // generate some random data, quite different range
                    function generateChartData() {
                        var chartData = [];
                        // current date
                        var firstDate = new Date();
                        // now set 500 minutes back
                        firstDate.setMinutes(firstDate.getDate() - 1000);

                        // and generate 500 data items
                        var visits = 500;
                        for (var i = 0; i < 500; i++) {
                            var newDate = new Date(firstDate);
                            // each time we add one minute
                            newDate.setMinutes(newDate.getMinutes() + i);
                            // some random number
                            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
                            // add data item to the array
                            chartData.push({
                                date: newDate,
                                visits: visits
                            });
                        }
                        return chartData;
                    }
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
            </div>
            <!-- <script>
                function userInstruments(container,d,x,s){
                    // console.debug("userInstruments",container,d);
                    for(var i in d){
                        var row=d[i],inst = row.title, s='';
                        s+='<div class="inner flex column"><div class="pic flex"><img src="'+row.from_currency.image+'" alt="'+row.from_currency.name+'"><span></span><img src="'+row.to_currency.image+'" alt="'+row.to_currency.name+'"></div>';
                        s+='<div class="percent"><span class="'+((row.direction>0)?"up":"down")+'">'+currency.value(row.diff,'')+'%</span></div>';
                        s+='<p class="total">'+currency.value(row.price,'')+'</p></div>';
                        container.append(s);

                    }
                }
            </script>
            <div class="item flex flex-top loader" data-action="/instrument" data-autostart="true" data-refresh="0" data-function="userInstruments"></div> -->
        </li>
        <li>
            <a href="#">Популярные пары</a>
            <div class="item flex flex-top">
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
            </div>
        </li>
        <li>
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
        </li>
    </ul>
</aside>
