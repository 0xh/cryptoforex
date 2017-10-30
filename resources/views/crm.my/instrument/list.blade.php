<div class="popup popup_b instruments">
    <div class="close" onclick="{ $(this).parent().fadeOut( 256, function(){ $(this).remove(); } ); }"></div>
    <div class="contenta flex">
        <strong>@lang('messages.instrument_list')</strong>
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
                    <td></td>
                </tr>
            </thead>
            <tbody class="loader" data-name="instrument-list" data-action="/json/instrument" data-function="crmInstrumentList" data-autostart="true" data-trigger="">
            </tbody>
        </table>
    </div>
</div>
