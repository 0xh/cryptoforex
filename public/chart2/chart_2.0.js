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
var defs;

var ohlcSelection;
var indicatorSelection;
var div;
// Опции графика
var chartOptions = {
    title: "Test Chart",
    title_y: "",

    grid_x_step: 100,          // Шаг горизонтальной сетки
    grid_y_step: 100,          // Шаг вертикальной сетки

    // Размеры иконок валютных пар
    icons_width: 20,
    icons_height: 20,

    sma0:       false,
    sma0Value:  10,
    sma1:       false,
    sma1Value:  20,
    ema2:       false,
    ema2Value:  50,

    macdVisible:    false,
    rsiVisible:     false,

    type: 1,            // Тип графика: 0-OHLC, 1-Candle, 2-Close

    trendlineData: [],
};

var newData = [];

var test_params = {
    id: 1,
    from_currency_id: "2",
    to_currency_id: "3",
    commission: "0.02",
    enabled: "1",
    title: "BTC\/BCH",
    from: {
        id: 2,
        name: "Bitcoin",
        code: "BTC",
        image: "https:\/\/www.cryptocompare.com\/media\/19633\/btc.png",
        symbol: "\\f15a",
        unicode: "\\u20bf"
    },
    to: {
        id: 3,
        name: "Bitcoin cash",
        code: "BCH",
        image: "https:\/\/www.cryptocompare.com\/media\/1383919\/bch.jpg",
        symbol: "\\f15a",
        unicode: "\\u20bf"
    },
    histo: {
        id: 16595,
        created_at: "1509331973",
        source_id: "1",
        instrument_id: "1",
        time: "1509331920",
        open: "14.25000",
        low: "14.22000",
        high: "14.25000",
        close: "14.21000",
        volumefrom: "0.9082000000",
        volumeto: "12.9000000000",
        exchange: "CCAGG",
        volation: "1"
    }
}

var title_position = 0;
var title_date_time = "0000";
function draw_title()
{
    // Пишем статус графика
    title_position +=10;
    var symb_width = chartOptions.title.length;
    var online_status = svg.append('text')
            .attr("class", "symbol")
            .attr("x", title_position)
            .text(chartOptions.title);
    title_position += online_status.node().getBBox().width + symb_width;


    // Выводим первую иконку
    svg.append("svg:image")
        .attr("xlink:href", test_params.from.image)
        .attr("width", chartOptions.icons_width)
        .attr("height", chartOptions.icons_height)
        .attr("x", title_position)
        .attr("y",-15);
    title_position += chartOptions.icons_width + symb_width;

    // Выводим вторую иконку
    svg.append("svg:image")
        .attr("xlink:href", test_params.to.image)
        .attr("width", chartOptions.icons_width)
        .attr("height", chartOptions.icons_height)
        .attr("x", title_position)
        .attr("y",-15);
    title_position += chartOptions.icons_width + symb_width;

    // Пишем название валютной пары
    var pair = svg.append('text')
            .attr("class", "symbol")
            .attr("x", title_position)
            .text(test_params.title);
    title_position += pair.node().getBBox().width + symb_width;

    // Пишем текущие дату и время
    svg.append('text')
            .attr("class", "symbol")
            .attr("x", title_position)
            .text(title_date_time);
}

var pbar_value = 0;
function draw_percent_bar(percent)
{
    var top_bottom = 20;    // Отступы сверху снизу от начала бара

    // Значение 100%
    var full_bar = dim.ohlc.height-(top_bottom*2);

    // Рисуем вертикальный индикатор
    var rect = svg.append("rect")
            .attr("class", "vertical_bar")
            .attr("x", 10)
            .attr("y", dim.indicator.padding)
            .attr("width", 30)
            .attr("height", dim.ohlc.height);


    // Выводим верхнее значение в процентах
    svg.append('text')
            .attr("class", "bar_symbol")
            .attr("x", 15)
            .attr("y", 20)
            .text(percent + "%");

    // Рисуем индикатор
//    var value_bar1 = ;
    svg.append("line")
            .attr("class", "vertical_bar_red")
            .attr("x1", 25)
            .attr("y1", 30)
            .attr("x2", 25)
//            .attr("y2", vred_ind1_value);
            .attr("y2", ((full_bar/100)*percent));//dim.ohlc.height-20);


    svg.append("line")
            .attr("class", "vertical_bar_green")
            .attr("x1", 25)
            .attr("y1", (((full_bar/100)*percent)+8))
            .attr("x2", 25)
            .attr("y2", dim.ohlc.height-18);

    // Выводим нижнее значение в процентах
    svg.append('text')
            .attr("class", "bar_symbol")
            .attr("x", 15)
            .attr("y", dim.ohlc.height-2)
            .text((100-percent) + "%");
}



