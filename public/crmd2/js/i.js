var c = {
    monthName:['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    minuter:function(){
        var d = new Date(),
            date = c.monthName[d.getMonth()]+' '+("0" + d.getDate()).slice(-2)+', '+d.getFullYear(),
            time = ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);
        console.debug(date,time);
        $(".header__date .date").text(date);
        $(".header__date .time").text(time);
        // setTimeout(c.minuter,10000);
    }
};
$(document).ready(function(){
    c.minuter();
    $(".popup-trigger").on("click",function(e){
        e.preventDefault();
        e.stopPropagation();
        var tid = $(this).attr("id");
        $('.popup,.bgc').fadeOut(700);
		$('.'+tid+',.bgc').fadeIn(700);
    });
    // $(".item.notenabled").css('pointer-events','none').append('<div style="background-color:rgba(30,42,54,.8);position:absolute;top:0;left:0;width:100%;height:100%;z-index:10;"></div>');

});
