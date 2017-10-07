<div class="bgc"></div>

<!--

<div class="popup popup_b user">
  <div class="close"></div>
  <div class="contenta flex">
    <strong>Users</strong>
    <table>
        <thead>
            <tr>
                <td>ID <div class="arrow"><span></span><span></span></div></td>
                <td>Registred <div class="arrow"><span></span><span></span></div></td>
                <td>Email <div class="arrow"><span></span><span></span></div></td>
                <td>Name <div class="arrow"><span></span><span></span></div></td>
                <td>Phone <div class="arrow"><span></span><span></span></div></td>
                <td>Country <div class="arrow"><span></span><span></span></div></td>
                <td>Balance 1 <div class="arrow"><span></span><span></span></div></td>
                <td>Balance 2 <div class="arrow"><span></span><span></span></div></td>
                <td>Rights <div class="arrow"><span></span><span></span></div></td>
                <td>Users <div class="arrow"><span></span><span></span></div></td>
                <td>Admin <div class="arrow"><span></span><span></span></div></td>
                <td>Last Online <div class="arrow"><span></span><span></span></div></td>
                <td></td>
                <td>IP</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="user_list" data-name="user-list" class="loader" data-action="/json/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
    </table>
  </div>
</div> -->

<div class="popup popup_m edit_user" data-callback="crmUserCallback">
    <span>@lang('messages.user_edit')</span>
    <div class="close"></div>
    <form action="#">
        <div class="item">
            <input type="text" name="name" data-name="name" placeholder="Name">
            <input type="email" name="email" data-name="email" placeholder="Nameaddress@servername.com">
            <input type="text" name="country" data-name="country" placeholder="Country">
            <!-- <input type="text" name="money" data-name="money" placeholder="$23 758.56"> -->
            <select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/json/user/rights" data-autostart="true"></select>
        </div>
        <div class="item">
            <input type="text" name="surname" data-name="surname" placeholder="Surname">
            <input type="tel" name="phone" data-name="phone" placeholder="Phone number">
            <input type="password" name="password" data-name="password" placeholder="password">
            <!-- <input type="text" name="country" data-name="country" placeholder="Country"> -->
            <!-- <select name="name_sur" data-name="name_sur" id="name_sur" placeholder="Name Surname">
                <option value="non-select" disabled="" selected="">User rightscountry</option>
                <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                <option value="Samuel L. Jacson">Samuel L. Jacson</option>
                <option value="George Washington">George Washington</option>
                <option value="Peris Hilton">Peris Hilton</option>
                <option value="Megan Fox">Megan Fox</option>
            </select> -->
        </div>
    </form>
    <!-- <a href="#" class="his">Megan Fox</a> -->
    <div class="button">
        <a href="#" class="cancel">Close</a>
        <!-- <a href="#" class="edit submit">Edit User</a> -->
        <a href="#" class="edit submit">@lang('messages.save')</a>
    </div>
</div>

