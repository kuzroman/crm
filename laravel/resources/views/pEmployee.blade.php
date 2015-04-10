{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content')

<table id="employee" class="silver">
    <thead>
        <tr class="head">
            <td class="">Название</td>
            <td class="">Зарплата</td>
            <td class="">Работает</td>
            <td></td>
        </tr>
        <tr id="addEmployee">
            <td><input name="name" placeholder="ФИО" /></td>
            <td><input name="salary" placeholder="Зарплата" /></td>
            <td>
                <label><input type="radio" name="isWork" value="0"/>нет</label>
                <label><input type="radio" name="isWork" value="1"/>да</label>
            </td>
            <td class="btnBox jAdd btn">
                <img class="right" src="img/icons/ic_playlist_add_24px.svg" alt="Добавить" title="Добавить"/>
            </td>
        </tr>
    </thead>
    <tbody id="employeesBox"></tbody>
</table>

<script type="text/template" id="tmplEmployee">
    <td><%=name%></td>
    <td><%=salary%></td>
    <td><% if (isWork == 1) { %>работает<% } else { %>нет<% } %></td>
    <td class="btnBox jEdit">
        <div class="btn">Редакция</div>
    </td>
</script>

<script type="text/template" id="tmplEmployeeEdit">
    <td><input class="" name="name" type="text" value="<%=name%>" /></td>
    <td><input class="" name="salary" type="text" value="<%=salary%>" /></td>
    <td>
        <label><input type="radio" name="isWork_<%=id%>" value="0" <% if (isWork == 0) { %> checked <% } %>/>нет</label>
        <label><input type="radio" name="isWork_<%=id%>" value="1" <% if (isWork == 1) { %> checked <% } %>/>да</label>
    </td>
    <td class="btnBox">
        <img class="jCancel btn" src="img/icons/ic_undo_24px.svg" alt="Отмена" title="Отмена"/>
        <img class="jChange btn" src="img/icons/ic_edit_24px.svg" alt="Изменить" title="Изменить"/>
        <img class="jDel btn" src="img/icons/ic_delete_24px.svg" alt="Удалить" title="Удалить"/>
    </td>
</script>


    @if (isset($employees) && count($employees) )
    <script>
    $(function () {
        if (!settings.cEmployees)
            settings.cEmployees = new App.Collections.Employees( {!! $employees !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.employee.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.employee.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.employee.js" language="javascript"></script>

@stop