<div class="bgc"></div>
<div class="popup user">
    <div class="search">
        <form action="#">
            <input type="search" placeholder="Search">
            <button type="submit"></button>
            <!-- <a href="#" class="filter">Show filter</a> -->
            <p><input type="checkbox" name="online" data-name="online" value="online"> Online Only</p>
            <a href="#" class="new">Add user</a>
            <div class="filter_users">
                <select name="status_id" class="loader" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-form="#user_list">
                    <!-- <option value="" disabled>change</option>
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
                    <option value="Deposited">Deposited</option> -->
                </select>
            </div>
            <div class="filter_users">
                <select class="loader" data-name="rights_id" data-action="/json/user/rights" data-autostart="true" data-trigger="change" data-form="#user_list"></select>
            </div>
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
    <strong>Users</strong>
    <div class="close"></div>
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
                <td>IP</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="user_list" data-name="user-list" class="loader" data-action="/json/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
        <!-- <tbody class="loader" data-action="/user" data-func="crmUserList" data-autostart="true" data-trigger="">
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->name}} {{$user->surname}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->country or 'unknown'}}</td>

                <td>{{$user->account->demo->amount or '-'}}</td>
                <td>{{$user->account->real->amount or '-'}}</td>
                <td>{{$user->rights_id}}</td>

                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>

                <td><a href="#" id="edit_user">Edit</a><a href="#" class="edit">Info</a></td>
            </tr>
            @endforeach

        </tbody> -->
    </table>
</div>

<div class="popup new_user">
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
    <div class="pagination">
      <ul>
          <li class="first">
              <a href="#">First page</a>
          </li>
          <li class="prev">
              <a href="#">...</a>
          </li>
          <li>
              <a href="#">3</a>
          </li>
          <li>
              <a href="#">4</a>
          </li>
          <li class="active">
              <a href="#">5</a>
          </li>
          <li>
              <a href="#">6</a>
          </li>
          <li>
              <a href="#">7</a>
          </li>
          <li class="next">
              <a href="#">...</a>
          </li>
          <li class="last">
              <a href="#">Last page</a>
          </li>
      </ul>
      <div class="total_item">
          <span>5</span>/<span>57</span>
      </div>
    </div>
</div>

<div class="popup edit_user submiter" data-callback="crmUserCallback">
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
            <input type="text" name="country" data-name="country" placeholder="Country">
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
        <a href="#" class="close cancel">Close</a>
        <!-- <a href="#" class="edit submit">Edit User</a> -->
        <a href="#" class="edit submit">@lang('messages.save')</a>
    </div>
</div>

