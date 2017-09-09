@extends('layouts.app')
@section('content')
<main class="main">
    <div class="container">
    	<div class="charts1 flex flex-top">
    		<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
			<script src="//www.amcharts.com/lib/3/pie.js"></script>
			<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
			<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
			<link rel="stylesheet" href="//www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    		<div class="item">
    			<script>
    				var chart = AmCharts.makeChart( "chart_pie", {
					  "type": "pie",
					  "theme": "light",
					  "dataProvider": [ {
					    "title": "BTC/LTE",
					    "value": 100
					  }, {
					    "title": "BTC/LTE",
					    "value": 400
					  } ],
					  "titleField": "title",
					  "valueField": "value",
					  "labelRadius": 5,

					  "radius": "42%",
					  "innerRadius": "60%",
					  "labelText": "[[title]]",
					  "export": {
					    "enabled": true
					  }
					} );
    			</script>
    			<div id="chart_pie" style="width: 100%;height: 500px;"></div>
    			
    		</div>
    		<div class="item">
    			<script>
    				var chart = AmCharts.makeChart("chart_pie2", {
					  "type": "pie",
					  "startDuration": 0,
					   "theme": "light",
					  "addClassNames": true,
					  "legend":{
					   	"position":"top",
					    "marginRight":0,
					    "autoMargins":false
					  },
					  "innerRadius": "30%",
					  "defs": {
					    "filter": [{
					      "id": "shadow",
					      "width": "200%",
					      "height": "200%",
					      "feOffset": {
					        "result": "offOut",
					        "in": "SourceAlpha",
					        "dx": 0,
					        "dy": 0
					      },
					      "feGaussianBlur": {
					        "result": "blurOut",
					        "in": "offOut",
					        "stdDeviation": 5
					      },
					      "feBlend": {
					        "in": "SourceGraphic",
					        "in2": "blurOut",
					        "mode": "normal"
					      }
					    }]
					  },
					  "dataProvider": [{
					    "country": "USA/BTC",
					    "litres": 200
					  }, {
					    "country": "USA/BTC",
					    "litres": 100
					  }, {
					    "country": "USA/BTC",
					    "litres": 150
					  }],
					  "valueField": "litres",
					  "titleField": "country",
					  "export": {
					    "enabled": true
					  }
					});

					chart.addListener("init", handleInit);

					chart.addListener("rollOverSlice", function(e) {
					  handleRollOver(e);
					});

					function handleInit(){
					  chart.legend.addListener("rollOverItem", handleRollOver);
					}

					function handleRollOver(e){
					  var wedge = e.dataItem.wedge.node;
					  wedge.parentNode.appendChild(wedge);
					}
    			</script>
    			<div id="chart_pie2" style="width: 100%;height: 500px;font-size: 12px;"></div>
    		</div>
    	</div>
    	<div class="table_carts">
            <table class="width">
              <thead>
                <th>Актив</th>
                <th>Дата/время/цена открытия</th>
                <th>Дата/время/цена закрытия</th>
                <th>вложено</th>
                <th>получено</th>
                <th>прибыль%</th>
              </thead>
              <tbody>
                <tr>
                  <td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>BTC/LTE</td>
                  <td class="down">17 авг 12:23:52 - 1.17821</td>
                  <td>17 авг 13:26:17 - 1.17777</td>
                  <td>$100 <span>x20</span></td>
                  <td>$ 102.89</td>
                  <td class="green">2.88%</td>
                </tr>
                <tr>
                  <td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>BTC/LTE</td>
                  <td class="down">7 авг 11:52:26 - 1.17541</td>
                  <td>7 авг 12:37:25 - 1.17412</td>
                  <td>$100 <span>x20</span></td>
                  <td>$ 110.73</td>
                  <td class="green">10.04%</td>
                </tr>
                <tr>
                  <td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>BTC/LTE</td>
                  <td class="up">7 авг 09:47:13 - 1.11706</td>
                  <td>7 авг 09:57:20 - 1.11711</td>
                  <td>$100 <span>x20</span></td>
                  <td>$ 97.63</td>
                  <td class="red">-2.24%</td>
                </tr>
                <tr>
                  <td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>BTC/LTE</td>
                  <td class="up">6 авг 23:22:16 - 1.17541</td>
                  <td>7 авг 01:07:15 - 1.17621</td>
                  <td>$100 <span>x20</span></td>
                  <td>$ 95.23</td>
                  <td class="red">-4.71%</td>
                </tr>
              </tbody>
            </table>
          </div>
    	<div class="charts2 flex flex-top"></div>
    </div>
</main>
@endsection