//var CandleChart = function createChart(element_selector, params)
function createChart(element_selector, params)
{
    title_position = 0;
    // Анализируем входные параметры
    //--------------------------------------------------------------------------
    // 1. Формируем параметры запросов
    requestParams.instrument_id = params.histo.instrument_id;
    requestParams.price_id = params.id;
    //--------------------------------------------------------------------------
    dim = {
        width: 640, height: 480,
        margin: { top: 20, right: 50, bottom: 30, left: 50 },
        ohlc: { height: 305 },
        indicator: { height: 65, padding: 5 }
    };

    // Подключаемся к DIV
    // и берем размеры у него
    // Высоты графиков:
    // *candle - 74%
    // *macd - 13%
    // *rsi - 13%
    div = d3.select(element_selector);
    dim.width = parseInt(div.style("width"));
    dim.height = parseInt(div.style("height"));
    dim.ohlc.height = dim.height - (dim.indicator.height*2) - (dim.margin.top*2) - (dim.indicator.padding);

    dim.plot = {
        width: dim.width - dim.margin.left - dim.margin.right,
        height: dim.height - dim.margin.top - dim.margin.bottom
    };
    dim.indicator.top = dim.ohlc.height+dim.indicator.padding;
    dim.indicator.bottom = dim.indicator.top+dim.indicator.height+dim.indicator.padding;

    // Рисуем график по всей высоте
    if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == false))
    {
        dim.ohlc.height = dim.height - (dim.margin.top*2) - (dim.indicator.padding);
    } else
    if (((chartOptions.macdVisible == true) && (chartOptions.rsiVisible == false)) ||
        ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == true)))
    {
        dim.indicator.height = dim.indicator.height*2;
    }

    indicatorTop = d3.scaleLinear()
            .range([dim.indicator.top, dim.indicator.bottom]);

//    parseDate = d3.timeParse("%d-%b-%y");
    // Преобразование даты и времени из формата
    // "YYYYMMDDHHMM" в нужный формат для графика
//    parseDate = d3.timeParse("%Y%m%d%H%M%Z");

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
            .tickFormat(d3.format("+.1%"));


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
//------------------------------------------------------------------------------
var index=0;
// 1. Включены оба графика
if ((chartOptions.macdVisible == true) && (chartOptions.rsiVisible == true))
{
    index = 1;
} else
// 2. Выключен график RSI
if ((chartOptions.macdVisible == true) && (chartOptions.rsiVisible == false))
{
    index = 1;
} else
// 3. Выключен график MACD
if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == true))
{
    index = 0;
} else
// 4. Выключены оба графика
if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == false))
{
    index = 1;
}
    macdScale = d3.scaleLinear()
            .range([indicatorTop(0)+dim.indicator.height, indicatorTop(0)]);

    rsiScale = d3.scaleLinear()//macdScale.copy()
            .range([indicatorTop(index)+dim.indicator.height, indicatorTop(index)]);
//------------------------------------------------------------------------------
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
            .yAnnotation([ohlcAnnotation, volumeAnnotation])
//            .yAnnotation([ohlcAnnotation, percentAnnotation, volumeAnnotation])
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

    svg = div.append("svg")
            .attr("width", dim.width)
            .attr("height", dim.height);

    draw_percent_bar(pbar_value);

    defs = svg.append("defs");

//-----------------------------------------------------------------------------------
    defs.append("clipPath")
            .attr("id", "ohlcClip")
        .append("rect")
            .attr("x", 0)
            .attr("y", 0)
            .attr("width", dim.plot.width)
            .attr("height", dim.ohlc.height);
