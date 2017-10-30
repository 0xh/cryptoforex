<div class="item">
    <strong>@lang('messages.instruments')<span>22</span></strong>
    <ul>
        @if(isset($instruments))
        <li>
            <p><a href="#" class="opener" data-action="/html/instrument">@lang('messages.instruments')</a></p>
            <p class="num">{{count($instruments)}}</p>
            <p class="last_num">{{count($instruments)}}</p>
        </li>
        @endif
    </ul>
    <script>
        window.onloads.push(function(){
            $("#instruments").on("click",function(){
                // jQuery('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
        	    jQuery('.instruments').fadeIn((window.animationTime!=undefined)?window.animationTime:256);
            });
        });
        window.onloads.push(function(){
            console.debug(window.crm);
            window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
                instrument:{
                    data:{},
                    list:function (container,d,x,s){
                        container.html('');
                        for(var i in d.data){
                            var row=d.data[i],s = '<tr data-class="instrument" data-id="'+row.id+'">',
                                diff = 100*(parseFloat(row.histo.close)-parseFloat(row.histo.open))/parseFloat(row.histo.open),
                                direction = (diff>0)?'<i class="up"></i>':((diff<0)?'<i class="down"></i>':'');
                            window.crm.instrument.data[row.id] = row;
                            s+='<td>'+row.id+'</td>';
                            s+='<td><input type="checkbox" '+((row.enabled=="1")?'checked="checked"':'')+'/></td>';
                            s+='<td>'+row.title+'</td>';

                            s+='<td>'+diff.toFixed(2)+'%</td>';
                            s+='<td>'+direction+'</td>';

                            s+='<td>'+parseFloat(row.commission)*100+'%</td>';
                            s+='<td><a href="#" onclick="crm.instrument.edit('+row.id+')" id="edit_deal">Edit</a></td>';
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
                            url:"/html/instrument/"+id,
                            success:function(d,x,s){
                                console.debug(d);
                                $('body').append(d);
                                // var inst = d[0],$bb=$('[data-rel=edit_instrument]'),
                                //     ih = new cf.loader($bb.find('.instrument-history').attr('data-action','/json/instrument/'+id+'/history'),Fresher);
                                // $bb.attr('data-action','/json/instrument/'+id+'/update');
                                // for(var i in inst){
                                //     var inpt = $bb.find('form [data-name="'+i+'"]')
                                //     if(inpt.attr('type')=='checkbox')inpt.attr('checked',(inst[i]=="1")?true:false);
                                //     else inpt.val(inst[i]);
                                // }
                                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                                // $bb.fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                                // cf.submiter($('.edit_user'));
                            }
                        });

                    },
                    history:function (container,d,x,s){
                        var int2OnOff=function(i){return (parseInt(i)==1)?'On':'Off';};
                        container.html('');
                        for(var i in d){
                            var s = '<tr data-class="instrument-history" data-id="'+d[i].id+'">',row=d[i];
                            s+='<td>'+new Date(row.created_at*1000)+'</td>';
                            s+='<td>'+int2OnOff(row.old_enabled)+' / '+int2OnOff(row.new_enabled)+'</td>';
                            s+='<td>'+parseFloat(row.old_commission)*100+'% / '+parseFloat(row.new_commission)*100+'%</td>';
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
                    }
                }
            });
            window.crmInstrumentList = crm.instrument.list;
            window.crmInstrumentHistoryList = crm.instrument.history;
            window.crmInstrumentCallback = function(d){
                // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
                document.location.reload();
            }
        });
    </script>
</div>
