"use strict";
function cfDataLoader(){

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
    _actions:[],
    _type:"get",
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
            if(cf._actions.length==0)return;
            var dt = new Date().getTime();
            for(var i in cf._actions){
                if((dt-cf._actions[i].last)>cf._actions[i].refresh*1000){
                    var args = (cf._actions[i].arguments == undefined)?null:cf._actions[i].arguments;
                    cf._actions[i].run(args);
                    cf._actions[i].last = dt;
                }

            }
        };
        setInterval(this.execute,1000);
        console.debug("refresher constructor called");
    },
    pagination:function(d){
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
        var fresher = arguments.length?$(arguments[1]):new Fresher;
        this.opts = {
            container:container,
            autostart: false,
            refresh:0
        };
        if(container == null) return;
        this.attrs = {
            func:container.attr("data-function"),
            autostart:(container.attr("data-autostart")=="true"),
            action:container.attr("data-action"),
            refresh:(container.attr("data-refresh")!=undefined)?container.attr("data-refresh"):0

        };
        this.opts = $.extend(this.opts,this.attrs);
        this.opts = $.extend(this.opts,((arguments.length>1)?arguments[1]:{}));
        this.execute = function(opts){
            $.ajax({
                url:opts.action,
                type:cf._type,
                success:function(d,x,s){
                    try{
                        if(opts.container.prop('tagName')=='SELECT'){
                            for(var i in d){
                                var id = (d[i].id!=undefined)?d[i].id:'',name=(d[i].title)?d[i].title:((d[i].name)?d[i].name:'');
                                opts.container.append('<option value="'+id+'">'+name+'</option>');
                            }
                            cf._statdata[opts.container.attr("data-name")] = d;
                        }
                        else window[opts.func](opts.container,d,x,s);
                    }
                    catch(e){console.error(e);}
                }
            });
        };
        // console.debug(this.opts);
        if(this.opts.autostart)this.execute(this.opts);
        if(parseInt(this.opts.refresh)>0){
            fresher.bind({
                run:this.execute,
                arguments:this.opts
            });
            // setTimeout(this.execute,this.refresh,60000);
            // setInterval(this.execute,this.refresh,this.opts);
        }
        return this;
    },
    submiter:function(){
        var container = arguments.length?arguments[0]:null,
            checkvals=function($t){
                return true;
            },getargs = function($c){
                var args = {};
                $c.find("input,select").each(function(){
                    var n,v;
                    n = $(this).attr("data-name");
                    // n = (n==undefined)?$(this).attr("name"):undefined;
                    if(n!=undefined && n.length)args[n]= $(this).val();
                });
                return args;
            };
        if(container == null) return;
        container = $(container);

        container.find('.submit').on('click',function(){
            var container =$(this).closest('.submiter');
            if(!checkvals(container))return;
            // console.debug(container);
            var action = container.attr("data-action"), args = getargs(container),callback = container.attr("data-callback");
            console.debug(args);
            $.ajax({
                url:action,
                data:args,
                type:cf._type,
                success:function(d){
                    if(window[callback]!=undefined)window[callback](d);
                    else console.debug(d);
                },
                error:function(x,s){console.error(x)}
            });
        });
        container.find('.cancel').on('click',function(){});
        return false;
    }

};
$(document).ready(function(){
    for(var i in window.onloads){
        window.onloads[i]();
    }
    var Fresher = new cf.refresher();
    $(".loader").each(function(){
        new cf.loader(this,Fresher);
    });
    $(".submiter").each(function(){
        cf.submiter(this);
    });
});

// Fresher.bind({
//     run:function(){
//         // console.debug("Binded func console");
//     }
// });
