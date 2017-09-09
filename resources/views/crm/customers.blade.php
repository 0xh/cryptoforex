<div class="item">
    <strong>@lang('messages.customers')</strong>
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
    <div class="popup user">
        <div class="search">
            <form action="#">
                <input type="search" placeholder="Search">
                <button type="submit"></button>
                <a href="#" class="filter">Show filter</a>
                <p><input type="checkbox" name="online" data-name="online" value="online"> Online Only</p>
                <a href="#" class="new">Add user</a>
                <div class="popup popup_filter">
                    <input type="radio" name="radio" data-name="radio" value="Admin"> Admin<br>
                    <input type="radio" name="radio" data-name="radio" value="Manager"> Manager<br>
                    <input type="radio" name="radio" data-name="radio" value="Client"> Client<br>
                    <input type="radio" name="radio" data-name="radio" value="Affiliate"> Affiliate<br>
                    <input type="radio" name="radio" data-name="radio" value="Super_Admin"> Super Admin<br>
                    <input type="radio" name="radio" data-name="radio" value="Fired"> Fired
                </div>
            </form>
        </div>
        <strong>Users</strong>
        <div class="close"></div>
        <table>
            <thead>
                <tr>
                    <td>ID <div class="arrow"><span></span><span></span></div></td>
                    <td>Registred <div class="arrow"><span></span><span></span></div></td>
                    <td>Email <div class="arrow"><span></span><span></span></div></td>
                    <td>Name <div class="arrow"><span></span><span></span></div></td>
                    <td>Phone <div class="arrow"><span></span><span></span></div></td>
                    <td>Country <div class="arrow"><span></span><span></span></div></td>
                    <td>Balance 1 <div class="arrow"><span></span><span></span></div></td>
                    <td>Balance 2 <div class="arrow"><span></span><span></span></div></td>
                    <td>Rights <div class="arrow"><span></span><span></span></div></td>
                    <td>Users <div class="arrow"><span></span><span></span></div></td>
                    <td>Admin <div class="arrow"><span></span><span></span></div></td>
                    <td>Last Online <div class="arrow"><span></span><span></span></div></td>
                    <td>IP</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="loader" data-action="/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
            <!-- <tbody class="loader" data-action="/user" data-func="crmUserList" data-autostart="true" data-trigger="">
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}} {{$user->surname}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->country or 'unknown'}}</td>

                    <td>{{$user->account->demo->amount or '-'}}</td>
                    <td>{{$user->account->real->amount or '-'}}</td>
                    <td>{{$user->rights_id}}</td>

                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>

                    <td><a href="#" id="edit_user">Edit</a><a href="#" class="edit">Info</a></td>
                </tr>
                @endforeach

            </tbody> -->
        </table>
    </div>
    <div class="popup dashboard">
        <div class="close"></div>
        <div class="top">
            <div class="item user-chart" style="width:100%;position:relative; min-height:500px;margin-top:20px;">
                <span>@lang('messages.user_dashboard')</span>
                <div class="user-chart-tuner" style="position:absolute;top:70px;left:44px;font-size:12px;">
                    <span id="user_chart_tune">5%</span>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.up()">Up</a>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.real()">Real</a>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.down()">Down</a>
                </div>
                <div id="user_chart" style="position:absolute;top:94px;left:44px;width:560px;height:420px;"></div>
                <div id="real_chart" style="position:absolute;top:94px;right:44px;width:560px;height:420px;"></div>
            </div>
            <div class="item user-accounts">
                <span>@lang('messages.user_accounts')</span>
                <!-- <div class="item-bank"><a href="#"><span></span>79 901.89</a></div>
                <div class="item-chart"><a href="#"><span></span>10 157.67</a></div> -->
            </div>
        </div>
        <div class="bot">
            <div class="item">
                <div class="left">
                    <strong>@lang('messages.user_data')</strong>
                    <a href="#" class="edit">Edit data user</a>
                    <ul>
                        <li>First name: <span class="user-name"></span></li>
                        <li>Last name: <span class="user-surname"></span></li>
                        <li>Created: <span class="user-created"></span></li>
                        <li>E-mail: <span class="user-email"></span></li>
                        <li>Phone number: <span class="user-phone"></span></li>
                        <li>Country: <span class="user-country"></span></li>
                        <!-- <li>Source: <span class="user-name"></span></li>
                        <li>Source Description: <span class="user-name"></span></li> -->
                    </ul>
                    <a href="#" class="back">Back</a>
                </div>
                <!--

                 <div class="right">

                    <ul>
                        <li>Fred</li>
                        <li>Collins</li>
                        <li>05-22-2017 15:27:17</li>
                        <li>Fred.Collins@alfadiamonds.com</li>
                        <li>+0000000000000</li>
                        <li>Belgium</li>
                        <li>Information</li>
                        <li>More information</li>
                    </ul>
                </div> -->
            </div>
            <div class="item">
                <div class="item_con">
                    <strong>Tasks Panel</strong>
                    <a href="#" class="add">Add Task</a>
                    <p class="task">Task need to do</p>
                    <div class="popup task_popup">
                        <textarea name="task" id="task"></textarea>
                    </div>
                </div>
                <div class="item_con">
                    <strong>Comments</strong>
                    <p class="coment">No Comments</p>
                    <textarea name="coment" id="coment" placeholder="Enter comment text"></textarea>
                    <div class="item_abs">
                        <a href="#">Add Comment</a>
                    </div>
                </div>
            </div>
            <div class="popup_tabs">
                <ul>
                    <li>Leads</li>
                    <li>Users</li>
                    <li>History</li>
                    <li class="active">Send E-mail</li>
                    <li>Charts</li>
                    <li>Commissions</li>
                    <li>Diamonds in sell</li>
                    <li>My diamonds</li>
                </ul>
                <textarea name="popup_tabs" id="popup_tabs" placeholder="Enter your text or use templates"></textarea>
            </div>
            <div class="form_bot"></div>
        </div>

    </div>
    <div class="popup edit_user submiter" data-callback="crmUserCallback">
        <span>Edit User</span>
        <div class="close"></div>
        <form action="#">
            <div class="item">
                <input type="text" name="name" data-name="name" placeholder="Name">
                <input type="email" name="email" data-name="email" placeholder="Nameaddress@servername.com">
                <input type="text" name="country" data-name="country" placeholder="Country">
                <!-- <input type="text" name="money" data-name="money" placeholder="$23 758.56"> -->
                <select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/userrights" data-autostart="true"></select>
            </div>
            <div class="item">
                <input type="text" name="surname" data-name="surname" placeholder="Surname">
                <input type="tel" name="phone" data-name="phone" placeholder="Phone number">
                <input type="password" name="password" data-name="password" placeholder="password">
                <input type="text" name="Comment" data-name="Comment" placeholder="Comment">
                <!-- <select name="name_sur" data-name="name_sur" id="name_sur" placeholder="Name Surname">
                    <option value="non-select" disabled="" selected="">User rightscountry</option>
                    <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                    <option value="Samuel L. Jacson">Samuel L. Jacson</option>
                    <option value="George Washington">George Washington</option>
                    <option value="Peris Hilton">Peris Hilton</option>
                    <option value="Megan Fox">Megan Fox</option>
                </select> -->
            </div>
        </form>
        <a href="#" class="his">Megan Fox</a>
        <div class="button">
            <a href="#" class="close cancel">Close</a>
            <!-- <a href="#" class="edit submit">Edit User</a> -->
            <a href="#" class="edit submit">@lang('messages.save')</a>
        </div>
    </div>
    <script>
        window.onloads.push(function(){
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                user:{
                    currentUser:null,
                    list:function (container,d,x,s){
                        container.html('');
                        for(var i in d){
                            var s = '<tr data-class="user" data-id="'+d[i].id+'">',row=d[i];
                            s+='<td>'+row.id+'</td>';
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+row.email+'</td>';
                            s+='<td>'+row.name+' '+row.surname+'</td>';
                            s+='<td>'+row.phone+'</td>';
                            s+='<td>'+row.country+'</td>';
                            s+='<td>'+((row.account.demo!=undefined)?currency.value(row.account.demo.amount,"USD"):0)+'</td>';
                            s+='<td>'+((row.account.real!=undefined)?row.account.real.amount:0)+'</td>';
                            s+='<td>'+row.rights_id+'</td>';
                            s+='<td></td>';
                            s+='<td></td>';
                            s+='<td>'+new Date(row.last_login*1000)+'</td>';
                            s+='<td>'+row.last_ip+'</td>';
                            s+='<td><a href="#" onclick="crm.user.edit('+row.id+')" id="edit_user">Edit</a><a href="#" onclick="crm.user.info('+row.id+')" class="edit">Info</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().closest(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);

                    },
                    add:function(){},
                    edit:function(id){
                        $.ajax({
                            url:"/user/"+id,
                            dataType:"json",
                            success:function(d,x,s){
                                console.debug(d);
                                var user = d[0];
                                $('.edit_user').attr('data-action','/user/'+id+'/edit');
                                for(var i in user)$('.edit_user form [data-name="'+i+'"]').val(user[i]);
                                $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                $('.edit_user,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                                // cf.submiter($('.edit_user'));
                            }
                        });

                    },
                    info:function(id){
                        this.currentUser = id;
                        $.ajax({
                            url:"/user/"+id,
                            dataType:"json",
                            before:function(){
                                $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                $('.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                            },
                            success:function(d,x,s){
                                var user = d[0],$cnr = $('.dashboard:first'),chart,rchart;
                                $.ajax({
                                    url:'/usermeta',
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
                                console.debug("info: ",user);
                                for(var i in user.account) $cnr.find('.user-accounts:first').append('<div class="item-bank"><a href="#"><span></span>'+user.account[i].amount+'</a></div>');
                                for(var i in user)$cnr.find('.user-'+i+':first').text(user[i]);
                                graphControl.makeChart(6000,"user_chart",id,chart);
                                graphControl.makeChart(6000,"real_chart",null,rchart);
                                // $('.edit_user').attr('data-action','/user/'+id+'/edit');
                                // for(var i in user)$('.edit_user form [data-name="'+i+'"]').val(user[i]);
                                $cnr.fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                            }
                        });

                    },
                    tune:{
                        getcurdata:function(){
                            var v = $("#user_chart_tune").text().replace(/%/i,"");
                            v=isNaN(v)?0:parseInt(v);
                            return {
                                tune:v,
                                user:crm.user.currentUser
                            };
                        },
                        setcurdata:function(v){

                            $("#user_chart_tune").text(v.tune+'%');

                        },
                        send:function(v){
                            var chart;
                            $.ajax({
                                url:'/usermeta',
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
            window.crmUserCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                document.location.reload();
            }
        });
    </script>
</div>
