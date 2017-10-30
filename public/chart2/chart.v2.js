
var dim;
var indicatorTop;
var parseDate;
var zoom;
var x, y;
var yPercent;
var yInit, yPercentInit, zoomableInit;
var yVolume;
var candlestick;
var sma0, sma1, ema2;
var volume;
var trendline;
var supstance;
var xAxis;
var timeAnnotation;
var yAxis;
var ohlcAnnotation;
var closeAnnotation;
var percentAxis;
var percentAnnotation;
var volumeAxis;
var volumeAnnotation;
var macdScale;
var rsiScale;
var macd;
var macdAxis;
var macdAnnotation;
var macdAxisLeft;
var macdAnnotationLeft;
var rsi;
var rsiAxis;
var rsiAnnotation;
var rsiAxisLeft;
var rsiAnnotationLeft;
var ohlcCrosshair;
var macdCrosshair;
var rsiCrosshair;
var svg;
var defs

var ohlcSelection;
var indicatorSelection;

// Опции графика
var chartOptions = {
    sma0:       true,
    sma0Value:  10,
    sma1:       true,
    sma1Value:  20,
    ema2:       true,
    ema2Value:  50,

    macdVisible:    true,
    rsiVisible:     true,

    type: 1,            // Тип графика: 0-OHLC, 1-Candle, 2-Close

    trendlineData: [],
};

