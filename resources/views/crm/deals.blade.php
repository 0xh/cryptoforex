<div class="item">
    <strong>@lang('messages.deals')<span>22</span></strong>
    <ul>
        @if(isset($deals))
        <li>
            <p><a href="#" id="deals">@lang('messages.deals')</a></p>
            <p class="num">{{count($deals)}}</p>
            <p class="last_num">{{count($deals)}}</p>
        </li>
        @endif
    </ul>

    <script>
        window.onloads.push(function(){
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                deal:{
                    current:undefined,
                    list:function (container,d,x,s){
                        container.html('');
                        console.debug(d);
                        for(var i in d.data){
                            var row=d.data[i],s = '<tr data-class="deal" data-id="'+row.id+'">';
                            s+='<td>'+row.id+'</td>';
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+new Date(row.updated_at*1000)+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.user.id+'">'+row.user.name+' '+row.user.surname+'</a></td>';
                            s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td></td>';
                            s+='<td><a href="#" data-class="instrument" data-id="'+row.instrument_id+'">'+row.instrument.from.code+'/'+row.instrument.to.code+'</a></td>';
                            s+='<td>'+row.status.name+'</td>';
                            s+='<td>'+currency.value(row.amount,row.currency.code)+'</td>';
                            s+='<td>x'+row.multiplier+'</td>';
                            s+='<td>'+((row.direction==-1)?'<i class="fa fa-arrow-down"></i>':'<i class="fa fa-arrow-up"></i>')+'</td>';
                            s+='<td>'+currency.value(row.profit,row.currency.code)+'</td>';
                            s+='<td>'+row.stop_low+' - '+row.stop_high+'</td>';

                            // s+='<td><a href="#" onclick="crm.deal.edit('+row.id+')" id="edit_deal">@lang('messages.edit')</a><a href="#" onclick="crm.deal.info('+row.id+')" class="edit">@lang('messages.info')</a></td>';
                            s+='<td><a href="#" onclick="crm.deal.info('+row.id+')" class="edit">@lang('messages.info')</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        cf.pagination(d,'deal-list',container);
                    },
                    info:function(id){
                        if(!arguments.length)return;
                        var id = arguments[0];
                        id=(typeof(id)=="object")?window.crm.user.current:id;
                        if(id==undefined)return;
                        this.current = id;
                        $.ajax({
                            url:"/html/deal/"+id,
                            dataType:"html",
                            success:function(d,x,s){
                                console.clear();
                                console.debug(d,x,s);
                                $('body').append(d);
                                // crm.user.calendar.init('scheduler_here');
                            }
                        });return;

                        $.ajax({
                            url:"/json/deal/"+id,
                            dataType:"json",
                            success:function(d,x,s){
                                var deal = d[0],$bb = $('[data-rel=deal_dashboard]'),showDealDetail=function(i,data,ns){
                                    if(typeof(data[i])!="string")return '';
                                    if(i.match(/_id$/))return '';
                                    if(ns!=undefined)ns='deal';
                                    ns+='-';
                                    var val = data[i],name = i;
                                    switch(i){
                                        case "created_at":
                                            name = '@lang("messages.created_at")';
                                        case "updated_at":
                                            name = '@lang("messages.updated_at")';
                                            val = new Date(val*1000);
                                            break;
                                    }
                                    return '<li>'+i+'<span class="data-detail '+ns+i+'">'+val+'</span></li>'
                                },chart;
                                // $('.edit_user').attr('data-action','/user/'+id+'/edit');
                                // graphControl.makeChart(60,"deal_chart",deal.user.id,chart);
                                $bb.find('.deal-data').html('');
                                for(var i in deal)
                                    $bb.find('.deal-data').append(showDealDetail(i,deal));

                                $bb.find('.user-data').html('');
                                $bb.find('.user-info-link').attr('onclick','crm.user.info('+deal.user.id+')');
                                for(var i in deal.user)
                                    $bb.find('.user-data').append(showDealDetail(i,deal.user,'user'));
                                if(deal.manager)$bb.find('.user-data').append(showDealDetail('name',deal.manager,'user'));

                                $bb.fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                                // cf.submiter($('.edit_user'));
                            }
                        });
                    }
                }
            });
            window.crmDealList = crm.deal.list;
            window.crmDealCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                document.location.reload();
            }
        });
    </script>
</div>
<div class="popup popup_b deals">
    <strong>Deals</strong>
    <div class="close"></div>
    <div class="contenta flex">
        <div class="search">
            <form action="#">
                <div class="filter_users">
                    <select class="loader requester" data-name="status_id" data-action="/json/deal/status" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
                </div>
                <div class="filter_users">
                    <select class="loader requester" data-name="instrument_id" data-action="/json/instrument" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
                </div>
            </form>
        </div>
        <table>
              <thead>
                  <tr>
                      <td>ID <div class="arrow sorter" data-name="id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Registred <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Updated <div class="arrow sorter" data-name="updated_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>User<div class="arrow sorter" data-name="user_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Manager<div class="arrow sorter" data-name="manager_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Instrument<div class="arrow sorter" data-name="instrument_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Status<div class="arrow sorter" data-name="status_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Amount<div class="arrow sorter" data-name="amount" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Multiplier<div class="arrow sorter" data-name="multiplier" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Direction<div class="arrow sorter" data-name="direction" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Profit<div class="arrow sorter" data-name="profit" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                      <td>Stops <div class="arrow"><span></span><span></span></div></td>
                      <td>&nbsp;</td>
                  </tr>
              </thead>
              <tbody class="loader" data-name="deal-list" data-action="/json/deal?status=all" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
        </table>
  </div>
</div>
