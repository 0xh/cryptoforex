<div class="bgc"></div>

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
            <tbody id="balance_list" data-name="balance-list" class="loader" data-sort="balance desc" data-action="/json/finance/balance" data-function="crmBalanceList" data-autostart="false" data-trigger=""></tbody>
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

<div class="popup edit_user submiter" data-callback="crmUserCallback" data-callback-error="crmUserCallbackError">
    <span>@lang('messages.user_edit')</span>
    <div class="close"></div>
    <form action="#">
        <div class="item">
            <input type="text" name="name" data-name="name" placeholder="Name">
            <input type="text" name="surname" data-name="surname" placeholder="Surname">
            <input type="email" name="email" data-name="email" placeholder="Nameaddress@servername.com">
            <input type="password" name="password" data-name="password" placeholder="password">
            <!-- <input type="text" name="country" data-name="country" placeholder="Country"> -->
            <!-- <input type="text" name="money" data-name="money" placeholder="$23 758.56"> -->

        </div>
        <div class="item">
            <input type="tel" name="phone" data-name="phone" placeholder="Phone number">
            <input type="text" name="country" data-name="country" placeholder="Country">
            <select name="rights_id" data-name="rights_id" placeholder="User rights" class="loader" data-action="/json/user/rights" data-autostart="true" style="height:42px;"></select>
            <!-- <select name="status_id" data-name="status_id" placeholder="User status" class="loader" data-action="/json/user/status" data-autostart="true"></select> -->
            <!-- <select name="name_sur" data-name="name_sur" id="name_sur" placeholder="Name Surname">
                <option value="non-select" disabled="" selected="">User rightscountry</option>
                <option value="Alexander Bogdanov">Alexander Bogdanov</option>
                <option value="Samuel L. Jacson">Samuel L. Jacson</option>
                <option value="George Washington">George Washington</option>
                <option value="Peris Hilton">Peris Hilton</option>
                <option value="Megan Fox">Megan Fox</option>
            </select> -->
        </div>
        <hr />
        <div class="item">
            <select class="loader" data-id="user-managers" data-title="All managers" data-name="parent_user_id" data-action="/json/user?rights_id=5" data-autostart="true" data-trigger="change" data-target="user-list"></select>
        </div>
    </form>
    <!-- <a href="#" class="his">Megan Fox</a> -->
    <div class="button">
        <a href="#" class="close cancel">Close</a>
        <!-- <a href="#" class="edit submit">Edit User</a> -->
        <a href="#" class="edit submit">@lang('messages.save')</a>
    </div>
</div>
<div class="popup popup_b deals">
  <strong>Deals</strong>
  <div class="close"></div>
  <div class="contenta flex">
      <div class="search">
          <form action="#">
              <div class="filter_users">
                  <select class="loader requester" data-title="Deal status" data-name="status_id" data-action="/json/deal/status" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
              </div>
              <div class="filter_users">
                  <select class="loader requester" data-title="Intrument" data-name="instrument_id" data-action="/json/instrument" data-autostart="true" data-trigger="change" data-target="deal-list"></select>
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