function createChart(elementId,chartName, ay_text)
{
    dim = {
        width: 960, height: 500,
        margin: { top: 20, right: 50, bottom: 30, left: 50 },
        ohlc: { height: 305 },
        indicator: { height: 65, padding: 5 }
    };
    dim.plot = {
        width: dim.width - dim.margin.left - dim.margin.right,
        height: dim.height - dim.margin.top - dim.margin.bottom
    };
    dim.indicator.top = dim.ohlc.height+dim.indicator.padding;
    dim.indicator.bottom = dim.indicator.top+dim.indicator.height+dim.indicator.padding;

    indicatorTop = d3.scaleLinear()
            .range([dim.indicator.top, dim.indicator.bottom]);

//    parseDate = d3.timeParse("%d-%b-%y");
    // Преобразование даты и времени из формата
    // "YYYYMMDDHHMM" в нужный формат для графика
    parseDate = d3.timeParse("%Y%m%d%H%M%Z");

    zoom = d3.zoom()
            .on("zoom", zoomed);

    x = techan.scale.financetime()
            .range([0, dim.plot.width]);

    y = d3.scaleLinear()
            .range([dim.ohlc.height, 0]);


    yPercent = y.copy();   // Same as y at this stage, will get a different domain later

    yVolume = d3.scaleLinear()
            .range([y(0), y(0.2)]);

    // Настраиваем тип графика(OHLC, Candle, ...)
    switch(chartOptions.type)
    {
        case 0:
            candlestick = techan.plot.ohlc()
                .xScale(x)
                .yScale(y);
            break;
        case 1:
            candlestick = techan.plot.candlestick()
                .xScale(x)
                .yScale(y);
            break;
        case 2:
            candlestick = techan.plot.close()
                .xScale(x)
                .yScale(y);
    }
/*    candlestick = techan.plot.candlestick()
            .xScale(x)
            .yScale(y);
*/
    sma0 = techan.plot.sma()
            .xScale(x)
            .yScale(y);

    sma1 = techan.plot.sma()
            .xScale(x)
            .yScale(y);

    ema2 = techan.plot.ema()
            .xScale(x)
            .yScale(y);

    volume = techan.plot.volume()
            .accessor(candlestick.accessor())   // Set the accessor to a ohlc accessor so we get highlighted bars
            .xScale(x)
            .yScale(yVolume);

    trendline = techan.plot.trendline()
            .xScale(x)
            .yScale(y);

    supstance = techan.plot.supstance()
            .xScale(x)
            .yScale(y);

    xAxis = d3.axisBottom(x);

    // Курсор по оси OX (текст)
    timeAnnotation = techan.plot.axisannotation()
            .axis(xAxis)
            .orient('bottom')
            .format(d3.timeFormat('%Y-%m-%d'))
            .width(65)
            .translate([0, dim.ohlc.height]);

    yAxis = d3.axisRight(y);

    ohlcAnnotation = techan.plot.axisannotation()
            .axis(yAxis)
            .orient('right')
            .format(d3.format(',.2f'))
            .translate([x(1), 0]);

    closeAnnotation = techan.plot.axisannotation()
            .axis(yAxis)
            .orient('right')
            .accessor(candlestick.accessor())
            .format(d3.format(',.2f'))
            .translate([x(1), 0]);

    percentAxis = d3.axisLeft(yPercent)
            .tickFormat(d3.format('+.1%'));

    percentAnnotation = techan.plot.axisannotation()
            .axis(percentAxis)
            .orient('left');

    volumeAxis = d3.axisRight(yVolume)
            .ticks(3)
            .tickFormat(d3.format(",.3s"));

    volumeAnnotation = techan.plot.axisannotation()
            .axis(volumeAxis)
            .orient("right")
            .width(35);

    macdScale = d3.scaleLinear()
            .range([indicatorTop(0)+dim.indicator.height, indicatorTop(0)]);

    rsiScale = macdScale.copy()
            .range([indicatorTop(1)+dim.indicator.height, indicatorTop(1)]);

/*    macdScale = d3.scaleLinear()
            .range([indicatorTop(0)+dim.indicator.height, indicatorTop(0)]);

    rsiScale = d3.scaleLinear()
            .range([indicatorTop(0)+dim.indicator.height, indicatorTop(0)]);
*/
    macd = techan.plot.macd()
            .xScale(x)
            .yScale(macdScale);

    macdAxis = d3.axisRight(macdScale)
            .ticks(3);

    macdAnnotation = techan.plot.axisannotation()
            .axis(macdAxis)
            .orient("right")
            .format(d3.format(',.2f'))
            .translate([x(1), 0]);

    macdAxisLeft = d3.axisLeft(macdScale)
            .ticks(3);

    macdAnnotationLeft = techan.plot.axisannotation()
            .axis(macdAxisLeft)
            .orient("left")
            .format(d3.format(',.2f'));

    rsi = techan.plot.rsi()
            .xScale(x)
            .yScale(rsiScale);

    rsiAxis = d3.axisRight(rsiScale)
            .ticks(3);

    rsiAnnotation = techan.plot.axisannotation()
            .axis(rsiAxis)
            .orient("right")
            .format(d3.format(',.2f'))
            .translate([x(1), 0]);

    rsiAxisLeft = d3.axisLeft(rsiScale)
            .ticks(3);

    rsiAnnotationLeft = techan.plot.axisannotation()
            .axis(rsiAxisLeft)
            .orient("left")
            .format(d3.format(',.2f'));

    ohlcCrosshair = techan.plot.crosshair()
            .xScale(timeAnnotation.axis().scale())
            .yScale(ohlcAnnotation.axis().scale())
            .xAnnotation(timeAnnotation)
            .yAnnotation([ohlcAnnotation, percentAnnotation, volumeAnnotation])
            .verticalWireRange([0, dim.plot.height]);

    macdCrosshair = techan.plot.crosshair()
            .xScale(timeAnnotation.axis().scale())
            .yScale(macdAnnotation.axis().scale())
            .xAnnotation(timeAnnotation)
            .yAnnotation([macdAnnotation, macdAnnotationLeft])
            .verticalWireRange([0, dim.plot.height]);

    rsiCrosshair = techan.plot.crosshair()
            .xScale(timeAnnotation.axis().scale())
            .yScale(rsiAnnotation.axis().scale())
            .xAnnotation(timeAnnotation)
            .yAnnotation([rsiAnnotation, rsiAnnotationLeft])
            .verticalWireRange([0, dim.plot.height]);

    div = d3.select("body").append("div").style("float", "left");

    svg = d3.select(elementId).append("svg")
            .attr("width", dim.width)
            .attr("height", dim.height);

/*    svg = d3.select("body").append("svg")
            .attr("width", dim.width)
            .attr("height", dim.height);
*/
    defs = svg.append("defs");

//-----------------------------------------------------------------------------------
    defs.append("clipPath")
            .attr("id", "ohlcClip")
        .append("rect")
            .attr("x", 0)
            .attr("y", 0)
            .attr("width", dim.plot.width)
            .attr("height", dim.ohlc.height);

    defs.selectAll("indicatorClip").data([0, 1])
        .enter()
            .append("clipPath")
            .attr("id", function(d, i) { return "indicatorClip-" + i; })
        .append("rect")
            .attr("x", 0)
            .attr("y", function(d, i) { return indicatorTop(i); })
            .attr("width", dim.plot.width)
            .attr("height", dim.indicator.height);

    svg = svg.append("g")
            .attr("transform", "translate(" + dim.margin.left + "," + dim.margin.top + ")");

    svg.append('text')
            .attr("class", "symbol")
            .attr("x", 20)
            .text(chartName);

    // Рисуем ось ось OX(Дата и время)
    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + dim.ohlc.height + ")");

    ohlcSelection = svg.append("g")
            .attr("class", "ohlc")
            .attr("transform", "translate(0,0)");

    ohlcSelection.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(" + x(1) + ",0)")
        .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", -12)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text(ay_text);

    ohlcSelection.append("g")
            .attr("class", "close annotation up");

    ohlcSelection.append("g")
            .attr("class", "volume")
            .attr("clip-path", "url(#ohlcClip)");

    ohlcSelection.append("g")
            .attr("class", "candlestick")
            .attr("clip-path", "url(#ohlcClip)");

    ohlcSelection.append("g")
            .attr("class", "indicator sma ma-0")
            .attr("clip-path", "url(#ohlcClip)");

    ohlcSelection.append("g")
            .attr("class", "indicator sma ma-1")
            .attr("clip-path", "url(#ohlcClip)");

    ohlcSelection.append("g")
            .attr("class", "indicator ema ma-2")
            .attr("clip-path", "url(#ohlcClip)");

    ohlcSelection.append("g")
            .attr("class", "percent axis");

    ohlcSelection.append("g")
            .attr("class", "volume axis");

    indicatorSelection = svg.selectAll("svg > g.indicator").data(["macd", "rsi"]).enter()
             .append("g")
                .attr("class", function(d) { return d + " indicator"; });

    indicatorSelection.append("g")
            .attr("class", "axis right")
            .attr("transform", "translate(" + x(1) + ",0)");

    indicatorSelection.append("g")
            .attr("class", "axis left")
            .attr("transform", "translate(" + x(0) + ",0)");

    indicatorSelection.append("g")
            .attr("class", "indicator-plot")
            .attr("clip-path", function(d, i) { return "url(#indicatorClip-" + i + ")"; });

    // Add trendlines and other interactions last to be above zoom pane
    svg.append('g')
            .attr("class", "crosshair ohlc");
