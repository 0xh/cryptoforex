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
    
    <!-- <script>
        window.onloads.push(function(){
            $("#deals").on("click",function(){
                jQuery('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
        	    jQuery('.deals,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
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
                        //     $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                        //     $('.dashboard,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
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
                                $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                $('.edit_user,.bgc').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                                // cf.submiter($('.edit_user'));
                            }
                        });

                    },
                    info:function(){}
                }
            });
            window.crmDealList = crm.deal.list;
            window.crmDealCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                document.location.reload();
            }
        });
    </script> -->
</div>
