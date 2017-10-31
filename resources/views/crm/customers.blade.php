<div class="item">
    <strong>@lang('messages.customers') <span>{{count($users)}}</span></strong>

    <ul>
        @can('superadmin')
            <li>
                <p><a href="javascript:window.crm.user.showList({rights_id:7});" class="m-user">@lang('messages.Admin')</a></p>
                <p class="num">{{$counts->admin or 'nodata'}}</p>
                <p class="last_num">{{$counts->admin_last or 'nodata'}}</p>
            </li>
        @endcan
        @can('admin')
            <li>
                <p><a href="javascript:window.crm.user.showList({rights_id:5});" class="m-user">@lang('messages.Manager')</a></p>
                <p class="num">{{$counts->manager or 'nodata'}}</p>
                <p class="last_num">{{$counts->manager_last or 'nodata'}}</p>
            </li>
            <li>
                <p><a href="javascript:window.crm.user.showList({rights_id:0});" class="m-user">@lang('messages.Ban')</a></p>
                <p class="num">{{$counts->fired or 'nodata'}}</p>
                <p class="last_num">{{$counts->fired_last or 'nodata'}}</p>
            </li>
        @endcan
        @can('manager')
            <li>
                <p><a href="#" class="m-user">@lang('messages.KYC')</a></p>
                <p class="num">{{$counts->admin or 'nodata'}}</p>
                <p class="last_num">{{$counts->admin_last or 'nodata'}}</p>
            </li>
            <li>
                <p><a href="javascript:window.crm.user.showList({rights_id:1});" class="m-user">@lang('messages.Client')</a></p>
                <p class="num">{{$counts->client or 'nodata'}}</p>
                <p class="last_num">{{$counts->client_last or 'nodata'}}</p>
            </li>
            <li>
                <p><a href="javascript:window.crm.user.showList({rights_id:2});" class="m-user">@lang('messages.Affiliate')</a></p>
                <p class="num">{{$counts->affilate or 'nodata'}}</p>
                <p class="last_num">{{$counts->affilate_last or 'nodata'}}</p>
            </li>
            <li>
                <p><a href="#" class="m-user">@lang('messages.Lead')</a></p>
                <p class="num">{{count($leads)}}</p>
                <p class="last_num">{{count($leads)}}</p>
            </li>
        @endcan
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
                    showList:function(opts){
                        $.ajax({
                            url:'/html/user',
                            dataType:"html",
                            data:opts,
                            success:function(d,x,s){
                                $(d).appendTo('body');
                                // cf._loaders['user-list'].opts.data={};
                                // cf._loaders['user-list'].execute();
                                cf.reload();
                            }
                        });
                        return;
                        var container = $('.popup.users');
                        container.fadeIn((animationTime)?animationTime:256);$('body').addClass('active');
                        // console.debug(container.find('select'));
                        container.find('input').val('');
                        container.find('select').removeAttr('selected').val('false');
                        for(var i in opts){
                            container.find('[data-name="'+i+'"]')
                                .val(opts[i])
                                // .change();
                        }
                        // console.debug(container.find('select[data-name=status_id]').val());
                        cf._loaders['user-list'].opts.data={};
                        cf._loaders['user-list'].execute();
                        // container.find('select:last').change();
                    },
                    list:function (container,d,x,s){
                        if(d.data.length==0){
                            var mm = $('<div class="popup users empty-list" style="display:block;padding:2rem;text-align:center; width: 12rem;">@lang("messages.list_empty")</div>').appendTo('body');
                            $('<div class="close"></div>').appendTo(mm).on('click',function(e){
                                $('.empty-list').fadeOut( 256, function(){ $(this).remove(); });
                            });
                            return;
                        }
                        container.html('');
                        for(var i in d.data){
                            var row=d.data[i],s = '<tr data-class="user" data-id="'+row.id+'">';
                            s+='<td><input type="checkbox" data-name="user_selected" value="user_'+row.id+'" data-id="'+row.id+'" /></td>';
                            s+='<td>'+row.id+'</td>';

                            s+='<td>'+dateFormat(row.created_at)+'</td>';
                            s+='<td>'+row.email+'</td>';
                            s+='<td>'+row.name+' '+row.surname+'</td>';
                            s+='<td>'+row.phone+'</td>';
                            s+='<td>'+row.country+'</td>';
                            s+='<td>'+row.status.title+'</td>';
                            for(var i =0;i <2;++i){
                                s+=(row.accounts[i]==undefined)?'<td>0</td>':'<td>'+currency.value(row.accounts[i].amount,"USD")+'&nbsp;<sup>'+row.accounts[i].type+'</sup></td>';
                            }
                            s+='<td>'+row.rights.title+'</td>';
                            s+='<td>'+row.users_count+'</td>';
                            s+='<td>'+((row.manager)?row.manager.name:'')+'</td>';
                            s+='<td>'+dateFormat(row.last_login)+'</td>';
                            s+='<td>'+row.last_ip+'</td>';
                            // s+='<td><a href="#" onclick="crm.user.edit('+row.id+')" id="edit_user">Edit</a><a href="#" onclick="crm.user.info('+row.id+')" class="edit">Info</a></td>';
                            s+='<td><a href="#" onclick="crm.user.info('+row.id+')" class="edit">Info</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        cf.pagination(d,'user-list',container);
                        container.find('[data-name=user_selected]').on('click change keyup',function(e){
                            if($('[data-name=user_selected]:checked').length)$('[data-name=manager_id]').show();else $('[data-name=manager_id]').hide();
                        })
                        $('[data-name=manager_id]').on("change",function(){
                            var manager_id = $(this).val();
                            $('[data-name=user_selected]:checked').each(function(){
                                var id = $(this).attr('data-id');
                                $.ajax({
                                    url:'/json/user/'+id+'/update?parent_user_id='+manager_id,
                                    success:function(){
                                    }
                                });
                            }).promise().done(function(){
                                $('.check-all').prop('checked',false);
                                cf._loaders['user-list'].execute();
                            });
                        });
                    },
                    add:function(){
                        var s = '<div class="popup edit_user submiter user-add" data-callback="crmUserCallback" data-callback-error="crmUserCallbackError" data-action="/user/add/json">';
                        s+= '<span>@lang("messages.user_add")</span><div class="close" onclick="{ $(\'.user-add\').fadeOut( 256, function(){ $(this).remove(); } ); }"></div>';
                        s+= '<form action="#">';
                        s+= '<div class="item">'
                                +'<input type="text" name="name" data-name="name" placeholder="Name">'
                                +'<input type="email" name="email" data-name="email" placeholder="Nameaddress@servername.com">'
                                +'<input type="password" name="password" data-name="password" placeholder="password">'
                                +'<select name="rights_id" data-title="Rights" data-name="rights_id" placeholder="User rights" class="loader" data-action="/json/user/rights" data-autostart="true"></select>'
                                +'<select name="status_id" data-title="Status" data-name="status_id" placeholder="User status" class="loader" data-action="/json/user/status" data-autostart="true"></select>'
                            +'</div>';
                        s+= '<div class="item">'
                                +'<input type="text" name="surname" data-name="surname" placeholder="Surname"/>'
                                +'<input type="tel" name="phone" data-name="phone" placeholder="Phone number"/>'
                                +'<input type="text" name="country" data-name="country" placeholder="Country"/>'
                            +'</div>';

                        s+= '</form>';
                        s+= '<hr style="display:block;width:100%;"/>';
                        s+= '<div class="button"><a href="#" class="close cancel">Close</a><a href="#" class="edit submit">@lang("messages.add")</a></div>';
                        $(s).appendTo('body').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                        cf.reload();
                        // $('.edit_user span:first').html('@lang("messages.user_add")');
                        // $('.edit_user').attr('data-action','/user/add/json');
                        // // $('.edit_user form input').val('');
                        // $('.edit_user').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                    },
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
                        });
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
            window.crmUserCallback = function(){
                var args = arguments.length?arguments[0]:undefined;
                console.debug("UserInfoCallback",args);
                $('.edit_user').fadeOut(animationTime?animationTime:256);
                cf._loaders['user-list'].execute();
            };
            window.crmUserCallbackError = function(d){
                alert(d.message);
            }
        });
    </script>
</div>
