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
            <td><input name="isWork" placeholder="Работает" /></td>
            <td><div class="jAdd btn">Добавить</div></td>
        </tr>
    </thead>
    <tbody id="employeesBox"></tbody>
</table>

<script type="text/template" id="tmplEmployee">
    <td><%=name%></td>
    <td><%=salary%></td>
    <td><%=isWork%></td>
    <td class="btn jEdit">Редакция</td>
</script>

<script type="text/template" id="tmplEmployeeEdit">
    <td><input class="" name="name" type="text" value="<%=name%>" /></td>
    <td><input class="" name="salary" type="text" value="<%=salary%>" /></td>
    <td><input class="" name="isWork" type="text" value="<%=isWork%>" /></td>
    <td class="btn">
        <button class="jCancel">Отмена</button><br>
        <button class="jChange">Изм-ть</button><br>
        <button class="jDel">Удалить</button>
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