<div class="popup user_dashboard">
    <div class="close"></div>
    <div class="top">
        <div class="item user-chart" style="width:100%;position:relative; min-height:500px;margin-top:20px;">
            <span>@lang('messages.user_dashboard')</span>
            <div class="user-chart-tuner">
                <span id="user_chart_tune">5%</span>&nbsp;
                <a id="user_chart_up" href="#" onclick="crm.user.tune.up()">Up</a>&nbsp;
                <a id="user_chart_up" href="#" onclick="crm.user.tune.real()">Real</a>&nbsp;
                <a id="user_chart_up" href="#" onclick="crm.user.tune.down()">Down</a>
            </div>
            <div class="tabs_dash">
                <ul class="tabs_dashbord">
                    <li class="active">item 1</li>
                    <li>item 2</li>
                    <li>item 3</li>
                    <li>item 4</li>
                    <li>item 5</li>
                </ul>
                <div class="tabs_dash_con" style="display: block;">
                    <div id="user_chart" class="chart"></div>
                    <div class="item user-accounts">
                        <span>@lang('messages.user_accounts')</span>
                        <!-- <div class="item-bank"><a href="#"><span></span>79 901.89</a></div>
                        <div class="item-chart"><a href="#"><span></span>10 157.67</a></div> -->
                    </div>
                    <div class="bot">
                        <div class="item">
                            <div class="left">
                                <strong>@lang('messages.user_data')</strong>
                                <a href="#" class="edit">Edit data user</a>
                                <ul>
                                    <li>First name: <span class="user-name"></span></li>
                                    <li>Last name: <span class="user-surname"></span></li>
                                    <li>Created: <span class="user-created"></span></li>
                                    <li>E-mail: <span class="user-email"></span></li>
                                    <li>Phone number: <span class="user-phone"></span></li>
                                    <li>Country: <span class="user-country"></span></li>
                                    <!-- <li>Source: <span class="user-name"></span></li>
                                    <li>Source Description: <span class="user-name"></span></li> -->
                                </ul>
                                <a href="#" class="back">Back</a>
                            </div>
                            <!--

                             <div class="right">

                                <ul>
                                    <li>Fred</li>
                                    <li>Collins</li>
                                    <li>05-22-2017 15:27:17</li>
                                    <li>Fred.Collins@alfadiamonds.com</li>
                                    <li>+0000000000000</li>
                                    <li>Belgium</li>
                                    <li>Information</li>
                                    <li>More information</li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="item">
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
                        <div class="popup_tabs">
                            <ul>
                                <li>Leads</li>
                                <li>Users</li>
                                <li>History</li>
                                <li class="active">Send E-mail</li>
                                <li>Charts</li>
                                <li>Commissions</li>
                                <li>Diamonds in sell</li>
                                <li>My diamonds</li>
                            </ul>
                            <textarea name="popup_tabs" id="popup_tabs" placeholder="Enter your text or use templates"></textarea>
                        </div>
                        <div class="form_bot"></div>
                    </div>
                </div>
                <div class="tabs_dash_con">
                    <div id="user_chart" class="chart"></div>
                    <div class="item user-accounts">
                        <span>@lang('messages.user_accounts')</span>
                        <!-- <div class="item-bank"><a href="#"><span></span>79 901.89</a></div>
                        <div class="item-chart"><a href="#"><span></span>10 157.67</a></div> -->
                    </div>
                    <div class="bot">
                        <div class="item">
                            <div class="left">
                                <strong>@lang('messages.user_data')</strong>
                                <a href="#" class="edit">Edit data user</a>
                                <ul>
                                    <li>First name: <span class="user-name"></span></li>
                                    <li>Last name: <span class="user-surname"></span></li>
                                    <li>Created: <span class="user-created"></span></li>
                                    <li>E-mail: <span class="user-email"></span></li>
                                    <li>Phone number: <span class="user-phone"></span></li>
                                    <li>Country: <span class="user-country"></span></li>
                                    <!-- <li>Source: <span class="user-name"></span></li>
                                    <li>Source Description: <span class="user-name"></span></li> -->
                                </ul>
                                <a href="#" class="back">Back</a>
                            </div>
                            <!--

                             <div class="right">

                                <ul>
                                    <li>Fred</li>
                                    <li>Collins</li>
                                    <li>05-22-2017 15:27:17</li>
                                    <li>Fred.Collins@alfadiamonds.com</li>
                                    <li>+0000000000000</li>
                                    <li>Belgium</li>
                                    <li>Information</li>
                                    <li>More information</li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="item">
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
                        <div class="popup_tabs">
                            <ul>
                                <li>Leads</li>
                                <li>Users</li>
                                <li>History</li>
                                <li class="active">Send E-mail</li>
                                <li>Charts</li>
                                <li>Commissions</li>
                                <li>Diamonds in sell</li>
                                <li>My diamonds</li>
                            </ul>
                            <textarea name="popup_tabs" id="popup_tabs" placeholder="Enter your text or use templates"></textarea>
                        </div>
                        <div class="form_bot"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item user-accounts">
            <span>@lang('messages.user_accounts')</span>
            <!-- <div class="item-bank"><a href="#"><span></span>79 901.89</a></div>
            <div class="item-chart"><a href="#"><span></span>10 157.67</a></div> -->
        </div>
    </div>
