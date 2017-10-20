<div class="bot">
  <div class="container">
    <div class="flex flex-top">
      <div class="tabs">
        <ul class="tabs__caption flex width">
          <li class="flex active">
            <!-- <span><?php echo app('translator')->getFromJson('messages.history'); ?> </span>
            <span class="all"><?php echo app('translator')->getFromJson('messages.all_history'); ?></span> -->
            <span>active</span>
          </li>
          <li class="flex">
            <!-- <span><?php echo app('translator')->getFromJson('messages.news'); ?></span>
            <span class="all"><?php echo app('translator')->getFromJson('messages.all_news'); ?></span> -->
            <span>signals</span>
          </li>
          <li class="flex">
            <!-- <span><?php echo app('translator')->getFromJson('messages.trade'); ?></span>
            <span class="all"><?php echo app('translator')->getFromJson('messages.Webinars'); ?></span> -->
            <span>closed</span>
          </li>
        </ul>

        <div class="tabs__content active">
          <div class="table">
              <?php if(Auth::guest()): ?>
              <?php else: ?>
              <script>
                function historyCloseDeals(container,d,x,s){
                    container.html('');
                    for(var i in d.data){
                        var row=d.data[i],jsdata = JSON.stringify(d.data[i]),s='<tr class="deal-row" data-instrument-id="'+row.instrument.id+'" data-raw=\''+jsdata+'\' data-price="'+row.open.price+'" '+
                            ((row.status_id==10)?'onclick=\'dealInfo('+jsdata+')\'':'')
                            +' id="deal-'+row.id+'">',
                            inst = row.instrument.from.code+'/'+row.instrument.to.code,
                            prct = 100*(row.profit/row.amount),
                            openTime = new Date(row.open.created_at*1000),
                            closeTime = (row.close!=null)?new Date(row.close.created_at*1000):new Date();

                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+openTime.toGMTString()+'</td>';
                        s+= '<td>'+row.open.price+'</td>';
                        s+= (row.close!=null)?'<td>'+closeTime.toGMTString()+'</td>':'<td>&nbsp;</td>';
                        s+= (row.close!=null)?'<td>'+row.close.price+'</td>':'<td>&nbsp;</td>';
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
                        var row=d.data[i],jsdata = JSON.stringify(d.data[i]),s='<tr class="deal-row" data-instrument-id="'+row.instrument.id+'" data-raw=\''+jsdata+'\' data-price="'+row.open.price+'" '+
                            ((row.status_id==10)?'onclick=\'dealInfo('+jsdata+')\'':'')
                            +' id="deal-'+row.id+'">',
                            inst = row.instrument.from.code+'/'+row.instrument.to.code,
                            prct = 100*(row.profit/row.amount),
                            openTime = new Date(row.open.created_at*1000),
                            profitClass = '';
                        // console.debug(row.id+' ('+row.volation+') => '+profitClass);
                        if(parseInt(row.volation)==1)profitClass='bg_green';
                        else if(parseInt(row.volation)==-1)profitClass='bg_red';
                        // s+= '<td><i class="ic ic_btc"></i><i class="ic ic_lte"></i>'+inst+'</td>';
                        s+= '<td>'+inst+'</td>';
                        s+= '<td class="'+((row.direction==1)?"down":"up")+'">'+openTime.toGMTString()+'</td>';
                        s+= '<td>'+row.open.price+'</td>';
                        s+= '<td>&nbsp;</td>';
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
                  <th><?php echo app('translator')->getFromJson('messages.Assets'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.D/T/O'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.open_price'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.current_price'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.invested'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.received'); ?></th>
                  <th><?php echo app('translator')->getFromJson('messages.Profit'); ?> %</th>
                </thead>
                <tbody class="loader" data-action="/deal?status=open&user_id=<?php echo e(Auth::user()->id); ?>" data-autostart="true" data-refresh="4800" data-function="historyDeals"></tbody>
                </table>
              <?php endif; ?>

          </div>
        </div>

        <div class="tabs__content">
          <div class="table table_ta">
            <div class="top flex flex-top">
              <strong><?php echo app('translator')->getFromJson('messages.tech'); ?></strong>
              <ul class="flex">
                <li><a href="#">1 <?php echo app('translator')->getFromJson('messages.min'); ?></a></li>
                <li><a href="#">5 <?php echo app('translator')->getFromJson('messages.min'); ?></a></li>
                <li><a href="#">15 <?php echo app('translator')->getFromJson('messages.min'); ?></a></li>
                <li><a href="#">30 <?php echo app('translator')->getFromJson('messages.min'); ?></a></li>
                <li><a href="#">1 <?php echo app('translator')->getFromJson('messages.hour'); ?></a></li>
                <li><a href="#">5 <?php echo app('translator')->getFromJson('messages.hour'); ?></a></li>
                <li><a href="#">1 <?php echo app('translator')->getFromJson('messages.day'); ?></a></li>
                <li><a href="#">1 <?php echo app('translator')->getFromJson('messages.week'); ?></a></li>
                <li><a href="#">1 <?php echo app('translator')->getFromJson('messages.month'); ?></a></li>
              </ul>
            </div>
            <table class="width">
              <thead>
                <th><?php echo app('translator')->getFromJson('messages.instruments'); ?></th>
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
              <?php if(Auth::guest()): ?>
              <?php else: ?>

              <table class="width">
                  <thead>
                    <th><?php echo app('translator')->getFromJson('messages.Assets'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.D/T/O'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.open_price'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.D/T/C'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.close'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.invested'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.received'); ?></th>
                    <th><?php echo app('translator')->getFromJson('messages.Profit'); ?> %</th>
                  </thead>
                <tbody class="loader" data-action="/deal?status=close&user_id=<?php echo e(Auth::user()->id); ?>" data-autostart="true" data-refresh="8000" data-function="historyCloseDeals"></tbody>
                </table>
              <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
