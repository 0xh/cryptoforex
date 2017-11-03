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

function createChart(params)
{   
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
    div = d3.select("#chart_field");
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

    // Рисуем вертикальный индикатор
    svg.append("rect")
            .attr("class", "vertical_bar")
            .attr("x", 10)
            .attr("y", dim.indicator.padding)
            .attr("width", 30)
            .attr("height", dim.ohlc.height);
/*
    svg.append('text')
            .attr("class", "symbol")
            .attr("x", 10)
            .text("35%");
*/
    var vred_ind1_value = 100;
    vred_ind1 = svg.append("line")
            .attr("class", "vertical_bar_red")
            .attr("x1", 25)
            .attr("y1", 20)
            .attr("x2", 25)
            .attr("y2", vred_ind1_value);
            

    vred_ind2 = svg.append("line")
            .attr("class", "vertical_bar_green")
            .attr("x1", 25)
            .attr("y1", vred_ind1_value+8)
            .attr("x2", 25)
            .attr("y2", dim.ohlc.height);
    
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
    
    // Пишем Название графика
    svg.append('text')
            .attr("class", "symbol")
            .attr("x", (title_position+10))
            .text(chartOptions.title);
    
    // Выводим первую иконку
    svg.append("svg:image")
        .attr("xlink:href", test_params.from.image)
        .attr("width", chartOptions.icons_width)
        .attr("height", chartOptions.icons_height)
        .attr("x", title_position+50)
        .attr("y",-15);

    // Выводим вторую иконку
    svg.append("svg:image")
        .attr("xlink:href", test_params.to.image)
        .attr("width", chartOptions.icons_width)
        .attr("height", chartOptions.icons_height)
        .attr("x", (title_position+55+chartOptions.icons_width))
        .attr("y",-15);
    
    // Пишем название валютной пары
    svg.append('text')
            .attr("class", "symbol")
            .attr("x", (title_position+60+chartOptions.icons_width*2))
            .text(test_params.title);

    // Пишем текущие дату и время
    svg.append('text')
            .attr("class", "symbol")
            .attr("x", (title_position+120+chartOptions.icons_width*2))
            .text(title_date_time);
    
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
    createChart(test_params);
//    checkForm();
    
    // Обнуляем массив
    newData.length = 0;
    sendRequest();
    
    // Далее будем запрашивать по одному элементу раз в минуту
//    RequestParams.limit = 1;    
}

