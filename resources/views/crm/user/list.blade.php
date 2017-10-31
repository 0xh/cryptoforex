<div class="popup users user user-list" style="display:block;">
    <div class="close" onclick="{ $('.user-list').fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <div class="search">
        <form action="#" class="flex jcsb width">
            <div class="left flex">
                <div class="inner">
                    <input type="search" placeholder="Search" class="requester" data-name="search" data-trigger="keyup" data-target="user-list"><button type="submit"></button>
                </div>
                <div class="inner">
                    <p class="status red">
                        <input type="checkbox" class="requester" data-name="online" data-trigger="change" data-target="user-list"/>
                        <!-- <label><input type="checkbox" class="requester" data-name="online" data-trigger="change" data-target="user-list"/>Online</label> -->
                    </p>
                </div>
            </div>
            <div class="center flex">
                <div class="inner active">
                    <select class="requester" data-id="user-rights" data-title="All user rights" data-name="rights_id" data-action="/json/user/rights" data-autostart="false" data-trigger="change" data-target="user-list">
                        @foreach($rights["list"] as $row)
                            <option value="{{$row->id}}" @if($row->id==$rights["selected"]) selected="selected" @endif>
                                {{$row->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @can('superadmin')
                <div class="inner active">
                    <select class="requester" data-id="user-administrators" data-title="All administrators" data-name="parent_id" data-action="/json/user?rights_id=7" data-autostart="true" data-trigger="change" data-target="user-managers">
                        <option value="false">Administrators</option>
                        @foreach($rights["admins"] as $row)
                            <option value="{{$row->id}}">
                                {{$row->name}} {{$row->surname}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endcan
                @can('admin')
                <div class="inner">
                    <select class="loader requester" data-id="user-managers" data-title="All managers" data-name="parent_id" data-action="/json/user?rights_id=5" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                </div>
                @endcan
                <!-- <div class="inner"><select class="loader requester" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"></select></div> -->
            </div>
            <div class="right flex">
                <!-- <div class="inner">
                    <select class="loader requester" data-name="status_id" data-title="Status" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                </div> -->
                <div class="inner">
                    <select class="loader requester" data-name="country" data-title="Country" data-action="/json/user/countries" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                </div>
                @if($rights["selected"]<2)
                <div class="inner">
                    <select class="loader requester" data-title="Status" data-name="status_id" data-action="/json/user/status" data-autostart="true" data-trigger="change" data-target="user-list"></select>
                </div>
                @endif
                <div class="inner">
                    <select class="loader" style="display:none;" data-title="Assign" data-name="manager_id" data-action="/json/user?assigner=1" data-autostart="true"></select>
                </div>
                <!-- <div class="inner"><label><input type="checkbox" class="requester" data-name="assigned" data-trigger="change" data-target="user-list"/>Assigned</label></div>
                <div class="inner"><label><input type="checkbox" class="requester" data-name="control" data-trigger="change" data-target="user-list"/>Control</label></div> -->

                <div class="inner">
                    <a href="javascript:crm.user.add()" class="add">add User</a>
                </div>
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <td><input type="checkbox" class="check-all" data-list="user_selected" /></td>
                <td>ID <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>

                <td>Registred <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Email <div class="arrow sorter" data-name="email" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Name <div class="arrow sorter" data-name="name" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Phone <div class="arrow sorter" data-name="phone" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Country <div class="arrow sorter" data-name="country" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
                <td>Status <div class="arrow sorter" data-name="status" data-trigger="click" data-target="user-list" data-value="asc"><span></span><span></span></div></td>
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
