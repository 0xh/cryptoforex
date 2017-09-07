<div class="item">
    <strong>@lang('messages.deals')</strong>
    <ul>
        @if(isset($deals))
        <li>
            <p><a href="#" id="deals">@lang('messages.deals')</a></p>
            <p class="num">{{count($deals)}}</p>
            <p class="last_num">{{count($deals)}}</p>
        </li>
        @endif
    </ul>
    <div class="popup deals">
        <div class="search">
            <form action="#">
                <input type="search" placeholder="Search">
                <button type="submit"></button>
                <!-- <a href="#" class="filter">Show filter</a> -->
                <p><input type="checkbox" name="online" data-name="online" value="online"> Active Only</p>
                <!-- <a href="#" class="new">Add user</a> -->
                <!-- <div class="popup popup_filter">
                    <input type="radio" name="radio" data-name="radio" value="Admin"> Admin<br>
                    <input type="radio" name="radio" data-name="radio" value="Manager"> Manager<br>
                    <input type="radio" name="radio" data-name="radio" value="Client"> Client<br>
                    <input type="radio" name="radio" data-name="radio" value="Affiliate"> Affiliate<br>
                    <input type="radio" name="radio" data-name="radio" value="Super_Admin"> Super Admin<br>
                    <input type="radio" name="radio" data-name="radio" value="Fired"> Fired
                </div> -->
            </form>
        </div>
        <strong>Deals</strong>
        <div class="close"></div>
        <table>
            <thead>
                <tr>

                    <td>ID <div class="arrow"><span></span><span></span></div></td>
                    <td>Registred <div class="arrow"><span></span><span></span></div></td>
                    <td>Updated <div class="arrow"><span></span><span></span></div></td>
                    <td>User<div class="arrow"><span></span><span></span></div></td>
                    <td>Instrument <div class="arrow"><span></span><span></span></div></td>
                    <td>Status <div class="arrow"><span></span><span></span></div></td>

                    <td>Amount <div class="arrow"><span></span><span></span></div></td>
                    <td>Multiplier <div class="arrow"><span></span><span></span></div></td>
                    <td>Direction <div class="arrow"><span></span><span></span></div></td>
                    <td>Profit <div class="arrow"><span></span><span></span></div></td>
                    <td>Stops <div class="arrow"><span></span><span></span></div></td>


                    <td></td>
                </tr>
            </thead>
            <tbody class="loader" data-action="/deal" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
        </table>
    </div>
    <script>
        window.onloads.push(function(){
            $("#deals").on("click",function(){
                jQuery('.popup,.bgc').fadeOut(700);
        	    jQuery('.deals,.bgc').fadeIn(700);
            });
        });
        window.onloads.push(function(){
            console.debug(window.crm);
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                deal:{
                    list:function (container,d,x,s){
                        container.html('');
                        for(var i in d){
                            var s = '<tr data-class="deal" data-id="'+d[i].id+'">',row=d[i];
                            s+='<td>'+row.id+'</td>';
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+new Date(row.updated_at*1000)+'</td>';
                            s+='<td><a href="#" data-class="user" data-id="'+row.user.id+'">'+row.user.name+' '+row.user.surname+'</a></td>';
                            s+='<td><a href="#" data-class="instrument" data-id="'+row.instrument_id+'">'+row.instrument.from_currency.code+'/'+row.instrument.to_currency.code+'</a></td>';
                            s+='<td>'+row.status.name+'</td>';
                            s+='<td>'+currency.value(row.amount,row.currency.code)+'</td>';
                            s+='<td>x'+row.multiplier+'</td>';
                            s+='<td>'+((row.direction==-1)?'<i class="fa fa-arrow-down"></i>':'<i class="fa fa-arrow-up"></i>')+'</td>';
                            s+='<td>'+currency.value(row.profit,row.currency.code)+'</td>';
                            s+='<td>'+row.stop_low+' - '+row.stop_high+'</td>';

                            s+='<td><a href="#" onclick="crm.deal.edit('+row.id+')" id="edit_deal">Edit</a><a href="#" onclick="crm.deal.info('+row.id+')" class="edit">Info</a></td>';
                            s+='</tr>'
                            container.append(s);
                        }
                        var pp = cf.pagination(d),$pp = container.parent().closest(".pagination");
                        if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter(container.parent());
                        $pp.html(pp);

                        // $('.edit').click(function(){
                        //     $('.popup,.bgc').fadeOut(700);
                        //     $('.dashboard,.bgc').fadeIn(700);
                        // });
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
                                $('.popup,.bgc').fadeOut(200);
                                $('.edit_user,.bgc').fadeIn(200);
                                // cf.submiter($('.edit_user'));
                            }
                        });

                    },
                    info:function(){}
                }
            });
            window.crmDealList = crm.deal.list;
            window.crmDealCallback = function(d){
                // $('.popup,.bgc').fadeOut(400);
                document.location.reload();
            }
        });
    </script>
</div>