/*
    svg.append("g")
            .attr("class", "tradearrow")
            .attr("clip-path", "url(#ohlcClip)");
*/
    svg.append('g')
            .attr("class", "crosshair macd");

    svg.append('g')
            .attr("class", "crosshair rsi");

    svg.append("g")
            .attr("class", "trendlines analysis")
            .attr("clip-path", "url(#ohlcClip)");
/*    svg.append("g")
            .attr("class", "supstances analysis")
            .attr("clip-path", "url(#ohlcClip)");*/

//    d3.select("button").on("click", reset);
}

function init()
{
    createChart("Тестовый график", "AXIS_Y");
    checkForm();
}

function clearChart()
{
    // Пересоздаем график
    d3.select("body").select("svg").remove();
    createChart("Тестовый график", "AXIS_Y");
}


/*******************************************************************************
* Описание:   Функция сброса зума(масштабирования).
* Примечание: Почему-то не работает!!!
* Параметры:  Нет.
* Возвращает: Нет.
*/
    function reset() {
/*        zoom.scale(1);
        zoom.translate([0,0]);
        draw();*/
    }

/*******************************************************************************
* Описание:   Функция зума(масштабирования).
* Примечание: Нет.
* Параметры:  Нет.
* Возвращает: Нет.
*/
    function zoomed() {
        x.zoomable().domain(d3.event.transform.rescaleX(zoomableInit).domain());
        y.domain(d3.event.transform.rescaleY(yInit).domain());
        yPercent.domain(d3.event.transform.rescaleY(yPercentInit).domain());

        updateChart();
    }

/*******************************************************************************
* Описание:   Функция добавляет данные на график.
* Примечание: Нет.
* Параметры:  Нет.
* Возвращает: Нет.
*/
//var trendlineData;

