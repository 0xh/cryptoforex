<div class="bgc"></div>

<div class="popup user">
    <div class="search">
        <form action="#">
            <input type="search" placeholder="Search" class="requester" data-name="search" data-trigger="keyup" data-target="user-list"><button type="submit"></button>
            <!-- <a href="#" class="filter">Show filter</a> -->
            <p><input type="checkbox" name="online" data-name="online" class="requester" data-trigger="change" data-target="user-list" value="online">@lang('messages.online_users')</p>
            <!-- <div class="batcher">
            </div> -->
            <div class="filter_users">
                <select class="loader" data-name="manager_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                <a href="javascript:0;" class="button batcher" data-list="user_selected" data-action="/json/user/{data-id}/update?parent_user_id={manager_id}" data-target="user-list" onclick="cf.batcher(this);">@lang('message.add_manager')</a>
            </div>

            <div class="filter_users">
                <select class="loader requester" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
            <div class="filter_users">
                <select class="loader requester" data-name="rights_id" data-action="/json/user/rights" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
            <div class="filter_users">
                <select class="loader requester" data-name="country" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>

            <div class="filter_users">
                <select class=" requester" data-name="source" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
            </div>
        </form>
    </div>
    <strong>Users</strong>
    <div class="close"></div>
    <table>
        <thead>
            <tr>
                <td><input type="checkbox" class="check-all" data-list="user_selected" /></td>
                <td>ID <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Registred <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <!-- <td>Registred <div class="arrow sorter"><span></span><span></span></div></td> -->
                <td>Email <div class="arrow sorter" data-name="email" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Name <div class="arrow sorter" data-name="name" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Phone <div class="arrow sorter" data-name="phone" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Country <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Balance 1 <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Balance 2 <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Rights <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Users <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Admin <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Last Online <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>IP <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td></td>
            </tr>
        </thead>
        <tbody id="user_list" data-name="user-list" class="loader" data-action="/json/user" data-function="crmUserList" data-autostart="true" data-trigger=""></tbody>
    </table>
</div>

<div class="popup popup_b deals">
  <strong>Deals</strong>
  <div class="close"></div>
  <div class="contenta flex">
      <div class="search">
          <form action="#">
              <div class="filter_users">
                  <select class="loader requester" data-name="status_id" data-action="/json/deal/status" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
              </div>
              <div class="filter_users">
                  <select class="loader requester" data-name="instrument_id" data-action="/json/instrument" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
              </div>
          </form>
      </div>
      <table>
            <thead>
                <tr>
                    <td>ID <div class="arrow sorter" data-name="id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Registred <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Updated <div class="arrow sorter" data-name="updated_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>User<div class="arrow sorter" data-name="user_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Manager<div class="arrow sorter" data-name="manager_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Instrument<div class="arrow sorter" data-name="instrument_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Status<div class="arrow sorter" data-name="status_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Amount<div class="arrow sorter" data-name="amount" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Multiplier<div class="arrow sorter" data-name="multiplier" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Direction<div class="arrow sorter" data-name="direction" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Profit<div class="arrow sorter" data-name="profit" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Stops <div class="arrow"><span></span><span></span></div></td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody class="loader" data-name="deal-list" data-action="/json/deal?status=all" data-function="crmDealList" data-autostart="true" data-trigger=""></tbody>
      </table>
  </div>
</div>

<div class="popup popup_users_balans">
    <strong>Users balances</strong>
    <div class="close"></div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Manager</td>
                    <td>In deals<div class="arrow"><span></span><span></span></div></td>
                    <!-- name="status_id" class="loader" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-form="#user_list" -->
                    <td>Profit </td>
                    <td>Balance</td>
                </tr>
            </thead>
            <tbody id="balance_list" data-name="balance-list" class="loader" data-sort="balance desc" data-action="/json/finance/balance" data-function="crmBalanceList" data-autostart="true" data-trigger=""></tbody>
        </table>
    </div>
</div>

<div class="popup widthdtrawal">
    <strong>Widthdtrawal investment</strong>
    <div class="close"></div>
    <div class="table">
        <span>Total: <span class="withdrawal_list_total"></span></span>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>User ID</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Value</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody id="withdrawal_list" data-name="withdrawal-list" class="loader" data-sort="amount desc" data-action="/json/finance/withdrawal?status=request" data-function="crmWithdrawalList" data-autostart="true"></tbody>
        </table>
        </ul>
        <!-- <div class="total_item"><span>5</span>/<span>57</span></div> -->
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
        <span>Total: <span class="transaction_list_total"></span></span>
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
            <!-- <tbody> -->
            <tbody id="transaction_list" data-name="transaction-list" class="loader" data-action="/json/finance" data-function="crmTransactionList" data-autostart="true" data-trigger=""></tbody>
        </table>
    </div>
</div>