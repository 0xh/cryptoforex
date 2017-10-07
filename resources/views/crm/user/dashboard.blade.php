<div class="popup popup_b user_dashboard show" style="display:block;">
    <div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <strong>@lang('messages.user_dashboard')</strong>
    <div class="contenta flex info">
        <div class="item">
            <div class="inner">
                <div class="wrap">
                    <div class="left user-basic-info submitter" data-action="/json/user/update" data-callback="">
                        <!-- <a href="#" class="edit">Edit data user</a> -->
                        <ul class="">
                            <li>First name: <span class="user-name">{{$user["name"]}}</span></li>
                            <li>Last name: <span class="user-surname">{{$user["surname"]}}</span></li>
                            <li>Created: <span class="user-created">{{date("Y-m-d H:i:s",time($user["created_at"]))}}</span></li>
                            <li>E-mail: <span class="user-email">{{$user["email"]}}</span></li>
                            <!-- <li>Password: <span class="user-password"></span></li> -->
                            <li>Phone number: <span class="user-phone">{{$user["phone"]}}</span></li>
                            <li>Country: <span class="user-country">{{$user["country"]}}</span></li>
                            <li>KYC: <span class="user-rurs">No</span></li>
                            <li>Status: <span class="user-status">new client</span></li>
                            <!-- <li>Rights: <span class="user-rights_id"><select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/json/user/rights" data-autostart="true"></select></span></li> -->
                            <!-- <li>Source: <span class="user-name"></span></li>
                            <li>Source Description: <span class="user-name"></span></li> -->
                        </ul>
                        <div class="button flex">
                            <a href="javascript:0;" class="submit">@lang('messages.save')</a>
                            <a href="javascript:0;" class="submit">@lang('edit.save')</a>
                        </div>
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
                <div id="user_scheduler_{{$user['id']}}" class="dhx_cal_container">
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
            <div class="inner"></div>
            <div class="inner">
                <div class="tabs_in">
                    <ul class="tabs_in_dashbord">
                        <li>Comments</li>
                        <li>Logs</li>
                        <li>Finance</li>
                        <li>Open trad</li>
                        <li>Verification</li>
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
                        @foreach($user['accounts'] as $account)
                            <div class="item-bank">
                                <h5 class="user-account-name">@lang("messages.".$account->type)</h5>
                                <a href="#"><span></span>{{$account->amount}}</a>
                                <div class"submiter user-account" id="user_account_{{$account->id}}" data-autostart="true" data-id="{{$account->id}}" data-action="/json/finance/deposit?account_id={{$account->id}}&merchant_id=1" data-callback="crmUserInfo">
                                    <input name="amount" data-name="amount"/>
                                    <button class="deposit submit" onclick="window.crm.user.deposit('user_account_{{$account->id}}')">@lang("messages.deposit")</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tabs_in_dash opentrades">
                        <table>
                            <thead>
                                <tr>
                                    <td>ID <div class="arrow"><span></span><span></span></div></td>
                                    <td>Registred <div class="arrow"><span></span><span></span></div></td>
                                    <td>Updated <div class="arrow"><span></span><span></span></div></td>
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
                            <tbody class="loader" id="user_deals" data-name="user-deals" data-action="/json/deal?status=open" data-function="crmDealList" data-autostart="true" data-trigger="">
                                @foreach($deals as $deal)
                                    <tr  data-class="deal" data-id="{{$deal->id}}">
                                        <td>{{$deal->id}}</td>
                                        <td>{{$deal->created_at}}</td>
                                        <td>{{$deal->updated_at}}</td>
                                        <td>{{$deal->instrument->title}}</td>
                                        <td>{{$deal->status->name}}</td>
                                        <td>{{$deal->amount}}</td>
                                        <td>{{$deal->multiplier}}</td>
                                        <td>{{$deal->direction}}</td>
                                        <td>{{$deal->profit}}</td>
                                        <td>{{$deal->price_start}} - {{$deal->price_stop}}</td>
                                        <td><a href="javascript:0;" onclick="crm.deal.info({{$deal->id}})" class="edit">@lang('messages.info')</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tabs_in_dash verification">
                        <table>
                            <thead>
                                <tr>
                                    <td>ID <div class="arrow"><span></span><span></span></div></td>
                                    <td>Registred <div class="arrow"><span></span><span></span></div></td>
                                    <td>Updated <div class="arrow"><span></span><span></span></div></td>
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
                            <tbody class="loader" id="user_deals" data-name="user-deals" data-action="/json/deal?status=open" data-function="crmDealList" data-autostart="true" data-trigger="">
                                @foreach($deals as $deal)
                                    <tr  data-class="deal" data-id="{{$deal->id}}">
                                        <td>{{$deal->id}}</td>
                                        <td>{{$deal->created_at}}</td>
                                        <td>{{$deal->updated_at}}</td>
                                        <td>{{$deal->instrument->title}}</td>
                                        <td>{{$deal->status->name}}</td>
                                        <td>{{$deal->amount}}</td>
                                        <td>{{$deal->multiplier}}</td>
                                        <td>{{$deal->direction}}</td>
                                        <td>{{$deal->profit}}</td>
                                        <td>{{$deal->price_start}} - {{$deal->price_stop}}</td>
                                        <td><a href="javascript:0;" onclick="crm.deal.info({{$deal->id}})" class="edit">@lang('messages.info')</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('ul.tabs_in_dashbord li:not(.active)').on('click', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs_in').find('div.tabs_in_dash').removeClass('active').eq($(this).index()).addClass('active');
    });
    // var dp = dataProcessor("/json/task?user_id={{$user['id']}}");
    // dp.init(scheduler);
    scheduler.init("user_scheduler_{{$user['id']}}",new Date(),"week");
    scheduler.load("/json/task?user_id={{$user['id']}}","json");
    scheduler.attachEvent("onEventAdded", function(id,ev){
        // console.debug("onEventAdded",id,ev,ev.start_date.toISOString());

        $.ajax({
            url:"/json/task/add",
            dataType:"json",
            data:{
                title:ev.text,
                text:ev.text,
                start_date:ev.start_date.toISOString().slice(0,-5),
                end_data:ev.end_date.toISOString().slice(0,-5),
                user_id:{{$user["id"]}},
                type_id:1,
                status_id:1
            },
            success:function(d,x,s){
                console.debug("task created:",d);
                ev.id = d.id;
            }
        });
    });
</script>