//------------------------------------------------------------------------------
// 1. Включены оба графика
if ((chartOptions.macdVisible == true) && (chartOptions.rsiVisible == true))
{
    defs.selectAll("indicatorClip").data([0, 1])
        .enter()
            .append("clipPath")
            .attr("id", function(d, i) { return "indicatorClip-" + i; })
        .append("rect")
            .attr("x", 0)
            .attr("y", function(d, i) { return indicatorTop(i); })
            .attr("width", dim.plot.width)
            .attr("height", dim.indicator.height);
} else
// 2. Выключен график RSI
if ((chartOptions.macdVisible == true) && (chartOptions.rsiVisible == false))
{
    defs.selectAll("indicatorClip").data([0, 1])
        .enter()
            .append("clipPath")
            .attr("id", function(d, i) { return "indicatorClip-" + i; })
        .append("rect")
            .attr("x", 0)
            .attr("y", function(d, i) { return indicatorTop(i); })
            .attr("width", dim.plot.width)
            .attr("height", dim.indicator.height);
} else
// 3. Выключен график MACD
if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == true))
{
    defs.selectAll("indicatorClip").data([0, 1])
        .enter()
            .append("clipPath")
            .attr("id", function(d, i) { return "indicatorClip-" + i; })
        .append("rect")
            .attr("x", 0)
            .attr("y", function(d, i) { return indicatorTop(0); })
            .attr("width", dim.plot.width)
            .attr("height", dim.indicator.height);
} else
// 4. Выключены оба графика
if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == false))
{
    defs.selectAll("indicatorClip").data([0, 1])
        .enter()
            .append("clipPath")
            .attr("id", function(d, i) { return "indicatorClip-" + i; })
        .append("rect")
            .attr("x", 0)
            .attr("y", function(d, i) { return indicatorTop(i); })
            .attr("width", dim.plot.width)
            .attr("height", dim.indicator.height);
}


//------------------------------------------------------------------------------
    svg = svg.append("g")
            .attr("transform", "translate(" + dim.margin.left + "," + dim.margin.top + ")");

    // Формируем название графика
    draw_title();
    // Рисуем горизонтальную сетку
    for (var i=1; i<(dim.ohlc.height/chartOptions.grid_x_step); i++)
    {
        svg.append('line')
                .attr("class", "grid")
                .attr("x1", 0)
                .attr("y1", (i*chartOptions.grid_x_step + 0.5))
                .attr("x2", (dim.width - 100))
                .attr("y2", (i*chartOptions.grid_x_step + 0.5));
    }

    // Рисуем вертикальную сетку
    for (var i=0; i<((dim.width-100)/chartOptions.grid_y_step); i++)
    {
        svg.append('line')
                .attr("class", "grid")
                .attr("x1", (i*chartOptions.grid_y_step))
                .attr("y1", 0)
                .attr("x2", (i*chartOptions.grid_y_step))
                .attr("y2", dim.ohlc.height);
    }

    // Рисуем ось OX(Дата и время)
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
            .text(chartOptions.title_y);

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
    // createChart("#chart_field", test_params);
//    createChart("#tst_field", test_params);

//    checkForm();

    // Обнуляем массив
    // newData.length = 0;
    // sendRequest();

    // Далее будем запрашивать по одному элементу раз в минуту
//    RequestParams.limit = 1;
}