</div>

<div class="popup deals">
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
                <td>&nbsp;</td>
                <td></td>
            </tr>
        </thead>
        <tbody class="loader" data-action="/json/deal?status=all" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
    </table>
</div>
<div class="popup color-1" data-rel="deal_dashboard">
    <strong>@lang('messages.deal_dashboard')</strong>
    <div class="close"></div>
    <div class="top">
        <div class="item bot">
            <div class="tabs_dash">
                <div class="tabs_dash_con active">
                    <div class="bot">
                        <div class="item">
                            <div class="left">
                                <!-- <strong>@lang('messages.deal_data')</strong> -->
                                <div class="user-chart-tuner">
                                    <span id="user_chart_tune">5%</span>&nbsp;
                                    <a id="user_chart_up" href="#" onclick="crm.user.tune.up()">Up</a>&nbsp;
                                    <a id="user_chart_real" href="#" onclick="crm.user.tune.real()">Real</a>&nbsp;
                                    <a id="user_chart_down" href="#" onclick="crm.user.tune.down()">Down</a>
                                </div>
                                <div id="deal_chart" class="chart"></div>
                                <!-- <a href="#" class="edit">@lang('message.user_info')</a> -->
                                <ul class="deal-data readonly-data">
                                    <li>@lang('messages.amount'): <span class="deal-amount"></span></li>
                                    <li>@lang('messages.instrument'): : <span class="user-instrument"></span></li>
                                </ul>
                            </div>
                            <div class="item_con">
                                <strong>@lang('message.user_info')</strong>
                                <a href="#" class="user-info-link" onclick="crm.user.info('+row.id+')">@lang('message.edit')</a>
                                <ul class="user-data readonly-data">
                                    <li>First name: <span class="user-name"></span></li>
                                    <li>Last name: <span class="user-surname"></span></li>
                                    <li>E-mail: <span class="user-email"></span></li>
                                    <li>Phone number: <span class="user-phone"></span></li>
                                    <li>Country: <span class="user-country"></span></li>
                                    <!-- <li>Source: <span class="user-name"></span></li>
                                    <li>Source Description: <span class="user-name"></span></li> -->
                                </ul>
                            </div>
                            <!-- <div class="item_con">
                                <strong>Comments</strong>
                                <p class="coment">No Comments</p>
                                <textarea name="coment" id="coment" placeholder="Enter comment text"></textarea>
                                <div class="item_abs">
                                    <a href="#">Add Comment</a>
                                </div>
                            </div> -->
                        </div>
                        <div class="form_bot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup edit_instrument submiter" data-callback="crmInstrumentCallback" data-rel="edit_instrument">
    <strong>@lang('messages.instrument_edit')</strong>
    <div class="close"></div>
    <form action="#">
        <div class="item">
            <label for="enabled">@lang('messages.instrument_enabled')<input type="checkbox" name="enabled" data-name="enabled" placeholder="enabled"></label>

            <input type="text" name="commission" data-name="commission" placeholder="Comission">
        </div>
        <div class="item">
            <strong>@lang('messages.instrument_history')</strong>
            <table>
                <thead>
                    <td>Date</td>
                    <td>Old enabled/New enabled</td>
                    <td>Old commission/New commission</td>
                </thead>
                <tbody class="instrument-history" data-action="/json/instrument" data-function="crmInstrumentHistoryList" data-autostart="true" data-trigger=""></tbody>
            </table>

        </div>
    </form>
    <!-- <a href="#" class="his">Megan Fox</a> -->
    <div class="button">
        <a href="#" class="close cancel">Close</a>
        <!-- <a href="#" class="edit submit">Edit User</a> -->
        <a href="#" class="edit submit">@lang('messages.save')</a>
    </div>
</div>

