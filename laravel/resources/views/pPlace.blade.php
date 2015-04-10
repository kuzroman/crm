{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')

{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

<table id="place" class="silver">
    <thead>
        <tr class="head">
            <td class="">Вид продавца</td>
            <td></td>
        </tr>
        <tr id="addPlace">
            <td><input name="name" placeholder="Вид продавца"/></td>
            <td class="btnBox jAdd btn">
                <img class="right" src="img/icons/ic_playlist_add_24px.svg" alt="Добавить" title="Добавить"/>
            </td>
        </tr>
    </thead>
    <tbody id="placesBox"></tbody>
</table>

<script type="text/template" id="tmplPlace">
    <td><%=name%></td>
    <td class="btnBox jEdit">
        <div class="btn">Редакция</div>
    </td>
</script>

<script type="text/template" id="tmplPlaceEdit">
    <td><input class="" name="name" type="text" value="<%=name%>" /></td>
    <td class="btnBox">
        <img class="jCancel btn" src="img/icons/ic_undo_24px.svg" alt="Отмена" title="Отмена"/>
        <img class="jChange btn" src="img/icons/ic_edit_24px.svg" alt="Изменить" title="Изменить"/>
        <img class="jDel btn" src="img/icons/ic_delete_24px.svg" alt="Удалить" title="Удалить"/>
    </td>
</script>


    @if (isset($place) && count($place) )
    <script>
    $(function () {
        if (!settings.cPlaces)
            settings.cPlaces = new App.Collections.Places( {!! $place !!} )
    })
    </script>
    @endif


    <script type="text/javascript" src="js/models/m.place.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.place.js" language="javascript"></script>
    <script type="text/javascript" src="js/views/v.place.js" language="javascript"></script>

@stop