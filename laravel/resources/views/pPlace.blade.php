{{-- шаблонизатор blade в действии // наследуем шаблон template\template.blade.php --}}
@extends('template.template')


{{--  все что напишем между @section('content') и @stop попадет в @yield('content') в шаблон в который мы обращаемся --}}
@section('content') {{-- здесь можно разместить контент --}}

    <div id="place" class="simpleView">
        <form id="addPlace">
            <input name="name" type="text" placeholder="вид продавца" />
            <button class="jAdd">Добавить</button>
        </form>
        <div id="placesBox"></div>
    </div>

    <script type="text/template" id="tmplPlace">
        <span><%=name%></span>
        <button class="jEdit">Ред-ть</button>
    </script>

    <script type="text/template" id="tmplPlaceEdit">
        <input class="" name="name" type="text" value="<%=name%>" />
        <button class="jDel">Удалить</button>
        <button class="jChange">Изм-ть</button>
        <button class="jCancel">Отмена</button>
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
    <script type="text/javascript" src="js/views/v.place.js" language="javascript"></script>
    <script type="text/javascript" src="js/collections/c.place.js" language="javascript"></script>

    {{--<script type="text/javascript" src="js/router/r.buyer.js"></script>--}}
    <script type="text/javascript" src="js/pages/p.place.js"></script>

@stop