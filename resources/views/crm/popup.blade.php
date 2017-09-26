<div class="popup user">
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
        <tbody class="loader" data-action="/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
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
    <span>Edit User</span>
    <div class="close"></div>
    <form action="#">
        <div class="item">
            <input type="text" name="name" data-name="name" placeholder="Name">
            <input type="email" name="email" data-name="email" placeholder="Nameaddress@servername.com">
            <input type="text" name="country" data-name="country" placeholder="Country">
            <!-- <input type="text" name="money" data-name="money" placeholder="$23 758.56"> -->
            <select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/userrights" data-autostart="true"></select>
        </div>
        <div class="item">
            <input type="text" name="surname" data-name="surname" placeholder="Surname">
            <input type="tel" name="phone" data-name="phone" placeholder="Phone number">
            <input type="password" name="password" data-name="password" placeholder="password">
            <input type="text" name="Comment" data-name="Comment" placeholder="Comment">
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

<div class="popup dashboard">
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
        <tbody class="loader" data-action="/deal" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
    </table>
</div>