<div class="popup manage">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>Manage Dashborad diamonds</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Offer ID</td>
                <td>Ref.</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Lab</td>
                <td>Price $</td>
                <td>Status</td>
                <td>Hold</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>GIA</td>
                <td>12821.9</td>
                <td>Status</td>
                <td>Hold</td>
                <td><a href="#" class="edit">Edit</a></td>
                <td><a href="#" class="del">Del</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup users">
    <strong>Users Verified</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>User ID</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Documents</td>
                <td>Verification</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
            <tr>
                <td>22-05-17 19:27:52</td>
                <td>375</td>
                <td>George</td>
                <td>Washington</td>
                <td>Passport / Driver licence</td>
                <td><a href="#" class="accept buy">Accept</a><a href="#" class="close">Decline</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup users_balances">
    <strong>Users Balances</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>User ID</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Action</td>
                <td>Value</td>
                <td>Method</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
                <td><a href="#"></a><a href="#"></a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup user_history">
    <strong>Users History</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>User ID</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Action</td>
                <td>Value</td>
                <td>Method</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
            <tr>
                <td>22-05-17 18:44:27</td>
                <td>237</td>
                <td>Samuel</td>
                <td>L. Jacson</td>
                <td>Deposite</td>
                <td>$70 375.29</td>
                <td>Deposite from Cradit Card</td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup leads">
    <div class="search">
        <form action="#">
            <input type="search" placeholder="Search">
            <button type="submit"></button>
            <a href="#" class="source">Source</a>
            <div class="popup popup_source">
                <input type="radio" name="radio" value="All"> All<br>
                <input type="radio" name="radio" value="1A"> 1A<br>
                <input type="radio" name="radio" value="2A"> 2A<br>
                <input type="radio" name="radio" value="19AGNS"> 19AGNS<br>
                <input type="radio" name="radio" value="3A"> 3A<br>
                <input type="radio" name="radio" value="4A"> 4A<br>
                <input type="radio" name="radio" value="5A"> 5A<br>
                <input type="radio" name="radio" value="6A"> 6A<br>
                <input type="radio" name="radio" value="7A"> 7A<br>
                <input type="radio" name="radio" value="8A"> 8A<br>
                <input type="radio" name="radio" value="9A"> 9A<br>
                <input type="radio" name="radio" value="10A"> 10A<br>
                <input type="radio" name="radio" value="11A"> 11A<br>
                <input type="radio" name="radio" value="12A"> 12A<br>
                <input type="radio" name="radio" value="13A"> 13A<br>
                <input type="radio" name="radio" value="14A"> 14A<br>
                <input type="radio" name="radio" value="15A"> 15A<br>
                <input type="radio" name="radio" value="16A"> 16A<br>
                <input type="radio" name="radio" value="17A"> 17A<br>
                <input type="radio" name="radio" value="18A"> 18A<br>
                <input type="radio" name="radio" value="19A"> 19A<br>
                <input type="radio" name="radio" value="Wadea PPC"> Wadea PPC<br>
                <input type="radio" name="radio" value="200417SA"> 200417SA<br>
                <input type="radio" name="radio" value="Depo"> Depo<br>
                <input type="radio" name="radio" value="Depo"> Depo<br>
                <input type="radio" name="radio" value="Diamond Previlege"> Diamond Previlege<br>
                <input type="radio" name="radio" value="Yasha"> Yasha<br>
                <input type="radio" name="radio" value="L18_05_17D"> L18_05_17D<br>
                <input type="radio" name="radio" value="One more serch source"> One more serch source<br>
            </div>
            <a href="#" class="filter">Show filter</a>
            <div class="popup popup_filter">
                <input type="radio" name="radio" value="All"> All<br>
                <input type="radio" name="radio" value="New client"> New client<br>
                <input type="radio" name="radio" value="No answer 1"> No answer 1<br>
                <input type="radio" name="radio" value="No answer 1"> No answer 1<br>
                <input type="radio" name="radio" value="No answer 3"> No answer 3<br>
                <input type="radio" name="radio" value="Call back"> Call back<br>
                <input type="radio" name="radio" value="Not interested"> Not interested<br>
                <input type="radio" name="radio" value="Call back / No answer"> Call back / No answer<br>
                <input type="radio" name="radio" value="Wrong number"> Wrong number<br>
                <input type="radio" name="radio" value="Wrong number"> Wrong number
            </div>
            <select name="admin" id="admin">
                <option value="none-disable">Choose Admin</option>
                <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                <option value="Fred Collins">Fred Collins</option>
                <option value="Test admin">Test admin</option>
                <option value="One more admin">One more admin</option>
                <option value="New one admin">New one admin</option>
                <option value="Chosen admin">Chosen admin</option>
                <option value="Stephen Masterson">Stephen Masterson</option>
                <option value="Thomas Baxter">Thomas Baxter</option>
            </select>
            <a href="#" class="filter">Cange admin</a>
            <a href="#" class="del">Delete leads</a>
            <a href="#" class="new" id="edit_user">Add user</a>
        </form>
    </div>
    <strong>Leads</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td><div class="serch"></div>ID <div class="arrow"><span></span><span></span></div></td>
                <td>Created <div class="arrow"><span></span><span></span></div></td>
                <td>Customers name <div class="arrow"><span></span><span></span></div></td>
                <td>E-mail <div class="arrow"><span></span><span></span></div></td>
                <td>Phone <div class="arrow"><span></span><span></span></div></td>
                <td>Country <div class="arrow"><span></span><span></span></div></td>
                <td>Source <div class="arrow"><span></span><span></span></div></td>
                <td>Source Descr. <div class="arrow"><span></span><span></span></div></td>
                <td>Status <div class="arrow"><span></span><span></span></div></td>
                <td>Admin <div class="arrow"><span></span><span></span></div></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
            <tr>
                <td><div class="serch"></div>725</td>
                <td>10-04-17 16:39</td>
                <td>Edgar Zinsser</td>
                <td>Prezision@zinsser.org</td>
                <td>497357559623</td>
                <td>DE</td>
                <td>200417SA</td>
                <td>Nothing</td>
                <td>New</td>
                <td>Stephen Masterson</td>
                <td><a href="#" class="edit">Info</a><a href="#" id="edit_user">Edit</a><a href="#" class="del">Del</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup operations">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>Diamonds</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Certificate</td>
                <td>Price</td>
                <td>Buy</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
            <tr>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>12821.9</td>
                <td><a href="#" class="buy">Buy</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>


