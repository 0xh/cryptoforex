var SmartScroll = (function () {

  var SmartScroll = function (scrollElement, containers, callback) {

    this.$scroll = $(scrollElement);
    this.$containers = $(containers);
    this.whenVisible = callback;
    this.scrollTimeout = null;

    this.bind();

    // Start rendering
    this.$scroll.trigger('scroll.smart');
  };

  SmartScroll.prototype = {

    bind: function () {

      var that = this;

      that.$scroll.on('scroll.smart', function () {

        if (that.scrollTimeout)
          clearTimeout(that.scrollTimeout);

        // Execute at the end of scroll
        that.scrollTimeout = setTimeout(function () {

          var html = document.documentElement,
              clientHeight = html.clientHeight,
              visibleContainers = [],
              clientRect,
              visibleHeight;

          that.$containers.each(function () {

            clientRect = this.getBoundingClientRect();
            visibleHeight = (clientRect.height - 20);

            // Show if at least 20 pixels of the container height is visible
            if (clientRect.top >= visibleHeight * -1 && clientRect.bottom <= clientHeight + visibleHeight)
              visibleContainers.push(this);
          });

          if (visibleContainers.length)
            that.whenVisible(visibleContainers);

        }, 250);
      });
    }
  };

  return SmartScroll;

})();

var createChart = function (containerElement, index) {

  var id = ["chart", index].join("-"),
      columnElement = document.createElement("div"),
      loaderElement = document.createElement("div");

  loaderElement.setAttribute("class", "ui active loader");
  columnElement.setAttribute("class", "column");
  columnElement.setAttribute("id", id);
  columnElement.appendChild(loaderElement);
  containerElement.appendChild(columnElement);

  var info = {
        id: id,
        containerElement: columnElement,
        isDrawn: false,
        draw: function (callback) {

          info.isDrawn = true;

          var chart = AmCharts.makeChart(id, {
            "type": "serial",
            "theme": "light",
            "categoryField": "year",
            "rotate": true,
            // Disable animations
            "startDuration": 0,
            "categoryAxis": {
              "gridPosition": "start",
              "position": "left"
            },
            "trendLines": [],
            "graphs": [{
              "balloonText": "Income:[[value]]",
              "fillAlphas": 0.8,
              "id": "AmGraph-1",
              "lineAlpha": 0.2,
              "title": "Income",
              "type": "column",
              "valueField": "income"
            }, {
              "balloonText": "Expenses:[[value]]",
              "fillAlphas": 0.8,
              "id": "AmGraph-2",
              "lineAlpha": 0.2,
              "title": "Expenses",
              "type": "column",
              "valueField": "expenses"
            }],
            "guides": [],
            "valueAxes": [{
              "id": "ValueAxis-1",
              "position": "top",
              "axisAlpha": 0
            }],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": [{
              "year": 2005,
              "income": 23.5,
              "expenses": 18.1
            }, {
              "year": 2006,
              "income": 26.2,
              "expenses": 22.8
            }, {
              "year": 2007,
              "income": 30.1,
              "expenses": 23.9
            }, {
              "year": 2008,
              "income": 29.5,
              "expenses": 25.1
            }, {
              "year": 2009,
              "income": 24.6,
              "expenses": 25
            }],
            "listeners": [{
              "event": "init",
              "method": callback
            }],
            "export": {
              "enabled": true
            }

          });
        }
      };

  return info;
}

var containerElement = document.getElementById("charts-container"),
    numberOfCharts = 120,
    index = 0,
    chartInfo,
    chartReferences = {};

while(index < numberOfCharts) {
  chartInfo = createChart(containerElement, index);
  chartReferences[chartInfo.id] = chartInfo;
  index++;
}

var scroll = new SmartScroll(document, '#charts-container .column', function (elements) {

  var index = 0,
      info,
      draw = function (element) {
        var id = element.getAttribute('id'),
            whenReady = function () {

              setTimeout(function () {

                index++;

                // Draw next
                if (elements[index])
                  draw(elements[index]);

              }, 0);
            };

        info = chartReferences[id];

        if (info.isDrawn)
          whenReady();
        else
          info.draw(whenReady);
      };

  // Start drawing
  draw(elements[index]);
});