//CandleChart.prototype.clearChart = function()
function clearChart()
{
    // Пересоздаем график
    d3.select("body").select("svg").remove();
    createChart("#chart_field", test_params);
//    createChart("#tst_field", test_params);

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
var zoom_value = 0;
//CandleChart.prototype.zoomChart = function()
function zoomChart(type)
{
    console.log(newData.length);
    //x.zoomable().domain([zoom_value, newData.length]).copy();
    if (type == 0) {
        zoom_value++;
    } else {
        if (zoom_value > 0) {
            zoom_value--;
        }
    }

    dataChart(newData);

}
    function zoomed() {
        // x.zoomable().domain(d3.event.transform.rescaleX(zoomableInit).domain());
        // y.domain(d3.event.transform.rescaleY(yInit).domain());
        // yPercent.domain(d3.event.transform.rescaleY(yPercentInit).domain());
/*
    var zum = x.zoomable();

    var val = zum.domain();
    var low = x.invertToIndex(Math.round(val[0]));
    var high = x.invertToIndex(Math.round(val[1]));

    console.log(low + " - " + high);

 x.zoomable().domain()
(2) [-0.5200000000000001, 6.573851216282099]
48index.html:668 -1 - 0
x.zoomable().domain()
(2) [-0.5200000000000001, 5.385449030184755]
index.html:668 -1 - 0
x.zoomable().domain()
(2) [-0.5200000000000001, 5.809189415589086]
Math.ro
undefined
Math.round(x.zoomable().domain()[0])
-1
 */
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
//CandleChart.prototype.dataChart = function(data)
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

/*        if ((chartOptions.macdVisible == false) && (chartOptions.rsiVisible == false)) {
            d3.select("body").select("svg").style("height", "345");
        } else {
//            d3.select("body").select("svg").style("height", "500");
            d3.select("body").select("svg").style("height", dim.height);
        }
*/
        // Рисуем "Cross cursor" на графике OHLC
        svg.select("g.crosshair.ohlc").call(ohlcCrosshair).call(zoom);


        // Отображаем линии треда(косые линии)
        // если они присутствуют
        if (chartOptions.trendlineData.length > 0)
            svg.select("g.trendlines").datum(chartOptions.trendlineData).call(trendline).call(trendline.drag);

        // Отображаем линии подложки (горизонтальные, пунктирные)
//        svg.select("g.supstances").datum(supstanceData).call(supstance).call(supstance.drag);

        // Stash for zooming
        x.zoomable().domain([zoom_value, data.length]).copy(); // Zoom in a little to hide indicator preroll

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
//        svg.select("g.volume.axis").call(volumeAxis);                           // Ось Volume(400M, 300M...)
//        svg.select("g.percent.axis").call(percentAxis);                         // Ось OY левая(Проценты)
//        svg.select("g.percent.axis").call(percentAxis).selectAll("text").remove();// Удаляем подписи оси проценты

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
//            svg.select("g.macd .axis.left").call(macdAxisLeft);                     // Ось OY левая
            svg.select("g.macd .indicator-plot").call(macd.refresh);                // Масштабирование MACD по оси OX
            svg.select("g.crosshair.macd").call(macdCrosshair.refresh);             // хз!!!
        }

        // Отображаем RSI-график
        if (chartOptions.rsiVisible == true) {
            // RSI-график
            svg.select("g.rsi .axis.right").call(rsiAxis);                          // Ось OY правая
//            svg.select("g.rsi .axis.left").call(rsiAxisLeft);                       // Ось OY левая
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

var requestParams = {
//    url:
    limit: 144,
    user_id: 1,
    instrument_id: 0,
    price_id: 0
}

var requestTimer = null;
var checkData = false;
function sendRequest()
{

    // 1. Создаём новый объект XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // 2. Конфигурируем его: GET-запрос на URL 'hystominute'
    xhr.open('GET', 'http://xcryptex.com/data/amcharts/hystominute?limit='
            + requestParams.limit
    //        + '&user_id=' + RequestParams.user_id
            + '&instrument_id=' + requestParams.instrument_id, false);

    // 3. Отсылаем запрос
    xhr.send();

    // 4. Если код ответа сервера не 200, то это ошибка
    if (xhr.status != 200) {
      // обработать ошибку
//      alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
    } else {
        // Конвертируем
        var resp_data = JSON.parse(xhr.responseText);
//        for (var i=(resp_data.length-1); i>(-1); i--)
        for (var i=(resp_data.length-1); i>(resp_data.length-128); i--)
        {
            if (checkData == true) {
                // Проверяем на наличе дубликатов
                // т.е. одинаковых по дате и времени записей
                // заменяем старую запись новой
                var reqDate = new Date(resp_data[i].date);
//                console.log((newData[newData.length-1].date) + " ---> " + (reqDate));
                if (((newData[newData.length-1].date).getTime()) == (reqDate.getTime())) {
//                    console.log("data copy!!!");
                    newData.pop();
                }
            }
            newData.push({
                date: new Date(resp_data[i].date),
                open: resp_data[i].open,
                high: resp_data[i].high,
                low: resp_data[i].low,
                close: resp_data[i].close,
                volume: resp_data[i].volume,
            });


        }


        // Выводим на график
        dataChart(newData);

        // Начинаем выводить свечу в динамике
        sendRequestPrice();

        // Запускаем таймер
//        requestTimer = setTimeout(sendRequest, 50000);

        if (checkData == false) checkData = true;
    }
}

var price_response;
function sendRequestPrice()
{

    // 1. Создаём новый объект XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // 2. Конфигурируем его: GET-запрос на URL 'phones.json'
//    xhr.open('GET', 'http://xcryptex.com/data/amcharts/hystominute?limit=10&user_id=1&instrument_id=1&date_from=1505411477000&date_to=1505411477000', false);

    xhr.open('GET', 'http://xcryptex.com/price/json/' + requestParams.price_id, false);

    // 3. Отсылаем запрос
    xhr.send();

    // 4. Если код ответа сервера не 200, то это ошибка
    if (xhr.status != 200) {
      // обработать ошибку
//      alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
    } else {
        price_response = JSON.parse(xhr.responseText);
//        console.log(resp_data);
        paintCandle();

    }
}

var price_second = 0;
var date, open, high, low, close; //volume;
var current_date = [];
function paintCandle()
{
    // Обрабатываем открытие свечи
    var result = parseFloat(price_response[price_second].price);

    // Выводим время в название графика
/*    chartOptions.title = "Online " + newData[newData.length-1].date.getDate() + ".";
    chartOptions.title += newData[newData.length-1].date.getMonth() + "."+ newData[newData.length-1].date.getFullYear() + " ";
    chartOptions.title += newData[newData.length-1].date.getHours() + ":" + newData[newData.length-1].date.getMinutes() + ":";
    chartOptions.title += newData[newData.length-1].date.getSeconds();
*/
    current_date[0] = newData[newData.length-1].date.getDate();
    current_date[1] = newData[newData.length-1].date.getMonth() + 1;
    current_date[2] = newData[newData.length-1].date.getFullYear();
    current_date[3] = newData[newData.length-1].date.getHours();
    current_date[4] = newData[newData.length-1].date.getMinutes();
//    current_date[5] = newData[newData.length-1].date.getSeconds();
    current_date[5] = price_second;

    for (var i=0; i<6; i++) {
        if (current_date[i] < 10) {
            current_date[i] = "0" + current_date[i];
        }
    }
    chartOptions.title = "Online";// + "\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0";
    title_date_time = current_date[0] + "." + current_date[1] + "." + current_date[2] + " " + current_date[3] + ":" + current_date[4] + ":" + current_date[5];
//    chartOptions.title += "ETH/BTC" + "\u00A0\u00A0\u00A0";
//    chartOptions.title += current_date[0] + "." + current_date[1] + "." + current_date[2] + " ";
//    chartOptions.title += current_date[3] + ":" + current_date[4] + ":" + current_date[5];

//    console.log(date);
    // 1-я секунда
    if (price_second == 0)
    {
        // Создаем новую дату
        date = new Date(newData[newData.length-1].date.getFullYear(),
                            newData[newData.length-1].date.getMonth(),
                            newData[newData.length-1].date.getDate(),
                            newData[newData.length-1].date.getHours(),
                            (newData[newData.length-1].date.getMinutes()+1));

        open = result;//parseFloat(price_response[price_second].price);
        high = result;//parseFloat(price_response[price_second].price);
        low = result;//parseFloat(price_response[price_second].price);
        close = result;//parseFloat(price_response[price_second].price);
//        volume = parseFloat('0');
        price_second = 1;
    } else

    // 2-59 секунда
    {
        newData.pop();

        close = result;//price_response[price_second].price;                                   // Отрисовываем новое закрытие

        if (result > high) {                              // Отрисовываем новый максимум
            high = result;//price_response[price_second].price;
        }

        if (result < low) {
            low = result;//price_response[price_second].price;
        }

//       if (price_second == 58) {
//            console.log('end');
//        } else {
           price_second++;
//        }
    }

    // Добавляем новые данные
    newData.push({
        date: new Date(date),
        open: open,
        high: high,
        low: low,
        close: close,
        volume: 0,
    });

    clearChart();
    dataChart(newData);

    // Через секунду рисуем новое значение
    if (price_second == 58) {
        clearTimeout(requestTimer);
        sendRequestPrice();
//        console.log('end');
        price_second = 0;
    } else {
//        console.log(price_second);
    }
    requestTimer = setTimeout(paintCandle, 1000);
    animateRound();
}

function getRandomArbitrary(min, max) {
  return Math.random() * (max - min) + min;
}

var animate_round=0;
function animateRound()
{

    // Рисуем мигающий индикатор в названии
    svg.append('circle')
            .attr("class", "flashing_point")
            .attr("cx", 0)
            .attr("cy", -3)
            .attr("r", animate_round);
    if (animate_round == 0) {
        animate_round = 5;
    } else {
        animate_round = 0;
    }

    // Для примера рисуем рандомный бар
    pbar_value = parseInt(getRandomArbitrary(10, 100));

}



var background = 0;
function setBackground()
{
    if (background == 0) {
        d3.select("body").style("background", "#333333");
        background = 1;
    } else {
        d3.select("body").style("background", "#ffffff");
        background = 0;
    }
}
//------------------------------------------------------------------------------

$(document).ready(function(){
    $(window).resize(function(){
        // обновляем размер графика
        clearChart();
        dataChart(newData);
    });
});