<div class="popup popup_b user_dashboard">
    <div class="close"></div>
    <strong>@lang('messages.user_dashboard')</strong>
    <div class="contenta flex info">
        <div class="item">
            <div class="inner">
                <div class="wrap">
                    <div class="left user-basic-info submitter" data-action="/json/user/update" data-callback="">
                        <!-- <a href="#" class="edit">Edit data user</a> -->
                        <ul class="">
                            <li>First name: <span class="user-name"></span></li>
                            <li>Last name: <span class="user-surname"></span></li>
                            <li>Created: <span class="user-created"></span></li>
                            <li>E-mail: <span class="user-email"></span></li>
                            <!-- <li>Password: <span class="user-password"></span></li> -->
                            <li>Phone number: <span class="user-phone"></span></li>
                            <li>Country: <span class="user-country"></span></li>
                            <li>Kurs: <span class="user-kurs"></span></li>
                            <li>Status: <span class="user-status"></span></li>
                            <!-- <li>Rights: <span class="user-rights_id"><select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/json/user/rights" data-autostart="true"></select></span></li> -->
                            <!-- <li>Source: <span class="user-name"></span></li>
                            <li>Source Description: <span class="user-name"></span></li> -->
                        </ul>
                        <a href="javascript:0;" class="submit">@lang('messages.save')</a>
                        <a href="javascript:0;" class="submit">Edit</a>
                    </div>
                    <!-- <div class="right">
                        <ul>
                            <li>BTC/LTC - REAL</li>
                            <li>BTh/LsC -  + 15%</li>
                            <li>BTs/LTC - 5%</li>
                            <li>BTC/LTC - REAL</li>
                        </ul>
                    </div> -->
                </div>
                <!-- <div id="user_chart" class="chart"></div>
                <div class="user-chart-tuner">
                    <span id="user_chart_tune">5%</span>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.up()">Up</a>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.real()">Real</a>&nbsp;
                    <a id="user_chart_up" href="#" onclick="crm.user.tune.down()">Down</a>
                </div> -->
            </div>
            <div class="inner">
          <!-- <script type="text/javascript" charset="utf-8">
            function
          </script> -->
                <div id="scheduler_here" class="dhx_cal_container">
                    <div class="dhx_cal_navline">
                        <div class="dhx_cal_prev_button">&nbsp;</div>
                        <div class="dhx_cal_next_button">&nbsp;</div>
                        <div class="dhx_cal_today_button"></div>
                        <div class="dhx_cal_date"></div>
                        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
                        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
                        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
                    </div>
                    <div class="dhx_cal_header"></div>
                    <div class="dhx_cal_data"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="inner">
                <div class="tabs_in">
                    <ul class="tabs_in_dashbord">
                        <li>Comments</li>
                        <li>Logs</li>
                        <li>Finance</li>
                        <li>Open trad</li>
                        <li>Verifications</li>
                    </ul>
                    <div class="tabs_in_dash comments">
                        <div class="item_con">
                            <strong>Tasks Panel</strong>
                            <a href="#" class="add">Add Task</a>
                            <p class="task">Task need to do</p>
                            <div class="popup task_popup">
                                <textarea name="task" id="task"></textarea>
                            </div>
                        </div>
                        <div class="item_con">
                            <strong>Comments</strong>
                            <p class="coment">No Comments</p>
                            <textarea name="coment" id="coment" placeholder="Enter comment text"></textarea>
                            <div class="item_abs">
                                <a href="#">Add Comment</a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs_in_dash logs">
                    </div>
                    <div class="tabs_in_dash finance">
                        <div class="item_con">
                            <strong>Tasks Panel</strong>
                            <a href="#" class="add">Add Task</a>
                            <p class="task">Task need to do</p>
                            <div class="popup task_popup">
                                <textarea name="task" id="task"></textarea>
                            </div>
                        </div>
                        <div class="item_con">
                            <strong>Comments</strong>
                            <p class="coment">No Comments</p>
                            <textarea name="coment" id="coment" placeholder="Enter comment text"></textarea>
                            <div class="item_abs">
                                <a href="#">Add Comment</a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs_in_dash opentrades">
                        <table>
                            <thead>
                                <tr>
                                    <td>ID <div class="arrow"><span></span><span></span></div></td>
                                    <td>Registred <div class="arrow"><span></span><span></span></div></td>
                                    <td>Updated <div class="arrow"><span></span><span></span></div></td>
                                    <td>User<div class="arrow"><span></span><span></span></div></td>
                                    <td>Manager<div class="arrow"><span></span><span></span></div></td>
                                    <td>Instrument <div class="arrow"><span></span><span></span></div></td>
                                    <td>Status <div class="arrow"><span></span><span></span></div></td>
                                    <td>Amount <div class="arrow"><span></span><span></span></div></td>
                                    <td>Multiplier <div class="arrow"><span></span><span></span></div></td>
                                    <td>Direction <div class="arrow"><span></span><span></span></div></td>
                                    <td>Profit <div class="arrow"><span></span><span></span></div></td>
                                    <td>Stops <div class="arrow"><span></span><span></span></div></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody class="loader" id="user_deals" data-name="user-deals" data-action="/json/deal?status=open" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup popup_b deals">
  <!-- <script>
      window.onloads.push(function(){
          window.crm = $.extend(((window.crm!=undefined)?window.crm:{}),{
              deal:{
                  current:undefined,
                  list:function (container,d,x,s){
                      container.html('');
                      for(var i in d){
                          var s = '<tr data-class="deal" data-id="'+d[i].id+'">',row=d[i];
                          s+='<td>'+row.id+'</td>';
                          s+='<td>'+new Date(row.created_at*1000)+'</td>';
                          s+='<td>'+new Date(row.updated_at*1000)+'</td>';
                          s+='<td><a href="#" data-class="user" data-id="'+row.user.id+'">'+row.user.name+' '+row.user.surname+'</a></td>';
                          s+=(row.manager)?'<td><a href="#" data-class="manager" data-id="'+row.manager.id+'">'+row.manager.name+' '+row.manager.surname+'</a></td>':'<td></td>';
                          s+='<td><a href="#" data-class="instrument" data-id="'+row.instrument_id+'">'+row.instrument.from_currency.code+'/'+row.instrument.to_currency.code+'</a></td>';
                          s+='<td>'+row.status.name+'</td>';
                          s+='<td>'+currency.value(row.amount,row.currency.code)+'</td>';
                          s+='<td>x'+row.multiplier+'</td>';
                          s+='<td>'+((row.direction==-1)?'<i class="fa fa-arrow-down"></i>':'<i class="fa fa-arrow-up"></i>')+'</td>';
                          s+='<td>'+currency.value(row.profit,row.currency.code)+'</td>';
                          s+='<td>'+row.stop_low+' - '+row.stop_high+'</td>';

                          // s+='<td><a href="#" onclick="crm.deal.edit('+row.id+')" id="edit_deal">@lang('messages.edit')</a><a href="#" onclick="crm.deal.info('+row.id+')" class="edit">@lang('messages.info')</a></td>';
                          s+='<td><a href="#" onclick="crm.deal.info('+row.id+')" class="edit">@lang('messages.info')</a></td>';
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
                  info:function(id){
                      this.current = id;
                      $.ajax({
                          url:"/json/deal/"+id,
                          dataType:"json",
                          success:function(d,x,s){
                              var deal = d[0],$bb = $('[data-rel=deal_dashboard]'),showDealDetail=function(i,data,ns){
                                  if(typeof(data[i])!="string")return '';
                                  if(i.match(/_id$/))return '';
                                  if(ns!=undefined)ns='deal';
                                  ns+='-';
                                  var val = data[i],name = i;
                                  switch(i){
                                      case "created_at":
                                          name = '@lang("messages.created_at")';
                                      case "updated_at":
                                          name = '@lang("messages.updated_at")';
                                          val = new Date(val*1000);
                                          break;
                                  }
                                  return '<li>'+i+'<span class="data-detail '+ns+i+'">'+val+'</span></li>'
                              },chart;
                              // $('.edit_user').attr('data-action','/user/'+id+'/edit');
                              graphControl.makeChart(60,"deal_chart",deal.user.id,chart);
                              $bb.find('.deal-data').html('');
                              for(var i in deal)
                                  $bb.find('.deal-data').append(showDealDetail(i,deal));

                              $bb.find('.user-data').html('');
                              $bb.find('.user-info-link').attr('onclick','crm.user.info('+deal.user.id+')');
                              for(var i in deal.user)
                                  $bb.find('.user-data').append(showDealDetail(i,deal.user,'user'));
                              if(deal.manager)$bb.find('.user-data').append(showDealDetail('name',deal.manager,'user'));

                              $bb.fadeIn((window.animationTime!=undefined)?window.animationTime:256);
                              // cf.submiter($('.edit_user'));
                          }
                      });
                  }
              }
          });
          window.crmDealList = crm.deal.list;
          window.crmDealCallback = function(d){
              // $('.popup,.bgc').fadeOut((window.animationTime!=undefined)?window.animationTime:256);
              document.location.reload();
          }
      });
  </script> -->
  <div class="close"></div>
  <div class="contenta flex">
    <strong>Some title</strong>
    <div class="search">
      <form action="#">
          <input type="search" placeholder="Search">
          <button type="submit"></button>
          <a href="#" class="filter">Show filter</a>
          <p><input type="checkbox" name="online" data-name="online" value="online"> Online Only</p>
          <a href="#" class="new">Add user</a>
          <div class="filter_users">
              <select name="users" id="uers">
                  <option value="" disabled>change</option>
                  <option value="Hung up">Hung up</option>
                  <option value="New client">New client</option>
                  <option value="No answer 1">No answer 1</option>
                  <option value="No answer 2">No answer 2</option>
                  <option value="No answer 3">No answer 3</option>
                  <option value="Callback">Callback</option>
                  <option value="Not interested">Not interested</option>
                  <option value="Callback/No answer">Callback/No answer</option>
                  <option value="Wrong number">Wrong number</option>
                  <option value="Unreachable">Unreachable</option>
                  <option value="Registered">Registered</option>
                  <option value="Deposited">Deposited</option>
              </select>
          </div>
          <div class="popup popup_filter">
              <input type="radio" name="radio" data-name="radio" value="Admin"> Admin<br>
              <input type="radio" name="radio" data-name="radio" value="Manager"> Manager<br>
              <input type="radio" name="radio" data-name="radio" value="Client"> Client<br>
              <input type="radio" name="radio" data-name="radio" value="Affiliate"> Affiliate<br>
              <input type="radio" name="radio" data-name="radio" value="Super_Admin"> Super Admin<br>
              <input type="radio" name="radio" data-name="radio" value="Fired"> Fired
          </div>
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
              <td>Manager<div class="arrow"><span></span><span></span></div></td>
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
      <tbody class="loader" data-action="/json/deal?status=all" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
  </table>
  </div>
</div>

<div class="popup popup_s new_user">
    <strong>New Users</strong>
    <div class="close"></div>
    <div class="search">
      <div class="form">
          <form action="#">
              <select name="affiliate" id="affiliate">
                  <option value="Select Affiliate">Select Affiliate</option>
                  <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                  <option value="Jessica Alba">Jessica Alba</option>
                  <option value="Christopher Lambert">Christopher Lambert</option>
                  <option value="Jonny Dep">Jonny Dep</option>
              </select>
              <select name="source" id="source">
                  <option value="Select Source">Select Source</option>
                  <option value="Diamonds-marketing.com">Diamonds-marketing.com</option>
              </select>
              <select name="country" id="country">
                  <option value="Select Country">Select Country</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
              </select>
              <select name="admin" id="admin">
                  <option value="Select Admin">Select Admin</option>
                  <option value="Collins Fred">Collins Fred</option>
                  <option value="James Bond">James Bond</option>
                  <option value="Ashley Cooper">Ashley Cooper</option>
                  <option value="New guy">New guy</option>
              </select>
              <input type="submit" value="Change admin">
          </form>
        </div>
    </div>
    <div class="table">
      <span>Total: 4</span>
      <table>
          <thead>
              <tr>
                  <td></td>
                  <td>ID</td>
                  <td>Registration</td>
                  <td>Mail</td>
                  <td>Name</td>
                  <td>Phone</td>
                  <td>Country</td>
                  <td>Balance</td>
                  <td>IP</td>
                  <td>Source</td>
                  <td>Affiliate</td>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>161</td>
                  <td>2017-05-11 17:58:55</td>
                  <td>focinabup@alienware13.com</td>
                  <td>My Diamonds</td>
                  <td>+0000000000</td>
                  <td>Argentina</td>
                  <td>$37 512.27</td>
                  <td>37.142.168.151</td>
                  <td>diamonds-marketing.com</td>
                  <td>
                      <a href="#" id="edit_user">Edit</a>
                      <a href="#" class="edit" onclick="crm.user.info(1)">Info</a>
                  </td>
              </tr>
          </tbody>
      </table>
    </div>
    <div class="pagination"><ul><li class="first active"><a href="#">First page</a></li><li class="prev"><a href="#">...</a></li><li><a href="#">1</a></li><li><a href="#">2</a></li><li class="next"><a href="#">...</a></li><li class="last"><a href="#">Last page</a></li></ul><div class="total_item"><span>12</span>/<span>18</span></div></div>
</div>

<div class="popup popup_b instruments">
    <!-- <div class="search"> -->
        <!-- <form action="#"> -->
            <!-- <input type="search" placeholder="Search"> -->
            <!-- <button type="submit"></button> -->
            <!-- <a href="#" class="filter">Show filter</a> -->
            <!-- <p><input type="checkbox" name="online" data-name="online" value="online"> Active Only</p> -->
            <!-- <a href="#" class="new">Add user</a> -->
            <!-- <div class="popup popup_filter">
                <input type="radio" name="radio" data-name="radio" value="Admin"> Admin<br>
                <input type="radio" name="radio" data-name="radio" value="Manager"> Manager<br>
                <input type="radio" name="radio" data-name="radio" value="Client"> Client<br>
                <input type="radio" name="radio" data-name="radio" value="Affiliate"> Affiliate<br>
                <input type="radio" name="radio" data-name="radio" value="Super_Admin"> Super Admin<br>
                <input type="radio" name="radio" data-name="radio" value="Fired"> Fired
            </div> -->
        <!-- </form> -->
    <!-- </div> -->
    <strong>@lang('messages.instruments')</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>

                <td>ID <div class="arrow"><span></span><span></span></div></td>
                <td>Enabled <div class="arrow"><span></span><span></span></div></td>

                <td>Title <div class="arrow"><span></span><span></span></div></td>

                <td>Volate <div class="arrow"><span></span><span></span></div></td>
                <td>Price<div class="arrow"><span></span><span></span></div></td>
                <td>From currency <div class="arrow"><span></span><span></span></div></td>
                <td>To Currency <div class="arrow"><span></span><span></span></div></td>

                <td>Commission <div class="arrow"><span></span><span></span></div></td>

                <td></td>
            </tr>
        </thead>
        <tbody class="loader" data-action="/json/instrument" data-function="crmInstrumentList" data-autostart="true" data-trigger=""></tbody>
    </table>
</div>

<div class="popup popup_m selector">
  <div class="close"></div>
  <div class="search">
      <form action="#">
          <input type="search" placeholder="Search" class="requester" data-name="search" data-trigger="keyup" data-target="user-list"><button type="submit"></button>
          <!-- <a href="#" class="filter">Show filter</a> -->
          <p><input type="checkbox" name="online" data-name="online" class="requester" data-trigger="change" data-target="user-list" value="online">messages.online_users</p>
          <!-- <div class="batcher">
          </div> -->
          <div class="filter_users">
              <select class="loader" data-name="manager_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="1">Vladimir</option><option value="5">testoviy</option><option value="7">alex2</option></select>
              <a href="javascript:0;" class="button batcher" data-list="user_selected" data-action="/json/user/{data-id}/update?manager_id={manager_id}" data-target="user-list" onclick="cf.batcher(this);">message.add_manager</a>
          </div>

          <div class="filter_users">
              <select class="loader requester" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="10">Hung up</option><option value="20">New client</option><option value="30">No answer 1</option><option value="40">No answer 2</option><option value="50">No answer 3</option><option value="60">Callback</option><option value="70">Not interested</option><option value="80">Callback/No answer</option><option value="90">Wrong number</option><option value="100">Unreachable</option><option value="200">Registered</option><option value="300">Deposited</option></select>
          </div>
          <div class="filter_users">
              <select class="loader requester" data-name="rights_id" data-action="/json/user/rights" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="0">Бан</option><option value="1">Клиент</option><option value="2">Афилиат</option><option value="5">Менеджер</option><option value="7">Администратор</option><option value="20">System</option></select>
          </div>
          <div class="filter_users">
              <select class="loader requester" data-name="country" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="Russia">Russia</option><option value="-">-</option><option value="-">-</option></select>
          </div>

          <div class="filter_users">
              <select class=" requester" data-name="source" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
          </div>
      </form>
  </div>
  <div class="contenta">
    <strong>Some title</strong>
    <div class="table"></div>
    <div class="pagination"><ul><li class="first active"><a href="#">First page</a></li><li class="prev"><a href="#">...</a></li><li><a href="#">1</a></li><li><a href="#">2</a></li><li class="next"><a href="#">...</a></li><li class="last"><a href="#">Last page</a></li></ul><div class="total_item"><span>12</span>/<span>18</span></div></div>
  </div>
</div>
<div class="popup popup_s selector">
  <div class="close"></div>
  <div class="search">
      <form action="#">
          <input type="search" placeholder="Search" class="requester" data-name="search" data-trigger="keyup" data-target="user-list"><button type="submit"></button>
          <!-- <a href="#" class="filter">Show filter</a> -->
          <p><input type="checkbox" name="online" data-name="online" class="requester" data-trigger="change" data-target="user-list" value="online">messages.online_users</p>
          <!-- <div class="batcher">
          </div> -->
          <div class="filter_users">
              <select class="loader" data-name="manager_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="1">Vladimir</option><option value="5">testoviy</option><option value="7">alex2</option></select>
              <a href="javascript:0;" class="button batcher" data-list="user_selected" data-action="/json/user/{data-id}/update?manager_id={manager_id}" data-target="user-list" onclick="cf.batcher(this);">message.add_manager</a>
          </div>

          <div class="filter_users">
              <select class="loader requester" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="10">Hung up</option><option value="20">New client</option><option value="30">No answer 1</option><option value="40">No answer 2</option><option value="50">No answer 3</option><option value="60">Callback</option><option value="70">Not interested</option><option value="80">Callback/No answer</option><option value="90">Wrong number</option><option value="100">Unreachable</option><option value="200">Registered</option><option value="300">Deposited</option></select>
          </div>
          <div class="filter_users">
              <select class="loader requester" data-name="rights_id" data-action="/json/user/rights" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="0">Бан</option><option value="1">Клиент</option><option value="2">Афилиат</option><option value="5">Менеджер</option><option value="7">Администратор</option><option value="20">System</option></select>
          </div>
          <div class="filter_users">
              <select class="loader requester" data-name="country" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"><option value="false">All</option><option value="Russia">Russia</option><option value="-">-</option><option value="-">-</option></select>
          </div>

          <div class="filter_users">
              <select class=" requester" data-name="source" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
          </div>
      </form>
  </div>
  <div class="contenta">
    <strong>Some title</strong>
    <div class="table"></div>
    <div class="pagination"><ul><li class="first active"><a href="#">First page</a></li><li class="prev"><a href="#">...</a></li><li><a href="#">1</a></li><li><a href="#">2</a></li><li class="next"><a href="#">...</a></li><li class="last"><a href="#">Last page</a></li></ul><div class="total_item"><span>12</span>/<span>18</span></div></div>
  </div>
</div>
