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
        <td class="btn @if (Request::path() == 'kindcost') selected @endif">
            <a href="/kindcost">Вид затрат</a>
        </td>
        <td class="btn @if (Request::path() == 'employee') selected @endif">
            <a href="/employee">Сотрудники</a>
        </td>
        <td class="btn @if (Request::path() == 'mutualcalc') selected @endif">
            <a href="/mutualcalc">Взаиморасчеты</a>
        </td>
    </tr>
</table>