"use strict";
function cfDataLoader(){

}
var cf={
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
                    cf._actions[i].run();
                    cf._actions[i].last = dt;
                }

            }
        };
        setInterval(this.execute,1000);
        console.debug("refresher constructor called");
    },
    loader:function(){
        var container=arguments.length?$(arguments[0]):null;
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
            refresh:container.attr("data-refresh")
        };
        this.opts = $.extend(this.opts,this.attrs);
        this.opts = $.extend(this.opts,((arguments.length>1)?arguments[1]:{}));
        this.execute = function(opts){
            $.ajax({
                url:opts.action,
                type:cf._type,
                success:function(d,x,s){
                    try{
                        window[opts.func](opts.container,d,x,s);
                    }
                    catch(e){console.error(e);}
                }
            });
        };
        console.debug(this.opts);
        if(this.opts.autostart)this.execute(this.opts);
        if(this.opts.refresh>0){
            setTimeout(this.execute,this.refresh,this.opts);
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
                    if(n!=undefined && n.length)args[n]= $(this).val();
                });
                return args;
            };
        if(container == null) return;
        container = $(container);

        container.find('.submit').on('click',function(){
            var container =$(this).closest('.submiter');
            if(!checkvals(container))return;
            console.debug(container);
            var action = container.attr("data-action"), args = getargs(container);
            // console.debug(args);return;
            $.ajax({
                url:action,
                data:args,
                type:cf._type,
                success:function(d){console.debug(d)},
                error:function(x,s){console.debug(x)}
            });
        });
        container.find('.cancel').on('click',function(){});
        return false;
    }

};
$(document).ready(function(){
    var Fresher = new cf.refresher();
    $(".loader").each(function(){
        new cf.loader(this);
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
