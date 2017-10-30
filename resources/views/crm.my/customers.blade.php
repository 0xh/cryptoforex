<div class="item">
    <strong>@lang('messages.customers') <span>22</span></strong>
    <ul>
        @if(isset($leads))
        <li>
            <p><a href="#" id="leads">Leads</a></p>
            <p class="num">120</p>
            <p class="last_num">16</p>
        </li>
        @endif
        @if(isset($users))
        <li>
            <p><a href="#" id="user">@lang('messages.users')</a></p>
            <p class="num">{{count($users)}}</p>
            <p class="last_num">{{count($users)}}</p>
        </li>
        @endif
        @if(isset($usershisto))
        <li>
            <p><a href="#" id="user_history">@lang('messages.usershistory')</a></p>
            <p class="num">53</p>
            <p class="last_num">26</p>
        </li>

        <li>
            <p><a href="#" id="users">User verified</a></p>
            <p class="num">4</p>
            <p class="last_num">2</p>
        </li>
        @endif
    </ul>

    <script>
        window.onloads.push(function(){
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                user:{
                    current:null,
                    list:function (container,d,x,s){
                        container.html('');
                        for(var i in d.data){
                            var row=d.data[i],s = '<tr data-class="user" data-id="'+row.id+'">';
                            s+='<td><input type="checkbox" data-name="user_selected" value="user_'+row.id+'" data-id="'+row.id+'" /></td>';
                            s+='<td>'+row.id+'</td>';
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+row.email+'</td>';
                            s+='<td>'+row.name+' '+row.surname+'</td>';
                            s+='<td>'+row.phone+'</td>';
                            s+='<td>'+row.country+'</td>';
                            for(var i =0;i <2;++i){
                                s+=(row.accounts[i]==undefined)?'<td>0</td>':'<td>'+currency.value(row.accounts[i].amount,"USD")+'&nbsp;<sup>'+row.accounts[i].type+'</sup></td>';
                            }
                            s+='<td>'+row.rights.title+'</td>';
                            s+='<td></td>';
                            s+='<td>'+((row.manager)?row.manager.name:'')+'</td>';
                            s+='<td>'+new Date(row.last_login*1000)+'</td>';
                            s+='<td>'+row.last_ip+'</td>';
                            s+='<td><a href="#" onclick="crm.user.edit('+row.id+')" id="edit_user">Edit</a><a href="#" onclick="crm.user.info('+row.id+')" class="edit">Info</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        cf.pagination(d,'user-list',container);
                    },
                    add:function(){},
                    edit:function(id){
                        $.ajax({
                            url:"/json/user/"+id,
                            dataType:"json",
                            success:function(d,x,s){
                                console.debug(d);
                                var user = d[0];
                                $('.edit_user').attr('data-action','/json/user/'+id+'/update');
                                for(var i in user)$('.edit_user form [data-name="'+i+'"]').val(user[i]);
                                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                $('.edit_user').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                                // cf.submiter($('.edit_user'));
                            }
                        });

                    },
                    info:function(){
                        if(!arguments.length)return;
                        var id = arguments[0];
                        id=(typeof(id)=="object")?window.crm.user.current:id;
                        if(id==undefined)return;
                        this.current = id;
                        $.ajax({
                            url:"/html/user/"+id,
                            dataType:"html",
                            success:function(d,x,s){
                                // console.debug(d,x,s);
                                $('body').append(d);
                                // crm.user.calendar.init('scheduler_here');
                            }
                        });return;
                    },
                    deposit:function(i){
                        var tut = $('#'+i);
                        cf.submiter(tut);
                        //console.debug(tut);
                    },
                    deals:function(container,d,x,s){
                        container.html('');
                        for(var i in d){}
                        var pp = cf.pagination(d),$pp = container.parent().next(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);
                    },
                    calendar:{
                        init:function(id) {
                            scheduler.config.xml_date="%Y-%m-%d %H:%i";
                            scheduler.templates.week_date_class=function(date,today){
                                if (date.getDay()==0 || date.getDay()==6)
                                return "weekday";
                                return "";
                            };
                            scheduler.init(id,new Date(2018,0,13),"week");
                            scheduler.load("./Scheduler/data/events.xml");
                        }
                    },
                    instruments:function($cnr,id){
                        var inst_tabs = $cnr.find('.user-instruments-tab'), inst_tab_cons=inst_tabs.parent(), first = true;
                        inst_tabs.html('');
                        for(var i in window.crm.instrument.data){
                            var inst = window.crm.instrument.data[i],s = '';
                            inst_tabs.append('<li>'+inst.title+'</li>');
                            s+='<div class="tabs_dash_con user-instrument" data-id="'+inst.id+'">';
                            s+='<h3>'+inst.title+'</h3>';
                            s+='<img alt="chart for '+inst.title+'" style="width:60%;height:300px; border:solid 1px grey;float:left;"/>';
                            s+='<div class="submiter instrument-fee" style="width:30%;float:left;margin-left:10px;">';
                            s+='<label for="user_instrument_fee">Commission: <input name="fee" value="1"/>%</label>';
                            s+='<a href="#" class="edit button submit">@lang("messages.save")</a>';
                            s+='</div>';
                            s+='<div class="tunner" style="float:left;margin:10px 0 0 10px; border-top:solid 1px grey;width:30%;">';
                            s+='<span class="user_chart_tune">5%</span>&nbsp;';
                            s+='<a id="user_chart_up" href="#" class="button" onclick="crm.user.tune.up('+inst.id+')">Up</a>&nbsp;';
                            s+='<a id="user_chart_up" href="#" class="button" onclick="crm.user.tune.real('+inst.id+')">Real</a>&nbsp;';
                            s+='<a id="user_chart_up" href="#" class="button" onclick="crm.user.tune.down('+inst.id+')">Down</a>';
                            s+='</div>';
                            s+='</div>';
                            inst_tab_cons.append(s);
                            /*<div class="tabs_dash_con">
                                <div class="user-chart-tuner">
                                    <span id="user_chart_tune">5%</span>&nbsp;
                                    <a id="user_chart_up" href="#" onclick="crm.user.tune.up()">Up</a>&nbsp;
                                    <a id="user_chart_up" href="#" onclick="crm.user.tune.real()">Real</a>&nbsp;
                                    <a id="user_chart_up" href="#" onclick="crm.user.tune.down()">Down</a>
                                </div>
                                <div id="user_chart" class="chart"></div>
                            </div>*/
                        }
                        inst_tabs.find('li:first').click();
                    },
                    tune:{
                        getcurdata:function(){
                            var v = $("#user_chart_tune").text().replace(/%/i,"");
                            v=isNaN(v)?0:parseInt(v);
                            return {
                                tune:v,
                                user:crm.user.current
                            };
                        },
                        setcurdata:function(v){

                            $("#user_chart_tune").text(v.tune+'%');

                        },
                        send:function(v){
                            var chart;
                            $.ajax({
                                url:'/json/user/meta',
                                dataType:"json",
                                data:{
                                    meta_name:'user_chart_tune',
                                    meta_value:v.tune,
                                    user_id:v.user
                                },
                                success:function(d){
                                    graphControl.makeChart(6000,"user_chart",v.user,chart);
                                }
                            });
                        },
                        up:function(){
                            var d = this.getcurdata();
                            if(d.tune<0) d.tune = 5;
                            else if(d.tune<=10)d.tune+=5;
                            this.send(d);
                            this.setcurdata(d);
                        },
                        real:function(){
                            var d = this.getcurdata();
                            d.tune=0;

                            this.send(d);
                            this.setcurdata(d);
                        },
                        down:function(){
                            var d = this.getcurdata();
                            if(d.tune>0) d.tune = -5;
                            else if(Math.abs(d.tune)<=10)d.tune-=5;
                            this.send(d);
                            this.setcurdata(d);
                        }
                    }
                }
            });
            window.crmUserList = crm.user.list;
            window.crmUserDealList = crm.user.deals;
            window.crmUserInfo = crm.user.info;
            window.crmUserCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                // document.location.reload();
            }
        });
    </script>
