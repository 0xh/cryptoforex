<div class="item">
    <strong>@lang('messages.finance')<span></span></strong>
    <ul>
        <li>
            <p><a href="#" id="money_transactions">Money transactions</a></p>
            <p class="num transaction_list_total">19</p>
            <p class="last_num transaction_list_total_daily">10</p>
        </li>
        <li>
            <p><a href="#" id="withdrawals">Withdrawals</a></p>
            <p class="num withdrawal_list_total">15</p>
            <p class="last_num withdrawal_list_total_daily">7</p>
        </li>
        <li>
            <p><a href="#" id="users_balans">Users balance</a></p>
            <p class="num balance_list_total">16</p>
            <p class="last_num balance_list_total_daily">4</p>
        </li>
    </ul>

    <script>
        window.onloads.push(function(){
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                finance:{
                    current:undefined,
                    list:function (container,d,x,s){
                        container.html('');
                        var daily = 0,curDate = new Date();
                        for(var i in d){
                            var s = '<tr data-class="transaction" data-id="'+d[i].id+'">',row=d[i], trxDate = new Date(row.created_at*1000);
                            daily+=(trxDate.getFullYear()==curDate.getFullYear() && trxDate.getMonth()==curDate.getMonth() && trxDate.getDay()==curDate.getDay() )?1:0;
                            s+='<td>'+trxDate+'</td>';
                            s+='<td>'+row.user.id+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.user.id+'">'+row.user.name+' '+row.user.surname+'</a></td>';
                            s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td></td>';
                            s+='<td>'+row.code+'</td>';
                            s+='<td>'+currency.value(row.amount,row.currency.code)+'</td>';
                            s+='<td>'+row.type+'</td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().closest(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);
                        $('.transaction_list_total').text(d.length);
                        $('.transaction_list_total_daily').text(daily);
                    },
                    balance:function (container,d,x,s){
                        container.html('');
                        var daily = 0,curDate = new Date();
                        for(var i in d){
                            var s = '<tr data-class="balance" data-id="'+d[i].id+'">',row=d[i],usrDate = new Date(d[i].updated_at*1000);
                            daily+=(usrDate.getFullYear()==curDate.getFullYear() && usrDate.getMonth() == curDate.getMonth())?1:0;
                            s+='<td>'+row.id+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.id+'">'+row.name+' '+row.surname+'</a></td>';
                            s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td></td>';
                            s+='<td>'+currency.value(row.deal,row.currency.code)+'</td>';
                            s+='<td>'+currency.value(row.profit,row.currency.code)+'</td>';
                            s+='<td>'+currency.value(row.balance,row.currency.code)+'</td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().closest(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);
                        $('.balance_list_total').text(d.length);
                        $('.balance_list_total_daily').text(daily);
                    },
                    withdrawal:function (container,d,x,s){
                        container.html('');
                        var daily = 0,curDate = new Date();
                        for(var i in d){
                            var s = '<tr data-class="withdrawal" data-id="'+d[i].id+'">',row=d[i], trxDate = new Date(row.created_at*1000);
                            daily+=(trxDate.getFullYear()==curDate.getFullYear() && trxDate.getMonth()==curDate.getMonth() && trxDate.getDay()==curDate.getDay() )?1:0;
                            s+='<td>'+trxDate+'</td>';
                            s+='<td>'+row.user.id+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.user.id+'">'+row.user.name+' '+row.user.surname+'</a></td>';
                            // s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td>&nbsp;</td>';
                            s+='<td>'+row.status+'</td>';
                            s+='<td>'+currency.value(row.amount,row.currency.code)+'</td>';
                            s+='<td><a href="javascript:0;" onclick="crm.finance.confirmwithdrawal('+row.id+')">@lang("messages.confirmwithdrawal")</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().closest(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);
                        $('.withdrawal_list_total').text(d.length);
                        $('.withdrawal_list_total_daily').text(daily);
                    },
                    confirmwithdrawal:function(){
                        
                    }
                }
            });
            window.crmBalanceList = crm.finance.balance;
            window.crmWithdrawalList = crm.finance.withdrawal;
            window.crmTransactionList = crm.finance.list;
            window.crmCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                document.location.reload();
            }
        });
    </script>
</div>
<div class="popup popup_users_balans">
    <strong>Users balances</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Manager</td>
                    <td>In deals<div class="arrow"><span></span><span></span></div></td>
                    <!-- name="status_id" class="loader" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-form="#user_list" -->
                    <td>Profit </td>
                    <td>Balance</td>
                </tr>
            </thead>
            <tbody id="balance_list" data-name="balance-list" class="loader" data-sort="balance desc" data-action="/json/finance/balance" data-function="crmBalanceList" data-autostart="true" data-trigger=""></tbody>
        </table>
    </div>
</div>
<div class="popup widthdtrawal">
    <strong>Widthdtrawal investment</strong>
    <div class="close"></div>
    <div class="table">
        <span>Total: <span class="withdrawal_list_total"></span></span>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Value</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody id="withdrawal_list" data-name="withdrawal-list" class="loader" data-sort="amount desc" data-action="/json/finance/withdrawal?status=request" data-function="crmWithdrawalList" data-autostart="true"></tbody>
        </table>
        </ul>
        <!-- <div class="total_item"><span>5</span>/<span>57</span></div> -->
    </div>
</div>

<div class="popup popup_money_report">
    <strong>Money transaction report</strong>
    <div class="close"></div>
    <div class="search">
        <form action="#">
            <input type="search" placeholder="search" name="search">
            <input type="date" value="Date min">
            <input type="date" value="Date max">
            <select name="processes" id="processes">
                <option value="Withdrawal processing">Withdrawal processing</option>
                <option value="Withdrawal declined">Withdrawal declined</option>
                <option value="Withdrawal successful">Withdrawal successful</option>
                <option value="Deposit in processing">Deposit in processing</option>
                <option value="Deposit declined">Deposit declined</option>
                <option value="Deposit successful">Deposit successful</option>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="table">
        <span>Total: <span class="transaction_list_total"></span></span>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Admin</td>
                    <td>Action</td>
                    <td>Value</td>
                    <td>Method</td>
                </tr>
            </thead>
            <!-- <tbody> -->
            <tbody id="transaction_list" data-name="transaction-list" class="loader" data-action="/json/finance" data-function="crmTransactionList" data-autostart="true" data-trigger=""></tbody>
        </table>
    </div>
</div>
