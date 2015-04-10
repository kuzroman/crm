{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

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


    <script type="text/javascript" src="js/models/m.place.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.place.js" language="javascript"></script>
    @if (isset($places) && count($places) )
    <script>
    $(function () {
        if (!settings.cPlaces)
            settings.cPlaces = new App.Collections.Places( {!! $places !!} )
    })
    </script>
    @endif


    @if (isset($orders) && count($orders) )
    <script>
    $(function () {
        if (!settings.cOrders)
            settings.cOrders = new App.Collections.Orders( {!! $orders !!} )
    })
    </script>
    @endif

<table id="order" class="silver">
    <thead>
        <tr class="head">
            <td>#</td>
            <td>Дата начала</td>
            <td>Покупатель</td>
            <td>Описание</td>
            <td>Участок</td>
            <td>Безнал</td>
            <td>Цена</td>
            <td>Оплачено</td>
            <td>Дата сдачи</td>
            <td>Готово</td>
            <td></td>
        </tr>
        <tr id="addOrder"></tr>
    </thead>
    <tbody id="ordersBox"></tbody>
</table>

<td></td>
            {{--<td><input type="ui_date" name="dateCreatedRus"/></td>--}}
            {{--<td>--}}
                {{--<select name="id_buyer">--}}
                    {{--<% _.each(settings.cBuyers, function(x,index) {--}}
                        {{--var model = settings.cBuyers.at(index)--}}
                            {{--,name = model.get('name')--}}
                            {{--,id = model.get('id');--}}

                        {{--var selected = (id_buyer == id) ? 'selected' : '';--}}
                    {{--%>--}}
                     {{--<option <%=selected%> value="<%=id%>"><%=name%></option>--}}
                    {{--<% }); %>--}}
                {{--</select>--}}
            {{--</td>--}}
            {{--<td><textarea name="desc"></textarea></td>--}}
             {{--<td>--}}
                {{--<select name="id_place">--}}
                    {{--<% _.each(settings.cPlaces, function(x,index) {--}}
                        {{--var model = settings.cPlaces.at(index)--}}
                            {{--,name = model.get('name')--}}
                            {{--,id = model.get('id');--}}

                        {{--var selected = (id_place == id) ? 'selected' : '';--}}
                    {{--%>--}}
                     {{--<option <%=selected%> value="<%=id%>"><%=name%></option>--}}
                    {{--<% }); %>--}}
                {{--</select>--}}
            {{--</td>--}}
            {{--<td>--}}
                {{--<label><input type="radio" name="cash" value="0"/>б.нал</label>--}}
                {{--<label><input type="radio" name="cash" value="1"/>нал</label>--}}
            {{--</td>--}}
            {{--<td><input name="price"></td>--}}
            {{--<td>--}}
                {{--<label><input type="radio" name="paid" value="0"/>Нет</label>--}}
                {{--<label><input type="radio" name="paid" value="1"/>Оплачено</label>--}}
            {{--</td>--}}
            {{--<td><input type="ui_date" name="dateCompletedRus"></td>--}}
            {{--<td>--}}
                {{--<label><input type="radio" name="finished" value="0"/>Нет</label>--}}
                {{--<label><input type="radio" name="finished" value="1"/>Готово</label>--}}
            {{--</td>--}}
            {{--<td class="btnBox jAdd btn">--}}
                {{--<img class="right" src="img/icons/ic_playlist_add_24px.svg" alt="Добавить" title="Добавить"/>--}}
            {{--</td>--}}

<script type="text/template" id="tmplOrder">
    <td><%=id%></td>
    <td><%=dateCreatedRus%></td>
    <td><%=buyerName%></td>
    <td><%=desc%></td>
    <td><%=placeName%></td>
    <td><% if (cash == 1) { %>нал<% } else { %>безнал<% } %></td>
    <td><%=price%></td>
    <td><% if (paid ==  1) { %>оплатил<% } else { %>нет<% } %></td>
    <td><%=dateCompletedRus%></td>
    <td><% if (finished == 1) { %>готово<% } else { %>нет<% } %></td>
    <td class="btnBox jEdit">
        <div class="btn">Редакция</div>
    </td>
</script>

<script type="text/template" id="tmplOrderEdit">
    <td></td>
    <td><input type="ui_date" name="dateCreatedRus" value="<%=dateCreatedRus%>"/></td>
    <td>
        <select name="id_buyer">
            <% _.each(settings.cBuyers, function(x,index) {
                    var model = settings.cBuyers.at(index)
                        ,name = model.get('name')
                        ,id = model.get('id');

                    var selected = (id_buyer == id) ? 'selected' : '';
            %>
             <option <%=selected%> value="<%=id%>"><%=name%></option>
            <% }); %>
        </select>
    </td>
    <td><textarea name="desc"><%=desc%></textarea></td>
     <td>
        <select name="id_place">
            <% _.each(settings.cPlaces, function(x,index) {
                    var model = settings.cPlaces.at(index)
                        ,name = model.get('name')
                        ,id = model.get('id');

                    var selected = (id_place == id) ? 'selected' : '';
            %>
             <option <%=selected%> value="<%=id%>"><%=name%></option>
            <% }); %>
        </select>
    </td>
    <td>
        <label>
            <input type="radio" name="cash" value="0" <% if (cash == 0) { %> checked <% } %> />б.нал
        </label>
        <label>
            <input type="radio" name="cash" value="1" <% if (cash == 1) { %> checked <% } %> />нал
        </label>
    </td>
    <td><input name="price" value="<%=price%>"></td>
    <td>
        <label>
            <input type="radio" name="paid" value="0" <% if (paid == 0) { %> checked <% } %> />Нет
        </label>
        <label>
            <input type="radio" name="paid" value="1" <% if (paid == 1) { %> checked <% } %> />Оплачено
        </label>
    </td>
    <td><input type="ui_date" name="dateCompletedRus" value="<%=dateCompletedRus%>"></td>
    <td>
        <label>
            <input type="radio" name="finished" value="0" <% if (finished == 0) { %> checked <% } %> />Нет
        </label>
        <label>
            <input type="radio" name="finished" value="1" <% if (finished == 1) { %> checked <% } %> />Готово
        </label>
    </td>
    <% if (price != '') { %>
            <td class="btnBox">
                <img class="jCancel btn" src="img/icons/ic_undo_24px.svg" alt="Отмена" title="Отмена"/>
                <img class="jChange btn" src="img/icons/ic_edit_24px.svg" alt="Изменить" title="Изменить"/>
                <img class="Удалить btn" src="img/icons/ic_delete_24px.svg" alt="Удалить" title="Удалить"/>
            </td>
        <% } else { %>
            <td class="btnBox jAdd btn">
                <img class="right" src="img/icons/ic_playlist_add_24px.svg" alt="Добавить" title="Добавить"/>
            </td>
    <% } %>
</script>


    <script type="text/javascript" src="js/models/m.order.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.order.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.order.js" language="javascript"></script>

    {{--<script type="text/javascript" src="js/router/r.order.js"></script>--}}
    {{--<script type="text/javascript" src="js/pages/p.order.js"></script>--}}

@stop