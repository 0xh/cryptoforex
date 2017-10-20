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
                        for(var i in d){
                            var s = '<tr data-class="user" data-id="'+d[i].id+'">',row=d[i];
                            s+='<td><input type="checkbox" data-name="user_selected" value="user_'+row.id+'" data-id="'+row.id+'" /></td>';
                            s+='<td>'+row.id+'</td>';
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+row.email+'</td>';
                            s+='<td>'+row.name+' '+row.surname+'</td>';
                            s+='<td>'+row.phone+'</td>';
                            s+='<td>'+row.country+'</td>';
                            s+='<td>'+((row.account.demo!=undefined)?currency.value(row.account.demo.amount,"USD"):0)+'</td>';
                            s+='<td>'+((row.account.real!=undefined)?row.account.real.amount:0)+'</td>';
                            s+='<td>'+row.rights.title+'</td>';
                            s+='<td></td>';
                            s+='<td>'+((row.manager.name)?row.manager.name:'')+'</td>';
                            s+='<td>'+new Date(row.last_login*1000)+'</td>';
                            s+='<td>'+row.last_ip+'</td>';
                            s+='<td><a href="#" onclick="crm.user.edit('+row.id+')" id="edit_user">Edit</a><a href="#" onclick="crm.user.info('+row.id+')" class="edit">Info</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().next(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);
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
                        console.debug(id);
                        if(id==undefined)return;
                        this.current = id;
                        $.ajax({
                            url:"/json/user/"+id,
                            dataType:"json",
                            before:function(){
                                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                // $('.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                            },
                            success:function(d,x,s){
                                var user = d[0],$cnr = $('.user_dashboard:first'),chart,rchart;
                                $.ajax({
                                    url:'/json/user/meta',
                                    dataType:"json",
                                    data:{
                                        meta_name:'user_chart_tune',
                                        user_id:user.id
                                    },
                                    success:function(d){
                                        var v = (d.meta_value==undefined)?0:d.meta_value;
                                        crm.user.tune.setcurdata({tune:v});
                                    }
                                });

                                window.crm.user.instruments($cnr,id);
                                var udeals = cf._loaders[$cnr.find('.user-deals #user_deals').attr("data-name")];
                                udeals.opts.data["user_id"]=user.id;
                                udeals.execute();
                                $cnr.find('.user-accounts .left').html('');
                                for(var i in user.account){
                                    var accname = (i=="demo")?'@lang("messages.real")':'@lang("messages.demo")';
                                    $cnr.find('.user-accounts .left').append('<div class="item-bank">\
                                        <h5 class="user-account-name">'+accname+'</h5><a href="#">\
                                        <span></span>'+user.account[i].amount+'</a>\
                                        <div class"submiter user-account" id="user_account_'+user.account[i].id+'" data-autostart="true" data-id="'+user.account[i].id+'" data-action="/json/finance/deposit?account_id='+user.account[i].id+'&merchant_id=1" data-callback="crmUserInfo">\
                                        <input name="amount" data-name="amount"/>\
                                        <button class="deposit submit" onclick="window.crm.user.deposit(\'user_account_'+user.account[i].id+'\')">@lang("messages.deposit")</button>\
                                    </div></div>');

                                }
                                for(var i in user)$cnr.find('.user-'+i).text(user[i]);
                                $cnr.find('.edit').attr("onclick",'crm.user.edit('+user.id+')');
                                // graphControl.makeChart(120,"user_chart",id,chart);
                                // graphControl.makeChart(120,"real_chart",null,rchart);
                                // $('.edit_user').attr('data-action','/user/'+id+'/edit');
                                for(var i in user)$('.edit_user form [data-name="'+i+'"]').val(user[i]);
                                $cnr.fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                            }
                        });

                    },
                    deposit:function(i){
                        var tut = $('#'+i);
                        cf.submiter(tut);
                        //console.debug(tut);
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
            <!-- <a href="#" class="filter">Show filter</a> -->
            <p><input type="checkbox" name="online" data-name="online" class="requester" data-trigger="change" data-target="user-list" value="online">@lang('messages.online_users')</p>
            <!-- <div class="batcher">
            </div> -->
            <div class="filter_users">
                <select class="loader" data-name="manager_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                <a href="javascript:0;" class="button batcher" data-list="user_selected" data-action="/json/user/{data-id}/update?manager_id={manager_id}" data-target="user-list" onclick="cf.batcher(this);">@lang('message.add_manager')</a>
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
<div class="popup new_user">
    <strong>New Users</strong>
    <div class="close"></div>
    <div class="search">
      <div class="form">
          <form action="#">
              <select name="affiliate" id="affiliate">
                  <option value="Select Affiliate">Select Affiliate</option>
                  <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                  <option value="Jessica Alba">Jessica Alba</option>
                  <option value="Christopher Lambert">Christopher Lambert</option>
                  <option value="Jonny Dep">Jonny Dep</option>
              </select>
              <select name="source" id="source">
                  <option value="Select Source">Select Source</option>
                  <option value="Diamonds-marketing.com">Diamonds-marketing.com</option>
              </select>
              <select name="country" id="country">
                  <option value="Select Country">Select Country</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
              </select>
              <select name="admin" id="admin">
                  <option value="Select Admin">Select Admin</option>
                  <option value="Collins Fred">Collins Fred</option>
                  <option value="James Bond">James Bond</option>
                  <option value="Ashley Cooper">Ashley Cooper</option>
                  <option value="New guy">New guy</option>
              </select>
              <input type="submit" value="Change admin">
          </form>
        </div>
    </div>
    <div class="table">
      <span>Total: 4</span>
      <table>
          <thead>
              <tr>
                  <td></td>
                  <td>ID</td>
                  <td>Registration</td>
                  <td>Mail</td>
                  <td>Name</td>
                  <td>Phone</td>
                  <td>Country</td>
                  <td>Balance</td>
                  <td>IP</td>
                  <td>Source</td>
                  <td>Affiliate</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
          </tbody>
      </table>
    </div>
    <div class="pagination">
      <ul>
          <li class="first">
              <a href="#">First page</a>
          </li>
          <li class="prev">
              <a href="#">...</a>
          </li>
          <li>
              <a href="#">3</a>
          </li>
          <li>
              <a href="#">4</a>
          </li>
          <li class="active">
              <a href="#">5</a>
          </li>
          <li>
              <a href="#">6</a>
          </li>
          <li>
              <a href="#">7</a>
          </li>
          <li class="next">
              <a href="#">...</a>
          </li>
          <li class="last">
              <a href="#">Last page</a>
          </li>
      </ul>
      <div class="total_item">
          <span>5</span>/<span>57</span>
      </div>
    </div>
</div>
