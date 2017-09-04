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
        this.opts = {};
        this.container = arguments.length?arguments[0]:null;
        this.opts = $.extend(this.opts,((arguments.length>1)?arguments[1]:{}));
        if(this.container == null) return;
        this.container = $(this.container);
        var func = this.container.attr("data-function");
        $.ajax({
            url:this.container.attr("data-action"),
            type:cf._type,
            complete:function(d,x,s){
                try{
                    window[func](this.container,d,x,s);
                }
                catch(e){
                    console.error(e);
                }

            }
        });
        return this;
    }
};
$(document).ready(function(){
    var Fresher = new cf.refresher();
    $(".loader").each(function(){
        new cf.loader(this);
    });
});

// Fresher.bind({
//     run:function(){
//         // console.debug("Binded func console");
//     }
// });
