var $cd = {
    item:{
        add:function(){
            var o=arguments.length?arguments[0]:null;
            if(o == null){console.error('incorrect usage of item.add - need item uid provided'); return;}
            $.ajax({
                url:"/data/"+o+'/info',
                dataType:"json",
                success:function(d,s,x){
                    console.info(d,s,x);
                    var $c = $('<div class="item"></div>').appendTo(".content");
                    $c.append('<strong>'+d.title+'</strong>');
                    var $l = $('<ul></ul>').appendTo($c);
                    for(var i in d.items){
                        var li = '<li>',item = d.items[i];
                        li+= '<p><a href="#" id="'+i+'">'+item.name+'</a></p>';
                        li+= '<p class="num">'+item.num+'</p>';
                        li+= '<p class="last_num">'+item.num+'</p>';
                        li+= '</li>';
                        $l.append(li);
                    }
                }
            });
        }
    }
};
//
// <div class="item">
//     <strong>{{title}}</strong>
//     <ul>
//         @foreach($items as $item)
//             <li>
//                 <p><a href="#" id="{{$item->uid}}">{{$item->name}}</a></p>
//                 <p class="num">{{$item->num}}</p>
//                 <p class="last_num">{{$item->num}}<</p>
//             </li>
//         @endforeach
//     </ul>
// </div>
$(document).ready(function(){

});
