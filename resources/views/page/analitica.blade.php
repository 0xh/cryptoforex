@extends('layouts.app')
@section('content')
<main class="main">
    <div class="container">
    	<div class="charts1 flex flex-top">
    		<div class="item">
    			<div id="chart_pie" style="width: 100%;height: 500px;"></div>    			
    		</div>
    		<div class="item">
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