</div>
<div class="popup user">
    <div class="search">
        <form action="#">
            <input type="search" placeholder="Search" class="requester" data-name="search" data-trigger="keyup" data-target="user-list"><button type="submit"></button>
            <p><input type="checkbox" name="online" data-name="online" class="requester" data-trigger="change" data-target="user-list" value="online">@lang('messages.online_users')</p>
            <div class="filter_users">
                <select class="loader" data-name="manager_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                <a href="javascript:0;" class="button batcher" data-list="user_selected" data-action="/json/user/{data-id}/update?parent_user_id={manager_id}" data-target="user-list" onclick="cf.batcher(this);">@lang('message.add_manager')</a>
            </div>

            <div class="filter_users">
                <select class="loader requester" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
            <div class="filter_users">
                <select class="loader requester" data-name="rights_id" data-action="/json/user/rights" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
            <div class="filter_users">
                <select class="loader requester" data-name="country" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>

            <div class="filter_users">
                <select class=" requester" data-name="source" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
        </form>
    </div>
    <strong>Users</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td><input type="checkbox" class="check-all" data-list="user_selected" /></td>
                <td>ID <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Registred <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <!-- <td>Registred <div class="arrow sorter"><span></span><span></span></div></td> -->
                <td>Email <div class="arrow sorter" data-name="email" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Name <div class="arrow sorter" data-name="name" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Phone <div class="arrow sorter" data-name="phone" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Country <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Balance 1 <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Balance 2 <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Rights <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Users <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Admin <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Last Online <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>IP <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="user_list" data-name="user-list" class="loader" data-action="/json/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
    </table>
</div>
