function Chart(el, props) {
        
        
    var
        self = this,
        eventNode = $({}),
        PROP_DATE_TO = '_dateTo',
        PROP_CUR_X = '_curX',
        PROP_CUR_Y = '_curY',
        PROP_CUR_SHOW = '_curShow',
        PROP_MAR_VOLUME = '_marginVolume',
        PROP_COL_BODYDN = '_colorBodyDown';
        
        this.xhrName = props.xhrName || 'BTC_BTS';
        this.xhrInstrumentId = props.xhrInstrumentId || 2;
        this.xhrUserId = props.xhrUserId || undefined;
        this.xhrPeriodFull = props.xhrPeriodFull || 1440;
        this.xhrPeriod = props.xhrPeriod || 60;
        this.xhrMaxInterval = props.xhrMaxInterval || 60000;
        this.xhrMinInterval = props.xhrMinInterval || 200;
        this.mouseDown = false;
        this.btnLine = props.btnLine || false;
        this.btnCandle = props.btnCandle || true;
        this.btnArea = props.btnArea || false;
        this.btnVolume = props.btnVolume || false;
        this.dataNum = props.dataNum || 120;
        this.dateFrom = props.dateFrom || 0;
        this.dateTo = props.dateTo || this[PROP_DATE_TO];
        this.noRedraw = props.noRedraw || false;
        this.curShow = props.curShow || this[PROP_CUR_SHOW];
        this.curX = props.curX || this[PROP_CUR_X];
        this.curY = props.curY || this[PROP_CUR_Y];
        this.labelYWidth = props.labelYWidth || 0;
        this.gtype = props.gtype || 'minute';
        this.barPanel = props.barPanel || false;
        this.gArea = props.gArea || true;
        this.gCandle = props.gCandle || true;
        this.lineColor = props.lineColor || "#22f";
        this.labelYWidth = props.labelYWidth || 75;
        this.labelXHeight = props.labelXHeight || 20;
        this.lineStrokeWidth = props.lineStrokeWidth || 2;
        this.lastTooltipCandleNum = props.lastTooltipCandleNum || 0;
        this.propertyLow = props.propertyLow || 'low';
        this.propertyHigh = props.propertyHigh || 'high';
        this.propertyVolume = props.propertyVolume || 'volume';
        this.propertyDate = props.propertyDate || 'date';
        this.propertyClose = props.propertyClose || 'close';
        this.propertyOpen = props.propertyOpen || 'open';
        this.barSpacing = props.barSpacing || 0.35;
        this.candleWidth = props.candleWidth || 0;
        this.marginCandle = props.marginCandle || 15;
        this.marginVolume = this[PROP_MAR_VOLUME] = props.marginVolume || 5;
        this.tick = props.tick || 100;
        this.tickShow = props.tickShow || false;
        this.tickOpen = props.tickOpen || 100;
        this.tickHigh = props.tickHigh || 100;
        this.tickLow = props.tickLow || 100;
        this.curXColor = props.curXColor || '#fff';
        this.curYColor = props.curYColor || '#fff';
        this.colorCandleBackground = props.colorCandleBackground || '#333';
        this.colorCandleBodyDown = props.colorCandleBodyDown || '#db4c3c';
        this.colorCandleStemDown = props.colorCandleStemDown || '#db4c3c';
        this.colorCandleBodyUp = props.colorCandleBodyUp || '#04bf85';
        this.colorCandleStemUp = props.colorCandleStemUp || '#04bf85';
        this.colorVolumeSell = props.colorVolumeSell || '#db4c3c';
        this.colorVolumeBuy = props.colorVolumeBuy || '#04bf85';
        this.colorVolumeSellBorder = props.colorVolumeSellBorder || '#db4c3c';
        this.colorVolumeBackground = props.colorVolumeBackground || '#222';
        this.colorVolumeBuyBorder = props.colorVolumeBuyBorder || this[PROP_COL_BODYDN];
        this.colorTick = props.colorTick || '#f00';
        this.colorTickLow = props.colorTickLow || '#a00';
        this.colorTickHigh = props.colorTickHigh || '#0a0';
        this.colorTickText = props.colorTickText || '#222';
        this.colorTickBg = props.colorTickBg || '#fff'; //Unuse,
        this.tickBodyColor = props.tickBodyColor || '#04bf85';
        this.tickStemColor = props.tickStemColor || '#04bf85';
        this.colorLabelTimeBackground = props.colorLabelTimeBackground || '#333';
        this.colorLabelTimeForeground = props.colorLabelTimeForeground || '#aaa';
        this.colorLabelCandleBackground = props.colorLabelCandleBackground || '#333';
        this.colorLabelCandleForeground = props.colorLabelCandleForeground || '#aaa';
        this.colorLabelVolumeBackground = props.colorLabelVolumeBackground || '#444';
        this.colorLabelVolumeForeground = props.colorLabelVolumeForeground || '#bbb';
    
        this.labelFontFamily = props.labelFontFamily || 'Ubuntu';
        this.labelFontSize = props.labelFontSize || 10;
        this.data = [];
        this.timerTick = 0; // Ticks to red line with current value redraw
        this.timerGraph = 0;
        this.mouseDownX = 0;
        this.width = props.width || "100%";
        this.height = props.height || "100%";
        this.aspectRatio = function() {
            return height / width;
        };
    
        this.elId = $(el).attr('id');
        this.svg = el;
        this.el = el;
    
        utils = window.utilities;
        identity = function(v) {
            return v;
        };

    this.redrawIdent = function () {
        return function(val) {
            redraw();
            return val;
        };
    };
    
    this.redrawGetSetter = function (prop, allowNull) {
        return {
            get: utils.getter(prop),
            set: utils.setter(prop, allowNull, redrawIdent()),
        };
    };

    this.low = function(prev, next) {
        if (prev === null) return next;
        
        return (next === null) ? prev : Math.min(prev, next);
    };

    this.high = function(prev, next) {
        if (prev === null) return next;
        return (next === null) ? prev : Math.max(prev, next);
    };

    this.dateMS = function(v) {
        if (v instanceof Date) return v.getTime();
        if (typeof v === 'string') {
            var ms = Date.parse(v);
            if (isNaN(ms)) return null;
            return ms;
        }
        if (typeof v === 'number' && !isNaN(v)) return v;
        return null;
    };

    this.lowDate = function(prev, next) {
        return self.low(prev, self.dateMS(next));
    };

    this.highDate = function(prev, next) {
        return self.high(prev, self.dateMS(next));
    };

    this.dateSeriesMinutes = function(ms) {
        return moment(ms).format('mm:ss');
    };

    this.dateSeriesHours = function(ms) {
        return moment(ms).format('HH:mm');
    };

    this.dateSeriesDays = function(ms) {
        return moment(ms).format('MMM, DD');
    };

    this.dateSeriesMonths = function(ms) {
        return moment(ms).format('MMM, YYYY');
    };

    this.dateSeriesYears = function(ms) {
        return moment(ms).format('MMM, YYYY');
    };

    this.dateSeriesFunctionFromDiff = function(start, end) {
        var diff = Math.abs(self.dateMS(start) - self.dateMS(end));
        return (diff >= 3.1104e+10 ? self.dateSeriesYears : (diff >= 2.592e+9 ? self.dateSeriesMonths : (diff >= 1.728e+8 ? self.dateSeriesDays : (diff >= 3.6e+6 ? self.dateSeriesHours : self.dateSeriesMinutes))));
    };
    
//    this.getScales = function(data) {
//        return self.getScales(data || self.data, {
//            propertyLow: self.propertyLow,
//            propertyHigh: self.propertyHigh,
//            propertyVolume: self.propertyVolume,
//            propertyDate: self.propertyDate,
//            tick: self.tick
//        });
//    };
    
    this.getScales = function(data, spec) {
        spec = spec || {};
        
        var
            dataNum  = dataNum,
            dateFrom = dateFrom,
            propLow = spec.propertyLow || 'low',
            propHigh = spec.propertyHigh || 'high',
            propVol = spec.propertyVolume || 'volume',
            propDate = spec.propertyDate || 'date',
            propTick = spec.propertyTick || 'tick';
        if(data[data.length - 1].open < data[data.length - 1].low ) data[data.length - 1].low = data[data.length - 1].open;
//        if(data[0].open > data[0].high ) data[0].high = data[0].open;
        return data.reduce(function(p, c, i) { // find all domains using a single data iteration (optimal)
            p.lowestLow = self.low(p.lowestLow, c[propLow]);
            p.highestHigh = self.high(p.highestHigh, c[propHigh]);
            p.volumeLow = self.low(p.volumeLow, c[propVol]);
            p.volumeHigh = self.high(p.volumeHigh, c[propVol]);
            p.dateLow = self.lowDate(p.dateLow, c[propDate]);
            p.dateHigh = self.highDate(p.dateHigh, c[propDate]);
            return p;
        }, { // seed the unprocessed domains
            lowestLow: null,
            highestHigh: null,
            volumeLow: null,
            volumeHigh: null,
            dateLow: null,
            dateHigh: null,
            dateHigh: null,
            dateHigh: null,

        });
    };

    this.resize = function(w,h) {
        svg = self.svg;
        width = w || self.width;
        height = h || self.height;
        svg.attr('width', width);
        svg.attr('height', height);

        if (width !== self.width) {
            self.width = width;
        }
        if (height !== self.height) {
            self.height = height;
        }

        return svg;
    };

    this.clearData = function() {
        self.data.splice(0, self.data.length);
        setter.call(self);
        return true;
    };

    this.loadData = function(recievedData) {

        if (recievedData == undefined) {
            return false;
        }
        recievedData.splice(0, 1);
        var dataSet = recievedData,
            newData = [],
            tmp = {
                open: '',
                close: '',
                high: '',
                low: '',
                value: '',
                volume: '',
                date: '',
            },
            highest = function(ind, period) {
                var value = dataSet[ind].high;
                for (k = ind + 1; k < period; k++) {
                    if (value < dataSet[k].high) value = dataSet[k].high;
                }
                return value;
            },
            lowest = function(ind, period) {
                var value = dataSet[ind].low;
                for (k = ind + 1; k < period; k++) {
                    if (value > dataSet[k].low) value = dataSet[k].low;
                }
                return value;
            },
            rebuild = function(period) {
                var tmpDate;
                for(var i = 0; i < period; i++){
                    tmpDate = new Date(dataSet[i].date).getMinutes();
                    if( tmpDate % period == 0){
                        var offsetData = i;
                        break;
                    }else if (tmpDate == 0){
                        var offsetData = 0;
                        break;
                    };
                }
                
                var last = period;
                for (var i =  0; i < Math.floor((dataSet.length - offsetData) / period); i++) {
                    tmp.close = dataSet[i * period + offsetData].close;
                    tmp.value = tmp.close;
                    tmp.volume = tmp.close;
                    tmp.high = highest(i * period + offsetData, period + offsetData);
                    tmp.low = lowest(i * period + offsetData, period + offsetData);
                    if (i < (Math.floor(((dataSet.length - offsetData) / period) - 1))) tmp.open = dataSet[(i + 1) * period + offsetData].close;
                    else if (dataSet[(i + 1) * period - 1 + offsetData].open < tmp.low) tmp.open = tmp.low;
                    else if (dataSet[(i + 1) * period - 1 + offsetData].open > tmp.high) tmp.open = tmp.high;
                    else tmp.open = dataSet[(i + 1) * period - 1].open;
                    tmp.date = dataSet[i * period + offsetData].date;
                    
                    newData.push({
                        open: tmp.open,
                        close: tmp.close,
                        high: tmp.high,
                        low: tmp.low,
                        value: tmp.value,
                        volume: tmp.volume,
                        date: tmp.date,
                    });
                    self.tick = tmp.close;

                }
            };
        switch (self.gtype) {
            case '1 min':
                newData = recievedData;
                break;
            case '5 min':
                rebuild(5);
                break;
            case '15 min':
                rebuild(15);
                break;
            case '30 min':
                rebuild(30);
                break;
            case '45 min':
                rebuild(45);
                break;
            case '1 hour':
                rebuild(60);
                break;
            case '2 hours':

                break;
            case '4 hours':

                break;
            case '5 hours':

                break;
            case '1 day':

                break;
            default:
                newData = recievedData;
                break;
        };
        Array.prototype.push.apply(self.data, newData);
        self.redraw();
        return true;
    };

    this.reset = function() {
        self.resetCandles();
        self.resetVolume();
        self.resetLabels();
        self.resetTick();
        self.resetArea();
        self.hideCursor(true);
    };

    this.coordCandles = function() {
        var
            volcoord = self.coordVolume();
        return {
            x: volcoord.x,
            y: 0,
            h: volcoord.y,
            w: volcoord.w
        };
    };

    this.resetArea = function() {
        self.svg.selectAll('g.area').remove();
        self.svg.selectAll('g.grid').remove();
        return self;
    };

    this.redrawArea = function() {
        var
            propLow = self.propertyLow,
            propHigh = self.propertyHigh,
            propVol = self.propertyVolume,
            propDate = self.propertyDate,
            propClose = self.propertyClose,
            propOpen = self.propertyOpen,
            colorBG = self.colorCandleBackground,
            colorBodyDown = self.colorCandleBodyDown,
            colorBodyUp = self.colorCandleBodyUp,
            colorStemDown = self.colorCandleStemDown,
            colorStemUp = self.colorCandleStemUp,
            margin = self.marginCandle || 0,
            coord = self.coordCandles(),
            drawData = self.getCurData(),
            scales = self.getScales(drawData),
            coordVol = self.coordVolume(),
            approxW = (coord.w / drawData.length),
            barSpace = approxW * self.barSpacing,
            barWidth = approxW - barSpace,
            stemWidth = barWidth * 0.15,
            dataNum = self.dataNum,

            dOpenCloseMin = function(d) {
                return Math.min(d[propClose], d[propOpen]);
            },
            dOpenCloseMax = function(d) {
                return Math.max(d[propClose], d[propOpen]);
            },
            dIsDown = function(d) {
                return d[propClose] < d[propOpen];
            },
            dStemColor = function(d) {
                return dIsDown(d) ? colorStemDown : colorStemUp;
            },
            dBodyColor = function(d) {
                return dIsDown(d) ? colorBodyDown : colorBodyUp;
            };

        calcDateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([0, coord.w - barWidth]),
            calcRY = d3.scaleLinear()
            .domain([scales.lowestLow, scales.highestHigh])
            .range([coord.h - margin, margin]);

        
        
        //Make area graph
        groupLines = self.svg.append("g")
            .attr('class', 'area')
            .attr("transform", 'translate(' + [coord.x, coord.y].join(' ') + ')');
        
        
        
        
            groupLines.append('rect')
                .attr('class', 'background')
                .attr('width', coord.w)
                .attr('height', coord.h)
                .attr('fill', colorBG);
            var lastIndex = self.dataNum//data.length - 1;
        
        if (self.btnArea == true) {
            
            
            

            linesArea = d3.area()
                .x(function(d, index) {
                    var res = calcDateX(d.date) + barWidth / 2;
                    if (index == 0) res = calcDateX(d.date) + barWidth;
                    if (index == lastIndex) {
                        res = calcDateX(d.date)
                    };
                    return res;
                })
                .y1(function(d) {
                    return calcRY(d.value);
                })
                .y0(coord.h);
            
            groupLines.append("path")
                .datum(drawData)
                .attr("fill", "steelblue")
                .attr("style", "opacity: 0.2")
                .attr("d", linesArea);
        }
        if (self.btnLine == true) {
            //Make line graph
            var
            line = self.svg.append("g")
                .attr('class', 'line')
                .attr("transform", 'translate(' + [coord.x, coord.y].join(' ') + ')');

            lineDraw = d3.line()
                .x(function(d, index) {
                        var res = calcDateX(d.date) + barWidth / 2;
                        if (index == 0) res = calcDateX(d.date) + barWidth;
                        if (index == lastIndex) {
                            res = calcDateX(d.date)
                        };
                        return res;
                    })
                .y(function(d) {
                    return calcRY(d.value);
                })
            groupLines.append("path")
                    .datum(drawData)
                    .attr("fill", "none")
                    .attr("stroke-width", self.lineStrokeWidth)
                    .attr("stroke", self.lineColor)
                    .attr("style", "opacity: 1")
                    .attr("d", lineDraw);
        }
        //Make grid
        gridFun = d3.axisBottom()
            .scale(1000)
            .ticks(5);

        grid = self.svg.append("g")
            .attr("class", "grid")
            .attr("transform", 'translate(' + [coord.x, coord.y].join(' ') + ')');

        grid.append('rect')
            .attr('class', 'grid-item')
            .attr('width', coord.w)
            .attr('height', 1);

        // calculate number of rows and columns
        var squareWidth = coord.w / 10;
        var squareHeight = coord.h / 10;

        var squaresColumn = Math.round(coord.w / squareWidth);
        var squaresRow = Math.round(coord.h / squareHeight);
        // loop over number of columns
        for (var n = 0; squaresRow / 2 > n; n++) {

            // create each set of rows
            var rows = grid.selectAll('rect' + ' .row-' + (n + 1))
                .data(d3.range(1))
                .enter().append('rect')
                .attr("style", "opacity: 0.2")
                .attr('width', coord.w)
                .attr('y', squareHeight * 2 * n)
                .attr('height', squareHeight)
                .attr('fill', 'none')
                .attr('stroke-dasharray', '5 5')
                .attr('stroke-width', '1')
                .attr('stroke', '#999');


        };
        for (var n = 0; squaresColumn / 2 > n; n++) {
            var cols = grid.selectAll('rect' + ' .col-' + (n + 1))
                .data(d3.range(1))
                .enter().append('rect')
                .attr("style", "opacity: 0.2")
                .attr('width', squareWidth)
                .attr('height', coord.h)
                .attr('x', squareWidth * 2 * n)
                .attr('fill', 'none')
                .attr('stroke-dasharray', '5 5')
                .attr('stroke-width', '1')
                .attr('stroke', '#999');
        };

    };


    this.scroll = function(delta) {
        
        self.dataNum -= delta/20;
        if(self.dataNum < 60) self.dataNum = 60;
        if(self.dataNum > 1440) self.dataNum = 1440;
        
        if(self.dataNum > self.data.length) self.dataNum = self.data.length;
        if((self.dataFrom + self.dataNum > self.data.length) && ((self.dataFrom - delta/20) > 0) ) self.dataFrom -= delta/20;
        self.redraw();
    }
    this.mouseMove = function (event) {
        switch (event.type) {
            case 'mouseup':
                $(self.el).css({cursor:'crosshair'});
                self.mouseDown = false;
            break;
            case 'mouseleave':
                self.hideCursor();
                $(".tooltip-inner").remove();
                return;
                break;
            case 'mouseenter':
            case 'mousemove':
                if(self.mouseDown){
                    
                    
                    var delta =  event.pageX - self.mouseDownX,
                    
                    coord = self.coordCandles(),
                    drawData = self.getCurData(),
                    scales = self.getScales(drawData),
                    approxW = (coord.w / drawData.length),
                    barSpace = approxW * self.barSpacing,
                    barWidth = approxW - barSpace,
                    
                    calcC = d3.scaleLinear()
                            .range([0, drawData.length])
                            .domain([0, coord.w * 0.8]);
                    if( (self.dateFrom + calcC(delta)) < 0){
                        self.dateFrom = 0;
                        self.mouseDownX += delta;
                        self.redraw();
                    }else if((self.dateFrom + calcC(delta) + self.dataNum) > self.data.length){
                        if(self.data.length - self.dataNum > 0)
                            self.dateFrom = self.data.length - self.dataNum;
                        else{
                            self.dateFrom = 0;
                            self.dataNum = self.data.length;
                        }
                        self.redraw();
                    }else{
                        self.dateFrom += calcC(delta);
                        self.mouseDownX += delta;
                        self.redraw();
                    }
                }
                self.moveCursor(event.pageX, event.pageY);
                break;
            case 'mousedown':
                self.mouseDownX = event.pageX;
                $( "#main:active").css({cursor:'grabbing!important'});
                $( "#main").css({cursor:'grabbing!important'});
                $( "#main svg").css({cursor:'grabbing!important'});
                $( "#main svg g").css({cursor:'grabbing!important'});
                $( "#main svg g path").css({cursor:'grabbing!important'});
                $( "#main svg g rect").css({cursor:'grabbing!important'});
                $( "#main>svg>g>line").css({cursor:'grabbing!important'});
                self.mouseDown = true;
                break;
            
            default:
                break;

        }

    };
    
    this.hideCursor = function(show) {
        
        if(!self.curShow) return;
        self.svg.selectAll('g.cursor').remove();
        if(!self.show) self.curShow = false;
        self.noRedraw = false;
        if(!show && self.mouseDown){ 
            self.mouseDown = false;
        }
        $(self.el).css({cursor:'default'});
        
    };
    this.getCurData = function() {
            return self.data.filter(function(d,i){
                    return (i >= self.dateFrom) && (i < self.dataNum + self.dateFrom);
                });
    };
    this.showCursor = function(show) {
        coord = self.coordCandles(),
        coordvol = self.coordVolume(),
        drawData = self.getCurData(),
        scales = self.getScales(drawData),
        margin = self.marginCandle || 0,
        approxW = (coord.w / drawData.length),
        barSpace = approxW * self.barSpacing,
        barWidth = approxW - barSpace,
//        barWidth = self.candleWidth,
        stemWidth = barWidth * 0.15;
        
        //if not created - create cursorgraph
        if($(self.el).find("svg>g.cursor").length  == 0) {
        cursor = self.svg.append('g')
            .attr('class', 'cursor')
            .attr('transform', 'translate(' + [coord.x, coord.y].join(' ') + ')');
        cursor.append("line")
            .classed("x-line", true)
            .attr("stroke-dasharray", "5 5").attr('stroke-width', 1)
            .attr('stroke-linecap', 'butt')
            .attr('data-animation', 'false')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', self.curXColor);
            
        cursor.append("line")
            .classed("y-line", true)
            .attr("stroke-dasharray", "5 5")
            .attr('stroke-linecap', 'butt')
            .attr('data-animation', 'false')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', self.curYColor);
            
        cursor.append("rect")
            .classed("cur-time",true)
            .attr('width', 100)
            .attr('height', 20)
            .attr('fill', self.colorTick);
            
        cursor.append("rect")
            .classed("cur-value",true)
            .attr('height', 20)
            .attr('fill', self.colorTick);
        cursor.append('text')
            .attr('class', 'cur-label-x')
            .attr('font-family', self.labelFontFamily)
            .attr('font-size', self.labelFontSize * 1.7)
            .attr('text-anchor', 'middle')
            .attr('fill', "#fff");
        cursor.append('text')
            .attr('class', 'cur-label-y')
            .attr('font-family', self.labelFontFamily)
            .attr('font-size', self.labelFontSize * 1.7)
            .attr('text-anchor', 'right')
            .attr('fill', "#fff");
        }
        
        
        
        var
        scaleX = d3.scaleLinear()
            .domain([show.minX, show.maxX])
            .range([0, coord.w - barWidth]),
        scaleY = d3.scaleLinear()
            .domain([show.minY, show.maxY])
            .range([0, show.h]),
            
        y = show.posY,
        
        calcDateX = d3.scaleLinear()
            .domain([0, coord.w - barWidth])
            .range([scales.dateLow, scales.dateHigh]),
        
        calcCoordX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([ 0, coord.w - barWidth]);
        
        var
        calcVolHeight = d3.scaleLinear()
            .domain([0, coord.h])
            .range([scales.volumeHigh, scales.volumeLow]),
        candY = d3.scaleLinear()
            .domain([show.maxY, show.minY])
            .range([scales.lowestLow, scales.highestHigh]);
        nearestCandle = function(x){
            var nearest = 100,
                coord = 0;
            for(var i = 0; i < self.data.length; i++){
                date = calcCoordX(self.data[i].date);
                delta = Math.abs(date - scaleX(x));
                if( delta < nearest ){ 
                    nearest = delta;
                    coord = date;
                }
                
            }
            return coord;
        };
        
        x = nearestCandle(show.posX);
        curX = self.svg.select("line.x-line")
            .attr("x1", x + barWidth/2)
            .attr("x2", x + barWidth/2)
            .attr("y2", scaleY(show.maxY)), //show.maxY
        curY = self.svg.select("line.y-line")
            .attr("x2", scaleX(show.maxX) + barWidth)//show.maxX
            .attr("y1", scaleY(y))
            .attr("y2", scaleY(y)),
        curTime = self.svg.select("rect.cur-time")
            .attr('x', x - 100/2 + barWidth/2)
            .attr('y', scaleY(show.maxY) + coordvol.h),
        curValue = self.svg.select("rect.cur-value")
            .attr('x', scaleX(show.maxX) + barWidth)
            .attr('width', self.labelYWidth)
            .attr('y', scaleY(y) - 20/2),
        curXLabel = self.svg.select("text.cur-label-x")
            .attr('y', scaleY(show.maxY) + coordvol.h + self.labelFontSize * 1.7)
            .attr('x', x + barWidth/2)
            .text(moment(calcDateX( x  ) ).format('H:mm:ss')),
        curYLabel = self.svg.select("text.cur-label-y")
            .attr('x', scaleX(show.maxX) + barWidth + 10)
            .attr('y', scaleY(y) + self.labelFontSize * 0.6)
            .text(Math.floor(candY(scaleY(show.posY))*100)/100 );
            
        overCandle = function(x, y, cX){
            var
                nCandle = '.candle-body[x="' + cX + '"]',
                cY = Number($(nCandle).attr("y")),
                cHeight = Number($(nCandle).attr("height")),
                cWidth = Number($(nCandle).attr("width")),
                i = Number($(nCandle).attr("num")),
                pX = scaleX(x),
                pY = scaleY(y);
            
            if( (((pX >= cX - barWidth/2) && (pX <= cX + cWidth)) && ((pY >= cY) && (pY <= cY + cHeight))) ){
                var tooltipText = 'high:' + drawData[i].high + '     ' + 'low:' + drawData[i].low + '     ' + 'open:' + drawData[i].open + '     ' + 'close:' + drawData[i].close + '     ' + 'volume:' + drawData[i].volume + '     ' + drawData[i].date;
                var numCandle = '.candle-body[num="' + i + '"]';
                $(numCandle).tooltip({
                    track: true,
                    title: tooltipText,
                    placement: 'bottom',
                    delay: {
                        show: 0,
                        hide: 0
                    },
                    html: true,
                    trigger: 'hover focus',
                }).show();
            self.lastTooltipCandleNum = i;
            }else{
                $('.candle-body[num="' + i + '"]').tooltip('hide');
            }
            
        }
        overCandle(show.posX, show.posY, x);
        self.curShow = true;
        
    };


    this.moveCursor = function(posX, posY) {
        var
        coordl = self.coordLabels(),
        coord = self.coordCandles(),
        coordVol = self.coordVolume(),
        coordLabel = self.coordLabels(),
        cSX = coordl.seriesX.w,
        margin = self.marginCandle || 0,
        approxW = (coord.w / self.data.length),
        barSpace = approxW * self.barSpacing,
        barWidth = approxW - barSpace,
        maxY = coord.h + margin;
        if($(self.el).find("svg>g.grid").length > 0){
            var
            minRange = $(self.el).find("svg>g.grid").offset(),
            maxRangeX = $(self.el).find("svg>g.label-y").offset(),
            maxRangeY = $(self.el).find("svg>g.label-x").offset(),
            minX = minRange.left,
            minY = minRange.top,
            maxX = maxRangeX.left,
            maxY = maxRangeY.top;  
            if($(self.el).find("svg>g.volume").length > 0){
                var
                volY = $(self.el).find("svg>g.volume").offset(),
                maxY = volY.top;
            }
        }else return;
        show = {
            posX: event.pageX,
            posY: event.pageY,
            minX: minX, 
            maxX: maxX, 
            minY: minY, 
            maxY: maxY,
            w: coord.w,
            h: coord.h,
            labelW: cSX
        }
            
        if ((posX > maxX || posY > maxY) || (posX < minX || posY < minY)) {
            self.hideCursor();
            return;
        }
        $(self.el).css({cursor:'crosshair'});
        self.curX = posX;
        self.curY = posY;
        self.showCursor(show);
    };

    this.resetCandles = function() {
        self.svg.selectAll('g.candles').remove();
    };

    this.redrawCandles = function() {
        var

            propLow = self.propertyLow,
            propHigh = self.propertyHigh,
            propVol = self.propertyVolume,
            propDate = self.propertyDate,
            propClose = self.propertyClose,
            propOpen = self.propertyOpen,
            colorBG = self.colorCandleBackground,
            colorBodyDown = self.colorCandleBodyDown,
            colorBodyUp = self.colorCandleBodyUp,
            colorStemDown = self.colorCandleStemDown,
            colorStemUp = self.colorCandleStemUp,
            margin = self.marginCandle || 0,
            coord = self.coordCandles(),
            coordvol = self.coordVolume(),
            drawData = self.getCurData(),
            scales = self.getScales(drawData),
            approxW = (coord.w / drawData.length),
            
            barSpace = approxW * self.barSpacing,
            
            barWidth = approxW - barSpace,
            stemWidth = barWidth * 0.15,
            svg = self.svg,
            
            //Make candles
            group = self.svg.append('g')
            .attr('class', 'candles')
            .attr('transform', 'translate(' + [coord.x, coord.y].join(' ') + ')'),
            
            calcDateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([0, coord.w - barWidth]);
            self.candleWidth = barWidth;
        var
            calcRY = d3.scaleLinear()
            .domain([scales.lowestLow, scales.highestHigh])
            .range([coord.h - margin, margin]);
        
        if (stemWidth < 1) {
            stemWidth = 1;
        }
        if (barWidth < 1) {
            barWidth = 1;
        }

        var
            dOpenCloseMin = function(d) {
                return Math.min(d[propClose], d[propOpen]);
            },
            dOpenCloseMax = function(d) {
                return Math.max(d[propClose], d[propOpen]);
            },
            dIsDown = function(d) {
                return d[propClose] < d[propOpen];
            },
            dStemColor = function(d) {
                return dIsDown(d) ? colorStemDown : colorStemUp;
            },
            dBodyColor = function(d) {
                return dIsDown(d) ? colorBodyDown : colorBodyUp;
            };
        if (self.btnCandle) {
            if (stemWidth > 0) {
                group.selectAll('rect.candle-stem')
                    .data(drawData)
                    .enter().append('rect')
                    .attr('class', 'candle-stem')
                    .attr('width', stemWidth)
                    .attr('x', function(d) {
                        return calcDateX(d[propDate]) + ((barWidth / 2) - (stemWidth / 2));
                    })
                    .attr('y', function(d) {
                        return calcRY(d[propHigh]);
                    })
                    .attr('height', function(d) {
                        return calcRY(d[propLow]) - calcRY(d[propHigh]);
                    })
                    .attr('fill', dStemColor);
            }
            minHeight = function(height){
                return height == 0 ? 1 : height;
            }
            group.selectAll('rect.candle-body')
                .data(drawData)
                .enter().append('rect')
                .attr('class', 'candle-body')
                .attr('width', barWidth)
                .attr('vmin', dOpenCloseMin)
                .attr('vmax', dOpenCloseMax)
                .attr('x', function(d) {
                    return calcDateX(d[propDate]);
                })
                .attr('y', function(d) {
                    return calcRY(this.getAttribute('vmax'));
                })
                .attr('height', function(d) {
                    return minHeight(Math.abs(calcRY(this.getAttribute('vmin')) - calcRY(this.getAttribute('vmax'))));
                })
                .attr('stroke-width', 0.5)
                .attr('stroke-linecap', 'butt')
                .attr('data-animation', 'false')
                .attr('stroke-rendering', 'crispEdges')
                .attr('stroke', dStemColor)
                .attr('fill', dBodyColor)
                .attr('num', function(d, i) {return i;})
                .attr('data-toggle', "tooltip")
                .attr('data-placement', "bottom")
                .attr('data', scales.lowestLow);
        }
    };

    this.coordVolume = function() {
        var
            volheight = 100,
            coordlabels = self.coordLabels(),
            coordSX = coordlabels.seriesX;
        if (volheight / self.height > 0.25) {
            volheight = 50;
        }
        if (!self.barPanel) volheight = 0;
        return {
            x: coordSX.x,
            y: coordSX.y - volheight,
            w: coordSX.w,
            h: volheight
        };
    };

    this.resetVolume = function() {
        self.svg.selectAll('g.volume').remove();
    };

    this.redrawVolume = function() {

        if (!self.barPanel) return;
        var
            coord = self.coordVolume(),
            propVol = self.propertyVolume,
            propDate = self.propertyDate,
            propClose = self.propertyClose,
            propOpen = self.propertyOpen,
            colorVolSell = self.colorVolumeSell,
            colorVolBuy = self.colorVolumeBuy,
            colorVolSellBorder = self.colorVolumeSellBorder,
            colorVolBuyBorder = self.colorVolumeBuyBorder,
            colorBG = self.colorVolumeBackground,
            drawData = self.getCurData(),
            scales = self.getScales(drawData),
            approxW = (coord.w / drawData.length),
            barSpace = approxW * self.barSpacing,
            barWidth = approxW - barSpace,
            
            
            margin = self.marginVolume || 0;

        if (barWidth < 1) {
            barWidth = 1;
        }

        var
            group = self.svg.append('g')
            .attr('class', 'volume')
            .attr('transform', 'translate(' + [coord.x, coord.y].join(' ') + ')'),
            calcDateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([0, coord.w - barWidth]),
            calcVolHeight = d3.scaleLinear()
            .domain([scales.volumeLow, scales.volumeHigh])
            .range([2, coord.h - margin]),
            dIsDown = function(d) {
                return d[propClose] < d[propOpen];
            },
            dColorBars = function(d) {
                return dIsDown(d) ? colorVolSell : colorVolBuy;
            },
            dColorBarsBord = function(d) {
                return dIsDown(d) ? colorVolSellBorder : colorVolBuyBorder;
            };

        group.append('rect')
            .attr('class', 'background')
            .attr('width', coord.w)
            .attr('height', coord.h)
            .attr('fill', colorBG);

        group.selectAll('rect.volume-bar')
            .data(drawData)
            .enter().append('rect')
            .attr('class', 'volume-bar')
            .attr('fill', dColorBars)
            .attr('stroke', dColorBarsBord)
            .attr('width', barWidth)
            .attr('stroke-width', 0.5)
            .attr('stroke-linecap', 'butt')
            .attr('stroke-rendering', 'crispEdges')
            .attr('height', function(d) {
                return calcVolHeight(d[propVol]);
            })
            .attr('x', function(d) {
                return calcDateX(d[propDate]);
            })
            .attr('y', function(d) {
                return (coord.h - this.getAttribute('height'));
            });
    };

    this.coordLabels = function() {
        var
            xheight = self.labelXHeight,
            ywidth = self.labelYWidth;
        
        return {
            seriesX: {
                x: 0,
                y: self.height - xheight,
                w: self.width - ywidth,
                h: xheight
            },
            seriesY: {
                x: self.width - ywidth,
                y: 0,
                w: ywidth,
                h: self.height
            }
        };
    };

    this.resetTick = function() {
        self.svg.selectAll('g.tick').remove();
    };

    this.genTick = function(curTick, scales, min, max) {
        var candle = max - min,
            delta = Math.random() * candle / 10;
        if(Math.random() >= 0.5) var sign = -1; else var sign = 1;
        if((delta * sign + curTick > max) || (delta * sign + curTick < min)) sign = -sign;
        if((delta * sign + curTick > max) || (delta * sign + curTick < min)) return curTick;
        return Math.floor((delta * sign + curTick) * 100000) / 100000;
//        if (min == ma
    };

    this.redrawTick = function() {
        if ((self.data == undefined)) {
            return;
        } else if(!self.data.length) return;
        self.resetTick(self.svg);
        var
            coord = self.coordLabels(),
            drawData = self.getCurData(self.data),
            scales = self.getScales(drawData),
        
            coordvol = self.coordVolume(),
            coordcand = self.coordCandles(),
            propVol = self.propertyVolume,
            fontFamily = self.labelFontFamily,
            fontSize = self.labelFontSize,
            colorTimeBG = self.colorLabelTimeBackground,
            colorTimeFG = self.colorLabelTimeForeground,
            colorCandleBG = self.colorLabelCandleBackground,
            colorCandleFG = self.colorLabelCandleForeground,
            colorVolumeBG = self.colorLabelVolumeBackground,
            colorVolumeFG = self.colorLabelVolumeForeground,
            marginCandle = self.marginCandle || 0,
            marginVolume = self.marginVolume || 0,
            margin = self.marginCandle || 0,

            
            tickVol = self.genTick(self.tick, scales, self.tickLow, self.tickHigh),
            cSX = coord.seriesX,
            cSY = coord.seriesY,
            groupY = self.svg.append('g')
            .attr('class', 'tick line')
            .attr('transform', 'translate(' + [0, cSY.y].join(' ') + ')');
            self.data[0].close = tickVol;
        if (tickVol > self.data[0].open) {
            self.colorTick = self.colorTickHigh;
            var direction = true;
        }
        else {
            var direction = false;
            self.colorTick = self.colorTickLow;
        }
        var eventData = {
            low: self.data[0].low,
            high: self.data[0].high,
            open: self.data[0].open,
            close: tickVol,
            direction: direction
        };
        eventNode.trigger('tickEvent', [eventData, direction, self.elId]);
        
        var
        // candle data & functions:
        candticks = 2,
        candY = d3.scaleLinear()
        .domain([scales.lowestLow, scales.highestHigh])
        .range([coordcand.y + coordcand.h - marginCandle, coordcand.y + marginCandle]), //,
        
        maxY = candY(scales.lowestLow),
        minY = candY(scales.highestHigh);
        
        coordcand.y = candY(tickVol);
        if(coordcand.y > maxY) coordcand.y = maxY;
        if(coordcand.y < minY) coordcand.y = minY;
        
        if(self.tickShow){
            groupY.append('rect') // placeholder for X labels (end-cap)
            .attr('y', coordcand.y - 2)
            .attr('width', coordcand.w)
            .attr('height', 2)
            .attr('fill', self.colorTick);
        }

        // Tick labels
        
        
        groupY.append('rect') // background
            .attr('y', coordcand.y - 12)
            .attr('x', 0)
            .attr('width', self.labelYWidth)
            .attr('height', 20)
            .attr('fill', self.colorTick);

        groupY.selectAll('tick') // ticks
            .data(candY.ticks(candticks))
            .enter().append('text')
            .attr('class', 'tick-label')
            .attr('x', 0)
            .attr('y', coordcand.y - 12)
            .attr('dx', cSY.w / 2)
            .attr('dy', fontSize * 1.5)
            .attr('font-family', fontFamily)
            .attr('font-size', fontSize * 1.5)
            .attr('text-anchor', 'middle')
            .attr('fill', '#fff')
            .text(tickVol);
        
        groupY.append('rect') // background
            .attr('y', coordcand.y - 12)
            .attr('x', coordcand.w)
            .attr('width', self.labelYWidth)
            .attr('height', 20)
            .attr('fill', self.colorTick);

        groupY.selectAll('tick') // ticks
            .data(candY.ticks(candticks))
            .enter().append('text')
            .attr('class', 'tick-label')
            .attr('x', coordcand.w - 5)
            .attr('y', coordcand.y - 12)
            .attr('dx', cSY.w / 2)
            .attr('dy', fontSize * 1.5)
            .attr('font-family', fontFamily)
            .attr('font-size', fontSize * 1.5)
            .attr('text-anchor', 'middle')
            .attr('fill', '#fff')
            .text(tickVol);
        var open = self.data[0].open;
        if(self.dateFrom == 0){
            var lastY = candY(open),
                coordY = candY(tickVol) - 12;
//                coordY = coordcand.y - 12;
                self.tickStemColor = self.colorCandleStemDown,
                self.tickBodyColor = self.colorCandleBodyDown;
            if (self.data[0].open < tickVol) {
                self.tickBodyColor = self.colorCandleBodyUp;
                self.tickStemColor = self.colorCandleStemUp;
            }
            if (coordY + 10 > lastY) {
                heightB = Math.abs(coordY - lastY + 10);
                $(self.el).find('rect.candle-body')
                        .eq(0)
                        .attr('height', heightB)
                        .attr('y', candY(open))
                        .attr('stroke', self.tickBodyColor)
                        .attr('fill', self.tickBodyColor);
                $(self.el).find('rect.candle-stem').eq(0)
                        .attr('class', 'candle-stem')
                        .attr('stroke-width', 0.5)
                        .attr('stroke-linecap', 'butt')
                        .attr('stroke-rendering', 'crispEdges')
                        .attr('stroke', self.tickStemColor)
                        .attr('fill', self.tickStemColor);
            } else {
                heightB = Math.abs(lastY - coordY - 10);
                $(self.el).find('rect.candle-body').eq(0)
                    .attr('height', heightB)
                    .attr('y', candY(open) - heightB)
                    .attr('stroke', self.tickBodyColor)
                    .attr('fill', self.tickBodyColor);
                $(self.el).find('rect.candle-stem').eq(0)
                    .attr('class', 'candle-stem')
                    .attr('stroke-width', 0.5)
                    .attr('stroke-linecap', 'butt')
                    .attr('stroke-rendering', 'crispEdges')
                    .attr('stroke', self.tickStemColor)
                    .attr('fill', self.tickStemColor);
            }
        
            

//            $('rect.candle-body').eq(0)
//                .attr('class', 'candle-body')
//                .attr('stroke-width', 0.5)
//                .attr('stroke-linecap', 'butt')
//                .attr('stroke-rendering', 'crispEdges')
//                .attr('stroke', self.tickStemColor)
//                .attr('fill', self.tickBodyColor);
        }else{
            
        }
    };

    this.resetLabels = function() {
        self.svg.selectAll('g.labels').remove();
    };

    this.redrawLabels = function() {
        var
            coord = self.coordLabels(),
            coordvol = self.coordVolume(),
            coordcand = self.coordCandles(),
            fontFamily = self.labelFontFamily,
            fontSize = self.labelFontSize,
            colorTimeBG = self.colorLabelTimeBackground,
            colorTimeFG = self.colorLabelTimeForeground,
            colorCandleBG = self.colorLabelCandleBackground,
            colorCandleFG = self.colorLabelCandleForeground,
            colorVolumeBG = self.colorLabelVolumeBackground,
            colorVolumeFG = self.colorLabelVolumeForeground,
            marginCandle = self.marginCandle || 0,
            marginVolume = self.marginVolume || 0,
            drawData = self.getCurData(),
            scales = self.getScales(drawData),
            cSX = coord.seriesX,
            cSY = coord.seriesY,
            groupY = self.svg.append('g')
            .attr('class', 'labels label-y')
            .attr('transform', 'translate(' + [cSY.x, cSY.y].join(' ') + ')'),
            groupYLeft = self.svg.append('g')
            .attr('class', 'labels label-y-left')
            .attr('transform', 'translate(0, 0)'),
            groupX = self.svg.append('g')
            .attr('class', 'labels label-x')
            .attr('transform', 'translate(' + [cSX.x, cSX.y].join(' ') + ')');

//        if (!this.barPanel) coordcand.h += coordvol.h;
        // time series data & functions:
        var
            timeticks = 10,
            dateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([cSX.x, cSX.x + cSX.w]),

            // candle data & functions:
            candticks = 6,
            candY = d3.scaleLinear()
            .domain([scales.lowestLow, scales.highestHigh])
            .range([coordcand.y + coordcand.h - marginCandle, coordcand.y + marginCandle]),

            // volume data & functions:

            volticks = 5,
            volY = d3.scaleLinear()
            .domain([scales.volumeLow, scales.volumeHigh])
            .range([coordvol.y + coordvol.h, coordvol.y + fontSize + marginVolume]);
            self.labelYWidth = cSY.w;
        if (self.barPanel) {
            // volume labels:
            groupY.append('rect') // background
                .attr('y', coordvol.y)
                .attr('width', cSY.w)
                .attr('height', coordvol.h)
                .attr('fill', colorVolumeBG);
            
            groupY.selectAll('text.vol-label') // ticks
                .data(volY.ticks(volticks))
                .enter().append('text')
                .attr('class', 'vol-label')
                .attr('x', 0)
                .attr('y', volY)
                .attr('dx', cSY.w / 2)
                .attr('dy', 0)
                .attr('fill', colorVolumeFG)
                .attr('font-family', fontFamily)
                .attr('font-size', fontSize)
                .attr('text-anchor', 'middle')
                .text(String);
        }

        groupX.append('rect') // placeholder for time-series labels
            .attr('width', cSX.w)
            .attr('height', cSX.h)
            .attr('fill', colorTimeBG);

        groupY.append('rect') // placeholder for X labels (end-cap)
            .attr('y', cSX.y)
            .attr('width', cSY.w)
            .attr('height', cSX.h)
            .attr('fill', colorTimeBG);

        groupX.selectAll('text.series-x')
            .data(dateX.ticks(timeticks))
            .enter().append('svg:text')
            .attr('class', 'series-x')
            .attr('x', dateX)
            .attr('y', 0)
            .attr('dy', (cSX.h / 2) + (fontSize / 2))
            .attr('font-family', fontFamily)
            .attr('font-size', fontSize)
            .attr('text-anchor', 'middle')
            .attr('fill', colorTimeFG)
            .text(self.dateSeriesFunctionFromDiff(scales.dateLow, scales.dateHigh));

        // candle labels
        groupY.append('rect') // background
            .attr('y', coordcand.y)
            .attr('width', cSY.w)
            .attr('height', coordcand.h)
            .attr('fill', colorCandleBG);

        groupY.selectAll('text.candle-label') // ticks
            .data(candY.ticks(candticks))
            .enter().append('text')
            .attr('class', 'candle-label')
            .attr('x', 0)
            .attr('y', candY)
            .attr('dx', cSY.w / 2)
            // .attr('dy', fontSize/2)
            .attr('font-family', fontFamily)
            .attr('font-size', fontSize)
            .attr('text-anchor', 'middle')
            .attr('fill', colorCandleFG)
            .text(function(d) {
                return utils.isNumber(d) ? (d < 1 ? d.toFixed(4) : d) : d;
            });
        
        groupYLeft.append('rect') // background
            .attr('y', coordcand.y)
            .attr('width', cSY.w)
            .attr('height', coordcand.h)
            .attr('fill', colorCandleBG);
        groupYLeft.append('rect') // placeholder for X labels (end-cap)
            .attr('y', cSX.y)
            .attr('width', cSY.w)
            .attr('height', cSX.h)
            .attr('fill', colorTimeBG);
        groupYLeft.selectAll('text.candle-label') // ticks
            .data(candY.ticks(candticks))
            .enter().append('text')
            .attr('class', 'candle-label')
            .attr('x', 0)
            .attr('y', candY)
            .attr('dx', cSY.w / 2)
            // .attr('dy', fontSize/2)
            .attr('font-family', fontFamily)
            .attr('font-size', fontSize)
            .attr('text-anchor', 'middle')
            .attr('fill', colorCandleFG)
            .text(function(d) {
                return utils.isNumber(d) ? (d < 1 ? d.toFixed(4) : d) : d;
            });
    };

    this.redraw = function() {
        // clear existing selfed data
        self.reset();

        if (self.data == undefined || !self.data.length) { // bail out if no data
            return svg;
        }
        //    this.height+=200;
        // resize SVG to outer limits
        self.svg.attr('width', self.width);
        self.svg.attr('height', self.height);
        self.svg.attr('viewBox', '0 0 ' + self.width + ' ' + self.height);

        var
        /***** scales:
         * lowestLow
         * highestHigh
         * volumeLow
         * volumeHigh
         * dateLow
         * dateHigh
         *****/
//        dataNum = self.dataNum,
//        dateFrom = self.dateFrom,
        scales = self.getScales(self.data.filter(function(d,i){return (i >= self.dateFrom) && (i < self.dataNum + self.dateFrom)}));
        self.redrawArea();
        self.redrawCandles();
        self.redrawVolume();
        self.redrawLabels();
        self.redrawTick();
        if(self.curShow) self.moveCursor(curX, curY);
    };

    this.initView = function(svg) {
        self.resize(window.innerWidth, window.innerHeight, svg);
//        this.redraw();
        return svg;
    };

    this.resetPeriod = function() {
        if(self.dataNum > self.data.length) self.dataNum = self.data.length;
        
    };


    this.init = function() {
        self.dateFrom = 0;
        self.timerTick = 0; // Ticks to red line with current value redraw
        self.timerGraph = 0; //Ticks to main redraw
        $(self.el).append('<div class="chart-logo"></div>');
//        console.log("element", self.el);
    };

    this.reloadData = function(force = false) {
        
        var
            request = 'http://xcryptex.com/data/amcharts/hystominute?limit=' + self.xhrPeriodFull + '&instrument_id=' + self.xhrInstrumentId;
        if( self.xhrUserId != undefined) request += '&UserId=' + self.xhrUserId;
            
        
        if ((self.timerGraph == 0) || (force == true)) {
            $.ajax({ // fetch some self data
                url: request,
                json: true,
                success: function(t) {
                    cleaner.call();
                    loader.call(self,t.map(function(record) {
                        
                        if (record.low > record.high) {
                            var tmp = record.low;
                            record.low = record.high;
                            record.high = tmp;
                        }
                        record.date = new Date(record.date);
                        return record;
                    }));
                    self.tick = t[1].open;
                    self.tickOpen  = t[1].open;
                    self.tickHigh  = t[1].high;
                    self.tickLow  = t[1].low;
                    self.redraw();
                }
                
            });
            
            self.timerGraph = self.xhrMaxInterval / self.xhrMinInterval; // 600 * renew base interval = interval
        }
        // Redraw ticker
        if (self.timerTick == 0) {
            ticker.call();
            self.timerTick = 1; // 1 * renew base interval = interval
        }
        self.timerTick--;
        self.timerGraph--;
        
        
         //Renew base interval
    };
    this.setHandlers = function (elem) {
//        var self = this;
        // Handlers
        var mouseChange = $(elem).on('mousemove mouseleave mousedown mouseup', function(e) {
            self.mouseMove(e);
        });

        if (elem.addEventListener) {
            if ('onwheel' in document) {
                // IE9+, FF17+, Ch31+
                elem.addEventListener("wheel", onWheel);
            } else if ('onmousewheel' in document) {
                // устаревший вариант события
                elem.addEventListener("mousewheel", onWheel);
            } else {
                // Firefox < 17
                elem.addEventListener("MozMousePixelScroll", onWheel);
            }
        } else { // IE8-
            elem.attachEvent("onmousewheel", onWheel);
        }

        function onWheel(e) {
            e = e || window.event;

            // wheelDelta не дает возможность узнать количество пикселей
            var delta = e.deltaY || e.detail || e.wheelDelta;

            self.scroll(delta);

            e.preventDefault ? e.preventDefault() : (e.returnValue = false);
        }
        var candleType = $(elem).parent().find(".candle-type>button").on('click', function() {
            self.gtype = $(this).attr('period');
            self.reloadData(true);
        });
        var panelShowHide = $(elem).parent().find("button.panel-show-hide").on('click', function() {
            self.barPanel = !self.barPanel;
            self.redraw();
        });
        var areaShowHide = $(elem).parent().find("button.area-show-hide").on('click', function() {
            self.btnArea = !self.btnArea;
            self.redraw();
        });
        var candleShowHide = $(elem).parent().find("button.candle-show-hide").on('click', function() {
            self.btnCandle = !self.btnCandle;
            self.redraw();
        });
        var lineShowHide = $(elem).parent().find("button.line-show-hide").on('click', function() {
            self.btnLine = !self.btnLine;
            self.redraw();
        });
        var tickShowHide = $(elem).parent().find("button.tick-show-hide").on('click', function() {
            self.tickShow = !self.tickShow;
            self.redraw();
        });
        var bgChange = $(elem).parent().find("button.background-change").on('click', function() {
            if(self.colorCandleBackground == '#333') {
                self.colorCandleBackground = '#fff';
                self.curXColor = '#333';
                self.curYColor = '#333';
            }else{ 
                self.colorCandleBackground = '#333';
                self.curXColor = '#fff';
                self.curYColor = '#fff';
            }
            self.redraw();
        });
        
        (window.onresize = function() {
            self.resize(window.outerWidth, window.outerHeight);
            self.redraw();
        })();
    };

    this.install = function(parent) {
//        parent = parent || this.parent;
        
        // set the parent's svg context
        this.svg = this.initView(d3.select(parent).append('svg:svg' ).attr('name', self.elId));
        return svg;
    };
    
    this.uninstall = function(parent) {
        d3.select(parent || this.parent)
            .select('svg')
            .remove();

        return parent;
    };

        this.svg = d3.select(el).append('svg:svg' ).attr('name', self.elId);
    
        this.resize(window.innerWidth, window.innerHeight, this.svg);
        
        // load any data in the props
        this.loadData(props.data);
        this.setParams = function(params){
            for(var key in params){
                switch(key){
                    case "xhrInstrumentId":
                        self.xhrInstrumentId = params[key];
                        break;
                    case "xhrUserId":
                        self.xhrUserId = params[key];
                        break;
                    default:
                        break;
                }
            };
        }
        // initialize data get priodically
        this.init();
        var ticker = this.redrawTick.bind(),
            reloader = self.reloadData.bind(this);
        var
            cleaner = this.clearData.bind(this),
            loader = this.loadData.bind(this),
            setParams = this.setParams.bind(this),
            setter = this.reset.bind();
            
            
        this.start = setInterval(reloader, this.xhrMinInterval);
        // Set handlers
        this.setHandlers(this.el);
        return {
            reloadData: reloader,
            
            on: on,
            trigger: trigger,
            setParams: setParams,
            
        };
            function on(){
                eventNode.on.apply(eventNode, arguments);
        }
            function trigger(){
                eventNode.trigger.apply(eventNode, arguments);
        }

};

    
