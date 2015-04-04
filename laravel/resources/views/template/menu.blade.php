<table class="silver mt9 mb9">
    <tr>
        <td @if (Request::path() == 'buyer') class="selected" @endif >
            <a href="/buyer">Контрагенты</a>
        </td>
        <td @if (Request::path() == 'kindbuyer') class="selected" @endif >
            <a href="/kindbuyer">Вид Контрагента</a>
        </td>
    </tr>
</table>