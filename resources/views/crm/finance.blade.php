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
        <!-- <li>
            <p><a href="#" id="users_balans">Users balance</a></p>
            <p class="num balance_list_total">16</p>
            <p class="last_num balance_list_total_daily">4</p>
        </li> -->
    </ul>

    <script>
        window.onloads.push(function(){
            $('#money_transactions').on('click',function(){$('.popup_money_report').fadeIn(256);});
            $('#withdrawals').on('click',function(){$('.widthdtrawal').fadeIn(256);});
            $('#users_balans').on('click',function(){$('.popup_users_balans').fadeIn(256);});
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                finance:{
                    current:undefined,
                    list:function (container,d,x,s){
                        container.html('');
                        var daily = 0,curDate = new Date();
                        for(var i in d.data){
                            var row=d.data[i], s = '<tr data-class="transaction" data-id="'+row.id+'">', trxDate = new Date(row.created_at*1000);
                            daily+=(trxDate.getFullYear()==curDate.getFullYear() && trxDate.getMonth()==curDate.getMonth() && trxDate.getDay()==curDate.getDay() )?1:0;
                            s+='<td>'+trxDate+'</td>';
                            s+='<td>'+row.account.user.id+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.account.user.id+'">'+row.account.user.name+' '+row.account.user.surname+'</a></td>';
                            s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td></td>';
                            s+='<td>'+row.code+'</td>';
                            s+='<td>'+currency.value(row.amount,row.account.currency.code)+'</td>';
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
                        for(var i in d.data){
                            var row=d.data[i],s = '<tr data-class="balance" data-id="'+row.id+'">',usrDate = new Date(row.updated_at*1000);
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

                        $('.balance_list_total').text(d.total);
                        $('.balance_list_total_daily').text(daily);
                    },
                    withdrawal:function (container,d,x,s){
                        container.html('');
                        var daily = 0,curDate = new Date();
                        for(var i in d.data[i]){
                            var row=d.data[i], s = '<tr data-class="withdrawal" data-id="'+row.id+'">', trxDate = new Date(row.created_at*1000);
                            daily+=(trxDate.getFullYear()==curDate.getFullYear() && trxDate.getMonth()==curDate.getMonth() && trxDate.getDay()==curDate.getDay() )?1:0;
                            s+='<td>'+trxDate+'</td>';
                            s+='<td>'+row.account.user.id+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.account.user.id+'">'+row.account.user.name+' '+row.account.user.surname+'</a></td>';
                            // s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td>&nbsp;</td>';
                            s+='<td>'+row.status+'</td>';
                            s+='<td>'+currency.value(row.amount,row.account.currency.code)+'</td>';
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
