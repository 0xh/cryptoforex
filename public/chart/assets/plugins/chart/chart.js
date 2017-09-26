(function() {
    var
        utils = window.utilities,
        identity = function(v) {
            return v;
        };

    var

        PROP_MOUSE_DOWN = '_mouseDown',
        PROP_DATA_NUM = '_dataNum',
        PROP_DATE_FROM = '_dateFrom',
        PROP_DATE_TO = '_dateTo',
        PROP_NO_REDRAW = '_noRedraw',
        PROP_CUR_X = '_curX',
        PROP_CUR_Y = '_curY',
        PROP_CUR_SHOW = '_curShow',
        PROP_EL = '_el',
        PROP_GTYPE = '_gtype',
        PROP_SVG = '_svg',
        PROP_DATA = '_data',
        PROP_WIDTH = '_width',
        PROP_HEIGHT = '_height',
        PROP_GRAPH_AREA = '_gArea',
        PROP_GRAPH_CANDLE = '_gCandle',
        PROP_BAR_PANEL = '_barPanel',
        PROP_BAR_SPACING = '_barSpacing',
        PROP_DPROP_LOW = '_propertyLow',
        PROP_DPROP_HIGH = '_propertyHigh',
        PROP_DPROP_VOL = '_propertyVolume',
        PROP_DPROP_DATE = '_propertyDate',
        PROP_DPROP_CLOSE = '_propertyClose',
        PROP_DPROP_OPEN = '_propertyOpen',
        PROP_MAR_CANDLE = '_marginCandle',
        PROP_MAR_VOLUME = '_marginVolume',
        PROP_TICK = '_tick',
        PROP_COL_CURSOR_X = '_curXColor',
        PROP_COL_CURSOR_Y = '_curYColor',
        PROP_COL_CANDBG = '_colorCandleBackground',
        PROP_COL_BODYDN = '_colorBodyDown',
        PROP_COL_BODYUP = '_colorBodyUp',
        PROP_COL_STEMDN = '_colorStemDown',
        PROP_COL_STEMUP = '_colorStemUp',
        PROP_COL_VOLBG = '_colorVolBackground',
        PROP_COL_VOLDN = '_colorVolSell',
        PROP_COL_VOLUP = '_colorVolBuy',
        PROP_COL_VOLDNBORD = '_colorVolSellBorder',
        PROP_COL_VOLUPBORD = '_colorVolBuyBorder',
        PROP_COL_TICK = '_colorTick',
        PROP_COL_TICK_HIGH = '_colorTickHigh',
        PROP_COL_TICK_LOW = '_colorTickLow',
        PROP_COL_TICKTEXT = '_colorTickText',
        PROP_COL_TICKBG = '_colorTickBg',
        PROP_COL_LABTIMEBG = '_colorLabelTimeBackground',
        PROP_COL_LABTIMEFG = '_colorLabelTimeForeground',
        PROP_COL_LABCANBG = '_colorLabelCandleBackground',
        PROP_COL_LABCANFG = '_colorLabelCandleForeground',
        PROP_COL_LABVOLBG = '_colorLabelVolumeBackground',
        PROP_COL_LABVOLFG = '_colorLabelVolumeForeground',
        PROP_LAB_FAM = '_labelFontFamily',
        PROP_LAB_SIZE = '_labelFontSize';

    function D3CandleStickChart(el, props) {
        this[PROP_WIDTH] = 320;
        this[PROP_HEIGHT] = 240;
        this[PROP_DATA] = [];

        if (window.d3 === undefined) {
            throw new Error('Unable to locate the d3 library');
        }

        props = utils.isPlainObject(props) ? props : {};

        // load any data in the props
        this.loadData(props.data);

        this.width = props.width;
        this.height = props.height;
        this.parent = el || document.body;

        this[PROP_MOUSE_DOWN] = props.mouseDown || this[PROP_MOUSE_DOWN];
        this[PROP_DATA_NUM] = props.dataNum || 120;
        this[PROP_DATE_FROM] = props.dateFrom || this[PROP_DATE_FROM];
        this[PROP_DATE_TO] = props.dateTo || this[PROP_DATE_TO];
        this[PROP_NO_REDRAW] = props.noRedraw || false;
        this[PROP_CUR_SHOW] = props.curShow || this[PROP_CUR_SHOW];
        this[PROP_CUR_X] = props.curX || this[PROP_CUR_X];
        this[PROP_CUR_Y] = props.curY || this[PROP_CUR_Y];
        this[PROP_GTYPE] = props.gtype || 'minute';
        this[PROP_BAR_PANEL] = props.barPanel || false;
        this[PROP_GRAPH_AREA] = props.gArea || true;
        this[PROP_GRAPH_CANDLE] = props.gCandle || true;
        this[PROP_DPROP_LOW] = props.propertyLow || 'low';
        this[PROP_DPROP_HIGH] = props.propertyHigh || 'high';
        this[PROP_DPROP_VOL] = props.propertyVolume || 'volume';
        this[PROP_DPROP_DATE] = props.propertyDate || 'date';
        this[PROP_DPROP_CLOSE] = props.propertyClose || 'close';
        this[PROP_DPROP_OPEN] = props.propertyOpen || 'open';
        this[PROP_BAR_SPACING] = props.barSpacing || 0.35;
        this[PROP_MAR_CANDLE] = props.marginCandle || 15;
        this[PROP_MAR_VOLUME] = props.marginVolume || 5;
        this[PROP_TICK] = props.tick || 100; // Renewal base interval
        this[PROP_COL_CURSOR_X] = props.curXColor || '#444';
        this[PROP_COL_CURSOR_Y] = props.curYColor || '#444';
        this[PROP_COL_CANDBG] = props.colorCandleBackground || '#fff';
        this[PROP_COL_BODYDN] = props.colorCandleBodyDown || '#db4c3c';
        this[PROP_COL_STEMDN] = props.colorCandleStemDown || '#db4c3c';
        this[PROP_COL_BODYUP] = props.colorCandleBodyUp || '#04bf85';
        this[PROP_COL_STEMUP] = props.colorCandleStemUp || '#04bf85';
        this[PROP_COL_VOLBG] = props.colorVolumeSell || '#222';
        this[PROP_COL_VOLDN] = props.colorVolumeBuy || this[PROP_COL_BODYDN];
        this[PROP_COL_VOLUP] = props.colorVolumeSellBorder || '#04bf85';
        this[PROP_COL_VOLUPBORD] = props.colorVolumeBackground || '#04bf85';
        this[PROP_COL_VOLDNBORD] = props.colorVolumeBuyBorder || this[PROP_COL_BODYDN];
        this[PROP_COL_TICK] = props.colorTick || '#f00';
        this[PROP_COL_TICK_LOW] = props.colorTickLow || '#a00';
        this[PROP_COL_TICK_HIGH] = props.colorTickHigh || '#0a0';
        this[PROP_COL_TICKTEXT] = props.colorTickText || '#222';
        this[PROP_COL_TICKBG] = props.colorTickBg || '#fff'; //Unused
        this[PROP_COL_LABTIMEBG] = props.colorLabelTimeBackground || '#333';
        this[PROP_COL_LABTIMEFG] = props.colorLabelTimeForeground || '#aaa';
        this[PROP_COL_LABCANBG] = props.colorLabelCandleBackground || '#333';
        this[PROP_COL_LABCANFG] = props.colorLabelCandleForeground || '#aaa';
        this[PROP_COL_LABVOLBG] = props.colorLabelVolumeBackground || '#444';
        this[PROP_COL_LABVOLFG] = props.colorLabelVolumeForeground || '#bbb';
        this[PROP_LAB_FAM] = props.labelFontFamily || 'Ubuntu';
        this[PROP_LAB_SIZE] = props.labelFontSize || 10;
    }

    function redrawIdent() {
        return function(val) {
            this.redraw(this.svg, this.data);
            return val;
        };
    }

    function redrawGetSetter(prop, allowNull) {
        return {
            get: utils.getter(prop),
            set: utils.setter(prop, allowNull, redrawIdent()),
        };
    }

    Object.defineProperties(D3CandleStickChart.prototype, {
        parent: { // auto-install if this gets changed.
            get: utils.getter(PROP_EL),
            set: utils.setter(PROP_EL, false, function(parent) {
                if (parent) {
                    if (this.parent) { // un-install any previous charts in parent
                        this.uninstall(this.parent);
                    }
                    return this.install(parent);
                }

                return this.parent;
            })
        },
        svg: {
            get: utils.getter(PROP_SVG)
        },
        width: {
            get: utils.getter(PROP_WIDTH),
            set: utils.setterInt(PROP_WIDTH, 0)
        },
        height: {
            get: utils.getter(PROP_HEIGHT),
            set: utils.setterInt(PROP_HEIGHT, 0)
        },
        aspectRatio: {
            get: function() {
                return this.height / this.width;
            }
        },
        data: {
            get: utils.getter(PROP_DATA)
        },

//        noRedraw: redrawGetSetter(PROP_NO_REDRAW),
        el: redrawGetSetter(PROP_EL),
        mouseDown: redrawGetSetter(PROP_MOUSE_DOWN),
        dataNum: redrawGetSetter(PROP_DATA_NUM),
        dateFrom: redrawGetSetter(PROP_DATE_FROM),
        dateTo: redrawGetSetter(PROP_DATE_TO),
        curXColor: redrawGetSetter(PROP_COL_CURSOR_X),
        curYColor: redrawGetSetter(PROP_COL_CURSOR_Y),
        gtype: redrawGetSetter(PROP_GTYPE),
        barPanel: redrawGetSetter(PROP_BAR_PANEL),
        gArea: redrawGetSetter(PROP_GRAPH_AREA),
        gCandle: redrawGetSetter(PROP_GRAPH_CANDLE),
        propertyLow: redrawGetSetter(PROP_DPROP_LOW),
        propertyHigh: redrawGetSetter(PROP_DPROP_HIGH),
        propertyVolume: redrawGetSetter(PROP_DPROP_VOL),
        propertyDate: redrawGetSetter(PROP_DPROP_DATE),
        propertyClose: redrawGetSetter(PROP_DPROP_CLOSE),
        propertyOpen: redrawGetSetter(PROP_DPROP_OPEN),
        propertyTick: redrawGetSetter(PROP_TICK),
        barSpacing: redrawGetSetter(PROP_BAR_SPACING),
        marginCandle: redrawGetSetter(PROP_MAR_CANDLE),
        marginVolume: redrawGetSetter(PROP_MAR_VOLUME),
        colorCandleBackground: redrawGetSetter(PROP_COL_CANDBG),
        colorCandleBodyDown: redrawGetSetter(PROP_COL_BODYDN),
        colorCandleBodyUp: redrawGetSetter(PROP_COL_BODYUP),
        colorCandleStemDown: redrawGetSetter(PROP_COL_STEMDN),
        colorCandleStemUp: redrawGetSetter(PROP_COL_STEMUP),
        colorVolumeSell: redrawGetSetter(PROP_COL_VOLDN),
        colorVolumeBuy: redrawGetSetter(PROP_COL_VOLUP),
        colorVolumeSellBorder: redrawGetSetter(PROP_COL_VOLDNBORD),
        colorVolumeBuyBorder: redrawGetSetter(PROP_COL_VOLUPBORD),
        colorVolumeBackground: redrawGetSetter(PROP_COL_VOLBG),
        colorLabelTimeBackground: redrawGetSetter(PROP_COL_LABTIMEBG),
        colorTick: redrawGetSetter(PROP_COL_TICK),
        colorTickLow: redrawGetSetter(PROP_COL_TICK_LOW),
        colorTickHigh: redrawGetSetter(PROP_COL_TICK_HIGH),
        colorTickText: redrawGetSetter(PROP_COL_TICKTEXT),
        colorTickBg: redrawGetSetter(PROP_COL_TICKBG),
        colorLabelTimeForeground: redrawGetSetter(PROP_COL_LABTIMEFG),
        colorLabelCandleBackground: redrawGetSetter(PROP_COL_LABCANBG),
        colorLabelCandleForeground: redrawGetSetter(PROP_COL_LABCANFG),
        colorLabelVolumeBackground: redrawGetSetter(PROP_COL_LABVOLBG),
        colorLabelVolumeForeground: redrawGetSetter(PROP_COL_LABVOLFG),
        labelFontFamily: redrawGetSetter(PROP_LAB_FAM),
        labelFontSize: redrawGetSetter(PROP_LAB_SIZE)
    });

    D3CandleStickChart.low = function(prev, next) {

        if (prev === null) return next;

        return (next === null) ? prev : Math.min(prev, next);
    };

    D3CandleStickChart.high = function(prev, next) {
        if (prev === null) return next;
        return (next === null) ? prev : Math.max(prev, next);
    };

    D3CandleStickChart.dateMS = function(v) {
        if (v instanceof Date) return v.getTime();
        if (typeof v === 'string') {
            var ms = Date.parse(v);
            if (isNaN(ms)) return null;
            return ms;
        }
        if (typeof v === 'number' && !isNaN(v)) return v;
        return null;
    };

    D3CandleStickChart.lowDate = function(prev, next) {
        return D3CandleStickChart.low(prev, D3CandleStickChart.dateMS(next));
    };

    D3CandleStickChart.highDate = function(prev, next) {
        return D3CandleStickChart.high(prev, D3CandleStickChart.dateMS(next));
    };

    D3CandleStickChart.dateSeriesMinutes = function(ms) {
        return moment(ms).format('mm:ss');
    };

    D3CandleStickChart.dateSeriesHours = function(ms) {
        return moment(ms).format('HH:mm');
    };

    D3CandleStickChart.dateSeriesDays = function(ms) {
        return moment(ms).format('MMM, DD');
    };

    D3CandleStickChart.dateSeriesMonths = function(ms) {
        return moment(ms).format('MMM, YYYY');
    };

    D3CandleStickChart.dateSeriesYears = function(ms) {
        return moment(ms).format('MMM, YYYY');
    };

    D3CandleStickChart.dateSeriesFunctionFromDiff = function(start, end) {
        var diff = Math.abs(D3CandleStickChart.dateMS(start) - D3CandleStickChart.dateMS(end));
        return (diff >= 3.1104e+10 ? D3CandleStickChart.dateSeriesYears : (diff >= 2.592e+9 ? D3CandleStickChart.dateSeriesMonths : (diff >= 1.728e+8 ? D3CandleStickChart.dateSeriesDays : (diff >= 3.6e+6 ? D3CandleStickChart.dateSeriesHours : D3CandleStickChart.dateSeriesMinutes))));
    };

    D3CandleStickChart.getScales = function(data, spec) {
        spec = spec || {};
        var
            propLow = spec.propertyLow || 'low',
            propHigh = spec.propertyHigh || 'high',
            propVol = spec.propertyVolume || 'volume',
            propDate = spec.propertyDate || 'date',
            propTick = spec.propertyTick || 'tick';
        var dataNum = this.dataNum;
        return data.reduce(function(p, c, i) { // find all domains using a single data iteration (optimal)
            if(i < dataNum) return p;
            p.lowestLow = D3CandleStickChart.low(p.lowestLow, c[propLow]);
            p.highestHigh = D3CandleStickChart.high(p.highestHigh, c[propHigh]);
            p.volumeLow = D3CandleStickChart.low(p.volumeLow, c[propVol]);
            p.volumeHigh = D3CandleStickChart.high(p.volumeHigh, c[propVol]);
            p.dateLow = D3CandleStickChart.lowDate(p.dateLow, c[propDate]);
            p.dateHigh = D3CandleStickChart.highDate(p.dateHigh, c[propDate]);
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

    D3CandleStickChart.prototype.resize = function(width, height, svg) {
        svg = svg || this.svg;
        width = width || this.width;
        height = height || this.height;

        svg.attr('width', width);
        svg.attr('height', height);

        if (width !== this.width) {
            this.width = width;
        }
        if (height !== this.height) {
            this.height = height;
        }

        return this;
    };

    D3CandleStickChart.prototype.clearData = function() {
        this.data.splice(0, this.data.length);
        this.reset();
        return true;
    };

    D3CandleStickChart.prototype.loadData = function(data) {
        if (!utils.isArray(data)) return false;
        var dataSet = data,
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
                for (i = 0; i < dataSet.length / period; i++) {
                    tmp.close = dataSet[i * period].close;
                    tmp.value = tmp.close;
                    tmp.volume = tmp.close;
                    tmp.high = highest(i * period, period);
                    tmp.low = lowest(i * period, period);
                    if (i != dataSet.length / period - 1) tmp.open = dataSet[(i + 1) * period].close;
                    else if (dataSet[(i + 1) * period - 1].open < tmp.low) tmp.open = tmp.low;
                    else if (dataSet[(i + 1) * period - 1].open > tmp.high) tmp.open = tmp.high;
                    else tmp.open = dataSet[(i + 1) * period - 1].open;
                    if (i == dataSet.length / period - 1) console.log((i + 1) * period, tmp);
                    tmp.date = dataSet[i * period].date;
                    newData.push({
                        open: tmp.open,
                        close: tmp.close,
                        high: tmp.high,
                        low: tmp.low,
                        value: tmp.value,
                        volume: tmp.volume,
                        date: tmp.date,
                    });

                }
            };

        switch (this.gtype) {
            case '1 min':
                newData = data;
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
                newData = data;
                break;
        };
        Array.prototype.push.apply(this.data, newData);
        console.log("loadData");
        this.redraw();
        return true;
    };

    D3CandleStickChart.prototype.reset = function(svg) {
        svg = svg || this.svg;
        this.resetCandles(svg);
        this.resetVolume(svg);
        this.resetLabels(svg);
        this.resetTick(svg);
        this.resetArea(svg);
        this.hideCursor(true);
    };

    D3CandleStickChart.prototype.getScales = function(data) {
        return D3CandleStickChart.getScales(data || this.data, {
            propertyLow: this.propertyLow,
            propertyHigh: this.propertyHigh,
            propertyVolume: this.propertyVolume,
            propertyDate: this.propertyDate,
            tick: this.tick
        });
    };

    D3CandleStickChart.prototype.coordCandles = function() {
        var
            volcoord = this.coordVolume();

        return {
            x: volcoord.x,
            y: 0,
            h: volcoord.y,
            w: volcoord.w
        };
    };

    D3CandleStickChart.prototype.resetArea = function(svg) {
        svg.selectAll('g.area').remove();
        svg.selectAll('g.grid').remove();
        return this;
    };

    D3CandleStickChart.prototype.redrawArea = function(svg, scales) {
        var
            propLow = this.propertyLow,
            propHigh = this.propertyHigh,
            propVol = this.propertyVolume,
            propDate = this.propertyDate,
            propClose = this.propertyClose,
            propOpen = this.propertyOpen,
            colorBG = this.colorCandleBackground,
            colorBodyDown = this.colorCandleBodyDown,
            colorBodyUp = this.colorCandleBodyUp,
            colorStemDown = this.colorCandleStemDown,
            colorStemUp = this.colorCandleStemUp,
            margin = this.marginCandle || 0,
            coord = this.coordCandles(),
            coordVol = this.coordVolume(),
            approxW = (coord.w / this.data.length),
            barSpace = approxW * this.barSpacing,
            barWidth = approxW - barSpace,
            stemWidth = barWidth * 0.15,
            dataNum = this.dataNum,

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

//        if (!this.barPanel) coord.h += coordVol.h;

        calcDateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([0, coord.w - barWidth]),
            calcRY = d3.scaleLinear()
            .domain([scales.lowestLow, scales.highestHigh])
            .range([coord.h - margin, margin]);


        //Make area graph
        groupLines = svg.append("g")
            .attr('class', 'area')
            .attr("transform", 'translate(' + [coord.x, coord.y].join(' ') + ')');
        if (this.gArea == true) {

            groupLines.append('rect')
                .attr('class', 'background')
                .attr('width', coord.w)
                .attr('height', coord.h)
                .attr('fill', colorBG);
            var lastIndex = this.dataNum//this.data.length - 1;

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
                .datum(this.data)
                .attr("fill", "steelblue")
                .attr("style", "opacity: 0.2")
                .attr("d", linesArea);
        }

        //Make grid
        gridFun = d3.axisBottom()
            .scale(1000)
            .ticks(5);

        grid = svg.append("g")
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

        return svg;
    };


    D3CandleStickChart.prototype.scroll = function(delta) {

        this.dataNum -= delta/20;
        if(this.dataNum < 60) this.dataNum = 60;
        if(this.dataNum > 1440) this.dataNum = 1440;
        console.log(this.dataNum);
        this.redraw();
    }
    D3CandleStickChart.prototype.mouseMove = function(event) {

        switch (event.type) {
            case 'mouseleave':
                this.hideCursor();
                return;
                break;
            case 'mouseenter':
            case 'mousemove':
                this.moveCursor(event.pageX, event.pageY);
                break;
            case 'mousedown':
//                if(this.mouseDown) return;
                $( "#main:active").css({cursor:'grabbing!important'});
                console.log("mouseDown");
                this.mouseDown = true;
                break;
            case 'mouseup':
                $(this.el).css({cursor:'crosshair'});
                console.log("mouseUp");
                this.mouseDown = false;
                break;
            default:
                break;

        }

    };

    D3CandleStickChart.prototype.hideCursor = function(show) {
        if(!this.curShow) return;
        this.svg.selectAll('g.cursor').remove();
        if(!show) this.curShow = false;
        this.noRedraw = false;

        console.log("cursorHide", this.curShow, this.curX, this.curY);

    };

    D3CandleStickChart.prototype.showCursor = function(show) {
        coord = this.coordCandles(),
        coordvol = this.coordVolume(),
        data = this.data,
        scales = this.getScales(data),
        svg = this.svg,
        margin = this.marginCandle || 0,
        approxW = (coord.w / this.data.length),
        barSpace = approxW * this.barSpacing,
        barWidth = approxW - barSpace,
        stemWidth = barWidth * 0.15;

        //if not created - create cursorgth
        if($(this.el).find("svg>g.cursor").length  == 0) {
        cursor = svg.append('g')
            .attr('class', 'cursor')
            .attr('transform', 'translate(' + [coord.x, coord.y].join(' ') + ')');
        cursor.append("line")
            .classed("x-line", true)
            .attr("stroke-dasharray", "5 5").attr('stroke-width', 1)
            .attr('stroke-linecap', 'butt')
            .attr('data-animation', 'false')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', this.curXColor);

        cursor.append("line")
            .classed("y-line", true)
            .attr("stroke-dasharray", "5 5")
            .attr('stroke-linecap', 'butt')
            .attr('data-animation', 'false')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', this.curYColor);

        cursor.append("rect")
            .classed("cur-time",true)
            .attr('width', 100)
            .attr('height', 20)
            .attr('fill', this.colorTick);

        cursor.append("rect")
            .classed("cur-value",true)
            .attr('height', 20)
            .attr('fill', this.colorTick);
        cursor.append('text')
            .attr('class', 'cur-label-x')
            .attr('font-family', this.labelFontFamily)
            .attr('font-size', this.labelFontSize * 1.7)
            .attr('text-anchor', 'middle')
            .attr('fill', "#fff");
        cursor.append('text')
            .attr('class', 'cur-label-y')
            .attr('font-family', this.labelFontFamily)
            .attr('font-size', this.labelFontSize * 1.7)
            .attr('text-anchor', 'right')
            .attr('fill', "#fff");
        }



        var
        scaleX = d3.scaleLinear()
            .domain([show.minX, show.maxX])
            .range([0, show.w]),
        scaleY = d3.scaleLinear()
            .domain([show.minY, show.maxY])
            .range([0, show.h]),

        x = show.posX,
        y = show.posY,

        calcDateX = d3.scaleLinear()
            .domain([0, coord.w - barWidth])
            .range([scales.dateLow, scales.dateHigh]),
        calcVolHeight = d3.scaleLinear()
            .domain([0, coord.h])
            .range([scales.volumeHigh, scales.volumeLow]),
        candY = d3.scaleLinear()
            .domain([show.maxY, show.minY])
            .range([scales.lowestLow, scales.highestHigh]);
        curX = svg.select("line.x-line")
            .attr("x1", scaleX(x))
            .attr("x2", scaleX(x))
            .attr("y2", scaleY(show.maxY)), //show.maxY
        curY = svg.select("line.y-line")
            .attr("x2", scaleX(show.maxX))//show.maxX
            .attr("y1", scaleY(y))
            .attr("y2", scaleY(y)),
        curTime = svg.select("rect.cur-time")
            .attr('x', scaleX(x) - 100/2)
            .attr('y', scaleY(show.maxY) + coordvol.h),
        curValue = svg.select("rect.cur-value")
            .attr('x', scaleX(show.maxX))
            .attr('width', show.labelW)
            .attr('y', scaleY(y) - 20/2),
        curXLabel = svg.select("text.cur-label-x")
            .attr('y', scaleY(show.maxY) + coordvol.h + this.labelFontSize * 1.7)
            .attr('x', scaleX(x))
            .text(moment(calcDateX( scaleX(x) ) ).format('H:mm:ss')),
        curYLabel = svg.select("text.cur-label-y")
            .attr('x', scaleX(show.maxX) + 5)
            .attr('y', scaleY(y) + this.labelFontSize * 0.6)
            .text(Math.floor(candY(scaleY(show.posY))*100)/100 );

        console.log("showCursor", this.curShow, show.posX, show.posY);

        this.curShow = true;

        //this.noRedraw = false;
    };


    D3CandleStickChart.prototype.moveCursor = function(posX, posY) {
        var
        coordl = this.coordLabels(),
        coord = this.coordCandles(),
        coordVol = this.coordVolume(),
        coordLabel = this.coordLabels(),
        el = this.el,
        cSX = coordl.seriesX.w,
        margin = this.marginCandle || 0,
        approxW = (coord.w / this.data.length),
        barSpace = approxW * this.barSpacing,
        barWidth = approxW - barSpace,
        maxY = coord.h + margin;
        if($(el).find("svg>g.grid").length > 0){
            var
            minRange = $(el).find("svg>g.grid").offset(),
            maxRangeX = $(el).find("svg>g.label-y").offset(),
            maxRangeY = $(el).find("svg>g.label-x").offset(),
            minX = minRange.left,
            minY = minRange.top,
            maxX = maxRangeX.left,
            maxY = maxRangeY.top;
            if($(el).find("svg>g.volume").length > 0){
                var
                volY = $(el).find("svg>g.volume").offset();
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
            this.hideCursor();
            return;
        }
        this.curX = posX;
        this.curY = posY;
        this.showCursor(show);
    };

    D3CandleStickChart.prototype.resetCandles = function(svg) {
        svg.selectAll('g.candles').remove();
        return this;
    };

    D3CandleStickChart.prototype.redrawCandles = function(svg, scales, data) {
        var
            dataItems = data,
            propLow = this.propertyLow,
            propHigh = this.propertyHigh,
            propVol = this.propertyVolume,
            propDate = this.propertyDate,
            propClose = this.propertyClose,
            propOpen = this.propertyOpen,
            colorBG = this.colorCandleBackground,
            colorBodyDown = this.colorCandleBodyDown,
            colorBodyUp = this.colorCandleBodyUp,
            colorStemDown = this.colorCandleStemDown,
            colorStemUp = this.colorCandleStemUp,
            margin = this.marginCandle || 0,
            coord = this.coordCandles(),
            coordvol = this.coordVolume(),
            approxW = (coord.w / this.dataNum), //this.data.length
            barSpace = approxW * this.barSpacing,
            barWidth = approxW - barSpace,
            stemWidth = barWidth * 0.15,
            dataNum = this.dataNum,
            //Make candles
            group = svg.append('g')
            .attr('class', 'candles')
            .attr('transform', 'translate(' + [coord.x, coord.y].join(' ') + ')'),

            calcDateX = d3.scaleLinear()
            .domain([scales.dateLow, scales.dateHigh])
            .range([0, coord.w - barWidth]);

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

        if (this.gCandle) {
            if (stemWidth > 0) {
                group.selectAll('rect.candle-stem')
                    .data(this.data.filter(function(d,i){
                        return i < dataNum;

                }))
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

            group.selectAll('rect.candle-body')
                .data(this.data.filter(function(d,i){
                        return i < dataNum;

                }))
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
                    return calcRY(this.getAttribute('vmin')) - calcRY(this.getAttribute('vmax'));
                })
                .attr('stroke-width', 0.5)
                .attr('stroke-linecap', 'butt')
                .attr('data-animation', 'false')
                .attr('stroke-rendering', 'crispEdges')
                .attr('stroke', dStemColor)
                .attr('fill', dBodyColor);
            var test = group.selectAll('rect.candle-body').on('mouseover', function(d, i) {
                var tooltipText = 'high:' + dataItems[i].high + '     ' + 'low:' + dataItems[i].low + '     ' + 'open:' + dataItems[i].open + '     ' + 'close:' + dataItems[i].close + '     ' + 'volume:' + dataItems[i].volume + '     ' + dataItems[i].date;
                $(this).tooltip({
                    title: tooltipText,
                    placement: 'bottom',
                    delay: {
                        show: 1,
                        hide: 1
                    }
                });

            });
        }
        return svg;
    };

    D3CandleStickChart.prototype.coordVolume = function() {
        var
            volheight = 100,
            coordlabels = this.coordLabels(),
            coordSX = coordlabels.seriesX;

        if (volheight / this.height > 0.25) {
            volheight = 50;
        }
        if (!this.barPanel) volheight = 0;
        return {
            x: coordSX.x,
            y: coordSX.y - volheight,
            w: coordSX.w,
            h: volheight
        };
    };

    D3CandleStickChart.prototype.resetVolume = function(svg) {
        svg.selectAll('g.volume').remove();
        return this;
    };

    D3CandleStickChart.prototype.redrawVolume = function(svg, scales) {
        if (!this.barPanel) return;
        var
            coord = this.coordVolume(),
            propVol = this.propertyVolume,
            propDate = this.propertyDate,
            propClose = this.propertyClose,
            propOpen = this.propertyOpen,
            colorVolSell = this.colorVolumeSell,
            colorVolBuy = this.colorVolumeBuy,
            colorVolSellBorder = this.colorVolumeSellBorder,
            colorVolBuyBorder = this.colorVolumeBuyBorder,
            colorBG = this.colorVolumeBackground,
            approxW = (coord.w / this.data.length),
            barSpace = approxW * this.barSpacing,
            barWidth = approxW - barSpace,
            dataNum = this.dataNum,
            margin = this.marginVolume || 0;

        if (barWidth < 1) {
            barWidth = 1;
        }

        var
            group = svg.append('g')
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
            .data(this.data.filter(function(d,i){
                        return i < dataNum;

                }))
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

        return svg;
    };

    D3CandleStickChart.prototype.coordLabels = function() {
        var
            xheight = 20,
            ywidth = 75;

        return {
            seriesX: {
                x: 0,
                y: this.height - xheight,
                w: this.width - ywidth,
                h: xheight
            },
            seriesY: {
                x: this.width - ywidth,
                y: 0,
                w: ywidth,
                h: this.height
            }
        };
    };

    D3CandleStickChart.prototype.resetTick = function(svg) {
        svg.selectAll('g.tick').remove();
        return this;
    };

    D3CandleStickChart.prototype.genTick = function(tick, scales, min, max) {
        if (min == max) delta = Math.random() * min * .0000005;
        else delta = (Math.random() * (max - min) + min) * .00005;
        var sign = 1;


        if (Math.random() * 10 < 5) sign = -1;
        if (((this.data.tick + sign * delta) < max) && ((this.data.tick + sign * delta) > min)) this.data.tick += sign * delta;
        else this.data.tick += -1 * sign * delta;

        return Math.floor(this.data.tick * 100) / 100;
    };

    D3CandleStickChart.prototype.redrawTick = function(svg, scales, data) {
//        return;
        if ((this.data[0] == undefined) || !('open' in this.data[0])) {

            return;
        }
        svg = svg || this.svg;
        data = data || this.data;//.filter(function(d,i){return i < this.dataNum});
        dataNum = this.dataNum;
        scales = this.getScales(data.filter(function(d,i){return i < dataNum}));
        this.resetTick(svg);
        var
            coord = this.coordLabels(),
            coordvol = this.coordVolume(),
            coordcand = this.coordCandles(),
            propVol = this.propertyVolume,
            fontFamily = this.labelFontFamily,
            fontSize = this.labelFontSize,
            colorTimeBG = this.colorLabelTimeBackground,
            colorTimeFG = this.colorLabelTimeForeground,
            colorCandleBG = this.colorLabelCandleBackground,
            colorCandleFG = this.colorLabelCandleForeground,
            colorVolumeBG = this.colorLabelVolumeBackground,
            colorVolumeFG = this.colorLabelVolumeForeground,

            colorTick = this.colorTick,
            colorTickLow = this.colorTickLow,
            colorTickHigh = this.colorTickHigh,
            colorTickText = this.colorTickText,
            colorTickBg = this.colorTickBg,
            marginCandle = this.marginCandle || 0,
            marginVolume = this.marginVolume || 0,
            margin = this.marginCandle || 0,

            tick = this.data[0].close,
            tickVol = this.genTick(tick, scales, this.data[0].low, this.data[0].high),
            cSX = coord.seriesX,
            cSY = coord.seriesY,
            groupY = svg.append('g')
            .attr('class', 'tick line')
            .attr('transform', 'translate(' + [0, cSY.y].join(' ') + ')');

        if (tickVol > tick) colorTick = colorTickHigh;
        else colorTick = colorTickLow;
//        if (!this.barPanel) coordcand.h += coordvol.h;
        var
        // candle data & functions:
        candticks = 2,
        candY = d3.scaleLinear()
        .domain([scales.lowestLow, scales.highestHigh])
        .range([coordcand.y + coordcand.h - marginCandle, coordcand.y + marginCandle]); //,


        coordcand.y = candY(tickVol);

        groupY.append('rect') // placeholder for X labels (end-cap)
            .attr('y', coordcand.y - 2)
            .attr('width', coordcand.w)
            .attr('height', 2)
            .attr('fill', colorTick);


        // Candle labels
        groupY.append('rect') // background
            .attr('y', coordcand.y - 12)
            .attr('x', coordcand.w)
            .attr('width', 65)
            .attr('height', 20)
            .attr('fill', colorTick);

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
        var lastY = candY(this.data[0].close),
            coordY = coordcand.y - 12,
            dStemColor = '#db4c3c',
            dBodyColor = '#db4c3c';
        if (this.data[0].close < tickVol) {
            dBodyColor = '#04bf85';
            dStemColor = '#04bf85';
        }
        if (coordY + 10 > lastY) {
            heightB = Math.abs(coordY - lastY + 10);
            $('rect.candle-body').eq(0).attr('height', heightB).attr('y', coordY + 10 - heightB);
        } else {
            heightB = Math.abs(lastY - coordY - 10);
            $('rect.candle-body').eq(0).attr('height', heightB).attr('y', coordY + 10);
        }
        $('rect.candle-stem').eq(0)
            .attr('class', 'candle-stem')
            .attr('stroke-width', 0.5)
            .attr('stroke-linecap', 'butt')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', dStemColor)
            .attr('fill', dBodyColor);

        $('rect.candle-body').eq(0)
            .attr('class', 'candle-body')
            .attr('stroke-width', 0.5)
            .attr('stroke-linecap', 'butt')
            .attr('stroke-rendering', 'crispEdges')
            .attr('stroke', dStemColor)
            .attr('fill', dBodyColor);

        return svg;
    };

    D3CandleStickChart.prototype.resetLabels = function(svg) {
        svg.selectAll('g.labels').remove();
        return this;
    };

    D3CandleStickChart.prototype.redrawLabels = function(svg, scales) {
        var
            coord = this.coordLabels(),
            coordvol = this.coordVolume(),
            coordcand = this.coordCandles(),
            fontFamily = this.labelFontFamily,
            fontSize = this.labelFontSize,
            colorTimeBG = this.colorLabelTimeBackground,
            colorTimeFG = this.colorLabelTimeForeground,
            colorCandleBG = this.colorLabelCandleBackground,
            colorCandleFG = this.colorLabelCandleForeground,
            colorVolumeBG = this.colorLabelVolumeBackground,
            colorVolumeFG = this.colorLabelVolumeForeground,
            marginCandle = this.marginCandle || 0,
            marginVolume = this.marginVolume || 0,
            cSX = coord.seriesX,
            cSY = coord.seriesY,
            groupY = svg.append('g')
            .attr('class', 'labels label-y')
            .attr('transform', 'translate(' + [cSY.x, cSY.y].join(' ') + ')'),
            groupX = svg.append('g')
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
        if (this.barPanel) {
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
            .text(D3CandleStickChart.dateSeriesFunctionFromDiff(scales.dateLow, scales.dateHigh));

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



        return svg;
    };

    D3CandleStickChart.prototype.redraw = function(svg, data) {
//        if(this.noRedraw) return;
        svg = svg || this.svg;
        data = data || this.data;

        // clear existing charted data
        this.reset(svg);

        if (!data.length) { // bail out if no data
            return svg;
        }
        //    this.height+=200;
        // resize SVG to outer limits
        svg.attr('width', this.width);
        svg.attr('height', this.height - 80);
        svg.attr('viewBox', '0 0 ' + this.width + ' ' + this.height);

        var
        /***** scales:
         * lowestLow
         * highestHigh
         * volumeLow
         * volumeHigh
         * dateLow
         * dateHigh
         *****/
        dataNum = this.dataNum;
        scales = this.getScales(data.filter(function(d,i){return i < dataNum}));

        console.log("redraw");
        this.redrawArea(svg, scales);
        this.redrawCandles(svg, scales, data);
        this.redrawVolume(svg, scales);
        this.redrawLabels(svg, scales);
        this.redrawTick(svg, scales);
        console.log(this.curShow, this.curX, this.curY);
        if(this.curShow) this.moveCursor(this.curX, this.curY);
    };

    D3CandleStickChart.prototype.initView = function(svg) {
        console.log("intiView");
        this.el
        this.resize(this.width, this.height, svg);
        this.redraw(svg, this.data);
        return svg;
    };

    D3CandleStickChart.prototype.install = function(parent) {
        parent = parent || this.parent;
        if (!parent) {
            return false;
        }

        // set the parent's svg context
        this[PROP_SVG] = this.initView(d3.select(parent).append('svg:svg'));

        return parent;
    };

    D3CandleStickChart.prototype.uninstall = function(parent) {
        d3.select(parent || this.parent)
            .select('svg')
            .remove();

        return parent;
    };

    this.D3CandleStickChart = D3CandleStickChart;

}).call(this);

(function(el) {
    if (!el) throw new Error('Unable to find main canvas.');

    var chart = new window.D3CandleStickChart(el, {}),


        // data loading stuff
        msPerSec = 1000,
        pair = 'BTC_BTS',
        period = 1000,
        num = 60,
        // numFull = 1440,
        numFull = 14400,
        mainInterval = 200; // Main interval to renew ticks
    graphInterval = 60000; // Iterval in ms to renew all graphs
    epocEnd = Math.round(Date.now() / msPerSec),
        epocStart = Math.round(epocEnd - (period * num));

    chart.data.timerGraph = 0; //Ticks to main redraw
    chart.data.timerTick = 0; // Ticks to red line with current value redraw
    function reloadData(force = false) {
        // Redraw full graph
        if ((chart.data.timerGraph == 0) || (force == true)) {
            $.ajax({ // fetch some chart data
                url: 'http://xcryptex.com/data/amcharts/hystominute?limit=' + numFull + '&instrument_id=2',
                json: true,
                success: function(data) {
                    chart.clearData();

                    chart.loadData(data.map(function(record) {
                        if (record.low > record.high) {
                            var tmp = record.low;
                            record.low = record.high;
                            record.high = record.tmp;
                        }
                        record.date = new Date(record.date);
                        return record;
                    }));
                    chart.data.tick = data[0].close;
                }
            });

            chart.data.timerGraph = graphInterval / mainInterval; // 600 * renew base interval = interval
        }
        // Redraw ticker
        if (chart.data.timerTick == 0) {

            chart.redrawTick();
            chart.data.timerTick = 1; // 1 * renew base interval = interval
        }
        chart.data.timerTick--;
        chart.data.timerGraph--;
    }

    reloadData();
    setInterval(reloadData, mainInterval); //Renew base interval

    // Handlers
    var mouseChange = $("#main").on('mousemove mouseenter mouseleave mousedown mouseup', function(e) {
        chart.mouseMove(e)
    });

    if (el.addEventListener) {
        if ('onwheel' in document) {
            // IE9+, FF17+, Ch31+
            el.addEventListener("wheel", onWheel);
        } else if ('onmousewheel' in document) {
            // устаревший вариант события
            el.addEventListener("mousewheel", onWheel);
        } else {
            // Firefox < 17
            el.addEventListener("MozMousePixelScroll", onWheel);
        }
    } else { // IE8-
        el.attachEvent("onmousewheel", onWheel);
    }

    function onWheel(e) {
        e = e || window.event;

        // wheelDelta не дает возможность узнать количество пикселей
        var delta = e.deltaY || e.detail || e.wheelDelta;

        chart.scroll(delta);

        e.preventDefault ? e.preventDefault() : (e.returnValue = false);
    }

    var candleType = $("#candle-type>button").on('click', function() {
        chart.gtype = $(this).html();
        console.log(chart.gtype);
        reloadData(true);
    });
    var panelShowHide = $("button#panel-show-hide").on('click', function() {
        if ($(this).html() == 'remove panel') {
            chart.barPanel = false;
            $(this).html('add panel');
        } else {
            chart.barPanel = true;
            $(this).html('remove panel');
        }
        reloadData(true);
    });
    var areaShowHide = $("button#area-show-hide").on('click', function() {
        if ($(this).html() == 'remove area') {
            chart.gArea = false;
            $(this).html('add area');
        } else {
            chart.gArea = true;
            $(this).html('remove area');
        }
        reloadData(true);
    });
    var candleShowHide = $("button#candle-show-hide").on('click', function() {
        if ($(this).html() == 'remove candle') {
            chart.gCandle = false;
            $(this).html('add candle');
        } else {
            chart.gCandle = true;
            $(this).html('remove candle');
        }
        reloadData(true);
    });
    (window.onresize = function() {
        chart.resize(window.innerWidth, window.innerHeight);
        console.log("resize");
        chart.redraw();

    })();

})(document.getElementById('main'));
(function(el) {
    if (!el) throw new Error('Unable to find main canvas.');

    var chart = new window.D3CandleStickChart(el, {}),


        // data loading stuff
        msPerSec = 1000,
        pair = 'BTC_BTS',
        period = 1000,
        num = 60,
        // numFull = 1440,
        numFull = 14400,
        mainInterval = 200; // Main interval to renew ticks
    graphInterval = 60000; // Iterval in ms to renew all graphs
    epocEnd = Math.round(Date.now() / msPerSec),
        epocStart = Math.round(epocEnd - (period * num));

    chart.data.timerGraph = 0; //Ticks to main redraw
    chart.data.timerTick = 0; // Ticks to red line with current value redraw
    function reloadData(force = false) {
        // Redraw full graph
        if ((chart.data.timerGraph == 0) || (force == true)) {
            $.ajax({ // fetch some chart data
                url: 'http://xcryptex.com/data/amcharts/hystominute?limit=' + numFull + '&instrument_id=1',
                json: true,
                success: function(data) {
                    chart.clearData();

                    chart.loadData(data.map(function(record) {
                        if (record.low > record.high) {
                            var tmp = record.low;
                            record.low = record.high;
                            record.high = record.tmp;
                        }
                        record.date = new Date(record.date);
                        return record;
                    }));
                    chart.data.tick = data[0].close;
                }
            });

            chart.data.timerGraph = graphInterval / mainInterval; // 600 * renew base interval = interval
        }
        // Redraw ticker
        if (chart.data.timerTick == 0) {

            chart.redrawTick();
            chart.data.timerTick = 1; // 1 * renew base interval = interval
        }
        chart.data.timerTick--;
        chart.data.timerGraph--;
    }

    reloadData();
    setInterval(reloadData, mainInterval); //Renew base interval

    // Handlers
    var mouseChange = $("#main_2").on('mousemove mouseenter mouseleave mousedown mouseup', function(e) {
        chart.mouseMove(e)
    });

    if (el.addEventListener) {
        if ('onwheel' in document) {
            // IE9+, FF17+, Ch31+
            el.addEventListener("wheel", onWheel);
        } else if ('onmousewheel' in document) {
            // устаревший вариант события
            el.addEventListener("mousewheel", onWheel);
        } else {
            // Firefox < 17
            el.addEventListener("MozMousePixelScroll", onWheel);
        }
    } else { // IE8-
        el.attachEvent("onmousewheel", onWheel);
    }

    function onWheel(e) {
        e = e || window.event;

        // wheelDelta не дает возможность узнать количество пикселей
        var delta = e.deltaY || e.detail || e.wheelDelta;

        chart.scroll(delta);

        e.preventDefault ? e.preventDefault() : (e.returnValue = false);
    }

    var candleType = $("#candle-type>button_2").on('click', function() {
        chart.gtype = $(this).html();
        console.log(chart.gtype);
        reloadData(true);
    });
    var panelShowHide = $("button#panel-show-hide_2").on('click', function() {
        if ($(this).html() == 'remove panel') {
            chart.barPanel = false;
            $(this).html('add panel');
        } else {
            chart.barPanel = true;
            $(this).html('remove panel');
        }
        reloadData(true);
    });
    var areaShowHide = $("button#area-show-hide_2").on('click', function() {
        if ($(this).html() == 'remove area') {
            chart.gArea = false;
            $(this).html('add area');
        } else {
            chart.gArea = true;
            $(this).html('remove area');
        }
        reloadData(true);
    });
    var candleShowHide = $("button#candle-show-hide_2").on('click', function() {
        if ($(this).html() == 'remove candle') {
            chart.gCandle = false;
            $(this).html('add candle');
        } else {
            chart.gCandle = true;
            $(this).html('remove candle');
        }
        reloadData(true);
    });
    (window.onresize = function() {
        chart.resize(window.innerWidth, window.innerHeight);
        console.log("resize");
        chart.redraw();

    })();

})(document.getElementById('main_2'));