<div class="popup waiting">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>Waiting</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Hold Time</td>
                <td>Hold Time</td>
                <td>Buy</td>
                <td>Cancel</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>71:27:52</td>
                <td>5 319.86</td>
                <td><a href="#" class="buy">Buy</a></td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup history_in-sell">
    <strong>Customers diamonds in sell / History</strong>
    <div class="offer">
        Offer ID: <span>26293</span> / Ref: <span>107184914</span> / Carat: <span>0.12</span> / Color: <span>D</span> / Clarity <span>SI3</span> / Price: <span>155$</span>
    </div>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>User ID</td>
                <td>Mail</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Date</td>
                <td>Price $</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>88</td>
                <td>faagboola@hotmail.com</td>
                <td>Fanla Agboola</td>
                <td>447732527066</td>
                <td>05/05/2017 15:55:35</td>
                <td>88.08</td>
            </tr>
            <tr>
                <td>88</td>
                <td>faagboola@hotmail.com</td>
                <td>Fanla Agboola</td>
                <td>447732527066</td>
                <td>05/05/2017 15:55:35</td>
                <td>88.08</td>
            </tr>
            <tr>
                <td>88</td>
                <td>faagboola@hotmail.com</td>
                <td>Fanla Agboola</td>
                <td>447732527066</td>
                <td>05/05/2017 15:55:35</td>
                <td>88.08</td>
            </tr>
        </tbody>
    </table>
    <a href="#" class="back">Back this offer to offers</a>
