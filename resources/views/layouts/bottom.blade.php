<div class="bot">
  <div class="container">
    <div class="flex flex-top">
      <div class="tabs">
        <ul class="tabs__caption flex width">
          <li class="flex active">
            <!-- <span>@lang('messages.history') </span>
            <span class="all">@lang('messages.all_history')</span> -->
            <span>active</span>
          </li>
          <li class="flex">
            <!-- <span>@lang('messages.news')</span>
            <span class="all">@lang('messages.all_news')</span> -->
            <span>signals</span>
          </li>
          <li class="flex">
            <!-- <span>@lang('messages.trade')</span>
            <span class="all">@lang('messages.Webinars')</span> -->
            <span>closed</span>
          </li>
        </ul>

        <div class="tabs__content active">
          <div class="table">
              @if(Auth::guest())
              @else
              <script>
                function dateTime(d){
                    if(d==undefined || d==null)return '';
                    var dd =  new Date(d*1000),r = '',pad=function(v){
                        v = v.toString().replace(/\s*(\S+)\s*/,'$1');
                        return ((v.length==1)?'0':'')+v;
                    };
                    r = dd.getFullYear()+"-"+pad(dd.getMonth()+1)+"-"+pad(dd.getDate());
                    r+= "&nbsp;<sup>"+pad(dd.getHours())+':'+pad(dd.getMinutes())+"</sup>";
                    return r;
                }
                function historyCloseDeals(container,d,x,s){
                    container.html('');
                    for(var i in d.data){
                        var row=d.data[i],jsdata = JSON.stringify(d.data[i]),s='<tr class="deal-row" data-instrument-id="'+row.instrument.id+'" data-raw=\''+jsdata+'\' data-price="'+row.open_price+'" '+
                            ((row.status_id==10)?'onclick=\'dealInfo('+jsdata+')\'':'')
                            +' id="deal-'+row.id+'">',
                            inst = row.instrument.from.code+'/'+row.instrument.to.code,
                            prct = 100*(row.profit/row.amount),
                            openTime = new Date(row.created_at*1000),
                            closeTime = new Date(row.updated_at*1000);

                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+dateTime(row.created_at)+'</td>';
                        s+= '<td>'+row.open_price+'</td>';
                        s+= '<td>'+dateTime(row.updated_at)+'</td>';
                        s+= '<td>'+row.close_price+'</td>';
                        s+= '<td>'+currency.value(row.amount,'USD')+' <span>x'+row.multiplier+'</span></td>';
                        s+= '<td class="'+((row.close_price==undefined)?'profit':"")+'">'+currency.value(parseFloat(row.amount)+parseFloat(row.profit),'USD',4)+'</td>';
                        s+= '<td class="'+((row.profit>0)?"green":"red")+'">'+prct.toFixed(2)+'%</td>'
                        s+='</tr>';
                        container.append(s);
                    }
                }
                function historyDeals(container,d,x,s){
                    container.html('');
                    for(var i in d.data){
                        var row=d.data[i],jsdata = JSON.stringify(d.data[i]),s='<tr class="deal-row" data-instrument-id="'+row.instrument.id+'" data-raw=\''+jsdata+'\' data-price="'+row.open_price+'" '+
                            ((row.status_id==10)?'onclick=\'dealInfo('+jsdata+')\'':'')
                            +' id="deal-'+row.id+'">',
                            inst = row.instrument.title,
                            prct = 100*(row.profit/row.amount),
                            openTime = new Date(row.created_at*1000),
                            profitClass = '',profitClass2 = '';
                        // console.debug(row.id+' ('+row.volation+') => '+profitClass);
                        if(parseInt(row.volation)==1)profitClass='bg_green';
                        else if(parseInt(row.volation)==-1)profitClass='bg_red';
                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+dateTime(row.created_at)+'</td>';
                        s+= '<td>'+row.open_price+'</td>';
                        s+= '<td class="'+profitClass2+'">'+((row.close_price!=undefined)?row.close_price:'&nbsp;')+'</td>';
                        s+= '<td>'+currency.value(row.amount,'USD')+' <span>x'+row.multiplier+'</span></td>';

                        s+= '<td class="'+profitClass+'">'+currency.value(parseFloat(row.amount)+parseFloat(row.profit),'USD',4)+'</td>';
                        s+= '<td class="'+((row.profit>=0)?"green":"red")+'">'+prct.toFixed(2)+'%</td>'
                        s+='</tr>';
                        container.append(s);
                    }
                }
              </script>
              <table class="width">
                <thead>
                  <th>@lang('messages.Assets')</th>
                  <th>@lang('messages.D/T/O')</th>
                  <th>@lang('messages.open_price')</th>
                  <th>@lang('messages.current_price')</th>
                  <th>@lang('messages.invested')</th>
                  <th>@lang('messages.received')</th>
                  <th>@lang('messages.Profit') %</th>
                </thead>
                <tbody class="loader" data-action="/deal?status=open&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="2400" data-function="historyDeals"></tbody>
                </table>
              @endif

          </div>
        </div>

        <div class="tabs__content">
          <div class="table table_ta">
            <div class="top flex flex-top">
              <strong>@lang('messages.tech')</strong>
              <ul class="flex">
                <li><a href="#">1 @lang('messages.min')</a></li>
                <li><a href="#">5 @lang('messages.min')</a></li>
                <li><a href="#">15 @lang('messages.min')</a></li>
                <li><a href="#">30 @lang('messages.min')</a></li>
                <li><a href="#">1 @lang('messages.hour')</a></li>
                <li><a href="#">5 @lang('messages.hour')</a></li>
                <li><a href="#">1 @lang('messages.day')</a></li>
                <li><a href="#">1 @lang('messages.week')</a></li>
                <li><a href="#">1 @lang('messages.month')</a></li>
              </ul>
            </div>
            <table class="width">
              <thead>
                <th>@lang('messages.instruments')</th>
                <th>RSI(14)</th>
                <th>STOCH(9,6)</th>
                <th>STOCHRSI(14)</th>
                <th>MACD(12,26)</th>
                <th>ADX(14)</th>
                <th>Williams (%R)</th>
                <th>CCI(14)</th>
                <th>ATR(14)</th>
              </thead>
              <tbody>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                </tr>
                <tr>
                  <td>BTC/LTC</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                  <td class="green">BUY</td>
                  <td class="red">SELL</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="tabs__content">
          <div class="table">
              @if(Auth::guest())
              @else

              <table class="width">
                  <thead>
                    <th>@lang('messages.Assets')</th>
                    <th>@lang('messages.D/T/O')</th>
                    <th>@lang('messages.open_price')</th>
                    <th>@lang('messages.D/T/C')</th>
                    <th>@lang('messages.close')</th>
                    <th>@lang('messages.invested')</th>
                    <th>@lang('messages.received')</th>
                    <th>@lang('messages.Profit') %</th>
                  </thead>
                <tbody class="loader" data-action="/deal?status=close&user_id={{Auth::user()->id}}" data-autostart="true" data-refresh="4800" data-function="historyCloseDeals"></tbody>
                </table>
              @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
