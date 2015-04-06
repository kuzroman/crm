<table class="silver mt9 mb9">
    <tr>
        <td class="btn @if (Request::path() == 'order') selected @endif">
            <a href="/order">Продажи</a>
        </td>
        <td class="btn @if (Request::path() == 'buyer') selected @endif">
            <a href="/buyer">Контрагенты</a>
        </td>
        <td class="btn @if (Request::path() == 'kindbuyer') selected @endif">
            <a href="/kindbuyer">Вид Контрагента</a>
        </td>
        <td class="btn @if (Request::path() == 'place') selected @endif">
            <a href="/place">Участки</a>
        </td>
    </tr>
</table>