</div>

<div class="popup customers">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>CustomersÃ¢â‚¬â„¢ diamonds</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Offer ID</td>
                <td>Ref.</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Sertificate</td>
                <td>Price $</td>
                <td>Buyer</td>
                <td>Manager</td>
                <td>Sale date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>508897</td>
                <td>1200022005</td>
                <td>1.82</td>
                <td>H</td>
                <td>Sertificate</td>
                <td>165</td>
                <td>Mustafa Ali</td>
                <td>Sara Alwakel</td>
                <td>05-18-2017 12:48:12</td>
                <td><a href="#">History</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup my_diamonds">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>My Diamonds</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Certificate</td>
                <td>Date / Time</td>
                <td>Price $</td>
                <td>Sell</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td>04-28-2017 12:18:51</td>
                <td class="blue">130</td>
                <td><a href="#" class="buy">Sell</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup in_sell">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>In Sell</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Certificate</td>
                <td>Price $</td>
                <td>Cancel</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="disable">Waiging for buying</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="disable">Waiging for buying</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>Certificate</td>
                <td class="blue">2 547.92</td>
                <td><a href="#" class="red no">Cancel</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup sold_diamond">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>Sold Diamonds</strong>
    <div class="close"></div>
    <div class="results-filter">
        <form method="post" class="form-filter">
            <div class="form-filter--line">
                <input type="radio" id="byQuantity" name="filtered-by" value="by quantity">
                <label for="byQuantity" class="form-filter--first-column">By Quantity</label>
                <p class="form-filter--quantity">
                    <span>Last</span>
                        <input type="radio" id="operations5" name="quantity-operations" value="5">
                    <label for="operations5" class="form-filter--quantity-value">5</label>
                        <input type="radio" id="operations10" name="quantity-operations" value="10">
                    <label for="operations10" class="form-filter--quantity-value">10</label>
                        <input type="radio" id="operations15" name="quantity-operations" value="15">
                    <label for="operations15" class="form-filter--quantity-value">15</label>
                    <span>operations</span>
                </p>
            </div>
            <div class="form-filter--line">
                <input type="radio" id="byPeriod" name="filtered-by" value="by period">
                <label for="byPeriod" class="form-filter--first-column">By Period</label>
                <p class="form-filter--period">
                    <span>Last</span>
                        <input type="radio" id="periodWeek" name="period-length" value="week">
                    <label for="periodWeek" class="form-filter--period-value">Week</label>
                        <input type="radio" id="periodMonth" name="period-length" value="month">
                    <label for="periodMonth" class="form-filter--period-value">Month</label>
                        <input type="radio" id="periodChoose" name="period-length" value="choose">
                    <label for="periodChoose" class="form-filter--period-value">Choose period</label>
                </p>
            </div>
            <div class="form-filter--line">
                <p class="form-filter--first-column">Period:</p>
                <p class="form-filter--period">
                    <input type="date" name="period-length" id="periodBegin" placeholder="04.01.2017"> -
                    <input type="date" name="period-length" id="periodEnd" placeholder="05.01.2017">
                </p>
            </div>
            <div class="form-filter--line">
                <p class="form-filter--first-column">Amount:</p>
                <p class="form-filter--amount">
                    <input type="number" min="0" name="amount-length" id="amountBegin" placeholder="From"> -
                    <input type="number" min="0" name="amount-length" id="amountEnd" placeholder="To">
                </p>
            </div>
            <div class="form-filter--line">
                <div class="form-filter--apply">
                    <input type="submit" value="Apply">
                </div>
            </div>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Date / Time</td>
                <td>Price $</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
            <tr>
                <td>120250982</td>
                <td>0.91</td>
                <td>G</td>
                <td>SI1</td>
                <td>04-12-2017 17:29:26</td>
                <td class="blue">2 547.92</td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup cust_in-sell">
    <div class="search_all">
        <form action="#">
            <input type="search" name="search" title="search" placeholder="Search by ref. number">
            <button type="submit" class="search-submit"></button>
            <a href="#" class="advanced">Advanced search</a>
            <div class="popup popup-search">
                <div class="item">
                    <input type="number" name="priceStart" title="Start Price" placeholder="Start Price">
                    <input type="number" name="priceEnd" title="End Price" placeholder="End Price">
                </div>
                <div class="item">
                    <input type="number" name="caratStart" title="Start Carat" placeholder="Start Carat">
                    <input type="number" name="caratEnd" title="End Carat" placeholder="End Carat">
                </div>
                <div class="item">
                    <input type="text" name="searchColor" title="Search Color" placeholder="Search Color">
                    <input type="text" name="searchCharity" title="Search Charity" placeholder="Search Charity">
                </div>
            </div>
        </form>
    </div>
    <strong>Customers diamonds in sell</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td>Ref</td>
                <td>Carat</td>
                <td>Color</td>
                <td>Clarity</td>
                <td>Sertificate</td>
                <td>Price $</td>
                <td>User</td>
                <td>Manager</td>
                <td>History</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
            <tr>
                <td>107184914</td>
                <td>0.12</td>
                <td>D</td>
                <td>SI3</td>
                <td>-</td>
                <td>155</td>
                <td>Abdalla Alhashimi</td>
                <td>Sara Alwakel</td>
                <td><a href="#">History</a></td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup_task">
    <strong class="active">Tasks <span>22</span></strong>
    <div class="close"></div>
    <ul class="top">
        <li><b>Leads Tasks</b></li>
        <li>Deadline</li>
        <li>Status</li>
        <li><b>Leads Tasks</b></li>
        <li>Deadline</li>
        <li>Status</li>
    </ul>
    <div class="all_task">
        <ul class="task">
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="sub">
                    <li>No tasks</li>
                    <li>05-25-17 14:00</li>
                    <li>
                        <a href="#" class="cancel">cancel</a>
                        <a href="#" class="complate">complate</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="add_task">
        <strong>Add Task</strong>
        <form action="#">
            <textarea name="add_task" id="add_task" placeholder="Enter task text"></textarea>
            <input type="submit" value="Add task">
        </form>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup_users_balans">
    <strong>Users balances</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Action</td>
                    <td>Value</td>
                    <td>Method</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Depostit ok</td>
                    <td>100</td>
                    <td>Deposit from Credit Card</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup_email">
    <strong>Email logs</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Status</td>
                    <td>Check</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>praezision@zinsser.org</td>
                    <td>Email sent</td>
                    <td><a href="#" class="read">read email</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup_telephone">
    <strong>Telephone</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Telephone</td>
                    <td>Status</td>
                    <td>Check</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>+00000000000000</td>
                    <td>Phone call 7 min. 51 sec</td>
                    <td><a href="#" class="check">Check</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup-accept">
    <h2 class="popup-accept--title">
        Are you going to <span class="accept-text hidden">buy</span> this diamond?</h2>
    <div class="popup-accept--title-line"></div>
    <h3 class="popup-accept--question">Are you sure?</h3>
    <ul class="popup-accept--info">
        <li class="info-text">Ref. <span>12042017</span></li>
        <li class="info-text">Carat <span>10</span></li>
        <li class="info-text">Color <span>F</span></li>
        <li class="info-text">Clarity <span>SI1</span></li>
        <li class="info-text">Price <br><span>$10 117.17</span></li>
    </ul>
    <div class="accept-buttons">
        <div class="button-buy" id="play"><a class="yes">Yes</a></div>
        <div class="button-cancel"><a class="no">No</a></div>
    </div>