function dataChart(data)
{

        x.domain(techan.scale.plot.time(data).domain());
        y.domain(techan.scale.plot.ohlc(data).domain());
        yVolume.domain(techan.scale.plot.volume(data).domain());


/*
        trendlineData = [
            { start: { date: data[0].date, value: 14.2 }, end: { date: data[data.length-1].date, value: 15.6 } },
//            { start: { date: data[10].date, value: 14 }, end: { date: data[50].date, value: 15 } }
        ];
*/
/*
        var supstanceData = [
            { start: new Date(2014, 2, 11), end: new Date(2014, 5, 9), value: 63.64 },
            { start: new Date(2013, 10, 21), end: new Date(2014, 2, 17), value: 55.50 }
        ];

        var trades = [
            { date: data[67].date, type: "buy", price: data[67].low, low: data[67].low, high: data[67].high },
            { date: data[100].date, type: "sell", price: data[100].high, low: data[100].low, high: data[100].high },
            { date: data[130].date, type: "buy", price: data[130].low, low: data[130].low, high: data[130].high },
            { date: data[170].date, type: "sell", price: data[170].low, low: data[170].low, high: data[170].high }
        ];
*/
        var macdData = techan.indicator.macd()(data);
        macdScale.domain(techan.scale.plot.macd(macdData).domain());
        var rsiData = techan.indicator.rsi()(data);
        rsiScale.domain(techan.scale.plot.rsi(rsiData).domain());

        // Рисуем "Свечи" на графике OHLC
        svg.select("g.candlestick").datum(data).call(candlestick);
        // Рисуем последнюю точку закрытия на оси "Price($)"(зеленая)
        if (data.length > 0)
            svg.select("g.close.annotation").datum([data[data.length-1]]).call(closeAnnotation);
        // Рисуем данные "Volume" на графике OHLC
        svg.select("g.volume").datum(data).call(volume);

        // Рисуем данные SMA0
        if (chartOptions.sma0 == true) {
            svg.select("g.sma.ma-0").datum(techan.indicator.sma().period(chartOptions.sma0Value)(data)).call(sma0);
        }

        // Рисуем данные SMA1
        if (chartOptions.sma1 == true)
            svg.select("g.sma.ma-1").datum(techan.indicator.sma().period(chartOptions.sma1Value)(data)).call(sma1);
        // Рисуем данные EMA2
        if (chartOptions.ema2 == true)
        svg.select("g.ema.ma-2").datum(techan.indicator.ema().period(chartOptions.ema2Value)(data)).call(ema2);

        // Рисуем график MACD
        if (chartOptions.macdVisible == true) {
            svg.select("g.macd .indicator-plot").datum(macdData).call(macd);
            svg.select("g.crosshair.macd").call(macdCrosshair).call(zoom);
        }

        // Рисуем график RSI
        if (chartOptions.rsiVisible == true) {
            svg.select("g.rsi .indicator-plot").datum(rsiData).call(rsi);
            svg.select("g.crosshair.rsi").call(rsiCrosshair).call(zoom);
        }

        // Рисуем "Cross cursor" на графике OHLC
        svg.select("g.crosshair.ohlc").call(ohlcCrosshair).call(zoom);


        // Отображаем линии треда(косые линии)
        // если они присутствуют
        if (chartOptions.trendlineData.length > 0)
            svg.select("g.trendlines").datum(chartOptions.trendlineData).call(trendline).call(trendline.drag);

        // Отображаем линии подложки (горизонтальные, пунктирные)
//        svg.select("g.supstances").datum(supstanceData).call(supstance).call(supstance.drag);

        // Stash for zooming
        zoomableInit = x.zoomable().domain([10, data.length]).copy(); // Zoom in a little to hide indicator preroll

        yInit = y.copy();
        yPercentInit = yPercent.copy();

        updateChart();
}
/*******************************************************************************
* Описание:   Функция обновления графика.
* Примечание: Нет.
* Параметры:  Нет.
* Возвращает: Нет.
*/
function updateChart() {


        // OHLC-график
        svg.select("g.x.axis").call(xAxis);                                     // Ось OX(Дата и время)
        svg.select("g.ohlc .axis").call(yAxis);                                 // Ось OY правая(Price $)
        svg.select("g.volume.axis").call(volumeAxis);                           // Ось Volume(400M, 300M...)
        svg.select("g.percent.axis").call(percentAxis);                         // Ось OY левая(Проценты)

        // Обновление компонентов графика
        svg.select("g.candlestick").call(candlestick.refresh);                  // Свечи OHLC
        svg.select("g.close.annotation").call(closeAnnotation.refresh);
        svg.select("g.volume").call(volume.refresh);                            // Volume на графике OHLC
        svg.select("g .sma.ma-0").call(sma0.refresh);                           // SMA-0()
        svg.select("g .sma.ma-1").call(sma1.refresh);                           // SMA-1
        svg.select("g .ema.ma-2").call(ema2.refresh);                           // EMA-2(оранжевая линия)


        svg.select("g.crosshair.ohlc").call(ohlcCrosshair.refresh);             // хз!!!

        // Отображаем MACD-график
        if (chartOptions.macdVisible == true) {
            // MACD-график
            svg.select("g.macd .axis.right").call(macdAxis);                        // Ось OY правая
            svg.select("g.macd .axis.left").call(macdAxisLeft);                     // Ось OY левая
            svg.select("g.macd .indicator-plot").call(macd.refresh);                // Масштабирование MACD по оси OX
            svg.select("g.crosshair.macd").call(macdCrosshair.refresh);             // хз!!!
        }

        // Отображаем RSI-график
        if (chartOptions.rsiVisible == true) {
            // RSI-график
            svg.select("g.rsi .axis.right").call(rsiAxis);                          // Ось OY правая
            svg.select("g.rsi .axis.left").call(rsiAxisLeft);                       // Ось OY левая
            svg.select("g.crosshair.rsi").call(rsiCrosshair.refresh);               // хз!!!
            svg.select("g.rsi .indicator-plot").call(rsi.refresh);                  // Масштабирование RSI по оси OX
        }
        svg.select("g.trendlines").call(trendline.refresh);                     // Линии треда(косые линии)
//        svg.select("g.supstances").call(supstance.refresh);                     // Линии подложки (горизонтальные, пунктирные)
//        svg.select("g.tradearrow").call(tradearrow.refresh);
    }

