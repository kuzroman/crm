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
                <td class="">Получатель</td>
                <td class="">Вид затрат</td>
                <td class="">Примечание</td>
                <td class=" btn"><div class="jAdd">Добавить</div></td>
            </tr>
        </thead>
        <tbody id="mutualCalcsList"></tbody>
    </script>

    <script type="text/template" id="tmplMutualCalc">
        <td class=""><%=id%></td>
        <td class=""><%=orderDateCreatedRus%></td>
        <td class=""><%=dateRus%></td>
        <td class=""><%=sum%></td>
        <td class=""><%=recipientName%></td>
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
                <td class="pr9">Заказ</td>
                <td>
                    <select name="id_order">
                        <% _.each(settings.cOrders, function(x,index) {
                                var model = settings.cOrders.at(index)
                                    ,date = model.get('dateCreatedRus')
                                    ,name = model.get('buyerName')
                                    ,id = model.get('id');

                                var selected = (id_order == id) ? 'selected' : '';
                        %>
                         <option <%=selected%> value="<%=id%>"><%=date%> - <%=name%></option>
                        <% }); %>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Дата</td>
                <td><input type="ui_date" name="dateRus" value="<%=dateRus%>"/></td>
            </tr>
            <tr>
                <td>Сумма</td>
                <td><input name="sum" value="<%=sum%>"></td>
            </tr>
            <tr>
                <td class="pr9">Получатель</td>
                <td>
                    <span>Покупатель:</span>
                    <select name="id_buyer" class="jChangeRecipient jEditIdBuyer">
                        <option value=""></option>
                        <% _.each(settings.cBuyers, function(x,index) {
                                var model = settings.cBuyers.at(index)
                                    ,name = model.get('name')
                                    ,id = model.get('id');

                                var selected = (id_buyer == id) ? 'selected' : '';
                        %>
                         <option <%=selected%> value="<%=id%>"><%=name%></option>
                        <% }); %>
                    </select>

                    <span>или Сотрудник:</span>
                    <select name="id_employee" class="jChangeRecipient jEditIdEmployee">
                        <option value=""></option>
                        <% _.each(settings.cEmployees, function(x,index) {
                                var model = settings.cEmployees.at(index)
                                    ,name = model.get('name')
                                    ,id = model.get('id');

                                var selected = (id_employee == id) ? 'selected' : '';
                        %>
                         <option <%=selected%> value="<%=id%>"><%=name%></option>
                        <% }); %>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="pr9">Вид затрат</td>
                <td>
                    <select name="id_kindcost">
                        <% _.each(settings.cKindCosts, function(x,index) {
                                var model = settings.cKindCosts.at(index)
                                    ,name = model.get('name')
                                    ,id = model.get('id');

                                var selected = (id_kindcost == id) ? 'selected' : '';
                        %>
                         <option <%=selected%> value="<%=id%>"><%=name%></option>
                        <% }); %>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Примечание</td>
                <td><textarea name="desc"><%=desc%></textarea></td>
            </tr>


            <tr>
                <td></td>
                <td class="pt9">
                 <%  if (sum == '') { %>
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