</div>

<div class="popup widthdtrawal">
    <strong>Widthdtrawal investment</strong>
    <div class="close"></div>
    <div class="table">
        <span>Total: 2</span>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Value</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>27 000</td>
                    <td>Accepted</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup popup_money_report">
    <strong>Money transaction report</strong>
    <div class="close"></div>
    <div class="search">
        <form action="#">
            <input type="search" placeholder="search" name="search">
            <input type="date" value="Date min">
            <input type="date" value="Date max">
            <select name="processes" id="processes">
                <option value="Withdrawal processing">Withdrawal processing</option>
                <option value="Withdrawal declined">Withdrawal declined</option>
                <option value="Withdrawal successful">Withdrawal successful</option>
                <option value="Deposit in processing">Deposit in processing</option>
                <option value="Deposit declined">Deposit declined</option>
                <option value="Deposit successful">Deposit successful</option>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="table">
        <span>Total: 79</span>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Admin</td>
                    <td>Action</td>
                    <td>Value</td>
                    <td>Method</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Fred Collins < Alexander Bogdanov</td>
                    <td>Withdrawal processing</td>
                    <td>27 000</td>
                    <td>Withdrawal from Credit card</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup manage_lots">
    <strong>Manage lots</strong>
    <div class="search">
        <form action="#">
            <input type="search" placeholder="Search" name="search">
        </form>
        <a href="#" class="add">Add lot</a>
    </div>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Ref</td>
                    <td>Carat</td>
                    <td>Color</td>
                    <td>Clarity</td>
                    <td>Price</td>
                    <td>Investing Bar Free</td>
                    <td>Time</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>12042017</td>
                    <td>10</td>
                    <td>F</td>
                    <td>VS1</td>
                    <td>$30 000</td>
                    <td>98.7%</td>
                    <td>Time</td>
                    <td><a href="#" id="edit_user">Edit</a></td>
                    <td><a href="#" class="edit">Info</a></td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <ul>
                <li class="first">
                    <a href="#">First page</a>
                </li>
                <li class="prev">
                    <a href="#">...</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
                <li>
                    <a href="#">4</a>
                </li>
                <li class="active">
                    <a href="#">5</a>
                </li>
                <li>
                    <a href="#">6</a>
                </li>
                <li>
                    <a href="#">7</a>
                </li>
                <li class="next">
                    <a href="#">...</a>
                </li>
                <li class="last">
                    <a href="#">Last page</a>
                </li>
            </ul>
            <div class="total_item">
                <span>5</span>/<span>57</span>
            </div>
        </div>
    </div>
