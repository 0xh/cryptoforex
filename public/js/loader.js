"use strict";
function cfDataLoader(){

}
function pageReload(){
    document.location.reload();
}
var cf={
    _statdata:{},
    getDataByField:function(s,field,v){
        if(this._statdata[s]==undefined)return undefined;
        if(this._statdata[s][0]==undefined)return undefined;
        if(this._statdata[s][0][field]==undefined)return undefined;
        for(var i in this._statdata[s]){
            if(this._statdata[s][i][field] == v)return this._statdata[s][i];
        }
        return undefined;
    },
    getDataById:function(s,id){
        return cf.getDataByField(s,"id",id);
    },
    getDataByName:function(s,name){
        return cf.getDataByField(s,"name",id);
    },
    getDataByTitle:function(s,name){
        return cf.getDataByField(s,"title",id);
    },
    reload:function(){
        $(".loader:not(.loader-assigned)").each(function(){
            new cf.loader(this,Fresher);
        }).addClass('loader-assigned');
        $(".submiter:not(.submiter-assigned)").each(function(){
            cf.submiter(this);
        }).addClass('submiter-assigned');
        $(".sorter:not(.sorter-assigned)").each(function(){
            cf.sorter($(this));
        }).addClass('sorter-assigned');
        $(".check-all:not(.checkall-assigned)").on("change",function(){
            var v = $(this).is(':checked')?true:false, list = $(this).attr("data-list");
            $('[data-name='+list+']').prop("checked",v).change();
        }).addClass('checkall-assigned');
        $(".requester:not(.requester-assigned)").each(function(){
            new cf.requester($(this));
        }).addClass('requester-assigned');
        $("a.opener:not(.opener-assigned)").on("click",function(e){
            var $that = $(this),url = $that.attr("data-action");
            if(url!=undefined){
                $.ajax({
                    url:url,
                    success:function(d){
                        console.debug(d,$(d).appendTo('body'));
                        cf.reload();
                    }
                });
            }
        }).addClass("opener-assigned");
    },
    _actions:[],
    _loaders:[],
    _requests:[],
    _type:"get",
    _switchOff:false,
    refresher:function(){
        cf._actions=[];
        this.tick=0;
        this.bind=function(){
            var bnd = $.extend({
                refresh:1,
                last:new Date().getTime(),
                run:function(){}
            },arguments.length?arguments[0]:{});
            cf._actions.push(bnd);
        };
        this.execute=function(){
            if(cf._switchOff)return;
            if(cf._actions.length==0)return;
            var dt = new Date().getTime();
            for(var i in cf._actions){
                // console.debug("refresher #"+i,(dt-cf._actions[i].last),'>',cf._actions[i].refresh);
                if((dt-cf._actions[i].last)>cf._actions[i].refresh){
                    var args = (cf._actions[i].arguments == undefined)?null:cf._actions[i].arguments;
                    // console.debug("refresher executing...",cf._actions[i].run,args);
                    cf._actions[i].run(args);
                    cf._actions[i].last = dt;
                }
                // cf._switchOff=true;
            }
        };
        setInterval(this.execute,1000);
        // console.debug("refresher constructor called");
    },
    pagination:function(d){
        /*
        current_page:1
        from:1
        data:[]
        last_page:1
        next_page_url:null
        path:"http://cryptoforex.bs2/json/deal"
        per_page:24
        prev_page_url:null
        to:12
        total:12
        */
        var s='',tl=(arguments.length>1)?arguments[1]:'data-list',$t = (arguments.length>2)?arguments[2]:undefined;
		s+='<ul>';
		s+='<li class="first"><a class="requester" data-name="page" data-value="1" href="javascript:0;" data-trigger="click" data-target="'+tl+'">First page</a></li>';
		if(d.prev_page_url)s+='<li class="prev"><a class="requester" data-name="page" data-value="'+(d.current_page-1)+'" href="javascript:0;" data-trigger="click" data-target="'+tl+'">...</a></li>';
        for(var i=0;i<d.last_page;++i){
            s+='<li class="'+((d.current_page==(i+1))?"active":"")+'"><a class="requester" data-name="page" data-value="'+(i+1)+'" href="javascript:0;" data-trigger="click" data-target="'+tl+'">'+(i+1)+'</a></li>';
        }
        if(d.next_page_url)s+='<li class="next"><a class="requester" data-name="page" data-value="'+(d.current_page+1)+'" href="javascript:0;" data-trigger="click" data-target="'+tl+'">...</a></li>';
		s+='<li class="last"><a class="requester" data-name="page" data-value="'+d.last_page+'" href="javascript:0;" data-trigger="click" data-target="'+tl+'">Last page</a></li>';
		s+='</ul>';
		s+='<div class="total_item"><span>'+d.current_page+'</span>/<span>'+d.last_page+'</span></div>';
        if($t){
            var $pp = $t.parent('table').next(".pagination");
            if(!$pp.length) $pp = $('<div class="pagination"></div>').insertAfter($t.parent());
            $pp.html(s);
            cf.reload();
        }
        return s;
    },
    pagination2:function(d){
        var s='',first = true,perpage = 12,pages = Math.ceil(d.length/perpage);
		s+='<ul>';
		s+='<li class="first active"><a href="#">First page</a></li>';
		s+='<li class="prev"><a href="#">...</a></li>';
        for(var i=0;i<pages;++i){
            s+='<li><a href="#">'+(i+1)+'</a></li>';
        }
        s+='<li class="next"><a href="#">...</a></li>';
		s+='<li class="last"><a href="#">Last page</a></li>';
		s+='</ul>';
		s+='<div class="total_item"><span>'+((d.length<perpage)?d.length:perpage)+'</span>/<span>'+d.length+'</span></div>';
        return s;
    },
    loader:function(){
        var container=arguments.length?$(arguments[0]):null;
        var _frshr = arguments.length?$(arguments[1]):new cf.refresher();
        this.opts = {
            container:container,
            autostart: false,
            refresh:0
        };
        if(container == null) return;
        var attrs = {
            uid:(container.attr("data-id")==undefined)?container.attr("data-name"):container.attr("data-id"),
            func:container.attr("data-function"),
            autostart:(container.attr("data-autostart")=="true"),
            action:container.attr("data-action"),
            refresh:(container.attr("data-refresh")!=undefined)?container.attr("data-refresh"):0,
            trigger:(container.attr("data-trigger")!=undefined)?container.attr("data-trigger"):false,
            request:(container.attr("data-request")!=undefined)?container.attr("data-request"):false,
            sort:(container.attr("data-sort")!=undefined)?container.attr("data-sort"):false,
            callback:(container.attr("data-request-function")!=undefined)?container.attr("data-request-function"):false,
            data:{}
        };
        this.opts = $.extend(this.opts,attrs);
        this.opts = $.extend(this.opts,((arguments.length>1)?arguments[1]:{}));
        // console.debug(this.opts);
        this.execute = function(){
            var opts = (arguments.length)?arguments[0]:this.opts,rdata = {};
            if(opts==undefined || opts.container == undefined )return;
            opts.action = opts.container.attr('data-action');
            container.find("input,select,textarea").each(function(){
                var name = $(this).attr('data-name'), val = $(this).val();
                console.debug(opts.uid,name,val);
                if(name!=undefined && val.length) rdata[name]= val;
            });
            if(opts.sort!==false){
                rdata["sort"]={};
                var srt =opts.sort.split(/\,/g);
                for(var i in srt){
                    var a = srt[i].split(/\s/g);
                    rdata["sort"][a[0]]=a[1];
                }
            }
            rdata = $.extend(opts.data,rdata);
            $.ajax({
                url:opts.action,
                type:cf._type,
                data:rdata,
                success:function(d,x,s){
                    cf._requests[opts.action]=d;
                    try{
                        if(opts.container.prop('tagName')=='SELECT'){
                            var title = (opts.container.attr('data-title')!=undefined)?opts.container.attr('data-title'):'Lists';
                            opts.container.html('');
                            opts.container.append('<option value="false">'+title+'</option>');
                            for(var i in (d.data!=undefined)?d.data:d){
                                var row = (d.data!=undefined)?d.data[i]:d[i];
                                var name=(row.title)?row.title:((row.name)?row.name:''),
                                    value = (row.id==undefined)?name:row.id;
                                name = (row.surname)?name+' '+row.surname:'';
                                // console.debug(title,name,value);
                                opts.container.append('<option value="'+value+'">'+name+'</option>');
                            }
                            cf._statdata[opts.container.attr("data-name")] = d;
                        }
                        else window[opts.func](opts.container,d,x,s);
                    }
                    catch(e){console.error(opts,e);}
                }
            });
        };
        if(this.opts.autostart){
            this.execute(this.opts);
        }
        if(parseInt(this.opts.refresh)>0){
            var execute_func =this.execute, bnd = {
                run:execute_func,
                refresh:parseInt(this.opts.refresh),
                arguments:this.opts
            };
            // console.debug("loader refresh:", _frshr[0],bnd);
            _frshr[0].bind(bnd);
            // setTimeout(this.execute,this.refresh,60000);
            // setInterval(this.execute,this.refresh,this.opts);
        }
        cf._loaders[this.opts.uid]= this;
        return this;
    },
    requester:function(){
        var $that = arguments.length?arguments[0]:$(this),
            trigger = $that.attr("data-trigger"),
            callfunc=function(){
                var act_uids = $(this).attr("data-target"),
                    name = $(this).attr("data-name"),
                    val = ($(this).attr('type')=="checkbox")?($(this).is(':checked')?1:0):(($(this).attr("data-value")!=undefined)?$(this).attr("data-value"):$(this).val());
                var act_uids = act_uids.split(/,/);
                for(var i in act_uids){
                    var act_uid = act_uids[i],
                        ld = cf._loaders[act_uid].opts.data;
                    console.debug(act_uid,name,val,ld);
                    if(val.length==0) delete ld[name]; else ld[name]=val;
                    cf._loaders[act_uid].execute();
                }

            };

        $that.on(trigger,callfunc);
        // console.debug(($that instanceof jQuery)?"jquery":"object",trigger);
    },
    submiter:function(){
        var container = arguments.length?$(arguments[0]):null,
            checkvals=function($t){
                return true;
            },getargs = function($c){
                var args = {};
                $c.find("input,select").each(function(){
                    var n,v;
                    n = $(this).attr("data-name");
                    v = $(this).val();
                    if($(this).attr('type')=='checkbox')v=$(this).is(':checked')?"1":'0';
                    // n = (n==undefined)?$(this).attr("name"):undefined;
                    if(n!=undefined && n.length)args[n]= v;
                });
                return args;
            },clickfn=function(){
                if(!checkvals(container))return;
                var action = container.attr("data-action"), args = getargs(container),callback = container.attr("data-callback"),error = container.attr("data-callback-error");
                console.debug(action,args,callback);
                $.ajax({
                    url:action,
                    data:args,
                    type:cf._type,
                    success:function(d){
                        if(window[callback]!=undefined)window[callback](d);
                        else console.debug(d);
                    },
                    error:function(x,s){
                        if(window[error]!=undefined)window[error](x.responseJSON);
                        else console.error(x);
                    }
                });
            };

        if(container.attr("data-autostart")=="true")clickfn();
        else container.find('.submit').on('click',clickfn);
        container.find('.cancel').on('click',function(){});

        return false;
    },
    action:function(){
        var arg = arguments.length?arguments[0]:false;
        if(arg==false)return;
        arg = (typeof(arg)=="string")?JSON.parse(arg):arg;
        console.debug(arg);return;
        $.ajax(arg);
    },
    batcher:function(that){
        var container = (that instanceof jQuery)?that:$(that),
            action = container.attr("data-action"),
            param = container.attr('data-list'),
            callback = container.attr("data-callback"),
            target =container.attr("data-target");
        $('[data-name='+param+']').each(function(){
            if(!$(this).is(':checked'))return;
            var that = this,
                replacer = function(m,p,o,s){
                    if(p=="data-id") return $(that).attr("data-id");
                    else{
                        return $('[data-name='+p+']').val();
                    }
                },
                act = action.replace(/\{([^\}]+)\}/g,replacer);
            $.ajax({
                url:act,
                type:cf._type,
                success:function(d){
                    if(window[callback]!=undefined)window[callback](d);
                    else {
                        console.debug(d);
                        if(target && cf._loaders[target])cf._loaders[target].execute();
                    }
                },
                error:function(x,s){console.error(x)}
            });
        });
    },
    sorter:function(that){
        var container = (that instanceof jQuery)?that:$(that),
            callback = container.attr("data-callback"),
            dataName = container.attr("data-name"),
            target =container.attr("data-target");
        container.find('span').on('click',function(){
            var dataValue = container.attr("data-value")
            container.attr("data-value",(dataValue=='asc')?'desc':'asc');
            if(target && cf._loaders[target]){
                cf._loaders[target].opts.data.sort = (cf._loaders[target].opts.data.sort)?cf._loaders[target].opts.data.sort:{};
                cf._loaders[target].opts.data.sort[dataName] = dataValue;
                cf._loaders[target].execute();
            }
            $('.sorter span').show();
            container.find('span:eq('+((dataValue=='asc')?'0':'1')+')').show();
            container.find('span:eq('+((dataValue=='asc')?'1':'0')+')').hide();
        });
    }
};

$(document).ready(function(){
    window.Fresher = new cf.refresher();
    cf.reload();
    for(var i in window.onloads){
        window.onloads[i]();
    }

    // window.MainChart = new Chart(document.getElementById('main'), {
    //     xhrInstrumentId: id,     // query type currency number
    //     xhrPeriodFull: 1440,    // data max period
    //     dataNum: 60,          // default zoom number of dataset in 1 screen
    //     xhrMaxInterval: 45000,  // renewal full data interval
    //     xhrMinInterval: 1000,    // ticks - min interval to update and redraw last close data
    //     btnVolume: true,       // bottom volume graph default state
    //     colorCandleBodyUp: "#f59" // example to change positive candle body
    // });
});

// Fresher.bind({
//     run:function(){
//         // console.debug("Binded func console");
//     }
// });
