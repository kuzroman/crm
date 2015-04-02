{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="buyersBox"></div>

    <script type="text/template" id="tmplBuyers">
        <div class="buyers silver">
            <ul class="head">
                <li class="num">#
                <li class="name">Название
                <li class="kind">Вид
                <li class="email">Описание
                <li class="add"><div class="jAdd">Добавить</div>
            </ul>
        </div>
        <div class="buyers silver" id="buyersList"></div>
    </script>

    <script type="text/template" id="tmplBuyer">
        <li class="num"><%=id%>
        <li class="name"><%=name%>
        <li class="kind"><%=kindName%>
        <li class="email"><%=about%>
        <% if (edit) { %>
            <li class="btn jEdit">Редакция
        <% } %>
    </script>

    <script type="text/template" id="tmplBuyerEdit">
        <div class="jClose close">X</div>
        <ul>
            <li><input name="name" value="<%=name%>"/>
            <li>
            <select name="id_kind">
                <% _.each(settings.cKindBuyers, function(x,index) {
                        var model = settings.cKindBuyers.at(index)
                            ,kind = model.get('kind')
                            ,id = model.get('id');

                        var selected = (id_kind == id) ? 'selected' : '';
                %>
                 <option <%=selected%> value="<%=id%>"><%=kind%></option>
                <% }); %>
            </select>
            <li><input name="about" value="<%=about%>">
            {{--<li><input type="button">--}}
            <li>
                <%  if (name == '') { %>
                    <button class="jAdd">Добавить</button>
                <% } else { %>
                    <button class="jChange mr18">Изменить</button>
                    <button class="jDel">Удалить</button>
                <% } %>
        </ul>
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
    {{--понадобится если захочу отобразить шаблон buyer.blade без kindBuer.blade--}}
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