function clearChart()
{
    // Пересоздаем график
    d3.select("body").select("svg").remove();
    createChart(test_params);
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

var animate_round=0;
function animateRound()
{

    // Рисуем мигающий индикатор в названии
    svg.append('circle')
            .attr("class", "flashing_point")
            .attr("cx", title_position)
            .attr("cy", -3)
            .attr("r", animate_round);
    if (animate_round == 0) {
        animate_round = 5;
    } else {
        animate_round = 0;
    }
    

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
        volume: 0,
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
/*
function setPeriod(data, period)
{
    var periodData = [];
    var first, second, start=0;
    for (var i=0; i<data.length; i++)
    {
        // Смотрим кратно ли время, 
        // требуемому периоду
        if ((((data[i].date).getMinutes())%period) == 0)
        {
            if (start == 0) {
                first = i;
                start = 1;
            } else if (start == 1) {
                second = i;
                start = 0;
                console.log("start - " + (data[first].date) + ", end - " + (data[second].date));
            }
        }
    }

}
*/
var jdata;
//var TEST_json = '[{"date":"2017-10-18 16:24:00","open":16.66,"low":16.66,"high":16.66,"close":16.68,"value":16.68,"volumefrom":0,"volumeto":0,"volume":0},{"date":"2017-10-18 16:23:00","open":16.64,"low":16.67,"high":16.64,"close":16.66,"value":16.66,"volumefrom":2.58,"volumeto":42.99,"volume":40.41},{"date":"2017-10-18 16:22:00","open":16.69,"low":16.69,"high":16.64,"close":16.64,"value":16.64,"volumefrom":15.89,"volumeto":264.56,"volume":248.67},{"date":"2017-10-18 16:21:00","open":16.68,"low":16.69,"high":16.68,"close":16.69,"value":16.69,"volumefrom":14.93,"volumeto":248.93,"volume":234},{"date":"2017-10-18 16:20:00","open":16.69,"low":16.7,"high":16.68,"close":16.68,"value":16.68,"volumefrom":22.79,"volumeto":380.3,"volume":357.51},{"date":"2017-10-18 16:19:00","open":16.68,"low":16.7,"high":16.67,"close":16.69,"value":16.69,"volumefrom":18.51,"volumeto":308.89,"volume":290.38},{"date":"2017-10-18 16:18:00","open":16.66,"low":16.68,"high":16.65,"close":16.68,"value":16.68,"volumefrom":14.77,"volumeto":245.9,"volume":231.13},{"date":"2017-10-18 16:17:00","open":16.66,"low":16.68,"high":16.62,"close":16.65,"value":16.65,"volumefrom":18.1,"volumeto":301.42,"volume":283.32},{"date":"2017-10-18 16:16:00","open":16.66,"low":16.68,"high":16.64,"close":16.66,"value":16.66,"volumefrom":14.32,"volumeto":238.23,"volume":223.91},{"date":"2017-10-18 16:15:00","open":16.64,"low":16.67,"high":16.64,"close":16.66,"value":16.66,"volumefrom":20.69,"volumeto":344.72,"volume":324.03},{"date":"2017-10-18 16:14:00","open":16.66,"low":16.68,"high":16.63,"close":16.64,"value":16.64,"volumefrom":26.73,"volumeto":445.03,"volume":418.3},{"date":"2017-10-18 16:13:00","open":16.66,"low":16.68,"high":16.64,"close":16.65,"value":16.65,"volumefrom":27.79,"volumeto":462.85,"volume":435.06},{"date":"2017-10-18 16:12:00","open":16.64,"low":16.67,"high":16.64,"close":16.66,"value":16.66,"volumefrom":12.2,"volumeto":203.35,"volume":191.15},{"date":"2017-10-18 16:11:00","open":16.66,"low":16.66,"high":16.63,"close":16.66,"value":16.66,"volumefrom":11.39,"volumeto":189.7,"volume":178.31},{"date":"2017-10-18 16:10:00","open":16.64,"low":16.66,"high":16.63,"close":16.66,"value":16.66,"volumefrom":11.32,"volumeto":188.46,"volume":177.14},{"date":"2017-10-18 16:09:00","open":16.62,"low":16.66,"high":16.62,"close":16.64,"value":16.64,"volumefrom":16.17,"volumeto":269.17,"volume":253},{"date":"2017-10-18 16:08:00","open":16.61,"low":16.63,"high":16.59,"close":16.62,"value":16.62,"volumefrom":15.26,"volumeto":253.9,"volume":238.64},{"date":"2017-10-18 16:07:00","open":16.62,"low":16.64,"high":16.58,"close":16.61,"value":16.61,"volumefrom":10.2,"volumeto":169.46,"volume":159.26},{"date":"2017-10-18 16:06:00","open":16.61,"low":16.65,"high":16.61,"close":16.62,"value":16.62,"volumefrom":12.09,"volumeto":200.9,"volume":188.81},{"date":"2017-10-18 16:05:00","open":16.61,"low":16.63,"high":16.6,"close":16.61,"value":16.61,"volumefrom":8,"volumeto":132.88,"volume":124.88},{"date":"2017-10-18 16:04:00","open":16.6,"low":16.62,"high":16.58,"close":16.61,"value":16.61,"volumefrom":5.61,"volumeto":93.09,"volume":87.48},{"date":"2017-10-18 16:03:00","open":16.58,"low":16.6,"high":16.58,"close":16.6,"value":16.6,"volumefrom":6.42,"volumeto":106.51,"volume":100.09},{"date":"2017-10-18 16:02:00","open":16.54,"low":16.59,"high":16.54,"close":16.58,"value":16.58,"volumefrom":8.11,"volumeto":134.44,"volume":126.33},{"date":"2017-10-18 16:01:00","open":16.51,"low":16.55,"high":16.51,"close":16.54,"value":16.54,"volumefrom":8.45,"volumeto":139.66,"volume":131.21},{"date":"2017-10-18 16:00:00","open":16.49,"low":16.5,"high":16.49,"close":16.5,"value":16.5,"volumefrom":17.03,"volumeto":281.43,"volume":264.4},{"date":"2017-10-18 15:59:00","open":16.48,"low":16.5,"high":16.46,"close":16.49,"value":16.49,"volumefrom":4.26,"volumeto":70.1,"volume":65.84},{"date":"2017-10-18 15:58:00","open":16.47,"low":16.51,"high":16.46,"close":16.47,"value":16.47,"volumefrom":5.44,"volumeto":89.31,"volume":83.87},{"date":"2017-10-18 15:57:00","open":16.49,"low":16.49,"high":16.46,"close":16.47,"value":16.47,"volumefrom":3.83,"volumeto":62.93,"volume":59.1},{"date":"2017-10-18 15:56:00","open":16.48,"low":16.53,"high":16.46,"close":16.49,"value":16.49,"volumefrom":4.37,"volumeto":71.83,"volume":67.46},{"date":"2017-10-18 15:55:00","open":16.5,"low":16.52,"high":16.48,"close":16.49,"value":16.49,"volumefrom":4.48,"volumeto":73.5,"volume":69.02},{"date":"2017-10-18 15:54:00","open":16.49,"low":16.51,"high":16.47,"close":16.49,"value":16.49,"volumefrom":4.72,"volumeto":77.76,"volume":73.04},{"date":"2017-10-18 15:53:00","open":16.47,"low":16.52,"high":16.46,"close":16.49,"value":16.49,"volumefrom":6.22,"volumeto":102.45,"volume":96.23},{"date":"2017-10-18 15:52:00","open":16.52,"low":16.52,"high":16.42,"close":16.47,"value":16.47,"volumefrom":12.97,"volumeto":213.43,"volume":200.46},{"date":"2017-10-18 15:51:00","open":16.46,"low":16.54,"high":16.46,"close":16.52,"value":16.52,"volumefrom":19.9,"volumeto":328.64,"volume":308.74},{"date":"2017-10-18 15:50:00","open":16.53,"low":16.54,"high":16.44,"close":16.47,"value":16.47,"volumefrom":20.84,"volumeto":343.81,"volume":322.97},{"date":"2017-10-18 15:49:00","open":16.58,"low":16.59,"high":16.53,"close":16.53,"value":16.53,"volumefrom":19.67,"volumeto":325.23,"volume":305.56},{"date":"2017-10-18 15:48:00","open":16.59,"low":16.62,"high":16.56,"close":16.58,"value":16.58,"volumefrom":10.3,"volumeto":170.64,"volume":160.34},{"date":"2017-10-18 15:47:00","open":16.63,"low":16.63,"high":16.6,"close":16.6,"value":16.6,"volumefrom":17.26,"volumeto":286.64,"volume":269.38},{"date":"2017-10-18 15:46:00","open":16.61,"low":16.63,"high":16.61,"close":16.62,"value":16.62,"volumefrom":13.02,"volumeto":216.35,"volume":203.33},{"date":"2017-10-18 15:45:00","open":16.61,"low":16.63,"high":16.59,"close":16.61,"value":16.61,"volumefrom":20.2,"volumeto":335.52,"volume":315.32},{"date":"2017-10-18 15:44:00","open":16.63,"low":16.63,"high":16.61,"close":16.61,"value":16.61,"volumefrom":27.38,"volumeto":455.15,"volume":427.77},{"date":"2017-10-18 15:43:00","open":16.6,"low":16.63,"high":16.6,"close":16.63,"value":16.63,"volumefrom":20.62,"volumeto":342.88,"volume":322.26},{"date":"2017-10-18 15:42:00","open":16.6,"low":16.63,"high":16.59,"close":16.6,"value":16.6,"volumefrom":14.35,"volumeto":238.69,"volume":224.34},{"date":"2017-10-18 15:41:00","open":16.61,"low":16.62,"high":16.6,"close":16.6,"value":16.6,"volumefrom":15.17,"volumeto":251.93,"volume":236.76},{"date":"2017-10-18 15:40:00","open":16.61,"low":16.62,"high":16.6,"close":16.61,"value":16.61,"volumefrom":20.42,"volumeto":339.31,"volume":318.89},{"date":"2017-10-18 15:39:00","open":16.6,"low":16.63,"high":16.6,"close":16.62,"value":16.62,"volumefrom":19.3,"volumeto":320.59,"volume":301.29},{"date":"2017-10-18 15:38:00","open":16.59,"low":16.62,"high":16.58,"close":16.61,"value":16.61,"volumefrom":18.12,"volumeto":300.44,"volume":282.32},{"date":"2017-10-18 15:37:00","open":16.58,"low":16.61,"high":16.57,"close":16.59,"value":16.59,"volumefrom":18.95,"volumeto":314.38,"volume":295.43},{"date":"2017-10-18 15:36:00","open":16.56,"low":16.59,"high":16.55,"close":16.58,"value":16.58,"volumefrom":19.73,"volumeto":327.26,"volume":307.53},{"date":"2017-10-18 15:35:00","open":16.55,"low":16.56,"high":16.54,"close":16.56,"value":16.56,"volumefrom":19.51,"volumeto":322.97,"volume":303.46},{"date":"2017-10-18 15:34:00","open":16.55,"low":16.56,"high":16.55,"close":16.55,"value":16.55,"volumefrom":8.36,"volumeto":138.36,"volume":130},{"date":"2017-10-18 15:33:00","open":16.59,"low":16.61,"high":16.55,"close":16.6,"value":16.6,"volumefrom":13.81,"volumeto":228.54,"volume":214.73},{"date":"2017-10-18 15:32:00","open":16.61,"low":16.64,"high":16.58,"close":16.6,"value":16.6,"volumefrom":37.13,"volumeto":616.77,"volume":579.64},{"date":"2017-10-18 15:31:00","open":16.63,"low":16.64,"high":16.59,"close":16.61,"value":16.61,"volumefrom":17.95,"volumeto":298.23,"volume":280.28},{"date":"2017-10-18 15:30:00","open":16.64,"low":16.64,"high":16.59,"close":16.63,"value":16.63,"volumefrom":22.26,"volumeto":370.15,"volume":347.89},{"date":"2017-10-18 15:29:00","open":16.65,"low":16.66,"high":16.64,"close":16.64,"value":16.64,"volumefrom":21.55,"volumeto":358.54,"volume":336.99},{"date":"2017-10-18 15:28:00","open":16.63,"low":16.65,"high":16.63,"close":16.65,"value":16.65,"volumefrom":18.46,"volumeto":306.55,"volume":288.09},{"date":"2017-10-18 15:27:00","open":16.61,"low":16.64,"high":16.61,"close":16.64,"value":16.64,"volumefrom":7.34,"volumeto":121.96,"volume":114.62},{"date":"2017-10-18 15:26:00","open":16.58,"low":16.61,"high":16.58,"close":16.61,"value":16.61,"volumefrom":21.39,"volumeto":355.58,"volume":334.19},{"date":"2017-10-18 15:25:00","open":16.56,"low":16.59,"high":16.56,"close":16.58,"value":16.58,"volumefrom":28.98,"volumeto":481.26,"volume":452.28},{"date":"2017-10-18 15:24:00","open":16.57,"low":16.59,"high":16.55,"close":16.56,"value":16.56,"volumefrom":18.27,"volumeto":302.76,"volume":284.49},{"date":"2017-10-18 15:23:00","open":16.57,"low":16.58,"high":16.56,"close":16.57,"value":16.57,"volumefrom":16.23,"volumeto":269.03,"volume":252.8},{"date":"2017-10-18 15:22:00","open":16.56,"low":16.58,"high":16.56,"close":16.57,"value":16.57,"volumefrom":17.96,"volumeto":297.49,"volume":279.53},{"date":"2017-10-18 15:21:00","open":16.56,"low":16.58,"high":16.56,"close":16.56,"value":16.56,"volumefrom":24.01,"volumeto":397.48,"volume":373.47},{"date":"2017-10-18 15:20:00","open":16.58,"low":16.6,"high":16.56,"close":16.58,"value":16.58,"volumefrom":7.85,"volumeto":130.01,"volume":122.16},{"date":"2017-10-18 15:19:00","open":16.59,"low":16.59,"high":16.57,"close":16.57,"value":16.57,"volumefrom":9.04,"volumeto":149.71,"volume":140.67},{"date":"2017-10-18 15:18:00","open":16.57,"low":16.58,"high":16.56,"close":16.57,"value":16.57,"volumefrom":13.08,"volumeto":216.84,"volume":203.76},{"date":"2017-10-18 15:17:00","open":16.56,"low":16.58,"high":16.52,"close":16.57,"value":16.57,"volumefrom":25.81,"volumeto":427.46,"volume":401.65},{"date":"2017-10-18 15:16:00","open":16.55,"low":16.57,"high":16.55,"close":16.55,"value":16.55,"volumefrom":14.28,"volumeto":235.87,"volume":221.59},{"date":"2017-10-18 15:15:00","open":16.49,"low":16.55,"high":16.48,"close":16.55,"value":16.55,"volumefrom":12.46,"volumeto":206.54,"volume":194.08},{"date":"2017-10-18 15:14:00","open":16.56,"low":16.56,"high":16.48,"close":16.49,"value":16.49,"volumefrom":13.23,"volumeto":217.76,"volume":204.53},{"date":"2017-10-18 15:13:00","open":16.55,"low":16.56,"high":16.54,"close":16.56,"value":16.56,"volumefrom":19.98,"volumeto":330.79,"volume":310.81},{"date":"2017-10-18 15:12:00","open":16.54,"low":16.55,"high":16.52,"close":16.54,"value":16.54,"volumefrom":11.31,"volumeto":187.09,"volume":175.78},{"date":"2017-10-18 15:11:00","open":16.55,"low":16.55,"high":16.53,"close":16.53,"value":16.53,"volumefrom":17.49,"volumeto":289.1,"volume":271.61},{"date":"2017-10-18 15:10:00","open":16.57,"low":16.58,"high":16.55,"close":16.57,"value":16.57,"volumefrom":14.18,"volumeto":234.59,"volume":220.41},{"date":"2017-10-18 15:09:00","open":16.58,"low":16.59,"high":16.51,"close":16.57,"value":16.57,"volumefrom":22.34,"volumeto":370.25,"volume":347.91},{"date":"2017-10-18 15:08:00","open":16.58,"low":16.58,"high":16.55,"close":16.57,"value":16.57,"volumefrom":19.12,"volumeto":317.07,"volume":297.95},{"date":"2017-10-18 15:07:00","open":16.55,"low":16.58,"high":16.55,"close":16.58,"value":16.58,"volumefrom":12.29,"volumeto":203.38,"volume":191.09},{"date":"2017-10-18 15:06:00","open":16.55,"low":16.57,"high":16.54,"close":16.55,"value":16.55,"volumefrom":11.66,"volumeto":192.76,"volume":181.1},{"date":"2017-10-18 15:05:00","open":16.53,"low":16.53,"high":16.52,"close":16.53,"value":16.53,"volumefrom":22.49,"volumeto":371.75,"volume":349.26},{"date":"2017-10-18 15:04:00","open":16.54,"low":16.55,"high":16.52,"close":16.53,"value":16.53,"volumefrom":19.4,"volumeto":320.47,"volume":301.07},{"date":"2017-10-18 15:03:00","open":16.56,"low":16.56,"high":16.53,"close":16.53,"value":16.53,"volumefrom":20.69,"volumeto":342.18,"volume":321.49},{"date":"2017-10-18 15:02:00","open":16.56,"low":16.58,"high":16.53,"close":16.55,"value":16.55,"volumefrom":19.82,"volumeto":327.7,"volume":307.88},{"date":"2017-10-18 15:01:00","open":16.56,"low":16.58,"high":16.54,"close":16.58,"value":16.58,"volumefrom":22.44,"volumeto":371.62,"volume":349.18},{"date":"2017-10-18 15:00:00","open":16.56,"low":16.57,"high":16.56,"close":16.56,"value":16.56,"volumefrom":13.87,"volumeto":229.44,"volume":215.57},{"date":"2017-10-18 14:59:00","open":16.56,"low":16.58,"high":16.54,"close":16.56,"value":16.56,"volumefrom":36.06,"volumeto":598.48,"volume":562.42},{"date":"2017-10-18 14:58:00","open":16.58,"low":16.59,"high":16.54,"close":16.56,"value":16.56,"volumefrom":30.35,"volumeto":503.24,"volume":472.89},{"date":"2017-10-18 14:57:00","open":16.56,"low":16.59,"high":16.56,"close":16.58,"value":16.58,"volumefrom":19.05,"volumeto":315.83,"volume":296.78},{"date":"2017-10-18 14:56:00","open":16.58,"low":16.59,"high":16.54,"close":16.56,"value":16.56,"volumefrom":20.54,"volumeto":340.45,"volume":319.91},{"date":"2017-10-18 14:55:00","open":16.54,"low":16.58,"high":16.54,"close":16.54,"value":16.54,"volumefrom":18.07,"volumeto":299.12,"volume":281.05},{"date":"2017-10-18 14:54:00","open":16.55,"low":16.55,"high":16.53,"close":16.53,"value":16.53,"volumefrom":18.11,"volumeto":300.81,"volume":282.7},{"date":"2017-10-18 14:53:00","open":16.54,"low":16.55,"high":16.54,"close":16.55,"value":16.55,"volumefrom":20.51,"volumeto":339.07,"volume":318.56},{"date":"2017-10-18 14:52:00","open":16.55,"low":16.55,"high":16.53,"close":16.53,"value":16.53,"volumefrom":29.58,"volumeto":488.98,"volume":459.4},{"date":"2017-10-18 14:51:00","open":16.57,"low":16.57,"high":16.55,"close":16.55,"value":16.55,"volumefrom":19.62,"volumeto":324.68,"volume":305.06},{"date":"2017-10-18 14:50:00","open":16.58,"low":16.59,"high":16.57,"close":16.57,"value":16.57,"volumefrom":19.26,"volumeto":319.01,"volume":299.75},{"date":"2017-10-18 14:49:00","open":16.56,"low":16.56,"high":16.53,"close":16.55,"value":16.55,"volumefrom":16.78,"volumeto":277.32,"volume":260.54},{"date":"2017-10-18 14:48:00","open":16.55,"low":16.56,"high":16.54,"close":16.56,"value":16.56,"volumefrom":15.9,"volumeto":262.76,"volume":246.86},{"date":"2017-10-18 14:47:00","open":16.55,"low":16.57,"high":16.55,"close":16.55,"value":16.55,"volumefrom":13.61,"volumeto":224.95,"volume":211.34},{"date":"2017-10-18 14:46:00","open":16.55,"low":16.56,"high":16.55,"close":16.56,"value":16.56,"volumefrom":23.57,"volumeto":390.07,"volume":366.5},{"date":"2017-10-18 14:45:00","open":16.57,"low":16.57,"high":16.54,"close":16.56,"value":16.56,"volumefrom":21.7,"volumeto":359.34,"volume":337.64},{"date":"2017-10-18 14:44:00","open":16.59,"low":16.6,"high":16.55,"close":16.57,"value":16.57,"volumefrom":16.93,"volumeto":280.63,"volume":263.7},{"date":"2017-10-18 14:43:00","open":16.53,"low":16.59,"high":16.53,"close":16.59,"value":16.59,"volumefrom":25.61,"volumeto":424.37,"volume":398.76},{"date":"2017-10-18 14:42:00","open":16.5,"low":16.59,"high":16.5,"close":16.53,"value":16.53,"volumefrom":13.34,"volumeto":220.61,"volume":207.27},{"date":"2017-10-18 14:41:00","open":16.52,"low":16.54,"high":16.5,"close":16.54,"value":16.54,"volumefrom":20.35,"volumeto":336.29,"volume":315.94},{"date":"2017-10-18 14:40:00","open":16.52,"low":16.54,"high":16.52,"close":16.52,"value":16.52,"volumefrom":19.67,"volumeto":325.14,"volume":305.47},{"date":"2017-10-18 14:39:00","open":16.53,"low":16.53,"high":16.5,"close":16.53,"value":16.53,"volumefrom":13.53,"volumeto":223.37,"volume":209.84},{"date":"2017-10-18 14:38:00","open":16.47,"low":16.53,"high":16.47,"close":16.53,"value":16.53,"volumefrom":14.65,"volumeto":241.58,"volume":226.93},{"date":"2017-10-18 14:37:00","open":16.47,"low":16.5,"high":16.44,"close":16.5,"value":16.5,"volumefrom":27.02,"volumeto":445.13,"volume":418.11},{"date":"2017-10-18 14:36:00","open":16.47,"low":16.51,"high":16.44,"close":16.47,"value":16.47,"volumefrom":10.57,"volumeto":173.93,"volume":163.36},{"date":"2017-10-18 14:35:00","open":16.46,"low":16.49,"high":16.45,"close":16.47,"value":16.47,"volumefrom":17.76,"volumeto":292.05,"volume":274.29},{"date":"2017-10-18 14:34:00","open":16.5,"low":16.5,"high":16.44,"close":16.46,"value":16.46,"volumefrom":10.53,"volumeto":173.24,"volume":162.71},{"date":"2017-10-18 14:33:00","open":16.52,"low":16.52,"high":16.45,"close":16.5,"value":16.5,"volumefrom":32.67,"volumeto":537.22,"volume":504.55},{"date":"2017-10-18 14:32:00","open":16.53,"low":16.53,"high":16.5,"close":16.51,"value":16.51,"volumefrom":18.34,"volumeto":302.69,"volume":284.35},{"date":"2017-10-18 14:31:00","open":16.5,"low":16.53,"high":16.49,"close":16.52,"value":16.52,"volumefrom":25.3,"volumeto":418.02,"volume":392.72},{"date":"2017-10-18 14:30:00","open":16.52,"low":16.54,"high":16.49,"close":16.5,"value":16.5,"volumefrom":26.77,"volumeto":441.41,"volume":414.64},{"date":"2017-10-18 14:29:00","open":16.5,"low":16.53,"high":16.5,"close":16.52,"value":16.52,"volumefrom":43.77,"volumeto":722.55,"volume":678.78},{"date":"2017-10-18 14:28:00","open":16.5,"low":16.5,"high":16.49,"close":16.49,"value":16.49,"volumefrom":11.04,"volumeto":181.87,"volume":170.83},{"date":"2017-10-18 14:27:00","open":16.49,"low":16.51,"high":16.49,"close":16.5,"value":16.5,"volumefrom":35.06,"volumeto":579.32,"volume":544.26},{"date":"2017-10-18 14:26:00","open":16.53,"low":16.54,"high":16.49,"close":16.49,"value":16.49,"volumefrom":9.71,"volumeto":160.27,"volume":150.56},{"date":"2017-10-18 14:25:00","open":16.53,"low":16.56,"high":16.53,"close":16.53,"value":16.53,"volumefrom":20.34,"volumeto":335.95,"volume":315.61},{"date":"2017-10-18 14:24:00","open":16.48,"low":16.57,"high":16.48,"close":16.53,"value":16.53,"volumefrom":17.29,"volumeto":285.75,"volume":268.46},{"date":"2017-10-18 14:23:00","open":16.53,"low":16.55,"high":16.49,"close":16.49,"value":16.49,"volumefrom":10.73,"volumeto":177.21,"volume":166.48},{"date":"2017-10-18 14:22:00","open":16.58,"low":16.59,"high":16.52,"close":16.53,"value":16.53,"volumefrom":25.36,"volumeto":418.49,"volume":393.13},{"date":"2017-10-18 14:21:00","open":16.59,"low":16.59,"high":16.51,"close":16.56,"value":16.56,"volumefrom":20.99,"volumeto":347.56,"volume":326.57},{"date":"2017-10-18 14:20:00","open":16.61,"low":16.62,"high":16.54,"close":16.59,"value":16.59,"volumefrom":20.78,"volumeto":343.9,"volume":323.12},{"date":"2017-10-18 14:19:00","open":16.62,"low":16.63,"high":16.53,"close":16.6,"value":16.6,"volumefrom":42.09,"volumeto":697.59,"volume":655.5},{"date":"2017-10-18 14:18:00","open":16.61,"low":16.64,"high":16.58,"close":16.62,"value":16.62,"volumefrom":26.02,"volumeto":431.86,"volume":405.84},{"date":"2017-10-18 14:17:00","open":16.67,"low":16.67,"high":16.62,"close":16.62,"value":16.62,"volumefrom":22.59,"volumeto":376.09,"volume":353.5},{"date":"2017-10-18 14:16:00","open":16.63,"low":16.71,"high":16.6,"close":16.67,"value":16.67,"volumefrom":21.35,"volumeto":354.53,"volume":333.18},{"date":"2017-10-18 14:15:00","open":16.66,"low":16.66,"high":16.63,"close":16.63,"value":16.63,"volumefrom":10.71,"volumeto":178.03,"volume":167.32},{"date":"2017-10-18 14:14:00","open":16.67,"low":16.67,"high":16.66,"close":16.66,"value":16.66,"volumefrom":10.52,"volumeto":175.33,"volume":164.81},{"date":"2017-10-18 14:13:00","open":16.66,"low":16.72,"high":16.66,"close":16.66,"value":16.66,"volumefrom":20.71,"volumeto":344.93,"volume":324.22},{"date":"2017-10-18 14:12:00","open":16.74,"low":16.74,"high":16.66,"close":16.66,"value":16.66,"volumefrom":15.15,"volumeto":252.54,"volume":237.39},{"date":"2017-10-18 14:11:00","open":16.69,"low":16.73,"high":16.69,"close":16.73,"value":16.73,"volumefrom":25.62,"volumeto":429.83,"volume":404.21},{"date":"2017-10-18 14:10:00","open":16.64,"low":16.7,"high":16.64,"close":16.69,"value":16.69,"volumefrom":23.18,"volumeto":386.57,"volume":363.39},{"date":"2017-10-18 14:09:00","open":16.62,"low":16.66,"high":16.61,"close":16.64,"value":16.64,"volumefrom":19.56,"volumeto":325.64,"volume":306.08},{"date":"2017-10-18 14:08:00","open":16.63,"low":16.66,"high":16.59,"close":16.62,"value":16.62,"volumefrom":33.41,"volumeto":555.56,"volume":522.15},{"date":"2017-10-18 14:07:00","open":16.66,"low":16.66,"high":16.58,"close":16.63,"value":16.63,"volumefrom":22.42,"volumeto":373.03,"volume":350.61},{"date":"2017-10-18 14:06:00","open":16.65,"low":16.68,"high":16.64,"close":16.66,"value":16.66,"volumefrom":28.02,"volumeto":466.41,"volume":438.39},{"date":"2017-10-18 14:05:00","open":16.66,"low":16.68,"high":16.63,"close":16.65,"value":16.65,"volumefrom":19.29,"volumeto":321.35,"volume":302.06},{"date":"2017-10-18 14:04:00","open":16.66,"low":16.69,"high":16.64,"close":16.66,"value":16.66,"volumefrom":21.69,"volumeto":361.71,"volume":340.02},{"date":"2017-10-18 14:03:00","open":16.61,"low":16.66,"high":16.61,"close":16.66,"value":16.66,"volumefrom":14.1,"volumeto":235.19,"volume":221.09},{"date":"2017-10-18 14:02:00","open":16.59,"low":16.62,"high":16.57,"close":16.62,"value":16.62,"volumefrom":54.18,"volumeto":901.55,"volume":847.37},{"date":"2017-10-18 14:01:00","open":16.56,"low":16.59,"high":16.55,"close":16.59,"value":16.59,"volumefrom":29.35,"volumeto":487.12,"volume":457.77},{"date":"2017-10-18 14:00:00","open":16.52,"low":16.6,"high":16.52,"close":16.56,"value":16.56,"volumefrom":27.19,"volumeto":449.65,"volume":422.46},{"date":"2017-10-18 13:59:00","open":16.51,"low":16.53,"high":16.51,"close":16.52,"value":16.52,"volumefrom":30.59,"volumeto":505.13,"volume":474.54},{"date":"2017-10-18 13:58:00","open":16.49,"low":16.52,"high":16.49,"close":16.51,"value":16.51,"volumefrom":42.54,"volumeto":702.25,"volume":659.71},{"date":"2017-10-18 13:57:00","open":16.46,"low":16.5,"high":16.46,"close":16.49,"value":16.49,"volumefrom":24.83,"volumeto":409.89,"volume":385.06},{"date":"2017-10-18 13:56:00","open":16.44,"low":16.5,"high":16.44,"close":16.47,"value":16.47,"volumefrom":30.69,"volumeto":505.79,"volume":475.1},{"date":"2017-10-18 13:55:00","open":16.43,"low":16.44,"high":16.42,"close":16.43,"value":16.43,"volumefrom":25.6,"volumeto":424.49,"volume":398.89},{"date":"2017-10-18 13:54:00","open":16.42,"low":16.44,"high":16.42,"close":16.42,"value":16.42,"volumefrom":16.64,"volumeto":273.54,"volume":256.9},{"date":"2017-10-18 13:53:00","open":16.43,"low":16.44,"high":16.4,"close":16.41,"value":16.41,"volumefrom":30.52,"volumeto":500.99,"volume":470.47},{"date":"2017-10-18 13:52:00","open":16.43,"low":16.47,"high":16.43,"close":16.44,"value":16.44,"volumefrom":22.7,"volumeto":373.02,"volume":350.32},{"date":"2017-10-18 13:51:00","open":16.37,"low":16.45,"high":16.37,"close":16.4,"value":16.4,"volumefrom":17.42,"volumeto":286.47,"volume":269.05},{"date":"2017-10-18 13:50:00","open":16.37,"low":16.4,"high":16.36,"close":16.37,"value":16.37,"volumefrom":39.37,"volumeto":647.31,"volume":607.94},{"date":"2017-10-18 13:49:00","open":16.35,"low":16.38,"high":16.35,"close":16.37,"value":16.37,"volumefrom":18.24,"volumeto":298.63,"volume":280.39},{"date":"2017-10-18 13:48:00","open":16.37,"low":16.4,"high":16.35,"close":16.36,"value":16.36,"volumefrom":20.93,"volumeto":342.68,"volume":321.75},{"date":"2017-10-18 13:47:00","open":16.4,"low":16.41,"high":16.37,"close":16.37,"value":16.37,"volumefrom":32.62,"volumeto":534.45,"volume":501.83},{"date":"2017-10-18 13:46:00","open":16.37,"low":16.41,"high":16.37,"close":16.4,"value":16.4,"volumefrom":20.38,"volumeto":334.28,"volume":313.9},{"date":"2017-10-18 13:45:00","open":16.4,"low":16.4,"high":16.35,"close":16.39,"value":16.39,"volumefrom":19.41,"volumeto":317.93,"volume":298.52},{"date":"2017-10-18 13:44:00","open":16.41,"low":16.41,"high":16.39,"close":16.4,"value":16.4,"volumefrom":23.43,"volumeto":384.33,"volume":360.9},{"date":"2017-10-18 13:43:00","open":16.4,"low":16.41,"high":16.4,"close":16.4,"value":16.4,"volumefrom":32.33,"volumeto":530.52,"volume":498.19},{"date":"2017-10-18 13:42:00","open":16.42,"low":16.42,"high":16.39,"close":16.4,"value":16.4,"volumefrom":6.99,"volumeto":114.6,"volume":107.61},{"date":"2017-10-18 13:41:00","open":16.51,"low":16.51,"high":16.44,"close":16.44,"value":16.44,"volumefrom":27.32,"volumeto":449.3,"volume":421.98},{"date":"2017-10-18 13:40:00","open":16.52,"low":16.52,"high":16.48,"close":16.51,"value":16.51,"volumefrom":28.73,"volumeto":474.15,"volume":445.42},{"date":"2017-10-18 13:39:00","open":16.52,"low":16.53,"high":16.52,"close":16.52,"value":16.52,"volumefrom":34.64,"volumeto":572.43,"volume":537.79},{"date":"2017-10-18 13:38:00","open":16.51,"low":16.52,"high":16.5,"close":16.52,"value":16.52,"volumefrom":17.22,"volumeto":284.45,"volume":267.23},{"date":"2017-10-18 13:37:00","open":16.48,"low":16.51,"high":16.48,"close":16.51,"value":16.51,"volumefrom":18.27,"volumeto":301.48,"volume":283.21},{"date":"2017-10-18 13:36:00","open":16.5,"low":16.52,"high":16.48,"close":16.48,"value":16.48,"volumefrom":37.94,"volumeto":626.15,"volume":588.21},{"date":"2017-10-18 13:35:00","open":16.46,"low":16.52,"high":16.44,"close":16.49,"value":16.49,"volumefrom":25.05,"volumeto":413.51,"volume":388.46},{"date":"2017-10-18 13:34:00","open":16.35,"low":16.46,"high":16.35,"close":16.46,"value":16.46,"volumefrom":19.06,"volumeto":314.06,"volume":295},{"date":"2017-10-18 13:33:00","open":16.34,"low":16.38,"high":16.33,"close":16.35,"value":16.35,"volumefrom":28,"volumeto":458.89,"volume":430.89},{"date":"2017-10-18 13:32:00","open":16.31,"low":16.4,"high":16.3,"close":16.34,"value":16.34,"volumefrom":30.8,"volumeto":503.43,"volume":472.63},{"date":"2017-10-18 13:31:00","open":16.3,"low":16.31,"high":16.29,"close":16.31,"value":16.31,"volumefrom":29.11,"volumeto":474.63,"volume":445.52},{"date":"2017-10-18 13:30:00","open":16.27,"low":16.3,"high":16.26,"close":16.29,"value":16.29,"volumefrom":23.27,"volumeto":379.13,"volume":355.86},{"date":"2017-10-18 13:29:00","open":16.25,"low":16.27,"high":16.25,"close":16.27,"value":16.27,"volumefrom":17.01,"volumeto":277.13,"volume":260.12},{"date":"2017-10-18 13:28:00","open":16.26,"low":16.26,"high":16.25,"close":16.25,"value":16.25,"volumefrom":3.61,"volumeto":58.57,"volume":54.96},{"date":"2017-10-18 13:27:00","open":16.26,"low":16.27,"high":16.26,"close":16.26,"value":16.26,"volumefrom":7.2,"volumeto":116.86,"volume":109.66},{"date":"2017-10-18 13:26:00","open":16.26,"low":16.27,"high":16.26,"close":16.27,"value":16.27,"volumefrom":17.09,"volumeto":277.84,"volume":260.75},{"date":"2017-10-18 13:25:00","open":16.26,"low":16.27,"high":16.26,"close":16.26,"value":16.26,"volumefrom":9.57,"volumeto":155.7,"volume":146.13},{"date":"2017-10-18 13:24:00","open":16.25,"low":16.27,"high":16.25,"close":16.27,"value":16.27,"volumefrom":7.24,"volumeto":117.63,"volume":110.39},{"date":"2017-10-18 13:23:00","open":16.25,"low":16.26,"high":16.25,"close":16.25,"value":16.25,"volumefrom":2.24,"volumeto":36.42,"volume":34.18},{"date":"2017-10-18 13:22:00","open":16.26,"low":16.26,"high":16.25,"close":16.25,"value":16.25,"volumefrom":1.83,"volumeto":29.57,"volume":27.74},{"date":"2017-10-18 13:21:00","open":16.26,"low":16.26,"high":16.26,"close":16.26,"value":16.26,"volumefrom":1.2,"volumeto":19.35,"volume":18.15},{"date":"2017-10-18 13:20:00","open":16.26,"low":16.26,"high":16.26,"close":16.26,"value":16.26,"volumefrom":1.02,"volumeto":16.56,"volume":15.54},{"date":"2017-10-18 13:19:00","open":16.26,"low":16.26,"high":16.25,"close":16.25,"value":16.25,"volumefrom":2.8,"volumeto":45.52,"volume":42.72},{"date":"2017-10-18 13:18:00","open":16.25,"low":16.26,"high":16.25,"close":16.25,"value":16.25,"volumefrom":14.26,"volumeto":231.71,"volume":217.45},{"date":"2017-10-18 13:17:00","open":16.22,"low":16.25,"high":16.21,"close":16.25,"value":16.25,"volumefrom":19.98,"volumeto":323.42,"volume":303.44},{"date":"2017-10-18 13:16:00","open":16.25,"low":16.25,"high":16.22,"close":16.22,"value":16.22,"volumefrom":30.09,"volumeto":485.52,"volume":455.43},{"date":"2017-10-18 13:15:00","open":16.24,"low":16.25,"high":16.23,"close":16.25,"value":16.25,"volumefrom":12.59,"volumeto":204.49,"volume":191.9},{"date":"2017-10-18 13:14:00","open":16.24,"low":16.25,"high":16.24,"close":16.24,"value":16.24,"volumefrom":29.15,"volumeto":473.33,"volume":444.18},{"date":"2017-10-18 13:13:00","open":16.24,"low":16.24,"high":16.23,"close":16.24,"value":16.24,"volumefrom":24.05,"volumeto":390.45,"volume":366.4},{"date":"2017-10-18 13:12:00","open":16.25,"low":16.26,"high":16.24,"close":16.24,"value":16.24,"volumefrom":20.94,"volumeto":339.85,"volume":318.91},{"date":"2017-10-18 13:11:00","open":16.25,"low":16.25,"high":16.24,"close":16.25,"value":16.25,"volumefrom":14.38,"volumeto":233.08,"volume":218.7},{"date":"2017-10-18 13:10:00","open":16.23,"low":16.25,"high":16.23,"close":16.25,"value":16.25,"volumefrom":18,"volumeto":292.19,"volume":274.19},{"date":"2017-10-18 13:09:00","open":16.23,"low":16.24,"high":16.22,"close":16.23,"value":16.23,"volumefrom":18.54,"volumeto":301.08,"volume":282.54},{"date":"2017-10-18 13:08:00","open":16.22,"low":16.24,"high":16.21,"close":16.23,"value":16.23,"volumefrom":25.65,"volumeto":416.25,"volume":390.6},{"date":"2017-10-18 13:07:00","open":16.22,"low":16.24,"high":16.21,"close":16.22,"value":16.22,"volumefrom":9.26,"volumeto":150.28,"volume":141.02},{"date":"2017-10-18 13:06:00","open":16.19,"low":16.2,"high":16.18,"close":16.2,"value":16.2,"volumefrom":11.64,"volumeto":188.47,"volume":176.83},{"date":"2017-10-18 13:05:00","open":16.19,"low":16.2,"high":16.19,"close":16.19,"value":16.19,"volumefrom":10.63,"volumeto":172.09,"volume":161.46},{"date":"2017-10-18 13:04:00","open":16.19,"low":16.2,"high":16.19,"close":16.19,"value":16.19,"volumefrom":13.66,"volumeto":221.2,"volume":207.54},{"date":"2017-10-18 13:03:00","open":16.19,"low":16.2,"high":16.19,"close":16.19,"value":16.19,"volumefrom":17.74,"volumeto":287.08,"volume":269.34},{"date":"2017-10-18 13:02:00","open":16.2,"low":16.2,"high":16.18,"close":16.19,"value":16.19,"volumefrom":11.62,"volumeto":187.89,"volume":176.27},{"date":"2017-10-18 13:01:00","open":16.2,"low":16.2,"high":16.18,"close":16.2,"value":16.2,"volumefrom":9.03,"volumeto":146.12,"volume":137.09},{"date":"2017-10-18 13:00:00","open":16.2,"low":16.21,"high":16.19,"close":16.19,"value":16.19,"volumefrom":17.84,"volumeto":288.64,"volume":270.8},{"date":"2017-10-18 12:59:00","open":16.21,"low":16.21,"high":16.19,"close":16.19,"value":16.19,"volumefrom":16.08,"volumeto":260.25,"volume":244.17},{"date":"2017-10-18 12:58:00","open":16.2,"low":16.21,"high":16.2,"close":16.21,"value":16.21,"volumefrom":14.45,"volumeto":233.93,"volume":219.48},{"date":"2017-10-18 12:57:00","open":16.2,"low":16.21,"high":16.19,"close":16.2,"value":16.2,"volumefrom":14.72,"volumeto":238.26,"volume":223.54},{"date":"2017-10-18 12:56:00","open":16.2,"low":16.2,"high":16.19,"close":16.2,"value":16.2,"volumefrom":16.51,"volumeto":267.24,"volume":250.73},{"date":"2017-10-18 12:55:00","open":16.19,"low":16.2,"high":16.19,"close":16.2,"value":16.2,"volumefrom":14.42,"volumeto":233.43,"volume":219.01},{"date":"2017-10-18 12:54:00","open":16.19,"low":16.2,"high":16.19,"close":16.19,"value":16.19,"volumefrom":13.15,"volumeto":212.88,"volume":199.73},{"date":"2017-10-18 12:53:00","open":16.19,"low":16.2,"high":16.18,"close":16.2,"value":16.2,"volumefrom":8.82,"volumeto":142.78,"volume":133.96},{"date":"2017-10-18 12:52:00","open":16.19,"low":16.2,"high":16.17,"close":16.18,"value":16.18,"volumefrom":24.12,"volumeto":390.3,"volume":366.18},{"date":"2017-10-18 12:51:00","open":16.19,"low":16.2,"high":16.19,"close":16.19,"value":16.19,"volumefrom":15.78,"volumeto":255.45,"volume":239.67},{"date":"2017-10-18 12:50:00","open":16.19,"low":16.19,"high":16.18,"close":16.19,"value":16.19,"volumefrom":14.57,"volumeto":235.91,"volume":221.34},{"date":"2017-10-18 12:49:00","open":16.18,"low":16.19,"high":16.18,"close":16.19,"value":16.19,"volumefrom":19.42,"volumeto":314.33,"volume":294.91},{"date":"2017-10-18 12:48:00","open":16.17,"low":16.19,"high":16.17,"close":16.18,"value":16.18,"volumefrom":15.39,"volumeto":248.96,"volume":233.57},{"date":"2017-10-18 12:47:00","open":16.18,"low":16.19,"high":16.16,"close":16.17,"value":16.17,"volumefrom":21.43,"volumeto":346.58,"volume":325.15},{"date":"2017-10-18 12:46:00","open":16.18,"low":16.18,"high":16.17,"close":16.18,"value":16.18,"volumefrom":11.13,"volumeto":179.97,"volume":168.84},{"date":"2017-10-18 12:45:00","open":16.17,"low":16.2,"high":16.17,"close":16.19,"value":16.19,"volumefrom":11.16,"volumeto":180.53,"volume":169.37},{"date":"2017-10-18 12:44:00","open":16.18,"low":16.19,"high":16.18,"close":16.18,"value":16.18,"volumefrom":11.85,"volumeto":191.59,"volume":179.74},{"date":"2017-10-18 12:43:00","open":16.18,"low":16.19,"high":16.18,"close":16.18,"value":16.18,"volumefrom":5.68,"volumeto":91.98,"volume":86.3},{"date":"2017-10-18 12:42:00","open":16.18,"low":16.19,"high":16.17,"close":16.18,"value":16.18,"volumefrom":13.39,"volumeto":216.59,"volume":203.2},{"date":"2017-10-18 12:41:00","open":16.18,"low":16.18,"high":16.18,"close":16.18,"value":16.18,"volumefrom":13.51,"volumeto":218.56,"volume":205.05},{"date":"2017-10-18 12:40:00","open":16.18,"low":16.19,"high":16.17,"close":16.18,"value":16.18,"volumefrom":10.14,"volumeto":164.09,"volume":153.95},{"date":"2017-10-18 12:39:00","open":16.17,"low":16.18,"high":16.17,"close":16.18,"value":16.18,"volumefrom":21.1,"volumeto":341.62,"volume":320.52},{"date":"2017-10-18 12:38:00","open":16.17,"low":16.18,"high":16.17,"close":16.17,"value":16.17,"volumefrom":16.41,"volumeto":265.68,"volume":249.27},{"date":"2017-10-18 12:37:00","open":16.18,"low":16.18,"high":16.17,"close":16.17,"value":16.17,"volumefrom":15.5,"volumeto":250.73,"volume":235.23},{"date":"2017-10-18 12:36:00","open":16.17,"low":16.18,"high":16.16,"close":16.18,"value":16.18,"volumefrom":12.24,"volumeto":198,"volume":185.76},{"date":"2017-10-18 12:35:00","open":16.18,"low":16.19,"high":16.17,"close":16.17,"value":16.17,"volumefrom":18.34,"volumeto":296.91,"volume":278.57},{"date":"2017-10-18 12:34:00","open":16.18,"low":16.19,"high":16.17,"close":16.18,"value":16.18,"volumefrom":22.9,"volumeto":370.56,"volume":347.66},{"date":"2017-10-18 12:33:00","open":16.17,"low":16.18,"high":16.16,"close":16.18,"value":16.18,"volumefrom":18.41,"volumeto":297.83,"volume":279.42},{"date":"2017-10-18 12:32:00","open":16.16,"low":16.17,"high":16.15,"close":16.16,"value":16.16,"volumefrom":13.05,"volumeto":211.23,"volume":198.18},{"date":"2017-10-18 12:31:00","open":16.17,"low":16.19,"high":16.16,"close":16.16,"value":16.16,"volumefrom":27,"volumeto":436.72,"volume":409.72},{"date":"2017-10-18 12:30:00","open":16.16,"low":16.17,"high":16.16,"close":16.17,"value":16.17,"volumefrom":5.88,"volumeto":95.07,"volume":89.19},{"date":"2017-10-18 12:29:00","open":16.17,"low":16.18,"high":16.16,"close":16.16,"value":16.16,"volumefrom":12.21,"volumeto":197.42,"volume":185.21},{"date":"2017-10-18 12:28:00","open":16.17,"low":16.17,"high":16.17,"close":16.17,"value":16.17,"volumefrom":20.67,"volumeto":334.18,"volume":313.51},{"date":"2017-10-18 12:27:00","open":16.16,"low":16.18,"high":16.16,"close":16.17,"value":16.17,"volumefrom":19.69,"volumeto":318.3,"volume":298.61},{"date":"2017-10-18 12:26:00","open":16.16,"low":16.17,"high":16.16,"close":16.17,"value":16.17,"volumefrom":15.5,"volumeto":250.39,"volume":234.89},{"date":"2017-10-18 12:25:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":5.72,"volumeto":92.46,"volume":86.74},{"date":"2017-10-18 12:24:00","open":16.16,"low":16.16,"high":16.15,"close":16.16,"value":16.16,"volumefrom":21.11,"volumeto":341.22,"volume":320.11},{"date":"2017-10-18 12:23:00","open":16.16,"low":16.17,"high":16.16,"close":16.16,"value":16.16,"volumefrom":16.08,"volumeto":259.93,"volume":243.85},{"date":"2017-10-18 12:22:00","open":16.16,"low":16.18,"high":16.16,"close":16.16,"value":16.16,"volumefrom":14.99,"volumeto":242.29,"volume":227.3},{"date":"2017-10-18 12:21:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":9.82,"volumeto":158.67,"volume":148.85},{"date":"2017-10-18 12:20:00","open":16.15,"low":16.16,"high":16.15,"close":16.15,"value":16.15,"volumefrom":16.31,"volumeto":263.49,"volume":247.18},{"date":"2017-10-18 12:19:00","open":16.17,"low":16.17,"high":16.16,"close":16.16,"value":16.16,"volumefrom":13.83,"volumeto":223.58,"volume":209.75},{"date":"2017-10-18 12:18:00","open":16.15,"low":16.16,"high":16.15,"close":16.16,"value":16.16,"volumefrom":2.95,"volumeto":47.64,"volume":44.69},{"date":"2017-10-18 12:17:00","open":16.14,"low":16.16,"high":16.13,"close":16.15,"value":16.15,"volumefrom":8.39,"volumeto":135.55,"volume":127.16},{"date":"2017-10-18 12:16:00","open":16.13,"low":16.14,"high":16.13,"close":16.14,"value":16.14,"volumefrom":17.19,"volumeto":277.46,"volume":260.27},{"date":"2017-10-18 12:15:00","open":16.14,"low":16.14,"high":16.13,"close":16.13,"value":16.13,"volumefrom":11,"volumeto":177.67,"volume":166.67},{"date":"2017-10-18 12:14:00","open":16.16,"low":16.16,"high":16.14,"close":16.14,"value":16.14,"volumefrom":17.91,"volumeto":289.3,"volume":271.39},{"date":"2017-10-18 12:13:00","open":16.15,"low":16.16,"high":16.15,"close":16.16,"value":16.16,"volumefrom":16.43,"volumeto":265.34,"volume":248.91},{"date":"2017-10-18 12:12:00","open":16.15,"low":16.16,"high":16.14,"close":16.15,"value":16.15,"volumefrom":16.08,"volumeto":259.77,"volume":243.69},{"date":"2017-10-18 12:11:00","open":16.14,"low":16.17,"high":16.14,"close":16.15,"value":16.15,"volumefrom":22.83,"volumeto":368.84,"volume":346.01},{"date":"2017-10-18 12:10:00","open":16.16,"low":16.19,"high":16.16,"close":16.18,"value":16.18,"volumefrom":23.58,"volumeto":381.14,"volume":357.56},{"date":"2017-10-18 12:09:00","open":16.15,"low":16.16,"high":16.14,"close":16.16,"value":16.16,"volumefrom":17.19,"volumeto":277.86,"volume":260.67},{"date":"2017-10-18 12:08:00","open":16.16,"low":16.18,"high":16.14,"close":16.15,"value":16.15,"volumefrom":29.71,"volumeto":479.59,"volume":449.88},{"date":"2017-10-18 12:07:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":10.82,"volumeto":174.8,"volume":163.98},{"date":"2017-10-18 12:06:00","open":16.18,"low":16.18,"high":16.17,"close":16.17,"value":16.17,"volumefrom":19.18,"volumeto":310.02,"volume":290.84},{"date":"2017-10-18 12:05:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.04373,"volumeto":0.7042,"volume":0.66047},{"date":"2017-10-18 12:04:00","open":16.18,"low":16.18,"high":16.16,"close":16.17,"value":16.17,"volumefrom":20.4,"volumeto":329.45,"volume":309.05},{"date":"2017-10-18 12:03:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.02154,"volumeto":0.3469,"volume":0.32536},{"date":"2017-10-18 12:02:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.01504,"volumeto":0.2422,"volume":0.22716},{"date":"2017-10-18 12:01:00","open":16.14,"low":16.14,"high":16.13,"close":16.13,"value":16.13,"volumefrom":3.58,"volumeto":57.57,"volume":53.99},{"date":"2017-10-18 12:00:00","open":16.14,"low":16.16,"high":16.14,"close":16.14,"value":16.14,"volumefrom":15.04,"volumeto":242.68,"volume":227.64},{"date":"2017-10-18 11:59:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.7498,"volumeto":12.07,"volume":11.3202},{"date":"2017-10-18 11:58:00","open":16.14,"low":16.15,"high":16.13,"close":16.13,"value":16.13,"volumefrom":9.97,"volumeto":160.9,"volume":150.93},{"date":"2017-10-18 11:57:00","open":16.13,"low":16.14,"high":16.12,"close":16.14,"value":16.14,"volumefrom":15.89,"volumeto":256.46,"volume":240.57},{"date":"2017-10-18 11:56:00","open":16.11,"low":16.13,"high":16.11,"close":16.13,"value":16.13,"volumefrom":4.78,"volumeto":76.98,"volume":72.2},{"date":"2017-10-18 11:55:00","open":16.11,"low":16.13,"high":16.1,"close":16.11,"value":16.11,"volumefrom":14.85,"volumeto":239.34,"volume":224.49},{"date":"2017-10-18 11:54:00","open":16.1,"low":16.13,"high":16.08,"close":16.11,"value":16.11,"volumefrom":31.25,"volumeto":504.4,"volume":473.15},{"date":"2017-10-18 11:53:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.003013,"volumeto":0.0486,"volume":0.045587},{"date":"2017-10-18 11:52:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.001081,"volumeto":0.01744,"volume":0.016359},{"date":"2017-10-18 11:51:00","open":16.16,"low":16.16,"high":16.16,"close":16.16,"value":16.16,"volumefrom":0.00062,"volumeto":0.01,"volume":0.00938},{"date":"2017-10-18 11:50:00","open":16.1,"low":16.1,"high":16.09,"close":16.09,"value":16.09,"volumefrom":21.51,"volumeto":346.18,"volume":324.67},{"date":"2017-10-18 11:49:00","open":16.14,"low":16.16,"high":16.1,"close":16.1,"value":16.1,"volumefrom":14.4,"volumeto":231.82,"volume":217.42},{"date":"2017-10-18 11:48:00","open":16.15,"low":16.17,"high":16.12,"close":16.14,"value":16.14,"volumefrom":24.91,"volumeto":402.29,"volume":377.38},{"date":"2017-10-18 11:47:00","open":16.13,"low":16.14,"high":16.12,"close":16.13,"value":16.13,"volumefrom":8.87,"volumeto":143.16,"volume":134.29},{"date":"2017-10-18 11:46:00","open":16.13,"low":16.15,"high":16.1,"close":16.13,"value":16.13,"volumefrom":25.76,"volumeto":415.87,"volume":390.11},{"date":"2017-10-18 11:45:00","open":16.13,"low":16.15,"high":16.12,"close":16.15,"value":16.15,"volumefrom":20.75,"volumeto":335.23,"volume":314.48},{"date":"2017-10-18 11:44:00","open":16.15,"low":16.18,"high":16.13,"close":16.13,"value":16.13,"volumefrom":28.6,"volumeto":461.85,"volume":433.25},{"date":"2017-10-18 11:43:00","open":16.14,"low":16.15,"high":16.11,"close":16.15,"value":16.15,"volumefrom":21.54,"volumeto":347.49,"volume":325.95},{"date":"2017-10-18 11:42:00","open":16.17,"low":16.17,"high":16.14,"close":16.14,"value":16.14,"volumefrom":40.57,"volumeto":656.55,"volume":615.98},{"date":"2017-10-18 11:41:00","open":16.16,"low":16.17,"high":16.14,"close":16.17,"value":16.17,"volumefrom":19.31,"volumeto":312.04,"volume":292.73},{"date":"2017-10-18 11:40:00","open":16.17,"low":16.17,"high":16.13,"close":16.14,"value":16.14,"volumefrom":15.1,"volumeto":243.68,"volume":228.58},{"date":"2017-10-18 11:39:00","open":16.18,"low":16.2,"high":16.15,"close":16.16,"value":16.16,"volumefrom":27.1,"volumeto":438.26,"volume":411.16},{"date":"2017-10-18 11:38:00","open":16.17,"low":16.19,"high":16.16,"close":16.18,"value":16.18,"volumefrom":21.98,"volumeto":355.58,"volume":333.6},{"date":"2017-10-18 11:37:00","open":16.18,"low":16.19,"high":16.17,"close":16.17,"value":16.17,"volumefrom":18.79,"volumeto":304.07,"volume":285.28},{"date":"2017-10-18 11:36:00","open":16.17,"low":16.23,"high":16.16,"close":16.18,"value":16.18,"volumefrom":26.11,"volumeto":425.32,"volume":399.21},{"date":"2017-10-18 11:35:00","open":16.16,"low":16.18,"high":16.16,"close":16.18,"value":16.18,"volumefrom":15.07,"volumeto":243.92,"volume":228.85},{"date":"2017-10-18 11:34:00","open":16.16,"low":16.18,"high":16.16,"close":16.17,"value":16.17,"volumefrom":39.49,"volumeto":639.42,"volume":599.93},{"date":"2017-10-18 11:33:00","open":16.14,"low":16.18,"high":16.13,"close":16.16,"value":16.16,"volumefrom":31.09,"volumeto":502.6,"volume":471.51},{"date":"2017-10-18 11:32:00","open":16.13,"low":16.15,"high":16.13,"close":16.15,"value":16.15,"volumefrom":28.72,"volumeto":463.78,"volume":435.06},{"date":"2017-10-18 11:31:00","open":16.11,"low":16.12,"high":16.09,"close":16.11,"value":16.11,"volumefrom":27.55,"volumeto":444.13,"volume":416.58},{"date":"2017-10-18 11:30:00","open":16.11,"low":16.11,"high":16.08,"close":16.11,"value":16.11,"volumefrom":26.01,"volumeto":419.09,"volume":393.08},{"date":"2017-10-18 11:29:00","open":16.07,"low":16.11,"high":16.07,"close":16.1,"value":16.1,"volumefrom":13.65,"volumeto":219.97,"volume":206.32},{"date":"2017-10-18 11:28:00","open":16.08,"low":16.1,"high":16.07,"close":16.07,"value":16.07,"volumefrom":24.08,"volumeto":387.75,"volume":363.67},{"date":"2017-10-18 11:27:00","open":16.07,"low":16.1,"high":16.07,"close":16.08,"value":16.08,"volumefrom":21.54,"volumeto":346.52,"volume":324.98},{"date":"2017-10-18 11:26:00","open":16.08,"low":16.08,"high":16.06,"close":16.07,"value":16.07,"volumefrom":25.17,"volumeto":404.54,"volume":379.37},{"date":"2017-10-18 11:25:00","open":16.08,"low":16.08,"high":16.07,"close":16.08,"value":16.08,"volumefrom":14.12,"volumeto":227,"volume":212.88},{"date":"2017-10-18 11:24:00","open":16.08,"low":16.08,"high":16.07,"close":16.08,"value":16.08,"volumefrom":19.09,"volumeto":307.04,"volume":287.95},{"date":"2017-10-18 11:23:00","open":16.07,"low":16.09,"high":16.07,"close":16.08,"value":16.08,"volumefrom":23.6,"volumeto":379.56,"volume":355.96},{"date":"2017-10-18 11:22:00","open":16.07,"low":16.08,"high":16.06,"close":16.07,"value":16.07,"volumefrom":11.77,"volumeto":189.2,"volume":177.43},{"date":"2017-10-18 11:21:00","open":16.07,"low":16.07,"high":16.06,"close":16.07,"value":16.07,"volumefrom":18.51,"volumeto":297.4,"volume":278.89},{"date":"2017-10-18 11:20:00","open":16.07,"low":16.08,"high":16.04,"close":16.07,"value":16.07,"volumefrom":13.51,"volumeto":217.05,"volume":203.54},{"date":"2017-10-18 11:19:00","open":16.05,"low":16.07,"high":16.05,"close":16.07,"value":16.07,"volumefrom":9.36,"volumeto":150.55,"volume":141.19},{"date":"2017-10-18 11:18:00","open":16.05,"low":16.06,"high":16.04,"close":16.05,"value":16.05,"volumefrom":16.51,"volumeto":265.35,"volume":248.84},{"date":"2017-10-18 11:17:00","open":16.03,"low":16.07,"high":16.03,"close":16.05,"value":16.05,"volumefrom":19.01,"volumeto":305.36,"volume":286.35},{"date":"2017-10-18 11:16:00","open":16.03,"low":16.04,"high":16.03,"close":16.04,"value":16.04,"volumefrom":14.22,"volumeto":228.31,"volume":214.09},{"date":"2017-10-18 11:15:00","open":16,"low":16.03,"high":16,"close":16.03,"value":16.03,"volumefrom":8.22,"volumeto":131.71,"volume":123.49},{"date":"2017-10-18 11:14:00","open":15.99,"low":16.02,"high":15.99,"close":16.01,"value":16.01,"volumefrom":17.82,"volumeto":285.31,"volume":267.49},{"date":"2017-10-18 11:13:00","open":15.98,"low":16,"high":15.97,"close":15.99,"value":15.99,"volumefrom":13.26,"volumeto":212.15,"volume":198.89},{"date":"2017-10-18 11:12:00","open":15.99,"low":15.99,"high":15.98,"close":15.98,"value":15.98,"volumefrom":6.05,"volumeto":96.65,"volume":90.6},{"date":"2017-10-18 11:11:00","open":16.02,"low":16.03,"high":15.97,"close":15.98,"value":15.98,"volumefrom":12.28,"volumeto":196.51,"volume":184.23},{"date":"2017-10-18 11:10:00","open":16.03,"low":16.03,"high":16,"close":16.03,"value":16.03,"volumefrom":25.7,"volumeto":409.92,"volume":384.22},{"date":"2017-10-18 11:09:00","open":15.98,"low":16.03,"high":15.98,"close":16.03,"value":16.03,"volumefrom":5.67,"volumeto":90.71,"volume":85.04},{"date":"2017-10-18 11:08:00","open":15.96,"low":15.96,"high":15.96,"close":15.96,"value":15.96,"volumefrom":10.71,"volumeto":171.15,"volume":160.44},{"date":"2017-10-18 11:07:00","open":15.96,"low":15.96,"high":15.95,"close":15.96,"value":15.96,"volumefrom":5.57,"volumeto":88.78,"volume":83.21},{"date":"2017-10-18 11:06:00","open":15.96,"low":15.97,"high":15.95,"close":15.96,"value":15.96,"volumefrom":10.36,"volumeto":165.4,"volume":155.04},{"date":"2017-10-18 11:05:00","open":15.93,"low":15.97,"high":15.93,"close":15.96,"value":15.96,"volumefrom":5.46,"volumeto":87.14,"volume":81.68},{"date":"2017-10-18 11:04:00","open":15.93,"low":15.96,"high":15.93,"close":15.93,"value":15.93,"volumefrom":4.3,"volumeto":68.56,"volume":64.26},{"date":"2017-10-18 11:03:00","open":15.93,"low":15.96,"high":15.92,"close":15.93,"value":15.93,"volumefrom":8.61,"volumeto":137.22,"volume":128.61},{"date":"2017-10-18 11:02:00","open":15.93,"low":15.94,"high":15.92,"close":15.93,"value":15.93,"volumefrom":6.34,"volumeto":100.9,"volume":94.56},{"date":"2017-10-18 11:01:00","open":15.93,"low":15.95,"high":15.92,"close":15.92,"value":15.92,"volumefrom":26.43,"volumeto":420.35,"volume":393.92},{"date":"2017-10-18 11:00:00","open":15.93,"low":15.94,"high":15.92,"close":15.94,"value":15.94,"volumefrom":10.55,"volumeto":168.09,"volume":157.54},{"date":"2017-10-18 10:59:00","open":15.92,"low":15.92,"high":15.9,"close":15.92,"value":15.92,"volumefrom":8.5,"volumeto":135.41,"volume":126.91},{"date":"2017-10-18 10:58:00","open":15.95,"low":15.95,"high":15.89,"close":15.91,"value":15.91,"volumefrom":31.51,"volumeto":498.08,"volume":466.57},{"date":"2017-10-18 10:57:00","open":15.93,"low":15.95,"high":15.93,"close":15.95,"value":15.95,"volumefrom":5.39,"volumeto":85.92,"volume":80.53},{"date":"2017-10-18 10:56:00","open":15.93,"low":15.95,"high":15.92,"close":15.94,"value":15.94,"volumefrom":14.41,"volumeto":229.61,"volume":215.2},{"date":"2017-10-18 10:55:00","open":15.98,"low":15.98,"high":15.93,"close":15.95,"value":15.95,"volumefrom":3.09,"volumeto":49.26,"volume":46.17},{"date":"2017-10-18 10:54:00","open":15.99,"low":15.99,"high":15.97,"close":15.98,"value":15.98,"volumefrom":8.05,"volumeto":128.6,"volume":120.55},{"date":"2017-10-18 10:53:00","open":15.99,"low":16,"high":15.99,"close":15.99,"value":15.99,"volumefrom":6.06,"volumeto":96.91,"volume":90.85},{"date":"2017-10-18 10:52:00","open":16,"low":16,"high":15.96,"close":15.99,"value":15.99,"volumefrom":7.35,"volumeto":117.5,"volume":110.15},{"date":"2017-10-18 10:51:00","open":16.01,"low":16.01,"high":15.94,"close":16,"value":16,"volumefrom":27.6,"volumeto":438.25,"volume":410.65},{"date":"2017-10-18 10:50:00","open":16.02,"low":16.04,"high":15.99,"close":16.01,"value":16.01,"volumefrom":13.03,"volumeto":208.47,"volume":195.44},{"date":"2017-10-18 10:49:00","open":16,"low":16.01,"high":15.99,"close":16.01,"value":16.01,"volumefrom":15.59,"volumeto":249.25,"volume":233.66},{"date":"2017-10-18 10:48:00","open":15.99,"low":16.01,"high":15.98,"close":16,"value":16,"volumefrom":13.6,"volumeto":217.63,"volume":204.03},{"date":"2017-10-18 10:47:00","open":16,"low":16.01,"high":15.99,"close":15.99,"value":15.99,"volumefrom":18.08,"volumeto":289.29,"volume":271.21},{"date":"2017-10-18 10:46:00","open":15.97,"low":16.01,"high":15.97,"close":16.01,"value":16.01,"volumefrom":23.51,"volumeto":376.25,"volume":352.74},{"date":"2017-10-18 10:45:00","open":15.99,"low":16.02,"high":15.95,"close":16,"value":16,"volumefrom":20.19,"volumeto":322.92,"volume":302.73},{"date":"2017-10-18 10:44:00","open":16.03,"low":16.03,"high":15.98,"close":15.98,"value":15.98,"volumefrom":20.79,"volumeto":332.72,"volume":311.93},{"date":"2017-10-18 10:43:00","open":16.06,"low":16.07,"high":16.02,"close":16.03,"value":16.03,"volumefrom":26.75,"volumeto":429.33,"volume":402.58},{"date":"2017-10-18 10:42:00","open":16.03,"low":16.1,"high":15.99,"close":16.06,"value":16.06,"volumefrom":37.77,"volumeto":604.67,"volume":566.9},{"date":"2017-10-18 10:41:00","open":16.14,"low":16.16,"high":16.02,"close":16.02,"value":16.02,"volumefrom":23.96,"volumeto":386.13,"volume":362.17},{"date":"2017-10-18 10:40:00","open":16.13,"low":16.18,"high":16.13,"close":16.16,"value":16.16,"volumefrom":20.19,"volumeto":326.02,"volume":305.83},{"date":"2017-10-18 10:39:00","open":16.13,"low":16.15,"high":16.11,"close":16.13,"value":16.13,"volumefrom":30.17,"volumeto":486.44,"volume":456.27},{"date":"2017-10-18 10:38:00","open":16.19,"low":16.19,"high":16.15,"close":16.16,"value":16.16,"volumefrom":17.72,"volumeto":285.93,"volume":268.21},{"date":"2017-10-18 10:37:00","open":16.2,"low":16.22,"high":16.18,"close":16.18,"value":16.18,"volumefrom":14.58,"volumeto":236.03,"volume":221.45},{"date":"2017-10-18 10:36:00","open":16.2,"low":16.21,"high":16.2,"close":16.2,"value":16.2,"volumefrom":16.94,"volumeto":274.53,"volume":257.59},{"date":"2017-10-18 10:35:00","open":16.23,"low":16.24,"high":16.19,"close":16.19,"value":16.19,"volumefrom":13.25,"volumeto":214.31,"volume":201.06},{"date":"2017-10-18 10:34:00","open":16.24,"low":16.25,"high":16.24,"close":16.24,"value":16.24,"volumefrom":36.69,"volumeto":595.66,"volume":558.97},{"date":"2017-10-18 10:33:00","open":16.24,"low":16.25,"high":16.22,"close":16.25,"value":16.25,"volumefrom":37.81,"volumeto":613.99,"volume":576.18},{"date":"2017-10-18 10:32:00","open":16.23,"low":16.25,"high":16.21,"close":16.24,"value":16.24,"volumefrom":22.43,"volumeto":364.39,"volume":341.96},{"date":"2017-10-18 10:31:00","open":16.23,"low":16.24,"high":16.21,"close":16.23,"value":16.23,"volumefrom":17.76,"volumeto":288.28,"volume":270.52},{"date":"2017-10-18 10:30:00","open":16.22,"low":16.24,"high":16.22,"close":16.23,"value":16.23,"volumefrom":19.51,"volumeto":316.58,"volume":297.07},{"date":"2017-10-18 10:29:00","open":16.21,"low":16.24,"high":16.2,"close":16.22,"value":16.22,"volumefrom":35.55,"volumeto":577.22,"volume":541.67},{"date":"2017-10-18 10:28:00","open":16.19,"low":16.23,"high":16.18,"close":16.21,"value":16.21,"volumefrom":61.09,"volumeto":990.29,"volume":929.2},{"date":"2017-10-18 10:27:00","open":16.17,"low":16.19,"high":16.17,"close":16.18,"value":16.18,"volumefrom":29.66,"volumeto":479.95,"volume":450.29},{"date":"2017-10-18 10:26:00","open":16.18,"low":16.18,"high":16.17,"close":16.17,"value":16.17,"volumefrom":28.05,"volumeto":453.88,"volume":425.83},{"date":"2017-10-18 10:25:00","open":16.18,"low":16.18,"high":16.14,"close":16.17,"value":16.17,"volumefrom":21.84,"volumeto":353.18,"volume":331.34},{"date":"2017-10-18 10:24:00","open":16.17,"low":16.18,"high":16.15,"close":16.17,"value":16.17,"volumefrom":25.57,"volumeto":413.07,"volume":387.5},{"date":"2017-10-18 10:23:00","open":16.16,"low":16.18,"high":16.16,"close":16.17,"value":16.17,"volumefrom":31.88,"volumeto":515.67,"volume":483.79},{"date":"2017-10-18 10:22:00","open":16.16,"low":16.16,"high":16.15,"close":16.16,"value":16.16,"volumefrom":8.43,"volumeto":136.35,"volume":127.92},{"date":"2017-10-18 10:21:00","open":16.16,"low":16.17,"high":16.15,"close":16.16,"value":16.16,"volumefrom":3.51,"volumeto":56.66,"volume":53.15},{"date":"2017-10-18 10:20:00","open":16.15,"low":16.16,"high":16.15,"close":16.16,"value":16.16,"volumefrom":19.88,"volumeto":321.32,"volume":301.44},{"date":"2017-10-18 10:19:00","open":16.13,"low":16.16,"high":16.12,"close":16.15,"value":16.15,"volumefrom":16.71,"volumeto":269.83,"volume":253.12},{"date":"2017-10-18 10:18:00","open":16.14,"low":16.14,"high":16.12,"close":16.13,"value":16.13,"volumefrom":27.53,"volumeto":443.96,"volume":416.43},{"date":"2017-10-18 10:17:00","open":16.1,"low":16.15,"high":16.1,"close":16.13,"value":16.13,"volumefrom":19.95,"volumeto":321.71,"volume":301.76},{"date":"2017-10-18 10:16:00","open":16.08,"low":16.11,"high":16.05,"close":16.09,"value":16.09,"volumefrom":39.5,"volumeto":636.04,"volume":596.54},{"date":"2017-10-18 10:15:00","open":16.09,"low":16.09,"high":16.06,"close":16.08,"value":16.08,"volumefrom":17.82,"volumeto":286.99,"volume":269.17},{"date":"2017-10-18 10:14:00","open":16.08,"low":16.1,"high":16.08,"close":16.09,"value":16.09,"volumefrom":25.01,"volumeto":402.53,"volume":377.52},{"date":"2017-10-18 10:13:00","open":16.08,"low":16.1,"high":16.08,"close":16.08,"value":16.08,"volumefrom":23.97,"volumeto":385.98,"volume":362.01},{"date":"2017-10-18 10:12:00","open":16.08,"low":16.08,"high":16.07,"close":16.08,"value":16.08,"volumefrom":12.49,"volumeto":201.05,"volume":188.56},{"date":"2017-10-18 10:11:00","open":16.06,"low":16.09,"high":16.06,"close":16.08,"value":16.08,"volumefrom":25.1,"volumeto":404.44,"volume":379.34},{"date":"2017-10-18 10:10:00","open":16.07,"low":16.08,"high":16.05,"close":16.06,"value":16.06,"volumefrom":11.15,"volumeto":178.85,"volume":167.7},{"date":"2017-10-18 10:09:00","open":16.06,"low":16.08,"high":16.05,"close":16.07,"value":16.07,"volumefrom":27.4,"volumeto":441.18,"volume":413.78},{"date":"2017-10-18 10:08:00","open":16.05,"low":16.05,"high":16.04,"close":16.04,"value":16.04,"volumefrom":28.9,"volumeto":462.79,"volume":433.89},{"date":"2017-10-18 10:07:00","open":16.03,"low":16.06,"high":16.02,"close":16.05,"value":16.05,"volumefrom":25.44,"volumeto":407.88,"volume":382.44},{"date":"2017-10-18 10:06:00","open":16.02,"low":16.04,"high":16.01,"close":16.02,"value":16.02,"volumefrom":35.15,"volumeto":563.6,"volume":528.45},{"date":"2017-10-18 10:05:00","open":16,"low":16.03,"high":16,"close":16.01,"value":16.01,"volumefrom":43.61,"volumeto":698.6,"volume":654.99},{"date":"2017-10-18 10:04:00","open":16,"low":16,"high":15.99,"close":15.99,"value":15.99,"volumefrom":32.14,"volumeto":514.79,"volume":482.65},{"date":"2017-10-18 10:03:00","open":15.99,"low":16,"high":15.98,"close":16,"value":16,"volumefrom":27.44,"volumeto":439.15,"volume":411.71},{"date":"2017-10-18 10:02:00","open":16.01,"low":16.01,"high":15.99,"close":15.99,"value":15.99,"volumefrom":30.36,"volumeto":485.38,"volume":455.02},{"date":"2017-10-18 10:01:00","open":16.02,"low":16.02,"high":16.01,"close":16.01,"value":16.01,"volumefrom":29.27,"volumeto":468.1,"volume":438.83},{"date":"2017-10-18 10:00:00","open":16.03,"low":16.03,"high":15.99,"close":16,"value":16,"volumefrom":9.35,"volumeto":149.54,"volume":140.19},{"date":"2017-10-18 09:59:00","open":16.03,"low":16.03,"high":16.02,"close":16.02,"value":16.02,"volumefrom":16.32,"volumeto":261.53,"volume":245.21},{"date":"2017-10-18 09:58:00","open":16.04,"low":16.04,"high":16.02,"close":16.04,"value":16.04,"volumefrom":24.31,"volumeto":389.51,"volume":365.2},{"date":"2017-10-18 09:57:00","open":16.01,"low":16.04,"high":16.01,"close":16.04,"value":16.04,"volumefrom":43.96,"volumeto":704.33,"volume":660.37},{"date":"2017-10-18 09:56:00","open":16.01,"low":16.02,"high":16.01,"close":16.01,"value":16.01,"volumefrom":20.23,"volumeto":324.27,"volume":304.04},{"date":"2017-10-18 09:55:00","open":16,"low":16.02,"high":16,"close":16.01,"value":16.01,"volumefrom":47.95,"volumeto":768.31,"volume":720.36},{"date":"2017-10-18 09:54:00","open":16.01,"low":16.03,"high":16.01,"close":16.01,"value":16.01,"volumefrom":48.24,"volumeto":772.55,"volume":724.31},{"date":"2017-10-18 09:53:00","open":16,"low":16.01,"high":15.99,"close":16,"value":16,"volumefrom":40.08,"volumeto":642.23,"volume":602.15},{"date":"2017-10-18 09:52:00","open":15.97,"low":15.99,"high":15.97,"close":15.99,"value":15.99,"volumefrom":23.29,"volumeto":372.49,"volume":349.2},{"date":"2017-10-18 09:51:00","open":15.96,"low":15.97,"high":15.96,"close":15.96,"value":15.96,"volumefrom":38.73,"volumeto":619.49,"volume":580.76},{"date":"2017-10-18 09:50:00","open":15.93,"low":15.96,"high":15.93,"close":15.95,"value":15.95,"volumefrom":22.42,"volumeto":358.26,"volume":335.84},{"date":"2017-10-18 09:49:00","open":15.93,"low":15.95,"high":15.93,"close":15.93,"value":15.93,"volumefrom":25.58,"volumeto":408.36,"volume":382.78},{"date":"2017-10-18 09:48:00","open":15.91,"low":15.96,"high":15.91,"close":15.94,"value":15.94,"volumefrom":25.69,"volumeto":409.81,"volume":384.12},{"date":"2017-10-18 09:47:00","open":15.91,"low":15.94,"high":15.91,"close":15.94,"value":15.94,"volumefrom":16.95,"volumeto":270.2,"volume":253.25},{"date":"2017-10-18 09:46:00","open":15.94,"low":15.94,"high":15.89,"close":15.91,"value":15.91,"volumefrom":31.79,"volumeto":506.23,"volume":474.44},{"date":"2017-10-18 09:45:00","open":15.93,"low":15.95,"high":15.89,"close":15.95,"value":15.95,"volumefrom":17.9,"volumeto":285.59,"volume":267.69},{"date":"2017-10-18 09:44:00","open":15.9,"low":15.95,"high":15.88,"close":15.93,"value":15.93,"volumefrom":28.39,"volumeto":452.55,"volume":424.16},{"date":"2017-10-18 09:43:00","open":15.87,"low":15.95,"high":15.86,"close":15.9,"value":15.9,"volumefrom":29.4,"volumeto":468.96,"volume":439.56},{"date":"2017-10-18 09:42:00","open":15.9,"low":15.9,"high":15.87,"close":15.87,"value":15.87,"volumefrom":28.71,"volumeto":455.96,"volume":427.25},{"date":"2017-10-18 09:41:00","open":15.87,"low":15.91,"high":15.87,"close":15.9,"value":15.9,"volumefrom":22.19,"volumeto":352.55,"volume":330.36},{"date":"2017-10-18 09:40:00","open":15.86,"low":15.88,"high":15.86,"close":15.87,"value":15.87,"volumefrom":20.03,"volumeto":317.77,"volume":297.74},{"date":"2017-10-18 09:39:00","open":15.9,"low":15.9,"high":15.87,"close":15.87,"value":15.87,"volumefrom":23.99,"volumeto":380.67,"volume":356.68},{"date":"2017-10-18 09:38:00","open":15.89,"low":15.89,"high":15.89,"close":15.89,"value":15.89,"volumefrom":32.27,"volumeto":512.19,"volume":479.92},{"date":"2017-10-18 09:37:00","open":15.88,"low":15.89,"high":15.88,"close":15.89,"value":15.89,"volumefrom":24.83,"volumeto":393.76,"volume":368.93},{"date":"2017-10-18 09:36:00","open":15.84,"low":15.89,"high":15.84,"close":15.88,"value":15.88,"volumefrom":19.81,"volumeto":314.7,"volume":294.89},{"date":"2017-10-18 09:35:00","open":15.85,"low":15.85,"high":15.84,"close":15.85,"value":15.85,"volumefrom":33.74,"volumeto":535.16,"volume":501.42},{"date":"2017-10-18 09:34:00","open":15.86,"low":15.88,"high":15.84,"close":15.85,"value":15.85,"volumefrom":23.8,"volumeto":377.61,"volume":353.81},{"date":"2017-10-18 09:33:00","open":15.88,"low":15.88,"high":15.86,"close":15.86,"value":15.86,"volumefrom":13.4,"volumeto":212.68,"volume":199.28},{"date":"2017-10-18 09:32:00","open":15.86,"low":15.88,"high":15.86,"close":15.88,"value":15.88,"volumefrom":19.49,"volumeto":309.51,"volume":290.02},{"date":"2017-10-18 09:31:00","open":15.85,"low":15.87,"high":15.85,"close":15.86,"value":15.86,"volumefrom":29.9,"volumeto":474.33,"volume":444.43},{"date":"2017-10-18 09:30:00","open":15.86,"low":15.88,"high":15.86,"close":15.87,"value":15.87,"volumefrom":27.16,"volumeto":430.86,"volume":403.7},{"date":"2017-10-18 09:29:00","open":15.87,"low":15.88,"high":15.87,"close":15.87,"value":15.87,"volumefrom":13.6,"volumeto":215.9,"volume":202.3},{"date":"2017-10-18 09:28:00","open":15.88,"low":15.88,"high":15.87,"close":15.88,"value":15.88,"volumefrom":21.95,"volumeto":348.54,"volume":326.59},{"date":"2017-10-18 09:27:00","open":15.86,"low":15.88,"high":15.86,"close":15.87,"value":15.87,"volumefrom":25.89,"volumeto":410.99,"volume":385.1},{"date":"2017-10-18 09:26:00","open":15.85,"low":15.87,"high":15.85,"close":15.86,"value":15.86,"volumefrom":23.22,"volumeto":368.61,"volume":345.39},{"date":"2017-10-18 09:25:00","open":15.86,"low":15.88,"high":15.85,"close":15.85,"value":15.85,"volumefrom":36.62,"volumeto":581.14,"volume":544.52},{"date":"2017-10-18 09:24:00","open":15.88,"low":15.9,"high":15.87,"close":15.87,"value":15.87,"volumefrom":36.13,"volumeto":573.5,"volume":537.37},{"date":"2017-10-18 09:23:00","open":15.85,"low":15.89,"high":15.85,"close":15.88,"value":15.88,"volumefrom":23.31,"volumeto":369.71,"volume":346.4},{"date":"2017-10-18 09:22:00","open":15.86,"low":15.86,"high":15.85,"close":15.86,"value":15.86,"volumefrom":18.72,"volumeto":296.81,"volume":278.09},{"date":"2017-10-18 09:21:00","open":15.85,"low":15.86,"high":15.85,"close":15.86,"value":15.86,"volumefrom":21.39,"volumeto":339.09,"volume":317.7},{"date":"2017-10-18 09:20:00","open":15.85,"low":15.85,"high":15.84,"close":15.85,"value":15.85,"volumefrom":1.66,"volumeto":26.3,"volume":24.64},{"date":"2017-10-18 09:19:00","open":15.85,"low":15.85,"high":15.84,"close":15.85,"value":15.85,"volumefrom":22.52,"volumeto":356.85,"volume":334.33},{"date":"2017-10-18 09:18:00","open":15.84,"low":15.85,"high":15.84,"close":15.85,"value":15.85,"volumefrom":15.03,"volumeto":238.21,"volume":223.18},{"date":"2017-10-18 09:17:00","open":15.85,"low":15.85,"high":15.84,"close":15.84,"value":15.84,"volumefrom":24.75,"volumeto":391.94,"volume":367.19},{"date":"2017-10-18 09:16:00","open":15.82,"low":15.86,"high":15.82,"close":15.85,"value":15.85,"volumefrom":14.06,"volumeto":222.67,"volume":208.61},{"date":"2017-10-18 09:15:00","open":15.82,"low":15.82,"high":15.81,"close":15.82,"value":15.82,"volumefrom":25.74,"volumeto":407.97,"volume":382.23},{"date":"2017-10-18 09:14:00","open":15.8,"low":15.82,"high":15.79,"close":15.82,"value":15.82,"volumefrom":13.14,"volumeto":208.02,"volume":194.88},{"date":"2017-10-18 09:13:00","open":15.81,"low":15.81,"high":15.78,"close":15.8,"value":15.8,"volumefrom":21.31,"volumeto":337.29,"volume":315.98},{"date":"2017-10-18 09:12:00","open":15.84,"low":15.84,"high":15.81,"close":15.81,"value":15.81,"volumefrom":21.25,"volumeto":336.63,"volume":315.38},{"date":"2017-10-18 09:11:00","open":15.84,"low":15.84,"high":15.81,"close":15.84,"value":15.84,"volumefrom":24.31,"volumeto":385.14,"volume":360.83},{"date":"2017-10-18 09:10:00","open":15.83,"low":15.85,"high":15.82,"close":15.84,"value":15.84,"volumefrom":22.26,"volumeto":352.9,"volume":330.64},{"date":"2017-10-18 09:09:00","open":15.85,"low":15.86,"high":15.82,"close":15.82,"value":15.82,"volumefrom":34.05,"volumeto":539.39,"volume":505.34},{"date":"2017-10-18 09:08:00","open":15.81,"low":15.85,"high":15.8,"close":15.84,"value":15.84,"volumefrom":22.56,"volumeto":357.06,"volume":334.5},{"date":"2017-10-18 09:07:00","open":15.81,"low":15.82,"high":15.79,"close":15.8,"value":15.8,"volumefrom":21.02,"volumeto":332.29,"volume":311.27},{"date":"2017-10-18 09:06:00","open":15.82,"low":15.83,"high":15.79,"close":15.81,"value":15.81,"volumefrom":21.09,"volumeto":333.68,"volume":312.59},{"date":"2017-10-18 09:05:00","open":15.82,"low":15.83,"high":15.79,"close":15.83,"value":15.83,"volumefrom":26.68,"volumeto":421.69,"volume":395.01},{"date":"2017-10-18 09:04:00","open":15.82,"low":15.84,"high":15.81,"close":15.81,"value":15.81,"volumefrom":23.39,"volumeto":369.63,"volume":346.24},{"date":"2017-10-18 09:03:00","open":15.92,"low":15.92,"high":15.82,"close":15.82,"value":15.82,"volumefrom":24.18,"volumeto":383.97,"volume":359.79},{"date":"2017-10-18 09:02:00","open":15.91,"low":15.92,"high":15.9,"close":15.92,"value":15.92,"volumefrom":17.78,"volumeto":283.05,"volume":265.27},{"date":"2017-10-18 09:01:00","open":15.9,"low":15.91,"high":15.9,"close":15.91,"value":15.91,"volumefrom":11.12,"volumeto":177.11,"volume":165.99},{"date":"2017-10-18 09:00:00","open":15.92,"low":15.93,"high":15.9,"close":15.9,"value":15.9,"volumefrom":21.47,"volumeto":341.95,"volume":320.48},{"date":"2017-10-18 08:59:00","open":15.92,"low":15.92,"high":15.9,"close":15.92,"value":15.92,"volumefrom":18.99,"volumeto":302.81,"volume":283.82},{"date":"2017-10-18 08:58:00","open":15.93,"low":15.93,"high":15.9,"close":15.92,"value":15.92,"volumefrom":25.4,"volumeto":404.41,"volume":379.01},{"date":"2017-10-18 08:57:00","open":15.92,"low":15.94,"high":15.91,"close":15.93,"value":15.93,"volumefrom":44.38,"volumeto":702.47,"volume":658.09},{"date":"2017-10-18 08:56:00","open":15.92,"low":15.93,"high":15.92,"close":15.92,"value":15.92,"volumefrom":20.65,"volumeto":328.76,"volume":308.11},{"date":"2017-10-18 08:55:00","open":15.92,"low":15.92,"high":15.9,"close":15.91,"value":15.91,"volumefrom":14.28,"volumeto":227.19,"volume":212.91},{"date":"2017-10-18 08:54:00","open":15.91,"low":15.93,"high":15.9,"close":15.92,"value":15.92,"volumefrom":24.27,"volumeto":386.18,"volume":361.91},{"date":"2017-10-18 08:53:00","open":15.9,"low":15.92,"high":15.89,"close":15.92,"value":15.92,"volumefrom":25.17,"volumeto":400.5,"volume":375.33},{"date":"2017-10-18 08:52:00","open":15.89,"low":15.9,"high":15.89,"close":15.9,"value":15.9,"volumefrom":7.56,"volumeto":120.09,"volume":112.53},{"date":"2017-10-18 08:51:00","open":15.89,"low":15.9,"high":15.88,"close":15.9,"value":15.9,"volumefrom":12.97,"volumeto":205.95,"volume":192.98},{"date":"2017-10-18 08:50:00","open":15.9,"low":15.9,"high":15.89,"close":15.89,"value":15.89,"volumefrom":24.55,"volumeto":390.33,"volume":365.78},{"date":"2017-10-18 08:49:00","open":15.89,"low":15.91,"high":15.89,"close":15.91,"value":15.91,"volumefrom":39.87,"volumeto":633.95,"volume":594.08},{"date":"2017-10-18 08:48:00","open":15.91,"low":15.91,"high":15.89,"close":15.89,"value":15.89,"volumefrom":20.68,"volumeto":328.82,"volume":308.14},{"date":"2017-10-18 08:47:00","open":15.91,"low":15.92,"high":15.89,"close":15.91,"value":15.91,"volumefrom":15.16,"volumeto":241.17,"volume":226.01},{"date":"2017-10-18 08:46:00","open":15.92,"low":15.92,"high":15.9,"close":15.92,"value":15.92,"volumefrom":23.1,"volumeto":367.61,"volume":344.51},{"date":"2017-10-18 08:45:00","open":15.94,"low":15.94,"high":15.91,"close":15.92,"value":15.92,"volumefrom":15.64,"volumeto":249.03,"volume":233.39},{"date":"2017-10-18 08:44:00","open":15.92,"low":15.94,"high":15.91,"close":15.94,"value":15.94,"volumefrom":20.48,"volumeto":326.37,"volume":305.89},{"date":"2017-10-18 08:43:00","open":15.89,"low":15.91,"high":15.89,"close":15.91,"value":15.91,"volumefrom":22.76,"volumeto":362.08,"volume":339.32},{"date":"2017-10-18 08:42:00","open":15.9,"low":15.9,"high":15.89,"close":15.9,"value":15.9,"volumefrom":17.43,"volumeto":277.19,"volume":259.76},{"date":"2017-10-18 08:41:00","open":15.92,"low":15.92,"high":15.9,"close":15.9,"value":15.9,"volumefrom":5.21,"volumeto":82.88,"volume":77.67},{"date":"2017-10-18 08:40:00","open":15.94,"low":15.95,"high":15.92,"close":15.92,"value":15.92,"volumefrom":16.42,"volumeto":261.3,"volume":244.88},{"date":"2017-10-18 08:39:00","open":15.95,"low":15.96,"high":15.94,"close":15.94,"value":15.94,"volumefrom":17.87,"volumeto":284.89,"volume":267.02},{"date":"2017-10-18 08:38:00","open":15.97,"low":15.97,"high":15.95,"close":15.95,"value":15.95,"volumefrom":15.24,"volumeto":242.98,"volume":227.74},{"date":"2017-10-18 08:37:00","open":15.97,"low":15.98,"high":15.95,"close":15.97,"value":15.97,"volumefrom":19.85,"volumeto":316.74,"volume":296.89},{"date":"2017-10-18 08:36:00","open":15.98,"low":15.99,"high":15.96,"close":15.97,"value":15.97,"volumefrom":19.52,"volumeto":311.91,"volume":292.39},{"date":"2017-10-18 08:35:00","open":15.98,"low":16,"high":15.97,"close":15.97,"value":15.97,"volumefrom":25.45,"volumeto":406.64,"volume":381.19},{"date":"2017-10-18 08:34:00","open":15.97,"low":15.98,"high":15.94,"close":15.98,"value":15.98,"volumefrom":23.09,"volumeto":368.99,"volume":345.9},{"date":"2017-10-18 08:33:00","open":15.92,"low":15.97,"high":15.91,"close":15.97,"value":15.97,"volumefrom":24.52,"volumeto":391.35,"volume":366.83},{"date":"2017-10-18 08:32:00","open":15.91,"low":15.92,"high":15.91,"close":15.92,"value":15.92,"volumefrom":21.35,"volumeto":340.16,"volume":318.81},{"date":"2017-10-18 08:31:00","open":15.9,"low":15.91,"high":15.9,"close":15.91,"value":15.91,"volumefrom":19.04,"volumeto":303.01,"volume":283.97},{"date":"2017-10-18 08:30:00","open":15.86,"low":15.91,"high":15.86,"close":15.89,"value":15.89,"volumefrom":10.99,"volumeto":174.68,"volume":163.69},{"date":"2017-10-18 08:29:00","open":15.88,"low":15.91,"high":15.86,"close":15.86,"value":15.86,"volumefrom":19,"volumeto":302.09,"volume":283.09},{"date":"2017-10-18 08:28:00","open":15.89,"low":15.91,"high":15.86,"close":15.89,"value":15.89,"volumefrom":21.11,"volumeto":335.35,"volume":314.24},{"date":"2017-10-18 08:27:00","open":15.85,"low":15.89,"high":15.84,"close":15.89,"value":15.89,"volumefrom":27.66,"volumeto":439.69,"volume":412.03},{"date":"2017-10-18 08:26:00","open":15.86,"low":15.9,"high":15.84,"close":15.86,"value":15.86,"volumefrom":30.19,"volumeto":479.13,"volume":448.94},{"date":"2017-10-18 08:25:00","open":15.85,"low":15.85,"high":15.84,"close":15.85,"value":15.85,"volumefrom":29.57,"volumeto":468.67,"volume":439.1},{"date":"2017-10-18 08:24:00","open":15.84,"low":15.84,"high":15.84,"close":15.84,"value":15.84,"volumefrom":21.18,"volumeto":335.7,"volume":314.52},{"date":"2017-10-18 08:23:00","open":15.83,"low":15.85,"high":15.83,"close":15.84,"value":15.84,"volumefrom":19.03,"volumeto":301.43,"volume":282.4},{"date":"2017-10-18 08:22:00","open":15.85,"low":15.85,"high":15.83,"close":15.84,"value":15.84,"volumefrom":15.36,"volumeto":243.44,"volume":228.08},{"date":"2017-10-18 08:21:00","open":15.86,"low":15.87,"high":15.85,"close":15.85,"value":15.85,"volumefrom":24.22,"volumeto":384.06,"volume":359.84},{"date":"2017-10-18 08:20:00","open":15.85,"low":15.86,"high":15.84,"close":15.86,"value":15.86,"volumefrom":24.19,"volumeto":383.89,"volume":359.7},{"date":"2017-10-18 08:19:00","open":15.86,"low":15.88,"high":15.85,"close":15.85,"value":15.85,"volumefrom":21.52,"volumeto":340.95,"volume":319.43},{"date":"2017-10-18 08:18:00","open":15.85,"low":15.88,"high":15.84,"close":15.86,"value":15.86,"volumefrom":16.57,"volumeto":262.76,"volume":246.19},{"date":"2017-10-18 08:17:00","open":15.86,"low":15.87,"high":15.84,"close":15.86,"value":15.86,"volumefrom":26.03,"volumeto":413.09,"volume":387.06},{"date":"2017-10-18 08:16:00","open":15.87,"low":15.89,"high":15.85,"close":15.86,"value":15.86,"volumefrom":28.97,"volumeto":459.71,"volume":430.74},{"date":"2017-10-18 08:15:00","open":15.86,"low":15.89,"high":15.85,"close":15.87,"value":15.87,"volumefrom":22.57,"volumeto":358.73,"volume":336.16},{"date":"2017-10-18 08:14:00","open":15.91,"low":15.91,"high":15.85,"close":15.86,"value":15.86,"volumefrom":25.11,"volumeto":397.5,"volume":372.39},{"date":"2017-10-18 08:13:00","open":15.87,"low":15.91,"high":15.87,"close":15.88,"value":15.88,"volumefrom":23.17,"volumeto":368.57,"volume":345.4},{"date":"2017-10-18 08:12:00","open":15.89,"low":15.89,"high":15.87,"close":15.88,"value":15.88,"volumefrom":18.9,"volumeto":300.44,"volume":281.54},{"date":"2017-10-18 08:11:00","open":15.89,"low":15.89,"high":15.87,"close":15.88,"value":15.88,"volumefrom":15.37,"volumeto":244.22,"volume":228.85},{"date":"2017-10-18 08:10:00","open":15.89,"low":15.9,"high":15.86,"close":15.89,"value":15.89,"volumefrom":24.07,"volumeto":382.91,"volume":358.84},{"date":"2017-10-18 08:09:00","open":15.93,"low":15.93,"high":15.9,"close":15.91,"value":15.91,"volumefrom":25.14,"volumeto":399.81,"volume":374.67},{"date":"2017-10-18 08:08:00","open":15.91,"low":15.95,"high":15.89,"close":15.92,"value":15.92,"volumefrom":12.94,"volumeto":206.07,"volume":193.13},{"date":"2017-10-18 08:07:00","open":15.94,"low":15.94,"high":15.91,"close":15.94,"value":15.94,"volumefrom":14.94,"volumeto":238.14,"volume":223.2},{"date":"2017-10-18 08:06:00","open":15.93,"low":15.94,"high":15.91,"close":15.93,"value":15.93,"volumefrom":23.21,"volumeto":369.91,"volume":346.7},{"date":"2017-10-18 08:05:00","open":15.91,"low":15.92,"high":15.9,"close":15.9,"value":15.9,"volumefrom":39.54,"volumeto":629.8,"volume":590.26},{"date":"2017-10-18 08:04:00","open":15.89,"low":15.91,"high":15.89,"close":15.9,"value":15.9,"volumefrom":15.7,"volumeto":249.76,"volume":234.06},{"date":"2017-10-18 08:03:00","open":15.9,"low":15.92,"high":15.89,"close":15.89,"value":15.89,"volumefrom":24.09,"volumeto":383.76,"volume":359.67},{"date":"2017-10-18 08:02:00","open":15.91,"low":15.94,"high":15.91,"close":15.92,"value":15.92,"volumefrom":23.23,"volumeto":369.95,"volume":346.72},{"date":"2017-10-18 08:01:00","open":15.94,"low":15.94,"high":15.9,"close":15.91,"value":15.91,"volumefrom":33.61,"volumeto":534.34,"volume":500.73},{"date":"2017-10-18 08:00:00","open":15.93,"low":15.96,"high":15.92,"close":15.94,"value":15.94,"volumefrom":22.07,"volumeto":352.25,"volume":330.18},{"date":"2017-10-18 07:59:00","open":15.98,"low":15.98,"high":15.92,"close":15.94,"value":15.94,"volumefrom":19.62,"volumeto":312.73,"volume":293.11},{"date":"2017-10-18 07:58:00","open":16.01,"low":16.01,"high":15.96,"close":15.96,"value":15.96,"volumefrom":31.11,"volumeto":495.76,"volume":464.65},{"date":"2017-10-18 07:57:00","open":16.02,"low":16.02,"high":15.99,"close":16,"value":16,"volumefrom":15.19,"volumeto":242.97,"volume":227.78},{"date":"2017-10-18 07:56:00","open":15.96,"low":16.02,"high":15.96,"close":16.01,"value":16.01,"volumefrom":21.03,"volumeto":333.2,"volume":312.17},{"date":"2017-10-18 07:55:00","open":15.94,"low":15.99,"high":15.93,"close":15.96,"value":15.96,"volumefrom":42.67,"volumeto":686.27,"volume":643.6},{"date":"2017-10-18 07:54:00","open":15.85,"low":15.93,"high":15.85,"close":15.92,"value":15.92,"volumefrom":68.14,"volumeto":1090.38,"volume":1022.24},{"date":"2017-10-18 07:53:00","open":15.77,"low":15.88,"high":15.77,"close":15.88,"value":15.88,"volumefrom":30.39,"volumeto":480.95,"volume":450.56},{"date":"2017-10-18 07:52:00","open":15.66,"low":15.78,"high":15.66,"close":15.78,"value":15.78,"volumefrom":62.94,"volumeto":998.05,"volume":935.11},{"date":"2017-10-18 07:51:00","open":15.6,"low":15.66,"high":15.6,"close":15.66,"value":15.66,"volumefrom":28.04,"volumeto":441.07,"volume":413.03},{"date":"2017-10-18 07:50:00","open":15.59,"low":15.62,"high":15.58,"close":15.6,"value":15.6,"volumefrom":29.93,"volumeto":467.18,"volume":437.25},{"date":"2017-10-18 07:49:00","open":15.65,"low":15.66,"high":15.59,"close":15.59,"value":15.59,"volumefrom":31.64,"volumeto":494.28,"volume":462.64},{"date":"2017-10-18 07:48:00","open":15.73,"low":15.73,"high":15.63,"close":15.65,"value":15.65,"volumefrom":16.79,"volumeto":262.81,"volume":246.02},{"date":"2017-10-18 07:47:00","open":15.79,"low":15.79,"high":15.68,"close":15.7,"value":15.7,"volumefrom":28.72,"volumeto":450.52,"volume":421.8},{"date":"2017-10-18 07:46:00","open":15.78,"low":15.8,"high":15.73,"close":15.73,"value":15.73,"volumefrom":32.27,"volumeto":508.55,"volume":476.28},{"date":"2017-10-18 07:45:00","open":15.8,"low":15.82,"high":15.78,"close":15.78,"value":15.78,"volumefrom":22.25,"volumeto":351.47,"volume":329.22},{"date":"2017-10-18 07:44:00","open":15.82,"low":15.82,"high":15.8,"close":15.81,"value":15.81,"volumefrom":25.65,"volumeto":405.41,"volume":379.76},{"date":"2017-10-18 07:43:00","open":15.79,"low":15.86,"high":15.79,"close":15.83,"value":15.83,"volumefrom":20.09,"volumeto":317.76,"volume":297.67},{"date":"2017-10-18 07:42:00","open":15.74,"low":15.82,"high":15.74,"close":15.82,"value":15.82,"volumefrom":30.99,"volumeto":490.8,"volume":459.81},{"date":"2017-10-18 07:41:00","open":15.61,"low":15.78,"high":15.61,"close":15.77,"value":15.77,"volumefrom":33.35,"volumeto":526.71,"volume":493.36},{"date":"2017-10-18 07:40:00","open":15.53,"low":15.7,"high":15.53,"close":15.68,"value":15.68,"volumefrom":21.04,"volumeto":329.7,"volume":308.66},{"date":"2017-10-18 07:39:00","open":15.55,"low":15.57,"high":15.51,"close":15.53,"value":15.53,"volumefrom":50.67,"volumeto":791.18,"volume":740.51},{"date":"2017-10-18 07:38:00","open":15.54,"low":15.58,"high":15.51,"close":15.56,"value":15.56,"volumefrom":38.15,"volumeto":594.36,"volume":556.21},{"date":"2017-10-18 07:37:00","open":15.55,"low":15.59,"high":15.52,"close":15.53,"value":15.53,"volumefrom":31.08,"volumeto":483.64,"volume":452.56},{"date":"2017-10-18 07:36:00","open":15.49,"low":15.56,"high":15.45,"close":15.56,"value":15.56,"volumefrom":34.06,"volumeto":530.32,"volume":496.26},{"date":"2017-10-18 07:35:00","open":15.42,"low":15.48,"high":15.41,"close":15.48,"value":15.48,"volumefrom":33.96,"volumeto":524.67,"volume":490.71},{"date":"2017-10-18 07:34:00","open":15.41,"low":15.43,"high":15.4,"close":15.41,"value":15.41,"volumefrom":20.91,"volumeto":321.77,"volume":300.86},{"date":"2017-10-18 07:33:00","open":15.52,"low":15.53,"high":15.38,"close":15.4,"value":15.4,"volumefrom":57.49,"volumeto":882.82,"volume":825.33},{"date":"2017-10-18 07:32:00","open":15.63,"low":15.67,"high":15.52,"close":15.52,"value":15.52,"volumefrom":60.51,"volumeto":938.25,"volume":877.74},{"date":"2017-10-18 07:31:00","open":15.67,"low":15.67,"high":15.6,"close":15.66,"value":15.66,"volumefrom":26.95,"volumeto":418.62,"volume":391.67},{"date":"2017-10-18 07:30:00","open":15.61,"low":15.71,"high":15.6,"close":15.63,"value":15.63,"volumefrom":42.44,"volumeto":666.93,"volume":624.49},{"date":"2017-10-18 07:29:00","open":15.06,"low":15.63,"high":15.06,"close":15.62,"value":15.62,"volumefrom":114.32,"volumeto":1817.05,"volume":1702.73},{"date":"2017-10-18 07:28:00","open":14.96,"low":15.26,"high":14.95,"close":15.26,"value":15.26,"volumefrom":261.83,"volumeto":4063.42,"volume":3801.59},{"date":"2017-10-18 07:27:00","open":14.92,"low":14.95,"high":14.92,"close":14.94,"value":14.94,"volumefrom":110.91,"volumeto":1671.76,"volume":1560.85},{"date":"2017-10-18 07:26:00","open":14.9,"low":14.92,"high":14.9,"close":14.92,"value":14.92,"volumefrom":16.51,"volumeto":246.47,"volume":229.96},{"date":"2017-10-18 07:25:00","open":14.89,"low":14.9,"high":14.89,"close":14.89,"value":14.89,"volumefrom":8.45,"volumeto":125.89,"volume":117.44},{"date":"2017-10-18 07:24:00","open":14.88,"low":14.9,"high":14.88,"close":14.89,"value":14.89,"volumefrom":9.74,"volumeto":145.11,"volume":135.37},{"date":"2017-10-18 07:23:00","open":14.89,"low":14.9,"high":14.88,"close":14.89,"value":14.89,"volumefrom":9.48,"volumeto":141.17,"volume":131.69},{"date":"2017-10-18 07:22:00","open":14.89,"low":14.9,"high":14.88,"close":14.89,"value":14.89,"volumefrom":5.86,"volumeto":87.2,"volume":81.34},{"date":"2017-10-18 07:21:00","open":14.88,"low":14.89,"high":14.87,"close":14.89,"value":14.89,"volumefrom":4.12,"volumeto":61.39,"volume":57.27},{"date":"2017-10-18 07:20:00","open":14.88,"low":14.89,"high":14.88,"close":14.88,"value":14.88,"volumefrom":7.88,"volumeto":117.31,"volume":109.43},{"date":"2017-10-18 07:19:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":3.34,"volumeto":49.78,"volume":46.44},{"date":"2017-10-18 07:18:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":0.4558,"volumeto":6.78,"volume":6.3242},{"date":"2017-10-18 07:17:00","open":14.84,"low":14.86,"high":14.84,"close":14.85,"value":14.85,"volumefrom":10.76,"volumeto":159.82,"volume":149.06},{"date":"2017-10-18 07:16:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":1.07,"volumeto":15.87,"volume":14.8},{"date":"2017-10-18 07:15:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":1.2,"volumeto":17.81,"volume":16.61},{"date":"2017-10-18 07:14:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":2.04,"volumeto":30.31,"volume":28.27},{"date":"2017-10-18 07:13:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":5.54,"volumeto":82.31,"volume":76.77},{"date":"2017-10-18 07:12:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":11.12,"volumeto":165.1,"volume":153.98},{"date":"2017-10-18 07:11:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":0.06119,"volumeto":0.9175,"volume":0.85631},{"date":"2017-10-18 07:10:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":3.73,"volumeto":55.25,"volume":51.52},{"date":"2017-10-18 07:09:00","open":14.81,"low":14.82,"high":14.81,"close":14.82,"value":14.82,"volumefrom":13.13,"volumeto":194.47,"volume":181.34},{"date":"2017-10-18 07:08:00","open":14.81,"low":14.81,"high":14.81,"close":14.81,"value":14.81,"volumefrom":0.02851,"volumeto":0.4223,"volume":0.39379},{"date":"2017-10-18 07:07:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":3.19,"volumeto":47.17,"volume":43.98},{"date":"2017-10-18 07:06:00","open":14.8,"low":14.82,"high":14.8,"close":14.81,"value":14.81,"volumefrom":18.75,"volumeto":277.74,"volume":258.99},{"date":"2017-10-18 07:05:00","open":14.79,"low":14.81,"high":14.79,"close":14.8,"value":14.8,"volumefrom":14.74,"volumeto":218.17,"volume":203.43},{"date":"2017-10-18 07:04:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":0.008011,"volumeto":0.1183,"volume":0.110289},{"date":"2017-10-18 07:03:00","open":14.79,"low":14.79,"high":14.79,"close":14.79,"value":14.79,"volumefrom":0.005247,"volumeto":0.07739,"volume":0.072143},{"date":"2017-10-18 07:02:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":4.09,"volumeto":60.47,"volume":56.38},{"date":"2017-10-18 07:01:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":1.63,"volumeto":24,"volume":22.37},{"date":"2017-10-18 07:00:00","open":14.78,"low":14.79,"high":14.76,"close":14.77,"value":14.77,"volumefrom":20.14,"volumeto":297.29,"volume":277.15},{"date":"2017-10-18 06:59:00","open":14.78,"low":14.78,"high":14.78,"close":14.78,"value":14.78,"volumefrom":2.42,"volumeto":35.69,"volume":33.27},{"date":"2017-10-18 06:58:00","open":14.78,"low":14.78,"high":14.78,"close":14.78,"value":14.78,"volumefrom":0.1615,"volumeto":2.39,"volume":2.2285},{"date":"2017-10-18 06:57:00","open":14.78,"low":14.78,"high":14.78,"close":14.78,"value":14.78,"volumefrom":0.094,"volumeto":1.39,"volume":1.296},{"date":"2017-10-18 06:56:00","open":14.78,"low":14.78,"high":14.78,"close":14.78,"value":14.78,"volumefrom":1.78,"volumeto":26.19,"volume":24.41},{"date":"2017-10-18 06:55:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":8.55,"volumeto":126.54,"volume":117.99},{"date":"2017-10-18 06:54:00","open":14.84,"low":14.84,"high":14.82,"close":14.82,"value":14.82,"volumefrom":14.3,"volumeto":211.87,"volume":197.57},{"date":"2017-10-18 06:53:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":0.1139,"volumeto":1.7,"volume":1.5861},{"date":"2017-10-18 06:52:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":15.92,"volumeto":236.06,"volume":220.14},{"date":"2017-10-18 06:51:00","open":14.88,"low":14.9,"high":14.88,"close":14.88,"value":14.88,"volumefrom":11.22,"volumeto":167.01,"volume":155.79},{"date":"2017-10-18 06:50:00","open":14.88,"low":14.88,"high":14.88,"close":14.88,"value":14.88,"volumefrom":3.24,"volumeto":48.23,"volume":44.99},{"date":"2017-10-18 06:49:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":10.65,"volumeto":158.44,"volume":147.79},{"date":"2017-10-18 06:48:00","open":14.86,"low":14.88,"high":14.86,"close":14.87,"value":14.87,"volumefrom":8.62,"volumeto":128.11,"volume":119.49},{"date":"2017-10-18 06:47:00","open":14.86,"low":14.86,"high":14.86,"close":14.86,"value":14.86,"volumefrom":0.3306,"volumeto":4.91,"volume":4.5794},{"date":"2017-10-18 06:46:00","open":14.84,"low":14.84,"high":14.84,"close":14.84,"value":14.84,"volumefrom":7.29,"volumeto":108.29,"volume":101},{"date":"2017-10-18 06:45:00","open":14.85,"low":14.86,"high":14.85,"close":14.86,"value":14.86,"volumefrom":10.17,"volumeto":151.3,"volume":141.13},{"date":"2017-10-18 06:44:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":0.0001853,"volumeto":0.00277,"volume":0.0025847},{"date":"2017-10-18 06:43:00","open":14.85,"low":14.85,"high":14.85,"close":14.85,"value":14.85,"volumefrom":2.71,"volumeto":40.2,"volume":37.49},{"date":"2017-10-18 06:42:00","open":14.85,"low":14.85,"high":14.84,"close":14.84,"value":14.84,"volumefrom":13.09,"volumeto":194.34,"volume":181.25},{"date":"2017-10-18 06:41:00","open":14.85,"low":14.85,"high":14.85,"close":14.85,"value":14.85,"volumefrom":1.03,"volumeto":15.42,"volume":14.39},{"date":"2017-10-18 06:40:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":16.2,"volumeto":240.32,"volume":224.12},{"date":"2017-10-18 06:39:00","open":14.83,"low":14.84,"high":14.82,"close":14.82,"value":14.82,"volumefrom":19.46,"volumeto":288.6,"volume":269.14},{"date":"2017-10-18 06:38:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":0.005895,"volumeto":0.08722,"volume":0.081325},{"date":"2017-10-18 06:37:00","open":14.81,"low":14.81,"high":14.81,"close":14.81,"value":14.81,"volumefrom":12.32,"volumeto":182.68,"volume":170.36},{"date":"2017-10-18 06:36:00","open":14.82,"low":14.83,"high":14.79,"close":14.81,"value":14.81,"volumefrom":33.6,"volumeto":497.05,"volume":463.45},{"date":"2017-10-18 06:35:00","open":14.84,"low":14.85,"high":14.83,"close":14.83,"value":14.83,"volumefrom":7.37,"volumeto":109.37,"volume":102},{"date":"2017-10-18 06:34:00","open":14.85,"low":14.87,"high":14.84,"close":14.85,"value":14.85,"volumefrom":40.27,"volumeto":597.65,"volume":557.38},{"date":"2017-10-18 06:33:00","open":14.85,"low":14.85,"high":14.85,"close":14.85,"value":14.85,"volumefrom":9.4,"volumeto":139.49,"volume":130.09},{"date":"2017-10-18 06:32:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":6.11,"volumeto":90.7,"volume":84.59},{"date":"2017-10-18 06:31:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":3.01,"volumeto":44.68,"volume":41.67},{"date":"2017-10-18 06:30:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":0.9028,"volumeto":13.38,"volume":12.4772},{"date":"2017-10-18 06:29:00","open":14.83,"low":14.83,"high":14.83,"close":14.83,"value":14.83,"volumefrom":3.3,"volumeto":49.05,"volume":45.75},{"date":"2017-10-18 06:28:00","open":14.82,"low":14.83,"high":14.8,"close":14.81,"value":14.81,"volumefrom":21.67,"volumeto":321.13,"volume":299.46},{"date":"2017-10-18 06:27:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":2.81,"volumeto":41.76,"volume":38.95},{"date":"2017-10-18 06:26:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":2.43,"volumeto":36.13,"volume":33.7},{"date":"2017-10-18 06:25:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":3.67,"volumeto":54.51,"volume":50.84},{"date":"2017-10-18 06:24:00","open":14.82,"low":14.82,"high":14.82,"close":14.82,"value":14.82,"volumefrom":1.43,"volumeto":21.15,"volume":19.72},{"date":"2017-10-18 06:23:00","open":14.75,"low":14.75,"high":14.75,"close":14.75,"value":14.75,"volumefrom":3.54,"volumeto":52.29,"volume":48.75},{"date":"2017-10-18 06:22:00","open":14.76,"low":14.77,"high":14.75,"close":14.77,"value":14.77,"volumefrom":14.4,"volumeto":212.74,"volume":198.34},{"date":"2017-10-18 06:21:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":0.08119,"volumeto":1.2,"volume":1.11881},{"date":"2017-10-18 06:20:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":4.4,"volumeto":64.89,"volume":60.49},{"date":"2017-10-18 06:19:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":4.07,"volumeto":60.22,"volume":56.15},{"date":"2017-10-18 06:18:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":15.5,"volumeto":229.27,"volume":213.77},{"date":"2017-10-18 06:17:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":9.08,"volumeto":134.25,"volume":125.17},{"date":"2017-10-18 06:16:00","open":14.76,"low":14.76,"high":14.76,"close":14.76,"value":14.76,"volumefrom":4.13,"volumeto":60.88,"volume":56.75},{"date":"2017-10-18 06:15:00","open":14.72,"low":14.76,"high":14.72,"close":14.75,"value":14.75,"volumefrom":35.69,"volumeto":526.26,"volume":490.57},{"date":"2017-10-18 06:14:00","open":14.8,"low":14.8,"high":14.8,"close":14.8,"value":14.8,"volumefrom":0.01779,"volumeto":0.2624,"volume":0.24461},{"date":"2017-10-18 06:13:00","open":14.8,"low":14.82,"high":14.72,"close":14.74,"value":14.74,"volumefrom":62.41,"volumeto":919.54,"volume":857.13},{"date":"2017-10-18 06:12:00","open":14.8,"low":14.8,"high":14.8,"close":14.8,"value":14.8,"volumefrom":0.0003149,"volumeto":0.004665,"volume":0.0043501},{"date":"2017-10-18 06:11:00","open":14.76,"low":14.81,"high":14.76,"close":14.78,"value":14.78,"volumefrom":26.33,"volumeto":389.37,"volume":363.04},{"date":"2017-10-18 06:10:00","open":14.8,"low":14.8,"high":14.74,"close":14.76,"value":14.76,"volumefrom":30.46,"volumeto":450.22,"volume":419.76},{"date":"2017-10-18 06:09:00","open":14.78,"low":14.82,"high":14.74,"close":14.8,"value":14.8,"volumefrom":35.29,"volumeto":521.18,"volume":485.89},{"date":"2017-10-18 06:08:00","open":14.77,"low":14.81,"high":14.77,"close":14.78,"value":14.78,"volumefrom":30.19,"volumeto":446.65,"volume":416.46},{"date":"2017-10-18 06:07:00","open":14.78,"low":14.78,"high":14.73,"close":14.76,"value":14.76,"volumefrom":18.36,"volumeto":271.35,"volume":252.99},{"date":"2017-10-18 06:06:00","open":14.8,"low":14.81,"high":14.77,"close":14.78,"value":14.78,"volumefrom":34.06,"volumeto":503.18,"volume":469.12},{"date":"2017-10-18 06:05:00","open":14.8,"low":14.81,"high":14.78,"close":14.8,"value":14.8,"volumefrom":22.94,"volumeto":339.24,"volume":316.3},{"date":"2017-10-18 06:04:00","open":14.8,"low":14.81,"high":14.77,"close":14.78,"value":14.78,"volumefrom":28.51,"volumeto":421.56,"volume":393.05},{"date":"2017-10-18 06:03:00","open":14.79,"low":14.82,"high":14.79,"close":14.8,"value":14.8,"volumefrom":24.66,"volumeto":364.69,"volume":340.03},{"date":"2017-10-18 06:02:00","open":14.8,"low":14.82,"high":14.77,"close":14.8,"value":14.8,"volumefrom":38.2,"volumeto":565.01,"volume":526.81},{"date":"2017-10-18 06:01:00","open":14.81,"low":14.82,"high":14.79,"close":14.8,"value":14.8,"volumefrom":23.15,"volumeto":343.1,"volume":319.95},{"date":"2017-10-18 06:00:00","open":14.82,"low":14.85,"high":14.81,"close":14.81,"value":14.81,"volumefrom":23.11,"volumeto":342.78,"volume":319.67},{"date":"2017-10-18 05:59:00","open":14.81,"low":14.83,"high":14.81,"close":14.82,"value":14.82,"volumefrom":24.25,"volumeto":359.36,"volume":335.11},{"date":"2017-10-18 05:58:00","open":14.82,"low":14.83,"high":14.8,"close":14.83,"value":14.83,"volumefrom":39.23,"volumeto":581.34,"volume":542.11},{"date":"2017-10-18 05:57:00","open":14.86,"low":14.89,"high":14.81,"close":14.82,"value":14.82,"volumefrom":27.49,"volumeto":407.57,"volume":380.08},{"date":"2017-10-18 05:56:00","open":14.87,"low":14.88,"high":14.85,"close":14.88,"value":14.88,"volumefrom":44.57,"volumeto":661.5,"volume":616.93},{"date":"2017-10-18 05:55:00","open":14.86,"low":14.87,"high":14.86,"close":14.87,"value":14.87,"volumefrom":23.71,"volumeto":352.91,"volume":329.2},{"date":"2017-10-18 05:54:00","open":14.86,"low":14.88,"high":14.85,"close":14.86,"value":14.86,"volumefrom":34.99,"volumeto":520.48,"volume":485.49},{"date":"2017-10-18 05:53:00","open":14.86,"low":14.87,"high":14.85,"close":14.85,"value":14.85,"volumefrom":27.11,"volumeto":403.36,"volume":376.25},{"date":"2017-10-18 05:52:00","open":14.86,"low":14.87,"high":14.85,"close":14.87,"value":14.87,"volumefrom":20.41,"volumeto":303.48,"volume":283.07},{"date":"2017-10-18 05:51:00","open":14.88,"low":14.89,"high":14.85,"close":14.86,"value":14.86,"volumefrom":29.08,"volumeto":432.19,"volume":403.11},{"date":"2017-10-18 05:50:00","open":14.88,"low":14.9,"high":14.88,"close":14.89,"value":14.89,"volumefrom":30.28,"volumeto":450.95,"volume":420.67},{"date":"2017-10-18 05:49:00","open":14.89,"low":14.91,"high":14.87,"close":14.88,"value":14.88,"volumefrom":16.52,"volumeto":245.81,"volume":229.29},{"date":"2017-10-18 05:48:00","open":14.92,"low":14.92,"high":14.89,"close":14.89,"value":14.89,"volumefrom":12.65,"volumeto":188.52,"volume":175.87},{"date":"2017-10-18 05:47:00","open":14.9,"low":14.92,"high":14.89,"close":14.9,"value":14.9,"volumefrom":13.65,"volumeto":203.58,"volume":189.93},{"date":"2017-10-18 05:46:00","open":14.89,"low":14.91,"high":14.89,"close":14.9,"value":14.9,"volumefrom":20.07,"volumeto":299.57,"volume":279.5},{"date":"2017-10-18 05:45:00","open":14.89,"low":14.9,"high":14.89,"close":14.89,"value":14.89,"volumefrom":28.71,"volumeto":428.39,"volume":399.68},{"date":"2017-10-18 05:44:00","open":14.88,"low":14.91,"high":14.88,"close":14.89,"value":14.89,"volumefrom":27.5,"volumeto":409.86,"volume":382.36},{"date":"2017-10-18 05:43:00","open":14.89,"low":14.9,"high":14.88,"close":14.88,"value":14.88,"volumefrom":31.73,"volumeto":473.04,"volume":441.31},{"date":"2017-10-18 05:42:00","open":14.87,"low":14.9,"high":14.87,"close":14.9,"value":14.9,"volumefrom":34.65,"volumeto":516.64,"volume":481.99},{"date":"2017-10-18 05:41:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":13.12,"volumeto":195.61,"volume":182.49},{"date":"2017-10-18 05:40:00","open":14.87,"low":14.87,"high":14.87,"close":14.87,"value":14.87,"volumefrom":1.04,"volumeto":15.49,"volume":14.45},{"date":"2017-10-18 05:39:00","open":14.9,"low":14.9,"high":14.9,"close":14.9,"value":14.9,"volumefrom":0.001995,"volumeto":0.02977,"volume":0.027775},{"date":"2017-10-18 05:38:00","open":14.89,"low":14.89,"high":14.89,"close":14.89,"value":14.89,"volumefrom":3.23,"volumeto":48.15,"volume":44.92},{"date":"2017-10-18 05:37:00","open":14.91,"low":14.91,"high":14.89,"close":14.9,"value":14.9,"volumefrom":18.18,"volumeto":271.13,"volume":252.95},{"date":"2017-10-18 05:36:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":0.4422,"volumeto":6.59,"volume":6.1478},{"date":"2017-10-18 05:35:00","open":14.9,"low":14.9,"high":14.9,"close":14.9,"value":14.9,"volumefrom":0.7356,"volumeto":10.97,"volume":10.2344},{"date":"2017-10-18 05:34:00","open":14.9,"low":14.9,"high":14.9,"close":14.9,"value":14.9,"volumefrom":0.002666,"volumeto":0.04,"volume":0.037334},{"date":"2017-10-18 05:33:00","open":14.94,"low":14.94,"high":14.92,"close":14.92,"value":14.92,"volumefrom":15.28,"volumeto":228.11,"volume":212.83},{"date":"2017-10-18 05:32:00","open":14.95,"low":14.95,"high":14.95,"close":14.95,"value":14.95,"volumefrom":14.35,"volumeto":214.56,"volume":200.21},{"date":"2017-10-18 05:31:00","open":14.97,"low":14.97,"high":14.95,"close":14.95,"value":14.95,"volumefrom":12.57,"volumeto":188.27,"volume":175.7},{"date":"2017-10-18 05:30:00","open":14.97,"low":14.97,"high":14.96,"close":14.97,"value":14.97,"volumefrom":22.23,"volumeto":332.8,"volume":310.57},{"date":"2017-10-18 05:29:00","open":14.93,"low":14.96,"high":14.93,"close":14.96,"value":14.96,"volumefrom":35.58,"volumeto":532.73,"volume":497.15},{"date":"2017-10-18 05:28:00","open":14.91,"low":14.93,"high":14.91,"close":14.93,"value":14.93,"volumefrom":25.26,"volumeto":377.4,"volume":352.14},{"date":"2017-10-18 05:27:00","open":14.91,"low":14.92,"high":14.9,"close":14.91,"value":14.91,"volumefrom":30.16,"volumeto":450.03,"volume":419.87},{"date":"2017-10-18 05:26:00","open":14.91,"low":14.92,"high":14.9,"close":14.91,"value":14.91,"volumefrom":13.28,"volumeto":198.33,"volume":185.05},{"date":"2017-10-18 05:25:00","open":14.93,"low":14.94,"high":14.9,"close":14.91,"value":14.91,"volumefrom":20.48,"volumeto":305.79,"volume":285.31},{"date":"2017-10-18 05:24:00","open":14.88,"low":14.95,"high":14.86,"close":14.93,"value":14.93,"volumefrom":17.58,"volumeto":262.54,"volume":244.96},{"date":"2017-10-18 05:23:00","open":14.9,"low":14.9,"high":14.9,"close":14.9,"value":14.9,"volumefrom":0.07239,"volumeto":1.07,"volume":0.99761},{"date":"2017-10-18 05:22:00","open":14.83,"low":14.87,"high":14.78,"close":14.83,"value":14.83,"volumefrom":19.19,"volumeto":284.7,"volume":265.51},{"date":"2017-10-18 05:21:00","open":14.84,"low":14.84,"high":14.79,"close":14.81,"value":14.81,"volumefrom":33.71,"volumeto":500.09,"volume":466.38},{"date":"2017-10-18 05:20:00","open":14.78,"low":14.81,"high":14.74,"close":14.78,"value":14.78,"volumefrom":28.43,"volumeto":419.12,"volume":390.69},{"date":"2017-10-18 05:19:00","open":14.75,"low":14.78,"high":14.74,"close":14.78,"value":14.78,"volumefrom":37.63,"volumeto":555.18,"volume":517.55},{"date":"2017-10-18 05:18:00","open":14.76,"low":14.76,"high":14.75,"close":14.75,"value":14.75,"volumefrom":12.35,"volumeto":182.12,"volume":169.77},{"date":"2017-10-18 05:17:00","open":14.76,"low":14.77,"high":14.74,"close":14.75,"value":14.75,"volumefrom":26.09,"volumeto":384.6,"volume":358.51},{"date":"2017-10-18 05:16:00","open":14.78,"low":14.79,"high":14.76,"close":14.76,"value":14.76,"volumefrom":31.25,"volumeto":461.47,"volume":430.22},{"date":"2017-10-18 05:15:00","open":14.79,"low":14.8,"high":14.73,"close":14.76,"value":14.76,"volumefrom":20.47,"volumeto":302.66,"volume":282.19},{"date":"2017-10-18 05:14:00","open":14.78,"low":14.8,"high":14.78,"close":14.78,"value":14.78,"volumefrom":16.8,"volumeto":248.44,"volume":231.64},{"date":"2017-10-18 05:13:00","open":14.78,"low":14.8,"high":14.76,"close":14.78,"value":14.78,"volumefrom":19.5,"volumeto":288.42,"volume":268.92},{"date":"2017-10-18 05:12:00","open":14.81,"low":14.82,"high":14.78,"close":14.79,"value":14.79,"volumefrom":27.5,"volumeto":407.05,"volume":379.55},{"date":"2017-10-18 05:11:00","open":14.82,"low":14.83,"high":14.81,"close":14.81,"value":14.81,"volumefrom":25.15,"volumeto":372.79,"volume":347.64},{"date":"2017-10-18 05:10:00","open":14.84,"low":14.84,"high":14.81,"close":14.82,"value":14.82,"volumefrom":24.57,"volumeto":364.72,"volume":340.15},{"date":"2017-10-18 05:09:00","open":14.84,"low":14.86,"high":14.82,"close":14.84,"value":14.84,"volumefrom":15.05,"volumeto":223.71,"volume":208.66},{"date":"2017-10-18 05:08:00","open":14.9,"low":14.9,"high":14.84,"close":14.84,"value":14.84,"volumefrom":16.94,"volumeto":250.87,"volume":233.93},{"date":"2017-10-18 05:07:00","open":14.95,"low":14.95,"high":14.9,"close":14.91,"value":14.91,"volumefrom":16.65,"volumeto":248,"volume":231.35},{"date":"2017-10-18 05:06:00","open":14.98,"low":14.98,"high":14.95,"close":14.97,"value":14.97,"volumefrom":35.68,"volumeto":533.2,"volume":497.52},{"date":"2017-10-18 05:05:00","open":15,"low":15.02,"high":14.98,"close":14.98,"value":14.98,"volumefrom":16.01,"volumeto":239.72,"volume":223.71},{"date":"2017-10-18 05:04:00","open":15.03,"low":15.03,"high":14.99,"close":15,"value":15,"volumefrom":7.16,"volumeto":107.45,"volume":100.29},{"date":"2017-10-18 05:03:00","open":15.06,"low":15.08,"high":15.03,"close":15.03,"value":15.03,"volumefrom":7.15,"volumeto":107.55,"volume":100.4},{"date":"2017-10-18 05:02:00","open":15.12,"low":15.14,"high":15.06,"close":15.06,"value":15.06,"volumefrom":4.55,"volumeto":68.56,"volume":64.01},{"date":"2017-10-18 05:01:00","open":15.18,"low":15.19,"high":15.11,"close":15.14,"value":15.14,"volumefrom":12.26,"volumeto":185.46,"volume":173.2},{"date":"2017-10-18 05:00:00","open":15.22,"low":15.22,"high":15.18,"close":15.19,"value":15.19,"volumefrom":7.4,"volumeto":112.32,"volume":104.92},{"date":"2017-10-18 04:59:00","open":15.2,"low":15.23,"high":15.2,"close":15.23,"value":15.23,"volumefrom":7.33,"volumeto":111.59,"volume":104.26},{"date":"2017-10-18 04:58:00","open":15.21,"low":15.21,"high":15.19,"close":15.2,"value":15.2,"volumefrom":9.29,"volumeto":141.6,"volume":132.31},{"date":"2017-10-18 04:57:00","open":15.21,"low":15.23,"high":15.21,"close":15.21,"value":15.21,"volumefrom":4.64,"volumeto":70.17,"volume":65.53},{"date":"2017-10-18 04:56:00","open":15.22,"low":15.23,"high":15.2,"close":15.22,"value":15.22,"volumefrom":7.39,"volumeto":112.36,"volume":104.97},{"date":"2017-10-18 04:55:00","open":15.22,"low":15.23,"high":15.22,"close":15.22,"value":15.22,"volumefrom":5.15,"volumeto":78.48,"volume":73.33},{"date":"2017-10-18 04:54:00","open":15.22,"low":15.23,"high":15.22,"close":15.23,"value":15.23,"volumefrom":4.35,"volumeto":65.8,"volume":61.45},{"date":"2017-10-18 04:53:00","open":15.21,"low":15.23,"high":15.2,"close":15.22,"value":15.22,"volumefrom":4.76,"volumeto":72.46,"volume":67.7},{"date":"2017-10-18 04:52:00","open":15.22,"low":15.24,"high":15.2,"close":15.21,"value":15.21,"volumefrom":4.62,"volumeto":70.28,"volume":65.66},{"date":"2017-10-18 04:51:00","open":15.22,"low":15.23,"high":15.19,"close":15.23,"value":15.23,"volumefrom":15.89,"volumeto":242.97,"volume":227.08},{"date":"2017-10-18 04:50:00","open":15.22,"low":15.23,"high":15.21,"close":15.22,"value":15.22,"volumefrom":6.07,"volumeto":91.99,"volume":85.92},{"date":"2017-10-18 04:49:00","open":15.23,"low":15.23,"high":15.22,"close":15.22,"value":15.22,"volumefrom":3.69,"volumeto":56.18,"volume":52.49},{"date":"2017-10-18 04:48:00","open":15.22,"low":15.22,"high":15.21,"close":15.21,"value":15.21,"volumefrom":5.97,"volumeto":90.8,"volume":84.83},{"date":"2017-10-18 04:47:00","open":15.2,"low":15.22,"high":15.2,"close":15.22,"value":15.22,"volumefrom":6.8,"volumeto":103.15,"volume":96.35},{"date":"2017-10-18 04:46:00","open":15.21,"low":15.21,"high":15.2,"close":15.21,"value":15.21,"volumefrom":7.77,"volumeto":118.15,"volume":110.38},{"date":"2017-10-18 04:45:00","open":15.2,"low":15.21,"high":15.2,"close":15.2,"value":15.2,"volumefrom":14.6,"volumeto":221.86,"volume":207.26},{"date":"2017-10-18 04:44:00","open":15.2,"low":15.2,"high":15.2,"close":15.2,"value":15.2,"volumefrom":11.55,"volumeto":175.76,"volume":164.21},{"date":"2017-10-18 04:43:00","open":15.2,"low":15.21,"high":15.19,"close":15.2,"value":15.2,"volumefrom":9.1,"volumeto":138.24,"volume":129.14},{"date":"2017-10-18 04:42:00","open":15.18,"low":15.21,"high":15.18,"close":15.2,"value":15.2,"volumefrom":15.99,"volumeto":243.1,"volume":227.11},{"date":"2017-10-18 04:41:00","open":15.18,"low":15.19,"high":15.17,"close":15.17,"value":15.17,"volumefrom":6.33,"volumeto":96.14,"volume":89.81},{"date":"2017-10-18 04:40:00","open":15.17,"low":15.18,"high":15.17,"close":15.18,"value":15.18,"volumefrom":9.43,"volumeto":143.17,"volume":133.74},{"date":"2017-10-18 04:39:00","open":15.18,"low":15.19,"high":15.17,"close":15.17,"value":15.17,"volumefrom":12.2,"volumeto":185.15,"volume":172.95},{"date":"2017-10-18 04:38:00","open":15.2,"low":15.21,"high":15.19,"close":15.19,"value":15.19,"volumefrom":8.04,"volumeto":122.24,"volume":114.2},{"date":"2017-10-18 04:37:00","open":15.2,"low":15.21,"high":15.2,"close":15.2,"value":15.2,"volumefrom":11.54,"volumeto":175.34,"volume":163.8},{"date":"2017-10-18 04:36:00","open":15.23,"low":15.24,"high":15.21,"close":15.21,"value":15.21,"volumefrom":10.5,"volumeto":159.52,"volume":149.02},{"date":"2017-10-18 04:35:00","open":15.22,"low":15.24,"high":15.21,"close":15.23,"value":15.23,"volumefrom":12.58,"volumeto":191.06,"volume":178.48},{"date":"2017-10-18 04:34:00","open":15.23,"low":15.23,"high":15.23,"close":15.23,"value":15.23,"volumefrom":6.9,"volumeto":105,"volume":98.1},{"date":"2017-10-18 04:33:00","open":15.24,"low":15.24,"high":15.23,"close":15.23,"value":15.23,"volumefrom":3.37,"volumeto":51.27,"volume":47.9},{"date":"2017-10-18 04:32:00","open":15.21,"low":15.23,"high":15.21,"close":15.23,"value":15.23,"volumefrom":5.43,"volumeto":82.66,"volume":77.23},{"date":"2017-10-18 04:31:00","open":15.24,"low":15.24,"high":15.21,"close":15.23,"value":15.23,"volumefrom":2.97,"volumeto":45.13,"volume":42.16},{"date":"2017-10-18 04:30:00","open":15.22,"low":15.22,"high":15.21,"close":15.22,"value":15.22,"volumefrom":4.5,"volumeto":68.4,"volume":63.9},{"date":"2017-10-18 04:29:00","open":15.24,"low":15.25,"high":15.23,"close":15.23,"value":15.23,"volumefrom":5.35,"volumeto":81.34,"volume":75.99},{"date":"2017-10-18 04:28:00","open":15.24,"low":15.26,"high":15.24,"close":15.24,"value":15.24,"volumefrom":6.13,"volumeto":93.17,"volume":87.04},{"date":"2017-10-18 04:27:00","open":15.26,"low":15.26,"high":15.23,"close":15.25,"value":15.25,"volumefrom":4.19,"volumeto":63.74,"volume":59.55},{"date":"2017-10-18 04:26:00","open":15.24,"low":15.25,"high":15.24,"close":15.25,"value":15.25,"volumefrom":5.34,"volumeto":81.11,"volume":75.77},{"date":"2017-10-18 04:25:00","open":15.24,"low":15.25,"high":15.24,"close":15.25,"value":15.25,"volumefrom":6.12,"volumeto":93.33,"volume":87.21},{"date":"2017-10-18 04:24:00","open":15.23,"low":15.25,"high":15.23,"close":15.24,"value":15.24,"volumefrom":6.53,"volumeto":99.59,"volume":93.06},{"date":"2017-10-18 04:23:00","open":15.23,"low":15.24,"high":15.23,"close":15.23,"value":15.23,"volumefrom":7.37,"volumeto":112.36,"volume":104.99},{"date":"2017-10-18 04:22:00","open":15.24,"low":15.24,"high":15.23,"close":15.23,"value":15.23,"volumefrom":7.27,"volumeto":110.84,"volume":103.57},{"date":"2017-10-18 04:21:00","open":15.24,"low":15.25,"high":15.23,"close":15.23,"value":15.23,"volumefrom":9.44,"volumeto":143.95,"volume":134.51},{"date":"2017-10-18 04:20:00","open":15.27,"low":15.27,"high":15.24,"close":15.24,"value":15.24,"volumefrom":8.65,"volumeto":132.03,"volume":123.38},{"date":"2017-10-18 04:19:00","open":15.26,"low":15.28,"high":15.25,"close":15.28,"value":15.28,"volumefrom":10.68,"volumeto":163.16,"volume":152.48},{"date":"2017-10-18 04:18:00","open":15.27,"low":15.28,"high":15.25,"close":15.26,"value":15.26,"volumefrom":7.9,"volumeto":120.72,"volume":112.82},{"date":"2017-10-18 04:17:00","open":15.28,"low":15.28,"high":15.26,"close":15.26,"value":15.26,"volumefrom":5.45,"volumeto":83.38,"volume":77.93},{"date":"2017-10-18 04:16:00","open":15.28,"low":15.29,"high":15.27,"close":15.28,"value":15.28,"volumefrom":1.72,"volumeto":26.33,"volume":24.61},{"date":"2017-10-18 04:15:00","open":15.3,"low":15.31,"high":15.27,"close":15.28,"value":15.28,"volumefrom":6.66,"volumeto":101.83,"volume":95.17},{"date":"2017-10-18 04:14:00","open":15.32,"low":15.33,"high":15.27,"close":15.3,"value":15.3,"volumefrom":9.18,"volumeto":140.57,"volume":131.39},{"date":"2017-10-18 04:13:00","open":15.31,"low":15.33,"high":15.3,"close":15.33,"value":15.33,"volumefrom":9.53,"volumeto":145.68,"volume":136.15},{"date":"2017-10-18 04:12:00","open":15.29,"low":15.33,"high":15.22,"close":15.31,"value":15.31,"volumefrom":21.55,"volumeto":331.01,"volume":309.46},{"date":"2017-10-18 04:11:00","open":15.2,"low":15.26,"high":15.19,"close":15.26,"value":15.26,"volumefrom":44.93,"volumeto":686.39,"volume":641.46},{"date":"2017-10-18 04:10:00","open":15.18,"low":15.26,"high":15.18,"close":15.2,"value":15.2,"volumefrom":11.41,"volumeto":173.73,"volume":162.32},{"date":"2017-10-18 04:09:00","open":15.19,"low":15.19,"high":15.17,"close":15.18,"value":15.18,"volumefrom":9.18,"volumeto":139.56,"volume":130.38},{"date":"2017-10-18 04:08:00","open":15.19,"low":15.2,"high":15.18,"close":15.19,"value":15.19,"volumefrom":8.99,"volumeto":136.39,"volume":127.4},{"date":"2017-10-18 04:07:00","open":15.17,"low":15.2,"high":15.17,"close":15.2,"value":15.2,"volumefrom":8.15,"volumeto":123.87,"volume":115.72},{"date":"2017-10-18 04:06:00","open":15.19,"low":15.2,"high":15.17,"close":15.17,"value":15.17,"volumefrom":4.85,"volumeto":73.66,"volume":68.81},{"date":"2017-10-18 04:05:00","open":15.18,"low":15.2,"high":15.17,"close":15.17,"value":15.17,"volumefrom":3.55,"volumeto":53.99,"volume":50.44},{"date":"2017-10-18 04:04:00","open":15.2,"low":15.2,"high":15.18,"close":15.18,"value":15.18,"volumefrom":4.29,"volumeto":65.17,"volume":60.88},{"date":"2017-10-18 04:03:00","open":15.24,"low":15.25,"high":15.19,"close":15.24,"value":15.24,"volumefrom":4.21,"volumeto":64.11,"volume":59.9},{"date":"2017-10-18 04:02:00","open":15.27,"low":15.27,"high":15.2,"close":15.24,"value":15.24,"volumefrom":3.97,"volumeto":60.5,"volume":56.53},{"date":"2017-10-18 04:01:00","open":15.27,"low":15.29,"high":15.26,"close":15.27,"value":15.27,"volumefrom":8.92,"volumeto":136.21,"volume":127.29},{"date":"2017-10-18 04:00:00","open":15.25,"low":15.29,"high":15.25,"close":15.26,"value":15.26,"volumefrom":5.29,"volumeto":80.78,"volume":75.49},{"date":"2017-10-18 03:59:00","open":15.26,"low":15.27,"high":15.24,"close":15.25,"value":15.25,"volumefrom":2.75,"volumeto":41.93,"volume":39.18},{"date":"2017-10-18 03:58:00","open":15.26,"low":15.27,"high":15.24,"close":15.27,"value":15.27,"volumefrom":2.71,"volumeto":41.22,"volume":38.51},{"date":"2017-10-18 03:57:00","open":15.27,"low":15.27,"high":15.23,"close":15.23,"value":15.23,"volumefrom":2.63,"volumeto":40.19,"volume":37.56},{"date":"2017-10-18 03:56:00","open":15.24,"low":15.27,"high":15.22,"close":15.27,"value":15.27,"volumefrom":12.9,"volumeto":197.3,"volume":184.4},{"date":"2017-10-18 03:55:00","open":15.18,"low":15.25,"high":15.18,"close":15.24,"value":15.24,"volumefrom":11.61,"volumeto":177.13,"volume":165.52},{"date":"2017-10-18 03:54:00","open":15.19,"low":15.22,"high":15.18,"close":15.18,"value":15.18,"volumefrom":12.96,"volumeto":197.69,"volume":184.73},{"date":"2017-10-18 03:53:00","open":15.19,"low":15.21,"high":15.18,"close":15.18,"value":15.18,"volumefrom":9.82,"volumeto":149.33,"volume":139.51},{"date":"2017-10-18 03:52:00","open":15.14,"low":15.21,"high":15.14,"close":15.2,"value":15.2,"volumefrom":11.98,"volumeto":182.19,"volume":170.21},{"date":"2017-10-18 03:51:00","open":15.17,"low":15.18,"high":15.14,"close":15.14,"value":15.14,"volumefrom":7.29,"volumeto":110.65,"volume":103.36},{"date":"2017-10-18 03:50:00","open":15.17,"low":15.2,"high":15.15,"close":15.15,"value":15.15,"volumefrom":9.47,"volumeto":143.63,"volume":134.16},{"date":"2017-10-18 03:49:00","open":15.19,"low":15.2,"high":15.17,"close":15.17,"value":15.17,"volumefrom":8.93,"volumeto":135.44,"volume":126.51},{"date":"2017-10-18 03:48:00","open":15.18,"low":15.2,"high":15.18,"close":15.19,"value":15.19,"volumefrom":5.21,"volumeto":79.04,"volume":73.83},{"date":"2017-10-18 03:47:00","open":15.19,"low":15.19,"high":15.15,"close":15.16,"value":15.16,"volumefrom":9.13,"volumeto":138.57,"volume":129.44},{"date":"2017-10-18 03:46:00","open":15.21,"low":15.23,"high":15.16,"close":15.19,"value":15.19,"volumefrom":15.72,"volumeto":238.37,"volume":222.65},{"date":"2017-10-18 03:45:00","open":15.23,"low":15.25,"high":15.18,"close":15.21,"value":15.21,"volumefrom":9.74,"volumeto":148.05,"volume":138.31},{"date":"2017-10-18 03:44:00","open":15.28,"low":15.28,"high":15.22,"close":15.24,"value":15.24,"volumefrom":18.41,"volumeto":279.81,"volume":261.4},{"date":"2017-10-18 03:43:00","open":15.3,"low":15.3,"high":15.25,"close":15.26,"value":15.26,"volumefrom":11.86,"volumeto":181.18,"volume":169.32},{"date":"2017-10-18 03:42:00","open":15.3,"low":15.31,"high":15.29,"close":15.3,"value":15.3,"volumefrom":12.76,"volumeto":195.33,"volume":182.57},{"date":"2017-10-18 03:41:00","open":15.29,"low":15.33,"high":15.29,"close":15.32,"value":15.32,"volumefrom":16.5,"volumeto":252.96,"volume":236.46},{"date":"2017-10-18 03:40:00","open":15.29,"low":15.35,"high":15.29,"close":15.29,"value":15.29,"volumefrom":7.83,"volumeto":119.84,"volume":112.01},{"date":"2017-10-18 03:39:00","open":15.29,"low":15.29,"high":15.29,"close":15.29,"value":15.29,"volumefrom":4.19,"volumeto":64.01,"volume":59.82},{"date":"2017-10-18 03:38:00","open":15.29,"low":15.29,"high":15.28,"close":15.29,"value":15.29,"volumefrom":4,"volumeto":61.3,"volume":57.3},{"date":"2017-10-18 03:37:00","open":15.28,"low":15.31,"high":15.28,"close":15.29,"value":15.29,"volumefrom":7.19,"volumeto":110.21,"volume":103.02},{"date":"2017-10-18 03:36:00","open":15.29,"low":15.3,"high":15.28,"close":15.28,"value":15.28,"volumefrom":2.36,"volumeto":36,"volume":33.64},{"date":"2017-10-18 03:35:00","open":15.26,"low":15.29,"high":15.26,"close":15.29,"value":15.29,"volumefrom":6.96,"volumeto":106.03,"volume":99.07},{"date":"2017-10-18 03:34:00","open":15.23,"low":15.28,"high":15.23,"close":15.26,"value":15.26,"volumefrom":5.01,"volumeto":76.62,"volume":71.61},{"date":"2017-10-18 03:33:00","open":15.26,"low":15.26,"high":15.23,"close":15.23,"value":15.23,"volumefrom":4.02,"volumeto":61.35,"volume":57.33},{"date":"2017-10-18 03:32:00","open":15.26,"low":15.26,"high":15.23,"close":15.24,"value":15.24,"volumefrom":57.22,"volumeto":879.65,"volume":822.43},{"date":"2017-10-18 03:31:00","open":15.26,"low":15.26,"high":15.21,"close":15.23,"value":15.23,"volumefrom":0.6665,"volumeto":10.17,"volume":9.5035},{"date":"2017-10-18 03:30:00","open":15.25,"low":15.26,"high":15.25,"close":15.26,"value":15.26,"volumefrom":0.9604,"volumeto":14.62,"volume":13.6596},{"date":"2017-10-18 03:29:00","open":15.24,"low":15.25,"high":15.24,"close":15.25,"value":15.25,"volumefrom":2.88,"volumeto":43.97,"volume":41.09},{"date":"2017-10-18 03:28:00","open":15.26,"low":15.27,"high":15.21,"close":15.21,"value":15.21,"volumefrom":0.3432,"volumeto":5.22,"volume":4.8768},{"date":"2017-10-18 03:27:00","open":15.21,"low":15.26,"high":15.19,"close":15.26,"value":15.26,"volumefrom":2.36,"volumeto":36,"volume":33.64},{"date":"2017-10-18 03:26:00","open":15.2,"low":15.22,"high":15.2,"close":15.21,"value":15.21,"volumefrom":0.9211,"volumeto":13.93,"volume":13.0089},{"date":"2017-10-18 03:25:00","open":15.26,"low":15.28,"high":15.2,"close":15.2,"value":15.2,"volumefrom":4.26,"volumeto":64.38,"volume":60.12},{"date":"2017-10-18 03:24:00","open":15.27,"low":15.28,"high":15.25,"close":15.26,"value":15.26,"volumefrom":3.44,"volumeto":52.41,"volume":48.97},{"date":"2017-10-18 03:23:00","open":15.27,"low":15.28,"high":15.27,"close":15.28,"value":15.28,"volumefrom":7.41,"volumeto":113.37,"volume":105.96},{"date":"2017-10-18 03:22:00","open":15.26,"low":15.27,"high":15.24,"close":15.27,"value":15.27,"volumefrom":1.92,"volumeto":29.3,"volume":27.38},{"date":"2017-10-18 03:21:00","open":15.3,"low":15.3,"high":15.24,"close":15.27,"value":15.27,"volumefrom":7.57,"volumeto":115.84,"volume":108.27},{"date":"2017-10-18 03:20:00","open":15.3,"low":15.31,"high":15.23,"close":15.3,"value":15.3,"volumefrom":12.01,"volumeto":183.96,"volume":171.95},{"date":"2017-10-18 03:19:00","open":15.14,"low":15.46,"high":15.14,"close":15.3,"value":15.3,"volumefrom":17.99,"volumeto":276.25,"volume":258.26},{"date":"2017-10-18 03:18:00","open":15.13,"low":15.31,"high":15.1,"close":15.31,"value":15.31,"volumefrom":22.43,"volumeto":342.55,"volume":320.12},{"date":"2017-10-18 03:17:00","open":15.09,"low":15.12,"high":15.07,"close":15.08,"value":15.08,"volumefrom":9.16,"volumeto":138.51,"volume":129.35},{"date":"2017-10-18 03:16:00","open":15.03,"low":15.07,"high":15.03,"close":15.07,"value":15.07,"volumefrom":7.41,"volumeto":111.51,"volume":104.1},{"date":"2017-10-18 03:15:00","open":14.99,"low":15.04,"high":14.98,"close":15.02,"value":15.02,"volumefrom":12.78,"volumeto":192.09,"volume":179.31},{"date":"2017-10-18 03:14:00","open":14.98,"low":15,"high":14.98,"close":14.99,"value":14.99,"volumefrom":17.81,"volumeto":267.07,"volume":249.26},{"date":"2017-10-18 03:13:00","open":14.99,"low":15,"high":14.97,"close":14.98,"value":14.98,"volumefrom":21.18,"volumeto":317.66,"volume":296.48},{"date":"2017-10-18 03:12:00","open":15,"low":15.01,"high":14.97,"close":14.99,"value":14.99,"volumefrom":25.23,"volumeto":378.41,"volume":353.18},{"date":"2017-10-18 03:11:00","open":14.99,"low":15.02,"high":14.98,"close":15.01,"value":15.01,"volumefrom":24.48,"volumeto":366.9,"volume":342.42},{"date":"2017-10-18 03:10:00","open":15.02,"low":15.02,"high":14.98,"close":14.99,"value":14.99,"volumefrom":6,"volumeto":89.85,"volume":83.85},{"date":"2017-10-18 03:09:00","open":15.02,"low":15.02,"high":15,"close":15.02,"value":15.02,"volumefrom":12.22,"volumeto":183.48,"volume":171.26},{"date":"2017-10-18 03:08:00","open":15.04,"low":15.05,"high":15.01,"close":15.03,"value":15.03,"volumefrom":23.52,"volumeto":353.65,"volume":330.13},{"date":"2017-10-18 03:07:00","open":15.08,"low":15.08,"high":15.02,"close":15.02,"value":15.02,"volumefrom":14.05,"volumeto":210.92,"volume":196.87},{"date":"2017-10-18 03:06:00","open":15.17,"low":15.17,"high":15.08,"close":15.08,"value":15.08,"volumefrom":48.03,"volumeto":722.02,"volume":673.99},{"date":"2017-10-18 03:05:00","open":15.19,"low":15.19,"high":15.18,"close":15.18,"value":15.18,"volumefrom":0.4056,"volumeto":6.15,"volume":5.7444},{"date":"2017-10-18 03:04:00","open":15.21,"low":15.21,"high":15.18,"close":15.19,"value":15.19,"volumefrom":10.96,"volumeto":166.59,"volume":155.63},{"date":"2017-10-18 03:03:00","open":15.21,"low":15.21,"high":15.2,"close":15.2,"value":15.2,"volumefrom":13.33,"volumeto":202.82,"volume":189.49},{"date":"2017-10-18 03:02:00","open":15.22,"low":15.23,"high":15.21,"close":15.22,"value":15.22,"volumefrom":15.51,"volumeto":235.97,"volume":220.46},{"date":"2017-10-18 03:01:00","open":15.23,"low":15.23,"high":15.19,"close":15.21,"value":15.21,"volumefrom":12.81,"volumeto":195.15,"volume":182.34},{"date":"2017-10-18 03:00:00","open":15.27,"low":15.27,"high":15.23,"close":15.23,"value":15.23,"volumefrom":7.18,"volumeto":109.58,"volume":102.4},{"date":"2017-10-18 02:59:00","open":15.26,"low":15.28,"high":15.25,"close":15.28,"value":15.28,"volumefrom":6.23,"volumeto":95.22,"volume":88.99},{"date":"2017-10-18 02:58:00","open":15.25,"low":15.27,"high":15.25,"close":15.26,"value":15.26,"volumefrom":5.2,"volumeto":79.53,"volume":74.33},{"date":"2017-10-18 02:57:00","open":15.21,"low":15.26,"high":15.21,"close":15.25,"value":15.25,"volumefrom":3.6,"volumeto":55,"volume":51.4},{"date":"2017-10-18 02:56:00","open":15.18,"low":15.21,"high":15.17,"close":15.21,"value":15.21,"volumefrom":8.3,"volumeto":126.43,"volume":118.13},{"date":"2017-10-18 02:55:00","open":15.18,"low":15.22,"high":15.16,"close":15.17,"value":15.17,"volumefrom":7.76,"volumeto":118,"volume":110.24},{"date":"2017-10-18 02:54:00","open":15.14,"low":15.22,"high":15.13,"close":15.18,"value":15.18,"volumefrom":2.26,"volumeto":34.41,"volume":32.15},{"date":"2017-10-18 02:53:00","open":15.09,"low":15.17,"high":15.09,"close":15.14,"value":15.14,"volumefrom":5.57,"volumeto":84.56,"volume":78.99},{"date":"2017-10-18 02:52:00","open":15.09,"low":15.12,"high":15.08,"close":15.12,"value":15.12,"volumefrom":5.23,"volumeto":79.18,"volume":73.95},{"date":"2017-10-18 02:51:00","open":15.08,"low":15.1,"high":15.07,"close":15.1,"value":15.1,"volumefrom":5.78,"volumeto":87.46,"volume":81.68},{"date":"2017-10-18 02:50:00","open":15.1,"low":15.1,"high":15.07,"close":15.09,"value":15.09,"volumefrom":7.43,"volumeto":111.87,"volume":104.44},{"date":"2017-10-18 02:49:00","open":15.1,"low":15.11,"high":15.09,"close":15.09,"value":15.09,"volumefrom":14.32,"volumeto":216.14,"volume":201.82},{"date":"2017-10-18 02:48:00","open":15.17,"low":15.17,"high":15.11,"close":15.12,"value":15.12,"volumefrom":21.72,"volumeto":328.7,"volume":306.98},{"date":"2017-10-18 02:47:00","open":15.2,"low":15.2,"high":15.16,"close":15.17,"value":15.17,"volumefrom":16.42,"volumeto":249.06,"volume":232.64},{"date":"2017-10-18 02:46:00","open":15.24,"low":15.26,"high":15.18,"close":15.21,"value":15.21,"volumefrom":25.17,"volumeto":382.23,"volume":357.06},{"date":"2017-10-18 02:45:00","open":15.28,"low":15.28,"high":15.22,"close":15.24,"value":15.24,"volumefrom":16.78,"volumeto":256.07,"volume":239.29},{"date":"2017-10-18 02:44:00","open":15.34,"low":15.34,"high":15.27,"close":15.27,"value":15.27,"volumefrom":24.33,"volumeto":372.78,"volume":348.45},{"date":"2017-10-18 02:43:00","open":15.35,"low":15.35,"high":15.34,"close":15.34,"value":15.34,"volumefrom":24.12,"volumeto":370.44,"volume":346.32},{"date":"2017-10-18 02:42:00","open":15.35,"low":15.35,"high":15.34,"close":15.34,"value":15.34,"volumefrom":25.81,"volumeto":396.44,"volume":370.63},{"date":"2017-10-18 02:41:00","open":15.34,"low":15.35,"high":15.34,"close":15.35,"value":15.35,"volumefrom":24.86,"volumeto":381.93,"volume":357.07},{"date":"2017-10-18 02:40:00","open":15.33,"low":15.34,"high":15.33,"close":15.34,"value":15.34,"volumefrom":21.34,"volumeto":327.8,"volume":306.46},{"date":"2017-10-18 02:39:00","open":15.33,"low":15.34,"high":15.32,"close":15.33,"value":15.33,"volumefrom":23.72,"volumeto":363.96,"volume":340.24},{"date":"2017-10-18 02:38:00","open":15.31,"low":15.34,"high":15.31,"close":15.33,"value":15.33,"volumefrom":26.75,"volumeto":410.21,"volume":383.46},{"date":"2017-10-18 02:37:00","open":15.34,"low":15.34,"high":15.31,"close":15.31,"value":15.31,"volumefrom":6.41,"volumeto":97.53,"volume":91.12},{"date":"2017-10-18 02:36:00","open":15.3,"low":15.34,"high":15.28,"close":15.34,"value":15.34,"volumefrom":33.16,"volumeto":507.39,"volume":474.23},{"date":"2017-10-18 02:35:00","open":15.33,"low":15.35,"high":15.29,"close":15.3,"value":15.3,"volumefrom":22.9,"volumeto":349.95,"volume":327.05},{"date":"2017-10-18 02:34:00","open":15.36,"low":15.36,"high":15.33,"close":15.33,"value":15.33,"volumefrom":7.28,"volumeto":111.55,"volume":104.27},{"date":"2017-10-18 02:33:00","open":15.39,"low":15.39,"high":15.34,"close":15.36,"value":15.36,"volumefrom":27.3,"volumeto":419.22,"volume":391.92},{"date":"2017-10-18 02:32:00","open":15.43,"low":15.43,"high":15.35,"close":15.37,"value":15.37,"volumefrom":34.66,"volumeto":533.3,"volume":498.64},{"date":"2017-10-18 02:31:00","open":15.42,"low":15.44,"high":15.42,"close":15.43,"value":15.43,"volumefrom":24.89,"volumeto":381.33,"volume":356.44},{"date":"2017-10-18 02:30:00","open":15.42,"low":15.42,"high":15.4,"close":15.42,"value":15.42,"volumefrom":16.03,"volumeto":247.53,"volume":231.5},{"date":"2017-10-18 02:29:00","open":15.45,"low":15.45,"high":15.42,"close":15.42,"value":15.42,"volumefrom":3.51,"volumeto":54.15,"volume":50.64},{"date":"2017-10-18 02:28:00","open":15.41,"low":15.44,"high":15.41,"close":15.43,"value":15.43,"volumefrom":34.76,"volumeto":537.05,"volume":502.29},{"date":"2017-10-18 02:27:00","open":15.37,"low":15.4,"high":15.37,"close":15.4,"value":15.4,"volumefrom":29.91,"volumeto":461.95,"volume":432.04},{"date":"2017-10-18 02:26:00","open":15.37,"low":15.41,"high":15.35,"close":15.37,"value":15.37,"volumefrom":33.95,"volumeto":523.44,"volume":489.49},{"date":"2017-10-18 02:25:00","open":15.37,"low":15.39,"high":15.33,"close":15.38,"value":15.38,"volumefrom":31.42,"volumeto":483.46,"volume":452.04},{"date":"2017-10-18 02:24:00","open":15.32,"low":15.37,"high":15.32,"close":15.37,"value":15.37,"volumefrom":17.96,"volumeto":275.92,"volume":257.96},{"date":"2017-10-18 02:23:00","open":15.32,"low":15.33,"high":15.31,"close":15.32,"value":15.32,"volumefrom":17.19,"volumeto":263.55,"volume":246.36},{"date":"2017-10-18 02:22:00","open":15.3,"low":15.33,"high":15.3,"close":15.3,"value":15.3,"volumefrom":26.1,"volumeto":399.79,"volume":373.69},{"date":"2017-10-18 02:21:00","open":15.29,"low":15.3,"high":15.28,"close":15.29,"value":15.29,"volumefrom":23.57,"volumeto":361.11,"volume":337.54},{"date":"2017-10-18 02:20:00","open":15.31,"low":15.31,"high":15.28,"close":15.29,"value":15.29,"volumefrom":21.95,"volumeto":336.56,"volume":314.61},{"date":"2017-10-18 02:19:00","open":15.32,"low":15.32,"high":15.3,"close":15.31,"value":15.31,"volumefrom":25.37,"volumeto":387.54,"volume":362.17},{"date":"2017-10-18 02:18:00","open":15.32,"low":15.33,"high":15.31,"close":15.32,"value":15.32,"volumefrom":21.51,"volumeto":329.45,"volume":307.94},{"date":"2017-10-18 02:17:00","open":15.32,"low":15.34,"high":15.32,"close":15.32,"value":15.32,"volumefrom":16.7,"volumeto":255.76,"volume":239.06},{"date":"2017-10-18 02:16:00","open":15.34,"low":15.34,"high":15.31,"close":15.32,"value":15.32,"volumefrom":21.87,"volumeto":334.63,"volume":312.76},{"date":"2017-10-18 02:15:00","open":15.33,"low":15.34,"high":15.31,"close":15.32,"value":15.32,"volumefrom":35.71,"volumeto":548.56,"volume":512.85},{"date":"2017-10-18 02:14:00","open":15.27,"low":15.31,"high":15.27,"close":15.3,"value":15.3,"volumefrom":31.94,"volumeto":489.86,"volume":457.92},{"date":"2017-10-18 02:13:00","open":15.2,"low":15.3,"high":15.2,"close":15.28,"value":15.28,"volumefrom":20,"volumeto":305.25,"volume":285.25},{"date":"2017-10-18 02:12:00","open":15.18,"low":15.26,"high":15.16,"close":15.26,"value":15.26,"volumefrom":18.95,"volumeto":290.39,"volume":271.44},{"date":"2017-10-18 02:11:00","open":15.07,"low":15.17,"high":15.06,"close":15.16,"value":15.16,"volumefrom":27.72,"volumeto":421.12,"volume":393.4},{"date":"2017-10-18 02:10:00","open":15.03,"low":15.06,"high":15.02,"close":15.06,"value":15.06,"volumefrom":90.44,"volumeto":1377.62,"volume":1287.18},{"date":"2017-10-18 02:09:00","open":15.04,"low":15.04,"high":15.02,"close":15.03,"value":15.03,"volumefrom":8.05,"volumeto":121.29,"volume":113.24},{"date":"2017-10-18 02:08:00","open":15,"low":15.06,"high":14.99,"close":15.02,"value":15.02,"volumefrom":12.95,"volumeto":194.79,"volume":181.84},{"date":"2017-10-18 02:07:00","open":14.97,"low":15,"high":14.97,"close":15,"value":15,"volumefrom":13.34,"volumeto":199.92,"volume":186.58},{"date":"2017-10-18 02:06:00","open":14.93,"low":14.97,"high":14.93,"close":14.97,"value":14.97,"volumefrom":9.09,"volumeto":136.02,"volume":126.93},{"date":"2017-10-18 02:05:00","open":14.95,"low":14.95,"high":14.93,"close":14.93,"value":14.93,"volumefrom":3.78,"volumeto":56.53,"volume":52.75},{"date":"2017-10-18 02:04:00","open":14.95,"low":14.96,"high":14.94,"close":14.95,"value":14.95,"volumefrom":13.35,"volumeto":199.67,"volume":186.32},{"date":"2017-10-18 02:03:00","open":14.96,"low":14.96,"high":14.94,"close":14.95,"value":14.95,"volumefrom":6.76,"volumeto":101.19,"volume":94.43},{"date":"2017-10-18 02:02:00","open":14.95,"low":14.96,"high":14.94,"close":14.96,"value":14.96,"volumefrom":8.25,"volumeto":123.27,"volume":115.02},{"date":"2017-10-18 02:01:00","open":14.9,"low":14.95,"high":14.9,"close":14.95,"value":14.95,"volumefrom":11.42,"volumeto":170.59,"volume":159.17},{"date":"2017-10-18 02:00:00","open":14.92,"low":14.92,"high":14.9,"close":14.9,"value":14.9,"volumefrom":6.34,"volumeto":94.59,"volume":88.25},{"date":"2017-10-18 01:59:00","open":14.93,"low":14.93,"high":14.93,"close":14.93,"value":14.93,"volumefrom":5.24,"volumeto":78.33,"volume":73.09},{"date":"2017-10-18 01:58:00","open":14.93,"low":14.93,"high":14.93,"close":14.93,"value":14.93,"volumefrom":0.1874,"volumeto":2.8,"volume":2.6126},{"date":"2017-10-18 01:57:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":2.76,"volumeto":41.27,"volume":38.51},{"date":"2017-10-18 01:56:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":5.55,"volumeto":82.65,"volume":77.1},{"date":"2017-10-18 01:55:00","open":14.91,"low":14.91,"high":14.9,"close":14.91,"value":14.91,"volumefrom":10.58,"volumeto":157.99,"volume":147.41},{"date":"2017-10-18 01:54:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":3.52,"volumeto":52.52,"volume":49},{"date":"2017-10-18 01:53:00","open":14.92,"low":14.92,"high":14.92,"close":14.92,"value":14.92,"volumefrom":5.55,"volumeto":82.88,"volume":77.33},{"date":"2017-10-18 01:52:00","open":14.91,"low":14.92,"high":14.91,"close":14.91,"value":14.91,"volumefrom":7.62,"volumeto":113.65,"volume":106.03},{"date":"2017-10-18 01:51:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":4.07,"volumeto":60.61,"volume":56.54},{"date":"2017-10-18 01:50:00","open":14.93,"low":14.93,"high":14.92,"close":14.93,"value":14.93,"volumefrom":10.94,"volumeto":163.31,"volume":152.37},{"date":"2017-10-18 01:49:00","open":14.93,"low":14.93,"high":14.91,"close":14.93,"value":14.93,"volumefrom":8,"volumeto":119.47,"volume":111.47},{"date":"2017-10-18 01:48:00","open":14.92,"low":14.93,"high":14.91,"close":14.93,"value":14.93,"volumefrom":11.61,"volumeto":173.25,"volume":161.64},{"date":"2017-10-18 01:47:00","open":14.93,"low":14.93,"high":14.93,"close":14.93,"value":14.93,"volumefrom":11.03,"volumeto":164.84,"volume":153.81},{"date":"2017-10-18 01:46:00","open":14.93,"low":14.95,"high":14.93,"close":14.95,"value":14.95,"volumefrom":8.33,"volumeto":124.36,"volume":116.03},{"date":"2017-10-18 01:45:00","open":14.93,"low":14.93,"high":14.92,"close":14.93,"value":14.93,"volumefrom":6.03,"volumeto":90.15,"volume":84.12},{"date":"2017-10-18 01:44:00","open":14.92,"low":14.93,"high":14.92,"close":14.93,"value":14.93,"volumefrom":4.4,"volumeto":65.69,"volume":61.29},{"date":"2017-10-18 01:43:00","open":14.92,"low":14.92,"high":14.91,"close":14.92,"value":14.92,"volumefrom":0.857,"volumeto":12.77,"volume":11.913},{"date":"2017-10-18 01:42:00","open":14.96,"low":14.96,"high":14.93,"close":14.93,"value":14.93,"volumefrom":6.76,"volumeto":101.02,"volume":94.26},{"date":"2017-10-18 01:41:00","open":14.96,"low":14.96,"high":14.96,"close":14.96,"value":14.96,"volumefrom":6.84,"volumeto":102.22,"volume":95.38},{"date":"2017-10-18 01:40:00","open":14.95,"low":14.96,"high":14.94,"close":14.96,"value":14.96,"volumefrom":14.79,"volumeto":221.32,"volume":206.53},{"date":"2017-10-18 01:39:00","open":14.95,"low":14.95,"high":14.95,"close":14.95,"value":14.95,"volumefrom":4.12,"volumeto":61.39,"volume":57.27},{"date":"2017-10-18 01:38:00","open":14.96,"low":14.96,"high":14.95,"close":14.95,"value":14.95,"volumefrom":4.21,"volumeto":62.7,"volume":58.49},{"date":"2017-10-18 01:37:00","open":14.95,"low":14.96,"high":14.94,"close":14.96,"value":14.96,"volumefrom":6.59,"volumeto":98.39,"volume":91.8},{"date":"2017-10-18 01:36:00","open":14.94,"low":14.95,"high":14.94,"close":14.95,"value":14.95,"volumefrom":4.8,"volumeto":71.73,"volume":66.93},{"date":"2017-10-18 01:35:00","open":14.95,"low":14.95,"high":14.94,"close":14.95,"value":14.95,"volumefrom":15.66,"volumeto":234.18,"volume":218.52},{"date":"2017-10-18 01:34:00","open":14.95,"low":14.96,"high":14.95,"close":14.95,"value":14.95,"volumefrom":15.03,"volumeto":224.94,"volume":209.91},{"date":"2017-10-18 01:33:00","open":14.94,"low":14.96,"high":14.94,"close":14.95,"value":14.95,"volumefrom":7.7,"volumeto":115.2,"volume":107.5},{"date":"2017-10-18 01:32:00","open":14.93,"low":14.96,"high":14.93,"close":14.95,"value":14.95,"volumefrom":15.09,"volumeto":225.17,"volume":210.08},{"date":"2017-10-18 01:31:00","open":14.94,"low":14.95,"high":14.93,"close":14.95,"value":14.95,"volumefrom":12.83,"volumeto":191.8,"volume":178.97},{"date":"2017-10-18 01:30:00","open":14.92,"low":14.94,"high":14.91,"close":14.94,"value":14.94,"volumefrom":6.43,"volumeto":95.96,"volume":89.53},{"date":"2017-10-18 01:29:00","open":14.91,"low":14.92,"high":14.91,"close":14.92,"value":14.92,"volumefrom":16.45,"volumeto":245.1,"volume":228.65},{"date":"2017-10-18 01:28:00","open":14.9,"low":14.91,"high":14.9,"close":14.91,"value":14.91,"volumefrom":11.51,"volumeto":171.69,"volume":160.18},{"date":"2017-10-18 01:27:00","open":14.91,"low":14.92,"high":14.91,"close":14.91,"value":14.91,"volumefrom":8.78,"volumeto":131.06,"volume":122.28},{"date":"2017-10-18 01:26:00","open":14.91,"low":14.91,"high":14.91,"close":14.91,"value":14.91,"volumefrom":1.55,"volumeto":23.15,"volume":21.6},{"date":"2017-10-18 01:25:00","open":14.91,"low":14.92,"high":14.9,"close":14.91,"value":14.91,"volumefrom":1.54,"volumeto":23.03,"volume":21.49},{"date":"2017-10-18 01:24:00","open":14.91,"low":14.92,"high":14.9,"close":14.9,"value":14.9,"volumefrom":6.59,"volumeto":98.24,"volume":91.65},{"date":"2017-10-18 01:23:00","open":14.92,"low":14.92,"high":14.89,"close":14.91,"value":14.91,"volumefrom":8.48,"volumeto":126.39,"volume":117.91},{"date":"2017-10-18 01:22:00","open":14.89,"low":14.92,"high":14.89,"close":14.92,"value":14.92,"volumefrom":9.25,"volumeto":137.79,"volume":128.54},{"date":"2017-10-18 01:21:00","open":14.89,"low":14.89,"high":14.88,"close":14.89,"value":14.89,"volumefrom":8.37,"volumeto":124.65,"volume":116.28},{"date":"2017-10-18 01:20:00","open":14.9,"low":14.91,"high":14.89,"close":14.89,"value":14.89,"volumefrom":6.75,"volumeto":100.42,"volume":93.67},{"date":"2017-10-18 01:19:00","open":14.89,"low":14.91,"high":14.88,"close":14.9,"value":14.9,"volumefrom":3.7,"volumeto":55.05,"volume":51.35},{"date":"2017-10-18 01:18:00","open":14.88,"low":14.92,"high":14.88,"close":14.89,"value":14.89,"volumefrom":5.03,"volumeto":74.94,"volume":69.91},{"date":"2017-10-18 01:17:00","open":14.87,"low":14.9,"high":14.86,"close":14.88,"value":14.88,"volumefrom":8.79,"volumeto":131.03,"volume":122.24},{"date":"2017-10-18 01:16:00","open":14.88,"low":14.91,"high":14.86,"close":14.87,"value":14.87,"volumefrom":16.31,"volumeto":242.9,"volume":226.59},{"date":"2017-10-18 01:15:00","open":14.88,"low":14.91,"high":14.86,"close":14.88,"value":14.88,"volumefrom":11.74,"volumeto":174.76,"volume":163.02},{"date":"2017-10-18 01:14:00","open":14.88,"low":14.9,"high":14.87,"close":14.88,"value":14.88,"volumefrom":16.41,"volumeto":243.95,"volume":227.54},{"date":"2017-10-18 01:13:00","open":14.87,"low":14.88,"high":14.86,"close":14.87,"value":14.87,"volumefrom":19.35,"volumeto":287.64,"volume":268.29},{"date":"2017-10-18 01:12:00","open":14.86,"low":14.87,"high":14.85,"close":14.87,"value":14.87,"volumefrom":33.38,"volumeto":496.6,"volume":463.22},{"date":"2017-10-18 01:11:00","open":14.84,"low":14.85,"high":14.84,"close":14.85,"value":14.85,"volumefrom":21.55,"volumeto":320.05,"volume":298.5},{"date":"2017-10-18 01:10:00","open":14.84,"low":14.85,"high":14.82,"close":14.84,"value":14.84,"volumefrom":37.4,"volumeto":555.37,"volume":517.97},{"date":"2017-10-18 01:09:00","open":14.8,"low":14.84,"high":14.8,"close":14.82,"value":14.82,"volumefrom":23.21,"volumeto":344.35,"volume":321.14},{"date":"2017-10-18 01:08:00","open":14.81,"low":14.83,"high":14.79,"close":14.8,"value":14.8,"volumefrom":6.85,"volumeto":101.14,"volume":94.29},{"date":"2017-10-18 01:07:00","open":14.81,"low":14.82,"high":14.81,"close":14.81,"value":14.81,"volumefrom":9.01,"volumeto":133.37,"volume":124.36},{"date":"2017-10-18 01:06:00","open":14.82,"low":14.83,"high":14.81,"close":14.82,"value":14.82,"volumefrom":24.65,"volumeto":366.88,"volume":342.23},{"date":"2017-10-18 01:05:00","open":14.81,"low":14.84,"high":14.81,"close":14.83,"value":14.83,"volumefrom":12.45,"volumeto":184.56,"volume":172.11},{"date":"2017-10-18 01:04:00","open":14.81,"low":14.83,"high":14.8,"close":14.81,"value":14.81,"volumefrom":10.55,"volumeto":156.49,"volume":145.94},{"date":"2017-10-18 01:03:00","open":14.8,"low":14.81,"high":14.8,"close":14.81,"value":14.81,"volumefrom":12.96,"volumeto":192.12,"volume":179.16},{"date":"2017-10-18 01:02:00","open":14.84,"low":14.84,"high":14.8,"close":14.8,"value":14.8,"volumefrom":13.54,"volumeto":200.6,"volume":187.06},{"date":"2017-10-18 01:01:00","open":14.86,"low":14.86,"high":14.84,"close":14.84,"value":14.84,"volumefrom":15.84,"volumeto":235.13,"volume":219.29},{"date":"2017-10-18 01:00:00","open":14.87,"low":14.87,"high":14.85,"close":14.86,"value":14.86,"volumefrom":7.56,"volumeto":112.34,"volume":104.78},{"date":"2017-10-18 00:59:00","open":14.87,"low":14.88,"high":14.86,"close":14.86,"value":14.86,"volumefrom":11.67,"volumeto":173.45,"volume":161.78},{"date":"2017-10-18 00:58:00","open":14.94,"low":14.94,"high":14.87,"close":14.87,"value":14.87,"volumefrom":8.22,"volumeto":122.22,"volume":114},{"date":"2017-10-18 00:57:00","open":14.94,"low":14.95,"high":14.93,"close":14.94,"value":14.94,"volumefrom":8.52,"volumeto":127.27,"volume":118.75},{"date":"2017-10-18 00:56:00","open":14.94,"low":14.95,"high":14.93,"close":14.93,"value":14.93,"volumefrom":3.83,"volumeto":57.24,"volume":53.41},{"date":"2017-10-18 00:55:00","open":14.95,"low":14.95,"high":14.93,"close":14.94,"value":14.94,"volumefrom":4.94,"volumeto":73.19,"volume":68.25},{"date":"2017-10-18 00:54:00","open":14.95,"low":14.95,"high":14.93,"close":14.95,"value":14.95,"volumefrom":3.99,"volumeto":59.6,"volume":55.61},{"date":"2017-10-18 00:53:00","open":14.93,"low":14.96,"high":14.93,"close":14.95,"value":14.95,"volumefrom":19.76,"volumeto":294.89,"volume":275.13},{"date":"2017-10-18 00:52:00","open":14.95,"low":14.96,"high":14.93,"close":14.93,"value":14.93,"volumefrom":7.21,"volumeto":107.62,"volume":100.41},{"date":"2017-10-18 00:51:00","open":14.95,"low":14.96,"high":14.91,"close":14.95,"value":14.95,"volumefrom":11.31,"volumeto":167.02,"volume":155.71},{"date":"2017-10-18 00:50:00","open":14.95,"low":14.97,"high":14.93,"close":14.96,"value":14.96,"volumefrom":8.75,"volumeto":130.75,"volume":122},{"date":"2017-10-18 00:49:00","open":14.95,"low":14.96,"high":14.92,"close":14.95,"value":14.95,"volumefrom":14.19,"volumeto":211.94,"volume":197.75},{"date":"2017-10-18 00:48:00","open":14.9,"low":14.96,"high":14.9,"close":14.95,"value":14.95,"volumefrom":16.86,"volumeto":251.65,"volume":234.79},{"date":"2017-10-18 00:47:00","open":14.93,"low":14.94,"high":14.9,"close":14.9,"value":14.9,"volumefrom":10.57,"volumeto":157.49,"volume":146.92},{"date":"2017-10-18 00:46:00","open":14.91,"low":14.93,"high":14.89,"close":14.93,"value":14.93,"volumefrom":13.27,"volumeto":198.04,"volume":184.77},{"date":"2017-10-18 00:45:00","open":14.9,"low":14.92,"high":14.89,"close":14.89,"value":14.89,"volumefrom":16.62,"volumeto":247.71,"volume":231.09},{"date":"2017-10-18 00:44:00","open":14.86,"low":14.9,"high":14.86,"close":14.9,"value":14.9,"volumefrom":6.04,"volumeto":89.77,"volume":83.73},{"date":"2017-10-18 00:43:00","open":14.87,"low":14.87,"high":14.83,"close":14.85,"value":14.85,"volumefrom":10.7,"volumeto":159.09,"volume":148.39},{"date":"2017-10-18 00:42:00","open":14.84,"low":14.87,"high":14.83,"close":14.86,"value":14.86,"volumefrom":12.03,"volumeto":178.75,"volume":166.72},{"date":"2017-10-18 00:41:00","open":14.85,"low":14.87,"high":14.83,"close":14.84,"value":14.84,"volumefrom":14.03,"volumeto":208.64,"volume":194.61},{"date":"2017-10-18 00:40:00","open":14.84,"low":14.88,"high":14.81,"close":14.85,"value":14.85,"volumefrom":6.65,"volumeto":98.62,"volume":91.97},{"date":"2017-10-18 00:39:00","open":14.91,"low":14.91,"high":14.81,"close":14.84,"value":14.84,"volumefrom":5.9,"volumeto":87.42,"volume":81.52},{"date":"2017-10-18 00:38:00","open":14.95,"low":14.96,"high":14.88,"close":14.91,"value":14.91,"volumefrom":43.4,"volumeto":641.7,"volume":598.3},{"date":"2017-10-18 00:37:00","open":14.98,"low":15,"high":14.94,"close":14.96,"value":14.96,"volumefrom":9.91,"volumeto":147.96,"volume":138.05},{"date":"2017-10-18 00:36:00","open":15.02,"low":15.02,"high":14.98,"close":14.98,"value":14.98,"volumefrom":5.39,"volumeto":80.68,"volume":75.29},{"date":"2017-10-18 00:35:00","open":15.02,"low":15.03,"high":15.02,"close":15.03,"value":15.03,"volumefrom":12.3,"volumeto":184.63,"volume":172.33},{"date":"2017-10-18 00:34:00","open":15.05,"low":15.05,"high":15.02,"close":15.02,"value":15.02,"volumefrom":20.78,"volumeto":312.5,"volume":291.72},{"date":"2017-10-18 00:33:00","open":15.08,"low":15.09,"high":15.06,"close":15.06,"value":15.06,"volumefrom":16.86,"volumeto":254.04,"volume":237.18},{"date":"2017-10-18 00:32:00","open":15.1,"low":15.11,"high":15.07,"close":15.08,"value":15.08,"volumefrom":14.19,"volumeto":214.3,"volume":200.11},{"date":"2017-10-18 00:31:00","open":15.14,"low":15.14,"high":15.09,"close":15.1,"value":15.1,"volumefrom":9.28,"volumeto":140.18,"volume":130.9},{"date":"2017-10-18 00:30:00","open":15.11,"low":15.15,"high":15.08,"close":15.14,"value":15.14,"volumefrom":19.67,"volumeto":299.1,"volume":279.43},{"date":"2017-10-18 00:29:00","open":15.12,"low":15.14,"high":15.11,"close":15.12,"value":15.12,"volumefrom":12.41,"volumeto":187.99,"volume":175.58},{"date":"2017-10-18 00:28:00","open":15.1,"low":15.13,"high":15.08,"close":15.11,"value":15.11,"volumefrom":13.14,"volumeto":198.86,"volume":185.72},{"date":"2017-10-18 00:27:00","open":15.07,"low":15.13,"high":15.07,"close":15.1,"value":15.1,"volumefrom":8.57,"volumeto":129.62,"volume":121.05},{"date":"2017-10-18 00:26:00","open":15.02,"low":15.14,"high":15.02,"close":15.07,"value":15.07,"volumefrom":21.18,"volumeto":320.44,"volume":299.26},{"date":"2017-10-18 00:25:00","open":15.01,"low":15.03,"high":15,"close":15.03,"value":15.03,"volumefrom":6.66,"volumeto":100.18,"volume":93.52},{"date":"2017-10-18 00:24:00","open":14.97,"low":15.02,"high":14.97,"close":15.01,"value":15.01,"volumefrom":6.29,"volumeto":94.29,"volume":88},{"date":"2017-10-18 00:23:00","open":14.93,"low":14.97,"high":14.93,"close":14.96,"value":14.96,"volumefrom":7.87,"volumeto":117.87,"volume":110},{"date":"2017-10-18 00:22:00","open":14.88,"low":14.95,"high":14.88,"close":14.94,"value":14.94,"volumefrom":20.52,"volumeto":306.11,"volume":285.59},{"date":"2017-10-18 00:21:00","open":14.82,"low":14.87,"high":14.82,"close":14.87,"value":14.87,"volumefrom":16.4,"volumeto":243.64,"volume":227.24},{"date":"2017-10-18 00:20:00","open":14.8,"low":14.83,"high":14.79,"close":14.83,"value":14.83,"volumefrom":13.62,"volumeto":201.99,"volume":188.37},{"date":"2017-10-18 00:19:00","open":14.82,"low":14.82,"high":14.79,"close":14.79,"value":14.79,"volumefrom":11.45,"volumeto":169.54,"volume":158.09},{"date":"2017-10-18 00:18:00","open":14.82,"low":14.83,"high":14.8,"close":14.81,"value":14.81,"volumefrom":17.35,"volumeto":257.22,"volume":239.87},{"date":"2017-10-18 00:17:00","open":14.81,"low":14.82,"high":14.8,"close":14.81,"value":14.81,"volumefrom":7.92,"volumeto":117.4,"volume":109.48},{"date":"2017-10-18 00:16:00","open":14.83,"low":14.86,"high":14.81,"close":14.81,"value":14.81,"volumefrom":10.95,"volumeto":162.29,"volume":151.34},{"date":"2017-10-18 00:15:00","open":14.83,"low":14.83,"high":14.81,"close":14.82,"value":14.82,"volumefrom":17.01,"volumeto":252.28,"volume":235.27},{"date":"2017-10-18 00:14:00","open":14.84,"low":14.84,"high":14.83,"close":14.84,"value":14.84,"volumefrom":7.94,"volumeto":117.83,"volume":109.89},{"date":"2017-10-18 00:13:00","open":14.83,"low":14.85,"high":14.83,"close":14.84,"value":14.84,"volumefrom":3.31,"volumeto":49.09,"volume":45.78},{"date":"2017-10-18 00:12:00","open":14.85,"low":14.85,"high":14.84,"close":14.84,"value":14.84,"volumefrom":7.35,"volumeto":109.18,"volume":101.83},{"date":"2017-10-18 00:11:00","open":14.84,"low":14.87,"high":14.84,"close":14.86,"value":14.86,"volumefrom":5.05,"volumeto":75.05,"volume":70},{"date":"2017-10-18 00:10:00","open":14.86,"low":14.9,"high":14.83,"close":14.84,"value":14.84,"volumefrom":4.97,"volumeto":73.78,"volume":68.81},{"date":"2017-10-18 00:09:00","open":14.91,"low":14.91,"high":14.88,"close":14.88,"value":14.88,"volumefrom":5.8,"volumeto":86.22,"volume":80.42},{"date":"2017-10-18 00:08:00","open":14.99,"low":14.99,"high":14.91,"close":14.91,"value":14.91,"volumefrom":5.37,"volumeto":79.52,"volume":74.15},{"date":"2017-10-18 00:07:00","open":15.01,"low":15.01,"high":15,"close":15,"value":15,"volumefrom":6.47,"volumeto":97.06,"volume":90.59},{"date":"2017-10-18 00:06:00","open":15.02,"low":15.02,"high":15,"close":15.01,"value":15.01,"volumefrom":8.91,"volumeto":133.64,"volume":124.73},{"date":"2017-10-18 00:05:00","open":15.06,"low":15.07,"high":15.03,"close":15.03,"value":15.03,"volumefrom":10.38,"volumeto":156.08,"volume":145.7},{"date":"2017-10-18 00:04:00","open":15.07,"low":15.07,"high":15.06,"close":15.06,"value":15.06,"volumefrom":14.92,"volumeto":224.82,"volume":209.9},{"date":"2017-10-18 00:03:00","open":15.11,"low":15.11,"high":15.06,"close":15.06,"value":15.06,"volumefrom":12.17,"volumeto":183.69,"volume":171.52},{"date":"2017-10-18 00:02:00","open":15.15,"low":15.16,"high":15.13,"close":15.13,"value":15.13,"volumefrom":20.34,"volumeto":307.69,"volume":287.35},{"date":"2017-10-18 00:01:00","open":15.17,"low":15.18,"high":15.14,"close":15.15,"value":15.15,"volumefrom":27.23,"volumeto":413.11,"volume":385.88},{"date":"2017-10-18 00:00:00","open":15.18,"low":15.19,"high":15.16,"close":15.16,"value":15.16,"volumefrom":24.51,"volumeto":372.13,"volume":347.62},{"date":"2017-10-17 23:59:00","open":15.21,"low":15.22,"high":15.18,"close":15.18,"value":15.18,"volumefrom":20.42,"volumeto":309.93,"volume":289.51},{"date":"2017-10-17 23:58:00","open":15.22,"low":15.22,"high":15.17,"close":15.21,"value":15.21,"volumefrom":16.45,"volumeto":250.07,"volume":233.62},{"date":"2017-10-17 23:57:00","open":15.26,"low":15.28,"high":15.25,"close":15.25,"value":15.25,"volumefrom":16.24,"volumeto":247.91,"volume":231.67},{"date":"2017-10-17 23:56:00","open":15.26,"low":15.28,"high":15.26,"close":15.26,"value":15.26,"volumefrom":8.76,"volumeto":133.87,"volume":125.11},{"date":"2017-10-17 23:55:00","open":15.13,"low":15.28,"high":15.13,"close":15.26,"value":15.26,"volumefrom":8.39,"volumeto":127.96,"volume":119.57},{"date":"2017-10-17 23:54:00","open":15.14,"low":15.16,"high":15.13,"close":15.16,"value":15.16,"volumefrom":12.15,"volumeto":186.19,"volume":174.04},{"date":"2017-10-17 23:53:00","open":15.11,"low":15.14,"high":15.11,"close":15.13,"value":15.13,"volumefrom":10.92,"volumeto":166.39,"volume":155.47},{"date":"2017-10-17 23:52:00","open":15.11,"low":15.13,"high":15.11,"close":15.12,"value":15.12,"volumefrom":5.43,"volumeto":82.49,"volume":77.06},{"date":"2017-10-17 23:51:00","open":15.1,"low":15.13,"high":15.1,"close":15.11,"value":15.11,"volumefrom":16.86,"volumeto":255.05,"volume":238.19},{"date":"2017-10-17 23:50:00","open":15.04,"low":15.11,"high":15.03,"close":15.09,"value":15.09,"volumefrom":10.78,"volumeto":162.96,"volume":152.18},{"date":"2017-10-17 23:49:00","open":14.92,"low":14.96,"high":14.9,"close":14.96,"value":14.96,"volumefrom":16.16,"volumeto":242.24,"volume":226.08},{"date":"2017-10-17 23:48:00","open":14.92,"low":14.97,"high":14.87,"close":14.92,"value":14.92,"volumefrom":35.28,"volumeto":525.36,"volume":490.08},{"date":"2017-10-17 23:47:00","open":14.91,"low":14.94,"high":14.91,"close":14.91,"value":14.91,"volumefrom":19.98,"volumeto":298.21,"volume":278.23},{"date":"2017-10-17 23:46:00","open":14.82,"low":14.91,"high":14.82,"close":14.91,"value":14.91,"volumefrom":20.87,"volumeto":311.12,"volume":290.25},{"date":"2017-10-17 23:45:00","open":14.81,"low":14.85,"high":14.81,"close":14.85,"value":14.85,"volumefrom":20.6,"volumeto":305.33,"volume":284.73},{"date":"2017-10-17 23:44:00","open":14.8,"low":14.81,"high":14.8,"close":14.81,"value":14.81,"volumefrom":18.62,"volumeto":275.84,"volume":257.22},{"date":"2017-10-17 23:43:00","open":14.78,"low":14.81,"high":14.78,"close":14.8,"value":14.8,"volumefrom":2.75,"volumeto":40.75,"volume":38},{"date":"2017-10-17 23:42:00","open":14.76,"low":14.79,"high":14.73,"close":14.78,"value":14.78,"volumefrom":5.97,"volumeto":88.12,"volume":82.15},{"date":"2017-10-17 23:41:00","open":14.76,"low":14.77,"high":14.74,"close":14.75,"value":14.75,"volumefrom":23.54,"volumeto":347.61,"volume":324.07},{"date":"2017-10-17 23:40:00","open":14.72,"low":14.76,"high":14.72,"close":14.76,"value":14.76,"volumefrom":11.06,"volumeto":163.18,"volume":152.12},{"date":"2017-10-17 23:39:00","open":14.72,"low":14.75,"high":14.72,"close":14.72,"value":14.72,"volumefrom":15.22,"volumeto":224.33,"volume":209.11},{"date":"2017-10-17 23:38:00","open":14.73,"low":14.73,"high":14.71,"close":14.72,"value":14.72,"volumefrom":25.71,"volumeto":378.57,"volume":352.86},{"date":"2017-10-17 23:37:00","open":14.73,"low":14.75,"high":14.73,"close":14.74,"value":14.74,"volumefrom":16.08,"volumeto":236.94,"volume":220.86},{"date":"2017-10-17 23:36:00","open":14.7,"low":14.73,"high":14.7,"close":14.73,"value":14.73,"volumefrom":18,"volumeto":265.22,"volume":247.22},{"date":"2017-10-17 23:35:00","open":14.71,"low":14.72,"high":14.69,"close":14.71,"value":14.71,"volumefrom":17.16,"volumeto":252.53,"volume":235.37},{"date":"2017-10-17 23:34:00","open":14.72,"low":14.72,"high":14.71,"close":14.71,"value":14.71,"volumefrom":4.8,"volumeto":70.27,"volume":65.47},{"date":"2017-10-17 23:33:00","open":14.76,"low":14.76,"high":14.7,"close":14.72,"value":14.72,"volumefrom":23.51,"volumeto":345.8,"volume":322.29},{"date":"2017-10-17 23:32:00","open":14.74,"low":14.76,"high":14.73,"close":14.76,"value":14.76,"volumefrom":19.81,"volumeto":292.01,"volume":272.2},{"date":"2017-10-17 23:31:00","open":14.74,"low":14.76,"high":14.72,"close":14.74,"value":14.74,"volumefrom":20.87,"volumeto":307.55,"volume":286.68},{"date":"2017-10-17 23:30:00","open":14.77,"low":14.77,"high":14.65,"close":14.74,"value":14.74,"volumefrom":19.33,"volumeto":284.87,"volume":265.54},{"date":"2017-10-17 23:29:00","open":14.78,"low":14.78,"high":14.71,"close":14.77,"value":14.77,"volumefrom":20.98,"volumeto":309.63,"volume":288.65},{"date":"2017-10-17 23:28:00","open":14.77,"low":14.79,"high":14.74,"close":14.78,"value":14.78,"volumefrom":6.87,"volumeto":101.37,"volume":94.5},{"date":"2017-10-17 23:27:00","open":14.8,"low":14.8,"high":14.77,"close":14.77,"value":14.77,"volumefrom":10.9,"volumeto":160.84,"volume":149.94},{"date":"2017-10-17 23:26:00","open":14.78,"low":14.85,"high":14.78,"close":14.8,"value":14.8,"volumefrom":4.15,"volumeto":61.32,"volume":57.17},{"date":"2017-10-17 23:25:00","open":14.68,"low":14.85,"high":14.68,"close":14.79,"value":14.79,"volumefrom":15.8,"volumeto":233.96,"volume":218.16},{"date":"2017-10-17 23:24:00","open":14.62,"low":14.68,"high":14.62,"close":14.68,"value":14.68,"volumefrom":35.63,"volumeto":524.23,"volume":488.6},{"date":"2017-10-17 23:23:00","open":14.61,"low":14.63,"high":14.59,"close":14.62,"value":14.62,"volumefrom":32.85,"volumeto":481.34,"volume":448.49},{"date":"2017-10-17 23:22:00","open":14.58,"low":14.63,"high":14.58,"close":14.62,"value":14.62,"volumefrom":27.09,"volumeto":395.74,"volume":368.65},{"date":"2017-10-17 23:21:00","open":14.58,"low":14.59,"high":14.54,"close":14.58,"value":14.58,"volumefrom":17.77,"volumeto":259,"volume":241.23},{"date":"2017-10-17 23:20:00","open":14.56,"low":14.59,"high":14.56,"close":14.57,"value":14.57,"volumefrom":34.86,"volumeto":507.47,"volume":472.61},{"date":"2017-10-17 23:19:00","open":14.62,"low":14.62,"high":14.57,"close":14.57,"value":14.57,"volumefrom":10.81,"volumeto":157.03,"volume":146.22},{"date":"2017-10-17 23:18:00","open":14.65,"low":14.65,"high":14.62,"close":14.62,"value":14.62,"volumefrom":2.12,"volumeto":30.89,"volume":28.77},{"date":"2017-10-17 23:17:00","open":14.68,"low":14.68,"high":14.62,"close":14.62,"value":14.62,"volumefrom":15.42,"volumeto":225.63,"volume":210.21},{"date":"2017-10-17 23:16:00","open":14.76,"low":14.77,"high":14.67,"close":14.68,"value":14.68,"volumefrom":22.78,"volumeto":333.87,"volume":311.09},{"date":"2017-10-17 23:15:00","open":14.77,"low":14.77,"high":14.76,"close":14.76,"value":14.76,"volumefrom":13.89,"volumeto":204.31,"volume":190.42},{"date":"2017-10-17 23:14:00","open":14.75,"low":14.77,"high":14.74,"close":14.77,"value":14.77,"volumefrom":3.76,"volumeto":55.39,"volume":51.63},{"date":"2017-10-17 23:13:00","open":14.77,"low":14.77,"high":14.75,"close":14.75,"value":14.75,"volumefrom":6.14,"volumeto":90.48,"volume":84.34},{"date":"2017-10-17 23:12:00","open":14.79,"low":14.8,"high":14.78,"close":14.78,"value":14.78,"volumefrom":4.85,"volumeto":71.41,"volume":66.56},{"date":"2017-10-17 23:11:00","open":14.79,"low":14.79,"high":14.79,"close":14.79,"value":14.79,"volumefrom":4.41,"volumeto":64.56,"volume":60.15},{"date":"2017-10-17 23:10:00","open":14.77,"low":14.79,"high":14.77,"close":14.79,"value":14.79,"volumefrom":3.88,"volumeto":57.19,"volume":53.31},{"date":"2017-10-17 23:09:00","open":14.78,"low":14.8,"high":14.77,"close":14.79,"value":14.79,"volumefrom":4.27,"volumeto":62.18,"volume":57.91},{"date":"2017-10-17 23:08:00","open":14.79,"low":14.79,"high":14.77,"close":14.79,"value":14.79,"volumefrom":19.66,"volumeto":289.14,"volume":269.48},{"date":"2017-10-17 23:07:00","open":14.78,"low":14.79,"high":14.77,"close":14.79,"value":14.79,"volumefrom":20.95,"volumeto":309.89,"volume":288.94},{"date":"2017-10-17 23:06:00","open":14.78,"low":14.79,"high":14.76,"close":14.78,"value":14.78,"volumefrom":31.2,"volumeto":461.26,"volume":430.06},{"date":"2017-10-17 23:05:00","open":14.75,"low":14.82,"high":14.74,"close":14.78,"value":14.78,"volumefrom":14.81,"volumeto":219.24,"volume":204.43},{"date":"2017-10-17 23:04:00","open":14.71,"low":14.8,"high":14.71,"close":14.75,"value":14.75,"volumefrom":21.24,"volumeto":313.08,"volume":291.84},{"date":"2017-10-17 23:03:00","open":14.68,"low":14.72,"high":14.68,"close":14.71,"value":14.71,"volumefrom":24.69,"volumeto":363.3,"volume":338.61},{"date":"2017-10-17 23:02:00","open":14.68,"low":14.71,"high":14.66,"close":14.68,"value":14.68,"volumefrom":37.58,"volumeto":552.88,"volume":515.3},{"date":"2017-10-17 23:01:00","open":14.51,"low":14.71,"high":14.51,"close":14.68,"value":14.68,"volumefrom":14.81,"volumeto":217.5,"volume":202.69},{"date":"2017-10-17 23:00:00","open":14.52,"low":14.53,"high":14.49,"close":14.51,"value":14.51,"volumefrom":19.85,"volumeto":288.73,"volume":268.88},{"date":"2017-10-17 22:59:00","open":14.74,"low":14.74,"high":14.54,"close":14.54,"value":14.54,"volumefrom":18.85,"volumeto":274.09,"volume":255.24},{"date":"2017-10-17 22:58:00","open":14.76,"low":14.76,"high":14.67,"close":14.67,"value":14.67,"volumefrom":24.91,"volumeto":365.88,"volume":340.97},{"date":"2017-10-17 22:57:00","open":14.79,"low":14.83,"high":14.75,"close":14.75,"value":14.75,"volumefrom":29.31,"volumeto":433.14,"volume":403.83},{"date":"2017-10-17 22:56:00","open":14.67,"low":14.87,"high":14.67,"close":14.82,"value":14.82,"volumefrom":25.63,"volumeto":379.13,"volume":353.5},{"date":"2017-10-17 22:55:00","open":14.56,"low":14.65,"high":14.56,"close":14.65,"value":14.65,"volumefrom":10.41,"volumeto":152.78,"volume":142.37},{"date":"2017-10-17 22:54:00","open":14.52,"low":14.6,"high":14.51,"close":14.6,"value":14.6,"volumefrom":23.49,"volumeto":343.41,"volume":319.92},{"date":"2017-10-17 22:53:00","open":14.48,"low":14.53,"high":14.47,"close":14.52,"value":14.52,"volumefrom":37.37,"volumeto":542.75,"volume":505.38},{"date":"2017-10-17 22:52:00","open":14.48,"low":14.49,"high":14.47,"close":14.48,"value":14.48,"volumefrom":17.65,"volumeto":255.64,"volume":237.99},{"date":"2017-10-17 22:51:00","open":14.5,"low":14.5,"high":14.47,"close":14.48,"value":14.48,"volumefrom":14.88,"volumeto":214.43,"volume":199.55},{"date":"2017-10-17 22:50:00","open":14.5,"low":14.51,"high":14.48,"close":14.5,"value":14.5,"volumefrom":35.44,"volumeto":513.67,"volume":478.23},{"date":"2017-10-17 22:49:00","open":14.5,"low":14.52,"high":14.5,"close":14.5,"value":14.5,"volumefrom":35.89,"volumeto":519.46,"volume":483.57},{"date":"2017-10-17 22:48:00","open":14.49,"low":14.51,"high":14.48,"close":14.51,"value":14.51,"volumefrom":48.45,"volumeto":702.23,"volume":653.78},{"date":"2017-10-17 22:47:00","open":14.41,"low":14.51,"high":14.38,"close":14.49,"value":14.49,"volumefrom":34.64,"volumeto":500.84,"volume":466.2},{"date":"2017-10-17 22:46:00","open":14.36,"low":14.41,"high":14.34,"close":14.39,"value":14.39,"volumefrom":61.75,"volumeto":888.97,"volume":827.22},{"date":"2017-10-17 22:45:00","open":14.34,"low":14.38,"high":14.32,"close":14.36,"value":14.36,"volumefrom":56.18,"volumeto":804.15,"volume":747.97},{"date":"2017-10-17 22:44:00","open":14.41,"low":14.41,"high":14.33,"close":14.33,"value":14.33,"volumefrom":49.69,"volumeto":711.18,"volume":661.49},{"date":"2017-10-17 22:43:00","open":14.42,"low":14.44,"high":14.4,"close":14.41,"value":14.41,"volumefrom":46.51,"volumeto":667.8,"volume":621.29},{"date":"2017-10-17 22:42:00","open":14.48,"low":14.49,"high":14.42,"close":14.42,"value":14.42,"volumefrom":16.86,"volumeto":243.23,"volume":226.37},{"date":"2017-10-17 22:41:00","open":14.52,"low":14.52,"high":14.47,"close":14.48,"value":14.48,"volumefrom":119.46,"volumeto":1728.12,"volume":1608.66},{"date":"2017-10-17 22:40:00","open":14.56,"low":14.58,"high":14.51,"close":14.51,"value":14.51,"volumefrom":11.61,"volumeto":168.23,"volume":156.62},{"date":"2017-10-17 22:39:00","open":14.6,"low":14.6,"high":14.56,"close":14.56,"value":14.56,"volumefrom":22.99,"volumeto":333.16,"volume":310.17},{"date":"2017-10-17 22:38:00","open":14.61,"low":14.66,"high":14.6,"close":14.6,"value":14.6,"volumefrom":20.23,"volumeto":294.5,"volume":274.27},{"date":"2017-10-17 22:37:00","open":14.66,"low":14.66,"high":14.62,"close":14.62,"value":14.62,"volumefrom":19.26,"volumeto":280.78,"volume":261.52},{"date":"2017-10-17 22:36:00","open":14.75,"low":14.79,"high":14.66,"close":14.66,"value":14.66,"volumefrom":8.4,"volumeto":123.14,"volume":114.74},{"date":"2017-10-17 22:35:00","open":14.82,"low":14.86,"high":14.74,"close":14.75,"value":14.75,"volumefrom":19.5,"volumeto":284.77,"volume":265.27},{"date":"2017-10-17 22:34:00","open":14.83,"low":14.85,"high":14.81,"close":14.82,"value":14.82,"volumefrom":14.32,"volumeto":211.36,"volume":197.04},{"date":"2017-10-17 22:33:00","open":14.88,"low":14.9,"high":14.82,"close":14.83,"value":14.83,"volumefrom":19.56,"volumeto":290.44,"volume":270.88},{"date":"2017-10-17 22:32:00","open":14.92,"low":14.92,"high":14.88,"close":14.89,"value":14.89,"volumefrom":26.24,"volumeto":390.34,"volume":364.1},{"date":"2017-10-17 22:31:00","open":14.93,"low":14.94,"high":14.9,"close":14.92,"value":14.92,"volumefrom":28.36,"volumeto":423.12,"volume":394.76},{"date":"2017-10-17 22:30:00","open":14.97,"low":14.97,"high":14.93,"close":14.93,"value":14.93,"volumefrom":24.98,"volumeto":371.93,"volume":346.95},{"date":"2017-10-17 22:29:00","open":14.98,"low":15.01,"high":14.97,"close":14.97,"value":14.97,"volumefrom":20.07,"volumeto":300.73,"volume":280.66},{"date":"2017-10-17 22:28:00","open":15.04,"low":15.04,"high":14.97,"close":14.99,"value":14.99,"volumefrom":7.01,"volumeto":105.15,"volume":98.14},{"date":"2017-10-17 22:27:00","open":15.06,"low":15.07,"high":15.03,"close":15.04,"value":15.04,"volumefrom":27.76,"volumeto":416.04,"volume":388.28},{"date":"2017-10-17 22:26:00","open":15.06,"low":15.06,"high":15.04,"close":15.06,"value":15.06,"volumefrom":29.98,"volumeto":451.37,"volume":421.39},{"date":"2017-10-17 22:25:00","open":15.09,"low":15.09,"high":15.08,"close":15.08,"value":15.08,"volumefrom":25.15,"volumeto":378.93,"volume":353.78},{"date":"2017-10-17 22:24:00","open":15.06,"low":15.09,"high":15.05,"close":15.09,"value":15.09,"volumefrom":19.13,"volumeto":288.4,"volume":269.27},{"date":"2017-10-17 22:23:00","open":15.08,"low":15.09,"high":14.99,"close":15.06,"value":15.06,"volumefrom":19.09,"volumeto":287.29,"volume":268.2},{"date":"2017-10-17 22:22:00","open":15.09,"low":15.09,"high":15.02,"close":15.08,"value":15.08,"volumefrom":33.14,"volumeto":499.42,"volume":466.28},{"date":"2017-10-17 22:21:00","open":15.1,"low":15.11,"high":15.07,"close":15.11,"value":15.11,"volumefrom":21.35,"volumeto":322.09,"volume":300.74},{"date":"2017-10-17 22:20:00","open":15.11,"low":15.11,"high":15.06,"close":15.1,"value":15.1,"volumefrom":24.39,"volumeto":367.71,"volume":343.32},{"date":"2017-10-17 22:19:00","open":15.1,"low":15.12,"high":15.06,"close":15.11,"value":15.11,"volumefrom":24.72,"volumeto":372.65,"volume":347.93},{"date":"2017-10-17 22:18:00","open":15.18,"low":15.18,"high":15.06,"close":15.11,"value":15.11,"volumefrom":21.46,"volumeto":324.25,"volume":302.79},{"date":"2017-10-17 22:17:00","open":15.2,"low":15.22,"high":15.18,"close":15.18,"value":15.18,"volumefrom":24.68,"volumeto":374.12,"volume":349.44},{"date":"2017-10-17 22:16:00","open":15.22,"low":15.23,"high":15.18,"close":15.2,"value":15.2,"volumefrom":26.24,"volumeto":398.97,"volume":372.73},{"date":"2017-10-17 22:15:00","open":15.25,"low":15.25,"high":15.21,"close":15.24,"value":15.24,"volumefrom":20.18,"volumeto":307.8,"volume":287.62},{"date":"2017-10-17 22:14:00","open":15.24,"low":15.3,"high":15.23,"close":15.25,"value":15.25,"volumefrom":27.38,"volumeto":416.18,"volume":388.8},{"date":"2017-10-17 22:13:00","open":15.23,"low":15.28,"high":15.23,"close":15.24,"value":15.24,"volumefrom":7.61,"volumeto":116.59,"volume":108.98},{"date":"2017-10-17 22:12:00","open":15.29,"low":15.29,"high":15.22,"close":15.23,"value":15.23,"volumefrom":3.88,"volumeto":59.26,"volume":55.38},{"date":"2017-10-17 22:11:00","open":15.26,"low":15.29,"high":15.26,"close":15.26,"value":15.26,"volumefrom":20.71,"volumeto":316.56,"volume":295.85},{"date":"2017-10-17 22:10:00","open":15.21,"low":15.27,"high":15.2,"close":15.26,"value":15.26,"volumefrom":20.1,"volumeto":306.95,"volume":286.85},{"date":"2017-10-17 22:09:00","open":15.14,"low":15.21,"high":15.14,"close":15.2,"value":15.2,"volumefrom":10.58,"volumeto":161.09,"volume":150.51},{"date":"2017-10-17 22:08:00","open":15.12,"low":15.14,"high":15.12,"close":15.13,"value":15.13,"volumefrom":13.76,"volumeto":208.37,"volume":194.61},{"date":"2017-10-17 22:07:00","open":15.11,"low":15.13,"high":15.11,"close":15.12,"value":15.12,"volumefrom":28.24,"volumeto":427.01,"volume":398.77},{"date":"2017-10-17 22:06:00","open":15.07,"low":15.11,"high":15.07,"close":15.11,"value":15.11,"volumefrom":33.89,"volumeto":511.8,"volume":477.91},{"date":"2017-10-17 22:05:00","open":15.07,"low":15.08,"high":15.07,"close":15.08,"value":15.08,"volumefrom":6.29,"volumeto":94.82,"volume":88.53},{"date":"2017-10-17 22:04:00","open":15.09,"low":15.09,"high":15.07,"close":15.07,"value":15.07,"volumefrom":5.83,"volumeto":87.92,"volume":82.09},{"date":"2017-10-17 22:03:00","open":15.11,"low":15.11,"high":15.09,"close":15.09,"value":15.09,"volumefrom":3.62,"volumeto":54.6,"volume":50.98},{"date":"2017-10-17 22:02:00","open":15.07,"low":15.12,"high":15.06,"close":15.11,"value":15.11,"volumefrom":36.73,"volumeto":553.69,"volume":516.96},{"date":"2017-10-17 22:01:00","open":15.08,"low":15.08,"high":15.07,"close":15.07,"value":15.07,"volumefrom":18.8,"volumeto":283.52,"volume":264.72},{"date":"2017-10-17 22:00:00","open":15.08,"low":15.09,"high":15.06,"close":15.07,"value":15.07,"volumefrom":23.86,"volumeto":359.56,"volume":335.7},{"date":"2017-10-17 21:59:00","open":15.09,"low":15.09,"high":15.08,"close":15.08,"value":15.08,"volumefrom":17.31,"volumeto":260.84,"volume":243.53},{"date":"2017-10-17 21:58:00","open":15.11,"low":15.11,"high":15.08,"close":15.08,"value":15.08,"volumefrom":8.13,"volumeto":122.56,"volume":114.43},{"date":"2017-10-17 21:57:00","open":15.11,"low":15.11,"high":15.1,"close":15.11,"value":15.11,"volumefrom":2.29,"volumeto":34.51,"volume":32.22},{"date":"2017-10-17 21:56:00","open":15.13,"low":15.13,"high":15.1,"close":15.11,"value":15.11,"volumefrom":6.2,"volumeto":93.65,"volume":87.45},{"date":"2017-10-17 21:55:00","open":15.13,"low":15.14,"high":15.11,"close":15.13,"value":15.13,"volumefrom":9.92,"volumeto":150.1,"volume":140.18},{"date":"2017-10-17 21:54:00","open":15.12,"low":15.24,"high":15.11,"close":15.13,"value":15.13,"volumefrom":21.36,"volumeto":323.06,"volume":301.7},{"date":"2017-10-17 21:53:00","open":15.12,"low":15.21,"high":15.11,"close":15.12,"value":15.12,"volumefrom":37.49,"volumeto":568.05,"volume":530.56},{"date":"2017-10-17 21:52:00","open":15.14,"low":15.14,"high":15.11,"close":15.12,"value":15.12,"volumefrom":8.71,"volumeto":131.74,"volume":123.03},{"date":"2017-10-17 21:51:00","open":15.16,"low":15.16,"high":15.14,"close":15.14,"value":15.14,"volumefrom":27.41,"volumeto":414.85,"volume":387.44},{"date":"2017-10-17 21:50:00","open":15.17,"low":15.17,"high":15.16,"close":15.16,"value":15.16,"volumefrom":34.54,"volumeto":523.43,"volume":488.89},{"date":"2017-10-17 21:49:00","open":15.19,"low":15.19,"high":15.17,"close":15.17,"value":15.17,"volumefrom":25.13,"volumeto":381.02,"volume":355.89},{"date":"2017-10-17 21:48:00","open":15.18,"low":15.2,"high":15.18,"close":15.2,"value":15.2,"volumefrom":20.12,"volumeto":305.4,"volume":285.28},{"date":"2017-10-17 21:47:00","open":15.23,"low":15.25,"high":15.15,"close":15.18,"value":15.18,"volumefrom":25.7,"volumeto":390.23,"volume":364.53},{"date":"2017-10-17 21:46:00","open":15.25,"low":15.26,"high":15.23,"close":15.23,"value":15.23,"volumefrom":16.13,"volumeto":245.68,"volume":229.55},{"date":"2017-10-17 21:45:00","open":15.33,"low":15.33,"high":15.23,"close":15.26,"value":15.26,"volumefrom":23.9,"volumeto":364.74,"volume":340.84},{"date":"2017-10-17 21:44:00","open":15.31,"low":15.31,"high":15.31,"close":15.31,"value":15.31,"volumefrom":15.16,"volumeto":232.12,"volume":216.96},{"date":"2017-10-17 21:43:00","open":15.31,"low":15.33,"high":15.31,"close":15.32,"value":15.32,"volumefrom":18.86,"volumeto":289.4,"volume":270.54},{"date":"2017-10-17 21:42:00","open":15.34,"low":15.34,"high":15.3,"close":15.31,"value":15.31,"volumefrom":7.3,"volumeto":111.92,"volume":104.62},{"date":"2017-10-17 21:41:00","open":15.34,"low":15.35,"high":15.32,"close":15.34,"value":15.34,"volumefrom":38.12,"volumeto":584.5,"volume":546.38},{"date":"2017-10-17 21:40:00","open":15.38,"low":15.38,"high":15.35,"close":15.35,"value":15.35,"volumefrom":33.75,"volumeto":518.4,"volume":484.65},{"date":"2017-10-17 21:39:00","open":15.37,"low":15.38,"high":15.37,"close":15.38,"value":15.38,"volumefrom":22.52,"volumeto":345.82,"volume":323.3},{"date":"2017-10-17 21:38:00","open":15.37,"low":15.38,"high":15.37,"close":15.38,"value":15.38,"volumefrom":21.53,"volumeto":330.79,"volume":309.26},{"date":"2017-10-17 21:37:00","open":15.38,"low":15.38,"high":15.34,"close":15.37,"value":15.37,"volumefrom":21.21,"volumeto":326.11,"volume":304.9},{"date":"2017-10-17 21:36:00","open":15.37,"low":15.38,"high":15.36,"close":15.38,"value":15.38,"volumefrom":19.63,"volumeto":301.69,"volume":282.06},{"date":"2017-10-17 21:35:00","open":15.39,"low":15.4,"high":15.37,"close":15.38,"value":15.38,"volumefrom":17.98,"volumeto":276.83,"volume":258.85},{"date":"2017-10-17 21:34:00","open":15.37,"low":15.38,"high":15.36,"close":15.38,"value":15.38,"volumefrom":15.48,"volumeto":238.18,"volume":222.7},{"date":"2017-10-17 21:33:00","open":15.34,"low":15.36,"high":15.34,"close":15.36,"value":15.36,"volumefrom":13.47,"volumeto":207.29,"volume":193.82},{"date":"2017-10-17 21:32:00","open":15.36,"low":15.36,"high":15.32,"close":15.34,"value":15.34,"volumefrom":3.16,"volumeto":48.68,"volume":45.52},{"date":"2017-10-17 21:31:00","open":15.35,"low":15.38,"high":15.35,"close":15.36,"value":15.36,"volumefrom":18.26,"volumeto":279.71,"volume":261.45},{"date":"2017-10-17 21:30:00","open":15.35,"low":15.37,"high":15.35,"close":15.35,"value":15.35,"volumefrom":21.8,"volumeto":334.6,"volume":312.8},{"date":"2017-10-17 21:29:00","open":15.38,"low":15.38,"high":15.34,"close":15.35,"value":15.35,"volumefrom":28.44,"volumeto":437.05,"volume":408.61},{"date":"2017-10-17 21:28:00","open":15.38,"low":15.4,"high":15.38,"close":15.38,"value":15.38,"volumefrom":25.06,"volumeto":385.31,"volume":360.25},{"date":"2017-10-17 21:27:00","open":15.37,"low":15.39,"high":15.36,"close":15.38,"value":15.38,"volumefrom":26.01,"volumeto":399.84,"volume":373.83},{"date":"2017-10-17 21:26:00","open":15.44,"low":15.44,"high":15.35,"close":15.37,"value":15.37,"volumefrom":18.19,"volumeto":279.66,"volume":261.47},{"date":"2017-10-17 21:25:00","open":15.45,"low":15.46,"high":15.43,"close":15.44,"value":15.44,"volumefrom":41.52,"volumeto":640.18,"volume":598.66},{"date":"2017-10-17 21:24:00","open":15.46,"low":15.49,"high":15.45,"close":15.45,"value":15.45,"volumefrom":36.57,"volumeto":564.87,"volume":528.3},{"date":"2017-10-17 21:23:00","open":15.44,"low":15.48,"high":15.44,"close":15.46,"value":15.46,"volumefrom":27.93,"volumeto":432,"volume":404.07},{"date":"2017-10-17 21:22:00","open":15.4,"low":15.45,"high":15.4,"close":15.45,"value":15.45,"volumefrom":31.65,"volumeto":488.41,"volume":456.76},{"date":"2017-10-17 21:21:00","open":15.41,"low":15.43,"high":15.39,"close":15.4,"value":15.4,"volumefrom":21.95,"volumeto":338.43,"volume":316.48},{"date":"2017-10-17 21:20:00","open":15.4,"low":15.41,"high":15.38,"close":15.41,"value":15.41,"volumefrom":27.01,"volumeto":416.28,"volume":389.27},{"date":"2017-10-17 21:19:00","open":15.38,"low":15.4,"high":15.37,"close":15.4,"value":15.4,"volumefrom":26.76,"volumeto":412.13,"volume":385.37},{"date":"2017-10-17 21:18:00","open":15.39,"low":15.41,"high":15.38,"close":15.38,"value":15.38,"volumefrom":24.5,"volumeto":377.44,"volume":352.94},{"date":"2017-10-17 21:17:00","open":15.39,"low":15.41,"high":15.39,"close":15.4,"value":15.4,"volumefrom":12.29,"volumeto":189.65,"volume":177.36},{"date":"2017-10-17 21:16:00","open":15.38,"low":15.4,"high":15.37,"close":15.39,"value":15.39,"volumefrom":16.2,"volumeto":249.56,"volume":233.36},{"date":"2017-10-17 21:15:00","open":15.36,"low":15.4,"high":15.36,"close":15.38,"value":15.38,"volumefrom":19.38,"volumeto":298.12,"volume":278.74},{"date":"2017-10-17 21:14:00","open":15.39,"low":15.39,"high":15.35,"close":15.36,"value":15.36,"volumefrom":12.2,"volumeto":187.95,"volume":175.75},{"date":"2017-10-17 21:13:00","open":15.35,"low":15.39,"high":15.35,"close":15.39,"value":15.39,"volumefrom":20.67,"volumeto":318.23,"volume":297.56},{"date":"2017-10-17 21:12:00","open":15.35,"low":15.35,"high":15.34,"close":15.35,"value":15.35,"volumefrom":28.62,"volumeto":440.42,"volume":411.8},{"date":"2017-10-17 21:11:00","open":15.34,"low":15.35,"high":15.32,"close":15.35,"value":15.35,"volumefrom":6.89,"volumeto":105.78,"volume":98.89},{"date":"2017-10-17 21:10:00","open":15.34,"low":15.35,"high":15.33,"close":15.34,"value":15.34,"volumefrom":18.19,"volumeto":279.41,"volume":261.22},{"date":"2017-10-17 21:09:00","open":15.33,"low":15.34,"high":15.32,"close":15.33,"value":15.33,"volumefrom":28.2,"volumeto":432.86,"volume":404.66},{"date":"2017-10-17 21:08:00","open":15.33,"low":15.34,"high":15.31,"close":15.33,"value":15.33,"volumefrom":21.4,"volumeto":328.55,"volume":307.15},{"date":"2017-10-17 21:07:00","open":15.36,"low":15.37,"high":15.33,"close":15.33,"value":15.33,"volumefrom":19.77,"volumeto":302.75,"volume":282.98},{"date":"2017-10-17 21:06:00","open":15.33,"low":15.36,"high":15.33,"close":15.35,"value":15.35,"volumefrom":33.36,"volumeto":511.52,"volume":478.16},{"date":"2017-10-17 21:05:00","open":15.34,"low":15.38,"high":15.32,"close":15.34,"value":15.34,"volumefrom":44.14,"volumeto":677.69,"volume":633.55},{"date":"2017-10-17 21:04:00","open":15.36,"low":15.38,"high":15.33,"close":15.35,"value":15.35,"volumefrom":34.15,"volumeto":524.84,"volume":490.69},{"date":"2017-10-17 21:03:00","open":15.36,"low":15.37,"high":15.36,"close":15.36,"value":15.36,"volumefrom":19,"volumeto":292.2,"volume":273.2},{"date":"2017-10-17 21:02:00","open":15.33,"low":15.34,"high":15.3,"close":15.33,"value":15.33,"volumefrom":11.17,"volumeto":171.29,"volume":160.12},{"date":"2017-10-17 21:01:00","open":15.34,"low":15.34,"high":15.33,"close":15.33,"value":15.33,"volumefrom":25.91,"volumeto":397.11,"volume":371.2},{"date":"2017-10-17 21:00:00","open":15.33,"low":15.34,"high":15.32,"close":15.33,"value":15.33,"volumefrom":29.53,"volumeto":452.53,"volume":423},{"date":"2017-10-17 20:59:00","open":15.34,"low":15.35,"high":15.32,"close":15.33,"value":15.33,"volumefrom":24.84,"volumeto":380.69,"volume":355.85},{"date":"2017-10-17 20:58:00","open":15.39,"low":15.4,"high":15.34,"close":15.34,"value":15.34,"volumefrom":24.53,"volumeto":376.74,"volume":352.21},{"date":"2017-10-17 20:57:00","open":15.41,"low":15.42,"high":15.4,"close":15.4,"value":15.4,"volumefrom":19.17,"volumeto":294.34,"volume":275.17},{"date":"2017-10-17 20:56:00","open":15.42,"low":15.43,"high":15.41,"close":15.42,"value":15.42,"volumefrom":24.7,"volumeto":379.66,"volume":354.96},{"date":"2017-10-17 20:55:00","open":15.42,"low":15.44,"high":15.41,"close":15.42,"value":15.42,"volumefrom":20.99,"volumeto":322.74,"volume":301.75},{"date":"2017-10-17 20:54:00","open":15.45,"low":15.48,"high":15.43,"close":15.45,"value":15.45,"volumefrom":21.96,"volumeto":338.07,"volume":316.11},{"date":"2017-10-17 20:53:00","open":15.5,"low":15.51,"high":15.45,"close":15.46,"value":15.46,"volumefrom":15.74,"volumeto":242.8,"volume":227.06},{"date":"2017-10-17 20:52:00","open":15.51,"low":15.51,"high":15.48,"close":15.49,"value":15.49,"volumefrom":11.75,"volumeto":181.44,"volume":169.69},{"date":"2017-10-17 20:51:00","open":15.6,"low":15.6,"high":15.48,"close":15.51,"value":15.51,"volumefrom":11.36,"volumeto":175.59,"volume":164.23},{"date":"2017-10-17 20:50:00","open":15.67,"low":15.67,"high":15.63,"close":15.65,"value":15.65,"volumefrom":53.89,"volumeto":835.5,"volume":781.61},{"date":"2017-10-17 20:49:00","open":15.7,"low":15.71,"high":15.7,"close":15.71,"value":15.71,"volumefrom":8.99,"volumeto":140.74,"volume":131.75},{"date":"2017-10-17 20:48:00","open":15.79,"low":15.79,"high":15.71,"close":15.72,"value":15.72,"volumefrom":7.89,"volumeto":123.83,"volume":115.94},{"date":"2017-10-17 20:47:00","open":15.8,"low":15.82,"high":15.76,"close":15.79,"value":15.79,"volumefrom":21.61,"volumeto":339.45,"volume":317.84},{"date":"2017-10-17 20:46:00","open":15.84,"low":15.84,"high":15.79,"close":15.81,"value":15.81,"volumefrom":39.35,"volumeto":621.86,"volume":582.51},{"date":"2017-10-17 20:45:00","open":15.84,"low":15.84,"high":15.81,"close":15.82,"value":15.82,"volumefrom":14.35,"volumeto":227.1,"volume":212.75},{"date":"2017-10-17 20:44:00","open":15.85,"low":15.86,"high":15.83,"close":15.84,"value":15.84,"volumefrom":16.32,"volumeto":258.64,"volume":242.32},{"date":"2017-10-17 20:43:00","open":15.83,"low":15.84,"high":15.83,"close":15.84,"value":15.84,"volumefrom":12.73,"volumeto":201.75,"volume":189.02},{"date":"2017-10-17 20:42:00","open":15.85,"low":15.85,"high":15.81,"close":15.83,"value":15.83,"volumefrom":2.87,"volumeto":42.99,"volume":40.12},{"date":"2017-10-17 20:41:00","open":15.85,"low":15.85,"high":15.83,"close":15.83,"value":15.83,"volumefrom":13.4,"volumeto":212.52,"volume":199.12},{"date":"2017-10-17 20:40:00","open":15.84,"low":15.84,"high":15.84,"close":15.84,"value":15.84,"volumefrom":7.68,"volumeto":121.79,"volume":114.11},{"date":"2017-10-17 20:39:00","open":15.88,"low":15.88,"high":15.84,"close":15.84,"value":15.84,"volumefrom":21.41,"volumeto":339.57,"volume":318.16},{"date":"2017-10-17 20:38:00","open":15.93,"low":15.93,"high":15.87,"close":15.89,"value":15.89,"volumefrom":17.14,"volumeto":270.5,"volume":253.36},{"date":"2017-10-17 20:37:00","open":15.93,"low":15.94,"high":15.91,"close":15.91,"value":15.91,"volumefrom":14.5,"volumeto":231.21,"volume":216.71},{"date":"2017-10-17 20:36:00","open":15.91,"low":15.94,"high":15.91,"close":15.94,"value":15.94,"volumefrom":27.25,"volumeto":434.42,"volume":407.17},{"date":"2017-10-17 20:35:00","open":15.89,"low":15.96,"high":15.87,"close":15.9,"value":15.9,"volumefrom":50.53,"volumeto":810.27,"volume":759.74},{"date":"2017-10-17 20:34:00","open":15.83,"low":15.93,"high":15.83,"close":15.88,"value":15.88,"volumefrom":19.74,"volumeto":314.14,"volume":294.4},{"date":"2017-10-17 20:33:00","open":15.83,"low":15.86,"high":15.83,"close":15.86,"value":15.86,"volumefrom":1.93,"volumeto":30.54,"volume":28.61},{"date":"2017-10-17 20:32:00","open":15.81,"low":15.83,"high":15.81,"close":15.83,"value":15.83,"volumefrom":5.02,"volumeto":79.38,"volume":74.36},{"date":"2017-10-17 20:31:00","open":15.82,"low":15.82,"high":15.8,"close":15.81,"value":15.81,"volumefrom":1.99,"volumeto":31.5,"volume":29.51},{"date":"2017-10-17 20:30:00","open":15.83,"low":15.84,"high":15.82,"close":15.82,"value":15.82,"volumefrom":1.15,"volumeto":18.17,"volume":17.02},{"date":"2017-10-17 20:29:00","open":15.82,"low":15.83,"high":15.82,"close":15.83,"value":15.83,"volumefrom":6.35,"volumeto":100.38,"volume":94.03},{"date":"2017-10-17 20:28:00","open":15.84,"low":15.84,"high":15.82,"close":15.82,"value":15.82,"volumefrom":3.87,"volumeto":61.34,"volume":57.47},{"date":"2017-10-17 20:27:00","open":15.85,"low":15.85,"high":15.83,"close":15.84,"value":15.84,"volumefrom":2.58,"volumeto":40.89,"volume":38.31},{"date":"2017-10-17 20:26:00","open":15.87,"low":15.87,"high":15.84,"close":15.84,"value":15.84,"volumefrom":15.64,"volumeto":247.75,"volume":232.11},{"date":"2017-10-17 20:25:00","open":15.86,"low":15.87,"high":15.85,"close":15.87,"value":15.87,"volumefrom":10.34,"volumeto":163.94,"volume":153.6},{"date":"2017-10-17 20:24:00","open":15.86,"low":15.87,"high":15.85,"close":15.86,"value":15.86,"volumefrom":8.14,"volumeto":129.16,"volume":121.02},{"date":"2017-10-17 20:23:00","open":15.86,"low":15.87,"high":15.84,"close":15.86,"value":15.86,"volumefrom":24.59,"volumeto":389.85,"volume":365.26},{"date":"2017-10-17 20:22:00","open":15.9,"low":15.9,"high":15.87,"close":15.87,"value":15.87,"volumefrom":27.59,"volumeto":437.86,"volume":410.27},{"date":"2017-10-17 20:21:00","open":15.89,"low":15.9,"high":15.87,"close":15.9,"value":15.9,"volumefrom":26.19,"volumeto":416.12,"volume":389.93},{"date":"2017-10-17 20:20:00","open":15.88,"low":15.91,"high":15.88,"close":15.89,"value":15.89,"volumefrom":20.6,"volumeto":327.94,"volume":307.34},{"date":"2017-10-17 20:19:00","open":15.84,"low":15.89,"high":15.84,"close":15.88,"value":15.88,"volumefrom":16.61,"volumeto":264.57,"volume":247.96},{"date":"2017-10-17 20:18:00","open":15.82,"low":15.89,"high":15.79,"close":15.85,"value":15.85,"volumefrom":39.97,"volumeto":634.09,"volume":594.12},{"date":"2017-10-17 20:17:00","open":15.85,"low":15.86,"high":15.77,"close":15.81,"value":15.81,"volumefrom":40.31,"volumeto":637.81,"volume":597.5},{"date":"2017-10-17 20:16:00","open":15.88,"low":15.88,"high":15.81,"close":15.83,"value":15.83,"volumefrom":21.37,"volumeto":338.51,"volume":317.14},{"date":"2017-10-17 20:15:00","open":15.87,"low":15.92,"high":15.85,"close":15.88,"value":15.88,"volumefrom":26.14,"volumeto":415.05,"volume":388.91},{"date":"2017-10-17 20:14:00","open":15.84,"low":15.87,"high":15.84,"close":15.87,"value":15.87,"volumefrom":23.84,"volumeto":378.69,"volume":354.85},{"date":"2017-10-17 20:13:00","open":15.83,"low":15.85,"high":15.82,"close":15.84,"value":15.84,"volumefrom":2.72,"volumeto":43.08,"volume":40.36},{"date":"2017-10-17 20:12:00","open":15.82,"low":15.83,"high":15.82,"close":15.83,"value":15.83,"volumefrom":1.21,"volumeto":19.13,"volume":17.92},{"date":"2017-10-17 20:11:00","open":15.82,"low":15.82,"high":15.82,"close":15.82,"value":15.82,"volumefrom":0.6381,"volumeto":10.01,"volume":9.3719},{"date":"2017-10-17 20:10:00","open":15.84,"low":15.84,"high":15.82,"close":15.82,"value":15.82,"volumefrom":17.23,"volumeto":272.86,"volume":255.63},{"date":"2017-10-17 20:09:00","open":15.82,"low":15.84,"high":15.81,"close":15.84,"value":15.84,"volumefrom":17.82,"volumeto":281.36,"volume":263.54},{"date":"2017-10-17 20:08:00","open":15.81,"low":15.85,"high":15.81,"close":15.82,"value":15.82,"volumefrom":26.32,"volumeto":416.14,"volume":389.82},{"date":"2017-10-17 20:07:00","open":15.83,"low":15.85,"high":15.81,"close":15.82,"value":15.82,"volumefrom":24.71,"volumeto":388.79,"volume":364.08},{"date":"2017-10-17 20:06:00","open":15.84,"low":15.84,"high":15.78,"close":15.81,"value":15.81,"volumefrom":24.54,"volumeto":388.81,"volume":364.27},{"date":"2017-10-17 20:05:00","open":15.8,"low":15.84,"high":15.78,"close":15.84,"value":15.84,"volumefrom":10.02,"volumeto":158.81,"volume":148.79},{"date":"2017-10-17 20:04:00","open":15.75,"low":15.88,"high":15.75,"close":15.79,"value":15.79,"volumefrom":17.43,"volumeto":276.7,"volume":259.27},{"date":"2017-10-17 20:03:00","open":15.72,"low":15.86,"high":15.71,"close":15.76,"value":15.76,"volumefrom":23.57,"volumeto":372.5,"volume":348.93},{"date":"2017-10-17 20:02:00","open":15.68,"low":15.82,"high":15.66,"close":15.73,"value":15.73,"volumefrom":25.97,"volumeto":409.76,"volume":383.79},{"date":"2017-10-17 20:01:00","open":15.72,"low":15.72,"high":15.69,"close":15.69,"value":15.69,"volumefrom":7.44,"volumeto":116.68,"volume":109.24},{"date":"2017-10-17 20:00:00","open":15.69,"low":15.73,"high":15.69,"close":15.72,"value":15.72,"volumefrom":21.48,"volumeto":337.14,"volume":315.66},{"date":"2017-10-17 19:59:00","open":15.75,"low":15.75,"high":15.72,"close":15.74,"value":15.74,"volumefrom":17.14,"volumeto":269.56,"volume":252.42},{"date":"2017-10-17 19:58:00","open":15.87,"low":15.88,"high":15.79,"close":15.79,"value":15.79,"volumefrom":27.52,"volumeto":435.31,"volume":407.79},{"date":"2017-10-17 19:57:00","open":15.89,"low":15.89,"high":15.87,"close":15.88,"value":15.88,"volumefrom":11.52,"volumeto":182.45,"volume":170.93},{"date":"2017-10-17 19:56:00","open":15.88,"low":15.89,"high":15.88,"close":15.89,"value":15.89,"volumefrom":9.36,"volumeto":148.41,"volume":139.05},{"date":"2017-10-17 19:55:00","open":15.89,"low":15.89,"high":15.88,"close":15.89,"value":15.89,"volumefrom":2.26,"volumeto":35.79,"volume":33.53},{"date":"2017-10-17 19:54:00","open":15.88,"low":15.91,"high":15.88,"close":15.89,"value":15.89,"volumefrom":5.73,"volumeto":91.02,"volume":85.29},{"date":"2017-10-17 19:53:00","open":15.87,"low":15.91,"high":15.87,"close":15.88,"value":15.88,"volumefrom":8.68,"volumeto":137.82,"volume":129.14},{"date":"2017-10-17 19:52:00","open":15.89,"low":15.9,"high":15.87,"close":15.87,"value":15.87,"volumefrom":12.43,"volumeto":197.38,"volume":184.95},{"date":"2017-10-17 19:51:00","open":15.87,"low":15.89,"high":15.87,"close":15.89,"value":15.89,"volumefrom":18,"volumeto":285.67,"volume":267.67},{"date":"2017-10-17 19:50:00","open":15.82,"low":15.86,"high":15.82,"close":15.86,"value":15.86,"volumefrom":22.63,"volumeto":358.86,"volume":336.23},{"date":"2017-10-17 19:49:00","open":15.8,"low":15.82,"high":15.78,"close":15.82,"value":15.82,"volumefrom":9.35,"volumeto":147.77,"volume":138.42},{"date":"2017-10-17 19:48:00","open":15.85,"low":15.85,"high":15.75,"close":15.79,"value":15.79,"volumefrom":12.57,"volumeto":199.17,"volume":186.6},{"date":"2017-10-17 19:47:00","open":15.7,"low":15.82,"high":15.65,"close":15.7,"value":15.7,"volumefrom":44,"volumeto":696.06,"volume":652.06},{"date":"2017-10-17 19:46:00","open":15.77,"low":15.79,"high":15.7,"close":15.71,"value":15.71,"volumefrom":25.5,"volumeto":401.38,"volume":375.88},{"date":"2017-10-17 19:45:00","open":15.81,"low":15.85,"high":15.75,"close":15.78,"value":15.78,"volumefrom":29.43,"volumeto":463.8,"volume":434.37},{"date":"2017-10-17 19:44:00","open":15.8,"low":15.82,"high":15.79,"close":15.81,"value":15.81,"volumefrom":28.58,"volumeto":451.05,"volume":422.47},{"date":"2017-10-17 19:43:00","open":15.83,"low":15.84,"high":15.8,"close":15.8,"value":15.8,"volumefrom":5.73,"volumeto":90.65,"volume":84.92},{"date":"2017-10-17 19:42:00","open":15.81,"low":15.84,"high":15.78,"close":15.83,"value":15.83,"volumefrom":9.33,"volumeto":146.99,"volume":137.66},{"date":"2017-10-17 19:41:00","open":15.73,"low":15.79,"high":15.73,"close":15.79,"value":15.79,"volumefrom":13.66,"volumeto":215.45,"volume":201.79},{"date":"2017-10-17 19:40:00","open":15.71,"low":15.83,"high":15.68,"close":15.73,"value":15.73,"volumefrom":13.07,"volumeto":205.88,"volume":192.81},{"date":"2017-10-17 19:39:00","open":15.63,"low":15.8,"high":15.62,"close":15.73,"value":15.73,"volumefrom":38.65,"volumeto":610.72,"volume":572.07},{"date":"2017-10-17 19:38:00","open":15.63,"low":15.65,"high":15.63,"close":15.63,"value":15.63,"volumefrom":5.44,"volumeto":85.01,"volume":79.57},{"date":"2017-10-17 19:37:00","open":15.63,"low":15.65,"high":15.61,"close":15.63,"value":15.63,"volumefrom":3.74,"volumeto":58.59,"volume":54.85},{"date":"2017-10-17 19:36:00","open":15.56,"low":15.65,"high":15.56,"close":15.63,"value":15.63,"volumefrom":23.09,"volumeto":361.8,"volume":338.71},{"date":"2017-10-17 19:35:00","open":15.39,"low":15.56,"high":15.39,"close":15.56,"value":15.56,"volumefrom":26.7,"volumeto":415.15,"volume":388.45},{"date":"2017-10-17 19:34:00","open":15.34,"low":15.42,"high":15.34,"close":15.39,"value":15.39,"volumefrom":16.72,"volumeto":258.37,"volume":241.65},{"date":"2017-10-17 19:33:00","open":15.31,"low":15.34,"high":15.28,"close":15.34,"value":15.34,"volumefrom":16.82,"volumeto":257.79,"volume":240.97},{"date":"2017-10-17 19:32:00","open":15.27,"low":15.31,"high":15.26,"close":15.3,"value":15.3,"volumefrom":15.72,"volumeto":239.93,"volume":224.21},{"date":"2017-10-17 19:31:00","open":15.26,"low":15.33,"high":15.25,"close":15.27,"value":15.27,"volumefrom":78.95,"volumeto":1222.5,"volume":1143.55},{"date":"2017-10-17 19:30:00","open":15.27,"low":15.28,"high":15.25,"close":15.26,"value":15.26,"volumefrom":5.08,"volumeto":77.47,"volume":72.39},{"date":"2017-10-17 19:29:00","open":15.28,"low":15.29,"high":15.27,"close":15.27,"value":15.27,"volumefrom":21,"volumeto":320.82,"volume":299.82},{"date":"2017-10-17 19:28:00","open":15.29,"low":15.3,"high":15.28,"close":15.29,"value":15.29,"volumefrom":22.98,"volumeto":351.35,"volume":328.37},{"date":"2017-10-17 19:27:00","open":15.31,"low":15.31,"high":15.29,"close":15.29,"value":15.29,"volumefrom":18.8,"volumeto":287.57,"volume":268.77},{"date":"2017-10-17 19:26:00","open":15.33,"low":15.34,"high":15.3,"close":15.31,"value":15.31,"volumefrom":28.78,"volumeto":440.28,"volume":411.5},{"date":"2017-10-17 19:25:00","open":15.36,"low":15.36,"high":15.32,"close":15.34,"value":15.34,"volumefrom":22.12,"volumeto":339.32,"volume":317.2},{"date":"2017-10-17 19:24:00","open":15.37,"low":15.37,"high":15.34,"close":15.35,"value":15.35,"volumefrom":27.87,"volumeto":427.8,"volume":399.93},{"date":"2017-10-17 19:23:00","open":15.37,"low":15.38,"high":15.37,"close":15.37,"value":15.37,"volumefrom":17.17,"volumeto":263.84,"volume":246.67},{"date":"2017-10-17 19:22:00","open":15.35,"low":15.38,"high":15.35,"close":15.38,"value":15.38,"volumefrom":29.91,"volumeto":459.59,"volume":429.68},{"date":"2017-10-17 19:21:00","open":15.38,"low":15.38,"high":15.34,"close":15.35,"value":15.35,"volumefrom":25.52,"volumeto":391.54,"volume":366.02},{"date":"2017-10-17 19:20:00","open":15.36,"low":15.38,"high":15.35,"close":15.37,"value":15.37,"volumefrom":19.36,"volumeto":297.15,"volume":277.79},{"date":"2017-10-17 19:19:00","open":15.37,"low":15.39,"high":15.37,"close":15.37,"value":15.37,"volumefrom":25.57,"volumeto":392.58,"volume":367.01},{"date":"2017-10-17 19:18:00","open":15.36,"low":15.38,"high":15.35,"close":15.38,"value":15.38,"volumefrom":35.54,"volumeto":546.59,"volume":511.05},{"date":"2017-10-17 19:17:00","open":15.36,"low":15.37,"high":15.36,"close":15.36,"value":15.36,"volumefrom":28.08,"volumeto":431.14,"volume":403.06},{"date":"2017-10-17 19:16:00","open":15.36,"low":15.36,"high":15.36,"close":15.36,"value":15.36,"volumefrom":31.69,"volumeto":486.82,"volume":455.13},{"date":"2017-10-17 19:15:00","open":15.38,"low":15.38,"high":15.36,"close":15.37,"value":15.37,"volumefrom":15.91,"volumeto":244.47,"volume":228.56},{"date":"2017-10-17 19:14:00","open":15.38,"low":15.39,"high":15.38,"close":15.38,"value":15.38,"volumefrom":25.5,"volumeto":391.91,"volume":366.41},{"date":"2017-10-17 19:13:00","open":15.38,"low":15.39,"high":15.37,"close":15.38,"value":15.38,"volumefrom":28.14,"volumeto":432.64,"volume":404.5},{"date":"2017-10-17 19:12:00","open":15.43,"low":15.43,"high":15.37,"close":15.38,"value":15.38,"volumefrom":26,"volumeto":400.31,"volume":374.31},{"date":"2017-10-17 19:11:00","open":15.45,"low":15.47,"high":15.43,"close":15.43,"value":15.43,"volumefrom":10.58,"volumeto":162.94,"volume":152.36},{"date":"2017-10-17 19:10:00","open":15.47,"low":15.49,"high":15.45,"close":15.45,"value":15.45,"volumefrom":41.3,"volumeto":637.64,"volume":596.34},{"date":"2017-10-17 19:09:00","open":15.53,"low":15.53,"high":15.46,"close":15.47,"value":15.47,"volumefrom":30.37,"volumeto":468.93,"volume":438.56},{"date":"2017-10-17 19:08:00","open":15.56,"low":15.56,"high":15.5,"close":15.53,"value":15.53,"volumefrom":13.05,"volumeto":202.31,"volume":189.26},{"date":"2017-10-17 19:07:00","open":15.63,"low":15.63,"high":15.56,"close":15.56,"value":15.56,"volumefrom":28.85,"volumeto":449.35,"volume":420.5},{"date":"2017-10-17 19:06:00","open":15.6,"low":15.63,"high":15.6,"close":15.61,"value":15.61,"volumefrom":20.17,"volumeto":315.51,"volume":295.34},{"date":"2017-10-17 19:05:00","open":15.61,"low":15.61,"high":15.6,"close":15.6,"value":15.6,"volumefrom":25.65,"volumeto":400.38,"volume":374.73},{"date":"2017-10-17 19:04:00","open":15.63,"low":15.63,"high":15.6,"close":15.61,"value":15.61,"volumefrom":24.45,"volumeto":381.39,"volume":356.94},{"date":"2017-10-17 19:03:00","open":15.61,"low":15.63,"high":15.61,"close":15.61,"value":15.61,"volumefrom":14.81,"volumeto":230.89,"volume":216.08},{"date":"2017-10-17 19:02:00","open":15.64,"low":15.64,"high":15.61,"close":15.61,"value":15.61,"volumefrom":9.84,"volumeto":153.51,"volume":143.67},{"date":"2017-10-17 19:01:00","open":15.65,"low":15.65,"high":15.64,"close":15.64,"value":15.64,"volumefrom":22.89,"volumeto":357.76,"volume":334.87},{"date":"2017-10-17 19:00:00","open":15.65,"low":15.67,"high":15.65,"close":15.65,"value":15.65,"volumefrom":22.94,"volumeto":358.77,"volume":335.83},{"date":"2017-10-17 18:59:00","open":15.64,"low":15.65,"high":15.63,"close":15.65,"value":15.65,"volumefrom":21.3,"volumeto":333.43,"volume":312.13},{"date":"2017-10-17 18:58:00","open":15.66,"low":15.67,"high":15.63,"close":15.64,"value":15.64,"volumefrom":17.01,"volumeto":266.06,"volume":249.05},{"date":"2017-10-17 18:57:00","open":15.67,"low":15.67,"high":15.64,"close":15.66,"value":15.66,"volumefrom":21.57,"volumeto":337.27,"volume":315.7},{"date":"2017-10-17 18:56:00","open":15.65,"low":15.67,"high":15.63,"close":15.67,"value":15.67,"volumefrom":27.8,"volumeto":434.54,"volume":406.74},{"date":"2017-10-17 18:55:00","open":15.72,"low":15.72,"high":15.64,"close":15.65,"value":15.65,"volumefrom":21.65,"volumeto":337.19,"volume":315.54},{"date":"2017-10-17 18:54:00","open":15.67,"low":15.72,"high":15.67,"close":15.71,"value":15.71,"volumefrom":25.2,"volumeto":395.13,"volume":369.93},{"date":"2017-10-17 18:53:00","open":15.61,"low":15.67,"high":15.61,"close":15.66,"value":15.66,"volumefrom":12.72,"volumeto":199.29,"volume":186.57},{"date":"2017-10-17 18:52:00","open":15.58,"low":15.62,"high":15.58,"close":15.6,"value":15.6,"volumefrom":9.38,"volumeto":146.43,"volume":137.05},{"date":"2017-10-17 18:51:00","open":15.63,"low":15.63,"high":15.58,"close":15.58,"value":15.58,"volumefrom":16.95,"volumeto":264.58,"volume":247.63},{"date":"2017-10-17 18:50:00","open":15.67,"low":15.67,"high":15.62,"close":15.62,"value":15.62,"volumefrom":33.75,"volumeto":525.69,"volume":491.94},{"date":"2017-10-17 18:49:00","open":15.73,"low":15.73,"high":15.67,"close":15.67,"value":15.67,"volumefrom":23.24,"volumeto":362.67,"volume":339.43},{"date":"2017-10-17 18:48:00","open":15.73,"low":15.74,"high":15.71,"close":15.71,"value":15.71,"volumefrom":17.6,"volumeto":275.15,"volume":257.55},{"date":"2017-10-17 18:47:00","open":15.75,"low":15.75,"high":15.73,"close":15.73,"value":15.73,"volumefrom":13.79,"volumeto":216.33,"volume":202.54},{"date":"2017-10-17 18:46:00","open":15.84,"low":15.84,"high":15.74,"close":15.75,"value":15.75,"volumefrom":23.28,"volumeto":366.32,"volume":343.04},{"date":"2017-10-17 18:45:00","open":15.9,"low":15.9,"high":15.84,"close":15.84,"value":15.84,"volumefrom":8.2,"volumeto":129.86,"volume":121.66},{"date":"2017-10-17 18:44:00","open":15.94,"low":15.98,"high":15.91,"close":15.91,"value":15.91,"volumefrom":20.87,"volumeto":332.22,"volume":311.35},{"date":"2017-10-17 18:43:00","open":15.98,"low":15.99,"high":15.94,"close":15.94,"value":15.94,"volumefrom":18.73,"volumeto":298.95,"volume":280.22},{"date":"2017-10-17 18:42:00","open":16.03,"low":16.03,"high":15.98,"close":15.98,"value":15.98,"volumefrom":13.69,"volumeto":218.97,"volume":205.28},{"date":"2017-10-17 18:41:00","open":16.06,"low":16.07,"high":16.03,"close":16.03,"value":16.03,"volumefrom":12.08,"volumeto":193.64,"volume":181.56},{"date":"2017-10-17 18:40:00","open":16.07,"low":16.08,"high":16.06,"close":16.06,"value":16.06,"volumefrom":22.65,"volumeto":363.7,"volume":341.05},{"date":"2017-10-17 18:39:00","open":16.08,"low":16.08,"high":16.06,"close":16.07,"value":16.07,"volumefrom":28.43,"volumeto":457.26,"volume":428.83},{"date":"2017-10-17 18:38:00","open":16.09,"low":16.11,"high":16.07,"close":16.09,"value":16.09,"volumefrom":24.26,"volumeto":390,"volume":365.74},{"date":"2017-10-17 18:37:00","open":16.13,"low":16.13,"high":16.11,"close":16.11,"value":16.11,"volumefrom":21,"volumeto":338,"volume":317},{"date":"2017-10-17 18:36:00","open":16.13,"low":16.13,"high":16.12,"close":16.12,"value":16.12,"volumefrom":22.44,"volumeto":361.63,"volume":339.19},{"date":"2017-10-17 18:35:00","open":16.14,"low":16.14,"high":16.12,"close":16.12,"value":16.12,"volumefrom":21.64,"volumeto":348.76,"volume":327.12},{"date":"2017-10-17 18:34:00","open":16.14,"low":16.16,"high":16.12,"close":16.15,"value":16.15,"volumefrom":25.78,"volumeto":416.19,"volume":390.41},{"date":"2017-10-17 18:33:00","open":16.17,"low":16.18,"high":16.13,"close":16.14,"value":16.14,"volumefrom":35.43,"volumeto":572.64,"volume":537.21},{"date":"2017-10-17 18:32:00","open":16.19,"low":16.19,"high":16.18,"close":16.18,"value":16.18,"volumefrom":21.41,"volumeto":346.5,"volume":325.09},{"date":"2017-10-17 18:31:00","open":16.22,"low":16.22,"high":16.19,"close":16.19,"value":16.19,"volumefrom":20.23,"volumeto":327.9,"volume":307.67},{"date":"2017-10-17 18:30:00","open":16.23,"low":16.23,"high":16.19,"close":16.22,"value":16.22,"volumefrom":22.07,"volumeto":357.9,"volume":335.83},{"date":"2017-10-17 18:29:00","open":16.2,"low":16.25,"high":16.2,"close":16.23,"value":16.23,"volumefrom":37.05,"volumeto":605.65,"volume":568.6},{"date":"2017-10-17 18:28:00","open":16.22,"low":16.24,"high":16.18,"close":16.22,"value":16.22,"volumefrom":32.4,"volumeto":526.36,"volume":493.96},{"date":"2017-10-17 18:27:00","open":16.19,"low":16.22,"high":16.18,"close":16.22,"value":16.22,"volumefrom":32.4,"volumeto":525.12,"volume":492.72},{"date":"2017-10-17 18:26:00","open":16.17,"low":16.2,"high":16.17,"close":16.18,"value":16.18,"volumefrom":25.73,"volumeto":416.38,"volume":390.65},{"date":"2017-10-17 18:25:00","open":16.16,"low":16.19,"high":16.16,"close":16.17,"value":16.17,"volumefrom":19.48,"volumeto":315.05,"volume":295.57},{"date":"2017-10-17 18:24:00","open":16.18,"low":16.18,"high":16.15,"close":16.16,"value":16.16,"volumefrom":20.88,"volumeto":337.79,"volume":316.91},{"date":"2017-10-17 18:23:00","open":16.21,"low":16.21,"high":16.18,"close":16.18,"value":16.18,"volumefrom":16.21,"volumeto":262.39,"volume":246.18},{"date":"2017-10-17 18:22:00","open":16.2,"low":16.21,"high":16.2,"close":16.21,"value":16.21,"volumefrom":13.68,"volumeto":221.51,"volume":207.83},{"date":"2017-10-17 18:21:00","open":16.22,"low":16.23,"high":16.2,"close":16.2,"value":16.2,"volumefrom":17.69,"volumeto":286.73,"volume":269.04},{"date":"2017-10-17 18:20:00","open":16.17,"low":16.24,"high":16.16,"close":16.22,"value":16.22,"volumefrom":27.19,"volumeto":440.55,"volume":413.36},{"date":"2017-10-17 18:19:00","open":16.17,"low":16.19,"high":16.17,"close":16.17,"value":16.17,"volumefrom":25.61,"volumeto":413.94,"volume":388.33},{"date":"2017-10-17 18:18:00","open":16.17,"low":16.18,"high":16.15,"close":16.17,"value":16.17,"volumefrom":34.66,"volumeto":559.98,"volume":525.32},{"date":"2017-10-17 18:17:00","open":16.17,"low":16.19,"high":16.13,"close":16.17,"value":16.17,"volumefrom":25.01,"volumeto":404.18,"volume":379.17},{"date":"2017-10-17 18:16:00","open":16.18,"low":16.19,"high":16.14,"close":16.17,"value":16.17,"volumefrom":18.09,"volumeto":292.76,"volume":274.67},{"date":"2017-10-17 18:15:00","open":16.17,"low":16.2,"high":16.16,"close":16.18,"value":16.18,"volumefrom":22.37,"volumeto":362.13,"volume":339.76},{"date":"2017-10-17 18:14:00","open":16.16,"low":16.19,"high":16.16,"close":16.18,"value":16.18,"volumefrom":18.29,"volumeto":295.92,"volume":277.63},{"date":"2017-10-17 18:13:00","open":16.17,"low":16.19,"high":16.14,"close":16.18,"value":16.18,"volumefrom":27.67,"volumeto":447.6,"volume":419.93},{"date":"2017-10-17 18:12:00","open":16.12,"low":16.22,"high":16.12,"close":16.14,"value":16.14,"volumefrom":31.05,"volumeto":502.25,"volume":471.2},{"date":"2017-10-17 18:11:00","open":16.08,"low":16.13,"high":16.07,"close":16.12,"value":16.12,"volumefrom":13.92,"volumeto":224.26,"volume":210.34},{"date":"2017-10-17 18:10:00","open":16.07,"low":16.09,"high":16.07,"close":16.08,"value":16.08,"volumefrom":20.16,"volumeto":324.36,"volume":304.2},{"date":"2017-10-17 18:09:00","open":16.06,"low":16.09,"high":16.06,"close":16.07,"value":16.07,"volumefrom":5.04,"volumeto":81.04,"volume":76},{"date":"2017-10-17 18:08:00","open":16.02,"low":16.08,"high":16.02,"close":16.06,"value":16.06,"volumefrom":14.51,"volumeto":233.14,"volume":218.63},{"date":"2017-10-17 18:07:00","open":16.05,"low":16.07,"high":16.05,"close":16.07,"value":16.07,"volumefrom":3.78,"volumeto":60.73,"volume":56.95},{"date":"2017-10-17 18:06:00","open":16.02,"low":16.05,"high":16.02,"close":16.05,"value":16.05,"volumefrom":7.83,"volumeto":125.51,"volume":117.68},{"date":"2017-10-17 18:05:00","open":16.02,"low":16.03,"high":16.01,"close":16.02,"value":16.02,"volumefrom":20.78,"volumeto":333.15,"volume":312.37},{"date":"2017-10-17 18:04:00","open":16.03,"low":16.03,"high":16,"close":16.02,"value":16.02,"volumefrom":13,"volumeto":208.34,"volume":195.34},{"date":"2017-10-17 18:03:00","open":16.01,"low":16.01,"high":15.98,"close":15.99,"value":15.99,"volumefrom":21.86,"volumeto":349.9,"volume":328.04},{"date":"2017-10-17 18:02:00","open":15.98,"low":16.01,"high":15.97,"close":15.99,"value":15.99,"volumefrom":26.62,"volumeto":426,"volume":399.38},{"date":"2017-10-17 18:01:00","open":15.97,"low":15.99,"high":15.95,"close":15.98,"value":15.98,"volumefrom":21.26,"volumeto":339.98,"volume":318.72},{"date":"2017-10-17 18:00:00","open":15.94,"low":15.97,"high":15.92,"close":15.97,"value":15.97,"volumefrom":21.62,"volumeto":344.91,"volume":323.29},{"date":"2017-10-17 17:59:00","open":15.96,"low":15.96,"high":15.94,"close":15.94,"value":15.94,"volumefrom":17.51,"volumeto":279.07,"volume":261.56},{"date":"2017-10-17 17:58:00","open":16.01,"low":16.02,"high":15.95,"close":15.98,"value":15.98,"volumefrom":26.35,"volumeto":420.64,"volume":394.29},{"date":"2017-10-17 17:57:00","open":16.08,"low":16.08,"high":16.03,"close":16.03,"value":16.03,"volumefrom":22.65,"volumeto":363.11,"volume":340.46},{"date":"2017-10-17 17:56:00","open":16.08,"low":16.1,"high":16.08,"close":16.08,"value":16.08,"volumefrom":35.95,"volumeto":577.75,"volume":541.8},{"date":"2017-10-17 17:55:00","open":16.07,"low":16.1,"high":16.07,"close":16.08,"value":16.08,"volumefrom":22.39,"volumeto":360.16,"volume":337.77},{"date":"2017-10-17 17:54:00","open":16.13,"low":16.13,"high":16.06,"close":16.07,"value":16.07,"volumefrom":37.48,"volumeto":603.16,"volume":565.68},{"date":"2017-10-17 17:53:00","open":16.17,"low":16.18,"high":16.14,"close":16.15,"value":16.15,"volumefrom":29.25,"volumeto":472.06,"volume":442.81},{"date":"2017-10-17 17:52:00","open":16.17,"low":16.18,"high":16.16,"close":16.17,"value":16.17,"volumefrom":25.13,"volumeto":406.66,"volume":381.53},{"date":"2017-10-17 17:51:00","open":16.18,"low":16.19,"high":16.16,"close":16.17,"value":16.17,"volumefrom":20.88,"volumeto":337.88,"volume":317},{"date":"2017-10-17 17:50:00","open":16.21,"low":16.23,"high":16.17,"close":16.18,"value":16.18,"volumefrom":13.19,"volumeto":213.57,"volume":200.38},{"date":"2017-10-17 17:49:00","open":16.2,"low":16.21,"high":16.17,"close":16.21,"value":16.21,"volumefrom":23.01,"volumeto":372.86,"volume":349.85},{"date":"2017-10-17 17:48:00","open":16.19,"low":16.21,"high":16.17,"close":16.18,"value":16.18,"volumefrom":25.24,"volumeto":409.58,"volume":384.34},{"date":"2017-10-17 17:47:00","open":16.18,"low":16.22,"high":16.17,"close":16.19,"value":16.19,"volumefrom":44.56,"volumeto":722.55,"volume":677.99},{"date":"2017-10-17 17:46:00","open":16.16,"low":16.18,"high":16.16,"close":16.18,"value":16.18,"volumefrom":21.18,"volumeto":343.32,"volume":322.14},{"date":"2017-10-17 17:45:00","open":16.15,"low":16.17,"high":16.12,"close":16.16,"value":16.16,"volumefrom":30.08,"volumeto":487.38,"volume":457.3},{"date":"2017-10-17 17:44:00","open":16.15,"low":16.17,"high":16.14,"close":16.15,"value":16.15,"volumefrom":12.5,"volumeto":202.17,"volume":189.67},{"date":"2017-10-17 17:43:00","open":16.07,"low":16.13,"high":16.07,"close":16.13,"value":16.13,"volumefrom":25.99,"volumeto":419.06,"volume":393.07},{"date":"2017-10-17 17:42:00","open":16.11,"low":16.11,"high":16.07,"close":16.09,"value":16.09,"volumefrom":25.02,"volumeto":402.63,"volume":377.61},{"date":"2017-10-17 17:41:00","open":16.09,"low":16.11,"high":16.08,"close":16.09,"value":16.09,"volumefrom":20.68,"volumeto":332.54,"volume":311.86},{"date":"2017-10-17 17:40:00","open":16.04,"low":16.11,"high":16.04,"close":16.1,"value":16.1,"volumefrom":37.41,"volumeto":603.32,"volume":565.91},{"date":"2017-10-17 17:39:00","open":16.08,"low":16.09,"high":16.04,"close":16.09,"value":16.09,"volumefrom":31.48,"volumeto":506.31,"volume":474.83},{"date":"2017-10-17 17:38:00","open":16.11,"low":16.12,"high":16.05,"close":16.08,"value":16.08,"volumefrom":58.59,"volumeto":961.3,"volume":902.71},{"date":"2017-10-17 17:37:00","open":16.11,"low":16.13,"high":16.08,"close":16.11,"value":16.11,"volumefrom":19.43,"volumeto":312.52,"volume":293.09},{"date":"2017-10-17 17:36:00","open":16.14,"low":16.17,"high":16.11,"close":16.11,"value":16.11,"volumefrom":41.38,"volumeto":686.07,"volume":644.69},{"date":"2017-10-17 17:35:00","open":16.14,"low":16.16,"high":16.13,"close":16.14,"value":16.14,"volumefrom":22,"volumeto":355.56,"volume":333.56},{"date":"2017-10-17 17:34:00","open":16.14,"low":16.17,"high":16.1,"close":16.14,"value":16.14,"volumefrom":51.53,"volumeto":832.78,"volume":781.25},{"date":"2017-10-17 17:33:00","open":16.11,"low":16.16,"high":16.1,"close":16.14,"value":16.14,"volumefrom":66.17,"volumeto":1068.55,"volume":1002.38},{"date":"2017-10-17 17:32:00","open":16.09,"low":16.11,"high":16.09,"close":16.11,"value":16.11,"volumefrom":33.75,"volumeto":544.09,"volume":510.34},{"date":"2017-10-17 17:31:00","open":15.97,"low":16.09,"high":15.97,"close":16.09,"value":16.09,"volumefrom":36.82,"volumeto":592.7,"volume":555.88},{"date":"2017-10-17 17:30:00","open":15.94,"low":16.03,"high":15.94,"close":15.97,"value":15.97,"volumefrom":34.58,"volumeto":555.12,"volume":520.54},{"date":"2017-10-17 17:29:00","open":15.97,"low":15.99,"high":15.94,"close":15.98,"value":15.98,"volumefrom":48.25,"volumeto":771.73,"volume":723.48},{"date":"2017-10-17 17:28:00","open":15.92,"low":15.96,"high":15.92,"close":15.96,"value":15.96,"volumefrom":30.83,"volumeto":494.35,"volume":463.52},{"date":"2017-10-17 17:27:00","open":15.88,"low":15.9,"high":15.88,"close":15.89,"value":15.89,"volumefrom":21.11,"volumeto":336.45,"volume":315.34},{"date":"2017-10-17 17:26:00","open":15.87,"low":15.89,"high":15.86,"close":15.88,"value":15.88,"volumefrom":25.38,"volumeto":402.64,"volume":377.26},{"date":"2017-10-17 17:25:00","open":15.85,"low":15.87,"high":15.85,"close":15.86,"value":15.86,"volumefrom":23.05,"volumeto":365.73,"volume":342.68},{"date":"2017-10-17 17:24:00","open":15.85,"low":15.86,"high":15.84,"close":15.85,"value":15.85,"volumefrom":9.58,"volumeto":151.91,"volume":142.33},{"date":"2017-10-17 17:23:00","open":15.85,"low":15.86,"high":15.84,"close":15.85,"value":15.85,"volumefrom":19.98,"volumeto":316.82,"volume":296.84},{"date":"2017-10-17 17:22:00","open":15.85,"low":15.85,"high":15.82,"close":15.85,"value":15.85,"volumefrom":30.62,"volumeto":485.28,"volume":454.66},{"date":"2017-10-17 17:21:00","open":15.81,"low":15.86,"high":15.81,"close":15.85,"value":15.85,"volumefrom":23.04,"volumeto":364.6,"volume":341.56},{"date":"2017-10-17 17:20:00","open":15.8,"low":15.84,"high":15.78,"close":15.81,"value":15.81,"volumefrom":23.79,"volumeto":376.56,"volume":352.77},{"date":"2017-10-17 17:19:00","open":15.76,"low":15.8,"high":15.76,"close":15.8,"value":15.8,"volumefrom":9.61,"volumeto":151.55,"volume":141.94},{"date":"2017-10-17 17:18:00","open":15.73,"low":15.77,"high":15.73,"close":15.76,"value":15.76,"volumefrom":16.26,"volumeto":256.14,"volume":239.88},{"date":"2017-10-17 17:17:00","open":15.71,"low":15.73,"high":15.71,"close":15.72,"value":15.72,"volumefrom":25.1,"volumeto":394.92,"volume":369.82},{"date":"2017-10-17 17:16:00","open":15.72,"low":15.72,"high":15.7,"close":15.71,"value":15.71,"volumefrom":25.74,"volumeto":404.56,"volume":378.82},{"date":"2017-10-17 17:15:00","open":15.68,"low":15.73,"high":15.68,"close":15.71,"value":15.71,"volumefrom":22.45,"volumeto":352.62,"volume":330.17},{"date":"2017-10-17 17:14:00","open":15.67,"low":15.69,"high":15.66,"close":15.68,"value":15.68,"volumefrom":23.61,"volumeto":370.39,"volume":346.78},{"date":"2017-10-17 17:13:00","open":15.63,"low":15.67,"high":15.63,"close":15.67,"value":15.67,"volumefrom":18.39,"volumeto":288.33,"volume":269.94},{"date":"2017-10-17 17:12:00","open":15.63,"low":15.66,"high":15.63,"close":15.63,"value":15.63,"volumefrom":21.32,"volumeto":333.81,"volume":312.49},{"date":"2017-10-17 17:11:00","open":15.61,"low":15.63,"high":15.61,"close":15.63,"value":15.63,"volumefrom":12.74,"volumeto":199.06,"volume":186.32},{"date":"2017-10-17 17:10:00","open":15.61,"low":15.62,"high":15.6,"close":15.61,"value":15.61,"volumefrom":9.37,"volumeto":146.2,"volume":136.83},{"date":"2017-10-17 17:09:00","open":15.59,"low":15.61,"high":15.59,"close":15.61,"value":15.61,"volumefrom":13.63,"volumeto":212.74,"volume":199.11},{"date":"2017-10-17 17:08:00","open":15.59,"low":15.61,"high":15.59,"close":15.59,"value":15.59,"volumefrom":11.59,"volumeto":180.77,"volume":169.18},{"date":"2017-10-17 17:07:00","open":15.58,"low":15.58,"high":15.58,"close":15.58,"value":15.58,"volumefrom":11.15,"volumeto":173.72,"volume":162.57},{"date":"2017-10-17 17:06:00","open":15.56,"low":15.59,"high":15.56,"close":15.58,"value":15.58,"volumefrom":11.56,"volumeto":179.97,"volume":168.41},{"date":"2017-10-17 17:05:00","open":15.56,"low":15.57,"high":15.55,"close":15.56,"value":15.56,"volumefrom":12.42,"volumeto":193.52,"volume":181.1},{"date":"2017-10-17 17:04:00","open":15.55,"low":15.56,"high":15.53,"close":15.56,"value":15.56,"volumefrom":11.19,"volumeto":174.07,"volume":162.88},{"date":"2017-10-17 17:03:00","open":15.55,"low":15.56,"high":15.54,"close":15.55,"value":15.55,"volumefrom":12.67,"volumeto":196.9,"volume":184.23},{"date":"2017-10-17 17:02:00","open":15.54,"low":15.58,"high":15.54,"close":15.54,"value":15.54,"volumefrom":9.56,"volumeto":148.57,"volume":139.01},{"date":"2017-10-17 17:01:00","open":15.56,"low":15.56,"high":15.54,"close":15.54,"value":15.54,"volumefrom":11.02,"volumeto":171.26,"volume":160.24},{"date":"2017-10-17 17:00:00","open":15.55,"low":15.57,"high":15.55,"close":15.56,"value":15.56,"volumefrom":15.53,"volumeto":241.34,"volume":225.81},{"date":"2017-10-17 16:59:00","open":15.57,"low":15.59,"high":15.54,"close":15.55,"value":15.55,"volumefrom":16.6,"volumeto":258.06,"volume":241.46},{"date":"2017-10-17 16:58:00","open":15.59,"low":15.59,"high":15.57,"close":15.57,"value":15.57,"volumefrom":27.81,"volumeto":433.09,"volume":405.28},{"date":"2017-10-17 16:57:00","open":15.6,"low":15.6,"high":15.58,"close":15.59,"value":15.59,"volumefrom":18.6,"volumeto":288.94,"volume":270.34},{"date":"2017-10-17 16:56:00","open":15.59,"low":15.6,"high":15.59,"close":15.6,"value":15.6,"volumefrom":18.17,"volumeto":283.32,"volume":265.15},{"date":"2017-10-17 16:55:00","open":15.59,"low":15.61,"high":15.59,"close":15.6,"value":15.6,"volumefrom":24.47,"volumeto":381.3,"volume":356.83},{"date":"2017-10-17 16:54:00","open":15.6,"low":15.6,"high":15.59,"close":15.59,"value":15.59,"volumefrom":15.82,"volumeto":246.44,"volume":230.62},{"date":"2017-10-17 16:53:00","open":15.6,"low":15.6,"high":15.59,"close":15.6,"value":15.6,"volumefrom":36.82,"volumeto":574.39,"volume":537.57},{"date":"2017-10-17 16:52:00","open":15.6,"low":15.61,"high":15.6,"close":15.6,"value":15.6,"volumefrom":28.28,"volumeto":441.09,"volume":412.81},{"date":"2017-10-17 16:51:00","open":15.6,"low":15.6,"high":15.59,"close":15.6,"value":15.6,"volumefrom":15.18,"volumeto":236.8,"volume":221.62},{"date":"2017-10-17 16:50:00","open":15.61,"low":15.61,"high":15.59,"close":15.6,"value":15.6,"volumefrom":23.99,"volumeto":374.17,"volume":350.18},{"date":"2017-10-17 16:49:00","open":15.6,"low":15.62,"high":15.59,"close":15.61,"value":15.61,"volumefrom":29.74,"volumeto":464.09,"volume":434.35},{"date":"2017-10-17 16:48:00","open":15.6,"low":15.6,"high":15.59,"close":15.6,"value":15.6,"volumefrom":17.28,"volumeto":269.47,"volume":252.19},{"date":"2017-10-17 16:47:00","open":15.58,"low":15.6,"high":15.58,"close":15.6,"value":15.6,"volumefrom":13.13,"volumeto":204.81,"volume":191.68},{"date":"2017-10-17 16:46:00","open":15.58,"low":15.58,"high":15.58,"close":15.58,"value":15.58,"volumefrom":16.41,"volumeto":256,"volume":239.59},{"date":"2017-10-17 16:45:00","open":15.48,"low":15.61,"high":15.48,"close":15.6,"value":15.6,"volumefrom":46.23,"volumeto":721.12,"volume":674.89},{"date":"2017-10-17 16:44:00","open":15.58,"low":15.59,"high":15.48,"close":15.49,"value":15.49,"volumefrom":23.57,"volumeto":365.84,"volume":342.27},{"date":"2017-10-17 16:43:00","open":15.61,"low":15.61,"high":15.57,"close":15.58,"value":15.58,"volumefrom":28.01,"volumeto":436.95,"volume":408.94},{"date":"2017-10-17 16:42:00","open":15.65,"low":15.65,"high":15.61,"close":15.62,"value":15.62,"volumefrom":16.17,"volumeto":252.53,"volume":236.36},{"date":"2017-10-17 16:41:00","open":15.64,"low":15.65,"high":15.63,"close":15.65,"value":15.65,"volumefrom":18.2,"volumeto":284.88,"volume":266.68},{"date":"2017-10-17 16:40:00","open":15.67,"low":15.68,"high":15.64,"close":15.64,"value":15.64,"volumefrom":28.22,"volumeto":442.06,"volume":413.84},{"date":"2017-10-17 16:39:00","open":15.68,"low":15.68,"high":15.63,"close":15.66,"value":15.66,"volumefrom":17.74,"volumeto":277.97,"volume":260.23},{"date":"2017-10-17 16:38:00","open":15.69,"low":15.69,"high":15.66,"close":15.68,"value":15.68,"volumefrom":17.37,"volumeto":271.77,"volume":254.4},{"date":"2017-10-17 16:37:00","open":15.7,"low":15.71,"high":15.67,"close":15.68,"value":15.68,"volumefrom":22.09,"volumeto":346.48,"volume":324.39},{"date":"2017-10-17 16:36:00","open":15.73,"low":15.73,"high":15.69,"close":15.7,"value":15.7,"volumefrom":25.99,"volumeto":408.4,"volume":382.41},{"date":"2017-10-17 16:35:00","open":15.73,"low":15.73,"high":15.72,"close":15.73,"value":15.73,"volumefrom":26.58,"volumeto":418.25,"volume":391.67},{"date":"2017-10-17 16:34:00","open":15.72,"low":15.73,"high":15.71,"close":15.72,"value":15.72,"volumefrom":19.34,"volumeto":304.39,"volume":285.05},{"date":"2017-10-17 16:33:00","open":15.73,"low":15.73,"high":15.71,"close":15.72,"value":15.72,"volumefrom":20.93,"volumeto":329.43,"volume":308.5},{"date":"2017-10-17 16:32:00","open":15.76,"low":15.77,"high":15.71,"close":15.72,"value":15.72,"volumefrom":29.47,"volumeto":463.66,"volume":434.19},{"date":"2017-10-17 16:31:00","open":15.78,"low":15.78,"high":15.76,"close":15.76,"value":15.76,"volumefrom":31.24,"volumeto":492.39,"volume":461.15},{"date":"2017-10-17 16:30:00","open":15.77,"low":15.78,"high":15.76,"close":15.77,"value":15.77,"volumefrom":25.58,"volumeto":403.8,"volume":378.22},{"date":"2017-10-17 16:29:00","open":15.78,"low":15.8,"high":15.77,"close":15.77,"value":15.77,"volumefrom":24.37,"volumeto":384.47,"volume":360.1},{"date":"2017-10-17 16:28:00","open":15.77,"low":15.8,"high":15.77,"close":15.8,"value":15.8,"volumefrom":15.98,"volumeto":252.37,"volume":236.39},{"date":"2017-10-17 16:27:00","open":15.76,"low":15.78,"high":15.73,"close":15.77,"value":15.77,"volumefrom":23.89,"volumeto":376.93,"volume":353.04},{"date":"2017-10-17 16:26:00","open":15.75,"low":15.76,"high":15.72,"close":15.76,"value":15.76,"volumefrom":27.3,"volumeto":430.14,"volume":402.84},{"date":"2017-10-17 16:25:00","open":15.73,"low":15.76,"high":15.72,"close":15.75,"value":15.75,"volumefrom":24.94,"volumeto":392.8,"volume":367.86}]';
function TEST_jsonToData()
{
    newData.length = 0;
    // Конвертируем 
    jdata = JSON.parse(TEST_json);
    
//    for (var i=0; i<jdata.length; i++)
    for (var i=(jdata.length-1); i>(-1); i--)    
    {
//        var nd = new Date(jdata[i].date);
//        console.log(nd);
//        console.log(nd.getFullYear()+" "+nd.getMonth()+" "+nd.getDay()+" "+nd.getHours()+" "+nd.getMinutes());
        newData.push({
            // new Date(2014, 2, 1, 1, date),
            date: new Date(jdata[i].date),
            open: jdata[i].open,
            high: jdata[i].high,
            low: jdata[i].low,
            close: jdata[i].close,
            volume: jdata[i].volume,
        });
    }
//    console.log(newData);
    dataChart(newData);    
//    setPeriod(newData, 5);
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
