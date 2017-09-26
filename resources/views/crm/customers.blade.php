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
                                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                $('.edit_user').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
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
                                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                // $('.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
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
                                $cnr.find('.edit:first').attr("onclick",'crm.user.edit('+user.id+')');
                                graphControl.makeChart(120,"user_chart",id,chart);
                                graphControl.makeChart(120,"real_chart",null,rchart);
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
