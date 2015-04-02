{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="contactsBox"></div>

    <script type="text/template" id="tmplContacts">
        <div class="buyers silver">
            <ul class="head">
                <li class="per3">#
                <li class="per20">Название
                <li class="per15">Телефон 1
                <li class="per15">Телефон 2
                <li class="per20">E-mail
                <li class="add"><div class="jAdd">Добавить</div>
            </ul>
        </div>
        <div class="buyers silver" id="contactsList"></div>
    </script>

    <script type="text/template" id="tmplContact">
        <li class="per3"><%=id%>
        <li class="per20"><%=name%>
        <li class="per15"><%=cell_1%>
        <li class="per15"><%=cell_2%>
        <li class="per20"><%=email%>
        <% if (edit) { %>
            <li class="btn jEdit">Редакция
        <% } %>
    </script>

    <script type="text/template" id="tmplContactEdit">
        <div class="jClose close">X</div>

        <table>
            <tr>
                <td width="75">Название</td>
                <td><input name="name" value="<%=name%>"/></td>
            </tr>
            <tr>
                <td>Тел 1</td>
                <td><input name="cell_1" value="<%=cell_1%>"/></td>
            </tr>
            <tr>
                <td>Тел 2</td>
                <td><input name="cell_2" value="<%=cell_2%>"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input name="email" value="<%=email%>"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <%  if (name == '') { %>
                        <button class="jAdd">Добавить</button>
                    <% } else { %>
                        <button class="jChange mr18">Изменить</button>
                        <button class="jDel">Удалить</button>
                    <% } %>
                </td>
            </tr>
        </table>


        {{--<ul>--}}
            {{--<li><input name="name" value="<%=name%>"/>--}}
            {{--<li><input name="cell_1" value="<%=cell_1%>"/>--}}
            {{--<li><input name="cell_2" value="<%=cell_2%>"/>--}}
            {{--<li><input name="email" value="<%=email%>">--}}
            {{--<li>--}}
                {{--<%  if (name == '') { %>--}}
                    {{--<button class="jAdd">Добавить</button>--}}
                {{--<% } else { %>--}}
                    {{--<button class="jChange mr18">Изменить</button>--}}
                    {{--<button class="jDel">Удалить</button>--}}
                {{--<% } %>--}}
        {{--</ul>--}}
    </script>



    @if (isset($contact) && count($contact) )
    <script>
    $(function () {
        if (!settings.cContacts)
            settings.cContacts = new App.Collections.Contacts( {!! $contact !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.contact.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.contact.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.contact.js" language="javascript"></script>

    {{--<script type="text/javascript" src="js/router/r.buyer.js"></script>--}}
    <script type="text/javascript" src="js/pages/p.contact.js"></script>

@stop