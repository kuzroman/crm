{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="buyersBox"></div>

    <script type="text/template" id="tmplBuyers">
        <thead>
            <tr class="head">
                <td>#</td>
                <td>Название</td>
                <td>Вид</td>
                <td>Описание</td>
                <td>Контакт</td>
                <td>Телефон 1</td>
                <td>Телефон 2</td>
                <td>Email</td>
                <td class=" btn"><div class="jAdd">Добавить</div></td>
            </tr>
        </thead>
        <tbody id="buyersList"></tbody>
    </script>

    <script type="text/template" id="tmplBuyer">
        <td><%=id%></td>
        <td><%=name%></td>
        <td><%=kindName%></td>
        <td><%=about%></td>
        <td><%=contact%></td>
        <td><%=cell_1%></td>
        <td><%=cell_2%></td>
        <td><%=email%></td>
        <% if (edit) { %>
            <td class="btn jEdit">Редакция</td>
        <% } %>
    </script>

    <script type="text/template" id="tmplBuyerEdit">
        <div class="jClose close">X</div>
        <table>
            <tr>
                <td>Название</td>
                <td><input name="name" value="<%=name%>"/></td>
            </tr>
            <tr>
                <td>Вид</td>
                <td>
                    <select name="id_kind">
                        <% _.each(settings.cKindBuyers, function(x,index) {
                                var model = settings.cKindBuyers.at(index)
                                    ,name = model.get('name')
                                    ,id = model.get('id');

                                var selected = (id_kind == id) ? 'selected' : '';
                        %>
                         <option <%=selected%> value="<%=id%>"><%=name%></option>
                        <% }); %>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Описание</td>
                <td><textarea name="about"><%=about%></textarea></td>
            </tr>
            <tr>
                <td>Контакт</td>
                <td><input name="contact" value="<%=contact%>"></td>
            </tr>
            <tr>
                <td>Телефон 1</td>
                <td><input name="cell_1" value="<%=cell_1%>"></td>
            </tr>
            <tr>
                <td>Телефон 2</td>
                <td><input name="cell_2" value="<%=cell_2%>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input name="email" value="<%=email%>"></td>
            </tr>
            <tr>
                <td></td>
                <td class="pt9">
                 <%  if (name == '') { %>
                    <button class="jAdd">Добавить</button>
                <% } else { %>
                    <button class="jChange mr18">Изменить</button>
                    <button class="jDel">Удалить</button>
                <% } %>
                </td>
            </tr>




        </table>
    </script>


    @if (isset($buyers) && count($buyers) )
    <script>
    $(function () {
        if (!settings.cBuyers)
            settings.cBuyers = new App.Collections.Buyers( {!! $buyers !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.kindBuyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.kindBuyer.js" language="javascript"></script>
    @if (isset($kind_buyer) && count($kind_buyer) )
    <script>
    $(function () {
        if (!settings.cKindBuyers)
            settings.cKindBuyers = new App.Collections.KindBuyers( {!! $kind_buyer !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.buyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.buyer.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.buyer.js" language="javascript"></script>

    <script type="text/javascript" src="js/router/r.buyer.js"></script>
    <script type="text/javascript" src="js/pages/p.buyer.js"></script>

@stop