function chartType(type)
{
    clearChart();

    // Меняем тип точки
    switch(type)
    {
        case 0:
            candlestick = techan.plot.ohlc()
                .xScale(x)
                .yScale(y);
            break;
        case 1:
            candlestick = techan.plot.candlestick()
                .xScale(x)
                .yScale(y);
            break;
        case 2:
            candlestick = techan.plot.close()
                .xScale(x)
                .yScale(y);
    }
    dataChart(newData);

    chartOptions.type = type;
}

function checkForm()
{
    // Смотрим чекбоксы SMA0, SMA1, EMA2
    if (document.getElementById("sma0Show").checked == true) {
        chartOptions.sma0 = true;
    } else {
        chartOptions.sma0 = false;
    }
    chartOptions.sma0Value = parseInt(document.getElementById("sma0_value").value);


    if (document.getElementById("sma1Show").checked == true) {
        chartOptions.sma1 = true;
    } else {
        chartOptions.sma1 = false;
    }
    chartOptions.sma1Value = parseInt(document.getElementById("sma1_value").value);

    if (document.getElementById("ema2Show").checked == true) {
        chartOptions.ema2 = true;
    } else {
        chartOptions.ema2 = false;
    }
    chartOptions.ema2Value = parseInt(document.getElementById("ema2_value").value);

    // Смотрим чекбоксы MACD, RSI
    if (document.getElementById("macdShow").checked == true) {
        chartOptions.macdVisible = true;
    } else {
        chartOptions.macdVisible = false;
    }

    if (document.getElementById("rsiShow").checked == true) {
        chartOptions.rsiVisible = true;
    } else {
        chartOptions.rsiVisible = false;
    }

    clearChart();

    dataChart(newData);
}

function addTrendline()
{
    chartOptions.trendlineData.push({
        start: {
            date: newData[0].date,
            value: newData[0].low
        },
        end: {
            date: newData[newData.length-1].date,
            value: newData[newData.length-1].high
        }
    });

    // Добавляем trendline на график
    svg.select("g.trendlines").datum(chartOptions.trendlineData).call(trendline).call(trendline.drag);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
// ТЕСТОВЫЕ ФУНКЦИИ!!!
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function TEST_getRandomValue(min, max) {
    return Math.random() * (max - min) + min;
}

var newData = [];
var date = 0;
function TEST_addRandomData()
{
    var minRand = parseFloat(document.getElementById("minRange").value);
    var maxRand = parseFloat(document.getElementById("maxRange").value);

    var max = TEST_getRandomValue(minRand, maxRand);
    var open = TEST_getRandomValue(minRand, maxRand);
    var close = TEST_getRandomValue(minRand, maxRand);
    var min = TEST_getRandomValue(minRand, maxRand);
    var vol = TEST_getRandomValue(minRand*10000, maxRand*10000);
    date++;

    newData.push({
//        date: new Date(2014, 2, date),
        date: new Date(2017, 10, 3, 1, date),
        open: open,
        high: max,
        low: min,
        close: close,
        volume: vol,
    });

//    console.log(newData);
    // Выводим данные на график
    dataChart(newData);
//    setPeriod(newData, 5);
/*    if (date>10) {
        dataChart(newData);
    }
*/
    randomTimer = setTimeout(TEST_addRandomData, 500);
}

var randomTimer;
function TEST_startRandom()
{
//    chartType(0);
    randomTimer = setTimeout(TEST_addRandomData, 500);
}

function TEST_stopRandom()
{
    clearTimeout(randomTimer);
}