</div>

<div class="popup customer_investments">
    <strong>Customer investments</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Lots</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
                <tr>
                    <td>2017-05-29 14:42:33</td>
                    <td>27</td>
                    <td>NIYUNGEKO Gerard</td>
                    <td>Lot 1 <span></span> $3 500</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <li class="first">
                <a href="#">First page</a>
            </li>
            <li class="prev">
                <a href="#">...</a>
            </li>
            <li>
                <a href="#">3</a>
            </li>
            <li>
                <a href="#">4</a>
            </li>
            <li class="active">
                <a href="#">5</a>
            </li>
            <li>
                <a href="#">6</a>
            </li>
            <li>
                <a href="#">7</a>
            </li>
            <li class="next">
                <a href="#">...</a>
            </li>
            <li class="last">
                <a href="#">Last page</a>
            </li>
        </ul>
        <div class="total_item">
            <span>5</span>/<span>57</span>
        </div>
    </div>
</div>

<div class="popup import_leads">
    <strong>Import leads</strong>
    <div class="close"></div>
    <div class="item_wrap">
        <form action="#">
            <input type="file" value="Choose file">
            <input type="submit" value="Import">
        </form>
        <p>Format xls: Name, Surname, email, phone number, country, source, source description</p>
        <p>Required fields name and phone or mail</p>
    </div>
</div>
