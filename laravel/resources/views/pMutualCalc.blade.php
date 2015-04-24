{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')

{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="mutualCalcsBox"></div>

    <script type="text/template" id="tmplMutualCalcs">
        <thead>
            <tr class="head">
                <td class="">#</td>
                <td class="">Заказ</td>
                <td class="">Дата</td>
                <td class="">Сумма</td>
                <td class="">Контрагент</td>
                <td class="">Сотрудник</td>
                <td class="">Вид затрат</td>
                <td class="">Примечание</td>
                <td class=" btn"><div class="jAdd">Добавить</div></td>
            </tr>
        </thead>
        <tbody id="mutualCalcsList"></tbody>
    </script>

    <script type="text/template" id="tmplMutualCalc">
        <td class=""><%=id%></td>
        <td class=""><%=orderDateCreated%></td>
        <td class=""><%=date%></td>
        <td class=""><%=sum%></td>
        <td class=""><%=buyerName%></td>
        <td class=""><%=employeeName%></td>
        <td class=""><%=kindCostName%></td>
        <td class=""><%=desc%></td>
        <% if (edit) { %>
            <td class="btn jEdit">Редакция</td>
        <% } %>
    </script>


    <script type="text/template" id="tmplMutualCalcEdit">
        <div class="jClose close">X</div>

        <table>
            <tr>
                <td class="pr9">Дата начала</td>
                <td><input type="ui_date" name="dateCreatedRus" value="<%=dateCreatedRus%>"/></td>
            </tr>
            <tr>
                <td>Покупатель</td>
                <td>

                </td>
            </tr>
            <tr>
                <td>Описание</td>
                <td><textarea name="desc"><%=desc%></textarea></td>
            </tr>
            <tr>
                <td>Участок</td>
                <td>

                </td>
            </tr>
            <tr>
                <td>Безнал</td>
                <td>
                    <label>
                        <input type="radio" name="cash" value="0" <% if (cash == 0) { %> checked <% } %> />б.нал
                    </label>
                    <label>
                        <input type="radio" name="cash" value="1" <% if (cash == 1) { %> checked <% } %> />нал
                    </label>
                </td>
            </tr>
            <tr>
                <td>Цена</td>
                <td><input name="price" value="<%=price%>"></td>
            </tr>
            <tr>
                <td>Оплачено</td>
                <td>
                    <label>
                        <input type="radio" name="paid" value="0" <% if (paid == 0) { %> checked <% } %> />Нет
                    </label>
                    <label>
                        <input type="radio" name="paid" value="1" <% if (paid == 1) { %> checked <% } %> />Оплачено
                    </label>
                </td>
            </tr>
            <tr>
                <td>Дата сдачи</td>
                <td><input type="ui_date" name="dateCompletedRus" value="<%=dateCompletedRus%>"></td>
            </tr>
            <tr>
                <td>Готово</td>
                <td>
                    <label>
                        <input type="radio" name="finished" value="0" <% if (finished == 0) { %> checked <% } %> />Нет
                    </label>
                    <label>
                        <input type="radio" name="finished" value="1" <% if (finished == 1) { %> checked <% } %> />Готово
                    </label>
                {{--<input name="finished" value="<%=finished%>">--}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="pt9">
                 <%  if (price == '') { %>
                    <button class="jAdd">Добавить</button>
                <% } else { %>
                    <button class="jChange mr18">Изменить</button>
                    <button class="jDel">Удалить</button>
                <% } %>
                </td>
            </tr>

        </table>
    </script>



    <script type="text/javascript" src="js/models/m.buyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.buyer.js" language="javascript"></script>
@if (isset($buyers) && count($buyers) )
    <script>
    $(function () {
        if (!settings.cBuyers)
            settings.cBuyers = new App.Collections.Buyers( {!! $buyers !!} )
    })
    </script>
@endif

    <script type="text/javascript" src="js/models/m.employee.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.employee.js" language="javascript"></script>
@if (isset($employees) && count($employees) )
    <script>
    $(function () {
        if (!settings.cEmployees)
            settings.cEmployees = new App.Collections.Employees( {!! $employees !!} )
    })
    </script>
@endif

    <script type="text/javascript" src="js/models/m.kindCost.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.kindCost.js" language="javascript"></script>
@if (isset($kindCosts) && count($kindCosts) )
    <script>
    $(function () {
        if (!settings.cKindCosts)
            settings.cKindCosts = new App.Collections.KindCosts( {!! $kindCosts !!} )
    })
    </script>
@endif

    <script type="text/javascript" src="js/models/m.order.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.order.js" language="javascript"></script>
@if (isset($orders) && count($orders) )
    <script>
    $(function () {
        if (!settings.cOrders)
            settings.cOrders = new App.Collections.Orders( {!! $orders !!} )
    })
    </script>
@endif



@if (isset($mutualCalc) && count($mutualCalc) )
    <script>
    $(function () {
        if (!settings.cMutualCalcs)
            settings.cMutualCalcs = new App.Collections.MutualCalcs( {!! $mutualCalc !!} )
    })
    </script>
@endif

    <script type="text/javascript" src="js/models/m.mutualCalc.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.mutualCalc.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.mutualCalc.js" language="javascript"></script>
    <script type="text/javascript" src="js/pages/p.mutualCalc.js" language="javascript"></script>

@stop