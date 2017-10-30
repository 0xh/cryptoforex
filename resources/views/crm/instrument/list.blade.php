<div class="popup popup_b instruments" style="display:block;">
    <div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <div class="contenta flex">
        <strong>@lang('messages.instrument_list')</strong>
        <table>
            <thead>
                <tr>
                    <td>ID <div class="arrow sorter" data-name="id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Enabled <div class="arrow sorter" data-name="updated_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>

                    <td>Title <div class="arrow sorter" data-name="created_at" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Diff<div class="arrow sorter" data-name="user_id" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>
                    <td>Direction<div class="arrow sorter" data-name="direction" data-trigger="click" data-target="deal-list" data-value="asc"><span></span><span></span></div></td>

                    <td>Commission <div class="arrow"><span></span><span></span></div></td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="loader" data-name="instrument-list" data-action="/json/instrument" data-function="crmInstrumentList" data-autostart="true" data-trigger="">
            </tbody>
        </table>
    </div>
</div>
